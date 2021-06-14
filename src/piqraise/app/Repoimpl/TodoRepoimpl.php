<?php
namespace App\Repoimpl;

use App\Models\Todo;
use App\Repository\TodoRepository;

class TodoRepoimpl implements TodoRepository
{
    /**
     * @var Todo
     */
    private $todo;

    public function __construct(
        Todo $todo
    ) {
        $this->todo = $todo;
    }
    public function list(int $id) {
        return $this->todo->where('user_id', $id)->get();
    }
    public function put(Todo $todo) {
        return $todo->save();
    }
}
