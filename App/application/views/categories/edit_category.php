<?php

$category_name = array(
  'name'  => 'category_name',
  'id'  => 'category_name',
  'value' => set_value('category_name',@$details[0]['category_name']),
  'class'=>'form-control',
  'placeholder'=>'Category Name',
  'data-parsley-required'=>'true'
);
?>
<?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"category_edit_form",'name'=>'category_edit_form', 'data-parsley-validate'=>"",'data-category_id'=>$details[0]['category_id'])); ?>
<div class="modal-body">
  <div class="form-group col-md-12">
    <label class="control-label" for="category_name">Category Name:</label>
    <?php echo form_input($category_name); ?>
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
  $('#category_edit_form').parsley();
  $('#category_edit_form').submit(function(e){
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-category_id');
    var values = $("#category_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('categories/update_category') ?>/'+id,
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
          category_datatable.fnDraw();
          $('#category_edit_form').parsley().reset();
        }else
        {
         toastr.error(result.message);
        }
      }
    });
  });
// });

</script>
