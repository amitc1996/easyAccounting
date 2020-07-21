<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Permissions_model extends CI_Model
{   
  
  public function __construct()
  {
	    $this->load->database(); //LOADS THE DATABASE AND CREATES DATABASE OBJECT
     
   }
   /**
  * Permissions_model::list_groups()
  *
  * @return array
  */
   public function list_groups()
   {
    $this->db->select('aauth_groups.*,GROUP_CONCAT(aauth_perm_to_group.perm_id SEPARATOR ",") as perm',FALSE);
    $this->db->join('aauth_perm_to_group','aauth_groups.id = aauth_perm_to_group.group_id','LEFT');
    $this->db->group_by('aauth_groups.id');
    $query = $this->db->get('aauth_groups');
    
    return $query->result_array();
  }
   /**
  * Permissions_model::user_details()
  *
  * @return array
  */
  public function user_details($user_id)
  {
    $this->db->select('aauth_users.*,GROUP_CONCAT(aauth_perm_to_user.perm_id SEPARATOR ",") as perm',FALSE);
    $this->db->join('aauth_perm_to_user','aauth_users.id = aauth_perm_to_user.user_id','LEFT');
    $this->db->where('aauth_users.id',$user_id);
    $this->db->group_by('aauth_users.id');
    $query = $this->db->get('aauth_users');
    
    return $query->result_array();
  }
  
}