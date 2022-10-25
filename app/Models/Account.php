<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'acct_no', 'status', 'first_name', 'last_name', 'sex', 'occupation', 'date_of_birth',
        'tel', 'nationality', 'address', 'next_of_kin', 'rel_kin', 'tel_kin', 'id_type', 'id_no', 'id_front', 'id_back',
        'passport_photo', 'signature', 'saving_product_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function savingProduct() {
        return $this->belongsTo(SavingProduct::class,'saving_product_id');
    }

    public function savingTransactions() {
        return $this->hasMany(SavingTransaction::class);
    }

}
