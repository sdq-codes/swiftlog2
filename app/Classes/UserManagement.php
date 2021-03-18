<?php
namespace App\Classes;

use App\Adapter\Interfaces\SmsAdapterInterface;
use App\Events\AccountRegistered;
use App\Exceptions\CustomValidationFailed;
use App\Http\Resources\UserResource;
use App\Models\Otp;
use App\Models\User;
use App\Repositories\Interfaces\OtpRepositoriesInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Traits\ExceptionsHandlers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserManagement {
    /**
     * @var User
     */
    private $user;

    private  $auth;

    private $smsAdapter;

    private $userRepository;

    private $otpRepositories;

    use ExceptionsHandlers;

    public function __construct(
        UserRepositoryInterface $userRepository,
        OtpRepositoriesInterface $otpRepositories,
        SmsAdapterInterface $smsAdapter
    ) {
        $this->user = new User();
        $this->auth = Auth::guard('api');
        $this->userRepository = $userRepository;
        $this->otpRepositories = $otpRepositories;
        $this->smsAdapter = $smsAdapter;
    }
    protected function otp(object $user):void {
        $otp = generateRandomstring(4);
        if ($this->otpRepositories->checkForExisting($user)) {
            $this->otpRepositories->update($user, $otp);
        } else {
            $this->otpRepositories->create($user, $otp);
        }
        event(new AccountRegistered($user, $otp));
    }

    public function register($data) {
        $user = null;
        $person = null;
        if ($data['user_type'] === 'admin') {
            $data['password'] = generateRandomstring(10);
            $person = $data['password'];
        }
        $data['password'] = Hash::make($data['password']);
        DB::transaction(function () use (&$user,$data){
            $user = $this->userRepository->create($data);
            $token = auth()->login($user);
            $user->access_token = $token;
            $this->otp($user);
        });
        $resource = new UserResource($user);
        if ($data['user_type'] === 'admin') {
            $this->smsAdapter->sendPassword($person, $user);
        }
        return response()->fetch(
            "Registration  Successful",
            $resource,
            'user'
        );
    }

    public function registerMemeber($data) {
        $user = null;
        $person = null;
        if ($data['user_type'] === 'admin') {
            $data['password'] = generateRandomstring(10);
            $person = $data['password'];
        }
        $data['password'] = Hash::make($data['password']);
        DB::transaction(function () use (&$user,$data){
            $user = $this->userRepository->createMember($data);
        });
        if ($data['user_type'] === 'admin') {
            $this->smsAdapter->sendPassword($person, $user);
        }
        return response()->fetch(
            "Registration  Successful",
            $user,
            'user'
        );
    }

    public function count(string $userType) {
        return response()->fetch(
            "Total number",
            $this->userRepository->userCount($userType),
            'count'
        );
    }

    public function users($limit, array $data) {
        return response()->fetch(
            "Total number",
            $this->userRepository->fetch($limit, $data),
            'count'
        );
    }

    public function update(array $data) {
        $user = Auth::user();
        $this->checkIfResourceFound($user, "User profile cannot be found.");
        $user = $this->userRepository->findById($user->id);
        return response()->updated(
            "Profile updated",
            $this->userRepository->update($user, $data),
            "User"
        );
    }

    public function resendOtp() {
        $this->otp(Auth::user());
        return true;
    }

    public function updatePassword(array $data) {
        $check = Hash::check($data['old_password'], auth()->user()->password);
        if (!$check) {
            throw new CustomValidationFailed("Old password is wrong.");
        }
        return response()->updated(
            "Profile updated",
            $this->userRepository->updatePassword(Hash::make($data['new_password']), auth()->user()),
            "User"
        );
    }

}