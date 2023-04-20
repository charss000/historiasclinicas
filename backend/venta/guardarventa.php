<?php
include("../seguridad.php");
$usu=$_SESSION["usuario"];
include_once("../conexion/clsConexion.php");
$obj= new clsConexion();
$data=$obj->consultar("SELECT imp_num FROM configuracion");
		foreach($data as $row){
			$impuesto=$row['imp_num'];
		}
$num_docu=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['num_docu'],ENT_QUOTES))));
$num_docu_i='';
$datasee=$obj->consultar("SELECT num_docu FROM venta");
  foreach((array)$datasee as $row){
    $num_docu_i=$row['num_docu'];
  }
$num=$data=$obj->consultar("SELECT * from carrito WHERE session_id='$usu'");
if($num == 0) {
 print "<script>alert('No se pudo Registrar la venta agrege productos al carrito..')</script>";
 print("<script>window.location.replace('insertar.php');</script>");
}elseif ($num_docu==$num_docu_i) {
   echo "El comprobante ya se encuentra registrado, favor volver a intentarlo.";
}else{
$data=$obj->consultar("SELECT MAX(idventa) as idventa FROM venta");
		foreach($data as $row){
			if($row['idventa']==NULL){
				$idventa='1';
			}else{
				$idventa=$row['idventa']+1;
			}
		}
$impuesto=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['txtigv'],ENT_QUOTES))));
$data=$obj->consultar("SELECT ROUND(SUM(importe),2) as subtotal FROM carrito WHERE session_id='$usu'");
		foreach($data as $row){
			$subtotal=$row['subtotal'];
		}
$data=$obj->consultar("SELECT ROUND(SUM(importe)*$impuesto/100 ,2) as igv FROM carrito WHERE session_id='$usu'");
		foreach($data as $row){
			$igv=$row['igv'];
		}
$data=$obj->consultar("SELECT ROUND(SUM(importe)*$impuesto/100+SUM(importe),2) as total FROM carrito WHERE session_id='$usu'");
		foreach($data as $row){
			$total=$row['total'];
		}
$idpaciente_v=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['idpaciente'],ENT_QUOTES))));
$fecha=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['fecha'],ENT_QUOTES))));

$observacion=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['obs'],ENT_QUOTES))));
//guardar venta
if($idcliente==NULL){
  $insert_v="INSERT INTO `venta`(`idventa`, `idpaciente_v`, `fecha`, `subtotal`, `igv`, `total`, `tipo_docu`, `num_docu`, `serie`,`observacion`,`usuario`,`estado`)
                        VALUES ('$idventa','$idpaciente_v','$fecha','$subtotal','$igv','$total','RECIBO','$num_docu','001','$observacion','$usu','pagado')";
	$obj->ejecutar($insert_v);
}
//guardar detalle venta obtenido de los datos del carrito
$data=$obj->consultar("SELECT * from carrito WHERE session_id='$usu'");
		foreach((array)$data as $row){
			$idservicio= $row['idservicio'];
      $des= $row['descripcion'];
		  $um= $row['um'];
      $cant= $row['cantidad'];
      $pre= $row['precio'];
		  $imp= $row['importe'];
$insert_dv="INSERT INTO `detalleventa`(`idventa`, `idservicio_v`, `cantidad`, `precio`, `importe`) VALUES ('$idventa','$idservicio','$cant','$pre','$imp')";
$obj->ejecutar($insert_dv);
}
 //actualizacion de stock
// $data=$obj->consultar("select * from carrito WHERE session_id='$usu'");
// 		foreach((array)$data as $row){
// 			$id= $row['idproducto'];
//       $cantdb= $row['cantidad'];
// $p="update productos set stock=stock-$cantdb where idproducto='$id' ";
// $obj->ejecutar($p);
// }
//vacear carrito
$limpia_car="DELETE FROM carrito WHERE session_id='$usu'";
$obj->ejecutar($limpia_car);
//
header("Location:../paciente/index.php");
}
?>
