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
use App\Models\Professionist\Lead;
use App\Models\Professionist\Sponsorship;

class GuestApiController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function customFilter(Request $request)
    {
        $formData = $request->all();
        $res = [];
        // NO FILTRO
        if ($formData['city'] == 'Ovunque') {
            array_push($res, Profile::with('professions', 'reviews')->join('users', 'profiles.id', '=', 'users.id')
                ->get());
        }
        // FILTRO CITTA
        else if ($formData['city'] != 'Ovunque') {
            array_push($res, Profile::with('professions', 'reviews')->where('address', $formData['city'])->join('users', 'profiles.id', '=', 'users.id')
                ->get());
        }

        return response()->json([
            'data' => $res
        ]);
    }



    public function cityUser(Request $request)
    {
        $profGroupByCity = Profile::all()
            ->groupBy('address');
        return response()->json([
            'cities' => $profGroupByCity,

        ]);
    }
    public function promotedUser(Request $request)
    {

        $sponsoredUser = Profile::with('sponsorships', 'professions', 'reviews')->join('users', 'user_id', '=', 'users.id')->has('sponsorships')->get();



        return response()->json([
            'data' => $sponsoredUser
        ]);
    }



    public function bannerUser(Request $request)
    {
        $users = Profile::with('professions', 'reviews')->join('users', 'profiles.id', '=', 'users.id')->paginate(8);
        return response()->json([
            // 'data2' => $checkIfHasProfile,
            'data' => $users
        ]);
        //era in più
        //return response()->json([]);
    }



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

        $query = User::where('email', $request['email'])->get();
        $response = $query->count() == 0;
        return response()->json([
            'isUnique'  => $response
        ]);
    }

    public function sendReview(Request $request)
    {
        $data = $request->all();
        $resp = Review::create($data);
        return response()->json([
            "response" => $resp
        ]);
    }

    public function sendMessage(Request $request)
    {
        $data = $request->all();
        $resp = Lead::create($data);
        return response()->json([
            "response" => $resp
        ]);
    }

    public function getLocations(Request $request){
        $data = DB::table('profiles')->select('address')
                      ->groupBy('address')->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function getProfessions(Request $request){
        $data = Profession::all();

        return response()->json([
            'data' => $data
        ]);
    }

    public function getProfileProfessions($id){
        $data = Profile::find($id)->professions()->get();
        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function create()
    //{
    //
    //}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(Request $request)
    //{
    //
    //}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    //public function show(Profile $profile)
    //{
    //
    //}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    //public function edit(Profile $profile)
    //{
    //
    //}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, Profile $profile)
    //{
    //
    //}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Profile $profile)
    //{
    //
    //}
}
