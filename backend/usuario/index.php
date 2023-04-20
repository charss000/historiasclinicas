<?php
include("../central/header.php");
$result=$obj->consultar("SELECT usuario.*
     , especialidad.especialidad
FROM
  usuario
INNER JOIN especialidad
ON usuario.idespecialidad = especialidad.idespecial");
?>
<div class="content-wrapper">
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
              <h3 class="box-title"><b>USUARIO-MEDICO</b></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
           </div>
           <div class="box-header">
              	  <a href="insertar.php" class="btn btn-success btn-flat"><i class="fa fa-user-plus"></i> Registrar Nuevo usuario-Medico </a>
           </div>
			<div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="tableheader">
                  <th>Apellidos y Nombres</th>
                  <th>Especialidad</th>
                  <th>E-Mail</th>
                  <th>Usuario</th>
                  <th>Estado</th>
				          <th>Editar</th>
                  <th>Horarios</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach((array)$result as $row){
              if ($row['estado']=='activo'){
               $estado="<span class='label label-success'>Activo</span>";
              }else{
               $estado="<span class='label label-danger'>Inactivo</span>";
              }
              ?>
							<tr>
              <td><?php echo $row['nombres']; ?></td>
							<td><?php echo $row['especialidad']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['usuario']; ?></td>
          		<td><?php echo $estado;?></td>
							<td><?php echo "<a href='actualizar.php?idusu=".$row['idusu']."' class='btn btn-default btn-sm'>"?><i class="fa fa-pencil-square-o"></i> Editar</td>
							<td>
              <?php
               if ($row['tipo']=='administrador'){
                echo "";
               }elseif ($row['tipo']=='laboratorio'){
                 echo "";
               }else {
                 echo "<a href='horario.php?idusu=".$row['idusu']."' class='btn btn-default btn-sm'><i class='fa fa-calendar'></i> Horarios";
               }
              ?> </td>
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
// $(document).on('click', '.eliminar', function(){
//  var id = $(this).attr("id");
//  // var accion = "eliminar";
//   bootbox.confirm('Realmente desea Eliminar?', function(result){
//     if(result) {
//       $.ajax({
//        url:"eliminar.php",
//        method:"POST",
//        data:{id:id, accion:'eliminar'},
//        success:function(data){
//          location.reload(true);
//        }
//    });
//   }
//  });
// });
  $(function () {
  $('#example1').DataTable({
                        responsive: true,
                        autoWidth: false
                    });
  });
</script>
