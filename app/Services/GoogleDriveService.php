<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class GoogleDriveService
{
    /**
     * The HTTP client instance to talk to Google Drive
     */
    protected PendingRequest $http;

    /**
     * Build a Drive service object from the user's access token
     *
     * @param  string  $accessToken
     */
    public function __construct(string $accessToken)
    {
        // Create the HTTP client ONCE with the token and base URL
        $this->http = Http::withToken($accessToken)
            ->baseUrl('https://www.googleapis.com/drive/v3');
    }

    /**
     * List all folders (or optionally search by a name fragment).
     */
    public function listFolders(?string $searchQuery = ''): array
    {
        $query = [
            "mimeType='application/vnd.google-apps.folder'",
            "trashed=false",
            "'root' in parents",  // Ensures only top-level folders
        ];

        if ($searchQuery) {
            $query[] = "name contains '" . addslashes($searchQuery) . "'";
        }

        $response = $this->http->get('files', [
            'q' => implode(' and ', $query),
            'fields' => 'files(id, name)',
        ]);

        if ($response->failed()) {
            // handle or log error
            return [];
        }

        return $response->json('files', []);
    }

    /**
     * List ONLY subfolders inside a given folder ID.
     */
    public function listSubFolders(string $folderId): array
    {
        $query = sprintf(
            "parents in '%s' and mimeType='application/vnd.google-apps.folder' and trashed=false",
            addslashes($folderId)
        );

        $response = $this->http->get('files', [
            'q' => $query,
            'fields' => 'files(id, name, mimeType)',
        ]);

        if ($response->failed()) {
            return [];
        }

        return $response->json('files', []);
    }

    /**
     * List ALL files (not just folders) under a folder ID.
     */
    public function listFilesInFolder(string $folderId): array
    {
        $query = sprintf(
            "parents in '%s' and trashed=false",
            addslashes($folderId)
        );

        $response = $this->http->get('files', [
            'q' => $query,
            'fields' => 'files(id, name, mimeType)',
        ]);

        if ($response->failed()) {
            return [];
        }

        return $response->json('files', []);
    }

    /**
     * Fetch metadata for a single file/folder by ID.
     */
    public function getFile(string $fileId): ?array
    {
        $response = $this->http->get("files/{$fileId}", [
            'fields' => 'id, name, mimeType, size, createdTime, modifiedTime',
        ]);

        if ($response->failed()) {
            return null;
        }

        return $response->json();
    }

}
