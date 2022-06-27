<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Professionist\Lead;
use App\Http\Controllers\Controller;
use App\Models\Professionist\Review;
use Illuminate\Support\Facades\Auth;
use App\Models\Professionist\Profile;
use App\Models\Professionist\Sponsorship;

class ProfessionistApiController extends Controller
{
    public function myDashboard()
    {
        $availableBundles = Sponsorship::all();
        return response()->json([
            'status'    => true,
            'response'  => [
                'data' => $availableBundles,
            ]
        ]);
    }
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

    public function getProfileInfo($id)
    {
        $profile = Profile::find($id);
        return response()->json([
            'status' => true,
            'response' => $profile
        ]);
    }

    public function getUserInfo($id)
    {
        $user = User::find($id);
        return response()->json([
            'status' => true,
            'response' => $user
        ]);
    }

    public function getUserReviews($id)
    {
        $reviews = Review::where('profile_id', $id)->get();
        return response()->json([
            'status' => true,
            'response' => $reviews
        ]);
    }

    public function getUserMessages($id)
    {
        $leads = Lead::where('profile_id', $id)->get();
        return response()->json([
            'status' => true,
            'response' => $leads
        ]);
    }
}
