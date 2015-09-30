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

                  <div class="form-group">
                    <label>Date range:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="reservation">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->


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
                    <input type="hidden" name="hidden_comments" id="hidden_comments" value="English">
                    <div class="box-footer">
                      <button type="reset" class="btn btn-primary">Cancelar</button>
                      <button type="button" onclick="javascript:clickme()" class="btn btn-primary pull-right">Guardar</button>
                    </div><!-- /.box-footer -->
                </form>

              </div>

              <script type="text/javascript">

              $('#reservation').daterangepicker();  

              function clickme(){
                
                $('#hidden_comments').val( $('#txtcomment').val() );
                $('#myform').submit();

                console.log ( $('#txtcomment').val() );
              }
              </script>

              <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>

              </div><!-- /.box -->
            </div>
          </div>








        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->