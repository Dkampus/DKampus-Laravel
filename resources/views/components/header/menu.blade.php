<button onclick="showMenu()" class="relative z-[30]">
<img src="menu.svg" alt="" class="w-8">
</button>

<div id="bar-menu" class="h-screen invisible bg-white shadow-xl transition-all duration-500 fixed w-0 top-0 right-0 z-[70]">

<div class="flex flex-row items-center justify-between w-full px-10 absolute top-5">
<a href="" class="bg-[#F9832A] w-40 h-[3.4rem] rounded-2xl text-center text-white flex items-center justify-center font-semibold text-lg">Masuk</a>
<button onclick="hideMenu()" class="right-8 top-8 font-bold text-xl text-[#FF9240]">
    <svg xmlns="http://www.w3.org/2000/svg" class="fill-[#FF9240]" height="1.5em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg>
</button>
</div>
</div>
<div onclick="hideMenu()" id="overlay-menu" class="fixed bg-black/20 invisible transition-all duration-500 opacity-0 w-screen h-screen z-[60] top-0 left-0"></div>