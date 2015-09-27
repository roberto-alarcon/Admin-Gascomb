<!DOCTYPE html>
<html lang="es">
<html>
<head>
	<title>Ingreso - Admin - Actividades</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta charset="UTF-8">
	<!-- Bootstrap -->
	<link href="<?php echo base_url('mechanic-assets/css/bootstrap.min.css')?>" rel="stylesheet" media="screen">
	<link href="<?php echo base_url('mechanic-assets/css/style.css');?>" rel="stylesheet" media="screen">
</head>
<body>
	<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog">
	  <div class="modal-content">
		  <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			  <h1 class="text-center">BIENVENIDO</h1>
			  <h2 class="text-center">INGRESE SU NUM DE EMPLEADO</h2>
			  <div align="center"><img src="<?php echo base_url('mechanic-assets/imgs/logo.png');?>" width="85" height="79" /></div>
		  </div>
		  <div class="modal-body">
			  <!--<form class="form col-md-12 center-block" id="myLogin" action="" method="post">-->
			  <?php echo form_open('mechanic/logeame'); ?>
				<div class="form-group inner-addon left-addon">
				  <i class="glyphicon glyphicon-lock form-control-feedback"></i>
				  <input type="password" id="nip" name="nip" class="form-control input-lg" placeholder="Num Empleado" />
				</div>
				<div class="form-group">
				  <button class="btn btn-primary btn-lg btn-block" id="btnIngresar">
                    Ingresar
				  </button>
				</div>
				<div id="msg"></div>
			  </form>
		  </div>
		  <div class="modal-footer">
			  <div class="col-md-12">
			  <!--<button class="btn" data-dismiss="modal" aria-hidden="true" type="reset">Cancel</button>-->
			  Control de Actividades 2.0
			  </div>	
		  </div>
	  </div>
	  </div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo base_url('mechanic-assets/js/bootstrap.min.js');?>"></script>
        <script type='text/javascript'>
        
        $(document).ready(function() {
			$("#btnIngresar").click(function(){
			    if ($("#nip").val()==""){
					msg = "Por favor Ingrese su Num Empleado";
					$("#msg").fadeIn('slow');
					$("#msg").html(msg);
					$("#nip").focus();
					return false;
			    /*} else if ( $("#nip").val().length < 3 || $("#nip").val().length > 4 ){
					 msg = "El NIP debe ser de 4 digitos.";
					 $("#msg").fadeIn('slow');
					 $("#msg").html(msg);
					 $("#nip").focus();
					 return false;*/
				} else {
					$("#msg").fadeOut('slow');
					/*$.ajax({
						type: "POST",
						url: "signd/sign.php",
						data: $("#myLogin").serialize(),
						cache : false,
						success: function(data){
							if (data == "true"){
								$("#myLogin")[0].reset();

							} else {

								msg = "Usuario no encontrado";
								$("#msg").fadeIn('slow');
								$("#msg").html(msg);

							}
						}
					}); */				
				}	 
			})        
        });
        
        </script>	

</body>
</html>  
