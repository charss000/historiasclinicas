<head>
  <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
  <script src="../plugins/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="../plugins/plugins/jQuery/jquery-ui.min.js"></script>
  <script src="../plugins/bootbox/bootbox.min.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php

include_once("../conexion/clsConexion.php");
$obj= new clsConexion();
$funcion=$_POST["funcion"];
if($funcion=="modificar"){
$idu=$obj->real_escape_string($_POST['idusu']);

$estado1 = (isset($_POST['estado1'])) ? 1 : 0;
$hi1=$obj->real_escape_string($_POST['hora_inicio1']);
$hf1=$obj->real_escape_string($_POST['hora_fin1']);
$d1=$obj->real_escape_string($_POST['duracion1']);

$estado2 = (isset($_POST['estado2'])) ? 1 : 0;
$hi2=$obj->real_escape_string($_POST['hora_inicio2']);
$hf2=$obj->real_escape_string($_POST['hora_fin2']);
$d2=$obj->real_escape_string($_POST['duracion2']);

$estado3 = (isset($_POST['estado3'])) ? 1 : 0;
$hi3=$obj->real_escape_string($_POST['hora_inicio3']);
$hf3=$obj->real_escape_string($_POST['hora_fin3']);
$d3=$obj->real_escape_string($_POST['duracion3']);

$estado4 = (isset($_POST['estado4'])) ? 1 : 0;
$hi4=$obj->real_escape_string($_POST['hora_inicio4']);
$hf4=$obj->real_escape_string($_POST['hora_fin4']);
$d4=$obj->real_escape_string($_POST['duracion4']);

$estado5 = (isset($_POST['estado5'])) ? 1 : 0;
$hi5=$obj->real_escape_string($_POST['hora_inicio5']);
$hf5=$obj->real_escape_string($_POST['hora_fin5']);
$d5=$obj->real_escape_string($_POST['duracion5']);

$estado6 = (isset($_POST['estado6'])) ? 1 : 0;
$hi6=$obj->real_escape_string($_POST['hora_inicio6']);
$hf6=$obj->real_escape_string($_POST['hora_fin6']);
$d6=$obj->real_escape_string($_POST['duracion6']);

$estado7 = (isset($_POST['estado7'])) ? 1 : 0;
$hi7=$obj->real_escape_string($_POST['hora_inicio7']);
$hf7=$obj->real_escape_string($_POST['hora_fin7']);
$d7=$obj->real_escape_string($_POST['duracion7']);

  $sql1="UPDATE `dia_usuario` SET `estado`='$estado1',`hora_inicio`='$hi1',`hora_fin`='$hf1',`duracion`='$d1' WHERE `idu`='$idu' AND `idd`='1'";
  $sql2="UPDATE `dia_usuario` SET `estado`='$estado2',`hora_inicio`='$hi2',`hora_fin`='$hf2',`duracion`='$d2' WHERE `idu`='$idu' AND `idd`='2'";
  $sql3="UPDATE `dia_usuario` SET `estado`='$estado3',`hora_inicio`='$hi3',`hora_fin`='$hf3',`duracion`='$d3' WHERE `idu`='$idu' AND `idd`='3'";
  $sql4="UPDATE `dia_usuario` SET `estado`='$estado4',`hora_inicio`='$hi4',`hora_fin`='$hf4',`duracion`='$d4' WHERE `idu`='$idu' AND `idd`='4'";
  $sql5="UPDATE `dia_usuario` SET `estado`='$estado5',`hora_inicio`='$hi5',`hora_fin`='$hf5',`duracion`='$d5' WHERE `idu`='$idu' AND `idd`='5'";
  $sql6="UPDATE `dia_usuario` SET `estado`='$estado6',`hora_inicio`='$hi6',`hora_fin`='$hf6',`duracion`='$d6' WHERE `idu`='$idu' AND `idd`='6'";
  $sql7="UPDATE `dia_usuario` SET `estado`='$estado7',`hora_inicio`='$hi7',`hora_fin`='$hf7',`duracion`='$d7' WHERE `idu`='$idu' AND `idd`='7'";

if ($_POST['hora_inicio1']) {
  $obj->ejecutar($sql1);
}
if ($_POST['hora_inicio2']) {
  $obj->ejecutar($sql2);
}
if ($_POST['hora_inicio3']) {
  $obj->ejecutar($sql3);
}
if ($_POST['hora_inicio4']) {
  $obj->ejecutar($sql4);
}
if ($_POST['hora_inicio5']) {
  $obj->ejecutar($sql5);
}
if ($_POST['hora_inicio6']) {
  $obj->ejecutar($sql6);
}
if ($_POST['hora_inicio7']) {
  $obj->ejecutar($sql7);
}
    

      echo"<script>
        bootbox.alert('operacion exitosa', function(){
        self.location='index.php';
      });
    </script>";

}
?>
</body>
