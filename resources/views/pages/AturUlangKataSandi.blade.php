@extends('layouts.Login&Register')
@section('loginregister-content')
<form action="" class="w-[27rem] h-[27rem] border-2 flex flex-col items-center justify-center gap-5 px-20 mx-auto my-10 rounded-2xl text-[#5E5E5E]">
    <div id="content" class="flex flex-col gap-10">
    <div id="title" class="flex flex-col gap-2">
        <h1 class="text-black text-2xl font-semibold">Atur ulang kata sandi</h1>
        <p class="w-[90%] text-lg">Masukkan email yang terdaftar. Kami akan mengirimkan kode verifikasi untuk mengatur ulang kata sandi Anda.</p>
    </div>
    <div id="input" class="flex flex-col w-96 h-[3.5rem] gap-2">
        <label for="" class="font-semibold">Nama Lengkap</label>
        <input type="text" class="rounded-2xl border-2 border-[#5e5e5e]/50 w-full h-full py-3.5 focus:border-[#F9832A] focus:ring-[#F9832A] focus:border-2">
    </div>
    <div id="submitAndDaftar" class="flex flex-col mx-auto w-96 items-center">
        <button class="bg-[#F9832A] w-full h-[3.4rem] rounded-2xl text-white font-semibold text-lg">Selesai</button>
    </div>
    </div>
</form>
@endsection