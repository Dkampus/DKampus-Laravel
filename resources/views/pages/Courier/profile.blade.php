<x-courier-layout>
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-2">
                <h1 class="text-2xl font-bold text-[#F9832A]">Profile</h1>
                <p class="text-lg text-[#F9832A]">Selamat datang, {{ Auth::user()->nama_user ?? 'null' }}</p>
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <h1 class="text-xl font-bold text-[#F9832A]">Profile</h1>
                    <div class="flex flex-col gap-2">
                        <div class="flex flex-row gap-2">
                            <div class="flex flex-col gap-1">
                                <h1 class="text-lg font-bold text-[#F9832A]">Nama</h1>
                                <p class="text-lg text-[#F9832A]">{{ Auth::user()->nama_user ?? 'null' }}</p>
                            </div>
                            <div class="flex flex-col gap-1">
                                <h1 class="text-lg font-bold text-[#F9832A]">Email</h1>
                                <p class="text-lg text-[#F9832A]">{{ Auth::user()->email ?? 'null' }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h1 class="text-lg font-bold text-[#F9832A]">Nomor Telepon</h1>
                            <p class="text-lg text-[#F9832A]">{{ Auth::user()->no_telp ?? 'null' }}</p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h1 class="text-lg font-bold text-[#F9832A]">Alamat</h1>
                            <p class="text-lg text-[#F9832A]">{{ Auth::user()->alamat ?? 'null' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-courier-layout>
