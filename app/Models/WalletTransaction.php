<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'txn_type', 'amount', 'status', 'reference','fee', 'balance', 'created_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
