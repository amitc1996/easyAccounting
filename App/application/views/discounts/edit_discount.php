<?php

$discount_name = array(
  'name'  => 'discount_name',
  'id'  => 'discount_name',
  'value' => set_value('discount_name',@$details[0]['discount_name']),
  'class'=>'form-control',
  'placeholder'=>'Discount Name',
  'data-parsley-required'=>'true'
);
$discount_percentage = array(
  'name'  => 'discount_percentage',
  'id'  => 'discount_percentage',
  'value' => set_value('discount_percentage',@$details[0]['discount_percentage']),
  'class'=>'form-control',
  'placeholder'=>'Discount %',
  'data-parsley-required'=>'true'
);
?>
<?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"discount_edit_form",'name'=>'discount_edit_form', 'data-parsley-validate'=>"",'data-discount_id'=>$details[0]['discount_id'])); ?>
<div class="modal-body">
  <div class="form-group col-md-12">
    <label class="control-label" for="name">Discount Name:</label>
    <?php echo form_input($discount_name); ?>
  </div>
  <div class="form-group col-md-12">
          <label class="control-label" for="name">Discount %:</label>
          <?php echo form_input($discount_percentage); ?>
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
  $('#discount_edit_form').parsley();
  $('#discount_edit_form').submit(function(e){
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-discount_id');
    var values = $("#discount_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('discounts/update_discount') ?>/'+id,
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
          $('#discount_edit_form').parsley().reset();
          discount_datatable.fnDraw();
        }else
        {
          toastr.error(result.message);
        }
      }
    });
  });
// });

</script>
