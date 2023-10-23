<div class="flex flex-col items-center mx-auto w-max">
    <div class="border-2 relative bg-white z-[60] w-80 h-10 grid grid-cols-3 place-content-center place-items-center border-[#F9832A]/40 px-2 gap-24 rounded-md overflow-hidden">
    <button class="w-6 h-full">
        <img src="serach.svg" alt="" class="w-full h-full">
    </button>
    <input onclick="show()" id="search-input" name="value" type="" class="w-[12.5rem] h-full self-start outline-none ring-0 border-none text-[#F9832A] placeholder:font-medium placeholder:text-[#F9832A]" placeholder="Cari Menu">
    <button id="clear-input" class="invisible font-bold group flex flex-row justify-center items-center text-[#F9832A] self-center rounded-lg w-5 h-5 mr-1">
    <svg class="fill-[#F9832A] group-hover:fill-[#F9832A]/80" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
    </button>
    </div>
<div id="search-results" class="bg-white shadow-lg rounded-xl border h-0 w-80 invisible opacity-0 transition-all duration-300 absolute z-50 top-[3rem]">
    <button onclick="hide()">
    <svg class="top-10 left-5 absolute fill-[#F9832A]/70 group-hover:fill-[#F9832A]/80" xmlns="http://www.w3.org/2000/svg" height="1.3em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
    </button>
</div>
</div>
<div onclick="hide()" id="overlay-results" class="fixed bg-black/20 invisible transition-all duration-300 opacity-0 w-screen h-screen z-40 top-0"></div>
<script>
const searchResults = document.getElementById('search-results');
const overlayResults = document.getElementById('overlay-results')
function show(){
    if(searchResults.style.display === 'none' || searchResults.style.display === ''){
        searchResults.style.height = '24rem';
        searchResults.style.visibility = 'visible';
        searchResults.style.opacity = '100';
        searchResults.style.boxShadow = "0px 10px 15px -3px rgba(0,0,0,0.1)";

        overlayResults.style.opacity = '100';
        overlayResults.style.display = 'block';
        overlayResults.style.visibility = 'visible';
    }
}
function hide(){
    searchResults.style.height = '0rem';
    searchResults.style.visibility = 'invisible';
    searchResults.style.opacity = '0';
    searchResults.style.boxShadow = "0px";

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
</script>