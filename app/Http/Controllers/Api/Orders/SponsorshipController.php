<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use App\Http\Resources\SponsorshipResource;
use App\Models\Professionist\Sponsorship;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    public function index(Request $request)
    {
        $bundle = Sponsorship::all();
        return SponsorshipResource::collection($bundle);
    }
}
