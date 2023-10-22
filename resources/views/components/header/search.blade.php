<input id="search-input" name="value" type="" class="w-[12.5rem] h-full self-start outline-none ring-0 border-none text-[#F9832A] placeholder:font-medium placeholder:text-[#F9832A]" placeholder="Cari Menu">
<button id="clear-input" class="invisible font-bold flex flex-row justify-center items-center text-[#F9832A] self-center rounded-lg w-5 h-5 mr-1">
<h1 class="shadow-lg">x</h1>
</button>
<script>
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