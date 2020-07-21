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
        <div class="pull-right" >
          <a href="<?php echo site_url('permission'); ?>" class="btn btn-default" ><span class="glyphicon glyphicon-arrow-left " style="margin-right: 5px;"></span> Back</a>
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
                  <table id="user_permission_listing" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                   <td>Actions/User</td>
                                   <td><?php echo $user_details['0']['username']; ?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(in_array(strtolower('permissions_addUserPermission'),$permissions)){//can edit
                                foreach($perm_list as $permission)
                                {
                                echo "<tr>";
                                echo "<td>".$permission->name;
                                echo "</td>";
                                foreach($user_details as $value){
                                $user_perm = explode(',',$value['perm']);
                                if(in_array($permission->id,$user_perm))
                                {
                                echo '<td><input type="checkbox" class="assign_permission" data-permission_name = "'.$permission->id.'" data-user_id = "'.$value['id'].'" checked /></td>';
                                }else{
                                echo '<td><input type="checkbox" class="assign_permission" data-permission_name = "'.$permission->id.'" data-user_id = "'.$value['id'].'" /></td>';
                                }
                                }
                                echo "</tr>";
                                }
                            }
                            else{//only can view user permissions
                               foreach($perm_list as $permission)
                                {
                                echo "<tr>";
                                echo "<td>".$permission->name;
                                echo "</td>";
                                foreach($user_details as $value){
                                $user_perm = explode(',',$value['perm']);
                                if(in_array($permission->id,$user_perm))
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
            
        
            </div>
        </div>
        </section><!-- /.content -->
</div>
<script>
    $(document).ready(function(){
        
    $('.assign_permission').change(function(e){
        var action = '';
        if($(this).is(':checked'))
        {
            action = 'insert';
            
        }else{
            action = 'delete';
        }
        var permission_name = $(this).attr('data-permission_name');
        var user_id = $(this).attr('data-user_id');
        assign_permission_to_user(action,permission_name,user_id);
      });
      
      function assign_permission_to_user(action,permission_name,user_id)
      {
        var p_name = permission_name;
        var u_id = user_id;
        if(action == 'insert')
        {
            url_link = '<?php echo site_url('permissions/addUserPermission');?>/'+u_id+'/'+p_name;
        }else{
            url_link = '<?php echo site_url('permissions/deleteUserPermission');?>/'+u_id+'/'+p_name;
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
        
    });

</script>