 <?php
   include_once("../conexion/clsConexion.php");
   $obj=new clsConexion;
   $sql = "DELETE FROM paciente WHERE idpaciente= '".$_POST["id"]."'";
   $obj->ejecutar($sql);
  ?>
