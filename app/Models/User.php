<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'position',
        'mode_of_application',
        'name',
        'gender',
        'address',
        'email',
        'nric_no',
        'date_of_birth',
        'citizenship',
        'race',
        'phone',
        'marital_status',
        'driving_license',
        'current_salary',
        'earliest_commencement_date',
        'expected_salary',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }

    public function employments()
    {
        return $this->hasMany(Employment::class);
    }

    public function emergencies()
    {
        return $this->hasMany(Emergency::class);
    }

    public function referees()
    {
        return $this->hasMany(Referee::class);
    }

    public function questionnaire()
    {
        return $this->hasOne(Questionnaire::class);
    }

    public function declaration()
    {
        return $this->hasOne(Declaration::class);
    }
}
