<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PacienteModel extends Model
{
    protected $table='paciente';
    protected $primaryKey='idpaciente';
    public $timestamps = false;
}
