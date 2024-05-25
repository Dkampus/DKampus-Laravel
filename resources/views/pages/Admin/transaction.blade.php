<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">List Transaction</h1>

                    {{--Table data--}}
                    <div class="overflow-auto">
                        <table class="table w-full divide-y divide-gray-200 space-x-4">
                            <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 tracking-wider">Transaction ID</th>
                                <th scope="col" class="px-6 py-3 tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 tracking-wider">Total</th>
                                <th scope="col" class="px-6 py-3 tracking-wider">Payment</th>
                                <th scope="col" class="px-6 py-3 tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 tracking-wider">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($dataNTD !== null)
                                @foreach($dataNTD as $key => $data)
                                    <tr>
                                        <td class="uppercase">#TRX{{ucfirst(substr($data['orderID'], 0, 10))}}</td>
                                        <td class="text-center">{{ $data['timestamp'] }}</td>
                                        <td class="text-center">
                                            Rp. {{number_format($data['total'] + $data['ongkir']), 0, ',', '.' }}
                                        </td>
                                        <td class="text-center">QRIS</td>
                                        <td class="text-center">
                                            @if ($data['status'] == 'completed')
                                                <span class="text-green-400 font-bold">{{ ucfirst($data['status']) }}</span>
                                            @elseif ($data['status'] == 'on Delivery' || $data['status'] == 'searching')
                                                <span class="text-yellow-400 font-bold">{{ ucfirst($data['status']) }}</span>
                                            @else
                                                <span class="text-red-400 font-bold">{{ ucfirst($data['status']) }}</span>
                                        @endif
                                        <td class="text-center">
                                            @php $total_ongkir = $data['total'] + $data['ongkir'] @endphp
                                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline detail-button" data-order-id="{{ $data['orderID'] }}" data-date="{{ $data['timestamp'] }}" data-total="{{ $total_ongkir }}" data-payment="QRIS" data-status="{{ $data['status'] }}" data-bukti="{{ Storage::url('public/payment/' . $data['bukti']) }}" data-user="{{ $data['nama_penerima'] }}" data-cour="Not Taken Yet" data-jarak="{{ $data['jarak'] }}" data-bukti-akhir="{{ null }}">
                                                Details
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            @if ($dataOP !== null)
                                @foreach($dataOP as $key => $data)
                                    <tr>
                                        <td>#TRX{{ucfirst(substr($data['orderID'], 0, 10))}}</td>
                                        <td class=" text-center">{{ $data['timestamp'] }}
                                        </td>
                                        <td class="text-center">
                                            Rp. {{number_format($data['total'] + $data['ongkir']), 0, ',', '.' }}
                                        </td>
                                        <td class="text-center">QRIS</td>
                                        <td class="text-center">
                                            @if ($data['status'] == 'completed')
                                                <span class="text-green-400 font-bold">{{ ucfirst($data['status']) }}</span>
                                            @elseif ($data['status'] == 'on Delivery')
                                                <span class="text-yellow-400 font-bold">{{ ucfirst($data['status']) }}</span>
                                            @else
                                                <span class="text-red-400 font-bold">{{ ucfirst($data['status']) }}</span>
                                        @endif
                                        <td class="text-center">
                                            @php $total_ongkir = $data['total'] + $data['ongkir'] @endphp
                                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline detail-button" data-order-id="{{ $data['orderID'] }}" data-date="{{ $data['timestamp'] }}" data-total="{{ $total_ongkir }}" data-payment="QRIS" data-status="{{ $data['status'] }}" data-bukti="{{ Storage::url('public/payment/' . $data['bukti']) }}" data-user="{{ $data['nama_penerima'] }}" data-cour="{{ null }}" data-jarak="{{ $data['jarak'] }}" data-bukti-akhir="{{ null }}">
                                                Details
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            @if ($datas !== null)
                                @foreach($datas->sortByDesc('created_at') as $key => $data)
                                    <tr>
                                        <td class=" uppercase">#TRX{{substr($data->order_id, 0, 10)}}
                                        </td>
                                        <td class=" text-center">{{ $data->created_at }}
                                        </td>
                                        <td class="text-center">
                                            Rp. {{number_format($data->harga + $data->ongkir), 0, ',', '.' }}
                                        </td>
                                        <td class="text-center">QRIS</td>
                                        <td class="text-center">
                                            @if ($data->status == 'completed')
                                                <span class="text-green-400 font-bold">{{ ucfirst($data->status) }}</span>
                                            @elseif ($data->status == 'Pending')
                                                <span class="text-yellow-400 font-bold">{{ ucfirst($data->status) }}</span>
                                            @else
                                                <span class="text-red-400 font-bold">{{ ucfirst($data->status) }}</span>
                                        @endif
                                        <td class="text-center">
                                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline detail-button" data-order-id="{{ $data->order_id }}" data-date="{{ $data->created_at }}" data-total="{{ $data->harga + $data->ongkir }}" data-payment="QRIS" data-status="{{ $data->status }}" data-bukti="{{ Storage::url('public/payment/' . $data['bukti']) }}" data-user="{{ $data->customer->nama_user }}" data-cour="{{ $data->courier->nama_user }}" data-jarak="{{ $data->jarak }}" data-bukti-akhir="{{ Storage::url('public/payment/driver/' . $data['bukti_akhir']) }}">
                                                Details
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal detail transaction --}}
        <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-detail" role="dialog" aria-modal="true" id="modal-edit">
            <div class="flex items end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-200" id="modal-headline">
                                    Details Transaction
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="orderID" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Order ID</label>
                                <p id="orderID" class="mt-1 text-sm text-gray-900 dark:text-gray-200 truncate"></p>
                            </div>
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Date</label>
                                <p id="date" class="mt-1 text-sm text-gray-900 dark:text-gray-200"></p>
                            </div>
                            <div>
                                <label for="orderBy" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Ordered by</label>
                                <p id="orderBy" class="mt-1 text-sm text-gray-900 dark:text-gray-200"></p>
                            </div>
                            <div>
                                <label for="takenBy" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Taken by</label>
                                <p id="takenBy" class="mt-1 text-sm text-gray-900 dark:text-gray-200"></p>
                            </div>
                            <div>
                                <label for="total" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Total</label>
                                <p id="total" class="mt-1 text-sm text-gray-900 dark:text-gray-200"></p>
                            </div>
                            <div>
                                <label for="payment" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Payment</label>
                                <p id="payment" class="mt-1 text-sm text-gray-900 dark:text-gray-200"></p>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                                <p id="status" class="mt-1 text-sm text-gray-900 dark:text-gray-200"></p>
                            </div>
                            <div>
                                <label for="jarak" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Jarak</label>
                                <p id="jarak" class="mt-1 text-sm text-gray-900 dark:text-gray-200"></p>
                            </div>

                            {{-- button untuk melihat image dari bukti pembayaran transaksi --}}
                            <div class="col-span-2">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline show-proof-button" data-bukti="">
                                    Show Payment Proof
                                </button>
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline show-proof-button-driver" data-bukti-akhir="">
                                    Show Payment Proof Driver
                                </button>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline close-button">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal untuk menampilkan bukti pembayaran --}}
        <div id="payment-proof-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <img id="payment-proof-image" src="" alt="" class="w-full">
                    </div>
                    <div class="bg-white dark:bg-gray-800 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="document.getElementById('payment-proof-modal').classList.add('hidden')">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('modal-edit');
        const orderIdElement = document.getElementById('orderID');
        const dateElement = document.getElementById('date');
        const orderByElement = document.getElementById('orderBy');
        const takenByElement = document.getElementById('takenBy');
        const totalElement = document.getElementById('total');
        const paymentElement = document.getElementById('payment');
        const statusElement = document.getElementById('status');
        const jarakElement = document.getElementById('jarak');
        const detailButtons = document.querySelectorAll('.detail-button');
        const showProofButton = document.querySelector('.show-proof-button');
        const showProofDriverButton = document.querySelector('.show-proof-button-driver');
        const paymentProofModal = document.getElementById('payment-proof-modal');
        const paymentProofImage = document.getElementById('payment-proof-image');

        showProofButton.addEventListener('click', function() {
            const buktiUrl = this.getAttribute('data-bukti');
            if (buktiUrl) {
                paymentProofImage.src = buktiUrl;
                paymentProofModal.classList.remove('hidden');
            } else {
                alert('No payment proof available.');
            }
        });

        showProofDriverButton.addEventListener('click', function() {
            const buktiUrl = this.getAttribute('data-bukti-akhir');
            if (buktiUrl) {
                paymentProofImage.src = buktiUrl;
                paymentProofModal.classList.remove('hidden');
            } else {
                alert('No payment proof available.');
            }
        });

        detailButtons.forEach(button => {
            button.addEventListener('click', function() {
                const orderId = '#TRX' + this.getAttribute('data-order-id').substring(0, 10).toUpperCase();
                const date = this.getAttribute('data-date');
                const user = this.getAttribute('data-user');
                const courier = this.getAttribute('data-cour');
                const jarak = this.getAttribute('data-jarak');
                const total = 'Rp. ' + this.getAttribute('data-total').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                const payment = this.getAttribute('data-payment');
                const status = this.getAttribute('data-status').charAt(0).toUpperCase() + this.getAttribute('data-status').slice(1);

                orderIdElement.textContent = orderId;
                dateElement.textContent = date;
                orderByElement.textContent = user;
                takenByElement.textContent = courier;
                totalElement.textContent = total;
                paymentElement.textContent = payment;
                statusElement.textContent = status;
                orderByElement.textContent = user;
                takenByElement.textContent = courier;
                if (jarak > 1000) {
                    var jarakKm = (jarak / 1000).toFixed(2);
                    jarakElement.textContent = jarakKm + ' km';
                } else {
                    jarakElement.textContent = jarak + ' m';
                }
                showProofButton.setAttribute('data-bukti', this.getAttribute('data-bukti'));
                showProofDriverButton.setAttribute('data-bukti-akhir', this.getAttribute('data-bukti-akhir'));
                modal.classList.remove('hidden');
            });
        });

        modal.querySelector('.close-button').addEventListener('click', function() {
            modal.classList.add('hidden');
        });
    });
</script>
