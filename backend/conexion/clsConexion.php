<?php
class clsConexion{
 function __construct(){
	try{
    //modificar los datos de la conexion
		$host="localhost";
		$db_name="cstintaypuncocom_db";
		//$user="root";
		//$pass="";
		$user="cstintaypuncocom_root";
		$pass="6eoM-QX03A,x";
		$this->con=mysqli_connect($host,$user,$pass) or die ("error en la conexion a la bd");
	       mysqli_select_db($this->con,$db_name) or die("no se encontro la bd");
    $this->con->set_charset("utf8");
		}catch(Exception $ex){
			throw $ex;
		 }
    }
	function consultar($sql){
	  //$con = new clsConexion;

	  $res=mysqli_query($this->con,$sql);
	  $data=NULL;
	  while($fila=mysqli_fetch_assoc($res)){
	  $data[]=$fila;
	  }
	  return $data;
    mysqli_close($this->con,$sql);
	}
	 function ejecutar($sql){
   mysqli_query($this->con,$sql);
	 if(mysqli_affected_rows($this->con)<=0){
     // ("Error en: $sql: " . mysqli_error());
  // permite retornar el mensaje en caso no se ejecute correctamente el query
       return false;
	   }else{
       // retorna el mensaje correcto en caso se ejecute el query
       return true;
	   }
   }
   //seguridad mysqli_real_escape_string en poo
    public function real_escape_string($string) {
    return $this->con->real_escape_string($string);
  }
}
?>
