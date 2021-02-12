<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodosController extends Controller
{
    // Todo一覧をjsonで返す
    public function index()
    {
        $todos = Todo::all();
        return response()->json($todos);
    }
}
