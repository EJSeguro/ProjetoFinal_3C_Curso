<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'title',
        'company',
        'description',
        'start_date',
        'end_date',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}