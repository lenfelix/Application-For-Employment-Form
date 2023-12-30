<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Declaration extends Model
{
    protected $fillable = [
        'business_involvement',
        'conviction',
        'medical_condition',
        'signature',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
