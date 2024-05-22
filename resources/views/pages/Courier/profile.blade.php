@extends('layouts.Root')
@section('content')
    @include('components.header.courierHeader')
    <div class="bg-[#F0F3F8] flex flex-col items-center justify-center">
        <div class="w-full h-full space-y-8 bg-white rounded-lg p-8">
            <div class="profile-section text-center">
                <img class="w-24 h-24 rounded-full mx-auto object-cover" src="{{ asset('logoDkampus.png') }}" alt="Profil Picture">
                <h2 class="text-2xl font-semibold mt-4">{{ Auth::user()->nama_user ?? 'null' }}</h2>
                <p class="text-gray-600">{{ Auth::user()->email ?? 'null' }}</p>
                <p class="text-gray-600">{{ Auth::user()->no_telp ?? 'null' }}</p>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Pengaturan Akun</h3>
                <div class="grid grid-cols-1 gap-4">
                    <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md text-center">
                        Ubah Password
                    </a>
                    <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md text-center">
                        Ubah Nomor Telepon
                    </a>
                    <a href="#" class="bg-gray-300 text-gray-500 py-2 px-4 rounded-md text-center cursor-not-allowed">
                        Photo Profile (Segera hadir)
                    </a>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Seputar DKampus</h3>
                <div class="grid grid-cols-1 gap-4">
                    <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md text-center">
                        Tentang Kami
                    </a>
                    <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md text-center">
                        Hubungi Kami
                    </a>
                    <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md text-center">
                        Syarat dan Ketentuan
                    </a>
                </div>
            </div>

            <div class="mt-8 text-center">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Ubah Password --}}
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full md:max-w-xl" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <form action="#" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                    Ubah Password
                                </h3>
                                <div class="mt-2">
                                    <div class="mb-2">
                                        <label for="password" class="block text-sm font-medium text-gray-700">Password Lama</label>
                                        <input type="password" name="password" id="password" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Password Lama">
                                    </div>
                                    <div class="mb-2">
                                        <label for="new-password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                                        <input type="password" name="new-password" id="new-password" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Password Baru">
                                    </div>
                                    <div class="mb-2">
                                        <label for="confirm-password" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                                        <input type="password" name="confirm-password" id="confirm-password" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Konfirmasi Password Baru">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#F9832A] text-base font-medium text-white hover:bg-[#F9832A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Ubah Password
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{--Modal ubah nomor telepon--}}
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full md:max-w-xl" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <form action="#" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                    Ubah Nomor Telepon
                                </h3>
                                <div class="mt-2">
                                    <div class="mb-2">
                                        <label for="no-telp" class="block text-sm font-medium text-gray-700">Nomor Telepon Baru</label>
                                        <input type="text" name="no-telp" id="no-telp" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Nomor Telepon Baru">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#F9832A] text-base font-medium text-white hover:bg-[#F9832A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm w-auto sm:text-sm">
                        Ubah Nomor Telepon
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
    @include('components.navbar.navbarCourier')
@endsection
