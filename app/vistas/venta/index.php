<?php

$this->layout('../plantilla/index',['titulo'=>'SISCLINICA - pagos'])
?>
<?php $this->push('estilos_librerias'); ?>
<link rel="stylesheet" type="text/css" href="/asset/libs/DataTables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="/asset/libs/DataTables/DataTables-1.13.6/css/dataTables.bootstrap5.min.css"/>
<?php $this->end(); ?>
<?php $this->push('script_librerias1'); ?>
  <script src="/asset/libs/jquery-3.7.1.min.js"></script> 
  <script src="/asset/libs/DataTables/datatables.min.js"></script>

<?php $this->end(); ?>

<?php $this->start('contenido'); ?>

<div class="container-fluid">
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <span class="fs-4 fw-bold">Listado de todos los Pagos</span>
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="my-4">
                <table>

                    <tr>
                        <td><b>T.PAGADOS:</b> <?= $m[0]->total ?></td>
                    </tr>
                    <tr>
                        <td><b>T.PENDIENTES:</b> <?= $s[0]->total ?></td>
                    </tr>
                </table>
            </div>
            <table class="table" id="pacientes">
                <thead>
                    <tr>
                        <th>N. Recibo</th>
                        <th>Paciente</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($p as $row){
                      ?>
                    <tr>
                        <td><?= $numdocu=$row['num_docu']; ?></td>
                        <td><?= $row['paciente']; ?></td>
                        <td><?= $row['fecha']; ?></td>
                        <td><?= $row['total']; ?></td>
                        <td><?= ($row['estado']=='pagado')?'<span class="badge text-bg-success">pagado</span>':'<span class="badge text-bg-danger">pendiente</span>' ?></td>
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