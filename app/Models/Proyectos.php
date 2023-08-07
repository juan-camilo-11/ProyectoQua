<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Criterios;
use App\Models\Pruebas;

class Proyectos extends Model
{
    use HasFactory;

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'proyectos_tienen_usuarios', 'proyecto_id', 'usuario_id')->withPivot('cargo_id');
    }

    public function criterios()
    {
        return $this->hasMany(Criterios::class, 'proyecto_id');
    }
    public function pruebas()
    {
        return $this->hasMany(Pruebas::class);
    }
}
