<?php
include("../central/header.php");
// $idpaciente=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idpaciente'],ENT_QUOTES))));
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
                                                <input type="hidden" name="idpaciente" required id="idpaciente">
                                                <input type="text" class="form-control" required name="paciente" id="paciente">
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
                                                    <input type="text" class="form-control" name="sexo" id="sexo" readonly>
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
                                                      <input type="text" class="form-control" name="historia" id="num_historia" required readonly>
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
                                        <input type="hidden" name="" id="anio">
                                        <input type="hidden" name="" id="mes">
                                        <input type="hidden" name="" id="dia">
              <input type="text" class="form-control" name="edad" id="edad" readonly required >
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
                              <select name="idservicio" class='form-control' required>
                                 <?php
                                                     $result_u=$obj->consultar("SELECT * from servicio where idusu='$idusuario'");
                                                     foreach((array)$result_u as $row){
                                                       echo '<option value="'.$row['idservicio'].'" selected>'.$row['descripcion'].'</option>';
                                                   }
                                   ?>
                               </select>
                              </div>
                        </div>
                        <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Asignado:</label>
                                      <input type="hidden" name="usuario_res" id="usuario_res" required>
                                      <input type="text" class="form-control" name="responsable"  id="nombres" required>
                                      </div>
                        </div>

                  </div>
                </div>
             </div>
      </form>
                    <div class="col-md-6">
                      <h4>ACCIONES</h4>
                      <div class="panel panel-success">
                        <div class="panel-body">

                          <div class="col-md-4">
                                 <button type="submit" name="funcion" value="registrar" class="btn btn-success"><i class="fa fa-save"></i> Registrar </button>
                          </div>

                          <div class="col-md-4">
                                 <a href="javascript: history.go(-1)" class="btn btn-success btn-flat"><i class="fa fa-backward"></i> Cancelar</a>
                          </div>

                         </div>
                       </div>
                    </div>
                </div>
                <!-- /.row -->
        <!-- /.box-body -->
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
<script type="text/javascript">
 $(function() {
						 $("#paciente").autocomplete({
								 source: "buscar_paciente.php",
								 minLength: 2,
								 select: function(event, ui) {
									event.preventDefault();
									var idpaciente =$('#idpaciente').val(ui.item.idpaciente);
									$('#paciente').val(ui.item.paciente);
                  $('#sexo').val(ui.item.sexo);
                  $('#num_historia').val(ui.item.num_historia);

                  ///busca la edad del paciente enviando el parametro idpaciente mediante el tipo json y el archivo buscar_edad.php devuelve la edad en el mismo formulario
                            $.ajax({
                              url:"buscar_edad.php",
                              data: idpaciente,
                              type: "GET",
                              dataType: "json",
                              success:
                                function(respuesta)
                                {
                                     $('#anio').val(respuesta.anio);
                                     $('#mes').val(respuesta.mes);
                                     $('#dia').val(respuesta.dia);

                                     var annio = $("#anio").val();
                                     var mees = $("#mes").val();
                                     var diia = $("#dia").val();

                                     var edad = annio+"años "+mees+"meses "+diia+"dias";
                                     $("#edad").val(edad);
                                     //console.log(edad);
                                }
                            });
                  ///
								 }
						 });
		});
 </script>
<script type="text/javascript">
//busqueda de clientes
$(function() {
            $("#nombres").autocomplete({
                source: "buscar_laboratorio.php",
                minLength: 2,
                select: function(event, ui) {
                event.preventDefault();
                   $('#nombres').val(ui.item.nombres);
                   $('#usuario_res').val(ui.item.usuario);
           }
        });
    });
</script>
