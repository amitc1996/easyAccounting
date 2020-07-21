<?php
$branch_name = array(
  'name'  => 'branch_name',
  'id'  => 'branch_name',
  'value' => set_value('branch_name'),
  'class'=>'form-control',
  'placeholder'=>'Branch Name',
  'data-parsley-required'=>'true'
);
$branch_phone = array(
  'name'  => 'branch_phone',
  'id'  => 'branch_phone',
  'value' => set_value('branch_phone'),
  'class'=>'form-control',
  'placeholder'=>'Branch Phone',
  'data-parsley-required'=>'true'
);
$branch_email = array(
  'name'  => 'branch_email',
  'id'  => 'branch_email',
  'value' => set_value('branch_email'),
  'class'=>'form-control',
  'placeholder'=>'Email',
  'data-parsley-required'=>'true',
  'data-parsley-type'=>'email'
);

$branch_address = array(
  'name'  => 'branch_address',
  'id'  => 'branch_address',
  'value' => set_value('branch_address'),
  'class'=>'form-control',
  'placeholder'=>'Address',
  'data-parsley-required'=>'true',
  'rows'=>4,
);
$branch_city = array(
  'name'  => 'branch_city',
  'id'  => 'branch_city',
  'value' => set_value('branch_city'),
  'class'=>'form-control',
  'placeholder'=>'Branch City',
  'data-parsley-required'=>'true'
);
$branch_state = array(
  'name'  => 'branch_state',
  'id'  => 'branch_state',
  'value' => set_value('branch_state'),
  'class'=>'form-control',
  'placeholder'=>'Branch State',
  'data-parsley-required'=>'true'
);
$branch_country = array(
  'name'  => 'branch_country',
  'id'  => 'branch_country',
  'value' => set_value('branch_country'),
  'class'=>'form-control',
  'placeholder'=>'Branch Country',
  'data-parsley-required'=>'true'
);
$branch_zip = array(
  'name'  => 'branch_zip',
  'id'  => 'branch_zip',
  'value' => set_value('branch_zip'),
  'class'=>'form-control',
  'placeholder'=>'Branch Zip/Post',
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
      <?php  if(in_array(strtolower('branches_add_branch'),$permissions)){?> 
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
            <table id="branches_listing" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th>Branch Name</th>
                  <th>Branch Email</th>
                  <th>Branch Phone</th>
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
        <h4 class="modal-title" id="myModalLabel">Add Branch</h4>
      </div>
      <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"branch_add_form",'name'=>'branch_add_form', 'data-parsley-validate'=>"")); ?>
      <div class="modal-body">
        <div class="form-group col-md-4">
          <label class="control-label" for="branch_name">Branch Name:</label>
          <?php echo form_input($branch_name); ?>
        </div>
        <div class="form-group col-md-4">
          <label class="control-label" for="branch_phone">Branch Phone:</label>
          <?php echo form_input($branch_phone); ?>
        </div>
          <div class="form-group col-md-4">
          <label class="control-label" for="branch_email">Branch Email:</label>
          <?php echo form_input($branch_email); ?>
        </div>
        <div class="form-group col-md-12">
          <label class="control-label" for="branch_address">Address:</label>
          <?php echo form_textarea($branch_address); ?>
        </div>
          <div class="form-group col-md-3">
          <label class="control-label" for="branch_city">City:</label>
          <?php echo form_input($branch_city); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="branch_state">State:</label>
          <?php echo form_input($branch_state); ?>
        </div>
         <div class="form-group col-md-3">
          <label class="control-label" for="branch_country">Country:</label>
          <?php echo form_input($branch_country); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="branch_zip">Zip/Post:</label>
          <?php echo form_input($branch_zip); ?>
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
<div class="modal fade" role="dialoge" tabindex="-1" id="edit_branch" aria-labelledby ="myModalLabel" aria-hidden="true">
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
var branches_listing= "";
$('#branch_add_form').parsley();
$(document).ready(function(){
  //discount datatable
  branches_listing = $('table#branches_listing ').DataTable({
    "bServerSide": true,
    "sAjaxSource": "<?php echo site_url('branches/branches_listing'); ?>",
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
       <?php  if(in_array(strtolower('branches_edit_branch'),$permissions)){?> 
      links += '<a href="#" data-branch_id="'+aData[4]+'" title="Edit Details" class="btn btn-custom btn-xs edit_branch" style="margin-right:5px;" ><span class="glyphicon glyphicon-pencil"></span></a>';
       <?php } if(in_array(strtolower('branches_delete_branch'),$permissions)){?> 
      links +='<a href="#" data-branch_id="'+aData[4]+'" title="Delete" class="btn btn-danger btn-xs delete_branch"  style="margin-right:5px;"><span class="glyphicon glyphicon-trash"></span></a>';
      <?php }?>
      $('td:eq(3)', nRow).html((aData[2]=='0000-00-00 00:00:00')?'-':dateSplit(aData[3]));
      $('td:eq(4)', nRow).html(links);
    },
    aoColumnDefs: [
      {
        bSortable: false,
        aTargets: [4]
      },
      {
        bSearchable: false,
        aTargets: [4]
      }
    ]
  });

  //Add branch
  $('#branch_add_form').parsley();
  $("#branch_add_form").on('submit',function(){
    var _this=$(this);
    var values = $('#branch_add_form').serialize();
    $.ajax({
      url:'<?php echo site_url('branches/add_branch'); ?>',
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
          $('#branch_add_form')[0].reset();
          $('#branch_add_form').parsley().reset();

          branches_listing.fnDraw();

        }else{
          toastr.error(result.message);
        }
      }
    });
    return false;
  });

  //Edit discount
  $(document).on('click','.edit_branch',function(e){
    e.preventDefault();
    id = $(this).attr('data-branch_id');
    $.ajax({
      url:'<?php echo site_url('branches/edit_branch') ?>/'+id,
      dataType: 'html',
      success:function(result)
      {
        $('#edit_content').html(result);
      }
    });
    $('#edit_branch').modal('show');
  });

  //Delete discount
  $(document).on('click','.delete_branch',function(e){
    e.preventDefault();
    var response = confirm('Are you sure want to delete this branch?');
    if(response){
      id = $(this).attr('data-branch_id');
      $.ajax({
        url:'<?php echo site_url('branches/delete_branch') ?>/'+id,
        dataType: 'json',
        success:function(result)
        {
          if(result.status==1)
          {
           toastr.success(result.message);
            branches_listing.fnDraw();
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
