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
                    <h1 class="text-2xl font-bold mb-4">Form UMKM</h1>

                    <form method="POST" action="{{ route('umkm.store') }}" enctype="multipart/form-data" class="space-y-4" id="umkmForm">
                        @csrf

                        <!-- Input fields for UMKM data -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="hidden" name="user_id" id="" value="{{ Auth::id() }}" required>
                            <div>
                                <label for="nama_umkm">Nama UMKM:</label>
                                <input type="text" name="nama_umkm" id="nama_umkm" placeholder="Nama UMKM" class="text-black w-full px-3 py-2 border rounded-md" required>
                            </div>
                            <div>
                                <label for="alamat">Alamat:</label>
                                <textarea name="alamat" id="alamat" placeholder="Alamat" class="text-black w-full px-3 py-2 border rounded-md" required></textarea>
                            </div>
                            <div>
                                <label for="logo_umkm">Logo UMKM:</label>
                                <input type="file" name="logo_umkm" id="logo_umkm" class="w-full" onchange="previewImage()" required>
                                <!-- Image Preview -->
                                <div id="image-preview" class="hidden">
                                    <h2 class="text-xl font-bold mt-4">Preview Logo:</h2>
                                    <img id="preview" src="" alt="Preview" class="mx-2 max-w-xs">
                                </div>
                            </div>
                            <div>
                                <label for="no_telp_umkm">No. Telp UMKM:</label>
                                <input type="text" name="no_telp_umkm" id="no_telp_umkm" placeholder="No. Telp UMKM" class="text-black w-full px-3 py-2 border rounded-md" required>
                            </div>
                        </div>

                        <!-- VIP Radio Buttons -->
                        <div>
                            <div class="flex items-center">
                                <label for="vip">VIP: &nbsp;</label>
                                <input type="radio" name="vip" value="0" id="vip-ya" required>
                                <label for="vip-ya" class="ml-1">Ya</label>
                                <input type="radio" name="vip" value="1" id="vip-tidak" class="ml-4" required>
                                <label for="vip-tidak" class="ml-1">Tidak</label>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Simpan UMKM
                        </button>
                    </form>

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
