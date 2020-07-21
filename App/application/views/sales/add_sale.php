<?php
$invoice_number = array(
  'name'  => 'invoice_number',
  'id'  => 'invoice_number',
  'value' => set_value('invoice_number',$invoice_number),
  'class'=>'form-control',
  'placeholder'=>'Invoice No.',
  'readonly'=>'readonly'
);
$invoice_date = array(
  'name'  => 'invoice_date',
  'id'  => 'invoice_date',
  'value' => set_value('invoice_date',date('m/d/Y',time())),
  'class'=>'form-control',
  'data-parsley-required'=>'true',
  'readonly'=>'readonly'
);
$client_options = array(''=>'--Select--');
if($clients && count($clients)> 0)
{
  foreach($clients as $val)
  {
    $client_options[$val['client_id']]= $val['client_orgnisation_name'];
  }
}
$clients = array(
  'name'  => 'client_name',
  'id'  => 'client_name',
  'value' => set_value('client_name'),
  'class'=>'form-control',
  'data-parsley-required'=>'true'
);
$wherehouse_options = array(''=>'--Select--');
if($wherehouses && count($wherehouses)> 0)
{
  foreach($wherehouses as $val)
  {
    $wherehouse_options[$val['wherehouse_id']]= $val['wherehouse_name'];
  }
}
$wherehouses = array(
  'name'  => 'wherehouse',
  'id'  => 'wherehouse',
  'value' => set_value('wherehouse'),
  'class'=>'form-control item_row',
);

$transportation_mode = array(
  'name'  => 'transportation_mode',
  'id'  => 'transportation_mode',
  'value' => set_value('transportation_mode'),
  'class'=>'form-control',
  'placeholder'=>'Transportation Mode',
);
$distacnce_to_transport = array(
  'name'  => 'distacnce_to_transport',
  'id'  => 'distacnce_to_transport',
  'value' => set_value('distacnce_to_transport'),
  'class'=>'form-control',
  'placeholder'=>'Approx Dist to Transport (Km)',
);
$transporter_name = array(
  'name'  => 'transporter_name',
  'id'  => 'transporter_name',
  'value' => set_value('transporter_name'),
  'class'=>'form-control',
  'placeholder'=>'Transporter Name',
);
$transporter_id = array(
  'name'  => 'transporter_id',
  'id'  => 'transporter_id',
  'value' => set_value('transporter_id'),
  'class'=>'form-control',
  'placeholder'=>'Transporter Id',
);
$transporter_document_no = array(
  'name'  => 'transporter_document_no',
  'id'  => 'transporter_document_no',
  'value' => set_value('transporter_document_no'),
  'class'=>'form-control',
  'placeholder'=>'Transporter Doc No.',
);
$transporter_document_date = array(
  'name'  => 'transporter_document_date',
  'id'  => 'transporter_document_date',
  'value' => set_value('transporter_document_date',date('m/d/Y',time())),
  'class'=>'form-control',
  'placeholder'=>'Transporter Doc Date',
  'readonly'=>'readonly'
);
$vechicle_no = array(
  'name'  => 'vechicle_no',
  'id'  => 'vechicle_no',
  'value' => set_value('vechicle_no'),
  'class'=>'form-control',
  'placeholder'=>'Vehicle No',
);
$place_of_supply = array(
  'name'  => 'place_of_supply',
  'id'  => 'place_of_supply',
  'value' => set_value('place_of_supply'),
  'class'=>'form-control',
  'placeholder'=>'Place Of Supply',
);
$buyer_order = array(
  'name'  => 'buyer_order',
  'id'  => 'buyer_order',
  'value' => set_value('buyer_order'),
  'class'=>'form-control',
  'placeholder'=>'Buyer Order',
);
$dispatch_document_no = array(
  'name'  => 'dispatch_document_no',
  'id'  => 'dispatch_document_no',
  'value' => set_value('dispatch_document_no'),
  'class'=>'form-control',
  'placeholder'=>'Dispatch Document No.',
);
$delevery_note_date = array(
  'name'  => 'delevery_note_date',
  'id'  => 'delevery_note_date',
  'value' => set_value('delevery_note_date',date('m/d/Y',time())),
  'class'=>'form-control',
  'placeholder'=>'Po No.',
  'readonly'=>'readonly'
);
$dispatch_through = array(
  'name'  => 'dispatch_through',
  'id'  => 'dispatch_through',
  'value' => set_value('dispatch_through'),
  'class'=>'form-control',
  'placeholder'=>'Dispatched Through',
);
function measurement_option_select($measurements){
  $option="";
  foreach ($measurements as $measurements) {
    $option .= '<option value="'.$measurements['measurement_id'].'">'.$measurements['measurement_name'].'</option>';
  }
  return $option;
}
function tax_option_select($taxes){
  $option="";
  foreach ($taxes as $tax) {
    $option .= '<option value="'.$tax["tax_id"].'">'.$tax["tax_name"].'@'.$tax["tax_percentage"].'%'.'</option>';
  }
  return $option;
}
function discount_option_select($discounts){
$option="";
  foreach ($discounts as $discount) {
    $option .= '<option value="'.$discount["discount_id"].'">'.$discount["discount_name"].'@'.$discount["discount_percentage"].'%'.'</option>';
  }
  return $option;
}
$item_title = array(
  'name'  => 'item_title',
  'id'  => 'item_title',
  'value' => set_value('item_title'),
  'class'=>'form-control',
  'placeholder'=>'Enter Product Name/Sku',
);
$sub_total_amount = array(
  'name'  => 'sub_total_amount',
  'id'  => 'sub_total_amount',
  'value' => set_value('sub_total_amount'),
  'class'=>'form-control',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);
