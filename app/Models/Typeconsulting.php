<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typeconsulting extends Model
{
    use HasFactory;
    public $fillable = [
        'name'
    ];
    protected $hidden = [
          'created_at',
        'updated_at'
    ];
    public function typcons()
    {
        return $this->hasmany(Typcons::class);
    }
}
