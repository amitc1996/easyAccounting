<?php
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
$date_returned = array(
  'name'  => 'date_returned',
  'id'  => 'date_returned',
  'value' => set_value('date_returned',date('m/d/Y',time())),
  'class'=>'form-control',
  'data-parsley-required'=>'true',
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
);
$item_title = array(
  'name'  => 'item_title',
  'id'  => 'item_title',
  'value' => set_value('item_title'),
  'class'=>'form-control item_row auto_complete',
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
);
$total_cost = array(
  'name'  => 'total_cost',
  'id'  => 'total_cost',
  'value' => set_value('total_cost'),
  'class'=>'form-control item_row',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);
$ebay_fee = array(
  'name'  => 'ebay_fee',
  'id'  => 'ebay_fee',
  'value' => set_value('ebay_fee'),
  'class'=>'form-control item_row',
  'placeholder'=>'0.00',
);
$paypal_fee = array(
  'name'  => 'paypal_fee',
  'id'  => 'paypal_fee',
  'value' => set_value('paypal_fee'),
  'class'=>'form-control item_row',
  'placeholder'=>'0.00',
);
$shipping_cost = array(
  'name'  => 'shipping_cost',
  'id'  => 'shipping_cost',
  'value' => set_value('shipping_cost'),
  'class'=>'form-control item_row',
  'placeholder'=>'0.00',
);

$total_ebay_fee = array(
  'name'  => 'total_ebay_fee',
  'id'  => 'total_ebay_fee',
  'value' => set_value('total_ebay_fee'),
  'class'=>'form-control',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);
$total_paypal_fee = array(
  'name'  => 'total_paypal_fee',
  'id'  => 'total_paypal_fee',
  'value' => set_value('total_paypal_fee'),
  'class'=>'form-control',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);
$total_shipping_cost = array(
  'name'  => 'total_shipping_cost',
  'id'  => 'total_shipping_cost',
  'value' => set_value('total_shipping_cost'),
  'class'=>'form-control',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);

$net_cost = array(
  'name'  => 'net_cost',
  'id'  => 'net_cost',
  'value' => set_value('net_cost'),
  'class'=>'form-control item_row',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);
$selling_price = array(
  'name'  => 'selling_price',
  'id'  => 'selling_price',
  'value' => set_value('selling_price'),
  'class'=>'form-control item_row',
  'placeholder'=>'0.00',
);
$net_profit = array(
  'name'  => 'net_profit',
  'id'  =>   'net_profit',
  'value' => set_value('net_profit'),
  'class'=>'form-control item_row',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);
$total_unit_cost = array(
  'name'  => 'total_unit_cost',
  'id'  => 'total_unit_cost',
  'value' => set_value('total_unit_cost'),
  'class'=>'form-control',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);
$total_net_cost = array(
  'name'  => 'total_net_cost',
  'id'  => 'total_net_cost',
  'value' => set_value('total_net_cost'),
  'class'=>'form-control',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);
$total_selling_price = array(
  'name'  => 'total_selling_price',
  'id'  => 'total_selling_price',
  'value' => set_value('total_selling_price'),
  'class'=>'form-control',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);
$total_net_profit = array(
  'name'  => 'total_net_profit',
  'id'  => 'total_net_profit',
  'value' => set_value('total_net_profit'),
  'class'=>'form-control',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);
$location = array(
  'name'  => 'location',
  'id'  => 'location',
  'value' => set_value('location'),
  'class'=>'form-control item_row',
  'placeholder'=>'Location',
  'readonly'=>'readonly',
);
$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>

