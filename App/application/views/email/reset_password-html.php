<?php 
$details['title']="Password Changed";
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
                                      Your new password on <?php echo $name; ?></h2>
                                      You have changed your password.<br />
                                      Please, keep it in your records so you don't forget it.<br />
                                      <br />
                                      <?php if (strlen($username) > 0) { ?>Your username: <?php echo $username; ?><br /><?php } ?>
                                        Your email address: <?php echo $email; ?><br />

                                        Your password: <?php echo  $password ; ?><br />
                                        <?php /* Your new password: <?php echo $new_password; ?><br /> */ ?>
                                        <br />
                                        <br />
                                        Thank you,<br />
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