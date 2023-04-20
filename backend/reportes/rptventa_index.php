<?php
include("../central/header.php");
?>
<!DOCTYPE html>

<div class="content-wrapper">
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
              <h3 class="box-title"><b>REPORTE DE INGRESOS </b></h3>
     <table class="table" >
	    <tr>
			   <td><b>Desde</td>
				<td><input type="date" id="bd-desde" class="form-control" required/></td>
				<td><b>Hasta</td>
				<td><input type="date" id="bd-hasta" class="form-control" required/></td>
				<td><a href="javascript:reportePDF();" class="btn btn-success"><span class="glyphicon glyphicon-print"> Imprimir</span></a></td>
		</tr>
     </table>
	 </div>
 </div>
 </section>
</div>
<?php include("../central/footer.php"); ?>

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
function reportePDF(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	if (desde=='' || hasta=='') {
		    alert('seleccione las fechas');
	}else {
		VentanaCentrada('rptrango_venta.php?desde='+desde+'&hasta='+hasta,'Factura','','1024','768','true');
	}
}
</script>
