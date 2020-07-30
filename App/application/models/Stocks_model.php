<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class  Stocks_model extends CI_Model{


  public function __construct(){

    $this->load->database();
  }

  /**
  * Stocks_model::add_category()
  *
  * @return bool
  */
  public function add_stock(){
    $resp=$this->get_stock($this->input->post("wherehouse"),$this->input->post("product"));
    if(!isset($resp['stock_id'])){
      $data = array(
      "wherehouse_id"=>$this->input->post("wherehouse"),
      "product_id"=>$this->input->post("product"),
      "stock"=>$this->input->post("stock"),
      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
       );
      if($this->db->insert('stocks',$data)){
       $datas['stock_id']=$this->db->insert_id(); 
       $datas['description']='Add Stock';
       $datas['stock_in']=$this->input->post("stock");
       $datas['created'] = date('Y-m-d H:i:s',time());
       $datas['created_by'] = $this->aauth->get_user_id();
       $res=$this->db->insert('stock_histories',$datas);
      }
    }
    else{
       $datai['stock']=$this->input->post("stock")+$resp['stock'];
       $this->db->where('stock_id',$resp['stock_id']);
       if($this->db->update('stocks',$datai)){
       $datas['stock_id']=$resp['stock_id']; 
       $datas['description']='Add Stock';
       $datas['stock_in']=$this->input->post("stock");
       $datas['created'] = date('Y-m-d H:i:s',time());
       $datas['created_by'] = $this->aauth->get_user_id();
       $res=$this->db->insert('stock_histories',$datas);
      }
    }
    if($res) return true;
    return false;
  }

  public function get_stock($wherehouse_id,$product_id){
       $this->db->select('*');
       $this->db->where('wherehouse_id',$wherehouse_id);
       $this->db->where('product_id',$product_id);
        $q = $this->db->get('stocks');
        if($q->num_rows()>0)
        {
            
            return $q->row_array();
        }
        return false;
    }

  /**
  * Get category details
  * @param int
  * @return array()
  * */
  public function get_stock_details($id)
  {
    $this->db->select('stocks.*,wherehouses.wherehouse_name,products.item_title,products.unit_cost');
    $this->db->from('stocks');
    $this->db->where('stock_id',$id);
    $this->db->join('wherehouses','wherehouses.wherehouse_id = stocks.wherehouse_id');
    $this->db->join('products','products.product_id = stocks.product_id');
    $query = $this->db->get();
    $row = $query->result_array();
    return  $row;
  }

  /**
  * update category
  * @param int
  * @return bool
  * */
  public function update_stock($id){
  
     $data = array(
      "wherehouse_id"=>$this->input->post("wherehouse"),
      "product_id"=>$this->input->post("product"),
      "stock"=>$this->input->post("stock"),
      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
    );
    $oldRecord=$this->get_stock($this->input->post("wherehouse"),$this->input->post("product"));
    $this->db->where('stock_id',$id);
    $this->db->where('is_deleted',0);
    if($this->db->update('stocks',$data)){
        if($oldRecord["stock"]!=$data["stock"])
        {
      if($oldRecord["stock"] > $data["stock"]){ //decreased
         $diff =  $oldRecord["stock"] - $data["stock"];
        $datas["stock_out"] = $diff;
        $datas['description']='Update stock decrease stock quantity '.$diff;;
        $datas['created'] = date('Y-m-d H:i:s',time());
        $datas['created_by'] = $this->aauth->get_user_id();
        $datas['stock_id']=$oldRecord['stock_id']; 
       }
       if($oldRecord["stock"] < $data["stock"]){ //increased
        $diff =  $data["stock"] - $oldRecord["stock"];
        $datas["stock_in"] = $diff;
        $datas['description']='Update stock increase stock quantity '.$diff;;
        $datas['created'] = date('Y-m-d H:i:s',time());
        $datas['created_by'] = $this->aauth->get_user_id();
        $datas['stock_id']=$oldRecord['stock_id']; 
     }
       
       $res=$this->db->insert('stock_histories',$datas);
     }
        return true;
      
    }
    else{
      return false;
    }
  }


  public function get_stock_summary_data(){
   $from =  trim($this->input->post('start_date'));
    $to =    trim($this->input->post('end_date'));
    $condition = '';
    if($from && $to) 
    $condition="date(stock_histories.created) >= '$from' AND date(stock_histories.created) <= '$to'";
    $this->db->select('SUM(stock_in)- SUM(stock_out) as total_avl_stock,products.item_title,products.unit_cost,measurements.measurement_name');
     if($condition!=''){
      $this->db->where($condition);
     }
      $this->db->join('stocks','stocks.stock_id = stock_histories.stock_id','left');
      $this->db->join('products','products.product_id = stocks.product_id','left');
      $this->db->join('measurements','products.measurement = measurements.measurement_id','left');
      $this->db->group_by('stock_histories.stock_id');
      $query = $this->db->get('stock_histories');
      $result = $query->result_array();
      return $result;
  }
  /**
  * Categories_model::delete()
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
    $this->db->where('stock_id', $id);
    $result = $this->db->update('stocks',$data);

    if($result) return true;
    return false;
  }
}

?>
