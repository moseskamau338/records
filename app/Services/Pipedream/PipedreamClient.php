<?php

namespace App\Services\Pipedream;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PipedreamClient
{
    protected string $baseUrl = 'https://api.pipedream.com/v1';
    protected string $clientId;
    protected string $clientSecret;
    public string $projectId;
    public string $environment;
    protected ?string $accessToken = null;

    public function __construct(string $clientId, string $clientSecret, string $projectId, string $environment)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->projectId = $projectId;
        $this->environment = $environment;
        $this->accessToken = $this->getAccessToken();
    }

    /**
     * Authenticate and retrieve a token
     */
    protected function authenticate(): string
    {
        $pipedreamRequestData = [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];
        info('Making Pipedream API request', $pipedreamRequestData);
        $response = Http::asJson()->post("{$this->baseUrl}/oauth/token", $pipedreamRequestData);
        info($response);
        if (!$response->successful()) {
            throw new \Exception('Authentication failed: ' . $response->body());
        }

        $data = $response->json();
//        Cache::put('pipedream_access_token', $data['access_token'], $data['expires_in'] - 60);

        return $data['access_token'];
    }

    /**
     * Retrieve the access token, auto-refresh if needed
     */
    protected function getAccessToken(): string
    {
//        if (Cache::has('pipedream_access_token')) {
//            return Cache::get('pipedream_access_token');
//        }

        return $this->authenticate();
    }

    /**
     * Make an authorized request to the Pipedream API
     */
    public function request(string $method, string $endpoint, array $data = []): array
    {
        $url = "{$this->baseUrl}/connect/{$this->projectId}/{$endpoint}";
        $response = Http::withHeader('x-pd-environment', $this->environment)->withToken($this->accessToken)
            ->{$method}($url, $data);

        if ($response->unauthorized()) {
            $this->accessToken = $this->authenticate();
            $response = Http::withToken($this->accessToken)
                ->{$method}($url, $data);
        }

        if (!$response->successful()) {
            throw new \Exception('API request failed: ' . $response->body());
        }

        return $response->json();
    }

    /**
     * Example: Retrieve credentials for user-authenticated apps
     */
    public function getCredentials(string $userId): array
    {
        return $this->request('get', 'user/credentials');
    }

    public function getAccounts(string $userId): array
    {
        return $this->request('get', 'accounts/', [
            'external_user_id' => $userId,
        ]);
    }
     public function getAccount(string $accountId): array
    {
        return $this->request('get', 'accounts/' . $accountId, [
            "include_credentials" => true
        ]);
    }
    public function removeUser(string $external_user_id)
    {
        return $this->request('gelete', 'users/'.$external_user_id);
    }
    public function disconnectAccount(string $account_id)
    {
        return $this->request('delete', '/accounts/'.$account_id);
    }
}
