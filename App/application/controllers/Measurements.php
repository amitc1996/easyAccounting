<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Measurements extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Datatables');
    $this->load->model('Measurements_model');
  }


  
  /**
     *
     Measurements index
     * */

  function index(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
     $data["title"] = "Settings";
    $data['setting_aside']=$this->load->view('settings/setting_aside', '', TRUE);

    $this->load->view('include/inner_header',$data);
    $this->load->view('measurements/measurements_listing',$data);
    $this->load->view('include/inner_footer',$data);

  }

  /*
  * data for category datatable
  * @return json
  */
  function measurements_listing(){
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();
  
    $this->datatables->select('measurements.measurement_name,measurements.created,measurements.measurement_id')
    ->where('measurements.is_deleted',0)
    ->from('measurements');
    echo $this->datatables->generate();
  }

  /**
  * Add measurement
  * @return json
  */

  public function add_measurement(){

    $data["admin_data"] = $this->checkAccess();

    $this->form_validation->set_rules('measurement_name','Measurement Name','trim|required|xss_clean|is_unique[measurements.measurement_name]');

    if($this->form_validation->run()){
      if($this->Measurements_model->add_measurement()){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('measurement_added_success');
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
  * generate edit measurement form
  * @return void
  */
  function edit_measurement($id){

    $data["admin_data"] = $this->checkAccess();

    $data["details"] = $this->Measurements_model->get_measurement_details($id);
     
    $this->load->view('measurements/edit_measurement',$data);
  }

  /**
  * Edit measurement
  * @return json
  */
  function update_measurement($id){

    $data['admin_data'] = $this->checkAccess();
    $unique = checkEditUnique($id,$this->input->post('measurement_name'),'measurements','measurement_name','measurement_id');

    if($unique){
      $this->form_validation->set_rules('measurement_name','Measurement Name','trim|required|xss_clean');

      if($this->form_validation->run()){
        if($this->Measurements_model->update_measurement($id)){
          $result["status"] = 1;
          $result["message"] = $this->lang->line('measurement_update_success');
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
      $result["message"] = $this->lang->line('unique_measurment_name_error');
    }

    echo json_encode($result);
  }

  /**
  * Delete brand
  * @return json
  */

  public function delete_measurement($id){

    $data['admin_data'] = $this->checkAccess();
    $del = $this->Measurements_model->delete($id);

    if($del){
      $result['message'] = $this->lang->line('measurement_delete_success');
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
