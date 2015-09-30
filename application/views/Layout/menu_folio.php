<?php $folio_id = $this->session->userdata('folio_id'); ?>
<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <!--div class="pull-left image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div-->
          </div>
          <!-- search form -->
          <form action="<?php echo base_url('index.php/loadfolio'); ?>" method="post" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="folio_id" class="form-control" placeholder="ID Folio">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">GENERAL</li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            
            <li class="header">ACTIVIDADES FOLIO <?php echo "- ".$folio_id ?></li>

            <!-- Modulo Informacion General -->

            <li class="treeview">
              <a href="#">
                <i class="fa fa-calendar"></i>
                <span>Información General</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('index.php/general/pdf'); ?>"><i class="fa fa-circle-o"></i> PDF - Orden de Servicio </a></li>
                <li><a href="<?php echo base_url('index.php/general/photos'); ?>"><i class="fa fa-circle-o"></i> Fotografías </a></li>
                
              </ul>
            </li>

            
            <!-- Modulo Tareas -->

            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Tareas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('index.php/tasks/update'); ?>"><i class="fa fa-circle-o"></i> Agregar / Eliminar Tareas</a></li>
                <li><a href="<?php echo base_url('index.php/tasks'); ?>"><i class="fa fa-circle-o"></i> Asignar Actividades</a></li>
                <li><a href="<?php echo base_url('index.php/tasks/gantt'); ?>"><i class="fa fa-circle-o"></i> Gráfica de Gantt</a></li>
              </ul>
            </li>


            <!-- Modulo Requisiciones -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i>
                <span>Requisiciones</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Solicitar Material </a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Autorizar Material</a></li>
              </ul>
            </li>

            <!-- Modulo Ampliaciones -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i>
                <span>Ampliaciones</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Resumen </a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Solicitar ampliación</a></li>
              </ul>
            </li>

            <!-- Modulo Seguimiento -->
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-edit"></i> <span>Seguimiento</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>

            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>