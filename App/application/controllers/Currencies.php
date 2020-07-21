<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Currencies extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Datatables');
    $this->load->model('Currencies_model');
  }


  
 /**
     * Currencies::index()
     * @return json
     */

  function index(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data["title"] = "Settings";
    $data['setting_aside']=$this->load->view('settings/setting_aside', '', TRUE);
    $this->load->view('include/inner_header',$data);
    $this->load->view('currencies/currencies_listing',$data);
    $this->load->view('include/inner_footer',$data);

  }

  /**
     * Currencies::currencies_listing()
     * @return json
     */
  function currencies_listing(){
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();

    $this->datatables->select('currencies.currency_code,currencies.currency_symbol,currencies.created,currencies.currency_id')
    ->where('currencies.is_deleted',0)
    ->from('currencies');
    echo $this->datatables->generate();
  }

  /**
     * Currencies::add_currency()
     * @return json
     */
  public function add_currency(){
    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('currency_code','Currency Code','trim|required|xss_clean'); 
    $this->form_validation->set_rules('currency_symbol','Currency Symbol','trim|required|xss_clean');

    if($this->form_validation->run()){
      if($this->Currencies_model->add_currency()){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('currency_added_success');
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
     * Currencies::edit_currency()
     * @return void
     */
  function edit_currency($id){

    $data["admin_data"] = $this->checkAccess();

    $data["details"] = $this->Currencies_model->get_currency_details($id);
     
    $this->load->view('currencies/edit_currency',$data);
  }

 /**
     * Currencies::update_currency()
     * @return void
     */
  function update_currency($id){

    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('currency_code','Currency Code','trim|required|xss_clean'); 
    $this->form_validation->set_rules('currency_symbol','Currency Symbol','trim|required|xss_clean');
      if($this->form_validation->run()){
        if($this->Currencies_model->update_currency($id)){
          $result["status"] = 1;
          $result["message"] = $this->lang->line('currency_update_success');
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
     * Currency::delete_currency()
     * @return void
     */

  public function delete_currency($id){

    $data['admin_data'] = $this->checkAccess();
    $del = $this->Currencies_model->delete($id);

    if($del){
      $result['message'] = $this->lang->line('currency_delete_success');
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
