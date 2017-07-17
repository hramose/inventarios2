<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Denuncias extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['descripcion','lugar','lat','lng','motivo_den_id'];
    public function motivos() {
        return $this->hasMany('Motivos_Denuncias', 'id', 'motivo_den_id');
    }

}
