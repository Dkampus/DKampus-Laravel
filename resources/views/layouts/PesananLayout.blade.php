@extends('layouts.Root')
@section('content')
<header class="w-full bg-white mb-2 shadow-lg flex flex-row gap-5 justify-center">
    <nav class="flex flex-row gap-5 w-full px-5 mt-10 mb-5">
        <a href="/pesanan" class="transition-all py-2 font-semibold rounded-2xl w-[50%] flex flex-col items-center text-center text-lg duration-300 {{$NavPesanan === 'Pesanan' ? 'bg-[#F9832A] text-white border-2 border-[#F9832A]' : 'bg-white border-2 border-[#F9832A] text-[#F9832A]'}}">
        Pesanan
        </a>
        <a href="/pesanan/proses" class="transition-all py-2 font-semibold rounded-2xl w-[50%] flex flex-col items-center text-center text-lg duration-300 {{$NavPesanan === 'Proses' ? 'bg-[#F9832A] text-white border-2 border-[#F9832A]' : 'bg-white border-2 border-[#F9832A] text-[#F9832A]'}}">Proses</a>
    </nav>
</header>
<main class="pb-44">
@yield('pesananContent')
</main>
@endsection