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
                            <p><span class="font-semibold">Alamat UMKM:</span> <a href="{{ $item['umkm_link_address'] }}" class="text-[#F9832A] hover:underline">{{ $item['umkm_address'] }}</a></p>
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
                            {{-- @if ($item['notesAlamat'] != "-")--}}
                            {{-- <p><span class="font-semibold">Catatan Alamat:</span> {{ $item['notesAlamat'] }}</p>--}}
                            {{-- @endif--}}
                            <p><span class="font-semibold">No. Telp Cust:</span> {{ $no_telp_cust }}</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">
                                <p><span class="font-semibold">Subtotal:</span> Rp. {{ number_format($item['total'], 0, ',', '.') }}</p>
                                <p><span class="font-semibold">Ongkir:</span> Rp. {{ number_format($item['ongkir'], 0, ',', '.') }}</p>
                            </div>

                            <div class="flex flex-row gap-2">
                                {{-- {{ route('complete.orders') }} --}}
                                <form action="#" method="POST" onsubmit="return confirmCompleteOrder()">
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
        {{-- Modal selesaikan pesanan --}}
        <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items end justify-center h-auto pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                                    Selesaikan Pesanan
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Apakah kamu yakin ingin menyelesaikan pesanan ini?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- List Pesanan --}}
                    <div class="bg-white overflow-hidden mb-2 mx-2">
                        <div class="px-4">
                            <h3 class="text-md font-semibold text-gray-700 mb-2">Pesanan:</h3>
                            <ul class="list-disc list-inside text-sm text-gray-600 mb-2">
                                <li>1 (Nasi Goreng) - Pedas</li>
                                <li>2 (Mie Ayam) - Tidak pedas</li>
                            </ul>
                            <div class="flex items center justify-between">
                                <div class="text-sm text-gray-600">
{{--                                    <p><span class="font-semibold">Subtotal:</span> Rp. 25.000</p>--}}
                                    <p><span class="font-semibold">Ongkir:</span> Rp. 5.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- input from courier : proof-payment(img) and total-price of orders --}}
                    <div class="bg-white overflow-hidden mb-2 mx-2">
                        <div class="p-4">
                            <label for="total-price" class="block text-sm font-medium text-gray-700">Total Harga</label>
                            <div class="mt-1">
                                <input type="number" name="total-price" id="total-price" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Rp. 30.000" required>
                                <span class="text-xs text-gray-500">*Total harga menu yang kamu keluarakan</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <label for="proof-payment" class="block text-sm font-medium text-gray-700">Bukti Pembayaran</label>
                            <div class="mt-1">
                                <input type="file" name="bukti" id="bukti" class="w-full h-12 border-2 border-[#F9832A] rounded-xl" style="display: none;" accept=".jpg,.jpeg" required>
                                <button type="button" id="uploadButton" class="w-full h-12 bg-[#F9832A] text-white font-bold rounded-xl mt-2">Pilih File</button>
                                <span id="fileName" class="text-sm text-gray-500"></span>
                            </div>
                            <div class="mt-1">
                                <span class="text-xs text-gray-500">*Unggah bukti pembayaran mengirimkan pesanan</span>
                            </div>
                        </div>
                    </div>
                    {{-- button selesaikan --}}
                    <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        {{-- route('complete.orders') --}}
                        <form action="" method="POST">
                            @csrf
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#F9832A] text-base font-medium text-white hover:bg-[#F9832A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Selesaikan
                            </button>
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('components.navbar.navbarCourier')
<script>
    //show modals confrimation complete order
</script>
