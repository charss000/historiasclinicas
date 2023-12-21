<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
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
	font-size: 14px;
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
<body id="n">
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
   <?php 
   $totalv = 0;
   foreach($result as $row){
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

	 	$result_d= array_filter($detalleventa,function($v,$k) use($idventa){
	 		
	 		return $v['idventa']==$idventa;
	 	}, ARRAY_FILTER_USE_BOTH);/*$obj->consultar("SELECT
	 		servicio.descripcion,
	 		detalleventa.idventa
	 	FROM detalleventa
	 		INNER JOIN servicio
	 			ON detalleventa.idservicio_v = servicio.idservicio
	 				where detalleventa.idventa='$idventa'"); */
	 	foreach($result_d as $ra){
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