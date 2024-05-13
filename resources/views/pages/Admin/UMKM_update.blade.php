<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('UMKM Update') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">Update UMKM</h1>

                    <form method="POST" action="{{ route('umkm.update', $umkm->id) }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <!-- Input fields for UMKM data -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="hidden" name="user_id" id="" value="{{ Auth::id() }}">
                            <div>
                                <label for="nama_umkm">Nama UMKM:</label>
                                <input type="text" name="nama_umkm" id="nama_umkm" placeholder="Nama UMKM" class="text-black w-full px-3 py-2 border rounded-md" value="{{ $umkm->nama_umkm }}">
                            </div>
                            <div>
                                <label for="alamat">Alamat:</label>
                                <textarea name="alamat" id="alamat" placeholder="Alamat" class="text-black w-full px-3 py-2 border rounded-md">{{ $umkm->alamat }}</textarea>
                            </div>
                            <div>
                                <label for="logo_umkm">Logo UMKM:</label>
                                <input type="file" name="logo_umkm" id="logo_umkm" class="w-full" onchange="previewImage()" value="{{ $umkm->logo_umkm }}">
                                {{-- <input type="text" name="logo_umkm" id="logo_umkm" class="text-black w-full" value="{{ Storage::url($umkm->logo_umkm) }}"> --}}

                                <div id="image_logo_umkm" class="">
                                    <h2 class="text-xl font-bold mt-4">Preview Logo:</h2>
                                    <img src="{{ Storage::url($umkm->logo_umkm) }}" alt="Preview" class="mx-2 max-w-xs">
                                </div>

                                <!-- Image Preview -->
                                <div id="image-preview" class="hidden">
                                    <h2 class="text-xl font-bold mt-4">Preview Logo:</h2>
                                    <img id="preview" src="{{ Storage::url($umkm->logo_umkm) }}" alt="Preview" class="mx-2 max-w-xs">
                                </div>
                            </div>
                            <div>
                                <label for="no_telp_umkm">No. Telp UMKM:</label>
                                <input type="text" name="no_telp_umkm" id="no_telp_umkm" placeholder="No. Telp UMKM" class="text-black w-full px-3 py-2 border rounded-md" value="{{ $umkm->no_telp_umkm }}">
                            </div>
                        </div>

                        <!-- VIP Radio Buttons -->
                        <div>
                            <div class="flex items-center">
                                <label for="vip">VIP: &nbsp;</label>
                                <input type="radio" name="vip" value="0" id="vip-ya" {{ $umkm->vip == 0 ? 'checked' : '' }}>
                                <label for="vip-ya" class="ml-1">Ya</label>
                                <input type="radio" name="vip" value="1" id="vip-tidak" class="ml-4" {{ $umkm->vip == 1 ? 'checked' : '' }}>
                                <label for="vip-tidak" class="ml-1">Tidak</label>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-500 hover-bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Update UMKM
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="pb-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between">
                    {{ __("Products") }}
                    <a href="{{ route('product') }}">
                        <button class="w-full py-1 px-5 text-center font-semibold text-sm bg-yellow-400 text-white rounded-full shadow-sm mb-2">
                            Add Product
                        </button>
                    </a>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 h-[400px] overflow-y-auto hidden-scrol shadow-sm sm:rounded-lg mt-4">
                <table class="border-collapse table-auto w-full text-sm  relative">
                    <thead class="sticky top-0 bg-slate-950/70 backdrop-blur-sm">
                        <tr>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-white text-left">Image Makanan</th>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-white text-left">Nama Makanan</th>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-white text-left">Harga</th>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-3 pb-3 text-slate-400 dark:text-white text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-slate-800">
                        @if (count($products) == 0)
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
                        @foreach ($products as $data)
                        <tr>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"><img class="h-24 rounded-lg" src="{{Storage::url($data->image)}}" alt=""></td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $data->nama_makanan }}</td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $data->harga }}</td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400 flex flex-col">
                                <a href="" class="py-1 text-center font-semibold text-sm bg-green-400 text-white rounded-full shadow-sm mb-2">View</a>
                                <a href="{{ route('product.edit', $data->id) }}" class="py-1 text-center font-semibold text-sm bg-cyan-500 text-white rounded-full shadow-sm mb-2">Edit</a>
                                <form action="{{ route("product.destroy", $data) }}" method="POST" class="delete-form w-full">
                                    @csrf
                                    @method("DELETE")
                                    <button value="{{ $data->nama_makanan }}" class="w-full delete-button py-1 text-center font-semibold text-sm bg-red-400 text-white rounded-full shadow-sm mb-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @endif


                    </tbody>
                </table>
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
            title: "{{ session('error2') }}"
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
            title: "{{ session('success') }}"
        })
    </script>
    @endif

    <script>
        function previewImage() {
            var input = document.getElementById('logo_umkm');
            var preview = document.getElementById('preview');
            var imagePreview = document.getElementById('image-preview');
            var image = document.getElementById('image_logo_umkm');
            console.log(image);

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
                image.classList.add('hidden');
                imagePreview.classList.remove('hidden');
            } else {
                image.classList.add('hidden');
                imagePreview.classList.add('hidden');
            }
        }
    </script>
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