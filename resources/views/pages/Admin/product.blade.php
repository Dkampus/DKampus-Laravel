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
                                        <td class="text-center">{{ $menu->harga }}</td>
                                        <td class="text-center">{{ $menu->promo??'n/a' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('product.edit', $menu->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
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

                <!-- Modal -->
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
                                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah</button>
                                        <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" onclick="document.getElementById('modalProductumkm').classList.add('hidden')">Batal</button>
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
</x-app-layout>
<script>
    document.querySelector('[data-bs-target="#modalProductumkm"]').addEventListener('click', function() {
        event.preventDefault();
        document.getElementById('modalProductumkm').classList.remove('hidden');
    });
</script>
