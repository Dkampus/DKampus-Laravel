@extends('layouts.Root')
@section('content')
<header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-8">
    <a href="{{'/'}}" class="absolute top-5 left-5 flex items-center gap-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z" />
        </svg>
        <h1 class="font-bold text-black text-xl mb-1">Chat</h1>
    </a>
</header>
<main class="flex flex-col gap-5 px-5 mt-3">
    <form action="{{ route('room.chat') }}" method="POST">
        @csrf
        <div class="flex flex-col gap-5" id="chat-list">
            {{-- Chat list will be dynamically updated here --}}
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
        var custId = "{{ $custId }}";

        function handleSubmitButtonClick(courId) {
            $('input[name="courId"]').val(courId);

            $('form').submit();
        }

        function displayLatestMessage(sender, message, timestamp, courId) {

            var containerDiv = $('<div>').addClass('chat-item');

            var chatItemDiv = $('<div>').addClass('flex justify-between items-center gap-3');

            var senderInfoDiv = $('<div>').addClass('flex flex-col gap-1 items-start');
            var senderName = $('<h1>').addClass('font-bold text-black').text(sender);
            var messageText = $('<p>').addClass('text-gray-400').text(message);
            senderInfoDiv.append(senderName, messageText);

            var timestampDiv = $('<div>').addClass('flex flex-col items-end gap-1');
            var timestampText = $('<p>').addClass('text-gray-400').text(timestamp);
            var unreadCountDiv = $('<div>').addClass('w-5 h-5 rounded-full bg-orange-500 flex items-center justify-center');
            var unreadCount = $('<a>').addClass('text-white text-xs font-bold').text('!');
            unreadCountDiv.append(unreadCount);
            timestampDiv.append(timestampText, unreadCountDiv);

            chatItemDiv.append(senderInfoDiv, timestampDiv);

            var submitButton = $('<button>')
                .attr('type', 'submit')
                .addClass('w-full')
                .click(function() {
                    handleSubmitButtonClick(courId);
                });

            var hiddenInput = $('<input>').addClass('hidden').attr('type', 'hidden').attr('name', 'courId');

            containerDiv.append(chatItemDiv, hiddenInput);

            submitButton.append(containerDiv);

            $('#chat-list').append(submitButton);
        }


        // Listen for new messages for the specific custId
        var custIdRef = database.ref('chats').orderByKey().startAt(custId + '-').endAt(custId + '-\uf8ff');

        custIdRef.on('child_added', function(snapshot) {
            var lastMessageQuery = snapshot.ref.orderByChild('msgs/timestamp').limitToLast(1);

            lastMessageQuery.once('value', function(lastMessageSnapshot) {
                lastMessageSnapshot.forEach(function(childSnapshot) {
                    var messageId = snapshot.key;
                    var messageData = childSnapshot.val();

                    if (messageData.msgs) {
                        var courId = messageId.split('-')[1];
                        var mssgData = messageData.msgs;
                        var sender = snapshot.val().cour_name;
                        var message = mssgData.msg;
                        var timestamp = mssgData.timestamp;
                        var date = new Date(timestamp);
                        var hours = date.getHours().toString().padStart(2, '0');
                        var minutes = date.getMinutes().toString().padStart(2, '0');
                        var formattedTimestamp = hours + ':' + minutes;
                        displayLatestMessage(sender, message, formattedTimestamp, courId);
                    }
                });
            });
        });
    </script>
</main>
@endsection