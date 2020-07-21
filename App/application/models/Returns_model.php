<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Returns_model extends CI_Model
{

  public function __construct()
  {
    $this->load->database();

  }

     /**
  * Returns_model:: get_vendors
  * @return array
  */

  public function get_vendors()
  {
    $this->db->select('vendor_id,vendor_name');
    $this->db->order_by('vendor_name', 'ASC');
    $query = $this->db->get('vendors');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
      return false;
    }
  }

      /**
  * Returns_model:: get_marketplaces
  * @return array
  */

  public function get_marketplaces()
  {
    $this->db->select('marketplace_id,marketplace_name');
    $this->db->order_by('marketplace_name', 'ASC');
    $query = $this->db->get('marketplaces');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
      return false;
    }
  }

     /**
  * Returns_model:: get_categories
  * @return array
  */

  public function get_categories()
  {
    $this->db->select('category_id,category_name');
    $this->db->order_by('category_name', 'ASC');
    $this->db->order_by('category_name','asc');
    $query = $this->db->get('categories');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
      return false;
    }
  }

    /**
  * Returns_model:: save_sale
  * @return array
  */

  public function save_sale()
  {
    $user_id=$this->aauth->get_user_id();
    $data = array(
      "invoice_id"=>'IN'.date('Ymd').str_pad(($this->tblrecdaycount('sales')+1),2,0,STR_PAD_LEFT),
      "marketplace_id"=>$this->input->post("marketplace_name"),
      "date_sold"=>date("Y-m-d", strtotime($this->input->post("date_returned"))),
      "total_final_cost"=>$this->input->post("total_cost"),
      "total_ebay_fee"=>$this->input->post("total_ebay_fee"),
      "total_pay_pal_fee"=>$this->input->post("total_paypal_fee"),
      "total_shipping_cost"=>$this->input->post("total_shipping_cost"),
      "total_net_cost"=>$this->input->post("total_net_cost"),
      "total_selling_price"=>$this->input->post("total_selling_price"),
      "total_net_profit"=>$this->input->post("total_net_profit"),
      "created_by"=>  $user_id,
      "created" => date('Y-m-d H:i:s',time()),
    );
    $query = $this->db->insert('sales',$data);
    if($query)
    {
      $insert_id = $this->db->insert_id();
      unset($data);
      $grand_data = array();
      $items  = array();
      $product_items = $this->input->post('product_items')?:array();
      foreach($product_items as $key=>$product_item)
      {
        $itemData["sale_id"]= $insert_id;
        $itemData["item_title"] = $product_item['item_title'];
        $itemData["location"] = $product_item['location'];
        $itemData["product_id"] = $product_item['product_id'];
        $itemData["category_id"] = $product_item['category_id'];
        $itemData["item_qty"] = $product_item['item_qty'];
        $itemData["unit_cost"] = $product_item['unit_cost'];
        $itemData["total_cost"] = '-'.$product_item['total_cost'];
        $itemData["ebay_fee"] = $product_item['ebay_fee'];
        $itemData["paypal_fee"] = $product_item['paypal_fee'];
        $itemData["shipping_cost"] = $product_item['shipping_cost'];
        $itemData["net_cost"] = $product_item['net_cost'];
        $itemData["selling_price"] = $product_item['selling_price'];
        $itemData["net_profit"] = $product_item['net_profit'];
        $itemData["created"] = date('Y-m-d H:i:s',time());

        $this->db->select('products.*,categories.category_name');
        $this->db->join('categories','products.category_id = categories.category_id','left');
        $this->db->where('products.product_id',$product_item['product_id']);
        $query = $this->db->get('products');
        if($query->num_rows()>0)
        {
          $row = $query->result_array();
          $itemData['stock'] = $row[0]['stock'];
          array_push($grand_data,$itemData);
          //reducing stock
          if($row[0]['stock']>=0){

            if(isset($forStock[$row[0]['product_id']]))
            {

              $forStock[$row[0]['product_id']]["stock"] = $forStock[$row[0]['product_id']]["stock"] + $itemData['item_qty'];
            }
            else{
              $tempForStock["product_id"] = $row[0]['product_id'];
              $tempForStock["stock"] =  ($row[0]['stock'] + $itemData['item_qty']);
              $forStock[$row[0]['product_id']] = $tempForStock;
            }
          }
        }
      }
      $inserted = $this->db->insert_batch('sale_items',$grand_data);
      if($inserted)
      {

        if(count($forStock)>0)
        $this->db->update_batch('products', $forStock, 'product_id');

        return $insert_id;
      }

      else
      return false;
    }
    else
    return false;
  }

   /**
  * Returns_model:: save_sale
  * @param product_id
  * @return array
  */

  public function get_products($product_id=0){
    $this->db->select('products.*,categories.category_name');
    $this->db->join('categories','products.category_id = categories.category_id','left');
    $this->db->where('products.product_id',$product_id);
    $q = $this->db->get('products');
    if($q->num_rows()>0)
    {
      return $q->result_array();
    }
    return false;
  }

   /**
  * Returns_model:: tblrecdaycount
  * @param product_id,date,wheredatefield
  * @return array
  */

  public function tblrecdaycount($table='',$date='',$wheredatefield='created')
  {
    $date=$date?:date('Y-m-d');

    if($table=='' || $wheredatefield==''){
      return 0;
    }

    $this->db->select('count(*) as total');
    $this->db->where($wheredatefield.'>=',$date.' 00:00:00');
    $this->db->where($wheredatefield.'<=',$date.' 23:59:59');
    $this->db->from($table);
    $query = $this->db->get();
    if($query->num_rows()> 0){
      $row =  $query->row_array();
      return $row['total'];
    }
    else{
      return false;
    }
  }

    /**
  * Returns_model:: search_product
  * @param title
  * @return array
  */


  function search_product($title){
    $this->db->like('item_title', $title , 'both');
    $this->db->order_by('item_title', 'ASC');
    $this->db->limit(10);
    $this->db->where('is_deleted',0);
    return $this->db->get('products')->result();
  }
}
