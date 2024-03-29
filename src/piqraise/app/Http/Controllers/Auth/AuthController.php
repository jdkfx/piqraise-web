<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Socialite;

class AuthController extends Controller
{
    public function TwitterRedirect()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function TwitterCallback()
    {
        try {
            $user = Socialite::driver('twitter')->user();
            $user_info = User::firstOrCreate(['token' => $user->token, 'name' => $user->nickname, 'email' => $user->getEmail()]);
            \Auth::login($user_info, true);
        }
        catch(\Exception $e) {
            dd($e);
            return redirect('/');
        }

        return redirect('/today');
    }

    public function getLogout()
    {
        \Auth::logout();
        return redirect('/');
    }
}
