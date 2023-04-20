<?php
include("../central/header.php");
$idpaciente=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idpaciente'],ENT_QUOTES))));

$result=$obj->consultar("SELECT tipo,nombres,usuario,idusu from usuario WHERE usuario='$usuario'");
  foreach((array)$result as $row){
    $idusua=$row["idusu"];
    $nom_usu=$row["nombres"];
  }

$data=$obj->consultar("SELECT * from paciente WHERE idpaciente='".$obj->real_escape_string($idpaciente)."'");
								foreach((array)$data as $row){
                $no= $row['paciente'];
                $tel= $row['telefono'];
                $es= $row['estado_civil'];
                $dir= $row['direccion_pa'];
                $email= $row['email'];
                $apo= $row['apoderado'];
                $sexo= $row['sexo'];
                $nd= $row['documento_pa'];
                $fec_nacimiento= $row['fec_nacimiento'];
                $history= $row['num_historia'];
		            }
// muestra todas las historias del paciente atendidos por diferentes medicos
$res_history=$obj->consultar("SELECT historia.fecha
     , paciente.paciente
     , paciente.idpaciente
     , historia.motivo
     , historia.examen_fisico
     , historia.diagnostico
     , historia.tratamiento
     , historia.idusuario
     , usuario.nombres
		 , usuario.tipo
     , historia.idhistoria
FROM
  historia
INNER JOIN paciente
ON historia.idpaciente = paciente.idpaciente
INNER JOIN usuario
ON historia.idusuario = usuario.idusu
Where paciente.idpaciente='$idpaciente'
  ORDER by historia.fecha desc");
?>
<div class="content-wrapper">
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
             <h3 class="box-title"><b>HISTORIAL MEDICO N° <?php echo $history; ?></b></h3>
               <p><?php echo $no; ?></p>
               <div class="box-header">
                 <a href="javascript: history.go(-1)" class="btn btn-success btn-flat"><i class="fa fa-backward"></i> </a>
               </div>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
           </div>

			<div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="tableheader">
                  <th>Medico</th>
                  <th>Paciente</th>
                  <th>Fecha</th>
                  <th>Motivo</th>
                  <th>Examen Fisico</th>
                  <th>Diagnostico</th>
                  <th>Tratamiento</th>
									<th>Imprimir</th>
									<th>Editar</th>
									<!-- <th>Eliminar</th> -->
                </tr>
                </thead>
                <tbody>
				<?php foreach((array)$res_history as $row){
              ?>
							<tr>
              <td><?php echo $row['nombres']; ?></td>
              <td><?php echo $row['paciente']; ?></td>
              <td><?php echo $row['fecha']; ?></td>
							<td><?php
							echo $textToStore = nl2br(htmlentities($row['motivo'], ENT_QUOTES, 'UTF-8'));
							?>
							</td>
							<td><?php
							echo $textToStore = nl2br(htmlentities($row['examen_fisico'], ENT_QUOTES, 'UTF-8'));
							?>
							</td>
              <td><?php
							echo $textToStore = nl2br(htmlentities($row['diagnostico'], ENT_QUOTES, 'UTF-8'));
							?>
						  </td>
							<td><?php
							echo $textToStore = nl2br(htmlentities($row['tratamiento'], ENT_QUOTES, 'UTF-8'));
							?>
							</td>

              <td><?php echo "<a href='#' class='btn btn-default' onclick='imprimir_factura(".$row['idhistoria'].");'><i class='glyphicon glyphicon-print'></i></a>"?></td>
	
							<td>
								<?php
							  if ($row['idusuario']==$idusua) {
								echo "<a href='actualizar.php?idhistoria=".$row['idhistoria']."' class='btn btn-default btn-sm btn-icon icon-left'><i class='fa fa-pencil-square-o'></i>";
							   }elseif($row['idusuario']!=$idusua) {
									echo "";
								}?>
							</td>
							<!-- <td>
							<button type="button" name="eliminar" id="<?php echo $row['idhistoria'];?>" class='btn btn-danger btn-sm btn-icon icon-left eliminar'><i class="fa fa-trash"></i></button>
							</td> -->
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
   VentanaCentrada('../reportes/rpt_historia.php?idhistoria='+id_factura,'Factura','','1024','768','true');
 }
</script>
