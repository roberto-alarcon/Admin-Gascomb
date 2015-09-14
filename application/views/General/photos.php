 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Fotografías - <?php echo $this->session->userdata('folio_id'); ?> 
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Fotografias</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
          <?php

          foreach ($list as $key => $value) {
            # code...
          ?>

          
            <div class="col-md-6">
              <!-- Box Comment -->
              <div class="box box-widget">
                <div class='box-body'>
                  <img class="img-responsive pad" src="<?php echo $value;?>" alt="Photo">
                  <p><?php echo $value;?></p>
                </div><!-- /.box-body -->  
              </div><!-- /.box -->
            </div><!-- /.col -->
           

          <?php
          }

          ?>
         </div><!-- /.row -->

         
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->