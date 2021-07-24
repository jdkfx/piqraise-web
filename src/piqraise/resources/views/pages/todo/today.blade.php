@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>今日のTODO</h1>
                        @foreach ($todos as $todo)
                            内容
                            <br>
                            {{ $todo->content }}
                            <br>
                            publicflagは1なら表示
                            <br>
                            {{ $todo->public_flag }}
                            <!-- on / off の切り替えボタンでvueで切り替えたい(さすがにここで画面遷移するのだるい) -->
                            @if ($todo->public_flag)
                                {!! Form::open(['route' => ['todo.updatePublicFlagFalse', $todo->id]]) !!}
                                {{ Form::submit('非公開にする', ['class' => 'back']) }}
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => ['todo.updatePublicFlagTrue', $todo->id]]) !!}
                                {{ Form::submit('公開する', ['class' => 'back']) }}
                                {!! Form::close() !!}
                            @endif
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
