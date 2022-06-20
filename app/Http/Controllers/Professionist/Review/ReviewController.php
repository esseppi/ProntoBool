<?php

namespace App\Http\Controllers\Professionist\Review;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Professionist\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    private function getValidators(){
        return [
            'name' => 'required|min:2',
            'vote' => 'required|numeric|min:0|max:5',
            'email' => 'required|email',
            'profile_id' => 'required',
            'message' => 'required|min:10|max:255',
        ];
    }

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
        $data = DB::table('users')
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->get();
        return view('professionist.Review.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request; $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        //validazione dei campi
        $request->validate($this->getValidators());
        
        $lead = Review::create($data);
        return redirect()->route('dashboard', Auth::user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
