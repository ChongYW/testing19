<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
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
            $capitalWallet->amount += $request['amount'];
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
            $bonusWallet->amount += $request['amount'];
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

    public function transfer(Request $request)
    {
        $user = auth()->id();

        $status = null;
        $message = null;

        $request->validate([
            'target_wallet' => 'required',
            'to_wallet_id' => 'required',
            'amount' => 'required',
        ]);

        if ($request->target_wallet == "capital")
        {
            $capitalType = "Capital";

            $capitalWallet = Wallet::where('user_id', auth()->id())->where('wallet_type', $capitalType)->first();

            if ($capitalWallet->amount >= $request['amount'])
            {
                if (Wallet::find($request['to_wallet_id']) != null)
                {
                    $capitalWallet->amount -= $request['amount'];
                    $capitalWallet->save();

                    $targetWalletID = $capitalWallet->id;

                    $toWalletID = Wallet::findOrFail($request['to_wallet_id']);
                    $toWalletID -> amount += $request['amount'];
                    $toWalletID -> save();

                    Transaction::create([
                        'date_time' => now(),
                        'amount' => $request['amount'],
                        'description' => $request['description'],
                        'transaction_type' => "Transfer",
                        'from_wallet_id' => $targetWalletID,
                        'from_user_id' => $user,
                        'to_wallet_id' => $request['to_wallet_id'],
                        'to_user_id' => $toWalletID->user_id,
                    ]);

                    $status = 'status';
                    $message = 'Transfer successfully!';

                }else
                {
                    $status = 'error';
                    $message = 'Target wallet ID not found!';
                }
            }else
            {
                $status = 'error';
                $message = 'Current wallet amount not enough!';
            }
        }else
        {
            $bonusType = "Bonus";

            $bonusWallet = Wallet::where('user_id', auth()->id())->where('wallet_type', $bonusType)->first();

            if ($bonusWallet->amount >= $request['amount'])
            {
                if (Wallet::find($request['to_wallet_id']) != null)
                {
                    $bonusWallet->amount -= $request['amount'];
                    $bonusWallet->save();

                    $targetWalletID = $bonusWallet->id;

                    $toWalletID = Wallet::findOrFail($request['to_wallet_id']);
                    $toWalletID -> amount += $request['amount'];
                    $toWalletID -> save();

                    Transaction::create([
                        'date_time' => now(),
                        'amount' => $request['amount'],
                        'description' => $request['description'],
                        'transaction_type' => "Transfer",
                        'from_wallet_id' => $targetWalletID,
                        'from_user_id' => $user,
                        'to_wallet_id' => $request['to_wallet_id'],
                        'to_user_id' => $toWalletID->user_id,
                    ]);

                    $status = 'status';
                    $message = 'Transfer successfully!';

                }else
                {
                    $status = 'error';
                    $message = 'Target wallet ID not found!';
                }
            }else
            {
                $status = 'error';
                $message = 'Current wallet amount not enough!';
            }
        }

        return redirect('/dashboard')->with($status, $message);

    }

    public function withdraw(Request $request)
    {
        $user = auth()->id();

        $status = null;
        $message = null;

        $request->validate([
            'target_wallet' => 'required',
            'amount' => 'required',
        ]);

        if ($request->target_wallet == "capital")
        {
            $capitalType = "Capital";

            $capitalWallet = Wallet::where('user_id', auth()->id())->where('wallet_type', $capitalType)->first();

            if ($capitalWallet->amount >= $request['amount'])
            {
                $capitalWallet->amount -= $request['amount'];
                $capitalWallet->save();

                $targetWalletID = $capitalWallet->id;

                Transaction::create([
                    'date_time' => now(),
                    'amount' => $request['amount'],
//                'description',
                    'transaction_type' => "Withdraw",
                    'from_wallet_id' => $targetWalletID,
                    'from_user_id' => $user,
                    'to_wallet_id' => $targetWalletID,
                    'to_user_id' => $user,
                ]);

                $status = 'status';
                $message = 'Withdraw successfully!';

            }else
            {
                $status = 'error';
                $message = 'Current wallet amount not enough!';
            }

        }else
        {
            $bonusType = "Bonus";

            $bonusWallet = Wallet::where('user_id', auth()->id())->where('wallet_type', $bonusType)->first();

            if ($bonusWallet->amount >= $request['amount'])
            {
                $bonusWallet->amount -= $request['amount'];
                $bonusWallet->save();

                $targetWalletID = $bonusWallet->id;

                Transaction::create([
                    'date_time' => now(),
                    'amount' => $request['amount'],
//                'description',
                    'transaction_type' => "Withdraw",
                    'from_wallet_id' => $targetWalletID,
                    'from_user_id' => $user,
                    'to_wallet_id' => $targetWalletID,
                    'to_user_id' => $user,
                ]);

                $status = 'status';
                $message = 'Withdraw successfully!';

            }else
            {
                $status = 'error';
                $message = 'Current wallet amount not enough!';
            }
        }

        return redirect('/dashboard')->with($status, $message);

    }

}
