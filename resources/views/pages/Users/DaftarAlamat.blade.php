@extends('layouts.Root')
@section('content')
    <?php
        // Temporary data
    $alamatUser = [
        [
            'Title' => 'FIT',
            'Alamat' => 'No., Jl. Sukapura No.20, Sukapura, Kec. Dayeuhkolot Kabupaten Badung',
            'linkgmap' => 'https://www.google.com/maps/place/No.,+Jl.+Sukapura+No.20,+Sukapura,+Kec.+Dayeuhkolot+Kabupaten+Badung'
        ],
        [
            'Title' => 'Rumah',
            'Alamat' => 'Kawasan pendidikan Telkom University Gg.Babakan Ciamis 3',
            'linkgmap' => 'https://www.google.com/maps/place/Kawasan+pendidikan+Telkom+University+Gg.Babakan+Ciamis+3'
        ],
        [
            'Title' => 'Kost PGA',
            'Alamat' => 'Kawasan pendidikan Telkom University Gg.PGA, Desa Lengkong',
            'linkgmap' => 'https://www.google.com/maps/place/Kawasan+pendidikan+Telkom+University+Gg.PGA,+Desa+Lengkong'
        ],
        [
            'Title' => 'FIT',
            'Alamat' => 'No., Jl. Sukapura No.20, Sukapura, Kec. Dayeuhkolot Kabupaten Badung',
            'linkgmap' => 'https://www.google.com/maps/place/No.,+Jl.+Sukapura+No.20,+Sukapura,+Kec.+Dayeuhkolot+Kabupaten+Badung'
        ],
        [
            'Title' => 'Rumah',
            'Alamat' => 'Kawasan pendidikan Telkom University Gg.Babakan Ciamis 3',
            'linkgmap' => 'https://www.google.com/maps/place/Kawasan+pendidikan+Telkom+University+Gg.Babakan+Ciamis+3'
        ],
        [
            'Title' => 'Kost PGA',
            'Alamat' => 'Kawasan pendidikan Telkom University Gg.PGA, Desa Lengkong',
            'linkgmap' => 'https://www.google.com/maps/place/Kawasan+pendidikan+Telkom+University+Gg.PGA,+Desa+Lengkong'
        ],
    ];
    ?>
    <header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-8">
        <a href="{{'/'}}" class="absolute top-5 left-5 flex items-center gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z"/>
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
                        <span class="font-bold text-black text-l">{{$alamat['Title']}}<br></span>
                        <span class="font-normal text-black text-md">{{$alamat['Alamat']}}</span>
                    </div>
                    <a href="#" id="openModal{{$key}}" class="text-blue-700" onclick="event.preventDefault(); openModalAddAddress('tambahAlamatModal', 'Edit Alamat');">Edit</a>
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
                                            {{$alamat['Title']}}
                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">
                                                {{$alamat['Alamat']}}
                                            </p>
                                            <a href="{{$alamat['linkgmap']}}" class="text-blue-500" target="_blank">View on Google Maps</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-500 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="closeModalViewDetails{{$key}}">
                                    Close
                                </button>
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
                                        <form>
                                            <div class="mb-3">
                                                <label for="namaAlamat" class="form-label text-gray-700">Nama</label>
                                                <input type="text" class="form-control border border-gray-300 rounded p-2 w-full" id="namaAlamat">
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamatLengkap" class="form-label text-gray-700">Alamat Lengkap</label>
                                                <textarea class="form-control border border-gray-300 rounded p-2 w-full" id="alamatLengkap" rows="3"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="linkGmaps" class="form-label text-gray-700">Link Gmaps</label>
                                                <input type="text" class="form-control border border-gray-300 rounded p-2 w-full" id="linkGmaps">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-500 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModalAddAddress('tambahAlamatModal')">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Save
                            </button>
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
    </main>
@endsection
