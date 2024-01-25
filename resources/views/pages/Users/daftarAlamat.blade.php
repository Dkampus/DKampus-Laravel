{{--//layout yg mana dah !??!?!?!?!--}}
@extends('layouts.root')
@section('content')
    <h1>Daftar Alamat</h1>

    @foreach ($alamat as $a)
        <div>
            <h2>{{ $a->nama_alamat }}</h2>
            <p>{{ $a->detail_alamat }}</p>
            <a href="/alamat/{{ $a->id }}/edit">Ubah</a>
            <form method="POST" action="/alamat/{{ $a->id }}">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </div>
    @endforeach
@endsection
