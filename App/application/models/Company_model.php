<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $ci =& get_instance();
    $this->load->database();
  }

  /**
  * Company_model::get_details()
  * @param int
  * @return array()
  * */
  function get_details($id)
  {
    $this->db->select('*');
    $this->db->from('company_profiles');
    $query = $this->db->get();
    $row = $query->result_array();
    return  $row;
  }

  /**
  * Company_model::checkDetails()
  * @param int
  * @return array()
  * */
  function checkDetails($id){

    $this->db->select('*')
    ->from('company_profiles');

    $result = $this->db->get();
    if($result->num_rows() > 0) return $result->result_array();
    return NULL;
  }

  /**
  * Company_model::updateCompany()
  *
  * @param int $id
  * @return
  */
  function updateCompany($id){
    $currency = $this->common->get_currencies($this->input->post('currency'));
    $data = array(
      'company_name'=>$this->input->post('name'),
      'email'=>$this->input->post('company_email'),
      'mobile'=>$this->input->post('mobile'),
      'work_phone'=>$this->input->post('workphone'),
      'tax'=>$this->input->post('tax'),
      'website'=>$this->input->post('website'),
      'address'=>$this->input->post('address'),
      'country'=>$this->input->post('country_name'),
      'state'=>$this->input->post('state'),
      'city'=>$this->input->post('city'),
      'zip'=>$this->input->post('zip'),
      'notes'=>$this->input->post('note'),
      'declaration'=>$this->input->post('declaration'),
      'terms'=>$this->input->post('terms'),
      "financial_year_start"=>date("Y-m-d", strtotime($this->input->post("financial_year_start"))),
      "financial_year_end"=>date("Y-m-d", strtotime($this->input->post("financial_year_end"))),
      'gstin'=>$this->input->post('gstin'),
      'bank_name'=>$this->input->post('bank_name'),
      'account_number'=>$this->input->post('account_number'),
      'branch_name'=>$this->input->post('branch_name'),
      'ifsc_code'=>$this->input->post('ifsc_code'),
      'ad_code'=>$this->input->post('ad_code'),
      'swift_code'=>$this->input->post('swift_code'),
      'logo_image'=>$this->input->post('logo'),
      'signature_image'=>$this->input->post('sign'),
      'signature'=>$this->input->post('signature'),
    );

    if($this->db->update('company_profiles',$data)) 
    return true;
    return false;
  }
}
