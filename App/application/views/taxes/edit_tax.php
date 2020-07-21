<?php
$texgroups=json_decode($details[0]['taxe_groups'],true);

$group_name = array(
  'name'  => 'group_name',
  'id'  => 'group_name',
  'value' => set_value('group_name',@$details[0]['tax_name']),
  'class'=>'form-control',
  'placeholder'=>'Ggroup Name',
  'data-parsley-required'=>'true'
);
$tax_name = array(
  'name'  => 'tax_name',
  'id'  => 'tax_name',
  'value' => set_value('tax_name',@$details[0]['tax_name']),
  'class'=>'form-control',
  'placeholder'=>'Tax Name',
  'data-parsley-required'=>'true'
);
$tax_percentage = array(
  'name'  => 'tax_percentage',
  'id'  => 'tax_percentage',
  'value' => set_value('tax_percentage',@$details[0]['tax_percentage']),
  'class'=>'form-control',
  'placeholder'=>'Tax %',
  'data-parsley-required'=>'true'
);
?>
<?php if($details[0]['is_grouped']==1){?>
  <?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"group_tax_edit_form",'name'=>'group_tax_edit_form', 'data-parsley-validate'=>"",'data-tax_id'=>$details[0]['tax_id'])); ?>
<div class="modal-body">
  <div class="row">
        <div class="form-group col-md-11">
          <label class="control-label" for="group_name">Group Name:</label>
          <?php echo form_input($group_name); ?>
        </div>
         <div class="form-group col-md-1">
         </div>
       </div>
           <div id="edynamic_tax_add_row"></div>
         <div class="form-group col-md-11">
          <a href="#" class="btn btn-info pull-right" id="eadd_row" title="Add row"><i class="fa fa-plus"></i></a>
         </div>
        <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
  <div class="clearfix"></div>
  <button type="submit" class="btn btn-custom pull-right save" style="margin-left: 5px;"><i class="fa fa-spinner fa-spin formloader"></i> Save Changes</button>
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="margin-left: 5px;">Back</button>
  <?php echo form_close(); ?>
 <?php }else  {?> 
<?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"tax_edit_form",'name'=>'tax_edit_form', 'data-parsley-validate'=>"",'data-tax_id'=>$details[0]['tax_id'])); ?>
<div class="modal-body">
  <div class="form-group col-md-12">
    <label class="control-label" for="tax_name">Tax Name:</label>
    <?php echo form_input($tax_name); ?>
  </div>
  <div class="form-group col-md-12">
    <label class="control-label" for="tax_percentage">Tax %:</label>
    <?php echo form_input($tax_percentage); ?>
  </div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
  <div class="clearfix"></div>
  <button type="submit" class="btn btn-custom pull-right save" style="margin-left: 5px;"><i class="fa fa-spinner fa-spin formloader"></i> Save Changes</button>
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="margin-left: 5px;">Back</button>
  <?php echo form_close(); ?>
   <?php }?> 
  <div class="clearfix"></div>
  <div id="edit_res" class="text-left" style="margin-top: 5px;"></div>
</div>

<script>
  <?php if($details[0]['taxe_groups']){?>
  var obj = JSON.parse('<?php echo $details[0]['taxe_groups'];?>');
  var rowCount=0;
$.each(obj, function(index, value) {
  var taxrow=`
        <div class="row ${rowCount}">
         <div class="form-group col-md-6">
          <input type="text" class="form-control" placeholder="Tax Name" name="taxes[${rowCount}][tax_name]" value="${value.tax_name}">
        </div>
         <div class="form-group col-md-5">
         <input type="text" class="form-control" placeholder="Tax %" name="taxes[${rowCount}][tax_percentage]" value="${value.tax_percentage}">
        </div>
         <div class="form-group col-md-1">
            <a href="#" data-remove_row="${rowCount}" class="btn btn-danger pull-right remove_row" title="Remove row"><i class="fa fa-minus"></i></a>
         </div>
               `;
        rowCount++;
         $('#edynamic_tax_add_row').append(taxrow);
     console.log(value.tax_name);
  // Will stop running after "three"
});
<?php }?>
// $(document).ready(function(e){
  $('#eadd_row').on('click',function(e){
   e.preventDefault();
   var taxrow=`
        <div class="row ${rowCount}">
         <div class="form-group col-md-6">
          <input type="text" class="form-control" placeholder="Tax Name" name="taxes[${rowCount}][tax_name]" value="">
        </div>
         <div class="form-group col-md-5">
         <input type="text" class="form-control" placeholder="Tax %" name="taxes[${rowCount}][tax_percentage]" value="">
        </div>
         <div class="form-group col-md-1">
            <a href="#" data-remove_row="${rowCount}" class="btn btn-danger pull-right remove_row" title="Remove row"><i class="fa fa-minus"></i></a>
         </div>
               `;
        rowCount++;
        $('#edynamic_tax_add_row').append(taxrow);
  });

  //attach parsley validation
  $('#tax_edit_form').parsley();
  $('#tax_edit_form').submit(function(e){
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-tax_id');
    var values = $("#tax_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('taxes/update_tax') ?>/'+id,
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
          $('#tax_edit_form').parsley().reset();
          tax_datatable.fnDraw();
        }else
        {
          toastr.error(result.message);
        }
      }
    });
  });
  //attach parsley validation
  $('#group_tax_edit_form').parsley();
  $('#group_tax_edit_form').submit(function(e){
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-tax_id');
    var values = $("#group_tax_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('taxes/update_group_tax') ?>/'+id,
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
          $('#group_tax_edit_form').parsley().reset();
          tax_datatable.fnDraw();
        }else
        {
          toastr.error(result.message);
        }
      }
    });
  });
// });

</script>
