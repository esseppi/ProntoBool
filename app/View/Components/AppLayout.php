<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $auth = Auth::user()->id;
        // dd($auth);

        $checkIfHasProfile = DB::table('users')
            ->crossJoin('profiles', 'users.id', '=', 'profiles.user_id')
            ->where('users.id', $auth)
            ->exists();
        return view('layouts.app', [
            'check' => $checkIfHasProfile
        ]);
    }
}
