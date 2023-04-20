<?php ob_start();
include("../seguridad.php");
$usu=$_SESSION["usuario"];
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$totalv = 0;
if(strlen($_GET['desde'])>0 and strlen($_GET['hasta'])>0){
$desde = trim($obj->real_escape_string(htmlentities(strip_tags($_GET['desde'],ENT_QUOTES))));
$hasta =trim($obj->real_escape_string(htmlentities(strip_tags($_GET['hasta'],ENT_QUOTES))));

	$verDesde = date('d/m/Y', strtotime($desde));
	$verHasta = date('d/m/Y', strtotime($hasta));
}else{
	$desde = '1111-01-01';
	$hasta = '9999-12-30';

	$verDesde = '__/__/____';
	$verHasta = '__/__/____';
}

$result=$obj->consultar("SELECT
  venta.fecha,
	venta.estado,
  paciente.idpaciente,
  paciente.paciente,
  venta.total,
  venta.num_docu,
  venta.idventa
FROM venta
  INNER JOIN paciente
    ON venta.idpaciente_v = paciente.idpaciente
WHERE venta.fecha BETWEEN '$desde' AND '$hasta'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>listado</title>

<style type="text/css">
ne {
	font-weight: bold;
}
ne {
	font-weight: bold;
}
ta {
	font-size: 16px;
}
#n {
	text-align: center;
	font-weight: bold;
	font-size: 24px;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #000;
}
.g {
	font-family: Georgia, "Times New Roman", Times, serif;
}
#l {
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}
</style>
</head>

<body class="n">
<table width="280" height="65" border="1" align="center" cellspacing="0">
  <tr>
    <td width="241" bgcolor="#0000000" id="n">LISTADO DE PAGOS</td>
  </tr>
    <tr>
          <td  bgcolor="#0000000" align="center"><?php echo 'Desde:'.$verDesde."   ".'hasta:'.$verHasta ?></td>
        </tr>
</table>
<p>&nbsp;</p>
<table width="360" border="1" align="center" cellspacing="0">
  <tr id="l">
     <th width="50" bgcolor="#0000000" scope="col">N. Recibo</th>
     <th width="60" bgcolor="#0000000" scope="col">Fecha</th>
     <th width="100" bgcolor="#0000000" scope="col">Paciente</th>
     <th width="100" bgcolor="#0000000" scope="col">Concepto(s):</th>
     <th width="50" bgcolor="#0000000" scope="col">Total</th>
		 <th width="50" bgcolor="#0000000" scope="col">Estado</th>
   </tr>
   <?php foreach((array) $result as $row){
     	$totalv = $totalv + $row['total'];
     ?>
		 <tr>
	 	<td><?php
	 	$idventa=$row['idventa'];
	 	echo $row['num_docu'];
	 	?></td>
	 	<td><?php echo $row['fecha']; ?></td>
		<td><?php echo $row['paciente']; ?></td>
	 	<td><?php
	 	$result_d=$obj->consultar("SELECT
	 		servicio.descripcion,
	 		detalleventa.idventa
	 	FROM detalleventa
	 		INNER JOIN servicio
	 			ON detalleventa.idservicio_v = servicio.idservicio
	 				where detalleventa.idventa='$idventa'");
	 	foreach((array)$result_d as $ra){
	 					$des=$ra['descripcion'];
	 							echo "<pre>";
	 							echo " ".$des."<br>";
	 							echo "</pre>";
	 	}
	 	?></td>
	 		<td><?php echo $row['total']; ?></td>
			<td><?php echo $row['estado']; ?></td>
	 	</tr>
	 <?php
 };
	 ?>
 </table>
 <p align="right">Total:<?php echo number_format($totalv,2); ?></p>
</body>
</html>
<?php
require_once("dompdf-0.8.3/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf=$dompdf->output();
$filename = 'pagos.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename,array("Attachment"=>0));
?>
