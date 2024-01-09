@forelse ($models as $item)
<a href="{{ route("detail-makanan", $item->nama_makanan) }}">
<div class="flex flex-col border border-black/30 p-2 w-40 rounded-xl transition-all duration-300 hover:shadow-md max-w-40 h-[185px] max-h-[185px] min-h-[185px]">
    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->nama_makanan }}" class="w-full h-[70%] pb-1">
    <div class="h-11 overflow-y-auto w-full">
        <h1 class="font-semibold">{{ $item->nama_makanan }}</h1>
        <h1 class="font-semibold">{{ $item->data_umkm->nama_umkm }}</h1>
    </div>
</div>
</a>
@empty
Menu tidak ditemukan
@endforelse