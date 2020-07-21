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
  'value' => set_value('wherehouse'),
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
  'value' => set_value('product'),
  'class'=>'form-control',
  'data-parsley-required'=>'true',
);

$stock = array(
  'name'  => 'stock',
  'id'  => 'stock',
  'value' => set_value('stock',0),
  'class'=>'form-control',
  'type'=>'number',
  'placeholder'=>'Stock',
  'min'=>'0',
);
$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>
<div class="content-wrapper" style="min-height: 916px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="pull-left">
      <?php echo $title; ?>

    </h1>
    <div class="pull-right" >
      <a href="#" class="btn btn-custom" title="Add Product" data-toggle="modal" data-target="#add_stock" ><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Add</a>
    </div>
    <div class="clearfix"></div>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div id="alert_area">
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-danger">
          <div class="box-body">
            <table id="stocks_listing" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th>Wherehouse name</th>
                  <th>Product name</th>
                  <th>Stocks</th>
                  <th class="actions">Actions</th>
                </tr>
              </thead>
            </table>
          </div><!-- /.box-body -->
        </div>
      </div>
    </div>
  </section><!-- /.content -->
</div>

<!--Add product Modal -->
<div class="modal fade " id="add_stock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 60%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Stock</h4>
      </div>
      <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"stock_add_form",'name'=>'stock_add_form', 'data-parsley-validate'=>"")); ?>
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
  <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <div class="clearfix"></div>
        <button type="submit" class="btn btn-custom pull-right save" style="margin-left: 5px;"><i class="fa fa-spinner fa-spin formloader"></i> Add</button>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="margin-left: 5px;">Back</button>
        <div class="clearfix"></div>
        <div id="add_res" class="text-left" style="margin-top: 5px;"></div>
      </div>
      <?php echo form_close(); ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit stock -->
<div class="modal fade" role="dialoge" tabindex="-1" id="edit_stock" aria-labelledby ="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Stock</h4>
      </div>
      <div id="edit_content"></div>
    </div><!-- modal content-->
  </div><!-- modal dialog-->
</div><!-- /modal-->
<!-- Main content -->

<!--View product -->
<div class="modal fade" id="view_stock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Details</h4>
      </div>
      <div class="modal-body">
       <div id="view_content">

       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Back</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Main content -->

<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script>
var stock_datatable= "";
$('#category_add_form').parsley();
$(document).ready(function(){
  //stocks listing
  stock_datatable = $('table#stocks_listing ').DataTable({
    "bServerSide": true,
    "sAjaxSource": "<?php echo site_url('stocks/stocks_listig'); ?>",
    "sPaginationType": "full_numbers",
    "iDisplayLength":25,
    "fnServerData": function (sSource, aoData, fnCallback)
    {
      var csrf = {"name": "<?php echo $csrf['name'];?>", "value":"<?php echo $csrf['hash'];?>"};
      aoData.push(csrf);
      $.ajax({
        "dataType": 'json',
        "type": "POST",
        "url": sSource,
        "data": aoData,
        "success": fnCallback
      });
    },
    "fnDrawCallback" : function() {
    },
    "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
      var currentDate="";
      var links="";
   
       links += '<a href="#" data-stock_id="'+aData[3]+'" title="View Details" class="btn btn-default btn-xs view_stock" style="margin-right:5px;" ><span class="glyphicon glyphicon-search"></span></a>';

      links += '<a href="#" data-stock_id="'+aData[3]+'" title="Edit Details" class="btn btn-custom btn-xs edit_stock" style="margin-right:5px;" ><span class="glyphicon glyphicon-pencil"></span></a>';
     
      links +='<a href="#" data-stock_id="'+aData[3]+'" title="Delete" class="btn btn-danger btn-xs delete_stock"  style="margin-right:5px;"><span class="glyphicon glyphicon-trash"></span></a>';
   
      $('td:eq(3)', nRow).html(links);
    },
    aoColumnDefs: [
      {
        bSortable: false,
        aTargets: [3]
      },
      {
        bSearchable: false,
        aTargets: [3]
      }
    ]
  });
   //Add stock
  $('#stock_add_form').parsley();
  $("#stock_add_form").on('submit',function(e){
    e.preventDefault();
    var _this=$(this);
    var values = $('#stock_add_form').serialize();
    $.ajax({
      url:'<?php echo site_url('stocks/add_stock'); ?>',
      dataType:'json',
      type:'POST',
      data:values,
      // shows the loader element before sending.
      beforeSend: function (){before(_this)},
      // hides the loader after completion of request, whether successfull or failor.
      complete: function (){complete(_this)},
      success:function(result){
        if(result.status==1){
         toastr.success(result.message);
          $('#stock_add_form')[0].reset();
          $('#stock_add_form').parsley().reset();

          stock_datatable.fnDraw();

        }else{
         toastr.error(result.message);
        }
      }
    });
    return false;
  });

  //Edit brand
  $(document).on('click','.edit_stock',function(e){
    e.preventDefault();
    id = $(this).attr('data-stock_id');
    $.ajax({
      url:'<?php echo site_url('stocks/edit_stock') ?>/'+id,
      dataType: 'html',
      success:function(result)
      {
        $('#edit_content').html(result);
      }
    });
    $('#edit_stock').modal('show');
  });
  //View stock
   $(document).on('click','.view_stock',function(e){
    e.preventDefault();
    id = $(this).attr('data-stock_id');
    $.ajax({
      url:'<?php echo site_url('stocks/view_stock') ?>/'+id,
      dataType: 'html',
      success:function(result)
      {
        $('#view_content').html(result);
      }
    });
    $('#view_stock').modal('show');
  });
  //Delete brand
  $(document).on('click','.delete_stock',function(e){
    e.preventDefault();
    var response = confirm('Are you sure want to delete this stock?');
    if(response){
      id = $(this).attr('data-stock_id');
      $.ajax({
        url:'<?php echo site_url('stocks/delete_stock') ?>/'+id,
        dataType: 'json',
        success:function(result)
        {
          if(result.status==1)
          {
           toastr.success(result.message);
            stock_datatable.fnDraw();
          }
          else
          {
            toastr.error(result.message);
          }
        }
      });
    }
    return false;
  });
    });
</script>
