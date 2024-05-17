<?php

namespace App\Http\Controllers;

use App\Models\history;

class TransactionController extends Controller
{
    public function index()
    {
        //temporary data transaction
        $data = history::all();
        return view('pages.Admin.transaction', [
            'Title' => 'Transactions',
            'datas' => $data
        ]);
    }
}
