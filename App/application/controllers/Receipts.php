<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Receipts extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Datatables');
    $this->load->library('Common');
    $this->load->model('Receipts_model'); 
  }


  
/**
 * Receipts::index()
 * @return void
 */

  function index(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data["title"] = "Receipts";
    $this->load->view('include/inner_header',$data);
    $this->load->view('receipts/receipts_listing',$data);
    $this->load->view('include/inner_footer',$data);

  }

  /*
  * data for category datatable
  * @return json
  */
  function receipts_listing(){
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();
    $this->datatables->select('receipt_number,to_account_name,from_account_name,receipt_date,for_transaction,amount,created,payment_id')
    ->from('receipts');
    echo $this->datatables->generate();
  }
 
  public function add_receipt(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data["title"] = "Payments";
    $data["branches"] = $this->common->get_branches();
    $data["ledgers"] = $this->common->get_ledgers();
    $data["account_groups"] = $this->common->get_account_groups();
    $data["receipt_number"] = $this->common->get_receipt_no();
    $this->load->view('include/inner_header',$data);
    $this->load->view('receipts/add_receipt',$data);
    $this->load->view('include/inner_footer',$data);
  }

    public function save_receipt(){
    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('branch','Branch','trim|required|xss_clean');
    $this->form_validation->set_rules('receipt_date','Receipt Date','trim|required|xss_clean');
    $this->form_validation->set_rules('to_account','To Account','trim|required|xss_clean');
    $this->form_validation->set_rules('from_account','From Account','trim|required|xss_clean');
    $this->form_validation->set_rules('amount','amount','trim|required|xss_clean');
    $this->form_validation->set_rules('payment_option','Payment Option','trim|required|xss_clean');
    if($this->form_validation->run()){
      if($resp=$this->Receipts_model->add_receipt()){
        if(is_array($resp)){
          if($resp['status']==0){
             $result["status"] = 0;
             $result["message"] = $resp['message'];
          }
        }
        else{
        $result["status"] = 1;
        $result["message"] = $this->lang->line('receipt_added_success');
        }
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
