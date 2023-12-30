<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $fillable = [
        'achievement',
        'strength',
        'weakness',
        'employer_describe',
        'characteristic_rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
