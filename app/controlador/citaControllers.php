<?php 
namespace App\Controllers;
use App\Controller;

/**
 * 
 */
class citaControllers extends Controller
{
	
	function __construct()
	{
		
		$this->renderTemplate("cita");
	}
	public function index($value='')
	{
		if($_SESSION['tipo']=='administrador'){

			$this->loadDAO('usuario');
			$p = $this->dao->getUsuariosEspecialidad();
			//$m = $this->dao->ventasPagos();
			//$s = $this->dao->ventasNoPagos();
			$this->templates->addData(['p'=>$p]);
			
		}
		print $this->templates->render('index');
	}
	public function cita($value='')
	{
		$this->loadDAO('usuario');
		$row = $this->dao->getConfiguracion()[0];
		date_default_timezone_set($row->zona_horaria);

		$p = $this->dao->getUsuarioEspecialidad($_GET['idusu']);
		$this->templates->addData(['result'=>$this->dao->getCitaPacienteUsuario($_GET['idusu']),'no'=>$p[0]->nombres,'es'=>$p[0]->especialidad,'result_u'=>$this->dao->getUsuarioServicio($_GET['idusu']),'idusu'=>$_GET['idusu'],'hoy' => date("Y-m-d H:i:s"),'hoy_v' => date("Y-m-d"),'anio'=>date("Y")]);
		print $this->templates->render('cita');
	}
	public function verhoras($value='')
	{
		$this->loadDAO('usuario');
		$idd=$_POST['idd'];
		$idu=$_POST['idu'];
		$result_hora=$this->dao->getDiaUsuario($idu,$idd);
		foreach($result_hora as $row){
			 $estado= $row['estado'];
			 $hi= strtotime($row['hora_inicio']);
			 $hf= strtotime($row['hora_fin']);
			 $d= $row['duracion']*60;
		}
		if ($estado=='1') {
		  for($i=$hi; $i<=$hf; $i+=$d) {
		    echo  "<option>".date("H:i",$i)."</option>";
		  }
		} else {
		  echo "";
		}
	}

	public function buscarPaciente($value='')
	{
		$this->loadDAO('paciente');
		$return_arr = [];
		$data = $this->dao->search($_GET['term']);
		foreach($data as $row) {
			$idpaciente=$row['idpaciente'];
			$row_array['value'] =$row['paciente'].'|'.$row['documento_pa'];
			$row_array['idpaciente']=$row['idpaciente'];
			$row_array['paciente']=$row['paciente'];
			$row_array['num_historia']=$row['num_historia'];
			array_push($return_arr,$row_array);
	    }
	    print json_encode($return_arr);
	}

	public function error()
	{
		header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
		print $this->templates->render('404');
	}
}