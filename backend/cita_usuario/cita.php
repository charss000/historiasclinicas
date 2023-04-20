<?php
include("../central/header.php");
$idusu=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idusu'],ENT_QUOTES))));
$idpa=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idpa'],ENT_QUOTES))));

$resultc=$obj->consultar("SELECT * FROM paciente where idpaciente='$idpa'");
    foreach((array)$resultc as $row){
      $paciente_i=$row["paciente"];
      $istoria=$row["num_historia"];
  }
$result=$obj->consultar("SELECT cita.fecha
     , cita.hora
     , paciente.paciente
     , cita.idpaciente
     , cita.idcita
     , usuario.idusu
FROM
  cita
INNER JOIN paciente
ON cita.idpaciente = paciente.idpaciente
INNER JOIN usuario
ON cita.idusuario = usuario.idusu
where usuario.idusu='$idusu'
order by cita.fecha asc");

$data=$obj->consultar("SELECT especialidad.especialidad
     , usuario.nombres
     , usuario.idusu
FROM
  usuario
INNER JOIN especialidad
ON usuario.idespecialidad = especialidad.idespecial WHERE idusu='".$obj->real_escape_string($idusu)."'");
								foreach((array)$data as $row){
                $idusu= $row['idusu'];
                $no= $row['nombres'];
								$es= $row['especialidad'];
		            }

                $resultc=$obj->consultar("SELECT * FROM configuracion");
                		foreach((array)$resultc as $row){
                			$zona=$row["zona_horaria"];
                	}
                	date_default_timezone_set("$zona");
                  $hoy = date("Y-m-d H:i:s");
                  $hoy_v = date("Y-m-d");
                  $anio=date("Y");
?>
<div class="content-wrapper">
<!-- inicio de registro  -->
<section class="content">
 <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"><b>RESERVA DE CITAS MÉDICAS</b></h3>
        <p><?php echo $no.'- ESPECIALIDAD:'.' '.$es; ?></p>
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

                <input type="hidden" class="form-control" name="idusu" required value="<?php echo $idusu; ?>" readonly>

                <div class="form-group">
                 <label>Paciente:</label>
                 <div class="input-group">
                   <div class="input-group-addon">
                     <i class="fa fa-wheelchair"></i>
                   </div>
                   <input type="hidden" name="idpaciente" id="idpaciente" value="<?php echo "$idpa"; ?>">
                   <input type="text" class="form-control" name="paciente_noguardar" id="paciente" required value="<?php echo "$paciente_i"; ?>" readonly>
                 </div>
               </div>

              <div class="form-group">
               <label>Servicio:</label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-edit"></i>
                 </div>
                 <select name="idservicio" class='form-control' required>
                    <?php
                                        $result_u=$obj->consultar("SELECT * from servicio where idusu='$idusu'");
                                        foreach((array)$result_u as $row){
                                          echo '<option value="'.$row['idservicio'].'" selected>'.$row['descripcion'].' - '.$row['precio'].'</option>';
                                      }
                      ?>
                  </select>
               </div>
             </div>

            <div class="form-group">
             <label>Hora:</label>
             <div class="input-group">
               <div class="input-group-addon">
                 <i class="fa fa-clock-o"></i>
               </div>
               <select name="hora" id="hora" class='form-control'required>
                    <option value="">Seleccione</option>
                </select>
             </div>
           </div>

              </div>
            <div class="col-md-6">

              <div class="form-group">
               <label>N° Historia:</label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-history"></i>
                 </div>
                 <input type="text" class="form-control" name="historia_noguardar" id="num_historia" required readonly value="<?php echo "$istoria"; ?>">
               </div>
             </div>

            <div class="form-group">
             <label>Fecha:</label>
             <div class="input-group">
                <input type="date" name="fecha" id="fecha" class="form-control" min="<?php echo "$hoy_v"; ?>" onchange="handler(event);">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-primary btnverhoras"><span class="fa fa-play"></span></button>
                </span>
             </div>
           </div>
           <input type="hidden" name="idusu" id="idusu" value="<?php echo "$idusu"; ?>">
           <input type="hidden" name="output" id="output">
        </div>
            <!-- /.row -->
      </div>
    <!-- /.box-body -->
    <div class="box-footer">
     <center><button type="submit" name="funcion" value="registrar" class="btn btn-success"><i class="fa fa-save"></i> Registrar </button>
         <a href="index.php" class="btn btn-default"><i class="fa fa-close"></i> Cancelar </a></button>
     </center>
     <small><b>Fecha y Hora:</b>  <?php echo $hoy; ?></small>
    </div>
  </form>
  </div>
</section>
<!-- fin de registro -->
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
              <h3 class="box-title"><b>LISTADO DE CITAS</b></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
           </div>

			<div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="tableheader">
                  <th>Paciente</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Imprimir</th>
				          <!-- <th>Editar</th> -->
                  <th>Cancelar</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach((array)$result as $row){
              ?>
							<tr>
              <td><?php echo $row['paciente']; ?></td>
              <td><?php echo $row['fecha']; ?></td>
              <td><?php echo $row['hora']; ?></td>
<td><?php echo "<a href='#' class='btn btn-default' onclick='imprimir_factura(".$row['idcita'].");'><i class='glyphicon glyphicon-print'></i></a>"?></td>
<td><button type="button" name="eliminar" id="<?php echo $row['idcita'];?>" class='btn btn-danger btn-sm btn-icon icon-left eliminar'><i class="fa fa-trash"></i></button></td>
              </tr>
					<?php
					};
				?>
			    </tbody>
            </table>
            <!-- /.box-body -->
          </div>
           </div>
          <!-- /.box -->
        <!-- Main content -->
          </section>
  </div>
<?php include("../central/footer.php"); ?>
<script>
$(document).on('click', '.eliminar', function(){
 var id = $(this).attr("id");
 // var accion = "eliminar";
  bootbox.confirm('Realmente desea Eliminar?', function(result){
    if(result) {
      $.ajax({
       url:"eliminar.php",
       method:"POST",
        data:{id:id},
       success:function(data){
         location.reload(true);
       }
   });
  }
 });
});
  $(function () {
  $('#example1').DataTable({
                        responsive: true,
                        autoWidth: false,
                        "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
                    });
  });
</script>
 <script type="text/javascript">
 function VentanaCentrada(theURL,winName,features, myWidth, myHeight, isCenter) { //v3.0
 	if(window.screen)if(isCenter)if(isCenter=="true"){
 		var myLeft = (screen.width-myWidth)/2;
 		var myTop = (screen.height-myHeight)/2;
 		features+=(features!='')?',':'';
 		features+=',left='+myLeft+',top='+myTop;
 	}
 	window.open(theURL,winName,features+((features!='')?',':'')+'width='+myWidth+',height='+myHeight);
 }
 function imprimir_factura(id_factura){
 	VentanaCentrada('../reportes/ticket_cita.php?idcita='+id_factura,'Factura','','1024','768','true');
  }
 </script>
<script type="text/javascript">
function handler(e){
  var input = document.getElementById("fecha").value;
  var date = new Date(input).getUTCDay();
  var weekday = ['7', '1', '2', '3', '4', '5', '6', '7'];
  // var weekday = ['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];
  	$('#output').val(weekday[date]);
  //document.getElementById('output').textContent = weekday[date];
}
</script>
<script>
$(document).ready(function(){
$(document).on('click', '.btnverhoras', function(){
  var idd = $('#output').val();
  var idu = $('#idusu').val();

    if(idd != '' && idu != '')
    {
      $.ajax({
           url:"verhoras.php",
           method:"POST",
           data:{idd:idd,idu:idu},
           success:function(data){
             $('#hora').html(data);
           }
      });
    }else{
         alert("POR FAVOR DE LLENAR LOS CAMPOS FALTANTES");
    }
    console.log(idd);
    console.log(idu);
});
});
</script>
