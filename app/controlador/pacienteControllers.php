<?php 
namespace App\Controllers;
use App\Controller;

/**
 * 
 */
class pacienteControllers extends Controller
{
	
	function __construct()
	{
		
		$this->renderTemplate("paciente");
	}
	public function index($value='')
	{
		if($_SESSION['tipo']=='administrador'){
			$this->loadDAO('usuario');
			$m = $this->dao->nums();
			$this->loadDAO('servicio');
			$s = $this->dao->nums();
			$this->loadDAO('paciente');
			$p = $this->dao->lista();
			$this->templates->addData(['m'=>$m,'s'=>$s,'p'=>$p]);
			
		}
		print $this->templates->render('index');
	}
	public function insertar($value='')
	{
		print $this->templates->render('insertar');
	}
	public function actualizar($value='')
	{
		$this->loadDAO('paciente');
		$cod=$_GET['idpaciente'];
		$data = $this->dao->getPaciente('idpaciente',$cod);
		foreach($data as $row){
            $no= $row['paciente'];
            $tel= $row['telefono'];
            $es= $row['estado_civil'];
            $dir= $row['direccion_pa'];
            $email= $row['email'];
            $apo= $row['apoderado'];
            $sexo= $row['sexo'];
            $nd= $row['documento_pa'];
            $fec_nacimiento= $row['fec_nacimiento'];
		}
		$this->templates->addData(['no'=>$no,'tel'=>$tel,'es'=>$es,'dir'=>$dir,'email'=>$email,'apo'=>$apo,'sexo'=>$sexo,'nd'=>$nd,'fec_nacimiento'=>$fec_nacimiento]);
		print $this->templates->render('actualizar');
	}
	public function verpagos($value='')
	{
		$this->loadDAO('venta');
		
		print $this->templates->render('verpagos');
	}

	public function error()
	{
		header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
		print $this->templates->render('404');
	}
}