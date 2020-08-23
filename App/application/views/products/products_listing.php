<?php
$product_name = array(
  'name'  => 'product_name',
  'id'  => 'product_name',
  'value' => set_value('product_name'),
  'class'=>'form-control',
  'placeholder'=>'Product Name',
  'data-parsley-required'=>'true'
);
$sku = array(
  'name'  => 'sku',
  'id'  => 'sku',
  'value' => set_value('sku'),
  'class'=>'form-control',
  'placeholder'=>'SKU Id',
);
$unit_cost = array(
  'name'  => 'unit_cost',
  'id'  => 'unit_cost',
  'value' => set_value('unit_cost',0),
  'class'=>'form-control',
  'placeholder'=>'Product Price',
  'data-parsley-required'=>'true',
  'min'=>'0',
  'step'=>'0.01',
  'type'=>'number',
  'readonly'=>'readonly'
);
$salling_price = array(
  'name'  => 'salling_price',
  'id'  => 'salling_price',
  'value' => set_value('salling_price',0),
  'class'=>'form-control',
  'placeholder'=>'Salling Price',
  'data-parsley-required'=>'true',
  'min'=>'0',
  'step'=>'0.01',
  'type'=>'number',
  'readonly'=>'readonly'
);

$unit_cost_exclude_gst = array(
  'name'  => 'unit_cost_exclude_gst',
  'id'  => 'unit_cost_exclude_gst',
  'value' => set_value('unit_cost_exclude_gst',0),
  'class'=>'form-control unit_cost_exclude_gst',
  'placeholder'=>'Product Price(Exc. GST)',
  'data-parsley-required'=>'true',
  'min'=>'0',
  'step'=>'0.01',
  'type'=>'number'
);
$salling_price_exclude_gst = array(
  'name'  => 'salling_price_exclude_gst',
  'id'  => 'salling_price_exclude_gst',
  'value' => set_value('salling_price_exclude_gst',0),
  'class'=>'form-control salling_price_exclude_gst',
  'placeholder'=>'Salling Price(Exc. GST)',
  'data-parsley-required'=>'true',
  'min'=>'0',
  'step'=>'0.01',
  'type'=>'number'
);



$category_options = array(''=>'--Select--');
if($categories && count($categories)> 0)
{
  foreach($categories as $val)
  {
    $category_options[$val['category_id']]= $val['category_name'];
  }
}
$categories = array(
  'name'  => 'category_name',
  'id'  => 'category_name',
  'value' => set_value('category_name',@$details[0]['category_id']),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true'
);

$brand_options = array(''=>'--Select--');
if($brands && count($brands)> 0)
{
  foreach($brands as $val)
  {
    $brand_options[$val['brand_id']]= $val['brand_name'];
  }
}
$brands = array(
  'name'  => 'brand',
  'id'  => 'brand',
  'value' => set_value('brand',@$details[0]['brand_id']),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true'
);


$measurement_options = array(''=>'--Select--');
if($measurements && count($measurements)> 0)
{
  foreach($measurements as $val)
  {
    $measurement_options[$val['measurement_id']]= $val['measurement_name'];
  }
}
$measurements = array(
  'name'  => 'measurement',
  'id'  => 'measurement',
  'value' => set_value('measurement',@$details[0]['measurement']),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true'
);

