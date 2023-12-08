<div class="w-[60%] flex flex-col items-center mx-auto">
    {{-- Search Input --}}
    <div onclick class="border-2 relative bg-white z-[60] w-full h-10 flex flex-row justify-between items-center border-[#F9832A]/40 gap-2 px-2 rounded-md overflow-hidden focus:border-[#F9832A]">
        <div class="flex flex-row items-center gap-2">
        <button class="min-w-[1rem] max-w-[10%] h-full">
            <img src="serach.svg" alt="" class="w-full h-full">
        </button>
        <input onclick="showResults()" id="search-input" name="value" type="" class="min-w-max sm:max-w-full h-full self-start outline-none ring-0 border-none text-[#F9832A] placeholder:font-medium placeholder:text-[#F9832A]" placeholder="Cari Menu">
        </div>
        {{-- Clear Button --}}
        <button id="clear-input" class="invisible font-bold group flex flex-row justify-center items-center text-[#F9832A] self-center rounded-lg w-5 h-5 mr-1">
        <svg class="fill-[#F9832A] group-hover:fill-[#F9832A]/80" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
        </button>
    </div>
<div id="search-results" class="bg-white shadow-lg rounded-xl border h-0 min-w-[63%] max-w-[100%] invisible opacity-0 transition-all duration-300 absolute z-50 top-[3rem]">
    
</div>
</div>
<div onclick="hideResults()" id="overlay-results" class="fixed bg-black/20 invisible transition-all duration-300 opacity-0 w-screen h-screen z-40 left-0 top-0"></div>