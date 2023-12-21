<?php 
namespace App\Controllers;
use App\Controller;

/**
 * 
 */
class usuarioControllers extends Controller
{
	
	function __construct()
	{
		
		$this->renderTemplate("usuario");
		
	}
	public function index($value='')
	{
			$this->loadDAO('usuario');
			$datos = $this->dao->getUsuariosEspecialidad();
			$this->templates->addData(['datosUsuarios'=>$datos]);
			print $this->templates->render('index');
	}
	public function insertar($value='')
	{
		$this->loadDAO('especialidad');
		$this->templates->addData(['result'=>$this->dao->getEspecialidades()]);
		print $this->templates->render('insertar');
	}
	public function actualizar($value='')
	{
		$this->loadDAO('usuario');
		$cod = $_GET['idusu'];
		$data = $this->dao->getUsuario('idusu',$cod);

		foreach($data as $row){
			$this->templates->addData(['cod'=>$cod,'idesp'=> $row['idespecialidad'],'no'=> $row['nombres'],'se'=> $row['sexo'],'fecha'=> $row['fecha_nacimiento'],'doc'=> $row['documento'],'dir'=> $row['direccion'],'email'=> $row['email'],'tel'=> $row['telefono'],'tipo'=> $row['tipo'],'usuario'=> $row['usuario'],'estado'=> $row['estado'],'cla'=> $row['clave']]);
		          	
		}
		$this->loadDAO('especialidad');
		$this->templates->addData(['result'=>$this->dao->getEspecialidadesNotAdmin()]);
		print $this->templates->render('actualizar');
	}
	public function horario($h='')
	{

		$this->loadDAO('usuario');
		if(count($_POST)){
			
			for ($i=1; $i < 8; $i++) { 
				$arr =[];
				$arr['estado']=isset($_POST['estado'][$i]) ? 1 : 0;
				if ($_POST['hora_inicio'][$i]) {
					$arr['hora_inicio']=$_POST['hora_inicio'][$i];
				}
				if ($_POST['hora_fin'][$i]) {
					$arr['hora_fin']=$_POST['hora_fin'][$i];
				}
				if ($_POST['duracion'][$i]) {
					$arr['duracion']=$_POST['duracion'][$i];
				}


					$this->dao->updateDiaUsuario($_GET['idusu'],$i,$arr);
				}
			$this->templates->addData(['ok'=>'ok']);
		}
		$row = $this->dao->getConfiguracion()[0];
		date_default_timezone_set($row->zona_horaria);
		$hoy = date("Y-m-d H:i:s");
		$dias = $this->dao->getDiasUsuario($_GET['idusu']);
		foreach ($dias as $value) {
			${'hi'.$value->valor}=$value->hora_inicio;
			${'hf'.$value->valor}=$value->hora_fin;
			${'d'.$value->valor}=$value->duracion;
			${'estado'.$value->valor}=$value->estado;
			${$value->variable} = $value->valor;
		}
		$this->templates->addData(['no_usu'=>$this->dao->getUsuario('idusu',$_GET['idusu'])[0]->nombres,'hi1'=>$hi1,'hi2'=>$hi2,'hi3'=>$hi3,'hi4'=>$hi4,'hi5'=>$hi5,'hi6'=>$hi6,'hi7'=>$hi7,'hf1'=>$hf1,'hf2'=>$hf2,'hf3'=>$hf3,'hf4'=>$hf4,'hf5'=>$hf5,'hf6'=>$hf6,'hf7'=>$hf7,'d1'=>$d1,'d2'=>$d2,'d3'=>$d3,'d4'=>$d4,'d5'=>$d5,'d6'=>$d6,'d7'=>$d7,'estado1'=>$estado1,'estado2'=>$estado2,'estado3'=>$estado3,'estado4'=>$estado4,'estado5'=>$estado5,'estado6'=>$estado6,'estado7'=>$estado7,'idusu'=>$_GET['idusu'],'idd1'=>$idd1,'idd2'=>$idd2,'idd3'=>$idd3,'idd4'=>$idd4,'idd5'=>$idd5,'idd6'=>$idd6,'idd7'=>$idd7]);

		print $this->templates->render('horario');
	}


	public function error()
	{
		header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
		print $this->templates->render('404');
	}
}