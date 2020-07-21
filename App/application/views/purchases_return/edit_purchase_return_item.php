<?php
/*echo "<pre>";print_r($details);die;*/
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
  'data-parsley-required'=>'true'     
);
$location = array(
  'name'  => 'location',
  'id'  => 'location',
  'value' => set_value('location',@$details[0]['location']),
  'class'=>'form-control',
  'placeholder'=>'Location',
  'data-parsley-required'=>'true'       
);
$sku = array(
  'name'  => 'sku',
  'id'  => 'sku',
  'value' => set_value('sku',@$details[0]['sku']),
  'class'=>'form-control item_row auto_complete',
  'placeholder'=>'SKU',   
  'readonly'=>'readonly',    
);
$item_title = array(
  'name'  => 'item_title',
  'id'  => 'item_title',
  'value' => set_value('item_title',@$details[0]['item_title']),
  'class'=>'form-control item_row',
  'placeholder'=>'Item title',   
  'data-parsley-required'=>'true'      
);
$item_qty = array(
  'name'  => 'item_qty',
  'id'  => 'item_qty',
  'value' => set_value('item_qty',@$details[0]['item_qty']),
  'class'=>'form-control item_row',
  'placeholder' => 'Quantity',
  'data-parsley-type'=>'digits',
  'min'=>'1',
  'type' => 'number',    
  'data-parsley-required'=>'true'  
);
$unit_cost = array(
  'name'  => 'unit_cost',
  'id'  => 'unit_cost',
  'value' => set_value('unit_cost',@$details[0]['unit_cost']),
  'class'=>'form-control item_row',
  'placeholder'=>'0.00',   
  'data-parsley-required'=>'true'   
);
$total_cost = array(
  'name'  => 'total_cost',
  'id'  => 'total_cost',
  'value' => set_value('total_cost',@$details[0]['total_cost']),
  'class'=>'form-control item_row',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',   
  'data-parsley-required'=>'true'    
);
$estimate_price_per_unit = array(
  'name'  => 'estimate_price_per_unit',
  'id'  => 'estimate_price_per_unit',
  'value' => set_value('estimate_price_per_unit',@$details[0]['estimate_price_per_unit']),
  'class'=>'form-control item_row',
  'readonly'=>'readonly', 
  'placeholder'=>'0.00',     
);
$condition = array(
  'name'  => 'condition',
  'id'  => 'condition',
  'value' => set_value('condition',@$details[0]['conditions']),
  'class'=>'form-control item_row',
  'placeholder'=>'Condition',       
);
$date_listed = array(
  'name'  => 'date_listed',
  'id'  => 'date_listed',
  'value' => set_value('date_listed',date("m/d/Y", strtotime(@$details[0]['date_listed']))),
  'class'=>'form-control',
  'data-parsley-required'=>'true',
  'readonly'=>'readonly'        
);
?>
<?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"purchase_edit_form",'name'=>'purchase_edit_form', 'data-parsley-validate'=>"",'data-purchase_id_id'=>$details[0]['purchase_item_id'])); ?>
<div class="modal-body">
    <div class="form-group col-md-6">
              <label class="control-label" for="email">Category:</label>
              <?php  echo form_dropdown($categories,$category_options,$categories['value']); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="email">Sku:</label>
              <?php  echo form_input($sku); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="email">Date Listed:</label>
              <?php  echo form_input($date_listed); ?>
          </div>
        <div class="form-group col-md-6">
              <label class="control-label" for="email">Title:</label>
              <?php  echo form_input($item_title); ?>
          </div>
           <div class="form-group col-md-6">
              <label class="control-label" for="email">Location:</label>
              <?php  echo form_input($location); ?>
          </div>
            <div class="form-group col-md-12">
              <label class="control-label" for="email">Condition:</label>
              <?php  echo form_input($condition); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="email">Quantity:</label>
              <?php  echo form_input($item_qty); ?>
          </div>
           <div class="form-group col-md-3">
              <label class="control-label" for="email">Unit Cost:</label>
              <?php  echo form_input($unit_cost); ?>
          </div>
           <div class="form-group col-md-3">
              <label class="control-label" for="email">Estimate price:</label>
              <?php  echo form_input($estimate_price_per_unit); ?>
          </div>
           <div class="form-group col-md-3">
              <label class="control-label" for="email">Total Cost:</label>
              <?php  echo form_input($total_cost); ?>
          </div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
  <div class="clearfix"></div>
  <button type="submit" class="btn btn-primary pull-right save" style="margin-left: 5px;"><i class="fa fa-spinner fa-spin formloader"></i> Save Changes</button>
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="margin-left: 5px;">Back</button>
  <?php echo form_close(); ?>
  <div class="clearfix"></div>
  <div id="edit_res" class="text-left" style="margin-top: 5px;"></div>
