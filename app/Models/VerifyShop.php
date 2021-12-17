<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyShop extends Model
{
    use HasFactory;

    public $table="verify_shops";

    protected $fillable=[
        'shop_id',
        'token',
    ];

    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}
