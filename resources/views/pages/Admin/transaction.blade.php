<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>

    @php
       // Temporary data transaction
         $transaction = [
              [
                'umkm' => 'UMKM 1',
                'cart' => [
                    [
                        'product' => 'Makanan 1',
                        'price' => 20000,
                        'qty' => 2
                    ],
                    [
                        'product' => 'Makanan 2',
                        'price' => 10000,
                        'qty' => 1
                    ]
              ],
                'total' => 40000,
                'status' => 'Success'
              ],
                [
                    'umkm' => 'UMKM 2',
                    'cart' => [
                        [
                            'product' => 'Makanan 3',
                            'price' => 15000,
                            'qty' => 2
                        ],
                        [
                            'product' => 'Makanan 4',
                            'price' => 25000,
                            'qty' => 1
                        ]
                ],
                    'total' => 55000,
                    'status' => 'Pending'
                ],
                [
                    'umkm' => 'UMKM 3',
                    'cart' => [
                        [
                            'product' => 'Makanan 5',
                            'price' => 30000,
                            'qty' => 2
                        ],
                        [
                            'product' => 'Makanan 6',
                            'price' => 20000,
                            'qty' => 1
                        ]
                ],
                    'total' => 80000,
                    'status' => 'Ditolak'
                ],
                [
                    'umkm' => 'UMKM 3',
                    'cart' => [
                        [
                            'product' => 'Makanan 5',
                            'price' => 30000,
                            'qty' => 2
                        ],
                        [
                            'product' => 'Makanan 6',
                            'price' => 20000,
                            'qty' => 1
                        ]
                ],
                    'total' => 80000,
                    'status' => 'Dibatalkan'
                ]
    ];
    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">List Transaction</h1>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">UMKM</th>
                                <th class="px-4 py-2">Product</th>
                                <th class="px-4 py-2">Qty</th>
                                <th class="px-4 py-2">Total</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction as $key => $item)
                            <tr>
                                <td class="border px-4 py-2">{{ $key+1 }}</td>
                                <td class="border px-4 py-2">{{ $item['umkm'] }}</td>
                                <td class="border px-4 py-2">
                                    @foreach ($item['cart'] as $cart)
                                        {{ $cart['product'] }} <br>
                                    @endforeach
                                </td>
                                <td class="border px-4 py-2">
                                    @foreach ($item['cart'] as $cart)
                                        {{ $cart['qty'] }} <br>
                                    @endforeach
                                </td>
                                <td class="border px-4 py-2">{{ $item['total'] }}</td>
                                <td class="border px-4 py-2">
                                    @switch($item['status'])
                                        @case('Success')
                                            <span class="text-green-500">{{ $item['status'] }}</span>
                                            @break
                                        @case('Pending')
                                            <span class="text-yellow-500">{{ $item['status'] }}</span>
                                            @break
                                        @case('Dibatalkan')
                                        @case('Ditolak')
                                            <span class="text-red-500">{{ $item['status'] }}</span>
                                            @break
                                        @default
                                            {{ $item['status'] }}
                                    @endswitch
                                </td>
                                <td class="border px-4 py-2">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Detail</button>
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
