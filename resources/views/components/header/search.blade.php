<div class="w-[60%] relative flex flex-col items-center mx-auto md:hidden">
    {{-- Search Input --}}
    <div onclick class="border-2 relative bg-white z-[60] w-full h-10 flex flex-row justify-between items-center border-[#F9832A]/40 gap-2 px-2 rounded-md overflow-hidden focus:border-[#F9832A] md:h-12">
        <div class="flex flex-row items-center gap-2 h-full">
        <button class="min-w-[1rem] max-w-[10%] h-full md:min-w-[1.5rem]">
            <img src="serach.svg" alt="" class="w-full h-full">
        </button>
        <input onclick="showResults()" id="search-input" name="value" type="" class="min-w-max sm:max-w-full h-full self-start outline-none ring-0 border-none text-[#F9832A] placeholder:font-medium placeholder:text-[#F9832A] placeholder:md:text-lg" placeholder="Cari Menu">
        </div>
        {{-- Clear Button --}}
        <button id="clear-input" class="invisible font-bold group flex flex-row justify-center items-center text-[#F9832A] self-center rounded-lg w-5 h-5 mr-1">
            <svg class="fill-[#F9832A] group-hover:fill-[#F9832A]/80" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/>
            </svg>
        </button>
    </div>
    <div id="search-results" class="bg-white flex flex-col gap-3 items-start p-3 shadow-lg rounded-xl border h-auto w-full invisible opacity-0 transition-all duration-300 absolute z-50 top-[3rem] sm:min-w-[21vw]">
        <h1 class="font-bold">Hasil Pencarian</h1>
        <!-- Tempat untuk menampilkan hasil pencarian -->
    </div>
</div>
<div onclick="hideResults()" id="overlay-results" class="fixed bg-black/20 invisible transition-all duration-300 opacity-0 w-screen h-screen z-40 left-0 top-0"></div>
<script>
    $(document).ready(function() {
        $('#search-input').on('keyup', function() {
            var query = $(this).val();
            if (query != '') {
                $.ajax({
                    url: "{{ route('search') }}",
                    method: "GET",
                    data: {query: query},
                    success: function(data) {
                        var searchResults = '';
                        for (var i = 0; i < data.length; i++) {
                            searchResults += '<div class="flex flex-row justify-start rounded-lg border w-full p-3 border-black/30 items-center gap-3">' +
                                '<img src="{{ asset('ewewewewe.png') }}" alt="" class="w-14 h-14 rounded-full object-cover">' +
                                '<div class="flex flex-col">' +
                                '<h1 class="font-bold text-black">' + data[i].nama_makanan + '</h1>' +
                                '<p class="text-gray-400 text-s">Rp ' + new Intl.NumberFormat('id-ID', { style: 'decimal' }).format(data[i].harga) + '</p>' +
                                '<p class="text-gray-400">' + data[i].rating + '</p>' +
                                '</div></div>';
                        }
                        $('#search-results').html(searchResults);
                        $('#search-results').css('display', 'block');
                    }
                });
            } else {
                $('#search-results').css('display', 'none');
            }
        });
    });
</script>
