<?php
include("../central/header.php");
include_once("../conexion/clsConexion.php");
$objcliente=new clsConexion;
$idlab=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idlab'],ENT_QUOTES))));
$resultc=$obj->consultar("SELECT * FROM configuracion");
          foreach((array)$resultc as $row){
                $zona=$row["zona_horaria"];
          	}
date_default_timezone_set("$zona");
$hoy = date("Y-m-d H:i:s");
//busqueda de pacientes
$resultpa=$obj->consultar("SELECT
  laboratorio.idlab,
  laboratorio.responsable,
  laboratorio.examen,
  paciente.paciente
  FROM laboratorio
  INNER JOIN paciente
  ON laboratorio.idpaciente = paciente.idpaciente
  WHERE laboratorio.idlab='$idlab'");
          foreach((array)$resultpa as $row){
                $pa=$row["paciente"];
                $examen=$row["examen"];
          	}
//lista de examenes
$result=$obj->consultar("SELECT * FROM examen WHERE idlabo='$idlab'");
?>
<div class="content-wrapper">
<!-- inicio de registro  -->
<section class="content">
 <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"><b>REGISTRO DE EXAMENES: <?php echo "$examen"; ?></b></h3>
        <p>PACIENTE: <?php echo $pa; ?></p>
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
                 <label>Análisis:</label>
                 <div class="input-group">
                   <div class="input-group-addon">
                     <i class="fa fa-edit"></i>
                   </div>
                   <input type="hidden" name="idlab" value="<?php echo "$idlab"; ?>">
                   <input type="text" class="form-control" name="analisis" required>
                 </div>
               </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                 <label>Resultado:</label>
                 <div class="input-group">
                   <div class="input-group-addon">
                     <i class="fa fa-edit"></i>
                   </div>
                   <input type="text" class="form-control" name="resultado" required>
                 </div>
               </div>
              </div>

            <div class="col-md-6">
              <div class="form-group">
               <label>Referencia:</label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-edit"></i>
                 </div>
                 <input type="text" class="form-control" name="referencia" required>
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
<!-- fin de registro -->
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
              <h3 class="box-title"><b>LISTADO DE EXAMENES</b></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
           </div>

			<div class="box-body">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="tableheader">
                  <th>Análisis</th>
                  <th>Resultado</th>
                  <th>Referencia</th>
                  <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach((array)$result as $row){
              ?>
							<tr>
              <td><?php echo $row['analisis']; ?></td>
              <td><?php echo $row['resultado']; ?></td>
              <td><?php echo $row['referencia']; ?></td>
<td><button type="button" name="eliminar" id="<?php echo $row['idexamen'];?>" class='btn btn-danger btn-sm btn-icon icon-left eliminar'><i class="fa fa-trash"></i></button></td>
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
