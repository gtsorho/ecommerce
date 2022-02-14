<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\partners;
use App\Models\products;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Validation\Rules\Password as RulesPassword;



class partnersController extends Controller
{ 
// ****************************************Dependent Functions***********************************
    public function generateUniqueCode(){
        $characters = '0123456789';
        $code = '';

        while (strlen($code) < 6) {
            $position = rand(0, 10 - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }

        if (Partners::where('store_id', $code)->exists()) {
            $this->generateUniqueCode();
        }

        return $code;
    }

    // ********************************** CURD functions***************************************

    public function show (Request $request) {
        return response()->json(auth()->user(), 200);
    }

    public function partnerProducts (Request $request) {
        $partner = auth()->user();
        $products = $partner->products;
        return response()->json($products, 200);
    }

    public function partnerProductOne ($id) {
        $partner = auth()->user();
        $product = $partner->products()->where('productId',$id)->first();
        return response()->json([$product], 200);
    }

    public function destroyProduct($id)
    {
        $partner = auth()->user();
        // $partner->products()->where('productId',$id)->first();
        $img_delete = Storage::disk('public')->delete($partner->products()->where('productId',$id)->image);
        $product = $partner->products()->where('productId',$id)->delete();
        return response()->json($product, 200);
    }

    public function index (Request $request) {
        return response()->json(Partners::all(), 200);
    }


    // **********************************Authentication Funtions****************************************
    public function register(Request $Request){
        
        $Request->merge(['store_id' => $this->generateUniqueCode()]);

        $fields = $Request->validate([
            'store_id' => 'required|string|unique:partners,store_id',
            'fullname' => 'required|string',
            'shop_name' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'contact' => 'required|string',
            'email' => 'required|string|unique:partners,email',
            'password' => 'required|string|confirmed'
        ]);
        $partner =  $fields['password'] = bcrypt($fields['password']);
        $partner = Partners::create($fields);

        
        $token = $partner->createToken('myapptoken') -> plainTextToken;
        
        $response = [
            'user' => $partner,
            'token' => $token   
        ];

        event(new Registered($partner));
        return response()->json($response, 201);
    }

    public function login(Request $Request){
        $fields = $Request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $partner = Partners::where('email', $fields['email'])->first();

        if(!$partner || !Hash::check($fields['password'], $partner->password)){
            return response()->json(['message'=> 'invalid credentials'], 401);
        }
        $token = $partner->createToken('myapptoken') -> plainTextToken;
        
        $response = [
            'partner' => $partner,
            'token' => $token   
        ];

        return response()->json($response, 201);
    }


    public function partnerLogout(Request $Request){
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>'logged out']);
    }

    public function updatePartner(Request $Request){
        
        $fields = $Request->validate([
            'fullname' => 'nullable|string',
            'shop_name' => 'nullable|string',
            'location' => 'nullable|string',
            'certification' => 'nullable|boolean',
            'description' => 'nullable|string',
            'contact' => 'nullable|string',
            'email' => 'nullable|string|unique:partners,email',
            'password' => 'nullable|string|confirmed'
        ]);

        if($Request->has('password')){
            $fields['password'] = bcrypt($fields['password']);
        }

        $partner = auth()->user();
        $updated = $partner->update($fields);  


        return response()->json([$updated, $partner], 200);
    }

    public function destroyPartner(request $request)
    {
        $partner = auth()->user();
        $deleted = $partner->delete();

        return response()->json($deleted, 200);
    }

    // ******************************** Password Reset ***********************************
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::broker('partners')->sendResetLink(
            $request->only('email')
        );
        
        if($status == Password::RESET_LINK_SENT) {
            return [
                'status' => __($status)
            ];
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    public function reset(Request $request)
    {

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);

        $status = Password::broker('partners')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message'=> 'Password reset successfully'
            ]);
        }

        return response([
            'message'=> __($status)
        ], 500);

    }

    // // **************************** Email Verificatation ***************************************
    public function sendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Already Verified'
            ]);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['status' => 'verification-link-sent']);
    }

    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email already verified'
            ]);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response()->json([
            'message'=>'Email has been verified'
        ]);
    }
}
