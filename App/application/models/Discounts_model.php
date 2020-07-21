<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class  Discounts_model extends CI_Model{

  public function __construct(){

    $this->load->database();
  }

  /**
  * Discounts_model::add_discount()
  *
  * @return bool
  */
  public function add_discount(){
    $data = array(
      "discount_name"=>$this->input->post("discount_name"),
      "discount_percentage"=>$this->input->post("discount_percentage"),
      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );

    $res = $this->db->insert('discounts', $data);

    if($res) return true;
    return false;
  }

  /**
  * Get discount details
  * @param int
  * @return array()
  * */
  public function get_discount_details($id)
  {
    $this->db->select('*');
    $this->db->from('discounts');
    $this->db->where('discount_id',$id);
    $this->db->where('company_id',$company_id);
    $query = $this->db->get();
    $row = $query->result_array();
    return  $row;
  }

  /**
  * update_discount 
  * @param int
  * @return bool
  * */
  public function update_discount($id){
    $data = array(
      "discount_name"=>$this->input->post("discount_name"),
      "discount_percentage"=>$this->input->post("discount_percentage"),
      "last_updated"=> date('Y-m-d H:i:s',time())
    );
    $this->db->where('discount_id',$id);
    $this->db->where('is_deleted',0);
    $this->db->where('company_id',$company_id);
    $res =$this->db->update('discounts',$data);

    if($res) return true;
    return false;
  }

  /**
  * Discounts_model::delete()
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
    $this->db->where('discount_id', $id);
    $this->db->where('company_id',$company_id);
    $result = $this->db->update('discounts',$data);

    if($result) return true;
    return false;
  }
}

?>