</div>

<script>
// $(document).ready(function(e){
  $("#date_listed").datepicker({
      dateFormat: 'mm/dd/yy',
      maxDate: new Date,
      changeMonth: true,changeYear: true,yearRange: "-100:+0",  
 });
  //attach parsley validation
  $('#purchase_edit_form').parsley();
  $('#purchase_edit_form').submit(function(e){
     var chk_validate = checkItemRowValidate();
    if(chk_validate==false){
        return false;
    }
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-purchase_id_id');
    var values = $("#purchase_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('purchases_return/update_purchase_return_item') ?>/'+id,
      type:'post',
      dataType: 'json',
      data:values,
      // shows the loader element before sending.
      beforeSend: function (){before(_this)},
      // hides the loader after completion of request, whether successfull or failor.
      complete: function (){complete(_this)},
      success:function(result){
        if(result.status==1){
          $('#edit_res').empty().html('<div class="alert alert-success text-left  alert-dismissable" id="e_disappear">'+result.message+'</div>');
          setTimeout(function(){$('#e_disappear').fadeOut('slow')},3000);
          ajax_datatable.fnDraw();
          $('#purchase_edit_form').parsley().reset();
          location.reload();
        }else
        {
          $('#edit_res').empty().html('<div class="alert alert-danger text-left  alert-dismissable" id="e_disappear">'+result.message+'</div>');
          setTimeout(function(){$('#e_disappear').fadeOut('slow')},3000)
        }
      }
    });
  });
$('#item_qty').on('change',function(){
    this.value=(parseInt(this.value)||1);
    calculate_total_cost();
 });
$('#unit_cost').on('change',function(){
    calculate_total_cost();
    this.value=(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));
 });
 $('#estimate_price_per_unit').on('change',function(){
    this.value=(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));
 });
  function calculate_total_cost(){
   var totalcost=0.00;
   var quantity=$('#item_qty').val();
   var unitcost = $('#unit_cost').val();
    if ($.isNumeric(quantity) && $.isNumeric(unitcost)) {
      quantity = parseInt(quantity);
      unitcost = parseFloat(unitcost);
      if(unitcost>0 && quantity){
        totalcost=unitcost*quantity;
      }
    }
   $('#total_cost').val(totalcost.toFixed(2));
 }

   function checkItemRowValidate(){
        var item_title_flag = 0;
                if($('#item_title').val()==''){
                    $('#item_title').css('border','1px solid #f4516c');
                    item_title_flag = 1;
                }else{
                    $('#item_title').css('border','');
                }
            if(item_title_flag==1){
                return false;
            }
            var category_flag = 0;
                if($('#category_name').val()==''){
                    $('#category_name').css('border','1px solid #f4516c');
                    category_flag = 1;
                }else{
                    $('#category_name').css('border','');
                }
            if(category_flag==1){
                return false;
            }

            var item_qty_flag = 0;
                if($('#item_qty').val()=='' || $('#item_qty').val()<1){
                    $('#item_qty').css('border','1px solid #f4516c');
                    item_qty_flag = 1;
                }else{
                    $('#item_qty').css('border','');
                }
            if(item_qty_flag==1){
                return false;
            }

            var unit_price_flag = 0;
                if($('#unit_cost').val()=='' || $('#unit_cost').val()<0.01){
                    $('#unit_cost').css('border','1px solid #f4516c');
                    unit_price_flag = 1;
                }else{
                    $('#unit_cost').css('border','');
                }
            if(unit_price_flag==1){
                return false;
            }
            
            var estimate_price_flag = 0;
                if($('#estimate_price_per_unit').val()<0 && $('#estimate_price_per_unit').val()!=''){
                    $('#estimate_price_per_unit').css('border','1px solid #f4516c');
                    estimate_price_flag = 1;
                }else{
                    $('#estimate_price_per_unit').css('border','');
                }
            if(estimate_price_flag==1){
                return false;
            }

            var total_cost_flag = 0;
                if($('#total_cost').val()=='' || $('#total_cost').val()<0.01){
                    $('#total_cost').css('border','1px solid #f4516c');
                    total_cost_flag = 1;
                }else{
                    $('#total_cost').css('border','');
                }
            if(total_cost_flag==1){
                return false;
            }
    }
// });

</script>
