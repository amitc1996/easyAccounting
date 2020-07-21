<?php
$client_orgnisation_name = array(
  'name'  => 'client_orgnisation_name',
  'id'  => 'client_orgnisation_name',
  'value' => set_value('client_orgnisation_name',@$details[0]['client_orgnisation_name']),
  'class'=>'form-control',
  'placeholder'=>'Company Name',
  'data-parsley-required'=>'true'
);
$client_orgnisation_phone = array(
  'name'  => 'client_orgnisation_phone',
  'id'  => 'client_orgnisation_phone',
  'value' => set_value('client_orgnisation_phone',@$details[0]['client_orgnisation_phone']),
  'class'=>'form-control',
  'placeholder'=>'Company Phone',
  'data-parsley-required'=>'true',
  'data-parsley-pattern'=>'\+?\d[\d -]{8,12}\d',
  'data-parsley-pattern-message'=>'Enter valid phone number'
);
$gstin = array(
  'name'  => 'gstin',
  'id'  => 'gstin',
  'value' => set_value('gstin',@$details[0]['gstin']),
  'class'=>'form-control',
  'placeholder'=>'GSTIN',
  'data-parsley-required'=>'true',
  'data-parsley-pattern'=>'^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$',
  'data-parsley-pattern-message'=>'Enter valid gstin number',
  'data-parsley-required'=>'true',
);
$client_email = array(
  'name'  => 'client_email',
  'id'  => 'client_email',
  'value' => set_value('client_email',@$details[0]['client_email']),
  'class'=>'form-control',
  'placeholder'=>'Email',
  'data-parsley-type'=>'email'
);
$client_name = array(
  'name'  => 'client_name',
  'id'  => 'client_name',
  'value' => set_value('client_name',@$details[0]['client_name']),
  'class'=>'form-control',
  'placeholder'=>'Name',
  'data-parsley-required'=>'true'
);
$client_mobile = array(
  'name'  => 'client_mobile',
  'id'  => 'client_mobile',
  'value' => set_value('client_mobile',@$details[0]['client_mobile']),
  'class'=>'form-control',
  'placeholder'=>'Mobile',
  'data-parsley-pattern'=>'\+?\d[\d -]{8,12}\d',
  'data-parsley-pattern-message'=>'Enter valid mobile number',
);
$client_tax_number = array(
  'name'  => 'client_tax_number',
  'id'  => 'client_tax_number',
  'value' => set_value('client_tax_number',@$details[0]['client_tax_number']),
  'class'=>'form-control',
  'placeholder'=>'Tax Number',
);
$client_address_b = array(
  'name'  => 'client_address_b',
  'id'  => 'eclient_address_b',
  'value' => set_value('client_address_b',@$details[0]['client_address_b']),
  'class'=>'form-control',
  'placeholder'=>'Address',
  'data-parsley-required'=>'true',
  'rows'=>4,
);
$client_city_b = array(
  'name'  => 'client_city_b',
  'id'  => 'eclient_city_b',
  'value' => set_value('client_city_b',@$details[0]['client_city_b']),
  'class'=>'form-control',
  'placeholder'=>'City',
  'data-parsley-required'=>'true'
);
$client_state_b = array(
  'name'  => 'client_state_b',
  'id'  => 'eclient_state_b',
  'value' => set_value('client_state_b',@$details[0]['client_state_b']),
  'class'=>'form-control',
  'placeholder'=>'State',
  'data-parsley-required'=>'true'
);
$client_country_b = array(
  'name'  => 'client_country_b',
  'id'  => 'eclient_country_b',
  'value' => set_value('client_country_b',@$details[0]['client_country_b']),
  'class'=>'form-control',
  'placeholder'=>'Country',
  'data-parsley-required'=>'true'
);
$client_zip_b = array(
  'name'  => 'client_zip_b',
  'id'  => 'eclient_zip_b',
  'value' => set_value('client_zip_b',@$details[0]['client_zip_b']),
  'class'=>'form-control',
  'placeholder'=>'Pincode',
  'data-parsley-required'=>'true',
  'data-parsley-pattern'=>'^[\d\+\-\.\(\)\/\s]*$',
  'data-parsley-pattern-message'=>'Enter valid pincode'
);

