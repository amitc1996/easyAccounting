<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Group_model extends CI_Model
{   
  
  public function __construct()
  {
   $this->load->database();
   
 }
 
    /**
     * Check groups
     * */

    public function check_group($name,$g_id = false)
    {
      $this->db->where('name',$name);
      if($g_id){
        $this->db->where('id <> ',$g_id);
      }
      $query = $this->db->get('aauth_groups');
      if($query->num_rows() > 0)
        return true;
      
      return false;
    }
    
     /**
     * Groups details
     * */

     public function group_details($g_id)
     {
      $this->db->where('id',$g_id);
      $query = $this->db->get('aauth_groups');
      if($query->num_rows() > 0)
        return $query->result_array();
      
      return false;
    } 

    /**
     * Groups details get
     * */

    public function get_details()
    {
      $this->db->select('*');
      $query = $this->db->get('aauth_groups');
      if($query->num_rows() > 0)
        return $query->result_array();
      
      return false;
    } 
    
  }