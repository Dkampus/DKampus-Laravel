@extends('layouts.Root')
@section('content')
<header class="sticky top-0 left-0 flex justify-between items-center w-full bg-white z-10 shadow-md py-8 mb-5">
    <a href="{{ url('/chats') }}" class="flex items-center gap-x-2 ml-5">
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
    <a href="{{ url('wa.me/' . $wa ?? '') }}" class="mr-5">
        <img src="whatsapp.svg" alt="WhatsApp" width="24" height="24">
    </a>
</header>
<main>
    <div id="chat-messages" class="flex flex-col gap-3 m-4 overflow-y-auto pb-16">
        {{-- Chat messages will be displayed here --}}
    </div>
</main>
<footer class="fixed bottom-0 left-0 w-full bg-white z-10 shadow-md py-2 px-4">
    <form id="message-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex items-center mb-2">
            <input id="message-input" type="text" name="message" placeholder="Type a message" class="flex-grow border rounded-lg p-3 mr-2">
            <input id="image-input" type="file" name="image" accept="image/*" class="hidden">
            <button type="button" id="image-btn" class="bg-[#F9832A] rounded-lg p-2 mr-2">
                <img src="{{ asset('/image-icon.svg') }}" width="24" height="24" class="bi bi-image">
            </button>
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
        var startTime = performance.now();

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
        }).then(function() {
            var endTime = performance.now(); // Ambil waktu selesai pengiriman pesan
            var duration = endTime - startTime; // Hitung durasi pengiriman dalam milidetik
            console.log('Pengiriman pesan selesai dalam ' + duration + ' milidetik');

            sendNotificationToServer(courId, "New Message", message);
        });
        var chatRef = database.ref('chats/' + custId + '-' + courId + '/custNewMssg');
        chatRef.transaction(function(currentValue) {
            return (currentValue || 0) + 1;
        });
    }

    var lastDisplayedDate = null;

    function displayMessage(role, message, timestamp) {
        // Create message elements
        var date = new Date(timestamp);
        var today = new Date();
        var hours = date.getHours().toString().padStart(2, '0');
        var minutes = date.getMinutes().toString().padStart(2, '0');
        var formattedTimestamp = hours + ':' + minutes;

        // Format the date for display
        var messageDate = date.toDateString();
        var yesterday = new Date(today);
        yesterday.setDate(today.getDate() - 1);

        var dateLabel;
        if (messageDate === today.toDateString()) {
            dateLabel = "Today";
        } else if (messageDate === yesterday.toDateString()) {
            dateLabel = "Yesterday";
        } else {
            dateLabel = date.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        // Check if we need to add a new date div
        if (lastDisplayedDate !== messageDate) {
            var dateDiv = $('<div>').addClass('text-center my-2 date-label');
            var dateSpan = $('<span>').addClass('inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700').text(dateLabel);
            dateDiv.append(dateSpan);
            $('#chat-messages').append(dateDiv);
            // Update the last displayed date
            lastDisplayedDate = messageDate;
        }

        var messageDiv = $('<div>').addClass('flex flex-col mb-3 m-4');
        var containerDiv = $('<div>').addClass('rounded-lg p-3');

        if (isImageFile(message)) {
            var imageUrl = `/storage/chatsImg/${message}`;
            var messageText = $('<img>').attr('src', imageUrl).addClass('mt-2 max-w-xs rounded-lg');
        } else {
            var messageText = $('<p>').text(message);
        }

        var timestampText = $('<p>').addClass('text-xs').text(formattedTimestamp);

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
    }

    // Listen for new messages
    database.ref('chats/' + custId + '-' + courId).on('child_added', function(snapshot) {
        var startTime = performance.now();
        var messageData = snapshot.val();
        console.log(messageData);

        if (messageData.msgs) {
            var role = messageData.msgs.role;
            var message = messageData.msgs.msg;
            var timestamp = messageData.msgs.timestamp;
            displayMessage(role, message, timestamp);
            var endTime = performance.now();
            var duration = endTime - startTime;
            console.log('Penerimaan pesan selesai dalam ' + duration + ' milidetik');
        }

    });

    // Send message when form is submitted
    $('#message-form').submit(function(event) {
        event.preventDefault(); // Prevent form submission

        var message = $('#message-input').val().trim();
        var imageFile = $('#image-input')[0].files[0];

        if (imageFile) {
            var formData = new FormData();
            formData.append('image', imageFile);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content')); // Add CSRF token if needed
            $.ajax({
                url: '/uploadChatImage',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        var imageUrl = response.imageUrl;
                        sendMessage(imageUrl.split('/').pop());
                        console.log('success');
                    } else {
                        console.log('Image upload failed');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + error);
                }
            });
        } else if (message !== '') {
            sendMessage(message);
            sendChatbotMessage(message);
        }

        $('#message-input').val('');
        $('#image-input').val('');
    });

    $('#image-btn').click(function() {
        $('#image-input').click();
    });

    $('#image-input').change(function() {
        $('#message-form').submit();
    });

    function isImageFile(fileName) {
        const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'heic', 'webp'];

        const fileExtension = fileName.split('.').pop().toLowerCase();

        return imageExtensions.includes(fileExtension);
    }

    function sendNotificationToServer(userId, title, body) {
        $.ajax({
            url: '{{ route("send.notification") }}',
            type: 'POST',
            data: {
                user_id: userId,
                title: title,
                body: body,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('Notification sent successfully:', response);
            },
            error: function(xhr, status, error) {
                console.error('Error sending notification:', error);
            }
        });
    }
</script>
@endsection
