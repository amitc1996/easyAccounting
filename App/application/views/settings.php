
<?php
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value' => @$profile_info->email,
	'maxlength'	=> 80,
	'size'	=> 30,
     'class'=>'form-control',
    'placeholder'=>'Email',
    "data-parsley-type" => 'email',
    'data-parsley-required'=>'true'
);
$new_email = array(
	'name'	=> 'email',
	'id'	=> 'new_email',
    'maxlength'	=> 80,
	'size'	=> 30,
     'class'=>'form-control',
    'placeholder'=>'Email',
    "data-parsley-type" => 'email',
    'data-parsley-required'=>'true'
);
$vpassword = array(
	'name'	=> 'password',
	'id'	=> 'vpassword',
	'maxlength'	=> 80,
	'class'=>'form-control',
    'placeholder'=>'Current Password',
    'data-parsley-required'=>'true'
);
$password = array(
	'name'	=> 'old_password',
	'id'	=> 'old_password',
	'maxlength'	=> 80,
	'class'=>'form-control',
    'placeholder'=>'Current Password',
    'data-parsley-required'=>'true'
);

$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> 80,
	'class'=>'form-control',
    'placeholder'=>'New Password',
    'data-parsley-required'=>'true',
    'data-parsley-minlength'=>6
);

$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> 80,
	'class'=>'form-control',
    'placeholder'=>'Confirm New Password',
    'data-parsley-required'=>'true',
    'data-parsley-minlength'=>6,
    'data-parsley-equalto'=>"#new_password"
);



?> 
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Settings
            <small>Change your basic and login settings</small>
          </h1>
          <ol class="breadcrumb">
            
          </ol>
        </section>

        <!-- Main content -->
      
                <section class="content">
                <div class="row">
      
      
        <div class="col-xs-12">
        <?php
      $msg = $this->session->flashdata('message');
      $class = $this->session->flashdata('class');
      if($msg)
      {
        echo "<div class='alert alert-dismissable alert-".$class."' id='message_box' ><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$msg."</div>";
      }
      ?>
        <div id="add_user_res"></div>
        
        <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Change Basic Information</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php echo form_open(site_url('settings/change_email'),  array('class'=>'form-horizontal','role'=>'form','id'=>'email_form', 'data-parsley-validate'=>"" )); ?>
                  <div class="box-body">
                    <div class="form-group">
                                       <div class="col-lg-12">
                                            <label class="control-label">Email</label>
                                          <?php echo form_input($email); ?> 
                                            <span style="color: red;"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></span>
                                        </div>
                                      </div> 
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                     <button type="button" class="btn btn-custom pull-right" data-toggle="modal" data-target="#changeEmail">Change Email</button>
                  </div>
                 <?php echo form_close(); ?>	
              </div>
        
        
        
        <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Change Password</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php echo form_open(site_url('settings/change_password'),  array('class'=>'form-horizontal','role'=>'form','id'=>'password_form')); ?>
                  <div class="box-body">
                   <div class="form-group">
                                        
                                        <div class="col-lg-12">
                                            <label class="control-label">Current Password</label>
                                          <?php echo form_password($password); ?> 
                                            <span style="color: red;"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></span>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        
                                        <div class="col-lg-12">
                                            <label class="control-label">New Password</label>
                                          <?php echo form_password($new_password); ?> 
                                            <span style="color: red;"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?></span>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        
                                        <div class="col-lg-12">
                                            <label class="control-label">Confirm New Password</label>
                                          <?php echo form_password($confirm_new_password); ?> 
                                            <span style="color: red;"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?></span>
                                        </div>
                                      </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-custom pull-right save"><i class="fa fa-spinner fa-spin formloader"></i> Change Password</button>
                  </div>
                 <?php echo form_close(); ?>	
              </div>
        </div>
      </div>         
       </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<!-- Change Email -->
<div class="modal fade" id="changeEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <?php echo form_open(site_url('settings/change_email'),  array('role'=>'form','id'=>'new_email_form', 'data-parsley-validate'=>"" )); ?>
     
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Enter password to change email</h4>
      </div>
      <div class="modal-body">
              <div class="form-group">
                
                    <label class="control-label" for="vpassword">Password</label>
                  <?php echo form_password($vpassword); ?> 
        
              </div>
            <div class="form-group">
               
                    <label class="control-label" for="new_email">Email</label>
                  <?php echo form_input($new_email); ?> 
             
              </div>
           
      </div>
      <div class="modal-footer">
       
       <div class="clearfix" ></div>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-custom save"><i class="fa fa-spinner fa-spin formloader"></i> Submit</button>
        <div class="clearfix"></div>
       <div id="new_email_form_res" style="margin-top: 5px;" class="text-left" ></div>
      </div>
      
      <?php echo form_close(); ?>
      	
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
$('#changeEmail').on('show.bs.modal', function (e) {
  $('#new_email').val($('#email').val());
})

$(document).ready(function(){
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 
 //change email
 $('#new_email_form').parsley();
$('#new_email_form').submit(function(){
        var _this=$(this);
     $('#new_email_form_loader').fadeIn();
                            var values = $('#new_email_form').serialize();
                            $.ajax({
                            url:'<?php echo site_url('settings/change_email/'); ?>',
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
                                $('#new_email_form')[0].reset();
                                $('#new_email_form').parsley().reset();
                                $('#new_email_form_loader').fadeOut();
                                
                             }
                             else
                             {
                                
                               toastr.error(result.message);
                                $('#vpassword').val('');
                                $('#new_email_form_loader').fadeOut();
                             } 
                            }
                           });
    
    return false;
    });
    
    $('#password_form').parsley();
     $('#password_form').submit(function(){
    var _this=$(this);
    var values = $('#password_form').serialize();
    $.ajax({
    url:'<?php echo site_url('settings/change_password'); ?>',
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
        $('#password_form')[0].reset();
        $('#password_form').parsley().reset();
     }
     else
     {
        
        toastr.error(result.message);
        $('#password_form')[0].reset();
     }     
    }
   });
   
    return false;
        
    });   
    
});
</script>