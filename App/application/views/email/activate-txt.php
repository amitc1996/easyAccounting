Welcome to <?php echo $site_name; ?>,

Thanks for joining <?php echo $site_name; ?>. We listed your sign in details below, make sure you keep them safe.
To verify your email address, please follow this link:

<?php echo site_url('/auth/email_verification/'.$user_id.'/'.$verification_code); ?>



Have fun!
The <?php echo $site_name; ?> Team