<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Exception;
use GuzzleHttp\Client;
use function Laravel\Prompts\error;

class CsController extends Controller
{
    private function bot($id, $msg, $timestamp){
        try{
            $client = new Client();
            $url = 'http://127.0.0.1:5000/chat';
            $response = $client->request('POST', $url, [
                'json' => [
                    'uid' => $id,
                    'message' => $msg,
                ]
            ]);
            if ($response != null) {
                $response = json_decode($response->getBody()->getContents());
                $database = app('firebase.database');
                if (strlen($response->message) > 0) {
                    $postData = [
                        'msgs' => [
                            'msg' => $response->message,
                            'timestamp' => $timestamp,
                            'role' => "admin",
                        ],
                    ];
                    $database->getReference('chats/' . $id . '-' . '1')->push()->set($postData);
                }
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return redirect()->back()->with('error2', 'Error');
        }
    }
    public function start()
    {
        try {
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
                    'role' => "customer",
                ],
            ];
            $database->getReference('chats/' . $custId . '-' . '1')->push()->set($postData);
            $database->getReference('chats/' . $custId . '-' . '1' . '/cust_name')->set($cust_name);
            $database->getReference('chats/' . $custId . '-' . '1' . '/cour_name')->set('Admin');
            $database->getReference('chats/' . $custId . '-' . '1' . '/courNewMssg')->set(1);
            $database->getReference('chats/' . $custId . '-' . '1' . '/custNewMssg')->set(0);
            $this->bot($custId, $msg, $timestamp);

            return view('pages/Users/ChatRoomPage', [
                'Title' => 'room-chat',
                'date' => $timestamp,
                'custId' => $custId,
                'courId' => '1',
                'cour_name' => 'Admin',
            ]);
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('error2', 'Error');
        }
    }
}
