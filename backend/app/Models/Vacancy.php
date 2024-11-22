<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    const HOMEOFFICE_CATEGORY = "homeoffice";
    const HYBRID_CATEGORY = "hybrid";
    const PRESENCIAL_CATEGORY = "presencial";
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
