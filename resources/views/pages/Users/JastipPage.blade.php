@extends('layouts.Root')
@section('content')
<header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10">
    {{-- Topbar --}}
    @include('components.header.topbar')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy7Wqkn0A1tWbQf9-LnGum9UucUooaQXY&libraries=places&callback=initAutocomplete" defer></script>
</header>
<main class="px-3 md:mx-2 md:mb-40">
    <section class="bg-white rounded-lg shadow-md p-6 md:p-8 h-auto h-screen mb-28 overflow-y-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Dkampus Jasa Titip (Jastip)</h2>

        <form action="{{ route('jastip.order') }}" method="POST">
            @csrf
            <div id="warungContainer">
                <div class="warung mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Warung:</label>
                    <div class="flex item-center mb-2">
                        <input type="text" name="warung[]" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50" placeholder="Nama UMKM pilihanmu" required>
                        <button type="button" class="ml-2 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-1 px-2 rounded-md" onclick="removeWarung(this)">-</button>
                    </div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">Menu:</label>
                    <div class="menuContainer">
                        <div class="menu flex items-center mb-2">
                            <input type="text" name="nama_menu[][]" placeholder="Nama Menu" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50" required>
                            <input type="number" name="kuantitas[][]" placeholder="Jumlah" min="1" class="mt-1 p-2 ml-2 w-20 border rounded-md focus:ring focus:ring-opacity-50" required>
                            <button type="button" class="ml-2 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-1 px-2 rounded-md" onclick="removeMenu(this)">-</button>
                        </div>
                    </div>
                    <button type="button" class="mb-4 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-2 px-4 rounded-md" onclick="addMenu(this)">Tambah Menu</button>
                </div>
            </div>
            <button type="button" class="mb-4 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-2 px-4 rounded-md" onclick="addWarung()">Tambah Warung</button>

            <div class="mb-4">
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Warung:</label>
                <input type="text" id="alamat" name="alamat" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50">
                <input type="text" id="geo" name="geo" class="hidden">
                <input type="text" id="link" name="link" class="hidden">
                <script>
                    var autocomplete;

                    function initAutocomplete() {
                        var input = document.getElementById('alamat');
                        autocomplete = new google.maps.places.Autocomplete(input);

                        autocomplete.addListener('place_changed', function() {
                            var place = autocomplete.getPlace();
                            if (!place.geometry || !place.place_id) {
                                alert("No details available for input: '" + place.name + "'");
                                return;
                            }
                            var latitude = place.geometry.location.lat();
                            var longitude = place.geometry.location.lng();
                            var combinedLocation = `${latitude},${longitude}`;
                            console.log(combinedLocation, latitude, longitude);
                            var googleMapsLink = place.url;
                            console.log(googleMapsLink);
                            document.getElementById('link').value = googleMapsLink;
                            $('#geo').val(combinedLocation);
                        });
                    }
                </script>
                {{-- Notes info --}}
                <span class="text-xs text-gray-500">*Masukan alamat lengkap warung yang dituju, dan jika lebih dari 1 warung tolong yang searah antar warung</span>
            </div>

            <div class="mb-6">
                <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan Tambahan:</label>
                <textarea id="catatan" name="catatan" rows="3" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50"></textarea>
                {{-- Notes info --}}
                <span class="text-xs text-gray-500">*Catatan tambahan untuk driver, seperti menu/lokasi warung/lokasi pengantaran.</span>
            </div>

            <div class="flex justify-between items-center">
                <a id="alamatshow" class="flex flex-row gap-3 items-center border-2 border-[#F9832A] p-3 h-12 rounded-lg">
                    <img src="Map.svg" alt="" class="w-6">
                    <div id="desc" class="flex flex-row gap-2 items-center">
                        @if ($alamatUtama !== null)
                        <h1 class="text-[#5e5e5e] font-medium" id="selected_address">{{ $alamatUtama->nama_alamat }}</h1>
                        <input type="text" class="hidden" id="selected_address_id" name="selected_address_id" value="{{ $alamatUtama->id }}">
                        @else
                        <h1 class="text-[#5e5e5e] font-medium" id="selected_address">Masukan Alamat</h1>
                        <input type="text" class="hidden" id="selected_address_id" name="selected_address_id" value="">
                        @endif
                        <img src="ArrowTop.svg" alt="">
                    </div>
                </a>
                <button type="submit" class="bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-2 px-4 rounded-md">
                    Kirim
                </button>
            </div>

            <div id="overlayAddNewAddress" onclick="renderHideListAddress()" class="bg-black/10 transition-all duration-500 invisible opacity-0 -z-10 h-screen w-full absolute top-0 left-0"></div>
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
        </form>
    </section>
