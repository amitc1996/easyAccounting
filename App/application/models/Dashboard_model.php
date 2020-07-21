<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_model extends CI_Model
{   
    
    public function __construct()
  {
      $this->load->database();
     
  }
   
     public  function get_products() { 
      $from =  trim($this->input->post('start_date'));
      $to =    trim($this->input->post('end_date'));
      $condition = '';
      if($from && $to) 
      $condition="date(products.created) >= '$from' AND date(products.created) <= '$to'";

      $this->db->select('count(*)');
      $this->db->where("products.is_deleted", 0);
      if($condition!=''){
        $this->db->where($condition);
       }
        $query = $this->db->get('products');
        $cnt = $query->row_array();
		    return $cnt['count(*)'];
    }

    public  function total_clients() { 
      $from =  trim($this->input->post('start_date'));
      $to =    trim($this->input->post('end_date'));
      $condition = '';
      if($from && $to) 
      $condition.="date(clients.created) >= '$from' AND date(clients.created) <= '$to'";

      $this->db->select('count(*)');
      $this->db->where("clients.is_deleted", 0);
      if($condition!=''){
        $this->db->where($condition);
       }
        $query = $this->db->get('clients');
        $cnt = $query->row_array();
        return $cnt['count(*)'];
    }

     public  function total_clients_city_wise() { 
      $this->db->select('client_city_b,count(*) as total');
      $this->db->where("clients.is_deleted", 0);
      $this->db->group_by('client_city_b');
        $query = $this->db->get('clients');
        $cnt = $query->result_array();
        return $cnt;
    }

    public  function total_payble_amount(){ 
      $from =  trim($this->input->post('start_date'));
      $to =    trim($this->input->post('end_date'));
      $condition = '';
      if($from && $to) 
      $condition.=" date(purchases.purchase_date) >= '$from' AND date(purchases.purchase_date) <= '$to'";

        $this->db->select('SUM(grand_total)');
        $this->db->where("is_deleted", 0);
       if($condition!=''){
        $this->db->where($condition);
       }
        $query = $this->db->get('purchases');
        $cnt = $query->row_array();
        return $cnt['SUM(grand_total)'];
       }

       public  function total_outstanding(){ 
      $from =  trim($this->input->post('start_date'));
      $to =    trim($this->input->post('end_date'));
      $condition = '';
      if($from && $to) 
      $condition.=" date(sales.invoice_date) >= '$from' AND date(sales.invoice_date) <= '$to'";

        $this->db->select('SUM(grand_total)');
        $this->db->where("is_deleted", 0);
       if($condition!=''){
        $this->db->where($condition);
       }
        $query = $this->db->get('sales');
        $cnt = $query->row_array();
        return $cnt['SUM(grand_total)'];
       }

       public function sales_outstanding_amount(){
          $from =  trim($this->input->post('start_date'));
          $to =    trim($this->input->post('end_date'));
          $condition = '';
          if($from && $to) 
          $condition.=" date(sales.invoice_date) >= '$from' AND date(sales.invoice_date) <= '$to'";

           $this->db->select('SUM(grand_total) as total_amount,SUM(paid_amount) as total_paid_amount');
           $this->db->where("is_deleted", 0);
           if($condition!=''){
            $this->db->where($condition);
           }
          $query = $this->db->get('sales');
          $cnt = $query->row_array();
          return $cnt;
       }

       public function purchase_payable_amount(){
          $from =  trim($this->input->post('start_date'));
          $to =    trim($this->input->post('end_date'));
          $condition = '';
          if($from && $to) 
          $condition.=" date(purchases.purchase_date) >= '$from' AND date(purchases.purchase_date) <= '$to'";

           $this->db->select('SUM(grand_total) as total_amount,SUM(paid_amount) as total_paid_amount');
           $this->db->where("is_deleted", 0);
           if($condition!=''){
            $this->db->where($condition);
           }
          $query = $this->db->get('purchases');
          $cnt = $query->row_array();
          return $cnt;
       }
}
