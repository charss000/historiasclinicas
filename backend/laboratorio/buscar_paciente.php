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
	$data=$obj->consultar("SELECT
  paciente.paciente,
  cita.idcita,
  usuario.usuario,
  paciente.idpaciente,
  paciente.num_historia,
  paciente.sexo,
  paciente.fec_nacimiento
FROM cita
  INNER JOIN paciente
    ON cita.idpaciente = paciente.idpaciente
  INNER JOIN usuario
    ON cita.idusuario = usuario.idusu
WHERE usuario.usuario = '$usu' AND paciente.paciente like '%" .($_GET['term']) . "%' LIMIT 0 ,100");
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	foreach($data as $row) {
		$idpaciente=$row['idpaciente'];
		$row_array['value'] =$row['paciente'];
		$row_array['idpaciente']=$row['idpaciente'];
		$row_array['paciente']=$row['paciente'];
		$row_array['sexo']=$row['sexo'];
		$row_array['num_historia']=$row['num_historia'];
		array_push($return_arr,$row_array);
    }
/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);
}
?>
