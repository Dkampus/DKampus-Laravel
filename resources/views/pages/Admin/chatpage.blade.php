<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>
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
                        <div class="p-4" id="list-chat">

                        </div>
                    </div>
                </div>
                {{-- Chatroom --}}
                <div class="w-3/4 mx-5">
                    <div class="bg-white dark:bg-gray-800 h-96" id="room-chat">

                    </div>
                    <div class="p-4 bg-white dark:bg-gray-800">
                        <form id="message-form" action="#" method="POST">
                            @csrf
                            <div class="flex flex-row items-center space-x-4" id="custId">
                                <input id="message-input" type="text" class="w-full p-2 border border-gray-200 dark:border-gray-600 rounded-lg focus:outline-none" placeholder="Type a message..." disabled>
                                <button class="bg-blue-500 text-white p-2 rounded-lg focus:outline-none" type="submit" id="send-btn" disabled>Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
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

    // Reference to your Firebase database
    var database = firebase.database();

    function sendMessage(message, custId) {
        var timestamp = new Date().toISOString();
        database.ref('chats/' + custId + '-' + courId).push().set({
            msgs: {
                role: 'driver',
                msg: message,
                timestamp: timestamp
            }
        });
        var chatRef = database.ref('chats/' + custId + '-' + courId + '/custNewMssg');
        chatRef.transaction(function(currentValue) {
            return (currentValue || 0) + 1;
        });
    }

    function listChat(sender, message, timestamp, custId) {
        date = new Date(timestamp);
        hours = date.getHours().toString().padStart(2, '0');
        minutes = date.getMinutes().toString().padStart(2, '0');
        formattedTimestamp = hours + ':' + minutes;
        var button = $('<button>').addClass('flex flex-row items-center space-x-4 p-2 text-start w-full chat-item').attr('data-del-id', custId);
        var photoProfile = $('<img>').addClass('h-10 w-10 rounded-full');
        var divChat = $('<div>').addClass('flex flex-col w-full chat-list');
        var sender = $('<p>').addClass('font-semibold text-gray-800 dark:text-gray-200').text(sender);
        var message = $('<p>').addClass('text-sm text-gray-500 dark:text-gray-400 message').text(message);
        var pTime = $('<p>').addClass('text-xs text-end text-white time').text(formattedTimestamp).attr('data-time', timestamp);
        divChat.append(sender, message, pTime);
        button.append(photoProfile, divChat);
        button.click(function() {
            loadChat(custId);
        });
        return button;
    }

    function roomChat(role, message, timestamp) {
        var firstDiv = $('<div>').addClass('p-4');
        var messageDiv = $('<div>').addClass('flex flex-col mb-3 m-4');
        var containerDiv = $('<div>').addClass('rounded-lg p-3');
        var messageText = $('<p>').text(message);
        var timestampText = $('<p>').addClass('text-xs').text(timestamp);

        if (role === 'driver') {
            var messageContainer = $('<div>').addClass('flex flex-row items-center space-x-4 justify-end');
            // var avatarImg = $('<img>').addClass('h-10 w-10 rounded-full').attr('src', 'https://randomuser.me/api/port').attr('alt', 'avatar');
            messageDiv.addClass('items-end');
            containerDiv.addClass('bg-blue-500 text-white');
            messageContainer.append(containerDiv);
            messageDiv.append(messageContainer);
            firstDiv.append(messageDiv);
        } else {
            var messageContainer = $('<div>').addClass('flex items-center space-x-4');
            // var avatarImg = $('<img>').addClass('h-10 w-10 roxunded-full').attr('src', 'https://randomuser.me/api/port').attr('alt', 'avatar');
            messageDiv.addClass('items-start');
            containerDiv.addClass('bg-gray-200');
            messageContainer.append(containerDiv);
            messageDiv.append(messageContainer);
            firstDiv.append(messageDiv);
        }

        // Append elements to container
        containerDiv.append(messageText, timestampText);

        // Append container to chat messages
        $('#room-chat').append(firstDiv);
    }

    var courId = 40;
    var custId;
    var chatItemCreated = true;


    function loadChat(custId) {
        $('#room-chat').empty();
        var chatRef = database.ref('chats/' + custId + '-' + courId);
        chatRef.on('child_added', function(snapshot) {
            var messageData = snapshot.val().msgs;
            if (messageData) {
                roomChat(messageData.role, messageData.msg, messageData.timestamp);
                $('#message-input').prop('disabled', false);
                $('#send-btn').prop('disabled', false);
                $('#custId').attr('data-id', custId);
            }
        });
    }

    var courIdRef = database.ref('chats');
    courIdRef.on('child_added', function(snapshot) {
        var lastMessageQuery = snapshot.ref.orderByChild('msgs/timestamp').limitToLast(1);
        var id = snapshot.key.split('-')[1];
        if (id == courId) {
            var messageId = snapshot.key;
            custId = messageId.split('-')[0];
            (function(custId) {
                database.ref('chats/' + custId + '-' + courId).on('value', function(csnapshot) {
                    countMssg = csnapshot.val().custNewMssg;
                });
                database.ref('chats/' + custId + '-' + courId).on('child_changed', function(countsnapshot) {
                    countMssg = countsnapshot.val();
                    if (countMssg != 0) {
                        $('div[data-count-id="' + custId + '"] .count-message').empty();
                        $('div[data-count-id="' + custId + '"] .count-message').text(countMssg);
                        $('div[data-count-id="' + custId + '"]').removeClass('hidden');
                    } else {
                        $('div[data-count-id="' + custId + '"]').addClass('hidden');
                    }
                });
                lastMessageQuery.on('child_added', function(childSnapshot) {
                    var mssgData = childSnapshot.val();
                    var messageData = mssgData.msgs;
                    if (messageData) {
                        sender = snapshot.val().cust_name;
                        message = messageData.msg;
                        timestamp = messageData.timestamp;
                        date = new Date(timestamp);
                        hours = date.getHours().toString().padStart(2, '0');
                        minutes = date.getMinutes().toString().padStart(2, '0');
                        formattedTimestamp = hours + ':' + minutes;
                        if (!chatItemCreated) {
                            chatItem = listChat(sender, message, timestamp, custId, countMssg);
                            chatItemCreated = true; // Set flag to true indicating chat item is created
                        } else {
                            chatItem = listChat(sender, message, timestamp, custId, countMssg);
                            var chatList = $('#list-chat');
                            var chatItems = chatList.children('.chat-item');
                            existingChatItem = chatList.find('.chat-item[data-del-id="' + custId + '"]');
                            if (existingChatItem.length > 0) {
                                console.log(1);
                                chatItem = listChat(sender, message, timestamp, custId, countMssg);
                                existingChatItem.find('.message').text(message);
                                existingChatItem.find('.timestamp').text(formattedTimestamp);
                                $('.chat-item[data-del-id="' + custId + '"]').remove();
                                $('#list-chat').prepend(chatItem);
                            } else {
                                displayLatestMessage(sender, message, timestamp, custId, countMssg);
                            }
                        }
                    }
                });
            })
            (custId);

        }
    });

    function displayLatestMessage(sender, message, timestamp, custId, countMssg) {

        var chatItem = listChat(sender, message, timestamp, custId, countMssg);

        var chatList = $('#list-chat');
        var chatItems = chatList.children('.chat-item');
        if (chatItems.length > 0) {
            var newestMessageTimestamp = timestamp;
            var inserted = false;
            chatItems.each(function() {
                var existingTimestamp = chatItems.find('.time').data('time');
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

    $('#message-form').submit(function(event) {
        event.preventDefault(); // Prevent form submission

        var message = $('#message-input').val().trim();
        var custId = $('#custId').data('id');
        console.log(custId);
        if (message !== '') {
            sendMessage(message, custId);

            $('#message-input').val('');
        }
    });
</script>