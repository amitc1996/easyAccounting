<?php
$supplier_orgnisation_name = array(
  'name'  => 'supplier_orgnisation_name',
  'id'  => 'supplier_orgnisation_name',
  'value' => set_value('supplier_orgnisation_name',@$details[0]['supplier_orgnisation_name']),
  'class'=>'form-control',
  'placeholder'=>'Company Name',
  'data-parsley-required'=>'true'
);
$supplier_orgnisation_phone = array(
  'name'  => 'supplier_orgnisation_phone',
  'id'  => 'supplier_orgnisation_phone',
  'value' => set_value('supplier_orgnisation_phone',@$details[0]['supplier_orgnisation_phone']),
  'class'=>'form-control',
  'placeholder'=>'Company Phone',
  'data-parsley-pattern'=>'\+?\d[\d -]{8,12}\d',
  'data-parsley-pattern-message'=>'Enter valid phone number'
);
$supplier_email = array(
  'name'  => 'supplier_email',
  'id'  => 'supplier_email',
  'value' => set_value('supplier_email',@$details[0]['supplier_email']),
  'class'=>'form-control',
  'placeholder'=>'Email',
  'data-parsley-type'=>'email'
);
$gstin = array(
  'name'  => 'gstin',
  'id'  => 'gstin',
  'value' => set_value('gstin',@$details[0]['gstin']),
  'class'=>'form-control',
  'placeholder'=>'GSTIN',
  'data-parsley-pattern'=>'^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$',
  'data-parsley-pattern-message'=>'Enter valid gstin number',
);
$supplier_name = array(
  'name'  => 'supplier_name',
  'id'  => 'supplier_name',
  'value' => set_value('supplier_name',@$details[0]['supplier_name']),
  'class'=>'form-control',
  'placeholder'=>'Contact Person Name',
);
$supplier_mobile = array(
  'name'  => 'supplier_mobile',
  'id'  => 'supplier_mobile',
  'value' => set_value('supplier_mobile',@$details[0]['supplier_mobile']),
  'class'=>'form-control',
  'placeholder'=>'Mobile',
  'data-parsley-pattern'=>'\+?\d[\d -]{8,12}\d',
  'data-parsley-pattern-message'=>'Enter valid mobile number'
);
$supplier_tax_number = array(
  'name'  => 'supplier_tax_number',
  'id'  => 'supplier_tax_number',
  'value' => set_value('supplier_tax_number',@$details[0]['supplier_tax_number']),
  'class'=>'form-control',
  'placeholder'=>'Tax Number',
);
$supplier_address_b = array(
  'name'  => 'supplier_address_b',
  'id'  => 'esupplier_address_b',
  'value' => set_value('supplier_address_b',@$details[0]['supplier_address_b']),
  'class'=>'form-control',
  'placeholder'=>'Address',
  'data-parsley-required'=>'true',
  'rows'=>4
);
$supplier_city_b = array(
  'name'  => 'supplier_city_b',
  'id'  => 'esupplier_city_b',
  'value' => set_value('supplier_city_b',@$details[0]['supplier_city_b']),
  'class'=>'form-control',
  'placeholder'=>'City',
  'data-parsley-required'=>'true'
);
$supplier_state_b = array(
  'name'  => 'supplier_state_b',
  'id'  => 'esupplier_state_b',
  'value' => set_value('supplier_state_b',@$details[0]['supplier_state_b']),
  'class'=>'form-control',
  'placeholder'=>'State',
  'data-parsley-required'=>'true'
);
$supplier_country_b = array(
  'name'  => 'supplier_country_b',
  'id'  => 'esupplier_country_b',
  'value' => set_value('supplier_country_b',@$details[0]['supplier_country_b']),
  'class'=>'form-control',
  'placeholder'=>'Country',
  'data-parsley-required'=>'true'
);
$supplier_zip_b = array(
  'name'  => 'supplier_zip_b',
  'id'  => 'esupplier_zip_b',
  'value' => set_value('supplier_zip_b',@$details[0]['supplier_zip_b']),
  'class'=>'form-control',
  'placeholder'=>'Pincode',
  'data-parsley-pattern'=>'^[\d\+\-\.\(\)\/\s]*$',
  'data-parsley-pattern-message'=>'Enter valid pincode'
);

?>
<?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"supplier_edit_form",'name'=>'supplier_edit_form', 'data-parsley-validate'=>"",'data-supplier_id'=>$details[0]['supplier_id'])); ?>
   <div class="modal-body">
        <div class="row">
        <div class="form-group col-md-6">
          <label class="control-label" for="supplier_orgnisation_name">Company Name:</label>
          <?php echo form_input($supplier_orgnisation_name); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="supplier_orgnisation_phone">Company Phone:</label>
          <?php echo form_input($supplier_orgnisation_phone); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="supplier_email">Email:</label>
          <?php echo form_input($supplier_email); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="supplier_name">Contact Person Name:</label>
          <?php echo form_input($supplier_name); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="supplier_mobile">Mobile:</label>
          <?php echo form_input($supplier_mobile); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="gstin">GSTIN:</label>
          <?php echo form_input($gstin); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="supplier_tax_number">Service Tax Number:</label>
          <?php echo form_input($supplier_tax_number); ?>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
         <hr>
          <label class="control-label" for="supplier_address_b">Address:</label>
          <?php echo form_textarea($supplier_address_b); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="supplier_city_b">City:</label>
          <?php echo form_input($supplier_city_b); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="supplier_state_b">State:</label>
          <?php echo form_input($supplier_state_b); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="supplier_country_b">Country:</label>
          <?php echo form_input($supplier_country_b); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="supplier_zip_b">Pincode:</label>
          <?php echo form_input($supplier_zip_b); ?>
        </div>
      </div>
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
     $('#esupplier_address_s').val($('#esupplier_address_b').val());
     $('#esupplier_city_s').val($('#esupplier_city_b').val());
     $('#esupplier_state_s').val($('#esupplier_state_b').val());
     $('#esupplier_country_s').val( $('#esupplier_country_b').val());
     $('#esupplier_zip_s').val($('#esupplier_zip_b').val());
  }
});
  //update suppliers
  $('#supplier_edit_form').parsley();
  $('#supplier_edit_form').submit(function(e){
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-supplier_id');
    var values = $("#supplier_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('suppliers/update_supplier') ?>/'+id,
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
          suppliers_listing.fnDraw();
          $('#supplier_edit_form').parsley().reset();
        }else
        {
         toastr.error(result.message);
        }
      }
    });
  });
});
</script>
