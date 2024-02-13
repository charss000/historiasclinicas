<?php
include("../seguridad.php");
if (isset($_GET['term'])){
	# conectare la base de datos
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$return_arr = array();
/* Si la conexi�n a la base de datos , ejecuta instrucci�n SQL. */
	$data=$obj->consultar("SELECT * FROM paciente WHERE paciente like '%" .($_GET['term']) . "%' LIMIT 0 ,100");
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/

	foreach($data as $row) {
		$idpaciente=$row['idpaciente'];
		$row_array['value'] =$row['paciente'].'|'.$row['documento_pa'];
		$row_array['idpaciente']=$row['idpaciente'];
		$row_array['paciente']=$row['paciente'];
		$row_array['num_historia']=$row['num_historia'];
		array_push($return_arr,$row_array);
    }
/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);
}
?>
