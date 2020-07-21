<?php
$branch_name = array(
  'name'  => 'branch_name',
  'id'  => 'branch_name',
  'value' => set_value('branch_name',@$details[0]['branch_name']),
  'class'=>'form-control',
  'placeholder'=>'Branch Name',
  'data-parsley-required'=>'true'
);
$branch_phone = array(
  'name'  => 'branch_phone',
  'id'  => 'branch_phone',
  'value' => set_value('branch_phone',@$details[0]['branch_phone']),
  'class'=>'form-control',
  'placeholder'=>'Branch Phone',
  'data-parsley-required'=>'true'
);
$branch_email = array(
  'name'  => 'branch_email',
  'id'  => 'branch_email',
  'value' => set_value('branch_email',@$details[0]['branch_email']),
  'class'=>'form-control',
  'placeholder'=>'Email',
  'data-parsley-required'=>'true',
  'data-parsley-type'=>'email'
);

$branch_address = array(
  'name'  => 'branch_address',
  'id'  => 'branch_address',
  'value' => set_value('branch_address',@$details[0]['branch_address']),
  'class'=>'form-control',
  'placeholder'=>'Address',
  'data-parsley-required'=>'true',
  'rows'=>4,
);
$branch_city = array(
  'name'  => 'branch_city',
  'id'  => 'branch_city',
  'value' => set_value('branch_city',@$details[0]['branch_city']),
  'class'=>'form-control',
  'placeholder'=>'Branch City',
  'data-parsley-required'=>'true'
);
$branch_state = array(
  'name'  => 'branch_state',
  'id'  => 'branch_state',
  'value' => set_value('branch_state',@$details[0]['branch_state']),
  'class'=>'form-control',
  'placeholder'=>'Branch State',
  'data-parsley-required'=>'true'
);
$branch_country = array(
  'name'  => 'branch_country',
  'id'  => 'branch_country',
  'value' => set_value('branch_country',@$details[0]['branch_country']),
  'class'=>'form-control',
  'placeholder'=>'Branch Country',
  'data-parsley-required'=>'true'
);
$branch_zip = array(
  'name'  => 'branch_zip',
  'id'  => 'branch_zip',
  'value' => set_value('branch_zip',@$details[0]['branch_zip']),
  'class'=>'form-control',
  'placeholder'=>'Branch Zip/Post',
  'data-parsley-required'=>'true'
);

$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>
<?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"branch_edit_form",'name'=>'branch_edit_form', 'data-parsley-validate'=>"",'data-branch_id'=>$details[0]['branch_id'])); ?>
<div class="modal-body">
 <div class="form-group col-md-4">
          <label class="control-label" for="branch_name">Branch Name:</label>
          <?php echo form_input($branch_name); ?>
        </div>
        <div class="form-group col-md-4">
          <label class="control-label" for="branch_phone">Branch Phone:</label>
          <?php echo form_input($branch_phone); ?>
        </div>
          <div class="form-group col-md-4">
          <label class="control-label" for="branch_email">Branch Email:</label>
          <?php echo form_input($branch_email); ?>
        </div>
        <div class="form-group col-md-12">
          <label class="control-label" for="branch_address">Address:</label>
          <?php echo form_textarea($branch_address); ?>
        </div>
          <div class="form-group col-md-3">
          <label class="control-label" for="branch_city">City:</label>
          <?php echo form_input($branch_city); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="branch_state">State:</label>
          <?php echo form_input($branch_state); ?>
        </div>
         <div class="form-group col-md-3">
          <label class="control-label" for="branch_country">Country:</label>
          <?php echo form_input($branch_country); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="branch_zip">Zip/Post:</label>
          <?php echo form_input($branch_zip); ?>
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
  $('#branch_edit_form').parsley();
  $('#branch_edit_form').submit(function(e){
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-branch_id');
    var values = $("#branch_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('branches/update_branch') ?>/'+id,
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
          $('#branch_edit_form').parsley().reset();
          branches_listing.fnDraw();
        }else
        {
          toastr.error(result.message);
        }
      }
    });
  });
// });

</script>
