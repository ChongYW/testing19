<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showWallet()
    {

        $capitalType = "Capital";

        $capitalWallet = Wallet::where('user_id', auth()->id())->where('wallet_type', $capitalType)->first();

        $bonusType = "Bonus";

        $bonusWallet = Wallet::where('user_id', auth()->id())->where('wallet_type', $bonusType)->first();

        $userWallet = [
            'capitalWallet' => $capitalWallet,
            'bonusWallet' => $bonusWallet,
        ];

        return view('dashboard')->with($userWallet);

    }
}
