<?php
$currency_code = array(
  'name'  => 'currency_code',
  'id'  => 'currency_code',
  'value' => set_value('currency_code',@$details[0]['currency_code']),
  'class'=>'form-control',
  'placeholder'=>'Currency Code',
  'data-parsley-required'=>'true'
);
$currency_symbol = array(
  'name'  => 'currency_symbol',
  'id'  => 'currency_symbol',
  'value' => set_value('currency_symbol',@$details[0]['currency_symbol']),
  'class'=>'form-control',
  'placeholder'=>'Currency Symbol',
  'data-parsley-required'=>'true'
);
$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>
<?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"currency_edit_form",'name'=>'currency_edit_form', 'data-parsley-validate'=>"",'data-currency_id'=>$details[0]['currency_id'])); ?>
<div class="modal-body">
 <div class="form-group col-md-12">
          <label class="control-label" for="currency_code">Currency Code:</label>
          <?php echo form_input($currency_code); ?>
        </div>
        <div class="form-group col-md-12">
          <label class="control-label" for="currency_symbol">Currency Symbol:</label>
          <?php echo form_input($currency_symbol); ?>
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
  $('#currency_edit_form').parsley();
  $('#currency_edit_form').submit(function(e){
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-currency_id');
    var values = $("#currency_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('currencies/update_currency') ?>/'+id,
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
          $('#currency_edit_form').parsley().reset();
          currency_datatable.fnDraw();
        }else
        {
          toastr.error(result.message);
        }
      }
    });
  });
// });

</script>
