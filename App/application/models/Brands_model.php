<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class  Brands_model extends CI_Model{


  public function __construct(){

    $this->load->database();
  }

  /**
  * Brands_model::add_brand()
  *
  * @return bool
  */
  public function add_brand(){
    $data = array(
      "brand_name"=>$this->input->post("brand_name"),
      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );

    $res = $this->db->insert('brands', $data);

    if($res) return true;
    return false;
  }

  /**
  * Get brand details
  * @param int
  * @return array()
  * */
  public function get_brand_details($id)
  {
    $this->db->select('*');
    $this->db->from('brands');
    $this->db->where('brand_id',$id);
    $query = $this->db->get();
    $row = $query->result_array();
    return  $row;
  }

  /**
  * update brand
  * @param int
  * @return bool
  * */
  public function update_brand($id){
    $data = array(
      "brand_name"=>$this->input->post("brand_name"),
      "last_updated"=> date('Y-m-d H:i:s',time())
    );
    $this->db->where('brand_id',$id);
    $this->db->where('is_deleted',0);
    $res =$this->db->update('brands',$data);

    if($res) return true;
    return false;
  }

  /**
  * Brands_model::delete()
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
    $this->db->where('brand_id', $id);
    $result = $this->db->update('brands',$data);

    if($result) return true;
    return false;
  }
}

?>
