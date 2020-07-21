<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Categories extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Datatables');
    $this->load->model('Categories_model');
  }


  
 /**
     * Categories::index()
     * @return void
     */
  function index(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data["title"] = "Settings";
    $data['setting_aside']=$this->load->view('settings/setting_aside', '', TRUE);
    $this->load->view('include/inner_header',$data);
    $this->load->view('categories/categories_listing',$data);
    $this->load->view('include/inner_footer',$data);

  }

  
 /**
     * Categories::add_category()
     * @return json
     */
  function categories_listing(){
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();
    $this->datatables->select('categories.category_name,categories.category_id,categories.created')
    ->where('categories.is_deleted',0)
    ->from('categories');
    echo $this->datatables->generate();
  }

 /**
     * Categories::add_category()
     * @return json
     */
  public function add_category(){

    $data["admin_data"] = $this->checkAccess();

    $this->form_validation->set_rules('category_name','Category Name','trim|required|xss_clean|is_unique[categories.category_name]');

    if($this->form_validation->run()){
      if($this->Categories_model->add_category()){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('category_added_success');
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
     * Categories::edit_category()
     * @return void
     */
  function edit_category($id){

    $data["admin_data"] = $this->checkAccess();

    $data["details"] = $this->Categories_model->get_category_details($id);

    $this->load->view('categories/edit_category',$data);
  }
/**
     * Categories::update_category()
     * @return json
     */
  function update_category($id){

    $data['admin_data'] = $this->checkAccess();
    $unique = checkEditUnique($id,$this->input->post('category_name'),'categories','category_name','category_id');

    if($unique){
      $this->form_validation->set_rules('category_name','Category Name','trim|required|xss_clean');

      if($this->form_validation->run()){
        if($this->Categories_model->update_category($id)){
          $result["status"] = 1;
          $result["message"] = $this->lang->line('category_update_success');
        }else{
          $result["status"] = 0;
          $result["message"] =  $this->lang->line('Error_occured');
        }
      }else{
        $result["status"] = 0;
        $result["message"] = validation_errors();
      }
    }else {
      $result["status"] = 0;
      $result["message"] = $this->lang->line('unique_category_name_error');
    }

    echo json_encode($result);
  }

/**
     * Categories::delete_category()
     * @return json
     */
  public function delete_category($id){

    $data['admin_data'] = $this->checkAccess();
    $del = $this->Categories_model->delete($id);

    if($del){
      $result['message'] = $this->lang->line('category_delete_success');
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
