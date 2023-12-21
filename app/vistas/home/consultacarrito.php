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
