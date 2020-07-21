<?php 
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
   
   <div class="clearfix"></div>
 </section>

 <!-- Main content -->
 <section class="content">
  <!-- Small boxes (Stat box) -->
  <div id="alert_area"></div>

  <div class="row">
    <div class="col-xs-12">
      
      <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#group_permission" role="tab" data-toggle="tab">Groups Permissions</a></li>
        <li><a href="#users_permission" class="tab_shown" role="tab" data-toggle="tab">Users Permissions</a></li>
      </ul>
      
      <div class="tab-content">  
       
        <div class="tab-pane fade in active" id="group_permission">
          <div class="box box-danger">
            <div class="box-body">
              <table id="permission_listing" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                   <td>Permissions/Groups</td>
                   <?php 
                   foreach($group_list as $value)
                   {
                    echo "<td>".$value['name'];
                    echo "</td>";
                  }
                  ?>
                </tr>
              </thead>
              <tbody>
               
                <?php if(in_array(strtolower('permissions_addPermission'),$permissions)){
                 foreach($perm_list as $permission)
                 {
                  echo "<tr>";
                  echo "<td>".$permission->name;
                  echo "</td>";
                  foreach($group_list as $value){
                    $group_perm = explode(',',$value['perm']);
                    if(in_array($permission->id,$group_perm))
                    {
                      echo '<td><input type="checkbox" class="assign_permission" data-permission_id = "'.$permission->id.'" data-group_id = "'.$value['id'].'" checked /></td>';
                    }else{
                      echo '<td><input type="checkbox" class="assign_permission" data-permission_id = "'.$permission->id.'" data-group_id = "'.$value['id'].'" /></td>';
                    }
                  }
                  echo "</tr>";
                }
                
              }
              
              else{
               foreach($perm_list as $permission)
               {
                echo "<tr>";
                echo "<td>".$permission->name;
                echo "</td>";
                foreach($group_list as $value){
                  $group_perm = explode(',',$value['perm']);
                  if(in_array($permission->id,$group_perm))
                  {
                    echo '<td><span><i class="fa fa-check success" aria-hidden="true"></i></span></td>';
                  }else{
                    echo '<td><span><i class="fa fa-times danger" aria-hidden="true"></i></span></td>';
                  }
                }
                echo "</tr>";
              }
            }
            ?>
          </tbody>
        </table>
      </div><!-- /.box-body -->
    </div>
  </div><!-- group_permission tab -->
  
  <div class="tab-pane fade" id="users_permission">
    <div class="box box-danger">
      <div class="box-body">
        <table id="user_permission_listing" class="table table-bordered table-striped">
          <thead>
            <tr>
              <td>User Email</td>
              <td>Name</td>
              <td class="actions">Actions</td>
            </tr>
          </thead>
        </table>
      </div><!-- /.box-body -->
    </div>
  </div><!-- users_permission tab -->
  
</div><!-- tab-content -->

</div>
</div>
</section><!-- /.content -->
</div>
<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script>
  $(document).ready(function(){
    
    //groups permission
    $('.assign_permission').change(function(e){
      var action = '';
      if($(this).is(':checked'))
      {
        action = 'insert';
        
      }else{
        action = 'delete';
      }
      var permission_id = $(this).attr('data-permission_id');
      var group_id = $(this).attr('data-group_id');
      assign_permission_to_group(action,permission_id,group_id);
    });
    
    function assign_permission_to_group(action,permission_id,group_id)
    {
      var p_id = permission_id;
      var g_id = group_id;
      
      if(action == 'insert')
      {
        url_link = '<?php echo site_url('permissions/addPermission');?>/'+g_id+'/'+p_id;
      }else{
        url_link = '<?php echo site_url('permissions/deletePermission');?>/'+g_id+'/'+p_id;
      }
      
      $.ajax({
        url:url_link,
        data:{"<?php echo $csrf['name'];?>":"<?php echo $csrf['hash'];?>"},
        dataType:'json',
        type:'POST',
        success:function(result){
          if(result.status==1)
          {  
            console.log('success');
          }
          else
          {
            console.log('error');
          }
          
        }
      });
      return false;   
    }
    
    
      //users permission
      
      ajax_datatable = $('table#user_permission_listing ').DataTable({
        "bServerSide": true,
        "sAjaxSource": "<?php echo site_url('permissions/user_permission_listing'); ?>",
        "sPaginationType": "full_numbers",
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
          
          links += '<a href="<?php echo site_url('permissions/users_permission'); ?>/'+aData[2]+'" class="btn btn-primary btn-custom btn-xs" >Permission</a>';
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
      
    });

  </script>

