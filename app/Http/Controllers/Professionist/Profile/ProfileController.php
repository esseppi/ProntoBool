<?php

namespace App\Http\Controllers\Professionist\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Professionist\Lead;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Professionist\Review;
use Illuminate\Support\Facades\Auth;
use App\Models\Professionist\Profile;
use App\Models\Professionist\Service;
use Illuminate\Support\Facades\Storage;
use App\Models\Professionist\Profession;
use App\Models\Professionist\Sponsorship;

class ProfileController extends Controller
{
    private function getCreateValidators(){
        $arr = [
            'phone' => 'required|min:10|max:20',
            'address' => 'required',
            'description' => 'required',
            'professions' => 'required',
            'curriculum' => 'required|mimes:pdf',
            'profilepic' => 'required|min:2|mimes:png,jpg'
        ];
        return $arr;
    }

    private function getEditValidators(){
        $arr = [
            'phone' => 'required|min:10|max:20',
            'address' => 'required',
            'description' => 'required',
            'professions' => 'required',
        ];
        return $arr;
    }
    
    public function deleteJob($id)
    {
        $profile = Profile::find(Auth::user()->id);
        $profile->professions()->detach($id);
        $profile->update();
        return view('dashboard');
    }
    public function deleteService($id)
    {
        $service = Service::find($id);
        $service->delete();
        return view('dashboard');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Profile::whereRaw('1 = 1');

        return response()->json([
            'status'    => 'success',
            'balance'  => $data,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Profile $profile)
    {
        $auth = Auth::user()->id;
        $checkIfHasProfile = DB::table('users')
            ->crossJoin('profiles', 'users.id', '=', 'profiles.user_id')
            ->where('users.id', $auth)
            ->exists();

        if ($checkIfHasProfile) abort(403);
        $data = Profession::whereRaw('1=1')->get();
        return view('professionist.profile.create', [
            'profile'        => $profile,
            'professions'    => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Profession $profession)
    {   
        // CREAZIONE NUOVO PROFILO
        $formData = $request->all() + [
            'id' => Auth::user()->id,
            'user_id' => Auth::user()->id,
        ];

        //validation 
        $request->validate($this->getCreateValidators());
        
        $cv_url = Storage::put('cv', $formData['curriculum']);
        $pic_url = Storage::put('pic', $formData['profilepic']);
        dd($cv_url);
        $formData['curriculum'] = $cv_url;
        $formData['pic'] = $pic_url;
        $profession = $formData['professions'];

        // ATTACCA LA PROFESSIONE AL PROFILO

        Profile::create($formData);
        $profile = Profile::find(Auth::user()->id);
        $profile->professions()->attach($profession);
        return view('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $reviews = Review::where('profile_id', Auth::user()->id)->get();
        $services = Service::where('profile_id', Auth::user()->id)->get();
        $jobs = $profile->find(Auth::user()->id)->professions;
        $sponsorships = $profile->find(Auth::user()->id)->sponsorships;

        return view('professionist.profile.show', [
            'myId' => Auth::user()->id,
            'jobs'      => $jobs,
            'sponsorships' => $sponsorships,
            'reviews' => $reviews,
            'services' => $services
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */


    public function edit(Profile $profile)
    {
        $professions = Profession::whereRaw('1 = 1')->get();
        return view('professionist.profile.edit', [
            'profile'        => $profile,
            'professions'    => $professions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *edit
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //validation
        $request->validate($this->getEditValidators());
        
        // if (Auth::user()->id !== $profile->user_id) abort(403);
        
        $formData = $request->all();
        $professionId = $formData['professions'];
        $profile->update($formData);
        if ($professionId) {
            $profile->professions()->sync($professionId);
        }

        return view('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        if (Auth::user()->id !== $profile->user_id) abort(403);
        $allMyMsg = Lead::where('profile_id', Auth::user()->id)->get();
        foreach ($allMyMsg as $msg) {
            $msg->delete();
        }

        $deleteReview = Review::where('profile_id', Auth::user()->id);
        $deleteReview->delete();
        $deleteService = Service::where('profile_id', Auth::user()->id);
        $deleteService->delete();

        $profile->sponsorships()->detach();
        $profile->professions()->detach();
        $profile->delete();

        return view('dashboard')/*->with('status', "Profile $profile->title deleted")*/;
    }
}
