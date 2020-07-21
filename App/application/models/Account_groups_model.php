<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class  Account_groups_model extends CI_Model{


  public function __construct(){

    $this->load->database();
  }

  /**
  * Account_groups_model::add_group()
  *
  * @return bool
  */
  public function add_group(){
    $data = array(
      "branch_id"=>$this->input->post("branch"),
      "group_name"=>$this->input->post("group_name"),
      "account_category_id"=>$this->input->post("category_name"),
      "opening_balance"=>$this->input->post("opening_balance"),
      "description"=>$this->input->post("description"),
      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );

    $res = $this->db->insert('account_groups', $data);

    if($res) return true;
    return false;
  }

  /**
  * Get brand details
  * @param int
  * @return array()
  * */
  public function get_account_group_details($id)
  {
    $this->db->select('*');
    $this->db->from('account_groups');
    $this->db->where('account_group_id',$id);
    $query = $this->db->get();
    $row = $query->result_array();
    return  $row;
  }

  /**
  * update account_group
  * @param int
  * @return bool
  * */
  public function update_account_group($id){
    $data = array(
      "branch_id"=>$this->input->post("branch"),
      "group_name"=>$this->input->post("group_name"),
      "account_category_id"=>$this->input->post("category_name"),
      "opening_balance"=>$this->input->post("opening_balance"),
      "description"=>$this->input->post("description"),
      "last_updated"=> date('Y-m-d H:i:s',time())
    );
    $this->db->where('account_group_id',$id);
    $this->db->where('is_deleted',0);
    $res =$this->db->update('account_groups',$data);

    if($res) return true;
    return false;
  }

  /**
  * Account_groups_model::delete()
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
    $this->db->where('account_group_id', $id);
    $result = $this->db->update('account_groups',$data);

    if($result) return true;
    return false;
  }
}

?>
