@extends('layouts.PesananLayout')
@section('pesananContent')
<div class="w-full h-screen flex flex-col items-center justify-center bg-white">

    <section id="warungIbuPagi" class="flex flex-col items-start">
        <div id="titleWarung" class="flex flex-row items-center mb-4">
            <div class="flex flex-row justify-start items-center gap-4 rounded-xl">
            <input type="checkbox" name="" id="checkboxCard" class="text-[#F9832A] border-2 rounded-md border-[#F9832A] w-8  h-8 transition-all duration-300 checked:fill-[#F9832A] checked:border-[#F9832A] checked:ring-[#F9832A] focus:fill-[#F9832A] focus:border-[#F9832A] focus:ring-[#F9832A]">
            <label for="warung" for="" class="flex flex-row gap-2 items-center">
                <img src="market.svg" alt="" class="w-10">
                <h1 class="text-xl font-semibold">Warung Ayam Baghdad</h1>
            </label>
            </div>
        </div>
        <div class="bg-[#5e5e5e]/40 w-full h-0.5"></div>
        <div id="cardList" class="flex flex-col items-start gap-y-7 mt-10">
            <div id="cardPesanan" class="flex flex-row items-center justify-start gap-4 rounded-xl">
                {{-- Favorite and Checkbox --}}
                <div id="favoriteAndCheckbox" class="flex flex-col gap-3 items-start mb-auto">
                    <input type="checkbox" name="" id="checkboxCard" class="text-[#F9832A] border-2 rounded-md border-[#F9832A] w-8 h-8 transition-all duration-300 checked:fill-[#F9832A] checked:border-[#F9832A] checked:ring-[#F9832A] focus:fill-[#F9832A] focus:border-[#F9832A] focus:ring-[#F9832A]">
                    <div id="like">
                        <label for="NavCheckbox" id="NavLikeButton" class="w-8 h-8 bg-white flex flex-col justify-center items-center border-2 border-[#5e5e5e]/40 rounded-md">
                            <svg id="NavLikeIcon" height="20" class="fill-[#5e5e5e]/60 transition-all duration-300" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.08993 0.292134C6.66743 0.309697 7.2266 0.41053 7.76835 0.59478H7.82243C7.8591 0.612197 7.8866 0.631447 7.90493 0.648864C8.10752 0.713947 8.2991 0.78728 8.48243 0.888114L8.83077 1.04395C8.96827 1.11728 9.13327 1.25386 9.22493 1.30978C9.3166 1.36386 9.41743 1.41978 9.49993 1.48303C10.5183 0.70478 11.7549 0.283114 13.0291 0.292134C13.6075 0.292134 14.185 0.373864 14.7341 0.558114C18.1175 1.65811 19.3367 5.37061 18.3183 8.61561C17.7408 10.2739 16.7966 11.7873 15.56 13.0239C13.7899 14.738 11.8475 16.2597 9.7566 17.5705L9.52743 17.7089L9.2891 17.5614C7.19085 16.2597 5.23743 14.738 3.45085 13.0147C2.22252 11.7781 1.27743 10.2739 0.690767 8.61561C-0.345066 5.37061 0.874101 1.65811 4.29418 0.538864C4.56002 0.447197 4.8341 0.38303 5.1091 0.34728H5.2191C5.47668 0.309697 5.73243 0.292134 5.9891 0.292134H6.08993ZM14.2574 3.18895C13.8816 3.0597 13.4691 3.26228 13.3316 3.64728C13.2033 4.03228 13.4049 4.45395 13.7899 4.59053C14.3775 4.81053 14.7708 5.38895 14.7708 6.0297V6.05811C14.7533 6.26803 14.8166 6.47061 14.9449 6.62645C15.0733 6.78228 15.2658 6.87303 15.4674 6.89228C15.8433 6.8822 16.1641 6.58061 16.1916 6.1947V6.08561C16.2191 4.80136 15.4408 3.63811 14.2574 3.18895Z"/>
                            </svg>
                        </label>
                        <input class="invisible absolute" type="checkbox" name="" id="like">
                    </div>
                </div>

                {{-- content card pesanan --}}
                <div id="contentPesanan" class="shadow-md w-[27rem] rounded-xl border">
                    <label for="checkboxCard" class="flex flex-row items-center">
                        <img src="pahaAyam.jpg" alt="" class="rounded-lg h-full">
                        <div id="desc" class="flex flex-row justify-between w-full">
                            <div class="flex flex-col justify-center gap-3 px-5">
                                <h1 class="font-semibold text-xl">Paha Ayam</h1>
                                <a href="" class="text-sm text-gray-500">Tambahkan catatan</a>
                                <h2 class="text-[#F9832A] font-semibold text-lg">Rp22.000</h2>
                            </div>
                            <div id="count" class="flex flex-col items-center bg-white shadow-lg justify-between mr-2 my-auto rounded-lg w-[2.5rem] h-full">
                                <button id="increment" class="bg-[#EEEEEE] rounded-xl scale-100 shadow-md flex w-[2.5rem] flex-col justify-center items-center h-[2.5rem] font-bold">
                                    <svg height="25" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.16809 3.24121V11.4823" stroke="#F9832A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3.40259 7.36157H10.9335" stroke="#F9832A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <input id="number" type="number" class="font-semibold bg-transparent w-[2.5rem] border-none text-center focus:border-none focus:ring-0" value="0" readonly/>
                                <button id="decrement" class="bg-[#EEEEEE] rounded-xl scale-100 shadow-md flex w-[2.5rem] flex-col justify-center items-center h-[2.5rem] font-bold">
                                    <svg height="25" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.53027 8H12.0151" stroke="#2B2B2B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection