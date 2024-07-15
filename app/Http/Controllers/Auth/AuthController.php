<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::find($request->user_id);
        $user->login();
        
        return redirect()->route('hotels.index');
    }

    public function logout(Request $request)
    {
        $user = User::find($request->user_id);
        $user->logout();
        
        return redirect()->route('home');
    }
}
