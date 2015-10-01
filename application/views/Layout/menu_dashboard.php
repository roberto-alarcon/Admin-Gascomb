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
            <li class="header">MENÚ GENERAL</li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            
            
            <!-- Modulo Informacion General -->

            <li class="treeview">
              <a href="#">
                <i class="fa fa-calendar"></i>
                <span>Mis folios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('index.php/folios/'); ?>"><i class="fa fa-circle-o"></i> Asignar Folios </a></li>
                
                
              </ul>
            </li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>