<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permissions extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->helper('security');
        $this->load->library('Datatables');
        $this->load->library('Aauth');
        $this->load->library('form_validation');
        $this->load->model('permissions_model');
    }
    
    /**
     *
     Permissions index
     * */

    public function index()
    {

        $data["admin_data"] = $this->checkAccess(); 
        $data['permissions'] = getUserPermissions();

        $data['group_list']=$this->permissions_model->list_groups(); 
        $data['perm_list']=$this->aauth->list_perms();
        $data["title"] = "Permissions"; 

        $this->load->view('include/inner_header', $data);
        $this->load->view('permissions/permissions', $data);
        $this->load->view('include/inner_footer', $data);

    }

    // Add Permission

    public function addPermission($g_name,$p_name)
    {

        $data["admin_data"] = $this->checkAccess();

        if($insert_id = $this->aauth->allow_group($g_name,$p_name))
        {
            $result['status'] = 1;
        }
        else{
            $result['status'] = 0;
        }  

        echo json_encode($result);        
    }
    

    //Delete Permission

    public function deletePermission($g_name,$p_name)
    {
        $data["admin_data"] = $this->checkAccess();
        

        if($delet_id = $this->aauth->deny_group($g_name,$p_name))
        {    
            $result['status'] = 1;
        }
        else{
            $result['status'] = 0;
        }  

        echo json_encode($result);
    }
    
    //User listing with permission accessibility

    public function user_permission_listing()
    {
        $data["admin_data"] = $this->checkAccess();
        
        $logged_in_user_id=$this->aauth->get_user_id();
        $_POST['sColumns'] = '';
        $this->datatables->select('email,username,id')
        ->where('banned',0)
        ->where('id <> ',$logged_in_user_id)
        ->where('id <> ',1)
        ->from('aauth_users');
        echo $this->datatables->generate();
    }
    
   //Individual User Permission

    public function users_permission($user_id)
    {
        // if(($user_id == '')||($user_id == 1)||($this->aauth->is_banned($user_id))||(!$this->aauth->get_user($user_id))||($user_id == $this->aauth->get_user_id()))
        //     {
        //     redirect('permissions');
        //     }

        $data["admin_data"] = $this->checkAccess();       
        $data['permissions'] = getUserPermissions();       
        $data['user_details'] = $this->permissions_model->user_details($user_id);
        $data['perm_list']=$this->aauth->list_perms();
        $data["title"] = "Users Permissions";
        $this->load->view('include/inner_header', $data);
        $this->load->view('permissions/user_permissions', $data);
        $this->load->view('include/inner_footer', $data);
    }
    
   //Individual user add Permission

    public function addUserPermission($u_id,$p_name){

        $data["admin_data"] = $this->checkAccess();
        
        if($insert_id = $this->aauth->allow_user($u_id,$p_name))
        {
            $result['status'] = 1;
        }
        else{
            $result['status'] = 0;
        }  

        echo json_encode($result);
        
    }
    
    //Delete individual user permission

    public function deleteUserPermission($u_id,$p_name)
    {
        $data["admin_data"] = $this->checkAccess();
        
        
        if($delet_id = $this->aauth->deny_user($u_id,$p_name))
        {    
            $result['status'] = 1;
        }
        else{
            $result['status'] = 0;
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