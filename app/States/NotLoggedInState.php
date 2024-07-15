<?php

namespace App\States;

use App\Models\User;

class NotLoggedInState implements LoginState
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login()
    {
        // Logic for logging in
        // For example:
        $this->user->changeState('logged_in');
    }

    public function logout()
    {
        // User is already logged out, do nothing
    }
}
