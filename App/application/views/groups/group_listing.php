<?php 
$name = array(
  'name'	=> 'name',
  'id'	=> 'name',
  'value' => set_value('name'),
  'class'=>'form-control',
  'placeholder'=>'Name',
  'data-parsley-required'=>'true'       
);

$definition = array(
  'name'	=> 'definition',
  'id'	=> 'definition',
  'value' => set_value('definition'),
  'class'=>'form-control',
  'placeholder'=>'Definition',       
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
     <?php echo @$title; ?>
     <small></small>
   </h1>

   <div class="pull-right" >
    <a href="#" class="btn btn-custom" title="Add Group" data-toggle="modal" data-target="#group_modal" ><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Add</a>
  </div>
  <div class="clearfix"></div>
</section>
<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div id="alert_area"></div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-danger">
        <div class="box-body">
          <table id="group_listing" class="table table-bordered table-striped">
            <thead>
              <tr>
               <th>Name</th>
               <th>Defination</th>
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

<!--Add groups Modal -->
<div class="modal fade bs-example-modal-lg " id="group_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 40%;" >
    <div class="modal-content">
       <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"add_group_form",'name'=>'add_group_form', 'data-parsley-validate'=>"")); ?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Add New Group</h4>
        </div>

        <div class="modal-body">
         <div class="form-group">
          <label class="control-label" for="name">Name*</label>
          <?php echo form_input($name); ?> 
        </div>
        <div class="form-group">
          <label class="control-label" for="definition">Definition</label>
          <?php echo form_input($definition); ?> 
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="modal-footer">
       <div class="clearfix"></div>
       <button type="submit" class="btn btn-custom pull-right save"><i class="fa fa-spinner fa-spin formloader"></i> Submit</button>
       <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
       <div class="clearfix"></div>
       <div id="alert-area" class="text-left" style="margin-top:5px;"></div>
     </div>
   <?php echo form_close(); ?>
 </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Edit group Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog"  style="width: 40%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Group</h4>
      </div>

      <div id="edit_group_response">
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script>
  $(document).ready(function(){

    $('#add_group_form').parsley();
    //group listing
    ajax_datatable = $('table#group_listing ').DataTable({
      "bServerSide": true,
      "sAjaxSource": "<?php echo site_url('groups/group_listing'); ?>",
      "sPaginationType": "full_numbers",
      "fnServerData": function (sSource, aoData, fnCallback)
      {
         // ajax post csrf send. 
         var csrf = {"name": "<?php echo $csrf['name'];?>", "value":"<?php echo $csrf['hash'];?>"};
         aoData.push(csrf);
        $('#loader3').show();
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
        var links="";
              links += '<a href="#" data-group_id="'+aData[2]+'" title="Edit Details" class="btn btn-custom btn-xs edit_group" style="margin-right:5px;" ><span class="glyphicon glyphicon-pencil"></span></a>';  
                links +='<a href="#" data-group_id="'+aData[2]+'" title="Delete" class="btn btn-danger btn-xs delete_group"  style="margin-right:5px;"><span class="glyphicon glyphicon-trash"></span></a>';
                $('td:eq(2)', nRow).html( links);

                return nRow;
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
 // addgroup
    $("#add_group_form").on('submit',function(){
       var _this=$(this);
      var values = $('#add_group_form').serialize();
      $.ajax({
        url:'<?php echo site_url('groups/addGroup');?>',
        dataType:'json',
        data:values,
        type:'POST',
     // shows the loader element before sending.
        beforeSend: function (){before(_this)},
         // hides the loader after completion of request, whether successfull or failor.
        complete: function (){complete(_this)},
        success:function(result){
          if(result.status==1)
          {  
            toastr.success(result.message);
            $('#add_group_form')[0].reset();
            $('#add_group_form').parsley().reset();
            ajax_datatable.fnDraw();
          }
          else
          {
            toastr.error(result.message);
          }
        }
      });
      return false;   
    });

 //Edit group
 $(document).on('click','.edit_group',function(e){
  e.preventDefault();
  $('#edit_group_response').empty();
  id = $(this).attr('data-group_id');
  $.ajax({
   url:'<?php echo site_url('groups/editGroup') ?>/'+id,
   dataType: 'html',
   success:function(result)
   {
    $('#edit_group_response').html(result);
  } 
});
  $('#editModal').modal('show');
});
 
   //delete group
   $(document).on('click','.delete_group',function(e){
    e.preventDefault();
    var response = confirm('Are you sure want to delete this group ?');
    if(response){
      id = $(this).attr('data-group_id');
      $.ajax({
       url:'<?php echo site_url('groups/deleteGroup/') ?>/'+id,
       dataType: 'json',
       success:function(result)
       {
        if(result.status==1)
        {  
         toastr.success(result.message);
          ajax_datatable.fnDraw();
        }
        else
        {
          toastr.error(result.message);

        }
      } 
    });
    }
  });

 });
</script>

