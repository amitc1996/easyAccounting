<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Wherehouses extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Datatables');
    $this->load->model('Wherehouses_model');
    $this->load->library('Common');
  }


  
   /**
     * Wherehouses::index()
     * @return json
     */
  function index(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data["title"] = "Settings";
    $data["branches"] = $this->common->get_branches();
    $data['setting_aside']=$this->load->view('settings/setting_aside', '', TRUE);

    $this->load->view('include/inner_header',$data);
    $this->load->view('wherehouses/wherehouses_listing',$data);
    $this->load->view('include/inner_footer',$data);

  }

 /**
     * Wherehouses::wherehouses_listing()
     * @return json
     */
  function wherehouses_listing(){
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();
    $this->datatables->select('branches.branch_name,wherehouses.wherehouse_name,wherehouses.created,wherehouses.wherehouse_id')
    ->join('branches','branches.branch_id = wherehouses.branch_id')
    ->where('wherehouses.is_deleted',0)
    ->from('wherehouses');
    echo $this->datatables->generate();
  }

/**
     * Wherehouses::add_wherehouse()
     * @return json
     */

  public function add_wherehouse(){

    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('branch','Branch Name','trim|required|xss_clean');
    $this->form_validation->set_rules('wherehouse_name','Wherehouse Name','trim|required|xss_clean|is_unique[wherehouses.wherehouse_name]');

    if($this->form_validation->run()){
      if($this->Wherehouses_model->add_wherehouse()){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('wherehouse_added_success');
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
     * Wherehouses::edit_wherehouse()
     * @return json
     */
  function edit_wherehouse($id){

    $data["admin_data"] = $this->checkAccess();
    $data["branches"] = $this->Wherehouses_model->get_branches();
    $data["details"] = $this->Wherehouses_model->get_wherehouse_details($id);
     
    $this->load->view('wherehouses/edit_wherehouse',$data);
  }

   /**
     * Wherehouses::update_wherehouse()
     * @return json
     */
  function update_wherehouse($id){

    $data['admin_data'] = $this->checkAccess();
    $unique = checkEditUnique($id,$this->input->post('wherehouse_name'),'wherehouses','wherehouse_name','wherehouse_id');

    if($unique){
      $this->form_validation->set_rules('branch','Branch Name','trim|required|xss_clean');
      $this->form_validation->set_rules('wherehouse_name','Wherehouse Name','trim|required|xss_clean');

      if($this->form_validation->run()){
        if($this->Wherehouses_model->update_wherehouse($id)){
          $result["status"] = 1;
          $result["message"] = $this->lang->line('wherehouse_update_success');
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
      $result["message"] = $this->lang->line('unique_wherehouse_name_error');
    }

    echo json_encode($result);
  }

 /**
     * Wherehouses::delete_wherehouse()
     * @return json
     */

  public function delete_wherehouse($id){

    $data['admin_data'] = $this->checkAccess();
    $del = $this->Wherehouses_model->delete($id);

    if($del){
      $result['message'] = $this->lang->line('wherehouse_delete_success');
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
