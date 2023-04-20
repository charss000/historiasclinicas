<?php
include("../central/header.php");
$estado=null;
$tipo=null;
$resultc=$obj->consultar("SELECT * FROM configuracion");
    foreach((array)$resultc as $row){
      $zona=$row["zona_horaria"];
  }
  date_default_timezone_set("$zona");
  $hoy = date("Y-m-d H:i:s");

?>
<!DOCTYPE html>
 <div class="content-wrapper">
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
     <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><b>USUARIO- MEDICO</b></h3>
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
                 <input type="text" class="form-control" name="na" placeholder="Por ejemplo,Juan Perez Perez" required>
               </div>
             </div>

             <div class="form-group">
             <label for="inputEmail3">Fecha de Nacimiento(*):</label>
             <div class="input-group">
               <div class="input-group-addon">
                 <i class="fa fa-edit"></i>
               </div>
             <input type="date" class="form-control"  placeholder="Ejemplo,Lima peru" name="fecha" required max="<?php echo date("Y-m-d"); ?>">
             </div>
            </div>

             <div class="form-group">
             <label for="inputEmail3">Direccion:</label>
             <div class="input-group">
               <div class="input-group-addon">
                 <i class="fa fa-edit"></i>
               </div>
             <input type="text" class="form-control"  placeholder="Ejemplo,Lima peru" name="direccion">
             </div>
            </div>

            <div class="form-group">
            <label for="inputEmail3">Email:</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-envelope-o"></i>
              </div>
            <input type="email" class="form-control"  placeholder="Ejemplo,sistemassuccessr@ejemplo.com" name="mail" >
            </div>
            </div>

              <div class="form-group">
               <label>Usuario(*):</label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-pencil"></i>
                 </div>
                 <input type="text" class="form-control" name="usuario" required autocomplete="off" maxlength="50">
               </div>
             </div>

                <div class="form-group">
                  <label>Tipo(*):</label>
                    <select class="form-control select2" style="width: 100%;" required="true" name="tipo" id="tipo">
                                      <option value="">SELECCIONE</option>
                                      <option value="administrador">administrador</option>
                                      <option value="usuario">usuario</option>
                                      <option value="laboratorio">laboratorio</option>
                    </select>
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
                  <label for="inputEmail3">Documento(*):</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-edit"></i>
                    </div>
                  <input type="text" class="form-control"  placeholder="Ejemplo,12345678" name="documento" required>
                  </div>
                 </div>
<!-- especialidad -->
	             <div class="form-group">
              <label>Telefono:</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-phone"></i>
                </div>
                <input type="text" class="form-control" name="tel" placeholder="Numero de telefono o celular">
              </div>
              </div>

              <div class="form-group">
                <label>Estado(*):</label>
                  <select class="form-control select2" style="width: 100%;" required="true" name="es">
                                    <option value="activo" <?php if($estado=='activo'){ echo 'selected'; } ?>>activo</option>
                                     <option value="inactivo" <?php if($estado=='inactivo'){ echo 'selected'; } ?>>inactivo</option>
                  </select>
               </div>

               <div class="form-group">
               <label>Clave(*):</label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-unlock"></i>
                 </div>
                 <input type="password" class="form-control" name="cla" placeholder="ingrese una clave segura min.de 6 digitos" required >
               </div>
               </div>

              <div class="form-group" id="idesp">
              <label>Especialidad(*):</label>
              <select name="idesp" class='form-control'required>
                 <?php
                                     $result=$obj->consultar("SELECT * from especialidad where especialidad<>'administrador'");
                                     foreach((array)$result as $row){
                                     if($row['idespecial']==$idesp){
                                       echo '<option value="'.$row['idespecial'].'" selected>'.$row['especialidad'].'</option>';
                                     }else{
                                       echo '<option value="'.$row['idespecial'].'">'.$row['especialidad'].'</option>';
                                     }
                                   }
                   ?>
               </select>
             </div>

          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- establecer horarios profesores -->
        <div class="box-footer">
         <center><button type="submit" name="funcion" value="registrar" class="btn btn-success"><i class="fa fa-save"></i> Registrar </button>
             <a href="index.php" class="btn btn-default"><i class="fa fa-close"></i> Cancelar </a></button>
         </center>
          <!-- <small>(*)campos obligatorios</small> -->
        </div>
      </form>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include("../central/footer.php"); ?>
<script type="text/javascript">
$('#idesp').hide();
$('#tipo').change(function(){
    var tipo = $('#tipo').val();
    var idesp = $('#idesp').val();
          if (tipo=='administrador') {
              $('#idesp').hide();
          } else {
              $('#idesp').show('');
          }
});
</script>
