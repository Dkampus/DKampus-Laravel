<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">List Product UMKM</h1>

                    <!-- Button trigger modal -->
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="document.getElementById('modalProductumkm').classList.remove('hidden')">
                        Tambah Product
                    </button>

                    <!-- Table for displaying UMKM data -->
                    <div class="overflow-auto">
                        <table class="min-w-full divide-y divide-gray-200 space-x-4">
                            <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 tracking-wider">Nama UMKM</th>
                                <th scope="col" class="px-6 py-3 tracking-wider">Nama Makanan</th>
                                <th scope="col" class="px-6 py-3 tracking-wider">Deskripsi</th>
{{--                                <th scope="col" class="px-6 py-3 tracking-wider">Image Makanan</th>--}}
                                <th scope="col" class="px-6 py-3 tracking-wider">Harga</th>
                                <th scope="col" class="px-6 py-3 tracking-wider">Promo</th>
                                <th scope="col" class="px-6 py-3 tracking-wider">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($menus as $menu)
                                    <tr>
                                        <td>{{ $umkms[$menu->data_umkm_id-1]->nama_umkm }}</td> {{--Ini bug atau gatau kenapa data umkm id + 1, jadi di - 1 ya wwkkwkwkw--}}
                                        <td>{{ $menu->nama_makanan }}</td>
                                        <td>{{ $menu->deskripsi }}</td>
{{--                                        <td><img src="{{ Storage::url($menu->image) }}" alt="img" class="mx-2 max-w-xs"></td>--}}
                                        <td class="text-center" title="Harga Diskon: Rp. {{ number_format($menu->harga * (1 - $menu->diskon/100), 0, ',', '.') }}">
                                            {{ number_format($menu->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">{{ $menu->diskon }}%</td>
                                        <td class="text-center">
                                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                                    onclick="editProduct(this)"
                                                    data-id="{{ $menu->id }}"
                                                    data-umkm="{{ $menu->data_umkm_id }}"
                                                    data-nama_makanan="{{ $menu->nama_makanan }}"
                                                    data-deskripsi="{{ $menu->deskripsi }}"
                                                    data-harga="{{ $menu->harga }}"
                                                    data-promo="{{ $menu->diskon }}">
                                                Edit
                                            </button>
                                            <form action="{{ route('product.destroy', $menu->id) }}" method="post" class="inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination links -->
                    <div class="mt-4">
                        {{ $menus->links() }}
                    </div>
                </div>

                {{-- modal tambah product umkm --}}
                <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="modalProductumkm">
                    <div class="flex items end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-200" id="modal-headline">
                                            Tambah Product
                                        </h3>
                                    </div>
                                </div>
                                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="umkm" class="block text-sm font-medium text-gray-700 dark:text-gray-200">UMKM</label>
                                        <select name="umkm" id="umkm" class="form-select mt-1 block w-full">
                                            @foreach($umkms as $umkm)
                                                <option value="{{ $umkm->id }}">{{ $umkm->nama_umkm }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="nama_makanan" class="block text sm font-medium text-gray-700 dark:text-gray-200">Nama Makanan</label>
                                        <input type="text" name="nama_makanan" id="nama_makanan" class="form-input mt-1 block w-full" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="deskripsi" class="block text sm font-medium text-gray-700 dark:text-gray-200">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" class="form-textarea mt-1 block w-full" required></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="image" class="block text sm font-medium text-gray-700 dark:text-gray-200">Image Makanan</label>
                                        <input type="file" name="image" id="image" class="form-input mt-1 block w-full" onchange="previewImage()" required>
                                    </div>
                                    <div class="mb-4 hidden" id="image-preview">
                                        <img src="" alt="Image Preview" id="preview" class="max-w-xs">
                                    </div>
                                    <div class="mb-4">
                                        <label for="harga" class="block text sm font-medium text-gray-700 dark:text-gray-200">Harga</label>
                                        <input type="number" name="harga" id="harga" class="form-input mt-1 block w-full" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="promo" class="block text sm font-medium text-gray-700 dark:text-gray-200">Promo</label>
                                        <input type="text" name="promo" id="promo" class="form-input mt-1 block w-full">
                                    </div>
                                    <div class="mb-4">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah</button>
                                        <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="document.getElementById('modalProductumkm').classList.add('hidden')">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- modal edit product umkm --}}
                <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="modalEditProductumkm">
                    <div class="flex items end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-200" id="modal-headline">
                                            Edit Product
                                        </h3>
                                    </div>
                                </div>
                                <form action="#" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label for="edit_umkm" class="block text-sm font-medium text-gray-700 dark:text-gray-200">UMKM</label>
                                        <select name="edit_umkm" id="edit_umkm" class="form-select mt-1 block w-full">
                                            @foreach($umkms as $umkm)
                                                <option value="{{ $umkm->id }}">{{ $umkm->nama_umkm }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="edit_nama_makanan" class="block text sm font-medium text-gray-700 dark:text-gray-200">Nama Makanan</label>
                                        <input type="text" name="edit_nama_makanan" id="edit_nama_makanan" class="form-input mt-1 block w-full" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="edit_deskripsi" class="block text sm font-medium text-gray-700 dark:text-gray-200">Deskripsi</label>
                                        <textarea name="edit_deskripsi" id="edit_deskripsi" class="form-textarea mt-1 block w-full" required></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="edit_image" class="block text sm font-medium text-gray-700 dark:text-gray-200">Image Makanan</label>
                                        <input type="file" name="edit_image" id="edit_image" class="form-input mt-1 block w-full" onchange="previewImage()" required>
                                    </div>
                                    <div class="mb-4 hidden" id="edit-image-preview">
                                        <img src="" alt="Image Preview" id="edit-preview" class="max-w-xs">
                                    </div>
                                    <div class="mb-4">
                                        <label for="edit_harga" class="block text sm font-medium text-gray-700 dark:text-gray-200">Harga</label>
                                        <input type="number" name="edit_harga" id="edit_harga" class="form-input mt-1 block w-full" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="edit_promo" class="block text sm font-medium text-gray-700 dark:text-gray-200">Promo</label>
                                        <input type="text" name="edit_promo" id="edit_promo" class="form-input mt-1 block w-full">
                                    </div>
                                    <div class="mb-4">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                                        <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="document.getElementById('modalEditProductumkm').classList.add('hidden')">Batal</button>
                                    </div>
                                </form>
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
        function previewImage() {
            var input = document.getElementById('image');
            var preview = document.getElementById('preview');
            var imagePreview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                imagePreview.classList.add('hidden');
            }
        }
    </script>
    <script>
        function editProduct(button) {
            // Get data from data-* attributes
            var id = button.getAttribute('data-id');
            var umkm = button.getAttribute('data-umkm');
            var nama_makanan = button.getAttribute('data-nama_makanan');
            var deskripsi = button.getAttribute('data-deskripsi');
            var harga = button.getAttribute('data-harga');
            var promo = button.getAttribute('data-promo');

            // Fill the form in the modal with the data
            document.getElementById('edit_umkm').value = umkm;
            document.getElementById('edit_nama_makanan').value = nama_makanan;
            document.getElementById('edit_deskripsi').value = deskripsi;
            document.getElementById('edit_harga').value = harga;
            document.getElementById('edit_promo').value = promo;

            // Update the form action to point to the update route
            var form = document.querySelector('#modalEditProductumkm form');
            // form.action = '/product/update/' + id;

            // Show the modal
            document.getElementById('modalEditProductumkm').classList.remove('hidden');
        }
    </script>
    <script>
        document.querySelector('[data-bs-target="#modalProductumkm"]').addEventListener('click', function() {
            event.preventDefault();
            document.getElementById('modalProductumkm').classList.remove('hidden');
        });
    </script>
</x-app-layout>

