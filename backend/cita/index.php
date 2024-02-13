<?php
include("../central/header.php");
$result=$obj->consultar("SELECT especialidad.especialidad
     , usuario.nombres
     , usuario.tipo
     , usuario.idusu
FROM
  usuario
INNER JOIN especialidad
ON usuario.idespecialidad = especialidad.idespecial where tipo<>'administrador' and tipo<>'laboratorio' AND estado = 'activo'");
?>
<div class="content-wrapper">
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
              <h3 class="box-title"><b>MEDICO CITA</b></h3>
              <p>Reserva de citas a los distintos medicos de cada especialidad</p>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
           </div>

			<div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="tableheader">
                  <th>Medico</th>
                  <th>Especialidad</th>
				          <th>Reservar Cita</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach((array)$result as $row){
              ?>
							<tr>
							<td><?php echo $row['nombres']; ?></td>
              <td><?php echo $row['especialidad']; ?></td>
<td><?php echo "<a href='cita.php?idusu=".$row['idusu']."' class='btn btn-success btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o"></i> cita</td>
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
  <!-- cambiar cupo por orden de llegada y eso sera no editable autoincrementable 1.2.3 segun los pacientes que se van registrando -->
<?php include("../central/footer.php"); ?>
<script>
  $(function () {
  $('#example1').DataTable({
                        responsive: true,
                        autoWidth: false,
                        "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
                    });
  });
</script>
