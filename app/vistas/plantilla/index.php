<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $titulo ?></title>
	<link rel="stylesheet" type="text/css" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/vendor/fortawesome/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="/asset/css/dashboard.css">
  <?= $this->section('estilos_librerias') ?>
  <link rel="stylesheet" href="/asset/css/style.css">
	<!-- <link rel="stylesheet" href="/asset/css/AdminLTE.css">
  	<link rel="stylesheet" href="/asset/css/skins/_all-skins.css"> -->
  	<link rel="shortcut icon" href="/asset/img/apple-icon-57x57.png" />

  <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <?= $this->section('script_librerias1') ?>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
    </style>

</head>
<body class="d-flex flex-column h-100">
	
	<header class="navbar sticky-top bg-success flex-md-nowrap p-0 shadow main-header" data-bs-theme="dark">
	  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="/">Centro de Salud Tintay Punco</a>

	  <ul class="navbar-nav flex-row d-md-none">
	    <li class="nav-item text-nowrap">
	      <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
	        <svg class="bi"><use xlink:href="#search"/></svg>
	      </button>
	    </li>
	    <li class="nav-item text-nowrap">
	      <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
	        <svg class="bi"><use xlink:href="#list"/></svg>
	      </button>
	    </li>
	  </ul>

	  <div id="navbarSearch" class="navbar-search w-100 collapse">
	    <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
	  </div>
	</header>
<div class="flex-shrink-0 h-auto">
	<div class="container-fluid">
		<div class="row">
			<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
				<div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel"  style="height:calc(100vh - 80px) !important;">
					<div class="offcanvas-header">
          				<h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
          				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        			</div>
        			<div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
        				<ul class="nav flex-column">
        					<?php
        					foreach ($btnAside as $value) {
                    if (count($value)==5) {
                      print '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="'.$value[3].'"></i>'.$value[0].'</a><ul class="dropdown-menu dropdown-menu-end">';
                      foreach ($value[4] as $subValue) {
                        print '<li><a class="dropdown-item" href="'.$subValue[2].'"><i class="'.$subValue[3].'"></i>'.$subValue[0].'</a></li>';
                      }
                      print '</ul></li>';
                    } else {
                      print '<li class="nav-item"><a class="nav-link d-flex align-items-center gap-2 '.$value[1].'" aria-current="page" href="'.$value[2].'"><i class="'.$value[3].'"></i>'.$value[0].'</a></li>';
                    }
                    
        					 	
        					 } 
        					?>
        					<li class="nav-item"><a class="nav-link d-flex align-items-center gap-2" href="/home/salir"><i class="fa fa-power-off"></i> Cerrar Sesion</a></li>
        				</ul>
        			</div>
				</div>
			</div>
			<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
				<?= $this->section('contenido') ?>
			</main>
		</div>
	</div>
</div>
<footer class="footer mt-auto py-1 bg-light">
		<!-- Desarrollado por <a href="//olvermontalvo.nom.pe" class="text-decoration-none" target="_blank">Olver Edgar Montalvo Sabino</a> -->
	</footer>
</body>
</html>