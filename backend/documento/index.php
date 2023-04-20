<?php
include("../central/header.php");
$result=$obj->consultar("SELECT tipo,nombres,usuario,idusu from usuario WHERE usuario='$usuario'");
  foreach((array)$result as $row){
    $idusuario=$row["idusu"];
    $nom_usu=$row["nombres"];
  }
  $resul_doc=$obj->consultar("SELECT paciente.paciente
     , cita.idcita
     , usuario.usuario
     , usuario.idusu
     , adjunto.idpaciente
FROM
  cita
INNER JOIN paciente
ON cita.idpaciente = paciente.idpaciente
INNER JOIN usuario
ON cita.idusuario = usuario.idusu
INNER JOIN adjunto
ON adjunto.idpaciente = paciente.idpaciente
GROUP BY paciente.idpaciente");
?>
<div class="content-wrapper">
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
              <h3 class="box-title"><b>DOCUMENTOS</b></h3>
              <?php
              if ($tipo=='usuario') {
                echo "<p>Documentos medicos de los pacientes</p>";
              } else {
                echo "<p>Documentos medicos de todos los pacientes atendidos</p>";
              }
               ?>
               <div class="box-header">
                     <a href="insertar.php" class="btn btn-success btn-flat"><i class="fa fa-file"></i> Registrar Nuevo Documento </a>
               </div>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
           </div>
           <!-- <div class="box-header">
              	  <a href="insertar.php" class="btn btn-success btn-flat"><i class="fa fa-history"></i> Registrar Historia</a>
           </div> -->
			<div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="tableheader">
                  <th>Paciente</th>
                  <th>ver Documentos</th>
                </tr>
                </thead>
                <tbody>
			  	<?php
             foreach((array)$resul_doc as $row){
              ?>
							<tr>
							<td><?php echo $row['paciente']; ?></td>
  <td><?php echo "<a href='ver_documentos.php?idpaciente=".$row['idpaciente']."' class='btn btn-success btn-sm btn-icon icon-left' title='historial del paciente'>"?><i class="fa fa-eye"></i> </td>

              </tr>
					<?php
					};
				?>
			           </tbody>
               </table>
            <!-- /.box-body -->
             </div>
            </div>
          <!-- /.box -->
        <!-- Main content -->
      </section>
  </div>
<?php include("../central/footer.php"); ?>
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
  $('#example1').DataTable({
                        responsive: true,
                        autoWidth: false,
                        "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
                    });
  });
</script>
