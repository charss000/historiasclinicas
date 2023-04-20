<?php
include("../central/header.php");
?>
<!DOCTYPE html>
 <div class="content-wrapper">
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
     <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><b>ESPECIALIDAD</b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
              <form action="capturar.php" method="post">
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                       <label>Especialidad:</label>
                       <div class="input-group">
                         <div class="input-group-addon">
                           <i class="fa fa-stethoscope"></i>
                         </div>
                         <input type="text" class="form-control" name="no" placeholder="Por ejemplo,neumologia" required>
                       </div>
                     </div>

                  </div>
                <!-- /.row -->
              </div>
        <!-- /.box-body -->
        <div class="box-footer">
         <center><button type="submit" name="funcion" value="registrar" class="btn btn-success"><i class="fa fa-save"></i> Registrar </button>
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
