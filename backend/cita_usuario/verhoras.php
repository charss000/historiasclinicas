<?php
include_once("../conexion/clsConexion.php");
$obj= new clsConexion();
$idd=trim($obj->real_escape_string(strip_tags($_POST['idd'],ENT_QUOTES)));
$idu=trim($obj->real_escape_string(strip_tags($_POST['idu'],ENT_QUOTES)));
$result_hora=$obj->consultar("SELECT * from dia_usuario where idu='$idu' and idd='$idd'");
foreach((array)$result_hora as $row){
 $estado= $row['estado'];
 $hi= strtotime($row['hora_inicio']);
 $hf= strtotime($row['hora_fin']);
 $d= $row['duracion']*60;
}
if ($estado=='1') {
  for($i=$hi; $i<=$hf; $i+=$d) {
    echo  "<option>".date("H:i",$i)."</option>";
  }
} else {
  echo "";
}
?>
