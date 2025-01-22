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

    /**
    This function is used to get the folders in the Any account as provided in the params
     * It retrieve credentials via Pipedream and builds a disk dynamically
     * It then lists the files in the root directory (or specify a folder)
     */
    public function getIntegrationFolders(string $app, string $account_id,Request $request, PipedreamClient $pipedream)
    {
         try {
             if(!$request->has('folder_id')) {
                 $payload = $pipedream->getAccount($account_id);
                 $user = auth()->user();
                 $user->pipedream_account_credentials = $payload;
                 $user->save();
             }

            // Transform the payload into the required configuration
            $config = StorageConfigTransformer::transform($app, auth()->user()->pipedream_account_credentials);

            // initialise drive service
             $driveClient = new GoogleDriveService($config['accessToken']);

            $folders = $request->has('folder_id') ? $driveClient->listSubFolders($request->query('folder_id')) : $driveClient->listFolders();

            return response()->json($folders);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (FilesystemException $e) {
              return response()->json(['error' => $e->getMessage()], 400);
         }

    }
}
