<?php 
$details['title']="Create a new password";
$this->load->view('email/email_header',$details);?>
<div class="cContent" id="cContent-5" style="padding: 15px;background-color: rgba(255, 255, 255,0.9);">
    <table width="100%" cellspacing="0" cellpadding="0" style="padding: 0px; padding-top: 0px; padding-bottom: 15px;">
        <tbody>
            <tr>
                <td>
                    <table width="100%" cellpadding="0" cellspacing="0" style="">
                        <tbody>
                            <tr>
                                <td bgcolor="">
                                    <div id="txtHolder-5" class="txtEditorClass" style="color: #666666; font-size: 14px; font-family: 'Arial'; text-align: Left">
                                       Forgot your password, huh? No big deal.<br />
                                       To create a new password, just follow this link:<br />
                                       <br />
                                       <br>
                                       <big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/reset_password/'.$verification_code); ?>" style="color: #3366cc;">Create a new password</a></b></big><br />
                                       <br />
                                       Link doesn't work? Copy the following link to your browser address bar:<br />
                                       <nobr><a href="<?php echo site_url('/auth/reset_password/'.$verification_code); ?>" style="color: #3366cc;"><?php echo site_url('/auth/reset_password/'.$verification_code); ?></a></nobr><br />
                                       <br />
                                       <br />
                                       You received this email, because it was requested by a <a href="<?php echo site_url(''); ?>" style="color: #3366cc;"><?php echo $name; ?></a> user. This is part of the procedure to create a new password on the system. If you DID NOT request a new password then please ignore this email and your password will remain the same.<br />
                                       <br />
                                       <br />
                                       Have fun!<br />
                                       The <?php echo $name; ?> Team
                                   </div>
                               </td>
                           </tr>
                       </tbody>
                   </table>
               </td>
           </tr>
       </tbody>
   </table>
</div>
<?php $this->load->view('email/email_footer');?>