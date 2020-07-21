<?php
$voucher_number = array(
  'name'  => 'voucher_number',
  'id'  => 'voucher_number',
  'value' => set_value('voucher_number',$voucher_number),
  'class'=>'form-control',
  'placeholder'=>'Voucher No',
  'readonly'=>'readonly',
  'data-parsley-required'=>'true',
);
$for_transaction = array(
  'name'  => 'for_transaction',
  'id'  => 'for_transaction',
  'value' => set_value('for_transaction'),
  'class'=>'form-control',
  'placeholder'=>'For Transaction',
  'data-parsley-required'=>'true',
);

$branches_options = array(''=>'--Select--');
if($branches && count($branches)> 0)
{
  foreach($branches as $val)
  {
    $branches_options[$val['branch_id']]= $val['branch_name'];
  }
}
$branches = array(
  'name'  => 'branch',
  'id'  => 'branch',
  'value' => set_value('branch'),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true'
);


$from_account_options = array(''=>'--Select--');
if($ledgers && count($ledgers)> 0)
{
  foreach($ledgers as $val)
  {
    $from_account_options[$val['leadger_id']]= $val['leadger_name'];
  }
}
$from_account = array(
  'name'  => 'from_account',
  'id'  => 'from_account',
  'value' => set_value('from_account'),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true'
);

$to_account_options = array(''=>'--Select--');
if($ledgers && count($ledgers)> 0)
{
  foreach($ledgers as $val)
  {
    $to_account_options[$val['leadger_id']]= $val['leadger_name'];
  }
}
$to_account = array(
  'name'  => 'to_account',
  'id'  => 'to_account',
  'value' => set_value('to_account'),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true'
);


$voucher_date = array(
  'name'  => 'voucher_date',
  'id'  => 'voucher_date',
  'value' => set_value('voucher_date',date('m/d/Y',time())),
  'class'=>'form-control',
  'data-parsley-required'=>'true',
  'readonly'=>'readonly'
);
$amount = array(
  'name'  => 'amount',
  'id'  => 'amount',
  'value' => set_value('amount',0),
  'class'=>'form-control',
  'placeholder'=>'Amount',
  'data-parsley-required'=>'true',
  'min'=>'0',
);
$payment_type_options = array(
   ''=>'--Select--',
   'Cash'=>'Cash',
   'Chack'=>'Chack'
);
$payment_option = array(
  'name'  => 'payment_option',
  'id'  => 'payment_option',
  'value' => set_value('payment_option'),
  'class'=>'form-control',
  'data-parsley-required'=>'true'
);
$description = array(
  'name'  => 'description',
  'id'  => 'description',
  'value' => set_value('description'),
  'class'=>'form-control s_addr',
  'placeholder'=>'Description',
  'rows'=>4,
);

$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>
<style type="text/css">
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
    <a href="<?php echo site_url('payments');?>" class="btn btn-default" title="Back"><span class="glyphicon glyphicon-arrow-left" style="margin-right: 5px;"></span>Back</a>
  </div>
  <div class="clearfix"></div>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div id="alert_area"></div>
    <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"payment_add_form",'name'=>'payment_add_form', 'data-parsley-validate'=>"")); ?>
  <div class="row">
    <div class="col-xs-12">
      <div id="add_purchase_res"></div>
      <div class="box box-danger">
       <div class="box-body">
        <div class="row">
         <div class="col-md-6">
           <div class="well">
            <div class="row">
           <div class="form-group col-md-6">
            <label class="control-label" for="voucher_number">Voucher Number:</label>
              <?php echo form_input($voucher_number); ?>
            </div>
             <div class="form-group col-md-6">
            <label class="control-label" for="for_transaction">For Transaction:</label>
             <?php echo form_input($for_transaction); ?>
            </div>
            <div class="clearfix"></div>
           <div class="form-group col-md-6">
            <label class="control-label" for="branches">Branch:</label>
            <?php  echo form_dropdown($branches,$branches_options,$branches['value']); ?>
            </div>
            <div class="form-group col-md-6">
            <label class="control-label" for="voucher_date">Voucher Date:</label>
            <?php echo form_input($voucher_date); ?>
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-md-6">
            <label class="control-label" for="from_account">From Account:</label>
            <?php  echo form_dropdown($from_account,$from_account_options,$from_account['value']); ?>
            <input type="hidden" name="from_account_name" id="from_account_name" value="">
            </div>
            <div class="form-group col-md-6">
            <label class="control-label" for="to_account">To Account:</label>
            <?php  echo form_dropdown($to_account,$to_account_options,$to_account['value']); ?>
            <input type="hidden" name="to_account_name" id="to_account_name" value="">
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-md-6">
              <label class="control-label" for="payment_option">Payment Mode:</label>
              <?php  echo form_dropdown($payment_option,$payment_type_options,$payment_option['value']); ?>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label" for="amount">Amount:</label>
              <?php echo form_input($amount); ?>
            </div>
            </div>
           </div>
         </div>
         <div class="col-md-6">
           <div class="well">
             <div class="row">
            <div class="form-group col-md-12">
              <label class="control-label" for="description">Description:</label>
              <?php echo form_textarea($description); ?>
            </div>
             </div>
           </div>
         </div>
        </div>
           <div class="clearfix"></div>
       </div><!-- /.box-body -->
       <div class="box-footer">
      <button type="submit" id="save_purchase" class="btn btn-custom pull-right save"><i class="fa fa-spinner fa-spin formloader"></i> Pay Now</button>
      <div class="clearfix"></div>
     </div>
     </div>
   </div>
 </div>
 <?php echo form_close(); ?>
</section><!-- /.content -->
</div>

<script type="text/javascript">
$(document).ready(function(){
  //add payment
  $('#to_account').on('change',function(){
  $('#to_account_name').val($('#to_account :selected').text());
  })
  $('#from_account').on('change',function(){
    $('#from_account_name').val($('#from_account :selected').text());
  })
  //Add payment
  $('#payment_add_form').parsley();
  $("#payment_add_form").on('submit',function(e){
     e.preventDefault();
    var _this=$(this);
    var values = $('#payment_add_form').serialize();
    $.ajax({
      url:'<?php echo site_url('payments/save_payment'); ?>',
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
          $('#payment_add_form')[0].reset();
          $('#payment_add_form').parsley().reset();
           setTimeout(function(){location.reload()},4000);
        }else{
          toastr.error(result.message);
        }
      }
    });
    return false;
  });
});
</script>