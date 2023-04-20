 <?php
   include_once("../conexion/clsConexion.php");
   $obj=new clsConexion;
   $sql = "UPDATE `venta` SET `estado`='pagado' WHERE idventa='".$_POST["id"]."'";
   $obj->ejecutar($sql);
  ?>
