<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class LabelsController extends Controller
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = env('LABELS_API_URL');
        $this->apiKey = env('API_KEY');
    }
    
    public function generateLabels()
    {
        $url = $this->apiUrl.'/generate_labels';
        $response = Http::withHeaders(['X-API-Key' => $this->apiKey])->post($url, ['count' => 10]);
        return $response->json();
    }

    public function recordLabels()
    {
        $url = $this->apiUrl.'/record_labels';
        $response = Http::get($url);
        $filePath = 'temp/labels.csv';
        Storage::put($filePath, $response->body());

        return response()->download(storage_path('app/' . $filePath))->deleteFileAfterSend(true);
    }
}
