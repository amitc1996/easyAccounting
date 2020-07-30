<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* E-mail Messages */

// Account verification
$lang['aauth_email_verification_subject'] = 'Account Verification';
$lang['aauth_email_verification_code'] = 'Your verification code is: ';
$lang['aauth_email_verification_text'] = " You can also click on (or copy and paste) the following link\n\n";
$lang['auth_message_new_email_sent'] = 'A confirmation email has been sent to %s. Follow the instructions in the email to complete this change of email address.';

// Password reset
$lang['aauth_email_reset_subject'] = 'Reset Password ';
$lang['aauth_email_reset_text'] = "To reset your password click on (or copy and paste in your browser address bar) the link below:\n\n";
$lang['auth_subject_welcome'] = 'Welcome to %s!';
$lang['auth_subject_change_email'] = 'Email Change Request %s';
$lang['auth_subject_account_updated'] = 'Account Updated';
$lang['auth_subject_activate'] = 'Activate your Email-Ids';
$lang['new_reset_password_link'] = 'New password link has been sent to your registered email ID.';
$lang['auth_subject_send_invoice'] = 'Invoice from %s!';

// Password reset success
$lang['aauth_email_reset_success_subject'] = 'Successful Pasword Reset';
$lang['aauth_password_reset_success_message'] = 'Your password has been successfully changed and has been sent to your registered email address';
$lang['aauth_email_reset_success_new_password'] = 'Your password has successfully been reset. Your new password is : ';
$lang['Incorrect_password'] = 'Password you entered is incorrect.';
//login
$lang['successfully_login'] = 'Welcome, You are successfully logged in.';
//change_email
$lang['email_successfully_updated'] = 'Email has been Successfully Updated.';
//change_password
$lang['password_successfully_updated'] = 'Password has been Successfully Updated';
/* Error Messages */

// Account creation errors
$lang['aauth_error_email_exists'] = 'Email address already exists on the system. If you forgot your password, you can click the link below.';
$lang['aauth_error_username_exists'] = "Account already exists on the system with that username.  Please enter a different username, or if you forgot your password, please click the link below.";
$lang['aauth_error_email_invalid'] = 'Invalid e-mail address';
$lang['aauth_error_password_invalid'] = 'Invalid password';
$lang['aauth_error_username_invalid'] = 'Invalid Username';
$lang['aauth_error_username_required'] = 'Username required';
$lang['aauth_error_totp_code_required'] = 'Authentication Code required';
$lang['aauth_error_totp_code_invalid'] = 'Invalid Authentication Code';


// Account update errors
$lang['aauth_error_update_email_exists'] = 'Email address already exists on the system.  Please enter a different email address.';
$lang['aauth_error_update_username_exists'] = "Username already exists on the system.  Please enter a different username.";


// Access errors
$lang['aauth_error_no_access'] = 'Sorry, you do not have access to the resource you requested.';
$lang['aauth_error_login_failed_email'] = 'E-mail Address and Password do not match.';
$lang['aauth_error_login_failed_name'] = 'Username and Password do not match.';
$lang['aauth_error_login_failed_all'] = 'E-mail, Username or Password do not match.';
$lang['aauth_error_login_attempts_exceeded'] = 'You have exceeded your login attempts, your account has now been locked.';
$lang['aauth_error_recaptcha_not_correct'] = 'Sorry, the reCAPTCHA text entered was incorrect.';

// Misc. errors
$lang['aauth_error_no_user'] = 'User does not exist';
$lang['aauth_error_vercode_invalid'] = 'Invalid Verification Code';
$lang['aauth_error_account_not_verified'] = 'Your account has not been verified. Please check your e-mail and verify your account.';
$lang['aauth_error_no_group'] = 'Group does not exist';
$lang['aauth_error_no_subgroup'] = 'Subgroup does not exist';
$lang['aauth_error_self_pm'] = 'It is not possible to send a Message to yourself.';
$lang['aauth_error_no_pm'] = 'Private Message not found';

//access_denied

$lang["access_denied"] = 'The page you requested is forbidden for you. You have not propper access to see this page. Please visit <a href="'.site_url('settings').'">mainpage</a>.';


