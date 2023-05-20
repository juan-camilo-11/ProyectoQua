<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pruebas extends Model
{
    use HasFactory;
    public function requisito()
    {
        return $this->belongsTo(Pruebas::class);
    }
}