$client_address_s = array(
  'name'  => 'client_address_s',
  'id'  => 'eclient_address_s',
  'value' => set_value('client_address_s',@$details[0]['client_address_s']),
  'class'=>'form-control s_addr',
  'placeholder'=>'Address',
  'data-parsley-required'=>'true',
  'rows'=>4,
);
$client_city_s = array(
  'name'  => 'client_city_s',
  'id'  => 'eclient_city_s',
  'value' => set_value('client_city_s',@$details[0]['client_city_s']),
  'class'=>'form-control s_addr',
  'placeholder'=>'City',
  'data-parsley-required'=>'true'
);
$client_state_s = array(
  'name'  => 'client_state_s',
  'id'  => 'eclient_state_s',
  'value' => set_value('client_state_s',@$details[0]['client_state_s']),
  'class'=>'form-control s_addr',
  'placeholder'=>'State',
  'data-parsley-required'=>'true'
);
$client_country_s = array(
  'name'  => 'client_country_s',
  'id'  => 'eclient_country_s',
  'value' => set_value('client_country_s',@$details[0]['client_country_s']),
  'class'=>'form-control s_addr',
  'placeholder'=>'Country',
  'data-parsley-required'=>'true'
);
$client_zip_s = array(
  'name'  => 'client_zip_s',
  'id'  => 'eclient_zip_s',
  'value' => set_value('client_zip_s',@$details[0]['client_zip_s']),
  'class'=>'form-control s_addr',
  'placeholder'=>'Pincode',
  'data-parsley-required'=>'true',
  'data-parsley-pattern'=>'^[\d\+\-\.\(\)\/\s]*$',
  'data-parsley-pattern-message'=>'Enter valid pincode'
);
?>
<?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"client_edit_form",'name'=>'client_edit_form', 'data-parsley-validate'=>"",'data-client_id'=>$details[0]['client_id'])); ?>
<div class="modal-body">
  <div class="row">
        <div class="form-group col-md-6">
          <label class="control-label" for="client_orgnisation_name">Company Name:</label>
          <?php echo form_input($client_orgnisation_name); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="client_orgnisation_phone">Company Phone:</label>
          <?php echo form_input($client_orgnisation_phone); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="client_email">Email:</label>
          <?php echo form_input($client_email); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="client_name">Contact Person Name:</label>
          <?php echo form_input($client_name); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="client_mobile">Mobile:</label>
          <?php echo form_input($client_mobile); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="gstin">GSTIN:</label>
          <?php echo form_input($gstin); ?>
        </div>
    
        <div class="form-group col-md-6">
          <label class="control-label" for="client_tax_number">Service Tax Number:</label>
          <?php echo form_input($client_tax_number); ?>
        </div>
      </div>
        <div class="row">
          <div class="col-md-12 addr_label">
          <h4>Billing Address:</h4>
          </div>
        <div class="form-group col-md-12">
         <hr>
          <label class="control-label" for="client_address_b">Address:</label>
          <?php echo form_textarea($client_address_b); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="client_city_b">City:</label>
          <?php echo form_input($client_city_b); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="client_state_b">State:</label>
          <?php echo form_input($client_state_b); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="client_country_b">Country:</label>
          <?php echo form_input($client_country_b); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="client_zip_b">Pincode:</label>
          <?php echo form_input($client_zip_b); ?>
        </div>
      </div>
        <div class="clearfix"></div>
         <div class="row">
          <div class="col-md-12 addr_label">
          <h4>Shipping Address:</h4>
          </div>
        <div class="form-group col-md-12">
          <hr>
          <div class="checkbox" style="margin-top: -5px;">
            <label>
              <input type="checkbox" id="esam_as_billing_addrs"> Same as billing address
            </label>
          </div>
          <label class="control-label" for="client_address_s">Address:</label>
          <?php echo form_textarea($client_address_s); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="client_city_s">City:</label>
          <?php echo form_input($client_city_s); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="client_state_s">State:</label>
          <?php echo form_input($client_state_s); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="client_country_s">Country:</label>
          <?php echo form_input($client_country_s); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="client_zip_s">Pincode:</label>
          <?php echo form_input($client_zip_s); ?>
        </div>
      </div>
        <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
  <div class="clearfix"></div>
  <button type="submit" class="btn btn-custom pull-right save" style="margin-left: 5px;"><i class="fa fa-spinner fa-spin formloader"></i> Save Changes</button>
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="margin-left: 5px;">Back</button>
  <div class="clearfix"></div>
  <div id="edit_res" class="text-left" style="margin-top: 5px;"></div>
</div>
<?php echo form_close(); ?>

<script>
$(document).ready(function(e){
  $('#esam_as_billing_addrs').on('change',function(){
  if($(this).prop('checked')){
     $('#eclient_address_s').val($('#eclient_address_b').val());
     $('#eclient_city_s').val($('#eclient_city_b').val());
     $('#eclient_state_s').val($('#eclient_state_b').val());
     $('#eclient_country_s').val( $('#eclient_country_b').val());
     $('#eclient_zip_s').val($('#eclient_zip_b').val());
  }
});
  //update client operation
  $('#client_edit_form').parsley();
  $('#client_edit_form').submit(function(e){
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-client_id');
    var values = $("#client_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('clients/update_client') ?>/'+id,
      type:'post',
      dataType: 'json',
      data:values,
      // shows the loader element before sending.
      beforeSend: function (){before(_this)},
      // hides the loader after completion of request, whether successfull or failor.
      complete: function (){complete(_this)},
      success:function(result){
        if(result.status==1){
         toastr.success(result.message);
          client_datatable.fnDraw();
          $('#client_edit_form').parsley().reset();
        }else
        {
          toastr.success(result.message);
        }
      }
    });
  });
});
</script>
