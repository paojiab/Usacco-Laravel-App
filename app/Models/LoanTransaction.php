<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'txn_type',
        'amount',
        'fee',
        'balance',
        'user_id'
    ];

    public function loan(){
        return $this->belongsTo(Loan::class);
    }
}
