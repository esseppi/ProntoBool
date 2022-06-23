<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Professionist\Profile;
use PhpParser\Node\Expr\Cast\Object_;
use App\Models\Professionist\Profession;
use App\Models\Professionist\Review;

class GuestApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Profile::whereRaw('1 = 1');
        return response()->json([
            'status'    => true,
            'response'  => [
                'data' => $data->get(),
            ]
        ]);
    }
    public function getSearchInfo(Request $request)
    {

        $profNames = Profession::all('name');
        $profGroupByCity = Profile::all()
            ->groupBy('address');

        return response()->json([
            'profNames'  => $profNames,
            'placeNames'  => $profGroupByCity

        ]);
    }

    public function getSearchResult(Request $request)
    {

        $profNames = Profession::all('name');
        $profGroupByCity = Profile::all()
            ->groupBy('address');

        return response()->json([
            'profNames'  => $profNames,
            'placeNames'  => $profGroupByCity

        ]);
    }
    public function customFilter(Request $request)
    {
        return response()->json([
            $request->all()
        ]);
    }
    public function getProfInfo(Request $request)
    {

        $users = Profile::with('professions', 'reviews')->join('users', 'profiles.id', '=', 'users.id')
            ->get();
        return response()->json([
            // 'data2' => $checkIfHasProfile,
            'data' => $users
        ]);
    }

    public function landingPage(Request $request)
    {

        $profNames = Profession::all('name');
        $profGroupByCity = Profile::all()
            ->groupBy('address');

        return response()->json([
            'profNames'  => $profNames,
            'placeNames'  => $profGroupByCity

        ]);
    }

    public function isUnique(Request $request)
    {

        $query = User::where('email',$request['email'])->get();
        $response = $query->count() == 0;
        return response()->json([
            'isUnique'  => $response
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
