<?php
include("../central/header.php");
$cod=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idpaciente'],ENT_QUOTES))));
$data=$obj->consultar("SELECT * from paciente WHERE idpaciente='".$obj->real_escape_string($cod)."'");
								foreach((array)$data as $row){
                $no= $row['paciente'];
                $tel= $row['telefono'];
                $es= $row['estado_civil'];
                $dir= $row['direccion_pa'];
                $email= $row['email'];
                $apo= $row['apoderado'];
                $sexo= $row['sexo'];
                $nd= $row['documento_pa'];
                $fec_nacimiento= $row['fec_nacimiento'];
		            }
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
                     <input type="text" class="form-control" name="no" placeholder="Por ejemplo,Juan Perez Perez" required value="<?php echo "$no"; ?>">
                   </div>
                 </div>

                <div class="form-group">
                <label for="inputEmail3">Fecha de Nacimiento(*):</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                <input type="date" class="form-control"  placeholder="Ejemplo,Lima peru" name="fecha" required  value="<?php echo "$fec_nacimiento"; ?>" readonly>
                </div>
               </div>
               <div class="form-group">
                 <label>Estado Civil(*):</label>
                   <select class="form-control select2" style="width: 100%;" required="true" name="ec">
                                     <option value="soltero" <?php if($es=='soltero'){ echo 'selected'; } ?>>soltero</option>
                                      <option value="casado" <?php if($es=='casado'){ echo 'selected'; } ?>>casado</option>
                                      <option value="viudo" <?php if($es=='viudo'){ echo 'selected'; } ?>>viudo</option>
                                      <option value="divorciado" <?php if($es=='divorciado'){ echo 'selected'; } ?>>divorciado</option>
                                      <option value="conviviente" <?php if($es=='conviviente'){ echo 'selected'; } ?>>conviviente</option>
                   </select>
              </div>
              <div class="form-group">
              <label>Email:</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-envelope-o"></i>
                </div>
              <input type="email" class="form-control"  placeholder="Ejemplo,sistemassuccessr@ejemplo.com" name="mail"  value="<?php echo "$email"; ?>">
              </div>
            </div>
            <div class="form-group">
            <label>Apoderado:</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-users"></i>
              </div>
            <input type="text" class="form-control"  placeholder="Ejemplo,padre jose" name="apo"  value="<?php echo "$apo"; ?>">
            </div>
          </div>
              </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Sexo(*):</label>
                        <select class="form-control select2" style="width: 100%;" required="true" name="sexo">
                                          <option value="masculino" <?php if($sexo=='masculino'){ echo 'selected'; } ?>>masculino</option>
                                           <option value="femenino" <?php if($sexo=='femenino'){ echo 'selected'; } ?>>femenino</option>
                        </select>
                   </div>
                   <div class="form-group">
                    <label>Numero Documento(*):</label>
                     <div class="input-group">
                      <div class="input-group-addon">
                      <i class="fa fa-edit"></i>
                    </div>
                    <input type="text" class="form-control" name="num_docu" placeholder="ejemplo:12345678" required maxlength="15"  value="<?php echo "$nd"; ?>">
                     </div>
                  </div>
                  <div class="form-group">
                   <label>direccion:</label>
                    <div class="input-group">
                     <div class="input-group-addon">
                     <i class="fa fa-edit"></i>
                   </div>
                   <input type="text" class="form-control" name="dir" placeholder="ingrese su direccion"  value="<?php echo "$dir"; ?>">
                    </div>
                 </div>

                 <div class="form-group">
                  <label>Telefono/celular:</label>
                   <div class="input-group">
                    <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" name="tel" placeholder="Numero de telefono o celular"  value="<?php echo "$tel"; ?>">
                   </div>
                </div>
            </div>
          <!-- /.row -->
        </div>
        <div class="box-footer">
       <center>
        <button type="submit" value="modificar" class="btn btn-success"><i class="fa fa-pencil"></i>Modificar</button>
         <input type="hidden" name="funcion" id="funcion" value="modificar"/>
         <input type="hidden" name="cod" value="<?php echo $cod;?>"/>
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
