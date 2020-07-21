<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Discounts extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Datatables');
    $this->load->model('Discounts_model');
  }


  
 /**
     * Discounts::index()
     * @return json
     */

  function index(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data["title"] = "Settings";
    $data['setting_aside']=$this->load->view('settings/setting_aside', '', TRUE);
    $this->load->view('include/inner_header',$data);
    $this->load->view('discounts/discounts_listing',$data);
    $this->load->view('include/inner_footer',$data);

  }

   
 /**
     * Discounts::discounts_listing()
     * @return json
     */
  function discounts_listing(){
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();
    $this->datatables->select('discounts.discount_name,discounts.discount_percentage,discounts.created,discounts.discount_id')
    ->where('discounts.is_deleted',0)
    ->from('discounts');
    echo $this->datatables->generate();
  }

  /**
     * Discounts::add_discount()
     * @return json
     */
  public function add_discount(){

    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('discount_name','Discount Name','trim|required|xss_clean'); 
    $this->form_validation->set_rules('discount_percentage','Discount Percentage','trim|required|xss_clean');

    if($this->form_validation->run()){
      if($this->Discounts_model->add_discount()){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('discount_added_success');
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
     * Discounts::edit_discount()
     * @return json
     */
  function edit_discount($id){

    $data["admin_data"] = $this->checkAccess();

    $data["details"] = $this->Discounts_model->get_discount_details($id);
     
    $this->load->view('discounts/edit_discount',$data);
  }

 /**
     * Discounts::update_discount()
     * @return json
     */
  function update_discount($id){

    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('discount_name','Discount Name','trim|required|xss_clean'); 
    $this->form_validation->set_rules('discount_percentage','Discount Percentage','trim|required|xss_clean');
      if($this->form_validation->run()){
        if($this->Discounts_model->update_discount($id)){
          $result["status"] = 1;
          $result["message"] = $this->lang->line('discount_update_success');
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
     * Discounts::delete_discount()
     * @return json
     */
  public function delete_discount($id){

    $data['admin_data'] = $this->checkAccess();
    $del = $this->Discounts_model->delete($id);

    if($del){
      $result['message'] = $this->lang->line('discount_delete_success');
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
