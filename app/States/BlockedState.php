<?php

namespace App\States;

use App\Models\User;

class BlockedState implements LoginState
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login()
    {
        // User is blocked, cannot log in
    }

    public function logout()
    {
        // Logic for logging out while blocked
        // For example:
        $this->user->changeState('not_logged_in');
    }
}
