<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Product_model extends CI_Model
{

  public function __construct()
  {
    $this->load->database();
  }

  /**
  * Product_model:: get_product_details
  * @param int $id
  * @return array
  */
  public function get_product_details($id){
   
    $this->db->where('product_id',$id)
    ->select('products.product_id,products.item_title,products.sku,products.category_id,
    products.brand_id,products.measurement,products.igst,products.cgst,products.sgst,products.stock,products.unit_cost,products.salling_price,products.created,categories.category_name,brands.brand_name,measurements.measurement_name,products.product_description,products.hsn_sac_code,products.unit_cost_exclude_gst,products.salling_price_exclude_gst');
    $this->db->join('categories','products.category_id = categories.category_id','left');
    $this->db->join('brands','products.brand_id = brands.brand_id','left');
    $this->db->join('measurements','products.measurement = measurements.measurement_id','left');

    $res = $this->db->get('products');

    if($res) return $res->result_array();
    return NULL;
  }
  /**
  * Product_model:: add_product
  * @return boolean
  */
  public function add_product(){
  
     $data = array(
        'sku'=>$this->input->post('sku')?$this->input->post('sku'):strtoupper(uniqid('SKU')),
        'item_title' => $this->input->post('product_name'),
        'category_id' => $this->input->post('category_name'),
        'brand_id' => $this->input->post('brand'),
        'igst' => $this->input->post('igst'),
        'cgst' => $this->input->post('cgst'),
        'sgst' => $this->input->post('sgst'),
        'measurement' => $this->input->post('measurement'),
        'unit_cost' => $this->input->post('unit_cost'),
        'salling_price' => $this->input->post('salling_price'),
        'unit_cost_exclude_gst' => $this->input->post('unit_cost_exclude_gst'),
        'salling_price_exclude_gst' => $this->input->post('salling_price_exclude_gst'),
        'hsn_sac_code' => $this->input->post('hsn_sac_code'),
        'product_description' => $this->input->post('product_description'),
        'created' => date('Y-m-d H:i:s',time()),
        'created_by' => $this->aauth->get_user_id(),
      );
    $res = $this->db->insert('products',$data);
    if($res){
      $data['product_id']=$this->db->insert_id(); 
      $data['action']='Add Product';
     if($this->db->insert('product_histories',$data)){
       return true;
     }
     else{
      return false;
     }
     }
    else{
    return false;
    } 
  }

  /**
  * Product_model:: update_product
  * @param mixed
  * @return bool
  */
  public function update_product($id){
     
      $data = array(
        'item_title' => $this->input->post('product_name'),
        'category_id' => $this->input->post('category_name'),
        'brand_id' => $this->input->post('brand'),
        'igst' => $this->input->post('igst'),
        'cgst' => $this->input->post('cgst'),
        'sgst' => $this->input->post('sgst'),
        'measurement' => $this->input->post('measurement'),
        'unit_cost' => $this->input->post('unit_cost'),
        'salling_price' => $this->input->post('salling_price'),
        'unit_cost_exclude_gst' => $this->input->post('unit_cost_exclude_gst'),
        'salling_price_exclude_gst' => $this->input->post('salling_price_exclude_gst'),
        'hsn_sac_code' => $this->input->post('hsn_sac_code'),
        'product_description' => $this->input->post('product_description'),
        'last_updated' => date('Y-m-d H:i:s',time()),
      );
   
    $this->db->where('product_id',$id);
    $res = $this->db->update('products',$data);
    if($res){
     $data['product_id']=$id; 
     $data['action']='Update Product';
     $data['created'] = date('Y-m-d H:i:s',time());
     $data['created_by'] = $this->aauth->get_user_id();
     if($this->db->insert('product_histories',$data)){
       return true;
     }
     else{
      return false;
     }
     }
    else{
    return false;
    }
  }

  /**
  * Product_model:: delete
  * @param int $id
  * @return bool
  */
  public function delete($id){
  
    $data = array(
      'is_deleted' => 1,
      // 'is_disabled' => 1,
      'last_updated' => date('Y-m-d H:i:s',time()),
      'deleted_by' => $this->aauth->get_user_id(),
    );
    $this->db->where('product_id',$id);
    $res = $this->db->update('products',$data);

    if($res) return true;
    return false;
  }

  /**
  * Product_model:: fillter_categories
  * @param mixed
  * @return array
  */

  public function fillter_categories(){
   
    $this->db->select('products.category_id,categories.category_name');
    $this->db->distinct();
    $this->db->order_by('category_name', 'ASC');
    $this->db->join('categories','products.category_id = categories.category_id','left');
    $query = $this->db->get('products');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
      return false;
    }
  }

  /**
  * Product_model:: fillter_location
  * @param mixed
  * @return array
  */
  
  
  public function get_hrecords($product_id){
    $this->db->select('product_histories.*,categories.category_name,brands.brand_name,measurements.measurement_name');
    $this->db->where('product_id',$product_id);
    $this->db->where('product_histories.is_deleted',0);
    $this->db->join('categories','product_histories.category_id = categories.category_id','left');
    $this->db->join('brands','product_histories.brand_id = brands.brand_id','left');
    $this->db->join('measurements','product_histories.measurement = measurements.measurement_id','left');
     $query = $this->db->get('product_histories');
    if($query->num_rows() > 0)
      return $query->result_array();
    else
      return false;
  }
}
