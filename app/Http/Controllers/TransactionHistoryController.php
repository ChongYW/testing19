<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionHistoryController extends Controller
{
    //
    public function showTransactionHistory()
    {
        $userID = auth()->id();

        $relatedData = Transaction::where('from_wallet_id', $userID)->get();

        return view('transaction_history', compact('relatedData'));
    }
}
