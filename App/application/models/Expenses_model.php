<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class  Expenses_model extends CI_Model{


  public function __construct(){

    $this->load->database();
  }

  /**
  * Expenses_model::add_group()
  *
  * @return bool
  */
  public function add_expense(){
 
    $data = array(
      "branch_id"=>$this->input->post("branch"),
      "expense_date"=>date("Y-m-d", strtotime($this->input->post("expense_date"))),
      "to_account_id"=>$this->input->post("ledger"),
      "to_account_name"=>$this->input->post("to_account_name"),
      "from_account_id"=>$this->input->post("account_group"),
      "from_account_name"=>$this->input->post("from_account_name"),
      "payment_method"=>$this->input->post("payment_option"),
      "amount"=>$this->input->post("amount"),
      "description"=>$this->input->post("description"),
      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );

    $res = $this->db->insert('expenses', $data);

    if($res) return true;
    return false;
  }

  /**
  * Get brand get_expense_details
  * @param int
  * @return array()
  * */
  public function get_expense_details($id)
  {
    $this->db->select('*');
    $this->db->from('expenses');
    $this->db->where('expense_id',$id);
    $query = $this->db->get();
    $row = $query->result_array();
  
    return  $row;
  }

  /**
  * update update_expense
  * @param int
  * @return bool
  * */
  public function update_expense($id){
    $data = array(
      "branch_id"=>$this->input->post("branch"),
      "expense_date"=>date("Y-m-d", strtotime($this->input->post("expense_date"))),
      "to_account_id"=>$this->input->post("ledger"),
      "to_account_name"=>$this->input->post("to_account_name"),
      "from_account_id"=>$this->input->post("account_group"),
      "from_account_name"=>$this->input->post("from_account_name"),
      "payment_method"=>$this->input->post("payment_option"),
      "amount"=>$this->input->post("amount"),
      "description"=>$this->input->post("description"),
      "last_updated"=> date('Y-m-d H:i:s',time())
    );
    $this->db->where('expense_id',$id);
    $this->db->where('is_deleted',0);
    $res =$this->db->update('expenses',$data);

    if($res) return true;
    return false;
  }

  /**
  * Expense_model::delete()
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
    $this->db->where('expense_id', $id);
    $result = $this->db->update('expenses',$data);

    if($result) return true;
    return false;
  }
}

?>
