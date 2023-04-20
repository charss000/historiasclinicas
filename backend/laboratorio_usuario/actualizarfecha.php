<?php
include("../central/header.php");
include_once("../conexion/clsConexion.php");
$objcliente=new clsConexion;
$idlab=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idlab'],ENT_QUOTES))));
$resultl=$obj->consultar("SELECT * FROM laboratorio where idlab='$idlab'");
          foreach((array)$resultl as $row){
                $f_muestra=$row["f_muestra"];
                $f_entrega=$row["f_entrega"];
          	}
$resultc=$obj->consultar("SELECT * FROM configuracion");
          foreach((array)$resultc as $row){
                $zona=$row["zona_horaria"];
          	}
date_default_timezone_set("$zona");
$hoy = date("Y-m-d H:i:s");
//busqueda de pacientes
$resultpa=$obj->consultar("SELECT
  laboratorio.idlab,
  laboratorio.responsable,
  laboratorio.examen,
  paciente.paciente
  FROM laboratorio
  INNER JOIN paciente
  ON laboratorio.idpaciente = paciente.idpaciente
  WHERE laboratorio.idlab='$idlab'");
          foreach((array)$resultpa as $row){
                $pa=$row["paciente"];
          	}

?>
<div class="content-wrapper">
<!-- inicio de registro  -->
<section class="content">
 <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"><b>REGISTRO DE FECHA DE MUESTRA Y ENTREGA</b></h3>
        <p>PACIENTE: <?php echo $pa; ?></p>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
          <form action="capturar_fecha.php" method="post">
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label>Fecha de Muestra:</label>
                    <input type="date" class="form-control" name="f_muestra" value="<?php echo "$f_muestra"; ?>">
              </div>
              </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Fecha de Entrega:</label>
                  <input type="date" class="form-control" name="f_entrega" value="<?php echo "$f_entrega"; ?>">
            </div>
          </div>

            <!-- /.row -->
          </div>
    <!-- /.box-body -->
    <div class="box-footer">
     <center>
      <button type="submit" value="modificar" class="btn btn-success"><i class="fa fa-pencil"></i>Ingresar</button>
       <input type="hidden" name="funcion" id="funcion" value="modificar"/>
       <input type="hidden" name="cod" value="<?php echo $idlab;?>"/>
       <a href="index.php" class="btn btn-default"><i class="fa fa-close"></i> Cancelar </a></button>
     </center>

    </div>
  </form>
  </div>
</section>
<!-- fin de registro -->
</div>
<?php include("../central/footer.php"); ?>
