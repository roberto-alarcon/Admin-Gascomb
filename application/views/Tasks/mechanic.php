<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Asignar Mecánicos - Folio <?php echo $this->session->userdata('folio_id'); ?>
            
          </h1>
        </section>

        <script type="text/javascript">

        function delete_confirm( id_activity ){

          if( confirm("¿Esta seguro que desea eliminar la actividad?") ){

            window.location.href = "/Admin-Gascomb/index.php/tasks/delete/?id_activity=" + id_activity;

          }

        }

        
        function add_new_element(){

          window.location.href = "/Admin-Gascomb/index.php/tasks/mechanic_add/";
        }

        </script>
        <!-- Main content -->
        <p/>
        <section class="content">
          
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <?php echo form_open('tasks/mechanic_add'); ?>
                  <h3 class="box-title">Tabla de tareas</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px; float: right;">
                      <div class="input-group-btn">
                        <button class="btn btn-block btn-primary" type="submit" style="float: right;">Guardar</button></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Tarea</th>
                      <th>Mecánico</th>
                      
                    </tr>
                    
                    <?php
                    
                    // Lista empleados:



                    $cont = 0;
                    foreach ($result->result() as $row)
                    {
                        $id_activity = $row->floor_activity_id;
                        echo '<tr>';
                        //echo '<td><a href="'. base_url( "index.php/tasks/delete/?id_activity=$id_activity") .'"><i class="fa fa-fw fa-remove"></a></td>';
                        echo '<td>'.strtoupper( $row->description ).' '.$row->employee_id.'</td>';
                        echo '<td>';
                        echo '<select name="'.$id_activity.'">';
                        echo '<option value="0"> -- SELECCIONA MECÁNICO -- </option>';
                        foreach ($list_employees->result() as $row_employee){
                          
                          $selected = "";
                          if( $row->employee_id == $row_employee->employee_id){
                            $selected = "selected";

                          }


                          echo '<option value="'.$row_employee->employee_id.'" '.$selected.'>'.strtoupper( $row_employee->name." ".$row_employee->last_name ).'</option>';
                        }
                        echo '</select>';
                        echo '</td>';
                        echo '</tr>';

                        $cont ++;
                    }

                    ?>

                  </table>

                </div><!-- /.box-body -->
              </form>
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->