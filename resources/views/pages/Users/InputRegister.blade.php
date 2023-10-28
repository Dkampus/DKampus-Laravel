@extends('layouts.Login&Register')
@section('loginregister-content')
<form id="inputs" class="w-[27rem] h-full border-2 flex gap-5 flex-col py-10 mx-auto rounded-2xl text-[#5E5E5E]">
    <div class="flex flex-col gap-2 justify-center items-center">
        <h1 class="font-semibold text-2xl text-black">Daftar dengan Email</h1>
        <h2>email@gmail.com</h2>
    </div>
    <div class="flex flex-col gap-3 mx-auto w-96 h-[5.8rem]">
        <label for="email">Nama Lengkap</label>
        <input id="email" type="text" class="rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-full placeholder:text-[#5e5e5e]/50" placeholder="Awan Maulana">
    </div>
    <div class="flex flex-col gap-3 mx-auto w-96 h-[5.8rem] relative">
        <label for="sandi">Kata Sandi</label>
        <input id="sandi" type="password" class="rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-full  placeholder:text-[#5e5e5e]/50" placeholder="********">
        <button id="showSandi" class="absolute transition-all duration-300 cursor-pointer bottom-[1.15rem] right-5">
        </button>
    </div>
    <div class="flex flex-col gap-3 mx-auto w-96 h-[5.8rem] relative">
        <label for="confrimSandi">Konfirmasi Kata Sandi</label>
        <input id="confrimSandi" type="password" class="rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-full placeholder:text-[#5e5e5e]/50" placeholder="********">
        <button id="showSandiConfirm" class="absolute bottom-[1.15rem] right-5">
        <svg xmlns="http://www.w3.org/2000/svg" height="1.3em" class="fill-[#5e5e5e]" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
        </button>
    </div>
    <div id="submitAndDaftar" class="flex flex-col gap-2 mt-3 mx-auto w-96 items-center">
        <button class="bg-[#F9832A] w-full h-[3.4rem] rounded-2xl text-white font-semibold text-lg">Selesai</button>
    </div>
    <a href="" class="text-center mt-7">
        Dengan mendaftar, saya menyetujui
        <br>
        <span class="text-[#F9832A]">Syarat dan Ketentuan</span> serta <span class="text-[#F9832A]">Kebijakan Privasi</span>
    </a>
</form>
@endsection