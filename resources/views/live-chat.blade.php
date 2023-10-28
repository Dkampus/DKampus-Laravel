<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>

<body>

    <div class="flex flex-col dark:bg-gray-800 p-8">
        <div id="chat-box" class="w-full h-96 dark:bg-gray-500 rounded-md text-white overflow-y-auto">
            @forelse ($chatRoom as $item)
                <div>
                    {{ $item->sender_id }} {{ $item->message }}
                </div>
            @empty
            @endforelse
        </div>
        <div>
            {{-- <h1>{{ Auth::id() }}</h1> --}}

            <input type="hidden" class="w-full" name="" id="chat_room_id"
                value="{{ $chatRoom->first()->chat->id }}">
            <input type="hidden" class="w-full" name="" id="sender_id" value="{{ Auth::id() }}">
            <input type="hidden" class="w-full" name="" id="receiver_id"
                value="{{ $chatRoom->first()->receiver_id == Auth::id() ? $chatRoom->first()->sender_id : $chatRoom->first()->receiver_id }}">
            <label for="chat" class="sr-only">Your message</label>
            <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-700">
                <button type="button"
                    class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 18">
                        <path fill="currentColor"
                            d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 1H2a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z" />
                    </svg>
                    <span class="sr-only">Upload image</span>
                </button>
                <button type="button"
                    class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.408 7.5h.01m-6.876 0h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM4.6 11a5.5 5.5 0 0 0 10.81 0H4.6Z" />
                    </svg>
                    <span class="sr-only">Add emoji</span>
                </button>
                <textarea id="message" rows="1"
                    class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Your message..."></textarea>
                <button type="button" id="sendButton"
                    class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                    <svg class="w-5 h-5 rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 18 20">
                        <path
                            d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                    </svg>
                    <span class="sr-only">Send message</span>
                </button>
            </div>

        </div>
    </div>

</body>
@vite('resources/js/app.js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {

        $('#sendButton').on('click', function(e) {
            e.preventDefault();
            // console.log('uhuy')

            const chat_room_id = $('#chat_room_id').val();
            const sender_id = $('#sender_id').val();
            const receiver_id = $('#receiver_id').val();
            const message = $('#message').val();

            const data = {
                chat_room_id,
                sender_id,
                receiver_id,
                message
            }

            // console.log(data)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ url('/private') }}",
                data: data,
                dataType: "json",
                success: function(response) {
                    $('#message').val('');
                    $("#chat-box").append(
                        ` <div> ${response.message.sender_id} ${response.message.message} </div>`
                    );
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('error')
                }
            });
        });

        $('#message').on('keypress', function(e) {
            if (e.which === 13) { // 13 is the key code for Enter
                e.preventDefault();
                $('#sendButton').click(); // Trigger the button click event
            }
        });
    });
</script>
<script>
    setTimeout(() => {
        window.Echo.private(
                'liveChatPrivate.user.{{ Auth::id() }}'
            )
            .listen('.private_msg', (e) => {
                console.log(e);


                $("#chat-box").append(` <div> ${e.message.sender_id} ${e.message.message} </div>`);
            });
    }, 200);
</script>

{{-- <script>
    setTimeout(() => {
        window.Echo.channel(
                'testing'
            )
            .listen('.testWebsocket', (e) => {
                console.log(e);
            });
    }, 200);
</script> --}}

</html>
