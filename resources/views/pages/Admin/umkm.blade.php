<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('UMKM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">UMKM yang terdaftar</h1>

                    <!-- Button trigger modal -->
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-bs-toggle="modal" data-bs-target="#umkmModal">
                        Tambah UMKM
                    </button>

                    <!-- Table for displaying UMKM data -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Nama UMKM</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Logo UMKM</th>
                            <th scope="col">No. Telp</th>
                            <th scope="col" class="px-1 py-2">VIP</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($umkms as $umkm)
                            <tr>
                                <td>{{ $umkm->nama_umkm }}</td>
                                <td>{{ $umkm->alamat }}</td>
                                <td><img src="{{ Storage::url($umkm->logo_umkm) }}" alt="umkm_img" width="50"></td>
                                <td>{{ $umkm->no_telp_umkm }}</td>
                                <td class="px-1 py-2">{{ $umkm->vip ? '✓' : '🗙' }}</td>
                                <td class="flex flex-col items-center">
                                    <!-- View button -->
                                    <a href="{{ route('umkm.show', $umkm->id) }}" class="text-center">View</a>

                                    <!-- Edit button -->
                                    <a href="{{ route('umkm.edit', $umkm->id) }}" class="text-center">Edit</a>

                                    <!-- Delete button -->
                                    <form action="{{ route('umkm.destroy', $umkm->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-center">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination links -->
                    <div class="mt-4">
                        {{ $umkms->links() }}
                    </div>
                </div>

                <!-- Modal -->
                <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="modalumkm">
                    <div class="flex items end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-200" id="modal-headline">
                                            Tambah UMKM
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            @auth
                            <form action="{{ route('umkm.store') }}" method="POST" id="umkmForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="mb-4">
                                        <label for="nama_umkm" class="block text sm font-medium text-gray-700 dark:text-gray-200">Nama UMKM</label>
                                        <input type="text" name="nama_umkm" id="nama_umkm" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="alamat" class="block text sm font-medium text-gray-700 dark:text-gray-200">Alamat</label>
                                        <input type="text" name="alamat" id="alamat" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="no_telp_umkm" class="block text sm font-medium text-gray-700 dark:text-gray-200">No. Telp</label>
                                        <input type="text" name="no_telp_umkm" id="no_telp_umkm" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="logo_umkm" class="block text sm font-medium text-gray-700 dark:text-gray-200">Logo UMKM</label>
                                        <input type="file" name="logo_umkm" id="logo_umkm" class="form-input rounded-md shadow-sm mt-1 block w-full" onchange="previewImage()" required>
                                        <div id="image-preview" class="hidden mt-2">
                                            <img id="preview" class="rounded-md shadow-sm" alt="Image preview" width="100">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="vip" class="block text sm font-medium text-gray-700 dark:text-gray-200">VIP</label>
                                        <input type="radio" name="vip" id="vip" value="1" class="form-radio" required>
                                        <label for="vip" class="mr-2 text-sm text-gray-500 dark:text-gray-200">Ya</label>
                                        <input type="radio" name="vip" id="vip" value="0" class="form-radio" required>
                                        <label for="vip" class="text-sm text-gray-500 dark:text-gray-200">Tidak</label>
                                        <div class="text-sm text-gray-500 dark:text-gray-200">VIP UMKM akan mendapatkan featured dan benefit lainnya.</div>
                                    </div>
                                    {{-- save and cancel button --}}
                                    <div class="mt-4">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                                        <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="document.getElementById('modalumkm').classList.add('hidden')">Batal</button>
                                    </div>
                                </div>
                            </form>
                            @endauth
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
        function previewImage() {
            var input = document.getElementById('logo_umkm');
            var preview = document.getElementById('preview');
            var imagePreview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
                imagePreview.classList.remove('hidden');
            } else {
                imagePreview.classList.add('hidden');
            }
        }

        document.getElementById('umkmForm').addEventListener('submit', function(event) {
            var inputs = this.querySelectorAll('input, textarea');
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].value === '') {
                    event.preventDefault();
                    alert('Harap isi semua field sebelum submit!');
                    return;
                }
            }
        });
    </script>
</x-app-layout>
<script>
    document.querySelector('[data-bs-target="#umkmModal"]').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('modalumkm').classList.remove('hidden');
    });
</script>
