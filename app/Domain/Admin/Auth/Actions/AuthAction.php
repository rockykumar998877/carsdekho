<?php

namespace Domain\Admin\Auth\Actions;

use Domain\Admin\Auth\Services\AuthService;
use Domain\Admin\User\Dtos\UserDto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(private AuthService $authService)
    {
        //
    }

    /**
     * function to initiate the login action
     *
     * @param UserDto $userDto
     * @return boolean
     */
    public function loginAction(UserDto $userDto): bool
    {
        $userData = $this->authService->login($userDto);
        if ($userData) {
            return true;
        }
        return false;
    }

    /**
     * Send a password reset link to the user.
     *
     * @param UserDto $userDto
     * @return string The status of the password reset link sending process.
     */
    public function forgotPasswordAction(UserDto $userDto): string
    {
        // We use Laravel's built-in password reset functionality.
        // It will handle token generation, storage, and sending the notification.
        $status = Password::broker('users')->sendResetLink(
            ['email' => $userDto->email]
        );

        return $status;
    }

    /**
     * Reset the user's password.
     *
     * @param array $credentials
     * @return string The status of the password reset attempt.
     */
    public function resetPasswordAction(array $credentials): string
    {
        $status = Password::broker('users')->reset(
            $credentials,
            function ($user, $password) {
                $this->authService->resetPassword($user, $password);
            }
        );

        return $status;
    }

    /**
     * function to initiate the logout action
     *
     * @return void
     */
    public function logoutAction()
    {
        $this->authService->logout();
    }
}
