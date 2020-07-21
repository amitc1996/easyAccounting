<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class  Measurements_model extends CI_Model{


  public function __construct(){

    $this->load->database();
  }

  /**
  * Measurements_model::add_brand()
  *
  * @return bool
  */
  public function add_measurement(){
    $data = array(
      "measurement_name"=>$this->input->post("measurement_name"),
      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );

    $res = $this->db->insert('measurements', $data);

    if($res) return true;
    return false;
  }

  /**
  * Get brand details
  * @param int
  * @return array()
  * */
  public function get_measurement_details($id)
  {
    $this->db->select('*');
    $this->db->from('measurements');
    $this->db->where('measurement_id',$id);
    $query = $this->db->get();
    $row = $query->result_array();
    return  $row;
  }

  /**
  * update measurement
  * @param int
  * @return bool
  * */
  public function update_measurement($id){
    $data = array(
      "measurement_name"=>$this->input->post("measurement_name"),
      "last_updated"=> date('Y-m-d H:i:s',time())
    );
    $this->db->where('measurement_id',$id);
    $this->db->where('is_deleted',0);
    $res =$this->db->update('measurements',$data);

    if($res) return true;
    return false;
  }

  /**
  * Measurements_model::delete()
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
    $this->db->where('measurement_id', $id);
    $result = $this->db->update('measurements',$data);

    if($result) return true;
    return false;
  }
}

?>
