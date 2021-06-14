<?php

namespace App\Http\Controllers;

use App\Http\Requests\PutTodoRequest;
use App\Usecase\TodoUsecase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * @var TodoUsecase
     */
    private $todoUsecase;

    public function __construct(
        TodoUsecase $todoUsecase
    ) {
        $this->todoUsecase = $todoUsecase;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $status = config('http.StatusOK');
        $todos = $this->todoUsecase->list();
        if (!$todos) {
            $status = config('http.StatusBadRequest');
        }
        return response()->json([
            'user_id' => 1,
            'todos' => $todos,
        ], $status, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(PutTodoRequest $request): JsonResponse
    {
        $status = config('http.StatusCreated');
        if (!$this->todoUsecase->put($request)) {
            $status = config('http.StatusInternalServerError');
        }
        return response()->json([], $status, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return response()->json([], config('http.StatusOK'), [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return string
     */
    public function update(Request $request, $id)
    {
        return "a";
        // return response()->json([], config('http.StatusOK'), [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return response()->json([], config('http.StatusAccepted'), [], JSON_UNESCAPED_UNICODE);
    }
}
