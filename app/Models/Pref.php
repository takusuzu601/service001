<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pref extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    
        // 1対1
        public function shop()
        {
            return $this->hasOne(Shop::class);
        }
}
