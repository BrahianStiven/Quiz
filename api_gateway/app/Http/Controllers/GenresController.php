<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenresController extends Controller
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = env('LARAVEL_API_URL');
        $this->apiKey = env('API_KEY');
    }


    public function getGenre(string $id)
    {
        $url = $this->apiUrl.'/genres/' . $id;
        $response = Http::withHeaders(['X-API-Key' => $this->apiKey])->get($url);
        return $response->json();
    }

    public function getGenres()
    {
        $url = $this->apiUrl.'/genres';
        $response = Http::withHeaders(['X-API-Key' => $this->apiKey])->get($url);
        return $response->json();
    }
}
