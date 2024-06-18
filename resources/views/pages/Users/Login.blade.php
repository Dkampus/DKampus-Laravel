@extends('layouts.Login&Register')
@section('loginregister-content')
    {!! Form::open([
    'route' => 'login',
    'method' => 'POST',
    'class' => 'w-[27rem] sm:w-[27rem] h-[33rem] border-2 flex flex-col py-10 mx-auto my-10 rounded-2xl text-[#5E5E5E]',
    ]) !!}

    {{-- Title --}}
    <h1 class="font-semibold text-xl text-center mb-10 text-black">Masuk</h1>

    {{-- Inputs Box --}}
    <div id="inputs" class="flex flex-col gap-5 mx-5">

        {{-- Email Input --}}
        <div class="flex flex-col gap-3 mx-auto w-full sm:w-96">
            <label for="email">Masukan Email Anda</label>
            {!! Form::email('email', '', [
            'class' =>
            'rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-[3.4rem] placeholder:text-[#5e5e5e]/50',
            'placeholder' => 'email@gmail.com',
            ]) !!}
        </div>

        {{-- Password Input --}}
        <div class="flex flex-col gap-3 mx-auto w-full sm:w-96">
            <label for="sandi">Kata Sandi</label>
            {!! Form::password('password', [
            'class' =>
            'rounded-2xl border-2 transition-all duration-100 border-[#5e5e5e]/30 focus:border-[#F9832A] focus:ring-[#F9832A] w-full h-[3.4rem] placeholder:text-[#5e5e5e]/50 placeholder:',
            'placeholder' => '********',
            ]) !!}
            <a href="/atur-ulang-kata-sandi" class="ml-auto text-[#F9832A] font-medium">Lupa kata sandi?</a>
        </div>

        {{-- Submit & Daftar --}}
        <div id="submitAndDaftar" class="flex flex-col gap-3.5 mt-3 mx-auto w-full sm:w-96 items-center">
            <button type="submit" class="bg-[#F9832A] w-full h-[3.4rem] rounded-2xl text-white font-semibold text-lg">Masuk</button>
            <button type="button" onclick="window.location.href='{{ route('register') }}'" class="bg-white border-2 border-[#F9832A] w-full flex justify-center items-center h-[3.4rem] rounded-2xl text-[#F9832A] font-semibold text-lg">Daftar</button>
        </div>
        {{-- Modal salah email atau password --}}
        @if (session('error'))
            <div id="modal_confirm_email" class="flex flex-col absolute visible opacity-100 transition-all z-99 rounded-xl justify-center gap-3 py-5 items-center scale-100 mx-auto border w-full sm:w-[26.8rem] h-[9rem] bg-white">
                <p>{{ session('error') }}</p>
                <button onclick="hideModal(event)" class="bg-[#F9832A] w-24 h-10 rounded-2xl text-white font-semibold text-lg">Oke</button>
            </div>
        @endif
        @if($errors->any())
            <div id="modal_confirm_email" class="flex flex-col absolute visible opacity-100 transition-all z-99 rounded-xl justify-center gap-3 py-5 items-center scale-100 mx-auto border w-full sm:w-[26.8rem] h-[9rem] bg-white">
                <p>{{ $errors->first() }}</p>
                <button onclick="hideModal(event)" class="bg-[#F9832A] w-24 h-10 rounded-2xl text-white font-semibold text-lg">Oke</button>
            </div>
        @endif
    </div>
    {!! Form::close() !!}
@endsection
