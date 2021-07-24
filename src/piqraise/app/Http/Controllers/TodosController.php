<?php

namespace App\Http\Controllers;

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

    // 指定した日付のTodo一覧をjsonで返す
    public function index($userId, $date)
    {
        $user = User::where('name', $userId)->first();
        $todos = Todo::where('user_id', $user->id)->whereDate('created_at', '=', $date)->get();
        return response()->json($todos);
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

    // OGP画像を作成する
    public function createOgpImg(Todo $todo)
    {
        $w = 600;
        $h = 315;
        $partLength = 10;

        $fontSize = 30;
        // $fontPath = resource_path('font/mushin.otf');

        $image = \imagecreatetruecolor($w, $h);
        $bg = \imagecreatefromjpeg(resource_path('image/HIRO95_yuubaenokage_TP_V4.jpg'));
        imagecopyresampled($image, $bg, 0, 0, 0, 0, $w, $h, 800, 533);

        $white = imagecolorallocate($image, 255, 255, 255);
        $grey = imagecolorallocate($image, 128, 128, 128);

        $parts = [];
        $length = mb_strlen($post->title);
        for ($start = 0; $start < $length; $start += $partLength) {
            $parts[] = mb_substr($post->title, $start, $partLength);
        }

        $this->drawParts($image, $parts, $w, $h, $fontSize, $fontPath, $grey, 3);
        $this->drawParts($image, $parts, $w, $h, $fontSize, $fontPath, $white);

        ob_start();
        imagepng($image);
        $content = ob_get_clean();

        return response($content)->header('Content-Type', 'image/png');
    }

    private function drawParts($image, $parts, $w, $h, $fontSize, $fontPath, $color, $offset = 0)
    {
        foreach ($parts as $i => $part) {
            $box = \imagettfbbox($fontSize, 0, $fontPath, $part);
            $boxWidth = $box[4] - $box[6];
            $boxHeight = $box[1] - $box[7];

            $x = ($w - $boxWidth) / 2;
            $y = $h / 2 + $boxHeight / 2 - $boxHeight * count($parts) * 0.5 + $boxHeight * $i;
            \imagettftext($image, $fontSize, 0, $x + $offset, $y + $offset, $color, $fontPath, $part);
        }
    }
}
