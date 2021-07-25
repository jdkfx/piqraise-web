<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoCreateRequest;
use Carbon\Carbon;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class OgpController extends Controller
{
    // OGP画像を作成する
    public function createOgpImg()
    {
        $w = 640;
        $h = 360;

        $font = storage_path('./font/NotoSansJP-Regular.otf');

        $image = \imagecreatetruecolor($w, $h);
        $bg = \imagecreatefromjpeg(storage_path('./img/bg.jpg'));
        $sx = imagesx($bg);
        $sy = imagesy($bg);

        imagecopyresampled($image, $bg, 0, 0, 0, 0, $w, $h, 640, 360);

        $black = imagecolorallocate($image, 0, 0, 0);

        // $todos = Todo::where('user_id', Auth::id())->whereDate('target_date', Carbon::today())->get();
        $todos = Todo::where('user_id', 1)->whereDate('target_date', Carbon::today())->get();

        $date = Carbon::today()->format('Y/m/d') . 'のタスク';
        $parts = $this->createParts($date , 18);
        $this->drawParts($image, $parts, $w, $h, 30, 50, 18, $font, $black);

        $i = 0;
        $stry = 100;
        $imgy = 70;
        
        $doneIcon = imagecreatefrompng(storage_path('./img/done.png'));
        $doingIcon = imagecreatefrompng(storage_path('./img/doing.png'));

        $doneix = imagesx($doneIcon);
        $doneiy = imagesy($doneIcon);
        $doneratio = $sy * 0.1 / $doneiy;
        $donenewwidth = ceil($doneix * $doneratio);
        $donenewheight = ceil($doneiy * $doneratio);

        $doingix = imagesx($doneIcon);
        $doingiy = imagesy($doneIcon);
        $doingratio = $sy * 0.1 / $doingiy;
        $doingnewwidth = ceil($doingix * $doingratio);
        $doingnewheight = ceil($doingiy * $doingratio);
        
        imagesavealpha($doneIcon, true);
        imagesavealpha($doingIcon, true);

        foreach ($todos as $todo) {
            if ($i > 3) {
                $otherTodosCount = $todos->count() - 4;
                $otherTodo = '他' . $otherTodosCount . '件のタスクを見る…';
                $parts = $this->createParts($otherTodo, 20);
                $this->drawParts($image, $parts, $w, $h, 300, 290, 20, $font, $black);
                break;
            }

            if ($todo->done_flag == true) {
                imagecopyresampled($image, $doneIcon, 60, $imgy, 0, 0, $donenewwidth, $donenewheight, $doneix, $doneiy);

                $doneTaskStr = $todo->content;
                $parts = $this->createParts($doneTaskStr, 20);
                $this->drawParts($image, $parts, $w, $h, 100, $stry, 25, $font, $black);

                $stry += 50;
                $imgy += 50;
            } else {
                imagecopyresampled($image, $doingIcon, 60, $imgy, 0, 0, $doingnewwidth, $doingnewheight, $doingix, $doingiy);

                $doingTaskStr = $todo->content;
                $parts = $this->createParts($doingTaskStr, 20);
                $this->drawParts($image, $parts, $w, $h, 100, $stry, 25, $font, $black);

                $stry += 50;
                $imgy += 50;
            }

            $i++;
        }

        // Twitterアイコンを取り出す
        // $parts = $this->createParts($userImg, 255);
        // $this->drawParts($image, $parts, $w, $h, 50, 330, 18, $font, $black);

        // $userName = Auth::user()->name;
        // $parts = $this->createParts($userName, 255);
        // $this->drawParts($image, $parts, $w, $h, 80, 330, 15, $font, $black);

        // パーセンテージを表示させる
        // $perOfComplete = '50';

        ob_start();
        imagepng($image);
        imagedestroy($doingIcon);
        imagedestroy($doneIcon);
        imagedestroy($image);

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
