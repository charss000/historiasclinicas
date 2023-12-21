<?php

$this->layout('../plantilla/index',['titulo'=>'SISCLINICA - Ver Pagos'])
?>
<?php $this->push('estilos_librerias'); ?>
<link rel="stylesheet" type="text/css" href="/asset/libs/DataTables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="/asset/libs/DataTables/DataTables-1.13.6/css/dataTables.bootstrap5.min.css"/>
<?php $this->end(); ?>
<?php $this->push('script_librerias1'); ?>
  <script src="/asset/libs/jquery-3.7.1.min.js"></script> 
  <script src="/asset/libs/DataTables/datatables.min.js"></script>
  <script src="/asset/libs/bootbox/bootbox.all.min.js"></script>

<?php $this->end(); ?>
<?php $this->start('contenido'); ?>

<div class="container-fluid">
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><a href="/paciente/"><i class="fa fa-backward" style="color:black"></i></a>
            <b>PAGOS DE: <?php if(isset($pac)) echo $pac; ?> </b>
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="container">
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
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
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
<?php $this->stop(); ?>