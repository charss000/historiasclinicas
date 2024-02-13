<?php

$this->layout('../plantilla/index',['titulo'=>'CS TINTAY PUNCO - Usuario'])
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

<div class="container-fluid mt-3">
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            USUARIO-MEDICO
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="container">
                <a href="insertar" class="btn btn-success btn-flat"><i class="fa fa-user-plus"></i> Registrar Nuevo usuario-Medico </a>
                <div class="mt-3">
                    <table id="example1" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
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
                            <?php
                            foreach ($datosUsuarios as $fila) {
                                 ?>
                            <tr>
                                <td><?= $fila['nombres'] ?></td>
                                <td><?= $fila['especialidad'] ?></td>
                                <td><?= $fila['email'] ?></td>
                                <td><?= $fila['usuario'] ?></td>
                                <td><?= $fila['estado']=='activo'?'<span class="badge text-bg-success">Activo</span>':'<span class="badge text-bg-danger">Inactivo</span>' ?></td>
                                <td><a href="actualizar?idusu=<?= $fila['idusu'] ?>" class="btn btn-light btn-sm btn-outline-dark"><i class="fa fa-pencil-square"></i> Editar</a></td>
                                <td><?= $fila['tipo']=='usuario'?'<a href="horario?idusu='.$fila['idusu'].'" class="btn btn-light btn-sm btn-outline-dark"><i class="fa fa-calendar"></i> Horarios</a>':'' ?></td>
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
      
    </div>
</div>
<script>
    $(function () {
  $('#example1').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
            paginate: {
                    first:      "Primero",
                    last:       "Último",
                    next:       "Siguiente",
                    previous:   "Anterior"
                },
            search:"Buscar:",
            info: 'Mostrando página _PAGE_ de _PAGES_',
            infoEmpty: 'No records available',
            infoFiltered: '(filtered from _MAX_ total records)',
            lengthMenu: 'mostrar _MENU_ filas por página',
            zeroRecords: 'Nothing found - sorry'
        }
    });
  });
</script>   
<?php $this->stop(); ?>