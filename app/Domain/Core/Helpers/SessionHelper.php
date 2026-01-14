<?php

namespace App\Domain\Core\Helpers;

class SessionHelper
{
    /**
     * function to get the current session id
     *
     * @return string
     */
    public static function getCurrentSessionId():string
    {
        return session()->getId();
    }
}