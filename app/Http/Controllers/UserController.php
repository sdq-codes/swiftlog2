<?php

namespace App\Http\Controllers;

use App\Classes\UserManagement;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    private $userManagement;

    public function __construct(UserManagement $userManagement) {
        $this->userManagement = $userManagement;
    }

    public function count(string $userType) {
        return $this->userManagement->count($userType);
    }

    public function users(Request $request) {
        return $this->userManagement->users(10, $request->all());
    }

    public function update(Request $request) {
//        return $request->all();
        $this->validate($request, [
            'email' => 'email|unique:users',
            'telephone' => 'numeric|unique:users'
        ]);
        return $this->userManagement->update($request->all());
    }

    public function block(Request $request) {
        $user = User::whereId($request->userId)->first();
        return User::whereId($user->id)->update([
            "active" => !$user->active
        ]);
    }

    public function otp() {
        return $this->userManagement->resendOtp();
    }

    public function changePassword(Request $request) {
        $this->validate($request, [
            'new_password' => 'required|min:8|same:new_password_confirm',
            'new_password_confirm' => 'required|min:8|same:new_password'
        ]);
        return $this->userManagement->updatePassword($request->all());
    }

    public function rider(Request $request) {
        $this->validate($request, [
            'new_password' => 'required|min:8|same:new_password_confirm',
            'new_password_confirm' => 'required|min:8|same:new_password'
        ]);
        return $this->userManagement->updatePassword($request->all());
    }

    public function admin() {
        return response()->created(
            "Successfully created coupons",
            User::where("user_type", "admin")->get(),
            "admins"
        );
    }
}
