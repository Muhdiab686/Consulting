<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    protected $fillable =
    [
        'name',
        'email',
        'password',
        'role',
        'blance'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];
    /**
     * Get the user ad with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function typcons()
    {
        return $this->hasmany(Typcons::class);
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function consulting()
    {
        return $this->hasmany(Consulting::class);
    }
}
