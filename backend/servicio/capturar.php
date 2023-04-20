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
$cod=trim($obj->real_escape_string(strip_tags($_POST['cod'],ENT_QUOTES)));
$no=trim($obj->real_escape_string(strip_tags($_POST['no'],ENT_QUOTES)));
$um=trim($obj->real_escape_string(strip_tags($_POST['um'],ENT_QUOTES)));
// $stock=trim($obj->real_escape_string(strip_tags($_POST['stock'],ENT_QUOTES)));
$pre=trim($obj->real_escape_string(strip_tags($_POST['pre'],ENT_QUOTES)));
$idusu=trim($obj->real_escape_string(strip_tags($_POST['idusu'],ENT_QUOTES)));
$sql="UPDATE `servicio` SET `descripcion`='$no',`um`='$um',`precio`='$pre',`idusu`='$idusu' WHERE idservicio=$cod";
  $res=$obj->ejecutar($sql);
  if ($res) {
      echo"<script>
        bootbox.alert('Registro Actualizado', function(){
        self.location='index.php';
      });
    </script>";
  } else {
    echo"<script>
      bootbox.alert('Algo salio mal , Vuelva a intentarlo', function(){
      self.location='index.php';
    });
  </script>";
  }
}
if($funcion=="registrar"){
  $no=trim($obj->real_escape_string(strip_tags($_POST['no'],ENT_QUOTES)));
  $um=trim($obj->real_escape_string(strip_tags($_POST['um'],ENT_QUOTES)));
  $pre=trim($obj->real_escape_string(strip_tags($_POST['pre'],ENT_QUOTES)));
  $idusu=trim($obj->real_escape_string(strip_tags($_POST['idusu'],ENT_QUOTES)));
  $sql="INSERT INTO `servicio`(`descripcion`, `um`, `precio`, `idusu`) VALUES ('$no','$um','$pre','$idusu')";
  $res=$obj->ejecutar($sql);
    if ($res) {
        echo"<script>
          bootbox.alert('Registro Exitoso', function(){
          self.location='index.php';
        });
      </script>";
    } else {
      echo"<script>
        bootbox.alert('Algo salio mal , Vuelva a intentarlo', function(){
        self.location='index.php';
      });
    </script>";
    }
 }
?>
</body>
