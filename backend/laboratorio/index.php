<?php
include("../central/header.php");
$result=$obj->consultar("SELECT tipo,nombres,usuario,idusu from usuario WHERE usuario='$usuario'");
  foreach((array)$result as $row){
    $idusuario=$row["idusu"];
    $nom_usu=$row["nombres"];
  }
  $resul_doc=$obj->consultar("SELECT
  paciente.paciente,
  laboratorio.fecha,
  laboratorio.idlab,
  laboratorio.idpaciente,
  laboratorio.examen,
  laboratorio.idusuario,
  laboratorio.idventa
FROM laboratorio
  INNER JOIN paciente
    ON laboratorio.idpaciente = paciente.idpaciente
    WHERE laboratorio.idusuario='$idusuario'
    ORDER BY laboratorio.idlab DESC");
?>
<div class="content-wrapper">
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
              <h3 class="box-title"><b>LABORATORIO</b></h3>
              <?php
              if ($tipo=='usuario') {
                echo "<p>Examenes medicos de los pacientes</p>";
              }
               ?>
               <div class="box-header">
                     <a href="insertar.php" class="btn btn-success btn-flat"><i class="fa fa-file"></i> Registrar</a>
               </div>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
           </div>
           <!-- <div class="box-header">
              	  <a href="insertar.php" class="btn btn-success btn-flat"><i class="fa fa-history"></i> Registrar Historia</a>
           </div> -->
			<div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="tableheader">
                  <th>Paciente</th>
                  <th>Examen</th>
                  <th>Pago</th>
                  <th>Ver resultados</th>
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
                  <?php $idventa=$row['idventa']; ?>
                  <td>
                      <?php
                      $result_d=$obj->consultar("SELECT idventa,estado FROM venta WHERE idventa='$idventa'");

                    foreach((array)$result_d as $ra){
                      if ($ra['estado']=='pendiente') {
                          echo '<span class="label label-danger">pendiente</span>';
                      } else {
                          echo '<span class="label label-success">pagado</span>';
                      }
                    }
                   ?>
                 </td>
                 <td><?php
                 
    if (isset($ra) && $ra['estado']=='pendiente') {
        echo '';
    } else {

      echo "<a href='ver_examenes.php?idlab=".$row['idlab']."' class='btn btn-default btn-sm btn-icon icon-left' title='historial del paciente'><i class='fa fa-eye'></i>";
    }
    ?>
    </td>
    <td><?php
    if (isset($ra) && $ra['estado']=='pendiente') {
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
