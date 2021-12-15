<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyOner extends Model
{
    use HasFactory;

    public $table="verify_oners";

    protected $fillable=[
        'oner_id',
        'token',
    ];

    public function oner(){
        return $this->belongsTo(Oner::class);
    }
}
