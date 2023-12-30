<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $fillable = [
        'period',
        'last_attended_school',
        'language_stream',
        'highest_standard',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
