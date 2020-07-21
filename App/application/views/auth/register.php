<?php
$company_name = array(
  'name'  => 'company_name',
  'id'  => 'company_name',
  'class' => 'form-control m-input',
  'placeholder' => 'Company name',
  'maxlength' => 80,
  'size'  => 30,
  'data-parsley-required'=>'true' ,
  
);
$username = array(
  'name'  => 'username',
  'id'  => 'username',
  'class' => 'form-control m-input',
  'placeholder' => 'Username',
  'maxlength' => 80,
  'size'  => 30,
  'data-parsley-required'=>'true' ,
  
);
$email = array(
  'name'  => 'email',
  'id'  => 'email',
  'class' => 'form-control m-input',
  'placeholder' => 'Email',
  'maxlength' => 80,
  'size'  => 30,
  'data-parsley-required'=>'true' ,
  'data-parsley-type'=>'email'
  
);
$password = array(
  'name'  => 'password',
  'id'  => 'password',
  'class' => 'form-control m-input',
  'placeholder' =>'Password',
  'size'  => 30,
  'data-parsley-minlength'=>6,
  'data-parsley-required'=>'true'
);
$confirm_password = array(
  'name'  => 'confirm_password',
  'id'  => 'confirm_password',
  'class' => 'form-control',
  'placeholder' => 'Confirm Password',
  'data-parsley-minlength'=>6,
  'data-parsley-required'=>'true',
  'size'  => 30,
  'data-parsley-equalto'=>'#password',
);
$agree = array(
  'name'  => 'agree',
  'type'=>"checkbox",
  'class'=>"custom-control-input",
  'id'  => 'agree',
  'value' => 1,
  'style' => 'margin:0;padding:0',
  'data-parsley-required'=>'true'
); 
?>
 <div class="body">
<h2>Register a new membership</h2>
<?php
      $msg = $this->session->flashdata('message');
      $class = $this->session->flashdata('class');
      if($msg)
      {
        echo "<div class='alert alert-dismissable alert-".$class."' id='message_box' ><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$msg."</div>";
      }
      ?>
<?php echo form_open($this->uri->uri_string(),array('method' => 'post', 'id'=>'login_form', 'data-parsley-validate'=>"")); ?>
          <div class="form-group has-feedback">
            <?php echo form_input($company_name); ?>
            <span class="form-control-feedback"><i class="fa fa-building" aria-hidden="true"></i></span>
          </div>
          <div class="form-group has-feedback">
            <?php echo form_input($username); ?>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <?php echo form_input($email); ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <?php echo form_password($password); ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <?php echo form_password($confirm_password); ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <div class="">
                <label>
                <?php echo form_checkbox($agree); ?>
                I agree <a href="<?php echo site_url('auth/t&c'); ?>">t&c</a>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-6">
              <div class="row">
          <div class="col-xs-12">
         <?php echo anchor('auth/login/', 'Have membership'); ?>
          </div>
          </div>
          </div>
           
            </div><!-- /.col -->
             <button type="submit" class="btn btn-theme btn-round btn-block mt-10 mb-20">Register</button>
          </div>
        <?php echo form_close();?>
<?php if (validation_errors()) { ?><div class="alert alert-danger login-alert-box" role="alert"><?php echo validation_errors(); ?></div> <?php }?>
<?php if(count($this->aauth->get_errors_array()) > 0){ ?>
<div class=" alert alert-danger" role="alert"><?php $this->aauth->print_errors(); ?></div>
<?php } ?>
</div><!-- /.login-box-body -->