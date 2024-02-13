<?php
include("../seguridad.php");
$usuario=$_SESSION["usuario"];
$tipo=$_SESSION["tipo"];
// $idsucursal=$_SESSION["sucursal"];
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$result=$obj->consultar("SELECT nombres from usuario WHERE usuario='$usuario'");
  foreach((array)$result as $row){
    $n=$row["nombres"];
  }
  $usur=$obj->consultar("SELECT razon_social FROM configuracion");
                foreach($usur as $row){
                $r_z=$row['razon_social'];
                }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>CS TINTAY PUNCO</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../plugins/jquery-ui.css">
  <link rel="stylesheet" href="../plugins/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
  <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/plugins/iCheck/all.css">
  <link rel="stylesheet" href="../plugins/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="../plugins/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <link rel="shortcut icon" href="../plugins/img/apple-icon-57x57.png" />
  <link rel="stylesheet" href="../plugins/dist/css/skins/_all-skins.min.css">
</head>
<body class="hold-transition skin-green-light sidebar-mini">
<div class="wrapper">
<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SI</b>CLI</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CS TINTAY PUNCO</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="icon-bar"><i class="fa fa-home"></i>Toggle navigation</span>

      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">

          </li>
        </ul>
      </div>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
		          <a href="#"><?php echo "BIENVENIDO::..$n"; ?></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar">
        <?php
  $url = explode('/',$_SERVER['REQUEST_URI']);

  ?>
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <ul class="sidebar-menu">
          <li class="header"><?php echo "<p style='legend;' >" . $r_z. "</p>"; ?></li>
          <li class="header">Panel de Navegacion</li>
          <?php
          if ($tipo=="administrador") { ?>
          
          
            <li class="<?= ($url[2]=='inicio' && $url[3]=='index.php')?'active':''?> treeview"><a href="../inicio/index.php"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
         <?php }

          if ($tipo=="usuario") { ?>
            <li class="<?= $url[3]=='index_usuario.php'?'active':'' ?> treeview"><a href="../inicio/index_usuario.php"><i class="fa fa-calendar"></i> <span>Calendario</span></a></li>
          <?php }
          ?>
          <?php
           if ($tipo=="usuario" || $tipo=="administrador") { ?>
           <li class="<?= ($url[2]=='historia' && $url[3]=='index.php')?'active':'' ?>"><a href="../historia/index.php"><i class="fa fa-history"></i> <span>Historias</span></a></li>
          <?php  }
          
            if ($tipo=="laboratorio") { ?>
            <li class="<?= $url[2]=='laboratorio_usuario'?'active':'' ?>"><a href="../laboratorio_usuario/index.php"><i class="fa fa-flask"></i> <span>Laboratorio</span></a></li>'
           <?php }

          
           if ($tipo=="usuario") {?>
            <li class="<?= $url[3]=='historial.php'?'active':'' ?>"><a href="../historia/historial.php"><i class="fa fa-address-card"></i> <span>Historial</span></a></li>
           <?php }
/*
          <!-- <li><a href="../vitales/index.php"><i class="fa fa-heart"></i> <span>Funciones Vitales</span></a></li> -->
          */
          if ($tipo=="administrador") {?>
            <li class="<?= $url[2]=='paciente'?'active':'' ?>"><a href="../paciente/index.php"><i class="fa fa-wheelchair"></i> <span>Paciente</span></a></li>
         <?php }

          
          if ($tipo=="usuario") {?>
          <li class="<?= $url[2]=='laboratorio'?'active':'' ?>"><a href="../laboratorio/index.php"><i class="fa fa-flask"></i> <span>laboratorio</span></a></li>
         <?php }

          
          if ($tipo=="administrador") {?>
          <li class="<?= $url[2]=='venta'?'active':'' ?>"><a href="../venta/index.php"><i class="fa fa-dollar"></i> <span>Pagos</span></a></li>
          <?php }

          
          if ($tipo=="administrador") { ?>
            <li class="<?= $url[2]=='servicio'?'active':'' ?>"><a href="../servicio/index.php"><i class="fa fa-edit"></i> <span>Servicio-Producto</span></a></li>
          <?php }
          
          if ($tipo=="usuario") {?>
            <li class="<?= $url[2]=='documento'?'active':'' ?>"><a href="../documento/index.php"><i class="fa fa-file"></i> <span>Documentos</span></a></li>
         <?php }
         
          
          if ($tipo=="administrador") {?>
            <li class="<?= $url[2]=='cita'?'active':'' ?>"><a href="../cita/index.php"><i class="fa fa-clock-o"></i> <span>Citas</span></a></li>
         <?php }
          
          if ($tipo=="usuario") {?>
            <li class="<?= $url[2]=='cita_usuario'?'active':'' ?>"><a href="../cita_usuario/index.php"><i class="fa fa-clock-o"></i> <span>Proxima Cita</span></a></li>
         <?php }

          
          if ($tipo=="administrador") {
            echo '<li class="treeview">
                <a href="#">
                  <i class="fa fa-stethoscope"></i>
                  <span>Modulo Usuario</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                <li><a href="../usuario/index.php"><i class="fa fa-users"></i> <span>Usuario-Medico</span></a></li>
                <li><a href="../especialidad/index.php"><i class="fa fa-stethoscope"></i> <span>Especialidad</span></a></li>
                </ul>
              </li>';
             }
           ?>
          <?php
          if ($tipo=="administrador") {
            echo '<li class="treeview">
                <a href="#">
                  <i class="fa fa-signal"></i>
                  <span>Reportes</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="../reportes/rptventa_index.php"><i class="fa fa-money"></i> <span> Ingresos</span></a></li>
                </ul>
              </li>';
             }
           ?>
              <?php
              if ($tipo=="administrador") {
                echo '<li><a href="../backup/backup.php"><i class="fa fa-database"></i> <span>Respaldo</span></a></li>
        		    <li><a href="../configuracion/actualizar.php"><i class="fa fa-cogs"></i> <span>Configuracion</span></a></li>';
              }
             ?>

          <li><a href="../cerrar.php"><i class="fa fa-power-off"></i> <span>Cerrar Sesion</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
