<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioModel extends Model
{
    protected $table='servicio';
    protected $primaryKey='idservicio';
    public $timestamps = false;
}
