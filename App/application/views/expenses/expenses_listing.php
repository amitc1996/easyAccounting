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

$ledgers_options = array(''=>'--Select--');
if($ledgers && count($ledgers)> 0)
{
  foreach($ledgers as $val)
  {
    $ledgers_options[$val['leadger_id']]= $val['leadger_name'];
  }
}
$ledgers = array(
  'name'  => 'ledger',
  'id'  => 'ledger',
  'value' => set_value('ledger'),
  'class'=>'form-control item_row',
  'data-parsley-required'=>'true'
);

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
$expense_date = array(
  'name'  => 'expense_date',
  'id'  => 'expense_date',
  'value' => set_value('expense_date',date('m/d/Y',time())),
  'class'=>'form-control',
  'data-parsley-required'=>'true',
  'readonly'=>'readonly'
);
$amount = array(
  'name'  => 'amount',
  'id'  => 'amount',
  'value' => set_value('amount',0),
  'class'=>'form-control',
  'placeholder'=>'Amount',
  'data-parsley-required'=>'true',
  'min'=>'0',
);
$payment_type_options = array(
   ''=>'--Select--',
   'Cash'=>'Cash',
   'Chack'=>'Chack'
);
$payment_option = array(
  'name'  => 'payment_option',
  'id'  => 'payment_option',
  'value' => set_value('payment_option'),
  'class'=>'form-control',
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
       <?php  if(in_array(strtolower('expenses_add_expense'),$permissions)){?>
      <a href="#" class="btn btn-custom" title="Add Expense" data-toggle="modal" data-target="#add_leadger_form" ><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Add</a>
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
            <table id="expenses_listing" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th style="width:300px;">From Ledger</th>
                  <th style="width:200px;">To Ledger</th>
                  <th style="width:200px;">Amount</th>
                  <th style="width:200px;">Date</th>
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
        <h4 class="modal-title" id="myModalLabel">Add Expense</h4>
      </div>
      <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"expense_add_form",'name'=>'expense_add_form', 'data-parsley-validate'=>"")); ?>
      <div class="modal-body">
      <div class="form-group col-md-6">
      <label class="control-label" for="branches">Branch:</label>
      <?php  echo form_dropdown($branches,$branches_options,$branches['value']); ?>
      </div>
      <div class="form-group col-md-6">
      <label class="control-label" for="expense_date">Date:</label>
      <?php echo form_input($expense_date); ?>
      </div>
      <div class="form-group col-md-6">
      <label class="control-label" for="ledgers">To Leadger:</label>
      <?php  echo form_dropdown($ledgers,$ledgers_options,$ledgers['value']); ?>
      <input type="hidden" name="to_account_name" id="to_account_name" value="">
      </div>
      <div class="form-group col-md-6">
      <label class="control-label" for="account_groups">From Leadger:</label>
      <input type="hidden" name="from_account_name" id="from_account_name" value="">
      <?php  echo form_dropdown($account_groups,$account_groups_options,$account_groups['value']); ?>
      </div>
      <div class="form-group col-md-6">
        <label class="control-label" for="payment_option">Payment Mode:</label>
        <?php  echo form_dropdown($payment_option,$payment_type_options,$payment_option['value']); ?>
      </div>
      <div class="form-group col-md-6">
        <label class="control-label" for="amount">Amount:</label>
        <?php echo form_input($amount); ?>
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
<div class="modal fade" role="dialoge" tabindex="-1" id="edit_expense_model" aria-labelledby ="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 50%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Expense</h4>
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
var expense_datatable= "";
$('#expense_add_form').parsley();
$(document).ready(function(){

  

$('#ledger').on('change',function(){
  $('#to_account_name').val($('#ledger :selected').text());
})
$('#account_group').on('change',function(){
  $('#from_account_name').val($('#account_group :selected').text());
})
 $("#expense_date").datepicker({
      dateFormat: 'mm/dd/yy',
      maxDate: new Date,
      changeMonth: true,changeYear: true,yearRange: "-100:+0",
 });
  expense_datatable = $('table#expenses_listing ').DataTable({
    "bServerSide": true,
    "sAjaxSource": "<?php echo site_url('expenses/expenses_listing'); ?>",
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

       links += '<a href="#" data-expense_id="'+aData[5]+'" title="View Details" class="btn btn-default btn-xs view_expense" style="margin-right:5px;" ><span class="glyphicon glyphicon-search"></span></a>';
        <?php  if(in_array(strtolower('expenses_edit_expenses'),$permissions)){?> 
      links += '<a href="#" data-expense_id="'+aData[5]+'" title="Edit Details" class="btn btn-xs btn-custom edit_expense" style="margin-right:5px;" ><span class="glyphicon glyphicon-pencil"></span></a>';
        <?php  }if(in_array(strtolower('expenses_delete_expense'),$permissions)){?>
      links +='<a href="#" data-expense_id="'+aData[5]+'" title="Delete" class="btn btn-danger btn-xs delete_expense"  style="margin-right:5px;"><span class="glyphicon glyphicon-trash"></span></a>';
      <?php }?>
       $('td:eq(3)', nRow).html(dateSplit(aData[3]));
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
  $('#expense_add_form').parsley();
  $("#expense_add_form").on('submit',function(){
    var _this=$(this);
    var values = $('#expense_add_form').serialize();
    $.ajax({
      url:'<?php echo site_url('expenses/add_expense'); ?>',
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
          $('#expense_add_form')[0].reset();
          $('#expense_add_form').parsley().reset();

          expense_datatable.fnDraw();

        }else{
          toastr.error(result.message);
        }
      }
    });
    return false;
  });

  //Edit product
  $(document).on('click','.edit_expense',function(e){
    e.preventDefault();
    id = $(this).attr('data-expense_id');
    $.ajax({
      url:'<?php echo site_url('expenses/edit_expenses') ?>/'+id,
      dataType: 'html',
      success:function(result)
      {
        $('#edit_content').html(result);
      }
    });
    $('#edit_expense_model').modal('show');
  });
    //View product
   $(document).on('click','.view_product',function(e){
    e.preventDefault();
    id = $(this).attr('data-expense_id');
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
  $(document).on('click','.delete_expense',function(e){
    e.preventDefault();
    var response = confirm('Are you sure want to delete this account expense?');
    if(response){
      id = $(this).attr('data-expense_id');
      $.ajax({
        url:'<?php echo site_url('expenses/delete_expense') ?>/'+id,
        dataType: 'json',
        success:function(result)
        {
          if(result.status==1)
          {
            toastr.success(result.message);
            expense_datatable.fnDraw();
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
