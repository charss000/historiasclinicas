<?php
include("../central/header.php");
$idlab=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idlab'],ENT_QUOTES))));
// $idcita=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idcita'],ENT_QUOTES))));
$result=$obj->consultar("SELECT * from usuario WHERE usuario='$usuario'");
  foreach((array)$result as $row){
    $idusuario=$row["idusu"];
		$nombres=$row["nombres"];
  }
$resultc=$obj->consultar("SELECT * FROM configuracion");
		foreach((array)$resultc as $row){
			$zona=$row["zona_horaria"];
	}
	date_default_timezone_set("$zona");
// obtener idpaciente
$result_idpa=$obj->consultar("SELECT * from laboratorio WHERE idlab='$idlab'");
  foreach((array)$result_idpa as $row){
    $idpaciente=$row["idpaciente"];
    $f_muestra=$row["f_muestra"];
    $f_entrega=$row["f_entrega"];
  }
  //obtener el nombre del paciente
  $result_pa=$obj->consultar("SELECT * from paciente WHERE idpaciente='$idpaciente'");
    foreach((array)$result_pa as $row){
      $paciente=$row["paciente"];
      $history=$row["num_historia"];
      $sex=$row["sexo"];
    }
    //obtener datos laboratorio
    $result_la=$obj->consultar("SELECT * from laboratorio WHERE idlab='$idlab'");
      foreach((array)$result_la as $row){
        $ex=$row["examen"];
        $resp=$row["responsable"];
      }
      //obtener asignado de laboratorio
      $result_la=$obj->consultar("SELECT * from usuario WHERE usuario='$resp'");
        foreach((array)$result_la as $row){
            $idRes=$row['idusu'];
          $res=$row["nombres"];
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

  $r_examen=$obj->consultar("SELECT * FROM examen WHERE idlabo='$idlab'");

?>
<!DOCTYPE html>
 <div class="content-wrapper">
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
     <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><b>LABORATORIO</b></h3>
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
                                                <input type="text" class="form-control" required name="noguardar_paciente" readonly="true" value="<?php echo $paciente?>">
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

                                      <div class="col-md-4">
                                                  <div class="form-group">
                                                    <label>Edad:</label>
                                                    <div class="input-group">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-neuter"></i>
                                                      </div>
                                                     <input type="text" class="form-control" name="edad" readonly required value="<?php echo $anios.'años,  '.$meses.'meses,  '.$dias.' '.'dias';?>">
                                                    </div>
                                                    </div>
                                        </div>
                         </div>
                     </div>
                  </div>

<div class="col-md-12">

                <div class="col-md-6">
                  <h4>Datos del Examen</h4>
                  <div class="panel panel-success">
                    <div class="panel-body">

                        <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Examen:</label>
                                          <textarea  class="form-control" name="examen" rows="2" cols="60" placeholder="ej:Electrocardiograma" required readonly> <?php echo "$ex"; ?></textarea>
                                      </div>
                        </div>
                        <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Asignado:</label>
                                      <input type="hidden" name="idmedico" value="<?php echo $idusuario; ?>">
                                      <input type="text" class="form-control" name="responsable" required value="<?php echo "$res"; ?>" readonly>
                                      </div>
                        </div>

                  </div>
                </div>
             </div>

                    <div class="col-md-6">
                      <h4>Fechas</h4>
                      <div class="panel panel-success">
                        <div class="panel-body">

                          <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Fecha de Muestra:</label>
                                          <input type="date" class="form-control" name="f_muestra"  readonly value="<?php echo "$f_muestra"; ?>">
                                    </div>
                          </div>

                          <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Fecha de Entrega:</label>
                                          <input type="date" class="form-control" name="f_entrega" readonly value="<?php echo "$f_entrega"; ?>">
                                    </div>
                          </div>

                         </div>
                       </div>
                    </div>

                    <div class="col-md-12">
                      <h4>RESULTADO DE LABORATORIO</h4>
                      <div class="panel panel-success">
                        <div class="panel-body">

                          <div class="box-body">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr class="tableheader">
                                      <th>ANÁLISIS</th>
                                      <th>RESULTADOS</th>
                                      <th>REFERENCIA</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                              <?php
                                 foreach((array)$r_examen as $row){
                                  ?>
                                  <tr>
                                  <td><?php echo $row['analisis']; ?></td>
                                  <td><?php echo $row['resultado']; ?></td>
                                  <td><?php echo $row['referencia']; ?></td>  </tr>
                              <?php
                              };
                            ?>
                             </tbody>
                          </table>
                        <!-- /.box-body -->
                      </div>

                         </div>
                       </div>
                    </div>

                </div>
                <!-- /.row -->

        <!-- /.box-body -->
        <div class="box-footer">
         <center><button type="submit" name="funcion" value="registrar" class="btn btn-success hide"><i class="fa fa-save"></i> Registrar </button>
             <a href="javascript: history.go(-1)" class="btn btn-success btn-flat"><i class="fa fa-backward"></i> volver atras</a>
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
	       $("#imc").blur(function (e) {
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
