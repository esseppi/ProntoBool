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
        $data = DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->get();
        return view('newMessage', [
            'profiles'      => $data
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

        //validazione dei campi
        $validation = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'profile_id' => 'required',
            'message' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validation->errors(),
            ]);
        } else {
            $lead = Lead::create($data);
            //Credenziali Mailtrap.io
            //mail: luigibardellagerbi@mail.com
            //pwd: team5boolean

            $email_prof = DB::table('users')
                ->where('users.id', $data['profile_id'])
                ->join('profiles', 'users.id', '=', 'profiles.user_id')
                ->get('email');

            Mail::to($email_prof)->send(new NewMessageMail($lead));
            // Mail::to($lead->email)->send(new NewMessageMail($lead));

            return response()->json([
                'success' => true,
                'lead' => $lead,
            ]);
        };
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
