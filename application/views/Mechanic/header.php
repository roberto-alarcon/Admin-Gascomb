<?php
$session = $this->session->userdata('logged_in'); 
if (!isset($session))
{
  echo "
  <script language='Javascript'>
    location.href = '/Admin-Gascomb/index.php/mechanic';
  </script>";
  exit;
} 
?>
<!DOCTYPE html>
<html lang="es">
<html>
<head>
<title>Grid-Actividades</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta charset="UTF-8">

<link href="<?php echo base_url('mechanic-assets/css/bootstrap.min.css');?>" rel="stylesheet" media="screen">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link href="<?php echo base_url('mechanic-assets/css/style.css');?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('mechanic-assets/css/AdminLTE.min.css');?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('mechanic-assets/skins/_all-skins.min.css');?>" rel="stylesheet" media="screen">
<link rel="stylesheet" href="<?php echo base_url('mechanic-assets/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>"/>

<body>

	<nav class="navbar navbar-default" role="navigation">

	  <div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target=".navbar-ex1-collapse">
		  <span class="sr-only">Desplegar navegación</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</button>
		<a class="navbar-brand padd_cero" href="#"><img src="<?php echo base_url('mechanic-assets/imgs/logo2.png');?>" /></a>
	  </div>

	  <div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav navbar-right">
		  <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			  Menú <b class="caret"></b>
			</a>
			<ul class="dropdown-menu">
			  <li><a href="#">Salir</a></li>
			  <!--<li class="divider"></li>
			  <li><a href="#">Acción #2</a></li>-->
			</ul>
		  </li>
		</ul>
		<p class="navbar-text"><?php echo $session['name']; ?></p>
	  </div>
	</nav>