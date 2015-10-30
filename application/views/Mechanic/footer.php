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
  <script src="<?php echo base_url('mechanic-assets/js/jQuery-2.1.4.min.js');?>"></script>
  <script src="<?php echo base_url('mechanic-assets/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('mechanic-assets/js/fastclick.min.js');?>"></script>
  <script src=" <?php echo base_url('mechanic-assets/js/app.min.js'); ?>"></script>
  <script src=" <?php echo base_url('mechanic-assets/js/demo.js'); ?>"></script>
  <script src=" <?php echo base_url('mechanic-assets/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
  <script>
	  $(function () {
		    //bootstrap WYSIHTML5 - text editor
		    $(".textarea").wysihtml5();

		    //pdf modal
			$(".pdf").click(function(){
			  var id = $(this).attr("data-pdf");
			  //var url_media = "http://github-develop.gascomb.com/user_interface/mecanicos/"+id+"/pdf/"+id+".pdf";
			  var url_media = id;
			  $(".modal-body").html('<iframe width="100%" height="610" frameborder="0" scrolling="yes" allowtransparency="true" src="'+url_media+'"></iframe>');
			  $('#myModal2').modal('show');
			});	

			/* -------------------------------- [ activities ] ---------------------------------- */
	        
	        //start
	        $(".tostart").click(function(){

	        })

	        //finalize
			$(".tofinalize").click(function(){

			})

            //restart
            $(".restart").click(function(){

            })


	  });
  </script>
</body>
</html>  