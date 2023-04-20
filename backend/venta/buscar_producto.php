<?php
include("../seguridad.php");
if (isset($_GET['term'])){
	# conectare la base de datos
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$return_arr = array();
/* Si la conexion a la base de datos , ejecuta instruccion SQL. */
	$data=$obj->consultar("SELECT * from servicio WHERE descripcion like '%" .($_GET['term']) . "%' LIMIT 0 ,100");
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	foreach($data as $row) {
		$idservicio=$row['idservicio'];
		$row_array['value'] =$row['descripcion'].' .precio:'.$row['precio'];
		$row_array['idservicio']=$row['idservicio'];
		$row_array['descripcion']=$row['descripcion'];
		array_push($return_arr,$row_array);
    }
/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);
}
?>
