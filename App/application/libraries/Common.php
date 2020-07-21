<?php
class Common
{
    private $CI;
 
    function __construct()
    {
        $this->CI = get_instance();
    }
 
    function company_profile($company_id=1)
    {
        $query = $this->CI->db->select('company_profiles.*')
		 ->where('company_id',$company_id)
		 ->get('company_profiles');
		  return $query->row_array();
    }
   
    public function tblrecdaycount($table='')
     {
    $this->CI->db->select('count(*) as total');
    $this->CI->db->from($table);
    $query = $this->CI->db->get();
    if($query->num_rows()> 0){
      $row =  $query->row_array();
      return $row['total'];
    }
    else{
      return false;
    }
  }

  /* public function tblrecdaycount($table='',$date='',$wheredatefield='created')
     {
    $date=$date?:date('Y-m-d');

    if($table=='' || $wheredatefield==''){
      return 0;
    }

    $this->CI->db->select('count(*) as total');
    $this->CI->db->where($wheredatefield.'>=',$date.' 00:00:00');
    $this->CI->db->where($wheredatefield.'<=',$date.' 23:59:59');
    $this->CI->db->from($table);
    $query = $this->CI->db->get();
    if($query->num_rows()> 0){
      $row =  $query->row_array();
      return $row['total'];
    }
    else{
      return false;
    }
  }*/


  public function get_supplier()
  {
  
    $this->CI->db->select('supplier_id,supplier_orgnisation_name');
    $this->CI->db->order_by('supplier_name', 'ASC');

    $this->CI->db->where('is_deleted',0);
    $query = $this->CI->db->get('suppliers');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
    return false;
  } 
  }


       
  public function get_branches()
  {
  
  $this->CI->db->select('branch_id,branch_name');
  $this->CI->db->where('is_deleted',0);
    $query = $this->CI->db->get('branches');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
    return false;
  } 
  }


public function get_ledgers(){
  
  $this->CI->db->select('leadger_id,leadger_name');
  $this->CI->db->where('is_deleted',0);
    $query = $this->CI->db->get('leadgers');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
    return false;
  }
}
  public function get_taxes()
  {
  
  $this->CI->db->select('tax_id,tax_name,tax_percentage');
  $this->CI->db->where('is_deleted',0);
    $query = $this->CI->db->get('taxes');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
    return false;
  } 
  }


  public function get_measurements()
  {
    
  $this->CI->db->select('measurement_id,measurement_name');
  $this->CI->db->where('is_deleted',0);
    $query = $this->CI->db->get('measurements');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
    return false;
  } 
  }



   public function get_categories()
   {
  
    $this->CI->db->select('category_id,category_name');

  $this->CI->db->where('is_deleted',0);
    $this->CI->db->order_by('category_name', 'ASC');
    $query = $this->CI->db->get('categories');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
    return false;
  } 
}
  public function get_account_categories()
   {
  
    $this->CI->db->select('account_category_id,account_category_name');
    $this->CI->db->where('is_deleted',0);
    $this->CI->db->order_by('account_category_name', 'ASC');
    $query = $this->CI->db->get('account_categories');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
    return false;
  } 
  }

  public function get_account_groups(){
  
    $this->CI->db->select('account_group_id,group_name');

  $this->CI->db->where('is_deleted',0);
    $this->CI->db->order_by('group_name', 'ASC');
    $query = $this->CI->db->get('account_groups');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
    return false;
  } 
  }



   public function get_brands()
   {
  
    $this->CI->db->select('brand_id,brand_name');

  $this->CI->db->where('is_deleted',0);
    $this->CI->db->order_by('brand_name', 'ASC');
    $query = $this->CI->db->get('brands');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
    return false;
  } 
  }



   public function get_wherehouses()
   {
  
    $this->CI->db->select('wherehouse_id,wherehouse_name');

  $this->CI->db->where('is_deleted',0);
    $this->CI->db->order_by('wherehouse_name', 'ASC');
    $query = $this->CI->db->get('wherehouses');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
    return false;
  } 
  }
  

  function get_products_details($product_id=false){

  $this->CI->db->select('products.*,measurements.measurement_name');
  $this->CI->db->join('measurements','measurements.measurement_id = products.measurement','left');
  $this->CI->db->where('products.is_deleted',0);
  $this->CI->db->where('products.product_id',$product_id);
  $q = $this->CI->db->get('products');
  if($q->num_rows()>0)
  {
     return $q->result_array();
  }
  return false;
 }

 function search_product($title){
    
   $this->CI->db->select('*','item_title as label');
   $this->CI->db->like('item_title', $title , 'both');
   $this->CI->db->where('is_deleted',0);
   $this->CI->db->order_by('item_title', 'ASC');
   $this->CI->db->limit(10);
   return $this->CI->db->get('products')->result();
 }
function get_products(){
    $this->CI->db->select('product_id,item_title');
    $this->CI->db->order_by('item_title', 'ASC');

    $this->CI->db->where('is_deleted',0);
    $query = $this->CI->db->get('products');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
    return false;
  } 
 }
 

 function get_clients(){
    $this->CI->db->select('client_id,client_orgnisation_name');
    $this->CI->db->order_by('client_name', 'ASC');

    $this->CI->db->where('is_deleted',0);
    $query = $this->CI->db->get('clients');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
    return false;
  } 
 }
function get_currencies($id=false){
    $this->CI->db->select('currency_id,currency_code,currency_symbol');

    $this->CI->db->where('is_deleted',0);
    if($id){
       $this->CI->db->where('currency_id',$id);
    }
    $query = $this->CI->db->get('currencies');
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
    return false;
  } 
 }
 function get_invoice_no(){

  $company_profile=$this->company_profile();
  $start=date("y",strtotime($company_profile['financial_year_start']));
  $end=date("y",strtotime($company_profile['financial_year_end']));
  return 'INV-'.str_pad(($this->tblrecdaycount('sales')+1),3,0,STR_PAD_LEFT).'/'.$start.'-'.$end;
 }
 function get_po_no(){

  $company_profile=$this->company_profile();
  $start=date("y",strtotime($company_profile['financial_year_start']));
  $end=date("y",strtotime($company_profile['financial_year_end']));
  return 'PO-'.str_pad(($this->tblrecdaycount('purchases')+1),3,0,STR_PAD_LEFT).'/'.$start.'-'.$end;
 }

 function get_voucher_no(){

  $company_profile=$this->company_profile();
  $start=date("y",strtotime($company_profile['financial_year_start']));
  $end=date("y",strtotime($company_profile['financial_year_end']));
  return 'VR-'.str_pad(($this->tblrecdaycount('payments')+1),3,0,STR_PAD_LEFT).'/'.$start.'-'.$end;
 }

 function get_receipt_no(){

  $company_profile=$this->company_profile();
  $start=date("y",strtotime($company_profile['financial_year_start']));
  $end=date("y",strtotime($company_profile['financial_year_end']));
  return 'RC-'.str_pad(($this->tblrecdaycount('receipts')+1),3,0,STR_PAD_LEFT).'/'.$start.'-'.$end;
 }
}