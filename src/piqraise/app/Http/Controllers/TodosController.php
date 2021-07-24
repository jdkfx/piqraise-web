<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodosController extends Controller
{
    // 未認証のユーザーをログインページに移動させる
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create() {
        return view('pages.todo.create');
    }

    public function store(TodoCreateRequest $request)
    {
        $todo = Todo::create([
            'user_id' => Auth::id(),
            'done_flag' => false,
            'public_flag' => $request->public_flag,
            'content' => $request->content,
            'target_date' => $request->date,
        ]);
        return redirect(route('index'))->with('success', __('created'));
    }

    public function today(): \Illuminate\Http\JsonResponse
    {
        $todos = Todo::where('user_id', Auth::id())->whereDate('target_date', Carbon::today())->get();
        return response()->json($todos);
    }

    // TODO: perry 後でserviceらへんでまとめる
    public function get($date): \Illuminate\Http\JsonResponse
    {
        $todos = Todo::where('user_id', Auth::id())->whereDate('target_date', $date)->get();
        return response()->json($todos);
    }

    public function getPublic($userId, $date): \Illuminate\Http\JsonResponse
    {
        $todos = Todo::where('user_id', $userId)->whereDate('target_date', $date)->where('public_flag', true)->get();
        return response()->json($todos);
    }

    // OGP画像を作成する
    public function createOgpImg()
    {
        $date = '2021/07/24のタスク';
        $doneTask1 = '✅タスク1';
        $doneTask2 = '✅タスク2';
        $doneTask3 = '✅タスク3';
        $task = '　タスク4たたたたたたたたたたたた';
        $otherTaskCount = '他4件のタスクを見る…';
        // $userImg = storage_path('./img/icon.jpg');
        $userImg = '〇';
        $userName = 'jdkfx';
        $appName = 'PiQraise';
        $perOfComplete = '50';

        $w = 640;
        $h = 360;

        $font = storage_path('./font/NotoSansJP-Regular.otf');

        $image = \imagecreatetruecolor($w, $h);
        $bg = \imagecreatefromjpeg(storage_path('./img/bg.jpg'));

        imagecopyresampled($image, $bg, 0, 0, 0, 0, $w, $h, 640, 360);

        $black = imagecolorallocate($image, 0, 0, 0);

        $parts = $this->createParts($date , 255);
        $this->drawParts($image, $parts, $w, $h, 30, 50, 18, $font, $black);

        $parts = $this->createParts($doneTask1, 255);
        $this->drawParts($image, $parts, $w, $h, 80, 100, 25, $font, $black);

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

        $parts = $this->createParts($userName, 255);
        $this->drawParts($image, $parts, $w, $h, 80, 330, 15, $font, $black);

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
