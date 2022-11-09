<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Welfare extends Model
{
    use HasFactory;

    protected $fillable = ['amount','user_id','welfare_product_id'];

    public function welfareProduct(){
        return $this->belongsTo(WelfareProduct::class);
    }
}