<div class="content-wrapper" style="min-height: 916px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="pull-left">
      <?php echo @$title; ?>
      <small></small>
    </h1>
    <div class="pull-right" >
      <a href="<?php echo site_url('returns');?>" class="btn btn-default" title="Back"><span class="glyphicon glyphicon-arrow-left" style="margin-right: 5px;"></span>Back</a>
    </div>
    <div class="clearfix"></div>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->

    <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"return_add_form",'name'=>'return_add_form', 'data-parsley-validate'=>"")); ?>
    <div class="row">
      <div class="col-xs-12">
        <div id="add_return_res"></div>
        <div class="box box-primary">

          <div class="box-body">
            <div class="row">
            <div class="form-group col-md-6">
              <label class="control-label" for="marketplace">Marketplace:</label>
              <?php  echo form_dropdown($marketplaces, $marketplace_options,$marketplaces['value']); ?>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label" for="sale_date">Date Sold:</label>
              <?php  echo form_input($date_returned); ?>
            </div>
          </div>
            <div class="clearfix"></div><hr />
            <div class="row">
            <div class="form-group col-md-3">
              <input id="product_id" type="hidden" name="product_id" value="">
              <label class="control-label" for="title">Title:</label>
              <?php  echo form_input($item_title); ?>
              <div id="itemerror" style="margin-top:2px;"></div>
            </div>
            <div class="form-group col-md-2">
              <label class="control-label" for="category">Category:</label>
              <?php  echo form_dropdown($categories,$category_options,$categories['value']); ?>
            </div>
          <div class="form-group col-md-2">
              <label class="control-label" for="categories">Location:</label>
              <?php  echo form_input($location); ?>
          </div>
            <div class="form-group col-md-1">
              <label class="control-label" for="quantity">Quantity:</label>
              <?php  echo form_input($item_qty); ?>
            </div>
            <div class="form-group col-md-2">
              <label class="control-label" for="email">Unit Cost:</label>
              <?php  echo form_input($unit_cost); ?>
            </div>
             <div class="form-group col-md-2">
              <label class="control-label" for="email">Total Cost:</label>
              <?php  echo form_input($total_cost); ?>
            </div>
          </div>
          <div class="row">
             <div class="form-group col-md-2">
              <label class="control-label" for="email">Marketplace fee:</label>
              <?php  echo form_input($ebay_fee); ?>
            </div>
             <div class="form-group col-md-2">
              <label class="control-label" for="email">Paypal Fee:</label>
              <?php  echo form_input($paypal_fee); ?>
            </div>
            <div class="form-group col-md-2">
              <label class="control-label" for="email">Shipping Cost:</label>
              <?php  echo form_input($shipping_cost); ?>
            </div>
            <div class="form-group col-md-2">
              <label class="control-label" for="email">Net Cost:</label>
              <?php  echo form_input($net_cost); ?>
            </div>
            <div class="form-group col-md-2">
              <label class="control-label" for="email">Selling price:</label>
              <?php  echo form_input($selling_price); ?>
            </div>
            <div class="form-group col-md-2">
              <label class="control-label" for="email">Net Profit:</label>
              <?php  echo form_input($net_profit); ?>
            </div>
            <div class="form-group col-md-1 pull-right">
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
                    <th style="width: 300px;">Title</th>
                    <th style="width: 200px;">Category</th>
                    <th style="width: 200px;">Location</th>
                    <th style="width: 100px;">Quantity</th>
                    <th style="width: 100px;">Unit Cost</th>
                    <th style="width: 100px;">Total Cost</th>
                    <th style="width: 100px;">Marketplace fee</th>
                    <th style="width: 100px;">Paypal Fee</th>
                    <th style="width: 100px;">Shipping Cost</th>
                    <th style="width: 100px;">Net Cost</th>
                    <th style="width: 100px;">Selling price</th>
                    <th class="text-right"  style="width: 120px;">Net Profit</th>
                  </tr>
                </thead>
                <tbody id="item_data"></tbody>
                <tfoot>
                  <tr>
                    <td colspan="6" class="text-right"><strong>Totals:</strong></td>
                    <td><?php  echo form_input($total_unit_cost); ?></td>
                    <td><?php  echo form_input($total_ebay_fee); ?></td>
                    <td><?php  echo form_input($total_paypal_fee); ?></td>
                    <td><?php  echo form_input($total_shipping_cost); ?></td>
                    <td><?php  echo form_input($total_net_cost); ?></td>
                    <td><?php  echo form_input($total_selling_price); ?></td>
                    <td><?php  echo form_input($total_net_profit); ?></td>
                  </tr>
                </tfoot>
              </table>
            </div><hr/>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <button type="button" id="save_return" class="btn btn-primary pull-right save"><i class="fa fa-spinner fa-spin formloader"></i> Save sale</button>
            <div class="clearfix"></div>
            <div id="alert_area" style="margin-top: 10px;"></div>
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

  $("#date_returned").datepicker({
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
  $('#ebay_fee').on('change',function(){
    this.value=(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));
    calculate_total_cost();
  });
  $('#paypal_fee').on('change',function(){
    this.value=(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));
    calculate_total_cost();
  });
  $('#shipping_cost').on('change',function(){
    this.value=(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));
    calculate_total_cost();
  });
  $('#selling_price').on('change',function(){
    this.value=(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));
    calculate_total_cost();
  });
  //add_item
  $('#add_item').on('click',function(){
    var chk_validate = checkItemRowValidate();

    if(chk_validate==false || !($('#return_add_form').parsley().validate())){
      return false;
    }
    var category_lbl=$("#category_name option:selected").text();
    var product_id=$("#product_id").val();
    var category=$("#category_name").val();
    var location=$("#location").val();
    var item_title=$("#item_title").val();
    var item_quantity=$("#item_qty").val();
    var unit_cost=$("#unit_cost").val();
    var totalcost=$("#total_cost").val();
    var ebay_fee=$("#ebay_fee").val();
    var paypal_fee=$("#paypal_fee").val();
    var shipping_cost=$("#shipping_cost").val();
    var net_cost=$("#net_cost").val();
    var selling_price=$("#selling_price").val();
    var net_profit=$("#net_profit").val();

    var item_data=`<tr class="${rowCount}">
    <td><a data-remove_row ="${rowCount}" class="remove_item" style="color:red;" href=""><i class="fa fa-remove"></i></a>
    <a data-edit_row ="${rowCount}" data-product_id="${product_id}" data-quantity="${item_quantity}" data-unit_cost="${unit_cost}" data-total_cost="${totalcost}" class="edit_item" style="color:orange;" data-ebay_fee="${ebay_fee}" data-paypal_fee="${paypal_fee}" data-shipping_cost="${shipping_cost}" data-net_cost="${net_cost}" data-selling_price="${selling_price}" data-net_profit="${net_profit}" href="" title='Edit Details'><i class="fa fa-edit"></i></a></td>
    <td>${item_title}</td>
    <td>${category_lbl}</td>
    <td>${location}</td>
    <td>${item_quantity}</td>
    <td>${unit_cost}</td>
    <td class="totalcost">${totalcost}</td>
    <td class="ebay_fee">${ebay_fee}</td>
    <td class="paypal_fee">${paypal_fee}</td>
    <td class="shipping_cost">${shipping_cost}</td>
    <td class="net_cost">${net_cost}</td>
    <td class="selling_price">${selling_price}</td>
    <td class="net_profit">${net_profit}</td>
    <tr>`;
    $('#item_data').append(item_data);
    product_items[rowCount]={'product_id':product_id,
      'category_id':category,
      'item_title':item_title,
      'location':location,
      'item_qty':item_quantity,
      'unit_cost':unit_cost,
      'total_cost':totalcost,
      'ebay_fee':ebay_fee,
      'paypal_fee':paypal_fee,
      'shipping_cost':shipping_cost,
      'net_cost':net_cost,
      'selling_price':selling_price,
      'net_profit':net_profit,
    };

    $('#item_qty').val(1);
    $('.item_row').val("");
    rowCount++;
    calculate_grand_total();
  });

  $(document).on('click','.remove_item',function(e){
    e.preventDefault();
    target = $(this).attr('data-remove_row');
    $('.'+target).remove();
    // product_items.splice(target,1);
    delete product_items[target];
    calculate_grand_total();
  });

  $(document).on('click','.edit_item',function(e){
    e.preventDefault();
    target = $(this).attr('data-edit_row');
    var productId = $(this).attr('data-product_id');
    var quantity = $(this).attr('data-quantity');
    var unitCost = $(this).attr('data-unit_cost');
    var totalCost = $(this).attr('data-total_cost');
    var ebay_fee = $(this).attr('data-ebay_fee');
    var paypal_fee = $(this).attr('data-paypal_fee');
    var shipping_cost = $(this).attr('data-shipping_cost');
    var net_cost = $(this).attr('data-net_cost');
    var selling_price = $(this).attr('data-selling_price');
    var net_profit = $(this).attr('data-net_profit');
    $('.'+target).remove();

    delete product_items[target];
    calculate_grand_total();
    $('.item_row').val('');

    get_product_details(productId,true);
    $("#item_qty").val(quantity);
    $("#unit_cost").val(unitCost);
    $("#total_cost").val(totalCost);
    $("#ebay_fee").val(ebay_fee);
    $("#paypal_fee").val(paypal_fee);
    $("#shipping_cost").val(shipping_cost);
    $("#net_cost").val(net_cost);
    $("#selling_price").val(selling_price);
    $("#net_profit").val(net_profit);
  });

  $('form input').keydown(function (e) { //to stop from from submitting on enter
      if (e.keyCode == 13) {
          e.preventDefault();
          return false;
      }
  });
})

