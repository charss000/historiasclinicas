<?php
include("../central/header.php");
// include_once("../conexion/clsConexion.php");
// $obj=new clsConexion;
$idpaciente=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idpaciente'],ENT_QUOTES))));
$idcita=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idcita'],ENT_QUOTES))));
$result=$obj->consultar("SELECT * from usuario WHERE usuario='$usuario'");
  foreach((array)$result as $row){
    $idusuario=$row["idusu"];
		$nombres=$row["nombres"];
  }
	//calculo de edad en años meses y dias
	$calculo_edad=$obj->consultar("SELECT idpaciente
     , paciente
     , fec_nacimiento
     , timestampdiff(YEAR, fec_nacimiento, now()) AS anios
     , timestampdiff(MONTH, fec_nacimiento, now()) % 12 AS meses
     , floor(timestampdiff(DAY, fec_nacimiento, now()) % 30.4375) AS dias
			FROM paciente	where idpaciente='$idpaciente'");
			foreach((array)$calculo_edad as $row){
				$anios=$row["anios"];
				$meses=$row["meses"];
				$dias=$row["dias"];
		}
	//Paciente
	$paciente=$obj->consultar("SELECT idpaciente,paciente,sexo,fec_nacimiento,num_historia FROM paciente WHERE idpaciente='$idpaciente'");
			foreach((array)$paciente as $row){
        $pa=$row["paciente"];
				$sex=$row["sexo"];
				$fec_na=$row["fec_nacimiento"];
        $history=$row["num_historia"];
		}

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
          <h3 class="box-title"><b>HISTORIA</b></h3>
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
                                              <input type="hidden" name="idcita" value="<?php echo $idcita; ?>">
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
                                                  <input type="text" class="form-control" name="fecha" required readonly="true" value="<?php echo (date('Y-m-d'));?>">
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
                                                      <input type="text" class="form-control" name="noguardar" readonly="true" value="<?php echo $fec_na;?>">
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
                                                        <input type="text" class="form-control" name="historia" required readonly="true" value="<?php echo $history;?>">
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
                                      <input type="text" class="form-control" name="edad" readonly required value="<?php echo $anios.'años,  '.$meses.'meses,  '.$dias.' '.'dias';?>">
                                    </div>
                                    </div>
                        </div>

                        <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Talla (cm):</label>
                                      <div class="input-group">
                                        <input type="number" class="form-control" required name="talla" id="talla" min="0" step="any" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" placeholder="ejemplo:1.60">
                                      </div>
                                      </div>
                        </div>
                        <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Peso (kg):</label>
                                      <div class="input-group">
                                        <input type="number"  class="form-control"  required name="peso" id="peso" min="0" step="any" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;">
                                      </div>
                                      </div>
                        </div>
                        <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Pre.Art(mmhg):</label>
                                      <div class="input-group">
                                        <input type="text" class="form-control" name="mmhg" required placeholder="ejemplo:90/99">
                                      </div>
                                      </div>
                        </div>
                        <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Frec.Res x':</label>
                                      <div class="input-group">
                                        <input type="number" min="0" class="form-control" name="frec" required placeholder="ejemplo 18">
                                      </div>
                                      </div>
                        </div>
                        <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Temperatura c°:</label>
                                      <div class="input-group">
                                        <input type="number" min="0" class="form-control" name="temp" required>
                                      </div>
                                      </div>
                        </div>
                        <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Frec.Cardiaca x':</label>
                                      <div class="input-group">
                                        <input type="number" min="0" class="form-control" name="cardiaca"  required placeholder="ejemplo 59">
                                      </div>
                                      </div>
                        </div>
                        <div class="col-md-12">
                                    <div class="form-group">
                                      <label>IMC:</label>
                                      <div class="input-group">
                                        <input type="number"  step="any" class="form-control" name="imc" id="imc" readonly="true" required>
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
                                          <textarea  class="form-control" name="motivo" rows="4" cols="100"></textarea>
                                        </div>
                                        </div>
                          </div>

                          <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Examen Fisico:</label>
                                        <div class="input-group">
                                          <textarea  class="form-control" name="ef" rows="4" cols="100"></textarea>
                                        </div>
                                        </div>
                          </div>

                          <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Diagnostico:</label>
                                        <div class="input-group">
                                          <textarea  class="form-control" name="diag" rows="4" cols="100"></textarea>
                                        </div>
                                      </div>
                          </div>

                          <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Tratamiento:</label>
                                        <div class="input-group">
                                          <textarea  class="form-control" name="tratamiento" rows="4" cols="100"></textarea>
                                        </div>
                                        </div>
                          </div>

                         </div>
                       </div>
                    </div>

                </div>
                <!-- /.row -->

        <!-- /.box-body -->
        <div class="box-footer">
         <center><button type="submit" name="funcion" value="registrar" class="btn btn-success"><i class="fa fa-save"></i> Registrar </button>
             <a href="javascript: history.go(-1)" class="btn btn-success btn-flat"><i class="fa fa-backward"></i> Cancelar</a>
         </center>
        </div>
      </form>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include("../central/footer.php"); ?>
<script>
$(document).ready(function () {
	       $("#peso").blur(function (e) {
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
