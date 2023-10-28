@extends('layouts.Login&Register')
@section('loginregister-content')
<div class="w-[27rem] h-[27rem] border-2 flex flex-col gap-5 py-10 mx-auto my-10 rounded-2xl text-[#5E5E5E]">
<img src="gmail.svg" alt="" class="w-14 mx-auto">
<div id="desc" class="flex flex-col items-center">
    <h1 class="font-bold text-2xl text-black">Masukkan kode verifikasi</h1>
    <p class="text-center">Kode verifikasi telah dikirim ke email
        <br>
        email@gmail.com </p>
</div>
<input id="verificationInput" oninput="validateNumbersOnly(this)" maxlength="6" type="text" class="text-center flex flex-row justify-center text-black tracking-[1rem] font-light text-5xl border-2 w-96 mx-auto border-t-0 border-x-0 border-b-orange-500 focus:border-x-0 focus:border-t-0 focus:border-b-2 focus:border-b-orange-500 focus:ring-0 mt-5">
<div id="timer" class="flex flex-col items-center visible transition-all duration-300">
    <h1>mohon tunggu dalam <span id="timerSeconds">30 </span> detik untuk kirim ulang</h1>
</div>
<a id="link" class="invisible">Kirim Ulang</a>
</div>
@endsection