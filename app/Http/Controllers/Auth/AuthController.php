<?php

namespace App\Http\Controllers\Auth;

use App\Classes\AuthClass;
use App\Classes\UserManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    /**
     * @var AuthClass
     */
    private $authClass;

    private $userManagement;

    public function __construct(UserManagement $userManagement, AuthClass $authClass) {
        $this->authClass = $authClass;
        $this->userManagement = $userManagement;
    }

    public function login(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        return $this->authClass->loginUser($request->only(['email','password']));
    }


    public function register(Request $request){
        $this->validate($request,[
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'name' => 'required|string',
            'telephone' => 'required|numeric|unique:users',
            'user_type' => 'required',
            'business_category' => 'required',
            'address_text' => 'required',
            'address_latitude' => 'required',
            'address_longitude' => 'required',
        ]);
        return $this->userManagement->register($request->only([
            'email','password','name','telephone', 'user_type', 'address_text', 'business_category',
            'address_latitude', 'address_longitude']));
    }

    public function userVerification(Request $request){
        $this->validate($request,[
            'otp' => 'required'
        ]);
        $user =  $request->user();

        return $this->authClass->verifyUserEmail($user,$request->otp);
    }

    public function resendVerification(Request $request){
        $user = $request->user();
        return $this->authClass->resendVerificationEmail($user);
    }

    public function resetPasswordMail(Request $request){
        $this->validate($request,[
            'email' => 'required|email|exists:users,email'
        ]);
        return $this->authClass->sendResetPasswordMail($request->email);
    }

    public function checkToken() {
        return response()->fetch(
            "Checking authentication",
            Auth::check(),
            'auth'
        );
    }

    public function passwordReset(Request $request){
        $this->validate($request,[
            'password'=> 'required|confirmed'
        ]);
        $user =  $request->user();
        return $this->authClass->resetPassword($user,$request->only(['password']));
    }
}
