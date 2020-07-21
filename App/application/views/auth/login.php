<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
    'class' => 'form-control',
    'placeholder' => 'Email ',
	'maxlength'	=> 80,
	'size'	=> 30,
    'data-parsley-required'=>'true' 
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
    'class' => 'form-control',
    'placeholder' =>'Password',
	'size'	=> 30,
    'data-parsley-required'=>'true'
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
 <div class="body">
<h2>Login to start your session</h2>
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
            <?php echo form_input($login); ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <?php echo form_password($password); ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          
          <div class="row">
            <div class="col-xs-6">
              <div class="">
                <label>
                <?php echo form_checkbox($remember); ?>
                Remember Me
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-6">
              <div class="row">
          <div class="col-xs-12">
          <?php echo anchor('auth/forgot_password/', 'Forgot password?'); ?>
          </div>
          </div>
           
            </div><!-- /.col -->
          </div>
             <button type="submit" class="btn btn-theme btn-round btn-block mt-10 mb-20">Sign In</button>

        <?php echo form_close();?>
<?php if (validation_errors()) { ?><div class="alert alert-danger login-alert-box" role="alert"><?php echo validation_errors(); ?></div> <?php }?>
<?php if(count($this->aauth->get_errors_array()) > 0){ ?>
<div class=" alert alert-danger" role="alert"><?php $this->aauth->print_errors(); ?></div>
<?php } ?>
</div><!-- /.login-box-body -->
