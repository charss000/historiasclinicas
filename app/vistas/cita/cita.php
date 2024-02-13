<?php

$this->layout('../plantilla/index',['titulo'=>'CS TINTAY PUNCO - Reserva Cita'])
?>
<?php $this->push('estilos_librerias'); ?>
<link rel="stylesheet" type="text/css" href="/asset/libs/DataTables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="/asset/libs/DataTables/DataTables-1.13.6/css/dataTables.bootstrap5.min.css"/>
<link rel="stylesheet" type="text/css" href="/asset/libs/jquery-ui/jquery-ui.css">
<?php $this->end(); ?>
<?php $this->push('script_librerias1'); ?>
    <script src="/asset/libs/jquery-3.7.1.min.js"></script>
  <script src="/asset/libs/DataTables/datatables.js"></script>
  <script src="/asset/libs/jquery-ui/jquery-ui.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <!-- <script src="/asset/libs/jquery-3.7.1.min.js"></script> 
    <script src="/asset/libs/jquery-ui/jquery-ui.js"></script> 
  <script src="/asset/libs/DataTables/datatables.min.js"></script> -->

<?php $this->end(); ?>
<?php $this->start('contenido'); ?>
<div class="alert alert-success" role="alert">
  Estamos trabajando en esta sección pronto estará listo!
</div>

<div class="container-fluid mt-3">
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <b>RESERVA DE CITAS MÉDICAS : <span class="text-primary"><?php echo $no.'- ESPECIALIDAD:'.' '.$es; ?></span></b>
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="cita/add" method="post"  id="insertar">
                      <div class="row">
                        <div class="col-md-6">
                          <input type="hidden" class="form-control" name="idusu" required value="<?php echo $idusu; ?>" readonly>
                            <div class="mb-3">
                              <label>Paciente:</label>
                              <div class="input-group">
                                    <div class="input-group-text">
                                      <i class="fa fa-wheelchair"></i>
                                   </div>
                                   <input type="hidden" name="idpaciente" id="idpaciente">
                                   <input type="text" class="form-control" name="paciente_noguardar" id="paciente" required placeholder="buscar por apellidos y nombres">
                                 </div>
                               </div>

                              <div class="mb-3">
                               <label>Servicio:</label>
                               <div class="input-group">
                                 <div class="input-group-text">
                                   <i class="fa fa-edit"></i>
                                 </div>
                                 <select name="idservicio" class='form-select' required>
                                    <?php
                                                        foreach($result_u as $row){
                                                          echo '<option value="'.$row['idservicio'].'" selected>'.$row['descripcion'].' - '.$row['precio'].'</option>';
                                                      }
                                      ?>
                                  </select>
                               </div>
                             </div>

                            <div class="mb-3">
                             <label>Hora:</label>
                             <div class="input-group">
                               <div class="input-group-text">
                                 <i class="fa fa-clock"></i>
                               </div>
                               <select name="hora" id="hora" class='form-select'required>
                                    <option value="">Seleccione</option>
                                </select>
                             </div>
                           </div>

                              </div>
                        <div class="col-md-6">

                              <div class="mb-3">
                               <label>N° Historia:</label>
                               <div class="input-group">
                                 <div class="input-group-text">
                                   <i class="fa fa-history"></i>
                                 </div>
                                 <input type="text" class="form-control" name="historia_noguardar" id="num_historia" required readonly>
                               </div>
                             </div>

                            <div class="mb-3">
                             <label>Fecha:</label>
                             <div class="input-group">
                                <input type="date" name="fecha" id="fecha" class="form-control" min="<?php echo "$hoy_v"; ?>" onchange="handler(event);">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-primary btnverhoras"><span class="fa fa-play"></span></button>
                                </span>
                             </div>
                           </div>
                           <input type="hidden" name="idusu" id="idusu" value="<?php echo "$idusu"; ?>">
                           <input type="hidden" name="output" id="output">
                        </div>
                            <!-- /.row -->
                      </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                          <center>
                            <button type="submit" name="funcion" value="registrar" class="btn btn-success"><i class="fa fa-save"></i> Registrar </button><a href="index.php" class="btn btn-default"><i class="fa fa-close"></i> Cancelar </a>
                          </center>
                     <small><b>Fecha y Hora:</b>  <?php echo $hoy; ?></small>
                    </div>
                  </form>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <b>LISTADO DE CITAS</b>
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="tableheader">
                  <th>Paciente</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Imprimir</th>
                  <!-- <th>Editar</th> -->
                  <th>Cancelar</th>
                </tr>
                </thead>
                <tbody>
        <?php foreach($result as $row){
              ?>
              <tr>
              <td><?php echo $row['paciente']; ?></td>
              <td><?php echo $row['fecha']; ?></td>
              <td><?php echo $row['hora']; ?></td>
<td><?php echo "<a href='#' class='btn btn-default' onclick='imprimir_factura(".$row['idcita'].");'><i class='fa fa-print'></i></a>"?></td>
<td><button type="button" name="eliminar" id="<?php echo $row['idcita'];?>" class='btn btn-danger btn-sm btn-icon icon-left eliminar'><i class="fa fa-trash"></i></button></td>
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
  VentanaCentrada('/reportes/ticketCita?idcita='+id_factura,'Factura','','1024','768','true');
  }
 </script>
<script>
document.addEventListener("DOMContentLoaded", function () {
                         $("#paciente").autocomplete({
                                 source: "buscarPaciente",
                                 minLength: 2,
                                 select: function(event, ui) {
                                    event.preventDefault();
                                    $('#idpaciente').val(ui.item.idpaciente);
                                    $('#paciente').val(ui.item.paciente);
                  $('#num_historia').val(ui.item.num_historia);
                                 }
                         });
        });
 </script>

<script type="text/javascript">
function handler(e){
  var input = document.getElementById("fecha").value;
  var date = new Date(input).getUTCDay();
  var weekday = ['7', '1', '2', '3', '4', '5', '6', '7'];
  // var weekday = ['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];
    $('#output').val(weekday[date]);
  //document.getElementById('output').textContent = weekday[date];
}
$('#insertar').on('submit',evt=>{
  evt.preventDefault()

  var formData = new FormData(document.getElementById("insertar"));
  $.ajax({
    url:'/api/'+evt.target.attributes["action"].value,
    type: "post",
    dataType: "json",
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    beforeSend: function() {
      $('.msg').html("<img src='/asset/img/ajax-loader.gif' />");
    },
  }).done(response=>{

    if (response != 'error') {
        Swal.fire({
            title: 'Desea Registrar otro usuario?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Sí',
            denyButtonText: `No'`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                location.reload()
            } else if (result.isDenied) {
                self.location='/cita/'
            }
        })
      }else{
        Swal.fire({
             icon: 'error',
            title: 'Ocurrió un error en el Servidor',
                            showConfirmButton: false,
                            timer: 2000
                        })
      }
  })
  
})
</script>


<script>
$(document).ready(function(){
$(document).on('click', '.btnverhoras', function(){
  var idd = $('#output').val();
  var idu = $('#idusu').val();

    if(idd != '' && idu != '')
    {
      $.ajax({
           url:"verhoras",
           method:"POST",
           data:{idd:idd,idu:idu},
           success:function(data){
             $('#hora').html(data);
           }
      });
    }else{
         alert("POR FAVOR DE LLENAR LOS CAMPOS FALTANTES");
    }
    console.log(idd);
    console.log(idu);
});
});
</script>
<?php $this->stop(); ?>