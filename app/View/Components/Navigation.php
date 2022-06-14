<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Navigation extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $auth = Auth::user()->id;

        // $checkIfHasProfile = DB::table('users')
        //     ->crossJoin('profiles', 'users.id', '=', 'profiles.user_id')
        //     ->where('users.id', $auth)
        //     ->exists();
        // return view('layouts.navigation', [
        //     'check' => $checkIfHasProfile
        // ]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $auth = Auth::user()->id;
        //dd($auth);

        $checkIfHasProfile = DB::table('users')
            ->crossJoin('profiles', 'users.id', '=', 'profiles.user_id')
            ->where('users.id', $auth)
            ->exists();
        return view('layouts.navigation', [
            'check' => $checkIfHasProfile
        ]);
    }
}