$total_discount_amount = array(
  'name'  => 'total_discount_amount',
  'id'  => 'total_discount_amount',
  'value' => set_value('total_discount_amount'),
  'class'=>'form-control',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);

$total=array(
   'name'  => 'total',
  'id'  => 'total',
  'value' => set_value('total'),
  'class'=>'form-control',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);
$less_round_off=array(
   'name'  => 'less_round_off',
  'id'  => 'less_round_off',
  'value' => set_value('less_round_off'),
  'class'=>'form-control',
  'placeholder'=>'0.00',
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
$tigst = array(
  'name'  => 'tigst',
  'id'  => 'tigst',
  'value' => set_value('igst'),
  'class'=>'form-control',
  'placeholder'=>'0',
   'type'=>'number',
   'min'=>'0',
   'step'=>'0.01',
   'readonly'=>'readonly',
  'data-parsley-required'=>'true',
);
$tcgst = array(
  'name'  => 'tcgst',
  'id'  => 'tcgst',
  'value' => set_value('cgst'),
  'class'=>'form-control',
  'placeholder'=>'0',
   'type'=>'number',
   'min'=>'0',
   'step'=>'0.01',
   'readonly'=>'readonly',
  'data-parsley-required'=>'true',
);
$tsgst = array(
  'name'  => 'tsgst',
  'id'  => 'tsgst',
  'value' => set_value('sgst'),
  'class'=>'form-control',
  'placeholder'=>'0',
  'type'=>'number',
  'min'=>'0',
  'step'=>'0.01',
  'readonly'=>'readonly',
  'data-parsley-required'=>'true',
);
$notes = array(
  'name'  => 'notes',
  'id'  => 'notes',
  'value' => set_value('notes'),
  'class'=>'form-control s_addr',
  'placeholder'=>'Notes...',
  'rows'=>4,
);
$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
$i=0;
?>
<style type="text/css">
  .items-table-holder {
    min-height: 230px;
    max-height: 230px;
    overflow-y: scroll;
    border: 1px solid #ccc;
}
.hidden_info{
    border: none;
    width: 100%;
    pointer-events: none;
    background: none;
}

.well{
  border:none;
  border-radius: 0px;
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
    <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"sale_add_form",'name'=>'sale_add_form', 'data-parsley-validate'=>"")); ?>
  <div class="row">
    <div class="col-xs-12">
      <div id="add_purchase_res"></div>
      <div class="box box-danger">
       <div class="box-body">
        <div class="row">
          <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Invoice No.:</label>
             <?php  echo form_input($invoice_number); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="invoice_date">Invoice Date:</label>
             <?php  echo form_input($invoice_date); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Clients:</label>
             <?php  echo form_dropdown($clients, $client_options,$clients['value']); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Wherehouse:</label>
            <?php  echo form_dropdown($wherehouses, $wherehouse_options,$wherehouses['value']); ?>
          </div>
        </div>
           <div class="clearfix"></div>
        <div class="row billing_shipping_address">
          <hr />
          <div class="form-group col-md-6"> 
            <div class="well">
            <h4><strong>Billed To :</strong></h4>
                <input class="hidden_info client_orgnisation_name" name="client_orgnisation_name" type="text" value=""/><br> 
                <input class="hidden_info" name="client_address_b" type="text" value="" id="client_address_b"/><br> 
                <input class="hidden_info" name="client_city_b" type="text" value="" id="client_city_b"/><br>
                <input class="hidden_info" name="client_state_b" type="text" value="" id="client_state_b"/><br>
                <input class="hidden_info" name="client_country_b" type="text" value="" id="client_country_b"/><br>
                <input class="hidden_info" name="client_zip_b" type="text" value="" id="client_zip_b"/><br>
                 <input class="hidden_info client_email" name="client_email" type="text" value=""/><br> 
                <input class="hidden_info client_mobile" name="client_mobile" type="text" value=""/><br>
                <input class="hidden_info client_tax_number" name="client_tax_number" type="text" value=""/><br> 
              </div>
          </div>
          <div class="form-group col-md-6">
            <div class="well">
            <h4><strong>Shipped To :</strong></h4>
               <input class="hidden_info client_orgnisation_name" name="client_orgnisation_name" type="text" value="" /><br> 
               <input class="hidden_info" name="client_address_s" type="text" value="" id="client_address_s"/><br> 
                <input class="hidden_info" name="client_city_s" type="text" value="" id="client_city_s"/><br>
                <input class="hidden_info" name="client_state_s" type="text" value="" id="client_state_s"/><br>
                <input class="hidden_info" name="client_country_s" type="text" value="" id="client_country_s"/><br>
                <input class="hidden_info" name="client_zip_s" type="text" value="" id="client_zip_s"/><br>
                <input class="hidden_info client_email" name="client_email" type="text" value=""/><br> 
                <input class="hidden_info client_mobile" name="client_mobile" type="text" value=""/><br>
                <input class="hidden_info client_tax_number" name="client_tax_number" type="text" value=""/><br>
              </div>
          </div>
        </div>
         <div class="clearfix"></div><hr />
        <div class="row"> 
            <input type="hidden" value="" name="is_submit_and_pay" id="is_submit_and_pay">
          <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Transportation Mode:</label>
             <?php  echo form_input($transportation_mode); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Approx Dist to Transport (Km):</label>
             <?php  echo form_input($distacnce_to_transport); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Transporter Name:</label>
             <?php  echo form_input($transporter_name); ?>
          </div>
           <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Transporter Id:</label>
             <?php  echo form_input($transporter_id); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Transporter Doc No:</label>
             <?php  echo form_input($transporter_document_no); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="date_purchased">Transporter Doc Date:</label>
             <?php  echo form_input($transporter_document_date); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Vehicle No:</label>
             <?php  echo form_input($vechicle_no); ?>
          </div>
           <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Place Of Supply:</label>
             <?php  echo form_input($place_of_supply); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Buyer Order:</label>
             <?php  echo form_input($buyer_order); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Dispatch Document No:</label>
             <?php  echo form_input($dispatch_document_no); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="date_purchased">Delivery Note Date:</label>
             <?php  echo form_input($delevery_note_date); ?>
          </div>
           <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Dispatched Through:</label>
             <?php  echo form_input($dispatch_through); ?>
          </div>
        </div>
        <div class="clearfix"></div><hr />
        <div class="row">
           <div class="form-group col-md-12">
              <label class="control-label" for="item_title">Product Names:</label>
              <?php  echo form_input($item_title); ?>
               <div class="clearfix"></div>
          </div>
       </div>
        <div class="clearfix"></div><hr />
        <div class="row">
        <div class="col-md-12">
        <div class="items-table-holder">
              <table id="items-table" class="table table-bordered table-condensed table-hover">
                    <thead>
                       <tr>
                        <th style="width: 25px;"></th>
                        <th style="width: 300px;">Title</th>
                        <th style="width: 100px;">HSN/SAC</th>
                        <th style="width: 50px;">Unit</th>
                        <th style="width: 100px;">Product Price</th>
                        <th style="width: 100px;">Quantity</th>
                        <th style="width: 100px;">Sub Total</th>
                        <th colspan="2" style="width: 350px;">Discount</th>
                        <th colspan="2" style="width: 400px;">IGST</th>
                        <th colspan="2" style="width: 400px;">CGST</th>
                        <th colspan="2" style="width: 400px;">SGST</th>
                        <th style="width: 120px;">Total</th>
                      </tr>
                    </thead>
                    <tbody id="item_data"></tbody>
                  </table>
             </div>
           </div>
           </div>
             <div class="clearfix"></div><hr />
      <div class="row">
        <div class="col-md-9">
          <div class="form-group col-md-12">
            <div class="well">
             <div class="checkbox">
                <label>
                  <input type="checkbox" name="reverse_charge" value="1"> Reverse Charge
                </label>
              </div>
              <?php echo form_textarea($notes); ?>
            </div> 
          </div>
        </div>
        <div class="col-md-3">
               <table class="pull-right">
                 <tr>
                  <td>
                    <div class="form-group total_amt">
                    <div class="pull-right">
                     <?php  echo form_input($sub_total_amount); ?>
                    </div>
                    <label class="pull-right control-label">Sub Total:</label>
                   </div>
                 </td>
                </tr>
                  <tr>
                  <td>
                    <div class="form-group total_amt">
                    <div class="pull-right">
                     <?php  echo form_input($total_discount_amount); ?>
                    </div>
                    <label class="pull-right control-label">Total Discount:</label>
                   </div>
                 </td>
                </tr>
             <tr>
                  <td>
                  <div class="form-group total_amt">
                    <div class="pull-right">
                     <?php  echo form_input($tigst); ?>
                    </div>
                    <label class="pull-right control-label">IGST:</label>
                </div>
              </td>
            </tr>
            <tr>
                  <td>
                  <div class="form-group total_amt">
                    <div class="pull-right">
                     <?php  echo form_input($tcgst); ?>
                    </div>
                    <label class="pull-right control-label">CGST:</label>
                </div>
              </td>
            </tr>
            <tr>
                  <td>
                  <div class="form-group total_amt">
                    <div class="pull-right">
                     <?php  echo form_input($tsgst); ?>
                    </div>
                    <label class="pull-right control-label">SGST:</label>
                </div>
              </td>
            </tr>
             <tr>
                  <td>
                  <div class="form-group total_amt">
                    <div class="pull-right">
                     <?php  echo form_input($total); ?>
                    </div>
                    <label class="pull-right control-label">Total:</label>
                </div>
              </td>
            </tr>
            <tr>
                  <td>
                  <div class="form-group total_amt">
                    <div class="pull-right">
                     <?php  echo form_input($less_round_off); ?>
                    </div>
                    <label class="pull-right control-label">(-)Less Round Off:</label>
                </div>
              </td>
            </tr>
             <tr>
                  <td>
                  <div class="form-group total_amt">
                    <div class="pull-right">
                     <?php  echo form_input($grand_total); ?>
                    </div>
                    <label class="pull-right control-label">Grand Total:</label>
                </div>
              </td>
            </tr>
          </table>
        </div>
      </div>
       </div><!-- /.box-body -->
       <div class="box-footer">
      <button type="submit" id="save_purchase" class="btn btn-custom pull-right save"><i class="fa fa-spinner fa-spin formloader"></i> Save Sale</button>
       <button style="margin-right:5px;" type="button" id="save_and_pay" class="btn btn-custom pull-right save">Save & Pay</button>
      <div class="clearfix"></div>
     </div>
     </div>
   </div>
 </div>
 <?php echo form_close(); ?>
