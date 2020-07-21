<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Branches extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Datatables');
    $this->load->model('Branches_model');
  }


  
 /**
     * Branches::index()
     * @return json
     */

  function index(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data["title"] = "Settings";
    $data['setting_aside']=$this->load->view('settings/setting_aside', '', TRUE);
    $this->load->view('include/inner_header',$data);
    $this->load->view('branches/branches_listing',$data);
    $this->load->view('include/inner_footer',$data);

  }

  /**
     * Branches::branches_listing()
     * @return json
     */
  function branches_listing(){
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();
    $this->datatables->select('branches.branch_name,branches.branch_email,branches.branch_phone,branches.created,branches.branch_id')
    ->where('branches.is_deleted',0)
    ->where('branches.branch_id !=',1)
    ->from('branches');
    echo $this->datatables->generate();
  }

  /**
     * Branches::add_branch()
     * @return json
     */
  public function add_branch(){
    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('branch_name','Branch Name','trim|required|xss_clean'); 
    $this->form_validation->set_rules('branch_phone','Branch Phone','trim|required|xss_clean');
    $this->form_validation->set_rules('branch_email','Branch Email','trim|required|xss_clean'); 
    $this->form_validation->set_rules('branch_address','Address','trim|required|xss_clean');
    $this->form_validation->set_rules('branch_city','City','trim|required|xss_clean'); 
    $this->form_validation->set_rules('branch_state','State','trim|required|xss_clean');
    $this->form_validation->set_rules('branch_country','Country','trim|required|xss_clean'); 
    $this->form_validation->set_rules('branch_zip','Zip/Post','trim|required|xss_clean');

    if($this->form_validation->run()){
      if($this->Branches_model->add_branch()){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('branch_added_success');
      }else{
        $result["status"] = 0;
        $result["message"] =  $this->lang->line('error_occured');
      }
    }else{
      $result["status"] = 0;
      $result["message"] = validation_errors();
    }
    echo json_encode($result);
  }

  /**
     * Branches::edit_branch()
     * @return void
     */
  function edit_branch($id){

    $data["admin_data"] = $this->checkAccess();

    $data["details"] = $this->Branches_model->get_branch_details($id);
     
    $this->load->view('branches/edit_branch',$data);
  }

 /**
     * Branches::update_branch()
     * @return void
     */
  function update_branch($id){

    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('branch_name','Branch Name','trim|required|xss_clean'); 
    $this->form_validation->set_rules('branch_phone','Branch Phone','trim|required|xss_clean');
    $this->form_validation->set_rules('branch_email','Branch Email','trim|required|xss_clean'); 
    $this->form_validation->set_rules('branch_address','Address','trim|required|xss_clean');
    $this->form_validation->set_rules('branch_city','City','trim|required|xss_clean'); 
    $this->form_validation->set_rules('branch_state','State','trim|required|xss_clean');
    $this->form_validation->set_rules('branch_country','Country','trim|required|xss_clean'); 
    $this->form_validation->set_rules('branch_zip','Zip/Post','trim|required|xss_clean');
      if($this->form_validation->run()){
        if($this->Branches_model->update_branch($id)){
          $result["status"] = 1;
          $result["message"] = $this->lang->line('branch_update_success');
        }else{
          $result["status"] = 0;
          $result["message"] =  $this->lang->line('error_occured');
        }
      }else{
        $result["status"] = 0;
        $result["message"] = validation_errors();
      }
    echo json_encode($result);
  }


   /**
     * Branches::delete_branch()
     * @return void
     */

  public function delete_branch($id){

    $data['admin_data'] = $this->checkAccess();
    $del = $this->Branches_model->delete($id);

    if($del){
      $result['message'] = $this->lang->line('branch_delete_success');
      $result['status'] = 1;
    }else {
      $result['message'] = $this->lang->line('error_occured');
      $result['status'] = 0;
    }

    echo json_encode($result);
  }

  /** Verify if user is logged in and is admin (for direct requests)
  * @param void
  * @return mixed
  */

  private function checkAccess(){

    if($this->aauth->is_loggedin()){
      return  $this->session->all_userdata();
    }
    else{
      redirect('/auth/login/');
    }
  }
}
?>
