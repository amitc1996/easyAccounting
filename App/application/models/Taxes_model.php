<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class  Taxes_model extends CI_Model{

  public function __construct(){

    $this->load->database();
  }

  /**
  * Taxes_model::add_brand()
  *
  * @return bool
  */
  public function add_tax(){
    $data = array(
      "tax_name"=>$this->input->post("tax_name"),
      "tax_percentage"=>$this->input->post("tax_percentage"),
      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );

    $res = $this->db->insert('taxes', $data);

    if($res) return true;
    return false;
  }
    /**
  * Taxes_model::add_tax_group()
  *
  * @return bool
  */

  public function add_tax_group(){
    $tax_percentage=0;
    foreach ($this->input->post("taxes") as $key => $value) {
      $tax_percentage+=$value['tax_percentage'];
    }
    $data = array(
      "is_grouped"=>1,
      "tax_name"=>$this->input->post("group_name"),
      "tax_percentage"=>$tax_percentage,
      'taxe_groups'=>json_encode($this->input->post("taxes")),
      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );

    $res = $this->db->insert('taxes', $data);

    if($res) return true;
    return false;
  }

  /**
  * Get tax details
  * @param int
  * @return array()
  * */
  public function get_tax_details($id)
  {
    $this->db->select('*');
    $this->db->from('taxes');
    $this->db->where('tax_id',$id);
    $query = $this->db->get();
    $row = $query->result_array();
    return  $row;
  }

  /**
  * update tax
  * @param int
  * @return bool
  * */
  public function update_tax($id){
    $data = array(
      "tax_name"=>$this->input->post("tax_name"),
      "tax_percentage"=>$this->input->post("tax_percentage"),
      "last_updated"=> date('Y-m-d H:i:s',time())
    );
    $this->db->where('tax_id',$id);
    $this->db->where('is_deleted',0);
    $res =$this->db->update('taxes',$data);

    if($res) return true;
    return false;
  }
   /**
  * Taxes_model::update_group_tax()
  *
  * @return bool
  */
  public function update_group_tax($id)
  $tax_percentage=0;
    foreach ($this->input->post("taxes") as $key => $value) {
      $tax_percentage+=$value['tax_percentage'];
    }
    $data = array(
      "tax_name"=>$this->input->post("group_name"),
      "tax_percentage"=>$tax_percentage,
       'taxe_groups'=>json_encode($this->input->post("taxes")),
      "last_updated"=> date('Y-m-d H:i:s',time())
    );
    $this->db->where('tax_id',$id);
    $this->db->where('is_deleted',0);
    $res =$this->db->update('taxes',$data);

    if($res) return true;
    return false;
  }

  /**
  * Taxes_model::delete()
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
    $this->db->where('tax_id', $id);
    $result = $this->db->update('taxes',$data);

    if($result) return true;
    return false;
  }
}

?>
