<?php

namespace App\Http\Controllers;

use App\Services\GoogleDriveService;
use App\Services\Pipedream\PipedreamClient;
use App\Services\StorageConfigTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FilesystemException;

class IntegrationsController extends Controller
{
    public function initializeConnection(Request $request, PipedreamClient $pipedream)
    {
        $validated = $request->validate([
            'app' => 'required|string',
        ]);

        try {
            // Call Pipedream API to initialize the connection
            info('----- Getting client temp token ------');
            $response = $pipedream->request('post', 'tokens', [
                'external_user_id' => tenant()->id . '/' .auth()->id(),
                'environment' => $pipedream->environment
            ]);

            return response()->json([
                'success' => true,
                'data' => $response,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getAccounts(Request $request, PipedreamClient $pipedream){
        try {
            $response = $pipedream->getAccounts(tenant()->id.'/'.auth()->id());

            return response()->json([
                'success' => true,
                'data' => $response['data'],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function getIntegrationFolders(string $app, string $account_id, PipedreamClient $pipedream)
    {
         try {
             $payload = $pipedream->getAccount($account_id);
            // Transform the payload into the required configuration
            $config = StorageConfigTransformer::transform($app, $payload);

            info('--- Pipedream account payload ready -----', ['config' => $config]);

            // Build the disk dynamically
             $_drive = new GoogleDriveService($config);
            $disk = $_drive->getClient();


            // List files in the root directory (or specify a folder)
            $files = $disk->listContents('/My Drive');

            return response()->json($files);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (FilesystemException $e) {
              return response()->json(['error' => $e->getMessage()], 400);
         }

    }
}
