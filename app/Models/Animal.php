<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animales';

    protected $fillable = ['nombre', 'tipo', 'peso', 'enfermedad', 'comentarios', 'dueno_id'];

   
    public function dueno()
    {
        return $this->belongsTo(Dueno::class, 'dueno_id');
    }
}