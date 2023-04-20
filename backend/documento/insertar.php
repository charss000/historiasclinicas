<?php
include("../central/header.php");
$resultc=$obj->consultar("SELECT * FROM configuracion");
    foreach((array)$resultc as $row){
      $zona=$row["zona_horaria"];
  }
  date_default_timezone_set("$zona");
  $hoy = date("Y-m-d H:i:s");

  $result_u=$obj->consultar("SELECT * FROM usuario where usuario='$usuario'");
      foreach((array)$result_u as $row){
        $idusu=$row["idusu"];
    }
?>
<!DOCTYPE html>
 <div class="content-wrapper">
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
     <div class="box box-success">
        <div class="box-header with-border">
    <h3 class="box-title"><b>DOCUMENTO</b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
              <form action="capturar.php" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">

                    <div class="form-group">
                     <label>Paciente:</label>
                     <div class="input-group">
                       <div class="input-group-addon">
                         <i class="fa fa-edit"></i>
                       </div>
                       <input type="hidden" name="idpaciente" id="idpaciente">
                       <input type="text" class="form-control" name="paciente" required id="paciente">
                     </div>
                   </div>

                      <div class="form-group">
                       <label>Descripcion:</label>
                       <div class="input-group">
                         <div class="input-group-addon">
                           <i class="fa fa-edit"></i>
                         </div>
                         <select name="no" class='form-control' required>
                           <?php
                             $result_u=$obj->consultar("SELECT * from servicio where idusu='$idusu'");
                                foreach((array)$result_u as $row){
                                 echo '<option value="'.$row['descripcion'].'" selected>'.$row['descripcion'].'</option>';
                                }
                             ?>
                          </select>
                       </div>
                     </div>

                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                     <label>Fecha:</label>
                     <div class="input-group">
                       <div class="input-group-addon">
                         <i class="fa fa-calendar"></i>
                       </div>
                      <input type="text" class="form-control" name="fecha" required readonly="true" value="<?php echo (date('Y-m-d'));?>">
                     </div>
                    </div>

                    <div class="form-group">
                     <label>Adjunto:(*)png,jpg</label>
                     <div class="input-group">
                       <div class="input-group-addon">
                         <i class="fa fa-file"></i>
                       </div>
                       <input type="file" name="file" required class="form-control">
                     </div>
                   </div>

                  </div>
                <!-- /.row -->
              </div>
        <!-- /.box-body -->
        <div class="box-footer">
         <center><button type="submit" name="funcion" value="registrar" class="btn btn-info"><i class="fa fa-save"></i> Registrar </button>
             <a href="index.php" class="btn btn-default"><i class="fa fa-close"></i> Cancelar </a></button>
         </center>
        </div>
      </form>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include("../central/footer.php"); ?>
<script type="text/javascript">
 $(function() {
						 $("#paciente").autocomplete({
								 source: "buscar_paciente.php",
								 minLength: 2,
								 select: function(event, ui) {
									event.preventDefault();
									$('#idpaciente').val(ui.item.idpaciente);
									$('#paciente').val(ui.item.paciente);
								 }
						 });
		});
 </script>
