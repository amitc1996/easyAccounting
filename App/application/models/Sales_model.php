<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Sales_model extends CI_Model
{

  public function __construct()
  {
    $this->load->database();

  }

  /**
  * Sales_model:: save_sale
  * @return array
  */

   public function save_sale(){

    $user_id=$this->aauth->get_user_id();
       $data = array(
        "invoice_number"=>$this->input->post("invoice_number"),
        "invoice_date"=>date("Y-m-d", strtotime($this->input->post("invoice_date"))),
        "wherehouse_id"=>$this->input->post("wherehouse"),
        "client_id"=>$this->input->post("client_name"),
        "client_name"=>$this->input->post("client_orgnisation_name"),
        "client_address"=>$this->input->post("client_address_b"),
        "client_city"=>$this->input->post("client_city_b"),
        "client_state"=>$this->input->post("client_state_b"),
        "client_country"=>$this->input->post("client_country_b"),
        "client_zip"=>$this->input->post("client_zip_b"),
        "client_phone"=>$this->input->post("client_mobile"),
        "client_email"=>$this->input->post("client_email"),
        "client_gstin_no"=>$this->input->post("client_tax_number"),
        "b_address"=>$this->input->post("client_address_b"),
        "b_city"=>$this->input->post("client_city_b"),
        "b_state"=>$this->input->post("client_state_b"),
        "b_country"=>$this->input->post("client_country_b"),
        "b_zip"=>$this->input->post("client_zip_b"),
        "s_address"=>$this->input->post("client_address_s"),
        "s_city"=>$this->input->post("client_city_s"),
        "s_state"=>$this->input->post("client_state_s"),
        "s_country"=>$this->input->post("client_country_s"),
        "s_zip"=>$this->input->post("client_zip_s"),
        "transportation_mode"=>$this->input->post("transportation_mode"),
        "distance_to_transport"=>$this->input->post("distacnce_to_transport"),
        "transporter_name"=>$this->input->post("transporter_name"),
        "transporter_id"=>$this->input->post("transporter_id"),
        "transporter_document_no"=>$this->input->post("transporter_document_no"),
        "transporter_document_date"=>date("Y-m-d", strtotime($this->input->post("transporter_document_date"))),
        "vechicle_no"=>$this->input->post("vechicle_no"),
        "place_of_supply"=>$this->input->post("place_of_supply"),

        "client_order"=>$this->input->post("buyer_order"),
        "dispatch_document_no"=>$this->input->post("dispatch_document_no"),
        "delivery_note_date"=>$this->input->post("delevery_note_date"),
        "dispatch_through"=>$this->input->post("dispatch_through"),
        
        "is_reverce_charge"=>$this->input->post("reverse_charge")?$this->input->post("reverse_charge"):0,
        "is_paid"=>$this->input->post("ispaid")?$this->input->post("ispaid"):0,
        "notes"=>$this->input->post("notes"),

        "sub_total"=>$this->input->post("sub_total_amount"),
        "total_discount"=>$this->input->post("total_discount_amount"),
        "total_igst"=>$this->input->post("tigst"),
        "total_cgst"=>$this->input->post("tcgst"),
        "total_sgst"=>$this->input->post("tsgst"),
        "grand_total"=>$this->input->post("grand_total"),
        "created_by"=>  $user_id,
        "created" => date('Y-m-d H:i:s',time()),
      );
     $this->db->trans_start();
        if($this->db->insert('sales',$data))
        {
            $sale_id  = $this->db->insert_id();
            $items  = array();
            $product_items = $this->input->post('item')?:array();
            foreach($product_items as $i => $product_item)
            {   
                            
                $itemData["sale_id"]= $sale_id;
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
               if($this->db->insert_batch('sale_items',$items))
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
                    if($currentstock[$key]['stock']>0){
                    $dataForUpdate["stock"] = $currentstock[$key]['stock']-$val["item_qty"]; 
                     $this->db->where('product_id',$val["product_id"]);
                    if($this->db->update('stocks',$dataForUpdate)){
                       $datas['stock_id']=$currentstock[$key]['stock_id']; 
                       $datas['description']='Sale item';
                       $datas['stock_out']=$val["item_qty"];
                       $datas['created'] = date('Y-m-d H:i:s',time());
                       $datas['created_by'] = $this->aauth->get_user_id();
                       $datas['sale_id']=$sale_id;
                       $res=$this->db->insert('stock_histories',$datas);
                    }
                   
                    }
                 }
            
               $this->db->trans_complete();
                return $sale_id;
               }
               return false;
            }
           return false; 
        }
        return false;
    }

    public function update_sale($sale_id){
    $user_id=$this->aauth->get_user_id();
     //get current items 
    $saleedetails = $this->get_sale($sale_id);
    foreach ($saleedetails['sale_items'] as $key => $value) {
     if(isset($current[$value['product_id']] )){
      $current[$value['product_id']] += $value['item_qty'];
      }
      else{
         $current[$value['product_id']] = $value['item_qty'];
      }
    }
  
       $data = array(
        "invoice_number"=>$this->input->post("invoice_number"),
        "invoice_date"=>date("Y-m-d", strtotime($this->input->post("invoice_date"))),
        "wherehouse_id"=>$this->input->post("wherehouse"),
        "client_id"=>$this->input->post("client_name"),
        "client_name"=>$this->input->post("client_orgnisation_name"),
        "client_address"=>$this->input->post("client_address_b"),
        "client_city"=>$this->input->post("client_city_b"),
        "client_state"=>$this->input->post("client_state_b"),
        "client_country"=>$this->input->post("client_country_b"),
        "client_zip"=>$this->input->post("client_zip_b"),
        "client_phone"=>$this->input->post("client_mobile"),
        "client_email"=>$this->input->post("client_email"),
        "client_gstin_no"=>$this->input->post("client_tax_number"),
        "b_address"=>$this->input->post("client_address_b"),
        "b_city"=>$this->input->post("client_city_b"),
        "b_state"=>$this->input->post("client_state_b"),
        "b_country"=>$this->input->post("client_country_b"),
        "b_zip"=>$this->input->post("client_zip_b"),
        "s_address"=>$this->input->post("client_address_s"),
        "s_city"=>$this->input->post("client_city_s"),
        "s_state"=>$this->input->post("client_state_s"),
        "s_country"=>$this->input->post("client_country_s"),
        "s_zip"=>$this->input->post("client_zip_s"),
        "transportation_mode"=>$this->input->post("transportation_mode"),
        "distance_to_transport"=>$this->input->post("distacnce_to_transport"),
        "transporter_name"=>$this->input->post("transporter_name"),
        "transporter_id"=>$this->input->post("transporter_id"),
        "transporter_document_no"=>$this->input->post("transporter_document_no"),
        "transporter_document_date"=>date("Y-m-d", strtotime($this->input->post("transporter_document_date"))),
        "vechicle_no"=>$this->input->post("vechicle_no"),
        "place_of_supply"=>$this->input->post("place_of_supply"),

        "client_order"=>$this->input->post("buyer_order"),
        "dispatch_document_no"=>$this->input->post("dispatch_document_no"),
        "delivery_note_date"=>$this->input->post("delevery_note_date"),
        "dispatch_through"=>$this->input->post("dispatch_through"),
        
        "is_reverce_charge"=>$this->input->post("reverse_charge")?$this->input->post("reverse_charge"):0,
        "is_paid"=>$this->input->post("ispaid")?$this->input->post("ispaid"):0,
        "notes"=>$this->input->post("notes"),

        "sub_total"=>$this->input->post("sub_total_amount"),
        "total_discount"=>$this->input->post("total_discount_amount"),
        "total_igst"=>$this->input->post("tigst"),
        "total_cgst"=>$this->input->post("tcgst"),
        "total_sgst"=>$this->input->post("tsgst"),
        "grand_total"=>$this->input->post("grand_total"),
        "created_by"=>  $user_id,
        "created" => date('Y-m-d H:i:s',time()),
      );
     $this->db->trans_start();
        $this->db->where('sale_id',$sale_id);
        if($this->db->update('sales',$data))
        {
          //re-adding stock on current items
            foreach ($current as $key => $val) {
                  $sql = 'UPDATE stocks SET stock = stock + '.$val.' WHERE product_id='.$key;
                  $this->db->query($sql); 
            }

            $this->db->where('sale_id',$sale_id);
            $this->db->delete('sale_items');
            $items  = array();
            $product_items = $this->input->post('item')?:array();
            foreach($product_items as $i => $product_item)
            {   
                            
                $itemData["sale_id"]= $sale_id;
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
               if($this->db->insert_batch('sale_items',$items))
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
                    if($currentstock[$key]['stock']>0){
                    $dataForUpdate["stock"] = $currentstock[$key]['stock']-$val["item_qty"]; 
                     $this->db->where('product_id',$val["product_id"]);
                    if($this->db->update('stocks',$dataForUpdate)){
                        if($current[$val["product_id"]]!=$val["item_qty"])
                          {
                        if($current[$val["product_id"]] > $val["item_qty"]){ //decreased
                          $diff =  $current[$val["product_id"]] - $val["item_qty"];
                          $datas["stock_in"] = $diff;
                          $datas['description']='Update sale item '.$diff;;
                          $datas['created'] = date('Y-m-d H:i:s',time());
                          $datas['created_by'] = $this->aauth->get_user_id();
                          $datas['stock_id']=$currentstock[$key]['stock_id']; 
                          $datas['sale_id']=$sale_id;
                         }
                         if($current[$val["product_id"]] < $val["item_qty"]){ //increased
                          $diff =  $val["item_qty"] - $current[$val["product_id"]];
                          $datas["stock_out"] = $diff;
                          $datas['description']='Update sale item '.$diff;;
                          $datas['created'] = date('Y-m-d H:i:s',time());
                          $datas['created_by'] = $this->aauth->get_user_id();
                          $datas['stock_id']=$currentstock[$key]['stock_id'];
                          $datas['sale_id']=$sale_id;
                         }
                         $res=$this->db->insert('stock_histories',$datas);
                       }
                    }
                    }
                 }
               $this->db->trans_complete();
                return $sale_id;
               }
               return false;
            }
           return false; 
        }
        return false;
    }

     public function delete_sale($sid){
    //get current items    //get current items 
    $saleedetails = $this->get_sale($sid);
    $datai=array();
    foreach ($saleedetails['sale_items'] as $key => $value) { 
    if(isset($current[$value['product_id']])){
     $current[$value['product_id']]  +=  $value['item_qty'];
    } 
    else{
      $current[$value['product_id']] =  $value['item_qty'];
    } 
    }

    foreach ($current as $key => $val) {
          $sql = 'UPDATE stocks SET stock = stock + '.$val.' WHERE product_id='.$key;
          $this->db->query($sql); 
          $stock_id= $this->db->where('product_id',$key)->get('stocks')->row()->stock_id;

          $datas["stock_in"] = $val;
          $datas['description']='Delete sale item '.$val;
          $datas['created'] = date('Y-m-d H:i:s',time());
          $datas['created_by'] = $this->aauth->get_user_id();
          $datas['stock_id']=$stock_id;
          $datas['sale_id']=$sid;
          $res=$this->db->insert('stock_histories',$datas);
    }   

    $data["is_deleted"] = 1;
    $data["deleted_on"] = date('Y-m-d H:i:s');
    $data["deleted_by"] = $this->aauth->get_user_id();

    $this->db->where('sale_id',$sid);
    return $this->db->update('sales',$data);
    return false;
    }
  


        public function get_sale($sale_id)
         {  
        $this->db->select('sales.*');
        $this->db->where('sale_id',$sale_id);
        $query = $this->db->get('sales');

        if($query->num_rows()>0)
        {
            $data["sale_details"] = $query->result_array();
            
            $this->db->select('sale_items.*');
            $this->db->where('sale_id',$sale_id);
            $query = $this->db->get('sale_items');
            if($query->num_rows()>0)
            {

               $data["sale_items"] =$query->result_array();
            }
            else{
              $data["sale_items"] = array();
            }
            return $data;
        }
        return false;
    }

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

 public function  get_client_details($id){
    $this->db->select('*');
    $this->db->where('client_id',$id);
    $query = $this->db->get('clients');
    if($query->num_rows() > 0)
    return $query->row_array();
        
    return false;
   }
 }

