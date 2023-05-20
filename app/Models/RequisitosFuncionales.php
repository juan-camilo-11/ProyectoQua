<?php

namespace App\Models;

use App\Models\Criterios;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitosFuncionales extends Model
{
    use HasFactory;
    public function criterio()
    {
        return $this->belongsTo(Criterios::class);
    }
    public function pruebas()
{
    return $this->hasMany(Pruebas::class,'requisito_id');
}

}
