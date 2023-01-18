<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();

        return view('/profile') -> with('user', $user);
    }

}
