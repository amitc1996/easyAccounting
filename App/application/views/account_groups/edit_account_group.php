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
  'id'  => 'branch',
  'value' => set_value('branch',$details[0]['branch_id']),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true'
);
$group_name = array(
  'name'  => 'group_name',
  'id'  => 'group_name',
  'value' => set_value('group_name',$details[0]['group_name']),
  'class'=>'form-control',
  'placeholder'=>'Group Name',
  'data-parsley-required'=>'true'
);

$opening_balance = array(
  'name'  => 'opening_balance',
  'id'  => 'opening_balance',
  'value' => set_value('opening_balance',$details[0]['opening_balance']),
  'class'=>'form-control',
  'placeholder'=>'Opening Balance',
  'data-parsley-required'=>'true',
  'min'=>'0',
);

$category_options = array(''=>'--Select--');
if($categories && count($categories)> 0)
{
  foreach($categories as $val)
  {
    $category_options[$val['account_category_id']]= $val['account_category_name'];
  }
}
$categories = array(
  'name'  => 'category_name',
  'id'  => 'category_name',
  'value' => set_value('category_name',$details[0]['account_category_id']),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true'
);

$description = array(
  'name'  => 'description',
  'id'  => 'description',
  'value' => set_value('description',$details[0]['description']),
  'class'=>'form-control s_addr',
  'placeholder'=>'Description',
  'rows'=>4,
);

$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>
<?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"account_group_edit_form",'name'=>'account_group_edit_form', 'data-parsley-validate'=>"",'data-account_group_id'=>$details[0]['account_group_id'])); ?>
<div class="modal-body">
  <div class="form-group col-md-6">
   <label class="control-label" for="branches">Branch:</label>
    <?php  echo form_dropdown($branches,$branches_options,$branches['value']); ?>
  </div>
  <div class="form-group col-md-6">
    <label class="control-label" for="group_name">Group Name:</label>
    <?php echo form_input($group_name); ?>
  </div>
    <div class="form-group col-md-6">
    <label class="control-label" for="categories">Category:</label>
   <?php  echo form_dropdown($categories,$category_options,$categories['value']); ?>
  </div>
  <div class="form-group col-md-6">
    <label class="control-label" for="opening_balance">Opening Blance:</label>
    <?php echo form_input($opening_balance); ?>
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
  //attach parsley validation
  $('#account_group_edit_form').parsley();
  $('#account_group_edit_form').submit(function(e){
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-account_group_id');
    var values = $("#account_group_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('account_groups/update_account_group') ?>/'+id,
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
          account_group_datatable.fnDraw();
          $('#account_group_edit_form').parsley().reset();
        }else
        {
         toastr.error(result.message);
        }
      }
    });
  });
// });

</script>
