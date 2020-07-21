<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_controller
{
 
  function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->model('settings_model');
    $this->lang->load('aauth_lang');
    date_default_timezone_set('America/New_York');

  }
     /**
     * Setting index
     * */ 

     public function index()
     {
      $data["admin_data"] = $this->checkAccess();
      $data['permissions'] = getUserPermissions();
      $data['user_id']	= $this->aauth->get_user_id();   
      $data["profile_info"] = $this->settings_model->get_user_by_id($data['user_id']);
      $data["title"]  = "Settings";
      $this->load->view('include/inner_header', $data);
      $this->load->view('settings', $data);
      $this->load->view('include/inner_footer', $data);

    }

    /**
     * Change email
     * */  

    public function change_email()
    {
      $data["admin_data"] = $this->checkAccess();
      $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

      if($this->form_validation->run())
      {
        if ($data['res'] = $this->aauth->set_new_email($this->form_validation->set_value('email'), $this->form_validation->set_value('password')))
        { 
          if( $this->aauth->config_vars['email_verification'] == TRUE)
          {
            $this->_send_email('change_email', $this->form_validation->set_value('email'), $data['res']);
            $result["status"] = 1; 
            $result["message"] = sprintf($this->lang->line('auth_message_new_email_sent'),$this->form_validation->set_value('email'));
          }else{
           $result["status"] = 1; 
           $result["message"] = $this->lang->line('email_successfully_updated');
         }
         
       }
       else
       {

        $errors = $this->aauth->get_errors_array();
        foreach ($errors as $k => $v)   $data['errors'][$k] = $v;
        $result['status'] = 0;
        $result['message'] =  $data['errors'][$k];
      }
    }
    else
    {

      $result["status"] = 0;
      $result["message"] = validation_errors();
    }
    
    echo json_encode($result);
    
  }
    /**
     * Reset email
     * */  

    function reset_email()
    {

      $user_id        = $this->uri->segment(3);
      $new_email_key  = $this->uri->segment(4);

      if ($this->aauth->activate_new_email($user_id, $new_email_key)) {   
        $this->aauth->logout();
        
        $this->_show_message($this->lang->line('auth_message_new_email_activated').' '.anchor('/auth/login/', 'Login'));

      } else {                                                                
        $this->_show_message($this->lang->line('auth_message_new_email_failed'));
      }
    }
    
    /**
     * Show Message
     * */  

    function _show_message($message)
    {
      $this->session->set_flashdata('message', $message);
      redirect('/auth/');
    }

    /**
     * Change password
     * */   

    public function change_password()
    {
      $data["admin_data"] = $this->checkAccess();
      $data['user_id']	= $this->aauth->get_user_id();
      $data["profile_info"] = $this->settings_model->get_user_by_id($data['user_id']); 
      
      $password = $this->aauth->hash_password($this->input->post('old_password'), $data['user_id']);
      if($password == $data["profile_info"]->pass)
      {
        if($updated = $this->settings_model->update_password($data['user_id']))
        {
          $result['status'] = 1;
          $result['message'] = $this->lang->line('password_successfully_updated');
        }else{
          $result['status'] = 0;
          $result['message'] = $this->lang->line('error_occured');
        }
      }
      else
      {
        $result['status'] = 0;
        $result['message'] = $this->lang->line('Incorrect_password');    
      }
      
      echo json_encode($result);
    }
    /**
     * Send email
     * */
    function _send_email($type, $email, &$data)
    {
      
      $data['site_name'] = $this->config->item('name','aauth');
      $this->load->library('email');
      $this->email->from($this->config->item('email','aauth'), $this->config->item('name','aauth'));
      $this->email->reply_to($this->config->item('email','aauth'), $this->config->item('name','aauth'));
      $this->email->to($email);
      $this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('name','aauth')));
      $this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
      $this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
      $this->email->send();
    }
    
  /** Verify if user is logged in and is admin (for direct requests)
   * @param void
   * @return mixed
   */

  private function checkAccess()
  {  
   if($this->aauth->is_loggedin())
   {
    return  $this->session->all_userdata();
  }
  else
  {
    redirect('auth'); 
    die();
  }
}
}