<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Payments extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Datatables');
    $this->load->library('Common');
    $this->load->model('Payments_model');
  }


  
/**
 * Payments::index()
 * @return void
 */

  function index(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data["title"] = "Payments";
    $this->load->view('include/inner_header',$data);
    $this->load->view('payments/payments_listing',$data);
    $this->load->view('include/inner_footer',$data);

  }

  /*
  * data for category datatable
  * @return json
  */
  function payments_listing(){
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();

    $this->datatables->select('voucher_number,to_account_name,from_account_name,voucher_date,for_transaction,amount,created,payment_id')
    ->from('payments');
    echo $this->datatables->generate();
  }

  public function add_payment(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data["branches"] = $this->common->get_branches();
    $data["ledgers"] = $this->common->get_ledgers();
    $data["account_groups"] = $this->common->get_account_groups();
    $data["voucher_number"] = $this->common->get_voucher_no();
    $data["title"] = "Payments";
    $this->load->view('include/inner_header',$data);
    $this->load->view('payments/add_payment',$data);
    $this->load->view('include/inner_footer',$data);
  }

  public function save_payment(){
   
    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('branch','Branch','trim|required|xss_clean');
    $this->form_validation->set_rules('voucher_date','Voucher Date','trim|required|xss_clean');
    $this->form_validation->set_rules('to_account','To Account','trim|required|xss_clean');
    $this->form_validation->set_rules('from_account','From Account','trim|required|xss_clean');
    $this->form_validation->set_rules('amount','amount','trim|required|xss_clean');
    $this->form_validation->set_rules('payment_option','Payment Option','trim|required|xss_clean');
    if($this->form_validation->run()){
      if($resp=$this->Payments_model->add_payment()){
        if(is_array($resp)){
          if($resp['status']==0){
             $result["status"] = 0;
             $result["message"] = $resp['message'];
          }
        }
        else{
        $result["status"] = 1;
        $result["message"] = $this->lang->line('payment_added_success');
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
