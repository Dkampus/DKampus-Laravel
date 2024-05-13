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
                    <div class="overflow-auto">
                        <table class="min-w-full divide-y divide-gray-200 space-x-4">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 tracking-wider">Nama UMKM</th>
                                    <th scope="col" class="px-6 py-3 tracking-wider">Alamat</th>
                                    <th class="hidden" scope="col">link</th>
                                    <th scope="col" class="px-6 py-3 tracking-wider">No. Telp</th>
                                    <th scope="col" class="px-6 py-3 tracking-wider">VIP</th>
                                    <th scope="col" class="px-6 py-3 tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($umkms as $umkm)
                                <tr>
                                    <td class="">{{ $umkm->nama_umkm }}</td>
                                    <td class="">{{ $umkm->alamat }}</td>
                                    <td class="hidden"> {{ $umkm->link }} </td>
                                    {{-- <td><img src="{{ Storage::url($umkm->logo_umkm) }}" alt="umkm_img" width="50"></td>--}}
                                    <td class="text-center">{{ $umkm->no_telp_umkm }}</td>
                                    <td class="text-center">{{ $umkm->vip ? 'Ya' : 'Tidak' }}</td>

                                    <td class="text-center">
                                        <div class="flex justify-center space-x-2">
                                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="editUser(this)" data-id="{{ $umkm->id }}" data-nama_umkm="{{ $umkm->nama_umkm }}" data-alamat="{{ $umkm->alamat }}" data-no_telp_umkm="{{ $umkm->no_telp_umkm }}" data-vip="{{ $umkm->vip }}" data-link="{{ $umkm->link }}">
                                                Edit
                                            </button>
                                            <form id="deleteForm{{ $umkm->id }}" action="{{ route('umkm.destroy', $umkm->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" onclick="confirmDelete('{{ $umkm->id }}', '{{ $umkm->nama_umkm }}')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination links -->
                    <div class="mt-4">
                        {{ $umkms->links() }}
                    </div>
                </div>

                {{-- modal tambah umkm --}}
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
                                        <input type="text" id="autocomplete" name="alamat" id="alamat" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                        <input type="text" name="link" class="hidden" id="link">
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

                {{-- modal edit umkm --}}
                <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="modal-edit">
                    <div class="flex items end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-200" id="modal-headline">
                                            Edit UMKM
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('umkm.update', $umkm->id) }}" method="POST" id="editForm" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="mb-4">
                                        <label for="edit_nama_umkm" class="block text sm font-medium text-gray-700 dark:text-gray-200">Nama UMKM</label>
                                        <input type="text" name="edit_nama_umkm" id="edit_nama_umkm" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                        <p>{{ $umkm->id }}</p>
                                    </div>
                                    <div class="mb-4">
                                        <label for="edit_alamat" class="block text sm font-medium text-gray-700 dark:text-gray-200">Alamat</label>
                                        <input type="" name="edit_link" class="hidden" id="edit_link">
                                        <input type="text" name="edit_alamat" id="edit_alamat" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="edit_no_telp_umkm" class="block text sm font-medium text-gray-700 dark:text-gray-200">No. Telp</label>
                                        <input type="text" name="edit_no_telp_umkm" id="edit_no_telp_umkm" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="logo_umkm" class="block text sm font-medium text-gray-700 dark:text-gray-200">Logo UMKM</label>
                                        <input type="file" name="logo_umkm" id="logo_umkm" class="form-input rounded-md shadow-sm mt-1 block w-full">
                                    </div>
                                    <div class="mb-4">
                                        <label for="edit_vip" class="block text sm font-medium text-gray-700 dark:text-gray-200">VIP</label>
                                        <input type="radio" name="edit_vip" id="edit_vip" value="1" class="form-radio" required>
                                        <label for="edit_vip" class="mr-2 text-sm text-gray-500 dark:text-gray-200">Ya</label>
                                        <input type="radio" name="edit_vip" id="edit_vip" value="0" class="form-radio" required>
                                        <label for="edit_vip" class="text-sm text-gray-500 dark:text-gray-200">Tidak</label>
                                        <div class="text-sm text-gray-500 dark:text-gray-200">VIP UMKM akan mendapatkan featured dan benefit lainnya.</div>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                                        <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="document.getElementById('modal-edit').classList.add('hidden')">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy7Wqkn0A1tWbQf9-LnGum9UucUooaQXY&libraries=places&callback=initAutocomplete" defer></script>
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
    <script>
        function confirmDelete(id, nama_umkm) {
            var isConfirmed = confirm("Are you sure you want to delete " + nama_umkm + "?");

            if (isConfirmed) {
                document.getElementById('deleteForm' + id).submit();
            } else {
                console.log("Deletion canceled.");
            }
        }
    </script>
    <script>
        var autocomplete;

        function initAutocomplete() {
            var input = document.getElementById('autocomplete');

            autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry || !place.place_id) {
                    alert("No details available for input: '" + place.name + "'");
                    return;
                }

                var googleMapsLink = place.url;
                console.log(googleMapsLink);
                document.getElementById('autocomplete').value = googleMapsLink;
                document.getElementById('edit_link').value = googleMapsLink;
            });
        }
    </script>
    <script>
        var editauto;
        var edit;

        function editUser(button) {
            var id = button.getAttribute('data-id');
            var nama_umkm = button.getAttribute('data-nama_umkm');
            var alamat = button.getAttribute('data-alamat');
            var no_telp_umkm = button.getAttribute('data-no_telp_umkm');
            var vip = button.getAttribute('data-vip');
            var link = button.getAttribute('data-link');

            document.getElementById('edit_link').value = link;
            document.getElementById('edit_nama_umkm').value = nama_umkm;
            document.getElementById('edit_alamat').value = alamat;
            document.getElementById('edit_no_telp_umkm').value = no_telp_umkm;
            document.getElementById('edit_vip').value = vip;

            edit = document.getElementById('edit_alamat');
            editauto = new google.maps.places.Autocomplete(edit);
            editauto.addListener('place_changed', function() {
                var place = editauto.getPlace();
                if (!place.geometry || !place.place_id) {
                    alert("No details available for input: '" + place.name + "'");
                    return;
                }

                var googleMapsLink = place.url;
                console.log(googleMapsLink);
                document.getElementById('edit_link').value = googleMapsLink;
            });
            console.log(document.getElementById('edit_alamat').value, document.getElementById('edit_link').value);

            // Update the form action to point to the update route
            var form = document.querySelector('#editForm');
            form.action = '{{ route("umkm.update", ["id" => ":id"]) }}'.replace(':id', id);

            // Show the modal
            document.getElementById('modal-edit').classList.remove('hidden');
        }
    </script>

    <style>
        /* Style the "powered by Google" attribution */
        .pac-container:after {
            content: none !important;
        }
    </style>
</x-app-layout>
<script>
    document.querySelector('[data-bs-target="#umkmModal"]').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('modalumkm').classList.remove('hidden');
    });
</script>