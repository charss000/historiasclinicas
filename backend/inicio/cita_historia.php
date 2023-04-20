<?php
include("../central/header.php");
$fecha=$_GET['date'];
$result=$obj->consultar("SELECT paciente.paciente
     , cita.idcita
     , cita.idventa
     , cita.estado
     , cita.fecha
     , cita.hora
     -- , DATE_FORMAT(cita.fecha_hora, '%Y-%m-%d') AS fechasinminuto
     , usuario.usuario
     , paciente.idpaciente
FROM
  cita
INNER JOIN paciente
ON cita.idpaciente = paciente.idpaciente
INNER JOIN usuario
ON cita.idusuario = usuario.idusu
WHERE
  usuario = '$usuario' and fecha='$fecha'
order by hora asc
  ");
?>
<div class="content-wrapper">
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
              <h3 class="box-title"><b>CONTROL DE ATENCIONES</b></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
           </div>
			<div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="tableheader">
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Paciente</th>
                  <th>Atender</th>
                  <th>Estado</th>
                  <!-- <th>Imprimir</th>
                  <th>Eliminar</th> -->
                </tr>
                </thead>
                <tbody>
				<?php foreach((array)$result as $row){
              ?>
							<tr>
							<td><?php echo $row['fecha']; ?></td>
              <td><?php echo $row['hora']; ?></td>
              <td><?php echo $row['paciente']; ?></td>
              <?php
              $idventa=$row['idventa'];
              $result_d=$obj->consultar("SELECT idventa,estado FROM venta WHERE idventa='$idventa'");
              foreach((array)$result_d as $ra){
                $estadoventa=$ra['estado'];
              }
              ?>
              <td>
              <?php
              if ($row['estado']=='enespera' && $estadoventa=='pagado') {
                echo "<a href='../historia/insertar.php?idpaciente=".$row['idpaciente']."&idcita=".$row['idcita']."' class='btn btn-default btn-sm btn-icon icon-left'><i class='fa fa-heartbeat'></i>";
              }elseif ($row['estado']=='atendido') {
                echo "atendido";
              }elseif ($estadoventa=='pendiente') {
                echo "";
              }
              ?>
              </td>
              <td><?php
              if ($row['estado']=='enespera') {
                  echo "<span class='label label-info'>En Espera</span>";
              } else {
                echo "<span class='label label-success'>Atendido</span>";
              }
              ?>
             </td>
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
