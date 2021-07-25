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
                            @php
                                $userId = $todo->user_id;
                                $day = $todo->target_date;
                            @endphp
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

@section('additionalMeta')
<meta property="og:image" content="{{ config('app.url') }}/todo/{{ $userId }}/{{ $day }}/share.png">
<meta name="twitter:card" content="summary">
<meta name="twitter:image" content="{{ config('app.url') }}/todo/{{ $userId }}/{{ $day }}/share.png">
@endsection