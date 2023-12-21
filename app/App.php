<?php 
namespace App;
use App\Controllers\cuentaControllers;

class App
{
	
	function __construct()
	{
		# Capturamos la url de nuestra aplicación
		
		
		$url = isset($_GET['url']) ? $_GET['url'] : '/';

		$url = rtrim($url, '/');

		$url = explode('/', $url);
		session_start();
		
		if (isset($_SESSION['login'])) {
			if (empty($url[0])) {
				$controller = new \App\Controllers\homeControllers();
            	$controller->index();
			} else {
				$file_Controller = 'app/controlador/' . $url[0] . 'Controllers.php';
				if (file_exists($file_Controller)) {
					$controlador = "\\App\\Controllers\\" . $url[0] . "Controllers";
            		$controller = new $controlador();
					$nelementos = sizeof($url);
					if ($nelementos >= 2) {
						if (method_exists($controller, $url[1])) {
							if ($nelementos >= 3) {
								$param = [];
								for ($i = 2; $i < $nelementos; $i++) {
									array_push($param, $url[$i]);
								}
								$controller->{$url[1]}($param);
							}else{
								$controller->{$url[1]}();
							}
						}else{

							//$controller1 = new \App\Controllers\homeControllers();
							$controller->error();
						}
					}else{
						$controller->index();
					}
				}else{
					$controller = new \App\Controllers\homeControllers();
					$controller->error();
				}
			}
			
		} else {
			$controller = new cuentaControllers();
            $controller->login();
		}
		
	}
}

