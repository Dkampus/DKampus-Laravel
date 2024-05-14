@extends('layouts.PesananLayout')
@section('pesananContent')
<div class="flex flex-col gap-5 items-center justify-start bg-[#F0F3F8]">
    <section id="warungIbuPagi" class="flex flex-col bg-white w-full h-full py-10">
        <div id="contentCard" class="mx-auto">
            {{-- Title Warung --}}
            @if ($namaUMKM !== null)
            <div id="titleWarung" class="flex flex-row items-center mb-4">
                <div class="flex flex-row justify-start items-center gap-4 rounded-xl">
                    <input type="checkbox" name="" id="checkboxWarung" class="text-[#F9832A] border-2 rounded-md border-[#F9832A] w-8  h-8 transition-all duration-300 checked:fill-[#F9832A] checked:border-[#F9832A] checked:ring-[#F9832A] focus:fill-[#F9832A] focus:border-[#F9832A] focus:ring-[#F9832A]">
                    <label for="checkboxWarung" for="" class="flex flex-row gap-3 items-center">
                        <svg height="30" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.50596 0.214355C1.35633 0.214355 1.22294 0.318064 1.17148 0.474022L0.257897 3.24921C0.229051 3.33697 0.214353 3.42877 0.214355 3.52115V4.62513C0.214355 5.24936 0.66996 5.75602 1.23204 5.75602C1.79413 5.75602 2.25013 5.24936 2.25013 4.62513C2.25013 5.24975 2.70573 5.75602 3.26781 5.75602C3.8299 5.75602 4.2859 5.24936 4.2859 4.62513C4.2859 5.24975 4.7415 5.75602 5.30359 5.75602C5.86567 5.75602 6.32088 5.25015 6.32167 4.62592C6.32167 5.25015 6.77727 5.75602 7.33936 5.75602C7.90144 5.75602 8.35704 5.24936 8.35704 4.62513C8.35704 5.24975 8.81304 5.75602 9.37513 5.75602C9.93721 5.75602 10.3924 5.25015 10.3928 4.62592C10.3932 5.25015 10.8488 5.75602 11.4109 5.75602C11.973 5.75602 12.4286 5.24936 12.4286 4.62513C12.4286 5.24975 12.8842 5.75602 13.4467 5.75602C14.0088 5.75602 14.4644 5.24936 14.4644 4.62513V3.52115C14.4644 3.42877 14.4497 3.33697 14.4208 3.24921L13.5072 0.474418C13.4558 0.318064 13.3224 0.214355 13.1728 0.214355H1.50596Z" fill="#F9832A" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.79761 6.24282V9.31844H0.808024C0.755533 9.31844 0.705192 9.33929 0.668076 9.37641C0.630959 9.41353 0.610107 9.46387 0.610107 9.51636V9.91219C0.610107 9.96468 0.630959 10.015 0.668076 10.0521C0.705192 10.0893 0.755533 10.1101 0.808024 10.1101H13.8705C13.923 10.1101 13.9734 10.0893 14.0105 10.0521C14.0476 10.015 14.0684 9.96468 14.0684 9.91219V9.51636C14.0684 9.46387 14.0476 9.41353 14.0105 9.37641C13.9734 9.33929 13.923 9.31844 13.8705 9.31844H12.8809V6.24282C12.7152 6.17678 12.5622 6.08264 12.4285 5.96455C12.3259 6.05505 12.2118 6.1317 12.0893 6.19255V9.31844H2.58927V6.19255C2.46671 6.1317 2.35267 6.05505 2.25004 5.96455C2.11704 6.08132 1.96504 6.17632 1.79761 6.24282ZM12.0893 5.46817C12.1229 5.43452 12.1546 5.3985 12.1843 5.36011H12.0893V5.46817ZM12.6727 5.36011C12.7326 5.43764 12.8026 5.50674 12.8809 5.56554V5.36011H12.6727ZM1.79761 5.56554C1.87633 5.50721 1.94643 5.43804 2.00582 5.36011H1.79761V5.56554ZM2.49427 5.36011H2.58927V5.46817C2.55527 5.43427 2.52354 5.39817 2.49427 5.36011ZM1.20386 10.9018C1.15137 10.9018 1.10103 10.9226 1.06391 10.9597C1.02679 10.9969 1.00594 11.0472 1.00594 11.0997V14.0684C1.00594 14.1734 1.04764 14.2741 1.12188 14.3483C1.19611 14.4226 1.29679 14.4643 1.40177 14.4643H13.2768C13.3818 14.4643 13.4824 14.4226 13.5567 14.3483C13.6309 14.2741 13.6726 14.1734 13.6726 14.0684V11.0997C13.6726 11.0472 13.6518 10.9969 13.6146 10.9597C13.5775 10.9226 13.5272 10.9018 13.4747 10.9018H1.20386Z" fill="#F9832A" />
                            <path d="M3.3811 8.32902C3.3811 8.27653 3.40196 8.22619 3.43907 8.18907C3.47619 8.15196 3.52653 8.1311 3.57902 8.1311H4.76652C4.81901 8.1311 4.86935 8.15196 4.90647 8.18907C4.94359 8.22619 4.96444 8.27653 4.96444 8.32902V9.12069C4.96444 9.17318 4.94359 9.22352 4.90647 9.26064C4.86935 9.29775 4.81901 9.3186 4.76652 9.3186H3.57902C3.52653 9.3186 3.47619 9.29775 3.43907 9.26064C3.40196 9.22352 3.3811 9.17318 3.3811 9.12069V8.32902Z" fill="#F9832A" />
                            <path d="M4.17261 8.72485C4.17261 8.67236 4.19346 8.62202 4.23058 8.58491C4.26769 8.54779 4.31803 8.52694 4.37052 8.52694H5.55802C5.61051 8.52694 5.66086 8.54779 5.69797 8.58491C5.73509 8.62202 5.75594 8.67236 5.75594 8.72485V9.12069C5.75594 9.17318 5.73509 9.22352 5.69797 9.26064C5.66086 9.29775 5.61051 9.3186 5.55802 9.3186H4.37052C4.31803 9.3186 4.26769 9.29775 4.23058 9.26064C4.19346 9.22352 4.17261 9.17318 4.17261 9.12069V8.72485ZM7.33927 8.72485C7.33927 8.88233 7.27672 9.03335 7.16537 9.1447C7.05402 9.25605 6.903 9.3186 6.74552 9.3186C6.58805 9.3186 6.43703 9.25605 6.32568 9.1447C6.21433 9.03335 6.15177 8.88233 6.15177 8.72485C6.15177 8.56738 6.21433 8.41636 6.32568 8.30501C6.43703 8.19366 6.58805 8.1311 6.74552 8.1311C6.903 8.1311 7.05402 8.19366 7.16537 8.30501C7.27672 8.41636 7.33927 8.56738 7.33927 8.72485Z" fill="#F9832A" />
                        </svg>
                        <h1 class="text-xl font-semibold">{{ $namaUMKM }}</h1>
                    </label>
                </div>
            </div>
            <div class="bg-[#5e5e5e]/40 w-[30rem] h-0.5"></div>

            @else
            <h1 class="text-xl font-semibold">Ups keranjang kamu kosong :)</h1>
            @endif
            {{-- Card List Pesanan --}}
            <div id="cardList" class="flex flex-col transition-all duration-300 items-start gap-y-5 mt-5">
                @foreach ($data as $order => $item)
                <div id="cardPesanan{{ $item['id'] }}" class="flex flex-row items-center justify-start gap-4 rounded-xl">
                    {{-- Favorite and Checkbox --}}
                    <div id="favoriteAndCheckbox" class="flex flex-col gap-3 items-start mb-auto">
                        <input type="checkbox" name="" id="checkboxMakanan" class="text-[#F9832A] border-2 rounded-md border-[#F9832A] w-8 h-8 transition-all duration-300 checked:fill-[#F9832A] checked:border-[#F9832A] checked:ring-[#F9832A] focus:fill-[#F9832A] focus:border-[#F9832A] focus:ring-[#F9832A]">
                        <button type="button" id="like" value="{{ $item['id'] }}">
                            <label for="BtnLikeCheckbox" id="BtnLikes" class="w-8 h-8 bg-white flex flex-col justify-center items-center border-2 border-[#5e5e5e]/40 rounded-md">
                                @php
                                $fav = 0;
                                @endphp
                                @if ($fav == 0)
                                <svg height="20" id="BtnLikeIcon" class="fill-[#5e5e5e]/60 transition-all duration-300 " viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.08993 0.292134C6.66743 0.309697 7.2266 0.41053 7.76835 0.59478H7.82243C7.8591 0.612197 7.8866 0.631447 7.90493 0.648864C8.10752 0.713947 8.2991 0.78728 8.48243 0.888114L8.83077 1.04395C8.96827 1.11728 9.13327 1.25386 9.22493 1.30978C9.3166 1.36386 9.41743 1.41978 9.49993 1.48303C10.5183 0.70478 11.7549 0.283114 13.0291 0.292134C13.6075 0.292134 14.185 0.373864 14.7341 0.558114C18.1175 1.65811 19.3367 5.37061 18.3183 8.61561C17.7408 10.2739 16.7966 11.7873 15.56 13.0239C13.7899 14.738 11.8475 16.2597 9.7566 17.5705L9.52743 17.7089L9.2891 17.5614C7.19085 16.2597 5.23743 14.738 3.45085 13.0147C2.22252 11.7781 1.27743 10.2739 0.690767 8.61561C-0.345066 5.37061 0.874101 1.65811 4.29418 0.538864C4.56002 0.447197 4.8341 0.38303 5.1091 0.34728H5.2191C5.47668 0.309697 5.73243 0.292134 5.9891 0.292134H6.08993ZM14.2574 3.18895C13.8816 3.0597 13.4691 3.26228 13.3316 3.64728C13.2033 4.03228 13.4049 4.45395 13.7899 4.59053C14.3775 4.81053 14.7708 5.38895 14.7708 6.0297V6.05811C14.7533 6.26803 14.8166 6.47061 14.9449 6.62645C15.0733 6.78228 15.2658 6.87303 15.4674 6.89228C15.8433 6.8822 16.1641 6.58061 16.1916 6.1947V6.08561C16.2191 4.80136 15.4408 3.63811 14.2574 3.18895Z" />
                                </svg>
                                @endif
                            </label>
                            <input class="invisible absolute" type="checkbox" name="" id="BtnLikeCheckbox">
                        </button>
                    </div>

                    {{-- content card pesanan --}}
                    <form action="" method="POST">
                        <div id="contentPesanan{{ $item['id'] }}" class="shadow-md w-[27rem] rounded-xl border">
                            <div for="checkboxMakanan" class="flex flex-row items-center">
                                @php
                                $menu = \App\Models\Menu::where('id', $item['id'])->first();
                                $imagePath = $menu->image;
                                @endphp
                                <div class="h-32 w-60">
                                    <img src="{{ Storage::url($imagePath) }}" alt="" class="h-full w-full object-cover rounded-tl-xl rounded-bl-xl">
                                </div>
                                <div id="desc" class="flex flex-row justify-between w-full">
                                    <div class="flex flex-col justify-center gap-3 px-5">
                                        <h1 class="font-semibold text-xl">{{ $item['nama'] }}</h1>
                                        <a href="" class="text-sm text-gray-500">Tambahkan
                                            catatan</a>
                                        <h2 class="text-[#F9832A] font-semibold text-lg">
                                            Rp. {{number_format($item['harga'], 0, ',', '.')}}
                                        </h2>
                                    </div>
                                    <!-- Increament Button (PR POL) -->
                                    <div id="count" class="flex flex-col items-center bg-white shadow-lg justify-between mr-2 my-auto rounded-lg w-[2.5rem] h-full">
                                        <button id="increment" type="button" value="{{ $item['id'] }}" class="bg-[#EEEEEE] transition-all duration-300 rounded-xl scale-100 shadow-md flex w-[2.5rem] flex-col justify-center items-center h-[2.5rem] font-bold">
                                            <svg height="25" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.16809 3.24121V11.4823" stroke="#F9832A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M3.40259 7.36157H10.9335" stroke="#F9832A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        <input id="number" type="number" name="items[quantity][]" onchange="calculateTotal()" class="font-semibold bg-transparent w-[2.5rem] border-none text-center focus:border-none focus:ring-0" value="{{ $item['jumlah'] }}" readonly />

                                        <button id="decrement" type="button" value="{{ $item['id'] }}" class="bg-[#EEEEEE] transition-all duration-300 rounded-xl scale-100 shadow-md flex w-[2.5rem] flex-col justify-center items-center h-[2.5rem] font-bold">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3.53027 8H12.0151" stroke="#2B2B2B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>

                                        <button id="delete" value="{{ $item['id'] }}" class="hidden delete transition-all duration-300 bg-[#FF8080] rounded-xl scale-100 shadow-md w-[2.5rem] flex-col justify-center items-center h-[2.5rem] font-bold">
                                            <svg height="23" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.36136 12.1029C1.36136 12.4932 1.52167 12.8675 1.80702 13.1435C2.09236 13.4195 2.47938 13.5745 2.88292 13.5745H8.96914C9.37269 13.5745 9.7597 13.4195 10.045 13.1435C10.3304 12.8675 10.4907 12.4932 10.4907 12.1029V3.2731H1.36136V12.1029ZM2.88292 4.74473H8.96914V12.1029H2.88292V4.74473ZM8.58876 1.06565L7.82798 0.329834H4.02409L3.26331 1.06565H0.600586V2.53728H11.2515V1.06565H8.58876Z" fill="#EEEEEE" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <input type="hidden" name="items[harga][]" value="{{ $item['harga'] }}">
                <input type="hidden" name="items[id][]" value="{{ $item['id'] }}">
                @endforeach
            </div>
            </form>
            <form action="{{ route('cart.delete') }}" method="POST" class="delete-form hidden">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" id="deleteInput">
            </form>
        </div>
        {{-- End Card List Pesanan --}}
    </section>
