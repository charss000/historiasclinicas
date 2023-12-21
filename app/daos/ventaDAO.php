<?php 
namespace App\Daos;
use App\DAO;

use App\Models\VentaModel;
use App\Models\DetalleVentaModel;
use App\Models\ServicioModel;
use App\Models\CitaModel;

use Illuminate\Database\Capsule\Manager as DB;

class ventaDAO extends DAO
{
	
	function __construct()
	{
		$this->loadEloquent();
	}

    public function listaVentas()
    {
    	return VentaModel::select('paciente.paciente', 'venta.idventa', 'venta.num_docu',  'venta.total',  'venta.estado',  'venta.fecha')->join('paciente','venta.idpaciente_v', '=', 'paciente.idpaciente')->get();
    }
    public function listaVentasByDates($a,$b)
    {
        $rs = VentaModel::select('venta.fecha','venta.estado', 'paciente.idpaciente',  'paciente.paciente',  'venta.total', 'venta.num_docu',  'venta.idventa')->join('paciente','venta.idpaciente_v', '=', 'paciente.idpaciente')->whereBetween('venta.fecha',[$a,$b]);

        return $rs->get();
    }
    public function ventasPagos()
    {
    	return VentaModel::select('estado')->selectRaw('sum(total) as total')->where('estado','=','pagado')->get();
    }
    public function ventasNoPagos()
    {
    	return VentaModel::select('estado')->selectRaw('sum(total) as total')->where('estado','=','pendiente')->get();
    }
    public function getDetalleVenta()
    {
        return DetalleVentaModel::select('servicio.descripcion',   'detalleventa.idventa')->join('servicio','detalleventa.idservicio_v','=','servicio.idservicio')->get();
    }
    public function getPrecioServicio($idServicio)
    {
        return ServicioModel::where('idservicio','=',$idServicio)->get();
    }
    public function setCita($arr)
    {
        return CitaModel::insertGetId($arr);
    }
    public function setVenta($arr)
    {
        return VentaModel::insertGetId($arr);
    }
    public function updateVenta($idventa,$arr)
    {
        VentaModel::where('idventa','=',$idventa)->update($arr);
    }
    public function setDetalleVentas($arr)
    {
        return DetalleVentaModel::insertGetId($arr);
    }


    public function lastIdNext()
    {
        return DB::select("SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'cstintaypuncocom_db' AND   TABLE_NAME   = 'venta';");
    }
    public function getConfiguracion()
    {
        return DB::select("SELECT * FROM configuracion");
    }
}