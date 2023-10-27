@extends('layouts.Root')
@section('content')

    <header class="relative">
        {{-- navbar --}}
        <nav id="navbar-detail-makanan" class="fixed transition-all duration-200 z-[60] py-3.5 w-full flex flex-row justify-between items-center px-6 mt-10 mb-5">

            {{-- Kembali --}}
            <a href="/detail-warung" class="font-semibold text-2xl h-12 w-12 bg-white flex flex-col justify-center items-center rounded-full">
                <svg height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 11.7746C20 12.1543 19.7178 12.4681 19.3518 12.5178L19.25 12.5246L6.066 12.524L10.829 17.2675C11.1225 17.5598 11.1235 18.0347 10.8313 18.3282C10.5656 18.595 10.149 18.6201 9.85489 18.4029L9.77061 18.3305L3.72061 12.3065C3.68192 12.2679 3.64832 12.2263 3.61979 12.1822C3.61174 12.169 3.60354 12.1554 3.59576 12.1416C3.58861 12.1297 3.58215 12.1174 3.57606 12.105C3.56759 12.0869 3.55932 12.0681 3.55181 12.0491C3.5457 12.0343 3.54061 12.02 3.53596 12.0056C3.53043 11.9877 3.52506 11.9686 3.52045 11.9493C3.51701 11.9358 3.51429 11.9227 3.51192 11.9097C3.50859 11.8903 3.50575 11.8701 3.50372 11.8498C3.50197 11.8343 3.50092 11.8189 3.50034 11.8035C3.50019 11.7942 3.5 11.7844 3.5 11.7746L3.50038 11.7455C3.50095 11.7308 3.50196 11.7161 3.50339 11.7014L3.5 11.7746C3.5 11.7273 3.50438 11.681 3.51277 11.6361C3.51471 11.6253 3.51703 11.6143 3.51959 11.6034C3.52492 11.5808 3.53108 11.5591 3.53817 11.5377C3.54165 11.5272 3.5457 11.5158 3.55003 11.5046C3.5588 11.482 3.56832 11.4605 3.5788 11.4396C3.58367 11.4297 3.58913 11.4194 3.59484 11.4092C3.60421 11.3925 3.61386 11.3767 3.62407 11.3613C3.63128 11.3504 3.63925 11.339 3.64758 11.3278L3.65407 11.3192C3.67428 11.2928 3.6962 11.2677 3.71967 11.2443L3.72057 11.2436L9.77057 5.21857C10.0641 4.92629 10.5389 4.92727 10.8312 5.22077C11.0969 5.48759 11.1203 5.9043 10.9018 6.19746L10.829 6.28143L6.068 11.024L19.25 11.0246C19.6642 11.0246 20 11.3604 20 11.7746Z" fill="#003049"/>
                </svg>                
            </a>

            {{-- Title --}}
            <h1 id="titleDetail" class="text-white font-semibold text-lg uppercase invisible">Paha Ayam</h1>

            {{-- Favorit --}}
            <label for="myCheckbox" id="myButton" class="w-12 h-12 bg-white flex flex-col justify-center items-center rounded-full">
                <svg id="myIcon" height="25" class="fill-[#5e5e5e] transition-all duration-300" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.08993 0.292134C6.66743 0.309697 7.2266 0.41053 7.76835 0.59478H7.82243C7.8591 0.612197 7.8866 0.631447 7.90493 0.648864C8.10752 0.713947 8.2991 0.78728 8.48243 0.888114L8.83077 1.04395C8.96827 1.11728 9.13327 1.25386 9.22493 1.30978C9.3166 1.36386 9.41743 1.41978 9.49993 1.48303C10.5183 0.70478 11.7549 0.283114 13.0291 0.292134C13.6075 0.292134 14.185 0.373864 14.7341 0.558114C18.1175 1.65811 19.3367 5.37061 18.3183 8.61561C17.7408 10.2739 16.7966 11.7873 15.56 13.0239C13.7899 14.738 11.8475 16.2597 9.7566 17.5705L9.52743 17.7089L9.2891 17.5614C7.19085 16.2597 5.23743 14.738 3.45085 13.0147C2.22252 11.7781 1.27743 10.2739 0.690767 8.61561C-0.345066 5.37061 0.874101 1.65811 4.29418 0.538864C4.56002 0.447197 4.8341 0.38303 5.1091 0.34728H5.2191C5.47668 0.309697 5.73243 0.292134 5.9891 0.292134H6.08993ZM14.2574 3.18895C13.8816 3.0597 13.4691 3.26228 13.3316 3.64728C13.2033 4.03228 13.4049 4.45395 13.7899 4.59053C14.3775 4.81053 14.7708 5.38895 14.7708 6.0297V6.05811C14.7533 6.26803 14.8166 6.47061 14.9449 6.62645C15.0733 6.78228 15.2658 6.87303 15.4674 6.89228C15.8433 6.8822 16.1641 6.58061 16.1916 6.1947V6.08561C16.2191 4.80136 15.4408 3.63811 14.2574 3.18895Z"/>
                </svg>
            </label>
            <input type="checkbox" id="myCheckbox" class="form-checkbox opacity-0 absolute invisible"/>

        </nav>

        {{-- header content --}}
        <div>
            {{-- Banner Food --}}
            <img src="pahaAyam.jpeg" alt="" class="w-full h-[30rem] object-cover">

            {{-- Gradient Image --}}
            <div class="bg-gradient-to-t from-black/70 to-transparent h-full w-full absolute z-50 top-0"></div>

            {{-- Description --}}
            <div id="desc" class="absolute z-50 bottom-0 text-white px-5 flex flex-col gap-3.5 py-5">
                <h1 class="text-4xl font-semibold">Paha Ayam</h1>

                {{-- Ratings, Time, & State Count --}}
                <div class="flex flex-row items-center justify-between gap-8">
                    {{-- Ratings --}}
                    <div id="Ratings" class="flex flex-row text-lg items-center gap-2">
                        <div id="averageRatings" class="flex flex-row items-center gap-2">
                            <svg height="20" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.55008 7.96476C9.3947 8.12328 9.32331 8.35253 9.3587 8.57735L9.89203 11.6845C9.93703 11.9479 9.83144 12.2144 9.62207 12.3666C9.4169 12.5245 9.14393 12.5434 8.92016 12.4171L6.26311 10.9582C6.17072 10.9065 6.06813 10.8787 5.96315 10.8755H5.80057C5.74417 10.8844 5.68898 10.9033 5.63859 10.9324L2.98094 12.3982C2.84955 12.4676 2.70077 12.4923 2.55499 12.4676C2.19984 12.3969 1.96287 12.0407 2.02106 11.6649L2.55499 8.55778C2.59039 8.33106 2.519 8.10054 2.36362 7.9395L0.1973 5.72912C0.0161234 5.54408 -0.0468684 5.26621 0.0359208 5.01549C0.11631 4.7654 0.321483 4.58288 0.569251 4.54184L3.55086 4.0865C3.77763 4.06187 3.97681 3.91661 4.07879 3.70189L5.39262 0.866291C5.42382 0.803138 5.46401 0.745036 5.51261 0.695776L5.5666 0.651569C5.59479 0.618729 5.62719 0.591573 5.66319 0.569469L5.72858 0.544208L5.83056 0.5H6.08313C6.3087 0.52463 6.50728 0.666726 6.61106 0.878922L7.94229 3.70189C8.03828 3.9084 8.22485 4.05176 8.44022 4.0865L11.4218 4.54184C11.6738 4.57973 11.8844 4.76287 11.9678 5.01549C12.0464 5.26873 11.9786 5.54661 11.7938 5.72912L9.55008 7.96476Z" fill="#Fff"/>
                            </svg>
                            <h3>4.7</h3>
                        </div>
                        <h3 id="countRatings">560 Rating</h3>
                    </div>
                    {{-- Time --}}
                    <div id="timeFinished" class="flex flex-row text-lg items-center gap-2">
                        <svg height="20" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.5 1.01562C5.4153 1.01563 4.35495 1.33728 3.45305 1.93991C2.55115 2.54254 1.8482 3.39908 1.4331 4.40122C1.018 5.40336 0.909392 6.50608 1.12101 7.56995C1.33262 8.63381 1.85496 9.61104 2.62196 10.378C3.38897 11.145 4.36619 11.6674 5.43005 11.879C6.49392 12.0906 7.59664 11.982 8.59878 11.5669C9.60092 11.1518 10.4575 10.4489 11.0601 9.54696C11.6627 8.64506 11.9844 7.58471 11.9844 6.5C11.9828 5.04595 11.4044 3.65191 10.3763 2.62374C9.34809 1.59557 7.95405 1.01724 6.5 1.01562ZM6.5 10.7656C5.65634 10.7656 4.83163 10.5155 4.13015 10.0467C3.42867 9.57802 2.88193 8.91183 2.55908 8.13238C2.23622 7.35294 2.15175 6.49527 2.31634 5.66782C2.48093 4.84037 2.88719 4.08031 3.48375 3.48375C4.08031 2.88719 4.84037 2.48093 5.66782 2.31634C6.49527 2.15175 7.35295 2.23622 8.13239 2.55908C8.91183 2.88193 9.57803 3.42867 10.0467 4.13015C10.5155 4.83162 10.7656 5.65634 10.7656 6.5C10.7644 7.63094 10.3146 8.71522 9.51492 9.51492C8.71522 10.3146 7.63095 10.7644 6.5 10.7656ZM9.95313 6.5C9.95313 6.66162 9.88893 6.81661 9.77465 6.93089C9.66037 7.04517 9.50537 7.10938 9.34375 7.10938H6.5C6.33839 7.10938 6.18339 7.04517 6.06911 6.93089C5.95483 6.81661 5.89063 6.66162 5.89063 6.5V3.65625C5.89063 3.49463 5.95483 3.33964 6.06911 3.22536C6.18339 3.11108 6.33839 3.04688 6.5 3.04688C6.66162 3.04688 6.81662 3.11108 6.9309 3.22536C7.04518 3.33964 7.10938 3.49463 7.10938 3.65625V5.89063H9.34375C9.50537 5.89063 9.66037 5.95483 9.77465 6.06911C9.88893 6.18339 9.95313 6.33838 9.95313 6.5Z" fill="#FFF"/>
                        </svg>
                        <h1>10min - 30min</h1>
                    </div>
                    {{-- State Count --}}
                    <div id="count" class="flex flex-row items-center bg-black/10 justify-around px-1 border-2 rounded-lg w-28 h-12">
                    <button id="decrement" class="text-3xl flex flex-col justify-center h-full font-bold text-gray-500">-</button>
                    <input id="number" type="number" class="font-semibold bg-transparent w-10 border-none text-center focus:border-none focus:ring-0" value="0" readonly/>
                    <button id="increment" class="text-xl flex flex-col justify-center h-full font-bold text-[#F9832A]">+</button>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <main>
    {{-- Harga --}}
    <div class="flex flex-row justify-between items-center mx-5 my-7">
        <h1 class="text-2xl font-semibold">Harga</h1>
        <h2 class="text-xl font-semibold text-[#F9832A]">Rp16.000</h2>
    </div>

    {{-- line --}}
    <div class="bg-[#D9D9D9] w-[31rem] mx-auto px-5 h-0.5"></div>

    {{-- deskripsi --}}
    <div class="mx-5 my-7 flex flex-col gap-2">
        <h1 class="text-2xl font-semibold">Deskripsi</h1>
        <p class="text-lg font-light">Potongan paha ayam dibalut dengan campuran tepung bumbu dan rempah-rempah segar, digoreng hingga kulitnya keemasan dan renyah Memadukan gurih dan daging paha ayam yang lembut.</p>
    </div>

    {{-- line --}}
    <div class="bg-[#D9D9D9] w-[31rem] mx-auto px-5 h-0.5"></div>

    {{-- Catatan --}}
    <div class="mx-5 my-7 flex flex-col gap-2">
        <h1 class="text-2xl font-semibold pb-3">Catatan</h1>
        <textarea class="rounded-xl border-2 border-gray-300 focus:border-gray-300 focus:ring-0" name="" id="" cols="30" rows="7" placeholder="Saran : Ayam nya yang paling besar, saos nya 10, Kriuk nya banyakin"></textarea>
        <button class="bg-[#F9832A] rounded-xl h-[3rem] font-semibold text-white text-lg">Pesan Sekarang</button>
    </div>

    {{-- Rekomendasi Menu --}}
    <div id="listRekomendasi" class="mx-5">
        <h1 class="font-semibold text-2xl my-5">Rekomendasi <span class="text-[#F9832A]">Menu</span> Lain</h1>
        <div class="grid grid-cols-2 relative gap-x-14 gap-y-5 mx-6 place-content-between place-items-center">
            @forelse ($CardFood as $Item)
                <div href="/detail-makanan" class="w-[14.5rem] relative mb-2 border rounded-2xl transition-all duration-300 overflow-hidden hover:shadow-md">
                    <img src="{{$Item['Img']}}" alt="" class="w-full">
                    <div id="desc" class="flex flex-col gap-2 py-2 px-3">
                        <div id="ratings" class="flex flex-row items-center gap-1">
                            <img src="Iconly/Bold/Star.svg" alt="">
                            <h2>{{$Item['Ratings']}}</h2>
                        </div>
                        <h1 class="font-semibold text-xl">{{$Item['Title']}}</h1>
                        <h2 class="font-medium">{{$Item['Price']}}</h2>
                        <div id="buttons" class="flex flex-row gap-2">
                            <button class="bg-[#F9832A] w-[80%] h-10 rounded-xl font-semibold text-white">Beli</button>
                            <div>
                                <label for="myCheckbox" id="myButton" class="w-12 h-12 bg-white flex flex-col justify-center items-center rounded-full">
                                    <svg id="myIcon" height="25" class="fill-[#5e5e5e] transition-all duration-300" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.08993 0.292134C6.66743 0.309697 7.2266 0.41053 7.76835 0.59478H7.82243C7.8591 0.612197 7.8866 0.631447 7.90493 0.648864C8.10752 0.713947 8.2991 0.78728 8.48243 0.888114L8.83077 1.04395C8.96827 1.11728 9.13327 1.25386 9.22493 1.30978C9.3166 1.36386 9.41743 1.41978 9.49993 1.48303C10.5183 0.70478 11.7549 0.283114 13.0291 0.292134C13.6075 0.292134 14.185 0.373864 14.7341 0.558114C18.1175 1.65811 19.3367 5.37061 18.3183 8.61561C17.7408 10.2739 16.7966 11.7873 15.56 13.0239C13.7899 14.738 11.8475 16.2597 9.7566 17.5705L9.52743 17.7089L9.2891 17.5614C7.19085 16.2597 5.23743 14.738 3.45085 13.0147C2.22252 11.7781 1.27743 10.2739 0.690767 8.61561C-0.345066 5.37061 0.874101 1.65811 4.29418 0.538864C4.56002 0.447197 4.8341 0.38303 5.1091 0.34728H5.2191C5.47668 0.309697 5.73243 0.292134 5.9891 0.292134H6.08993ZM14.2574 3.18895C13.8816 3.0597 13.4691 3.26228 13.3316 3.64728C13.2033 4.03228 13.4049 4.45395 13.7899 4.59053C14.3775 4.81053 14.7708 5.38895 14.7708 6.0297V6.05811C14.7533 6.26803 14.8166 6.47061 14.9449 6.62645C15.0733 6.78228 15.2658 6.87303 15.4674 6.89228C15.8433 6.8822 16.1641 6.58061 16.1916 6.1947V6.08561C16.2191 4.80136 15.4408 3.63811 14.2574 3.18895Z"/>
                                    </svg>
                                </label>
                                <input type="checkbox" id="myCheckbox" class="form-checkbox opacity-0"/>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                
            @endforelse
        </div>
    </div>
    </main>
@endsection