<?php class Check_access {
    var $ci;

    function __construct() {

    }

    function index()
    {
        $this->ci =& get_instance();
       
        $class = $this->ci->router->fetch_class();
        $method = $this->ci->router->fetch_method();
        $permission = false;
        if($class == 'Migrate' || $class == 'migrate')
        return true;
        
        $this->ci->db->where('controller',$class);//
        $this->ci->db->where('method',$method);
        $query = $this->ci->db->get('aauth_perms');
       
        if($query->num_rows()==1){//if permission is defined 
           $permission = strtolower($class.'_'.$method); 
        }
   
        if($this->ci->aauth->is_loggedin()){//user is logged in
            if($permission){//if permission is defined
              if(!in_array($permission, getUserPermissions())){//check if user has that permission
               if ($this->ci->input->is_ajax_request()){
                  $accept = explode(',',$_SERVER['HTTP_ACCEPT']);
                  if($accept[0] == 'application/json'){//return json response 
                     echo json_encode(array('status'=>0,'message'=>$this->ci->lang->line('access_denied')));
                     die();
                  }
                  else{//return html response for error
                     exit($this->ci->load->view('errors/access_denied', null, true));
                  }
                  
               }
               //redirect if not ajax
               show_error($this->ci->lang->line('access_denied'), 403, 'Forbidden 403');
               // redirect('auth/accessDenied'); 
             }  
           }
        }
    }
}