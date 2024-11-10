<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'vaccacion_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function vaccation(){
        return $this->belongsTo(Vaccacion::class);
    }
}
