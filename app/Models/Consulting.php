<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulting extends Model
{
    use HasFactory;
    public $fillabe=[
        'name',
        'photo',
        'skills',
        'posishion',
        'start_time',
        'end_time',
        'Daysspace',
        'phone',
        'category',
        'price'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    protected $hidden = [
        'created_at',
        'user_id',
      'updated_at'
    ];

}
