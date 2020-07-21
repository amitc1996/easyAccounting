<?php
$brand_name = array(
  'name'  => 'brand_name',
  'id'  => 'brand_name',
  'value' => set_value('brand_name',@$details[0]['brand_name']),
  'class'=>'form-control',
  'placeholder'=>'Brand Name',
  'data-parsley-required'=>'true'
);
?>
<?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"brand_edit_form",'name'=>'brand_edit_form', 'data-parsley-validate'=>"",'data-brand_id'=>$details[0]['brand_id'])); ?>
<div class="modal-body">
  <div class="form-group col-md-12">
    <label class="control-label" for="brand_name">Brand Name:</label>
    <?php echo form_input($brand_name); ?>
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
  $('#brand_edit_form').parsley();
  $('#brand_edit_form').submit(function(e){
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-brand_id');
    var values = $("#brand_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('brands/update_brand') ?>/'+id,
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
          brand_datatable.fnDraw();
          $('#brand_edit_form').parsley().reset();
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
