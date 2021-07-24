@extends('layouts.app')
@section('title', 'タスクの新規作成')

@section('content')
    <div class="max-w-lg mx-auto px-2 sm:px-4">
        <div class="my-12">
            <div class="">
                <h1>ToDo作成</h1>

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul class="text-danger alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li style="list-style: none;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {!! Form::open(['route' => 'todo.create']) !!}
                    {{ Form::token() }}
                    <p>{{ Form::label('content', '内容') }}</p>
                    <p>{{ Form::textarea('content', old('content')) }}</p>
                    <p>{{ Form::label('target_date', '実行日') }}</p>
                    <p>{{ Form::date('date', old('date'), ['class' => 'form-control input_border']) }}</p>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" name="public_flag" id="toggle" class="toggle-checkbox absolute block w-6 rounded-full bg-white border-white border-4 appearance-none cursor-pointer">
                        <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                    </div>

                    {{ Form::submit('作成する', ['class' => 'back']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