/* Info messages */
$lang['aauth_info_already_member'] = 'User is already member of group';
$lang['aauth_info_already_subgroup'] = 'Subgroup is already member of group';
$lang['aauth_info_group_exists'] = 'Group name already exists';
$lang['aauth_info_perm_exists'] = 'Permission name already exists';
$lang['aauth_user_created'] = 'You have successfully registered. Check your email address to activate your account.';

$lang['error_occured'] = 'Error Occured.';

/*Group */
$lang['group_successfully_added'] = 'Group has been successfully added.';
$lang['group_name_exist'] = 'Group name already exists.';
$lang['group_successfully_deleted'] = 'Group has been successfully deleted.';
$lang['group_successfully_updated'] = 'Group has been successfully updated.';

/*Staff */
$lang['staff_successfully_added'] = 'Staff has been successfully added.';
$lang['staff_delete_success'] = 'Staff has been successfully deleted.';
$lang['staff_successfully_updated'] = 'Staff has been successfully updated.';
$lang['password_update_success'] = 'Password has been successfully updated.';
$lang['staff_email_exist'] = 'Email Address already exists.';
$lang['staff_username_exist'] = 'Username  already exists.';

// category
$lang['category_added_success'] = 'Category has been successsfully added.';
$lang['category_update_success'] = 'Category has been successsfully updated.';
$lang['category_delete_success'] = 'Category has been successsfully deleted.';

// category
$lang['stock_added_success'] = 'Stock has been successsfully added.';
$lang['stock_update_success'] = 'Stock has been successsfully updated.';
$lang['stock_delete_success'] = 'Stock has been successsfully deleted.';

// brand
$lang['brand_added_success'] = 'Brand has been successsfully added.';
$lang['brand_update_success'] = 'Brand has been successsfully updated.';
$lang['brand_delete_success'] = 'Brand has been successsfully deleted.';
$lang['unique_brand_name_error'] = 'The Brand Name field must contain a unique value.';


// measurement
$lang['measurement_added_success'] =  'Measurement has been successsfully added.';
$lang['measurement_update_success'] = 'Measurement has been successsfully updated.';
$lang['measurement_delete_success'] = 'Measurement has been successsfully deleted.';
$lang['unique_measurment_name_error'] = 'The Measurement Name field must contain a unique value.';


// tax
$lang['tax_added_success'] =  'Tax has been successsfully added.';
$lang['tax_update_success'] = 'Tax has been successsfully updated.';
$lang['tax_delete_success'] = 'Tax has been successsfully deleted.';

// currency
$lang['currency_added_success'] =  'Currency has been successsfully added.';
$lang['currency_update_success'] = 'Currency has been successsfully updated.';
$lang['currency_delete_success'] = 'Currency has been successsfully deleted.';

// branch
$lang['branch_added_success'] =  'Branch has been successsfully added.';
$lang['branch_update_success'] = 'Branch has been successsfully updated.';
$lang['branch_delete_success'] = 'Branch has been successsfully deleted.';


// discount
$lang['discount_added_success'] =  'Discount has been successsfully added.';
$lang['discount_update_success'] = 'Discount has been successsfully updated.';
$lang['discount_delete_success'] = 'Discount has been successsfully deleted.';

// wherehouse
$lang['wherehouse_added_success'] =  'Wherehouse has been successsfully added.';
$lang['wherehouse_update_success'] = 'Wherehouse has been successsfully updated.';
$lang['wherehouse_delete_success'] = 'Wherehouse has been successsfully deleted.';


// supplier
$lang['supplier_added_success'] = 'Supplier has been successsfully added.';
$lang['supplier_update_success'] = 'Supplier has been successsfully updated.';
$lang['supplier_delete_success'] = 'Supplier has been successsfully deleted.';

// account_group
$lang['account_group_added_success'] = 'Account group has been successsfully added.';
$lang['account_group_update_success'] = 'Account group has been successsfully updated.';
$lang['account_group_delete_success'] = 'Account group has been successsfully deleted.';
$lang['unique_account_name_error'] = 'The Group Name field must contain a unique value.';

// account_group
$lang['account_group_added_success'] = 'Account group has been successsfully added.';
$lang['account_group_update_success'] = 'Account group has been successsfully updated.';
$lang['account_group_delete_success'] = 'Account group has been successsfully deleted.';



