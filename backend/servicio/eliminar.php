 <?php
   include_once("../conexion/clsConexion.php");
   $obj=new clsConexion;
   $sql = "DELETE FROM servicio WHERE idservicio= '".$_POST["id"]."'";
   $obj->ejecutar($sql);
  ?>