</section><!-- /.content -->
</div>
<script>
  var rowCount = 0;
  var taxamount=0.00;
  var unit_arr=JSON.parse('<?php echo json_encode($measurements);?>');
 $(document).ready(function(){
   $('body').addClass('sidebar-collapse');
   $('#save_and_pay').on('click',function(){
    if($('#is_submit_and_pay').val('1')){
       $('#sale_add_form').trigger('submit');
    }
  });
  $('.billing_shipping_address').slideUp();
 $("#invoice_date").datepicker({
      dateFormat: 'mm/dd/yy',
      maxDate: new Date,
      changeMonth: true,changeYear: true,yearRange: "-100:+0",
 });
$("#delevery_note_date").datepicker({
      dateFormat: 'mm/dd/yy',
      maxDate: new Date,
      changeMonth: true,changeYear: true,yearRange: "-100:+0",
 });
$("#item_title").autocomplete({
  source: "<?php echo site_url('purchases/search_product/?');?>",
   change: function (event, ui) {
    if (ui.item == null || ui.item == undefined) {
      $('.item_row').val('');
    }
  },
  select: function (event, ui) {
     get_product_details(ui.item.product_id);
  }
}).autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<div>" + item.item_title + "<br>" + item.sku + "</div>" )
        .appendTo( ul );
    };
 $(document).on('click','.remove_item',function(e){
        e.preventDefault();
        target = $(this).attr('data-remove_row');
        $('.'+target).remove();
       calculate_price();
      });

 $(document).on('change','#client_name',function(e){
  var id=$(this).val();
  if(id){
    get_client_details(id);
  }
  })
 $(document).on('keyup keypress blur change','.unit_price_inp,.quantity_inp,.discount_inp,.tax_inp',function (){
  var count=$(this).attr('count');
  calculate_price(count);
 });

  //Add sale
  $('#sale_add_form').parsley();
  $("#sale_add_form").on('submit',function(){
    var _this=$(this);
    var values = $('#sale_add_form').serialize();
    $.ajax({
      url:'<?php echo site_url('sales/save_sale'); ?>',
      dataType:'json',
      type:'POST',
      data:values,
      // shows the loader element before sending.
      beforeSend: function (){before(_this)},
      // hides the loader after completion of request, whether successfull or failor.
      complete: function (){complete(_this)},
      success:function(result){
        if(result.status==1){

         toastr.success(result.message);
          $('#sale_add_form')[0].reset();
          $('#sale_add_form').parsley().reset();
          $('#item_data').empty();
          $('.billing_shipping_address').slideUp();
           setTimeout(function(){window.location.href = result.redirect_url},4000);
        }else{
          toastr.error(result.message);
        }
      }
    });
    return false;
  });
 })


 </script>
