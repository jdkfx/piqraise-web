@extends('layouts.app')
@section('title', 'タスクの編集')

@section('content')
    <div class="max-w-lg mx-auto px-2 sm:px-4">
        <div class="my-12">
            <div class="my-4">
                <h1 class="text-xl">タスク編集</h1>
            </div>
            <div class="p-4 rounded">

                @if (count($errors) > 0)
                    <div class="mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-400 text-xs mb-1 italic">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {!! Form::open(['route' => ['todo.edit', $todo->id]]) !!}
                {{ Form::token() }}
                <div class="mb-5">
                    <label for="content" class="block text-gray-700 text-sm font-bold mb-2">タスクの内容</label>
                    <textarea name="content" id="content" cols="50" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow">{{ $todo->content }}</textarea>
                </div>
                <div class="mb-8 flex items-center justify-between">
                    <label for="date" class="text-gray-700 text-sm font-bold">実施日</label>
                    <input type="date" name="date" id="date" value="{{ $todo->target_date }}">
                </div>
                <button type="submit" class="block mx-auto px-4 h-11 bg-piq-green-dark text-sm text-white">編集する</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
