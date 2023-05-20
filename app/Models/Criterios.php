<?php

namespace App\Models;

use App\Models\RequisitosFuncionales;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Criterios extends Model
{
    use HasFactory;
    public function requisitosFuncionales()
{
    return $this->hasMany(RequisitosFuncionales::class, 'criterio_id');
}

}
