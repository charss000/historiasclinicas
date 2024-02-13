<?php

$this->layout('../plantilla/index',['titulo'=>'CS TINTAY PUNCO - historial'])
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
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <span class="fs-4 fw-bold">Historias<br><span class="fs-6 fst-normal"><?= $st ?></span></span>
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <table class="table" id="pacientes">
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Historias</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($p as $row){
                      ?>
                    <tr>
                        <td><?php echo $row['paciente']; ?></td>
                        <td><?php echo "<a href='historias_paciente.php?idpaciente=".$row['idpaciente']."' class='btn btn-success btn-sm btn-icon icon-left' title='historial del paciente'>"?><i class="fa fa-history"></i> </td>
                    </tr>
                    <?php
                    }
                ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
      
    </div>
</div>
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
  $('#pacientes').DataTable({
        responsive: true,
        autoWidth: false,
        order: [[ 0, "desc" ]], //Ordenar (columna,orden)
        language: {
            paginate: {
                    first:      "Primero",
                    last:       "Último",
                    next:       "Siguiente",
                    previous:   "Anterior"
                },
            search:"Buscar:",
            info: 'Mostrando página _PAGE_ de _PAGES_',
            infoEmpty: 'No se encontraron Registros de Historias',
            infoFiltered: '(filtered from _MAX_ total records)',
            lengthMenu: 'mostrar _MENU_ filas por página',
            zeroRecords: 'No hay registro que mostrar'
        }
    });
  });
</script>
<?php $this->stop(); ?>