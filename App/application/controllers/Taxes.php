<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Taxes extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Datatables');
    $this->load->model('Taxes_model');
  }


  
 /**
     * Taxes::index()
     * @return json
     */

  function index(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data["title"] = "Settings";
    $data['setting_aside']=$this->load->view('settings/setting_aside', '', TRUE);
    $this->load->view('include/inner_header',$data);
    $this->load->view('taxes/taxes_listing',$data);
    $this->load->view('include/inner_footer',$data);

  }

  /**
     * Taxes::taxes_listing()
     * @return json
     */
  function taxes_listing(){
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();
    $this->datatables->select('taxes.tax_name,taxes.tax_percentage,taxes.created,taxes.tax_id')
    ->where('taxes.is_deleted',0)
    ->from('taxes');
    echo $this->datatables->generate();
  }

  /**
     * Taxes::add_tax()
     * @return json
     */
  public function add_tax(){

    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('tax_name','Tax Name','trim|required|xss_clean'); 
    $this->form_validation->set_rules('tax_percentage','Tax Percentage','trim|required|xss_clean');

    if($this->form_validation->run()){
      if($this->Taxes_model->add_tax()){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('tax_added_success');
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
     * Taxes::add_tax_group()
     * @return json
     */
  public function add_tax_group(){
   $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('group_name','Tax Name','trim|required|xss_clean'); 
    if($this->form_validation->run()){
      if($this->Taxes_model->add_tax_group()){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('tax_added_success');
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
     * Taxes::edit_tax()
     * @return void
     */
  function edit_tax($id){

    $data["admin_data"] = $this->checkAccess();

    $data["details"] = $this->Taxes_model->get_tax_details($id);
     
    $this->load->view('taxes/edit_tax',$data);
  }

 /**
     * Taxes::update_tax()
     * @return void
     */
  function update_tax($id){

    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('tax_name','Tax Name','trim|required|xss_clean'); 
    $this->form_validation->set_rules('tax_percentage','Tax Percentage','trim|required|xss_clean');
      if($this->form_validation->run()){
        if($this->Taxes_model->update_tax($id)){
          $result["status"] = 1;
          $result["message"] = $this->lang->line('tax_update_success');
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
     * Taxes::update_group_tax()
     * @return void
     */
  function update_group_tax($id){
   $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('group_name','Tax Name','trim|required|xss_clean'); 
      if($this->form_validation->run()){
        if($this->Taxes_model->update_group_tax($id)){
          $result["status"] = 1;
          $result["message"] = $this->lang->line('tax_update_success');
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
     * Taxes::delete_tax()
     * @return void
     */

  public function delete_tax($id){

    $data['admin_data'] = $this->checkAccess();
    $del = $this->Taxes_model->delete($id);

    if($del){
      $result['message'] = $this->lang->line('tax_delete_success');
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
