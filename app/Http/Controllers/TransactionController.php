<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
        //temporary data
        $data = [
            'id' => '1',
        ];
        return view('pages.Admin.transaction',[
            'Title' => 'Transactions',
            'data' => $data
        ]);
    }
}
