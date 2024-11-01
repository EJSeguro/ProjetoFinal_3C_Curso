<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccation extends Model
{
    protected $fillable = [
        'name',
        'category',
        'description',
        'user_id',
        'active',
    ];

    public function recruiter(){
        return $this->hasOne(User::class);
    }
}
