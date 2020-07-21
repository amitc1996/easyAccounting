<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Suppliers extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Datatables');
    $this->load->library('Common');
    $this->load->model('Suppliers_model');
  }
   
/**
     * Suppliers::index()
     * @return void
     */

  function index(){

    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data['title'] = 'Suppliers';
    $this->load->view('include/inner_header',$data);
    $this->load->view('suppliers/suppliers_listing',$data);
    $this->load->view('include/inner_footer',$data);

  }

 /**
     * Suppliers::suppliers_listing()
     * @return json
     */
  function suppliers_listing(){
    $_POST['sColumns'] = '';
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();
    $this->datatables->select('suppliers.supplier_orgnisation_name,suppliers.supplier_orgnisation_phone,suppliers.supplier_name,suppliers.supplier_email,suppliers.created,suppliers.supplier_id')
    ->where('suppliers.is_deleted',0)
    ->from('suppliers');
    echo $this->datatables->generate();
  }

 /**
     * Suppliers::add_supplier()
     * @return json
     */
  public function add_supplier(){
    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('supplier_orgnisation_name','Supplier Orgnisation Name','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_orgnisation_phone','Supplier Phone','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_mobile','Supplier mobile','trim|xss_clean');

    $this->form_validation->set_rules('supplier_email','Supplier email','trim|xss_clean');
    $this->form_validation->set_rules('supplier_name','Supplier name','trim|required|xss_clean');

    $this->form_validation->set_rules('gstin','GSTIN','trim|xss_clean');
    $this->form_validation->set_rules('supplier_tax_number','Client Service Tax Number','trim|xss_clean');

   $this->form_validation->set_rules('supplier_address_b','Supplier billing address','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_city_b','Supplier billing city','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_state_b','Supplier billing state','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_country_b','Supplier billing country','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_zip_b','Supplier billing zip','trim|required|xss_clean');

    $this->form_validation->set_rules('supplier_address_s','Supplier shipping address','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_city_s','Supplier shipping city','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_state_s','Supplier shipping state','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_country_s','Supplier shipping country','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_zip_s','Supplier shipping zip','trim|required|xss_clean');

    if($this->form_validation->run()){
      if($this->Suppliers_model->add_supplier()){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('supplier_added_success');
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
     * Suppliers::edit_supplier()
     * @return json
     */
  function edit_supplier($id){

    $data["admin_data"] = $this->checkAccess();
    $data["details"] = $this->Suppliers_model->get_supplier_details($id);

    $this->load->view('suppliers/edit_supplier',$data);
  }

 /**
     * Suppliers::update_supplier()
     * @return json
     */
  function update_supplier($id){

  $data['admin_data'] = $this->checkAccess();

  $this->form_validation->set_rules('supplier_orgnisation_name','Supplier Orgnisation Name','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_orgnisation_phone','Supplier Phone','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_mobile','Supplier mobile','trim|xss_clean');

    $this->form_validation->set_rules('supplier_email','Supplier email','trim|xss_clean');
    $this->form_validation->set_rules('supplier_name','Supplier name','trim|required|xss_clean');

    $this->form_validation->set_rules('gstin','GSTIN','trim|xss_clean');
    $this->form_validation->set_rules('supplier_tax_number','Client Service Tax Number','trim|xss_clean');

   $this->form_validation->set_rules('supplier_address_b','Supplier billing address','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_city_b','Supplier billing city','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_state_b','Supplier billing state','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_country_b','Supplier billing country','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_zip_b','Supplier billing zip','trim|required|xss_clean');

    $this->form_validation->set_rules('supplier_address_s','Supplier shipping address','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_city_s','Supplier shipping city','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_state_s','Supplier shipping state','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_country_s','Supplier shipping country','trim|required|xss_clean');
    $this->form_validation->set_rules('supplier_zip_s','Supplier shipping zip','trim|required|xss_clean');

      if($this->form_validation->run()){
        if($this->Suppliers_model->update_supplier($id)){
          $result["status"] = 1;
          $result["message"] = $this->lang->line('supplier_update_success');
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
     * Suppliers::delete_supplier()
     * @return json
     */
  public function delete_supplier($id){

    $data['admin_data'] = $this->checkAccess();
    $del = $this->Suppliers_model->delete_supplier($id);

    if($del){
      $result['message'] = $this->lang->line('supplier_delete_success');
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
