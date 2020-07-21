<?php 
$details['title']="Email Change Request";
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
                                         Your new email address on <?php echo $site_name; ?></h2>
                                         You have changed your email address for <?php echo $site_name; ?>.<br />
                                         Follow this link to confirm your new email address:<br />
                                         <br>
                                         <big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/settings/reset_email/'.$id.'/'.$new_email_key); ?>" style="color: #3366cc;">Confirm your new email</a></b></big><br />
                                         <br>
                                         Link doesn't work? Copy the following link to your browser address bar:<br />
                                         <nobr><a href="<?php echo site_url('/settings/reset_email/'.$id.'/'.$new_email_key); ?>" style="color: #3366cc;"><?php echo site_url('/settings/reset_email/'.$id.'/'.$new_email_key); ?></a></nobr><br />
                                         <br />
                                         <br />
                                         Your email address: <?php echo $new_email; ?><br />
                                         <br />
                                         <br />
                                         You received this email, because it was requested by a <a href="<?php echo site_url(''); ?>" style="color: #3366cc;"><?php echo $site_name; ?></a> user. If you have received this by mistake, please DO NOT click the confirmation link, and simply delete this email. After a short time, the request will be removed from the system.<br />
                                         <br />
                                         <br />
                                         <br>
                                         <br>
                                         Thank you,<br>
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