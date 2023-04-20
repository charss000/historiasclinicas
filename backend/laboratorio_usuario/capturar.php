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
if($funcion=="registrar"){
$idlab=trim($obj->real_escape_string(strip_tags($_POST['idlab'])));
$analisis=trim($obj->real_escape_string(strip_tags($_POST['analisis'])));
$resultado=trim($obj->real_escape_string(strip_tags($_POST['resultado'])));
$referencia=trim($obj->real_escape_string(strip_tags($_POST['referencia'])));
$sql="INSERT INTO `examen`(`idlabo`, `analisis`, `resultado`, `referencia`)
VALUES ('$idlab','$analisis','$resultado','$referencia')";
  $res=$obj->ejecutar($sql);
    if ($res) {
        echo"<script>
          bootbox.alert('Registro Exitoso', function(){
          self.location='insertar.php?idlab=".$idlab."';
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
