<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class  Categories_model extends CI_Model{

  private $table_name = 'categories';

  public function __construct(){

    $this->load->database();
  }

  /**
  * Categories_model::add_category()
  *
  * @return bool
  */
  public function add_category(){

    $data = array(
      "category_name"=>$this->input->post("category_name"),
      "created_by"=> $this->aauth->get_user_id(),
      "created" => date('Y-m-d H:i:s',time()),
      "last_updated" => date('Y-m-d H:i:s',time()),
      "is_deleted"=> 0
    );

    $res = $this->db->insert($this->table_name, $data);

    if($res) return true;
    return false;
  }

  /**
  * Get category details
  * @param int
  * @return array()
  * */
  public function get_category_details($id)
  {
    $this->db->select('*');
    $this->db->from($this->table_name);
    $this->db->where('category_id',$id);
    $query = $this->db->get();
    $row = $query->result_array();
    return  $row;
  }

  /**
  * update category
  * @param int
  * @return bool
  * */
  public function update_category($id){
    $data = array(
      "category_name"=>$this->input->post("category_name"),
      "last_updated"=> date('Y-m-d H:i:s',time())
    );
    $this->db->where('category_id',$id);
    $this->db->where('is_deleted',0);
    $res =$this->db->update($this->table_name,$data);

    if($res) return true;
    return false;
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
    $this->db->where('category_id', $id);
    $result = $this->db->update($this->table_name,$data);

    if($result) return true;
    return false;
  }
}

?>
