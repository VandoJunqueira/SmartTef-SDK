<?php

declare(strict_types=1);

namespace SmartTef;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;

class ApiConnection
{
    protected string $baseUrl;
    protected ?string $token;
    protected ?string $subscriptionKey;

    public function __construct()
    {
        $this->baseUrl = getenv('SMART_TEF_API_BASE_URL');
        $this->token = getenv('SMART_TEF_API_TOKEN');
        $this->subscriptionKey = getenv('SMART_TEF_API_SUBSCRIPTION_KEY');
    }

    public function setAuthorization(string $token, string $subscriptionKey)
    {
        $this->token = $token;
        $this->subscriptionKey = $subscriptionKey;
    }

    protected function getHeaders(): array
    {
        $headers = [
            'Accept' => 'application/json',
            'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
        ];

        if ($this->token) {
            $headers['Authorization'] = 'Bearer ' . $this->token;
        }

        return $headers;
    }

    public function get(string $endpoint, array $queryParams = []): Response|array
    {
        $url = rtrim($this->baseUrl, '/') . '/' . ltrim($endpoint, '/');

        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($url, $queryParams);

            $response->throw();

            return $response->json();
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    public function post(string $endpoint, array $data = []): Response|array
    {
        $url = rtrim($this->baseUrl, '/') . '/' . ltrim($endpoint, '/');

        try {
            $response = Http::withHeaders($this->getHeaders())
                ->post($url, $data);

            $response->throw();

            return $response->json();
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    protected function handleException(RequestException $e): array
    {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'status' => $e->response ? $e->response->status() : 500,
            'body' => $e->response ? $e->response->json() : null,
        ];
    }
}
