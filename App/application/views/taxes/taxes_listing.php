<?php
$tax_name = array(
  'name'  => 'tax_name',
  'id'  => 'tax_name',
  'value' => set_value('tax_name'),
  'class'=>'form-control',
  'placeholder'=>'Tax Name',
  'data-parsley-required'=>'true'
);
$tax_percentage = array(
  'name'  => 'tax_percentage',
  'id'  => 'tax_percentage',
  'value' => set_value('tax_percentage'),
  'class'=>'form-control',
  'placeholder'=>'Tax %',
  'data-parsley-required'=>'true'
);
$tax_name_g = array(
  'name'  => 'taxes[0][tax_name]',
  'id'  => 'tax_name',
  'value' => set_value('tax_name'),
  'class'=>'form-control',
  'placeholder'=>'Tax Name',
  'data-parsley-required'=>'true'
);
$tax_percentage_g = array(
  'name'  => 'taxes[0][tax_percentage]',
  'id'  => 'tax_percentage',
  'value' => set_value('tax_percentage'),
  'class'=>'form-control',
  'placeholder'=>'Tax %',
  'data-parsley-required'=>'true'
);
//tax group
$group_name = array(
  'name'  => 'group_name',
  'id'  => 'group_name',
  'value' => set_value('group_name'),
  'class'=>'form-control',
  'placeholder'=>'Ggroup Name',
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
       <?php  if(in_array(strtolower('taxes_add_tax'),$permissions)){?>
      <a href="#" class="btn btn-custom" title="Add tax" data-toggle="modal" data-target="#add_tax" ><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Add</a>
       <a href="#" class="btn btn-custom" title="Add tax group" data-toggle="modal" data-target="#add_tax_group" ><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Add group</a>
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
            <table id="taxes_listing" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th>Tax name</th>
                  <th>Tax %</th>
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

<!--Add tax Modal -->
<div class="modal fade " id="add_tax" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add tax</h4>
      </div>
      <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"tax_add_form",'name'=>'tax_add_form', 'data-parsley-validate'=>"")); ?>
      <div class="modal-body">
        <div class="form-group col-md-12">
          <label class="control-label" for="tax_name">Tax Name:</label>
          <?php echo form_input($tax_name); ?>
        </div>
        <div class="form-group col-md-12">
          <label class="control-label" for="tax_percentage">Tax %:</label>
          <?php echo form_input($tax_percentage); ?>
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

<!--Add tax Modal -->
<div class="modal fade " id="add_tax_group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add tax groups</h4>
      </div>
      <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"tax_group_add_form",'name'=>'tax_group_add_form', 'data-parsley-validate'=>"")); ?>
      <div class="modal-body">
        <div class="row">
        <div class="form-group col-md-11">
          <label class="control-label" for="name">Group Name:</label>
          <?php echo form_input($group_name); ?>
        </div>
         <div class="form-group col-md-1">
         </div>
        <div class="form-group col-md-6">
          <?php echo form_input($tax_name_g); ?>
        </div>
         <div class="form-group col-md-5">
          <?php echo form_input($tax_percentage_g); ?>
        </div>
         <div class="form-group col-md-1">
         </div>
       </div>
           <div id="dynamic_tax_add_row"></div>
         <div class="form-group col-md-11">
          <a href="#" class="btn btn-info pull-right" id="add_row" title="Add row"><i class="fa fa-plus"></i></a>
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

<!-- Edit tax -->
<div class="modal fade" role="dialoge" tabindex="-1" id="edit_user" aria-labelledby ="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit tax</h4>
      </div>
      <div id="edit_content"></div>
    </div><!-- modal content-->
  </div><!-- modal dialog-->
</div><!-- /modal-->
<!-- Main content -->

<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script>
var tax_datatable= "";
var rowCount=1;
$('#tax_add_form').parsley();
$(document).ready(function(){
  $('#add_row').on('click',function(e){
   e.preventDefault();
   var taxrow=`
        <div class="row ${rowCount}">
         <div class="form-group col-md-6">
          <input type="text" class="form-control" placeholder="Tax Name" name="taxes[${rowCount}][tax_name]" value="">
        </div>
         <div class="form-group col-md-5">
         <input type="text" class="form-control" placeholder="Tax %" name="taxes[${rowCount}][tax_percentage]" value="">
        </div>
         <div class="form-group col-md-1">
            <a href="#" data-remove_row="${rowCount}" class="btn btn-danger pull-right remove_row" title="Remove row"><i class="fa fa-minus"></i></a>
         </div>
               `;
        rowCount++;
        $('#dynamic_tax_add_row').append(taxrow);
  });
  tax_datatable = $('table#taxes_listing ').DataTable({
    "bServerSide": true,
    "sAjaxSource": "<?php echo site_url('taxes/taxes_listing'); ?>",
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
       <?php  if(in_array(strtolower('taxes_edit_tax'),$permissions)){?> 
      links += '<a href="#" data-tax_id="'+aData[3]+'" title="Edit Details" class="btn btn-custom btn-xs edit_tax" style="margin-right:5px;" ><span class="glyphicon glyphicon-pencil"></span></a>';
        <?php } if(in_array(strtolower('taxes_delete_brand'),$permissions)){?>
      links +='<a href="#" data-tax_id="'+aData[3]+'" title="Delete" class="btn btn-danger btn-xs delete_tax"  style="margin-right:5px;"><span class="glyphicon glyphicon-trash"></span></a>';
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

  //Add tax
  $('#tax_add_form').parsley();
  $("#tax_add_form").on('submit',function(){
    var _this=$(this);
    var values = $('#tax_add_form').serialize();
    $.ajax({
      url:'<?php echo site_url('taxes/add_tax'); ?>',
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
          $('#tax_add_form')[0].reset();
          $('#tax_add_form').parsley().reset();

          tax_datatable.fnDraw();

        }else{
          toastr.error(result.message);
        }
      }
    });
    return false;
  });

    //Add tax
  $('#tax_group_add_form').parsley();
  $("#tax_group_add_form").on('submit',function(){
    var _this=$(this);
    var values = $('#tax_group_add_form').serialize();
    $.ajax({
      url:'<?php echo site_url('taxes/add_tax_group'); ?>',
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
          $('#tax_group_add_form')[0].reset();
          $('#tax_group_add_form').parsley().reset();

          tax_datatable.fnDraw();

        }else{
          toastr.error(result.message);
        }
      }
    });
    return false;
  });

  //Edit tax
  $(document).on('click','.edit_tax',function(e){
    e.preventDefault();
    id = $(this).attr('data-tax_id');
    $.ajax({
      url:'<?php echo site_url('taxes/edit_tax') ?>/'+id,
      dataType: 'html',
      success:function(result)
      {
        $('#edit_content').html(result);
      }
    });
    $('#edit_user').modal('show');
  });

  //Delete company
  $(document).on('click','.delete_tax',function(e){
    e.preventDefault();
    var response = confirm('Are you sure want to delete this tax?');
    if(response){
      id = $(this).attr('data-tax_id');
      $.ajax({
        url:'<?php echo site_url('taxes/delete_tax') ?>/'+id,
        dataType: 'json',
        success:function(result)
        {
          if(result.status==1)
          {
           toastr.success(result.message);
            tax_datatable.fnDraw();
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
     $(document).on('click','.remove_row',function(e){
        e.preventDefault();
        target = $(this).attr('data-remove_row');
        $('.'+target).remove();
      });
});


</script>
