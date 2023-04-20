<?php
include("../seguridad.php");
$usuario=$_SESSION["usuario"];
if (isset($_GET['term'])){
	# conectare la base de datos
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$result=$obj->consultar("SELECT tipo,nombres,usuario,idusu from usuario WHERE usuario='$usuario'");
  foreach((array)$result as $row){
    $idusuario=$row["idusu"];
  }
$return_arr = array();
/* Si la conexi�n a la base de datos , ejecuta instrucci�n SQL. */
	$data=$obj->consultar("SELECT paciente.paciente
     , cita.idpaciente
     , cita.idusuario
FROM
  cita
INNER JOIN paciente
ON cita.idpaciente = paciente.idpaciente
WHERE  cita.idusuario='$idusuario' and paciente.paciente like '%" .($_GET['term']) . "%' LIMIT 0 ,100");
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	foreach($data as $row) {
		$idpaciente=$row['idpaciente'];
		$row_array['value'] =$row['paciente'];
		$row_array['idpaciente']=$row['idpaciente'];
		$row_array['paciente']=$row['paciente'];
		array_push($return_arr,$row_array);
    }
/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);
}
?>
