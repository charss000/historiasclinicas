<?php ob_start();
include("../seguridad.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
	if(!empty($_GET['idlab'])){
	 $idlab= trim($obj->real_escape_string(strip_tags($_GET['idlab'],ENT_QUOTES)));
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
$data=$obj->consultar("SELECT
  paciente.num_historia,
  paciente.paciente,
  usuario.nombres,
  paciente.sexo,
  paciente.fec_nacimiento,
  laboratorio.responsable,
  laboratorio.f_muestra,
  laboratorio.f_entrega,
  laboratorio.fecha,
  laboratorio.examen,
  laboratorio.edad,
  laboratorio.idlab,
  usuario.idusu
FROM laboratorio
  INNER JOIN paciente
    ON laboratorio.idpaciente = paciente.idpaciente
  INNER JOIN usuario
    ON laboratorio.idusuario = usuario.idusu
 WHERE laboratorio.idlab='".$obj->real_escape_string($idlab)."'");
								foreach((array)$data as $row){
								$resp= $row['responsable'];
                $idusuario= $row['idusu'];
								$nombres_usu= $row['nombres'];
							  $pa= $row['paciente'];
								$fec= $row['fecha'];
								$sexo= $row['sexo'];
								$naci= $row['fec_nacimiento'];
								$examen= $row['examen'];
								$fm= $row['f_muestra'];
								$fe= $row['f_entrega'];
								$num=$row['num_historia'];
								$edad=$row['edad'];
		            }
								//obtener responsable
								$resultre=$obj->consultar("SELECT usuario,nombres FROM usuario where usuario='$resp'");
											foreach((array)$resultre as $row){
												$usu_res=$row["nombres"];
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
    <td class="centrar">RESULTADO DE LABORATORIO</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="550" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td width="51" class="negrita">Fecha:</td>
    <td width="210"><?php echo $fec;?></td>
    <td width="145" class="negrita">Numero de Historia:</td>
    <td width="116"><?php echo $num;?></td>
  </tr>
</table>
<table width="547" border="1" align="center" cellspacing="0">
  <tr>
    <td colspan="2">APELLIDOS Y NOMBRES: <?php echo $pa;?></td>
  </tr>
  <tr>
    <td width="336">Fecha de Nacimiento: <?php echo $naci;?></td>
    <td width="201">Sexo: <?php echo $sexo;?></td>
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
    <td colspan="2">Medico  :  <?php echo $nombres_usu;?></td>
  </tr>
  <tr>
    <td colspan="2">Responsable : <?php echo $usu_res;?></td>
  </tr>
  <tr>
    <td width="333">Fec.Muestra : <?php echo $fm;?></td>
    <td width="204">Fec.Entrega :  <?php echo $fe;?></td>
  </tr>
  <tr>
    <td colspan="2">EXAMÉN :<strong> <?php echo $examen;?></strong></td>
  </tr>
</table>
<table width="547" border="0" align="center">

		  <tr>
				<td>ANÁLISIS</td>
		    <td>RESULTADOS</td>
		    <td>REFERENCIA</td>
		</tr>
<?php
 $r_examen=$obj->consultar("SELECT * FROM examen WHERE idlabo='$idlab'");
 foreach((array)$r_examen as $row){
	?>
	<tr>
	<td><?php echo $row['analisis']; ?></td>
	<td><?php echo $row['resultado']; ?></td>
	<td><?php echo $row['referencia']; ?></td>  </tr>
<?php
};
?>

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
//require_once("dompdf-0.8.3/autoload.inc.php");
require_once("../../vendor/autoload.php");

use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf=$dompdf->output();
$filename = 'historia.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename,array("Attachment"=>0));
?>
