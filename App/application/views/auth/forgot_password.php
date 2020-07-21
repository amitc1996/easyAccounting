<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
    'class' => 'form-control',
    'type' => 'email',
    'placeholder' => 'Email',
 	'value' => set_value('login'),
    'data-parsley-required'=>'true',
    'data-parsley-trigger' => 'change'
);

?>
<div class="body">
<h2>Enter your Email Id</h2>
<?php
      $msg = $this->session->flashdata('message');
      $class = $this->session->flashdata('class');
      if($msg)
      {
        echo "<div class='alert alert-dismissable alert-".$class."' id='message_box' ><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$msg."</div>";
      }
      ?>
<?php echo form_open($this->uri->uri_string(),array('method' => 'post', 'data-parsley-validate' => '')); ?>
            <div class="form-group has-feedback">
            <?php echo form_input($login); ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="row">
          <div class="col-xs-12">
          <button type="submit" name="reset" class="btn btn-theme btn-round btn-block mt-10 mb-20">Get New Password</button>
           <a href="<?php echo site_url('auth/login'); ?>" style="color: #333!important" class="btn btn-default btn-round btn-block mt-10 mb-20">Back</a>
          </div>
          </div>

<?php echo form_close(); ?>
<?php if (validation_errors()) { ?><div class=" alert alert-danger login-alert-box" role="alert"><?php echo validation_errors(); ?></div> <?php }?>
<?php if(count($this->aauth->get_errors_array()) > 0){ ?>
<div class=" alert alert-danger" role="alert"><?php $this->aauth->print_errors(); ?></div>
<?php } ?>
</div>