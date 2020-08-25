<?php
$po_number = array(
  'name'  => 'po_number',
  'id'  => 'po_number',
  'value' => set_value('po_number',$po_number),
  'class'=>'form-control',
  'placeholder'=>'Po No.',
  'readonly'=>'readonly',
  'data-parsley-required'=>'true',
);
$date_purchased = array(
  'name'  => 'date_purchased',
  'id'  => 'date_purchased',
  'value' => set_value('date_purchased',date('m/d/Y',time())),
  'class'=>'form-control',
  'data-parsley-required'=>'true',
  'readonly'=>'readonly'
);
$suppliers_options = array(''=>'--Select--');
if($suppliers && count($suppliers)> 0)
{
  foreach($suppliers as $val)
  {
    $suppliers_options[$val['supplier_id']]= $val['supplier_orgnisation_name'];
  }
}
$suppliers = array(
  'name'  => 'supplier_name',
  'id'  => 'supplier_name',
  'value' => set_value('supplier_name'),
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
  'data-parsley-required'=>'true',
);

$supplier_invoice = array(
  'name'  => 'supplier_invoice',
  'id'  => 'supplier_invoice',
  'value' => set_value('supplier_invoice'),
  'class'=>'form-control',
  'placeholder'=>'Supplier Invoice',
  'data-parsley-required'=>'true',
);
$supplier_order = array(
  'name'  => 'supplier_order',
  'id'  => 'supplier_order',
  'value' => set_value('supplier_order'),
  'class'=>'form-control',
  'placeholder'=>'Supplier Order',
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



function tax_option_select($taxes){
  $option="";
  foreach ($taxes as $tax) {
    $option .= '<option value="'.$tax["tax_id"].'">'.$tax["tax_name"].'/'.$tax["tax_percentage"].'%'.'</option>';
  }
  return $option;
}
function discount_option_select($discounts){
$option="";
  foreach ($discounts as $discount) {
    $option .= '<option value="'.$discount["discount_id"].'">'.$discount["discount_name"].'/'.$discount["discount_percentage"].'%'.'</option>';
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
$gtotal_cost = array(
  'name'  => 'gtotal_cost',
  'id'  => 'gtotal_cost',
  'value' => set_value('gtotal_cost'),
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
$total_discount_amount = array(
  'name'  => 'total_discount_amount',
  'id'  => 'total_discount_amount',
  'value' => set_value('total_discount_amount'),
  'class'=>'form-control',
  'placeholder'=>'0.00',
  'readonly'=>'readonly',
);

$sub_total_amount = array(
  'name'  => 'sub_total_amount',
  'id'  => 'sub_total_amount',
  'value' => set_value('sub_total_amount'),
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
$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
$notes = array(
  'name'  => 'notes',
  'id'  => 'notes',
  'value' => set_value('notes'),
  'class'=>'form-control s_addr',
  'placeholder'=>'Notes...',
  'rows'=>4,
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
$taxable_amount = array(
  'name'  => 'taxable_amount',
  'id'  => 'taxable_amount',
  'value' => set_value('taxable_amount'),
  'class'=>'form-control',
  'placeholder'=>'0',
  'type'=>'number',
  'min'=>'0',
  'step'=>'0.01',
  'readonly'=>'readonly',
  'data-parsley-required'=>'true',
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
    <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"purchase_add_form",'name'=>'purchase_add_form', 'data-parsley-validate'=>"")); ?>
  <div class="row">
    <div class="col-xs-12">
      <div id="add_purchase_res"></div>
      <div class="box box-danger">
       <div class="box-body">
        <div class="row">
          <div class="form-group col-md-3">
              <input type="hidden" value="" name="is_submit_and_pay" id="is_submit_and_pay">
              <label class="control-label" for="vendors">Po No.:</label>
             <?php  echo form_input($po_number); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="date_purchased">Date Purchased:</label>
             <?php  echo form_input($date_purchased); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Supplier:</label>
             <?php  echo form_dropdown($suppliers, $suppliers_options,$suppliers['value']); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Wherehouse:</label>
            <?php  echo form_dropdown($wherehouses, $wherehouse_options,$wherehouses['value']); ?>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row billing_shipping_address">
          <hr />
          <div class="form-group col-md-4">
            <div class="well">
            <h4><strong>Supplier</strong></h4>
                <input class="hidden_info" name="supplier_id" type="hidden" value="" id="supplier_id"/>
                <input class="hidden_info" name="supplier_orgnisation_name" type="text" value="" id="supplier_orgnisation_name"/><br>
                <input class="hidden_info" name="supplier_address" type="text" value="" id="supplier_address"/><br> 
                <input class="hidden_info" name="supplier_city" type="text" value="" id="supplier_city"/><br>
                <input class="hidden_info" name="supplier_state" type="text" value="" id="supplier_state"/><br>
                <input class="hidden_info" name="supplier_country" type="text" value="" id="supplier_country"/><br>
                <input class="hidden_info" name="supplier_zip" type="text" value="" id="supplier_zip"/><br>
                <input class="hidden_info" name="supplier_email" type="text" value="" id="supplier_email"/><br>
                 <input class="hidden_info" name="supplier_orgnisation_phone" type="text" value="" id="supplier_orgnisation_phone"/><br>
                 <input class="hidden_info" name="supplier_tax_number" type="text" value="" id="supplier_tax_number"/><br>
               </div>
          </div>
          <div class="form-group col-md-4"> 
            <div class="well">
            <h4><strong>Billing Address(Company Address)</strong></h4>
                <input class="hidden_info" name="b_address" type="text" value="<?php echo $company_profile['address'];?>" id="b_address"/><br> 
                <input class="hidden_info" name="b_city" type="text" value="<?php echo $company_profile['city'];?>" id="b_city"/><br>
                <input class="hidden_info" name="b_state" type="text" value="<?php echo $company_profile['state'];?>" id="b_state"/><br>
                <input class="hidden_info" name="b_country" type="text" value="<?php echo $company_profile['country'];?>" id="b_country"/><br>
                <input class="hidden_info" name="b_zip" type="text" value="<?php echo $company_profile['zip'];?>" id="b_zip"/><br>
              </div>
          </div>
          <div class="form-group col-md-4">
            <div class="well">
            <h4><strong>Shipping Address(Wherehouse Address)</strong></h4>
                <input class="hidden_info" name="s_address" type="text" value="" id="s_address"/><br> 
                <input class="hidden_info" name="s_city" type="text" value="" id="s_city"/><br>
                <input class="hidden_info" name="s_state" type="text" value="" id="s_state"/><br>
                <input class="hidden_info" name="s_country" type="text" value="" id="s_country"/><br>
                <input class="hidden_info" name="s_zip" type="text" value="" id="s_zip"/><br>
              </div>
          </div>
        </div>
         <div class="clearfix"></div><hr />
        <div class="row">
          <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Supplier Invoice:</label>
             <?php  echo form_input($supplier_invoice); ?>
          </div>
           <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Supplier Order:</label>
             <?php  echo form_input($supplier_order); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="vendors">Dispatch Document No:</label>
             <?php  echo form_input($dispatch_document_no); ?>
          </div>
          <div class="form-group col-md-3">
              <label class="control-label" for="date_purchased">Delivery Note Date:</label>
             <?php  echo form_input($delevery_note_date); ?>
          </div>
        </div>
        <div class="clearfix"></div><hr />
        <div class="row">
           <div class="form-group col-md-12">
          <div class="well" >
              <?php  echo form_input($item_title); ?>
              <div id="product_not_found_error"></div>
               <div class="clearfix"></div>
          </div>
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
                        <th style="width: 250px;">Title</th>
                        <th style="width: 100px;">HSN/SAC</th>
                        <th style="width: 50px;">Unit</th>
                        <th style="width: 100px;">Product Price</th>
                        <th style="width: 100px;">Quantity</th>
                        <th style="width: 100px;">Sub Total</th>
                        <th colspan="2" style="width: 350px;">Discount</th>
                        <th style="width: 100px;">Taxable Amount</th>
                        <th colspan="2" style="width: 400px;">IGST</th>
                        <th colspan="2" style="width: 400px;">CGST</th>
                        <th colspan="2" style="width: 400px;">SGST</th>
                        <th style="width: 120px;">Total</th>
                      </tr>
                    </thead>
                    <tbody id="item_data"></tbody>
                  </table>
             </div><hr/>
           </div>
         </div>
          <div class="row">
            <div class="col-md-8">
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
          <div class="col-md-4">
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
                     <?php  echo form_input($taxable_amount); ?>
                    </div>
                    <label class="pull-right control-label">Taxable Amount:</label>
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
      <button type="submit" id="save_purchase" class="btn btn-custom pull-right save">Save</button>
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
       $('#purchase_add_form').trigger('submit');
    }
  });
  $('.billing_shipping_address').slideUp();
 $("#date_purchased").datepicker({
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
      $('#product_not_found_error').html('<p style="color:red;">Product not found.</p>');
    }
  },
  select: function (event, ui) {
    $('#product_not_found_error').empty();
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

 $(document).on('change','#wherehouse',function(e){
  var id=$(this).val();
  if(id){
    get_wherehouse_address(id);
  }
  })

 $(document).on('change','#supplier_name',function(e){
  var id=$(this).val();
  if(id){
    get_supplier_details(id);
  }
  })
 $(document).on('keyup keypress blur change','.unit_price_inp,.quantity_inp,.discount_inp,.tax_inp,.price_discount_percent,.price_discount_amount,.price_igst_percent,.price_cgst_percent,.price_sgst_percent',function (){
  var count=$(this).attr('count');
  calculate_price(count);
 });

  //Add purchase
  $('#purchase_add_form').parsley();
  $("#purchase_add_form").on('submit',function(){
     if(!$('.quantity_inp').length){
  toastr.error('Add product first');
  return false;
}
    var _this=$(this);
    var values = $('#purchase_add_form').serialize();
    $.ajax({
      url:'<?php echo site_url('purchases/save_purchase'); ?>',
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
          $('#purchase_add_form')[0].reset();
          $('#purchase_add_form').parsley().reset();
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
  function get_supplier_details(supplier_id){
       $.ajax({
        url:'<?php echo site_url('purchases/get_supplier_details/'); ?>'+supplier_id,
        dataType:'json',
        type:'GET',
        success:function(result){
           if(result)
           {
             if(result){
              $('.billing_shipping_address').slideDown();
                  $('#supplier_orgnisation_name').val(result.supplier_orgnisation_name);
                  $('#supplier_address').val(result.supplier_address_b);
                  $('#supplier_city').val(result.supplier_city_b);
                  $('#supplier_state').val(result.supplier_state_b);
                  $('#supplier_country').val(result.supplier_country_b);
                  $('#supplier_zip').val(result.supplier_zip_b);
                  $('#supplier_email').val(result.supplier_email);
                  $('#supplier_orgnisation_phone').val(result.supplier_orgnisation_phone);
                  $('#supplier_tax_number').val(result.supplier_tax_number);
             }               
           }
        }
       });
  }
  function get_wherehouse_address(wherehouse_id){
       $.ajax({
        url:'<?php echo site_url('purchases/get_wherehouse_address/'); ?>'+wherehouse_id,
        dataType:'json',
        type:'GET',
        success:function(result){
           if(result)
           {
             if(result){
              $('.billing_shipping_address').slideDown();
                  $('#s_address').val(result.branch_address);
                  $('#s_city').val(result.branch_city);
                  $('#s_state').val(result.branch_state);
                  $('#s_country').val(result.branch_country);
                  $('#s_zip').val(result.branch_zip);
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
                     <td><input min="0"  id="unit_cost_${rowCount}" count="${rowCount}" class="form-control unit_price_inp" type="text" value="${result[0].unit_cost_exclude_gst}" name="item[${rowCount}][unit_cost]"></td>
                     <td><input min="1" id="item_qty_${rowCount}" count="${rowCount}" class="form-control quantity_inp" type="number" value="1" 
                     name="item[${rowCount}][item_qty]"></td>
                     <td><input id="total_amount_${rowCount}" count="${rowCount}" class="form-control hidden_info price_total_inp hidden_info" type="text" value="${result[0].unit_cost_exclude_gst}" 
                     name="item[${rowCount}][total_amount]"></td>

                     <td><input  class="form-control price_discount_percent" count="${rowCount}" name="item[${rowCount}][discount_percent]" id="discount_percent_${rowCount}" type="text" value="0"></td>

                      <td><input  class="form-control price_discount_amount hidden_info" count="${rowCount}" name="item[${rowCount}][discount_amount]" id="discount_amount_${rowCount}" type="text" value="0"></td>

                       <td><input  class="form-control price_taxable_amount" count="${rowCount}" name="item[${rowCount}][taxable_amount]" id="taxable_amount_${rowCount}" type="text" value="${result[0].unit_cost_exclude_gst}"></td>

                     <td><input class="form-control price_igst_percent" count="${rowCount}" name="item[${rowCount}][tax_igst_percent]" id="tax_igst_percent_${rowCount}" type="text" value="${result[0].igst}"></td>
                     <td><input class="form-control price_tax_igst_amount hidden_info" count="${rowCount}" name="item[${rowCount}][tax_igst_amount]" id="tax_igst_amount_${rowCount}" type="text" value="0"></td>

                     <td><input class="form-control price_cgst_percent" count="${rowCount}" name="item[${rowCount}][tax_cgst_percent]" id="tax_cgst_percent_${rowCount}" type="text" value="${result[0].cgst}"></td>
                     <td><input class="form-control price_tax_cgst_amount hidden_info" count="${rowCount}" name="item[${rowCount}][tax_cgst_amount]" id="tax_cgst_amount_${rowCount}" type="text" value="0"></td>

                     <td><input class="form-control price_sgst_percent" count="${rowCount}" name="item[${rowCount}][tax_sgst_percent]" id="tax_sgst_percent_${rowCount}" type="text" value="${result[0].sgst}"></td>
                     <td><input class="form-control price_tax_sgst_amount hidden_info" count="${rowCount}" name="item[${rowCount}][tax_sgst_amount]" id="tax_sgst_amount_${rowCount}" type="text" value="0"></td>

                     <td><input class="form-control price_gtotal_inp hidden_info" count="${rowCount}" type="text"  value="${result[0].unit_cost_exclude_gst}"id="total_gamount_${rowCount}" name="item[${rowCount}][total_gamount]"></td>
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
      
      $('#taxable_amount_'+rowCount).val(amount_after_discount);
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
    var all_price_taxable_inp=$('.price_taxable_amount');

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
    var total_taxableprice=0.00;

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

     $.each(all_price_taxable_inp,function (i,v){
      total_taxableprice=total_taxableprice+parseFloat($(v).val());
    })


    $('#sub_total_amount').val(total_price.toFixed(2));
    $('#total_discount_amount').val(total_discount.toFixed(2));
    $('#taxable_amount').val(total_taxableprice.toFixed(2));
    $('#tigst').val(total_igstprice.toFixed(2));
    $('#tcgst').val(total_cgstprice.toFixed(2));
    $('#tsgst').val(total_sgstprice.toFixed(2));
    $('#total').val(total_gprice.toFixed(2));
    var roundof=total_gprice-(Math.floor(total_gprice))
    $('#less_round_off').val(roundof.toFixed(2));
    $('#grand_total').val(Math.floor(total_gprice.toFixed(2)));

    }
</script>
