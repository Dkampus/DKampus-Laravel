@extends('layouts.Root')
@section('content')
    <?php
        // temporary data chats
    $chats = [
        [
            'id' => '888E7CBDE6EF0E045790AAC59C364F1C',
            'sender' => 'Driver y',
            'message' => 'Halo, apa sudah sesuai?',
            'time' => '12:00'
        ],
        [
            'id' => '88827CBDE6EF0E045790AAC59C364F1C',
            'sender' => 'Driver x',
            'message' => 'Halo, saya sudah di depan',
            'time' => '12:00'
        ],
        [
            'id' => '888E7CBDC6EF0E045790AAC59C364F1C',
            'sender' => 'Admin z',
            'message' => 'Halo, apa ada keluhan ?',
            'time' => '01:00'
        ]
    ];
    ?>
    <header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-8">
        <a href="{{'/'}}" class="absolute top-5 left-5 flex items-center gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z"/>
            </svg>
            <h1 class="font-bold text-black text-xl mb-1">Chat</h1>
        </a>
    </header>
    <main class="flex flex-col gap-5 px-5 mt-3">
        <div class="flex flex-col gap-5">
            {{--fetch data chat from database chat ?--}}
            @foreach($chats as $chat)
                <a href="{{ '/chats/' . $chat['id'] }}">
                    <div class="flex justify-between items-center gap-3">
                        <div class="flex flex-row gap-3">
                            <img src="{{ asset('images/ProfilePicture.png') }}" alt="" class="w-14 h-14 rounded-ful object-cover">
                            <div class="flex flex-col gap-1">
                                <h1 class="font-bold text-black">{{ $chat['sender'] }}</h1>
                                <p class="text-gray-400">{{ $chat['message'] }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-end gap-1">
                            <p class="text-gray-400">{{ $chat['time'] }}</p>
                            <div class="w-5 h-5 rounded-full bg-orange-500 flex items-center justify-center">
                                <a class="text-white text-xs font-bold">1</a>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </main>
@endsection
