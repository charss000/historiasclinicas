<?php 
namespace App\Controllers;
use App\Controller;

/**
 * 
 */
class homeControllers extends Controller
{
	
	function __construct()
	{
		
		$this->renderTemplate("home");
	}
	public function index($value='')
	{
		if($_SESSION['tipo']=='administrador'){
			$this->loadDAO('usuario');
			$m = $this->dao->nums();
			$this->loadDAO('servicio');
			$s = $this->dao->nums();
			$this->loadDAO('paciente');
			$p = $this->dao->nums();
			$this->templates->addData(['m'=>$m,'s'=>$s,'p'=>$p]);
			print $this->templates->render('index');
		}else if ($_SESSION['tipo']=='laboratorio') {
			print $this->templates->render('index_laboratorio');
		}else{
			print $this->templates->render('index_usuario');
		}
	}


	public function error()
	{
		header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
		print $this->templates->render('404');
	}

	public function salir()
	{
		session_destroy();
		header('Location: /');
	}
}