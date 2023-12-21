<?php 
namespace App\Controllers;
use App\Controller;

/**
 * 
 */
class ventaControllers extends Controller
{
	
	function __construct()
	{
		
		$this->renderTemplate("venta");
	}
	public function index($value='')
	{
		if($_SESSION['tipo']=='administrador'){

			$this->loadDAO('venta');
			$p = $this->dao->listaVentas();
			$m = $this->dao->ventasPagos();
			$s = $this->dao->ventasNoPagos();
			$this->templates->addData(['m'=>$m,'s'=>$s,'p'=>$p]);
			
		}
		print $this->templates->render('index');
	}
	public function insertar($value='')
	{
		$this->loadDAO('paciente');
		$this->templates->addData(['paciente'=>$this->dao->getPaciente('idpaciente',$_GET['idpaciente'])[0]->paciente]);
		$this->loadDAO('venta');
		$this->templates->addData(['recibo'=>str_pad($this->dao->lastIdNext()[0]->AUTO_INCREMENT,8,"0",STR_PAD_LEFT),'impuesto'=>$this->dao->getConfiguracion()[0]->imp_num]);
		date_default_timezone_set($this->dao->getConfiguracion()[0]->zona_horaria);
		print $this->templates->render('insertar');
	}

	public function error()
	{
		header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
		print $this->templates->render('404');
	}
}