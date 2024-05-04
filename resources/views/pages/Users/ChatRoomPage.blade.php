@extends('layouts.Root')
@section('content')
<?php
// temporary data chats
$chats = [
    [
        'id' => '888E7CBDE6EF0E045790AAC59C364F1C',
        'sender' => 'Driver y',
        'receiver' => 'Pengguna',
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
        'receiver' => 'Pengguna',
        'messages' => [
            [
                'msgid' => '988E7CBDE6EF0E045790AAC59C164F1C',
                'from' => 'sender',
                'message' => 'Halo, apa sudah sesuai?',
                'timestamp' => '2023-02-01 12:00:00',
            ],
            [
                'msgid' => '988E7CBDE6EF0E045790AAC59C363F1C',
                'from' => 'receiver',
                'message' => 'Sudah sesuai',
                'timestamp' => '2023-02-01 12:01:50',
            ],
            [
                'msgid' => '988E7CBDE6EF0E045790AAC59C364F1C',
                'from' => 'sender',
                'message' => 'Saya menuju ke lokasi',
                'timestamp' => '2023-02-01 12:22:00',
            ],
            [
                'msgid' => '988E7CBDE6EF0E045790AAC59C364F1C',
                'from' => 'sender',
                'message' => 'Sudah sampai, saya ada di depan',
                'timestamp' => '2023-02-01 12:32:00',
            ]
        ]
    ],
    [
        'id' => '888E7CBDC6EF0E045790AAC59C364F1C',
        'sender' => 'Admin z',
        'messages' => [
            [
                'msgid' => '988E7CBDE6EF0E045790AAC59C364F1C',
                'from' => 'sender',
                'message' => 'Halo, apa ada keluhan?',
                'timestamp' => '2023-02-01 12:00:00',
            ],
            [
                'msgid' => '988E7CBDE6EF0E045790AAC59C364F1C',
                'from' => 'receiver',
                'message' => 'Tidak ada keluhan',
                'timestamp' => '2023-02-01 12:02:00',
            ]
        ]
    ]
];
?>
<header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-8 mb-5">
    <a href="{{ url()->previous() }}" class="absolute top-5 left-5 flex items-center gap-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z" />
        </svg>
        @auth
        <div class="flex flex-row gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm0 1a7 7 0 1 1 0 14A7 7 0 0 1 8 1z" />
                <path d="M8 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                <path d="M8 10a5 5 0 0 0-4 2l1.5.5a4 4 0 0 1 6 0l1.5-.5a5 5 0 0 0-4-2z" />
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
            <h1 class="font-bold text-black text-l">{{ $sender }}</h1>
        </div>
        @endauth
    </a>
</header>
<main>
    @php
    $previousDate = null;
    @endphp
    @auth
    @foreach($chats as $chat)
    @if($chat['id'] === request()->route('id'))
    @foreach($chat['messages'] as $message)
    @php
    $currentDate = date('Y-m-d', strtotime($message['timestamp']));
    @endphp
    @if($previousDate !== $currentDate)
    <div class="text-center my-2">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">{{ date('l, d M Y', strtotime($currentDate)) }}</span>
    </div>
    @endif
    <div class="flex flex-col {{ $message['from'] === 'receiver' ? 'items-end' : 'items-start' }} mb-3 m-4">
        <div class="rounded-lg {{ $message['from'] === 'receiver' ? 'bg-[#F8832B]' : 'bg-[#FFE6D4]' }} p-3">
            <p>{{ $message['message'] }}</p>
        </div>
        <p class="text-xs text-gray-500">{{ date('h:i A', strtotime($message['timestamp'])) }}</p>
    </div>
    @php
    $previousDate = $currentDate;
    @endphp
    @endforeach
    @endif
    @endforeach
    @endauth
</main>
<footer class="fixed bottom-0 left-0 w-full bg-white z-10 shadow-md py-2 px-4">
    <form action="#" method="POST">
        @csrf
        <div class="flex items-center mb-2">
            <input type="text" name="message" placeholder="Type a message" class="flex-grow border rounded-lg p-3 mr-2">
            <button type="submit" class="bg-[#F9832A] rounded-lg p-2">
                <img src="{{ asset('/send.svg') }}" width="24" height="24" class="bi bi-box-arrow-in-right">
            </button>
        </div>
    </form>
</footer>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Initialize Firebase
    var firebaseConfig = {
        apiKey: "AIzaSyBJK-ziJOe-oMgSkjI5MJK16OO0LjQDMQQ",
        authDomain: "tester-6b415.firebaseapp.com",
        databaseURL: "https://tester-6b415-default-rtdb.asia-southeast1.firebasedatabase.app",
        projectId: "tester-6b415",
        storageBucket: "tester-6b415.appspot.com",
        messagingSenderId: "829911681243",
        appId: "1:829911681243:web:f6e4657da628304752e4fe",
        measurementId: "G-7PCGVXL2MX"
    };
    firebase.initializeApp(firebaseConfig);

    // Get a reference to the Firebase database
    var database = firebase.database();

    // Function to send a message
    function sendMessage(message) {
        var timestamp = new Date().toISOString(); // Get current UTC timestamp
        database.ref('chat').push().set({
            sender: 'user',
            message: message,
            timestamp: timestamp
        });
    }

    // Function to display messages
    function displayMessage(sender, message, timestamp) {
        // Create a container div for the message and sender information
        var containerDiv = $('<div>');

        // Create a paragraph or div for the sender
        var senderDiv = $('<p>').text(sender).addClass('mb-0');

        var date = new Date(timestamp);
        var hours = date.getHours().toString().padStart(2, '0');
        var minutes = date.getMinutes().toString().padStart(2, '0');
        // Create a paragraph or div for the message and timestamp
        var messageDiv = $('<p>').text(message + ' (' + hours + ':' + minutes + ')');

        // Append the sender and message to the container div
        containerDiv.append(senderDiv, messageDiv);

        // If the sender is the driver, align the container div to the right
        if (sender === 'driver') {
            containerDiv.addClass('text-end');
        }

        // Append the container div to the chat messages
        $('#chat-messages').append(containerDiv);
    }

    // Listen for new messages
    database.ref('messages').on('child_added', function(snapshot) {
        var messageData = snapshot.val();
        var sender = messageData.sender;
        var message = messageData.message;
        var timestamp = messageData.timestamp;
        displayMessage(sender, message, timestamp);
    });

    // Send message when Send button is clicked
    $('#send-btn').click(function() {
        var message = $('#message-input').val().trim();
        if (message !== '') {
            sendMessage(message);
            $('#message-input').val('');
        }
    });
</script>
@endsection