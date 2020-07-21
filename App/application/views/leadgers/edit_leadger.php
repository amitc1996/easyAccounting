
<?php
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
  'id'  => 'account_group',
  'value' => set_value('account_group',@$details[0]['account_group_id']),
  'class'=>'form-control',
  'data-parsley-required'=>'true'
);
$leadger_name = array(
  'name'  => 'leadger_name',
  'id'  => 'leadger_name',
  'value' => set_value('leadger_name',@$details[0]['leadger_name']),
  'class'=>'form-control',
  'placeholder'=>'Leadger Name',
  'data-parsley-required'=>'true'
);
$opening_balance = array(
  'name'  => 'opening_balance',
  'id'  => 'opening_balance',
  'value' => set_value('opening_balance',@$details[0]['opening_balance']),
  'class'=>'form-control',
  'placeholder'=>'Opening Balance',
  'data-parsley-required'=>'true',
  'min'=>'0',
);

$closing_balance = array(
  'name'  => 'closing_balance',
  'id'  => 'closing_balance',
  'value' => set_value('closing_balance',@$details[0]['closing_balance']),
  'class'=>'form-control',
  'placeholder'=>'Closing Balance',
  'data-parsley-required'=>'true',
  'min'=>'0',
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
<?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"leadger_edit_form",'name'=>'leadger_edit_form', 'data-parsley-validate'=>"",'data-leadger_id'=>$details[0]['leadger_id'])); ?>
<div class="modal-body">
 <div class="form-group col-md-6">
      <label class="control-label" for="leadger_name">Ledger Name:</label>
      <?php echo form_input($leadger_name); ?>
      </div>
      <div class="form-group col-md-6">
      <label class="control-label" for="account_groups">Account Group:</label>
      <?php  echo form_dropdown($account_groups,$account_groups_options,$account_groups['value']); ?>
      </div>

      <div class="form-group col-md-6">
        <label class="control-label" for="opening_balance">Opening Blance:</label>
        <?php echo form_input($opening_balance); ?>
      </div>
      
      <div class="form-group col-md-6">
        <label class="control-label" for="closing_balance">Closing Blance:</label>
        <?php echo form_input($closing_balance); ?>
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
//update ledger
  //attach parsley validation
  $('#leadger_edit_form').parsley();
  $('#leadger_edit_form').submit(function(e){
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-leadger_id');
    var values = $("#leadger_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('ledgers/update_ledger') ?>/'+id,
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
          leadger_datatable.fnDraw();
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
