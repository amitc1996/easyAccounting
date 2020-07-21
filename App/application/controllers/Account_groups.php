<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Account_groups extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Datatables');
    $this->load->library('Common');
    $this->load->model('Account_groups_model');
  }


  
 /**
     * Account_groups::index()
     * @return void
     */
  function index(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data["title"] = "Account Groups";
     $data["branches"] = $this->common->get_branches();
     $data["categories"] = $this->common->get_account_categories();
    $this->load->view('include/inner_header',$data);
    $this->load->view('account_groups/account_groups_listing',$data);
    $this->load->view('include/inner_footer',$data);

  }

  
 /**
     * Account_groups::account_group_listing()
     * @return 
     */
  function account_group_listing(){
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();
  
    $this->datatables->select('branches.branch_name,account_groups.group_name,account_categories.account_category_name,account_groups.opening_balance,account_groups.created,account_groups.account_group_id')
     ->join('branches','branches.branch_id = account_groups.branch_id')
     ->join('account_categories','account_categories.account_category_id = account_groups.account_category_id')
    ->where('account_groups.is_deleted',0)
    ->from('account_groups');
    echo $this->datatables->generate();
  }

 /**
     * Categories::add_category()
     * @return json
     */
  public function add_account_group(){

    $data["admin_data"] = $this->checkAccess();
     $this->form_validation->set_rules('branch','Branch','trim|required|xss_clean');
    $this->form_validation->set_rules('group_name','Group Name','trim|required|xss_clean|is_unique[account_groups.group_name]');
    $this->form_validation->set_rules('category_name','Category','trim|required|xss_clean');
    $this->form_validation->set_rules('opening_balance','Opening Balance','trim|required|xss_clean');
    if($this->form_validation->run()){
      if($this->Account_groups_model->add_group()){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('account_group_added_success');
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
     * Categories::edit_category()
     * @return void
     */
  function edit_account_group($id){

     $data["admin_data"] = $this->checkAccess();
     $data["details"] = $this->Account_groups_model->get_account_group_details($id);
     $data["branches"] = $this->common->get_branches();
     $data["categories"] = $this->common->get_account_categories();
    $this->load->view('account_groups/edit_account_group',$data);
  }
/**
     * Account_groups::update_account_group()
     * @return json
     */
  function update_account_group($id){
    $data['admin_data'] = $this->checkAccess();
     $this->form_validation->set_rules('branch','Branch','trim|required|xss_clean');
    $this->form_validation->set_rules('category_name','Category','trim|required|xss_clean');
    $this->form_validation->set_rules('opening_balance','Opening Balance','trim|required|xss_clean');
    $unique = checkEditUnique($id,$this->input->post('group_name'),'account_groups','group_name','account_group_id');
    if($unique){
      $this->form_validation->set_rules('group_name','Group Name','trim|required|xss_clean');
      if($this->form_validation->run()){
        if($this->Account_groups_model->update_account_group($id)){
          $result["status"] = 1;
          $result["message"] = $this->lang->line('account_group_update_success');
        }else{
          $result["status"] = 0;
          $result["message"] =  $this->lang->line('error_occured');
        }
      }else{
        $result["status"] = 0;
        $result["message"] = validation_errors();
      }
    }else {
      $result["status"] = 0;
      $result["message"] = $this->lang->line('unique_account_name_error');
    }

    echo json_encode($result);
  }

/**
     * Account_groups::delete_account_groups()
     * @return json
     */
  public function delete_account_groups($id){

    $data['admin_data'] = $this->checkAccess();
    $del = $this->Account_groups_model->delete($id);

    if($del){
      $result['message'] = $this->lang->line('account_group_delete_success');
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
