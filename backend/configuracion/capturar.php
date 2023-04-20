<head>
  <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
  <script src="../plugins/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="../plugins/plugins/jQuery/jquery-ui.min.js"></script>
  <script src="../plugins/bootbox/bootbox.min.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
  <?php
//  include("../seguridad.php");
  include_once("../conexion/clsConexion.php");
  $obj= new clsConexion();
  $funcion=$_POST["funcion"];
  if($funcion=="modificar"){
    $razon=trim($obj->real_escape_string(strip_tags($_POST['txtr'],ENT_QUOTES)));
    $mon=trim($obj->real_escape_string(strip_tags($_POST['mon'],ENT_QUOTES)));
    $z=trim($obj->real_escape_string(strip_tags($_POST['zona'],ENT_QUOTES)));
    $in=trim($obj->real_escape_string(strip_tags($_POST['in'],ENT_QUOTES)));
    $il=trim($obj->real_escape_string(strip_tags($_POST['il'],ENT_QUOTES)));
    $dir=trim($obj->real_escape_string(strip_tags($_POST['dir'],ENT_QUOTES)));
    $ruc=trim($obj->real_escape_string(strip_tags($_POST['ruc'],ENT_QUOTES)));
    $tel=trim($obj->real_escape_string(strip_tags($_POST['tel'],ENT_QUOTES)));
    $res=trim($obj->real_escape_string(strip_tags($_POST['res'],ENT_QUOTES)));
    $s_mon=trim($obj->real_escape_string(strip_tags($_POST['s_mon'],ENT_QUOTES)));
    $img_eliminar_1=$_POST["img_eliminar_1"];

   if ($_FILES['imagen']['name'] == ""){
  		//$result_img=$objalumno->consultaralumnoPorParametro('id',$cod,'');

    	$result=$obj->consultar("select logo from configuracion where idconfi='1';");
  		foreach($result as $row){
  			$nom_img_1=$row['logo'];
  		}
  		$nombreFichero_1=$nom_img_1;
  		$copiarFichero_1 = false;
  	 }else{
  		//Subir fichero
  		$copiarFichero_1 = false;
  		//Para garantizar la unicidad del nombre se a�ade una marca de tiempo
  		if (is_uploaded_file ($_FILES['imagen']['tmp_name'])){
  			$nombreDirectorio_1 = "foto/";
  			$nombreFichero_1_1 = $_FILES['imagen']['name'];
  			$nombreFichero_1=str_replace(" ","_",$nombreFichero_1_1);

  			$copiarFichero_1 = true;
  		//Si ya existe un fichero con el mismo nombre, renombrarlo
  			$nombreCompleto_1 = $nombreDirectorio_1 . $nombreFichero_1;
  			if (is_file($nombreCompleto_1)){
  				$idUnico_1 = time();
  				$nombreFichero_1 = $idUnico_1 . "-" . $nombreFichero_1;
  			}
  		// No se ha introducido ning�n fichero
  		}else if ($_FILES['imagen']['name'] == ""){
  			$nombreFichero_1 = '';
  		// El fichero introducido no se ha podido subir
  		}else{
  			$errores["imagen"] = "No se ha podido subir el fichero!";
  			$error = true;
  		}
  	}
  $sql="UPDATE `configuracion` SET `logo`='$nombreFichero_1',`razon_social`='$razon',`moneda`='$mon',`mon_simbolo`='$s_mon',`imp_num`='$in',`imp_letra`='$il',
  `zona_horaria`='$z',`direccion`='$dir',`ruc`='$ruc',`telefono`='$tel',`responsable`='$res' where idconfi='1'";

  $res=$obj->ejecutar($sql);
  if ($copiarFichero_1){
      	move_uploaded_file($_FILES['imagen']['tmp_name'],$nombreDirectorio_1 . $nombreFichero_1);
  	   	$dir="foto/".$img_eliminar_1;
  			if($img_eliminar_1!=""){
  					if(file_exists($dir)){
  						unlink($dir);
  					}
  			}

     }
     if ($res) {
         echo"<script>
           bootbox.alert('configuracion exitosa', function(){
           self.location='actualizar.php';
         });
       </script>";
     } else {
       echo"<script>
         bootbox.alert('Algo salio mal , Vuelva a intentarlo', function(){
         self.location='actualizar.php';
       });
     </script>";
    }
  }
  ?>
  </body>
