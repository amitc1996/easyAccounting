<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class  Branches_model extends CI_Model{

  public function __construct(){

    $this->load->database();
  }

  /**
  * Branches_model::add_branch()
  *
  * @return bool
  */
  public function add_branch(){

    
    $data = array(
      "branch_name"=>$this->input->post("branch_name"),
      "branch_phone"=>$this->input->post("branch_phone"),
      "branch_email"=>$this->input->post("branch_email"),
      "branch_address"=>$this->input->post("branch_address"),
      "branch_city"=>$this->input->post("branch_city"),
      "branch_state"=>$this->input->post("branch_state"),
      "branch_country"=>$this->input->post("branch_country"),
      "branch_zip"=>$this->input->post("branch_zip"),
      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );

    $res = $this->db->insert('branches', $data);

    if($res) return true;
    return false;
  }


  /**
  * Get get_branch_details 
  * @param int
  * @return array()
  * */
  public function get_branch_details($id)
  {
    $this->db->select('*');
    $this->db->from('branches');
    $this->db->where('branch_id',$id);
    $query = $this->db->get();
    $row = $query->result_array();
    return  $row;
  }

  /**
  * update_branch 
  * @param int
  * @return bool
  * */
  public function update_branch($id){
    $data = array(
      "branch_name"=>$this->input->post("branch_name"),
      "branch_phone"=>$this->input->post("branch_phone"),
      "branch_email"=>$this->input->post("branch_email"),
      "branch_address"=>$this->input->post("branch_address"),
      "branch_city"=>$this->input->post("branch_city"),
      "branch_state"=>$this->input->post("branch_state"),
      "branch_country"=>$this->input->post("branch_country"),
      "branch_zip"=>$this->input->post("branch_zip"),
      "last_updated"=> date('Y-m-d H:i:s',time())
    );
    $this->db->where('branch_id',$id);
    $this->db->where('is_deleted',0);
    $res =$this->db->update('branches',$data);

    if($res) return true;
    return false;
  }


  /**
  * Branches_model::delete()
  *
  * @param int $id
  * @return bool
  */
  public function delete($id){
    $data =array(
      "is_deleted" => 1,
      "deleted_by" => $this->aauth->get_user_id(),
      "deleted_on" => date('Y-m-d H:i:s',time())
    );
    $this->db->where('branch_id', $id);
    $result = $this->db->update('branches',$data);

    if($result) return true;
    return false;
  }
}

?>
