<?php  $this->layout('../plantilla/index',['titulo'=>'CS TINTAY PUNCO - Pagos']) ?>
<?php $this->push('estilos_librerias'); ?>
<link rel="stylesheet" type="text/css" href="/asset/libs/DataTables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="/asset/libs/DataTables/DataTables-1.13.6/css/dataTables.bootstrap5.min.css"/>
<?php $this->end(); ?>
<?php $this->push('script_librerias1'); ?>
  <script src="/asset/libs/jquery-3.7.1.min.js"></script> 
  <script src="/asset/libs/DataTables/datatables.min.js"></script>
  <script src="/asset/libs/jquery-ui/jquery-ui.js"></script>
  <script src="/asset/libs/AdminLTE-3.2.0/dist/js/adminlte.js"></script>

<?php $this->end(); ?>
<?php $this->start('contenido'); ?>

<div class="container-fluid mt-3">
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><a href="/paciente/"><i class="fa fa-backward" style="color:black"></i></a>
            <b>PAGOS</b>
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="container">
                <h4>PRODUCTOS/SERVICIOS:</h4>
                <form name="barcode" id="barcode_form">
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name=descripcion id="descripcion" placeholder="buscar por descripcion">
                            <input type="hidden" class="form-control" name="idservicio"  readonly id="idservicio">
                            <div class="input-group-text">
                                <button type="submit" class="btn btn-default"><span class="fa fa-plus-square"></span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="container mt-3">
                <form action="guardarventa.php" method="post">
                    <div class="col-md-12">
                        <h4>Datos Principales</h4>
                        <div class="card">
                            <div class="card-body">
                                 <div class="row justify-content-start">
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="fw-bold">FECHA:</label>
                                            <input type="text" class="form-control" name="fecha" required readonly value="<?php echo (date('Y-m-d'));?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="fw-bold">SERIE:</label>
                                             <input type="text" class="form-control" name="serie" required readonly value="<?php echo "001"; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="fw-bold">N.RECIBO:</label>
                                            <input type="text" class="form-control" name="num_docu" required readonly value="<?php echo "$recibo"; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="fw-bold">PACIENTE:</label>
                                            <input type="text" class="form-control" name=paciente required  id="paciente" placeholder="Ingrese los dos primeros digitos del apellido" value="<?php echo "$paciente"; ?>" readonly>
                                            <input type="hidden" class="form-control" name="idpaciente" required id="idpaciente" readonly value="<?php echo "$idpaciente"; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="fw-bold">OBSERVACIONES:</label>
                                            <textarea name="obs" id="obs" class="form-control" placeholder="ingrese aqui sus observaciones"></textarea>
                                        </div>
                                    </div>

                                        <!-- <div class="col-md-3">
                                                                <div class="mb-3">
                                                                  <label class="fw-bold">Cargo:</label>
                                                                  <input type="text" class="form-control" name="cargo" id="cargo" required readonly value="<?php echo "$recibo"; ?>">
                                                                </div>
                                            </div> -->


                                    <div class="col-md-2">
                                        <label class="fw-bold">Impuesto (%):</label>
                                        <div class="input-group margin">
                                            <div class="input-group-text">
                                                <input type="checkbox" id="checkboxigv" name="checkboxigv" class="icheckbox_minimal-green"/>
                                                <input type="hidden" name="igv" id="igv" value="<?php echo "$impuesto"; ?>">
                                            </div>
                                            <input type="text" class="form-control" name="txtigv" id="txtigv" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <h4>Acciones</h4>
                            <div class="panel panel-success">
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        <div class="box-body">
                                            <!-- <button type="button" onClick="location.href='limpiar.php'"><a class="btn btn-app"><i class="fa fa-repeat"></i> Nuevo</a></button> -->
                                            <button type="submit"><a class="btn btn-app"><i class="fa fa-save"></i> Guardar </a></button>
                                        </div>
                                 <!-- /.box-body -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <h4>Productos/Servicios</h4>
                            <div class="panel panel-success">
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <div id="live_data"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
       <!-- fin div carrito de compras -->
                    </div>
                             <!-- /.row -->
             <!-- /.box-body -->
                </form>

            </div>
          </div>
        </div>
      </div>
    </div>
</div>


<script>
$(document).ready(function(){
//inicializa en 0 el impuesto
$("#txtigv").val(0);
      function fetch_data()
      {
                var txtigv = $('#txtigv').val();
           $.ajax({
                url:"/api/venta/consultacarrito",
                method:"GET",
                                data:{txtigv:txtigv},
                                dataType:"text",
                success:function(data){
                     $('#live_data').html(data);
                                         console.log(txtigv);
                }
           });
      }
      fetch_data();
            //mostrar impuesto segun igv
        var igv = $('#igv').val();
        //si el checked esta marcado muestra el igv
         $('#checkboxigv').click(function() {
             if ($(this).is(':checked')) {
                     $("#txtigv").val(igv);
                     fetch_data();
             }
             //en caso contrario evalua el impuesto en 0
             else {
                     $("#txtigv").val("0");
                     fetch_data();
             }
        });

            // guardar mediante el teclado enter
      $(document).on('submit', '#barcode_form', function(event){
                    event.preventDefault();
                        var idservicio = $('#idservicio').val();
           $.ajax({
                url:"guardarcarrito.php",
                method:"POST",
                data:{idservicio:idservicio},
                dataType:"text",
                     success:function(data){
                        //alertify.alert('Agregar',data);
                        fetch_data();
                        limpiarcarrito();
                     }
           })
      });

            function limpiarcarrito()
            {
                 $('#descripcion').val('');
                 $('#descripcion').focus();
            }
      $(document).on('click', '.btn_delete', function(){
           var id=$(this).data("id3");
                $.ajax({
                     url:"eliminarcarrito.php",
                     method:"POST",
                     data:{id:id},
                     dataType:"text",
                     success:function(data){
                        fetch_data();
                     }
                });
      });
 });
</script>
<script type="text/javascript">
 $(function() {
                         $("#descripcion").autocomplete({
                                 source: "buscar_producto.php",
                                 minLength: 2,
                                 select: function(event, ui) {
                                    event.preventDefault();
                                    $('#idservicio').val(ui.item.idservicio);
                                    $('#descripcion').val(ui.item.descripcion);
                                 }
                         });
        });
 </script>
 <script type="text/javascript">
 //iCheck for checkbox and radio inputs
 $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
     checkboxClass: 'icheckbox_minimal-blue',
     radioClass   : 'iradio_minimal-blue'
 })
 //Red color scheme for iCheck
 $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
     checkboxClass: 'icheckbox_minimal-red',
     radioClass   : 'iradio_minimal-red'
 })
 //Flat red color scheme for iCheck
 $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
     checkboxClass: 'icheckbox_flat-green',
     radioClass   : 'iradio_flat-green'
 })
 </script>

<?php $this->stop(); ?>