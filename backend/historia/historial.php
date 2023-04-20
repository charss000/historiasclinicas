<?php
include("../central/header.php");
$result=$obj->consultar("SELECT paciente.paciente
     , cita.idcita
     , cita.estado
     , cita.fecha
     , cita.hora
     , usuario.usuario
     , usuario.idusu
     , paciente.idpaciente
FROM
  cita
INNER JOIN paciente
ON cita.idpaciente = paciente.idpaciente
INNER JOIN usuario
ON cita.idusuario = usuario.idusu
WHERE
  usuario = '$usuario'
  ");
?>
<div class="content-wrapper">
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
              <h3 class="box-title"><b>HISTORIAL MEDICO DE PACIENTES</b></h3>
              <p>Historial medico de pacientes atendidos en otras especialidades</p>
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
                  <th>Historial</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach((array)$result as $row){
              ?>
							<tr>
							<td><?php echo $row['paciente']; ?></td>
  <td><?php echo "<a href='historias_paciente.php?idpaciente=".$row['idpaciente']."&idusua=".$row['idusu']."' class='btn btn-success btn-sm btn-icon icon-left' title='historial del paciente'>"?><i class="fa fa-history"></i> </td>
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
