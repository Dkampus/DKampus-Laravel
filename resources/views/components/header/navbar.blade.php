<nav class="flex flex-row items-center justify-between px-5">
<a href="/">
<img src="logoDkampus.svg" alt=""></a>

<div class="border-2 relative w-72 h-10 grid grid-cols-3 place-content-center place-items-center border-[#F9832A]/40 px-2 gap-24 rounded-md overflow-hidden">
 <button class="w-6 h-full">
    <img src="serach.svg" alt="" class="w-full h-full">
 </button>
 @include('components.header.search')
</div>

<div class="flex flex-row items-center gap-5">
    <button>
    <img src="chat.svg" alt="" class="w-7">
    </button>
    @include('components.header.menu')
</div>
</nav>
<script>

</script>