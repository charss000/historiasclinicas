<?php
include("../seguridad.php");
ob_start();
$usu=$_SESSION["usuario"];
$idpc=NULL;
include_once("../conexion/clsConexion.php");
$obj= new clsConexion();
if (!empty($_POST)){
$idservicio=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['idservicio'],ENT_QUOTES))));
//registra los datos del carrito
$data=$obj->consultar("SELECT * FROM carrito WHERE session_id='$usu' AND idservicio='$idservicio'");
foreach((array)$data as $row){
  $idpc=$row['idservicio'];
}
//buscar producto por id
$data1=$obj->consultar("SELECT * FROM servicio WHERE idservicio='$idservicio'");
foreach((array)$data1 as $row){
$de=$row['descripcion'];
$um=$row['um'];
$pre=$row['precio'];
}
$cant=1;
$imp=$cant*$pre;
if ($idservicio==$idpc) {
  echo 'El Producto Ya Fue Agregado Al Carrito';
}else {
  $sql="INSERT INTO `carrito`(`idservicio`, `descripcion`, `um`, `cantidad`, `precio`,`importe`, `session_id`) VALUES
  ('$idservicio','$de','$um','$cant','$pre','$imp','$usu')";
  $obj->ejecutar($sql);
  echo 'Producto Agregado Al Carrito';
    }
}
?>
