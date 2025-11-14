<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'title',
        'company',
        'location',
        'salary',
        'logo'
    ];

    function applications() {
        return $this->hasMany(Application::class);
    }
}
