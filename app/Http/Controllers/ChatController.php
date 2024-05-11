<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Http\Controllers\Controller;
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

    /**
     * Show the form for creating a new resource.
     */

    public function listChat()
    {
        $currentUserId = Auth::user()->id;
        return view('pages/Users/ChatPage', [
            'Title' => 'list-chat',
            'custId' => $currentUserId,
        ]);
    }

    public function roomChat(Request $request)
    {
        $custId = Auth::user()->id;
        $courId = $request->input('courId');
        $database = app('firebase.database');
        $cour_name = $database->getReference('chats/' . $custId . '-' . $courId . '/cour_name')->getValue();
        $refKey = $database->getReference('chats/' . $custId . '-' . $courId)->getChildKeys();
        $date = $database->getReference('chats/' . $custId . '-' . $courId . '/' . $refKey[0] . '/msgs/timestamp')->getValue();
        // dd($date);
        return view('pages/users/chatroompage', [
            'Title' => 'room-chat',
            'cour_name' => $cour_name,
            'custId' => $custId,
            'courId' => $courId,
            'date' => $date,
        ]);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
