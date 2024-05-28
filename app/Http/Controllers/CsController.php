<?php

namespace App\Http\Controllers;

use GPBMetadata\Google\Api\Auth;
use Illuminate\Http\Request;
use Exception;

class CsController extends Controller
{
    public function start(){
        $database = app('firebase.database');
        $custId = Auth::user()->id;
        $cust_name = Auth::user()->nama_user;
        $msg = request()->input('pertanyaan');
        date_default_timezone_set('Asia/Jakarta');
        $timestamp = date('Y-m-d H:i:s');
        $postData = [
            'msgs' => [
                'msg' => $msg,
                'timestamp' => $timestamp,
                'role' => "driver",
            ],
        ];
        $database->getReference('chats/' . $custId . '1')->push()->set($postData);
        $database->getReference('chats/' . $courId . '1' . '/cust_name')->set($cust_name);
        $database->getReference('chats/' . $courId . '1' . '/cour_name')->set('Admin');
        $database->getReference('chats/' . $courId . '1' . '/courNewMssg')->set(1);
        $database->getReference('chats/' . $courId . '1' . '/custNewMssg')->set(0);

        return view('pages/Users/ChatRoomPage', [
            'Title' => 'room-chat',
            'date' => $timestamp,
            'custId' => $uid,
            'courId' => '1',
            'cour_name' => 'Admin',
        ]);
    }
}
