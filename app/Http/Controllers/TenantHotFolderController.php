<?php

namespace App\Http\Controllers;

use App\Models\TenantHotFolder;
use Illuminate\Http\Request;

class TenantHotFolderController extends Controller
{
     /**
     * This function is used to set the hot folder in the Pipedream account as provided in the params
     */
    public function store(Request $request)
    {
        $request->validate([
            'app' => 'required',
            'account_id' => 'required',
            'folder' => 'required',
         ]);

         try {

                TenantHotFolder::updateOrCreate(
                    ['account_id' => $request->account_id], // Match condition
                    [
                        'app'    => $request->app,
                        'folder' => $request->folder,
                    ]
                );

                // reset user pipedream credentials
                $user = auth()->user();
                $user->pipedream_account_credentials = null;
                $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Hot folder set successfully!',
            ]);
        } catch (\InvalidArgumentException|\Exception $e) {
             info('Error setting hot folder', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
