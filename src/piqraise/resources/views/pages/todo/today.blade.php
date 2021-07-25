@extends('layouts.app')
@section('title', 'YYYYMMDDのタスク')

@section('content')
    <div class="max-w-2xl mx-auto px-2 sm:px-4">
        <div class="my-12">
            <div class="my-4">
                <h1 class="text-xl">今日のタスク</h1>
            </div>

            <div class="p-4">
                <table class="table-fixed w-full">
                    <thead>
                        <tr>
                            <th class="w-1/6"></th>
                            <th class="w-4/6"></th>
                            <th class="w-1/6 text-right">公開状態</th>
                            <th class=""></th>
                            <th class=""></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todos as $todo)
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
                            <td>
                                <a href="{{ route('todo.edit', $todo->id) }}"><input type="submit" value="削除"></a>
                            </td>
                            <td>
                                {!! Form::open(['route' => ['todo.delete', $todo->id]]) !!}
                                <input type="submit" value="削除">
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
