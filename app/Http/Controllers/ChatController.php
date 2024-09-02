<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

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
            foreach ($refKey as $key) {
                $date = $database->getReference('chats/' . $custId . '-' . $courId . '/' . $key . '/msgs/timestamp')->getValue();
                if ($date != null) {
                    break;
                }
            }
            $wa = User::find($courId)->no_telp;
            if (substr($wa, 0, 2) === '08') {
                $convertedNumber = '+62' . substr($wa, 1);
            } else {
                //invalid number.
                $convertedNumber = '0';
            }
            // dd($refKey);
            return view('pages/Users/ChatRoomPage', [
                'Title' => 'room-chat',
                'cour_name' => $cour_name,
                'custId' => $custId,
                'courId' => $courId,
                'date' => $date,
                'wa' => $convertedNumber
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error2', 'Error');
        }
    }

    public function uploadChatImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/chatsImg');
            $url = Storage::url($path);

            return response()->json(['success' => true, 'imageUrl' => $url]);
        }

        return response()->json(['success' => false, 'error' => 'No image uploaded']);
    }

    public function redirectWhatsApp($phone)
    {
        if ($phone != null) {
            // Redirect to WhatsApp link
            return redirect("https://wa.me/{$phone}");
        } else {
            return redirect('/')->withErrors(['phone' => 'Invalid phone number format']);
        }
    }

    public function wa(Request $request)
    {
        $courId = $request->input('courId');
        $wa = User::find($courId)->no_telp;
        if (substr($wa, 0, 2) === '08') {
            $convertedNumber = '+62' . substr($wa, 1);
        } else {
            $convertedNumber = 'Invalid phone number format';
        }
        return redirect()->away('https://wa.me/' . $convertedNumber);
    }
}
