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
                    <h1 class="text-2xl font-bold mb-4">Form Edit Menu</h1>
                    <form method="POST" action="{{ route('product.update', $model->id) }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')

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
                                <label for="logo_umkm">Image Makanana:</label>
                                <input type="file" name="image" id="logo_umkm" class="w-full" onchange="previewImage()">
                                <!-- Image Preview -->
                                <div id="image-preview" class="hidden">
                                    <h2 class="text-xl font-bold mt-4">Preview Logo:</h2>
                                    <img id="preview" src="" alt="Preview" class="mx-2 max-w-xs">
                                </div>
                            </div>
                            <div>
                                <label for="harga">Harga:</label>
                                <input type="number" name="harga" id="no_telp_umkm" placeholder="harga: 25000" class="text-black w-full px-3 py-2 border rounded-md">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-500 hover-bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Simpan UMKM
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div>

<x-app-layout>
