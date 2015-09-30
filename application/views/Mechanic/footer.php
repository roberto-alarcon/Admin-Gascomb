	<div class="modal fade" id="myModal2" role="dialog">
		<div class="modal-dialog">
		  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Detalles del Folio</h4>
				</div>
				<div class="modal-body">
				  <!---->
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			  </div>
		</div>
	</div>

</div>

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="<?php echo base_url('mechanic-assets/js/bootstrap.min.js');?>"></script>
  <script type='text/javascript'>
	$(document).ready(function() {
	  /*modal - open*/
	  $("#detalles").click(function(){
		 var id = $(this).attr("data-id");
		 var url_media = "http://github-develop.gascomb.com/user_interface/mecanicos/"+id+"/pdf/"+id+".pdf";
		 $(".modal-body").html('<iframe width="100%" height="610" frameborder="0" scrolling="yes" allowtransparency="true" src="'+url_media+'"></iframe>');
		 $('#myModal2').modal('show');	 
	  });	

	});
  </script>	

</body>
</html>  