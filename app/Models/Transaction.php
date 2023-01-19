<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_time',
        'amount',
        'description',
        'transaction_type',
        'from_wallet_id',
        'from_user_id',
        'to_wallet_id',
        'to_user_id',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

}
