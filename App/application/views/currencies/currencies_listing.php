<?php
$currency_code = array(
  'name'  => 'currency_code',
  'id'  => 'currency_code',
  'value' => set_value('currency_code'),
  'class'=>'form-control',
  'placeholder'=>'Currency Code',
  'data-parsley-required'=>'true'
);
$currency_symbol = array(
  'name'  => 'currency_symbol',
  'id'  => 'currency_symbol',
  'value' => set_value('currency_symbol'),
  'class'=>'form-control',
  'placeholder'=>'Currency Symbol',
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
      <?php  if(in_array(strtolower('currencies_add_currency'),$permissions)){?> 
      <a href="#" class="btn btn-custom" title="Add discount" data-toggle="modal" data-target="#add_currency" ><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Add</a>
      <?php  } ?>
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
            <table id="currencies_listing" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th>Currency Code</th>
                  <th>Currency Symbol</th>
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

<!--Add discount Modal -->
<div class="modal fade " id="add_currency" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Currency</h4>
      </div>
      <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"currency_add_form",'name'=>'currency_add_form', 'data-parsley-validate'=>"")); ?>
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

<!-- Edit discount -->
<div class="modal fade" role="dialoge" tabindex="-1" id="edit_currency" aria-labelledby ="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit discount</h4>
      </div>
      <div id="edit_content"></div>
    </div><!-- modal content-->
  </div><!-- modal dialog-->
</div><!-- /modal-->
<!-- Main content -->

<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script>
var currency_datatable= "";
$('#currency_add_form').parsley();
$(document).ready(function(){
  //discount datatable
  currency_datatable = $('table#currencies_listing ').DataTable({
    "bServerSide": true,
    "sAjaxSource": "<?php echo site_url('currencies/currencies_listing'); ?>",
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
       <?php  if(in_array(strtolower('currencies_edit_currency'),$permissions)){?> 
      links += '<a href="#" data-currency_id="'+aData[3]+'" title="Edit Details" class="btn btn-custom btn-xs edit_currency" style="margin-right:5px;" ><span class="glyphicon glyphicon-pencil"></span></a>';
       <?php } if(in_array(strtolower('currencies_delete_currency'),$permissions)){?> 
      links +='<a href="#" data-currency_id="'+aData[3]+'" title="Delete" class="btn btn-danger btn-xs delete_currency"  style="margin-right:5px;"><span class="glyphicon glyphicon-trash"></span></a>';
      <?php }?>
      $('td:eq(2)', nRow).html((aData[2]=='0000-00-00 00:00:00')?'-':dateSplit(aData[2]));
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

  //Add currency
  $('#currency_add_form').parsley();
  $("#currency_add_form").on('submit',function(){
    var _this=$(this);
    var values = $('#currency_add_form').serialize();
    $.ajax({
      url:'<?php echo site_url('currencies/add_currency'); ?>',
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
          $('#currency_add_form')[0].reset();
          $('#currency_add_form').parsley().reset();

          currency_datatable.fnDraw();

        }else{
          toastr.error(result.message);
        }
      }
    });
    return false;
  });

  //Edit discount
  $(document).on('click','.edit_currency',function(e){
    e.preventDefault();
    id = $(this).attr('data-currency_id');
    $.ajax({
      url:'<?php echo site_url('currencies/edit_currency') ?>/'+id,
      dataType: 'html',
      success:function(result)
      {
        $('#edit_content').html(result);
      }
    });
    $('#edit_currency').modal('show');
  });

  //Delete discount
  $(document).on('click','.delete_currency',function(e){
    e.preventDefault();
    var response = confirm('Are you sure want to delete this currency?');
    if(response){
      id = $(this).attr('data-currency_id');
      $.ajax({
        url:'<?php echo site_url('currencies/delete_currency') ?>/'+id,
        dataType: 'json',
        success:function(result)
        {
          if(result.status==1)
          {
           toastr.success(result.message);
            currency_datatable.fnDraw();
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
