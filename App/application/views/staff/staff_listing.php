<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-multiselect.css'); ?>" />

<style>

#upper_content { 
    position: relative;
   
    margin: 10px;
    
}

select.multiselect,
select.multiselect + div.btn-group,
select.multiselect + div.btn-group button.multiselect,
select.multiselect + div.btn-group.open .multiselect-container{
    width:100% !important;
}

button.multiselect{
    overflow: hidden;
    text-overflow: ellipsis; 
    white-space: nowrap;
    width:100% !important
    
}

.hide-native-select .btn-group{
    width:100% !important
}
</style>
<?php
$first_name = array(
  'name'  => 'first_name',
  'id'  => 'first_name',
  'value' => set_value('first_name'),
  'class'=>'form-control',
  'placeholder'=>'First Name',
  'data-parsley-required'=>'true'       
);

$last_name = array(
  'name'  => 'last_name',
  'id'  => 'last_name',
  'value' => set_value('last_name'),
  'class'=>'form-control',
  'placeholder'=>'Last Name',
  'data-parsley-required'=>'true'       
);
$username = array(
  'name'  => 'username',
  'id'  => 'username',
  'value' => set_value('username'),
    'class' => 'form-control',
    'placeholder' => 'Username',
    'data-parsley-required'=>'true'
);
$email = array(
  'name'  => 'email',
  'id'  => 'email',
  'value' => set_value('email'),
    'class' => 'form-control',
    'placeholder' => 'Email',
    'data-parsley-required'=>'true',
    'data-parsley-type' => 'email'
);
$password = array(
  'name'  => 'password',
  'id'  => 'password',
    'class' => 'form-control',
    'placeholder' => 'Password',
    'data-parsley-required'=>'true'
);
$confirm_password = array(
  'name'  => 'confirm_password',
  'id'  => 'confirm_password',
    'class' => 'form-control',
    'placeholder' => 'Confirm Password',
    'data-parsley-required'=>'true',
    'data-parsley-equalto' => "#password"
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
          <?php if(in_array(strtolower('staff_add_staff'),$permissions)){?>
          <div class="pull-right" >
            <a href="#" class="btn btn-custom" title="Add Staff" data-toggle="modal" data-target="#add_staff" ><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Add</a>
         </div>
        <?php } ?>  

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
                  <table id="staff_listing" class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                                                  
                                   <th>Name</th>
                                   <th>Username</th>
                                   <th>Email</th>    
                                   <th>Groups</th>                               
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

<!--Add Staff Modal -->
<div class="modal fade " id="add_staff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add Staff</h4>
            </div>
                   <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"staff_add_form",'name'=>'staff_add_form', 'data-parsley-validate'=>"")); ?>
            <div class="modal-body">
                    <div class="form-group col-md-12">
                        <label class="control-label" for="user_groups">User Role(s)/Group(s)</label>
                        <select name="user_groups[]"  class="form-control" multiple="multiple" id="user_groups" data-parsley-trigger="change" required="">
                            <?php if(count($details)){
                                
                                    foreach($details as $detail){ ?>
                             <option value="<?php echo $detail['id']; ?>"><?php echo $detail['name']; ?></option>
                              <?php }}
                             else{ ?>
                             <option value="">No Group Found</option>
                             <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label" for="name">First Name:</label>
                        <?php echo form_input($first_name); ?> 
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label" for="email">Last Name:</label>
                        <?php echo form_input($last_name); ?> 
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label" for="name">User Name:</label>
                        <?php echo form_input($username); ?> 
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label" for="email">Email:</label>
                        <?php echo form_input($email); ?> 
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label" for="password">Password:</label>
                        <?php echo form_password($password); ?> 
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label" for="confirm_password">Confirm Password:</label>
                        <?php echo form_password($confirm_password); ?>   
                    </div>
                    <div class="clearfix"></div>   
                    <div class="form-group col-md-12 ">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="send_mail" value="1"> Send email with account information
                            </label>
                        </div>
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

<!--View Staff -->
<div class="modal fade" id="view_staff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 40%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Details</h4>
      </div>
      <div class="modal-body">
       <div id="response_view">
        
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Back</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit Staff -->
    <div class="modal fade" role="dialoge" tabindex="-1" id="edit_user" aria-labelledby ="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Edit Staff</h4>
                </div>
                <div id="edit_content"></div>
            </div><!-- modal content-->
        </div><!-- modal dialog-->
    </div><!-- /modal-->
    <!-- Main content -->

<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-multiselect.js'); ?>"></script>  
<script>
var staff_datatable= "";
$('#staff_add_form').parsley();
$(document).ready(function(){
             staff_datatable = $('table#staff_listing ').DataTable({
                "bServerSide": true,
                "sAjaxSource": "<?php echo site_url('Staff/staff_listing'); ?>",
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
              $('#loader1').fadeOut();
             },
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
            var currentDate="";
            var links="";
            <?php  if(in_array(strtolower('staff_edit_staff'),$permissions)) { ?>
            links += '<a href="#" data-staff_id="'+aData[4]+'" title="Edit Details" class="btn  btn-custom btn-xs edit_staff" style="margin-right:5px;" ><span class="glyphicon glyphicon-pencil"></span></a>';  
            <?php } if(in_array(strtolower('staff_delete_staff'),$permissions)) { ?>
            links +='<a href="#" data-staff_id="'+aData[4]+'" title="Delete" class="btn btn-danger btn-xs delete_staff"  style="margin-right:5px;"><span class="glyphicon glyphicon-trash"></span></a>';
            <?php } ?>
            $('td:eq(4)', nRow).html( links);
		},
        aoColumnDefs: [
          {
             bSortable: false,
             aTargets: [3,4]
          },
          {
             bSearchable: false,
             aTargets: [3,4]
          }
        ]
        });
        
    //multiselect 
    $('#user_groups').multiselect({
        enableFiltering: true,
        maxHeight: 300,
        includeSelectAllOption: true,
    });
    
    //Add staff
  $('#staff_add_form').parsley();
  $("#staff_add_form").on('submit',function(){
    var _this=$(this);
    var values = $('#staff_add_form').serialize();
    $.ajax({
    url:'<?php echo site_url('Staff/add_staff'); ?>',
    dataType:'json',
    type:'POST',
    data:values,
  // shows the loader element before sending.
   beforeSend: function (){before(_this)},
   // hides the loader after completion of request, whether successfull or failor.
   complete: function (){complete(_this)},
    success:function(result){
       
     if(result.status==1)
     {
        
       toastr.success(result.message);
        $('#staff_add_form')[0].reset();
        $('#staff_add_form').parsley().reset();
        
        $('#user_groups').multiselect('deselectAll', false);
        $('#user_groups').multiselect('updateButtonText');
        
        staff_datatable.fnDraw();
        
     }
     else
     { 
        toastr.error(result.message);
     } 
     
      
    }
   });
   
 return false;

 });
 
 //View Staff
     $(document).on('click','.view_staff',function(e){
        e.preventDefault();
        id = $(this).attr('data-staff_id');
        $.ajax({
           url:'<?php echo site_url('Staff/view_staff') ?>/'+id,
           dataType: 'html',
           success:function(result)
           {
            $('#response_view').html(result);
           } 
        });
        $('#view_staff').modal('show');
     });
     
 //Edit Staff
 $(document).on('click','.edit_staff',function(e){
    e.preventDefault();
    id = $(this).attr('data-staff_id');
    $.ajax({
       url:'<?php echo site_url('Staff/edit_staff') ?>/'+id,
       dataType: 'html',
       success:function(result)
       {
        $('#edit_content').html(result);
       } 
    });
    $('#edit_user').modal('show');
 });
 
 //Delete company
 $(document).on('click','.delete_staff',function(e){
    e.preventDefault();
    var response = confirm('Are you sure want to delete this staff?');
    if(response){
    id = $(this).attr('data-staff_id');
    $.ajax({
       url:'<?php echo site_url('Staff/delete_staff') ?>/'+id,
       dataType: 'json',
       success:function(result)
       {
        if(result.status==1)
        {
            toastr.success(result.message);
            staff_datatable.fnDraw();
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