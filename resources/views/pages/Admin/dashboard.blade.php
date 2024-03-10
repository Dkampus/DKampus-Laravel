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

            <div class="bg-white dark:bg-gray-800 h-[400px] overflow-y-auto hidden-scrol shadow-sm sm:rounded-lg mt-4">
            <table class="border-collapse table-auto w-full text-sm  relative">
                <thead class="sticky top-0 bg-slate-950/70 backdrop-blur-sm">
                  <tr>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-white text-left">Logo UMKM</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-white text-left">Nama UMKM</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-3 pb-3 text-slate-400 dark:text-white text-left">Aksi</th>
                  </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800">
                @if (count($data_umkm) == 0)
                    <tr>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">-</td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">Tidak ada data</td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400 flex flex-col">
                            <a class="py-1 text-center font-semibold text-sm bg-green-400 text-white rounded-full shadow-sm mb-2">View</a>
                            <a class="py-1 text-center font-semibold text-sm bg-cyan-500 text-white rounded-full shadow-sm mb-2">Edit</a>
                            <a class="py-1 text-center font-semibold text-sm bg-red-400 text-white rounded-full shadow-sm mb-2">Delete</a>
                        </td>
                    </tr>

                @else
                    @foreach ($data_umkm as $data)
                    <tr>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"><img class="h-24 rounded-lg" src="{{Storage::url($data->logo_umkm)}}" alt=""></td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $data->nama_umkm }}</td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400 flex flex-col">
                            <a href="" class="py-1 text-center font-semibold text-sm bg-green-400 text-white rounded-full shadow-sm mb-2">View</a>
                            <a href="umkm/{{$data->id}}/edit" class="py-1 text-center font-semibold text-sm bg-cyan-500 text-white rounded-full shadow-sm mb-2">Edit</a>
                            <form action="{{ route("umkm.destroy", $data) }}" method="POST" class="delete-form w-full">
                                @csrf
                                @method("DELETE")
                            <button value="{{ $data->nama_umkm }}" class="w-full delete-button py-1 text-center font-semibold text-sm bg-red-400 text-white rounded-full shadow-sm mb-2">Delete</button>
                        </form>
                        </td>
                    </tr>
                    @endforeach

                @endif

                </tbody>
              </table>
            </div>
        </div>
        {{-- disini adalah panel untuk menampilkan angka banyaknya data umkm, menu, user, dan transaksi --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-4 mx-2">
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
                            <div class="text-l font-semibold text-black">0</div>
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
                            <div class="text-l font-semibold text-black">0</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items center justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold">Transaksi</h2>
                            <p class="text-gray-500 dark:text-gray-400">Detail dari semua Transaksi</p>
                        </div>
                        <div class="flex items-center justify-center bg-white h-12 w-12 rounded-full">
                            <div class="text-l font-semibold text-black">0</div>
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
