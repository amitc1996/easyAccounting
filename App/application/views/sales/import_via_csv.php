<?php
$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
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
  'class'=>'form-control inport_select input_marketplace',
  'data-parsley-required'=>'true'
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
  'class'=>'form-control input_category inport_select',
);

$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>
<style type="text/css">
  .inset {
    padding: 0px 20px 40px;
}
.csv_table_holder {
    max-height: 650px;
}
.import-table input {
    font-size: 11px;
}
.inport_select{
  height: 23px;
  font-size: 11px;
  padding: 0px;
  width: 140px;
}
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
     <a href="<?php echo site_url('sales');?>" class="btn btn-default" title="Back"><span class="glyphicon glyphicon-arrow-left" style="margin-right: 5px;"></span>Back</a>
  </div>
  <div class="clearfix"></div>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div id="alert_area"></div>

  <div class="row">
    <div class="col-xs-12">


      <div class="box box-primary">
        <div class="box-body">
          <div class="page-content inset">
            <div class="row">
              <div class="col-md-12">
                <?php if(count($sales)){ ?>
                 <form name="import_form" id="import_form" method="POST" action="<?php echo site_url('sales/save_import'); ?>">
                  <input type="hidden" id="csrf" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" />
                   <div class="box-body csv_table_holder" style="overflow-x: scroll;">
                     <table id="csv_listing" class="table table-bordered table-condensed import-table">
                      <thead>
                        <tr class="tableheader tableheader-blue">
                         <th>Errors</th> 
                         <th>Invoice Id</th>
                         <th>Bill Date</th>
                         <th>Marketplace</th>
                         <th>Total Cost</th>
                         <th>Total Marketplace Fee</th>
                         <th>Total Paypal fee</th>
                         <th>Total Shipping Price</th>
                         <th>Total Net Cost</th>
                         <th>Total Selling Price</th>
                         <th>Total Net Profit</th>
                         <th>Created Date</th>
                         <th>Item Title</th>
                         <th>Sku</th>
                         <th>Category</th>
                         <th>Location</th>
                         <th>Stock</th>
                         <th>Item Quantity</th>
                         <th>Unit Cost</th>
                         <th>Total Cost</th>
                         <th>Marketplace Fee</th>
                         <th>Paypal fee</th>
                         <th>Shipping Cost</th>
                         <th>Net Cost</th>
                         <th>Salling Price</th>
                         <th>Net Profit</th>
                       </tr>
                     </thead>
                     <tbody>
                       <?php 
                        $i=0;
                        foreach($sales as $key=> $val){
                                    
                        if($i==0) {$i++;  continue;}  
                        $errors ='';
                        if(strlen(trim($val["Invoice Id"]))==0)
                         $errors.= '<br />Invoice id is required.';
                        if(strlen(trim($val["Bill Date"]))==0)
                         $errors.= '<br />Bill date is required.';
                        if(strlen(trim($val["Marketplace"]))==0)
                         $errors.= '<br />Marketplace is required.';
                        if(strlen($errors)>0)
                                 {
                                   $row_class = "alert-danger"; 
                                   $pos = strpos($errors,'<br />');
                                    if ($pos !== false) {
                                        $newstring = substr_replace($errors,'',$pos,strlen('<br />'));
                                    } 
                                   $error_element = "<td class='err_btn_holder'>".'<button type="button" class="btn btn-xs btn-danger" data-toggle="popover" title="Errors" data-content="'.$newstring.'">'.substr_count($errors,'<br />').'</button>'."</td>";
                                 }
                                 else{
                                    $row_class = "alert-success";
                                    $error_element = '<td class="err_btn_holder"></td>';
                                   } 
                                echo '<tr class="'.$row_class.'">';
                                echo $error_element;
                                echo '<td><input type="text" class="invoice_id_input"  name="invoice_id['.$val["Invoice Id"].']" id="invoice_id" value="'.htmlspecialchars($val["Invoice Id"]).'"  /></td>';
                                echo '<td><input type="text" class="bill_date_input"  name="bill_date['.$val["Invoice Id"].']" id="bill_date" value="'.htmlspecialchars($val["Bill Date"]).'"  /></td>';
                                $marketplaces['name']='marketplace_name['.$val["Invoice Id"].']';
                                echo '<td>'.form_dropdown($marketplaces, $marketplace_options,isset($val) ? $val["Marketplace"]:'').'</td>';
                                echo '<td><input type="text" class="total_cost_input"  name="total_cost['.$val["Invoice Id"].']" id="total_cost" value="'.htmlspecialchars($val["Total Cost"]).'"  /></td>';
                                 echo '<td><input type="text" class="total_marketplace_fee_input"  name="total_marketplace_fee['.$val["Invoice Id"].']" id="total_marketplace_fee" value="'.htmlspecialchars($val["Total Marketplace Fee"]).'"  /></td>';
                                 echo '<td><input type="text" class="total_paypal_fee_input"  name="total_paypal_fee['.$val["Invoice Id"].']" id="total_paypal_fee" value="'.htmlspecialchars($val["Total Paypal fee"]).'"  /></td>';
                                 echo '<td><input type="text" class="total_shipping_price_input"  name="total_shipping_price['.$val["Invoice Id"].']" id="total_shipping_price" value="'.htmlspecialchars($val["Total Shipping Price"]).'"  /></td>';
                                 echo '<td><input type="text" class="total_net_cost_input"  name="total_net_cost['.$val["Invoice Id"].']" id="total_net_cost" value="'.htmlspecialchars($val["Total Net Cost"]).'"  /></td>';
                                 echo '<td><input type="text" class="total_selling_price_input"  name="total_selling_price['.$val["Invoice Id"].']" id="total_selling_price" value="'.htmlspecialchars($val["Total Selling Price"]).'"  /></td>';
                                 echo '<td><input type="text" class="total_net_profit_input"  name="total_net_profit['.$val["Invoice Id"].']" id="total_net_profit" value="'.htmlspecialchars($val["Total Net Profit"]).'"  /></td>';
                                 echo '<td><input type="text" class="created_date_input"  name="created_date['.$val["Invoice Id"].']" id="created_date" value="'.htmlspecialchars($val["Created Date"]).'"  /></td>';
                                 echo '<td><input type="text" class="item_title_input"  name="item_title['.$val["Invoice Id"].'][]" id="item_title" value="'.htmlspecialchars($val["Item Title"]).'"  /></td>';
                                 echo '<td><input type="text" class="sku_input"  name="sku['.$val["Invoice Id"].'][]" id="sku" value="'.htmlspecialchars($val["SKU"]).'"  /></td>';
                                 $categories['name']='category_name['.$val["Invoice Id"].'][]';
                                 echo '<td>'.form_dropdown($categories,$category_options, isset($val) ? $val["Category"]:'').'</td>';
                                 echo '<td><input type="text" class="location_input"  name="location['.$val["Invoice Id"].'][]" id="location" value="'.htmlspecialchars($val["Location"]).'"  /></td>';
                                  echo '<td><input type="text" class="stock_input"  name="stock['.$val["Invoice Id"].'][]" id="stock" value="'.htmlspecialchars($val["Stock"]).'"  /></td>';
                                  echo '<td><input type="text" class="item_quantity_input"  name="item_quantity['.$val["Invoice Id"].'][]" id="item_quantity" value="'.htmlspecialchars($val["Item Quantity"]).'"  /></td>';
                                  echo '<td><input type="text" class="unit_cost_input"  name="unit_cost['.$val["Invoice Id"].'][]" id="unit_cost" value="'.htmlspecialchars($val["Unit Cost"]).'"  /></td>';
                                  echo '<td><input type="text" class="total_cost_input"  name="total_cost['.$val["Invoice Id"].']" id="total_cost" value="'.htmlspecialchars($val["Total Cost"]).'"  /></td>';
                                  echo '<td><input type="text" class="marketplace_fee_input"  name="marketplace_fee['.$val["Invoice Id"].'][]" id="marketplace_fee" value="'.htmlspecialchars($val["Marketplace Fee"]).'"  /></td>';
                                   echo '<td><input type="text" class="paypal_fee_input"  name="paypal_fee['.$val["Invoice Id"].'][]" id="paypal_fee" value="'.htmlspecialchars($val["Paypal fee"]).'"  /></td>';
                                   echo '<td><input type="text" class="shipping_cost_input"  name="shipping_cost['.$val["Invoice Id"].'][]" id="shipping_cost" value="'.htmlspecialchars($val["Shipping Cost"]).'"  /></td>';
                                   echo '<td><input type="text" class="net_cost_input"  name="net_cost['.$val["Invoice Id"].'][]" id="net_cost" value="'.htmlspecialchars($val["Net Cost"]).'"  /></td>';
                                   echo '<td><input type="text" class="salling_price_input"  name="salling_price['.$val["Invoice Id"].'][]" id="salling_price" value="'.htmlspecialchars($val["Salling Price"]).'"  /></td>';
                                    echo '<td><input type="text" class="net_profit_input"  name="net_profit['.$val["Invoice Id"].'][]" id="net_profit" value="'.htmlspecialchars($val["Net Profit"]).'"  /></td>';
                                echo '</tr>';
                                 $i++;
                        }
                        /*echo "<pre>";print_r($sales);die;*/
                       ?>         
                     </tbody>
                </table>
              </div>
              <div class="clearfix"></div>
              <div class="form-group">
                <br />
                <input type="submit" name="import_submit" id="import_submit" class="btn btn-primary pull-right margin-left-5" value="Import" />
              </div>
            </form>
          <?php } else { ?>
            <div class="box-body" style="overflow-x: scroll;">
              <div class="alert alert-danger"> Invalid Data</div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div><!-- /.box-body -->
  <form name="form_for_redirect" id="form_for_redirect" method="POST" action="<?php echo site_url('sales/redirect_to_list'); ?>">
    <input type="hidden" name="count" id="inserted" />
     <input type="hidden" id="csrf" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" />
  </form>
</div>
</div>
</div>
</section><!-- /.content -->
</div>

<script type="text/javascript">
  $(document).ready(function (){

   $('[data-toggle="popover"]').popover({html:true,placement:"left"});
  
   $('.input_marketplace,.input_category').change(function(){
        var row = $(this).parent().parent();
        validate_row(row);
    }) ;
  
  $('.sku_input,.invoice_id_input,.bill_date_input').keyup(function(){
    var row = $(this).parent().parent();
        validate_row(row);
    }) ;
    
  $("#import_form").submit(function(e){
        e.preventDefault();
        var good_rows = $('#csv_listing tr.alert-success').length;
        var neutral_rows = $('#csv_listing tr.alert-warning').length;
        if(good_rows==0 && neutral_rows==0 )
        {
            alert('No valid rows to insert. Please correct the errors and try again.')
            $('#loader').hide();
            return false;   
        }

        
        
        var bad_rows = $('#csv_listing tr.alert-danger').length;
        if(bad_rows>0)
        {
           var user_reply =  confirm('CAUTION: Only validated rows will be inserted, others will be discarded. Proceed?');
           if(user_reply)
           {
            $('#csv_listing tr.alert-danger').remove();
           }
           else
           {
            $('#loader').hide();
            processing=0;
            return false;
           }
        }
         var values = $("#import_form").serialize();
         console.log(values);
        /* var formData = JSON.stringify($("#import_form").serializeArray());*/
               $.ajax({
                  type: "POST",
                  url: '<?php echo site_url('sales/save_import'); ?>',
                  data:values,
                  dataType:'json',
                  success: function(res){
                       $('#inserted').val(res.count);
                       console.log(res);
                       $('#form_for_redirect').submit();
                       processing=0; 
                  }
                });
        });
  });



    function validate_row(row_obj)
    {
    var all_good = true;
    var error_message ="";
    
    //validate
    var invoice_id = row_obj.find('.invoice_id_input').val();
    if($.trim(invoice_id).length==0)
    {
        all_good=false;
        error_message+= '<br />Invoice id is required.';
    }
    var bill_date = row_obj.find('.bill_date_input').val();
    if($.trim(bill_date).length==0)
    {
        all_good=false;
        error_message+= '<br />Bill date is required.';
    }
    var marketplaces = row_obj.find('.input_marketplace').val();
    if($.trim(marketplaces).length==0 || $.trim(marketplaces)=="0" )
    {
        all_good=false;
        error_message+= '<br />Marketplace is required.';
    }

    
    if(all_good==false){
        var error_count = error_message.split('<br />').length - 1;
        error_message = error_message.replace("<br />", "");
        var new_button = '<button type="button" class="btn btn-xs btn-danger" data-toggle="popover" title="" data-content="'+error_message+'" data-original-title="Errors">'+error_count+'</button>'
        
        row_obj.find(".err_btn_holder").empty().html(new_button);
        row_obj.find(".err_btn_holder .btn").popover({html:true,placement:"left"})
        row_obj.addClass('alert-danger').removeClass('alert-success').removeClass('alert-warning');   
    }
    else{
        row_obj.find(".err_btn_holder").empty();   
        row_obj.removeClass('alert-danger').removeClass('alert-warning').addClass('alert-success');  
       
    }
    
   }
</script>
