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
$idmedico=trim($obj->real_escape_string(strip_tags($_POST['idmedico'],ENT_QUOTES)));
$idpaciente=trim($obj->real_escape_string(strip_tags($_POST['idpaciente'],ENT_QUOTES)));
$fecha=trim($obj->real_escape_string(strip_tags($_POST['fecha'],ENT_QUOTES)));
$edad=trim($obj->real_escape_string(strip_tags($_POST['edad'],ENT_QUOTES)));
$talla=trim($obj->real_escape_string(strip_tags($_POST['talla'],ENT_QUOTES)));
$peso=trim($obj->real_escape_string(strip_tags($_POST['peso'],ENT_QUOTES)));
$mmhg=trim($obj->real_escape_string(strip_tags($_POST['mmhg'],ENT_QUOTES)));
$frec=trim($obj->real_escape_string(strip_tags($_POST['frec'],ENT_QUOTES)));
$temp=trim($obj->real_escape_string(strip_tags($_POST['temp'],ENT_QUOTES)));
$cardiaca=trim($obj->real_escape_string(strip_tags($_POST['cardiaca'],ENT_QUOTES)));
$imc=trim($obj->real_escape_string(strip_tags($_POST['imc'],ENT_QUOTES)));
$motivo=trim($obj->real_escape_string(strip_tags($_POST['motivo'],ENT_QUOTES)));
$ef=trim($obj->real_escape_string(strip_tags($_POST['ef'],ENT_QUOTES)));
$diag=trim($obj->real_escape_string(strip_tags($_POST['diag'],ENT_QUOTES)));
$trata=trim($obj->real_escape_string(strip_tags($_POST['tratamiento'],ENT_QUOTES)));
$sql="UPDATE `historia` SET `idusuario`='$idmedico',`idpaciente`='$idpaciente',`fecha`='$fecha',
`edad`='$edad',`talla`='$talla',`peso`='$peso',`pre_mmhg`='$mmhg',`frec_res_x`='$frec',`temperatura_c`='$temp',`frec_cardiaca_x`='$cardiaca',`imc`='$imc',`motivo`='$motivo',
`examen_fisico`='$ef',`diagnostico`='$diag',`tratamiento`='$trata' WHERE idhistoria=$cod";
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
  $idcita=trim($obj->real_escape_string(strip_tags($_POST['idcita'],ENT_QUOTES)));
  $idmedico=trim($obj->real_escape_string(strip_tags($_POST['idmedico'],ENT_QUOTES)));
  $idpaciente=trim($obj->real_escape_string(strip_tags($_POST['idpaciente'],ENT_QUOTES)));
  $fecha=trim($obj->real_escape_string(strip_tags($_POST['fecha'],ENT_QUOTES)));
  $edad=trim($obj->real_escape_string(strip_tags($_POST['edad'],ENT_QUOTES)));
  $talla=trim($obj->real_escape_string(strip_tags($_POST['talla'],ENT_QUOTES)));
  $peso=trim($obj->real_escape_string(strip_tags($_POST['peso'],ENT_QUOTES)));
  $mmhg=trim($obj->real_escape_string(strip_tags($_POST['mmhg'],ENT_QUOTES)));
  $frec=trim($obj->real_escape_string(strip_tags($_POST['frec'],ENT_QUOTES)));
  $temp=trim($obj->real_escape_string(strip_tags($_POST['temp'],ENT_QUOTES)));
  $cardiaca=trim($obj->real_escape_string(strip_tags($_POST['cardiaca'],ENT_QUOTES)));
  $imc=trim($obj->real_escape_string(strip_tags($_POST['imc'],ENT_QUOTES)));
  $motivo=trim($obj->real_escape_string(strip_tags($_POST['motivo'],ENT_QUOTES)));
  $ef=trim($obj->real_escape_string(strip_tags($_POST['ef'],ENT_QUOTES)));
  $diag=trim($obj->real_escape_string(strip_tags($_POST['diag'],ENT_QUOTES)));
  $trata=trim($obj->real_escape_string(strip_tags($_POST['tratamiento'],ENT_QUOTES)));

  $sql="INSERT INTO `historia`(`idusuario`, `idpaciente`, `fecha`, `edad`, `talla`, `peso`, `pre_mmhg`, `frec_res_x`, `temperatura_c`, `frec_cardiaca_x`, `imc`, `motivo`, `examen_fisico`, `diagnostico`, `tratamiento`)
   VALUES ('$idmedico','$idpaciente','$fecha','$edad','$talla','$peso','$mmhg','$frec','$temp','$cardiaca','$imc','$motivo','$ef','$diag','$trata')";

   $sqlupdateestado="UPDATE `cita` SET `estado`='atendido' WHERE idcita=$idcita";

  $res=$obj->ejecutar($sql);
  $obj->ejecutar($sqlupdateestado);
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
