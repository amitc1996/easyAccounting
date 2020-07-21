<?php
  $name = array(
    'name'  => 'name',
    'id'  => 'name',
    'value' => set_value('name',@$details[0]["company_name"],false),
    'class' => 'form-control',
    'placeholder' => 'Name',
    'data-parsley-required'=>'true'
  );
  $company_email = array(
    'name'  => 'company_email',
    'id'  => 'company_email',
    'value' => set_value('email',@$details[0]["email"],false),
    'class' => 'form-control',
    'placeholder' => 'Email',
    'data-parsley-required'=>'true',
    'data-parsley-type' => 'email'
  );

  $mobile = array(
    'name'  => 'mobile',
    'id'  => 'mobile',
    'value' => set_value('mobile',@$details[0]["mobile"],false),
    'class' => 'form-control',
    'placeholder' => 'Mobile',
    'data-parsley-pattern'=>'^[\d\+\-\.\(\)\/\s]*$',
    'data-parsley-pattern-message'=>'Enter valid mobile number'
  );

  $workphone = array(
    'name'  => 'workphone',
    'id'  => 'workphone',
    'value' => set_value('workphone',@$details[0]["work_phone"],false),
    'class' => 'form-control',
    'placeholder' => 'Phone',
    'data-parsley-required'=>'true',
    'data-parsley-pattern'=>'^[\d\+\-\.\(\)\/\s]*$',
    'data-parsley-pattern-message'=>'Enter valid phone number'
  );

  $address = array(
    'name'  => 'address',
    'id'  => 'address',
    'value' => set_value('note',@$details[0]["address"],false),
    'class'=>'form-control',
    'placeholder'=>'Address...',
    'data-parsley-required'=>'true',
    'rows'=>'2'
  );
  $countries = array(
    'name'  => 'country_name',
    'id'    => 'country_name',
    'value' => set_value('city',@$details[0]["country"],false),
    'class'=>'form-control',
    'placeholder' => 'Country',
    'data-parsley-required'=>'true'
  );
  $states = array(
    'name'  => 'state',
    'value' => set_value('city',@$details[0]["state"],false),
    'id'    => 'edit_state',
    'class'=>'form-control',
    'placeholder' => 'State',
    'data-parsley-required'=>'true'
  );
  $city = array(
    'name'  => 'city',
    'id'  => 'city',
    'value' => set_value('city',@$details[0]["city"],false),
    'class' => 'form-control',
    'placeholder' => 'City',
    'data-parsley-required'=>'true'
  );

  $zip = array(
    'name'  => 'zip',
    'id'  => 'zip',
    'value' => set_value('zip',@$details[0]["zip"],false),
    'class' => 'form-control',
    'placeholder' => 'Zip/Post',
    'data-parsley-required'=>'true',
    'data-parsley-pattern'=>'^[\d\+\-\.\(\)\/\s]*$',
    'data-parsley-pattern-message'=>'Enter valid zip/post'
  );
  $website = array(
    'name'  => 'website',
    'id'  => 'website',
    'type' => 'url',
    'value' => set_value('website',@$details[0]["website"],false),
    'class' => 'form-control',
    'placeholder' => 'Website',
    'data-parsley-type' => 'url'
  );
  $gstin = array(
    'name'  => 'gstin',
    'id'  => 'gstin',
    'value' => set_value('gstin',@$details[0]["gstin"],false),
    'class' => 'form-control',
    'placeholder' => 'GSTIN',
  );
   $taxes = array(
    'name'  => 'tax',
    'id'  => 'tax',
    'value' => set_value('tax',@$details[0]["tax"],false),
    'class' => 'form-control',
    'placeholder' => 'Service Tax No.',
  );
  $notes = array(
    'name'  => 'note',
    'id'  => 'note',
    'value' => set_value('note',@$details[0]["notes"],false),
    'class'=>'form-control',
    'placeholder'=>'Note...',
    'rows'=>'2'
  );
  $tnc = array(
    'name'  => 'terms',
    'id'  => 'terms',
    'value' => set_value('terms',@$details[0]["terms"],false),
    'class'=>'form-control',
    'placeholder'=>'Terms and Conditions...',
    'rows'=>'2'
  );
