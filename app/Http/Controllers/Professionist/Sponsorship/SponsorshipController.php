<?php

namespace App\Http\Controllers\Professionist\Sponsorship;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Professionist\Profile;
use App\Models\Professionist\Sponsorship;
use App\Http\Requests\UpdateSponsorshipRequest;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bundles = Sponsorship::all();
        return view('professionist.sponsorship.create', compact("bundles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $duration = Sponsorship::find($data['bundle_id'])->duration;
        $endDate = date_add(now(), date_interval_create_from_date_string($duration));
        Profile::find(Auth::user()->id)->sponsorships()->attach($data['bundle_id'], ['startDate' => now(), 'endDate' => $endDate, 'isActive' => 1]);
        return view('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsorship $sponsorship)
    {
        //
    }
}
