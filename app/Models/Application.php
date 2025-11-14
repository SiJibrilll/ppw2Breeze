<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'vacancy_id',
        'cv',
        'status'
    ];

    function user() {
        return $this->belongsTo(User::class);
    }

    function vacancy() {
        return $this->belongsTo(Vacancy::class);
    }
}
