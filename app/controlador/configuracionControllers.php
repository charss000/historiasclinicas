<?php 
namespace App\Controllers;
use App\Controller;

/**
 * 
 */
class configuracionControllers extends Controller
{
	
	function __construct()
	{
		
		$this->renderTemplate("configuracion");
	}
	public function index($value='')
	{
		if($_SESSION['tipo']=='administrador'){
			$this->loadDAO('usuario');
			$row = $this->dao->getConfiguracion()[0];
			error_log(json_encode($row));
			$this->templates->addData(['logo'=>$row->logo,'razon'=>$row->razon_social,'mon_simbolo'=>$row->mon_simbolo,'moneda'=>$row->moneda,'in'=>$row->imp_num,'il'=>$row->imp_letra,'zona'=>$row->zona_horaria,'dir'=>$row->direccion,'ruc'=>$row->ruc,'tel'=>$row->telefono,'res'=>$row->responsable]);
			print $this->templates->render('index');
			
		}else{
			$this->error();
		}
		
	}


	public function error()
	{
		header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
		print $this->templates->render('404');
	}
}