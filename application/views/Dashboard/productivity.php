<!-- Content Wrapper. Contains page content -->
       <script type="text/javascript">

       function mechanic_view(){

          window.location.href = "/index.php/tasks/mechanic";
       }

       function task_update(){
          window.location.href = "/index.php/tasks/update";

       }

       </script> 


      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Reporte de productividad - Total <?php echo count( $report); ?>
            
          </h1>
        </section>

        <!-- Main content -->
        <p/>
        <section class="content">
          
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Tabla de tareas</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                   
                      <div class="input-group-btn">
                        <button class="btn btn-block btn-primary" onclick="mechanic_view();">Exportar a Excel</button></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      
                      <th>Dependencia</th>
                      <th>Folio</th>
                      <th>Marca</th>
                      <th>Tipo</th>
                      <th>Placa</th>
                       <th>Entrada</th>
                      <th>Reparación</th>
                      <th>Mecánico</th>
                      <th>Seguimiento</th>
                      <th>Torre</th>
                    </tr>

                    <?php 
                    	

                    	foreach ($report as $key => $value) {
                    		
                    		echo '<tr>';
	                        echo '<td>'.$value["dependency"].'</td>';
	                        echo '<td>'.$value["folio_id"].'</td>';
	                        echo '<td>'.$value["support_brand_vehicular"].'</td>';
	                        echo '<td>'.$value["support_models_vehicular"].'</td>';
	                        echo '<td>'.$value["registration_plate"].'</td>';
	                        echo '<td>'.$value["entry_date"].'</td>';
	                        echo '<td>'.$value["reparaciones"].'</td>';
	                        echo '<td>'.$value["mechanics"].'</td>';
	                        echo '<td>'.$value["seguimiento"].'</td>';
	                        echo '<td>'.$value["tower"].'</td>';
	                        echo  '</tr>';

                    	}
                      

                        
                      
                      

                    ?>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->