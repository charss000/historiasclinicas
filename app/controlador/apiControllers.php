<?php 
namespace App\Controllers;
use App\Controller;

/**
 * 
 */
class apiControllers extends Controller
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
		}
	}

	public function usuario($p='')
	{
		if ($p) {
			if (method_exists($this,'usuario_'.$p[0])) {
				$this->{'usuario_'.$p[0]}($p);
			} else {
				$this->error();
			}
			
		} else {
			$this->error();
		}
		
	}
	public function usuario_addUsuario($p)
	{
		$this->loadDAO('usuario');
		$usuario=$_POST['usuario'];
		$cla=$_POST['cla'];
		$documento=$_POST['documento'];
		$fec=$_POST['fecha'];
		$no=$_POST['na'];
		$dir=$_POST['direccion'];
		$sexo=$_POST['sexo'];
		$te=$_POST['tel'];
		$em=$_POST['mail'];
		$es=$_POST['es'];
		$t=$_POST['tipo'];
		$idespecialidad=$_POST['idesp'];

		if ($t=='administrador') {
			$idesp='1';
		} else {
		    $idesp=$idespecialidad;
		}
		$clavemd5 = password_hash($cla, PASSWORD_DEFAULT, [15]);
		$idu = $this->dao->setUsuario(['idespecialidad'=>$idesp, 'nombres'=>$no, 'sexo'=>$sexo, 'fecha_nacimiento'=>$fec, 'documento'=>$documento, 'direccion'=>$dir, 'email'=>$em, 'telefono'=>$te, 'tipo'=>$t, 'usuario'=>$usuario, 'clave'=>$clavemd5, 'estado'=>$es]);
		for($i=1; $i<=7; $i++){
			$this->dao->setDiaUsuario(['idd'=>$i,'idu'=>$idu]);
		}
		print json_encode(['msg'=>'ok']);
	}
	public function usuario_updateUsuario($value='')
	{
		$this->loadDAO('usuario');
		$cod=$_POST['cod'];
		$usuario=$_POST['usuario'];
		$cla=$_POST['cla'];
		$documento=$_POST['documento'];
		$fec=$_POST['fecha'];
		$no=$_POST['na'];
		$dir=$_POST['direccion'];
		$sexo=$_POST['sexo'];
		$te=$_POST['tel'];
		$em=$_POST['mail'];
		$es=$_POST['es'];
		$t=$_POST['tipo'];
		$idesp=$_POST['idesp'];
		$clavee = $this->dao->password($usuario)[0];
		if ($clavee!=$cla){
			$clavemd5 =password_hash($cla, PASSWORD_DEFAULT, [15]);
		}else{
			$clavemd5=$cla;
		}
		$this->dao->updateUsuario(['idespecialidad'=>$idesp,'nombres'=>$no,'sexo'=>$sexo,'fecha_nacimiento'=>$fec,'documento'=>$documento,
    'direccion'=>$dir,'email'=>$em,'telefono'=>$te,'tipo'=>$t,'usuario'=>$usuario,'clave'=>$clavemd5,'estado'=>$es],'idusu',$cod);
		print json_encode(['msg'=>'ok']);
	}


	public function cita($c='')
	{
		if ($c) {
			if (method_exists($this,$c[0].'Cita')) {
				$this->{$c[0].'Cita'}($c);
			} else {
				$this->error();
			}
			
		} else {
			$this->error();
		}
	}
	public function addCita($c)
	{
		$this->loadDAO('usuario');
		$row = $this->dao->getConfiguracion()[0];
		date_default_timezone_set($row->zona_horaria);
		$hoy = date("Y-m-d H:i:s");
		$fecha = date("Y-m-d");
		$idmedico=$_POST['idusu'];
	    $idpaciente=$_POST['idpaciente'];
	    $fecha=$_POST['fecha'];
	    $hora=$_POST['hora'];
	    $idservicio=$_POST['idservicio'];
	    $this->loadDAO('venta');
	    $precio = $this->dao->getPrecioServicio($idservicio)[0]->precio;
	    $idventa = $this->dao->setVenta(['idpaciente_v'=>$idpaciente, 'fecha'=>$fecha, 'subtotal'=>$precio, 'igv'=>0, 'total'=>$precio, 'tipo_docu'=>'RECIBO', 'num_docu'=>'', 'serie'=>'001','observacion'=>'','usuario'=>$_SESSION["usuario"],'estado'=>'pendiente']);
	    $this->dao->updateVenta($idventa,['num_docu'=>str_pad($idventa,8,"0",STR_PAD_LEFT)]);
	    $this->dao->setCita(['idpaciente'=>$idpaciente, 'idusuario'=>$idmedico, 'fecha'=>$fecha,'hora'=>$hora, 'cupo'=>1, 'fec_ho_impresion'=>$hoy, 'estado'=>'enespera', 'idventa'=>$idventa]);
	    $this->dao->setDetalleVentas(['idventa'=>$idventa, 'idservicio_v'=>$idservicio, 'cantidad'=>1, 'precio'=>$precio, 'importe'=>$precio]);


		print json_encode(['ok'=>1]);
	}

	public function paciente($p='')
	{
		if ($p) {
			if (method_exists($this,$p[0].'Paciente')) {
				$this->{$p[0].'Paciente'}($p);
			} else {
				$this->error();
			}
			
		} else {
			$this->error();
		}
	}
	private function addPaciente($p)
	{
		$no=$_POST['no'];
		$apo=$_POST['apo'];
		$sexo=$_POST['sexo'];
		$mail=$_POST['mail'];
		$tel=$_POST['tel'];
		$dir=$_POST['dir'];
		$nd=$_POST['num_docu'];
		$fecha=$_POST['fecha'];
		$ec=$_POST['ec'];
		$this->loadDAO('paciente');
		$idpaciente = $this->dao->setPaciente(['paciente'=>$no, 'sexo'=>$sexo, 'fec_nacimiento'=>$fecha, 'documento_pa'=>$nd, 'estado_civil'=>$ec, 'direccion_pa'=>$dir, 'telefono'=>$tel, 'email'=>$mail, 'apoderado'=>$apo]);
		$this->dao->updatePaciente($idpaciente,['num_historia'=>str_pad( $idpaciente,6,"0",STR_PAD_LEFT)]);
		print json_encode(['ok'=>0]);
	}
	private function updatePaciente($value='')
	{
		$cod=$_POST['cod'];
		$no=$_POST['no'];
		$apo=$_POST['apo'];
		$sexo=$_POST['sexo'];
		$mail=$_POST['mail'];
		$tel=$_POST['tel'];
		$dir=$_POST['dir'];
		$nd=$_POST['num_docu'];
		$fecha=$_POST['fecha'];
		$ec=$_POST['ec'];
		$this->loadDAO('paciente');
		$this->dao->updatePaciente($cod,['paciente'=>$no, 'sexo'=>$sexo, 'fec_nacimiento'=>$fecha, 'documento_pa'=>$nd, 'estado_civil'=>$ec, 'direccion_pa'=>$dir, 'telefono'=>$tel, 'email'=>$mail, 'apoderado'=>$apo]);
		print json_encode(['ok'=>0]);
	}

	public function venta($v='')
	{
		if ($v) {
			if (method_exists($this,$v[0])) {
				$this->{$v[0]}($v);
			} else {
				$this->error();
			}
			
		} else {
			$this->error();
		}
	}
	private function consultacarrito($v)
	{
		print $this->templates->render('consultacarrito');
	}

	public function error()
	{
		print json_encode(['msg'=>'error']);
	}
}