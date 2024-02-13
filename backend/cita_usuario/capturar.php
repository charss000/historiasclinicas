<?php
include("../seguridad.php");
$usu=$_SESSION["usuario"];
 ?>
<head>
  <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
  <script src="../plugins/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="../plugins/plugins/jQuery/jquery-ui.min.js"></script>
  <script src="../plugins/bootbox/bootbox.min.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php
include_once("../conexion/clsConexion.php");
$obj= new clsConexion();
$funcion=$_POST["funcion"];
if($funcion=="modificar"){
$cod=trim($obj->real_escape_string(strip_tags($_POST['cod'],ENT_QUOTES)));
}
if($funcion=="registrar"){
  $resultc=$obj->consultar("SELECT * FROM configuracion");
  		foreach((array)$resultc as $row){
  			$zona=$row["zona_horaria"];
  	}
  	date_default_timezone_set("$zona");
    $hoy = date("Y-m-d H:i:s");
    $fecha = date("Y-m-d");

    $idmedico=trim($obj->real_escape_string(strip_tags($_POST['idusu'],ENT_QUOTES)));
    $idpaciente=trim($obj->real_escape_string(strip_tags($_POST['idpaciente'],ENT_QUOTES)));
    $fecha=trim($obj->real_escape_string(strip_tags($_POST['fecha'],ENT_QUOTES)));
    $hora=trim($obj->real_escape_string(strip_tags($_POST['hora'],ENT_QUOTES)));
    // $fec_hora=trim($obj->real_escape_string(strip_tags($_POST['fec_hora'],ENT_QUOTES)));
  //insertar venta
  $idservicio=trim($obj->real_escape_string(strip_tags($_POST['idservicio'],ENT_QUOTES)));
  $data=$obj->consultar("SELECT MAX(idventa) as idventa FROM venta");
  		foreach($data as $row){
  			if($row['idventa']==NULL){
  				$idventa='1';
  			}else{
  				$idventa=$row['idventa']+1;
  			}
  		}

      $resultw=$obj->consultar("SELECT MAX(num_docu) as numero from venta");
      	foreach($resultw as $row){
      	     if($row['numero']==NULL){
      				$num_docu='00000001';
      			}else{;
      				$ultimo=$row['numero']+1;
      				$num_docu=str_pad((int) $ultimo,8,"0",STR_PAD_LEFT);
      			}
      	}

    $result_u=$obj->consultar("SELECT * from servicio where idservicio='$idservicio'");
        foreach((array)$result_u as $row){
              $precio=$row['precio'];
      }
  //fin insertar venta

  $hour='';
  $fh=$obj->consultar("SELECT usuario.idusu, cita.fecha,cita.hora FROM cita
                            INNER JOIN usuario
                            ON cita.idusuario = usuario.idusu
                            where usuario.idusu='$idmedico'");
                            		foreach((array)$fh as $row){
                            			$hour=$row["hora"];
                            	}
                     if (strtotime($hour)!=strtotime($hora)) {
                      $sql="INSERT INTO `cita`(`idpaciente`, `idusuario`, `fecha`,`hora`, `fec_ho_impresion`, `estado`, `idventa`)
                      VALUES ('$idpaciente','$idmedico','$fecha','$hora','$hoy','enespera','$idventa')";
                     //insertar venta
                      $insert_v="INSERT INTO `venta`(`idventa`, `idpaciente_v`, `fecha`, `subtotal`, `igv`, `total`, `tipo_docu`, `num_docu`, `serie`,`observacion`,`usuario`,`estado`)
                                            VALUES ('$idventa','$idpaciente','$fecha','0','0','$precio','RECIBO','$num_docu','001','','$usu','pendiente')";
                     //fin insertar venta
                      //insertar detalleventa
                      $insert_dv="INSERT INTO `detalleventa`(`idventa`, `idservicio_v`, `cantidad`, `precio`, `importe`) VALUES ('$idventa','$idservicio','1','$precio','$precio')";
                      //fin insertar detalleventa
                        $res=$obj->ejecutar($sql);
                      	$obj->ejecutar($insert_v);
                        $obj->ejecutar($insert_dv);
      if ($res) {
          echo"<script>
            bootbox.alert('Registro Exitoso', function(){
            self.location='index.php';
          });
        </script>";
      } else {
        echo"<script>
          bootbox.alert('Algo salio mal , Vuelva a intentarlo', function(){
          self.location='index.php';
        });
      </script>";
      }
    }
    else {
      echo"<script>
        bootbox.alert('esta fecha y hora ya se encuentra registrada para este medico', function(){
        self.location='index.php';
      });
    </script>";
    }
 }
?>
</body>
