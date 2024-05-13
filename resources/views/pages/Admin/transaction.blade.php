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
                                @foreach($datas as $key => $data)
                                <tr>
                                    <td>#TRX{{ strtoupper(substr($data['id'], 0, 20)) }}</td>
                                    <td class="text-center">{{ $data['date'] }}</td>
                                    <td class="text-center">
                                        Rp. {{
                                            number_format(array_reduce($data['cart'], function ($carry, $item) {
                                                return $carry + ($item['price'] * $item['qty']);
                                            }, 0), 0, ',', '.')
                                        }}
                                    </td>
                                    <td class="text-center">QRIS</td>
                                    <td class="text-center">
                                        @if ($data['status'] == 'Success')
                                        <span class="text-green-400 font-bold">{{ $data['status'] }}</span>
                                        @elseif ($data['status'] == 'Pending')
                                        <span class="text-yellow-400 font-bold">{{ $data['status'] }}</span>
                                        @else
                                        <span class="text-red-400 font-bold">{{ $data['status'] }}</span>
                                        @endif
                                    <td class="text-center">
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
</script>