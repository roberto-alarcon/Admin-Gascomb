<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Asignación de folios
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Simple</li>
          </ol>
        </section>
<!-- Main content -->
        <section class="content">

               <!-- SELECT2 EXAMPLE -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Folios asignados</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <?php echo form_open('folios/add'); ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Buscador de folio</label>
                    <input type="text" class="form-control" id="foliosInputBuscar" name="foliosInputBuscar" placeholder="">
                  </div><!-- /.form-group -->
                  
                  <div class="form-group">
                    
                    <button id="foliosBuscar" type="button" class="btn btn-primary"> Buscar</button>
                  </div><!-- /.form-group -->
                  <div id="foliosSearchResult" class="form-group">
                    
                  </div><!-- /.form-group -->
                  </form>
                </div><!-- /.col -->
                <div class="col-md-6">
                  
                   <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      
                      <th></th>
                      <th>Folio</th>
                      <th>Fecha ingreso</th>
                      <th>Status</th>
                      
                      
                      
                    </tr>

                    <?php
                      foreach ($gridFolio->result() as $row){

                        echo "<tr>";
                        echo '<td><a href="javascript:delete_confirm()"><i class="fa fa-fw fa-remove"></a></td>';
                        echo "<td><a href='".base_url('index.php/loadfolio/tasks?folio_id='.$row->folio_id)."'>".$row->folio_id."</a></td>";
                        echo "<td>".date('d/m/Y H:i:s' , $row->time_start)."</td>";
                        echo "<td>".$row->status."</td>";
                        echo "</tr>";

                      }


                    ?>

                  </table>
                </div><!-- /.box-body -->



                  </div><!-- /.form-group -->
                  
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
