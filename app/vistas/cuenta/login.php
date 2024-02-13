<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CS TINTAY PUNCO | LOGIN</title>
	<link rel="stylesheet" type="text/css" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/vendor/fortawesome/font-awesome/css/all.min.css">
	<link rel="stylesheet" href="/asset/css/AdminLTE.min.css">
	  <style>
  body {
     /*background: url('../../imagenes/j.jpg') fixed no-repeat; color: #bf00ff;
  position: absolute; top: 0; left: 0; width: 100%; height: 100%" */
  background: url('/asset/img/images.jpg');
  background-size: cover;
  background-repeat: no-repeat;
  position: relative;
  /*overflow-y:hidden;*/
  }
  #colorpanel {
    background: #ffffff;
    border: 11px hidden rgba(28,110,164,0.73);
    border-radius: 28px 28px 28px 29px;
}
.transparente{
opacity: 0.75;
-moz-opacity: 0.8;
filter: alpha(opacity=80);
-khtml-opacity: 0.8;
}
  </style>
</head>
<body class="h-100 transparente">
	<div class="login-box" >
		<div class="login-box-body" id="colorpanel">
			<div class="login-logo">
      			<legend class="border-bottom"><h3>CS TINTAY PUNCO</h3></legend>
      			<img src="/asset/img/LOGO_TINTAY.JPG" class="w-100" />
    		</div>
    		<p class="login-box-msg">Por favor ingrese su usuario y clave.</p>
    		<form name="form1" method="post" action="">
    			<div class="input-group input-group-sm mb-3">
        			<input type="text" class="form-control" name="usuario"  required placeholder="usuario"  autocomplete="off" />
        			<span class="input-group-text" id="inputGroup-sizing-sm"><i class="fa-solid fa-user"></i></span>
      			</div>
      			<div class="input-group input-group-sm mb-3">
        			<input type="password" class="form-control" name="clave" required placeholder="clave" autocomplete="off" />
        			<span class="input-group-text" id="inputGroup-sizing-sm"><i class="fa-solid fa-lock"></i></span>
      			</div>
      			<div class="w-100">
      				<button type="submit" value="Ingresar" class="btn btn-success btn-block btn-flat w-100"> Ingresar</button>
      			</div>
    		</form>
    		<div class="text-center">
           		<!-- <a href="../index.php">WEB INICIO</a> -->
      			<br/>
      			<span>2023</span>  - <span>All rights reserved.</span>
          		<br/>
        		<!-- Desarrollado por: <a href="https://olvermontalvo.nom.pe"  target="_blank">Olver Montalvo</a> -->
    		</div>
		</div>
	</div>
</body>
</html>