<?php ob_start();
include("../seguridad.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
	if(!empty($_GET['idhistoria'])){
	 $idhistoria= trim($obj->real_escape_string(strip_tags($_GET['idhistoria'],ENT_QUOTES)));
	}
$resultc=$obj->consultar("SELECT * FROM configuracion");
  		foreach((array)$resultc as $row){
  			$logo=$row["logo"];
  			$ruc=$row["ruc"];
  			$tel=$row["telefono"];
  			$dir=$row["direccion"];
  			$rz=$row["razon_social"];
  			$mon=$row["moneda"];
  			$imp_num=$row["imp_num"];
  			$imp_letra=$row["imp_letra"];
  			$zona=$row["zona_horaria"];
  	}
date_default_timezone_set("$zona");
$data=$obj->consultar("SELECT historia.*
     , paciente.num_historia
     , paciente.paciente
     , usuario.nombres
     , paciente.sexo
     , paciente.fec_nacimiento
     , especialidad.especialidad
FROM
  paciente
INNER JOIN historia
ON historia.idpaciente = paciente.idpaciente
INNER JOIN usuario
ON historia.idusuario = usuario.idusu
INNER JOIN especialidad
ON usuario.idespecialidad = especialidad.idespecial
 WHERE idhistoria='".$obj->real_escape_string($idhistoria)."'");
								foreach((array)$data as $row){
                $idusuario= $row['idusuario'];
								$nombres= $row['nombres'];
								$idpaciente= $row['idpaciente'];
							  $pa= $row['paciente'];
								$fec= $row['fecha'];
								$edad= $row['edad'];
								$sexo= $row['sexo'];
								$naci= $row['fec_nacimiento'];
								$es= $row['especialidad'];
								$motivo= $row['motivo'];
								$ef= $row['examen_fisico'];
								$diag= $row['diagnostico'];
								$trata= $row['tratamiento'];
								$his=$row['num_historia'];
		            }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>historia</title>
<style type="text/css">
.centrar {
	text-align: center;
	font-weight: bold;
}
.negrita {
	font-weight: bold;
}
</style>
</head>

<body>
<table width="200" border="0" align="center" cellspacing="0">
  <tr>
    <th height="77" bgcolor="#FFFFFF" scope="col"><h1> <img src="../configuracion/foto/<?php echo $logo?>" alt="" width="200" height="60" class="centrar" /> </h1></th>
  </tr>
</table>
<table width="550" border="0" align="center">
  <tr>
    <td class="centrar">HISTORIA CLINICA</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="550" border="0" align="center" cellspacing="0">
  <tr>
    <td width="56" style="text-align: right; font-weight: bold;">FICHA</td>
    <td width="490" style="text-align: left; font-weight: bold;">&nbsp;</td>
  </tr>
</table>
<table width="550" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td width="51" class="negrita">Fecha:</td>
    <td width="210"><?php echo $fec;?></td>
    <td width="145" class="negrita">Numero de Historia:</td>
    <td width="116"><?php echo $his;?></td>
  </tr>
</table>
<table width="547" border="1" align="center" cellspacing="0">
  <tr>
    <td colspan="2">APELLIDOS Y NOMBRES: <?php echo $pa;?></td>
  </tr>
  <tr>
    <td>Fecha de Nacimiento: <?php echo $naci;?></td>
    <td>Sexo: <?php echo $sexo;?></td>
  </tr>
</table>
<table width="549" border="0" align="center" cellspacing="1">
  <tr>
    <td width="336">Edad:</td>
    <td width="206"><table width="207" border="1" cellspacing="0">
      <tr>
        <td width="60">Años</td>
        <td width="74">Meses</td>
        <td width="59">Dias</td>
        </tr>
      <tr>
        <td colspan="3" align="center"><?php echo $edad;?></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="547" border="1" align="center" cellspacing="0">
  <tr>
    <td>Servicio: <?php echo $es;?></td>
  </tr>
  <tr>
    <td>Medico:<?php echo $nombres;?></td>
  </tr>
</table>
<table width="550" border="0" align="center">
  <tr>
    <td width="102" class="negrita"><u>
      Motivo:</u></td>
    <td width="432"><?php
		 echo $textToStor99 = nl2br(htmlentities($motivo, ENT_QUOTES, 'UTF-8'));
		?></td>
  </tr>
  <tr>
    <td class="negrita">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="negrita"><u>Diagnostico:</u></td>
    <td>
			<?php
      echo $textToStore = nl2br(htmlentities($diag, ENT_QUOTES, 'UTF-8'));
			 ?>
		</td>
  </tr>
  <tr>
    <td class="negrita">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="negrita"><u>Examen Fisico:</u></td>
    <td><?php
		  echo $textToStore2 = nl2br(htmlentities($ef, ENT_QUOTES, 'UTF-8'));
		?></td>
  </tr>
  <tr>
    <td class="negrita">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="negrita"><u>Tratamiento:</u></td>
    <td><?php
		echo $textToSt097 = nl2br(htmlentities($trata, ENT_QUOTES, 'UTF-8'));
		?></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</body>
</html>

<?php
require_once("dompdf-0.8.3/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf=$dompdf->output();
$filename = 'historia.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename,array("Attachment"=>0));
?>
