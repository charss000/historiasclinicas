<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioModel extends Model
{
    protected $table='usuario';
    protected $primaryKey='idusu';
    public $timestamps = false;
}
