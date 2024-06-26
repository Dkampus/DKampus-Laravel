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
                    <div class="bg-white dark:bg-gray-800">
                        <div class="flex flex-row items-center justify-between p-4 border-b dark:border-gray-600">
                            <p class="font-semibold text-gray-800 dark:text-gray-200">Chats</p>
                            <button id="addNewChat" class="text-gray-500 dark:text-gray-400 focus:outline-none">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div id="list-chat" class="bg-white dark:bg-gray-800 flex-grow overflow-auto h-[74.3vh] no-scrollbar">
                        {{-- Chat list in here --}}
                    </div>
                </div>
                {{-- Chatroom and message form --}}
                <div class="w-3/4 mx-5 flex flex-col h-[80vh]">
                    <div class="bg-white dark:bg-gray-800 flex-grow overflow-auto no-scrollbar" id="room-chat">
                        <a id="ifx" class="flex flex-col items-center justify-center h-full text-gray-500 dark:text-gray-400">
                            Silahkan pilih chat untuk melihat pesan
                        </a>
                        {{-- Chat messages in here --}}
                    </div>
                    <div class="p-4 bg-white dark:bg-gray-800">
                        <form id="message-form" action="#" method="POST">
                            @csrf
                            <div class="flex flex-row items-center space-x-4">
                                <input type="text" id="custId" class="hidden" value="">
                                <input id="message-input" type="text" class="w-full p-2 border border-gray-200 dark:border-gray-600 rounded-lg focus:outline-none" placeholder="Type a message..." disabled>
                                <button class="bg-blue-500 text-white p-2 rounded-lg focus:outline-none" type="submit" id="send-btn">Send</button>
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

    // Reference to your Firebase database
    var database = firebase.database();

    function sendMessage(message, custId) {
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
                role: 'admin',
                msg: message,
                timestamp: formattedTimestamp
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
        var photoProfile = $('<div>').addClass('h-10 w-12 rounded-full bg-red-200');
        var divChat = $('<div>').addClass('flex flex-col w-full chat-list');
        var senderAndTime = $('<div>').addClass('flex justify-between items-center w-full');
        var sender = $('<p>').addClass('font-semibold text-gray-800 dark:text-gray-200').text(sender);
        var pTime = $('<p>').addClass('text-xs text-end text-white time').text(formattedTimestamp).attr('data-time', timestamp);
        senderAndTime.append(sender, pTime);
        var message = $('<p>').addClass('text-sm text-gray-500 dark:text-gray-400 message').text(message);
        divChat.append(senderAndTime, message);
        button.append(photoProfile, divChat);
        button.click(function() {
            loadChat(custId);
        });
        return button;
    }

    function roomChat(role, message, timestamp) {
        var firstDiv = $('<div>').addClass('p-2');
        var messageDiv = $('<div>').addClass('flex flex-col mb-3 m-4');
        var containerDiv = $('<div>').addClass('rounded-lg p-3');
        var messageText = $('<p>').text(message);
        let timeformated = new Date(timestamp);
        var timestampText = $('<p>').addClass('text-xs').text(timeformated.getHours() + ':' + timeformated.getMinutes());

        if (role == 'courier' || role == 'admin') {
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

        containerDiv.append(messageText, timestampText);

        $('#room-chat').append(firstDiv);
    }

    var courId = 1;
    var custId;
    var chatItemCreated = true;


    function loadChat(custId) {
        $('#room-chat').empty();
        var ifx = $('#ifx');
        ifx.addClass('hidden');
        var chatRef = database.ref('chats/' + custId + '-' + courId);
        chatRef.on('child_added', function(snapshot) {
            var messageData = snapshot.val().msgs;
            console.log(messageData);
            if (messageData) {
                roomChat(messageData.role, messageData.msg, messageData.timestamp);
                $('#message-input').prop('disabled', false);
                $('#send-btn').prop('disabled', false);
                $('#custId').attr('value', custId);
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
                            chatItemCreated = true;
                        } else {
                            chatItem = listChat(sender, message, timestamp, custId, countMssg);
                            var chatList = $('#list-chat');
                            var chatItems = chatList.children('.chat-item');
                            existingChatItem = chatList.find('.chat-item[data-del-id="' + custId + '"]');
                            if (existingChatItem.length > 0) {
                                // console.log(1);
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
        var custId = $('#custId').val();
        console.log(custId);
        if (message !== '' && custId !== null) {
            sendMessage(message, custId);

            $('#message-input').val('');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const addNewChatBtn = document.getElementById('addNewChat');

        addNewChatBtn.addEventListener('click', function() {
            const message = "Hello, can i help you?!";
            const custId = 24;
            sendMessage(message, custId);
        });
    });
</script>

<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .no-scrollbar {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }
</style>
