<?php

namespace App\States;

use App\Models\User;

class LoggedInState implements LoginState
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login()
    {
        // User is already logged in, do nothing
    }

    public function logout()
    {
        // Logic for logging out
        // For example:
        $this->user->changeState('not_logged_in');
    }
}
