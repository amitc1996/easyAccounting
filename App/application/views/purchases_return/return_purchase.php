<?php
$vendor_options = array(''=>'--Select--');
if($vendors && count($vendors)> 0)
{
  foreach($vendors as $val)
  {
    $vendor_options[$val['vendor_id']]= $val['vendor_name'];
  }
}
$vendors = array(
  'name'  => 'vendor_name',
  'id'  => 'vendor_name',
  'value' => set_value('vendor_name'),
  'class'=>'form-control',
  'data-parsley-required'=>'true'
);

$marketplace_options = array(''=>'--Select--');
if($marketplaces && count($marketplaces)> 0)
{
  foreach($marketplaces as $val)
  {
    $marketplace_options[$val['marketplace_id']]= $val['marketplace_name'];
  }
}
$marketplaces = array(
  'name'  => 'marketplace_name',
  'id'  => 'marketplace_name',
  'value' => set_value('marketplace_name'),
  'class'=>'form-control',
  'data-parsley-required'=>'true'
);
$date_purchased = array(
  'name'  => 'date_purchased',
  'id'  => 'date_purchased',
  'value' => set_value('date_purchased',date('m/d/Y',time())),
  'class'=>'form-control',
  'data-parsley-required'=>'true',
  'readonly'=>'readonly'
);
$date_listed = array(
  'name'  => 'date_listed',
  'id'  => 'date_listed',
  'value' => set_value('date_listed',date('m/d/Y',time())),
  'class'=>'form-control',
  'data-parsley-required'=>'true',
  'readonly'=>'readonly'
);
$location = array(
  'name'  => 'location',
  'id'  => 'location',
  'value' => set_value('location'),
  'class'=>'form-control item_row',
  'placeholder'=>'Location',
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
  'value' => set_value('category_name'),
  'class'=>'form-control item_row',
  'readonly'=>'readonly'
);
$sku = array(
  'name'  => 'sku',
  'id'  => 'sku',
  'value' => set_value('sku'),
  'class'=>'form-control item_row auto_complete',
  'placeholder'=>'Sku',
  'readonly'=>'readonly'
);
$item_title = array(
  'name'  => 'item_title',
  'id'  => 'item_title',
  'value' => set_value('item_title'),
  'class'=>'form-control item_row',
  'placeholder'=>'Title',
);
$item_qty = array(
  'name'  => 'item_qty',
  'id'  => 'item_qty',
  'value' => set_value('item_qty',1),
  'class'=>'form-control ',
  'placeholder' => 'Quantity',
  'data-parsley-type'=>'digits',
  'min'=>'1',
  'type' => 'number',
);
$unit_cost = array(
  'name'  => 'unit_cost',
  'id'  => 'unit_cost',
  'value' => set_value('unit_cost'),
  'class'=>'form-control item_row',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);
$total_cost = array(
  'name'  => 'total_cost',
  'id'  => 'total_cost',
  'value' => set_value('total_cost'),
  'class'=>'form-control item_row',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);
$estimate_price_per_unit = array(
  'name'  => 'estimate_price_per_unit',
  'id'  => 'estimate_price_per_unit',
  'value' => set_value('estimate_price_per_unit'),
  'class'=>'form-control item_row',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);
$condition = array(
  'name'  => 'condition',
  'id'  => 'condition',
  'value' => set_value('condition'),
  'class'=>'form-control item_row',
  'placeholder'=>'Condition',
  'readonly'=>'readonly',
);
$grand_total = array(
  'name'  => 'grand_total',
  'id'  => 'grand_total',
  'value' => set_value('grand_total'),
  'class'=>'form-control',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);
