<?php

namespace App\Http\AsaasService\Adapter;

use App\Http\AsaasService\Exceptions\ErrorResponse;
use Illuminate\Support\Facades\Http;

class AsaasApiAdapter
{
    protected $client;
    protected $baseUrl;
    protected $apiKey;
    protected $errorResponse;

    public function __construct()
    {
        $this->baseUrl = env('ASAAS_API_DOMAIN');
        $this->apiKey = env('ASAAS_API_KEY');
    }

    public function get($endpoint)
    {
        $url = $this->baseUrl . $endpoint;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'access_token' => $this->apiKey,
        ])->get($url);

        if ($response->ok()) {
            return $response->json();
        }

        $errorResponse = new ErrorResponse($response);
        return $errorResponse->generate();
    }
    
    public function post($endpoint, $data)
    {
        $url = $this->baseUrl . $endpoint;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'access_token' => $this->apiKey,
        ])->post($url, $data);

        if ($response->ok()) {
            return $response->json();
        }

        $errorResponse = new ErrorResponse($response);
        return $errorResponse->generate();
    }
}
