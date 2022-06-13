<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSponsorhipRequest;
use App\Http\Requests\UpdateSponsorhipRequest;
use App\Models\Sponsorhip;

class SponsorhipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreSponsorhipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSponsorhipRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsorhip  $sponsorhip
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsorhip $sponsorhip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsorhip  $sponsorhip
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsorhip $sponsorhip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSponsorhipRequest  $request
     * @param  \App\Models\Sponsorhip  $sponsorhip
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSponsorhipRequest $request, Sponsorhip $sponsorhip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsorhip  $sponsorhip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsorhip $sponsorhip)
    {
        //
    }
}
