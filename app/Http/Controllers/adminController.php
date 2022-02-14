<?php

namespace App\Http\Controllers;

use App\Models\admins;
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

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        return response()->json(admins::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerAdmin(request $request){
        $fields = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'phone' => 'required|string',
            'username' => 'required|string|unique:admins,username',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);
        $admin = admins::create([
            'firstname' => $fields['firstname'],
            'lastname' => $fields['lastname'],
            'username' => $fields['username'],
            'phone' => $fields['phone'],
            'email' => $fields['email'],
            'password' =>bcrypt($fields['password'])
        ]);

        $token = $admin->createToken('myapptoken') -> plainTextToken;
        
        $response = [
            'user' => $admin,
            'token' => $token   
        ];
        return response()->json($response, 201);
    }


    public function updateAdmin(Request $Request){
        $admin = auth()->user();
        $fields = $Request->validate([
            'firstname' => 'nullable|string',
            'lastname' => 'nullable|string',
            'username' => 'nullable|string|unique:admin,username',
            'phone' => 'nullable|string',
            'email' => 'nullable|string|unique:users,email',
            'password' => 'nullable|string|confirmed'
        ]);
        $admin = $admin->update($fields);
        return response()->json(['message'=>$admin], 200);
    }


    public function loginAdmin(Request $Request){
        $fields = $Request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $admin = admins::where('email', $fields['email'])->first();
        if(!$admin || !Hash::check($fields['password'], $admin->password)){
            return response()->json(['message'=> 'invalid credentials'], 401);
        }
        $token = $admin->createToken('myapptoken') -> plainTextToken;
        
        $response = [
            'admin' => $admin,
            'token' => $token   
        ];

        return response()->json($response, 201);
    }

    public function logoutAdmin(Request $Request){
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>'logged out']);
    }


    public function deleteDelete(Request $Request){
        $delete = auth()->user()->delete();
        if($delete){
            return response()->json($delete,['message'=>'account Deleted'], 200);
        } 
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAdmin(Request $Request)
    {
        $admin = auth()->user()->first();
        return response()->json($admin, 200); 
    }

}
