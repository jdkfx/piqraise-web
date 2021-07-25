@extends('layouts.app')

@section('title', '公開中のタスク')

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
                            DONEフラグ
                            <br>
                            {{ $todo->done_flag }}
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
