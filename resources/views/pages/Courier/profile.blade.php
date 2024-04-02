<x-courier-layout>
    <div class="flex flex-col gap-5 items-center justify-start bg-[#F0F3F8]">
        {{--PhotoProfile, Nama, email, no.tlp. Dan section pengaturan--}}
        <div class="profile-section text-center mt-2">
            <img class="w-32 h-32 rounded-full mx-auto" src="{{ asset('logoDkampus.png') }}" alt="">
            <h2 class="text-2xl font-bold">{{ Auth::user()->nama_user ?? 'null' }}</h2>
            <p class="text-lg">{{ Auth::user()->email ?? 'null' }}</p>
            <p class="text-lg">{{ Auth::user()->no_telp ?? 'null' }}</p>
        </div>
    </div>
    <div class="bg-[#F0F3F8] flex flex-col gap-2 justify-start">
        <h1 class="text-xl font-bold text-black mx-5 mt-10">Pengaturan Akun</h1>
        <div class="flex flex-col items-start justify-start mx-5">
            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-full text-center">
                Ubah Password
            </a>
        </div>
        <div class="flex flex-col items-start justify-start mx-5">
            <a href="#" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full w-full text-center">
                Keluar
            </a>
        </div>
    </div>
    <div class="bg-[#F0F3F8] flex flex-col gap-2 justify-start">
        <h1 class="text-xl font-bold text-black mx-5 mt-10">Seputar DKampus</h1>
        <div class="flex flex-col items-start justify-start mx-5">
            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-full text-center">
                Tentang Kami
            </a>
        </div>
        <div class="flex flex-col items-start justify-start mx-5">
            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-full text-center">
                Hubungi Kami
            </a>
        </div>
        <div class="flex flex-col items-start justify-start mx-5">
            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-full text-center">
                Syarat dan Ketentuan
            </a>
        </div>
    </div>
</x-courier-layout>