//client
$lang['client_add_success']  = 'Client has been successsfully added.';
$lang['client_update_success'] = 'Client has been successsfully updated.';
$lang['client_delete_success'] = 'Client has been successsfully deleted.';

//ledger
$lang['ledger_added_success']  = 'Ledger has been successsfully added.';
$lang['ledger_update_success'] = 'Ledger has been successsfully updated.';
$lang['ledger_delete_success'] = 'Ledger has been successsfully deleted.';
$lang['ledger_unique_error'] = 'The Ledger Name field must contain a unique value.';


// marketplace
$lang['marketplace_added_success'] = 'Marketplace has been successsfully added.';
$lang['marketplace_update_success'] = 'Marketplace has been successsfully updated.';
$lang['marketplace_delete_success'] = 'Marketplace has been successsfully deleted.';



// products
$lang['product_add_success'] = 'Product has been successsfully added.';
$lang['product_delete_success'] = 'Product has been successsfully deleted.';
$lang['product_update_success'] = 'Product has been successsfully updated.';

/*Purchase */
$lang['purchase_successfully_added'] = 'Purchase has been successsfully added.';
$lang['purchase_update_success'] = 'Purchase has been successsfully updated.';
$lang['purchase_item_update_success'] = 'Purchase item has been successsfully updated.';
$lang['purchase_delete_success'] = 'Purchase has been successsfully deleted.';
$lang['purchase_item_delete_success'] = 'Purchase item has been successsfully deleted.';

/*Purchase Return*/
$lang['purchase_return_successfully_added'] = 'Purchase return has been successsfully added.';
$lang['purchase_return_update_success'] = 'Purchase return has been successsfully updated.';
$lang['purchase_return_item_update_success'] = 'Purchase return item has been successsfully updated.';
$lang['purchase_return_delete_success'] = 'Purchase return has been successsfully deleted.';
$lang['purchase_return_item_delete_success'] = 'Purchase return item has been successsfully deleted.';
$lang['purchase_stock_error'] = 'Something went wrong. Please verify stock details.';

/*Sale */
$lang['sale_successfully_added'] = 'Sale has been successsfully added.';
$lang['sale_successfully_updated'] = 'Sale has been successsfully updated.';
$lang['sale_item_update_success'] = 'Sale item has been successsfully updated.';
$lang['sale_delete_success'] = 'Sale has been successsfully deleted.';
$lang['sale_item_delete_success'] = 'Sale item has been successsfully deleted.';
$lang['sale_stock_error'] = 'Something went wrong. Please verify stock details.';
$lang['email_successfully_sent'] =  'Email has been successsfully sent.';
$lang['no_email_available'] =  'Please enter email first.';




/*Sales Return*/
$lang['sale_return_successfully_added'] = 'Sale return has been successsfully added.';
$lang['sale_return_update_success'] = 'Sale return has been successsfully updated.';
$lang['sale_return_item_update_success'] = 'Sale return item has been successsfully updated.';
$lang['sale_return_delete_success'] = 'Sale return has been successsfully deleted.';
$lang['sale_return_item_delete_success'] = 'Sale return item has been successsfully deleted.';

/* Unique name check */
$lang['unique_category_name_error'] = 'Category name already exists. Please try another.';
$lang['unique_vendor_name_error'] = 'Vendor name already exists. Please try another.';
$lang['unique_marketplace_name_error'] = 'Marketplace name already exists. Please try another.';

/* Company */
$lang['company_add_success'] = 'Company details have been added.';
$lang['company_add_error'] = 'Error adding comapny details.';
$lang['company_update_success'] = 'Company profile details have been updated.';
$lang['company_update_error'] = 'Company profile details could not be updated.';


/* Expense */

$lang['expense_added_success'] =  'Expense has been successsfully added.';
$lang['expense_update_success'] = 'Expense has been successsfully updated.';
$lang['expense_delete_success'] = 'Expense has been successsfully deleted.';


/* Payment */
$lang['payment_added_success'] =  'Payment has been successsfully added.';


/* Payment */
$lang['receipt_added_success'] =  'Receipt has been successsfully added.';



