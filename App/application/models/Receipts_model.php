<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class  Receipts_model extends CI_Model{


  public function __construct(){

    $this->load->database();
  }

  /**
  * Receipts_model::add_brand()
  *
  * @return bool
  */
  public function add_receipt(){
     $pdata=array();
    if($this->input->post('invoice_number')){
      $data['invoice_number']=$this->input->post('invoice_number');
      $data['invoice_id']=$this->input->post('invoice_id');
      $amount=$this->input->post("amount");
      $alreadypayamount=$this->input->post('already_paid_amount');
      $total_amount=$this->input->post('total_amount');
      if(($amount+$alreadypayamount)>$total_amount){
       $error['message']="You can not pay maximum amount on purchase amount";
       $error['status']=0;
       return $error;
      }
      $pdata['paid_amount']=$alreadypayamount+$amount;
      if(($amount+$alreadypayamount)==$total_amount){
        $pdata['is_paid']=2;
      }
      else{
       $pdata['is_paid']=1;
      }
    }

    $data = array(
      "branch_id"=>$this->input->post("branch"),
      "receipt_number"=>$this->input->post("receipt_number"),
      "receipt_date"=>date("Y-m-d", strtotime($this->input->post("receipt_date"))),
      "to_account_id"=>$this->input->post("to_account"),
      "to_account_name"=>$this->input->post("to_account_name"),
      "from_account_id"=>$this->input->post("from_account"),
      "from_account_name"=>$this->input->post("from_account_name"),
      "for_transaction"=>$this->input->post("for_transaction"),
      "payment_mode"=>$this->input->post("payment_option"),
      "amount"=>$this->input->post("amount"),
      "description"=>$this->input->post("description"),
      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );

   $cash_flow_data = array(
      "to_account_id"=>$this->input->post("to_account"),
      "to_account_name"=>$this->input->post("to_account_name"),
      "from_account_id"=>$this->input->post("from_account"),
      "from_account_name"=>$this->input->post("from_account_name"),
      "amount"=>$this->input->post("amount"),
      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
    );
    $this->db->trans_start();
    if($this->db->insert('receipts',$data)){
      if(count($pdata)>0){
       $this->db->where('sale_id',$this->input->post('sale_id'));
       $this->db->update('sales',$pdata);
      }
       if($this->db->insert('cash_flows',$cash_flow_data)){
       $this->db->trans_complete();
       return true;
      }
    }
    else{
      return false;
    }
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
