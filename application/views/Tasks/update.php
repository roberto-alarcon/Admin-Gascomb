<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Asignar Actividades - Folio <?php echo $this->session->userdata('folio_id'); ?>
            
          </h1>
        </section>

        <script type="text/javascript">

        function delete_confirm( id_activity ){

          if( confirm("¿Esta seguro que desea eliminar la actividad?") ){

            window.location.href = "/index.php/tasks/delete/?id_activity=" + id_activity;

          }

        }

        
        function add_new_element(){

          window.location.href = "/index.php/tasks/add/";
        }

        </script>
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
                        <button class="btn btn-block btn-primary" onclick="add_new_element();">Nueva Tarea</button></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th width="30px"></th>
                      <th>Tareas</th>
                      
                    </tr>
                    
                    <?php 

                    foreach ($result->result() as $row)
                    {
                        $id_activity = $row->floor_activity_id;
                        echo '<tr>';
                        //echo '<td><a href="'. base_url( "index.php/tasks/delete/?id_activity=$id_activity") .'"><i class="fa fa-fw fa-remove"></a></td>';
                        echo '<td><a href="javascript:delete_confirm('.$id_activity.')"><i class="fa fa-fw fa-remove"></a></td>';
                        echo '<td>'.strtoupper( $row->description ).'</td>';     
                        echo '</tr>';
                    }

                    ?>

                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->