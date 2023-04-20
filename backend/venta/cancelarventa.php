<?php
require "../conexion/clsConexion.php";
$obj= new clsConexion();
$cod= trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idventa'],ENT_QUOTES))));
$sql= "DELETE  FROM venta WHERE idventa='".$obj->real_escape_string($cod)."'";
 //devuelve el stock al cancelar la venta
$obj->ejecutar($sql);
header('location:index.php');
?>
