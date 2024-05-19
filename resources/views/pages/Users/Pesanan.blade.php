@extends('layouts.PesananLayout')
@section('pesananContent')
    <div class="flex flex-col gap-5 items-center justify-start bg-[#F0F3F8]">
        <section id="" class="flex flex-col bg-white w-full h-full py-10">
            <div class="flex items-center gap-x-2 px-5">
                @if($data !== null)
                    <img src="{{asset('shop.svg')}}" alt="" class="w-10 h-10">
                    <h1 class="font-semibold text-xl">{{$namaUMKM}}</h1>
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
                            <div class="flex flex-row justify-between items-start">
                                <div id="contentPesanan{{ $item['id'] }}" class="shadow-md w-full md:w-1/2 ">
                                    <div class="flex flex-row justify-between items-center">
                                        <div class="h-32 w-50">
                                            @php
                                                $menu = \App\Models\Menu::where('id', $item['id'])->first();
                                                $imagePath = $menu->image;
                                            @endphp
                                            <img src="{{ Storage::url($imagePath) }}" alt="" class="h-full w-full object-cover rounded-tl-xl rounded-bl-xl">
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
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2 ml-5">
                                    {{-- Increment Button --}}{{-- Masih belum sync sama js & db fb --}}
                                    <button type="button" class="increment-btn bg-[#F9832A] text-white w-8 h-8 rounded-md">
                                        +
                                    </button>
                                    {{-- Quantity Input --}}
                                    <input type="number" name="quantity" id="quantity" value="{{ $item['jumlah'] }}" class="quantity-input w-8 h-8 text-center border-2 border-[#F9832A] rounded-md" min="1" max="100">
                                    {{-- Decrement Button --}}
                                    <button type="button" class="decrement-btn bg-[#F9832A] text-white w-8 h-8 rounded-md">
                                        -
                                    </button>
                                </div>
                            </div>
                        </form>
                    @empty
                        <h1 class="text-center font-semibold">Tidak ada pesanan</h1>
                    @endforelse
                @else
                    <h1 class="text-center font-semibold">Tidak ada pesanan</h1>
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

        <div id="totalAndAddress">
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

@endsection

@push('js')
    <script>
        $(document).ready(function() {

            console.log("ready!");

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


            // Loop through all quantity inputs
            quantityInputs.forEach(function(quantityInput, index) {
                const itemQuantity = parseInt(quantityInput.value);
                const decrementBtn = decrementBtns[index];
                const incrementBtn = incrementBtns[index];

                // Show or hide decrement button based on quantity value
                if (itemQuantity == 1) {
                    decrementBtn.style.display = "none";
                    decrementBtn.style.pointerEvents = "none";
                    incrementBtn.style.pointerEvents = "auto";
                    deleteBtn[index].style.display = "flex";
                }

                // Show or hide increment button based on quantity value
                if (itemQuantity === 100) {
                    incrementBtn.style.opacity = "0";
                    incrementBtn.style.pointerEvents = "none";
                }

                // Add click event listener to decrement button
                decrementBtn.addEventListener("click", function(e) {
                    e.preventDefault();
                    let currentQuantity = parseInt(quantityInput.value);

                    if (currentQuantity > 1) {
                        decrementBtn.style.display = "absolute";
                        decrementBtn.style.pointerEvents = "auto";
                        quantityInput.value = currentQuantity - 1;
                        currentQuantity--;

                        const cartId = $(this).val();

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: "POST",
                            url: "/pesanan/update-quantity",
                            data: {
                                // _method: "PATCH", // Emulate PATCH request
                                id: cartId,
                                quantity: currentQuantity,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {

                            },
                            error: function(error) {
                                alert('Terjadi kesalahan. Silakan coba lagi.');
                            }
                        });
                    }

                    if (currentQuantity == 1) {
                        decrementBtn.style.display = "none";
                        decrementBtn.style.pointerEvents = "none";
                        incrementBtn.style.pointerEvents = "auto";
                        deleteBtn[index].style.display = "flex";
                    }

                    calculateTotal();
                });

                // Add click event listener to increment button
                incrementBtn.addEventListener("click", function(e) {
                    e.preventDefault();
                    let currentQuantity = parseInt(quantityInput.value);

                    if (currentQuantity < 100) {
                        currentQuantity++;
                        quantityInput.value = currentQuantity;
                        incrementBtn.style.opacity = currentQuantity === 100 ? "0" : "1";
                        incrementBtn.style.pointerEvents =
                            currentQuantity === 100 ? "none" : "auto";

                        const cartId = $(this).val();

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: "POST",
                            url: "/pesanan/update-quantity",
                            contentType: "application/json", // Set the content type to JSON
                            data: JSON.stringify({
                                id: cartId,
                                quantity: currentQuantity
                            }),
                            success: function(response) {
                                // Handle success
                            },
                            error: function(error) {

                            }
                        });
                    }

                    if (currentQuantity == 2) {
                        deleteBtn[index].style.display = "none";
                        decrementBtn.style.display = "flex";
                        decrementBtn.style.pointerEvents = "auto";
                    }

                    calculateTotal();
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
