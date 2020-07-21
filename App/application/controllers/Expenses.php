<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Expenses extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Datatables');
    $this->load->library('Common');
    $this->load->model('Expenses_model');
  }


  
 /**
     * Expenses::index()
     * @return void
     */
  function index(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data["title"] = "Expenses";
    $data["branches"] = $this->common->get_branches();
    $data["ledgers"] = $this->common->get_ledgers();
    $data["account_groups"] = $this->common->get_account_groups();
    $this->load->view('include/inner_header',$data);
    $this->load->view('expenses/expenses_listing',$data);
    $this->load->view('include/inner_footer',$data);

  }

  
 /**
     * Expenses::expenses_listing()
     * @return 
     */
  function expenses_listing(){
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();
    $this->datatables->select('expenses.from_account_name,expenses.to_account_name,expenses.amount,expenses.expense_date,expenses.created,expenses.expense_id')
    ->where('expenses.is_deleted',0)
    ->from('expenses');
    echo $this->datatables->generate();
  }

 /**
     * Expenses::add_expense()
     * @return json
     */
  public function add_expense(){
   
    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('branch','Branch','trim|required|xss_clean');
    $this->form_validation->set_rules('expense_date','Date','trim|required|xss_clean');
    $this->form_validation->set_rules('account_group','Account Group','trim|required|xss_clean');
    $this->form_validation->set_rules('ledger','To Ledger','trim|required|xss_clean');
    $this->form_validation->set_rules('amount','amount','trim|required|xss_clean');
    $this->form_validation->set_rules('payment_option','Payment Option','trim|required|xss_clean');
    if($this->form_validation->run()){
      if($this->Expenses_model->add_expense()){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('expense_added_success');
      }else{
        $result["status"] = 0;
        $result["message"] =  $this->lang->line('Error_occured');
      }
    }else{
      $result["status"] = 0;
      $result["message"] = validation_errors();
    }
    echo json_encode($result);
  }

 /**
     * Expenses::edit_expenses()
     * @return void
     */
  function edit_expenses($id){

     $data["admin_data"] = $this->checkAccess();
     $data["details"] = $this->Expenses_model->get_expense_details($id);
     $data["branches"] = $this->common->get_branches();
     $data["ledgers"] = $this->common->get_ledgers();
     $data["account_groups"] = $this->common->get_account_groups();
    
    $this->load->view('expenses/edit_expenses',$data);
  }
/**
     * Ledgers::update_account_group()
     * @return json
     */
  function update_expense($id){

    $data['admin_data'] = $this->checkAccess();
    $this->form_validation->set_rules('branch','Branch','trim|required|xss_clean');
    $this->form_validation->set_rules('expense_date','Date','trim|required|xss_clean');
    $this->form_validation->set_rules('account_group','Account Group','trim|required|xss_clean');
    $this->form_validation->set_rules('ledger','To Ledger','trim|required|xss_clean');
    $this->form_validation->set_rules('amount','amount','trim|required|xss_clean');
    $this->form_validation->set_rules('payment_option','Payment Option','trim|required|xss_clean');
      if($this->form_validation->run()){
        if($this->Expenses_model->update_expense($id)){
          $result["status"] = 1;
          $result["message"] = $this->lang->line('expense_update_success');
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
     * Expense::delete_expense()
     * @return json
     */
  public function delete_expense($id){

    $data['admin_data'] = $this->checkAccess();
    $del = $this->Expenses_model->delete($id);

    if($del){
      $result['message'] = $this->lang->line('expense_delete_success');
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
