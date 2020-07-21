<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
// ini_set('max_execution_time', 900);

class Products extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->helper('security');
    $this->load->library('Datatables');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->model('Product_model'); 
    $this->load->library('Common');
    $this->load->database();
  }

 /**
     * Products::index()
     * @return void
     */

  public function index(){

    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data['title'] = 'Products';
    $data["taxes"] = $this->common->get_taxes();
    $data["categories"] = $this->common->get_categories();
    $data["brands"] = $this->common->get_brands();
    $data["measurements"] = $this->common->get_measurements();
    $this->load->view('include/inner_header',$data);
    $this->load->view('products/products_listing',$data);
    $this->load->view('include/inner_footer',$data);
  }

   /**
     * Products::add_product()
     * @return void
     */

  public function add_product(){
    $this->form_validation->set_rules('product_name','Product Name','required|trim|xss_clean');
    $this->form_validation->set_rules('category_name','Category Name','trim|required|xss_clean');
    $this->form_validation->set_rules('brand','Brand Name','required|trim|xss_clean');
    $this->form_validation->set_rules('igst','IGST','required|trim|xss_clean');
    $this->form_validation->set_rules('cgst','CGST','required|trim|xss_clean');
    $this->form_validation->set_rules('sgst','SGST','required|trim|xss_clean');
    $this->form_validation->set_rules('measurement','Unit','required|trim|xss_clean');
    $this->form_validation->set_rules('unit_cost','Product Price','trim|required|xss_clean');
    $this->form_validation->set_rules('salling_price','Product Price','trim|required|xss_clean');
    $this->form_validation->set_rules('hsn_sac_code','Hsn/Sac','trim|xss_clean');
    $this->form_validation->set_rules('product_description','Description','trim|xss_clean');
    if($this->form_validation->run()){
      $res = $this->Product_model->add_product();
      if($res){
        $result['message'] = $this->lang->line('product_add_success');
        $result['status'] = 1;
      }else {
        $result['message'] = $this->lang->line('error_occured');
        $result['status'] = 0;
      }
    }else {
      $result['message'] = validation_errors();
      $result['status'] = 0;
    }

    echo json_encode($result);
  }

   /**
     * Products::products_listing()
     * @return json
     */
  public function products_listing(){
    $data["admin_data"] = $this->checkAccess();
    $from =  trim($this->input->post('start'));
    $to =    trim($this->input->post('end'));
    $category_name =  trim($this->input->post('category_name'));
    $condition = ' 1 = 1 ';
    if($category_name)
    $condition.=" AND products.category_id = '$category_name'";

    $cols = 'products.sku,products.item_title,categories.category_name,
    brands.brand_name,products.unit_cost,products.salling_price,products.created,products.product_id';
    $this->datatables->select($cols)
    ->join('categories','categories.category_id = products.category_id')
    ->join('brands','brands.brand_id = products.brand_id')
    ->where('products.is_deleted',0)
    ->where('products.is_disabled',0);
    if($condition != '')
    $this->datatables->where($condition);
    $this->datatables->from('products');
    echo $this->datatables->generate();
  }


  /**
  * edit product details
  * @param int $id
  * @return html
  */
  public function edit_product($id){

    $data['admin_data'] = $this->checkAccess();
    $data['details'] = $this->Product_model->get_product_details($id);
    $data["taxes"] = $this->common->get_taxes();
    $data["categories"] = $this->common->get_categories();
    $data["brands"] = $this->common->get_brands();
    $data["measurements"] = $this->common->get_measurements();
    $data["categories"] = $this->common->get_categories();
    $this->load->view('products/edit_product',$data);
  }

   /**
  * view product details
  * @param int $id
  * @return html
  */

   public function view_product($id){

    $data['admin_data'] = $this->checkAccess();
    $data['details'] = $this->Product_model->get_product_details($id);
    $data['hrecords'] = $this->Product_model->get_hrecords($id);
    $this->load->view('products/view_product',$data);
  }

   /**
  * update product details
  * @param int $id
  * @return json
  */

  public function update_product($id){
    $data['admin_data'] = $this->checkAccess();

    $this->form_validation->set_rules('product_name','Product Name','required|trim|xss_clean');
    $this->form_validation->set_rules('category_name','Category Name','trim|required|xss_clean');
    $this->form_validation->set_rules('brand','Brand Name','required|trim|xss_clean');
    $this->form_validation->set_rules('igst','IGST','required|trim|xss_clean');
    $this->form_validation->set_rules('cgst','CGST','required|trim|xss_clean');
    $this->form_validation->set_rules('sgst','SGST','required|trim|xss_clean');
    $this->form_validation->set_rules('measurement','Unit','required|trim|xss_clean');
    $this->form_validation->set_rules('unit_cost','Product Price','trim|required|xss_clean');
    $this->form_validation->set_rules('salling_price','Product Price','trim|required|xss_clean');
    $this->form_validation->set_rules('hsn_sac_code','Hsn/Sac','trim|xss_clean');
    $this->form_validation->set_rules('product_description','Description','trim|xss_clean');
    if($this->form_validation->run()){
      $res = $this->Product_model->update_product($id);
      if($res){
        $result['message'] = $this->lang->line('product_update_success');
        $result['status'] = 1;
      }else {
        $result['message'] = $this->lang->line('error_occured');
        $result['status'] = 0;
      }
    }else {
      $result['message'] = validation_errors();
      $result['status'] = 0;
    }

    echo json_encode($result);
  }

  /**
  * delete product
  * @param int $id
  * @return json
  */

  public function delete($id){

    $data['admin_data'] = $this->checkAccess();

    $res = $this->Product_model->delete($id);
    if($res){
      $result['message'] = $this->lang->line('product_delete_success');
      $result['status'] = 1;
    }else {
      $result['message'] = $this->lang->line('error_occured');
      $result['status'] = 0;
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
