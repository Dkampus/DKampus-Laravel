@extends('layouts.Root')
@section('content')
<header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-8 mb-5">
    <a href="{{ url('/chats') }}" class="absolute top-5 left-5 flex items-center gap-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z" />
        </svg>
        <div class="flex flex-row gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm0 1a7 7 0 1 1 0 14A7 7 0 0 1 8 1z" />
                <path d="M8 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                <path d="M8 10a5 5 0 0 0-4 2l1.5.5a4 4 0 0 1 6 0l1.5-.5a5 5 0 0 0-4-2z" />
            </svg>
            <h1 class="font-bold text-black text-l">{{ $cour_name }}</h1>
        </div>
    </a>
</header>
<main>
    <div class="text-center my-2">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">{{ date('l, d F Y', strtotime($date)) }}</span>
    </div>
    <div id="chat-messages" class="flex flex-col gap-3 m-4 overflow-y-auto pb-16">
        {{-- Chat messages will be displayed here --}}
    </div>
</main>
<footer class="fixed bottom-0 left-0 w-full bg-white z-10 shadow-md py-2 px-4">
    <form id="message-form" action="#" method="POST">
        @csrf
        <div class="flex items-center mb-2">
            <input id="message-input" type="text" name="message" placeholder="Type a message" class="flex-grow border rounded-lg p-3 mr-2">
            <button type="submit" id="send-btn" class="bg-[#F9832A] rounded-lg p-2">
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
        apiKey: "{{ env('FIREBASE_API_KEY') }}",
        authDomain: "{{ env('FIREBASE_AUTH_DOMAIN') }}",
        databaseURL: "{{ env('FIREBASE_DATABASE_URL') }}",
        projectId: "{{ env('FIREBASE_PROJECT_ID') }}",
        storageBucket: "{{ env('FIREBASE_STORAGE_BUCKET') }}",
        messagingSenderId: "{{ env('FIREBASE_MESSAGING_SENDER_ID') }}",
        appId: "{{ env('FIREBASE_APP_ID') }}",
        measurementId: "{{ env('FIREBASE_MEASUREMENT_ID') }}"
    };
    firebase.initializeApp(firebaseConfig);

    // Get a reference to the Firebase database
    var database = firebase.database();

    var custId = "{{ $custId }}";
    var courId = "{{ $courId }}";

    // Function to send a message for chatbot
    function sendChatbotMessage(message) {
        var date = new Date();
        var year = date.getFullYear();
        var month = (date.getMonth() + 1).toString().padStart(2, '0');
        var day = date.getDate().toString().padStart(2, '0');
        var hours = date.getHours().toString().padStart(2, '0');
        var minutes = date.getMinutes().toString().padStart(2, '0');
        var seconds = date.getSeconds().toString().padStart(2, '0');

        var formattedTimestamp = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

        // Send the message
        try {
            $.ajax({
                url: "{{ env('CHATBOT_ENDPOINT') }}",
                type: 'POST',
                data: JSON.stringify({
                    uid: custId,
                    message: message
                }),
                contentType: 'application/json',
                dataType: 'json',
                success: function(response) {
                    var chatbotMessage = response.message;
                    if (chatbotMessage != null) {
                        database.ref('chats/' + custId + '-' + courId).push().set({
                            msgs: {
                                role: 'courier',
                                msg: chatbotMessage,
                                timestamp: formattedTimestamp
                            }
                        });
                        var chatRef = database.ref('chats/' + custId + '-' + courId + '/courNewMssg');
                        chatRef.transaction(function(currentValue) {
                            return (currentValue || 0) + 1;
                        });
                    }
                }
            });
        } catch (error) {
            console.error(error);
        }
    }

    // Function to send a message
    function sendMessage(message) {
        var date = new Date();
        var year = date.getFullYear();
        var month = (date.getMonth() + 1).toString().padStart(2, '0');
        var day = date.getDate().toString().padStart(2, '0');
        var hours = date.getHours().toString().padStart(2, '0');
        var minutes = date.getMinutes().toString().padStart(2, '0');
        var seconds = date.getSeconds().toString().padStart(2, '0');

        var formattedTimestamp = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        database.ref('chats/' + custId + '-' + courId).push().set({
            msgs: {
                role: 'customer',
                msg: message,
                timestamp: formattedTimestamp
            }
        });
        var chatRef = database.ref('chats/' + custId + '-' + courId + '/custNewMssg');
        chatRef.transaction(function(currentValue) {
            return (currentValue || 0) + 1;
        });
    }

    // Function to display messages
    function displayMessage(role, message, timestamp) {
        // Create message elements
        var messageDiv = $('<div>').addClass('flex flex-col mb-3 m-4')
        var containerDiv = $('<div>').addClass('rounded-lg p-3');
        var messageText = $('<p>').text(message);
        var timestampText = $('<p>').addClass('text-xs').text(timestamp);

        if (role === 'customer') {
            messageDiv.addClass('items-end');
            containerDiv.addClass('bg-[#F8832B]');

        } else {
            messageDiv.addClass('items-start');
            containerDiv.addClass('bg-[#FFE6D4]');
            timestampText.addClass('text-gray-500');
        }

        // Append elements to container
        containerDiv.append(messageText, timestampText);
        messageDiv.append(containerDiv);

        // Append container to chat messages
        $('#chat-messages').append(messageDiv);

        // Scroll to the bottom of the chat messages
        var chatMessages = document.getElementById('chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Listen for new messages
    database.ref('chats/' + custId + '-' + courId).on('child_added', function(snapshot) {
        var messageData = snapshot.val();

        if (messageData.msgs) {
            var role = messageData.msgs.role;
            var message = messageData.msgs.msg;
            var timestamp = messageData.msgs.timestamp;
            var date = new Date(timestamp);
            var hours = date.getHours().toString().padStart(2, '0');
            var minutes = date.getMinutes().toString().padStart(2, '0');
            var formattedTimestamp = hours + ':' + minutes;
            displayMessage(role, message, formattedTimestamp);
        }
    });

    // Send message when form is submitted
    $('#message-form').submit(function(event) {
        event.preventDefault(); // Prevent form submission

        var message = $('#message-input').val().trim();
        if (message !== '') {
            sendMessage(message);
            sendChatbotMessage(message);
            $('#message-input').val(''); // Clear input field after sending
        }
    });
</script>
@endsection
