<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>
    {{--Temporary data chat--}}
    @php
        $chat = [
            [
                'chatid' => '1',
                'sender' => 'John Doe',
                'receiver' => 'Admin',
                'msg' => [
                    [
                        'sender' => 'John Doe',
                        'receiver' => 'Admin',
                        'msg' => 'Hello, how are you?'
                    ],
                    [
                        'sender' => 'Admin',
                        'receiver' => 'John Doe',
                        'msg' => 'I\'m good, thanks for asking'
                    ]
                ],
            ],
            [
                'chatid' => '2',
                'sender' => 'Jane Doe',
                'receiver' => 'Admin',
                'msg' => [
                    [
                        'sender' => 'Jane Doe',
                        'receiver' => 'Admin',
                        'msg' => 'Hi, I\'m good, how about you?'
                    ],
                    [
                        'sender' => 'Admin',
                        'receiver' => 'Jane Doe',
                        'msg' => 'I\'m good too, thanks for asking'
                    ]
                ],
            ],
            [
                'chatid' => '3',
                'sender' => 'John Doe',
                'receiver' => 'Admin',
                'msg' => [
                    [
                        'sender' => 'John Doe',
                        'receiver' => 'Admin',
                        'msg' => 'Hello, how are you?'
                    ],
                    [
                        'sender' => 'Admin',
                        'receiver' => 'John Doe',
                        'msg' => 'I\'m good, thanks for asking'
                    ]
                ],
            ],
            [
                'chatid' => '4',
                'sender' => 'Kaito Kid',
                'receiver' => 'Admin',
                'msg' => [
                    [
                        'sender' => 'Kaito Kid',
                        'receiver' => 'Admin',
                        'msg' => 'Hello, how are you?'
                    ],
                    [
                        'sender' => 'Admin',
                        'receiver' => 'Kaito Kid',
                        'msg' => 'I\'m good, thanks for asking'
                    ]
                ],
            ],
            [
                'chatid' => '5',
                'sender' => 'John Doe',
                'receiver' => 'Admin',
                'msg' => [
                    [
                        'sender' => 'John Doe',
                        'receiver' => 'Admin',
                        'msg' => 'Hello, how are you?'
                    ],
                    [
                        'sender' => 'Admin',
                        'receiver' => 'John Doe',
                        'msg' => 'I\'m good, thanks for asking'
                    ]
                ],
            ],
            [
                'chatid' => '6',
                'sender' => 'Jane Doe',
                'receiver' => 'Admin',
                'msg' => [
                    [
                        'sender' => 'Jane Doe',
                        'receiver' => 'Admin',
                        'msg' => 'Hi, I\'m good, how about you?'
                    ],
                    [
                        'sender' => 'Admin',
                        'receiver' => 'Jane Doe',
                        'msg' => 'I\'m good too, thanks for asking'
                    ]
                ],
            ],
            [
                'chatid' => '7',
                'sender' => 'John Doe',
                'receiver' => 'Admin',
                'msg' => [
                    [
                        'sender' => 'John Doe',
                        'receiver' => 'Admin',
                        'msg' => 'Hello, how are you?'
                    ],
                    [
                        'sender' => 'Admin',
                        'receiver' => 'John Doe',
                        'msg' => 'I\'m good, thanks for asking'
                    ]
                ],
            ],
            [
                'chatid' => '8',
                'sender' => 'Kaito Kid',
                'receiver' => 'Admin',
                'msg' => [
                    [
                        'sender' => 'Kaito Kid',
                        'receiver' => 'Admin',
                        'msg' => 'Hello, how are you?'
                    ],
                    [
                        'sender' => 'Admin',
                        'receiver' => 'Kaito Kid',
                        'msg' => 'I\'m good, thanks for asking'
                    ]
                ],
            ],
            [
                'chatid' => '9',
                'sender' => 'John Doe',
                'receiver' => 'Admin',
                'msg' => [
                    [
                        'sender' => 'John Doe',
                        'receiver' => 'Admin',
                        'msg' => 'Hello, how are you?'
                    ],
                    [
                        'sender' => 'Admin',
                        'receiver' => 'John Doe',
                        'msg' => 'I\'m good, thanks for asking'
                    ]
                ],
            ],
        ];
    @endphp
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="flex flex-row">
                {{-- Chat list --}}
                <div class="w-1/4">
                    <div class="bg-white dark:bg-gray-800 overflow-y-auto">
                        <div class="flex flex-row items-center justify-between p-4 border-b dark:border-gray-600">
                            <p class="font-semibold text-gray-800 dark:text-gray-200">Chats</p>
                            <button class="text-gray-500 dark:text-gray-400 focus:outline-none">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            @foreach($chat as $chatItem)
                                <a href="{{ route('chatroom.admin', $chatItem['chatid']) }}" class="flex flex-row items-center space-x-4 p-2">
                                    <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/port" alt="avatar">
                                    <div class="flex flex-col">
                                        <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $chatItem['sender'] }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ end($chatItem['msg'])['msg'] }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- Chatroom --}}
                <div class="w-3/4 mx-5">
                    <div class="bg-white dark:bg-gray-800 h-96">
                        <div class="p-4">
                            @foreach($chat as $chatItem)
                                @if($chatItem['chatid'] == 1)
                                    @foreach($chatItem['msg'] as $msg)
                                        @if($msg['sender'] == 'Admin')
                                            <div class="flex flex-row items-center space-x-4 justify-end">
                                                <div class="flex flex-col my-2">
                                                    <div class="bg-blue-500 text-white p-2 rounded-lg">
                                                        {{ $msg['msg'] }}
                                                    </div>
                                                </div>
                                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/port" alt="avatar">
                                            </div>
                                        @else
                                            <div class="flex items-center space-x-4">
                                                <img class="h-10 w-10 roxunded-full" src="https://randomuser.me/api/port" alt="avatar">
                                                <div class="flex flex-col my-2">
                                                    <div class="bg-gray-200 p-2 rounded-lg">
                                                        {{ $msg['msg'] }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="p-4 bg-white dark:bg-gray-800">
                        <div class="flex flex-row items-center space-x-4">
                            <input type="text" class="w-full p-2 border border-gray-200 dark:border-gray-600 rounded-lg focus:outline-none" placeholder="Type a message...">
                            <button class="bg-blue-500 text-white p-2 rounded-lg focus:outline-none">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
