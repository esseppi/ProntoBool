<?php

namespace App\Http\Controllers\Professionist\Profile;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Professionist\Profile;
use App\Models\Professionist\Profession;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
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
        if (Auth::user()->hasProfile) abort(403);
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
        $formData = $request->all() + [
            'id' => Auth::user()->id,
            'user_id' => Auth::user()->id,
        ];
        $cv_url = Storage::put('cv', $formData['curriculum']);
        $pic_url = Storage::put('pic', $formData['profilepic']);
        $formData['curriculum'] = $cv_url;
        $formData['pic'] = $pic_url;
        // dd($cv_url);
        // CREA PROFILO E AGGIORNA USER hasProfile
        Profile::create($formData);
        User::find(Auth::user()->id)->update(['hasProfile' => true]);
        // VERIFICA SE LA PROFESSIONE INSERITA ESISTE GIA'
        $profession = $formData['profession'];
        $checkIfProfessionExists = Profession::where('name', $profession)->exists();
        if (!$checkIfProfessionExists) {
            $newProfession = Profession::create(['name' => $profession]);
        }
        // SE NON ESISTE LA PROFESSIONE VIENE CREATA
        $newProfession = Profession::where('name', $profession)->get('id');
        // ATTACCA LA PROFESSIONE AL PROFILO
        $profile = Profile::find(Auth::user()->id);
        $profile->professions()->attach($newProfession->pluck('id')->all());
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
        $infojob = $profile->find(Auth::user()->id)->professions;
        // dd($infojob);
        return view('professionist.profile.show', [
            'infos'      => $infojob
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

        $formData = $request->all();
        $profile->update($formData);
        $professionId = Profession::where('name', $formData['profession'])->get('id');
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

        $profile->professions()->detach();
        $profile->delete();
        User::find($profile->id)->update(['hasProfile' => false]);

        return view('dashboard')/*->with('status', "Profile $profile->title deleted")*/;
    }
}
