<?php

$this->layout('../plantilla/index',['titulo'=>'CS TINTAY PUNCO -  Reportes'])
?>
<?php $this->push('script_librerias1'); ?>
  <script src="/asset/libs/jquery-3.7.1.min.js"></script> 
  
<?php $this->end(); ?>
<?php $this->start('contenido'); ?>

<div class="container">
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <span class="fs-4 fw-bold">REPORTE DE INGRESOS</span>
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <form action="">
                <div class="row">
                    <div class="col-lg-5 ">
                        <div class="input-group">
                            <label for="bd-desde" class=" input-group-text" id="basic-addon1">Desde : </label>
                            <input type="date" id="bd-desde" class="form-control" aria-describedby="basic-addon1" required/>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="input-group">
                            <label for="bd-hasta" class=" input-group-text" id="basic-addon1">Hasta : </label>
                            <input type="date" id="bd-hasta" class="form-control" aria-describedby="basic-addon1" required/>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <a href="javascript:reportePDF();" class="btn btn-success"><span class="glyphicon glyphicon-print"> Imprimir</span></a>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      
    </div>
</div>

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
        VentanaCentrada('reporteRangoFechas?desde='+desde+'&hasta='+hasta,'Factura','','1024','768','true');
    }
}
</script>

<?php $this->stop(); ?>