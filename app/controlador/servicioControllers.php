<?php 
namespace App\Controllers;
use App\Controller;

/**
 * 
 */
class servicioControllers extends Controller
{
	
	function __construct()
	{
		
		$this->renderTemplate("servicio");
	}
	public function index($value='')
	{
		if($_SESSION['tipo']=='administrador'){

			$this->loadDAO('servicio');
			$p = $this->dao->lista();
			//$m = $this->dao->ventasPagos();
			//$s = $this->dao->ventasNoPagos();
			$this->templates->addData(['p'=>$p]);
			
		}
		print $this->templates->render('index');
	}


	public function error()
	{
		header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
		print $this->templates->render('404');
	}
}