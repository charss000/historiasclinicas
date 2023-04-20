<?php
include("../central/header.php");
$result=$obj->consultar("SELECT
  paciente.paciente,
  venta.idventa,
  venta.num_docu,
  venta.total,
  venta.estado,
  venta.fecha
FROM venta
  INNER JOIN paciente
    ON venta.idpaciente_v = paciente.idpaciente");
$result_p=$obj->consultar("SELECT estado,sum(total) as total from venta where estado='pagado'");
     foreach ($result_p as $key) {
            $pagados=$key["total"];
     }
$result_pe=$obj->consultar("SELECT estado,sum(total) as total from venta where estado='pendiente'");
          foreach ($result_pe as $key) {
                 $pendiente=$key["total"];
          }
?>
<div class="content-wrapper">
  <section class="content">
       <div class="box box-primary">
           <div class="box-header with-border">
              <h3 class="box-title"><b>LISTADO DE TODOS LOS PAGOS</b></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
           </div>
            <div class="box-header with-border">
           <table>
             <tr>
               <td><b>T.PAGADOS:</b> <?php echo "$pagados"; ?></td>
             </tr>
             <tr>
               <td><b>T.PENDIENTES:</b> <?php echo "$pendiente"; ?></td>
             </tr>
           </table>
           </div>
           <!-- <div class="box-header">
              	  <a href="insertar.php" class="btn btn-success btn-flat"><i class="fa fa-shopping-cart"></i> Registrar</a>
           </div> -->
			<div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="tableheader">
                  <th>N. Recibo</th>
                  <th>Paciente</th>
                  <th>Fecha</th>
                  <th>Total</th>
                  <th>Estado</th>
				          <!-- <th>Estado</th> -->
                  <!-- <th>Acciones</th> -->
                  <!-- <th>Imprimir</th> -->
                </tr>
                </thead>
                <tbody>
				<?php foreach((array)$result as $row){?>
							<tr>
              <td><?php echo $numdocu=$row['num_docu']; ?></td>
              <td><?php echo $row['paciente']; ?></td>
              <td><?php echo $row['fecha']; ?></td>
              <td><?php echo $row['total']; ?></td>
              <td><?php
              if ($row['estado']=='pagado') {
                echo '<span class="label label-success">pagado</span>';
              } else {
                echo '<span class="label label-danger">pendiente</span>';
              }
              ?></td>
<!-- <td>
<?php echo "<a href='cancelarventa.php?idventa=".$row['idventa']."' class='btn btn-danger btn-sm btn-icon icon-left fa fa-close' title='cancelar'> " ?>
</td> -->
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
  $(function () {
  $('#example1').DataTable({
                        responsive: true,
                        autoWidth: false,
                        "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
                    });
  });
</script>
