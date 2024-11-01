<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $fillable = [
        'vaccation_id',
        'user_id',
    ];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function vaccation(){
        return $this->hasOne(Vaccation::class);
    }
}
