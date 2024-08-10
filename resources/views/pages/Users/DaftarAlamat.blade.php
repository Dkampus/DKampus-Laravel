@extends('layouts.Root')
@section('content')
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3zz718wI8G9tqVt4YkjjRSv_YHg9yPag&libraries=places&callback=initAutocomplete" defer></script>
<header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-8">
    <a href="{{'/'}}" class="absolute top-5 left-5 flex items-center gap-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z" />
        </svg>
        <h1 class="font-bold text-black text-xl">Daftar Alamat</h1>
    </a>
    <div class="absolute top-3 right-5">
        <a href="#" id="tambahAlamat" class="flex items-center gap-x-2 bg-orange-500 text-white px-3 py-2 rounded-md shadow-md" onclick="event.preventDefault(); openModalAddAddress('tambahAlamatModal', 'Tambah Alamat');">
            <h1 class="font-bold text-white text-md">Tambah Alamat</h1>
        </a>
    </div>
</header>
<main class="flex flex-col w-full h-full">
    @foreach($alamatUser as $key => $alamat)
    <div class="flex flex-col w-full h-auto px-1 py-3">
        <div class="flex flex-col w-full h-auto bg-white rounded-md shadow-md p-5">
            <div id="openModalViewDetails{{$key}}">
                @if ($alamat['utama'] == 1)
                <p class="flex items-center gap-x-2 bg-orange-500 text-white m-2 px-1 py-1 mr-5 rounded-md shadow-md">Alamat Utama</p>
                @endif
                <p class="font-bold text-black text-l">{{$alamat['nama_alamat']}}</p>
                <p class="font-normal text-black text-md">{{$alamat['address']}}</p>
            </div>
            {{-- <a href="#" id="openModal{{$key}}" class="text-blue-700" onclick="event.preventDefault(); openModalAddAddress('tambahAlamatModal', 'Edit Alamat');">Edit</a>--}}
            <form action="{{ route('alamatUtama') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-x-2 bg-orange-500 text-white px-3 py-2 rounded-md shadow-md mt-5">
                    <h2 class="text-white text-md">Set As Default</h2>
                    <input type="text" class="hidden" value="{{ $alamat['id'] }}" name="id">
                    <input type="text" class="hidden" value="{{ $alamat['user_id'] }}" name="custId">
                </button>
            </form>

        </div>
    </div>
    @endforeach
    @foreach($alamatUser as $key => $alamat)
    <!-- Modal view alamat-->
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="modal{{$key}}">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                {{$alamat['nama_alamat']}}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    {{$alamat['address']}}
                                </p>
                                <a href="{{$alamat['link']}}" class="text-blue-500" target="_blank">View on Google Maps</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-500 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="closeModalViewDetails{{$key}}">
                        Close
                    </button>
                    {{-- Delete alamat --}}
                    <form action="{{ route('delete.alamat') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-500 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Delete
                        </button>
                        <input type="text" class="hidden" value="{{ $alamat['id'] }}" name="id">
                        <input type="text" class="hidden" value="{{ $alamat['user_id'] }}" name="custId">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('openModalViewDetails{{$key}}').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('modal{{$key}}').classList.remove('hidden');
        });
        document.getElementById('closeModalViewDetails{{$key}}').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('modal{{$key}}').classList.add('hidden');
        });
    </script>
    @endforeach
    <!-- Modal tambah alamat-->
    <div id="tambahAlamatModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Tambah Alamat
                            </h3>
                            <div class="mt-2">
                                <form action="{{ route('daftar.alamat') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="namaAlamat" class="form-label text-gray-700">Nama</label>
                                        <input type="text" class="form-control border border-gray-300 rounded p-2 w-full" id="namaAlamat" name="namaAlamat">
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamatLengkap" class="form-label text-gray-700">Alamat Lengkap</label>
                                        <input id="autocomplete" placeholder="" class="form-control border border-gray-300 rounded p-2 w-full" type="text" name="address">
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamatLengkap" class="form-label text-gray-700">Catatan</label>
                                        <textarea id="autocomplete" placeholder="Tuliskan Alamat Lengkap Jika tidak terdaftar" class="form-control border border-gray-300 rounded p-2 w-full" type="text" name="notes"></textarea>
                                    </div>
                                    <div class="mb-3 hidden">
                                        <input type="text" class="form-control border border-gray-300 rounded p-2 w-full" id="linkGmaps" name="link">
                                        <input type="text" class="form-control border border-gray-300 rounded p-2 w-full" id="geoMaps" name="geo">
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-500 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModalAddAddress('tambahAlamatModal')">
                                            Close
                                        </button>
                                        <button type="submit" class="btn btn-primary mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        function openModalAddAddress(modalId, title) {
            document.getElementById(modalId).classList.remove('hidden');
            document.getElementById(modalId).querySelector('#modal-title').textContent = title;
        }

        function closeModalAddAddress(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
    <script>
        var autocomplete;

        function initAutocomplete() {
            var input = document.getElementById('autocomplete');
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
                document.getElementById('linkGmaps').value = googleMapsLink;
                $('#geoMaps').val(combinedLocation);
            });
        }
    </script>
</main>
@endsection