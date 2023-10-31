@extends('layouts.Login&Register')
@section('loginregister-content')
    {!! Form::open([
        'route' => 'login',
        'method' => 'POST',
        'class' => 'w-[27rem] h-[33rem] border-2 flex flex-col py-10 mx-auto my-10 rounded-2xl text-[#5E5E5E]',
    ]) !!}

    {{-- Title --}}
    <h1 class="font-semibold text-xl text-center mb-10 text-black">Masuk</h1>

    {{-- Inputs Box --}}
    <div id="inputs" class="flex flex-col gap-5">

        {{-- Email Input --}}
        {{-- <div class="flex flex-col gap-3 mx-auto w-96">
                <label for="email">Masukan Email Anda</label>
                <input id="email" type="text"
                    class="rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-[3.4rem] placeholder:text-[#5e5e5e]/50"
                    placeholder="email@gmail.com">
            </div> --}}

        {{-- Email Input Punya rama ini --}}
        <div class="flex flex-col gap-3 mx-auto w-96">
            <label for="email">Masukan Email Anda</label>
            {!! Form::email('email', '', [
                'class' =>
                    'rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-[3.4rem] placeholder:text-[#5e5e5e]/50',
                'placeholder' => 'email@gmail.com',
            ]) !!}
        </div>

        {{-- Password Input --}}
        {{-- <div class="flex flex-col gap-3 mx-auto w-96">
            <label for="sandi">Kata Sandi</label>
            <input id="sandi" type="password"
                class="rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-[3.4rem] placeholder:text-[#5e5e5e]/50 placeholder:"
                placeholder="********">
            <a href="/atur-ulang-kata-sandi" class="ml-auto text-[#F9832A] font-medium">Lupa kata sandi?</a>
        </div> --}}

        {{-- Password Input punya rama --}}
        <div class="flex flex-col gap-3 mx-auto w-96">
            <label for="sandi">Kata Sandi</label>
            {!! Form::password('password', [
                'class' =>
                    'rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-[3.4rem] placeholder:text-[#5e5e5e]/50 placeholder:',
                'placeholder' => '********',
            ]) !!}
            <a href="/atur-ulang-kata-sandi" class="ml-auto text-[#F9832A] font-medium">Lupa kata sandi?</a>
        </div>

        {{-- Submit & Daftar --}}
        <div id="submitAndDaftar" class="flex flex-col gap-3.5 mt-3 mx-auto w-96 items-center">
            {!! Form::submit('Masuk', [
                'class' => 'bg-[#F9832A] w-full h-[3.4rem] rounded-2xl text-white font-semibold text-lg',
                'onclick' => 'showModal()',
            ]) !!}
            <button class="bg-white border-2 border-[#F9832A] w-full h-[3.4rem] rounded-2xl text-[#F9832A] font-semibold text-lg">Daftar</button>
            {{-- <div class="flex flex-row items-center gap-1 ml-auto mt-3">
                <h2>Belum punya akun?</h2><a href="/daftar" class="text-[#F9832A]">Daftar</a>
            </div> --}}
        </div>

        {{-- Modal Jika Email belum terdaftar --}}
        {{-- <x-modals.modal>
            <h1 class="font-semibold">email@gmail.com</h1>
            <p class="text-[#5C5C5C]">Lanjutkan ke pendaftaran dengan email</p>
            <h1 class="font-semibold">email@gmail.com</h1>
            <div class="flex flex-row gap-2">
                <button class="bg-[#F9832A] w-28 h-9 rounded-lg text-white">Ya</button>
                <button onclick="hideModal()" class="bg-white border-2 w-28 h-9 rounded-lg text-[#F9832A] border-[#F9832A]">Salah</button>
            </div>
    </x-modals.modal> --}}
    </div>
    {!! Form::close() !!}
@endsection
