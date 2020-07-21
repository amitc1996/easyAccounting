<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Staff_model extends CI_Model
{   
    
    public function __construct()
	   {
	   $this->load->database(); //LOADS THE DATABASE AND CREATES DATABASE OBJECT
    // config/aauth.php
		$this->config_vars = $this->config->item('aauth');
	  }

      /**
      * Check staff username 
      * */
          
        public function check_Staff_email($email,$uid='')
        {
        $this->db->where('email ',$email);
        if($uid){
                  $this->db->where('id !=',$uid);          
        }
        $this->db->where('is_deleted',0);
        $query = $this->db->get('aauth_users');
        if($query->num_rows() > 0){
        return true;
        }
        return false;
      } 

      /**
       * Check staff username 
     * */

        public function check_Staff_username($username,$uid='')
        {
        $this->db->where('username ',$username);
        if($uid){
                  $this->db->where('id !=',$uid);
        }
        $this->db->where('is_deleted',0);
        $query = $this->db->get('aauth_users');
        if($query->num_rows() > 0){
        return true;
        }
        return false;
      } 

    /**
     * Staff_model::add_user()
     * 
     * @return
     */
    public function add_user(){
        $data = array(
            "first_name"=>$this->input->post("first_name"),
            "last_name"=>$this->input->post("last_name"),
            "username"=>$this->input->post("username"),
            "email"     =>$this->input->post("email"),
            "date_created" => date('Y-m-d H:i:s',time()),
        );
       /*        $email = $this->input->post("email");*/
        $insert_user = $this->db->insert('aauth_users', $data);
        if($insert_user){
        $user_id = $this->db->insert_id(); 
        $groups = $this->input->post("user_groups");
        $userGroups = array();
        foreach($groups as $group_id){
           array_push($userGroups,array(
                    'group_id' => $group_id,
                    'user_id' => $user_id,
                    ));
            }
        $salt = md5($user_id);
        $update['pass'] = hash($this->config_vars['hash'], $salt.$this->input->post("password"));
        //insert user password
        $this->db->where('id',$user_id);
        $this->db->update('aauth_users',$update);
        //insert user groups 
        $insert_group = $this->db->insert_batch('aauth_user_to_group', $userGroups);
      
          return true;
        }
        else{
          return false;
        }
    }

    /**
     * update user ()
     * */
    public function update_user($uid){
        $data = array(
        "first_name"=>$this->input->post("first_name"),
        "last_name"=>$this->input->post("last_name"),
        "username"=>$this->input->post("username"),
        "email"     =>$this->input->post("email"),
        );
        $this->db->where('email',$data['email']); 
        $this->db->where('id !=',$uid);
        $this->db->where('is_deleted',0); 
        $query =$this->db->get('aauth_users'); 
        if($query->num_rows()> 0){
              return false;
            }
            else{
         $this->db->where('id',$uid);       
        $update_user = $this->db->update('aauth_users', $data);
       
        if($update_user){
        $user_id = $uid;
     $groups = $this->input->post("user_groups");
        $userGroups = array();
        foreach($groups as $group_id){
           array_push($userGroups,array(
                    'group_id' => $group_id,
                    'user_id' => $user_id,
                    ));
            }
        
    $this->db->where('user_id',$user_id);
        $this->db->delete('aauth_user_to_group');
        $update_group = $this->db->insert_batch('aauth_user_to_group', $userGroups);

          return true;
        }
        else{
          return false;
        }
        }
    }

    /**
     * Get user details
     * @param int 
     * @return array()
     * */
       public function get_user_details($uid)
        {
    
            $this->db->select('*');
            $this->db->from('aauth_users');
            $this->db->where('id',$uid);
            $query = $this->db->get();
            $row = $query->result_array();
            return  $row;
         }
    /**
     * get user groups ()
     * */
    public function get_user_groups($uid)
     {
            $this->db->select('aauth_groups.name,aauth_groups.id as group_id');
            $this->db->from('aauth_groups');
            $this->db->join('aauth_user_to_group','aauth_user_to_group.group_id=aauth_groups.id');
            $this->db->where('aauth_user_to_group.user_id',$uid);
            $query = $this->db->get();
            if($query->num_rows()> 0){
             return  $query->result_array();
            }
            else{
                return false;
            }
      }

   /**
     * Staff_model::delete()
     * 
     * @param mixed $uid
     * @return
     */
    public function delete($uid)
    {
        $data =array(
          "is_deleted" => 1,
          "banned"=>1,
          "deleted_by" => $this->aauth->get_user_id(),
          "deleted_on" => date('Y-m-d H:i:s',time())
        );
        $this->db->where('id', $uid);
        $result = $this->db->update('aauth_users',$data); 

        if($result)
        {
            $this->db->where('user_id', $uid);
            $this->db->delete('aauth_user_to_group');
            return true; 
        } 
        else
        {
          return false; 
        }
    } 
    
    /**
     * update user password ()
     * */
    
    public function update_password($uid)
    {

        $salt = md5($uid);
	    	$update['pass'] = hash($this->config_vars['hash'], $salt.$this->input->post("password"));
        //insert user password
        $this->db->where('id',$uid);
        if($this->db->update('aauth_users',$update))
        {
        return true;
        }
        else{

        return false;
        }    
    }
  
}