<?php
$this->layout('../plantilla/index',['titulo'=>'CS TINTAY PUNCO'])
?>
<?php $this->start('contenido'); ?>
<div class="container-fluid">
	<h1>
        Accesos Directos
        <small>Panel De Control </small>
      </h1>
      <div class="row text-white">
      	<div class="col-md-6">
      		<div class="info-box bg-primary">
      			<div class="icon">
      				<i class="fa fa-user-md"></i>
      			</div>
      			<div class="content w-100">
      				<span class="text">Usuarios-Medicos</span>
      				<span class="number"><?= $m ?></span>
      				<div class="progress" style="height: 1px;">
  						<div class="progress-bar bg-white" role="progressbar" aria-label="Example 1px high" style="width: 20%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<a href="/usuario/"><i class="fa fa-caret-right" style="color:white"></i></a>

      			</div>
      		</div>
      	</div>
      	<div class="col-md-6">
      		<div class="info-box bg-orange">
      			<div class="icon">
      				<i class="fa fa-wheelchair"></i>
      			</div>
      			<div class="content w-100">
      				<span class="text">Pacientes</span>
      				<span class="number"><?= $s ?></span>
      				<div class="progress" style="height: 1px;">
  						<div class="progress-bar bg-white" role="progressbar" aria-label="Example 1px high" style="width: 70%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<a href="/paciente/"><i class="fa fa-caret-right" style="color:white"></i></a>
      			</div>
      		</div>
      	</div>
      	<div class="col-md-6">
      		<div class="info-box bg-success">
      			<div class="icon">
      				<i class="fa fa-edit"></i>
      			</div>
      			<div class="content w-100">
      				<span class="text">Servicios-Productos</span>
      				<span class="number"><?= $p ?></span>
      				<div class="progress" style="height: 1px;">
  						<div class="progress-bar bg-white" role="progressbar" aria-label="Example 1px high" style="width: 70%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<a href="/servicio/"><i class="fa fa-caret-right" style="color:white"></i></a>
      			</div>
      		</div>
      	</div>
      	<div class="col-md-6">
      		<div class="info-box bg-yellow">
      			<div class="icon">
      				<i class="fa fa-address-card"></i>
      			</div>
      			<div class="content w-100">
      				<span class="text">Historias</span>
      				<span class="number">ver</span>
      				<div class="progress" style="height: 1px;">
  						<div class="progress-bar bg-white" role="progressbar" aria-label="Example 1px high" style="width: 70%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<a href="/historia/"><i class="fa fa-caret-right" style="color:white"></i></a>
      			</div>
      		</div>
      	</div>
      	<div class="col-md-6">
      		<div class="info-box bg-primary">
      			<div class="icon">
      				<i class="fa fa-clock"></i>
      			</div>
      			<div class="content w-100">
      				<span class="text">Citas</span>
      				<span class="number">ver</span>
      				<div class="progress" style="height: 1px;">
  						<div class="progress-bar bg-white" role="progressbar" aria-label="Example 1px high" style="width: 70%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<a href="/cita/"><i class="fa fa-caret-right" style="color:white"></i></a>
      			</div>
      		</div>
      	</div>
      </div>
</div>
<?php $this->stop(); ?>