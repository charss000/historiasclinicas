 <?php
   include_once("../conexion/clsConexion.php");
   $obj=new clsConexion;
   $sql = "DELETE FROM examen WHERE idexamen= '".$_POST["id"]."'";
   $obj->ejecutar($sql);
  ?>
