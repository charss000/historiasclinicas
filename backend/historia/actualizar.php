<?php
include("../central/header.php");
$cod=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idhistoria'],ENT_QUOTES))));
$data=$obj->consultar("SELECT historia.*
     , paciente.num_historia
     , paciente.paciente
     , paciente.sexo
     , paciente.fec_nacimiento
     , usuario.nombres
FROM
  paciente
INNER JOIN historia
ON historia.idpaciente = paciente.idpaciente
INNER JOIN usuario
ON historia.idusuario = usuario.idusu
 WHERE idhistoria='".$obj->real_escape_string($cod)."'");
								foreach((array)$data as $row){
                $idusuario= $row['idusuario'];
								$nombres= $row['nombres'];
								$idpaciente= $row['idpaciente'];
							  $pa= $row['paciente'];
                $sex= $row['sexo'];
                $naci= $row['fec_nacimiento'];
								$fec= $row['fecha'];
								$edad= $row['edad'];
								$talla= $row['talla'];
								$peso= $row['peso'];
								$mmhg= $row['pre_mmhg'];
								$frec= $row['frec_res_x'];
								$temp= $row['temperatura_c'];
								$cardiaca= $row['frec_cardiaca_x'];
								$imc= $row['imc'];
								$motivo= $row['motivo'];
								$ef= $row['examen_fisico'];
								$diag= $row['diagnostico'];
								$trata= $row['tratamiento'];
								$his=$row['num_historia'];
		            }
?>
<!DOCTYPE html>
 <div class="content-wrapper">
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
       <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><b>ACTUALIZAR HISTORIA</b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form action="capturar.php" method="post">
						<div class="col-md-12">
									<h4>Datos Principales</h4>
									<div class="panel panel-success">
										<div class="panel-body">

													<div class="col-md-4">
																			<div class="form-group">
																				<label>Medico:</label>
																				<div class="input-group">
																					<div class="input-group-addon">
																						<i class="fa fa-stethoscope"></i>
																					</div>
																					<input type="hidden" name="idmedico" value="<?php echo $idusuario; ?>">
																					<input type="text" class="form-control" required name="noguardar_medico" readonly="true" value="<?php echo $nombres;?>">
																				</div>
																				</div>
														</div>

														<div class="col-md-4">
																				<div class="form-group">
																					<label>Paciente:</label>
																					<div class="input-group">
																						<div class="input-group-addon">
																							<i class="fa fa-user"></i>
																						</div>
																						<input type="hidden" name="idpaciente" value="<?php echo $idpaciente; ?>">
																						<input type="text" class="form-control" required name="noguardar_paciente" readonly="true" value="<?php echo $pa?>">
																					</div>
																					</div>
															</div>

															<div class="col-md-3">
																					<div class="form-group">
																						<label>Fecha Registro:</label>
																						<div class="input-group">
																							<div class="input-group-addon">
																								<i class="fa fa-calendar"></i>
																							</div>
																							<input type="text" class="form-control" name="fecha" required readonly="true" value="<?php echo $fec;?>">
																						</div>
																						</div>
																</div>

																<div class="col-md-4">
																						<div class="form-group">
																							<label>P.Sexo:</label>
																							<div class="input-group">
																								<div class="input-group-addon">
																									<i class="fa fa-neuter"></i>
																								</div>
																								<input type="text" class="form-control" name="noguardar" readonly="true" value="<?php echo $sex;?>">
																							</div>
																							</div>
																	</div>

																	<div class="col-md-4">
																							<div class="form-group">
																								<label>P.Fec Nacimiento:</label>
																								<div class="input-group">
																									<div class="input-group-addon">
																										<i class="fa fa-neuter"></i>
																									</div>
																									<input type="text" class="form-control" name="noguardar" readonly="true" value="<?php echo $naci;?>">
																								</div>
																								</div>
																		</div>

																		<div class="col-md-3">
																								<div class="form-group">
																									<label>N.Historia:</label>
																									<div class="input-group">
																										<div class="input-group-addon">
																											<i class="fa fa-history"></i>
																										</div>
																										<input type="text" class="form-control" name="historia" required readonly="true" value="<?php echo $his;?>">
																									</div>
																									</div>
																			</div>
										 </div>
								 </div>
							</div>

	<div class="col-md-12">

						<div class="col-md-4">
							<h4>Funciones Vitales</h4>
							<div class="panel panel-success">
								<div class="panel-body">

									<div class="col-md-12">
															<div class="form-group">
																<label>Edad:</label>
																<div class="input-group">
																	<input type="text" class="form-control" name="edad" required value="<?php echo $edad;?>">
																</div>
																</div>
										</div>

										<div class="col-md-12">
																<div class="form-group">
																	<label>Talla (cm):</label>
																	<div class="input-group">
																		<input type="number" class="form-control" required name="talla" id="talla" min="0" step="any" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" value="<?php echo $talla;?>">
																	</div>
																	</div>
										</div>
										<div class="col-md-12">
																<div class="form-group">
																	<label>Peso (kg):</label>
																	<div class="input-group">
																		<input type="number"  class="form-control"  required name="peso" id="peso" min="0" step="any" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;" value="<?php echo $peso;?>">
																	</div>
																	</div>
										</div>
										<div class="col-md-12">
																<div class="form-group">
																	<label>Pre.Art(mmhg):</label>
																	<div class="input-group">
																		<input type="text" class="form-control" name="mmhg" required value="<?php echo $mmhg;?>">
																	</div>
																	</div>
										</div>
										<div class="col-md-12">
																<div class="form-group">
																	<label>Frec.Res x':</label>
																	<div class="input-group">
																		<input type="number" min="0" class="form-control" name="frec" required value="<?php echo $frec;?>">
																	</div>
																	</div>
										</div>
										<div class="col-md-12">
																<div class="form-group">
																	<label>Temperatura c°:</label>
																	<div class="input-group">
																		<input type="number" min="0" class="form-control" name="temp" required value="<?php echo $temp;?>">
																	</div>
																	</div>
										</div>
										<div class="col-md-12">
																<div class="form-group">
																	<label>Frec.Cardiaca x':</label>
																	<div class="input-group">
																		<input type="number" min="0" class="form-control" name="cardiaca"  required value="<?php echo $frec;?>">
																	</div>
																	</div>
										</div>
										<div class="col-md-12">
																<div class="form-group">
																	<label>IMC:</label>
																	<div class="input-group">
																		<input type="number"  step="any" class="form-control" name="imc" id="imc" readonly="true" required value="<?php echo $imc;?>">
																	</div>
															</div>
										</div>

							</div>
						</div>
				 </div>

								<div class="col-md-8">
									<h4>Motivo De la Consulta</h4>
									<div class="panel panel-success">
										<div class="panel-body">

											<div class="col-md-12">
																	<div class="form-group">
																		<label>Motivo:</label>
																		<div class="input-group">
																			<textarea  class="form-control" name="motivo" rows="4" cols="100"><?php echo "$motivo"; ?></textarea>
																		</div>
																		</div>
											</div>

											<div class="col-md-12">
																	<div class="form-group">
																		<label>Examen Fisico:</label>
																		<div class="input-group">
																			<textarea  class="form-control" name="ef" rows="4" cols="100"><?php echo "$ef"; ?></textarea>
																		</div>
																		</div>
											</div>

											<div class="col-md-12">
																	<div class="form-group">
																		<label>Diagnostico:</label>
																		<div class="input-group">
																			<textarea  class="form-control" name="diag" rows="4" cols="100"><?php echo "$diag"; ?></textarea>
																		</div>
																	</div>
											</div>

											<div class="col-md-12">
																	<div class="form-group">
																		<label>Tratamiento:</label>
																		<div class="input-group">
																			<textarea  class="form-control" name="tratamiento" rows="4" cols="100"><?php echo "$trata"; ?></textarea>
																		</div>
																		</div>
											</div>

										 </div>
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

           <a href="javascript: history.go(-1)" class="btn btn-success btn-flat"><i class="fa fa-close"></i>Cancelar </a>

       </center>
      </div>
    </form>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("../central/footer.php"); ?>
  
  <script>
$(document).ready(function () {
	       $("#talla,#peso").blur(function (e) {
        // $("#calcular").click(function (e) {
            var peso = $("#peso").val();
            var talla = $("#talla").val();
            if(peso!="" && talla!=""){
              var imc = (peso/(Math.pow(talla,2))).toFixed(1);
               $("#imc").val(imc).css({"fontWeight":"bold","color":"red"});
            }else {
                  alert('ingrese la talla y el peso');
            }
        });
    });
</script>
