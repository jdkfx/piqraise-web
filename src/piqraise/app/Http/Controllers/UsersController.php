<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Todo;

class UsersController extends Controller
{
    // 未認証のユーザーをログインページに移動させる
    public function __construct()
    {
        // $this->middleware('auth');
    }
}
