@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
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
                        <p>{{ Form::label('public_flag', '公開する場合はチェック') }}</p>
                        <p>{{ Form::checkbox('public_flag', old('public_flag'), false, ['class' => 'form-control input_border']) }}</p>
                        <p>{{ Form::label('content', '内容') }}</p>
                        <p>{{ Form::textarea('content', old('content'), ['class' => 'form-control input_border', 'rows' => '8', 'cols' => '40']) }}</p>
                        <p>{{ Form::label('target_date', '実行日') }}</p>
                        <p>{{ Form::date('date', old('date'), ['class' => 'form-control input_border']) }}</p>

                        {{ Form::submit('作成する', ['class' => 'back']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
