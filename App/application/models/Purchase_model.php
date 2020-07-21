<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Purchase_model extends CI_Model
{   
  
  public function __construct()
  {
   $this->load->database();
  }

  /**
  * Purchase_model:: save_purchase
  * @return array
  */

  public function save_purchase(){
 
    $user_id=$this->aauth->get_user_id();
       $data = array(
        "po_number"=>$this->input->post("po_number"),
        "purchase_date"=>date("Y-m-d", strtotime($this->input->post("date_purchased"))),
        "wherehouse_id"=>$this->input->post("wherehouse"),
        "supplier_id"=>$this->input->post("supplier_name"),
        "supplier_name"=>$this->input->post("supplier_orgnisation_name"),
        "supplier_address"=>$this->input->post("supplier_address"),
        "supplier_city"=>$this->input->post("supplier_city"),
        "supplier_state"=>$this->input->post("supplier_state"),
        "supplier_country"=>$this->input->post("supplier_country"),
        "supplier_zip"=>$this->input->post("supplier_zip"),
        "supplier_phone"=>$this->input->post("supplier_orgnisation_phone"),
        "supplier_email"=>$this->input->post("supplier_email"),
        "supplier_tax_no"=>$this->input->post("supplier_tax_number"),
        "b_address"=>$this->input->post("b_address"),
        "b_city"=>$this->input->post("b_city"),
        "b_state"=>$this->input->post("b_state"),
        "b_country"=>$this->input->post("b_country"),
        "b_zip"=>$this->input->post("b_zip"),
        "s_address"=>$this->input->post("s_address"),
        "s_city"=>$this->input->post("s_city"),
        "s_state"=>$this->input->post("s_state"),
        "s_country"=>$this->input->post("s_country"),
        "s_zip"=>$this->input->post("s_zip"),
        "supplier_invoice"=>$this->input->post("supplier_invoice"),
        "supplier_order"=>$this->input->post("supplier_order"),
        "dispatch_document_no"=>$this->input->post("dispatch_document_no"),
        "delivery_note_date"=>$this->input->post("delevery_note_date"),
        "sub_total"=>$this->input->post("sub_total_amount"),
        "total_discount"=>$this->input->post("total_discount_amount"),
        "total_igst"=>$this->input->post("tigst"),
        "total_cgst"=>$this->input->post("tcgst"),
        "total_sgst"=>$this->input->post("tsgst"),
        "total"=>$this->input->post("total"),
        "less_round_off"=>$this->input->post("less_round_off"), 
        "grand_total"=>$this->input->post("grand_total"),
        "is_reverce_charge"=>$this->input->post("reverse_charge")?$this->input->post("reverse_charge"):0,
        "is_paid"=>$this->input->post("ispaid")?$this->input->post("ispaid"):0,
        "notes"=>$this->input->post("notes"),
        "created_by"=>  $user_id,
        "created" => date('Y-m-d H:i:s',time()),
      );
     $this->db->trans_start();
        if($this->db->insert('purchases',$data))
        {
            $purchase_id  = $this->db->insert_id();
            $items  = array();
            $product_items = $this->input->post('item')?:array();
            foreach($product_items as $i => $product_item)
            {   
                $itemData["purchase_id"]= $purchase_id;
                $itemData["product_id"] = $product_item['product_id']?$product_item['product_id']:'0';
                $itemData["item_title"] = $product_item['item_title'];
                $itemData["measurement_id"] = $product_item['measurement_id'];
                $itemData["measurement_name"] = $product_item['measurement_name'];
                $itemData["hsn_sac_code"] = $product_item['hsn_sac_code'];
                $itemData["item_qty"] = $product_item['item_qty'];
                $itemData["unit_cost"] = $product_item['unit_cost'];
                $itemData["total_cost"] = $product_item['total_amount'];
                $itemData["discount"] = $product_item['discount_percent'];
                $itemData["discount_amount"] = $product_item['discount_amount'];
                $itemData["cgst"] = $product_item['tax_cgst_amount'];
                $itemData["cgst_amount"] = $product_item['tax_cgst_amount'];
                $itemData["igst"] = $product_item['tax_igst_percent'];
                $itemData["igst_amount"] = $product_item['tax_igst_amount'];
                $itemData["sgst"] = $product_item['tax_sgst_percent'];
                $itemData["sgst_amount"] = $product_item['tax_sgst_amount'];
                $itemData["grand_total_coast"] = $product_item['total_gamount'];
                $itemData["created"] = date('Y-m-d H:i:s',time());
                array_push($items,$itemData);
            }
            if(count($items)>0)
            {
               if($this->db->insert_batch('purchase_items',$items))
               {
                //removing duplicate within post array by adding qty
               $forProductsStock =array(); 
               foreach($items as $key => $val)
               {
                 if(!isset($forProductsStock[$val["product_id"]]))
                 {
                  $forProductsStock[$val["product_id"]] = $val;
                 }
                  else
                  {
                    $forProductsStock[$val["product_id"]]["item_qty"] = $forProductsStock[$val["product_id"]]["item_qty"] + $val["item_qty"];
                  } 
               }
               $currentstock = $this->get_stock($this->input->post("wherehouse"));
               $allInserts = array();
               $allUpdate = array();
                foreach($forProductsStock as $key => $val)
                 {
                 if(!isset($currentstock[$key]))
                   {
                      $dataForInsert["stock"] = $val["item_qty"];
                      $dataForInsert["product_id"] = $val["product_id"];
                      $dataForInsert["wherehouse_id"] = $this->input->post("wherehouse");
                      $dataForInsert["created"] = date('Y-m-d H:i:s',time());  
                      $dataForInsert["created_by"] = $user_id;  
                      array_push($allInserts,$dataForInsert);
                 }
                 else
                 {
                    $dataForUpdate["product_id"] = $val["product_id"];
                    $dataForUpdate["stock"] = $currentstock[$key]['stock']+$val["item_qty"]; 
                    array_push($allUpdate,$dataForUpdate);
                 }
               }

               if(count($allInserts)>0)
               $this->db->insert_batch('stocks',$allInserts);
               
               if(count($allUpdate)>0)
               $this->db->update_batch('stocks',$allUpdate,'product_id');
               $this->db->trans_complete();
                return $purchase_id;
               }
               return false;
            }
           return false; 
        }
        return false;
  }
     
 public function update_purchase($id)
 {
   $user_id=$this->aauth->get_user_id();
       $data = array(
        "po_number"=>$this->input->post("po_number"),
        "purchase_date"=>date("Y-m-d", strtotime($this->input->post("date_purchased"))),
        "wherehouse_id"=>$this->input->post("wherehouse"),
        "supplier_id"=>$this->input->post("supplier_name"),
        "supplier_name"=>$this->input->post("supplier_orgnisation_name"),
        "supplier_address"=>$this->input->post("supplier_address"),
        "supplier_city"=>$this->input->post("supplier_city"),
        "supplier_state"=>$this->input->post("supplier_state"),
        "supplier_country"=>$this->input->post("supplier_country"),
        "supplier_zip"=>$this->input->post("supplier_zip"),
        "supplier_phone"=>$this->input->post("supplier_orgnisation_phone"),
        "supplier_email"=>$this->input->post("supplier_email"),
        "supplier_tax_no"=>$this->input->post("supplier_tax_number"),
        "b_address"=>$this->input->post("b_address"),
        "b_city"=>$this->input->post("b_city"),
        "b_state"=>$this->input->post("b_state"),
        "b_country"=>$this->input->post("b_country"),
        "b_zip"=>$this->input->post("b_zip"),
        "s_address"=>$this->input->post("s_address"),
        "s_city"=>$this->input->post("s_city"),
        "s_state"=>$this->input->post("s_state"),
        "s_country"=>$this->input->post("s_country"),
        "s_zip"=>$this->input->post("s_zip"),
        "supplier_invoice"=>$this->input->post("supplier_invoice"),
        "supplier_order"=>$this->input->post("supplier_order"),
        "dispatch_document_no"=>$this->input->post("dispatch_document_no"),
        "delivery_note_date"=>$this->input->post("delevery_note_date"),
        "sub_total"=>$this->input->post("sub_total_amount"),
        "total_discount"=>$this->input->post("total_discount_amount"),
        "total_igst"=>$this->input->post("tigst"),
        "total_cgst"=>$this->input->post("tcgst"),
        "total_sgst"=>$this->input->post("tsgst"),
        "total"=>$this->input->post("total"),
        "less_round_off"=>$this->input->post("less_round_off"), 
        "grand_total"=>$this->input->post("grand_total"),
        "is_reverce_charge"=>$this->input->post("reverse_charge")?$this->input->post("reverse_charge"):0,
        "is_paid"=>$this->input->post("ispaid")?$this->input->post("ispaid"):0,
        "notes"=>$this->input->post("notes"),
        "created_by"=>  $user_id,
        "created" => date('Y-m-d H:i:s',time()),
      );
     $this->db->trans_start();
         $this->db->where('purchase_id',$id);
        if($this->db->update('purchases',$data))
        {  
            $this->db->where('purchase_id',$id);
            $this->db->delete('purchase_items');
            $purchase_id  = $id;
            $items  = array();
            $product_items = $this->input->post('item')?:array();
            foreach($product_items as $i => $product_item)
            {   
                $itemData["purchase_id"]= $purchase_id;
                $itemData["product_id"] = $product_item['product_id']?$product_item['product_id']:'0';
                $itemData["item_title"] = $product_item['item_title'];
                $itemData["measurement_id"] = $product_item['measurement_id'];
                $itemData["measurement_name"] = $product_item['measurement_name'];
                $itemData["hsn_sac_code"] = $product_item['hsn_sac_code'];
                $itemData["item_qty"] = $product_item['item_qty'];
                $itemData["unit_cost"] = $product_item['unit_cost'];
                $itemData["total_cost"] = $product_item['total_amount'];
                $itemData["discount"] = $product_item['discount_percent'];
                $itemData["discount_amount"] = $product_item['discount_amount'];
                $itemData["cgst"] = $product_item['tax_cgst_amount'];
                $itemData["cgst_amount"] = $product_item['tax_cgst_amount'];
                $itemData["igst"] = $product_item['tax_igst_percent'];
                $itemData["igst_amount"] = $product_item['tax_igst_amount'];
                $itemData["sgst"] = $product_item['tax_sgst_percent'];
                $itemData["sgst_amount"] = $product_item['tax_sgst_amount'];
                $itemData["grand_total_coast"] = $product_item['total_gamount'];
                $itemData["created"] = date('Y-m-d H:i:s',time());
                array_push($items,$itemData);
            }
            if(count($items)>0)
            {
               if($this->db->insert_batch('purchase_items',$items))
               {
                //removing duplicate within post array by adding qty
               $forProductsStock =array(); 
               foreach($items as $key => $val)
               {
                 if(!isset($forProductsStock[$val["product_id"]]))
                 {
                  $forProductsStock[$val["product_id"]] = $val;
                 }
                  else
                  {
                    $forProductsStock[$val["product_id"]]["item_qty"] = $forProductsStock[$val["product_id"]]["item_qty"] + $val["item_qty"];
                  } 
               }
               $currentstock = $this->get_stock($this->input->post("wherehouse"));
               $allInserts = array();
               $allUpdate = array();
                foreach($forProductsStock as $key => $val)
                 {
                 if(!isset($currentstock[$key]))
                   {
                      $dataForInsert["stock"] = $val["item_qty"];
                      $dataForInsert["product_id"] = $val["product_id"];
                      $dataForInsert["wherehouse_id"] = $this->input->post("wherehouse");
                      $dataForInsert["created"] = date('Y-m-d H:i:s',time());  
                      $dataForInsert["created_by"] = $user_id;  
                      array_push($allInserts,$dataForInsert);
                 }
                 else
                 {
                    $dataForUpdate["product_id"] = $val["product_id"];
                    $dataForUpdate["stock"] = $currentstock[$key]['stock']+$val["item_qty"]; 
                    array_push($allUpdate,$dataForUpdate);
                 }
               }

               if(count($allInserts)>0)
               $this->db->insert_batch('stocks',$allInserts);
               
               if(count($allUpdate)>0)
               $this->db->update_batch('stocks',$allUpdate,'product_id');
               $this->db->trans_complete();
                return $purchase_id;
               }
               return false;
            }
           return false; 
        }
        return false;
 }


  /**
  * Purchase_model:: get_stock
  * @return array
  */

     public function get_stock($wherehouse_id){
       $this->db->select('*');
       $this->db->where('wherehouse_id',$wherehouse_id);
        $q = $this->db->get('stocks');
        if($q->num_rows()>0)
        {
            $rows = $q->result_array();
            foreach($rows as $val)
            {
                $rdata[$val["product_id"]] = $val;
            }
            return $rdata;
        }
        return false;
    }

    /**
  * Purchase_model:: get_purchase
  * @param purchase_id
  * @return array
  */

     public function get_purchase($purchase_id)
     {  
        $this->db->select('purchases.*');
        $this->db->where('purchase_id',$purchase_id);
        $query = $this->db->get('purchases');

        if($query->num_rows()>0)
        {
            $data["purchase_details"] = $query->result_array();
            
            $this->db->select('purchase_items.*');
            $this->db->where('purchase_id',$purchase_id);
            $query = $this->db->get('purchase_items');
            if($query->num_rows()>0)
            {

               $data["purchase_items"] =$query->result_array();
            }
            else{
              $data["purchase_items"] = array();
            }
            return $data;
        }
        return false;
    }

  /**
  * Purchase_model:: get_purchase_details
  * @param purchase_id
  * @return array
  */

    public function get_purchase_details($purchase_id)
    {
        $this->db->select('purchases.*');
        $this->db->where('purchases.purchase_id',$purchase_id);
        $query = $this->db->get('purchases');
        if($query->num_rows() > 0)
        return $query->result_array();
        return false;
    }
 
   /**
  * Purchase_model:: get_wherehouse_address
  * @return array
  */

   public function get_wherehouse_address($id){
    $this->db->select('wherehouses.*,branches.branch_address,branches.branch_city,branches.branch_state,branches.branch_country,branches.branch_zip');
    $this->db->join('branches','branches.branch_id = wherehouses.branch_id','left');
    $this->db->where('wherehouses.wherehouse_id',$id);
    $query = $this->db->get('wherehouses');
    if($query->num_rows() > 0)
    return $query->row_array();
        
    return false;
   }

    /**
  * Purchase_model:: get_supplier_details
  * @return array
  */
   
   public function get_supplier_details($id){
    $this->db->select('*');
    $this->db->where('supplier_id',$id);
    $query = $this->db->get('suppliers');
    if($query->num_rows() > 0)
    return $query->row_array();
        
    return false;
   }
  }