$igst = array(
  'name'  => 'igst',
  'id'  => 'igst',
  'value' => set_value('igst',0),
  'class'=>'form-control gst',
  'placeholder'=>'IGST %',
   'type'=>'number',
   'min'=>'0',
   'step'=>'0.01',
  'data-parsley-required'=>'true',
);
$cgst = array(
  'name'  => 'cgst',
  'id'  => 'cgst',
  'value' => set_value('cgst',0),
  'class'=>'form-control gst',
  'placeholder'=>'CGST %',
   'type'=>'number',
   'min'=>'0',
   'step'=>'0.01',
  'data-parsley-required'=>'true',
);
$sgst = array(
  'name'  => 'sgst',
  'id'  => 'sgst',
  'value' => set_value('sgst',0),
  'class'=>'form-control gst',
  'placeholder'=>'SGST %',
  'type'=>'number',
  'min'=>'0',
  'step'=>'0.01',
  'data-parsley-required'=>'true',
);
$product_description = array(
  'name'  => 'product_description',
  'id'  => 'product_description',
  'value' => set_value('product_description'),
  'class'=>'form-control s_addr',
  'placeholder'=>'Product Description',
  'rows'=>4,
);
$hsn_sac_code = array(
  'name'  => 'hsn_sac_code',
  'id'  => 'hsn_sac_code',
  'value' => set_value('hsn_sac_code'),
  'class'=>'form-control s_addr',
  'placeholder'=>'HSN/SAC Code',
  'rows'=>4,
);
$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>
<script src="<?php echo base_url('assets/plugins/daterangepicker/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.min.js');?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.css');?>" />
<div class="content-wrapper" style="min-height: 916px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="pull-left">
      <?php echo $title; ?>
    </h1>
     <div class="pull-right" >
       <?php if(in_array(strtolower('products_add_product'),$permissions)){?> 
      <a href="#" class="btn btn-custom" title="Add Product" data-toggle="modal" data-target="#add_product" ><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Add</a>
     <?php }?>
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
            <div class="clearfix"></div>
            <div class="row">
            <div class="form-group col-md-3">
              <?php  echo form_dropdown($categories,$category_options,$categories['value']); ?>
             </div> 
           </div>
             <div class="clearfix"></div>
            <table id="products_listing" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th style="width:200px;">SKU Id</th>
                  <th style="width:300px;">Product name</th>
                  <th style="width:200px;">Category</th>
                  <th style="width:200px;">Brand</th>
                  <th style="width:100px;">Product Price</th>
                  <th style="width:100px;">Salling Price</th>
                  <th style="width:80px;">Created</th>
                  <th style="width:150px;" class="actions">Actions</th>
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
<div class="modal fade " id="add_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 60%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Product</h4>
      </div>
      <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"product_add_form",'name'=>'product_add_form', 'data-parsley-validate'=>"")); ?>
      <div class="modal-body">
    <div class="form-group col-md-6">
    <label class="control-label" for="sku">SKU Id:</label>
    <?php echo form_input($sku); ?>
  </div>
    <div class="form-group col-md-6">
    <label class="control-label" for="product_name">Product Name:</label>
    <?php echo form_input($product_name); ?>
  </div>
  <div class="form-group col-md-6">
    <label class="control-label" for="categories">Category:</label>
    <?php  echo form_dropdown($categories,$category_options,$categories['value']); ?>
  </div>
  <div class="form-group col-md-6">
    <label class="control-label" for="brands">Brands:</label>
    <?php  echo form_dropdown($brands,$brand_options,$brands['value']); ?>
  </div>
  <div class="form-group col-md-2">
    <label class="control-label" for="taxes">IGST %:</label>
    <?php echo form_input($igst); ?>
  </div>
  <div class="form-group col-md-2">
    <label class="control-label" for="taxes">CGST %:</label>
    <?php echo form_input($cgst); ?>
  </div>
  <div class="form-group col-md-2">
    <label class="control-label" for="taxes">SGST %:</label>
    <?php echo form_input($sgst); ?>
  </div>
  <div class="form-group col-md-3">
    <label class="control-label" for="measurements">Unit:</label>
    <?php  echo form_dropdown($measurements,$measurement_options,$measurements['value']); ?>
  </div>
  <div class="form-group col-md-3">
    <label class="control-label" for="hsn_sac_code">HSN/SAC Code:</label>
    <?php echo form_input($hsn_sac_code); ?>
  </div>
  <div class="form-group col-md-3">
    <label class="control-label" for="unit_cost_exclude_gst">Product Price(Exc. GST):</label>
    <?php echo form_input($unit_cost_exclude_gst); ?>
  </div>
  <div class="form-group col-md-3">
    <label class="control-label" for="salling_price_exclude_gst">Salling Price(Exc. GST):</label>
    <?php echo form_input($salling_price_exclude_gst); ?>
  </div>
  <div class="form-group col-md-3">
    <label class="control-label" for="unit_cost">Product Price(Inc. GST):</label>
    <?php echo form_input($unit_cost); ?>
  </div>
  <div class="form-group col-md-3">
    <label class="control-label" for="salling_price">Salling Price(Inc. GST):</label>
    <?php echo form_input($salling_price); ?>
  </div>
  <div class="form-group col-md-12">
    <label class="control-label" for="product_description">Product Description:</label>
    <?php echo form_textarea($product_description); ?>
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

<!-- Edit product -->
<div class="modal fade" role="dialoge" tabindex="-1" id="edit_product" aria-labelledby ="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 60%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Product</h4>
      </div>
      <div id="edit_content"></div>
    </div><!-- modal content-->
  </div><!-- modal dialog-->
</div><!-- /modal-->
<!-- Main content -->

