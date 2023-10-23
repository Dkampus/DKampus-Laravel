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
    <script type="module" src={{asset('js/script.js')}}></script>
    <script src={{asset('css/style.css')}}></script>
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <title>Home - Welcome & Enjoy what you need</title>
    @vite('resources/css/app.css')
</head>
<body>
<div>
@yield('content')
</div> 
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script> 
<script>
    const swiperEl = document.querySelector('swiper-container')
    const params = {
      injectStyles: [`
      .swiper-pagination-bullet {
        width: 8px;
        height: 8px;
        text-align: center;
        line-height: 20px;
        font-size: 12px;
        color: #000;
        opacity: 1;
        background: rgba(0, 0, 0, 0.2);
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
      }

      .swiper-pagination-bullet-active {
        color: #fff;
        background: #F9832A;
        width: 20px;
        height: 8px;
        border-radius: 50px;
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
      }

      .swiper-button-disabled{
      position: absolute;
      /* left: -2rem; */
      display: none;
      transition: all;
      }
      `],
    }

Object.assign(swiperEl, params)

swiperEl.initialize();
</script>
</body>
</html>