 <?php
   include_once("../conexion/clsConexion.php");
   $obj=new clsConexion;
   $sql = "DELETE FROM especialidad WHERE idespecial= '".$_POST["id"]."'";
   $obj->ejecutar($sql);
  ?>
