<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id', 'txn_type', 'amount', 'status', 'reference','fee'
    ];

    public function account() {
        return $this->belongsTo(Account::class);
    }
}
