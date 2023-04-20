<?php
include("../central/header.php");
$resul_doc=$obj->consultar("SELECT
  laboratorio.idlab,
  laboratorio.responsable,
  laboratorio.examen,
  laboratorio.idventa,
  paciente.paciente
FROM laboratorio
  INNER JOIN paciente
    ON laboratorio.idpaciente = paciente.idpaciente
    WHERE laboratorio.responsable='$usuario'
    ORDER BY laboratorio.idlab DESC");
?>
<div class="content-wrapper">
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
              <h3 class="box-title"><b>EXAMENES DE PACIENTES</b></h3>
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
                  <th>Examen</th>
                  <th>Fecha M.E</th>
                  <th>Registrar</th>
                  <th>Imprimir</th>
                </tr>
                </thead>
                <tbody>
			  	<?php
             foreach((array)$resul_doc as $row){
              ?>
							<tr>
							<td><?php echo $row['paciente']; ?></td>
              <td><?php echo $row['examen']; ?></td>
              <?php
              $idventa=$row['idventa'];
              $result_d=$obj->consultar("SELECT idventa,estado FROM venta WHERE idventa='$idventa'");
              foreach((array)$result_d as $ra){
                $estado=$ra['estado'];
              }
              ?>
          <td><?php
          if ($estado=='pendiente') {
              echo '';
          } else {
            echo "<a href='actualizarfecha.php?idlab=".$row['idlab']."' class='btn btn-default btn-sm btn-icon' title='registrar fecha de entrega'><i class='fa fa-calendar'></i>";
          }
          ?>
         </td>
           <td>
          <?php
          if ($estado=='pendiente') {
              echo '';
          } else {
            echo "<a href='insertar.php?idlab=".$row['idlab']."' class='btn btn-default btn-sm btn-icon' title='registrar examenes'><i class='fa fa-save'></i>";
          }
          ?>
           </td>
        <td>
          <?php
          if ($estado=='pendiente') {
              echo '';
          } else {
            echo "<a href='#' class='btn btn-default' onclick='imprimir_factura(".$row['idlab'].");'><i class='glyphicon glyphicon-print'></i></a>";
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
 VentanaCentrada('../reportes/rpt_laboratorio.php?idlab='+id_factura,'Factura','','1024','768','true');
 }
</script>
