<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccacion extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'image',
        'field',
        'location',
        'active',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function applications(){
        return $this->hasMany(Application::class);
    }
}
