<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodosController extends Controller
{
    // 未認証のユーザーをログインページに移動させる
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function create() {
        return view('pages.todo.create');
    }

    public function store(TodoCreateRequest $request)
    {
        $todo = Todo::create([
            // 'user_id' => Auth::id(),
            'user_id' => 1,
            'done_flag' => false,
            'public_flag' => $request->public_flag,
            'content' => $request->content,
            'target_date' => $request->date,
        ]);
        return redirect(route('index'))->with('success', __('created'));
    }

    public function today()
    {
        // $todos = Todo::where('user_id', Auth::id())->whereDate('target_date', Carbon::today())->get();
        $todos = Todo::where('user_id', 1)->whereDate('target_date', Carbon::today())->get();
        return view('pages.todo.today', compact('todos'));
    }

    // TODO: perry 後でserviceらへんでまとめる
    public function get($date)
    {
        // $todos = Todo::where('user_id', Auth::id())->whereDate('target_date', $date)->get();
        $todos = Todo::where('user_id', 1)->whereDate('target_date', $date)->get();
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
        // Todo::where('user_id', Auth::id())->where('id', $id)->update(['public_flag' => true]);
        Todo::where('user_id', 1)->where('id', $id)->update(['public_flag' => true]);
        return redirect()->back();
    }

    public function updatePublicFlagFalse($id)
    {
        // Todo::where('user_id', Auth::id())->where('id', $id)->update(['public_flag' => false]);
        Todo::where('user_id', 1)->where('id', $id)->update(['public_flag' => false]);
        return redirect()->back();
    }

    public function updateDoneFlagTrue($id)
    {
        // Todo::where('user_id', Auth::id())->where('id', $id)->update(['done_flag' => true]);
        Todo::where('user_id', 1)->where('id', $id)->update(['done_flag' => true]);
        return redirect()->back();
    }

    public function updateDoneFlagFalse($id)
    {
        // Todo::where('user_id', Auth::id())->where('id', $id)->update(['done_flag' => false]);
        Todo::where('user_id', 1)->where('id', $id)->update(['done_flag' => false]);
        return redirect()->back();
    }

    // OGP画像を作成する
    public function createOgpImg()
    {
        $w = 640;
        $h = 360;

        $font = storage_path('./font/NotoSansJP-Regular.otf');

        $image = \imagecreatetruecolor($w, $h);
        $bg = \imagecreatefromjpeg(storage_path('./img/bg.jpg'));

        imagecopyresampled($image, $bg, 0, 0, 0, 0, $w, $h, 640, 360);

        $black = imagecolorallocate($image, 0, 0, 0);

        $todos = Todo::where('user_id', Auth::id())->whereDate('target_date', Carbon::today())->get();

<<<<<<< Updated upstream
        $parts = $this->createParts($doneTask2, 255);
        $this->drawParts($image, $parts, $w, $h, 80, 150, 25, $font, $black);

        $parts = $this->createParts($doneTask3, 255);
        $this->drawParts($image, $parts, $w, $h, 80, 200, 25, $font, $black);

        $parts = $this->createParts($task, 20);
        $this->drawParts($image, $parts, $w, $h, 80, 250, 25, $font, $black);

        $parts = $this->createParts($otherTaskCount, 255);
        $this->drawParts($image, $parts, $w, $h, 300, 300, 20, $font, $black);

        $parts = $this->createParts($userImg, 255);
        $this->drawParts($image, $parts, $w, $h, 50, 330, 18, $font, $black);

=======
        $date = Carbon::today()->format('Y/m/d') . 'のタスク';
        $parts = $this->createParts($date , 18);
        $this->drawParts($image, $parts, $w, $h, 30, 50, 18, $font, $black);

        $i = 0;
        $y = 100;
        foreach ($todos as $todo) {
            if ($i > 3) {
                $otherTodosCount = $todos->count() - 4;
                $otherTodo = '他' . $otherTodosCount . '件のタスクを見る…';
                $parts = $this->createParts($otherTodo, 20);
                $this->drawParts($image, $parts, $w, $h, 300, 290, 20, $font, $black);
                break;
            }

            if ($todo->done_flag == true) {
                $doneTask = $todo;
                $parts = $this->createParts($doneTask->content, 20);
                $this->drawParts($image, $parts, $w, $h, 80, $y, 25, $font, $black);
                $y += 50;
            } else {
                $doingTask = $todo;
                $parts = $this->createParts($doingTask->content, 20);
                $this->drawParts($image, $parts, $w, $h, 80, $y, 25, $font, $black);
                $y += 50;
            }

            $i++;
        }
        
        // Twitterアイコンを取り出す
        // $parts = $this->createParts($userImg, 255);
        // $this->drawParts($image, $parts, $w, $h, 50, 330, 18, $font, $black);
        
        $userName = Auth::user()->name;
>>>>>>> Stashed changes
        $parts = $this->createParts($userName, 255);
        $this->drawParts($image, $parts, $w, $h, 80, 330, 15, $font, $black);
        
        // パーセンテージを表示させる
        // $perOfComplete = '50';

        ob_start();
        imagepng($image);
        $content = ob_get_clean();

        return response($content)->header('Content-Type', 'image/png');
    }

    private function createParts($requestStr, $partLength) : array
    {
        $parts = [];
        $length = mb_strlen($requestStr);
        $parts[] = mb_strimwidth($requestStr, 0, $partLength, '…', 'UTF-8');
        return $parts;
    }

    private function drawParts($image, $parts, $w, $h, $x, $y, $fontSize, $font, $color, $offset = 0)
    {
        foreach ($parts as $i => $part) {
            $box = \imagettfbbox($fontSize, 0, $font, $part);
            $boxWidth = $box[4] - $box[6];
            $boxHeight = $box[1] - $box[7];

            \imagettftext($image, $fontSize, 0, $x + $offset, $y + $offset, $color, $font, $part);
        }
    }
}