<script type="text/javascript">
  function get_client_details(client_id){
       $.ajax({
        url:'<?php echo site_url('sales/get_client_details/'); ?>'+client_id,
        dataType:'json',
        type:'GET',
        success:function(result){
           if(result)
           {
             if(result){
              console.log(result);
              $('.billing_shipping_address').slideDown();
                  $('.client_orgnisation_name').val(result.client_orgnisation_name);
                  $('.client_email').val(result.client_email);
                  $('.client_mobile').val(result.client_mobile);
                  $('.client_tax_number').val(result.client_tax_number);
                  $('#client_orgnisation_phone_b').val(result.client_orgnisation_phone);
                  $('#client_email_b').val(result.client_email);
                  $('#client_tax_number').val(result.client_tax_number);
                  $('#client_address_b').val(result.client_address_b);
                  $('#client_city_b').val(result.client_city_b);
                  $('#client_state_b').val(result.client_state_b);
                  $('#client_country_b').val(result.client_country_b);
                  $('#client_zip_b').val(result.client_zip_b);
                  $('#client_address_s').val(result.client_address_b);
                  $('#client_city_s').val(result.client_city_b);
                  $('#client_state_s').val(result.client_state_b);
                  $('#client_country_s').val(result.client_country_b);
                  $('#client_zip_s').val(result.client_zip_b);
                  $('#client_email_s').val(result.client_email);
             }               
           }
        }
       });
  }
