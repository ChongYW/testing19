<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopUpController extends Controller
{
    public function topUp(Request $request)
    {
        $user = auth()->id();

        $request->validate([
            'target_wallet' => 'required',
            'amount' => 'required',
        ]);

        if ($request->target_wallet == "capital")
        {
            $capitalType = "Capital";

            $capitalWallet = Wallet::where('user_id', auth()->id())->where('wallet_type', $capitalType)->first();
            $capitalWallet->amount = $request['amount'];
            $capitalWallet->save();

            $targetWalletID = $capitalWallet->id;

            Transaction::create([
                'date_time' => now(),
                'amount' => $request['amount'],
//                'description',
                'transaction_type' => "Top-up",
                'from_wallet_id' => $targetWalletID,
                'from_user_id' => $user,
                'to_wallet_id' => $targetWalletID,
                'to_user_id' => $user,
            ]);
        }else
        {
            $bonusType = "Bonus";

            $bonusWallet = Wallet::where('user_id', auth()->id())->where('wallet_type', $bonusType)->first();
            $bonusWallet->amount = $request['amount'];
            $bonusWallet->save();

            $targetWalletID = $bonusWallet->id;

            Transaction::create([
                'date_time' => now(),
                'amount' => $request['amount'],
//                'description',
                'transaction_type' => "Top-up",
                'from_wallet_id' => $targetWalletID,
                'from_user_id' => $user,
                'to_wallet_id' => $targetWalletID,
                'to_user_id' => $user,
            ]);
        }

        return redirect('/dashboard')->with('status', 'Top-up successfully!');

    }
}
