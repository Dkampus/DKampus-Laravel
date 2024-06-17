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
<main class="flex flex-col gap-5 mt-3">
    <form action="{{ route('room.chat') }}" method="POST" id="chat-form">
        @csrf
        <div id="chat-list" class="mx-auto shadow-lg rounded-lg overflow-hidden md:max-w-lg">
            {{-- Chat items will be added here --}}
        </div>
    </form>
</main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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

        function handleSubmitButtonClick(courId) {
            $('input[name="courId"]').val(courId);

            $('#chat-form').submit();
            chatRef = database.ref('chats/' + custId + '-' + courId + '/courNewMssg');
            chatRef.set(0);
        }

        var countMssg;
        var courId;
        var existingChatItems = {};

        var custIdRef = database.ref('chats');
        custIdRef.on('child_added', function(snapshot) {
            var lastMessageQuery = snapshot.ref.orderByChild('msgs/timestamp').limitToLast(1);
            var id = snapshot.key.split('-')[0];
            if (id == custId) {
                courId = snapshot.key.split('-')[1];

                lastMessageQuery.on('child_added', function(lastMessageSnapshot) {
                    var mssgData = lastMessageSnapshot.val();
                    var messageData = mssgData.msgs;
                    if (messageData) {
                        var sender = snapshot.val().cour_name;
                        var message = messageData.msg;
                        var timestamp = messageData.timestamp;
                        var date = new Date(timestamp);
                        var hours = date.getHours().toString().padStart(2, '0');
                        var minutes = date.getMinutes().toString().padStart(2, '0');
                        var formattedTimestamp = hours + ':' + minutes;

                        if (existingChatItems[courId]) {
                            // Update existing chat item
                            existingChatItems[courId].find('.message').text(message);
                            existingChatItems[courId].find('.timestamp').text(formattedTimestamp);
                        } else {
                            // Create new chat item
                            var chatItem = createChatItem(sender, message, timestamp, courId, 0); // Assume no unread message initially
                            $('#chat-list').prepend(chatItem);
                            existingChatItems[courId] = chatItem; // Store the chat item for future updates
                        }
                    }
                });

                // Update unread message count when 'courNewMssg' changes
                database.ref('chats/' + custId + '-' + courId + '/courNewMssg').on('value', function(countsnapshot) {
                    countMssg = countsnapshot.val();
                    if (countMssg != 0) {
                        existingChatItems[courId].find('.count-message').text(countMssg);
                        existingChatItems[courId].find('.w-5').removeClass('hidden'); // Show unread count badge
                    } else {
                        existingChatItems[courId].find('.w-5').addClass('hidden'); // Hide unread count badge
                    }
                });
            }
        });


        function createChatItem(sender, message, timestamp, courId, countMssg) {
            var date = new Date(timestamp);
            var hours = date.getHours().toString().padStart(2, '0');
            var minutes = date.getMinutes().toString().padStart(2, '0');
            var formattedTimestamp = hours + ':' + minutes;

            var containerDiv = $('<div>').addClass('chat-item mb-2 p-2').attr('data-cour-id', courId);
            var chatItemDiv = $('<div>').addClass('flex justify-between items-center gap-3');

            var senderInfoDiv = $('<div>').addClass('flex flex-row gap-1 items-start');
            var svgIconPerson = $('<div class="w-10 h-10 rounded-full flex items-center justify-center">').html('<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#F9832A" class="bi bi-person-circle" viewBox="0 0 16 16"><path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm0 1a7 7 0 1 1 0 14A7 7 0 0 1 8 1z" /><path d="M8 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" /><path d="M8 10a5 5 0 0 0-4 2l1.5.5a4 4 0 0 1 6 0l1.5-.5a5 5 0 0 0-4-2z" /></svg>');
            var senderNameAndMessageDiv = $('<div>').addClass('flex flex-col gap-1 items-start');
            var senderName = $('<h1>').addClass('font-bold text-black').text(sender);
            var maxLength = 25; // Maxlength of message text
            var messageText = $('<p>').addClass('text-gray-400 message truncate').text(message.length > maxLength ? message.substring(0, maxLength) + '...' : message);
            senderNameAndMessageDiv.append(senderName, messageText);
            senderInfoDiv.append(svgIconPerson, senderNameAndMessageDiv); // Tambahkan svgIconPerson dan senderNameAndMessageDiv ke senderInfoDiv


            var timestampDiv = $('<div>').addClass('flex flex-col items-end gap-1 right-info');
            var timestampText = $('<p>').addClass('text-gray-400 timestamp').text(formattedTimestamp).attr('value', timestamp);
            var unreadCountDiv = $('<div>').addClass('w-5 h-5 rounded-full bg-orange-500 flex items-center justify-center hidden').attr('data-count-id', courId); // Always create the unread count badge, but hide it initially
            var unreadCount = $('<a>').addClass('text-white text-xs font-bold count-message').text(countMssg);
            unreadCountDiv.append(unreadCount);
            timestampDiv.append(timestampText, unreadCountDiv); // Always add the unread count badge to the timestamp div

            chatItemDiv.append(senderInfoDiv, timestampDiv);

            var submitButton = $('<button>')
                .attr('type', 'submit').attr('data-del-id', courId)
                .addClass('w-full chat-item')
                .click(function() {
                    handleSubmitButtonClick(courId);
                });

            var hiddenInput = $('<input>').addClass('hidden').attr('type', 'hidden').attr('name', 'courId');

            containerDiv.append(chatItemDiv, hiddenInput);

            submitButton.append(containerDiv);

            return submitButton;
        }
    </script>
@endsection
