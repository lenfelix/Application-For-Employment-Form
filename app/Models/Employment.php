<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    protected $fillable = [
        'period',
        'name_of_employer',
        'position',
        'salary',
        'reason_for_leaving',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
