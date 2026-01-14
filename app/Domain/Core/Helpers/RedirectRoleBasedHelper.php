<?php

namespace App\Domain\Core\Helpers;

use Illuminate\Support\Facades\Auth;

class RedirectRoleBasedHelper
{
    /**
     * Redirect user based on their role after login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function redirectBasedOnRole()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('admin.login');
        }

        // Always redirect to dashboard as requested by user
        return redirect()->route('admin.dashboard.index');
    }
}
