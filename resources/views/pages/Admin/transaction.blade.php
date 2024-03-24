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
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Total</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $key => $data)
                            <tr>
                                <td>#TRX{{ strtoupper(substr($data['id'], 0, 10)) }}</td>
                                <td>{{ $data['date'] }}</td>
                                <td>
                                    Rp. {{
                                        number_format(array_reduce($data['cart'], function ($carry, $item) {
                                            return $carry + ($item['price'] * $item['qty']);
                                        }, 0), 0, ',', '.')
                                    }}
                                </td>
                                <td>QRIS</td>
                                <td>{{ $data['status'] }}</td>
                                <td>
                                    <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Detail</a>
                                    <a href="#" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Process</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
{{--    console.log(@php echo json_encode($datas) @endphp);--}}
</script>
