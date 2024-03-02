@extends('layouts.Root')
@section('content')
    <?php
        // Temporary data
    $alamatUser = [
        [
            'Title' => 'FIT',
            'Alamat' => 'No., Jl. Sukapura No.20, Sukapura, Kec. Dayeuhkolot Kabupaten Badung'
        ],
        [
            'Title' => 'Rumah',
            'Alamat' => 'Kawasan pendidikan Telkom University Gg.Babakan Ciamis 3'
        ],
        [
            'Title' => 'Kost PGA',
            'Alamat' => 'Kawasan pendidikan Telkom University Gg.PGA, Desa Lengkong'
        ],
        [
            'Title' => 'FIT',
            'Alamat' => 'No., Jl. Sukapura No.20, Sukapura, Kec. Dayeuhkolot Kabupaten Badung'
        ],
        [
            'Title' => 'Rumah',
            'Alamat' => 'Kawasan pendidikan Telkom University Gg.Babakan Ciamis 3'
        ],
        [
            'Title' => 'Kost PGA',
            'Alamat' => 'Kawasan pendidikan Telkom University Gg.PGA, Desa Lengkong'
        ],
    ];
    ?>
    <header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-8">
        <a href="{{'/'}}" class="absolute top-5 left-5 flex items-center gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z"/>
            </svg>
            <h1 class="font-bold text-black text-2xl">Daftar Alamat</h1>
        </a>
        <div class="absolute top-3 right-5">
            <a href="{{'/tambahAlamat'}}" class="flex items-center gap-x-2 bg-orange-500 text-white px-3 py-2 rounded-md shadow-md">
                <h1 class="font-bold text-white text-md">Tambah Alamat</h1>
            </a>
        </div>
    </header>
    <main class="flex flex-col w-full h-full">
        @foreach($alamatUser as $alamat)
            <div class="flex flex-col w-full h-auto px-1 py-3">
                <div class="flex flex-col w-full h-auto bg-white rounded-md shadow-md p-5">
                    <h1 class="font-bold text-black text-l">{{$alamat['Title']}}</h1>
                    <p class="font-normal text-black text-md">{{$alamat['Alamat']}}</p>
                </div>
            </div>
        @endforeach
    </main>
@endsection
