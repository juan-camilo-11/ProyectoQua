<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluaciones extends Model
{
    use HasFactory;
    public function prueba()
    {
        return $this->belongsTo(Pruebas::class,'prueba_id');
    }
}
