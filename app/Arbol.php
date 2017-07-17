<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arbol extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['nombre_comun', 'nombre_cientifico', 'patrimonial', 'descripcion', 'historia', 'lat', 'lng'];
}
