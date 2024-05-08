<x-courier-layout>
    {{-- Temporary data --}}
    @php
    $orders = [
    [
    'nama_penerima' => 'Dimas Prasetyo',
    'alamat_pengirim' => 'Alamat Pengirim',
    'alamat_penerima' => 'Alamat Penerima',
    'nomor_telepon_pengirim' => 'Nomor Telepon Pengirim',
    'nomor_telepon_penerima' => 'Nomor Telepon Penerima',
    'deskripsi_paket' => 'Deskripsi Paket',
    'status_paket' => 'Status Paket',
    ],
    ];
    @endphp
    {{-- Main content --}}
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-2">
                <h1 class="text-2xl font-bold text-[#F9832A]">Dashboard</h1>
                <p class="text-lg text-[#F9832A]">Selamat datang, {{ Auth::user()->nama_user ?? 'null' }}</p>
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <h1 class="text-xl font-bold text-[#F9832A]">Pesanan yang harus diantar</h1>
                    <div class="flex flex-col gap-2">
                        @if ($orders != null)
                        @foreach ($orders as $order)
                        <div class="flex flex-col gap-2 border border-[#F9832A] p-2">
                            <p class="text-lg font-bold text-[#F9832A]">Nama Pengirim: {{ $nama_umkm }}</p>
                            <p class="text-lg font-bold text-[#F9832A]">Nama Penerima: {{ $nama_penerima }}</p>
                            <p class="text-lg font-bold text-[#F9832A]">Alamat Pengirim: {{ $order['alamat_pengirim'] }}</p>
                            <p class="text-lg font-bold text-[#F9832A]">Alamat Penerima: {{ $order['alamat_penerima'] }}</p>
                            <p class="text-lg font-bold text-[#F9832A]">Nomor Telepon Pengirim: {{ $no_telp_umkm }}</p>
                            <p class="text-lg font-bold text-[#F9832A]">Nomor Telepon Penerima: {{ $no_telp_cust }}</p>
                            <p class="text-lg font-bold text-[#F9832A]">Deskripsi Paket: {{ $order['deskripsi_paket'] }}</p>
                            <p class="text-lg font-bold text-[#F9832A]">Status Paket: {{ $order['status_paket'] }}</p>
                            <div class="flex flex-row gap-2">
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                                    Selesaikan
                                </button>
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                                    Batalkan Pesanan
                                </button>
                            </div>
                        </div>
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