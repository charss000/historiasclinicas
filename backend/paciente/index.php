<?php
include("../central/header.php");
$result=$obj->consultar("SELECT idpaciente,paciente,sexo,documento_pa,fec_nacimiento,sis from paciente");
?>
<div class="content-wrapper">
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
              <h3 class="box-title"><b>PACIENTE</b></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
           </div>
           <div class="box-header">
              	  <a href="insertar.php" class="btn btn-success btn-flat"><i class="fa fa-wheelchair"></i> Registrar Nuevo Paciente </a>
           </div>
			<div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="tableheader">
                  <th>Apellidos y Nombres</th>
                  <th>Sexo</th>
                  <th>N.Documento</th>
                  <th>Fec.Nacimiento</th>
                  <th>Pagar</th>
                  <th>Afiliado Al SIS</th>
                  <th>Ver Pagos</th>
				          <th>Editar</th>
                  <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach((array)$result as $row){
              ?>
							<tr>
							<td><?php echo $row['paciente']; ?></td>
              <td><?php echo $row['sexo']; ?></td>
							<td><?php echo $row['documento_pa']; ?></td>
							<td><?php echo $row['fec_nacimiento']; ?></td>
<td><?php echo "<a href='../venta/insertar.php?idpaciente=".$row['idpaciente']."' class='btn btn-success btn-sm'  title='Pagar por un nuevo servicio'>"?><i class="fa fa-shopping-cart"></i></td>
<td><?php echo $row['sis']?'Sí':'No' ?></td>
<td><?php echo "<a href='verpagos.php?idpaciente=".$row['idpaciente']."' class='btn btn-success btn-sm'>"?><i class="fa fa-money"></i></td>
<td><?php echo "<a href='actualizar.php?idpaciente=".$row['idpaciente']."' class='btn btn-default btn-sm'>"?><i class="fa fa-pencil-square-o"></i></td>
<td><button type="button" name="eliminar" id="<?php echo $row['idpaciente'];?>" class='btn btn-danger btn-sm btn-icon icon-left eliminar'><i class="fa fa-trash"></i></button></td>
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
