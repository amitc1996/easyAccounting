<?php
$brnd_name = array(
  'name'  => 'brand_name',
  'id'  => 'brand_name',
  'value' => set_value('brand_name'),
  'class'=>'form-control',
  'placeholder'=>'Brand Name',
  'data-parsley-required'=>'true'
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
      <?php  if(in_array(strtolower('brands_add_brand'),$permissions)){?>
      <a href="#" class="btn btn-custom" title="Add Brand" data-toggle="modal" data-target="#add_brand" ><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Add</a>
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
      <div><?php echo $setting_aside; ?></div>
      <div class="col-xs-10">
        <div class="box box-danger">
          <div class="box-body">
            <table id="brands_listing" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th>Brand name</th>
                  <th>Created On</th>
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

<!--Add Brand Modal -->
<div class="modal fade " id="add_brand" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Brand</h4>
      </div>
      <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"brand_add_form",'name'=>'brand_add_form', 'data-parsley-validate'=>"")); ?>
      <div class="modal-body">
        <div class="form-group col-md-12">
        </div>
        <div class="form-group col-md-12">
          <label class="control-label" for="brnd_name">Brand Name:</label>
          <?php echo form_input($brnd_name); ?>
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

<!-- Edit brand -->
<div class="modal fade" role="dialoge" tabindex="-1" id="edit_brand" aria-labelledby ="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit brand</h4>
      </div>
      <div id="edit_content"></div>
    </div><!-- modal content-->
  </div><!-- modal dialog-->
</div><!-- /modal-->
<!-- Main content -->

<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script>
var brand_datatable= "";
$('#brand_add_form').parsley();
$(document).ready(function(){
  brand_datatable = $('table#brands_listing ').DataTable({
    "bServerSide": true,
    "sAjaxSource": "<?php echo site_url('brands/brands_listing'); ?>",
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
      <?php  if(in_array(strtolower('brands_edit_brand'),$permissions)){?>
      links += '<a href="#" data-brand_id="'+aData[2]+'" title="Edit Details" class="btn btn-custom btn-xs edit_brand" style="margin-right:5px;" ><span class="glyphicon glyphicon-pencil"></span></a>';
      <?php } if(in_array(strtolower('brands_delete_brand'),$permissions)){?>
      links +='<a href="#" data-brand_id="'+aData[2]+'" title="Delete" class="btn btn-danger btn-xs delete_brand"  style="margin-right:5px;"><span class="glyphicon glyphicon-trash"></span></a>';
    <?php }?>
      $('td:eq(2)', nRow).html(links);
      $('td:eq(1)', nRow).html((aData[1]=='0000-00-00 00:00:00')?'-':dateSplit(aData[1]));
    },
    aoColumnDefs: [
      {
        bSortable: false,
        aTargets: [2]
      },
      {
        bSearchable: false,
        aTargets: [2]
      }
    ]
  });

  //Add brand
  $('#brand_add_form').parsley();
  $("#brand_add_form").on('submit',function(){
    var _this=$(this);
    var values = $('#brand_add_form').serialize();
    $.ajax({
      url:'<?php echo site_url('brands/add_brand'); ?>',
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
          $('#brand_add_form')[0].reset();
          $('#brand_add_form').parsley().reset();

          brand_datatable.fnDraw();

        }else{
         toastr.error(result.message);
        }
      }
    });
    return false;
  });

  //Edit brand
  $(document).on('click','.edit_brand',function(e){
    e.preventDefault();
    id = $(this).attr('data-brand_id');
    $.ajax({
      url:'<?php echo site_url('brands/edit_brand') ?>/'+id,
      dataType: 'html',
      success:function(result)
      {
        $('#edit_content').html(result);
      }
    });
    $('#edit_brand').modal('show');
  });

  //Delete brand
  $(document).on('click','.delete_brand',function(e){
    e.preventDefault();
    var response = confirm('Are you sure want to delete this brand?');
    if(response){
      id = $(this).attr('data-brand_id');
      $.ajax({
        url:'<?php echo site_url('brands/delete_brand') ?>/'+id,
        dataType: 'json',
        success:function(result)
        {
          if(result.status==1)
          {
           toastr.success(result.message);
            brand_datatable.fnDraw();
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
