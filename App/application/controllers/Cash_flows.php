<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Cash_flows extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Datatables');
  }


  
/**
 * Cash_flows::index()
 * @return void
 */

  function index(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data["title"] = "Cash Flows";
    $this->load->view('include/inner_header',$data);
    $this->load->view('cash_flows/cash_flows_listing',$data);
    $this->load->view('include/inner_footer',$data);

  }

  /*
  * data for category datatable
  * @return json
  */
  function cash_flows_listig(){
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();
    
    $this->datatables->select('to_account_name,from_account_name,amount,cash_flow_id')
    ->from('cash_flows');
    echo $this->datatables->generate();
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
