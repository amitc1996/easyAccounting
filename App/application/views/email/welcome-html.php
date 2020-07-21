<?php 
$details['title']="Welcome to ".$site_name;
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
                                        Hello <?php echo $username; ?>,<br>
                                        Thanks for joining <?php echo $site_name; ?>. We listed your sign in details below, make sure you keep them safe.<br />
                                        To open your <?php echo $site_name; ?> homepage, please follow this link:<br />
                                        <br />
                                        <big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/login/'); ?>" style="color: #3366cc;">Go to <?php echo $site_name; ?> now!</a></b></big><br />
                                        <br />
                                        Link doesn't work? Copy the following link to your browser address bar:<br />
                                        <nobr><a href="<?php echo site_url('/auth/login/'); ?>" style="color: #3366cc;"><?php echo site_url('/auth/login/'); ?></a></nobr><br />
                                        <br />
                                        <br />

                                        Your email address: <?php echo $email; ?><br />
                                        Your password: <?php echo $password; ?><br />  
                                        <br />
                                        <br />
                                        Have fun!<br />
                                        The <?php echo $site_name; ?> Team
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