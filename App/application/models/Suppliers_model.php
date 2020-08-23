<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Suppliers_model extends CI_Model{

  public function __construct(){

    $this->load->database();
  }

  /**
  * Suppliers_model::add_supplier()
  *
  * @return bool
  */
  public function add_supplier(){
    $data = array(

      "supplier_orgnisation_name"=>$this->input->post("supplier_orgnisation_name"),
      "supplier_orgnisation_phone"=>$this->input->post("supplier_orgnisation_phone"),

      "supplier_email"=>$this->input->post("supplier_email"),
      "supplier_name"=>$this->input->post("supplier_name"),
      "supplier_mobile"=>$this->input->post("supplier_mobile"),
      "supplier_tax_number"=>$this->input->post("supplier_tax_number"),
       "gstin"=>$this->input->post("gstin"),

      "supplier_address_b"=>$this->input->post("supplier_address_b"),
      "supplier_city_b"=>$this->input->post("supplier_city_b"),
      "supplier_state_b"=>$this->input->post("supplier_state_b"),
      "supplier_country_b"=>$this->input->post("supplier_country_b"),
      "supplier_zip_b"=>$this->input->post("supplier_zip_b"),

      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );

    $res = $this->db->insert('suppliers', $data);
    if($res) return true;
    return false;
  }

  /**
  * Suppliers_model::get_supplier_details()
  *
  * @return bool
  */
  public function get_supplier_details($id)
  {
    $this->db->select('*');
    $this->db->from('suppliers');
    $this->db->where('supplier_id',$id);
    $query = $this->db->get();
    $row = $query->result_array();
    return  $row;
  }

  /**
  * Suppliers_model::update_supplier()
  *
  * @return bool
  */
  public function update_supplier($id){
    $data = array(
      "supplier_orgnisation_name"=>$this->input->post("supplier_orgnisation_name"),
      "supplier_orgnisation_phone"=>$this->input->post("supplier_orgnisation_phone"),

      "supplier_email"=>$this->input->post("supplier_email"),
      "supplier_name"=>$this->input->post("supplier_name"),
      "supplier_mobile"=>$this->input->post("supplier_mobile"),
      "supplier_tax_number"=>$this->input->post("supplier_tax_number"),
       "gstin"=>$this->input->post("gstin"),

      "supplier_address_b"=>$this->input->post("supplier_address_b"),
      "supplier_city_b"=>$this->input->post("supplier_city_b"),
      "supplier_state_b"=>$this->input->post("supplier_state_b"),
      "supplier_country_b"=>$this->input->post("supplier_country_b"),
      "supplier_zip_b"=>$this->input->post("supplier_zip_b"),

      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );
    $this->db->where('supplier_id',$id);
    $this->db->where('is_deleted',0);
    $res =$this->db->update('suppliers',$data);

    if($res) return true;
    return false;
  }

   /**
  * Suppliers_model::delete_supplier()
  *
  * @return bool
  */
  public function delete_supplier($id){
    $data =array(
      "is_deleted" => 1,
      "deleted_by" => $this->aauth->get_user_id(),
      "deleted_on" => date('Y-m-d H:i:s',time())
    );
    $this->db->where('supplier_id', $id);
    $result = $this->db->update('suppliers',$data);

    if($result) return true;
    return false;
  }
}

?>
