<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WelfareProduct extends Model
{
    use HasFactory;

    protected $fillable = ['name','contribution'];

    public function welfares(){
        return $this->hasMany(Welfare::class);
    }
}