$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>
<style type="text/css">
  .items-table-holder {
    min-height: 230px;
    max-height: 230px;
    overflow-y: scroll;
    border: 1px solid #ccc;
}
</style>
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
    <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"purchase_add_form",'name'=>'purchase_add_form', 'data-parsley-validate'=>"")); ?>
  <div class="row">
    <div class="col-xs-12">
      <div id="add_purchase_res"></div>
      <div class="box box-primary">

       <div class="box-body">
        <div class="row">
         <input id="product_id" type="hidden" name="product_id" value="">
          <div class="form-group col-md-4">
              <label class="control-label" for="name">Vendor:</label>
             <?php  echo form_dropdown($vendors, $vendor_options,$vendors['value']); ?>
          </div>
          <div class="form-group col-md-4">
              <label class="control-label" for="email">Marketplace:</label>
              <?php  echo form_dropdown($marketplaces, $marketplace_options,$marketplaces['value']); ?>
          </div>
           <div class="form-group col-md-4">
              <label class="control-label" for="name">Date Purchased:</label>
             <?php  echo form_input($date_purchased); ?>
          </div>
        <div class="clearfix"></div><hr />

           <div class="form-group col-md-4">
              <label class="control-label" for="item_title">Title:</label>
              <?php  echo form_input($item_title); ?>
              <div id="itemerror" style="margin-top: 2px;"></div>
          </div>
        <div class="form-group col-md-2">
              <label class="control-label" for="sku">Sku:</label>
              <?php  echo form_input($sku); ?>
          </div>
        <div class="form-group col-md-3">
              <label class="control-label" for="email">Category:</label>
              <?php  echo form_dropdown($categories,$category_options,$categories['value']); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="categories">Location:</label>
              <?php  echo form_input($location); ?>
          </div>
       </div>
       <div class="clearfix"></div>
       <div class="row">
          <div class="form-group col-md-4">
             <label class="control-label" for="date_listed">Condition:</label>
             <?php  echo form_input($condition); ?>
         </div>
           <div class="form-group col-md-1">
              <label class="control-label" for="email">Quantity:</label>
              <?php  echo form_input($item_qty); ?>
          </div>
           <div class="form-group col-md-2">
              <label class="control-label" for="email">Unit Cost:</label>
              <?php  echo form_input($unit_cost); ?>
          </div>
           <div class="form-group col-md-2">
              <label class="control-label" for="email">Estimate price:</label>
              <?php  echo form_input($estimate_price_per_unit); ?>
          </div>
           <div class="form-group col-md-2">
              <label class="control-label" for="email">Total Cost:</label>
              <?php  echo form_input($total_cost); ?>
          </div>
          <div class="form-group col-md-1">
            <label class="control-label"></label>
            <a class="btn btn-block btn-success btn-sm" id="add_item"><span class="glyphicon glyphicon-plus"></span></a>
          </div>
        </div>
        <div class="clearfix"></div><hr />
        <div class="items-table-holder">
              <table id="items-table" class="table table-bordered table-condensed table-hover">
                      <thead>
                      <tr>
                       <th style="width: 25px;"></th>
                        <th style="width: 350px;">Title</th>
                        <th style="width: 200px;">Sku</th>
                        <th style="width: 200px;">Category</th>
                        <th style="width: 150px;">Location</th>
                        <th style="width: 350px;">Condition</th>
                        <th style="width: 50px;">Quantity</th>
                        <th style="width: 100px;">Unit Cost</th>
                        <th style="width: 100px;">Estimate price</th>
                        <th class="text-right" style="width: 120px;">Total Cost</th>
                      </tr>
                    </thead>
                    <tbody id="item_data"></tbody>
                  </table>
         </div><hr/>
          <div class="form-group">
              <div class="pull-right">
               <?php  echo form_input($grand_total); ?>
              </div>
              <label class="pull-right control-label">Grand Total:</label>
          </div>
       </div><!-- /.box-body -->
       <div class="box-footer">
      <button type="button" id="save_purchase_return" class="btn btn-primary pull-right save"><i class="fa fa-spinner fa-spin formloader"></i>Purchase Return</button>
      <div class="clearfix"></div>
     </div>
     </div>
   </div>
 </div>
 <?php echo form_close(); ?>
