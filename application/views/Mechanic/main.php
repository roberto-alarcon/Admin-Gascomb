<?php
    $resultado = json_decode($resultado, true);
	#echo "<pre>"; print_r($resultado); echo "</pre>"; #die();
?>
	<div class="container">
<?php	
if(count($resultado)<>0){
	foreach ($resultado as $k => $res){
		#echo $k.": ".$res;
		foreach($res as $k2 => $folio){
			if ($k2 == "folio"){
				$fol = $folio;
			}
			if ( $k2 == "actividades" && count($folio) > 0){
                $activities = array();
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

		}

?>
		<div class="row">
			<div class="panel panel-default">
			  <div class="panel-heading">Datos Generales del Folio</div>
			  <div class="panel-body">
				<table class="table table-condensed" >
				<tbody>
				  <tr>
					<td class="active">
					  <img src="http://i2.gascomb.com/37763/_qrcode/qrcode.png" border="0" title="" />
					</td>
					<td class="active small-data">
					  Folio <span><?=$fol?></span><br /><br />
					  Fecha de ingreso: <?=$entry_date?><br />
					  Tipo de Servicio: <?=$service_description?> <br />
					  Recibido por: <?=$received_by?><br />
					  Jefe de mecanicos: <?=$leader?>
					</td>				
					<!--<td class="success">dfdf</td>-->
					<td class="active">
					   <div class="small-data medio">
							Torre: <?=$tower?> <br />
							Cajon: <?=$parking_space?>
					   </div>
					   <div class="small-data medio right">
					   	    <button type="button" class="btn btn-info btn-xs">Ampliación</button>
					   	    <button type="button" class="btn btn-warning btn-xs">Requisición</button>
					   	    <button type="button" class="btn btn-default btn-xs">PDF</button>
					   </div>
					   &nbsp;<br />
					   <div class="head_services">SERVICIOS A REALIZAR</div>
					   &nbsp;<br />
					   
							<table class="table table-bordered table-hover">
								<tbody>
								<?php
									foreach ($activities as $k3 => $activity) {
								?>
								  <tr>
									<td>
										<div class="small-data"><strong><?=$activity['description']?></strong></div>
									</td>
									<td>
									  <div align="center">
										  <button type="button" class="btn btn btn-success btn-xs">INICIAR</button>
										  <button type="button" class="btn btn-danger btn-xs">Finalizar</button>
									  </div> 
									</td>
								  </tr>
								<?php			
									}
								?>	
								</tbody>  
							</table>					
					</td>
					<!--<td class="success">
					<td class="warning">-->
					<td class="danger">
						<div class="small-data">
							&nbsp; <br />
							&nbsp;
					   </div>				
					   <div class="head_services priority_red">
						NIVEL DE PRIORIDAD
					   </div>
					   &nbsp;<br />
					   <div class="medium-data center red">URGENTE</div>				   
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
						                    <tr>
						                      <td>fecha 1</td>
						                      <td>usuario 1</td>
						                      <td>comentarios 1</td>	
						                    </tr>
						                </tbody>   
					                  </table>  
	                                </div>

					                <div class="box" style="padding-top:15px;">
					                  <div class="box-body pad">
					                  	<div class="box-title2">Agrega Comentarios</div>
					                    <form>
					                      <textarea class="textarea" placeholder="Ingrese comentario aqui" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
					                    </form>
					                  </div>
					                  <div class="box-footer">
					                      <button type="button" onclick="javascript:clickme()" class="btn btn-primary pull-right">Guardar</button>
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
	</div>		

?>
