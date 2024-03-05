@extends('layouts.Root')
@section('content')
    <?php
    // temporary data chats
    $chats = [
        [
            'id' => '888E7CBDE6EF0E045790AAC59C364F1C',
            'sender' => 'Driver y',
            'receiver' => 'Driver x',
            'messages' => [
                [
                    'msgid' => '988E7CBDE6EF0E045790AAC59C364F1C',
                    'from' => 'sender',
                    'message' => 'Halo, apa sudah sesuai?',
                    'timestamp' => '2023-02-01 12:00:00',
                ],
                [
                    'msgid' => '988E7CBDE6EF0E045790AAC59C364F1C',
                    'from' => 'receiver',
                    'message' => 'Sudah sesuai',
                    'timestamp' => '2023-02-01 12:00:00',
                ]

            ]
        ],
        [
            'id' => '88827CBDE6EF0E045790AAC59C364F1C',
            'sender' => 'Driver x',
            'message' => 'Halo, saya ingin memesan makanan',
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
    <header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-8 mb-5">
        <a href="{{ url()->previous() }}" class="absolute top-5 left-5 flex items-center gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z"/>
            </svg>
            @auth
                <div class="flex flex-row gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm0 1a7 7 0 1 1 0 14A7 7 0 0 1 8 1z"/>
                        <path d="M8 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                        <path d="M8 10a5 5 0 0 0-4 2l1.5.5a4 4 0 0 1 6 0l1.5-.5a5 5 0 0 0-4-2z"/>
                    </svg>
                    @php
                        $chatid = request()->route('id');
                        $sender = 'test';
                        foreach ($chats as $chat) {
                            if ($chat['id'] === $chatid) {
                                $sender = $chat['sender'];
                                break;
                            }
                        }
                    @endphp
                    <h1 class="font-bold text-black text-xl">{{ $sender }}</h1>
                </div>
            @endauth
        </a>
    </header>
    <main>
        @auth
            @foreach($chats as $chat)
                @if($chat['id'] === request()->route('id'))
                    @foreach($chat['messages'] as $message)
                        <div class="flex flex-col {{ $message['from'] === 'receiver' ? 'items-end' : 'items-start' }} mb-3 m-4">
                            <div class="rounded-lg {{ $message['from'] === 'receiver' ? 'bg-[#F8832B]' : 'bg-[#FFE6D4]' }} p-3">
                                <p>{{ $message['message'] }}</p>
                            </div>
                            <p class="text-xs text-gray-500">{{ date('h:i A', strtotime($message['timestamp'])) }}</p>
                        </div>
                    @endforeach
                @endif
            @endforeach
        @endauth
    </main>
    <footer class="fixed bottom-0 left-0 w-full bg-white z-10 shadow-md py-2 px-4">
        <form action="{{}}" method="POST">
            @csrf
            <div class="flex items-center">
                <input type="text" name="message" placeholder="Type a message" class="flex-grow border rounded-lg p-2 mr-2">
                <button type="submit" class="bg-[#F9832A] text-white rounded-lg p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 .5.5H14a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-3a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5h8zm-1 2V4a1 1 0 0 0-1-1h-8a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1.5a.5.5 0 0 1 1 0v2a2 2 0 0 1-2 2h-8a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2a.5.5 0 0 1-1 0z"/>
                        <path fill-rule="evenodd" d="M13.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H1.5a.5.5 0 0 0 0 1h10.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                </button>
            </div>
        </form>
    </footer>
@endsection
