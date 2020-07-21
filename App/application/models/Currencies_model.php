<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class  Currencies_model extends CI_Model{

  public function __construct(){

    $this->load->database();
  }

  /**
  * Currencies_model::add_currency()
  *
  * @return bool
  */
  public function add_currency(){

    $data = array(
      "currency_code"=>$this->input->post("currency_code"),
      "currency_symbol"=>$this->input->post("currency_symbol"),
      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );

    $res = $this->db->insert('currencies', $data);

    if($res) return true;
    return false;
  }


  /**
  * Get get_currency_details 
  * @param int
  * @return array()
  * */
  public function get_currency_details($id)
  {
    $this->db->select('*');
    $this->db->from('currencies');
    $this->db->where('currency_id',$id);
    $query = $this->db->get();
    $row = $query->result_array();
    return  $row;
  }

  /**
  * update_currency 
  * @param int
  * @return bool
  * */
  public function update_currency($id){
    $data = array(
      "currency_code"=>$this->input->post("currency_code"),
      "currency_symbol"=>$this->input->post("currency_symbol"),
      "last_updated"=> date('Y-m-d H:i:s',time())
    );
    $this->db->where('currency_id',$id);
    $this->db->where('is_deleted',0);
    $res =$this->db->update('currencies',$data);

    if($res) return true;
    return false;
  }


  /**
  * Currencies_model::delete()
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
    $this->db->where('currency_id', $id);
    $result = $this->db->update('currencies',$data);

    if($result) return true;
    return false;
  }
}

?>
