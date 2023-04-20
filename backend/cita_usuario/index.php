<?php
include("../central/header.php");
$result=$obj->consultar("SELECT nombres,usuario,idusu from usuario WHERE usuario='$usuario'");
  foreach((array)$result as $row){
    $idusuario=$row["idusu"];
  }
$result=$obj->consultar("SELECT historia.fecha
     , paciente.paciente
     , paciente.idpaciente
     , historia.motivo
     , historia.examen_fisico
     , historia.diagnostico
     , historia.tratamiento
     , historia.idusuario
FROM
  historia
INNER JOIN paciente
ON historia.idpaciente = paciente.idpaciente
WHERE historia.idusuario='$idusuario';
");
?>
<div class="content-wrapper">
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
              <h3 class="box-title"><b>PROXIMAS CITAS</b></h3>
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
				          <th>Proxima Cita</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach((array)$result as $row){
              ?>
							<tr>
							<td><?php echo $row['paciente']; ?></td>
<td><?php echo "<a href='cita.php?idusu=".$row['idusuario']."&idpa=".$row['idpaciente']."' class='btn btn-success btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o"></i> citar</td>
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
