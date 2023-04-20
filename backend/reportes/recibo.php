<?php ob_start();
include("../seguridad.php");
include_once("../conexion/clsConexion.php");
include_once("cantidad_en_letras.php");
$obj=new clsConexion;
	if(!empty($_GET['idventa'])){
	 $idventa= trim($obj->real_escape_string(strip_tags($_GET['idventa'],ENT_QUOTES)));
	}
$result=$obj->consultar("SELECT * FROM configuracion");
		foreach((array)$result as $row){
		$logo=$row['logo'];
		$rz=$row['razon_social'];
		$moneda=$row['moneda'];
		$imp_num=$row['imp_num'];
		$mon_simbolo=$row['mon_simbolo'];
    $imp_letra=$row['imp_letra'];
		}

	$result_v=$obj->consultar("SELECT
  paciente.paciente,
	venta.idventa,
  venta.fecha,
  venta.subtotal,
  venta.igv,
  venta.total,
  venta.num_docu,
  venta.observacion,
  venta.usuario
FROM venta
  INNER JOIN paciente
    ON venta.idpaciente_v = paciente.idpaciente where venta.idventa='$idventa'");
				foreach((array)$result_v as $row){
				$paciente=$row['paciente'];
				$fecha=$row['fecha'];
				$subtotal=$row['subtotal'];
				$igv=$row['igv'];
				$total=$row['total'];
				$num_docu=$row['num_docu'];
				$observacion=$row['observacion'];
				$usuario=$row['usuario'];
				}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recibo de Pago</title>

<style type="text/css">
.centrar {
	text-align: center;
}
.d {
	text-align: right;
}
.c {
	text-align: center;
}
</style>
</head>

<body>
<table width="500" border="0" align="center" cellspacing="0">
  <tr>
    <th height="77" bgcolor="#FFFFFF" scope="col"><h1> <img src="../configuracion/foto/<?php echo $logo?>" alt="" width="200" height="80" /><?php echo $rz?></h1></th>
  </tr>
</table>
<table width="497" border="0" align="center" cellspacing="0">
  <tr>
    <td width="381" style="text-align: right; font-weight: bold;">&nbsp;</td>
    <td width="31" style="text-align: left; font-weight: bold;">&nbsp;</td>
    <td width="17" style="text-align: left; font-weight: bold;">&nbsp;</td>
    <td width="60" style="text-align: left; font-weight: bold;">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align: right; font-weight: bold;">RECIBO N° </td>
    <td style="text-align: right; font-weight: bold;">001</td>
    <td style="text-align: center; font-weight: bold;">-</td>
    <td class="lef" style="text-align: left; font-weight: bold;"><?php echo $num_docu?></td>
  </tr>
</table>
<table width="500" border="0" align="center">
  <tr>
    <td width="152" style="font-weight: bold">FECHA:</td>
    <td width="332"><?php echo $fecha?></td>
  </tr>
  <tr>
    <td style="font-weight: bold">RECIBIMOS DE:</td>
    <td><?php echo $paciente?></td>
  </tr>
</table>
<table width="500" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="218" bgcolor="#CCCCCC" style="text-align: center; font-weight: bold; font-size: 14;">CONCEPTO</td>
    <td width="90" bgcolor="#CCCCCC" style="text-align: center; font-weight: bold;">U.M</td>
    <td width="60" bgcolor="#CCCCCC" style="text-align: center; font-weight: bold;">CANT.</td>
    <td width="60" bgcolor="#CCCCCC" style="text-align: center; font-weight: bold;">PRECIO</td>
    <td width="60" bgcolor="#CCCCCC" style="text-align: center; font-weight: bold;">IMP.</td>
  </tr>
	<?php
	$result_dv=$obj->consultar("SELECT
  detalleventa.idventa,
  detalleventa.cantidad,
  detalleventa.precio,
  detalleventa.importe,
  servicio.descripcion,
  servicio.um
FROM detalleventa
  INNER JOIN servicio
    ON detalleventa.idservicio_v = servicio.idservicio where detalleventa.idventa='$idventa'");
		foreach((array)$result_dv as $row){
			?>
					<tr class="centrar">
			      <td><?php echo $row['descripcion']; ?></span></td>
					  <td><?php echo $row['um'];?></span>
            <td><?php echo $row['cantidad']; ?></span></td>
					 <td><?php echo $row['precio']; ?></span></td>
					 <td><?php echo $row['importe']; ?></span></td>
					</tr>
			<?php
			};
		?>
</table>
<table width="500" border="0" align="center" cellspacing="1">
  <tr>
    <td colspan="2" rowspan="3">&nbsp;</td>
    <td width="84">SUBTOTAL </td>
    <td width="20" class="d"><?php echo $mon_simbolo; ?></td>
    <td width="60" class="c"><?php echo $subtotal?></td>
  </tr>
  <tr>
    <td><?php echo $imp_letra?></td>
    <td class="d"><?php echo $mon_simbolo; ?></td>
    <td class="c"><?php echo $igv?></td>
  </tr>
  <tr>
    <td height="23">TOTAL</td>
    <td class="d"><?php echo $mon_simbolo; ?></td>
    <td class="c"><?php echo $total;?></td>
  </tr>
</table>
<table width="500" border="0" align="center">
  <tr>
    <td width="27" style="text-align: right">SON:</td>
    <td width="463" class="left" style="text-align: left"><?php echo CantidadEnLetra($total).' '.$moneda;?></td>
  </tr>
</table>
<table width="500" height="66" border="0" align="center">
  <tr>
    <td width="149" height="62" style="text-align: center"> OBSERVACIONES: </td>
    <td width="341" style="text-align: left; font-weight: bold;"><?php echo $observacion?></td>
  </tr>
</table>
<table width="500" border="0" align="center">
  <tr>
    <td width="36" style="text-align: right; font-weight: bold;">USU:</td>
    <td width="454" style="text-align: left;"><?php echo $usuario?></td>
  </tr>
</table>
<p>&nbsp;</p>
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
$filename = 'recibo.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename,array("Attachment"=>0));
?>
