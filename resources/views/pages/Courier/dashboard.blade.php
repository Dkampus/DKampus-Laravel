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
                            <p class=" text-lg font-bold text-[#F9832A]">Alamat Umkm: <a href=" {{ $item['link'] }}">{{ $item['alamat'] }}</a></p>
                            <p class="text-lg font-bold text-[#F9832A]">Nomor Telp Umkm: {{ $no_telp_umkm[$i] }}</p>
                            <p class="text-lg font-bold text-[#F9832A]">Orders:</p>
                            @foreach ($item['orders'] as $order => $orders)
                            <span class="text-lg font-bold text-[#F9832A]">{{ $orders['jumlah'] }} - {{ $orders['nama'] }} ( {{ $orders['catatan'] }} )</span>
                            @endforeach
                            <p class="text-lg font-bold text-[#F9832A]">Nama Penerima: {{ $item['nama_penerima'] }}</p>
                            <p class="text-lg font-bold text-[#F9832A]">Alamat Penerima: <a href=" {{ $item['cust_link_address'] }}">{{ $item['cust_address'] }}</a></p>
                            <p class="text-lg font-bold text-[#F9832A]">Notes Alamat: {{ $item['notesAlamat'] }}</p>
                            <p class="text-lg font-bold text-[#F9832A]">SubTotal: Rp. {{number_format($item['total'], 0, ',', '.')}}</p>
                            <p class="text-lg font-bold text-[#F9832A]">Ongkir: Rp. {{number_format($item['ongkir'], 0, ',', '.')}}</p>
                            <p class="text-lg font-bold text-[#F9832A]">No Telp Cust: {{ $no_telp_cust }}</p>


                            <div class="flex flex-row gap-2">
                                <form action="{{ route('complete.orders') }}" method="POST">
                                    @csrf
                                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                                        Selesaikan
                                    </button>
                                    <input type="text" class="hidden" value="{{ $custId[$i] }}" name="custId">
                                </form>
                                <form action="{{ route('delete.orders') }}" method="POST">
                                    @csrf
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                                        Batalkan Pesanan
                                    </button>
                                    <input type="text" class="hidden" value="{{ $custId[$i] }}" name="custId">
                                </form>
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