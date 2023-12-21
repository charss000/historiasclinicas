<?php

$this->layout('../plantilla/index',['titulo'=>'Error - Página no encontrada'])
?>
<?php $this->start('contenido'); ?>

<div class="container">
    <h1 class="text-center">
        ERROR 404
    </h1>
    <br>
    <h2 class="text-center"> Pagina no encontrada</h2>
</div>

<?php $this->stop(); ?>