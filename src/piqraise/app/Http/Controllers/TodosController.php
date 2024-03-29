<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use App\Http\Requests\TodoEditRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodosController extends Controller
{

    public function create() {
        return view('pages.todo.create');
    }

    public function edit($id)
    {
        $todo = Todo::where('user_id', Auth::id())->where('id', $id)->first();
        return view('pages.todo.edit', compact('todo'));
    }

    public function update(TodoEditRequest $request, $id)
    {
        Todo::where('user_id', Auth::id())->where('id', $id)->update([
            'target_date' => $request->date,
            'content' => $request->content,
        ]);
        return redirect()->back();
    }

    public function store(TodoCreateRequest $request)
    {
        Todo::create([
            'user_id' => Auth::id(),
            'done_flag' => false,
            'public_flag' => $request->public_flag,
            'content' => $request->content,
            'target_date' => $request->date,
        ]);
        return redirect()->back();
    }

    // MEMO: あえての物理削除
    public function delete($id) {
        Todo::where('user_id', Auth::id())->where('id', $id)->delete();
        return redirect()->back();
    }

    public function today()
    {
        $todos = Todo::where('user_id', Auth::id())->whereDate('target_date', Carbon::today())->get();
        $date = date_parse(Carbon::today());
        $year = $date['year'];
        $month = $date['month'];
        $day = $date['day'];
        return view('pages.todo.today', compact('todos', 'year', 'month', 'day'));
    }

    // TODO: perry 後でserviceらへんでまとめる
    public function get($date)
    {
        $todos = Todo::where('user_id', Auth::id())->whereDate('target_date', $date)->get();
        $date = date_parse($date);
        $year = $date['year'];
        $month = $date['month'];
        $day = $date['day'];
        return view('pages.todo.get', compact('todos', 'year', 'month', 'day'));
    }

    public function getPublic($userId, $date)
    {
        if (Auth::id() == $userId) {
            return redirect(route('todo.date', $date));
        }
        $todos = Todo::where('user_id', $userId)->whereDate('target_date', $date)->where('public_flag', true)->get();
        $date = date_parse($date);
        $year = $date['year'];
        $month = $date['month'];
        $day = $date['day'];
        return view('pages.todo.public', compact('todos', 'year', 'month', 'day'));
    }

    public function updatePublicFlagTrue($id)
    {
        Todo::where('user_id', Auth::id())->where('id', $id)->update(['public_flag' => true]);
        return redirect()->back();
    }

    public function updatePublicFlagFalse($id)
    {
        Todo::where('user_id', Auth::id())->where('id', $id)->update(['public_flag' => false]);
        return redirect()->back();
    }

    public function updateDoneFlagTrue($id)
    {
        Todo::where('user_id', Auth::id())->where('id', $id)->update(['done_flag' => true]);
        return redirect()->back();
    }

    public function updateDoneFlagFalse($id)
    {
        Todo::where('user_id', Auth::id())->where('id', $id)->update(['done_flag' => false]);
        return redirect()->back();
    }
}
