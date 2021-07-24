@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <p>ここが本文のコンテンツ</p>
    @auth
        Login中
    @endauth
    @guest
        <a href="{{ route('login') }}">TwitterでLogin</a>
    @endguest
@endsection
