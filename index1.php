<?php 


	# Incluiremos del autoload
	require_once 'vendor/autoload.php';
	
	#incluimos la configuración
	require_once 'config/config.php';
	//session_start();
	
	#nuestra primera entrada
	$app = new App\App();
