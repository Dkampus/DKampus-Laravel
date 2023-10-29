<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- icon title -->
    <link rel="apple-touch-icon" type="image/png" href={{asset('logoDkampus.png')}} />
    <link
      rel="apple-touch-icon"
      type="image/png"
      sizes="76x76"
      href={{asset('logoDkampus.png')}}
    />
    <link
      rel="apple-touch-icon"
      type="image/png"
      sizes="120x120"
      href={{asset('logoDkampus.png')}}
    />
    <link
      rel="apple-touch-icon"
      type="image/png"
      sizes="152x152"
      href={{asset('logoDkampus.png')}}
    />
    <link
      rel="apple-touch-icon"
      type="image/png"
      href={{asset('logoDkampus.png')}}
      sizes="60x60"
    />
    <link rel="icon" type="image/png" href={{asset('logoDkampus.png')}} />
    <link rel="icon" type="image/png" href={{asset('logoDkampus.png')}} sizes="32x32" />
    <link rel="icon" type="image/png" href={{asset('logoDkampus.png')}} sizes="192x192" />
    <link rel="icon" type="image/png" href={{asset('logoDkampus.png')}} sizes="16x16" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <title>{{$Title}} - Welcome & Enjoy what you need</title>
    @vite('resources/css/app.css')
</head>
<body>
<div id="containerLayout" class="max-w-xl">
@yield('content')
@if ($Title === 'Home' || $Title === 'Promo' || $Title === 'Pesanan' || $Title === 'Favorit')
<div class="w-full flex justify-center">
  @include('components.navbar.navbar')
</div>
@else
{{-- @include('components.navbar.navbar') --}}
@endif
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
@switch($Title)
    @case('Home')
    <script src="{{asset('js/homepage-script.js')}}"></script> 
    <script src="{{asset('js/swiper.js')}}"></script>
    @break
    @case('Promo')
      
    @break
    @case('Pesanan')
    <script src="{{asset('js/pesanan.js')}}"></script> 
    @break
    @case('Favorit')
      
    @break
    @case('Detail-Warung')
    <script src="{{asset('js/DetailWarung-script.js')}}"></script> 
    @break
    @case('Detail-Makanan')
    <script src="{{asset('js/DetailMakanan-script.js')}}"></script>
    @break
    @case('Log in')
    <script src="{{asset('js/login.js')}}"></script>
    @break
    @case('Register')
    <script src="{{asset('js/register.js')}}"></script>
    @break
    @case('Code Verification')
    <script src="{{asset('js/codeVerification.js')}}"></script>
    @break
    @case('Input Registrasi')
    <script src="{{asset('js/inputRegistration.js')}}"></script>
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