<!--View product -->
<div class="modal fade" id="view_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
var product_datatable= "";
var category_name="";
$('#product_add_form').parsley();
$(document).ready(function(){

  product_datatable = $('table#products_listing ').DataTable({
    "bServerSide": true,
    "sAjaxSource": "<?php echo site_url('products/products_listing'); ?>",
    "sPaginationType": "full_numbers",
    "iDisplayLength":25,
    "fnServerData": function (sSource, aoData, fnCallback)
    {
      var csrf = {"name": "<?php echo $csrf['name'];?>", "value":"<?php echo $csrf['hash'];?>"};
      aoData.push(csrf);
      aoData.push({name: "category_name", value: category_name});
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
      var categories = <?php echo json_encode($categories); ?>;
      var category="";
      var links="";
       links += '<a href="#" data-product_id="'+aData[7]+'" title="View Details" class="btn btn-default btn-xs view_product" style="margin-right:5px;" ><span class="glyphicon glyphicon-search"></span></a>';
        <?php if(in_array(strtolower('products_edit_product'),$permissions)){?>
      links += '<a href="#" data-product_id="'+aData[7]+'" title="Edit Details" class="btn btn-xs btn-custom edit_product" style="margin-right:5px;" ><span class="glyphicon glyphicon-pencil"></span></a>';
        <?php }if(in_array(strtolower('products_delete'),$permissions)){?>
      links +='<a href="#" data-product_id="'+aData[7]+'" title="Delete" class="btn btn-danger btn-xs delete_product"  style="margin-right:5px;"><span class="glyphicon glyphicon-trash"></span></a>';
       <?php }?>
      $('td:eq(6)', nRow).html(dateSplit(aData[6]));
      $('td:eq(7)', nRow).html(links);
    },
    aoColumnDefs: [
      {
        bSortable: false,
        aTargets: [7]
      },
      {
        bSearchable: false,
        aTargets: [7]
      }
    ]
  });

  $(document).on('change','#category_name',function(e){
       e.preventDefault(); 
       category_name =  $('#category_name').val();
       product_datatable.fnDraw();
     });
 
  //Add product
  $('#product_add_form').parsley();
  $("#product_add_form").on('submit',function(){
    var _this=$(this);
    var values = $('#product_add_form').serialize();
    $.ajax({
      url:'<?php echo site_url('products/add_product'); ?>',
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
          $('#product_add_form')[0].reset();
          $('#product_add_form').parsley().reset();

          product_datatable.fnDraw();

        }else{
          toastr.error(result.message);
        }
      }
    });
    return false;
  });

  //Edit product
  $(document).on('click','.edit_product',function(e){
    e.preventDefault();
    id = $(this).attr('data-product_id');
    $.ajax({
      url:'<?php echo site_url('products/edit_product') ?>/'+id,
      dataType: 'html',
      success:function(result)
      {
        $('#edit_content').html(result);
      }
    });
    $('#edit_product').modal('show');
  });
    //View product
   $(document).on('click','.view_product',function(e){
    e.preventDefault();
    id = $(this).attr('data-product_id');
    $.ajax({
      url:'<?php echo site_url('products/view_product') ?>/'+id,
      dataType: 'html',
      success:function(result)
      {
        $('#view_content').html(result);
        var history_datatable = $('table#history_tbl ').DataTable({
            "sPaginationType": "full_numbers",
            'bFilter':false,
            "bLengthChange": false,
            "aaSorting": [[1,'desc']],
            });
      }
    });
    $('#view_product').modal('show');
  });


  //Delete product
  $(document).on('click','.delete_product',function(e){
    e.preventDefault();
    var response = confirm('Are you sure want to delete this product?');
    if(response){
      id = $(this).attr('data-product_id');
      $.ajax({
        url:'<?php echo site_url('products/delete') ?>/'+id,
        dataType: 'json',
        success:function(result)
        {
          if(result.status==1)
          {
            toastr.success(result.message);
            product_datatable.fnDraw();
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

   $(document).on('keyup keypress blur change','.gst,.unit_cost_exclude_gst,.salling_price_exclude_gst',function (){
  calculate_price();
 });

});

function calculate_price(){
  console.log('sdf')
  var total_gst_tax=0;
  $.each($('.gst'),function (i,v){
      total_gst_tax=total_gst_tax+parseFloat($(v).val());
    })
$('#unit_cost').val(parseFloat($('#unit_cost_exclude_gst').val())+parseFloat($('#unit_cost_exclude_gst').val()*total_gst_tax/100));
$('#salling_price').val(parseFloat($('#salling_price_exclude_gst').val())+parseFloat($('#salling_price_exclude_gst').val()*total_gst_tax/100));
}
</script>
