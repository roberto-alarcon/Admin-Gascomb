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
            Asignar Actividades - Folio 30103
            
          </h1>
        </section>

        <!-- Main content -->
        <p/>
        <section class="content">
          
          
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Configuración de la tarea</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <!--label for="exampleInputEmail1">Priodidad</label -->
                  </div><!-- /.form-group -->
                  </form>
                </div><!-- /.col -->
                <div class="col-md-6">
                  
                  <div class="form-group">
                    
                    <label>Prioridad</label>
                    <select class="form-control select" name="activity" data-placeholder="Select a State">
                      <option>Urgente</option>
                      <option selected>Normal</option>
                      <option>Baja</option>
                    </select>
                    
                  </div><!-- /.form-group -->
                  <div class="form-group" style="float:right;">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </div><!-- /.form-group -->
                  </form>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->




          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Tabla de tareas</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                    
                      <div class="input-group-btn">
                        <button class="btn btn-block btn-primary" onclick="task_update();">Agregar / Eliminar Tareas</button></i></button>
                      </div>&nbsp;
                      <div class="input-group-btn">
                        <button class="btn btn-block btn-primary" onclick="mechanic_view();">Asignar Mecánicos</button></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      
                      <th>Tareas</th>
                      <th>Mecánico</th>
                      <th>Fecha inicio</th>
                      <th>Tiempo entrega</th>
                      <th>Fecha fin</th>
                      <th>Status</th>
                    </tr>

                    <?php 

                      foreach ($grid as $key => $value) {

                        echo '<tr>';
                        echo '<td>'.strtoupper ($value["description"]).'</td>';
                        echo '<td>'.strtoupper ($value["employees"]).'</td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        
                       if( $value["status"] == "" or $value["status"] == 0 ){
                          echo '<td><span class="label label-warning">Pendiente</span></td>';
                       }else if( $value["status"] == 1 ){
                          echo '<td><span class="label label-success">En Proceso</span></td>';

                       }else if( $value["status"] == 2 ){
                          echo '<td><span class="label label-danger">Detenida</span></td>';

                       }else if( $value["status"] == 3 ){
                          echo '<td><span class="label label-primary">Terminada</span></td>';

                       }
                        
                        echo  '</tr>';
                        # code...
                      }

                    ?>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->