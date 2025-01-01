<?php

namespace App\Http\Controllers;

use App\Services\Pipedream\PipedreamClient;
use Illuminate\Http\Request;

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
}