$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
 $bank_name = array(
    'name'  => 'bank_name',
    'id'  => 'bank_name',
    'value' => set_value('bank_name',@$details[0]["bank_name"],false),
    'class' => 'form-control',
    'placeholder' => 'Bank Name',
  );
   $account_number = array(
    'name'  => 'account_number',
    'id'  => 'account_number',
    'value' => set_value('account_number',@$details[0]["account_number"],false),
    'class' => 'form-control',
    'placeholder' => 'Account Number',
  );
    $branch_name = array(
    'name'  => 'branch_name',
    'id'  => 'branch_name',
    'value' => set_value('branch_name',@$details[0]["branch_name"],false),
    'class' => 'form-control',
    'placeholder' => 'Branch Name',
  );
     $ifsc_code = array(
    'name'  => 'ifsc_code',
    'id'  => 'ifsc_code',
    'value' => set_value('ifsc_code',@$details[0]["ifsc_code"],false),
    'class' => 'form-control',
    'placeholder' => 'IFSC Code',
  );
      $ad_code = array(
    'name'  => 'ad_code',
    'id'  => 'ad_code',
    'value' => set_value('ad_code',@$details[0]["ad_code"],false),
    'class' => 'form-control',
    'placeholder' => 'AD Code',
  );
    $swift_code = array(
    'name'  => 'swift_code',
    'id'  => 'swift_code',
    'value' => set_value('swift_code',@$details[0]["swift_code"],false),
    'class' => 'form-control',
    'placeholder' => 'SWIFT Code',
  );
 $financial_year_start = array(
    'name'  => 'financial_year_start',
    'id'  => 'financial_year_start',
    'value' => set_value('financial_year_start',@date("m/d/Y",strtotime(@$details[0]['financial_year_start'])),false),
    'class' => 'form-control',
    'readonly'=>'readonly',
    'placeholder' => 'Financial Year Start',
  ); 
  $financial_year_end = array(
    'name'  => 'financial_year_end',
    'id'  => 'financial_year_end',
    'value' => set_value('financial_year_end',@date("m/d/Y",strtotime(@$details[0]['financial_year_end'])),false),
    'class' => 'form-control',
     'readonly'=>'readonly',
    'placeholder' => 'Financial Year End',
  ); 
   $signature = array(
    'name'  => 'signature',
    'id'  => 'signature',
    'value' => set_value('signature',@$details[0]["signature"],false),
    'class' => 'form-control',
    'placeholder' => 'Signature',
  );

?>
<style type="text/css">
  .nav-tabs-custom > .nav-tabs > li.active {
    border-top-color: #444444;
}
.dropzone {
  background: #fff;
  border: 2px dashed #ddd;
  border-radius: 5px;
}

.dz-message {
  color: #999;
}

.dz-message:hover {
  color: #464646;
}

.dz-message h3 {
  font-size: 200%;
  margin-bottom: 15px;
}
</style>
 <link href="<?php echo base_url('assets/plugins/dropzone/dropzone.css'); ?>" rel="stylesheet" type="text/css" />
<div class="content-wrapper" style="min-height: 916px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="pull-left">
     <?php echo @$title; ?>
     <small></small>
   </h1>
   <div class="pull-right" >
    <a href="<?php echo site_url('purchases');?>" class="btn btn-default" title="Back"><span class="glyphicon glyphicon-arrow-left" style="margin-right: 5px;"></span>Back</a>
  </div>
  <div class="clearfix"></div>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div id="alert_area"></div>
    <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"company_profile_form",'name'=>'company_profile_form', 'data-parsley-validate'=>"",'data-company_id'=>$details[0]['company_id'])); ?>
  <div class="row">
    <div><?php echo $setting_aside; ?></div>
   <div class="col-xs-10">
      <div id="add_purchase_res"></div>
      <div class="box box-danger">
       <div class="box-body">
         <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Basic Details</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Bank Details</a></li>
               <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Sign</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="row">
          <div class="form-group col-md-6">
              <label class="control-label" for="name">Name:</label>
             <?php  echo form_input($name); ?>
          </div>
           <div class="form-group col-md-6">
            <label for="workphone">Phone:</label>
            <?php echo form_input($workphone); ?>
          </div>
          <div class="form-group col-md-6">
              <label class="control-label" for="company_email">Email:</label>
            <?php  echo form_input($company_email); ?>
          </div>
           <div class="form-group col-md-6">
              <label class="control-label" for="mobile">Mobile:</label>
             <?php  echo form_input($mobile); ?>
          </div>
           <div class="form-group col-md-12">
            <label for="address">Address:</label>
            <?php echo form_textarea($address); ?>
          </div>
          <div class="clearfix"></div>  
           <div class="form-group col-md-3">
          <label for="city">City:</label>
          <?php echo form_input($city); ?>
        </div>     
          <div class="form-group col-md-3">
            <label for="states">State:</label>
            <?php echo form_input($states); ?>
        </div>
        <div class="form-group col-md-3">
            <label for="countries">Country:</label>
            <?php echo form_input($countries); ?>
          </div>
         <div class="form-group col-md-3">
          <label for="zip">Zip/Post:</label>
          <?php echo form_input($zip); ?>
        </div>
         <div class="clearfix"></div>  
          <div class="form-group col-md-6">
            <label for="gstin">GSTIN:</label>
            <?php echo form_input($gstin); ?>
          </div>
          <div class="form-group col-md-6">
            <label for="taxes">Service Tax No:</label>
            <?php echo form_input($taxes); ?>
          </div>
      
         <div class="clearfix"></div>  
        <div class="form-group col-md-3">
            <label for="financial_year_start">Financial Year Start:</label>
            <?php echo form_input($financial_year_start); ?>
          </div>
          <div class="form-group col-md-3">
            <label for="financial_year_end">Financial Year End:</label>
            <?php echo form_input($financial_year_end); ?>
          </div>
            <div class="form-group col-md-3">
          <label for="website">Website:</label>
          <?php echo form_input($website); ?>
        </div>
          <div class="form-group col-md-3">
            <label for="signature">Signature:</label>
            <?php echo form_input($signature); ?>
          </div>
          <div class="form-group col-md-12">
            <label for="notes">Notes:</label>
            <?php echo form_textarea($notes); ?>
          </div>
          <div class="clearfix">&nbsp;</div>
            <div class="form-group col-md-12">
              <label for="tnc">Terms & Conditions:</label>
              <?php echo form_textarea($tnc); ?>
            </div>
             </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
              <div class="row">
          <div class="form-group col-md-6">
              <label class="control-label" for="bank_name">Bank Name:</label>
             <?php  echo form_input($bank_name); ?>
          </div>
          <div class="form-group col-md-6">
              <label class="control-label" for="account_number">Account Number:</label>
            <?php  echo form_input($account_number); ?>
          </div>
           <div class="form-group col-md-6">
              <label class="control-label" for="branch_name">Branch Name:</label>
             <?php  echo form_input($branch_name); ?>
          </div>
          <div class="form-group col-md-6">
            <label for="ifsc_code">IFSC Code:</label>
            <?php echo form_input($ifsc_code); ?>
          </div>
          <div class="form-group col-md-6">
              <label class="control-label" for="ad_code">AD Code:</label>
             <?php  echo form_input($ad_code); ?>
          </div>
          <div class="form-group col-md-6">
            <label for="swift_code">SWIFT Code:</label>
            <?php echo form_input($swift_code); ?>
          </div>
        </div>
        </div>
         <div class="tab-pane" id="tab_3">
           <div class="row">
             <div class="col-md-3">
                <label class="control-label" for="sign">Sign</label>
                          <div class="dropzone dz-clickable" id="myDropSign">
                            <div class="dz-default dz-message" data-dz-message="">
                              <span>Drop or click files here to upload</span>
                            </div>
                          </div>
              <input type="hidden" name="sign" id="sign" value="<?php echo @$details[0]["signature_image"];?>">
            </div>
         </div>
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
 </div><!-- /.box-body -->
 <div class="box-footer">
