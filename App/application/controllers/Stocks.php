<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Stocks extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->library('form_validation');
    $this->load->library('Common');
    $this->load->library('Datatables');
    $this->load->model('Stocks_model');
  }


  
/**
 * Stocks::index()
 * @return void
 */

  function index(){
    $data['admin_data'] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $data["wherehouses"] = $this->common->get_wherehouses();
    $data["products"] = $this->common->get_products();

    $data["title"] = "Stocks";
    $this->load->view('include/inner_header',$data);
    $this->load->view('stocks/stocks_listing',$data);
    $this->load->view('include/inner_footer',$data);

  }

  /*
  * data for category datatable
  * @return json
  */
  function stocks_listig(){
    $data["admin_data"] = $this->checkAccess();
    $logged_in_user_id=$this->aauth->get_user_id();
    $this->datatables->select('wherehouses.wherehouse_name,products.item_title,stocks.stock,stocks.stock_id')
    ->join('wherehouses','wherehouses.wherehouse_id = stocks.wherehouse_id')
    ->join('products','products.product_id = stocks.product_id')
    ->where('stocks.is_deleted',0)
    ->from('stocks');
    echo $this->datatables->generate();
  }

  public function add_stock(){
    
    $data["admin_data"] = $this->checkAccess();

    $this->form_validation->set_rules('wherehouse','Wherehouse Name','trim|required|xss_clean');
    $this->form_validation->set_rules('product','Product Name','trim|required|xss_clean');
    $this->form_validation->set_rules('stock','Stock','trim|required|xss_clean');
    if($this->form_validation->run()){
      if($this->Stocks_model->add_stock()){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('stock_added_success');
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

   /**
  * view stock details
  * @param int $id
  * @return html
  */

   public function view_stock($id){

    $data['admin_data'] = $this->checkAccess();
    $data['details'] = $this->Stocks_model->get_stock_details($id);
    //$data['hrecords'] = $this->Stocks_model->get_hrecords($id);
    $this->load->view('stocks/view_stock',$data);
  }

   public function edit_stock($id){
   
    $data["admin_data"] = $this->checkAccess();
    $data["wherehouses"] = $this->common->get_wherehouses();
    $data["products"] = $this->common->get_products();
    $data["details"] = $this->Stocks_model->get_stock_details($id);
    
    $this->load->view('stocks/edit_stock',$data);
  }

  public function update_stock($id){
    $data["admin_data"] = $this->checkAccess();
    $this->form_validation->set_rules('wherehouse','Wherehouse Name','trim|required|xss_clean');
    $this->form_validation->set_rules('product','Product Name','trim|required|xss_clean');
    $this->form_validation->set_rules('stock','Stock','trim|required|xss_clean');

    if($this->form_validation->run()){
      if($this->Stocks_model->update_stock($id)){
        $result["status"] = 1;
        $result["message"] = $this->lang->line('stock_update_success');
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


  public function delete_stock($id){

    $data['admin_data'] = $this->checkAccess();
    $del = $this->Stocks_model->delete($id);

    if($del){
      $result['message'] = $this->lang->line('stock_delete_success');
      $result['status'] = 1;
    }else {
      $result['message'] = $this->lang->line('error_occured');
      $result['status'] = 0;
    }

    echo json_encode($result);
  }

  public function get_stock_history($id){
    $this->datatables->select('action,created,stock,description')
    ->where('stock_id',$id)
    ->from('stock_histories');
    echo $this->datatables->generate();
  }



  /** Verify if user is logged in and is admin (for direct requests)
  * @param void
  * @return mixed
  */

  private function checkAccess(){

    if($this->aauth->is_loggedin()){
      return  $this->session->all_userdata();
    }
    else{
      redirect('/auth/login/');
    }
  }
}
?>
