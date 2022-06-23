<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Professionist\Sponsorship;
use Illuminate\Http\Request;
use App\Models\Professionist\Profile;

class ProfessionistApiController extends Controller
{
    public function getBundle()
    {
        $availableBundles = Sponsorship::all();
        return response()->json([
            'status'    => true,
            'response'  => [
                'data' => $availableBundles,
            ]
        ]);
    }

    public function getProfileInfo($id){
        $profile = Profile::find($id);
        return response()->json([
            'status' => true,
            'response' => $profile
        ]);
    }
}
