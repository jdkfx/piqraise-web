@extends('layouts.app')
@section('title', '今日のタスク')

@section('content')
    <div class="max-w-2xl mx-auto px-2 sm:px-4">
        <div class="my-12">
            <div class="mb-2">
                <h1 class="text-xl">今日のタスク</h1>
            </div>

            <div class="px-4 mb-4">
                <table class="table-fixed w-full">
                    <thead>
                        <tr>
                            <th class="w-1/12"></th>
                            <th class="w-7/12"></th>
                            <th class="w-2/12 text-right">公開状態</th>
                            <th class="w-1/12"></th>
                            <th class="w-1/12"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todos as $todo)
                        @php
                            $day = \Carbon\Carbon::today()->format('Ymd');
                            $userId = $todo->user_id;
                        @endphp
                        <tr>
                            <td class="pb-4">
                                @if ($todo->done_flag)
                                    {!! Form::open(['route' => ['todo.updateDoneFlagFalse', $todo->id]]) !!}
                                        <button type="submit" class="flex-shrink-0 text-xl mr-5">☑</button>
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::open(['route' => ['todo.updateDoneFlagTrue', $todo->id]]) !!}
                                        <button type="submit" class="flex-shrink-0 text-xl mr-5">☐</button>
                                    {!! Form::close() !!}
                                @endif
                            </td>
                            <td class="pb-4">
                                @if ($todo->done_flag)
                                    <p class="line-through text-xl break-words">{{ $todo->content }}</p>
                                @else
                                    <p class="text-xl break-words">{{ $todo->content }}</p>
                                @endif
                            </td>
                            <td class="pb-4 flex justify justify-end">
                                @if ($todo->public_flag)
                                    {!! Form::open(['route' => ['todo.updatePublicFlagFalse', $todo->id]]) !!}
                                        <div class="flex-shrink-0 relative inline-block w-11 mr-2 align-middle select-none transition duration-200 ease-in">
                                            <input type="checkbox" name="public_flag" id="toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-2 appearance-none cursor-pointer">
                                            <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                        </div>
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::open(['route' => ['todo.updatePublicFlagTrue', $todo->id]]) !!}
                                        <div class="flex-shrink-0 relative inline-block w-11 mr-2 align-middle select-none transition duration-200 ease-in">
                                            <input type="checkbox" name="public_flag" id="toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-2 appearance-none cursor-pointer">
                                            <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                        </div>
                                    {!! Form::close() !!}
                                @endif
                            </td>
                            <td class="pb-4 text-center">
                                <form method="get" action="{{ route('todo.edit', $todo->id) }}">
                                    <button type="submit" class="p-1 bg-piq-green-dark text-white text-sm">編集</button>
                                </form>
                            </td>
                            <td class="pb-4 text-center">
                                {!! Form::open(['route' => ['todo.delete', $todo->id]]) !!}
                                    <button type="submit" class="p-1 bg-piq-green-dark text-white text-sm">削除</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center mb-2">
                <a href="#" class="flex items-center h-7 px-4">
                    <span class="text-sm">< 昨日のタスク</span>
                </a>
                <a href="#" class="flex items-center h-7 px-4">
                    <span class="text-sm">明日のタスク ></span>
                </a>
            </div>

            <div class="flex items-center justify-center">
                <a href="" class="text-sm py-3 px-6 text-white bg-piq-green-dark rounded-3xl">タスク作成</a>
            </div>

            <div>
                <button><a href="{{ route('shareImg', [$userId, $day]) }}">画像でシェアする</a></button>
            </div>

        </div>
    </div>
@endsection
