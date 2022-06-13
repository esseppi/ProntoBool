<?php

namespace App\Http\Controllers\Professionist;

use App\Mail\NewMessageMail;
use Illuminate\Http\Request;
use App\Models\Professionist\Lead;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Lead::paginate(10);
        return view('professionist.lead.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->get();
        return view('professionist.lead.newMessage', [
            'profiles'      => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLeadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        dd($data);

        // //validazione dei campi
        // $validation = Validator::make($data, [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'message' => 'required',
        // ]);

        // if ($validation->fails()) {
        //     return response()->json([
        //         'success' => false,
        //         'error' => $validation->errors(),
        //     ]);
        // } else {
        //     $lead = Lead::create($data);
        //     //Credenziali Mailtrap.io
        //     //mail: luigibardellagerbi@mail.com
        //     //pwd: team5boolean


        //     Mail::to($lead->email)->send(new NewMessageMail(compact('data')));

        //     return response()->json([
        //         'success' => true,
        //         'lead' => $lead,
        //     ]);
        // };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLeadRequest  $request
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        //
    }
}