<button type="submit" id="save_purchase" class="btn btn-custom pull-right save"><i class="fa fa-spinner fa-spin formloader"></i> Save Changes</button>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>
 <?php echo form_close(); ?>
</section><!-- /.content -->
</div>
<script src="<?php echo base_url('assets/js/jquery.form.js')?>"></script>
<script src="//cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
<script src="<?php echo base_url('assets/plugins/dropzone/dropzone.js'); ?>" type="text/javascript"></script>   
<script>
    CKEDITOR.replace( 'terms' );  
   var myDropzoneSigh;
  var acceptedFiles='image/*';
  $(document).ready(function(){
    //update company profile
   $("#financial_year_start").datepicker({
        dateFormat: 'mm/dd/yy',
        changeMonth: true,changeYear: true,
   });
  $("#financial_year_end").datepicker({
        dateFormat: 'mm/dd/yy',
        changeMonth: true,changeYear: true,
   });
  

    $('#company_profile_form').parsley();
    $('#company_profile_form').submit(function(e){
       var _this=$(this);
        e.preventDefault();
        for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
      }
        id = $(this).attr('data-company_id');
        var values = $("#company_profile_form").serialize();
        console.log(values);
        $.ajax({
             url:'<?php echo site_url('company/update_company') ?>/'+id,
            type:'post',
            dataType: 'json',
            data:values,
            // shows the loader element before sending.
            beforeSend: function (){before(_this)},
             // hides the loader after completion of request, whether successfull or failor.
            complete: function (){complete(_this)},
            success:function(result){ 
                if(result.status==1)
                {   
                   toastr.success(result.message);
                    $('#company_profile_form').parsley().reset();
                }
                else
                {
                   toastr.error(result.message);
                }
            }
        });
    });
  });

  Dropzone.autoDiscover = false;
          myDropzoneSigh = new Dropzone("#myDropSign", {
            url:'<?php echo site_url('company/do_upload') ?>',
            acceptedFiles: acceptedFiles,
            maxFiles:1,
            addRemoveLinks: true,
           params: {<?php echo $csrf['name'];?>:"<?php echo $csrf['hash'];?>" },
          });
          var mockFile = { name: "<?php echo @$details[0]["signature_image"];?>"};
          myDropzoneSigh.on("success", function(file, xhr, formData) {
            var obj = JSON.parse(xhr);
            $('#sign').val(obj.img);
          });
          myDropzoneSigh.on("thumbnail", function(file, dataUrl) {
                $('.dz-image').last().find('img').attr({width: '100%', height: '100%'});
              }),
          <?php if($details[0]["signature_image"]){?>
          myDropzoneSigh.emit("addedfile", mockFile);
          myDropzoneSigh.emit("thumbnail", mockFile, "<?php echo site_url('file/get_file/logo_sign/'.$details[0]['signature_image']); ?>");
        <?php }?>
          myDropzoneSigh.on("removedfile",function(file){
            $('#sign').val('');
            var name=file.diskname;   
        })
          myDropzoneSigh.on("error", function(file, message2){
          alert('Unable to upload image');
        });
</script>