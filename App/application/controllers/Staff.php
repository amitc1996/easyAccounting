<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
    $this->load->helper('security');
    $this->load->library('Datatables');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->library("Aauth");
    $this->load->model('Staff_model');
    $this->load->model('Group_model');
  }

       /**
        * Staff::index()
        * @return void
        */
       public function index() {
        $data["admin_data"] = $this->checkAccess();
        $data['permissions'] = getUserPermissions();
        $data['details'] = $this->Group_model->get_details();
        $data["title"] = "Staff";
        $this->load->view('include/inner_header', $data);
        $this->load->view('staff/staff_listing', $data);
        $this->load->view('include/inner_footer', $data);
      }
    /**
     * Staff::staff_listing()
     * 
     * @return json
     */
    public function staff_listing()
    {
     $_POST['sColumns'] = '';
     $data["admin_data"] = $this->checkAccess();
     $logged_in_user_id=$this->aauth->get_user_id();
     $this->datatables->select('CONCAT(first_name, " " ,last_name ) as first_name,username,email,GROUP_CONCAT(aauth_groups.name SEPARATOR",") groups,aauth_users.id')
     ->where('aauth_users.banned',0)
     ->where('aauth_users.id <> ',$logged_in_user_id)
     ->where('aauth_users.id <> ',1)
     ->where('aauth_users.is_deleted',0)
     ->group_by('username')
     ->from('aauth_users')
     ->join('aauth_user_to_group','aauth_users.id=aauth_user_to_group.user_id','left')
     ->join('aauth_groups','aauth_groups.id=aauth_user_to_group.group_id','left');
     echo $this->datatables->generate();
   }
     /**
    * Add user
    *
    * @return json
    */
     
    public function add_staff()
    {   

      $data["admin_data"] = $this->checkAccess();
      $data['site_name'] = $this->config->item('name', 'aauth');
      $data['email'] = $this->input->post("email");
      $data['username'] = $this->input->post("username");
      $data['send_mail'] = $this->input->post("send_mail");
      $data['password'] = $this->input->post("password");
      $this->form_validation->set_rules('first_name','First Name','trim|required|xss_clean');
      $this->form_validation->set_rules('last_name','Last Name','trim|required|xss_clean');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean');
      $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
      $this->form_validation->set_rules('password','Password', 'required|trim|xss_clean');
      $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|xss_clean');
      if($this->form_validation->run()) 
      {
        if(!$this->Staff_model->check_Staff_email($data['email']))
        {
          if($this->Staff_model->check_Staff_username($data['username']))
          {
            $result = array('status'=>0,'message'=> $this->lang->line('staff_username_exist'));
          }
          else{
            if($data['send_mail']){
              $this->_send_email('welcome', $data['email'], $data);
            }
            if($this->Staff_model->add_user())
            {
              $result["status"] = 1;
              $result["message"] = $this->lang->line('staff_successfully_added');
            }else
            {
              $result["status"] = 0;
              $result["message"] =  $this->lang->line('Error_occured');
            }
          }
        }
        else
        {
         $result["status"] = 0;
         $result["message"] =  $this->lang->line('staff_email_exist');
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
    * Generate form for edit staff information
    *
    * @return void
    */
 public function edit_staff($uid)
 {
  $data["admin_data"] = $this->checkAccess();
  $data['permissions'] = getUserPermissions();
  $data['groups'] = $this->Group_model->get_details();
  $data["userGroups"] = $this->Staff_model->get_user_groups($uid);
  $data["details"] = $this->Staff_model->get_user_details($uid);
  $this->load->view('staff/edit_staff',$data);
}

   /**
    * Update staff information
    *
    * @return void
    */

   public function update_staff($uid)
   {
     $data["admin_data"] = $this->checkAccess();
     $data['site_name'] = $this->config->item('name', 'aauth');
     $data['email'] = $this->input->post("email");
     $data['username'] = $this->input->post("username");
     $data['send_mail'] = $this->input->post("send_mail");
     $data['password'] = $this->input->post("password");
     $this->form_validation->set_rules('first_name','First Name','trim|required|xss_clean');
     $this->form_validation->set_rules('last_name','Last Name','trim|required|xss_clean');
     $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean');
     $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
     if($this->form_validation->run()) 
     {

      if(!$this->Staff_model->check_Staff_email($data['email'],$uid))
      {
        if($this->Staff_model->check_Staff_username($data['username'],$uid)){
          $result["status"] = 0;
          $result["message"] =  $this->lang->line('staff_username_exist'); 
        }
        else{
         if($this->Staff_model->update_user($uid)){
          if($data['send_mail']){
            $this->_send_email('account_updated', $data['email'], $data);
          }
          $result["status"] = 1;
          $result["message"] = $this->lang->line('staff_successfully_updated');
        }
      }
    }else
    {
      $result["status"] = 0;
      $result["message"] =  $this->lang->line('staff_email_exist');
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
    * Delete staff information
    *
    * @return void
    */
     
     public function delete_staff($uid)
     {
       $data["admin_data"] = $this->checkAccess();
       $is_deleted = $this->Staff_model->delete($uid);
       if($is_deleted)
       {
         $result["status"] = 1; 
         $result["message"] = $this->lang->line('staff_delete_success');
       }
       else
       {
         $result["status"] = 0; 
         $result["message"] = $this->lang->line('Error_occured');
       }  
       echo json_encode($result);     
     }


     /**
     * Staff::view_staff()
     * 
     * @param mixed $id
     * @return void
     */
     public function view_staff($uid)
     {

      $data["admin_data"] = $this->checkAccess();
      $data['details'] = $this->Staff_model->get_user_details($uid);
      $this->load->view('staff/view_staff',$data);  
    }

      /**
    * Update  staff password
    *
    * @return void
    */

      public function update_password($uid)
      {
       $data["admin_data"] = $this->checkAccess();
       $data['site_name'] = $this->config->item('name', 'aauth');
       $data['send_mail'] = $this->input->post("send_mail");
       $data['password'] = $this->input->post("password");
       $details = $this->Staff_model->get_user_details($uid);
       $data['email'] = $details[0]['email'];
       $data['username'] = $details[0]['username'];
       $this->form_validation->set_rules('password', 'password', 'required|trim|xss_clean');
       if($this->form_validation->run()) 
       {
        if($this->Staff_model->update_password($uid))
        {
          if($data['send_mail']){
            $this->_send_email('account_updated', $data['email'], $data);
          }
          $result["status"] = 1;
          $result["message"] = $this->lang->line('password_update_success');
        }else
        {
          $result["status"] = 0;
          $result["message"] = $this->lang->line('Error_occured');
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
     * Send email message of given type (activate, email, etc.)
     *
     * @param   string
     * @param   string
     * @param   array
     * @return  void
     */
function _send_email($type, $email, &$data)
{
  $data["admin_data"] = $this->checkAccess();
  $this->load->library('email');
  $this->email->from($this->config->item('email', 'aauth'), $this->config->item('name', 'aauth'));
  $this->email->reply_to($this->config->item('email', 'aauth'), $this->config->item('name', 'aauth'));
  $this->email->to($email);
  $this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('name', 'aauth')));
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
    redirect('/auth/login/'); 
    die();
  }
}

}