</section><!-- /.content -->
</div>
<script>
  var product_items = {};
  var rowCount = 0;
 $(document).ready(function(){
  $("#category_name").prop('disabled',true);

 $("#date_purchased").datepicker({
       dateFormat: 'mm/dd/yy',
      maxDate: new Date,
      changeMonth: true,changeYear: true,yearRange: "-100:+0",
 });
 $('#item_qty').on('change',function(){
     this.value=(parseInt(this.value)||1);
    calculate_total_cost();
 });
 $('#unit_cost').on('change',function(){
  this.value=(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));
    calculate_total_cost();
 });
  $('#estimate_price_per_unit').on('change',function(){
  this.value=(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));
 });
 $("#item_title").autocomplete({
  source: "<?php echo site_url('purchases_return/search_product/?');?>",
  change: function (event, ui) {
    if (ui.item == null || ui.item == undefined) {
      $("#item_title").val("");
      $('#itemerror').empty();
      $('.item_row').val('');
      $('#itemerror').append('<p style="color:#ff3111;font-size: 0.9em;line-height: 0.9em;">Please select a valid product from suggestion list.</p>');
    }
  },
  select: function (event, ui) {
     get_product_details(ui.item.product_id);
  }
});
 //add_item
 $('#add_item').on('click',function(){
    var chk_validate = checkItemRowValidate();
    if(chk_validate==false || !($('#purchase_add_form').parsley().validate())){
        return false;
    }
  var category_lbl=$("#category_name option:selected").text();
  var category=$("#category_name").val();
  var item_title=$("#item_title").val();
  var item_quantity=$("#item_qty").val();
  var product_id=$("#product_id").val();
  var unit_cost=$("#unit_cost").val();
  var location= $("#location").val();
  //var date_listed= $("#date_listed").val();
  var condition= $("#condition").val();
  var sku= $("#sku").val();
  var estimate_price_per_unit=$("#estimate_price_per_unit").val();
  var totalcost=$("#total_cost").val();
  var item_data=`<tr class="${rowCount}">
                     <td><a data-remove_row ="${rowCount}" class="remove_item" style="color:red;" href=""><i class="fa fa-remove"></i></a></td>
                     <td>${item_title}</td>
                     <td>${sku}</td>
                     <td>${category_lbl}</td>
                     <td>${location}</td>
                     <td>${condition}</td>
                     <td>${item_quantity}</td>
                     <td>${unit_cost}</td>
                     <td>${estimate_price_per_unit}</td>
                     <td class="totalcost">${totalcost}</td>
                 <tr>`;
  $('#item_data').append(item_data);
       product_items[rowCount]={
        'product_id':product_id,
        'sku':sku,
        'category_id':category,
        'location':location,
        'condition':condition,
        'item_title':item_title,
        'item_qty':item_quantity,
        'unit_cost':unit_cost,
        'total_cost':totalcost,
        'estimate_price_per_unit':estimate_price_per_unit
         };
      $('.item_row').val("");
       $('#item_qty').val(1);
      rowCount++;
      calculate_grand_total();
 });

 $(document).on('click','.remove_item',function(e){
        e.preventDefault();
        target = $(this).attr('data-remove_row');
        $('.'+target).remove();
       delete product_items[target];
       calculate_grand_total();
      });

      $('form input').keydown(function (e) {
          if (e.keyCode == 13) {
              e.preventDefault();
              return false;
          }
      });
 })
  $("#save_purchase_return").click(function(){

    if(Object.keys(product_items).length<1)
    {
        alert('No purchase items added');
        return false;
    }
    var _this=$(this);
    var vendor_name=$("#vendor_name").val();
    var marketplace_name=$("#marketplace_name").val();
    var date_purchased=$("#date_purchased").val();
    //var date_listed=$("#date_listed").val();
    var location=$("#location").val();
    var grand_total=$("#grand_total").val();
   $.ajax({
    url:'<?php echo site_url('purchases_return/save_purchase_return'); ?>',
    dataType:'json',
    type:'POST',
      data:{vendor_name:vendor_name,marketplace_name:marketplace_name,date_purchased:date_purchased,grand_total:grand_total,product_items:product_items,"<?php echo $csrf['name'];?>":"<?php echo $csrf['hash'];?>"},
    // shows the loader element before sending.
     beforeSend: function (){before(_this)},
     // hides the loader after completion of request, whether successfull or failor.
     complete: function (){complete(_this)},
    success:function(result){
       if(result.status==1)
       {
          $('#item_data').empty();
          product_items={};
          $('#itemerror').empty();
          $('#add_purchase_res').html('<div class="alert alert-success" id="disappear_add"  >'+result.message+'</div>');
          setTimeout(function(){$('#disappear_add').fadeOut('slow')},3000)
          $('#purchase_add_form')[0].reset();
          $('#purchase_add_form').parsley().reset();
          $('html, body').animate({scrollTop: '0px'}, 300);
       }
       else
       {
          $('#add_purchase_res').empty().html('<div class="alert alert-danger" id="disappear_add">'+result.message+'</div>');
          setTimeout(function(){$('#disappear_add').fadeOut('slow')},3000)
       }
    }
   });

 return false;

 });
 </script>
<script type="text/javascript">
   function calculate_total_cost(){
   var quantity=$('#item_qty').val();
   var unitcost = $('#unit_cost').val();
   var totalcost=0.00;
    if ($.isNumeric(quantity) && $.isNumeric(unitcost)) {
      quantity = parseInt(quantity);
      unitcost = parseFloat(unitcost);
      if(unitcost>0 && quantity){
        totalcost=unitcost*quantity;
      }
    }
   $('#total_cost').val(totalcost.toFixed(2));
 }
function calculate_grand_total(){
  var calculated_total_sum=0.00;
    $(".totalcost").each(function (){
        var get_textbox_value = $(this).text();
        if ($.isNumeric(get_textbox_value)) {
          calculated_total_sum += parseFloat(get_textbox_value);
        }
      });
    $('#grand_total').val(calculated_total_sum.toFixed(2));
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
    function get_product_details($product_id){
       $.ajax({
        url:'<?php echo site_url('purchases_return/get_product/'); ?>'+$product_id,
        dataType:'json',
        type:'POST',
        data:{"<?php echo $csrf['name'];?>":"<?php echo $csrf['hash'];?>"},
        success:function(result){
           if(result)
           {
              $("#product_id").val(result[0].product_id);
              $("#item_title").val(result[0].item_title);
              $("#location").val(result[0].location);
              $("#condition").val(result[0].conditions);
              $("#sku").val(result[0].sku);
              $("#item_qty").val(1);
              $("#unit_cost").val(result[0].unit_cost);
              $("#estimate_price_per_unit").val(result[0].estimate_price_per_unit);
              $("#category_name").val(result[0].category_id).prop('disabled',true);
              $("#total_cost").val(result[0].unit_cost);
           }
        }
       });
  }
</script>
