<div id="modal_confirm_email" class="flex flex-col absolute invisible opacity-0 transition-all duration-300 z-0 rounded-xl justify-center gap-3 py-5 items-center scale-0 mx-auto border w-96 bg-white">
    <h1 class="font-semibold">email@gmail.com</h1>
    <p class="text-[#5C5C5C]">Apakah email anda sudah benar?</p>
    <div class="flex flex-row gap-2">
        <button class="bg-[#F9832A] w-28 h-9 rounded-lg text-white">Ya</button>
        <button onclick="hideModal()" class="bg-white border-2 w-28 h-9 rounded-lg text-[#F9832A] border-[#F9832A]">Salah</button>
    </div>
</div>
<div id="overlayDaftar" onclick="hideModal()" class="bg-black/40 invisible fixed top-0 w-full h-screen"></div>