<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class  Ledgers_model extends CI_Model{


  public function __construct(){

    $this->load->database();
  }

  /**
  * Ledgers_model::add_group()
  *
  * @return bool
  */
  public function add_ledger(){
   
    $data = array(
      "leadger_name"=>$this->input->post("leadger_name"),
      "account_group_id"=>$this->input->post("account_group"),
      "opening_balance"=>$this->input->post("opening_balance"),
      "closing_balance"=>$this->input->post("closing_balance"),
      "description"=>$this->input->post("description"),
      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );

    $res = $this->db->insert('leadgers', $data);

    if($res) return true;
    return false;
  }

  /**
  * Get brand details
  * @param int
  * @return array()
  * */
  public function get_ledger_details($id)
  {
    $this->db->select('*');
    $this->db->from('leadgers');
    $this->db->where('leadger_id',$id);
    $query = $this->db->get();
    $row = $query->result_array();
  
    return  $row;
  }

  /**
  * update update_ledger
  * @param int
  * @return bool
  * */
  public function update_ledger($id){
    $data = array(
     "leadger_name"=>$this->input->post("leadger_name"),
      "account_group_id"=>$this->input->post("account_group"),
      "opening_balance"=>$this->input->post("opening_balance"),
      "closing_balance"=>$this->input->post("closing_balance"),
      "description"=>$this->input->post("description"),
      "last_updated"=> date('Y-m-d H:i:s',time())
    );
    $this->db->where('leadger_id',$id);
    $this->db->where('is_deleted',0);
    $res =$this->db->update('leadgers',$data);

    if($res) return true;
    return false;
  }

  /**
  * Ledgers_model::delete()
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
    $this->db->where('leadger_id', $id);
    $result = $this->db->update('leadgers',$data);

    if($result) return true;
    return false;
  }
}

?>
