<?php
$wherehouse_options = array(''=>'--Select--');
if($wherehouses && count($wherehouses)> 0)
{
  foreach($wherehouses as $val)
  {
    $wherehouse_options[$val['wherehouse_id']]= $val['wherehouse_name'];
  }
}
$wherehouses = array(
  'name'  => 'wherehouse',
  'id'  => 'wherehouse',
  'value' => set_value('wherehouse',@$details[0]['wherehouse_id']),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true',
);

$products_options = array(''=>'--Select--');
if($products && count($products)> 0)
{
  foreach($products as $val)
  {
    $products_options[$val['product_id']]= $val['item_title'];
  }
}
$products = array(
  'name'  => 'product',
  'id'  => 'product',
  'value' => set_value('product',@$details[0]['product_id']),
  'class'=>'form-control',
  'data-parsley-required'=>'true',
);

$stock = array(
  'name'  => 'stock',
  'id'  => 'stock',
  'value' => set_value('stock',@$details[0]['stock']),
  'class'=>'form-control',
  'type'=>'number',
  'placeholder'=>'Stock',
  'min'=>'0',
);
?>
<?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"stock_edit_form",'name'=>'stock_edit_form', 'data-parsley-validate'=>"",'data-stock_id'=>$details[0]['stock_id'])); ?>
<div class="modal-body">
  <div class="form-group col-md-4">
      <label class="control-label" for="wherehouse">Wherehouse:</label>
        <?php  echo form_dropdown($wherehouses, $wherehouse_options,$wherehouses['value']); ?>
    </div>
    <div class="form-group col-md-4">
    <label class="control-label" for="product">Product:</label>
    <?php  echo form_dropdown($products, $products_options,$products['value']); ?>
  </div>
  <div class="form-group col-md-4">
    <label class="control-label" for="stock">Stock:</label>
    <?php echo form_input($stock); ?>
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
  $('#stock_edit_form').parsley();
  $('#stock_edit_form').submit(function(e){
    var _this=$(this);
    e.preventDefault();
    id = $(this).attr('data-stock_id');
    var values = $("#stock_edit_form").serialize();
    $.ajax({
      url:'<?php echo site_url('stocks/update_stock') ?>/'+id,
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
          stock_datatable.fnDraw();
          $('#stock_edit_form').parsley().reset();
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
