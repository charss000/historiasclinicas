 <?php
   include_once("../conexion/clsConexion.php");
   $obj=new clsConexion;
   $sql = "DELETE FROM adjunto WHERE idpaciente= '".$_POST["id"]."'";
   $obj->ejecutar($sql);
  ?>
