@extends('layouts.Root')
@section('content')
    @include('components.header.courierHeader')
    {{-- Main content --}}
    <main class="bg-[#F0F3F8] w-full h-screen mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    @if($orders != null)
                        <h1 class="text-xl font-bold text-[#F9832A]">Pesanan yang harus diantar</h1>
                    @endif
                    <div class="flex flex-col gap-2">
                        @if ($orders != null)
                        <?php $i = 0; ?>
                            @foreach ($orders as $order => $item)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-4">
                                    <div class="p-4">
                                        {{-- logo shop and the name of umkms--}}
                                        <div class="flex items-center gap-2">
                                            <img src="{{ asset('shop-orange.svg') }}" alt="" class="w-10 h-10 rounded-full">
                                            <h1 class="text-lg font-semibold text-gray-700">{{ $item['nama_umkm'] }}</h1>
                                        </div>

                                        {{-- information of orders --}}
                                        <div class="text-sm text-gray-600 mb-2">
                                            <p><span class="font-semibold">Alamat UMKM:</span> <a href="{{ $item['link'] }}" class="text-[#F9832A] hover:underline">{{ $item['alamat'] }}</a></p>
                                            <p><span class="font-semibold">No. Telp UMKM:</span> {{ $no_telp_umkm[$i] }}</p>
                                        </div>

                                        <h3 class="text-md font-semibold text-gray-700 mb-2">Pesanan:</h3>
                                        <ul class="list-disc list-inside text-sm text-gray-600 mb-2">
                                            @foreach ($item['orders'] as $order)
                                                @if ($order['catatan'] != "-")
                                                    <li>{{ $order['jumlah'] }} ({{ $order['nama'] }}) - {{ $order['catatan'] }}</li>
                                                @else
                                                    <li>{{ $order['jumlah'] }} ({{ $order['nama'] }})</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="text-sm text-gray-600 mb-4">
                                            <p><span class="font-semibold">Nama Penerima:</span> {{ $item['nama_penerima'] }}</p>
                                            <p><span class="font-semibold">Alamat Penerima:</span> <a href="{{ $item['cust_link_address'] }}" class="text-[#F9832A] hover:underline">{{ $item['cust_address'] }}</a></p>
{{--                                            @if ($item['notesAlamat'] != "-")--}}
{{--                                                <p><span class="font-semibold">Catatan Alamat:</span> {{ $item['notesAlamat'] }}</p>--}}
{{--                                            @endif--}}
                                            <p><span class="font-semibold">No. Telp Cust:</span> {{ $no_telp_cust }}</p>
                                        </div>

                                        <div class="flex items-center justify-between">
                                            <div class="text-sm text-gray-600">
                                                <p><span class="font-semibold">Subtotal:</span> Rp. {{ number_format($item['total'], 0, ',', '.') }}</p>
                                                <p><span class="font-semibold">Ongkir:</span> Rp. {{ number_format($item['ongkir'], 0, ',', '.') }}</p>
                                            </div>

                                            <div class="flex flex-row gap-2">
                                                <form action="{{ route('complete.orders') }}" method="POST" onsubmit="return confirmCompleteOrder()">
                                                    @csrf
                                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full text-sm">
                                                        Selesaikan
                                                    </button>
                                                    <input type="hidden" value="{{ $custId[$i] }}" name="custId">
                                                </form>

                                                <form action="{{ route('delete.orders') }}" method="POST" onsubmit="return confirmDeleteOrder()">
                                                    @csrf
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full text-sm">
                                                        Batalkan
                                                    </button>
                                                    <input type="hidden" value="{{ $custId[$i] }}" name="custId">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              <?php $i++ ?>
                            @endforeach
                        @endif
                        @if($orders == null)
                            <h1 class="text-xl font-bold text-black">Ups, kamu belum mengambil pesanan</h1>
                        @endif
                    </div>
                    <a href="{{ route('courierorder') }}" class="text-blue-500">Lihat semua pesanan</a>
                </div>
            </div>
        </div>
    </main>
    @include('components.navbar.navbarCourier')
<script>
    function confirmCompleteOrder() {
        return confirm('Are you sure you want to complete this order?');
    }

    function confirmDeleteOrder() {
        return confirm('Are you sure you want to cancel this order?');
    }
</script>
