@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>{{ $year }}年{{ $month }}月{{ $day }}日のTODO</h1>
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
                            {{ $todo->done_flag }}
                            <!-- on / off の切り替えボタンでvueで切り替えたい(さすがにここで画面遷移するのだるい) -->
                            @if ($todo->done_flag)
                                {!! Form::open(['route' => ['todo.updateDoneFlagFalse', $todo->id]]) !!}
                                {{ Form::submit('実行中にする', ['class' => 'back']) }}
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => ['todo.updateDoneFlagTrue', $todo->id]]) !!}
                                {{ Form::submit('完了済みにする', ['class' => 'back']) }}
                                {!! Form::close() !!}
                            @endif
                            <br>
                            <a href="{{ route('todo.edit', $todo->id) }}"><input type="submit" value="削除"></a>
                            {!! Form::open(['route' => ['todo.delete', $todo->id]]) !!}
                            <input type="submit" value="削除">
                            {!! Form::close() !!}
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
