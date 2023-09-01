<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backlog extends Model
{
    use HasFactory;
    protected $table = 'backlog'; // Nombre de la tabla en la base de datos
    protected $fillable = ['dia', 'requisito_id','proyecto_id']; // Campos que pueden ser asignados masivamente

}
