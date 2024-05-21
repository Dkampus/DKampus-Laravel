<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Users.ChatRoomPage');
    }


    public function listChat()
    {
        try {
            $currentUserId = Auth::user()->id;
            return view('pages/Users/ChatPage', [
                'Title' => 'list-chat',
                'custId' => $currentUserId,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    public function roomChat(Request $request)
    {
        try {
            $custId = Auth::user()->id;
            $courId = $request->input('courId');
            $database = app('firebase.database');
            $cour_name = $database->getReference('chats/' . $custId . '-' . $courId . '/cour_name')->getValue();
            $refKey = $database->getReference('chats/' . $custId . '-' . $courId)->getChildKeys();
            $date = $database->getReference('chats/' . $custId . '-' . $courId . '/' . $refKey[0] . '/msgs/timestamp')->getValue();
            // dd($date);
            return view('pages/Users/ChatRoomPage', [
                'Title' => 'room-chat',
                'cour_name' => $cour_name,
                'custId' => $custId,
                'courId' => $courId,
                'date' => $date,
            ]);
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->with('error2', 'Error');
        }
    }
}
