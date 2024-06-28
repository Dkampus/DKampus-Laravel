<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Google\Client as GoogleClient;
use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Support\Facades\Log;


class NotificationController extends Controller
{

    public function registerToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $user = Auth::user();

        if ($user) {
            // Check if the token is already registered
            if ($user->fcm_token !== $request->token) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['fcm_token' => $request->token]);

                return response()->json(['success' => true, 'message' => 'Token registered successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Token is already registered']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
        }
    }

    public function sendNotification(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        Log::info('Notification request received.', [
            'user_id' => $request->user_id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        $user = User::find($request->user_id);

        if ($user && $user->fcm_token) {
            $response = $this->sendFirebaseNotification($user->fcm_token, $request->title, $request->body);
            Log::info('Notification sent successfully: ', ['response' => $response]);
            return response()->json(['success' => true, 'response' => $response]);
        } else {
            Log::error('User does not have a valid FCM token');
            return response()->json(['success' => false, 'message' => 'User does not have a valid FCM token']);
        }
    }

    private function sendFirebaseNotification($target, $title, $body, $data = [])
    {
        $projectId = env('FIREBASE_PROJECT_ID');
        $serviceAccountFilePath = storage_path('app/tester-6b415-3d526d9c1e77.json');

        $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

        // Initialize Google Client to fetch access token
        $googleClient = new GoogleClient();
        $googleClient->setAuthConfig($serviceAccountFilePath);
        $googleClient->addScope('https://www.googleapis.com/auth/firebase.messaging');

        // Fetch access token
        $httpClient = $googleClient->authorize();

        // Prepare FCM message payload
        $message = [
            'message' => [
                'token' => $target,
                'notification' => [
                    'body' => $body,
                    'title' => $title,
                ],
                // 'data' => $data,
            ]
        ];

        $accessToken = 'Bearer ' . $googleClient->fetchAccessTokenWithAssertion()['access_token'];
        // Send HTTP request to FCM API using Guzzle HTTP client

        $headers = [
            'Authorization' => $accessToken,
            'Content-Type' => 'application/json',
        ];
        $httpClient = new GuzzleHttpClient([
            'headers' => $headers,
        ]);

        $response = $httpClient->post($url, [
            'json' => $message,
        ]);

        // Decode and return the response
        return json_decode($response->getBody(), true);
    }

    public function sendNotificationToCouriers()
    {
        $couriers = User::where('role', 'courier')->get();

        $title = "Pesanan Baru Masuk";
        $body = "Halo DSquad, ada pesanan baru yang siap untuk diambil. Mohon segera periksa aplikasi Anda untuk detail lebih lanjut dan ambil pesanan tersebut. Terima kasih atas kerjasamanya!";
        foreach ($couriers as $courier) {
            if ($courier->fcm_token) {
                $this->sendFirebaseNotification($courier->fcm_token, $title, $body);
            }
        }
    }
}
