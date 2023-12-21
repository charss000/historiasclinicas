<?php 
namespace App\Controllers;
use App\Controller;

/**
 * 
 */
class cuentaControllers extends Controller
{
	
	function __construct()
	{
		$this->renderTemplate("cuenta");
	}

	public function login($value='')
	{
		if(count($_POST)){
			$this->getLogin();
		}else{
			print $this->templates->render('login');
		}
	}
	public function index()
	{
		print $this->templates->render('index');
	}

	private function getLogin()
	{
		$this->loadDAO('usuario');
		if ($this->dao->usuarioExiste(strtolower($_POST['usuario']))) {
			if (password_verify($_POST['clave'],$this->dao->password(strtolower($_POST['usuario']))[0])) {
				$userDatos = $this->dao->getUsuario('usuario',$_POST['usuario']);
				$_SESSION["usuario"]=$userDatos[0]->usuario;
				$_SESSION["nombres"]=$userDatos[0]->nombres;
				$_SESSION['idusu']=$userDatos[0]->idusu;
				$_SESSION['tipo']=$userDatos[0]->tipo;
				//$_SESSION['permisos']=$this->dao->permisos($userDatos['id']);
				//$this->llenarDatos();
				//$this->loadConfig();
				$_SESSION['login']=true;
				header('Location: /');
			} else {
				print "contraseña incorrecta";
			}
			
		} else {
			print "Usuario No existe";
		}
	}

	private function llenarDatos()
	{

		$genero = $this->dao->genero($_SESSION['uid']);
		$_SESSION['datos']=$this->dao->data($_SESSION['uid'])[0];
		$_SESSION['img_perfil']=$genero[0]==2?'icons8-female-profile-48.png':'icons8-male-user-48.png';
		$_SESSION['sid']=$this->dao->idPersonal($_SESSION['uid'])[0];
	}
	private function loadConfig()
	{
		$this->loadDAO('sistema');
		$config = $this->dao->config();

		$_SESSION['config']=[];
		foreach ($config as $c) {
			$_SESSION['config'][$c['variable']]=$c['valor'];
		}
	}

	public function salir()
	{
		session_destroy();
		header('Location: /');
	}
}