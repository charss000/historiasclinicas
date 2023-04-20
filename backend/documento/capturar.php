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
// $idmedico=trim($obj->real_escape_string(strip_tags($_POST['idmedico'],ENT_QUOTES)));
// $idpaciente=trim($obj->real_escape_string(strip_tags($_POST['idpaciente'],ENT_QUOTES)));
// $fecha=trim($obj->real_escape_string(strip_tags($_POST['fecha'],ENT_QUOTES)));
// $trata=trim($obj->real_escape_string(strip_tags($_POST['tratamiento'],ENT_QUOTES)));
// $sql="UPDATE `historia` SET `idusuario`='$idmedico',`idpaciente`='$idpaciente',`fecha`='$fecha',
// `edad`='$edad',`talla`='$talla',`peso`='$peso',`pre_mmhg`='$mmhg',`frec_res_x`='$frec',`temperatura_c`='$temp',`frec_cardiaca_x`='$cardiaca',`imc`='$imc',`motivo`='$motivo',
// `examen_fisico`='$ef',`diagnostico`='$diag',`tratamiento`='$trata' WHERE idhistoria=$cod";
//   $res=$obj->ejecutar($sql);
//   if ($res) {
//       echo"<script>
//         bootbox.alert('Registro Actualizado', function(){
//         self.location='index.php';
//       });
//     </script>";
//   } else {
//     echo"<script>
//       bootbox.alert('Algo salio mal , Vuelva a intentarlo', function(){
//       self.location='index.php';
//     });
//   </script>";
//   }
}
if($funcion=="registrar"){

$idpaciente=trim($obj->real_escape_string(strip_tags($_POST['idpaciente'],ENT_QUOTES)));
$no=trim($obj->real_escape_string(strip_tags($_POST['no'],ENT_QUOTES)));
$fecha=trim($obj->real_escape_string(strip_tags($_POST['fecha'],ENT_QUOTES)));
  // $file=trim($obj->real_escape_string(strip_tags($_POST['file'],ENT_QUOTES)));
  //////////////////////guardar archivo/////////////////////
$file = rand(1000,100000)."-".$_FILES['file']['name'];
$file_loc = $_FILES['file']['tmp_name'];
$file_size = $_FILES['file']['size'];
$file_type = $_FILES['file']['type'];
$folder="subir/";
// new file size in KB
$new_size = $file_size/1024;
// new file size in KB
// make file name in lower case
$new_file_name = strtolower($file);
// make file name in lower case
$final_file=str_replace(' ','-',$new_file_name);
//////fin guardar archivo///////////

  if(move_uploaded_file($file_loc,$folder.$final_file)) {
    $sql2="INSERT INTO `adjunto`(`idpaciente`, `descripcion`, `fecha`, `file`, `type`, `size`)
     VALUES ('$idpaciente','$no','$fecha','$final_file','$file_type','$new_size')";
    $res=$obj->ejecutar($sql2);
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
 }
?>
</body>
