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
$resultw=$obj->consultar("SELECT MAX(num_historia) as numero from paciente");
	foreach($resultw as $row){
	     if($row['numero']==NULL){
				$history='000001';
			}else{;
				$ultimo=$row['numero']+1;
				$history=str_pad((int) $ultimo,6,"0",STR_PAD_LEFT);
			}
	}
$funcion=$_POST["funcion"];
if($funcion=="modificar"){
$cod=trim($obj->real_escape_string(strip_tags($_POST['cod'],ENT_QUOTES)));
$no=trim($obj->real_escape_string(strip_tags($_POST['no'],ENT_QUOTES)));
$apo=trim($obj->real_escape_string(strip_tags($_POST['apo'],ENT_QUOTES)));
$sexo=trim($obj->real_escape_string(strip_tags($_POST['sexo'],ENT_QUOTES)));
$mail=trim($obj->real_escape_string(strip_tags($_POST['mail'],ENT_QUOTES)));
$tel=trim($obj->real_escape_string(strip_tags($_POST['tel'],ENT_QUOTES)));
$dir=trim($obj->real_escape_string(strip_tags($_POST['dir'],ENT_QUOTES)));
$nd=trim($obj->real_escape_string(strip_tags($_POST['num_docu'],ENT_QUOTES)));
$fecha=$_POST['fecha'];
$ec=$_POST['ec'];

$sql="UPDATE `paciente` SET `paciente`='$no',`sexo`='$sexo',`fec_nacimiento`='$fecha',`documento_pa`='$nd',`estado_civil`='$ec',
`direccion_pa`='$dir',`telefono`='$tel',`email`='$mail',`apoderado`='$apo' WHERE idpaciente=$cod";
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
  $apo=trim($obj->real_escape_string(strip_tags($_POST['apo'],ENT_QUOTES)));
  $sexo=trim($obj->real_escape_string(strip_tags($_POST['sexo'],ENT_QUOTES)));
  $mail=trim($obj->real_escape_string(strip_tags($_POST['mail'],ENT_QUOTES)));
  $tel=trim($obj->real_escape_string(strip_tags($_POST['tel'],ENT_QUOTES)));
  $dir=trim($obj->real_escape_string(strip_tags($_POST['dir'],ENT_QUOTES)));
  $nd=trim($obj->real_escape_string(strip_tags($_POST['num_docu'],ENT_QUOTES)));
  $fecha=$_POST['fecha'];
  $ec=$_POST['ec'];

$sql="INSERT INTO `paciente`(`paciente`, `sexo`, `fec_nacimiento`, `documento_pa`, `estado_civil`, `direccion_pa`, `telefono`, `email`, `apoderado`, `num_historia`)
VALUES ('$no','$sexo','$fecha','$nd','$ec','$dir','$tel','$mail','$apo','$history')";
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
