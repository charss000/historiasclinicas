<?php
include("../central/header.php");
$resultc=$obj->consultar("SELECT * FROM configuracion");
		foreach((array)$resultc as $row){
			$zona=$row["zona_horaria"];
	}
	date_default_timezone_set("$zona");
?>
<!DOCTYPE html>
 <div class="content-wrapper">
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
     <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><b>PACIENTE</b></h3>
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
                       <label>Apellidos y Nombres(*):</label>
                       <div class="input-group">
                         <div class="input-group-addon">
                           <i class="fa fa-user"></i>
                         </div>
                         <input type="text" class="form-control" name="no" placeholder="Por ejemplo,Juan Perez Perez" required>
                       </div>
                     </div>
										 <!-- <input type="time" name="" value="00:00 a.m."> -->

                    <div class="form-group">
                    <label for="inputEmail3">Fecha de Nacimiento(*):</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    <input type="date" class="form-control"  placeholder="Ejemplo,Lima peru" name="fecha" required max="<?php echo (date('Y-m-d'));?>">
                    </div>
                   </div>

                   <div class="form-group">
                     <label>Estado Civil(*):</label>
                       <select class="form-control select2" style="width: 100%;" required="true" name="ec">
                                         <option value="soltero">soltero</option>
                                          <option value="casado">casado</option>
                                          <option value="viudo">viudo</option>
                                          <option value="divorciado">divorciado</option>
                                          <option value="conviviente">conviviente</option>
                       </select>
                  </div>

                  <div class="form-group">
                  <label>Email:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-envelope-o"></i>
                    </div>
                  <input type="email" class="form-control"  placeholder="Ejemplo,sistemassuccessr@ejemplo.com" name="mail">
                  </div>
                </div>

                <div class="form-group">
                <label>Apoderado:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-users"></i>
                  </div>
                <input type="text" class="form-control"  placeholder="Ejemplo,padre jose" name="apo">
                </div>
              </div>

                  </div>
      			          <div class="col-md-6">
                        <div class="form-group">
                          <label>Sexo(*):</label>
                            <select class="form-control select2" style="width: 100%;" required="true" name="sexo">
                                              <option value="masculino">masculino</option>
                                               <option value="femenino">femenino</option>
                            </select>
                       </div>

                       <div class="form-group">
                        <label>Numero Documento(*):</label>
                         <div class="input-group">
                          <div class="input-group-addon">
                          <i class="fa fa-edit"></i>
                        </div>
                        <input type="text" class="form-control" name="num_docu" placeholder="ejemplo:12345678" required maxlength="15">
                         </div>
                      </div>

                      <div class="form-group">
                       <label>Direccion:</label>
                        <div class="input-group">
                         <div class="input-group-addon">
                         <i class="fa fa-edit"></i>
                       </div>
                       <input type="text" class="form-control" name="dir" placeholder="ingrese su direccion">
                        </div>
                     </div>

      	             <div class="form-group">
                      <label>Telefono/celular:</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                      <input type="text" class="form-control" name="tel" placeholder="Numero de telefono o celular" >
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
            <small>(*)campos obligatorios</small>
        </div>
      </form>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include("../central/footer.php"); ?>
