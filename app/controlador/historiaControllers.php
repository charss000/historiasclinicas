<?php 
namespace App\Controllers;
use App\Controller;

/**
 * 
 */
class historiaControllers extends Controller
{
	
	function __construct()
	{
		
		$this->renderTemplate("historia");
	}
	public function index($value='')
	{
		if($_SESSION['tipo']=='administrador'){
			$this->loadDAO('usuario');
			$m = $this->dao->nums();
			$this->loadDAO('servicio');
			$s = $this->dao->nums();
			$this->loadDAO('paciente');
			$p = $this->dao->historialFull();
			$this->templates->addData(['m'=>$m,'s'=>$s,'p'=>$p,'st'=>'Historias medicas de todos los pacientes atendidos']);
			
		}
		print $this->templates->render('index');
	}


	public function error()
	{
		header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
		print $this->templates->render('404');
	}
}