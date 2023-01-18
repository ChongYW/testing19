<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\ValidIC;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = User::findOrFail(auth()->id());

        return view('/profile') -> with('user', $user);
    }

    public function showEditProfile()
    {
        $user = User::findOrFail(auth()->id());

        return view('/edit_profile') -> with('user', $user);
    }

    public function updateProfile(Request $request)
    {

//        $currentUserID = auth()->id();
//
//        $request->validate([
//            'name' => "required|string|max:255|alpha_dash|unique:users,name,$currentUserID",
//            'dob' => 'nullable|date|before:13 years ago',
//        ],[
//            'dob.before' => 'The day of birth must be a date before 13 years ago.'
//        ]);
//
//        $status = null;
//        $message = null;
//
//        if ($request['referral_id'] != null)
//        {
//            if (User::find($request['referral_id']) != null)
//            {
//                if ($request['referral_id'] != auth()->id())
//                {
//                    $user = User::findOrFail(auth()->id());
//                    $user->name = $request['name'];
//                    $user->dob = $request['dob'];
//                    $user->referral_id = $request['referral_id'];
//                    $user->save();
//
//                    $status = 'status';
//                    $message = 'Profile updated!';
//
//                }else
//                {
//                    $user = User::findOrFail(auth()->id());
//                    $user->name = $request['name'];
//                    $user->dob = $request['dob'];
//                    $user->save();
//
//                    $status = 'error';
//                    $message = 'Not valid referral ID!';
//                }
//            }else
//            {
//                $user = User::findOrFail(auth()->id());
//                $user->name = $request['name'];
//                $user->dob = $request['dob'];
//                $user->save();
//
//                $status = 'error';
//                $message = 'Not valid referral ID!';
//            }
//        }else
//        {
////                return redirect('/profile')->with('error', 'Not valid referral ID!');
//
//            $user = User::findOrFail(auth()->id());
//            $user->name = $request['name'];
//            $user->dob = $request['dob'];
//            $user->save();
//
//            $status = 'status';
//            $message = 'Profile updated!';
//
////                $status = 'error';
////                $message = 'Not valid referral ID!';
//
//        }
//        return redirect('/profile')->with($status, $message);

        $currentUserID = auth()->id();

        $request->validate([
            'name' => "required|string|max:255|alpha_dash|unique:users,name,$currentUserID",
            'dob' => 'nullable|date|before:13 years ago',
        ],[
            'dob.before' => 'The day of birth must be a date before 13 years ago.'
        ]);

        $status = null;
        $message = null;

        if ($request['referral_id'] != null)
        {
            if (User::find($request['referral_id']) != null)
            {
                if ($request['referral_id'] != auth()->id())
                {
                    $user = User::findOrFail(auth()->id());
                    $user->referral_id = $request['referral_id'];
                    $user->save();

                    $status = 'status';
                    $message = 'Profile updated!';

                }else
                {
                    $status = 'error_warning';
                    $message = 'Profile updated, but referral ID cant be current user ID!';
                }
            }else
            {
                $status = 'error';
                $message = 'Profile updated, but referral ID not found!';
            }
        }else
        {
            $user = User::findOrFail(auth()->id());
            $user->referral_id = null;
            $user->save();

            $status = 'status';
            $message = 'Profile updated!';

        }
        $user = User::findOrFail(auth()->id());
        $user->name = $request['name'];
        $user->dob = $request['dob'];
        $user->save();

        return redirect('/profile')->with($status, $message);

    }

}
