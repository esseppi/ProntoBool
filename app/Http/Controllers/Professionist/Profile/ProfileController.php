<?php

namespace App\Http\Controllers\Professionist\Profile;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Professionist\Profile;
use App\Models\Professionist\Profession;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;

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
        $professions = Profession::whereRaw('1 = 1');
        return view('professionist.profile.create', [
            'profile'        => $profile,
            'professions'    => $professions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $formData = $request->all() + [
            'user_id' => Auth::user()->id
        ];

        $newProfile = Profile::create($formData);
        // $newProfile->tags()->attach($formData['profession']);
        return view('professionist.profile.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */


    public function edit(Profile $profile)
    {
        $professions = Profession::whereRaw('1 = 1');
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
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        // if (Auth::user()->id !== $profile->user_id) abort(403);

        $formData = $request->all() + [
            'user_id' => Auth::user()->id
        ];
        $newProfile = Profile::create($formData);
        $newProfile->tags()->attach($formData['profession']);
        return redirect()->route('professionist.profile.show', $profile->id);

        $profession = Profession::all();
        return view('professionist.profile.edit', [
            'profession'          => $profession,
            'profile'             => $profile,
        ]);
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

        // $professions->tags()->detach();
        // $professions->tags()->sync([]);
        $profile->delete();

        if (url()->previous() === route('profession.profile.edit', $profile->id)) {
            return redirect()->route('profession.profile.create')/*->with('status', "Post $post->title deleted")*/;
        }
        return redirect(url()->previous())/*->with('status', "Post $post->title deleted")*/;
    }
}
