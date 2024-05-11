<div class="fixed bottom-32 right-4 md:bottom-2 md:right-4 z-50">
    <button class="bg-[#F9832A] w-20 h-10 rounded-2xl text-white font-semibold text-lg" onclick="showCSHelp()">
        CS Help
    </button>
</div>
{{-- modal input question --}}
<div class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden" id="modalBantuan">
    <div class="flex items center justify-center">
        <div class="bg-white w-[95%] h-auto max-h-[80%] rounded-xl p-5 mt-10 overflow-auto">
            <div class="flex flex-row justify-between items-center">
                <h1 class="font-semibold text-2xl">Bantuan</h1>
                <a href="#" onclick="closeModal()">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </a>
            </div>
            <div class="flex flex-col gap-5 mt-5">
                {{-- Input text box untuk pertanyaan dan menentukan kategori menggunakan AIML --}}
                <div class="flex flex-col gap-2">
                    <label for="pertanyaan" class="font-semibold">Pertanyaan</label>
                    <input type="text" name="pertanyaan" id="pertanyaan" class="border-2 rounded-md p-2" placeholder="Masukkan pertanyaan, keluhan, atau saran kamu">
                </div>
                <spam class="text-xs text-[#787878]">*Chat akan dijawab oleh bot dan akan diarahkan ke customer service</spam>
                {{-- button untuk submit pertanyaan --}}
                <button class="bg-[#F9832A] text-white font-semibold p-2 rounded-md">Kirim</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showCSHelp() {
        document.getElementById('modalBantuan').style.display = 'block';
    }
    function closeModal() {
        document.getElementById('modalBantuan').style.display = 'none';
    }
    window.onclick = function(event) {
        if (event.target == document.getElementById('modalBantuan')) {
            document.getElementById('modalBantuan').style.display = 'none';
        }
    }
</script>
