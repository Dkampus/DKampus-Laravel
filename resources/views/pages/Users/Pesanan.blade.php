@extends('layouts.PesananLayout')
@section('pesananContent')
    <div class="flex flex-col sm:flex-row items-center justify-center px-2">
        <section class="bg-white rounded-lg shadow-md w-full sm:w-1/2 max-w-4xl overflow-hidden">
            {{-- Header Section --}}
            <div class="bg-[#F9832A] text-white p-4 flex items-center justify-between">
                @if($data !== null)
                    <img src="{{asset('shop-white.svg')}}" alt="" class="w-10 h-10">
                    <h1 class="font-semibold text-xl sm:text-2xl">{{$namaUMKM}}</h1>
                @else
                @endif
            </div>
            {{-- Border Line --}}
            @if ($data !== null)
                <div class="border-b-2 border-[#F9832A] w-1/2 mx-auto my-5"></div>
            @endif
            {{-- List Pesanan --}}
            <div class="flex flex-col gap-5 px-5">
                @if($data !== null)
                @forelse ($data as $item)
                <form action="" method="POST">
                    <div class="flex flex-col md:flex-row justify-between items-start">
                        <div id="contentPesanan{{ $item['id'] }}" class="shadow-md w-full md:w-full">
                            <div class="flex flex-row md:flex-row justify-between items-center mb-2 w-full h-36">
                                    @php
                                    $menu = \App\Models\Menu::where('id', $item['id'])->first();
                                    $imagePath = $menu->image;
                                    @endphp
                                <div class="flex flex-row justify-center items-center w-full h-full">
                                    <img src="{{Storage::url($imagePath)}}" alt="" class="w-full h-24 object-cover rounded-lg">
                                </div>
                                <div class="flex flex-col gap-2 px-5 w-full">
                                    {{-- Nama Makanan --}}
                                    <div class="flex flex-row justify-between">
                                        <h1 class="font-semibold text-lg">{{ $menu->nama_makanan }}</h1>
                                    </div>
                                    {{-- Text area for catatan --}}
                                    <div class="flex flex-row justify-between">
                                        <textarea name="catatan" id="catatan" class="w-40 h-[4vh] rounded-lg border-0" placeholder="Catatan"></textarea>
                                    </div>
                                    {{-- Harga Makanan --}}
                                    <div class="flex flex-row justify-between">
                                        <h1 class="text-[#F9832A] font-semibold">Rp. {{ number_format($menu->harga, 0, ',', '.') }}</h1>
                                    </div>
                                </div>
                                <div id="count" class="flex flex-col gap-2 ml-3 mt-[0.2rem]">
                                    {{-- Masih belum sync sama js & db fb --}}
                                    {{-- Increment Button --}}
                                    <button id="increment" type="button" value="{{ $item['id'] }}" class="increment-btn bg-[#F9832A] text-white w-9 h-9 rounded-md">
                                        +
                                    </button>
                                    {{-- Quantity Input --}}
                                    <input id="number" type="number" name="items[quantity][]" onchange="calculateTotal()" value="{{ $item['jumlah'] }}" class="quantity-input w-9 h-9 text-center border-2 border-[#F9832A] rounded-md" min="1" max="100" readonly>
                                    {{-- Decrement Button --}}
                                    <button id="decrement" type="button" value="{{ $item['id'] }}" class="decrement-btn bg-[#F9832A] text-white w-9 h-9 rounded-md">
                                        -
                                    </button>
                                    {{-- Delete Button --}}
                                    <button id="delete" type="button" value="{{ $item['id'] }}" class="hidden delete bg-[#F9832A] text-white w-9 h-9 rounded-md">
                                        <svg height="20" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.36136 12.1029C1.36136 12.4932 1.52167 12.8675 1.80702 13.1435C2.09236 13.4195 2.47938 13.5745 2.88292 13.5745H8.96914C9.37269 13.5745 9.7597 13.4195 10.045 13.1435C10.3304 12.8675 10.4907 12.4932 10.4907 12.1029V3.2731H1.36136V12.1029ZM2.88292 4.74473H8.96914V12.1029H2.88292V4.74473ZM8.58876 1.06565L7.82798 0.329834H4.02409L3.26331 1.06565H0.600586V2.53728H11.2515V1.06565H8.58876Z" fill="#EEEEEE" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <input type="hidden" name="items[harga][]" value="{{ $item['harga'] }}">
                <input type="hidden" name="items[id][]" value="{{ $item['id'] }}">
                @empty
                <h1 class="text-center font-semibold text-lg">Ups, pesanan kamu kosong nih :)</h1>
                @endforelse
                @else
                <h1 class="text-center font-semibold text-lg">Ups, pesanan kamu kosong nih :)</h1>
                @endif
            </div>
        </section>
    </div>

    {{-- Render List Address --}}
    <div id="overlayAddNewAddress" onclick="renderHideListAddress()" class="bg-black/10 transition-all duration-500 invisible opacity-0 -z-10 h-screen w-full absolute top-0 left-0"></div>

    {{-- Form Checkout --}}
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <div id="addNewAddress" class="w-full pt-5 pb-14 flex flex-col items-center gap-5 border overflow-auto fixed h-0 bg-white rounded-3xl -bottom-96 transition-all duration-500 shadow-top-for-total-harga">
            @if ($AddressList !== null)
            @forelse ($AddressList as $Item)
            <div class="flex flex-row items-end gap-10 border-b-2 pb-2">
                <a class="address-button flex flex-col gap-2" onclick="renderHideListAddress()" data-id="{{ $Item['id'] }}" data-name="{{ $Item['nama_alamat'] }}">
                    <h1 class=" font-semibold text-lg">{{ $Item['nama_alamat'] }}</h1>
                    <div id="location" class="flex flex-row gap-2 items-center">
                        <img src="markLocation.svg" alt="" class="w-5">
                        <h1 class="text-wrapper-location">{{ $Item['address'] }}</h1>
                    </div>
                </a>
                <img src="edit.svg" alt="" class="w-5">
            </div>
            @empty
            <h1 class=" font-semibold text-lg">Silahkan Tambahkan Alamat</h1>
            <a href="/daftar-alamat" class="btn flex items-center gap-x-2 bg-orange-500 text-white px-3 py-2 rounded-md shadow-md">
                <h1 class="font-bold text-white text-md">Tambah Alamat</h1>
            </a>
            @endforelse
            @endif
        </div>

        <div id="totalAndAddress" class="w-full md:w-3/4 lg:w-1/2 mx-auto">
            @if($data !== null)
                @php $total = 0; @endphp
                @foreach ($data as $item)
                    @php $total += $item['harga'] * $item['jumlah']; @endphp
                @endforeach
            @else
                @php $total = 0; @endphp
            @endif
            <div id="content" class="fixed border-[2.5px] border-black/10 flex flex-row justify-around rounded-2xl h-48 pt-5 w-full left-0 bottom-0 bg-white shadow-top-for-total-harga">
                <a id="alamat" class="flex flex-row gap-3 items-center border-2 border-[#F9832A] p-3 h-12 rounded-lg">
                    <img src="Map.svg" alt="" class="w-6">
                    <div id="desc" class="flex flex-row gap-2 items-center">
                        @if ($alamatUtama !== null)
                            <h1 class="text-[#5e5e5e] font-medium" id="selected_address">{{ $alamatUtama->nama_alamat }}</h1>
                            <input type="hidden" id="selected_address_id" name="selected_address_id" value="{{ $alamatUtama->id }}">
                        @else
                            <h1 class="text-[#5e5e5e] font-medium" id="selected_address">Masukan Alamat</h1>
                            <input type="hidden" id="selected_address_id" name="selected_address_id" value="">
                        @endif
                        <img src="ArrowTop.svg" alt="">
                    </div>
                </a>
                <div id="totalHarga" class="flex flex-row gap-5">
                    <div id="descTotalHarga" class="text-center">
                        <h1>Total Harga</h1>
                        <p id="total_harga" class=" font-semibold border-b-2 border-[#F9832A]">Rp. {{ number_format($total, 0, ',', '.') }}</p>
                    </div>
                    <div id="buttonTotalHarga">
                        <button type="submit" class="bg-[#F9832A] h-10 w-24 text-white font-semibold rounded-xl">
                            Pesan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('cart.delete') }}" method="POST" class="delete-form hidden">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" id="deleteInput">
    </form>

