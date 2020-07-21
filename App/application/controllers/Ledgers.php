<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Ledgers extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Datatables');
    $this->load->library('Common');
    $this->load->model('Ledgers_model');
  }


  
 /**
     * Ledgers::index()
     * @return void
     */
  function index(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data["title"] = "Ledgers";
    $data["account_groups"] = $this->common->get_account_groups();
    $this->load->view('include/inner_header',$data);
    $this->load->view('leadgers/leadgers_listing',$data);
    $this->load->view('include/inner_footer',$data);

  }

  
 /**
     * Ledgers::account_group_listing()
     * @return 
     */
  function leadgers_listing(){
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();
    
    $this->datatables->select('leadgers.leadger_name,account_groups.group_name,leadgers.opening_balance,leadgers.closing_balance,leadgers.created,leadgers.leadger_id')
     ->join('account_groups','account_groups.account_group_id = leadgers.account_group_id')
    ->where('leadgers.is_deleted',0)
    ->from('leadgers');
    echo $this->datatables->generate();
  }

 /**
     * Ledgers::add_ledger()
     * @return json
     */
  public function add_ledger(){

    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('leadger_name','Ledger Name','trim|required|xss_clean|is_unique[leadgers.leadger_name]');
    $this->form_validation->set_rules('account_group','Account Group','trim|required|xss_clean');
    $this->form_validation->set_rules('opening_balance','Opening Balance','trim|required|xss_clean');
    $this->form_validation->set_rules('closing_balance','Closing Balance','trim|required|xss_clean');
    if($this->form_validation->run()){
      if($this->Ledgers_model->add_ledger()){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('ledger_added_success');
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
     * Ledgers::edit_ledger()
     * @return void
     */
  function edit_ledger($id){

     $data["admin_data"] = $this->checkAccess();
     $data["details"] = $this->Ledgers_model->get_ledger_details($id);
     $data["account_groups"] = $this->common->get_account_groups();
    
    $this->load->view('leadgers/edit_leadger',$data);
  }
/**
     * Ledgers::update_account_group()
     * @return json
     */
  function update_ledger($id){

    $data['admin_data'] = $this->checkAccess();
    $unique = checkEditUnique($id,$this->input->post('leadger_name'),'leadgers','leadger_name','leadger_id');
    if($unique){
    $this->form_validation->set_rules('leadger_name','Ledger Name','trim|required|xss_clean');
     $this->form_validation->set_rules('account_group','Account Group','trim|required|xss_clean');
    $this->form_validation->set_rules('opening_balance','Opening Balance','trim|required|xss_clean');
    $this->form_validation->set_rules('closing_balance','Closing Balance','trim|required|xss_clean');
      if($this->form_validation->run()){
        if($this->Ledgers_model->update_ledger($id)){
          $result["status"] = 1;
          $result["message"] = $this->lang->line('ledger_update_success');
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
      $result["message"] = $this->lang->line('ledger_unique_error');
    }

    echo json_encode($result);
  }

/**
     * Ledgers::delete_ledger()
     * @return json
     */
  public function delete_ledger($id){

    $data['admin_data'] = $this->checkAccess();
    $del = $this->Ledgers_model->delete($id);

    if($del){
      $result['message'] = $this->lang->line('ledger_delete_success');
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
