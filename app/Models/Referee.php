<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referee extends Model
{
    protected $fillable = [
        'referee_name',
        'occupation',
        'name_of_company',
        'contact_number',
        'years_known',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
