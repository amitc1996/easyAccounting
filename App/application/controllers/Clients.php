<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Clients extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Datatables');
    $this->load->model('Clients_model');
    $this->load->library('Common');
  }
   
  /**
     * Clients::index()
     * @return void
     */
  function index(){

    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data['title'] = 'Clients';
    $this->load->view('include/inner_header',$data);
    $this->load->view('clients/clients_listing',$data);
    $this->load->view('include/inner_footer',$data);
  }

  /**
     * Clients::clients_listing()
     * @return json
     */
  function clients_listing(){
    $_POST['sColumns'] = '';
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();
    $this->datatables->select('clients.client_orgnisation_name,clients.client_orgnisation_phone,clients.client_name,clients.client_email,clients.created,clients.client_id')
    ->where('clients.is_deleted',0)
    ->from('clients');
    echo $this->datatables->generate();
  }

  /**
     * Clients::add_client()
     * @return json
     */

  public function add_client(){
  
    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('client_orgnisation_name','Company Name','trim|required|xss_clean');
    $this->form_validation->set_rules('client_orgnisation_phone','Company Phone','trim|xss_clean');
    $this->form_validation->set_rules('client_mobile','Client mobile','trim|xss_clean');
    $this->form_validation->set_rules('client_email','Client email','trim|xss_clean');
    $this->form_validation->set_rules('client_name','Client name','trim|xss_clean');
    
    $this->form_validation->set_rules('gstin','GSTIN','trim|xss_clean');
    $this->form_validation->set_rules('client_tax_number','Client Service Tax Number','trim|xss_clean');

    $this->form_validation->set_rules('client_address_b','Client billing address','trim|required|xss_clean');
    $this->form_validation->set_rules('client_city_b','Client billing city','trim|required|xss_clean');
    $this->form_validation->set_rules('client_state_b','Client billing state','trim|required|xss_clean');
    $this->form_validation->set_rules('client_country_b','Client billing country','trim|required|xss_clean');
    $this->form_validation->set_rules('client_zip_b','Client billing zip','trim|xss_clean');

    $this->form_validation->set_rules('client_address_s','Client shipping address','trim|required|xss_clean');
    $this->form_validation->set_rules('client_city_s','Client shipping city','trim|required|xss_clean');
    $this->form_validation->set_rules('client_state_s','Client shipping state','trim|required|xss_clean');
    $this->form_validation->set_rules('client_country_s','Client shipping country','trim|required|xss_clean');
    $this->form_validation->set_rules('client_zip_s','Client shipping zip','trim|xss_clean');


    if($this->form_validation->run()){
      if($this->Clients_model->add_client()){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('client_add_success');
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
     * Clients::view_client()
     * @return void
     */
  public function view_client($id){

    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data['title'] = 'View Client';
    $data["details"] = $this->Clients_model->get_clients_details($id);
    $this->load->view('include/inner_header',$data);
    $this->load->view('clients/view_client',$data);
    $this->load->view('include/inner_footer',$data);
  }


   /**
   * Clients::edit_client()
   * @return json
   */
  function edit_client($id){

    $data["admin_data"] = $this->checkAccess();
    $data["details"] = $this->Clients_model->get_clients_details($id);

    $this->load->view('clients/edit_client',$data);
  }

  /**
   * Clients::update_client()
   * @return json
   */
  function update_client($id){

    $data['admin_data'] = $this->checkAccess();
    $this->form_validation->set_rules('client_orgnisation_name','Company Name','trim|required|xss_clean');
    $this->form_validation->set_rules('client_orgnisation_phone','Company Phone','trim|xss_clean');
    $this->form_validation->set_rules('client_mobile','Client mobile','trim|xss_clean');
    $this->form_validation->set_rules('client_email','Client email','trim|xss_clean');
    $this->form_validation->set_rules('client_name','Client name','trim|xss_clean');
    
    $this->form_validation->set_rules('gstin','GSTIN','trim|xss_clean');
    $this->form_validation->set_rules('client_tax_number','Client Service Tax Number','trim|xss_clean');

    $this->form_validation->set_rules('client_address_b','Client billing address','trim|required|xss_clean');
    $this->form_validation->set_rules('client_city_b','Client billing city','trim|required|xss_clean');
    $this->form_validation->set_rules('client_state_b','Client billing state','trim|required|xss_clean');
    $this->form_validation->set_rules('client_country_b','Client billing country','trim|required|xss_clean');
    $this->form_validation->set_rules('client_zip_b','Client billing zip','trim|xss_clean');

    $this->form_validation->set_rules('client_address_s','Client shipping address','trim|required|xss_clean');
    $this->form_validation->set_rules('client_city_s','Client shipping city','trim|required|xss_clean');
    $this->form_validation->set_rules('client_state_s','Client shipping state','trim|required|xss_clean');
    $this->form_validation->set_rules('client_country_s','Client shipping country','trim|required|xss_clean');
    $this->form_validation->set_rules('client_zip_s','Client shipping zip','trim|xss_clean');
    
      if($this->form_validation->run()){
        if($this->Clients_model->update_client($id)){
          $result["status"] = 1;
          $result["message"] = $this->lang->line('client_update_success');
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
   * Clients::delete_client()
   * @return json
   */

  public function delete_client($id){

    $data['admin_data'] = $this->checkAccess();
    $del = $this->Clients_model->delete_client($id);

    if($del){
      $result['message'] = $this->lang->line('client_delete_success');
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
