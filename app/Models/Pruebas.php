<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pruebas extends Model
{
    use HasFactory;
    public function requisito()
    {
        return $this->belongsTo(Pruebas::class);
    }
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
    public function evaluacion()
    {
        return $this->hasOne(Evaluaciones::class, 'prueba_id');
    }
}
