<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emergency extends Model
{
    protected $fillable = [
        'name',
        'relationship',
        'contact_no',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
