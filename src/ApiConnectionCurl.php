<?php

declare(strict_types=1);

namespace SmartTef;

class ApiConnectionCurl
{
    protected string $baseUrl;
    protected ?string $token = null;
    protected ?string $subscriptionKey = null;

    public function __construct()
    {
        $this->baseUrl = rtrim(getenv('SMART_TEF_API_BASE_URL'), '/');
        $this->token = getenv('SMART_TEF_API_TOKEN') ?: null;
        $this->subscriptionKey = getenv('SMART_TEF_API_SUBSCRIPTION_KEY') ?: null;
    }

    public function setAuthorization(string $token, string $subscriptionKey): void
    {
        $this->token = $token;
        $this->subscriptionKey = $subscriptionKey;
    }

    protected function getHeaders(): array
    {
        $headers = [
            'Accept: application/json',
        ];

        if ($this->subscriptionKey) {
            $headers[] = 'Ocp-Apim-Subscription-Key: ' . $this->subscriptionKey;
        }

        if ($this->token) {
            $headers[] = 'Authorization: Bearer ' . $this->token;
        }

        return $headers;
    }

    public function get(string $endpoint, array $queryParams = []): array
    {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');

        if (!empty($queryParams)) {
            $url .= '?' . http_build_query($queryParams);
        }

        return $this->request('GET', $url);
    }

    public function post(string $endpoint, array $data = []): array
    {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
        return $this->request('POST', $url, $data);
    }

    protected function request(string $method, string $url, array $data = []): array
    {
        $curl = curl_init();

        $headers = $this->getHeaders();

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_FAILONERROR => false,
        ];

        if ($method === 'POST') {
            $headers[] = 'Content-Type: application/json';
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
        }

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

        if (curl_errno($curl)) {
            $errorMsg = curl_error($curl);
            curl_close($curl);

            return $this->handleException($errorMsg, 0, null);
        }

        curl_close($curl);

        $decoded = json_decode($response, true);

        if ($httpCode >= 200 && $httpCode < 300) {
            return $decoded !== null ? $decoded : ['raw' => $response];
        }

        return $this->handleException("HTTP Error: $httpCode", $httpCode, $decoded);
    }

    protected function handleException(string $message, int $status, $body): array
    {
        return [
            'error' => true,
            'message' => $message,
            'status' => $status,
            'body' => $body,
        ];
    }
}
