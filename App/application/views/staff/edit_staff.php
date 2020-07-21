<?php

$first_name = array(
  'name'  => 'first_name',
  'id'  => 'first_name',
  'value' => set_value('first_name',@$details[0]['first_name']),
  'class'=>'form-control',
  'placeholder'=>'First Name',
  'data-parsley-required'=>'true'       
);

$last_name = array(
  'name'  => 'last_name',
  'id'  => 'last_name',
  'value' => set_value('last_name',@$details[0]['last_name']),
  'class'=>'form-control',
  'placeholder'=>'Last Name',
  'data-parsley-required'=>'true'       
);
$username = array(
  'name'  => 'username',
  'id'  => 'username',
  'value' => set_value('username',@$details[0]['username']),
    'class' => 'form-control',
    'placeholder' => 'Username',
    'data-parsley-required'=>'true'
);
$email = array(
  'name'  => 'email',
  'id'  => 'email',
  'value' => set_value('email',@$details[0]['email']),
    'class' => 'form-control',
    'placeholder' => 'Email',
    'data-parsley-required'=>'true',
    'data-parsley-type' => 'email'
);
$password = array(
  'name'  => 'password',
  'id'  => 'e_password',
  'value' => set_value('password'),
  'class' => 'form-control',
  'placeholder' => 'Password',
  'data-parsley-required'=>'true'
);
$confirm_password = array(
  'name'  => 'confirm_password',
  'id'  => 'e_confirm_password',
  'value' => set_value('confirm_password'),
  'class' => 'form-control',
  'placeholder' => 'Confirm Password',
  'data-parsley-required'=>'true',
  'data-parsley-equalto' => "#e_password"
);

$user_groups = array();
if($userGroups!== false){
    foreach($userGroups as $uGroup){
        array_push($user_groups, $uGroup['group_id']);
    }
}

?>
 <div class="modal-body">
            <?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"staff_edit_form",'name'=>'staff_edit_form', 'data-parsley-validate'=>"",'data-staff_id'=>$details[0]['id'])); ?>
			 <div class="form-group col-md-12">
            <label class="control-label">User Role(s)/Group(s)</label>
             <select name="user_groups[]" class="form-control" required="" data-parsley-trigger="change" multiple="multiple" id="e_user_groups" >
                 <?php if(count($groups)){
                        foreach($groups as $group){
                         $add_on= ''; 
                        if(in_array($group['id'],$user_groups)){ 
                         $add_on = 'selected';
                        } ?>
                 <option value="<?php echo $group['id']; ?>" <?php echo $add_on; ?> ><?php echo $group['name']; ?></option>
                  <?php } }
                 else
                 {?>
                 <option value="">No Group Found</option>
                <?php  } ?>
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
				<label class="control-label">Username</label>
                <?php echo form_input($username); ?>
            </div>
            <div class="form-group col-md-6">
				<label class="control-label">Email</label>
                <?php echo form_input($email); ?>
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-md-12">
             <div class="checkbox">
                <label>
                  <input type="checkbox" name="send_mail" id="c_send_mail" value="1"> Send notification email with updated information
                </label>
              </div>
            </div> 

      <div class="modal-footer">
      <div class="clearfix"></div>
         
         <div class="clearfix"></div>
         <button type="submit" class="btn btn-custom pull-right save" style="margin-left: 5px;"><i class="fa fa-spinner fa-spin formloader"></i> Save Changes</button>
         <div class="clearfix"></div>
         <div id="edit_res" class="text-left" style="margin-top: 5px;"></div>
      </div>
      <?php echo form_close(); ?>
      
      <!--password change form-->
        <?php echo form_open($this->uri->uri_string(),array('role'=>"form",'id'=>"password_edit_form",'name'=>'password_edit_form', 'data-parsley-validate'=>"",'data-staff_id'=>$details[0]['id'])); ?>
            <div class="form-group col-md-6">
				<label class="control-label">Password</label>
                <?php echo form_password($password); ?>
                </div>
            <div class="form-group col-md-6">
				<label class="control-label">Confirm Password</label>
                <?php echo form_password($confirm_password); ?>
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-md-12">
             <div class="checkbox">
                <label>
                  <input type="checkbox" name="send_mail" value="1"> Send notification email with updated information
                </label>
              </div>
            </div> 

      <div class="modal-footer">
      
         <div class="clearfix"></div>
         <button type="submit" class="btn btn-custom pull-right save" style="margin-left: 5px;"><i class="fa fa-spinner fa-spin formloader"></i> Change Password</button>
         <div class="clearfix"></div>
         <div id="edit_res_password" style="margin-top: 5px;" class="text-left"></div>
      </div>
       <?php echo form_close(); ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
      </div>
      
      <script>
$(document).ready(function(e){
    // email username change
    //attach parsley validation
    $('#staff_edit_form').parsley();
    $('#staff_edit_form').submit(function(e){
       var _this=$(this);
        e.preventDefault();
        id = $(this).attr('data-staff_id');
        var values = $("#staff_edit_form").serialize();
        $.ajax({
             url:'<?php echo site_url('Staff/update_staff') ?>/'+id,
            type:'post',
            dataType: 'json',
            data:values,
            // shows the loader element before sending.
            beforeSend: function (){before(_this)},
             // hides the loader after completion of request, whether successfull or failor.
            complete: function (){complete(_this)},
            success:function(result){
                if(result.status==1)
                {   
                   toastr.success(result.message);
                    staff_datatable.fnDraw();  
                    $('#staff_edit_form').parsley().reset();  
                    $("#c_send_mail"). prop("checked", false);
                }
                else
                {
                   toastr.error(result.message);
                }
            }
        });
    });
    
    //password change
    //attach parsley validation
    $('#password_edit_form').parsley();
    $('#password_edit_form').submit(function(e){
       var _this=$(this);
        e.preventDefault();
        id = $(this).attr('data-staff_id');
        var values = $("#password_edit_form").serialize();
        $.ajax({
             url:'<?php echo site_url('staff/update_password') ?>/'+id,
            type:'post',
            dataType: 'json',
            data:values,
            // shows the loader element before sending.
            beforeSend: function (){before(_this)},
             // hides the loader after completion of request, whether successfull or failor.
            complete: function (){complete(_this)},
            success:function(result){ 
                if(result.status==1)
                {   
                   toastr.success(result.message);
                    $('#password_edit_form')[0].reset();
                    $('#password_edit_form').parsley().reset();
                    staff_datatable.fnDraw();  
                }
                else
                {
                   toastr.error(result.message);
                }
            }
        });
    });

   //multiselect 
    $('#e_user_groups').multiselect({
        enableFiltering: true,
        maxHeight: 300,
        includeSelectAllOption: true,
    });
    
});

</script>  
