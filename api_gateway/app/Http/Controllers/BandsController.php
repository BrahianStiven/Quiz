<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BandsController extends Controller
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = env('LARAVEL_API_URL');
        $this->apiKey = env('API_KEY');
    }


    public function getBand(string $id)
    {
        $url = $this->apiUrl.'/bands/ '. $id;
        $response = Http::withHeaders(['X-API-Key' => $this->apiKey])->get($url);
        return $response->json();
    }

    public function getBands()
    {
        $url = $this->apiUrl.'/bands';
        $response = Http::withHeaders(['X-API-Key' => $this->apiKey])->get($url);
        return $response->json();
    }
}
