<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Professionist\Sponsorship;
use Illuminate\Http\Request;

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
}
