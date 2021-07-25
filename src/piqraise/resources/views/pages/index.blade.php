@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <div class="max-w-lg mx-auto px-2 sm:px-4">
        <div class="my-12">
            <div class="my-4 text-center">
                <p>日々のタスクをみんなに共有できるタスク管理ツール</p>
            </div>
            <div class="text-center">
                @auth
                    Login中
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="text-sm py-3 px-6 text-white bg-piq-green-dark">Twitterでログイン</a>
                @endguest
            </div>
        </div>
    </div>
@endsection
