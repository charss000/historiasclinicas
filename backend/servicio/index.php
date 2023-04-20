<?php
include("../central/header.php");
$result=$obj->consultar("SELECT * from servicio");
?>
<div class="content-wrapper">
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
              <h3 class="box-title"><b>SERVICIO-PRODUCTO-LABORATORIO</b></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
           </div>
           <div class="box-header">
              	  <a href="insertar.php" class="btn btn-success btn-flat"><i class="fa fa-edit"></i> Registrar </a>
           </div>
			<div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="tableheader">
                  <th>Descripcion</th>
                  <th>U.M</th>
                  <th>Precio</th>
				          <th>Editar</th>
                  <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach((array)$result as $row){
              ?>
							<tr>
							<td><?php echo $row['descripcion']; ?></td>
              <td><?php echo $row['um']; ?></td>
              <td><?php echo $row['precio']; ?></td>
<td><?php echo "<a href='actualizar.php?idservicio=".$row['idservicio']."' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o"></i> Editar</td>
<td><button type="button" name="eliminar" id="<?php echo $row['idservicio'];?>" class='btn btn-danger btn-sm btn-icon icon-left eliminar'><i class="fa fa-trash"></i> Eliminar</button></td>
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
