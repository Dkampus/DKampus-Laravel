@extends('layouts.Root')
@section('content')
<header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-4">
    <a href="{{url('/pesanan')}}" class="absolute top-5 left-5 flex items-center gap-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z" />
        </svg>
    </a>
    <h1 class="font-bold text-black text-xl">Pemesanan</h1>
</header>
<main class="flex flex-col w-full h-full">
    <div class="bg-[#F8832B] flex items-center p-3 rounded">
        <svg height="30" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.50596 0.214355C1.35633 0.214355 1.22294 0.318064 1.17148 0.474022L0.257897 3.24921C0.229051 3.33697 0.214353 3.42877 0.214355 3.52115V4.62513C0.214355 5.24936 0.66996 5.75602 1.23204 5.75602C1.79413 5.75602 2.25013 5.24936 2.25013 4.62513C2.25013 5.24975 2.70573 5.75602 3.26781 5.75602C3.8299 5.75602 4.2859 5.24936 4.2859 4.62513C4.2859 5.24975 4.7415 5.75602 5.30359 5.75602C5.86567 5.75602 6.32088 5.25015 6.32167 4.62592C6.32167 5.25015 6.77727 5.75602 7.33936 5.75602C7.90144 5.75602 8.35704 5.24936 8.35704 4.62513C8.35704 5.24975 8.81304 5.75602 9.37513 5.75602C9.93721 5.75602 10.3924 5.25015 10.3928 4.62592C10.3932 5.25015 10.8488 5.75602 11.4109 5.75602C11.973 5.75602 12.4286 5.24936 12.4286 4.62513C12.4286 5.24975 12.8842 5.75602 13.4467 5.75602C14.0088 5.75602 14.4644 5.24936 14.4644 4.62513V3.52115C14.4644 3.42877 14.4497 3.33697 14.4208 3.24921L13.5072 0.474418C13.4558 0.318064 13.3224 0.214355 13.1728 0.214355H1.50596Z" fill="#FFFFFF" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.79761 6.24282V9.31844H0.808024C0.755533 9.31844 0.705192 9.33929 0.668076 9.37641C0.630959 9.41353 0.610107 9.46387 0.610107 9.51636V9.91219C0.610107 9.96468 0.630959 10.015 0.668076 10.0521C0.705192 10.0893 0.755533 10.1101 0.808024 10.1101H13.8705C13.923 10.1101 13.9734 10.0893 14.0105 10.0521C14.0476 10.015 14.0684 9.96468 14.0684 9.91219V9.51636C14.0684 9.46387 14.0476 9.41353 14.0105 9.37641C13.9734 9.33929 13.923 9.31844 13.8705 9.31844H12.8809V6.24282C12.7152 6.17678 12.5622 6.08264 12.4285 5.96455C12.3259 6.05505 12.2118 6.1317 12.0893 6.19255V9.31844H2.58927V6.19255C2.46671 6.1317 2.35267 6.05505 2.25004 5.96455C2.11704 6.08132 1.96504 6.17632 1.79761 6.24282ZM12.0893 5.46817C12.1229 5.43452 12.1546 5.3985 12.1843 5.36011H12.0893V5.46817ZM12.6727 5.36011C12.7326 5.43764 12.8026 5.50674 12.8809 5.56554V5.36011H12.6727ZM1.79761 5.56554C1.87633 5.50721 1.94643 5.43804 2.00582 5.36011H1.79761V5.56554ZM2.49427 5.36011H2.58927V5.46817C2.55527 5.43427 2.52354 5.39817 2.49427 5.36011ZM1.20386 10.9018C1.15137 10.9018 1.10103 10.9226 1.06391 10.9597C1.02679 10.9969 1.00594 11.0472 1.00594 11.0997V14.0684C1.00594 14.1734 1.04764 14.2741 1.12188 14.3483C1.19611 14.4226 1.29679 14.4643 1.40177 14.4643H13.2768C13.3818 14.4643 13.4824 14.4226 13.5567 14.3483C13.6309 14.2741 13.6726 14.1734 13.6726 14.0684V11.0997C13.6726 11.0472 13.6518 10.9969 13.6146 10.9597C13.5775 10.9226 13.5272 10.9018 13.4747 10.9018H1.20386Z" fill="#FFFFFF" />
            <path d="M3.3811 8.32902C3.3811 8.27653 3.40196 8.22619 3.43907 8.18907C3.47619 8.15196 3.52653 8.1311 3.57902 8.1311H4.76652C4.81901 8.1311 4.86935 8.15196 4.90647 8.18907C4.94359 8.22619 4.96444 8.27653 4.96444 8.32902V9.12069C4.96444 9.17318 4.94359 9.22352 4.90647 9.26064C4.86935 9.29775 4.81901 9.3186 4.76652 9.3186H3.57902C3.52653 9.3186 3.47619 9.29775 3.43907 9.26064C3.40196 9.22352 3.3811 9.17318 3.3811 9.12069V8.32902Z" fill="#F9832A" />
            <path d="M4.17261 8.72485C4.17261 8.67236 4.19346 8.62202 4.23058 8.58491C4.26769 8.54779 4.31803 8.52694 4.37052 8.52694H5.55802C5.61051 8.52694 5.66086 8.54779 5.69797 8.58491C5.73509 8.62202 5.75594 8.67236 5.75594 8.72485V9.12069C5.75594 9.17318 5.73509 9.22352 5.69797 9.26064C5.66086 9.29775 5.61051 9.3186 5.55802 9.3186H4.37052C4.31803 9.3186 4.26769 9.29775 4.23058 9.26064C4.19346 9.22352 4.17261 9.17318 4.17261 9.12069V8.72485ZM7.33927 8.72485C7.33927 8.88233 7.27672 9.03335 7.16537 9.1447C7.05402 9.25605 6.903 9.3186 6.74552 9.3186C6.58805 9.3186 6.43703 9.25605 6.32568 9.1447C6.21433 9.03335 6.15177 8.88233 6.15177 8.72485C6.15177 8.56738 6.21433 8.41636 6.32568 8.30501C6.43703 8.19366 6.58805 8.1311 6.74552 8.1311C6.903 8.1311 7.05402 8.19366 7.16537 8.30501C7.27672 8.41636 7.33927 8.56738 7.33927 8.72485Z" fill="#F9832A" />
        </svg>
        <h2 class="font-bold text-white text-xl ml-4">{{$nama_umkm}}</h2>
    </div>
    @foreach($carts as $cart => $items)
    <div class="flex flex-col w-full h-auto px-1 py-2">
        <div class="flex flex-row items-center w-full h-auto bg-white rounded-md p-4">
            <div class="flex items-center gap-x-2">
                <div class="bg-[#F8832B] text-white text-sm px-2 py-1 rounded">
                    {{$items['jumlah']}}
                </div>
                <p class="text-black text-md">{{$items['nama']}}</p>
            </div>
            <p class="font-normal text-black text-md ml-auto">Rp{{ number_format($items['harga'] * $items['jumlah'], 0, '.', ',') }}</p>
        </div>
    </div>
    @endforeach
    <div class="flex flex-col w-full h-auto px-1 py-2 bg-gray-200"></div>

    {{-- Detail Transaksi --}}
    <div class="flex flex-col w-full h-auto px-1 py-2">
        <div class="flex flex-row items-center w-full h-auto bg-white rounded-md p-4">
            <p class="font-bold text-black text-l">Rangkuman Pembayaran</p>
        </div>
        <div class="flex flex-row items-center w-full h-auto bg-white rounded-md p-3">
            <p class="font-normal text-black text-md">Total Harga</p>
            <p class="font-normal text-black text-md ml-auto">Rp{{ number_format($total, 0, '.', ',') }}</p>
        </div>
        <div class="flex flex-row items-center w-full h-auto bg-white rounded-md p-3">
            <p class="font-normal text-black text-md">Ongkir</p>
            <p class="font-normal text-black text-md ml-auto">Rp{{ number_format($ongkir, 0, '.', ',') }}</p>
        </div>
        <div class="flex flex-row items-center w-full h-auto bg-white rounded-md p-3">
            <p class="font-bold text-black text-md">Total Pembayaran</p>
            <p class="font-bold text-black text-md ml-auto">Rp{{ number_format($total + $ongkir, 0, '.', ',') }}</p>
        </div>
    </div>
    <div class="flex flex-col w-full h-auto px-1 py-1 bg-gray-200"></div>
    {{--Pembayaran--}}
    <div class="flex flex-col w-full h-auto px-1 py-2">
        <div class="flex flex-row items-center w-full h-auto bg-white rounded-md p-4">
            <p class="font-bold text-black text-l">Pembayaran</p>
        </div>
        {{--Selection pembayaran belum, as default baru qris aja.--}}
        <a id="paymentSelection" class="flex items-center">
            <img src="{{ asset('qris.svg') }}" alt="QRIS" class="w-12 h-12 mx-4">
        </a>
        <span class="text-xs text-gray-500 text-center">*Dkampus hanya menerima pembayaran dengan QRIS</span>
    </div>
    <div class="flex flex-col w-full h-auto px-1 py-1 bg-gray-200"></div>
    {{--Alamat Pengiriman--}}
    <form action="{{ route('confirm.pay') }}" method="POST">
        @csrf
        <div class="flex flex-col w-full h-auto px-1 py-2 overflow-auto mb-12">
            <div class="flex flex-row items-center w-full h-auto bg-white rounded-md p-4">
                <p class="font-bold text-black text-l">Notes Pesanan</p>
                <p class="ml-auto text-[#F9832A]">optional</p>
            </div>
            <div class="flex flex-row items-center w-full h-auto bg-white rounded-md p-4">
                <textarea name="notesPesanan" id="notesPesanan" class="w-full rounded-md h-auto" placeholder="Tambahkan notes pesanan"></textarea>
            </div>
        </div>
        {{--Button Pesan--}}
        <a href="#" id="pesanButton" class="fixed bottom-0 left-0 right-0 flex items-center justify-center h-12 bg-[#F8832B]">
            <p class="font-bold text-white text-lg">Pembayaran</p>
        </a>
        {{-- modal confirmation --}}
        <div class="fixed bottom-0 left-0 w-full h-full bg-black bg-opacity-50 hidden" id="modalConfrimation">
            <div class="flex flex-col w-11/12 h-auto bg-white rounded-md p-4 absolute bottom-20 left-1/2 transform -translate-x-1/2">
                <p class="font-bold text-black text-xl">Apakah anda yakin?</p>
                <p class="font-normal text-black text-md mt-2">Pastikan semua informasi sudah benar sebelum melanjutkan.</p>
                <div class="flex flex-col w-full h-auto mt-4">
                    <button href="#" id="konfirmasiButton" class="flex items-center justify-center text-white h-12 bg-orange-500 w-full rounded-md mb-2" type="submit">Konfrimasi</button>
                    <a href="#" class="flex items-center justify-center text-black h-12 bg-gray-300 w-full rounded-md">Batal</a>
                </div>
            </div>
        </div>
    </form>
</main>
<script>
    document.getElementById('pesanButton').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('modalConfrimation').classList.remove('hidden');
    });
    document.querySelector('#modalConfrimation .bg-gray-300').addEventListener('click', function() {
        document.getElementById('modalConfrimation').classList.add('hidden');
    });
</script>
@endsection
