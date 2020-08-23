<?php

$product_name = array(
  'name'  => 'product_name',
  'id'  => 'product_name',
  'value' => set_value('product_name',@$details[0]['item_title']),
  'class'=>'form-control',
  'placeholder'=>'Product Name',
  'data-parsley-required'=>'true'
);
$sku = array(
  'name'  => 'sku',
  'id'  => 'sku',
  'value' => set_value('sku',@$details[0]['sku']),
  'class'=>'form-control',
  'placeholder'=>'SKU Id',
  'data-parsley-required'=>'true',
  'disabled' => 'true',
);
$unit_cost_exclude_gst = array(
  'name'  => 'unit_cost_exclude_gst',
  'id'  => 'eunit_cost_exclude_gst',
  'value' => set_value('unit_cost_exclude_gst',@$details[0]['unit_cost_exclude_gst']),
  'class'=>'form-control unit_cost_exclude_gst',
  'placeholder'=>'Product Price(Exc. GST)',
  'data-parsley-required'=>'true',
  'min'=>'0',
  'step'=>'0.01',
  'type'=>'number',
);
$salling_price_exclude_gst = array(
  'name'  => 'salling_price_exclude_gst',
  'id'  => 'esalling_price_exclude_gst',
  'value' => set_value('salling_price_exclude_gst',@$details[0]['salling_price_exclude_gst']),
  'class'=>'form-control salling_price_exclude_gst',
  'placeholder'=>'Salling Price(Exc. GST)',
  'data-parsley-required'=>'true',
  'min'=>'0',
  'step'=>'0.01',
  'type'=>'number',
);
$unit_cost = array(
  'name'  => 'unit_cost',
  'id'  => 'eunit_cost',
  'value' => set_value('unit_cost',@$details[0]['unit_cost']),
  'class'=>'form-control',
  'placeholder'=>'Unit Cost(Inc. GST)',
  'data-parsley-required'=>'true',
  'min'=>'0',
  'step'=>'0.01',
  'type'=>'number',
  'readonly'=>'readonly'
);
$salling_price = array(
  'name'  => 'salling_price',
  'id'  => 'esalling_price',
  'value' => set_value('salling_price',@$details[0]['salling_price']),
  'class'=>'form-control',
  'placeholder'=>'Salling Price(Inc. GST)',
  'data-parsley-required'=>'true',
  'min'=>'0',
  'step'=>'0.01',
  'type'=>'number',
  'readonly'=>'readonly'
);

$category_options = array(''=>'--Select--');
if($categories && count($categories)> 0)
{
  foreach($categories as $val)
  {
    $category_options[$val['category_id']]= $val['category_name'];
  }
}
$categories = array(
  'name'  => 'category_name',
  'id'  => 'category_name',
  'value' => set_value('category_name',@$details[0]['category_id']),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true',
);

$brand_options = array(''=>'--Select--');
if($brands && count($brands)> 0)
{
  foreach($brands as $val)
  {
    $brand_options[$val['brand_id']]= $val['brand_name'];
  }
}
$brands = array(
  'name'  => 'brand',
  'id'  => 'brand',
  'value' => set_value('brand',@$details[0]['brand_id']),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true',
);


$measurement_options = array(''=>'--Select--');
if($measurements && count($measurements)> 0)
{
  foreach($measurements as $val)
  {
    $measurement_options[$val['measurement_id']]= $val['measurement_name'];
  }
}
$measurements = array(
  'name'  => 'measurement',
  'id'  => 'measurement',
  'value' => set_value('measurement',@$details[0]['measurement']),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true',
);

$igst = array(
  'name'  => 'igst',
  'id'  => 'igst',
  'value' => set_value('igst',@$details[0]['igst']),
  'class'=>'form-control gst',
  'placeholder'=>'IGST %',
  'type'=>'number',
   'min'=>'0',
   'step'=>'0.01',
  'data-parsley-required'=>'true',
);
$cgst = array(
  'name'  => 'cgst',
  'id'  => 'cgst',
  'value' => set_value('cgst',@$details[0]['cgst']),
  'class'=>'form-control gst',
  'placeholder'=>'CGST %',
   'type'=>'number',
   'min'=>'0',
   'step'=>'0.01',
  'data-parsley-required'=>'true',
);
$sgst = array(
  'name'  => 'sgst',
  'id'  => 'sgst',
  'value' => set_value('sgst',@$details[0]['sgst']),
  'class'=>'form-control gst',
  'placeholder'=>'SGST %',
   'type'=>'number',
   'min'=>'0',
   'step'=>'0.01',
  'data-parsley-required'=>'true',
);

