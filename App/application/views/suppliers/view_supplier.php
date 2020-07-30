<?php

$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>
<style type="text/css">
  .addr_label{
    margin-bottom: -20px;
  }
</style>
<div class="content-wrapper" style="min-height: 916px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="pull-left">
      <?php echo $title; ?>

    </h1>
  
    <div class="pull-right" >
    <a href="<?php echo site_url('suppliers');?>" class="btn btn-default" title="Back"><span class="glyphicon glyphicon-arrow-left" style="margin-right: 5px;"></span>Back</a>
    </div>
  

    <div class="clearfix"></div>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div id="alert_area">
    </div>
    <div class="row">
      <div class="col-md-3">
         <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">About Supplier</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i>Company Name</strong>

              <p class="text-muted">
               <?php echo @$details[0]['supplier_orgnisation_name'];?>
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Contact Person Name</strong>

              <p class="text-muted">
             <?php echo @$details[0]['supplier_name'];?>
              </p>

              <hr>

               <strong><i class="fa fa-book margin-r-5"></i>Phone</strong>

              <p class="text-muted">
               <?php echo @$details[0]['supplier_orgnisation_phone'];?>
              </p>

              <hr>

               <strong><i class="fa fa-book margin-r-5"></i>Email</strong>

              <p class="text-muted">
               <?php echo @$details[0]['supplier_email'];?>
              </p>

              <hr>

               <strong><i class="fa fa-book margin-r-5"></i>GSTIN</strong>

              <p class="text-muted">
               <?php echo @$details[0]['gstin'];?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Billing Address </strong>

              <p class="text-muted"><?php echo @$details[0]['supplier_address_b'].','.@$details[0]['supplier_city_b'].','.@$details[0]['supplier_state_b'].','.@$details[0]['supplier_country_b'].','.@$details[0]['supplier_zip_b'];?></p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Shipping Address </strong>

              <p class="text-muted"><?php echo @$details[0]['supplier_address_s'].','.@$details[0]['supplier_city_s'].','.@$details[0]['supplier_state_s'].','.@$details[0]['supplier_country_s'].','.@$details[0]['supplier_zip_s'];?></p>
            </div>
            <!-- /.box-body -->
          </div>
      </div>
    </div>
  </section><!-- /.content -->
</div>
<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>

