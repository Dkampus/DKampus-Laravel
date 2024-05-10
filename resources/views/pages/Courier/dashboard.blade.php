<x-courier-layout>
    {{-- Main content --}}
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-2">
                <h1 class="text-2xl font-bold text-[#F9832A]">Dashboard</h1>
                <p class="text-lg text-[#F9832A]">Selamat datang, {{ $cour_name }}</p>
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <h1 class="text-xl font-bold text-[#F9832A]">Pesanan yang harus diantar</h1>
                    <div class="flex flex-col gap-2">
                        @if ($orders != null)
                        <?php $i = 0; ?>
                        @foreach ($orders as $order => $item)
                        <div class="flex flex-col gap-2 border border-[#F9832A] p-2">
                            <p class="text-lg font-bold text-[#F9832A]">Nama Umkm: {{ $item['nama_umkm'] }}</p>
                            <p class="text-lg font-bold text-[#F9832A]">Alamat Umkm: </p>
                            <p class="text-lg font-bold text-[#F9832A]">Nomor Telp Umkm: {{ $no_telp_umkm[$i] }}</p>
                            <p class="text-lg font-bold text-[#F9832A]">Nama Penerima: {{ $item['nama_penerima'] }}</p>
                            <p class="text-lg font-bold text-[#F9832A]">Alamat Penerima: </p>
                            <p class="text-lg font-bold text-[#F9832A]">Nama Umkm: {{ $item['nama_umkm'] }}</p>
                            <p class="text-lg font-bold text-[#F9832A]">Nama Umkm: {{ $item['nama_umkm'] }}</p>

                            <div class="flex flex-row gap-2">
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                                    Selesaikan
                                </button>
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                                    Batalkan Pesanan
                                </button>
                            </div>
                        </div>
                        <?php $i++ ?>
                        @endforeach
                        @else
                        <p class="text-lg font-bold text-[#F9832A]">Tidak ada pesanan yang harus diantar <br><a href="#" class="text-blue-500">Lihat semua pesanan</a></p>
                        @endif
                    </div>
                    <a href="{{ route('courierorder') }}" class="text-blue-500">Lihat semua pesanan</a>
                </div>
            </div>
        </div>
</x-courier-layout>