@extends('layouts.Root')
@section('content')
<header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-8">
    <a href="{{'/courier/dashboard'}}" class="absolute top-5 left-5 flex items-center gap-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z" />
        </svg>
        <h1 class="font-bold text-black text-xl mb-1">Chat</h1>
    </a>
</header>
<main class="flex flex-col gap-5 px-2 mt-3">
    <form action="{{ route('chatWaCour') }}" method="POST">
        @csrf
        <div id="chat-list" class="mx-auto overflow-hidden md:max-w-lg">
            {{-- Chat list items will be added here --}}
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
    var courId = "{{ $courId }}";

    var countMssg;
    var sender;
    var message;
    var timestamp;
    var date;
    var hours;
    var minutes;
    var formattedTimestamp;
    var custId

    // Listen for new messages for the specific custId
    var courIdRef = database.ref('chats');
    courIdRef.on('child_added', function(snapshot) {
        var lastMessageQuery = snapshot.ref.orderByChild('msgs/timestamp').limitToLast(1);
        var id = snapshot.key.split('-')[1];
        if (id == courId) {
            var messageId = snapshot.key;
            custId = messageId.split('-')[0];
            // console.log(custId);
            (function(custId) {
                // database.ref('chats/' + custId + '-' + courId).on('value', function(csnapshot) {
                //     countMssg = csnapshot.val().custNewMssg;
                //     console.log(countMssg);
                //     if (countMssg != 0) {
                //         // $('div[data-count-id="' + custId + '"] .count-message').empty();
                //         // $('div[data-count-id="' + custId + '"] .count-message').text(countMssg);
                //         // $('div[data-count-id="' + custId + '"]').removeClass('hidden');
                //         $('div[data-count-id="' + custId + '"]').addClass('hidden');
                //     } else {
                //         $('div[data-count-id="' + custId + '"]').addClass('hidden');
                //     }
                // });
                // database.ref('chats/' + custId + '-' + courId + '/custNewMssg').on('child_changed', function(countsnapshot) {
                //     countMssg = countsnapshot.val();
                //     console.log(countMssg);
                //     if (countMssg != 0) {
                //         // $('div[data-count-id="' + custId + '"] .count-message').empty();
                //         // $('div[data-count-id="' + custId + '"] .count-message').text(countMssg);
                //         // $('div[data-count-id="' + custId + '"]').removeClass('hidden');
                //         $('div[data-count-id="' + custId + '"]').addClass('hidden');
                //     } else {
                //         $('div[data-count-id="' + custId + '"]').addClass('hidden');
                //     }
                // });
                lastMessageQuery.on('child_added', function(childSnapshot) {
                    var mssgData = childSnapshot.val();
                    var messageData = mssgData.msgs;
                    console.log(messageData)
                    if (messageData) {
                        sender = snapshot.val().cust_name;
                        message = messageData.msg;
                        timestamp = messageData.timestamp;
                        date = new Date(timestamp);
                        hours = date.getHours().toString().padStart(2, '0');
                        minutes = date.getMinutes().toString().padStart(2, '0');
                        formattedTimestamp = hours + ':' + minutes;
                        chatItem = createChatItem(sender, message, timestamp, custId, countMssg);
                        chatList = $('#chat-list');
                        chatItems = chatList.children('.chat-item');
                        existingChatItem = chatItems.find('.chat-item[data-cust-id="' + custId + '"]');
                        if (existingChatItem.length > 0) {
                            existingChatItem.find('.message').text(message);
                            existingChatItem.find('.timestamp').text(formattedTimestamp);
                            $('.chat-item[data-del-id="' + custId + '"]').remove();
                            $('#chat-list').prepend(chatItem);
                        } else {
                            displayLatestMessage(sender, message, timestamp, custId, countMssg);
                        }
                    }
                });

            })
            (custId);

        }
    });

    function displayLatestMessage(sender, message, timestamp, custId, countMssg) {

        var chatItem = createChatItem(sender, message, timestamp, custId, countMssg);

        var chatList = $('#chat-list');
        var chatItems = chatList.children('.chat-item');
        if (chatItems.length > 0) {
            var newestMessageTimestamp = timestamp;
            var inserted = false;
            chatItems.each(function() {
                var existingTimestamp = $(this).find('.timestamp').data('time');
                if (newestMessageTimestamp > existingTimestamp) {
                    $(this).before(chatItem);
                    inserted = true;
                    return false;
                }
            });
            if (!inserted) {
                chatList.append(chatItem);
            }
        } else {
            chatList.append(chatItem);
        }

    }

    // Function to create a chat item
    function createChatItem(sender, message, timestamp, custId, countMssg) {
        date = new Date(timestamp);
        hours = date.getHours().toString().padStart(2, '0');
        minutes = date.getMinutes().toString().padStart(2, '0');
        formattedTimestamp = hours + ':' + minutes;

        var containerDiv = $('<div>').addClass('chat-item mb-5').attr('data-cust-id', custId);
        var chatItemDiv = $('<div>').addClass('flex justify-between items-center gap-3');

        var senderInfoDiv = $('<div>').addClass('flex flex-row gap-1 items-start');
        var svgIconPerson = $('<div class="w-10 h-10 rounded-full flex items-center justify-center">').html('<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#F9832A" class="bi bi-person-circle" viewBox="0 0 16 16"><path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm0 1a7 7 0 1 1 0 14A7 7 0 0 1 8 1z" /><path d="M8 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" /><path d="M8 10a5 5 0 0 0-4 2l1.5.5a4 4 0 0 1 6 0l1.5-.5a5 5 0 0 0-4-2z" /></svg>');
        var senderNameAndMessageDiv = $('<div>').addClass('flex flex-col gap-1 items-start');
        var senderName = $('<h1>').addClass('font-bold text-black').text(sender);
        var maxLength = 25; // Maxlength of message text
        // if (isImageFile(message)) {
        //     var messageText = $('<p>').addClass('text-gray-400 message truncate').text('image');
        // } else {
        //     var messageText = $('<p>').addClass('text-gray-400 message truncate').text(message.length > maxLength ? message.substring(0, maxLength) + '...' : message);
        // }
        senderNameAndMessageDiv.append(senderName);
        // senderNameAndMessageDiv.append(senderName, messageText);
        senderInfoDiv.append(svgIconPerson, senderNameAndMessageDiv);

        // var timestampDiv = $('<div>').addClass('flex flex-col items-end gap-1 right-info');
        // var timestampText = $('<p>').addClass('text-gray-400 timestamp').text(formattedTimestamp).attr('data-time', timestamp);
        // if (countMssg != 0) {
        //     var unreadCountDiv = $('<div>').addClass('w-5 h-5 rounded-full bg-orange-500 flex items-center justify-center').attr('data-count-id', custId);
        //     var unreadCount = $('<a>').addClass('text-white text-xs font-bold count-message').text(countMssg);
        //     unreadCountDiv.append(unreadCount);
        //     timestampDiv.append(timestampText, unreadCountDiv);
        // } else {
        //     timestampDiv.append(timestampText);
        // }


        // chatItemDiv.append(senderInfoDiv, timestampDiv);
        chatItemDiv.append(senderInfoDiv);

        var submitButton = $('<button>')
            .attr('type', 'submit').attr('data-del-id', custId)
            .addClass('w-full chat-item')
            .click(function() {
                handleSubmitButtonClick(custId);
            });

        var hiddenInput = $('<input>').addClass('hidden').attr('type', 'hidden').attr('name', 'custId');

        containerDiv.append(chatItemDiv, hiddenInput);

        submitButton.append(containerDiv);

        return submitButton;
    }

    function handleSubmitButtonClick(custId) {
        $('input[name="custId"]').val(custId);

        $('form').submit();
        chatRef = database.ref('chats/' + custId + '-' + courId + '/custNewMssg');
        chatRef.set(0);
    }

    function isImageFile(fileName) {
        const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'heic', 'webp'];

        const fileExtension = fileName.split('.').pop().toLowerCase();

        return imageExtensions.includes(fileExtension);
    }
</script>
@endsection