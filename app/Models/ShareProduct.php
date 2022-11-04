<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'selling_fee'
    ];

    public function shares(){
        return $this->hasMany(Share::class);
    }
}
