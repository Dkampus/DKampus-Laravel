@extends('layouts.Root')
@section('content')
    <header class="flex flex-row items-center gap-2 mx-5 mt-10 mb-16">
        <img src="ArrowLeft.svg" alt="" class="scale-110">
        @if ($Title === 'Log in' || $Title === 'Register')
        <h1 class="text-lg font-semibold">{{$Title}}</h1>
        @endif
    </header>
    <main class="py-7 flex w-full flex-col items-center justify-center h-full relative z-50">
        @if ($Title === 'Log in' || $Title === 'Register')
        <div id="logo" class="flex w-full flex-col items-center justify-center gap-4">
            <img src="logoDkampus.svg" alt="" class="scale-150">
            <img src="titleDkampus.svg" alt="" class="scale-110">
        </div>
        @endif
        @yield('loginregister-content')
    </main>
@endsection