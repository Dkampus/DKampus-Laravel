@guest
    <a href="/masuk"
    class="text-white w-full h-[2.5rem] rounded-lg text-center px-3 bg-[#F9832A] flex items-center justify-center font-semibold text-base md:w-[5vw]">
    Masuk
    </a>
    <a href="/masuk"
    class="text-[#F9832A] border-2 border-[#F9832A] w-full h-[2.5rem] rounded-lg text-center px-3 bg-[#fff] flex items-center justify-center font-semibold text-base md:w-[5vw]">
    Daftar
    </a>
@endguest

@auth
<button onclick="showMenu()" class="relative z-[30]">
    <img src="menu.svg" alt="" class="w-8">
</button>
@endauth
{{-- <button onclick="showMenu()" class="relative z-[30]">
    <img src="menu.svg" alt="" class="w-8">
</button> --}}

<div id="bar-menu"
    class="h-screen invisible bg-white shadow-xl overflow-auto transition-all duration-500 absolute w-0 top-0 right-0 z-[70]">
    {{-- @guest
            <a href="/masuk"
                class="bg-[#F9832A] w-40 h-[3.4rem] rounded-2xl text-center text-white flex items-center justify-center font-semibold text-lg">Masuk</a>
        @endguest
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="bg-[#F9832A] w-40 h-[3.4rem] rounded-2xl text-center text-white flex items-center justify-center font-semibold text-lg">Keluar</button>
            </form>
        @endauth --}}
    <header class="flex flex-row absolute top-8 right-5 gap-10 justify-end items-center w-full">
        <h1 class="text-xl font-semibold">Menu Utama</h1>
        <button onclick="hideMenu()" class="font-bold text-xl text-[#FF9240]">
            <svg xmlns="http://www.w3.org/2000/svg" class="fill-[#FF9240]" height="1.5em"
                viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path
                    d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
            </svg>
        </button>
    </header>

    <main class="mt-24 w-full">

        <div id="profile"
            class="relative shadow-md w-[22rem] h-28 flex flex-row items-start border rounded-lg mx-auto px-3 pt-5">
            <button>
                <img src="Avatar/Large.svg" alt="" class="w-[4.5rem]">
            </button>
            <div id="infoPengguna" class="my-0.5 flex flex-col gap-0.5 mx-2">
                <h1 class="font-bold text-lg">{{ Auth::user()->nama_user ?? 'Saha Ieu' }}</h1>
                <div id="location" class="flex flex-row gap-1 items-center">
                    <img src="markLocation.svg" alt="" class="w-4">
                    <h1 class="text-wrapper-location-profile">{{ Auth::user()->alamat ?? 'Tebak dimana hayoo' }}</h1>
                </div>
            </div>
            <a href="/settings">
                <img src="settings.svg" alt="" class="absolute right-3 top-3 w-5">
            </a>
        </div>

        <div id="pengaturanAkun" class="flex flex-col gap-7 w-[21rem] mx-auto mt-10">
            <h1 class="font-bold text-xl border-b-4 border-[#F9832A] pb-1 w-max">Pengaturan Akun</h1>
            <div class="flex flex-col gap-7 items-center">
                @foreach ($PengaturanAkun as $Item)
                    <a href="{{ $Item['Url'] }}" id="itemPengaturanAkun" class="flex flex-row gap-3 items-center">
                        <img src="{{ $Item['Icon'] }}" alt="" class="w-5">
                        <div class="flex flex-col gap-1">
                            <h1 class="font-semibold">{{ $Item['Title'] }}</h1>
                            <p class="text-sm w-72">{{ $Item['Desc'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div id="seputarDkampus" class="flex flex-col gap-7 w-[21rem] mx-auto mt-10">
            <h1 class="font-bold text-xl border-b-4 border-[#F9832A] pb-1 w-max">Seputar Dkampus</h1>
            <div class="flex flex-col gap-7 items-center">
                @foreach ($SeputarDkampus as $Item)
                    <a href="{{ $Item['Url'] }}" id="itemPengaturanAkun" class="flex flex-row gap-3 items-center">
                        <img src="{{ $Item['Icon'] }}" alt="" class="w-5">
                        <div class="flex flex-col gap-1">
                            <h1 class="font-semibold">{{ $Item['Title'] }}</h1>
                            <p class="text-sm w-72">{{ $Item['Desc'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

    </main>

    <footer class="flex flex-row gap-10 mt-10 mb-5 px-3 justify-between w-[22rem] mx-auto items-center">
        <div id="copyright" class="flex flex-row items-center">
            <img src="copyright.svg" alt="" class="w-4">
            <h1>Copyright Dkampus 2042</h1>
        </div>
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button onclick="" class="flex flex-row items-center border-b-2 border-[#FE8787]">
                    <img src="logOut.svg" alt="">
                    <h1 class="text-[#FE8787] font-semibold text-lg">Keluar</h1>
                </button>
            </form>
        @endauth
    </footer>

</div>
<div onclick="hideMenu()" id="overlay-menu"
    class="absolute bg-black/20 invisible transition-all duration-500 opacity-0 w-full h-screen z-[60] top-0 left-0">
</div>