</main>
<footer class="fixed bottom-0 left-0 w-full bg-white z-10">
    {{-- Bottombar --}}
    @include('components.navbar.navbar')
</footer>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function renderHideListAddress() {
        const listAddNewAddress = document.getElementById("addNewAddress");
        const overlayAddNewAddress = document.getElementById("overlayAddNewAddress");

        if (listAddNewAddress && overlayAddNewAddress) {
            listAddNewAddress.style.height = "0rem";
            listAddNewAddress.style.bottom = "-99rem";

            document.body.style.overflow = "auto";

            overlayAddNewAddress.style.visibility = "invisible";
            overlayAddNewAddress.style.opacity = "0";
            overlayAddNewAddress.style.zIndex = "-10";
        }
    }

    $(document).ready(function() {
        const listAddNewAddress = document.getElementById("addNewAddress");
        const overlayAddNewAddress = document.getElementById("overlayAddNewAddress");
        const ToggleAddress = document.getElementById("alamatshow");

        const state = {
            condition: false,
            count: 1,
        };

        function renderShowListAddress() {
            if (state.condition) {
                listAddNewAddress.style.height = "24rem";
                listAddNewAddress.style.bottom = "10rem";

                document.body.style.overflow = "hidden";

                overlayAddNewAddress.style.visibility = "visible";
                overlayAddNewAddress.style.opacity = "100";
                overlayAddNewAddress.style.zIndex = "0";
            } else {
                renderHideListAddress();
            }
        }

        function toggleState() {
            state.condition = !state.condition;
            renderShowListAddress();
        }

        if (overlayAddNewAddress && ToggleAddress) {
            overlayAddNewAddress.addEventListener("click", toggleState);
            ToggleAddress.addEventListener("click", toggleState);
        }
    });


    function addMenu(button) {
        const menuContainer = button.previousElementSibling;
        const newMenuInput = document.createElement('div');
        newMenuInput.classList.add('menu', 'flex', 'items-center', 'mb-2');
        newMenuInput.innerHTML = `
        <input type="text" name="nama_menu[][]" placeholder="Nama Menu" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50" required>
        <input type="number" name="kuantitas[][]" placeholder="Jumlah" min="1" class="mt-1 p-2 ml-2 w-20 border rounded-md focus:ring focus:ring-opacity-50" required>
        <button type="button" class="ml-2 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-1 px-2 rounded-md" onclick="removeMenu(this)">-</button>
    `;
        menuContainer.appendChild(newMenuInput);
    }

    function removeMenu(button) {
        button.parentNode.remove();
    }

    function removeWarung(button) {
        const warungElement = button.parentNode.parentNode;
        warungElement.remove();
    }

    function addWarung() {
        const warungContainer = document.getElementById('warungContainer');
        const newWarungInput = document.createElement('div');
        newWarungInput.classList.add('warung', 'mb-4');
        newWarungInput.innerHTML = `
        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Warung:</label>
        <div class="flex item-center mb-2">
            <input type="text" name="warung[]" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50" placeholder="Nama UMKM pilihanmu" required>
            <button type="button" class="ml-2 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-1 px-2 rounded-md" onclick="removeWarung(this)">-</button>
        </div>

        <label class="block text-sm font-medium text-gray-700 mb-2">Menu:</label>
        <div class="menuContainer">
            <div class="menu flex items-center mb-2">
                <input type="text" name="nama_menu[][]" placeholder="Nama Menu" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50" required>
                <input type="number" name="kuantitas[][]" placeholder="Jumlah" min="1" class="mt-1 p-2 ml-2 w-20 border rounded-md focus:ring focus:ring-opacity-50" required>
                <button type="button" class="ml-2 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-1 px-2 rounded-md" onclick="removeMenu(this)">-</button>
            </div>
        </div>
        <button type="button" class="mb-4 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-2 px-4 rounded-md" onclick="addMenu(this)">Tambah Menu</button>
    `;
        warungContainer.appendChild(newWarungInput);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const addressButtons = document.querySelectorAll('.address-button');
        const selectedAddressElement = document.getElementById('selected_address');
        const selectedAddressIdInput = document.getElementById('selected_address_id');

        addressButtons.forEach(button => {
            button.addEventListener('click', function() {
                const addressName = this.getAttribute('data-name');
                const addressId = this.getAttribute('data-id');

                selectedAddressElement.textContent = addressName;

                selectedAddressIdInput.value = addressId;
            });
        });
    });
</script>
<style>
    /* Style the "powered by Google" attribution */
    .pac-container:after {
        content: none !important;
    }
</style>
