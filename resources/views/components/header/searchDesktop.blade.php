<div class="w-[60%] relative flex-col items-center hidden mx-auto md:flex">
    {{-- Search Input --}}
    <div class="border-2 relative bg-white z-[60] w-full h-10 flex flex-row justify-between items-center border-[#F9832A]/40 gap-2 px-2 rounded-md overflow-hidden focus:border-[#F9832A] md:h-12">
        <div class="flex flex-row items-center gap-2 h-full">
            <button class="min-w-[1rem] max-w-[10%] h-full md:min-w-[1.5rem]">
                <img src="{{asset('serach.svg')}}" alt="" class="w-full h-full">
            </button>
            <form action="/search" method="GET" id="search-form">
                <input onclick="" id="search-input-desktop" name="value" type="" class="searchKeyword w-full min-w-max sm:max-w-full h-full self-start outline-none ring-0 border-none text-[#F9832A] placeholder:font-medium placeholder:text-[#F9832A] placeholder:md:text-lg" placeholder="Cari Menu">
            </form>
        </div>
        {{-- Clear Button --}}
        <button id="clear-input-desktop"
            class="invisible font-bold group flex flex-row justify-center items-center text-[#F9832A] self-center rounded-lg w-5 h-5 mr-1">
            <svg class="fill-[#F9832A] group-hover:fill-[#F9832A]/80" xmlns="http://www.w3.org/2000/svg" height="1em"
                viewBox="0 0 512 512">
                <path
                    d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
            </svg>
        </button>
    </div>
{{--    <div id="search-results-desktop" class="bg-white shadow-lg overflow-y-auto flex flex-col gap-3 rounded-xl border h-0 min-w-[80vw] invisible opacity-0 p-5 transition-all duration-300 absolute z-50 top-[3rem] sm:min-w-[58vw] md:top-[3rem]">--}}
{{--        <div>--}}
{{--            <h1 class="font-bold text-xl">Hasil Pencarian</h1>--}}
{{--            <div class="container-search-result grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-3 my-3 justify-center">--}}
{{--                <div class="flex flex-col border border-black/30 p-2 w-40 rounded-xl max-w-40 h-[185px] max-h-[185px] min-h-[185px]">--}}
{{--                    <img src="bagdhag.jpg" alt="" class="w-full">--}}
{{--                    <h1 class="font-semibold">Ayam Bagdhad Fried Chicken</h1>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
<div onclick="hideResultsDesktop()" id="overlay-results-desktop"
    class="fixed bg-black/20 invisible transition-all duration-300 opacity-0 w-screen h-screen z-40 left-0 top-0"></div>
