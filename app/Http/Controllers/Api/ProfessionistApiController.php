<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Professionist\Lead;
use Illuminate\Support\Facades\DB;
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



    public function updateProfile($id)
    {
        $profile = Profile::find($id);
        $profile->update(request()->all());
        return response()->json([
            'status' => true,
            'response' => $profile
        ]);
    }

    public function updateUser($id)
    {
        $user = User::find($id);
        $user->update(request()->all());
        return response()->json([
            'status' => true,
            'response' => $user
        ]);
    }

    // myDashboard
    public function getDashInfo($id)
    {

        $users = Profile::with('professions', 'reviews')->join('users', 'profiles.id', '=', 'users.id')
            ->get();
        $user = $users->find($id);

        return response()->json([
            'data' => $user
        ]);
    }
    public function getDashLeads($id)
    {
        // $leads = $leads = Lead::where('profile_id', $id)->get();



        $leads = Lead::selectRaw('year(created_at) as year, monthname(created_at) as month, COUNT(id)')
            ->groupBy('year', 'month')
            ->where('profile_id', $id)
            ->orderByRaw('min(created_at) desc')
            ->get();

        // SELECT COUNT(id), DATE_FORMAT(created_at, '%Y')
        // FROM leads
        // WHERE `profile_id` = 1
        // GROUP BY  DATE_FORMAT(created_at, '%Y');


        return response()->json([
            $leads
        ]);
    }

    public function getDashReviews($id)
    {
        $leads = Lead::where('profile_id', $id)->get();
        return response()->json([
            $leads
        ]);
    }
    public function getDashViews($id)
    {
        $leads = Lead::where('profile_id', $id)->get();
        return response()->json([
            $leads
        ]);
    }
}
