<?php

namespace App\Services;

class StorageConfigTransformer
{
    /**
     * Transform the payload into the required configuration for the storage provider.
     *
     * @param string $provider
     * @param array $payload
     * @return array
     * @throws \InvalidArgumentException
     */
    public static function transform(string $provider, array $payload): array
    {
        $driver_map = [
            'google_drive' => 'google',
            'dropbox' => 'dropbox',
        ];
        return match ($driver_map[$provider]) {
            'google' => [
                'driver' => 'google',
                'clientId' => $payload['credentials']['oauth_client_id'] ?? throw new \InvalidArgumentException("clientId is required for Google Drive"),
                'clientSecret' => $payload['credentials']['oauth_access_token'] ?? throw new \InvalidArgumentException("clientSecret is required for Google Drive"),
                'refreshToken' => $payload['credentials']['oauth_refresh_token'] ?? throw new \InvalidArgumentException("refreshToken is required for Google Drive"),
            ],
            'dropbox' => [
                'driver' => 'dropbox',
                'accessToken' => $payload['accessToken'] ?? throw new \InvalidArgumentException("accessToken is required for Dropbox"),
            ],
            'onedrive' => [
                'driver' => 'onedrive',
                'clientId' => $payload['clientId'] ?? throw new \InvalidArgumentException("clientId is required for OneDrive"),
                'clientSecret' => $payload['clientSecret'] ?? throw new \InvalidArgumentException("clientSecret is required for OneDrive"),
                'accessToken' => $payload['accessToken'] ?? throw new \InvalidArgumentException("accessToken is required for OneDrive"),
                'refreshToken' => $payload['refreshToken'] ?? null, // Optional
            ],
            default => throw new \InvalidArgumentException("Unsupported storage provider: $provider"),
        };
    }
}