</div>
{{-- End Title Warung --}}
{{-- <div class="bg-[#F0F3F8] w-full h-5"></div> --}}
</div>

<div id="overlayAddNewAddress" onclick="renderHideListAddress()" class="bg-black/10 transition-all duration-500 invisible opacity-0 -z-10 h-screen w-full absolute top-0 left-0">
</div>

<div id="addNewAddress" class="w-full pt-5 pb-14 flex flex-col items-center gap-5 border overflow-auto fixed h-0 bg-white rounded-3xl -bottom-96 transition-all duration-500 shadow-top-for-total-harga">
    @forelse ($AddressList as $Item)
    <div class="flex flex-row items-end gap-10 border-b-2 pb-2">
        <div class="flex flex-col gap-2">
            <h1 class="font-semibold text-lg">{{ $Item['Title'] }}</h1>
            <div id="location" class="flex flex-row gap-2 items-center">
                <img src="markLocation.svg" alt="" class="w-5">
                <h1 class="text-wrapper-location">{{ $Item['Alamat'] }}</h1>
            </div>
        </div>
        <img src="edit.svg" alt="" class="w-5">
    </div>
    @empty
    @endforelse
</div>

<div id="totalAndAddress">
    @php $total = 0; @endphp
    @foreach ($data as $item)
    @php $total += $item['harga'] * $item['jumlah']; @endphp
    @endforeach
    <div id="content" class="fixed border-[2.5px] border-black/10 flex flex-row justify-around rounded-2xl h-48 pt-5 w-full left-0 bottom-0 bg-white shadow-top-for-total-harga">
        <button id="alamat" class="flex flex-row gap-3 items-center border-2 border-[#F9832A] p-3 h-12 rounded-lg">
            <img src="Map.svg" alt="" class="w-6">
            <div id="desc" class="flex flex-row gap-2 items-center">
                <h1 class="text-[#5e5e5e] font-medium">Masukkan alamat Anda</h1>
                <img src="ArrowTop.svg" alt="">
            </div>
        </button>
        <div id="totalHarga" class="flex flex-row gap-5">
            <div id="descTotalHarga" class="text-center">
                <h1>Total Harga</h1>
                <p id="total_harga" class=" font-semibold border-b-2 border-[#F9832A]">Rp. {{ number_format($total, 0, ',', '.') }}</p>
            </div>
            <div id="buttonTotalHarga">
                <a href="{{ route('checkout') }}">
                    <button class="bg-[#F9832A] h-10 w-24 text-white font-semibold rounded-xl">
                        Pesan
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
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
</script>
@endpush