<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'withdraw_charge', 'closing_charge','minimum_balance'
    ];

    // public function accounts() {
    //     return $this->hasMany(Account::class);
    // }
}
