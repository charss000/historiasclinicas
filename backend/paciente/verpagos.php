<?php
include("../central/header.php");
$idpaciente=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idpaciente'],ENT_QUOTES))));
$result=$obj->consultar("SELECT
  venta.fecha,
  venta.estado,
  paciente.idpaciente,
  paciente.paciente,
  venta.total,
  venta.num_docu,
  venta.idventa
FROM venta
  INNER JOIN paciente
    ON venta.idpaciente_v = paciente.idpaciente
      where idpaciente='$idpaciente'");
      foreach((array)$result as $row){
        $pac=$row['paciente']??'NO ENCONTRADO';
      }
?>
<div class="content-wrapper">
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
              <h3 class="box-title"> <a href="index.php"><i class="fa fa-backward" style="color:black"></i></a><b>   PAGOS DE: <?php if(isset($pac)) echo $pac; ?> </b></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
           </div>
			<div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="tableheader">
                  <th>N° Recibo</th>
                  <th>Fecha</th>
                  <th>Concepto</th>
                  <th>Total</th>
                  <th>Estado</th>
                  <th>Imprimir</th>
                  </tr>
                 </thead>
                <tbody>
				<?php foreach((array)$result as $row){
              ?>
							<tr>
							<td><?php
              $idventa=$row['idventa'];
              echo $row['num_docu'];
              ?></td>
              <td><?php echo $row['fecha']; ?></td>
							<td><?php
              $result_d=$obj->consultar("SELECT
                servicio.descripcion,
                detalleventa.idventa
              FROM detalleventa
                INNER JOIN servicio
                  ON detalleventa.idservicio_v = servicio.idservicio
                    where detalleventa.idventa='$idventa'");
              foreach((array)$result_d as $ra){
                      $des=$ra['descripcion'];
                      //$name_explode = explode(" , ",$ra['descripcion']);
                      // echo " ".$name_explode."<br>";
                       //echo "<pre>";
                       //print_r($name_explode);
                       //echo json_encode($name_explode);
                      // print($name_explode);
                       //echo "</pre>";
                          echo "<pre>";
                          echo " ".$des."<br>";
                          echo "</pre>";
              }
              ?></td>
              	<td><?php echo $row['total']; ?></td>
                <td><?php
                if ($row['estado']=='pagado') {
                    echo '<span class="label label-success">pagado</span>';
                } else {
                  echo "<input type='button' name='estado' id='".$row['idventa']."' class='btn btn-danger btn-sm estado' value='pendiente' />";
                }
                ?></td>
                <td><?php echo "<a href='#' class='btn btn-default' onclick='imprimir_factura(".$row['idventa'].");'><i class='glyphicon glyphicon-print'></i></a>"?></td>
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
$(document).on('click', '.estado', function(){
 var id = $(this).attr("id");
 // var accion = "eliminar";
  bootbox.confirm('Realmente desea Pagar?', function(result){
    if(result) {
      $.ajax({
       url:"actualizar_estado.php",
       method:"POST",
        data:{id:id},
       success:function(data){
         location.reload(true);
       }
   });
  }
 });
});
</script>
<script>
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
	VentanaCentrada('../reportes/recibo.php?idventa='+id_factura,'Factura','','1024','768','true');
 }
</script>
