<?php

namespace App\Http\Controllers;

class TransactionController extends Controller
{
    public function index(){
        //temporary data transaction
        $data = [
            [
                'id' => encrypt(1),
                'date' => '2024-01-15 06:21:16',
                'name' => 'John Doe',
                'email' => 'jhondoe@gmail.com',
                'status' => 'Success', // 'Pending', 'Success', 'Failed
                'cart' => [
                    [
                        'name' => 'Product 1',
                        'price' => 10000,
                        'qty' => 2
                    ],
                    [
                        'name' => 'Product 2',
                        'price' => 20000,
                        'qty' => 1
                    ]
                ],
            ],
            [
                'id' => encrypt(2),
                'date' => '2024-01-15 06:21:16',
                'name' => 'Jane Doe',
                'email' => 'janedoe@gmail.com',
                'status' => 'Pending', // 'Pending', 'Success', 'Failed
                'cart' => [
                    [
                        'name' => 'Product 3',
                        'price' => 30000,
                        'qty' => 1
                    ],
                    [
                        'name' => 'Product 4',
                        'price' => 40000,
                        'qty' => 1
                    ]
                ],
            ],
            [
                'id' => encrypt(3),
                'date' => '2024-01-15 06:21:16',
                'name' => 'John Kim',
                'email' => 'jhonkim@gmail.com',
                'status' => 'Failed', // 'Pending', 'Success', 'Failed
                'cart' => [
                    [
                        'name' => 'Product 5',
                        'price' => 50000,
                        'qty' => 1
                    ],
                    [
                        'name' => 'Product 6',
                        'price' => 60000,
                        'qty' => 1
                    ]
                ],
            ],
        ];
        return view('pages.Admin.transaction',[
            'Title' => 'Transactions',
            'datas' => $data
        ]);
    }
}
