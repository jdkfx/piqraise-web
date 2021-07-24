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

    public function today()
    {
        $todos = Todo::where('user_id', Auth::id())->whereDate('target_date', Carbon::today())->get();
        return response()->json($todos);
    }

    // OGP画像を作成する
    public function createOgpImg()
    {
        $testStr = '私の名前はjdkfx17です．';

        $w = 640;
        $h = 360;
        $partLength = 10;

        $fontSize = 30;
        $font = storage_path('./font/NotoSansJP-Regular.otf');

        $image = \imagecreatetruecolor($w, $h);
        $bg = \imagecreatefromjpeg(storage_path('./img/bg.jpg'));

        imagecopyresampled($image, $bg, 0, 0, 0, 0, $w, $h, 640, 360);

        $black = imagecolorallocate($image, 0, 0, 0);

        $parts = [];
        $length = mb_strlen($testStr);
        for ($start = 0; $start < $length; $start += $partLength) {
            $parts[] = mb_substr($testStr, $start, $partLength);
        }

        $this->drawParts($image, $parts, $w, $h, $fontSize, $font, $black);

        ob_start();
        imagepng($image);
        $content = ob_get_clean();

        return response($content)->header('Content-Type', 'image/png');
    }

    private function drawParts($image, $parts, $w, $h, $fontSize, $font, $color, $offset = 0)
    {
        foreach ($parts as $i => $part) {
            $box = \imagettfbbox($fontSize, 0, $font, $part);
            $boxWidth = $box[4] - $box[6];
            $boxHeight = $box[1] - $box[7];

            $x = ($w - $boxWidth) / 2;
            $y = $h / 2 + $boxHeight / 2 - $boxHeight * count($parts) * 0.5 + $boxHeight * $i;
            \imagettftext($image, $fontSize, 0, $x + $offset, $y + $offset, $color, $font, $part);
        }
    }
}
