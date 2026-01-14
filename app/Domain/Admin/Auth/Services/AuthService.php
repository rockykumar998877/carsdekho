<?php

namespace Domain\Admin\Auth\Services;

use App\Domain\Admin\User\Enums\UserEnumsStatus;
use App\Infrastructure\Persistence\UserRepository;
use Domain\Admin\User\Dtos\UserDto;
use Domain\Admin\User\Entities\UserEntity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    private $userEntity;

    /**
     * Create a new class instance.
     */
    public function __construct(private UserRepository $userRepository)
    {
        $this->userEntity = UserEntity::class;
    }

    /**
     * Undocumented function
     *
     * @param UserDto $userDto
     * @return UserEntity|null
     */
    public function login(UserDto $userDto): ?UserEntity
    {
        $user = $this->userRepository->getDataOnBasisOfFilter(['email' => $userDto->email])->first();
        if (!$user || !Hash::check($userDto->password, $user->password)) {
            return null;
        }

        if ($user->status == UserEnumsStatus::inactive) {
            auth()->guard('web')->logout();
            session()->flash('error', trans('app.auth.login.inactive_access'));
        }

        Auth::loginUsingId($user->id);
        return $this->userEntity::fromModel($user);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    public function resetPassword($user, string $password): void
    {
        $user->password = Hash::make($password);
        $user->save();
    }

    /**
     * function to perform the logout operation
     *
     * @return void
     */
    public function logout()
    {
        Auth::logout();
    }
}
