<?php
$resultado = json_decode($resultado, true);
if(count($resultado)<>0){
	foreach ($resultado as $n => $s) {
	    $aux[$n] = $s['priority'];
	}
	array_multisort($aux, SORT_ASC, $resultado);
	#echo "<pre>"; print_r($resultado); echo "</pre>"; die();
?>
	<div class="container">
<?php	
	foreach ($resultado as $k => $res){
		#echo $k.": ".$res;
		$comments = array();
		$activities = array();
		foreach($res as $k2 => $folio){
			if ($k2 == "company"){
				$company = $folio;
			}
			if ($k2 == "qrcode"){
				$qrcode = $folio;
			}
			if ($k2 == "pdf"){
				$pdf = $folio;
			}
		    if ($k2 == "folio"){
				$fol = $folio;
			}
			if ( $k2 == "actividades" && count($folio) > 0){
             
                $activities = $folio;
			}
			if ($k2 == "datos_folio" && count($folio) > 0){
				$datasFolio = array();
				$datasFolio = $folio;
				foreach ($datasFolio as $k4 => $dataFolio) {
                   $entry_date = $dataFolio['entry_date'];
                   $tower = $dataFolio['tower'];
                   $parking_space = $dataFolio['parking_space'];
                   $received_by = $dataFolio['name'] . " " .$dataFolio['last_name'];
                   $service_description = $dataFolio['service_description'];
				}
			}
			if ($k2 == "leadername"){
				$leader = $folio;
			}

			if ($k2 == "priority"){
				$priority = $folio;
				switch ($priority) {
			        case 0:
					  $styles_p = "priority_red";
			          $priorities = "URGENTE";
			      
			        break;

			        case 1:
					  $styles_p = "priority_yellow";
					  $priorities = "MEDIO";
			      
			        break;

			        case 2:
					  $styles_p = "priority_green";
					  $priorities = "BAJO";
			        
			        break;			        

				}
			}
			
			if ($k2 == "comments"){
                $comments = $folio;
			}
		}

?>
		<div class="row">
			<div class="panel panel-default">
			  <div class="panel-heading">Datos Generales del Folio</div>
			  <div class="panel-body">
				<table class="table" >
				<tbody>
				  <tr>
					<td class="col-md-1">
					  <img src="<?=$qrcode?>" border="0" title="" />
					</td>
					<td class="col-md-3 small-data">
					  Folio <span><?=$fol?></span><br /><br />
					  Fecha de ingreso: <?=$entry_date?><br />
					  Tipo de Servicio: <?=$service_description?> <br />
					  Recibido por: <?=$received_by?><br />
					  Jefe de mecanicos: <?=$leader?><br />
					  compañia: <?=$company?>
					</td>				
					<!--<td class="success">dfdf</td>-->
					<td class="col-md-7">
					   <div class="small-data medio">
							Torre: <?=$tower?> <br />
							Cajon: <?=$parking_space?>
					   </div>
					   <div class="small-data medio right">
					   	    <button type="button" class="btn btn-info btn-xs">Ampliación</button>
					   	    <button type="button" class="btn btn-warning btn-xs">Requisición</button>
					   	    <button type="button" class="btn btn-default btn-xs pdf" data-pdf="<?=$pdf?>">PDF</button>
					   </div>
					   &nbsp;<br />
					   <div class="head_services">SERVICIOS A REALIZAR</div>
					   &nbsp;<br />
					   
							<table class="table table-bordered table-hover">
								<tbody>
								<?php
								    if (isset($activities) && count($activities)>0){
										foreach ($activities as $k3 => $activity) {
								?>
								  <tr>
									<td class="col-md-6">
										<div class="small-data"><strong><?=$activity['description']?></strong></div>
									</td>
									<td class="col-md-3">
									  <div align="center">
									  	<?php
                                           if ($activity['status']=="1"){ ?>
											  <button type="button" class="btn btn btn-success btn-xs tostart" datas="<?=$activity['floor_activity_id']?>" compid="<?=$company?>" fol="<?=$fol?>">Iniciar</button>
											  <button type="button" class="btn btn-danger btn-xs" disabled="disabled">Finalizar</button>
                                           <?php } else if ($activity['status']=="2"){ ?>
											  <button type="button" class="btn btn btn-warning btn-xs tostop" datas="<?=$activity['floor_activity_id']?>" compid="<?=$company?>" fol="<?=$fol?>">Detener</button>
											  <button type="button" class="btn btn-danger btn-xs tofinalize" datas="<?=$activity['floor_activity_id']?>" compid="<?=$company?>" fol="<?=$fol?>">Finalizar</button>
                                           <?php } else if ($activity['status']=="3"){ ?>
											  <button type="button" class="btn btn btn-success btn-xs restart" datas="<?=$activity['floor_activity_id']?>" compid="<?=$company?>" fol="<?=$fol?>">Reiniciar</button>
											  <button type="button" class="btn btn-danger btn-xs"  disabled="disabled">Finalizar</button>                                           	
                                           <?php } else if ($activity['status']=="4"){ ?>
											  <span class="label label-success">En Aprobación</span>
										   <?php } 
									  	?>
									  </div> 
									</td>
								  </tr>
								<?php	
                                    	}
									} else { ?>
								  <tr>
									<td class="col-md-6">
									   <div align="center"><h4><span class="label label-primary">Folio sin acividades asignadas</span></h4></div>
									</td>
								  </tr>	    

									<?php }
								?>	
								</tbody>  
							</table>					
					</td>
                    <td class="<?=$styles_p?> col-md-1">
                    	 <div class="small-data" style="margin-top:14px;"><p>&nbsp;</p></div>
		                 <div class="head_priority">
						    PRIORIDAD
					     </div> 
					        &nbsp;<br />
					     <div class="medium-data center"><?=$priorities?></div>
				    </td>
				  </tr>
				  <tr>
					<td colspan="5">
                       <div class="row">
				            <div class="col-xs-12">
				              <div class="box box-default collapsed-box">
				                <div class="box-header with-border">
				                  <h3 class="box-title">Comentarios</h3>
				                  <div class="box-tools pull-right">
				                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
				                  </div><!-- /.box-tools -->
				                </div><!-- /.box-header -->
				                <div class="box-body">
					                <div class="box-body table-responsive no-padding">
					                  <table class="table table-hover">
					                  	<tbody>
						                    <tr>
						                      <th>Fecha</th>
						                      <th>Usuario</th>
						                      <th>Comentarios</th> 
						                    </tr>
						                    <?php
											  if( count($comments) > 0 ){
												foreach ($comments as $k4 => $comment) {
						                    ?>
						                    <tr>
						                      <td><?=date('d/m/Y', $comment['date']);?></td>
						                      <td><?=$comment_user = $comment['name'] . " " .$comment['last_name'];?></td>
						                      <td><?=$comment['comments'];?></td>	
						                    </tr>
						                    <?php
												}
											  }
						                    ?>
						                </tbody>   
					                  </table>  
	                                </div>

					                <div class="box" style="padding-top:15px;">
					                  <div class="box-body pad">
					                  	<div class="box-title2">Agrega Comentarios</div>
					                  	<?php
					                  	   $this->load->helper('form');
					                       $attributes = array('id' => 'myform'.$fol);
                                           echo form_open('mechanic/addCommentMechanic' , $attributes); ?>
                                          <input type="hidden" name="company<?=$fol?>" value="<?=$company?>"/> 
					                      <textarea name="c<?=$fol?>" class="textarea" id="c<?=$fol?>" placeholder="Ingrese comentario aqui" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
					                    </form>
					                    <div id="error_c<?=$fol?>" style="font-size:11px; color:#ff0000; text-align:center;"></div>
					                  </div>
					                  <div class="box-footer">
					                      <button type="button" class="btn btn-primary pull-right comments" dcf="<?=$fol?>">Guardar</button>
					                  </div><!-- /.box-footer -->				                  
					                </div>	                                

				                </div><!-- /.box-body -->
				              </div><!-- /.box -->
                            </div>
                        </div>    
					</td>
				  </tr>
				</tbody>
				</table>		
			  </div>
			</div>
		</div>	
<?php					 

	}

} else {
	echo "No existen folios Asignados";
}

?>	
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


