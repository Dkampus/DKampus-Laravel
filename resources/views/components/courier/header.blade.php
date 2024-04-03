{{-- Header --}}
<header class="bg-orange-200">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <img src="{{ asset('logoDkampus.png') }}" alt="" class="">
        <a href="{{ route('chatpage') }}">
            @if (request()->is('courier/dashboard'))
            <img src="{{ asset('chat.svg') }}" alt="" class="w-7 mr-5">
            @else
            @endif
        </a>
    </div>
</header>
{{-- endHeader --}}
