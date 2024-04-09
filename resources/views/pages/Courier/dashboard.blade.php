<x-courier-layout>
    {{-- Main content --}}
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-2">
                <h1 class="text-2xl font-bold text-[#F9832A]">Dashboard</h1>
                <p class="text-lg text-[#F9832A]">Selamat datang, {{ Auth::user()->nama_user ?? 'null' }}</p>
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <h1 class="text-xl font-bold text-[#F9832A]">Paket yang harus diantar</h1>
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
        {{-- push notification --}}
        <div id="notification" class="fixed top-0 left-0 w-full bg-blue-500 text-white px-4 py-2 mt-20 ">
            <p class="inline-block">Penerimaan order baru</p>
            <div id="info">
                {{--detail order--}}
                <p class="text-white">Nama Pengirim: Nama Pengirim (user)</p>
                <p class="text-white">Nama Umkm : Nama Umkm</p>
                <p class="text-white">Ongkir : Rp. xxx</p>
            </div>
            {{-- button terima dan tolak --}}
            <div id="action" class="flex flex-row gap-2">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                    Terima
                </button>
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                    Tolak
                </button>
            </div>
        </div>
        <x-floatingcshelp />
    </main>
    {{-- endMain content --}}
</x-courier-layout>
<script>
    // Fungsi untuk menampilkan notifikasi
    function showNotification() {
        document.getElementById('notification').classList.remove('hidden');
    }

    // Fungsi untuk menyembunyikan notifikasi
    function hideNotification() {
        document.getElementById('notification').classList.add('hidden');
    }

    // Event listener untuk tombol "Ambil" dan "Tidak"
    document.getElementById('accept').addEventListener('click', hideNotification);
    document.getElementById('reject').addEventListener('click', hideNotification);

    // Panggil fungsi showNotification ketika ada order baru
    // showNotification();
</script>
