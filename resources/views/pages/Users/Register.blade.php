@extends('layouts.Login&Register')
@section('loginregister-content')
    <form id="formRegister" action="{{ route('register') }}" method="POST" class="w-[27rem] sm:w-[27rem] h-[40rem] border-2 flex flex-col py-5 mx-auto my-10 rounded-2xl text-[#5E5E5E]">
        @csrf
        {{-- Title --}}
        <h1 class="font-semibold text-xl text-center mb-10 text-black">Daftar <span class="text-[#F9832A]">Sekarang</span>
        </h1>

        {{-- Inputs --}}
        <div id="inputs" class="flex flex-col gap-5 mx-5">

            {{-- Nama Input --}}
            <div class="flex flex-col gap-3 mx-auto w-full sm:w-96">
                <label for="nama">Nama Anda</label>
                <input id="nama" type="text" name="nama" class="rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-[3.4rem] placeholder:text-[#5e5e5e]/50" placeholder="Nama Lengkap">
            </div>

            {{-- Email Input --}}
            <div class="flex flex-col gap-3 mx-auto w-full sm:w-96">
                <label for="email">Email Anda</label>
                <input id="email" type="text" name="email" class="rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-[3.4rem] placeholder:text-[#5e5e5e]/50" placeholder="email@gmail.com">
                {{-- <p>Contoh : email@gmail.com</p> --}}
            </div>

            {{-- Phone Number Input --}}
            <div class="flex flex-col gap-3 mx-auto w-full sm:w-96">
                <label for="no_telp">Nomor Telepon Anda</label>
                <input id="no_telp" type="text" name="no_telp" class="rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-[3.4rem] placeholder:text-[#5e5e5e]/50" placeholder="08xxxxxxxxxx">
            </div>

            {{-- Password Input --}}
            <div class="flex flex-col gap-3 mx-auto w-full sm:w-96">
                <label for="password">Password Anda</label>
                <input id="password" type="password" name="password" class="rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-[3.4rem] placeholder:text-[#5e5e5e]/50" placeholder="**********">
            </div>

            {{-- Password_confirmation Input --}}
            <div class="flex flex-col gap-3 mx-auto w-full sm:w-96">
                <label for="password_confirmation">Password Confirmation Anda</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-[3.4rem] placeholder:text-[#5e5e5e]/50" placeholder="**********">
            </div>
        </div>


        {{-- Daftar & Masuk --}}
        <div id="daftarAndMasuk" class="flex flex-col gap-2 mt-10 mb-2 mx-auto w-full sm:w-96 items-center">
            <button id="daftar" onclick="showModal()" type="button" class="bg-[#F9832A] w-full h-[3.4rem] rounded-2xl text-white font-semibold text-lg">Daftar</button>
            <div class="flex flex-row items-center gap-1 ml-auto mt-3">
                <h2>Sudah mempunyai akun?</h2><a href="/masuk" class="text-[#F9832A]">Masuk</a>
            </div>
        </div>

        {{-- Persyaratan dan Kebijakan Privasi --}}
        <a href="" class="text-center mt-7">
            Dengan mendaftar, saya menyetujui
            <br>
            <span class="text-[#F9832A]">Syarat dan Ketentuan</span> serta <span class="text-[#F9832A]">Kebijakan
            Privasi</span>
        </a>
    </form>

    {{-- Modal email Confirmation --}}
    <x-modals.modal>
        <h1 class="font-semibold" id="validation_email"></h1>
        <p class="text-[#5C5C5C]">Apakah email anda sudah benar?</p>
        <div class="flex flex-row gap-2">
            <button id="submit_btn" class="bg-[#F9832A] w-28 h-9 rounded-lg text-white">Ya</button>
            <button onclick="hideModal()" class="bg-white border-2 w-28 h-9 rounded-lg text-[#F9832A] border-[#F9832A]">Salah</button>
        </div>
    </x-modals.modal>

    {{-- Modal Information Error --}}
    <div id="modal_error_msg" class="flex flex-col absolute opacity-0 transition-all z-0 rounded-xl justify-center gap-3 py-5 items-center scale-0 mx-auto border w-full sm:w-[26.8rem] h-[9rem] bg-white">
        <p id="errorMsg"></p>
        <button onclick="hideErrorModal()" class="bg-[#F9832A] w-28 h-9 rounded-lg text-white">Tutup</button>
    </div>
    @if (session('error'))
        <script>
            window.onload = function() {
                showErrorModal("{{ session('error') }}");
            }
        </script>
    @endif
@endsection
