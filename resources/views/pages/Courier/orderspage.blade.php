@extends('layouts.Root')
@section('content')
<header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-8">
    <a href="{{ 'dashboard' }}" class="absolute top-5 left-5 flex items-center gap-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z" />
        </svg>
        <h1 class="font-bold text-black text-xl mb-1">Daftar Orderan</h1>
    </a>
</header>
<main class="bg-[#F0F3F8] py-2 px-2 sm:px-6 lg:px-8 sm:flex sm:flex-col sm:items-center h-screen" id="card">
    <div id="orderContainer" class="bg-white rounded-lg shadow-md overflow-hidden mx-4 my-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-5">
        {{-- Data Orders list will rendered here --}}
    </div>
    {{-- Modal for order details --}}
    <div id="orderDetailModal" class="hidden fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-8 rounded-lg w-5/6 max-w-lg">
            <h2 class="text-2xl font-bold mb-4">Order Details</h2>
            <div id="modalOrderDetails" class="mx-2 my-2">
                {{-- Data detail from order will rendered here --}}
            </div>
            <button id="closeModalBtn" class="bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-2 px-4 rounded-full text-sm">Close</button>
        </div>
    </div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
<script>
    // Initialize Firebase
    var firebaseConfig = {
        apiKey: "{{ env('FIREBASE_API_KEY') }}",
        authDomain: "{{ env('FIREBASE_AUTH_DOMAIN') }}",
        databaseURL: "{{ env('FIREBASE_DATABASE_URL') }}",
        projectId: "{{ env('FIREBASE_PROJECT_ID') }}",
        storageBucket: "{{ env('FIREBASE_STORAGE_BUCKET') }}",
        messagingSenderId: "{{ env('FIREBASE_MESSAGING_SENDER_ID') }}",
        appId: "{{ env('FIREBASE_APP_ID') }}",
        measurementId: "{{ env('FIREBASE_MEASUREMENT_ID') }}"
    };

    firebase.initializeApp(firebaseConfig);

    // Get a reference to the Firebase database
    var database = firebase.database();

    function renderOrder(orderData, id) {
        var idOrder = id;
        var nama_penerima = orderData.nama_penerima;
        var nama_umkm = orderData.nama_umkm;
        var ongkir = orderData.ongkir;
        var status = orderData.status;
        var total = orderData.total;
        var jarak = orderData.jarak;
        if (jarak > 1000) {
            convert = parseFloat((jarak / 1000).toFixed(2));
            var hasilJarak = convert + " km"
        } else {
            var hasilJarak = jarak + " m"
        }
        var ordersHtml = "";
        var orderNames = Object.values(orderData.orders).map(function(order) {
            return order.jumlah + ' ' + order.nama;
        });

        var combinedOrderNames = orderNames.join(", ");

        if (combinedOrderNames) {
            ordersHtml += `
                <div class="flex flex-row justify-between">
                    <span class="font-semibold text-l">Orders</span>
                    <span class="font-semibold text-l">${combinedOrderNames}</span>
                </div>`;
        }
        var timestamp = orderData.timestamp;
        var formattedTotal = "Rp. " + total.toLocaleString('id-ID');
        var html = `
            <div class="p-4" id="${idOrder}">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center">
                    <svg height="30" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.50596 0.214355C1.35633 0.214355 1.22294 0.318064 1.17148 0.474022L0.257897 3.24921C0.229051 3.33697 0.214353 3.42877 0.214355 3.52115V4.62513C0.214355 5.24936 0.66996 5.75602 1.23204 5.75602C1.79413 5.75602 2.25013 5.24936 2.25013 4.62513C2.25013 5.24975 2.70573 5.75602 3.26781 5.75602C3.8299 5.75602 4.2859 5.24936 4.2859 4.62513C4.2859 5.24975 4.7415 5.75602 5.30359 5.75602C5.86567 5.75602 6.32088 5.25015 6.32167 4.62592C6.32167 5.25015 6.77727 5.75602 7.33936 5.75602C7.90144 5.75602 8.35704 5.24936 8.35704 4.62513C8.35704 5.24975 8.81304 5.75602 9.37513 5.75602C9.93721 5.75602 10.3924 5.25015 10.3928 4.62592C10.3932 5.25015 10.8488 5.75602 11.4109 5.75602C11.973 5.75602 12.4286 5.24936 12.4286 4.62513C12.4286 5.24975 12.8842 5.75602 13.4467 5.75602C14.0088 5.75602 14.4644 5.24936 14.4644 4.62513V3.52115C14.4644 3.42877 14.4497 3.33697 14.4208 3.24921L13.5072 0.474418C13.4558 0.318064 13.3224 0.214355 13.1728 0.214355H1.50596Z" fill="#F9832A" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.79761 6.24282V9.31844H0.808024C0.755533 9.31844 0.705192 9.33929 0.668076 9.37641C0.630959 9.41353 0.610107 9.46387 0.610107 9.51636V9.91219C0.610107 9.96468 0.630959 10.015 0.668076 10.0521C0.705192 10.0893 0.755533 10.1101 0.808024 10.1101H13.8705C13.923 10.1101 13.9734 10.0893 14.0105 10.0521C14.0476 10.015 14.0684 9.96468 14.0684 9.91219V9.51636C14.0684 9.46387 14.0476 9.41353 14.0105 9.37641C13.9734 9.33929 13.923 9.31844 13.8705 9.31844H12.8809V6.24282C12.7152 6.17678 12.5622 6.08264 12.4285 5.96455C12.3259 6.05505 12.2118 6.1317 12.0893 6.19255V9.31844H2.58927V6.19255C2.46671 6.1317 2.35267 6.05505 2.25004 5.96455C2.11704 6.08132 1.96504 6.17632 1.79761 6.24282ZM12.0893 5.46817C12.1229 5.43452 12.1546 5.3985 12.1843 5.36011H12.0893V5.46817ZM12.6727 5.36011C12.7326 5.43764 12.8026 5.50674 12.8809 5.56554V5.36011H12.6727ZM1.79761 5.56554C1.87633 5.50721 1.94643 5.43804 2.00582 5.36011H1.79761V5.56554ZM2.49427 5.36011H2.58927V5.46817C2.55527 5.43427 2.52354 5.39817 2.49427 5.36011ZM1.20386 10.9018C1.15137 10.9018 1.10103 10.9226 1.06391 10.9597C1.02679 10.9969 1.00594 11.0472 1.00594 11.0997V14.0684C1.00594 14.1734 1.04764 14.2741 1.12188 14.3483C1.19611 14.4226 1.29679 14.4643 1.40177 14.4643H13.2768C13.3818 14.4643 13.4824 14.4226 13.5567 14.3483C13.6309 14.2741 13.6726 14.1734 13.6726 14.0684V11.0997C13.6726 11.0472 13.6518 10.9969 13.6146 10.9597C13.5775 10.9226 13.5272 10.9018 13.4747 10.9018H1.20386Z" fill="#F9832A" />
                        <path d="M3.3811 8.32902C3.3811 8.27653 3.40196 8.22619 3.43907 8.18907C3.47619 8.15196 3.52653 8.1311 3.57902 8.1311H4.76652C4.81901 8.1311 4.86935 8.15196 4.90647 8.18907C4.94359 8.22619 4.96444 8.27653 4.96444 8.32902V9.12069C4.96444 9.17318 4.94359 9.22352 4.90647 9.26064C4.86935 9.29775 4.81901 9.3186 4.76652 9.3186H3.57902C3.52653 9.3186 3.47619 9.29775 3.43907 9.26064C3.40196 9.22352 3.3811 9.17318 3.3811 9.12069V8.32902Z" fill="#F9832A" />
                        <path d="M4.17261 8.72485C4.17261 8.67236 4.19346 8.62202 4.23058 8.58491C4.26769 8.54779 4.31803 8.52694 4.37052 8.52694H5.55802C5.61051 8.52694 5.66086 8.54779 5.69797 8.58491C5.73509 8.62202 5.75594 8.67236 5.75594 8.72485V9.12069C5.75594 9.17318 5.73509 9.22352 5.69797 9.26064C5.66086 9.29775 5.61051 9.3186 5.55802 9.3186H4.37052C4.31803 9.3186 4.26769 9.29775 4.23058 9.26064C4.19346 9.22352 4.17261 9.17318 4.17261 9.12069V8.72485ZM7.33927 8.72485C7.33927 8.88233 7.27672 9.03335 7.16537 9.1447C7.05402 9.25605 6.903 9.3186 6.74552 9.3186C6.58805 9.3186 6.43703 9.25605 6.32568 9.1447C6.21433 9.03335 6.15177 8.88233 6.15177 8.72485C6.15177 8.56738 6.21433 8.41636 6.32568 8.30501C6.43703 8.19366 6.58805 8.1311 6.74552 8.1311C6.903 8.1311 7.05402 8.19366 7.16537 8.30501C7.27672 8.41636 7.33927 8.56738 7.33927 8.72485Z" fill="#F9832A" />
                    </svg>
                    <div class="ml-2">
                        <span class="font-semibold text-lg text-gray-800">${nama_umkm}</span>
                        <p class="text-sm text-gray-600">${timestamp}</p>
                    </div>
                </div>
                <span class="px-3 py-1 rounded-full text-sm font-semibold text-[#FF6E00] bg-[#FFEEE1]">Waiting For Driver</span>
            </div>

            {{--detail order --}}
            <p class="text-sm text-gray-600 mb-2">
                <span class="font-semibold">Pesanan:</span> ${combinedOrderNames}
            </p>

            <p class="text-sm text-gray-600">
                <span class="font-semibold">Ongkir:</span> Rp. ${ongkir.toLocaleString('id-ID')}
            </p>

            <div class="mt-4 border-t pt-4 flex items-center justify-between"><div>

            <div class="px-2 flex flex-row">
                <form action="{{ route('take.order') }}" method="POST" class="mr-2">
                @csrf
                    <input type="hidden" name="orderId" value="${id}">
                    <button type="submit" class="bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-2 px-4 rounded-full text-sm">Take Order</button>
                </form>
                <button onclick="showOrderDetailModal(${JSON.stringify(orderData).replace(/"/g, '&quot;')})" class="bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-2 px-4 rounded-full text-sm">View Details</button>
            </div>
            `;
        $('#orderContainer').append(html);
    }

    function showOrderDetailModal(orderData) {
        $('#modalOrderDetails').empty();
        console.log(orderData);
        var orderNames = Object.values(orderData.orders).map(function(order) {
            return order.jumlah + ' ' + order.nama + ' (' + order.catatan + ')';
        });

        var ordersHtml = "";

        var combinedOrderNames = orderNames.join(", ");

        if (combinedOrderNames) {
            ordersHtml += `
                <div class="flex flex-row justify-between">
                    <span class="font-semibold text-l">${combinedOrderNames}</span>
                </div>`;
        }

        var total = orderData.total + orderData.ongkir;

        var orderDetailsHtml = `
        <div class="flex flex-col">
            <h1 class="text-l font-bold">Nama Penerima:</h1>
            <p class="text-l">${ orderData.nama_penerima }</p>
        </div>
        <div class="flex flex-col">
            <h1 class="text-l font-bold">Nama UMKM:</h1>
            <p class="text-l">${orderData.nama_umkm }</p>
        </div>
        <div class="flex flex-col">
            <h1 class="text-l font-bold">Notes:</h1>
            <p class="text-l">${ orderData.notesAlamat }</p>
        </div>
        <div class="flex flex-col">
            <h1 class="text-l font-bold">Total + Ongkir:</h1>
            <p class="text-l">Rp. ${ total.toLocaleString('id-ID') }</p>
        </div>
        <div class="flex flex-col">
            <h1 class="text-l font-bold">Orders:</h1>
            <p class="text-l">${ ordersHtml }</p>
        `;

        $('#modalOrderDetails').append(orderDetailsHtml);

        $('#orderDetailModal').removeClass('hidden');
    }

    $('#closeModalBtn').click(function() {
        $('#orderDetailModal').addClass('hidden');
    });

    database.ref('needToDeliver').on('child_added', function(snapshot) {
        var id = snapshot.key;
        var orderData = snapshot.val();
        renderOrder(orderData, id);
    });

    database.ref('needToDeliver').on('child_removed', function(snapshot) {
        var orderId = snapshot.key;
        $('#' + orderId).remove();
    });
</script>
</main>
@endsection
