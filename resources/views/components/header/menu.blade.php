<button onclick="showMenu()" class="relative z-[30]">
<img src="menu.svg" alt="" class="w-8">
</button>
<div id="bar-menu" class="h-screen invisible bg-white shadow-xl fixed w-0 top-0 right-0 z-[70]">
<button onclick="hideMenu()" class="absolute right-8 top-8">X</button>
</div>
<div onclick="hideMenu()" id="overlay-menu" class="fixed bg-black/20 invisible transition-all duration-300 opacity-0 w-screen h-screen z-[60] top-0 left-0"></div>