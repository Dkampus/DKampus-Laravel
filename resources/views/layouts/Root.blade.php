<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- icon title -->
    <link rel="apple-touch-icon" type="image/png" href={{ asset('logoDkampus.png') }} />
    <link rel="apple-touch-icon" type="image/png" sizes="76x76" href={{ asset('logoDkampus.png') }} />
    <link rel="apple-touch-icon" type="image/png" sizes="120x120" href={{ asset('logoDkampus.png') }} />
    <link rel="apple-touch-icon" type="image/png" sizes="152x152" href={{ asset('logoDkampus.png') }} />
    <link rel="apple-touch-icon" type="image/png" href={{ asset('logoDkampus.png') }} sizes="60x60" />
    <link rel="icon" type="image/png" href={{ asset('logoDkampus.png') }} />
    <link rel="icon" type="image/png" href={{ asset('logoDkampus.png') }} sizes="32x32" />
    <link rel="icon" type="image/png" href={{ asset('logoDkampus.png') }} sizes="192x192" />
    <link rel="icon" type="image/png" href={{ asset('logoDkampus.png') }} sizes="16x16" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <title>{{ $Title }} - Welcome & Enjoy what you need</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div id="containerLayout" class="relative mx-auto {{$Title === 'Home' ? 'px-3' :'px-0' }}">
        {{-- TopBar Desktop --}}
        <div class="hidden md:flex md:flex-col">
            <div class="hidden w-[100%] items-center gap-0.5 pt-7 pb-3 mx-auto md:flex md:flex-row md:px-5">
                {{-- Logo --}}
                <div class="flex flex-row items-center md:gap-2">
                    <a href="/">
                        <img src="logoDkampus.svg" alt="" class="min-w-[100%] max-w-[120%] md:min-w-[2vw]">
                    </a>
                    <h1 class="font-bold text-[#F9832A] text-2xl hidden md:flex">Dkampus</h1>    
                </div>
            
                {{-- Search --}}
                @include('components.header.search')
            
                {{-- Sidebar --}}
                <div class="flex flex-row items-center gap-3">
                    {{-- <button>
                    <img src="chat.svg" alt="" class="w-8 mr-5">
                    </button> --}}
                    @auth
                    <button>
                    <img src="chat.svg" alt="" class="w-8 mr-5">
                    </button>
                    @endauth    
                    @include('components.header.menu')
                </div>
            </div>
            @if ($Title === 'Home' || $Title === 'Promo' || $Title === 'Pesanan' || $Title === 'Favorit' || $Title === 'Status')
            {{-- <div class="w-full relative flex justify-center"> --}}
                @include('components.navbar.navbarDesktop')
            {{-- </div> --}}
            @else
            {{-- @include('components.navbar.navbar') --}}
            @endif
        </div>
        @yield('content')
        @if ($Title === 'Home' || $Title === 'Promo' || $Title === 'Pesanan' || $Title === 'Favorit' || $Title === 'Status')
            {{-- <div class="w-full relative flex justify-center"> --}}
                @include('components.navbar.navbar')
            {{-- </div> --}}
        @else
            {{-- @include('components.navbar.navbar') --}}
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
    @switch($Title)
        @case('Home')
            <script src="{{ asset('js/homepage-script.js') }}"></script>
            <script src="{{ asset('js/swiper.js') }}"></script>
        @break

        @case('Promo')
        @break

        @case('Pesanan')
            <script src="{{ asset('js/pesanan.js') }}"></script>
        @break

        @case('Status')
            <script src="{{ asset('js/status.js') }}"></script>
        @break

        @case('Favorit')
        @break

        @case('Detail-Warung')
            <script src="{{ asset('js/DetailWarung-script.js') }}"></script>
        @break

        @case('Detail-Makanan')
            <script src="{{ asset('js/DetailMakanan-script.js') }}"></script>
        @break

        @case('Log in')
            <script src="{{ asset('js/login.js') }}"></script>
        @break

        @case('Register')
            <script src="{{ asset('js/register.js') }}"></script>
        @break

        @case('Code Verification')
            <script src="{{ asset('js/codeVerification.js') }}"></script>
        @break

        @case('Input Registrasi')
            <script src="{{ asset('js/inputRegistration.js') }}"></script>
        @break

        @default
            {{-- <script src="{{asset('js/DetailWarung-script.js')}}"></script> 
    <script src="{{asset('js/DetailMakanan-script.js')}}"></script>  --}}
            {{-- <script src="{{asset('js/homepage-script.js')}}"></script>   --}}
            {{-- <script src="{{asset('js/swiper.js')}}"></script> --}}
            {{-- <script src="{{asset('js/gsap.js')}}"></script> --}}
            {{-- <script src="{{asset('js/inputRegistration.js')}}"></script> --}}
            {{-- <script src="{{asset('js/codeVerification.js')}}"></script> --}}
    @endswitch
</body>

</html>
