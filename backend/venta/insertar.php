<?php
include("../central/header.php");
include_once("../conexion/clsConexion.php");
$idpaciente=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idpaciente'],ENT_QUOTES))));
$obj=new clsConexion;
// $anio=date("y");
$resultc=$obj->consultar("SELECT * FROM configuracion");
		foreach((array)$resultc as $row){
			$zona=$row["zona_horaria"];
			$impuesto=$row['imp_num'];
	}
//buscar paciente
$result_p=$obj->consultar("SELECT * FROM paciente where idpaciente='$idpaciente'");
		foreach((array)$result_p as $row){
			$paciente=$row["paciente"];
	}
	date_default_timezone_set("$zona");

$resultw=$obj->consultar("SELECT MAX(num_docu) as numero from venta");
	foreach($resultw as $row){
	     if($row['numero']==NULL){
				$recibo='00000001';
			}else{;
				$ultimo=$row['numero']+1;
				$recibo=str_pad((int) $ultimo,8,"0",STR_PAD_LEFT);
			}
	}
?>
<!DOCTYPE html>
<div class="content-wrapper">
	 <section class="content">
		 <!-- SELECT2 EXAMPLE -->
		<div class="box box-success">
			 <div class="box-header with-border">
				 <h3 class="box-title"> <a href="../paciente/index.php"><i class="fa fa-backward" style="color:black"></i></a><b>  PAGOS </b></h3>
				 <div class="box-tools pull-right">
					 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					 <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
				 </div>
			 </div>
			 <!-- /.box-header -->
			 <div class="box-body">
				 <div class="col-md-12">
					  <h4>PRODUCTOS/SERVICIOS:</h4>
						 <form name="barcode" id="barcode_form">
												<div class="form-group">
													<div class="input-group">
														<input type="text" class="form-control" name=descripcion id="descripcion" placeholder="buscar por descripcion">
													 <input type="hidden" class="form-control" name="idservicio"  readonly id="idservicio">
															 <div class="input-group-btn">
																 <button type="submit" class="btn btn-default"><span class="fa fa-plus-square"></span></button>
															 </div>
													</div>
													</div>
							 </form>
					 </div>
			  <form action="guardarventa.php" method="post">
							 <div class="col-md-12">
										 <h4>Datos Principales</h4>
										 <div class="panel panel-success">
											 <div class="panel-body">
                         <div class="row justify-content-around">
														 <div class="col-md-2">
																				 <div class="form-group">
																					 <label>FECHA:</label>
																					    <input type="text" class="form-control" name="fecha" required readonly value="<?php echo (date('Y-m-d'));?>">
																					 </div>
															 </div>

															 <div class="col-md-3">
																					 <div class="form-group">
																						 <label>SERIE:</label>
																							 <input type="text" class="form-control" name="serie" required readonly value="<?php echo "001"; ?>">
																						 </div>
																 </div>

																 <div class="col-md-3">
																						 <div class="form-group">
																							 <label>N.RECIBO:</label>
																								 <input type="text" class="form-control" name="num_docu" required readonly value="<?php echo "$recibo"; ?>">
																							 </div>
																	 </div>

																	 <div class="col-md-4">
																							 <div class="form-group">
																								  <label>PACIENTE:</label>
								<input type="text" class="form-control" name=paciente required  id="paciente" placeholder="Ingrese los dos primeros digitos del apellido" value="<?php echo "$paciente"; ?>" readonly>
							  <input type="hidden" class="form-control" name="idpaciente" required id="idpaciente" readonly value="<?php echo "$idpaciente"; ?>">
																								 </div>
																		 </div>

																			 <div class="col-md-4">
																									 <div class="form-group">
																										 		 <label>OBSERVACIONES:</label>
																											 <textarea name="obs" id="obs" class="form-control" placeholder="ingrese aqui sus observaciones"></textarea>
																										 </div>
																				 </div>

								<!-- <div class="col-md-3">
														<div class="form-group">
														  <label>Cargo:</label>
														  <input type="text" class="form-control" name="cargo" id="cargo" required readonly value="<?php echo "$recibo"; ?>">
														</div>
									</div> -->


	 <div class="col-md-2">
		 	<label>Impuesto (%):</label>
							<div class="input-group margin">
							 <div class="input-group-btn">
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

<div class="col-md-12">
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
        <!-- inicio div carrito de compras -->
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

	 </section>
	 <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->
  <!-- /.content-wrapper -->
<?php include("../central/footer.php"); ?>
<script>
$(document).ready(function(){
//inicializa en 0 el impuesto
$("#txtigv").val(0);
      function fetch_data()
      {
				var txtigv = $('#txtigv').val();
           $.ajax({
                url:"consultacarrito.php",
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
