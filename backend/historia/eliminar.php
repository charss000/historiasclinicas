 <?php
   include_once("../conexion/clsConexion.php");
   $obj=new clsConexion;
   $sql = "DELETE FROM historia WHERE idhistoria= '".$_POST["id"]."'";
   $obj->ejecutar($sql);
  ?>
