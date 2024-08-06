<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DestinationController extends Controller
{
    public function index()
    {
        // Add your logic here
        return view('map');
    }
    public function autocomplete(Request $request)
    {
        $query = $request->input('q');

        if (strlen($query) > 2) {
            $url = "https://nominatim.openstreetmap.org/search";
            $response = Http::get($url, [
                'q' => $query,
                'format' => 'json',
                'addressdetails' => 1,
                'limit' => 5,
            ]);

            return response()->json($response->json());
        }

        return response()->json($query);
    }
}
