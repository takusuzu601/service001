<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;


    protected $fillable = [
        'shop_id',
        'name',
        'cast_description'
    ];

    // １対 多 の１側なので単数形
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    // １対 多
    public function castimgs()
    {
        return $this->hasMany(CastImg::class);
    }

    // 多対多
    public function types(){
        return $this->belongsToMany(Type::class);
    }
}