function get_product_details($product_id){
       $.ajax({
        url:'<?php echo site_url('purchases/get_product/'); ?>'+$product_id,
        dataType:'json',
        type:'POST',
        data:{"<?php echo $csrf['name'];?>":"<?php echo $csrf['hash'];?>"},
        success:function(result){
           if(result)
           {
                  var unit_option='';
                  console.log(result);
                  $.each(unit_arr, function(index, value) {
                       var selected =(result[0].measurement==value.measurement_id)?'selected':'';
                       unit_option+='<option '+selected+' value="'+value.measurement_id+'">'+value.measurement_name+'</option>';
                   }); 

                var item_data=`<tr class="${rowCount} item_row" id="row_${rowCount}">
                     <input type="hidden" value="${result[0].product_id}" count="${rowCount}" id="product_id_${rowCount}" name="item[${rowCount}][product_id]">
                     <input class="form-control discount_name_inp" count="${rowCount}" type="hidden" id="discount_name_${rowCount}" value="" name="item[${rowCount}][discount_name]">
                     <input class="form-control tax_name_inp" count="${rowCount}" type="hidden" id="tax_name_${rowCount}" value="" name="item[${rowCount}][tax_name]">
                  <input class="form-control hidden_info" count="${rowCount}" id="measurement_name_${rowCount}" name="item[${rowCount}][measurement_name]" type="hidden" value="${result[0].measurement_name}">
                     <td><a data-remove_row ="${rowCount}" count="${rowCount}" class="remove_item" style="color:red;" href=""><i class="fa fa-remove"></i></a></td>
                     <td><input class="form-control hidden_info" count="${rowCount}" id="item_title_${rowCount}" name="item[${rowCount}][item_title]" type="text" value="${result[0].item_title}"></td>
                     <td><input class="form-control hidden_info" count="${rowCount}" id="hsnsac_code_${rowCount}" name="item[${rowCount}][hsn_sac_code]" type="text" value="${result[0].hsn_sac_code}"></td>
                     <td style="width:150px;"><select required="true" id="measurement_id_${rowCount}" count="${rowCount}" class="form-control measurement_inp" name="item[${rowCount}][measurement_id]"> ${unit_option}</select></td> 
                     <td><input min="0"  id="unit_cost_${rowCount}" count="${rowCount}" class="form-control unit_price_inp" type="text" value="${result[0].unit_cost}" name="item[${rowCount}][unit_cost]"></td>
                     <td><input min="1" id="item_qty_${rowCount}" count="${rowCount}" class="form-control quantity_inp" type="number" value="1" 
                     name="item[${rowCount}][item_qty]"></td>
                     <td><input id="total_amount_${rowCount}" count="${rowCount}" class="form-control hidden_info price_total_inp hidden_info" type="text" value="${result[0].unit_cost}" 
                     name="item[${rowCount}][total_amount]"></td>

                     <td><input  class="form-control price_discount_percent" count="${rowCount}" name="item[${rowCount}][discount_percent]" id="discount_percent_${rowCount}" type="text" value="0"></td>

                      <td><input  class="form-control price_discount_amount hidden_info" count="${rowCount}" name="item[${rowCount}][discount_amount]" id="discount_amount_${rowCount}" type="text" value="0"></td>

                      
                     <td><input class="form-control price_igst_percent" count="${rowCount}" name="item[${rowCount}][tax_igst_percent]" id="tax_igst_percent_${rowCount}" type="text" value="${result[0].igst}"></td>
                     <td><input class="form-control price_tax_igst_amount hidden_info" count="${rowCount}" name="item[${rowCount}][tax_igst_amount]" id="tax_igst_amount_${rowCount}" type="text" value="0"></td>

                     <td><input class="form-control price_cgst_percent" count="${rowCount}" name="item[${rowCount}][tax_cgst_percent]" id="tax_cgst_percent_${rowCount}" type="text" value="${result[0].cgst}"></td>
                     <td><input class="form-control price_tax_cgst_amount hidden_info" count="${rowCount}" name="item[${rowCount}][tax_cgst_amount]" id="tax_cgst_amount_${rowCount}" type="text" value="0"></td>

                     <td><input class="form-control price_sgst_percent" count="${rowCount}" name="item[${rowCount}][tax_sgst_percent]" id="tax_sgst_percent_${rowCount}" type="text" value="${result[0].sgst}"></td>
                     <td><input class="form-control price_tax_sgst_amount hidden_info" count="${rowCount}" name="item[${rowCount}][tax_sgst_amount]" id="tax_sgst_amount_${rowCount}" type="text" value="0"></td>

                     <td><input class="form-control price_gtotal_inp hidden_info" count="${rowCount}" type="text"  value="${result[0].unit_cost}"id="total_gamount_${rowCount}" name="item[${rowCount}][total_gamount]"></td>
                 <tr>`;
                rowCount++;
                $('#item_data').append(item_data);
                $('#item_title').val('');
                calculate_price(rowCount);
                $('.unit_price_inp').keyup();
           }
        }
       });
  }

   
    function calculate_price(rowCount) {
      var subtotal=0;
      var discount_amount=0;
      var tax_amount=0;
      var total_cost=0;
      var amount_after_discount=0;
      var amount_after_tax=0;
      var igst_amount=0;
      var cgst_amount=0;
      var sgst_amount=0;
      var total_gst_tax=0;
      var total_gamount=0;
      //get unitcost and qty value
      var unit_cost=$('#unit_cost_'+rowCount).val();
      var item_qty=$('#item_qty_'+rowCount).val();
      
      if (($.isNumeric(unit_cost)&&unit_cost>0)&&($.isNumeric(item_qty)&&item_qty>0)) 
          {
             subtotal= parseFloat(item_qty) * parseFloat(unit_cost);
          }
       $('#item_qty_'+rowCount).val();
       //perform subtotal
       $('#total_amount_'+rowCount).val(subtotal);
       //perform discount
      var discount_percent=$('#discount_percent_'+rowCount).val();
      discount_amount=subtotal*discount_percent/100;
      $('#discount_amount_'+rowCount).val(discount_amount);

      amount_after_discount  =  subtotal-discount_amount;
      //perform tax igst
      var igst_percent=$('#tax_igst_percent_'+rowCount).val();
      igst_amount=amount_after_discount*igst_percent/100;
      $('#tax_igst_amount_'+rowCount).val(igst_amount);       
     

      //perform tax cgst
      var cgst_percent=$('#tax_cgst_percent_'+rowCount).val();
      cgst_amount=amount_after_discount*cgst_percent/100;
      $('#tax_cgst_amount_'+rowCount).val(cgst_amount);       
     

      //perform tax sgst
      var sgst_percent=$('#tax_sgst_percent_'+rowCount).val();
      sgst_amount=amount_after_discount*sgst_percent/100;
      $('#tax_sgst_amount_'+rowCount).val(sgst_amount);       
     
       total_gst_tax=parseFloat(igst_amount)+parseFloat(cgst_amount)+parseFloat(sgst_amount)
         

         total_gamount=subtotal-discount_amount+parseFloat(total_gst_tax);
        $('#total_gamount_'+rowCount).val(total_gamount);    


       var unit=$('#measurement_id_'+rowCount+' :selected').text();
       $('#measurement_name_'+rowCount).val(unit);
    
      //perform total amount


      //perform final amount
    var all_price_total_inp=$('.price_total_inp');
    var all_discount_total_inp=$('.price_discount_amount'); 
    var all_tax_total_inp=$('.price_tax_amount');
    var all_price_totalg_inp=$('.price_gtotal_inp');

    var all_price_igst_inp=$('.price_tax_igst_amount');
    var all_price_cgst_inp=$('.price_tax_cgst_amount');
    var all_price_sgst_inp=$('.price_tax_sgst_amount');

    var total_price=0.00;
    var total_discount=0.00;
    var total_tax=0.00;
    var total_gprice=0.00;

    var total_igstprice=0.00;
    var total_cgstprice=0.00;
    var total_sgstprice=0.00;

    $.each(all_price_total_inp,function (i,v){
      total_price=total_price+parseFloat($(v).val());
    })
    $.each(all_discount_total_inp,function (i,v){
      total_discount=total_discount+parseFloat($(v).val());
    })
    $.each(all_tax_total_inp,function (i,v){
      total_tax=total_tax+parseFloat($(v).val());
    })
    $.each(all_price_totalg_inp,function (i,v){
      total_gprice=total_gprice+parseFloat($(v).val());
    })

    $.each(all_price_igst_inp,function (i,v){
      total_igstprice=total_igstprice+parseFloat($(v).val());
    })

    $.each(all_price_cgst_inp,function (i,v){
      total_cgstprice=total_cgstprice+parseFloat($(v).val());
    })

    $.each(all_price_sgst_inp,function (i,v){
      total_sgstprice=total_sgstprice+parseFloat($(v).val());
    })

    $('#sub_total_amount').val(total_price.toFixed(2));
    $('#total_discount_amount').val(total_discount.toFixed(2));
    $('#tigst').val(total_igstprice.toFixed(2));
    $('#tcgst').val(total_cgstprice.toFixed(2));
    $('#tsgst').val(total_sgstprice.toFixed(2));
    $('#total').val(total_gprice.toFixed(2));
    var roundof=total_gprice-(Math.floor(total_gprice))
    $('#less_round_off').val(roundof.toFixed(2));
    $('#grand_total').val(Math.floor(total_gprice.toFixed(2)));

    }
</script>
