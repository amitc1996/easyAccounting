
<!-- <div class="text-center social-links">
                <h3><span class="login">Social login</span></h3>
                    <a href="" class="btn btn-simple btn-just-icon"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="" class="btn btn-simple btn-just-icon"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div> -->
        <!--     <div class="footer">
    <p><a href="<?php //echo site_url(); ?>" target="_blank"><?php //echo $this->config->item('name', 'aauth'); ?></a> &copy; <?php// echo date("Y");?> All Rights Reserved,</p>
  </div> -->
<div class="stripes-wraper">
        <div class="stripes">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div><!-- /.login-box -->

<!-- jquery 1.10.2 -->
<script src="<?php echo base_url('/assets/js/jquery-1.10.2.min.js')?>"></script>
<!-- bootstrap.js --->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/custom.js');?>"></script>
<script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-green',
          radioClass: 'iradio_square-green',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>