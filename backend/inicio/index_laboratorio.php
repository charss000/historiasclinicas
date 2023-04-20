<?php
include("../central/header.php");
$obj=new clsConexion;
$result=$obj->consultar("SELECT idusu from usuario WHERE usuario='$usuario'");
  foreach((array)$result as $row){
    $idusuario=$row["idusu"];
  }
// $result=$obj->consultar("SELECT count(*) as n from paciente");
//   foreach((array)$result as $row){
//     $p=$row["n"];
// }
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Accesos Directos
        <small>Panel De Control </small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      <div class="col-md-6">
      <!-- Info Boxes Style 2 -->
      <!-- /.info-box -->
      <div class="info-box bg-blue">
          <!-- <i class="fa fa-users"></i> aqui se cambian los iconos de las librerias de font awesome  -->
        <span class="info-box-icon"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Examenes De Pacientes</span>
          <span class="info-box-number"></span>

          <div class="progress">
            <div class="progress-bar" style="width: 20%"></div>
          </div>
         <a href="../laboratorio_usuario/index.php"><i class="fa fa-caret-right" style="color:white"></i></a>
        </div>
        <!-- /.info-box-content -->
      </div>

      </div>
      <!-- <div class="col-md-8">
           <div id="calendar"></div>
      </div> -->
    </section>
    <!-- /.content -->
  </div>
