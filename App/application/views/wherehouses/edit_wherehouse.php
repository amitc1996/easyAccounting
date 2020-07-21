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
  'value' => set_value('branch',@$details[0]['branch_id']),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true'
);
$wherehouse_name = array(
  'name'  => 'wherehouse_name',
  'id'  => 'wherehouse_name',
  'value' => set_value('wherehouse_name',@$details[0]['wherehouse_name']),
  'class'=>'form-control',
  'placeholder'=>'wherehouse Name',
  'data-parsley-required'=>'true'
);
?>
<?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"wherehouse_edit_form",'name'=>'wherehouse_edit_form', 'data-parsley-validate'=>"",'data-wherehouse_id'=>$details[0]['wherehouse_id'])); ?>
<div class="modal-body">
  <div class="form-group col-md-6">
          <label class="control-label" for="name">Branch:</label>
          <?php  echo form_dropdown($branches,$branches_options,$branches['value']); ?>
        </div>
  <div class="form-group col-md-6">
    <label class="control-label" for="name">wherehouse Name:</label>
    <?php echo form_input($wherehouse_name); ?>
  </div>
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
  $('#wherehouse_edit_form').parsley();
  $('#wherehouse_edit_form').submit(function(e){
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-wherehouse_id');
    var values = $("#wherehouse_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('wherehouses/update_wherehouse') ?>/'+id,
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
          wherehouse_datatable.fnDraw();
          $('#wherehouse_edit_form').parsley().reset();
        }else
        {
          toastr.error(result.message);
          setTimeout(function(){$('#e_disappear').fadeOut('slow')},3000)
        }
      }
    });
  });
// });

</script>
