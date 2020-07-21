<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Clients_model extends CI_Model{

  public function __construct(){

    $this->load->database();
  }

  /**
  * Clients_model::add_client()
  *
  * @return bool
  */
  public function add_client(){
    $data = array(
      "client_orgnisation_name"=>$this->input->post("client_orgnisation_name"),
      "client_orgnisation_phone"=>$this->input->post("client_orgnisation_phone"),

      "client_email"=>$this->input->post("client_email"),
      "client_name"=>$this->input->post("client_name"),
      "client_mobile"=>$this->input->post("client_mobile"),
      "client_tax_number"=>$this->input->post("client_tax_number"),
      "gstin"=>$this->input->post("gstin"),

      "client_address_s"=>$this->input->post("client_address_s"),
      "client_city_s"=>$this->input->post("client_city_s"),
      "client_state_s"=>$this->input->post("client_state_s"),
      "client_country_s"=>$this->input->post("client_country_s"),
      "client_zip_s"=>$this->input->post("client_zip_s"),

      "client_address_b"=>$this->input->post("client_address_b"),
      "client_city_b"=>$this->input->post("client_city_b"),
      "client_state_b"=>$this->input->post("client_state_b"),
      "client_country_b"=>$this->input->post("client_country_b"),
      "client_zip_b"=>$this->input->post("client_zip_b"),

      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );

    $res = $this->db->insert('clients', $data);
    if($res) return true;
    return false;
  }

 /**
  * Clients_model::get_clients_details()
  * @return bool
  */
  public function get_clients_details($id)
  {
    $this->db->select('*');
    $this->db->from('clients');
    $this->db->where('client_id',$id);
    $query = $this->db->get();
    $row = $query->result_array();
    return  $row;
  }

  /**
  * Clients_model::update_client()
  * @return bool
  */
  public function update_client($id){
    $data = array(
      
      "client_orgnisation_name"=>$this->input->post("client_orgnisation_name"),
      "client_orgnisation_phone"=>$this->input->post("client_orgnisation_phone"),

      "client_email"=>$this->input->post("client_email"),
      "client_name"=>$this->input->post("client_name"),
      "client_mobile"=>$this->input->post("client_mobile"),
      "client_tax_number"=>$this->input->post("client_tax_number"),
      "gstin"=>$this->input->post("gstin"),
      
       "client_address_s"=>$this->input->post("client_address_s"),
      "client_city_s"=>$this->input->post("client_city_s"),
      "client_state_s"=>$this->input->post("client_state_s"),
      "client_country_s"=>$this->input->post("client_country_s"),
      "client_zip_s"=>$this->input->post("client_zip_s"),

      "client_address_b"=>$this->input->post("client_address_b"),
      "client_city_b"=>$this->input->post("client_city_b"),
      "client_state_b"=>$this->input->post("client_state_b"),
      "client_country_b"=>$this->input->post("client_country_b"),
      "client_zip_b"=>$this->input->post("client_zip_b"),

      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );
    $this->db->where('client_id',$id);
    $this->db->where('is_deleted',0);
    $res =$this->db->update('clients',$data);

    if($res) return true;
    return false;
  }

 /**
  * Clients_model::delete_client()
  * @return bool
  */
  public function delete_client($id){
    $data =array(
      "is_deleted" => 1,
      "deleted_by" => $this->aauth->get_user_id(),
      "deleted_on" => date('Y-m-d H:i:s',time())
    );
    $this->db->where('client_id', $id);
    $result = $this->db->update('clients',$data);

    if($result) return true;
    return false;
  }
}
?>
