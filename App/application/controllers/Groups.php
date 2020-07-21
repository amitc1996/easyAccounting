<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->library('Datatables');
        $this->load->library('Aauth');
        $this->load->library('form_validation');
        $this->load->model('group_model');
    }
    

    /**
     * 
     Group index
     * */

     public function index()
     {
        $data["admin_data"] = $this->checkAccess();
        $data['permissions'] = getUserPermissions();
        $data["title"] = "Groups";
        $this->load->view('include/inner_header', $data);
        $this->load->view('groups/group_listing', $data);
        $this->load->view('include/inner_footer', $data);
    }
    
    /**
    * Load emaillists list for datatable
    *
    * @return json
    */
    public function group_listing()
    {
        $_POST['sColumns'] = '';
        $data["admin_data"] = $this->checkAccess();   
        $looged_in_user_id=$this->aauth->get_user_id();

        $this->datatables->select('name, definition, id')->from(' aauth_groups');
        echo $this->datatables->generate();
    }
    

   /**
     * addGroup
     * */

   public function addGroup(){

    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('name','Name','trim|required|xss_clean');

    if($this->form_validation->run()){

        if(!$this->group_model->check_group($this->input->post('name')))
        {
         if($insert_id = $this->aauth->create_group($this->input->post('name'))
         {
            $result = array('status'=>1,'message'=>$this->lang->line('group_successfully_added'));
        }
        else
        {
            $result = array('status'=>0,'message'=> $this->lang->line('error_occured'));
        } 
    }
    else{
        $result = array('status'=>0,'message'=> $this->lang->line('group_name_exist'));
    }
}
else{
    $result = array('status'=>0,'message'=>validation_errors());
}
echo json_encode($result);
}
     /**
     * delete group
     * */

     public function deleteGroup($g_id)
     {
        $data["admin_data"] = $this->checkAccess();
        
        if($request = $this->aauth->delete_group($g_id)){

            $result = array('status'=>1,'message'=>$this->lang->line('group_successfully_deleted'));
        }
        else{
            $result = array('status'=>0,'message'=> $this->lang->line('error_occured'));
        }  

        echo json_encode($result);
    }
     /**
     * edit group
     * */
     public function editGroup($g_id)
     {

      $data["admin_data"] = $this->checkAccess();
      $data['permissions'] = getUserPermissions();
      $data["details"] = $this->group_model->group_details($g_id);
      $this->load->view('groups/edit_group',$data);

  }

     /**
     * update group
     * */
     public function updateGroup()
     {
      $data["admin_data"] = $this->checkAccess();


      $this->form_validation->set_rules('edit_name', 'Name', 'required|trim|xss_clean');

      $data['g_id'] = $this->input->post('g_id');
      $data['edit_name'] = $this->input->post('edit_name');
      $data['edit_definition'] = $this->input->post('edit_definition');

      if ($this->form_validation->run()) 
      {

        if(!$this->group_model->check_group($this->input->post('edit_name'),$data['g_id']))
          {
            if($data = $this->aauth->update_group($data['g_id'],$data['edit_name'],$data['edit_definition']))
            {
                $result["status"] = 1;
                $result["message"] = $this->lang->line('group_successfully_updated');
            }else
            {
                $result["status"] = 0;
                $result["message"] =  $this->lang->line('error_occured');
            }
        }  
        else{
            $result = array('status'=>0,'message'=> $this->lang->line('group_name_exist'));

        }
    }
    else
    {
        $result["status"] = 0;
        $result["message"] = validation_errors();
    }
    echo json_encode($result);
}


/** Verify if user is logged in and is admin (for direct requests)
   * @param void
   * @return mixed
   */
private function checkAccess()
{  
 if($this->aauth->is_loggedin())
 {
    return  $this->session->all_userdata();
}
else
{
    redirect('auth'); 
    die();
}
}


}
?>
