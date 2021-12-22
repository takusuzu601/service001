<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Shop extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'shop_phone',
        'email',
        'password',
        'email_verified'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 「１対多」の「多」
    public function casts()
    {
        return $this->hasMany(Cast::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function shopimgs()
    {
        return $this->hasMany(ShopImg::class);
    }
    // 1対1
    public function shopdescription()
    {
        return $this->hasOne(ShopDescription::class);
    }

    // 1対1 逆
    public function pref()
    {
        return $this->belongsTo(Pref::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    // 多対多
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