$("#item_title").autocomplete({
  source: "<?php echo site_url('returns/search_product/?');?>",
  change: function (event, ui) {
    if (ui.item == null || ui.item == undefined) {
      $("#item_title").val("");
      $("#category_name").val("");
      $("#unit_cost").val("");
      $("#total_cost").val("");
      $('#itemerror').empty();
      $('#itemerror').append('<p style="color:#ff3111;font-size: 0.9em;line-height: 0.9em;">Please select a valid product from suggestion list.</p>');
    }
    else {
      $('#itemerror').empty();
    }
  },
  select: function (event, ui) {
    get_product_details(ui.item.product_id);
  }
})

$("#save_return").click(function(){

  // $('#return_add_form').parsley().validate();

  if(Object.keys(product_items).length<1){
    alert('No sale items added.');
    return false;
  }
  var _this=$(this);
  var marketplace_name=$("#marketplace_name").val();
  var date_returned=$("#date_returned").val();
  var total_cost = $('#total_unit_cost').val();
  var total_ebay_fee = $('#total_ebay_fee').val();
  var total_paypal_fee = $('#total_paypal_fee').val();
  var total_shipping_cost = $('#total_shipping_cost').val();
  var total_net_cost = $('#total_net_cost').val();
  var total_selling_price = $('#total_selling_price').val();
  var total_net_profit = $('#total_net_profit').val();
  $.ajax({
    url:'<?php echo site_url('returns/save_return'); ?>',
    dataType:'json',
    type:'POST',
    data:{marketplace_name:marketplace_name,date_returned:date_returned,total_cost:total_cost,total_ebay_fee:total_ebay_fee,total_paypal_fee:total_paypal_fee,total_shipping_cost:total_shipping_cost,total_net_cost:total_net_cost,total_selling_price:total_selling_price,total_net_profit:total_net_profit,product_items:product_items,"<?php echo $csrf['name'];?>":"<?php echo $csrf['hash'];?>"},
    // shows the loader element before sending.
    beforeSend: function (){before(_this)},
    // hides the loader after completion of request, whether successfull or failor.
    complete: function (){complete(_this)},
    success:function(result){
      if(result.status==1)
      {

        $('#alert_area').html('<div class="alert alert-success" id="disappear_add"  >'+result.message+'</div>');
        setTimeout(function(){$('#disappear_add').fadeOut('slow')},3000)
        $('#return_add_form')[0].reset();
        $('#return_add_form').parsley().reset();
        $('#item_data').empty();
        product_items={};
        $('#itemerror').empty();

      }
      else
      {
        $('#alert_area').empty().html('<div class="alert alert-danger" id="disappear_add">'+result.message+'</div>');
        setTimeout(function(){$('#disappear_add').fadeOut('slow')},3000)
      }
    }
  });

  return false;
});
</script>
<script type="text/javascript">
function calculate_total_cost(){
 var quantity=1;
 var unitcost=0.00;
 var totalcost = 0.00;
 var ebay_fee=0;
 var paypal_fee=0;
 var shipping_cost=0;
 var additional_charge=0;
 var net_cost = 0.00;
 var net_profit = 0.00;
 var selling_price = 0.00;
  quantity=$('#item_qty').val();
  unitcost = $('#unit_cost').val();
  if ($.isNumeric(quantity) && $.isNumeric(unitcost)) {
    quantity = parseInt(quantity);
    unitcost = parseFloat(unitcost);
    if(unitcost>0 && quantity){
      totalcost=unitcost*quantity;
    }
  }
 $('#total_cost').val(totalcost.toFixed(2));
  ebay_fee=$("#ebay_fee").val();
  paypal_fee=$("#paypal_fee").val();
  shipping_cost=$("#shipping_cost").val();
  if($.isNumeric(ebay_fee)){
    additional_charge+=parseFloat(ebay_fee);
  }
  if($.isNumeric(paypal_fee)){
    additional_charge+=parseFloat(paypal_fee);
  }
  if($.isNumeric(shipping_cost)){
    additional_charge+=parseFloat(shipping_cost);
  }
 net_cost=totalcost+additional_charge;
 $('#net_cost').val(net_cost.toFixed(2));
selling_price = $('#selling_price').val();
if(selling_price>0){
 net_profit=selling_price-net_cost;
}
$('#net_profit').val(net_profit.toFixed(2));
}
function calculate_grand_total(){
  var total_unit_cost=0.00;
  var total_ebay_fee= 0.00;
  var total_paypal_fee= 0.00;
  var total_shipping_cost= 0.00;
  var total_net_cost=0.00;
  var total_selling_price=0.00;
  var total_net_profit=0.00;

  $(".totalcost").each(function (){
    var get_text_totalcost = $(this).text();
    if ($.isNumeric(get_text_totalcost)) {
      total_unit_cost += parseFloat(get_text_totalcost);
    }
  });

  $(".ebay_fee").each(function (){
    var get_text_ebay_fee = $(this).text();
    if ($.isNumeric(get_text_ebay_fee)) {
      total_ebay_fee += parseFloat(get_text_ebay_fee);
    }
  });

   $(".paypal_fee").each(function (){
    var get_text_paypal_fee = $(this).text();
    if ($.isNumeric(get_text_paypal_fee)) {
      total_paypal_fee += parseFloat(get_text_paypal_fee);
    }
  });

   $(".shipping_cost").each(function (){
    var get_text_shipping_cost = $(this).text();
    if ($.isNumeric(get_text_shipping_cost)) {
      total_shipping_cost += parseFloat(get_text_shipping_cost);
    }
  });

    $(".net_cost").each(function (){
    var get_text_net_cost = $(this).text();
    if ($.isNumeric(get_text_net_cost)) {
      total_net_cost += parseFloat(get_text_net_cost);
    }
  });

   $(".selling_price").each(function (){
    var get_text_selling_price = $(this).text();
    if ($.isNumeric(get_text_selling_price)) {
      total_selling_price += parseFloat(get_text_selling_price);
    }
  });

  total_net_profit=total_selling_price-total_net_cost;
 /* grand_total=calculated_total_sum-additional_charge;*/
  $('#total_unit_cost').val('-'+total_unit_cost.toFixed(2));
  $('#total_ebay_fee').val('-'+total_ebay_fee.toFixed(2));
  $('#total_paypal_fee').val('-'+total_paypal_fee.toFixed(2));
  $('#total_shipping_cost').val('-'+total_shipping_cost.toFixed(2));
  $('#total_net_cost').val('-'+total_net_cost.toFixed(2));
  $('#total_selling_price').val('-'+total_selling_price.toFixed(2));
  $('#total_net_profit').val('-'+total_net_profit.toFixed(2));
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
                if($('#unit_cost').val()=='' ){
                    $('#unit_cost').css('border','1px solid #f4516c');
                    unit_price_flag = 1;
                }else{
                    $('#unit_cost').css('border','');
                }
            if(unit_price_flag==1){
                return false;
            }

             var unit_selling_price = 0;
                if($('#selling_price').val()=='' ){
                    $('#selling_price').css('border','1px solid #f4516c');
                    unit_selling_price = 1;
                }else{
                    $('#selling_price').css('border','');
                }
            if(unit_selling_price==1){
                return false;
            }


            var total_cost_flag = 0;
                if($('#total_cost').val()=='' ){
                    $('#total_cost').css('border','1px solid #f4516c');
                    total_cost_flag = 1;
                }else{
                    $('#total_cost').css('border','');
                }
            if(total_cost_flag==1){
                return false;
            }
    }



function get_product_details($product_id,$flag=false){
  $.ajax({
    url:'<?php echo site_url('returns/get_product/'); ?>'+$product_id,
    dataType:'json',
    type:'POST',
    data:{"<?php echo $csrf['name'];?>":"<?php echo $csrf['hash'];?>"},
    success:function(result){
      if(result)
      {
        if ($flag==true) {
          $("#product_id").val(result[0].product_id);
          $("#item_title").val(result[0].item_title);
          $("#category_name").val(result[0].category_id).prop('disabled',true);
          $("#location").val(result[0].location);
        }else {
          $("#product_id").val(result[0].product_id);
          $("#item_title").val(result[0].item_title);
          $("#location").val(result[0].location);
          $("#unit_cost").val(result[0].unit_cost);
          $("#total_cost").val(result[0].unit_cost);
          $("#item_qty").val(1);
          $("#category_name").val(result[0].category_id).prop('disabled',true);
          $("#net_cost").val(result[0].unit_cost);
        }
      }
    }
  });
}
</script>
