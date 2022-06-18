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
    {   // CREAZIONE NUOVO PROFILO

        $validate = $request->validate([
            'company-website' => 'url|max:250',
            'profilepic' => 'image',//da inserire la grandezza massima quando deciso come inserirla nello stile
            'description' => 'min:20',
            'curriculum' => 'image'
        ]);

        $formData = $request->all() + [
            'id' => Auth::user()->id,
            'user_id' => Auth::user()->id,
        ];


        $cv_url = Storage::put('cv', $formData['curriculum']);
        $pic_url = Storage::put('pic', $formData['profilepic']);
        $formData['curriculum'] = $cv_url;
        $formData['pic'] = $pic_url;


        // CREA PROFILO
        // VERIFICA SE LA PROFESSIONE INSERITA ESISTE GIA'
        $profession = $formData['professions'];
        // dd($profession);

        // $newProfession = Profession::find($profession)->id;
        // ATTACCA LA PROFESSIONE AL PROFILO


        Profile::create($formData);

        $profile = Profile::find(Auth::user()->id);
        $profile->professions()->attach($profession);

        return view('dashboard');


        // formData = $request->all() + [
        //     'id' => Auth::user()->id,
        //     'user_id' => Auth::user()->id,
        // ];
        // $cv_url = Storage::put('cv', $formData['curriculum']);
        // $pic_url = Storage::put('pic', $formData['profilepic']);
        // $formData['curriculum'] = $cv_url;
        // $formData['pic'] = $pic_url;
        // // CREA PROFILO
        // Profile::create($formData);
        // // VERIFICA SE LA PROFESSIONE INSERITA ESISTE GIA'
        // $profession = $formData['profession'];
        // // $checkIfProfessionExists = Profession::where('name', $profession)->exists();
        // // if (!$checkIfProfessionExists) {
        // //     $newProfession = Profession::create(['name' => $profession]);
        // // }
        // // SE NON ESISTE LA PROFESSIONE VIENE CREATA
        // $newProfession = Profession::where('name', $profession)->get('id');
        // // ATTACCA LA PROFESSIONE AL PROFILO
        // $profile = Profile::find(Auth::user()->id);
        // $profile->professions()->attach($newProfession->pluck('id')->all());
        // return view('dashboard');
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
            'profile'      => Auth::user(),
            //dice che stiamo ripetendo l'ogetto provare senza la riga qui sotto
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
        // if (Auth::user()->id !== $profile->user_id) abort(403);

        $validate = $request->validate([
            'company-website' => 'url|max:250',
            'profilepic' => 'image',//da inserire la grandezza massima quando deciso come inserirla nello stile
            'description' => 'min:20',
            'curriculum' => 'image'
        ]);

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