$product_description = array(
  'name'  => 'product_description',
  'id'  => 'product_description',
  'value' => set_value('product_description',@$details[0]['product_description']),
  'class'=>'form-control',
  'placeholder'=>'Product Description',
  'rows'=>4,
);
$hsn_sac_code = array(
  'name'  => 'hsn_sac_code',
  'id'  => 'hsn_sac_code',
  'value' => set_value('hsn_sac_code',@$details[0]['hsn_sac_code']),
  'class'=>'form-control',
  'placeholder'=>'HSN/SAC Code',
);
?>
<?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"product_edit_form",'name'=>'product_edit_form', 'data-parsley-validate'=>"",'data-product_id'=>$details[0]['product_id'])); ?>
<div class="modal-body">
  <div class="form-group col-md-6">
    <label class="control-label" for="sku">SKU Id:</label>
    <?php echo form_input($sku); ?>
  </div>
  <div class="form-group col-md-6">
    <label class="control-label" for="product_name">Product Name:</label>
    <?php echo form_input($product_name); ?>
  </div>
    <div class="form-group col-md-6">
    <label class="control-label" for="categories">Category:</label>
    <?php  echo form_dropdown($categories,$category_options,$categories['value']); ?>
  </div>
  <div class="form-group col-md-6">
    <label class="control-label" for="brands">Brands:</label>
    <?php  echo form_dropdown($brands,$brand_options,$brands['value']); ?>
  </div>
  <div class="form-group col-md-2">
    <label class="control-label" for="taxes">IGST %:</label>
    <?php echo form_input($igst); ?>
  </div>
  <div class="form-group col-md-2">
    <label class="control-label" for="taxes">CGST %:</label>
    <?php echo form_input($cgst); ?>
  </div>
  <div class="form-group col-md-2">
    <label class="control-label" for="taxes">SGST %:</label>
    <?php echo form_input($sgst); ?>
  </div>
  <div class="form-group col-md-3">
    <label class="control-label" for="measurements">Unit:</label>
    <?php  echo form_dropdown($measurements,$measurement_options,$measurements['value']); ?>
  </div>
  <div class="form-group col-md-3">
    <label class="control-label" for="hsn_sac_code">HSN/SAC Code:</label>
    <?php echo form_input($hsn_sac_code); ?>
  </div>
  <div class="form-group col-md-3">
    <label class="control-label" for="unit_cost_exclude_gst">Product Price(Exc. GST):</label>
    <?php echo form_input($unit_cost_exclude_gst); ?>
  </div>
  <div class="form-group col-md-3">
    <label class="control-label" for="salling_price_exclude_gst">Salling Price(Exc. GST):</label>
    <?php echo form_input($salling_price_exclude_gst); ?>
  </div>
  <div class="form-group col-md-3">
    <label class="control-label" for="unit_cost">Product Price(Inc. GST):</label>
    <?php echo form_input($unit_cost); ?>
  </div>
  <div class="form-group col-md-3">
    <label class="control-label" for="salling_price">Salling Price(Inc. GST):</label>
    <?php echo form_input($salling_price); ?>
  </div>
  <div class="form-group col-md-12">
    <label class="control-label" for="product_description">Product Description:</label>
    <?php echo form_textarea($product_description); ?>
  </div>
<div class="clearfix"></div>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Back</button>
        <button type="submit" class="btn btn-custom pull-right save" style="margin-left: 5px;"><i class="fa fa-spinner fa-spin formloader"></i> Save Changes</button>
 </div>
<?php echo form_close(); ?>

<script>
$(document).ready(function(e){
  //update product
  $('#product_edit_form').parsley();
  $('#product_edit_form').submit(function(e){
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-product_id');
    var values = $("#product_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('products/update_product') ?>/'+id,
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
          product_datatable.fnDraw();
          $('#product_edit_form').parsley().reset();
        }else
        {
         toastr.error(result.message);
        }
      }
    });
  });

$(document).on('keyup keypress blur change','.gst,.unit_cost_exclude_gst,.salling_price_exclude_gst',function (){
  calculate_price_e();
 });

});

function calculate_price_e(){
  var total_gst_tax=0;
  $.each($('.gst'),function (i,v){
      total_gst_tax=total_gst_tax+parseFloat($(v).val());
    })
$('#eunit_cost').val(parseFloat($('#eunit_cost_exclude_gst').val())+parseFloat($('#eunit_cost_exclude_gst').val()*total_gst_tax/100));
$('#esalling_price').val(parseFloat($('#esalling_price_exclude_gst').val())+parseFloat($('#esalling_price_exclude_gst').val()*total_gst_tax/100));
}
</script>