@endsection

@push('js')
<script>
    $(document).ready(function() {

        console.log("ready!");
        // for favorite menus button
        $(document).on("click", '#like', function(e) {
            e.preventDefault();

            // Get the menuId from some source, for example, a data attribute on the element
            const menuId = $(this).val();

            // Make an AJAX request
            $.ajax({
                type: "POST",
                url: '/favoritStore/' + menuId,
                data: {
                    _token: '{{ csrf_token() }}',
                    menuId: menuId
                },
                success: function(response) {

                },
                error: function(error) {

                }
            });
        });


        $(document).ready(function() {
            // Increment Button
            $(".increment-btn").click(function() {
                let quantityInput = $(this).siblings('.quantity-input');
                let newValue = parseInt(quantityInput.val()) + 1;
                quantityInput.val(newValue);

                $.ajax({
                    type: "POST",
                    url: "/pesanan/update-quantity",
                    data: {
                        id: $(this).val(),
                        quantity: newValue,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // Handle success
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
                calculateTotal()
            });

            // Quantity Input
            $(".quantity-input").on('input', function() {
                $.ajax({
                    type: "POST",
                    url: "/pesanan/update-quantity",
                    data: {
                        id: $(this).siblings('.increment-btn').val(),
                        quantity: $(this).val(),
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // Handle success
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
                calculateTotal()
            });

            // Decrement Button
            $(".decrement-btn").click(function() {
                let quantityInput = $(this).siblings('.quantity-input');
                let newValue = parseInt(quantityInput.val()) - 1;

                if (newValue == 0) {
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin menghapus?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                    }).then((result) => {
                        const cartId = $(this).val();
                        console.log(cartId)
                        $("#deleteInput").val(cartId);
                        if (result.isConfirmed) {
                            const form = $('.delete-form');
                            console.log(form)
                            form.submit();
                        }
                    });
                } else {
                    quantityInput.val(newValue);
                    $.ajax({
                        type: "POST",
                        url: "/pesanan/update-quantity",
                        data: {
                            id: $(this).val(),
                            quantity: newValue,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // Handle success
                        },
                        error: function(error) {
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    });
                    calculateTotal();
                }
            });
        });

        $(document).on("click", "#delete", function(e) {
            e.preventDefault();

            // confirm delete
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
            }).then((result) => {
                const cartId = $(this).val();
                console.log(cartId)
                $("#deleteInput").val(cartId);
                if (result.isConfirmed) {
                    const form = $('.delete-form');
                    console.log(form)
                    form.submit();
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const addressButtons = document.querySelectorAll('.address-button');
        const selectedAddressElement = document.getElementById('selected_address');
        const selectedAddressIdInput = document.getElementById('selected_address_id');

        addressButtons.forEach(button => {
            button.addEventListener('click', function() {
                const addressName = this.getAttribute('data-name');
                const addressId = this.getAttribute('data-id');

                // Update the selected address display
                selectedAddressElement.textContent = addressName;

                // Set the hidden input value
                selectedAddressIdInput.value = addressId;
            });
        });
    });
</script>
@endpush
