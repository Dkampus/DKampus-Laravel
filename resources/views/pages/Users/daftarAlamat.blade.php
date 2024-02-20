@extends('layouts.Root')
@section('content')
    <header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10">
        {{-- Topbar --}}
        @include('components.header.topbar')
    </header>
    {{--    var temp alamat--}}
    <?php
        $alamats = [
            (object) ['id' => 1, 'alamat' => 'Jl. Raya Bogor'],
            (object) ['id' => 2, 'alamat' => 'Jl. Raya Jakarta'],
            (object) ['id' => 3, 'alamat' => 'Jl. Raya Depok'],
        ];
    ?>
    <main class="px-3 md:mx-14 md:mb-40">
        <h1>Daftar Alamat</h1>

        <!-- Tombol untuk menambah alamat -->
        <a href="/alamat/tambah" class="btn btn-primary">Tambah Alamat</a>

        <!-- Tabel untuk menampilkan daftar alamat -->
        <table class="table mt-3">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Alamat</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($alamats as $alamat)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $alamat->alamat }}</td>
                    <td>
                        <!-- Tombol untuk menghapus alamat -->
                        <form action="/alamat/{{ $alamat->id }}/hapus" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </main>
@endsection
