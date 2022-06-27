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
use Illuminate\Support\Facades\Storage;
class ProfessionistApiController extends Controller
{
    private function getValidators(){
        $arr = [
            'phone' => 'required|min:5|max:20',
            'address' => 'required',
            'description' => 'required',
            'professions' => 'required',
            'curriculum' => 'required|mimes:pdf',
            'profilepic' => 'required|min:2|mimes:png,jpg'
        ];
        return $arr;
    }

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

    public function getDashInfo($id)
    {

        $users = Profile::with('professions', 'reviews')->join('users', 'profiles.id', '=', 'users.id')
            ->get();
        $user = $users->find($id);

        return response()->json([
            'data' => $user
        ]);
    }

    public function updateProfile($id){
        $profile = Profile::find($id);
        $profile->update(request()->all());
        return response()->json([
            'status' => true,
            'response' => $profile
        ]);
    }

    public function updateUser($id){
        $user = User::find($id);
        $user->update(request()->all());
        return response()->json([
            'status' => true,
            'response' => $user
        ]);
    }

    public function newProfile(Request $request)
    {
                // CREAZIONE NUOVO PROFILO
                $formData = $request->all() + [
                    'id' => Auth::user()->id,
                    'user_id' => Auth::user()->id,
                ];

                $request->validate($this->getValidators());
                
                $cv_url = Storage::put('cv', $formData['curriculum']);
                $pic_url = Storage::put('pic', $formData['profilepic']);
                $formData['curriculum'] = $cv_url;
                $formData['pic'] = $pic_url;
                $profession = $formData['professions'];
        
                // ATTACCA LA PROFESSIONE AL PROFILO
        
                Profile::create($formData);
                $profile = Profile::find(Auth::user()->id);
                $profile->professions()->attach($profession);
                return view('dashboard');
    }
}
