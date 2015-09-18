<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Agregar nueva tarea
            
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
              <h3 class="box-title">Buscar tarea</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <?php echo form_open('tasks/add'); ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Busca la palabra relacionada: Ejemplo %muelles%</label>
                    <input type="text" class="form-control" id="query" name="query" placeholder="">
                  </div><!-- /.form-group -->
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                  </div><!-- /.form-group -->
                  </form>
                </div><!-- /.col -->
                <div class="col-md-6">
                  <?php echo form_open('tasks/add_activity'); ?>
                  <div class="form-group">
                    
                    <label>Multiple</label>
                    <select class="form-control select2" name="activity" multiple="multiple" data-placeholder="Select a State" style="width: 100%; height:300px;">
                      <?php 

                        if (!empty( $result )){
                          foreach ($result->result() as $row)
                          {
                              
                              echo '<option value="'.$row->description.'">'.$row->description.'</option>';     
                             
                          }
                        }

                    ?>
                    </select>
                  </div><!-- /.form-group -->
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Agregar Selección</button>
                  </div><!-- /.form-group -->
                  </form>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->