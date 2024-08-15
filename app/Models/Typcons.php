<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typcons extends Model
{
    use HasFactory;
    public $fillable = [
        'user_id',
    'typeconsul_id'
    ];
    protected $hidden = [
        'created_at',
        'user_id',
        'typeconsul_id',
      'updated_at'
  ];
    public function user()
    {
        return $this->belongsTo(Consulting::class);
    }
    public function typeconsult()   
    {
        return $this->belongsTo(Typeconsulting::class);
    }
}
