<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class  Wherehouses_model extends CI_Model{


  public function __construct(){

    $this->load->database();
  }

    
  public function get_branches()
  { 
  $this->db->select('branch_id,branch_name');
  $this->db->where('is_deleted',0);
    $query = $this->db->get('branches');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
    return false;
  } 
  }

  /**
  * Wherehouses_model::add_wherehouse()
  *
  * @return bool
  */
  public function add_wherehouse(){
    $data = array(
      "branch_id"=>$this->input->post("branch"),
      "wherehouse_name"=>$this->input->post("wherehouse_name"),
      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );

    $res = $this->db->insert('wherehouses', $data);

    if($res) return true;
    return false;
  }

  /**
  * Get brand details
  * @param int
  * @return array()
  * */
  public function get_wherehouse_details($id)
  {
    $this->db->select('*');
    $this->db->from('wherehouses');
    $this->db->where('wherehouse_id',$id);
    $query = $this->db->get();
    $row = $query->result_array();
    return  $row;
  }

  /**
  * update wherehouse
  * @param int
  * @return bool
  * */
  public function update_wherehouse($id){
    $data = array(
      "branch_id"=>$this->input->post("branch"),
      "wherehouse_name"=>$this->input->post("wherehouse_name"),
      "last_updated"=> date('Y-m-d H:i:s',time())
    );
    $this->db->where('wherehouse_id',$id);
    $this->db->where('is_deleted',0);
    $res =$this->db->update('wherehouses',$data);

    if($res) return true;
    return false;
  }

  /**
  * Wherehouses_model::delete()
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
    $this->db->where('wherehouse_id', $id);
    $result = $this->db->update('wherehouses',$data);

    if($result) return true;
    return false;
  }
}

?>
