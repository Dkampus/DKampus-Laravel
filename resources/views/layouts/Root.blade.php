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
<div>
@yield('content')
@include('components.navbar.navbar')
</div> 
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script> 
<script src="{{asset('js/script.js')}}"></script>
</body>
</html>