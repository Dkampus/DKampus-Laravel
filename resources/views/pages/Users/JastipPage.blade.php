@extends('layouts.Root')
@section('content')
    <header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10">
        {{-- Topbar --}}
        @include('components.header.topbar')
    </header>
    <main class="px-3 md:mx-2 md:mb-40">
        <section class="bg-white rounded-lg shadow-md p-6 md:p-8 h-screen">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Dkampus Jasa Titip (Jastip)</h2>

            <form action="" method="POST">
                @csrf

                <div class="mb-4" id="menuContainer">
                    <label class="block text-sm font-medium text-gray-700 mb-2">List menu yang ingin kamu pesan :</label>
                    <div class="flex items-center mb-2">
                        <input type="text" name="nama_menu[]" placeholder="Nama Menu" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50" required>
                        <input type="number" name="kuantitas[]" placeholder="Jumlah" min="1" class="mt-1 p-2 ml-2 w-20 border rounded-md focus:ring focus:ring-opacity-50" required>
                        <button type="button" class="ml-2 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-1 px-2 rounded-md" onclick="removeMenu(this)">-</button>
                    </div>
                </div>

                <button type="button" class="mb-4 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-2 px-4 rounded-md" onclick="addMenu()">Tambah Menu</button>

                <div class="mb-4">
                    <label for="warung" class="block text-sm font-medium text-gray-700">Nama Warung:</label>
                    <input type="text" id="warung" name="warung" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50" required>
                </div>

                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Warung (Autocomplete):</label>
                    <input type="text" id="alamat" name="alamat" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50">
                    <script>
                        // Tambahkan skrip autocomplete di sini (misalnya, menggunakan Google Maps Places API atau library lainnya)
                    </script>
                </div>

                <div class="mb-6">
                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan Tambahan:</label>
                    <textarea id="catatan" name="catatan" rows="3" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50"></textarea>
                </div>

                <div>
                    <button type="submit" class="bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-2 px-4 rounded-md">
                        Kirim
                    </button>
                </div>
            </form>
        </section>
    </main>
    <footer class="fixed bottom-0 left-0 w-full bg-white z-10">
        {{-- Bottombar --}}
        @include('components.navbar.navbar')
    </footer>
@endsection
<script>
    function addMenu() {
        const menuContainer = document.getElementById('menuContainer');
        const newMenuInput = document.createElement('div');
        newMenuInput.classList.add('flex', 'items-center', 'mb-2');
        newMenuInput.innerHTML = `
            <input type="text" name="nama_menu[]" placeholder="Nama Menu" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-opacity-50">
            <input type="number" name="kuantitas[]" placeholder="Jumlah" min="1" class="mt-1 p-2 ml-2 w-20 border rounded-md focus:ring focus:ring-opacity-50">
            <button type="button" class="ml-2 bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-1 px-2 rounded-md" onclick="removeMenu(this)">-</button>
        `;
        menuContainer.appendChild(newMenuInput);
    }

    function removeMenu(button) {
        button.parentNode.remove();
    }
</script>

