 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            PDF - <?php echo $this->session->userdata('folio_id'); ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pdf</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
          
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="<?php echo $pdf; ?>"></iframe>
            </div>

         </div><!-- /.row -->

         
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->