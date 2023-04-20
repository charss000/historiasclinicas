<?php
include("../seguridad.php");
ob_start();
$usu=$_SESSION["usuario"];
if (isset($_GET['term'])){
	# conectare la base de datos
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$return_arr = array();
/* Si la conexion a la base de datos , ejecuta instruccion SQL. */
	$data=$obj->consultar("SELECT * FROM usuario
		WHERE tipo = 'laboratorio' AND nombres like '%" .($_GET['term']) . "%' LIMIT 0 ,100");
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	foreach($data as $row) {
		// $idpaciente=$row['idpaciente'];
		$row_array['value'] =$row['nombres'];
		$row_array['nombres']=$row['nombres'];
		$row_array['usuario']=$row['usuario'];
		array_push($return_arr,$row_array);
    }
/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);
}
?>
