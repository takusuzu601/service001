<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    // 多対多
    public function casts()
    {
        return $this->belongsToMany(Cast::class);
    }
}
