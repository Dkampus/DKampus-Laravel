@extends('layouts.Root')
@section('content')
    @include('components.header.courierHeader')
    <div class="bg-[#F0F3F8] flex flex-col items-center justify-center mb-48">
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
                    <a href="#" class="bg-[#F9832A] hover:bg-[#F9832A] text-white font-bold py-2 px-4 rounded-md text-center" data-modal-show="ubahPasswordModal">
                        Ubah Password
                    </a>
                    <a href="#" class="bg-[#F9832A] hover:bg-[#F9832A] text-white font-bold py-2 px-4 rounded-md text-center" data-modal-show="ubahNomorTeleponModal">
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
                    <a href="#" class="bg-[#F9832A] hover:bg-[#F9832A] text-white font-bold py-2 px-4 rounded-md text-center">
                        Tentang Kami
                    </a>
                    <a href="#" class="bg-[#F9832A] hover:bg-[#F9832A] text-white font-bold py-2 px-4 rounded-md text-center">
                        Hubungi Kami
                    </a>
                    <a href="#" class="bg-[#F9832A] hover:bg-[#F9832A] text-white font-bold py-2 px-4 rounded-md text-center">
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
    <div id="ubahPasswordModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 bottom-0 z-50 hidden w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="ubahPasswordModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="py-6 px-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900">Ubah Password</h3>
                    <form class="space-y-6" action="#">
                        {{-- ... (Form untuk ubah password) ... --}}
                        <div class="flex flex-col space-y-1">
                            <label for="password" class="text-sm font-medium text-gray-700">Password Lama</label>
                            <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="new-password" class="text-sm font-medium text-gray-700">Password Baru</label>
                            <input type="password" id="new-password" name="new-password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="confirm-password" class="text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                            <input type="password" id="confirm-password" name="confirm-password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="flex flex-row justify-end space-x-4">
                            <button type="button" class="bg-red-500 text-white font-semibold py-2 px-4 rounded-md" data-modal-hide="ubahPasswordModal">Batal</button>
                            <button type="submit" class="bg-[#F9832A] hover:bg-[#F9832A] text-white font-semibold py-2 px-4 rounded-md">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Ubah Nomor Telepon --}}
    <div id="ubahNomorTeleponModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 bottom-0 z-50 hidden w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="ubahNomorTeleponModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="py-6 px-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900">Ubah Nomor Telepon</h3>
                    <form class="space-y-6" action="#">
                        {{-- ... (Form untuk ubah nomor telepon) ... --}}
                        <div class="flex flex-col space-y-1">
                            <label for="no-telp" class="text-sm font-medium text-gray-700">Nomor Telepon Baru</label>
                            <input type="tel" id="no-telp" name="no-telp" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="flex flex-row justify-end space-x-4">
                            <button type="button" class="bg-red-500 text-white font-semibold py-2 px-4 rounded-md" data-modal-hide="ubahNomorTeleponModal">Batal</button>
                            <button type="submit" class="bg-[#F9832A] hover:bg-[#F9832A] text-white font-semibold py-2 px-4 rounded-md">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('components.navbar.navbarCourier')
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalUbahPassword = document.getElementById('ubahPasswordModal');
        const modalUbahNomorTelepon = document.getElementById('ubahNomorTeleponModal');

        const modalUbahPasswordShow = Array.from(document.querySelectorAll('[data-modal-show="ubahPasswordModal"]'));
        const modalUbahNomorTeleponShow = Array.from(document.querySelectorAll('[data-modal-show="ubahNomorTeleponModal"]'));

        const modalUbahPasswordHide = Array.from(document.querySelectorAll('[data-modal-hide="ubahPasswordModal"]'));
        const modalUbahNomorTeleponHide = Array.from(document.querySelectorAll('[data-modal-hide="ubahNomorTeleponModal"]'));

        modalUbahPasswordShow.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                modalUbahPassword.classList.remove('hidden');
                modalUbahPassword.classList.add('flex');
            });
        });

        modalUbahNomorTeleponShow.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                modalUbahNomorTelepon.classList.remove('hidden');
                modalUbahNomorTelepon.classList.add('flex');
            });
        });

        modalUbahPasswordHide.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                modalUbahPassword.classList.remove('flex');
                modalUbahPassword.classList.add('hidden');
            });
        });

        modalUbahNomorTeleponHide.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                modalUbahNomorTelepon.classList.remove('flex');
                modalUbahNomorTelepon.classList.add('hidden');
            });
        });
    });
</script>
