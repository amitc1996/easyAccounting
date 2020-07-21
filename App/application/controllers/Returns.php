<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Returns extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Datatables');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->model('Returns_model');
  }

  /**
     *
     Returns index
     * */

  public function index()
  {
    $data["admin_data"] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data["title"] = "Add Return";
    $data["vendors"] = $this->Returns_model->get_vendors();
    $data["marketplaces"] = $this->Returns_model->get_marketplaces();
    $data["categories"] = $this->Returns_model->get_categories();
    $this->load->view('include/inner_header', $data);
    $this->load->view('returns/add_return', $data);
    $this->load->view('include/inner_footer', $data);
  }

  /**
  * search_product
  * @param void
  * @return json
  * */

  public function search_product(){
    $data["admin_data"] = $this->checkAccess();
    if (isset($_GET['term'])) {
      $result = $this->Returns_model->search_product($_GET['term']);
      if (count($result) > 0) {
        foreach ($result as $row)
        $arr_result[] = array(
          'label'         => $row->item_title,
          'product_id'   => $row->product_id,
        );
        echo json_encode($arr_result);
      }
    }
  }

  /**
  * fetch product details
  * @param int $id
  * @return json
  * */
  public function get_product($product_id)
  {
    $items = $this->Returns_model->get_products($product_id);
    echo json_encode($items);
  }

  /**
  * save_return
  * @param mixed
  * @return json
  * */

  public function save_return(){
    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('marketplace_name','Marketplace Name','trim|required|xss_clean');
    $this->form_validation->set_rules('date_returned','Date Returned','trim|required|xss_clean');

    if($this->form_validation->run()){
      if($this->Returns_model->save_sale()){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('sale_return_successfully_added');
      }else{
        $result["status"] = 0;
        $result["message"] =  $this->lang->line('Error_occured');
      }
    }else{
      $result["status"] = 0;
      $result["message"] = validation_errors();
    }
    echo json_encode($result);
  }



  /** Verify if user is logged in and is admin (for direct requests)
  * @param void
  * @return mixed
  */
  private function checkAccess()
  {
    if($this->aauth->is_loggedin())
    {
      return  $this->session->all_userdata();
    }
    else
    {
      redirect('auth');
      die();
    }
  }


}
?>
