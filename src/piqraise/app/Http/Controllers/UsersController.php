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
        $this->middleware('auth');
    }

    // Todo一覧をjsonで返す
    public function index($userId)
    {
        $user = User::where('name', $userId)->first();
        $todos = Todo::where('user_id', $user->id)->get();
        return response()->json($todos);
    }
}
