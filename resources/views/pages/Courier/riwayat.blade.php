<x-courier-layout>
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-2">
                <h1 class="text-2xl font-bold text-[#F9832A]">Riwayat</h1>
                <p class="text-lg text-[#F9832A]">Selamat datang, {{ Auth::user()->nama_user ?? 'null' }}</p>
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <h1 class="text-xl font-bold text-[#F9832A]">Paket yang sudah diantar</h1>
                    <div class="flex flex-col gap-2">
                        <div class="flex flex-row gap-2">
                            <div class="flex flex-col gap-1">
                                <h1 class="text-lg font-bold text-[#F9832A]">Nama Pengirim</h1>
                                <p class="text-lg text-[#F9832A]">Nama Pengirim</p>
                            </div>
                            <div class="flex flex-col gap-1">
                                <h1 class="text-lg font-bold text-[#F9832A]">Nama Penerima</h1>
                                <p class="text-lg text-[#F9832A]">Nama Penerima</p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h1 class="text-lg font-bold text-[#F9832A]">Alamat Pengirim</h1>
                            <p class="text-lg text-[#F9832A]">Alamat Pengirim</p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h1 class="text-lg font-bold text-[#F9832A]">Alamat Penerima</h1>
                            <p class="text-lg text-[#F9832A]">Alamat Penerima</p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h1 class="text-lg font-bold text-[#F9832A]">Nomor Telepon Pengirim</h1>
                            <p class="text-lg text-[#F9832A]">Nomor Telepon Pengirim</p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h1 class="text-lg font-bold text-[#F9832A]">Nomor Telepon Penerima</h1>
                            <p class="text-lg text-[#F9832A]">Nomor Telepon Penerima</p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h1 class="text-lg font-bold text-[#F9832A]">Deskripsi Paket</h1>
                            <p class="text-lg text-[#F9832A]">Deskripsi Paket</p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h1 class="text-lg font-bold text-[#F9832A]">Status Paket</h1>
                            <p class="text-lg text-[#F9832A]">Status Paket</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-courier-layout>
