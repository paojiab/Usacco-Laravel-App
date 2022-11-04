<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use HasFactory;

    protected $fillable = [
        'share_product_id', 'user_id', 'shares'
    ];

    public function shareProduct(){
        return $this->belongsTo(ShareProduct::class);
    }
}
