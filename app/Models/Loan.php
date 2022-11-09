<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'principal',
        'interest',
        'duration',
        'loan_fee',
        'disburse_amount',
        'reason',
        'balance',
        'maturity_date',
        'status',
        'guarantor',
        'collateral',
        'collateral_url',
        'collateral_ownership_url',
        'release_date'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function loanTransactions(){
        return $this->hasMany(LoanTransaction::class);
    }
}
