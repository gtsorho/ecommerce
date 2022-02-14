<?php

namespace App\Http\Controllers;

use App\Models\User;
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



class authController extends Controller
{
    public function show (Request $request) {
        return response()->json(auth()->user(), 200);
    }

    public function index (Request $request) {
        return response()->json(User::all(), 200);
    }

    public function register(Request $Request){
        $fields = $Request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);
        $user = User::create([
            'firstname' => $fields['firstname'],
            'lastname' => $fields['lastname'],
            'phone' => $fields['phone'],
            'email' => $fields['email'],
            'password' =>bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken') -> plainTextToken;
        
        $response = [
            'user' => $user,
            'token' => $token   
        ];

        event(new Registered($user));
        return response()->json($response, 201);
    }

    public function login(Request $Request){
        $fields = $Request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response()->json(['message'=> 'invalid credentials'], 401);
        }
        $token = $user->createToken('myapptoken') -> plainTextToken;
        
        $response = [
            'user' => $user,
            'token' => $token   
        ];

        return response()->json($response, 201);
    }


    public function logout(Request $Request){
        auth()->user()->tokens()->delete();

        return response()->json(['message'=>'logged out']);
    }

    public function delete(Request $Request){
        $delete = auth()->user()->delete();
        if($delete){
            return response()->json($delete,['message'=>'account Deleted'], 200);
        } 
    }

    public function update(Request $Request){
        $user = auth()->user();
        $fields = $Request->validate([
            'firstname' => 'nullable|string',
            'lastname' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|string|unique:users,email',
            'password' => 'nullable|string|confirmed'
        ]);
        $user->update($fields);
        return response()->json($user, ['message'=>'updated'], 200);
    }

    // ******************************** Password Reset ***********************************
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
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

        $status = Password::reset(
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

    // **************************** Email Verificatation ***************************************
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
