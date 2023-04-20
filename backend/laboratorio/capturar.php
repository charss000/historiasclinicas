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
if($funcion=="registrar"){
    $fecha=$_POST['fecha'];
    $idusuario=$_POST['idmedico'];
    $idpaciente=$_POST['idpaciente'];
    // $examen=$_POST['examen'];
    $responsable=$_POST['usuario_res'];
    $edad=$_POST['edad'];
    $idservicio=$_POST['idservicio'];
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
                $examen=$row['descripcion'];
        }
        //validando que no puedan registrar dos ventas al mismo tiempo
        $num_docu_i='';
        $datasee=$obj->consultar("SELECT num_docu FROM venta");
          foreach((array)$datasee as $row){
            $num_docu_i=$row['num_docu'];
          }
          if ($num_docu==$num_docu_i) {
             echo "El comprobante ya se encuentra registrado, favor volver a intentarlo.";
          }else {
            $sql="INSERT INTO `laboratorio`(`fecha`, `idusuario`, `idpaciente`, `edad`,`examen`, `responsable`, `f_muestra`, `f_entrega`, `idventa`)
                                  VALUES ('$fecha','$idusuario','$idpaciente','$edad','$examen','$responsable','','','$idventa')";

            $insert_v="INSERT INTO `venta`(`idventa`, `idpaciente_v`, `fecha`, `subtotal`, `igv`, `total`, `tipo_docu`, `num_docu`, `serie`,`observacion`,`usuario`,`estado`)
                                   VALUES ('$idventa','$idpaciente','$fecha','$precio','0','$precio','RECIBO','$num_docu','001','','$usu','pendiente')";
                                                        //insertar detalleventa
            $insert_dv="INSERT INTO `detalleventa`(`idventa`, `idservicio_v`, `cantidad`, `precio`, `importe`)
                                           VALUES ('$idventa','$idservicio','1','$precio','$precio')";

                        $res=$obj->ejecutar($sql);
                        $obj->ejecutar($insert_v);
                        $obj->ejecutar($insert_dv);
           }
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
?>
</body>
