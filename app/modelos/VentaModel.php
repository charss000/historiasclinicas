<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaModel extends Model
{
    protected $table='venta';
    protected $primaryKey='idventa';
    public $timestamps = false;
}
