<x-courier-layout>
    <div class="flex flex-col gap-5 items-center justify-start bg-[#F0F3F8]">
        {{--PhotoProfile, Nama, email, no.tlp. Dan section pengaturan--}}
        <div class="profile-section text-center mt-2">
            <img class="w-32 h-32 rounded-full mx-auto" src="{{ asset('logoDkampus.png') }}" alt="">
            <h2 class="text-2xl font-bold">{{ Auth::user()->nama_user ?? 'null' }}</h2>
            <p class="text-lg">{{ Auth::user()->email ?? 'null' }}</p>
            <p class="text-lg">{{ Auth::user()->no_telp ?? 'null' }}</p>
        </div>
    </div>
    <div class="bg-[#F0F3F8] flex flex-col gap-2 justify-start">
        <h1 class="text-xl font-bold text-black mx-5 mt-10">Pengaturan Akun</h1>
        <div class="flex flex-col items-start justify-start mx-5">
            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-full text-center">
                Ubah Password
            </a>
        </div>
        <div class="flex flex-col items-start justify-start mx-5">
            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-full text-center">
                Ubah Nomor Telepon
            </a>
        </div>
        <div class="flex flex-col items-start justify-start mx-5">
            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-full text-center opacity-50 cursor-not-allowed">
                Photo Profile
            </a>
        </div>
    </div>
    <div class="bg-[#F0F3F8] flex flex-col gap-2 justify-start">
        <h1 class="text-xl font-bold text-black mx-5 mt-10">Seputar DKampus</h1>
        <div class="flex flex-col items-start justify-start mx-5">
            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-full text-center">
                Tentang Kami
            </a>
        </div>
        <div class="flex flex-col items-start justify-start mx-5">
            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-full text-center">
                Hubungi Kami
            </a>
        </div>
        <div class="flex flex-col items-start justify-start mx-5">
            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-full text-center">
                Syarat dan Ketentuan
            </a>
        </div>
        <div class="flex flex-col items-center justify-start mx-5 my-10">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full text-center">
                    Logout
                </button>
            </form>
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
</x-courier-layout>
<script>

</script>
