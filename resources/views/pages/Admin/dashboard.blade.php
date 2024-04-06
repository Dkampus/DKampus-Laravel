<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!, as ") }} {{ Auth::user()->nama_user }}
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items center justify-between">
                            <div>
                                <h2 class="text-2xl font-semibold">UMKM</h2>
                                <p class="text-gray-500 dark:text-gray-400">Total UMKM yang terdaftar</p>
                            </div>
                            <div class="flex items-center justify-center bg-white h-12 w-12 rounded-full">
                                <div class="text-l font-semibold text-black">{{ count($data_umkm) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items center justify-between">
                            <div>
                                <h2 class="text-2xl font-semibold">Product</h2>
                                <p class="text-gray-500 dark:text-gray-400">Total menu dari semua umkm</p>
                            </div>
                            <div class="flex items-center justify-center bg-white h-12 w-12 rounded-full">
                                <div class="text-l font-semibold text-black">{{ count($menu) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items center justify-between">
                            <div>
                                <h2 class="text-2xl font-semibold">User</h2>
                                <p class="text-gray-500 dark:text-gray-400">Total user yang terdaftar</p>
                            </div>
                            <div class="flex items-center justify-center bg-white h-12 w-12 rounded-full">
                                <div class="text-l font-semibold text-black">{{ count($user) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items center justify-between">
                            <div>
                                <h2 class="text-2xl font-semibold">Transacation</h2>
                                <p class="text-gray-500 dark:text-gray-400">Detail dari semua Transaksi</p>
                            </div>
                            <div class="flex items-center justify-center bg-white h-12 w-12 rounded-full">
                                <div class="text-l font-semibold text-black">{{ count(app(\App\Http\Controllers\TransactionController::class)->index()['datas']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('error2'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: '{{ session('error2') }}'
            })
        </script>
    @endif
    @if (session('success'))
        <script>
            const ToastSuccess = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            ToastSuccess.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            })
        </script>
    @endif
    <script>
        // Ambil semua tombol hapus
        const deleteButtons = document.querySelectorAll('.delete-button');

        // Tambahkan event listener ke setiap tombol hapus
        deleteButtons.forEach(function(button) {
            const nama_umkm = button.value;
            button.addEventListener('click', function(e) {
                // Tampilkan konfirmasi SweetAlert
                e.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi',
                    text: `Apakah Anda yakin ingin menghapus umkm ${nama_umkm}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                }).then((result) => {
                    // Jika pengguna menekan "Ya", submit form
                    if (result.isConfirmed) {
                        const form = button.closest('.delete-form');
                        form.submit();
                    }
                });
            });
        });
        </script>
</x-app-layout>
