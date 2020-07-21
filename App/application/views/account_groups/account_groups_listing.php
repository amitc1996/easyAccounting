<?php
$branches_options = array(''=>'--Select--');
if($branches && count($branches)> 0)
{
  foreach($branches as $val)
  {
    $branches_options[$val['branch_id']]= $val['branch_name'];
  }
}
$branches = array(
  'name'  => 'branch',
  'id'  => 'branch',
  'value' => set_value('branch'),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true'
);
$group_name = array(
  'name'  => 'group_name',
  'id'  => 'group_name',
  'value' => set_value('group_name'),
  'class'=>'form-control',
  'placeholder'=>'Group Name',
  'data-parsley-required'=>'true'
);
$sku = array(
  'name'  => 'sku',
  'id'  => 'sku',
  'value' => set_value('sku'),
  'class'=>'form-control',
  'placeholder'=>'SKU Id',
);

$opening_balance = array(
  'name'  => 'opening_balance',
  'id'  => 'opening_balance',
  'value' => set_value('opening_balance',0),
  'class'=>'form-control',
  'placeholder'=>'Opening Balance',
  'data-parsley-required'=>'true',
  'min'=>'0',
);

$category_options = array(''=>'--Select--');
if($categories && count($categories)> 0)
{
  foreach($categories as $val)
  {
    $category_options[$val['account_category_id']]= $val['account_category_name'];
  }
}
$categories = array(
  'name'  => 'category_name',
  'id'  => 'category_name',
  'value' => set_value('category_name'),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true'
);

$description = array(
  'name'  => 'description',
  'id'  => 'description',
  'value' => set_value('description'),
  'class'=>'form-control s_addr',
  'placeholder'=>'Description',
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
      <?php if(in_array(strtolower('account_groups_add_account_group'),$permissions)){?>    
      <a href="#" class="btn btn-custom" title="Add Account Group" data-toggle="modal" data-target="#add_account_group_category" ><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Add</a>
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
            <table id="account_groups_listing" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th style="width:200px;">Branch</th>
                  <th style="width:300px;">Group name</th>
                  <th style="width:200px;">Category</th>
                  <th style="width:200px;">Opening Balance</th>
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
<div class="modal fade " id="add_account_group_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Group</h4>
      </div>
      <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"account_group_add_form",'name'=>'account_group_add_form', 'data-parsley-validate'=>"")); ?>
      <div class="modal-body">
    <div class="form-group col-md-6">
   <label class="control-label" for="branches">Branch:</label>
    <?php  echo form_dropdown($branches,$branches_options,$branches['value']); ?>
  </div>
  <div class="form-group col-md-6">
    <label class="control-label" for="group_name">Group Name:</label>
    <?php echo form_input($group_name); ?>
  </div>
  <div class="clearfix"></div>
    <div class="form-group col-md-6">
    <label class="control-label" for="categories">Category:</label>
   <?php  echo form_dropdown($categories,$category_options,$categories['value']); ?>
  </div>
  <div class="form-group col-md-6">
    <label class="control-label" for="opening_balance">Opening Blance:</label>
    <?php echo form_input($opening_balance); ?>
  </div>

  <div class="form-group col-md-12">
    <label class="control-label" for="description">Description:</label>
    <?php echo form_textarea($description); ?>
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
<div class="modal fade" role="dialoge" tabindex="-1" id="edit_account_group_model" aria-labelledby ="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 50%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Account Group</h4>
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
var account_group_datatable= "";
$('#account_group_add_form').parsley();
$(document).ready(function(){

  account_group_datatable = $('table#account_groups_listing ').DataTable({
    "bServerSide": true,
    "sAjaxSource": "<?php echo site_url('account_groups/account_group_listing'); ?>",
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
      var links="";
       links += '<a href="#" data-account_group_id="'+aData[5]+'" title="View Details" class="btn btn-default btn-xs view_account_group" style="margin-right:5px;" ><span class="glyphicon glyphicon-search"></span></a>';
        <?php if(in_array(strtolower('account_groups_edit_account_group'),$permissions)){?> 
      links += '<a href="#" data-account_group_id="'+aData[5]+'" title="Edit Details" class="btn btn-xs btn-custom edit_account_group" style="margin-right:5px;" ><span class="glyphicon glyphicon-pencil"></span></a>';
        <?php }if(in_array(strtolower('account_groups_delete_account_groups'),$permissions)){?> 
      links +='<a href="#" data-account_group_id="'+aData[5]+'" title="Delete" class="btn btn-danger btn-xs delete_account_group"  style="margin-right:5px;"><span class="glyphicon glyphicon-trash"></span></a>';
      <?php }?>
      $('td:eq(4)', nRow).html(dateSplit(aData[4]));
      $('td:eq(5)', nRow).html(links);
    },
    aoColumnDefs: [
      {
        bSortable: false,
        aTargets: [5]
      },
      {
        bSearchable: false,
        aTargets: [5]
      }
    ]
  });

 
  //Add product
  $('#account_group_add_form').parsley();
  $("#account_group_add_form").on('submit',function(){
    var _this=$(this);
    var values = $('#account_group_add_form').serialize();
    $.ajax({
      url:'<?php echo site_url('account_groups/add_account_group'); ?>',
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
          $('#account_group_add_form')[0].reset();
          $('#account_group_add_form').parsley().reset();

          account_group_datatable.fnDraw();

        }else{
          toastr.error(result.message);
        }
      }
    });
    return false;
  });

  //Edit product
  $(document).on('click','.edit_account_group',function(e){
    e.preventDefault();
    id = $(this).attr('data-account_group_id');
    $.ajax({
      url:'<?php echo site_url('account_groups/edit_account_group') ?>/'+id,
      dataType: 'html',
      success:function(result)
      {
        $('#edit_content').html(result);
      }
    });
    $('#edit_account_group_model').modal('show');
  });
    //View product
   $(document).on('click','.view_product',function(e){
    e.preventDefault();
    id = $(this).attr('data-account_group_id');
    $.ajax({
      url:'<?php echo site_url('products/view_product') ?>/'+id,
      dataType: 'html',
      success:function(result)
      {
        $('#view_content').html(result);
        var history_datatable = $('table#history_tbl ').DataTable({
            "sPaginationType": "full_numbers",
            'bFilter':false,
            "bLengthChange": false
            });
      }
    });
    $('#view_product').modal('show');
  });


  //Delete product
  $(document).on('click','.delete_account_group',function(e){
    e.preventDefault();
    var response = confirm('Are you sure want to delete this account groups?');
    if(response){
      id = $(this).attr('data-account_group_id');
      $.ajax({
        url:'<?php echo site_url('account_groups/delete_account_groups') ?>/'+id,
        dataType: 'json',
        success:function(result)
        {
          if(result.status==1)
          {
            toastr.success(result.message);
            account_group_datatable.fnDraw();
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
