<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CastImg extends Model
{
    use HasFactory;

    protected $fillable = [
        'cast_id',
        'img_path'
    ];

    // １対 多 の１側なので単数形
    public function cast()
    {
        return $this->belongsTo(Cast::class);
    }
}
