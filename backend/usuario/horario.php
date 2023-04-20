<?php
include("../central/header.php");;
$idusu=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idusu'],ENT_QUOTES))));
$resultc=$obj->consultar("SELECT * FROM configuracion");
		    foreach((array)$resultc as $row){
		      $zona=$row["zona_horaria"];
		  }
date_default_timezone_set("$zona");
$hoy = date("Y-m-d H:i:s");
$datan=$obj->consultar("SELECT * FROM usuario WHERE idusu='".$obj->real_escape_string($idusu)."'");
		foreach($datan as $row){
		     	$no_usu= $row['nombres'];
		}

$data1=$obj->consultar("SELECT * FROM dia_usuario WHERE idu= '$idusu' and idd='1'");
foreach((array)$data1 as $row){
	$hi1=$row["hora_inicio"];
	$hf1=$row["hora_fin"];
	$d1=$row["duracion"];
	$estado1=$row["estado"];
}
$data2=$obj->consultar("SELECT * FROM dia_usuario WHERE idu= '$idusu' and idd='2'");
foreach((array)$data2 as $row){
	$hi2=$row["hora_inicio"];
	$hf2=$row["hora_fin"];
	$d2=$row["duracion"];
	$estado2=$row["estado"];
}
$data3=$obj->consultar("SELECT * FROM dia_usuario WHERE idu= '$idusu' and idd='3'");
foreach((array)$data3 as $row){
	$hi3=$row["hora_inicio"];
	$hf3=$row["hora_fin"];
	$d3=$row["duracion"];
		$estado3=$row["estado"];
}
$data4=$obj->consultar("SELECT * FROM dia_usuario WHERE idu= '$idusu' and idd='4'");
foreach((array)$data4 as $row){
	$hi4=$row["hora_inicio"];
	$hf4=$row["hora_fin"];
	$d4=$row["duracion"];
		$estado4=$row["estado"];
}
$data5=$obj->consultar("SELECT * FROM dia_usuario WHERE idu= '$idusu' and idd='5'");
foreach((array)$data5 as $row){
	$hi5=$row["hora_inicio"];
	$hf5=$row["hora_fin"];
	$d5=$row["duracion"];
		$estado5=$row["estado"];
}
$data6=$obj->consultar("SELECT * FROM dia_usuario WHERE idu= '$idusu' and idd='6'");
foreach((array)$data6 as $row){
	$hi6=$row["hora_inicio"];
	$hf6=$row["hora_fin"];
	$d6=$row["duracion"];
		$estado6=$row["estado"];
}
$data7=$obj->consultar("SELECT * FROM dia_usuario WHERE idu= '$idusu' and idd='7'");
foreach((array)$data7 as $row){
	$hi7=$row["hora_inicio"];
	$hf7=$row["hora_fin"];
	$d7=$row["duracion"];
		$estado7=$row["estado"];
}
?>
<!DOCTYPE html>
 <div class="content-wrapper">
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
       <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">ASIGNAR HORARIOS AL USUARIO : <b><?php echo "$no_usu"; ?></b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
              <form action="actualizahora.php" method="post">

								<div class="box">
							             <div class="box-header">
							               <h3 class="box-title">Horarios</h3>
							             </div>
							             <!-- /.box-header -->
							             <div class="box-body no-padding">
							               <table class="table table-striped">
							                 <tr>
							                   <th style="width: 10px">#</th>
							                   <th style="width: 10px">Atiende</th>
							                   <th style="width: 80px">Día</th>
							                   <th style="width: 50px">Hora De inicio</th>
																 <th style="width: 50px">Hora De Fin</th>
																 <th style="width: 30px">Duración(min)</th>
							                 </tr>
							                 <tr>
							                   <td>1.</td>
							                   <td><input name="estado1" type="checkbox" <?php if($estado1=='1') {echo "checked='checked'";}?>></td>
							                   <td>Lunes</td>
																 <td><input type="time" name="hora_inicio1" value="<?php echo "$hi1"; ?>"></td>
																 <td><input type="time" name="hora_fin1"  value="<?php echo "$hf1"; ?>"></td>
																 <td><input type="number" min="0" max="60" name="duracion1" value="<?php echo "$d1"; ?>"></td>
							                 </tr>
															 <tr>
																<td>2.</td>
																<td><input name="estado2" type="checkbox" <?php if($estado2=='1') {echo "checked='checked'";}?>></td>
																<td>Martes</td>
																<td><input type="time" name="hora_inicio2" value="<?php echo "$hi2"; ?>"></td>
																<td><input type="time" name="hora_fin2" value="<?php echo "$hf2"; ?>"></td>
																<td><input type="number" min="0" max="60" name="duracion2" value="<?php echo "$d2"; ?>"></td>
															</tr>
															<tr>
 															 <td>3.</td>
 															 <td><input name="estado3" type="checkbox" <?php if($estado3=='1') {echo "checked='checked'";}?>></td>
 															 <td>Miercoles</td>
 															 <td><input type="time" name="hora_inicio3" value="<?php echo "$hi3"; ?>"></td>
 															 <td><input type="time" name="hora_fin3" value="<?php echo "$hf3"; ?>"></td>
 															 <td><input type="number" min="0" max="60" name="duracion3" value="<?php echo "$d3"; ?>"></td>
 														 </tr>
														 <tr>
															 <td>4.</td>
															 <td><input name="estado4" type="checkbox" <?php if($estado4=='1') {echo "checked='checked'";}?>></td>
															 <td>Jueves</td>
															 <td> <input type="time" name="hora_inicio4" value="<?php echo "$hi4"; ?>"></td>
															 <td><input type="time" name="hora_fin4" value="<?php echo "$hf4"; ?>"></td>
															 <td> <input type="number" min="0" max="60" name="duracion4" value="<?php echo "$d4"; ?>"></td>
														 </tr>
														 <tr>
															<td>5.</td>
															<td><input name="estado5" type="checkbox" <?php if($estado5=='1') {echo "checked='checked'";}?>></td>
															<td>Viernes</td>
															<td> <input type="time" name="hora_inicio5" value="<?php echo "$hi5"; ?>"></td>
															<td><input type="time" name="hora_fin5" value="<?php echo "$hf5"; ?>"></td>
															<td> <input type="number" min="0" max="60" name="duracion5" value="<?php echo "$d5"; ?>"></td>
														</tr>
														<tr>
															<td>6.</td>
															<td><input name="estado6" type="checkbox" <?php if($estado6=='1') {echo "checked='checked'";}?>></td>
															<td>Sabado</td>
															<td> <input type="time" name="hora_inicio6" value="<?php echo "$hi6"; ?>"></td>
															<td><input type="time" name="hora_fin6" value="<?php echo "$hf6"; ?>"></td>
															<td> <input type="number" min="0" max="60" name="duracion6" value="<?php echo "$d6"; ?>"></td>
														</tr>
														<tr>
															<td>7.</td>
															<td><input name="estado7" type="checkbox" <?php if($estado7=='1') {echo "checked='checked'";}?>></td>
															<td>Domingo</td>
															<td> <input type="time" name="hora_inicio7" value="<?php echo "$hi7"; ?>"></td>
															<td><input type="time" name="hora_fin7" value="<?php echo "$hf7"; ?>"></td>
															<td> <input type="number" min="0" max="60" name="duracion7" value="<?php echo "$d7"; ?>"></td>
														</tr>
							               </table>
							             </div>

							           </div>
												          <!-- /.box-body -->


		        <div class="box-footer">
		       <center>
		        <button type="submit" value="modificar" class="btn btn-success"><i class="fa fa-pencil"></i> Ingresar</button>
		         <input type="hidden" name="funcion" id="funcion" value="modificar"/>
		         <input type="hidden" name="idusu" value="<?php echo $idusu;?>"/>
		         <a href="index.php" class="btn btn-default"><i class="fa fa-close"></i> Cancelar </a></button>
		       </center>
		      </div>
    </form>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("../central/footer.php"); ?>
