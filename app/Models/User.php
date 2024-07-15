<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\States\LoginState;
use App\States\NotLoggedInState;
use App\States\LoggedInState;
use App\States\BlockedState;

class User extends Authenticatable
{
    protected $state;

    // Assuming 'status' is a field in your users table that holds the current state
    protected $fillable = ['name', 'email', 'password', 'status'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setState($this->status);
    }

    public function setState($status)
    {
        switch ($status) {
            case 'not_logged_in':
                $this->state = new NotLoggedInState($this);
                break;
            case 'logged_in':
                $this->state = new LoggedInState($this);
                break;
            case 'blocked':
                $this->state = new BlockedState($this);
                break;
            default:
                $this->state = new NotLoggedInState($this);
                break;
        }
    }

    public function login()
    {
        $this->state->login();
    }

    public function logout()
    {
        $this->state->logout();
    }

    public function changeState($status)
    {
        $this->status = $status;
        $this->setState($status);
        $this->save();
    }
}
