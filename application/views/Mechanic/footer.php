
	<div class="modal fade" id="myModal3" role="dialog">
		<div class="modal-dialog">
		  <!-- Modal content-->
		      <?php 
                  $this->load->helper('form');
                  $attributes = array('id' => 'myform');
                  echo form_open('ajaxmechanic/udpate_activitie',$attributes);
              ?>
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Por favor ingrese un comentario, para detener la actividad.</h4>
					</div>
					<div class="modal-body">
	                      <textarea class="textarea" name="comentario" id="comentario" placeholder="Ingrese comentario aqui" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
					</div>
					<div id="error_comentario" style="font-size:11px; color:#ff0000; text-align:center;"></div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-success" id="send_stop">Enviar</button>
					  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				  </div>
			  </form>
		</div>
	</div>
	<div class="modal fade" id="myModal4" role="dialog">
		<div class="modal-dialog">
		  <!-- Modal content-->
		      <?php 
                  $this->load->helper('form');
                  $attributes = array('id' => 'myform_ext');
                  echo form_open('ajaxmechanic/add_extensions',$attributes);
              ?>
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Por favor describa la causa por la que se solicita la ampliación del folio</h4>
					</div>
					<div class="modal-body">
	                      <textarea class="textarea" name="comment_ext" id="comment_ext" placeholder="Describa la ampliación" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
					</div>
					<div id="error_comment_ext" style="font-size:11px; color:#ff0000; text-align:center;"></div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-success" id="send_ext">Enviar</button>
					  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				  </div>
			  </form>
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
      (function(a){a.createModal=function(b){defaults={title:"",message:"Your Message Goes Here!",closeButton:true,scrollable:false};var b=a.extend({},defaults,b);var c=(b.scrollable===true)?'style="max-height: 500px;overflow-y: auto;"':"";html='<div class="modal fade" id="myModal">';html+='<div class="modal-dialog">';html+='<div class="modal-content">';html+='<div class="modal-header">';html+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';if(b.title.length>0){html+='<h4 class="modal-title">'+b.title+"</h4>"}html+="</div>";html+='<div class="modal-body" '+c+">";html+=b.message;html+="</div>";html+='<div class="modal-footer">';if(b.closeButton===true){html+='<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>'}html+="</div>";html+="</div>";html+="</div>";html+="</div>";a("body").prepend(html);a("#myModal").modal().on("hidden.bs.modal",function(){a(this).remove()})}})(jQuery);
	  $(function () {


		    //bootstrap WYSIHTML5 - text editor
		    $(".textarea").wysihtml5();

			$("#myModal2").on('hide.bs.modal', function(){
			   $(".modal-body").html("");
			});


		    //pdf modal
			$(".pdf").click(function(){
			  var url_media = $(this).attr("data-pdf");
			  //var url_media = "http://github-develop.gascomb.com/user_interface/mecanicos/"+id+"/pdf/"+id+".pdf";
			  //$(".pdfs").html('<iframe width="100%" height="610" frameborder="0" scrolling="yes" allowtransparency="true" src="'+url_media+'"></iframe>');
			  //$("#myModal2").modal('show');
	          var iframe = '<object type="application/pdf" data="'+url_media+'" width="100%" height="500">No Support</object>'
	          $.createModal({
	            title:"Detalles Folio",
	            message: iframe,
	            closeButton:true,
	            scrollable:false
	          });
			});	

			/* -------------------------------- [ activities ] ---------------------------------- */
	        
	        //start, finalize, restart, tostop
	        $(".tostart,.tofinalize,.restart,.tostop").click(function(){
	        	var company = $(this).attr("compid");
	        	var activity = $(this).attr("datas");
	        	var classe = $(this).attr("class");
	        	var folio = $(this).attr("fol");
	        	var actDes = $(this).attr("actdes");
	        	var classes = classe.split(" ");
	        	var action = classes[classes.length-1];

                if (action != "tostop"){
					$.ajax({
						type: "POST",
						url: 'ajaxmechanic/udpate_activitie',
						data: { act: action, comp: company, actv: activity, fo: folio },
						dataType:'html',
						success: function(data){
						  if (data == 1){
	                         location.reload();
						  } else {
						  	 alert("Update error");
						  }
						}     
					});
                } else {
                	
                	$("<input>").attr('type','hidden').attr('name','comp').attr('value',company).appendTo($('#myform'));
                	$("<input>").attr('type','hidden').attr('name','act').attr('value',action).appendTo($('#myform'));
                	$("<input>").attr('type','hidden').attr('name','actdes').attr('value',actDes).appendTo($('#myform'));
                	$("<input>").attr('type','hidden').attr('name','actv').attr('value',activity).appendTo($('#myform'));
                	$("<input>").attr('type','hidden').attr('name','fo').attr('value',folio).appendTo($('#myform'));
                	$("#myModal3").modal('show');

                }

	        })

	        /*send comments - stop acivity*/

	        $("#send_stop").click(function(){
               error = 0;
               comment = $('#comentario').val();
               if (comment == ""){
                  error = 1;
                  $("#error_comentario").html("Ingrese un comentario valido");
                  return false;
               } else {
               	  $("#error_comentario").html("");
               	  error = 0;
               }

               if (!error) {
                  $("#myform").submit();
               } 
            })

	        $(".comments").click(function(){
               error = 0;
               var fo = $(this).attr("dcf");

               var comment = $("#c"+fo).val();
               $("<input>").attr('type','hidden').attr('name','fo').attr('value',fo).appendTo($('#myform'+fo));
               if (comment == ""){
                  error = 1;
                  $("#error_c"+fo).html("Ingrese un comentario valido");
                  return false;
               } else {
               	  $("#error_c"+fo).html("");
               	  error = 0;
               }

               if (!error) {                  
                  $("#myform"+fo).submit();
               }
            })

            /*---------------- extensions ---------------*/

	        $(".extensions").click(function(){
               var fo_ext = $(this).attr("fext");
               var company_ext = $(this).attr("cext");
               var leader_ext = $(this).attr("lext");
               
               $("<input>").attr('type','hidden').attr('name','fol_ext').attr('value',fo_ext).appendTo($('#myform_ext'));
               $("<input>").attr('type','hidden').attr('name','comp_ext').attr('value',company_ext).appendTo($('#myform_ext'));
               $("<input>").attr('type','hidden').attr('name','lead_ext').attr('value',leader_ext).appendTo($('#myform_ext'));
               $("#myModal4").modal('show');

			});

	        $("#send_ext").click(function(){
               error = 0;
               comment = $('#comment_ext').val();
               if (comment == ""){
                  error = 1;
                  $("#error_comment_ext").html("Ingrese una descripción valida");
                  return false;
               } else {
               	  $("#error_comment_ext").html("");
               	  error = 0;
               }

               if (!error) {
                  
                   $("#myform_ext").submit();

               } 
            })           


	  });
  </script>
</body>
</html>  