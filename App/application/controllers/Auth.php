<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * @property Login_control $Login_control
 * @property Aauth $aauth Description
 * @version 1.0
 */
class Auth extends CI_Controller {

    public function __construct() {
        
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->lang->load('aauth_lang');
        $this->load->library("Aauth");
    }
    public function index() {
        
        if(!$this->aauth->is_loggedin())
        {
            redirect('/auth/login/');
        }else{
            redirect('/dashboard');
        }

    }
    
    /**
     * Login
     * */
    public function login()
    {
       if($this->aauth->is_loggedin()){
        redirect('/dashboard');
    }else{
        $this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('remember', 'Remember me', 'integer');
        
        if ($this->form_validation->run()) {
            if($this->aauth->login($this->input->post('login'),$this->input->post('password'),$this->input->post('remember')))
            {
                $this->session->set_flashdata(array(
                    'message' => $this->lang->line('successfully_login'),
                ));
                
                redirect('/dashboard');
            }
        }
        
      
        $data['title'] = 'Login';
        $this->load->view('include/outer_header',$data);
        $this->load->view('auth/login',$data);
        $this->load->view('include/outer_footer');
    }
}


     /**
     * Auth::register()
     * @return void
     */
   public function register()
   {
    $this->form_validation->set_rules('agree', 'Agree', 'integer|required');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|is_unique[aauth_users.email]',array('is_unique' => 'Email is Already Exists'));
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
    if($this->form_validation->run())
    {
        if($res = $this->aauth->create_user($this->input->post('email'),$this->input->post('password'),$this->input->post('username'),$this->input->post('company_name')))
        {

            if(!empty($res))
            {
                $this->session->set_flashdata(array(
                    'message' => $this->lang->line('aauth_user_created'),
                    'class' => 'success',
                ));
                redirect('/auth/login/');
            }
            else{
                $this->session->set_flashdata(array(
                    'message' => 'Something Wrong'.$res,
                    'class' => 'danger',
                ));
            }
        }

    }
    $data['title'] = 'Register';
    $this->load->view('include/outer_header',$data);
    $this->load->view('auth/register',$data);
    $this->load->view('include/outer_footer');
}

   /**
     * Auth::email_verification()
     * @param mixed $user_id,$ver_code
     * @return json
     */
    public function email_verification($user_id,$ver_code)
    {
        if(!empty($user_id) && !empty($ver_code)){
            if($this->aauth->verify_user($user_id, $ver_code))
            {
             $this->session->set_flashdata(array(
                'message' => $this->lang->line('aauth_email_verified_success'),
                'class' => 'success',
            ));
             redirect('/auth/login/');
         }else{
            $result["status"] = 0;
            $result["message"] = $this->lang->line('error_occured');
        }

    }else{
        $result["status"] = 0;
        $result["message"] = $this->lang->line('error_occured');
    }
    echo json_encode($result);
}

    /**
     * Logout
     * */
    
    public function logout() {

        $this->aauth->logout();
        redirect('/auth/login/');
    }
    
    /**
     * Forgot Password
     * */
    public function forgot_password()
    {
        $this->form_validation->set_rules('login', 'Email or login', 'trim|required|xss_clean');
        
        if ($this->form_validation->run()) {
            if($this->aauth->remind_password($this->input->post('login')))
            {
                $this->session->set_flashdata(array(
                    'message' => $this->lang->line('new_reset_password_link'),
                    'class' => 'success',
                ));
            }
            else{
                $this->session->set_flashdata(array(
                    'message' => $this->lang->line('aauth_error_email_invalid'),
                    'class' => 'danger',
                ));
            }
        }
        
        $data['title'] = 'Forgot Password';
        $this->load->view('include/outer_header',$data);
        $this->load->view('auth/forgot_password', $data);
        $this->load->view('include/outer_footer');
    }
    
    /**
     * Reset Password
     * */
    public function reset_password($ver_code)
    {
        if($this->aauth->reset_password($ver_code))
        {
            $this->session->set_flashdata(array(
                'message' => $this->lang->line('aauth_password_reset_success_message'),
                'class' => 'success',
            ));
            redirect('/auth/login/');
            
        }
        
    }
    
    /**
    show unauthorized access page
    */
    public function accessDenied(){
     $this->load->view('errors/access_denied');  
 }
 

}//end

/* End of file welcome.php */
