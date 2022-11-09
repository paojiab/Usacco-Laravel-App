<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'interest',
        'loan_fee',
        'minimum',
        'maximum',
        'loan_duration'
    ];
}
