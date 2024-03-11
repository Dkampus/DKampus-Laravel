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
                    <h1 class="text-2xl font-bold mb-4">Form Tambah Menu</h1>
                        {!! Form::model($model, [ 'route' => $route,'enctype' => "multipart/form-data", 'class' => "space-y-4", 'method' => $method]) !!}

                        <!-- Input fields for UMKM data -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="hidden" name="user_id" id="" value="{{ Auth::id() }}">
                            <div>
                                <label for="nama_umkm">Nama UMKM:</label>
                                {!! Form::select('nama_umkm', $umkm, null, [
                                    "class" => "w-full px-3 py-2 border rounded-md nama_umkm",
                                ]) !!}
                            </div>
                            <div>
                                <label for="nama_makanan">Nama Makanan:</label>
                                {!! Form::text("nama_makanan", null, ["class" => "text-black w-full rounded-md"]) !!}
                            </div>
                            <div>
                                <label for="deskripsi">Deskripsi:</label>
                                {!! Form::textarea("deskripsi", null, ["class" => "text-black w-full rounded-md "]) !!}
                            </div>
                            <div>
                                <label for="logo_umkm">Image Makanan:</label>
                                <input type="file" name="image" id="logo_umkm" class="w-full" onchange="previewImage()">
                                <div id="image_logo_umkm" class="">
                                    <img src="{{ Storage::url($model->image) }}" alt="Preview" class="mx-2 max-w-xs">
                                </div>
                                <!-- Image Preview -->
                                <div id="image-preview" class="hidden">
                                    <img id="preview" src="" alt="Preview" class="mx-2 max-w-xs">
                                </div>
                            </div>
                            <div>
                                <label for="harga">Harga:</label>
                                {!! Form::number("harga", null, [
                                    "class" => "text-black w-full rounded-md",
                                    "placeholder" => "harga: 25000"
                                ]) !!}
                            </div>
                            <div>
                                <label for="promo">Promo:</label>
                                {!! Form::number("promo", null, [
                                    "class" => "text-black w-full rounded-md",
                                    "placeholder" => "harga: 25000"
                                ]) !!}
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-500 hover-bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            {{ $button }} MENU
                        </button>
                    {!! Form::close() !!}
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
</x-app-layout>
