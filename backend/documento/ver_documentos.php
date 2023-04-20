<?php
include("../central/header.php");
$idpaciente=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idpaciente'],ENT_QUOTES))));
$no='';
$data=$obj->consultar("SELECT adjunto.file
     , adjunto.fecha
     , adjunto.descripcion
     , adjunto.idpaciente
     , paciente.paciente
FROM
  adjunto
INNER JOIN paciente
ON adjunto.idpaciente = paciente.idpaciente
 WHERE adjunto.idpaciente='$idpaciente'");
								foreach((array)$data as $row){
                $no= $row['paciente'];
		            }
?>
<div class="content-wrapper">
  <section class="content">
         <div class="box box-success">
           <div class="box-header with-border">
              <h3 class="box-title"><b>DOCUMENTOS DEL PACIENTE: <?php echo "$no"; ?></b></h3>
           </div>
           <div class="box-header">
             <a href="javascript: history.go(-1)" class="btn btn-success btn-flat"><i class="fa fa-backward"></i> </a>
           </div>
			<div class="box-body">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="tableheader">
                  <th>Fecha</th>
                  <th>Descripcion</th>
                  <th>Ver</th>
                  <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
			  	<?php
             foreach((array)$data as $row){
              ?>
							<tr>
                <td><?php echo $row['fecha']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <?php
                 if(is_file("subir/".$row['file']."")){
                 echo "<td class='sorting_1'><a href='subir/".$row['file']."' target='_blank'><span class='fa fa-download'  title='Descargar documento'></span></a></td>";
                 }else{
                  echo "<td class='sorting_1'><a href=''></a></td>";
                 }
               ?>

<td><button type="button" name="eliminar" id="<?php echo $row['idpaciente'];?>" class='btn btn-danger btn-sm btn-icon icon-left eliminar'><i class="fa fa-trash"></i></button></td>
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
