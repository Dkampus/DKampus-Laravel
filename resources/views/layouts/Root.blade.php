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
</div>
@if ($Title === 'Detail')
{{-- @include('components.navbar.navbar') --}}
@else
@include('components.navbar.navbar')
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script> 
@if ($Title === 'Home')
<script src="{{asset('js/homepage-script.js')}}"></script> 
<script src="{{asset('js/swiper.js')}}"></script>
@else
<script src="{{asset('js/DetailWarung-script.js')}}"></script> 
{{-- <script src="{{asset('js/homepage-script.js')}}"></script>   --}}
{{-- <script src="{{asset('js/swiper.js')}}"></script> --}}
{{-- <script src="{{asset('js/gsap.js')}}"></script> --}}
@endif
</body>
</html>