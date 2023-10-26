@extends('layouts.Login&Register')
@section('loginregister-content')
<form id="inputs" class="w-[27rem] h-[40rem] border-2 flex gap-5 flex-col py-10 mx-auto rounded-2xl text-[#5E5E5E]">
    <div class="flex flex-col gap-2 justify-center items-center">
        <h1 class="font-semibold text-2xl text-black">Daftar dengan Email</h1>
        <h2>email@gmail.com</h2>
    </div>
    <div class="flex flex-col gap-3 mx-auto w-96">
        <label for="email">Nama Lengkap</label>
        <input id="email" type="text" class="rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-[3.4rem] placeholder:text-[#5e5e5e]/50" placeholder="Awan Maulana">
    </div>
    <div class="flex flex-col gap-3 mx-auto w-96">
        <label for="sandi">Kata Sandi</label>
        <input id="sandi" type="password" class="rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-[3.4rem] placeholder:text-[#5e5e5e]/50 placeholder:" placeholder="********">
    </div>
    <div class="flex flex-col gap-3 mx-auto w-96">
        <label for="sandi">Konfirmasi Kata Sandi</label>
        <input id="sandi" type="password" class="rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-[3.4rem] placeholder:text-[#5e5e5e]/50 placeholder:" placeholder="********">
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