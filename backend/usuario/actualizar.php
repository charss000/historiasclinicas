<?php
include("../central/header.php");;
$cod=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idusu'],ENT_QUOTES))));
$data=$obj->consultar("SELECT * FROM usuario WHERE idusu='".$obj->real_escape_string($cod)."'");
		foreach($data as $row){
		          	$idesp= $row['idespecialidad'];
		           	$no= $row['nombres'];
								$se= $row['sexo'];
								$fecha= $row['fecha_nacimiento'];
								$doc= $row['documento'];
								$dir= $row['direccion'];
								$email= $row['email'];
							  $tel= $row['telefono'];
								$tipo= $row['tipo'];
			          $usuario= $row['usuario'];
                $estado= $row['estado'];
								$cla= $row['clave'];
		}
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
          <h3 class="box-title"><b>USUARIO-MEDICO</b></h3>
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
											 <input type="text" class="form-control" name="na" placeholder="Por ejemplo,Juan Perez Perez" required value="<?php echo "$no"; ?>">
										 </div>
									 </div>

									 <div class="form-group">
									 <label for="inputEmail3">Fecha de Nacimiento(*):</label>
									 <div class="input-group">
										 <div class="input-group-addon">
											 <i class="fa fa-edit"></i>
										 </div>
									 <input type="date" class="form-control"  placeholder="Ejemplo,Lima peru" name="fecha" required  value="<?php echo "$fecha"; ?>" max="<?php echo date("Y-m-d"); ?>">
									 </div>
									</div>

									 <div class="form-group">
									 <label for="inputEmail3">Direccion:</label>
									 <div class="input-group">
										 <div class="input-group-addon">
											 <i class="fa fa-edit"></i>
										 </div>
									 <input type="text" class="form-control"  placeholder="Ejemplo,Lima peru" name="direccion"  value="<?php echo "$dir"; ?>">
									 </div>
									</div>

									<div class="form-group">
									<label for="inputEmail3">Email(*):</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-envelope-o"></i>
										</div>
									<input type="email" class="form-control"  placeholder="Ejemplo,sistemassuccessr@ejemplo.com" name="mail"  value="<?php echo "$email"; ?>">
									</div>
									</div>

										<div class="form-group">
										 <label>Usuario(*):</label>
										 <div class="input-group">
											 <div class="input-group-addon">
												 <i class="fa fa-pencil"></i>
											 </div>
											 <input type="text" class="form-control" name="usuario" required autocomplete="off" maxlength="50"  value="<?php echo "$usuario"; ?>">
										 </div>
									 </div>

										 <div class="form-group">
											 <label>Estado(*):</label>
												 <select class="form-control select2" style="width: 100%;" required="true" name="es">
																					 <option value="activo" <?php if($estado=='activo'){ echo 'selected'; } ?>>activo</option>
																						<option value="inactivo" <?php if($estado=='inactivo'){ echo 'selected'; } ?>>inactivo</option>
												 </select>
											</div>

									</div>

											<div class="col-md-6">

												<div class="form-group">
													<label>Sexo(*):</label>
														<select class="form-control select2" style="width: 100%;" required="true" name="sexo">
																							<option value="masculino"  <?php if($se=='masculino'){ echo 'selected'; } ?>>masculino</option>
																							 <option value="femenino"  <?php if($se=='femenino'){ echo 'selected'; } ?>>femenino</option>
														</select>
												 </div>

												<div class="form-group">
												<label for="inputEmail3">Documento(*):</label>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-edit"></i>
													</div>
												<input type="text" class="form-control"  placeholder="Ejemplo,12345678" name="documento" required  value="<?php echo "$doc"; ?>">
												</div>
											 </div>

											 <div class="form-group">
											 <label>Especialidad(*):</label>
											 <select name="idesp" class='form-control'required>
													<?php
																							$result=$obj->consultar("select * from especialidad");
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

										 <div class="form-group">
										<label>Telefono:</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-phone"></i>
											</div>
											<input type="text" class="form-control" name="tel" placeholder="Numero de telefono o celular" value="<?php echo "$tel"; ?>">
										</div>
											</div>

											<div class="form-group">
												<label>Tipo(*):</label>
													<select class="form-control select2" style="width: 100%;" required="true" name="tipo">
																						<option value="administrador" <?php if($tipo=='administrador'){ echo 'selected'; } ?>>administrador</option>
																						 <option value="usuario" <?php if($tipo=='usuario'){ echo 'selected'; } ?>>usuario</option>
																						 <option value="laboratorio" <?php if($tipo=='laboratorio'){ echo 'selected'; } ?>>laboratorio</option>
													</select>
											 </div>

											 <div class="form-group">
										<label>Clave(*):</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-unlock"></i>
											</div>
											<input type="password" class="form-control" name="cla" placeholder="ingrese una clave segura min.de 6 digitos" value="<?php echo "$cla"; ?>" >
										</div>
										</div>

								</div>
								<!-- /.row -->
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
