<?php
$account_groups_options = array(''=>'--Select--');
if($account_groups && count($account_groups)> 0)
{
  foreach($account_groups as $val)
  {
    $account_groups_options[$val['account_group_id']]= $val['group_name'];
  }
}
$account_groups = array(
  'name'  => 'account_group',
  'id'  => 'account_group',
  'value' => set_value('account_group'),
  'class'=>'form-control',
  'data-parsley-required'=>'true'
);
$leadger_name = array(
  'name'  => 'leadger_name',
  'id'  => 'leadger_name',
  'value' => set_value('leadger_name'),
  'class'=>'form-control',
  'placeholder'=>'Leadger Name',
  'data-parsley-required'=>'true'
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

$closing_balance = array(
  'name'  => 'closing_balance',
  'id'  => 'closing_balance',
  'value' => set_value('closing_balance',0),
  'class'=>'form-control',
  'placeholder'=>'Closing Balance',
  'data-parsley-required'=>'true',
  'min'=>'0',
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
       <?php  if(in_array(strtolower('ledgers_index'),$permissions)){?>
      <a href="#" class="btn btn-custom" title="Add Ledger" data-toggle="modal" data-target="#add_leadger_form" ><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Add</a>
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
            <table id="account_ledgers_listing" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th style="width:300px;">Ledger name</th>
                  <th style="width:200px;">Group Name</th>
                  <th style="width:200px;">Opening Balance</th>
                  <th style="width:200px;">Closing Balance</th>
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
<div class="modal fade " id="add_leadger_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Ledger</h4>
      </div>
      <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"leadger_add_form",'name'=>'leadger_add_form', 'data-parsley-validate'=>"")); ?>
      <div class="modal-body">
      <div class="form-group col-md-6">
      <label class="control-label" for="leadger_name">Ledger Name:</label>
      <?php echo form_input($leadger_name); ?>
      </div>
      <div class="form-group col-md-6">
      <label class="control-label" for="account_groups">Account Group:</label>
      <?php  echo form_dropdown($account_groups,$account_groups_options,$account_groups['value']); ?>
      </div>

      <div class="form-group col-md-6">
        <label class="control-label" for="opening_balance">Opening Blance:</label>
        <?php echo form_input($opening_balance); ?>
      </div>
      
      <div class="form-group col-md-6">
        <label class="control-label" for="closing_balance">Closing Blance:</label>
        <?php echo form_input($closing_balance); ?>
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
<div class="modal fade" role="dialoge" tabindex="-1" id="edit_ledger_model" aria-labelledby ="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 50%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Ledger</h4>
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
var leadger_datatable= "";
$('#leadger_add_form').parsley();
$(document).ready(function(){
  //leadger listing
  leadger_datatable = $('table#account_ledgers_listing ').DataTable({
    "bServerSide": true,
    "sAjaxSource": "<?php echo site_url('ledgers/leadgers_listing'); ?>",
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
       links += '<a href="#" data-ledger_id="'+aData[5]+'" title="View Details" class="btn btn-default btn-xs view_account_group" style="margin-right:5px;" ><span class="glyphicon glyphicon-search"></span></a>';
        <?php  if(in_array(strtolower('ledgers_edit_ledger'),$permissions)){?>
      links += '<a href="#" data-ledger_id="'+aData[5]+'" title="Edit Details" class="btn  btn-xs btn-custom edit_ledger" style="margin-right:5px;" ><span class="glyphicon glyphicon-pencil"></span></a>';
        <?php } if(in_array(strtolower('ledgers_delete_ledger'),$permissions)){?>
      links +='<a href="#" data-ledger_id="'+aData[5]+'" title="Delete" class="btn btn-danger btn-xs delete_ledger"  style="margin-right:5px;"><span class="glyphicon glyphicon-trash"></span></a>';
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
  //Add ledger
  $('#leadger_add_form').parsley();
  $("#leadger_add_form").on('submit',function(){
    var _this=$(this);
    var values = $('#leadger_add_form').serialize();
    $.ajax({
      url:'<?php echo site_url('ledgers/add_ledger'); ?>',
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
          $('#leadger_add_form')[0].reset();
          $('#leadger_add_form').parsley().reset();

          leadger_datatable.fnDraw();

        }else{
          toastr.error(result.message);
        }
      }
    });
    return false;
  });

  //Edit ledger
  $(document).on('click','.edit_ledger',function(e){
    e.preventDefault();
    id = $(this).attr('data-ledger_id');
    $.ajax({
      url:'<?php echo site_url('ledgers/edit_ledger') ?>/'+id,
      dataType: 'html',
      success:function(result)
      {
        $('#edit_content').html(result);
      }
    });
    $('#edit_ledger_model').modal('show');
  });
    //View ledger
   $(document).on('click','.view_product',function(e){
    e.preventDefault();
    id = $(this).attr('data-ledger_id');
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


  //Delete ledger
  $(document).on('click','.delete_ledger',function(e){
    e.preventDefault();
    var response = confirm('Are you sure want to delete this account ledger?');
    if(response){
      id = $(this).attr('data-ledger_id');
      $.ajax({
        url:'<?php echo site_url('ledgers/delete_ledger') ?>/'+id,
        dataType: 'json',
        success:function(result)
        {
          if(result.status==1)
          {
            toastr.success(result.message);
            leadger_datatable.fnDraw();
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
