<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Todo;

class TodosController extends Controller
{
    // 未認証のユーザーをログインページに移動させる
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 指定した日付のTodo一覧をjsonで返す
    public function index($userId, $date)
    {
        $user = User::where('name', $userId)->first();
        $todos = Todo::where('user_id', $user->id)->whereDate('created_at', '=', $date)->get();
        return response()->json($todos);
    }
}
