<?php
session_start();
include_once("conexion/clsConexion.php");
$obj=new clsConexion;
// $result=$obj->consultar("SELECT logo FROM configuracion");
//     foreach((array)$result as $row){
//     $logo=$row['logo'];
//     }
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISCLINICA | LOGIN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="plugins/dist/css/AdminLTE.min.css">
  <link rel="shortcut icon" href="plugins/img/apple-icon-57x57.png" />
  <style>
  html, body{height:100%;}
  body {
     /*background: url('../../imagenes/j.jpg') fixed no-repeat; color: #bf00ff;
  position: absolute; top: 0; left: 0; width: 100%; height: 100%" */
  background: url('plugins/img/images.jpg');
  background-size: cover;
  background-repeat: no-repeat;
  position: relative;
  overflow-y:hidden;
  }
  #colorpanel {
    background: #ffffff;
    border: 11px hidden rgba(28,110,164,0.73);
    border-radius: 28px 28px 28px 29px;
}
.transparente{
opacity: 0.75;
-moz-opacity: 0.8;
filter: alpha(opacity=80);
-khtml-opacity: 0.8;
}
  </style>
</head>
<body class='transparente'>
<div class="login-box" >
  <!-- /.login-logo -->
  <div class="login-box-body" id="colorpanel">
    <div class="login-logo">
      <legend><h3>SISCLINICA</h3></legend>
      <!-- <img src="configuracion/foto/<?php echo $logo?>" width="250" height="100" /> -->
    </div>
    <p class="login-box-msg">Por favor ingrese su usuario y clave.</p>
    	<form name="form1" method="post" action="">
      <div class="form-group has-feedback">
        		<input type="text" class="form-control" name="usuario"  required placeholder="usuario"  autocomplete="off" />
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
    	<input type="password" class="form-control" name="clave" required placeholder="clave" autocomplete="off" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
    <div class="form-group has-feedback">
          <button type="submit" value="Ingresar" class="btn btn-success btn-block btn-flat"><i class="fa fa-unlock"></i> Ingresar</button>
      </div>
    </form>
    <div align="center">
    <?php 
    $clave ='21232f297a57a5a743894a0e4a801fc3';
    echo $clavemd5 = md5($clave);
    ?>
       <!-- <a href="../index.php">WEB INICIO</a> -->
      <br/>
      <span>2021-2030</span>  - <span>All rights reserved.</span>
          <br/>
        <a href=""  target="_blank">clinica universal</a>
    </div>
  </div>
  <!-- /.login-box-body -->
<!-- /.login-box -->
<!-- jQuery 2.2.3 -->
<script src="plugins/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="plugins/plugins/jQuery/jquery-ui.min.js"></script>
<script src="plugins/bootbox/bootbox.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    if(!empty($_POST['usuario']) and !empty($_POST['clave'])){
    $usuario= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['usuario'],ENT_QUOTES))));
    $clave= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['clave'],ENT_QUOTES))));
    $clavemd5 = md5($clave);
    $resultapo=$obj->consultar("SELECT tipo,usuario,clave,estado from usuario where usuario='".$obj->real_escape_string($usuario)."' and clave='".$obj->real_escape_string($clavemd5)."'");
    foreach((array)$resultapo as $row){
      $valor=$row['usuario'];
      $estado=$row["estado"];
      $tipo=$row["tipo"];
      // $sucu=$row["idsucursal"];
    }
    //si el usuario no existe en la bd manda el mensaje de error es como decir $row['usuario']=nulo
  if(isset($valor)==''){
    echo"<script>
      bootbox.alert('Usuario y/o clave Incorrecta', function(){
      self.location='index.php';
    });
  </script>";
  }
  else if($estado!='activo'){
    echo"<script>
      bootbox.alert('Usted no se encuentra Activo en la base de datos', function(){
      self.location='index.php';
    });
  </script>";
  }
  else if($tipo=='administrador'){
    // esta sesion de autentificado lo pongo 1 para seguridad i despues haga la comprobacion si no es igual a 1 se redireccion al inicio
   $_SESSION["autentificado"]=1;
   $_SESSION["usuario"]=$usuario;
   $_SESSION["clave"]=$clavemd5;
   // $_SESSION["sucursal"]=$sucu;
   $_SESSION["tipo"]=$tipo;
   echo "<script>window.location='inicio/index.php';</script>";

 }else if($tipo=='laboratorio'){
   $_SESSION["autentificado"]=1;
   $_SESSION["usuario"]=$usuario;
   $_SESSION["clave"]=$clavemd5;
   // $_SESSION["sucursal"]=$sucu;
   $_SESSION["tipo"]=$tipo;
   echo "<script>window.location='inicio/index_laboratorio.php';</script>";
 }
  else{
    $_SESSION["autentificado"]=1;
    $_SESSION["usuario"]=$usuario;
    $_SESSION["clave"]=$clavemd5;
    // $_SESSION["sucursal"]=$sucu;
    $_SESSION["tipo"]=$tipo;
    echo "<script>window.location='inicio/index_usuario.php';</script>";
  }
}
?>
