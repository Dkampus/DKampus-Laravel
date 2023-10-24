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
    <script src="{{asset('js/script.js')}}"></script>
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
<script>
const barMenu = document.getElementById('bar-menu');
const overlayMenu = document.getElementById('overlay-menu');
function showMenu(){
    if(barMenu.style.display === 'none' || barMenu.style.display === ''){
        barMenu.style.width = '23rem'
        barMenu.style.height = '100vh';
        barMenu.style.visibility = 'visible';
        barMenu.style.opacity = '100';
        barMenu.style.boxShadow = "0px 10px 15px -3px rgba(0,0,0,0.1)";

        // style body
        document.body.style.overflow = 'hidden';

        overlayMenu.style.opacity = '100';
        overlayMenu.style.display = 'block';
        overlayMenu.style.visibility = 'visible';
    }
}

function hideMenu(){
    barMenu.style.height = '0rem';
    barMenu.style.visibility = 'invisible';
    barMenu.style.opacity = '0';
    barMenu.style.boxShadow = "0px";

    // style body
    document.body.style.overflow = 'auto';

    overlayMenu.style.display = 'none';
    overlayMenu.style.opacity = '0';
}

const searchResults = document.getElementById('search-results');
const overlayResults = document.getElementById('overlay-results');
function showResults(){
    if(searchResults.style.display === 'none' || searchResults.style.display === ''){
        searchResults.style.height = '24rem';
        searchResults.style.visibility = 'visible';
        searchResults.style.opacity = '100';
        searchResults.style.boxShadow = "0px 10px 15px -3px rgba(0,0,0,0.1)";

        // style body
        document.body.style.overflow = 'hidden';

        overlayResults.style.opacity = '100';
        overlayResults.style.display = 'block';
        overlayResults.style.visibility = 'visible';
    }
}

function hideResults(){
    searchResults.style.height = '0rem';
    searchResults.style.visibility = 'invisible';
    searchResults.style.opacity = '0';
    searchResults.style.boxShadow = "0px";

    // style body
    document.body.style.overflow = 'auto';

    overlayResults.style.display = 'none';
    overlayResults.style.opacity = '0';
}

const searchInput = document.getElementById('search-input');
const clearInput = document.getElementById('clear-input');
clearInput.addEventListener("click",function(){
    searchInput.value = "";
    clearInput.style.display = 'none';
})
searchInput.addEventListener("input",function(){
    if(searchInput.value.trim() !== ''){
        clearInput.style.display = 'flex';
        clearInput.style.flexDirection = 'row';
        clearInput.style.justifyContent = 'center';
        clearInput.style.alignItems = 'center';
        clearInput.style.visibility = 'visible';
       
    }else{
        clearInput.style.display = 'none';
        clearInput.style.visibility = 'invisible';
       
    }
})
  const swiperEl = document.querySelector('swiper-container')
  const params = {
      injectStyles: [`
      'path/to/navigation-element.min.css',
      'path/to/pagination-element.min.css',
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
    const buttonEl = document.querySelector('button');
    buttonEl.addEventListener('click', () => {
    swiperEl.swiper.slideNext();
    });

Object.assign(swiperEl, params)
swiperEl.initialize();
</script>
</body>
</html>