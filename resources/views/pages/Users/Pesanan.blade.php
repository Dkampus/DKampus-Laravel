@extends('layouts.PesananLayout')
@section('pesananContent')
    <div class="flex flex-col gap-5 items-center justify-start bg-[#F0F3F8]">
        <section id="warungIbuPagi" class="flex flex-col bg-white w-full h-full py-10">
            <div id="contentCard" class="mx-auto">
                {{-- Title Warung --}}
                <div id="titleWarung" class="flex flex-row items-center mb-4">
                    <div class="flex flex-row justify-start items-center gap-4 rounded-xl">
                        <input type="checkbox" name="" id="checkboxWarung"
                            class="text-[#F9832A] border-2 rounded-md border-[#F9832A] w-8  h-8 transition-all duration-300 checked:fill-[#F9832A] checked:border-[#F9832A] checked:ring-[#F9832A] focus:fill-[#F9832A] focus:border-[#F9832A] focus:ring-[#F9832A]">
                        <label for="checkboxWarung" for="" class="flex flex-row gap-5 items-center">
                            <img src="{{ $carts->find(1)->menu->data_umkm->logo_umkm }}" alt="" class="w-24">
                            <h1 class="text-xl font-semibold">{{ $carts->first()->menu->data_umkm->nama_umkm }}</h1>
                        </label>
                    </div>
                </div>

                {{-- Line Card Pesanan --}}
                <div class="bg-[#5e5e5e]/40 w-[30rem] h-0.5"></div>

                {{-- Card List Pesanan --}}
                <div id="cardList" class="flex flex-col transition-all duration-300 items-start gap-y-7 mt-10">

                    @php $total_harga = 0; @endphp
                    @foreach ($carts as $c)
                        @php
                            $harga = number_format($c->menu->harga, 0, ',', '.');
                            $total_harga += $c->quantity * $c->menu->harga;
                        @endphp

                        <div id="cardPesanan{{ $c->id }}"
                            class="flex flex-row items-center justify-start gap-4 rounded-xl">
                            {{-- Favorite and Checkbox --}}
                            <div id="favoriteAndCheckbox" class="flex flex-col gap-3 items-start mb-auto">

                                <input type="checkbox" name="" id="checkboxMakanan"
                                    class="text-[#F9832A] border-2 rounded-md border-[#F9832A] w-8 h-8 transition-all duration-300 checked:fill-[#F9832A] checked:border-[#F9832A] checked:ring-[#F9832A] focus:fill-[#F9832A] focus:border-[#F9832A] focus:ring-[#F9832A]">

                                <div id="like">
                                    <label for="BtnLikeCheckbox" id="BtnLikeButton"
                                        class="w-8 h-8 bg-white flex flex-col justify-center items-center border-2 border-[#5e5e5e]/40 rounded-md">
                                        <svg height="20" id="BtnLikeIcon"
                                            class="fill-[#5e5e5e]/60 transition-all duration-300" viewBox="0 0 19 18"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.08993 0.292134C6.66743 0.309697 7.2266 0.41053 7.76835 0.59478H7.82243C7.8591 0.612197 7.8866 0.631447 7.90493 0.648864C8.10752 0.713947 8.2991 0.78728 8.48243 0.888114L8.83077 1.04395C8.96827 1.11728 9.13327 1.25386 9.22493 1.30978C9.3166 1.36386 9.41743 1.41978 9.49993 1.48303C10.5183 0.70478 11.7549 0.283114 13.0291 0.292134C13.6075 0.292134 14.185 0.373864 14.7341 0.558114C18.1175 1.65811 19.3367 5.37061 18.3183 8.61561C17.7408 10.2739 16.7966 11.7873 15.56 13.0239C13.7899 14.738 11.8475 16.2597 9.7566 17.5705L9.52743 17.7089L9.2891 17.5614C7.19085 16.2597 5.23743 14.738 3.45085 13.0147C2.22252 11.7781 1.27743 10.2739 0.690767 8.61561C-0.345066 5.37061 0.874101 1.65811 4.29418 0.538864C4.56002 0.447197 4.8341 0.38303 5.1091 0.34728H5.2191C5.47668 0.309697 5.73243 0.292134 5.9891 0.292134H6.08993ZM14.2574 3.18895C13.8816 3.0597 13.4691 3.26228 13.3316 3.64728C13.2033 4.03228 13.4049 4.45395 13.7899 4.59053C14.3775 4.81053 14.7708 5.38895 14.7708 6.0297V6.05811C14.7533 6.26803 14.8166 6.47061 14.9449 6.62645C15.0733 6.78228 15.2658 6.87303 15.4674 6.89228C15.8433 6.8822 16.1641 6.58061 16.1916 6.1947V6.08561C16.2191 4.80136 15.4408 3.63811 14.2574 3.18895Z" />
                                        </svg>
                                    </label>
                                    <input class="invisible absolute" type="checkbox" name=""
                                        id="BtnLikeCheckbox">
                                </div>

                            </div>

                            {{-- content card pesanan --}}
                            <form action="" method="POST">
                                <div id="contentPesanan{{ $c->id }}" class="shadow-md w-[27rem] rounded-xl border">
                                    <div for="checkboxMakanan" class="flex flex-row items-center">
                                        <div class="h-32 w-60">
                                            <img src="{{ $c->menu->image }}" alt=""
                                                class="rounded-lg h-full w-full object-cover">
                                        </div>
                                        {{-- <img src="{{$c->menu->image}}" alt="" class="rounded-lg h-max" width="100px"> --}}
                                        <div id="desc" class="flex flex-row justify-between w-full">
                                            <div class="flex flex-col justify-center gap-3 px-5">
                                                <h1 class="font-semibold text-xl">{{ $c->menu->nama_makanan }}</h1>
                                                <a href="" class="text-sm text-gray-500">Tambahkan catatan</a>
                                                <h2 class="text-[#F9832A] font-semibold text-lg">Rp{{ $harga }}
                                                </h2>
                                            </div>
                                            <div id="count"
                                                class="flex flex-col items-center bg-white shadow-lg justify-between mr-2 my-auto rounded-lg w-[2.5rem] h-full">
                                                <button id="increment" type="button"
                                                    class="bg-[#EEEEEE] transition-all duration-300 rounded-xl scale-100 shadow-md flex w-[2.5rem] flex-col justify-center items-center h-[2.5rem] font-bold">
                                                    <svg height="25" viewBox="0 0 14 15" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M7.16809 3.24121V11.4823" stroke="#F9832A" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M3.40259 7.36157H10.9335" stroke="#F9832A" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </button>
                                                <input id="number" type="number" name="items[quantity][]"
                                                    onchange="calculateTotal()"
                                                    class="font-semibold bg-transparent w-[2.5rem] border-none text-center focus:border-none focus:ring-0"
                                                    value="{{ $c->quantity }}" readonly />

                                                <button id="decrement" type="button"
                                                    class="bg-[#EEEEEE] transition-all duration-300 rounded-xl scale-100 shadow-md flex w-[2.5rem] flex-col justify-center items-center h-[2.5rem] font-bold">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3.53027 8H12.0151" stroke="#2B2B2B" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </button>



                                                <button onclick="DeleteItem()" id="delete"
                                                    class="hidden delete transition-all duration-300 bg-[#FF8080] rounded-xl scale-100 shadow-md w-[2.5rem] flex-col justify-center items-center h-[2.5rem] font-bold">
                                                    <svg height="23" viewBox="0 0 12 14" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M1.36136 12.1029C1.36136 12.4932 1.52167 12.8675 1.80702 13.1435C2.09236 13.4195 2.47938 13.5745 2.88292 13.5745H8.96914C9.37269 13.5745 9.7597 13.4195 10.045 13.1435C10.3304 12.8675 10.4907 12.4932 10.4907 12.1029V3.2731H1.36136V12.1029ZM2.88292 4.74473H8.96914V12.1029H2.88292V4.74473ZM8.58876 1.06565L7.82798 0.329834H4.02409L3.26331 1.06565H0.600586V2.53728H11.2515V1.06565H8.58876Z"
                                                            fill="#EEEEEE" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <input type="hidden" name="items[harga][]" value="{{ $c->menu->harga }}">
                        <input type="hidden" name="items[id][]" value="{{ $c->id }}">
                    @endforeach
                </div>
                </form>
                {{-- End Card List Pesanan --}}
            </div>
            {{-- End Title Warung --}}
        </section>
        {{-- <div class="bg-[#F0F3F8] w-full h-5"></div> --}}
    </div>

    <div id="overlayAddNewAddress" onclick="renderHideListAddress()"
        class="bg-black/10 transition-all duration-500 invisible opacity-0 -z-10 h-screen w-full absolute top-0 left-0">
    </div>

    <div id="addNewAddress"
        class="w-full pt-5 pb-14 flex flex-col items-center gap-5 border overflow-auto fixed h-0 bg-white rounded-3xl -bottom-96 transition-all duration-500 shadow-top-for-total-harga">
        @forelse ($AddressList as $Item)
            <div class="flex flex-row items-end gap-10 border-b-2 pb-2">
                <div class="flex flex-col gap-2">
                    <h1 class="font-semibold text-lg">{{ $Item['Title'] }}</h1>
                    <div id="location" class="flex flex-row gap-2 items-center">
                        <img src="markLocation.svg" alt="" class="w-5">
                        <h1 class="text-wrapper-location">{{ $Item['Alamat'] }}</h1>
                    </div>
                </div>
                <img src="edit.svg" alt="" class="w-5">
            </div>
        @empty
        @endforelse
    </div>

    <div id="totalAndAddress">
    <div id="content"
        class="fixed border-[2.5px] border-black/10 flex flex-row justify-around rounded-2xl h-48 pt-5 w-full left-0 bottom-0 bg-white shadow-top-for-total-harga">
        <button id="alamat" class="flex flex-row gap-3 items-center border-2 border-[#F9832A] p-3 h-12 rounded-lg">
            <img src="Map.svg" alt="" class="w-6">
            <div id="desc" class="flex flex-row gap-2 items-center">
                <h1 class="text-[#5e5e5e] font-medium">Masukkan alamat Anda</h1>
                <img src="ArrowTop.svg" alt="">
            </div>
        </button>

        @php $total_harga = number_format($total_harga,0,',','.'); @endphp
        <div id="totalHarga" class="flex flex-row gap-5">
            <div id="descTotalHarga" class="text-center">
                <h1>Total Harga</h1>
                <p id="total_harga" class=" font-semibold border-b-2 border-[#F9832A]">Rp{{ $total_harga }}</p>
            </div>
            <div id="buttonTotalHarga">
                <button class="bg-[#F9832A] h-10 w-24 text-white font-semibold rounded-xl">
                    Pesan
                </button>
            </div>
        </div>
    </div>
    </div>  
@endsection
