<?php
namespace App\Repository;


use App\Models\Todo;
use Illuminate\Http\Request;

interface TodoRepository
{
    public function list(int $id);
    public function put(Todo $todo);
}
