<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dueno extends Model
{
    use HasFactory;

    
    protected $table = 'duenos';

    protected $fillable = ['nombre', 'apellido'];

  
    public function animales()
    {
        return $this->hasMany(Animal::class, 'dueno_id');
    }
}