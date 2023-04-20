<?php
include("../central/header.php");
$result=$obj->consultar("SELECT tipo,nombres,usuario,idusu from usuario WHERE usuario='$usuario'");
  foreach((array)$result as $row){
    $idusuario=$row["idusu"];
    $nom_usu=$row["nombres"];
  }
  // muestra todas las historias de todos los pacientes de la clinica agrupandolos por paciente
$resul_admin=$obj->consultar("SELECT paciente.paciente
     , historia.fecha
     , historia.idpaciente
     , historia.idusuario
     , historia.idhistoria
FROM
  paciente
INNER JOIN historia
ON historia.idpaciente = paciente.idpaciente
  GROUP BY historia.idpaciente
  ORDER BY historia.idhistoria DESC");
//muestra todos los pacientes del doctor agrupandolos por paciente
  $resul_usu=$obj->consultar("SELECT paciente.paciente
       , historia.fecha
       , historia.idpaciente
       , historia.idusuario
       , historia.idhistoria
  FROM
    paciente
  INNER JOIN historia
  ON historia.idpaciente = paciente.idpaciente
    WHERE historia.idusuario='$idusuario'
    GROUP BY historia.idpaciente
    ORDER BY historia.idhistoria DESC");
?>
<div class="content-wrapper">
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
              <h3 class="box-title"><b>HISTORIAS</b></h3>
              <?php
              if ($tipo=='usuario') {
                echo "<p>Historias medicas de los pacientes a cargo de: $nom_usu</p>";
              } else {
                echo "<p>Historias medicas de todos los pacientes atendidos</p>";
              }
               ?>
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
                  <!-- <th>N.Historia</th> -->
                  <th>Paciente</th>
                  <!-- <th>Fecha</th> -->
                  <th>Historias</th>
                </tr>
                </thead>
                <tbody>
				<?php if ($tipo=='administrador') {
                $x=$resul_admin;
              } else {
                $x=$resul_usu;
              }
        foreach((array)$x as $row){
              ?>
							<tr>
              <td><?php echo $row['paciente']; ?></td>
  <td><?php echo "<a href='historias_paciente.php?idpaciente=".$row['idpaciente']."' class='btn btn-success btn-sm btn-icon icon-left' title='historial del paciente'>"?><i class="fa fa-history"></i> </td>
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
