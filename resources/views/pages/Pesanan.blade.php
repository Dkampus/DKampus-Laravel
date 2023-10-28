@extends('layouts.PesananLayout')
@section('pesananContent')
<div class="w-full h-screen flex flex-col items-center justify-center bg-white">

    <section id="warungIbuPagi">
        <div id="cardList" class="flex flex-col gap-7">
        <div id="cardPesanan" class="flex flex-row mx-auto gap-2 rounded-xl">
            {{-- Favorite and Checkbox --}}
            <div id="favoriteAndCheckbox" class="flex flex-col pt-2 mb-auto">
                <input type="checkbox" name="" id="checkboxCard" class="checked:fill-[#F9832A] checked:border-[#F9832A] checked:ring-[#F9832A]">
                <div id="like">
                    <label for="like"></label>
                    <input type="checkbox" name="" id="like">
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
        <div id="cardPesanan" class="flex flex-row mx-auto gap-2 rounded-xl">
            <div id="favoriteAndCheckbox" class="flex flex-col mb-auto">
                <input type="checkbox" name="" id="checkboxCard">
                <div id="like">
                    <label for="like"></label>
                    <input type="checkbox" name="" id="like">
                </div>
            </div>
            <div id="contentPesanan" class="shadow-md w-[27rem] rounded-xl border">
                <label for="checkboxCard" class="flex flex-row items-center">
                    <img src="pahaAyam.jpg" alt="" class="rounded-lg">
                    <div id="desc" class="flex flex-row justify-between w-full">
                        <div class="flex flex-col gap-3 justify-center px-5">
                            <h1 class="font-semibold text-xl">Paha Ayam</h1>
                            <a href="" class="text-sm text-gray-500">Tambahkan catatan</a>
                            <h2 class="text-[#F9832A] font-semibold text-lg">Rp22.000</h2>
                        </div>
                        <div id="count" class="flex flex-col items-center bg-white justify-center py-2 mr-2 border-2 rounded-lg w-16 h-full">
                            <button id="decrement" class="flex flex-col justify-center h-full font-bold text-gray-500">-</button>
                            <input id="number" type="number" class="font-semibold bg-transparent w-10 border-none text-center focus:border-none focus:ring-0" value="0" readonly/>
                            <button id="increment" class="flex flex-col justify-center h-full font-bold text-[#F9832A]">+</button>
                        </div>
                    </div>
                </label>
            </div>
        </div>
        <div id="cardPesanan" class="flex flex-row mx-auto gap-2 rounded-xl">
            <div id="favoriteAndCheckbox" class="flex flex-col mb-auto">
                <input type="checkbox" name="" id="checkboxCard">
                <div id="like">
                    <label for="like"></label>
                    <input type="checkbox" name="" id="like">
                </div>
            </div>
            <div id="contentPesanan" class="shadow-md w-[27rem] rounded-xl border">
                <label for="checkboxCard" class="flex flex-row items-center">
                    <img src="pahaAyam.jpg" alt="" class="rounded-lg h-full">
                    <div id="desc" class="flex flex-row justify-between w-full">
                        <div class="flex flex-col gap-3 justify-center px-5">
                            <h1 class="font-semibold text-xl">Paha Ayam</h1>
                            <a href="" class="text-sm text-gray-500">Tambahkan catatan</a>
                            <h2 class="text-[#F9832A] font-semibold text-lg">Rp22.000</h2>
                        </div>
                        <div id="count" class="flex flex-col items-center bg-white shadow-lg justify-center mr-2 border-2 rounded-lg w-16 h-full">
                            <button id="decrement" class="flex flex-col justify-center h-full font-bold text-gray-500">-</button>
                            <input id="number" type="number" class="font-semibold bg-transparent w-10 border-none text-center focus:border-none focus:ring-0" value="0" readonly/>
                            <button id="increment" class="flex flex-col justify-center h-full font-bold text-[#F9832A]">+</button>
                        </div>
                    </div>
                </label>
            </div>
        </div>
        </div>
    </section>
</div>
@endsection