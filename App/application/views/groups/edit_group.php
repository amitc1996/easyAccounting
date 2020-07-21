<?php 
$edit_name = array(
  'name'	=> 'edit_name',
  'id'	=> 'edit_name',
  'value' => set_value('edit_name',@$details[0]['name']),
  'class'=>'form-control',
  'placeholder'=>'Name',
  'data-parsley-required'=>'true'       
);

$edit_definition = array(
  'name'	=> 'edit_definition',
  'id'	=> 'edit_definition',
  'value' => set_value('edit_definition',@$details[0]['definition']),
  'class'=>'form-control',
  'placeholder'=>'Definition',       
);
?>

<?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"edit_group_form",'name'=>'edit_group_form', 'data-parsley-validate'=>"")); ?>
 <div class="modal-body">
   <input type="hidden" name="g_id" value="<?php echo $details[0]['id']; ?>" />
   <div class="form-group">
    <label class="control-label" for="edit_name">Name*</label>
    <?php echo form_input($edit_name); ?> 
  </div>
  
  <div class="form-group">
    <label class="control-label" for="edit_definition">Definition</label>
    <?php echo form_input($edit_definition); ?> 
  </div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
  <button type="submit" class="btn btn-custom pull-right save"><i class="fa fa-spinner fa-spin formloader"></i> Submit</button>
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
  <div class="clearfix"></div>
  <div class="text-left" id="edit_alert-area" style="margin-top:5px;"></div>
</div>
<?php echo form_close(); ?>
<script>
  $('#edit_group_form').parsley();
  $("#edit_group_form").on('submit',function(){
      var _this=$(this);
    var values = $('#edit_group_form').serialize();
    $.ajax({
      url:'<?php echo site_url('groups/updateGroup');?>',
      dataType:'json',
      data:values,
      type:'POST',
      // shows the loader element before sending.
        beforeSend: function (){before(_this)},
         // hides the loader after completion of request, whether successfull or failor.
        complete: function (){complete(_this)},
      success:function(result){
        if(result.status==1)
        {  
          toastr.success(result.message);
          ajax_datatable.fnDraw();
        }
        else
        {
         toastr.error(result.message);
        }
      }
    });
    return false;   
  });

</script>