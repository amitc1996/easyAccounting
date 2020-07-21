<?php
$vendor_options = array(''=>'--Select--');
if($vendors && count($vendors)> 0)
{
  foreach($vendors as $val)
  {
    $vendor_options[$val['vendor_id']]= $val['vendor_name'];
  }
}
$vendors = array(
  'name'  => 'vendor_name',
  'id'  => 'vendor_name',
  'value' => set_value('vendor_name',@$details[0]['vendor_id']),
  'class'=>'form-control',
  'data-parsley-required'=>'true'        
);

$marketplace_options = array(''=>'--Select--');
if($marketplaces && count($marketplaces)> 0)
{
  foreach($marketplaces as $val)
  {
    $marketplace_options[$val['marketplace_id']]= $val['marketplace_name'];
  }
}
$marketplaces = array(
  'name'  => 'marketplace_name',
  'id'  => 'marketplace_name',
  'value' => set_value('marketplace_name',@$details[0]['marketplace_id']),
  'class'=>'form-control',
  'data-parsley-required'=>'true'        
);
$date_purchased = array(
  'name'  => 'date_purchased',
  'id'  => 'edate_purchased',
  'value' => set_value('date_purchased',date("m/d/Y", strtotime(@$details[0]['purchase_date']))),
  'class'=>'form-control',
  'data-parsley-required'=>'true',
  'readonly'=>'readonly'       
);
?>
<?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"purchase_return_edit_form",'name'=>'purchase_return_edit_form', 'data-parsley-validate'=>"",'data-purchase_id'=>@$details[0]['purchase_id'])); ?>
<div class="modal-body">
   <div class="form-group col-md-4">
              <label class="control-label" for="name">Vendor:</label>
             <?php  echo form_dropdown($vendors, $vendor_options,$vendors['value']); ?>
          </div>
          <div class="form-group col-md-4">
              <label class="control-label" for="email">Marketplace:</label>
              <?php  echo form_dropdown($marketplaces, $marketplace_options,$marketplaces['value']); ?>
          </div>
           <div class="form-group col-md-4">
              <label class="control-label" for="name">Date Purchased:</label>
             <?php  echo form_input($date_purchased); ?>
          </div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
  <div class="clearfix"></div>
  <button type="submit" class="btn btn-primary pull-right save" style="margin-left: 5px;"><i class="fa fa-spinner fa-spin formloader"></i> Save Changes</button>
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="margin-left: 5px;">Back</button>
  <?php echo form_close(); ?>
  <div class="clearfix"></div>
  <div id="edit_res" class="text-left" style="margin-top: 5px;"></div>
</div>

<script>
// $(document).ready(function(e){
 $("#edate_purchased").datepicker({
      dateFormat: 'mm/dd/yy',
      maxDate: new Date,
      changeMonth: true,changeYear: true,yearRange: "-100:+0",  
 });
  //attach parsley validation
  $('#purchase_return_edit_form').parsley();
  $('#purchase_return_edit_form').submit(function(e){
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-purchase_id');
    var values = $("#purchase_return_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('purchases_return/update_purchase_return') ?>/'+id,
      type:'post',
      dataType: 'json',
      data:values,
      // shows the loader element before sending.
      beforeSend: function (){before(_this)},
      // hides the loader after completion of request, whether successfull or failor.
      complete: function (){complete(_this)},
      success:function(result){

        if(result.status==1){
          $('#edit_res').empty().html('<div class="alert alert-success text-left  alert-dismissable" id="e_disappear">'+result.message+'</div>');
          setTimeout(function(){$('#e_disappear').fadeOut('slow')},3000);
          ajax_datatable.fnDraw();
          $('#purchase_return_edit_form').parsley().reset();
        }else
        {
          $('#edit_res').empty().html('<div class="alert alert-danger text-left  alert-dismissable" id="e_disappear">'+result.message+'</div>');
          setTimeout(function(){$('#e_disappear').fadeOut('slow')},3000)
        }
      }
    });
  });
// });

</script>
