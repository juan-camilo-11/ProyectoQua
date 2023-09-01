<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    use HasFactory;
    protected $table = 'daily'; // Nombre de la tabla en la base de datos
    protected $fillable = ['fecha', 'codigo','estado','prueba_id','proyecto_id']; // Campos que pueden ser asignados masivamente

}
