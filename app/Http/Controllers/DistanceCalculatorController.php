<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DistanceCalculatorController extends Controller
{
    public function ongkir(Request $request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $apiKey = env('GOOGLE_MAPS_API_KEY');
        $client = new Client();

        $response = $client->get("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&key=$apiKey");
        $data = json_decode($response->getBody(), true);

        // Extracting distance from the response
        $distance = $data['rows'][0]['elements'][0]['distance']['text'];

        return response()->json(['distance' => $distance]);
    }
}
