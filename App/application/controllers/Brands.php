<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Brands extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Datatables');
    $this->load->model('Brands_model');
  }


  
  /**
  * Brands::index()
  *
  * @return bool
  */

  function index(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
     $data["title"] = "Settings";
     $data['setting_aside']=$this->load->view('settings/setting_aside', '', TRUE);

    $this->load->view('include/inner_header',$data);
    $this->load->view('brands/brands_listing',$data);
    $this->load->view('include/inner_footer',$data);

  }

    
  /**
  * Brands::brands_listing()
  *
  * @return bool
  */
  function brands_listing(){
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();
    
    $this->datatables->select('brands.brand_name,brands.created,brands.brand_id')
    ->where('brands.is_deleted',0)
    ->from('brands');
    echo $this->datatables->generate();
  }

   
  /**
  * Brands::add_brand()
  *
  * @return bool
  */

  public function add_brand(){

    $data["admin_data"] = $this->checkAccess();

    $this->form_validation->set_rules('brand_name','Brand Name','trim|required|xss_clean|is_unique[brands.brand_name]');

    if($this->form_validation->run()){
      if($this->Brands_model->add_brand()){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('brand_added_success');
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
  * Brands::edit_brand()
  *
  * @return bool
  */

  function edit_brand($id){

    $data["admin_data"] = $this->checkAccess();

    $data["details"] = $this->Brands_model->get_brand_details($id);
     
    $this->load->view('brands/edit_brand',$data);
  }

   /**
  * Brands::update_brand()
  *
  * @return bool
  */
  function update_brand($id){

    $data['admin_data'] = $this->checkAccess();
    $unique = checkEditUnique($id,$this->input->post('brand_name'),'brands','brand_name','brand_id');

    if($unique){
      $this->form_validation->set_rules('brand_name','Brand Name','trim|required|xss_clean');

      if($this->form_validation->run()){
        if($this->Brands_model->update_brand($id)){
          $result["status"] = 1;
          $result["message"] = $this->lang->line('brand_update_success');
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
      $result["message"] = $this->lang->line('unique_brand_name_error');
    }

    echo json_encode($result);
  }

   /**
  * Brands::delete_brand()
  * @return bool
  */

  public function delete_brand($id){

    $data['admin_data'] = $this->checkAccess();
    $del = $this->Brands_model->delete($id);

    if($del){
      $result['message'] = $this->lang->line('brand_delete_success');
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
