<?php
	$idpaciente = $_GET['idpaciente'];
  include_once("../conexion/clsConexion.php");
  $obj=new clsConexion;
  $calculo_edad=$obj->consultar("SELECT idpaciente
     , paciente
     , fec_nacimiento
     , timestampdiff(YEAR, fec_nacimiento, now()) AS anios
     , timestampdiff(MONTH, fec_nacimiento, now()) % 12 AS meses
     , floor(timestampdiff(DAY, fec_nacimiento, now()) % 30.4375) AS dias
      FROM paciente	where idpaciente='$idpaciente'");
	 $info = array();
   foreach((array)$calculo_edad as $row){
    $anio=$row["anios"];
    $mes=$row["meses"];
    $dia=$row["dias"];
  }
	$info['anio'] = $anio;
	$info['mes'] = $mes;
	$info['dia'] = $dia;
	echo json_encode($info);
?>
