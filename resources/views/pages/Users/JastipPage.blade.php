@extends('layouts.Root')
@section('content')
<header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10">
    {{-- Topbar --}}
    @include('components.header.topbar')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3zz718wI8G9tqVt4YkjjRSv_YHg9yPag&libraries=places&callback=initAutocomplete" defer></script>
</header>
<main class="px-3 md:mx-2 md:mb-40">
    <section class="bg-white rounded-lg shadow-md p-6 md:p-8 h-auto h-screen mb-28 overflow-y-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Dkampus Jasa Titip (Jastip)</h2>

        <form action="{{ route('jastip.order') }}" method="POST">
            @csrf
            <div id="warungContainer">
                {{-- Switch button untuk memilih jenis jastip apakah makanan/barang saja --}}
                <div class="flex justify-between items-center mb-4">
                    <label for="jenisJastip" class="block text-sm font-medium text-gray-700">Jenis Jastip:</label>
                    <button type="button" role="switch" aria-checked="true" aria-labelledby="jenisJastip" class="relative inline-flex items-center cursor-pointer switch-button">
                        <span class="mr-3 text-gray-700">Makanan</span>
                        <input type="checkbox" name="jenisJastip" id="jenisJastip" value="makanan" checked class="sr-only">
                        <span class="switch-track w-11 h-6 bg-[#F9832A] rounded-full p-0.5 flex items-center justify-start transition-colors duration-200 ease-in-out" aria-hidden="true">
                            <span class="switch-thumb w-5 h-5 bg-white rounded-full shadow-md transform transition-transform duration-200 ease-in-out"></span>
                        </span>
                        <span class="ml-3 text-gray-700">Barang</span>
                    </button>
                </div>


                <div class="warung mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Warung:</label>
                    <div class="flex item-center mb-2">
                        <input type="text" name="warung[]" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50" placeholder="Nama UMKM pilihanmu" required>
                        <button type="button" class="ml-2 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-1 px-2 rounded-md" onclick="removeWarung(this)">-</button>
                    </div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">Menu/Barang:</label>
                    <div class="menuContainer">
                        <div class="menu flex items-center mb-2">
                            <input type="text" name="nama_menu[0][]" placeholder="Nama Menu/Barang" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50" required>
                            <input type="number" name="kuantitas[0][]" placeholder="Jumlah" min="1" class="mt-1 p-2 ml-2 w-20 border rounded-md focus:ring focus:ring-opacity-50" required>
                            <button type="button" class="ml-2 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-1 px-2 rounded-md" onclick="removeMenu(this)">-</button>
                        </div>
                    </div>
                    <button type="button" class="mb-4 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-2 px-4 rounded-md" onclick="addMenu(this, this.dataset.index)" data-index="0">Tambah Menu/Barang</button>
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
            <div id="addNewAddress" class="w-[85%] sm:w-full md:w-[28rem] pt-5 pb-14 flex flex-col items-center gap-5 border overflow-auto fixed h-0 bg-white rounded-3xl -bottom-96 transition-all duration-500 shadow-top-for-total-harga">
                @if ($AddressList !== null)
                @forelse ($AddressList as $Item)
                <div class="flex flex-row items-end gap-10 border-b-2 pb-2 w-[85%] sm:w-full md:w-[28rem]">
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
        //disable sidebar menu and hide remove
        let sidebar = document.querySelector('button[onclick="showMenu()"]');
        sidebar.remove();

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

    function addMenu(button, warungIndex) {
        const menuContainer = button.closest('.warung').querySelector('.menuContainer');
        const newMenuInput = document.createElement('div');
        newMenuInput.classList.add('menu', 'flex', 'items-center', 'mb-2');
        newMenuInput.innerHTML = `
        <input type="text" name="nama_menu[${warungIndex}][]" placeholder="Nama Menu/Barang" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50" required>
        <input type="number" name="kuantitas[${warungIndex}][]" placeholder="Jumlah" min="1" class="mt-1 p-2 ml-2 w-20 border rounded-md focus:ring focus:ring-opacity-50" required>
        <button type="button" class="ml-2 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-1 px-2 rounded-md" onclick="removeMenu(this)">-</button>
    `;
        menuContainer.appendChild(newMenuInput);
    }

    function removeMenu(button) {
        button.parentNode.remove();
    }

    let warungIndex = 1;

    function removeWarung(button) {
        const warungElement = button.parentNode.parentNode;
        warungElement.remove();
        warungIndex--;
        if (warungIndex != 4) {
            let buttonAddWarung = document.querySelector('button[onclick="addWarung()"]');
            buttonAddWarung.disabled = false;
            buttonAddWarung.className = 'mb-4 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-2 px-4 rounded-md';
        }
    }


    function addWarung() {
        const warungContainer = document.getElementById('warungContainer');
        const newWarungInput = document.createElement('div');
        newWarungInput.classList.add('warung', 'mb-4');
        //limit if warungIndex > 4
        try {
            if (warungIndex < 4) {
                newWarungInput.innerHTML = `
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Warung:</label>
                <div class="flex item-center mb-2">
                    <input type="text" name="warung[]" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50" placeholder="Nama UMKM pilihanmu" required>
                    <button type="button" class="ml-2 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-1 px-2 rounded-md" onclick="removeWarung(this)">-</button>
                </div>

                <label class="block text-sm font-medium text-gray-700 mb-2">Menu/Barang:</label>
                <div class="menuContainer">
                    <div class="menu flex items-center mb-2">
                        <input type="text" name="nama_menu[${warungIndex}][]" placeholder="Nama Menu/Barang" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50" required>
                        <input type="number" name="kuantitas[${warungIndex}][]" placeholder="Jumlah" min="1" class="mt-1 p-2 ml-2 w-20 border rounded-md focus:ring focus:ring-opacity-50" required>
                        <button type="button" class="ml-2 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-1 px-2 rounded-md" onclick="removeMenu(this)">-</button>
                    </div>
                </div>
                <button type="button" class="mb-4 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-2 px-4 rounded-md" onclick="addMenu(this, this.dataset.index)" data-index="${warungIndex}">Tambah Menu/Barang</button>
            `;
                warungContainer.appendChild(newWarungInput);
                warungIndex++;
            } else {
                //disable button add warung
                let buttonAddWarung = document.querySelector('button[onclick="addWarung()"]');
                buttonAddWarung.disabled = true;
                buttonAddWarung.classList.add('bg-gray-300', 'cursor-not-allowed');
                throw new Error('Limit of warung has been reached');
            }
        } catch (error) {}
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

    document.addEventListener('DOMContentLoaded', function() {
        const switchButton = document.querySelector('.switch-button');
        const switchTrack = switchButton.querySelector('.switch-track');
        const switchThumb = switchButton.querySelector('.switch-thumb');
        const switchValue = document.getElementById('jenisJastip');

        switchButton.addEventListener('click', () => {
            const isChecked = switchButton.getAttribute('aria-checked') === 'true';
            switchButton.setAttribute('aria-checked', !isChecked);

            if (!isChecked) {
                switchTrack.classList.add('bg-[#F9832A]');
                switchThumb.style.transform = 'translateX(calc(100% - 1.25rem))';
                switchValue.value = 'makanan';
            } else {
                switchThumb.style.transform = 'translateX(100%)';
                switchValue.value = 'barang';
            }
        });
    });
</script>
<style>
    /* Style the "powered by Google" attribution */
    .pac-container:after {
        content: none !important;
    }

    /* Add this to your CSS file or <style> tag */
    .switch-button:focus .switch-track,
    .switch-button:focus-visible .switch-track {
        /* Style focus state */
        box-shadow: 0 0 0 3px rgba(249, 131, 42, 0.4);
    }

    /* Ensure the address is fully visible */
    .pac-item {
        white-space: normal;
        line-height: 1.5;
    }

    /* Adjust the container to allow more space for the address */
    .pac-container {
        max-height: 400px;
        /* Adjust the height as needed */
        overflow-y: auto;
    }

    /* Hide the location icon on the left side of the address suggestions */
    .pac-item .pac-icon {
        display: none;
    }

    /* Optional: Better spacing for address items */
    .pac-item-query {
        margin-bottom: 5px;
    }
</style>