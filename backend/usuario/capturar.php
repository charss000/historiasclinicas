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
$usuario=trim($obj->real_escape_string(strip_tags($_POST['usuario'],ENT_QUOTES)));
$cla=trim($obj->real_escape_string(strip_tags($_POST['cla'],ENT_QUOTES)));
$documento=trim($obj->real_escape_string(strip_tags($_POST['documento'],ENT_QUOTES)));
$fec=trim($obj->real_escape_string(strip_tags($_POST['fecha'],ENT_QUOTES)));
$no=trim($obj->real_escape_string(strip_tags($_POST['na'],ENT_QUOTES)));
$dir=trim($obj->real_escape_string(strip_tags($_POST['direccion'],ENT_QUOTES)));
$sexo=trim($obj->real_escape_string(strip_tags($_POST['sexo'],ENT_QUOTES)));
$te=trim($obj->real_escape_string(strip_tags($_POST['tel'],ENT_QUOTES)));
$em=trim($obj->real_escape_string(strip_tags($_POST['mail'],ENT_QUOTES)));
$es=trim($obj->real_escape_string(strip_tags($_POST['es'],ENT_QUOTES)));
$t=trim($obj->real_escape_string(strip_tags($_POST['tipo'],ENT_QUOTES)));
$idesp=trim($obj->real_escape_string(strip_tags($_POST['idesp'],ENT_QUOTES)));
$data=$obj->consultar("SELECT clave From usuario WHERE idusu='$cod'");
 foreach ($data as $row) {
    $clavee=$row['clave'];
}
if ($clavee!=$cla) {
  $clavemd5 = md5($cla);
    $sql="UPDATE `usuario` SET `idespecialidad`='$idesp',`nombres`='$no',`sexo`='$sexo',`fecha_nacimiento`='$fec',`documento`='$documento',
    `direccion`='$dir',`email`='$em',`telefono`='$te',`tipo`='$t',`usuario`='$usuario',`clave`='$clavemd5',`estado`='$es' WHERE idusu=$cod";

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
if ($clavee==$cla){
  $sql="UPDATE `usuario` SET `idespecialidad`='$idesp',`nombres`='$no',`sexo`='$sexo',`fecha_nacimiento`='$fec',`documento`='$documento',
  `direccion`='$dir',`email`='$em',`telefono`='$te',`tipo`='$t',`usuario`='$usuario',`estado`='$es' WHERE idusu=$cod";
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
}
if($funcion=="registrar"){
  $usuario=trim($obj->real_escape_string(strip_tags($_POST['usuario'],ENT_QUOTES)));
  $cla=trim($obj->real_escape_string(strip_tags($_POST['cla'],ENT_QUOTES)));
  $documento=trim($obj->real_escape_string(strip_tags($_POST['documento'],ENT_QUOTES)));
  $fec=trim($obj->real_escape_string(strip_tags($_POST['fecha'],ENT_QUOTES)));
  $no=trim($obj->real_escape_string(strip_tags($_POST['na'],ENT_QUOTES)));
  $dir=trim($obj->real_escape_string(strip_tags($_POST['direccion'],ENT_QUOTES)));
  $sexo=trim($obj->real_escape_string(strip_tags($_POST['sexo'],ENT_QUOTES)));
  $te=trim($obj->real_escape_string(strip_tags($_POST['tel'],ENT_QUOTES)));
  $em=trim($obj->real_escape_string(strip_tags($_POST['mail'],ENT_QUOTES)));
  $es=trim($obj->real_escape_string(strip_tags($_POST['es'],ENT_QUOTES)));
  $t=trim($obj->real_escape_string(strip_tags($_POST['tipo'],ENT_QUOTES)));
  $idespecialidad=trim($obj->real_escape_string(strip_tags($_POST['idesp'],ENT_QUOTES)));

  if ($t=='administrador') {
    $idesp='1';
  }
  else {
    $idesp=$idespecialidad;
  }
  $clavemd5=md5($cla);
    $sql="INSERT INTO `usuario`(`idespecialidad`, `nombres`, `sexo`, `fecha_nacimiento`, `documento`, `direccion`, `email`, `telefono`, `tipo`, `usuario`, `clave`, `estado`)
                        VALUES ('$idesp','$no','$sexo','$fec','$documento','$dir','$em','$te','$t','$usuario','$clavemd5','$es')";

                        $data=$obj->consultar("SELECT MAX(idusu) as idusu FROM usuario");
                        		foreach($data as $row){
                        				$idu=$row['idusu']+1;
                        		}

  $obj->ejecutar($sql);
   //inserta los 7 dias en el idd es el id del dia
   // si salta error aqui colocar todas las variables de la tabla a insertar
  for($i=1; $i<=7; $i++){
    $sql_c="INSERT into dia_usuario (`idd`,`idu`)values('$i','$idu')";
    $res=$obj->ejecutar($sql_c);
  }
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
