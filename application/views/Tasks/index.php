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
            Asignar Actividades - Folio <?php echo $this->session->userdata('folio_id'); ?>
            
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
                    

                      <div class="form-group">
                        <label>Prioridad</label>
                        <select class="form-control select" name="activity" data-placeholder="Select a State">
                          <option>Urgente</option>
                          <option selected>Normal</option>
                          <option>Baja</option>
                        </select>
                        
                      </div><!-- /.form-group -->
                    
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Fecha de inicio <a href="#" onclick="javascript:time_start();" class="btn small" id="dp4" data-date-format="yyyy-mm-dd" data-date="2015-09-30">Cambiar</a></th>
                            <th>Fecha de entrega <a href="#" onclick="javascript:time_end();" class="btn small" id="dp5" data-date-format="yyyy-mm-dd" data-date="2015-09-30">Cambiar</a></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td id="startDate">2015-09-30</td>
                            <td id="endDate">2015-09-30</td>
                          </tr>
                        </tbody>
                      </table>
                      <input type="hidden" name="time_start_input" id="time_start_input" value="">
                      <input type="hidden" name="time_end_input" id="time_end_input" value="">
                  </div><!-- /.form-group -->
                  </form>


                  

                </div><!-- /.col -->
                <div class="col-md-6">
                  
                  <div class="form-group">
                    
                    <!--Aqui ponemos info del status<br/ -->
                    
                  </div><!-- /.form-group -->

                  </form>
                </div><!-- /.col -->
              </div><!-- /.row -->
              <div class="form-group" style="float:right;">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </div><!-- /.form-group -->
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

          
          <!-- Comentarios -->
           <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Comentarios</h3>
                  <div class="box-tools">
                    
                  </div>
                </div><!-- /.box-header -->
                
                <!-- Tabla comentarios -->
                <?php

                if( count($comments) > 0)
                {
                
                ?>
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      
                      <th>Fecha</th>
                      <th>Usuario</th>
                      <th>Comentarios</th>
                      
                    </tr>


                    <?php

                    foreach ($comments as $key => $value) {

                        echo '<tr>';
                        echo '<td>'.date('d/m/Y h:i:s',$value['date']).'</td>';
                        echo '<td>'.$value['employee_name'].'</td>';
                        echo '<td>'.$value['comments'].'</td>';
                        echo '</tr>';
                      # code...
                    }

                    ?>
    
                  </table>
                </div><!-- /.box-body -->

                <?php
                }
                ?>
                <!--  Fin Tabla comentarios -->

                <!-- textarea -->
                <div class="box-body">
                <div class="form-group">
                  <label>Agregar nuevo comentario</label>
                </div>
                <?php 
                $attributes = array('id' => 'myform');
                echo form_open('tasks/add_comment' , $attributes); ?>
                    <textarea id="txtcomment" name="txtcomment" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    <input type="hidden" name="hidden_comments" id="hidden_comments" value="">
                    <div class="box-footer">
                      <button type="reset" class="btn btn-primary">Cancelar</button>
                      <button type="button" onclick="javascript:clickme()" class="btn btn-primary pull-right">Guardar</button>
                    </div><!-- /.box-footer -->
                </form>

              </div>

              <script type="text/javascript">


              function clickme(){
                
                $('#hidden_comments').val( $('#txtcomment').val() );
                $('#myform').submit();

                console.log ( $('#txtcomment').val() );
              }


              function time_start(){

                $('#dp4').datepicker()
                    .on('changeDate', function(ev){
                      if (ev.date.valueOf() > endDate.valueOf()){
                        $('#alert').show().find('strong').text('The start date can not be greater then the end date');
                      } else {
                        $('#alert').hide();
                        startDate = new Date(ev.date);
                        $('#startDate').text($('#dp4').data('date'));
                        $('#time_start_input').val( $('#dp4').data('date') );
                      }
                      $('#dp4').datepicker('hide');
                    });

              }

              function time_end(){

                $('#dp5').datepicker()
                    .on('changeDate', function(ev){
                      if (ev.date.valueOf() < startDate.valueOf()){
                        $('#alert').show().find('strong').text('The end date can not be less then the start date');
                      } else {
                        $('#alert').hide();
                        endDate = new Date(ev.date);
                        $('#endDate').text($('#dp5').data('date'));
                        $('#time_end_input').val( $('#dp5').data('date') );
                      }
                      $('#dp5').datepicker('hide');
                    });
              }
              
              </script>



                <script>
              if (top.location != location) {
                top.location.href = document.location.href ;
              }
                $(function(){
                  window.prettyPrint && prettyPrint();
                  $('#dp1').datepicker({
                    format: 'mm-dd-yyyy'
                  });
                  $('#dp4').datepicker();
                  $('#dp5').datepicker();
                  $('#dp3').datepicker();
                  $('#dpYears').datepicker();
                  $('#dpMonths').datepicker();
                  
                  
                  var startDate = new Date(2012,1,20);
                  var endDate = new Date(2012,1,25);
                  $('#dp4').datepicker()
                    .on('changeDate', function(ev){
                      if (ev.date.valueOf() > endDate.valueOf()){
                        $('#alert').show().find('strong').text('The start date can not be greater then the end date');
                      } else {
                        $('#alert').hide();
                        startDate = new Date(ev.date);
                        $('#startDate').text($('#dp4').data('date'));
                      }
                      $('#dp4').datepicker('hide');
                    });
                  $('#dp5').datepicker()
                    .on('changeDate', function(ev){
                      if (ev.date.valueOf() < startDate.valueOf()){
                        $('#alert').show().find('strong').text('The end date can not be less then the start date');
                      } else {
                        $('#alert').hide();
                        endDate = new Date(ev.date);
                        $('#endDate').text($('#dp5').data('date'));
                      }
                      $('#dp5').datepicker('hide');
                    });

                    // disabling dates
                    var nowTemp = new Date();
                    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

                    var checkin = $('#dpd1').datepicker({
                      onRender: function(date) {
                        return date.valueOf() < now.valueOf() ? 'disabled' : '';
                      }
                    }).on('changeDate', function(ev) {
                      if (ev.date.valueOf() > checkout.date.valueOf()) {
                        var newDate = new Date(ev.date)
                        newDate.setDate(newDate.getDate() + 1);
                        checkout.setValue(newDate);
                      }
                      checkin.hide();
                      $('#dpd2')[0].focus();
                    }).data('datepicker');
                    var checkout = $('#dpd2').datepicker({
                      onRender: function(date) {
                        return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                      }
                    }).on('changeDate', function(ev) {
                      checkout.hide();
                    }).data('datepicker');
                });
              </script>


              </div><!-- /.box -->
            </div>
          </div>








        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->