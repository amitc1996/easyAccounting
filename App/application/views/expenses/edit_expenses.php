<?php
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
  'id'  => 'ebranch',
  'value' => set_value('branch',@$details[0]['branch_id']),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true'
);

$ledgers_options = array(''=>'--Select--');
if($ledgers && count($ledgers)> 0)
{
  foreach($ledgers as $val)
  {
    $ledgers_options[$val['leadger_id']]= $val['leadger_name'];
  }
}
$ledgers = array(
  'name'  => 'ledger',
  'id'  => 'eledger',
  'value' => set_value('ledger',@$details[0]['to_account_id']),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true'
);

$account_groups_options = array(''=>'--Select--');
if($account_groups && count($account_groups)> 0)
{
  foreach($account_groups as $val)
  {
    $account_groups_options[$val['account_group_id']]= $val['group_name'];
  }
}
$account_groups = array(
  'name'  => 'account_group',
  'id'  => 'eaccount_group',
  'value' => set_value('account_group',@$details[0]['from_account_id']),
  'class'=>'form-control',
  'data-parsley-required'=>'true'
);
$expense_date = array(
  'name'  => 'expense_date',
  'id'  => 'eexpense_date',
  'value' => set_value('expense_date',date("m/d/Y",strtotime(@$details[0]['expense_date']))),
  'class'=>'form-control',
  'data-parsley-required'=>'true',
  'readonly'=>'readonly'
);
$amount = array(
  'name'  => 'amount',
  'id'  => 'amount',
  'value' => set_value('amount',@$details[0]['amount']),
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
  'value' => set_value('payment_option',@$details[0]['payment_method']),
  'class'=>'form-control',
  'data-parsley-required'=>'true'
);
$description = array(
  'name'  => 'description',
  'id'  => 'description',
  'value' => set_value('description',@$details[0]['description']),
  'class'=>'form-control s_addr',
  'placeholder'=>'Description',
  'rows'=>4,
);

$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>
<?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"leadger_edit_form",'name'=>'leadger_edit_form', 'data-parsley-validate'=>"",'data-expense_id'=>$details[0]['expense_id'])); ?>
<div class="modal-body">
<div class="form-group col-md-6">
      <label class="control-label" for="branches">Branch:</label>
      <?php  echo form_dropdown($branches,$branches_options,$branches['value']); ?>
      </div>
      <div class="form-group col-md-6">
      <label class="control-label" for="expense_date">Date:</label>
      <?php echo form_input($expense_date); ?>
      </div>
      <div class="form-group col-md-6">
      <label class="control-label" for="ledgers">To Leadger:</label>
      <?php  echo form_dropdown($ledgers,$ledgers_options,$ledgers['value']); ?>
      <input type="hidden" name="to_account_name" id="eto_account_name" value="<?php echo @$details[0]['to_account_name'];?>">
      </div>
      <div class="form-group col-md-6">
      <label class="control-label" for="account_groups">From Leadger:</label>
      <input type="hidden" name="from_account_name" id="efrom_account_name" value="<?php echo @$details[0]['from_account_name'];?>">
      <?php  echo form_dropdown($account_groups,$account_groups_options,$account_groups['value']); ?>
      </div>
      <div class="form-group col-md-6">
        <label class="control-label" for="payment_option">Payment Mode:</label>
        <?php  echo form_dropdown($payment_option,$payment_type_options,$payment_option['value']); ?>
      </div>
      <div class="form-group col-md-6">
        <label class="control-label" for="amount">Amount:</label>
        <?php echo form_input($amount); ?>
      </div>

      <div class="form-group col-md-12">
        <label class="control-label" for="description">Description:</label>
        <?php echo form_textarea($description); ?>
      </div>
  
        <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
  <div class="clearfix"></div>
  <button type="submit" class="btn btn-custom pull-right save" style="margin-left: 5px;"><i class="fa fa-spinner fa-spin formloader"></i> Save Changes</button>
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="margin-left: 5px;">Back</button>
  <?php echo form_close(); ?>
  <div class="clearfix"></div>
  <div id="edit_res" class="text-left" style="margin-top: 5px;"></div>
</div>

<script>
// $(document).ready(function(e){
  //ledger change operation
$('#eledger').on('change',function(){
  $('#eto_account_name').val($('#eledger :selected').text());
})
$('#eaccount_group').on('change',function(){
  $('#efrom_account_name').val($('#eaccount_group :selected').text());
})
 $("#eexpense_date").datepicker({
      dateFormat: 'mm/dd/yy',
      maxDate: new Date,
      changeMonth: true,changeYear: true,yearRange: "-100:+0",
 });
 //ledger submit operation
  //attach parsley validation
  $('#leadger_edit_form').parsley();
  $('#leadger_edit_form').submit(function(e){
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-expense_id');
    var values = $("#leadger_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('expenses/update_expense') ?>/'+id,
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
          expense_datatable.fnDraw();
          $('#leadger_edit_form').parsley().reset();
        }else
        {
         toastr.error(result.message);
        }
      }
    });
  });
// });

</script>
