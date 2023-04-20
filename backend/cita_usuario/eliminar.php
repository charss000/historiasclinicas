<?php
  include_once("../conexion/clsConexion.php");
  $obj=new clsConexion;
  $sql = "DELETE FROM cita WHERE idcita= '".$_POST["id"]."'";
  $resultc=$obj->consultar("SELECT idventa FROM cita where idcita='".$_POST["id"]."'");
      foreach((array)$resultc as $row){
        $idventa=$row["idventa"];
    }
  $sql_delventa = "DELETE FROM venta WHERE idventa= '$idventa'";
  $obj->ejecutar($sql);
  $obj->ejecutar($sql_delventa);
 ?>
