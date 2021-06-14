<?php
namespace App\Usecase;

use App\Http\Requests\PutTodoRequest;
use App\Models\Todo;
use App\Repository\TodoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoUsecase
{
    /**
     * @var TodoRepository
     */
    private $todoRepository;
    /**
     * @var Todo
     */
    private $todo;

    public function __construct(
        Todo $todo,
        TodoRepository $todoRepository
    ) {
        $this->todo = $todo;
        $this->todoRepository = $todoRepository;
    }
    public function list() {
        // TODO:
        // $this->todo->user_id = Auth::id();
        return $this->todoRepository->list(1);
    }
    public function put(PutTodoRequest $request) {
        // TODO:
        // $this->todo->user_id = Auth::id();
        $this->todo->content = $request->content;
        return $this->todoRepository->put($this->todo);
    }
}
