<?php
include("../seguridad.php");
ob_start();
$usu=$_SESSION["usuario"];
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$impuesto=$_GET['txtigv'] ?? '';
$num=$result=$obj->consultar("SELECT * FROM carrito WHERE session_id='".$usu."'");

$resultm=$obj->consultar("SELECT * from configuracion");
  foreach($resultm as $row){
      $moneda=$row['mon_simbolo'];
      $letra=$row['imp_letra'];
      // $impuesto=$row['imp_num'];
  }
  $data1=$obj->consultar("SELECT ROUND(SUM(importe),2) as subtotal FROM carrito  WHERE session_id='$usu'");
		foreach($data1 as $row){
			$subtotal=$row['subtotal']?? '';
		}
$data2=$obj->consultar("SELECT ROUND(SUM(importe)*$impuesto/100 ,2) as igv FROM carrito  WHERE session_id='$usu'");
		foreach($data2 as $row){
			$igv=$row['igv']?? '';
		}
$data3=$obj->consultar("SELECT ROUND(SUM(importe)*$impuesto/100+SUM(importe),2) as total FROM carrito WHERE session_id='$usu'");
		foreach($data3 as $row){
			$total=$row['total']?? '';
		}
?>
 <div class="table-responsive">
           <table class="table table-striped">
                <tr>
                     <th width="10%"></th>
                     <th width="40%">Descripcion</th>
                     <th width="20%">U.m</th>
                     <th width="10%">Cant.</th>
                     <th width="10%">Precio</th>
                     <th width="10%">Importe</th>

                </tr>
<?php
 if($num > 0)
 {
   	foreach((array)$result as $row){
     ?>
                <tr>
                     <td><button type="button" name="delete_btn" data-id3="<?php echo $row["idservicio"];?>" class="btn btn-xs btn-danger btn_delete"><span class='glyphicon glyphicon-trash'></span></button></td>
                      <td><?php echo $row["descripcion"];?></td>
                      <td><?php echo $row["um"];?></td>
                      <td><?php echo $c=$row["cantidad"];?></td>
                      <td><?php echo $p=$row["precio"];?></td>
                      <td><?php $im=$c*$p;echo number_format($im,2);?></td>

                </tr>
        <?php
      };
 }else{
  echo"<tr>
        <td colspan='5'align='center'>Carrito Vacio</td>
       </tr>";
 }
 echo'<tr>
			<td colspan="5" align="right">SUBTOTAL '.$moneda.'</td>
			<td align="left">'.$subtotal.'</td>
		 </tr>

		 <tr>
		 <td colspan="5" align="right"> '.$letra.' '.$moneda.'</td>
		 <td align="left">'.$igv.'</td>
		 </tr>

		 <tr>
			<td colspan="5" align="right">TOTAL '.$moneda.'</td>
			<td align="left">'.$total.'</td>
		 </tr>
		 ';
  	?>
	</table>
</div>
