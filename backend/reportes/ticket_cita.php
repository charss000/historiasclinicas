<?php
include('../seguridad.php');
ob_start();
$usu_sesion=$_SESSION["usuario"];
include_once("../conexion/clsConexion.php");
	if(!empty($_GET['idcita'])){
	$obj=new clsConexion;
//configuracion
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
	///sucursal
	$idcita= trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idcita'],ENT_QUOTES))));
	$result=$obj->consultar("SELECT cita.fecha
     , cita.hora
		 , paciente.paciente
     , cita.idcita
     , usuario.idusu
     , especialidad.especialidad
     , usuario.nombres
     , cita.cupo
     , cita.fec_ho_impresion
     , usuario.usuario
     , paciente.num_historia
FROM
  cita
INNER JOIN paciente
ON cita.idpaciente = paciente.idpaciente
INNER JOIN usuario
ON cita.idusuario = usuario.idusu
INNER JOIN especialidad
ON usuario.idespecialidad = especialidad.idespecial
where cita.idcita ='$idcita'");
			foreach((array)$result as $row){
			//$usu=$row['usuario'];
			$fec=$row['fecha'];
		  $hora=$row['hora'];
		  $pa=$row['paciente'];
			$es=$row['especialidad'];
			$no=$row['nombres'];
		  $cupo=$row['cupo'];
			$fec_im=$row['fec_ho_impresion'];
			$history=$row['num_historia'];
			}
}
?>
<html>
<head>
<!-- <script type='text/javascript'>
	window.onload=function(){
		self.print();
	}
</script> -->
<meta charset="utf-8">
<!-- <style media='print'>
input{display:none;}
</style> -->
<style type="text/css">
.zona_impresion{
width: 400px;
padding:10px 5px 10px 5px;
float:left;
font-size:12.5px;
}

center {
	text-align: center;
}

#negrita {
	font-weight: bold;
}
</style>
<script>
function printPantalla()
{
   document.getElementById('cuerpoPagina').style.marginRight  = "0";
   document.getElementById('cuerpoPagina').style.marginTop = "1";
   document.getElementById('cuerpoPagina').style.marginLeft = "1";
   document.getElementById('cuerpoPagina').style.marginBottom = "0";
   document.getElementById('botonPrint').style.display = "none";
   window.print();
}
</script>
</head>
<body id="cuerpoPagina">
<div class="zona_impresion">
<table  border="0" class="zona_impresion">
  <tr>
    <td colspan="2" align="center"><img src="../configuracion/foto/<?php echo $logo?>" width="210" height="50" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><?php echo "$rz";?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><?php echo "RUC".'  :'."$ruc";?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><?php echo "$dir";?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><?php echo "TELEF:".' '.$tel;?></td>
  </tr>
  <tr>

  </tr>
	<tr>
	    <td colspan="5">=======================================================</td>
	</tr>
	<tr>
	  <td colspan="2" align="center"><b>TICKET DE CITA</b></td>
    </tr>
	<tr>
	  <td colspan="2" align="center">&nbsp;</td>
    </tr>
	<tr>
		<td width="268">FECHA:</td>
    <td width="268"><?php echo $fec; ?></td>
  </tr>
	<tr>
		<td width="268">HORA:</td>
		<td width="268"><?php echo $hora; ?></td>
	</tr>
	<tr>
		<td>SERV:</td>
		<td><?php echo $es; ?></td>
	</tr>
	<tr>
		<td>MEDICO:</td>
		<td><?php echo $no; ?></td>
	</tr>
  </table>
<table border="0" width="384" align="center" class="zona_impresion">
<br>
    <tr>
      <td colspan="3">=======================================================</td>
    </tr>
		<tr>
			<td width="195">N° HISTORIA:</td>
			<td width="195" align='left'><?php echo $history; ?></td>
		</tr>
					<tr>
					  <td width="195">PACIENTE:</td>
					  <td width="195" align='left'><?php echo $pa; ?></td>
					</tr>

		<tr>
		  <td colspan="3">=======================================================</td>
		</tr>
    <!-- <tr>
      <td colspan="5" align="center">Gracias por su compra...</td>
    </tr> -->
    <tr>
      <td align="left">USUA:</td>
      <td colspan="9" align="center"><?php echo "$usu_sesion"; ?></td>
    </tr>
    <tr>
			<td align="left">Fecha y Hora de Impresion:</td>
      <td colspan="9" align="center"><?php echo date("Y-m-d   H:i"); ?></td>
    </tr>
    <tr>
			      <td align="left">
							<!-- <button onclick="window.location.href='javascript: history.go(-1)'">Regresar</button> -->
						 </td>
      <td colspan="9" align="center">
				<a href="#" id="botonPrint" onClick="printPantalla();"><img src="../plugins/img/printer.png" border="0" style="cursor:pointer" title="Imprimir"></a>
				<!-- <input type="button" id="desaparece" onClick="imprimir()" value="Imprimir"> -->
			</td>
    </tr>
  </table>
</div>
<p><br>
</p>
<p>
</body>
</html>
