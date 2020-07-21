<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Purchases extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->library('Datatables');
        $this->load->library('Aauth');
        $this->load->library('form_validation');
        $this->load->library('Common');
        $this->load->model('Purchase_return_model');
    }
    

  /**
     * Purchases::index()
     * @return void
     */

     public function index()
     {
        $data["admin_data"] = $this->checkAccess();
        $data['permissions'] = getUserPermissions();
        $data["title"] = "Purchases";
        $this->load->view('include/inner_header', $data);
        $this->load->view('purchases/purchase_listing', $data);
        $this->load->view('include/inner_footer', $data);
    }
    
    /**
     * Purchases::purchase_listing()
     * @return json
     */
    public function purchase_listing()
    {
        $_POST['sColumns'] = '';
        $data["admin_data"] = $this->checkAccess();   
        $looged_in_user_id=$this->aauth->get_user_id();
        $this->datatables->select('purchases.po_number,purchases.supplier_name,purchases.purchase_date,purchases.paid_amount,purchases.grand_total,purchases.is_paid,purchases.created,purchases.purchase_id')
        ->where('purchases.is_returned',0)
        ->from('purchases');
        echo $this->datatables->generate();
    }
    
 /**
     * Purchases::new_purchase()
     * @return json
     */
     public function new_purchase()
     {
        $data["admin_data"] = $this->checkAccess();
        $data['permissions'] = getUserPermissions();
        $data["title"] = "New Purchase";
        $data["suppliers"] = $this->common->get_supplier();
        $data["wherehouses"] = $this->common->get_wherehouses();
        $data["taxes"] = $this->common->get_taxes();
        $data["measurements"] = $this->common->get_measurements();
        $data["po_number"] = $this->common->get_po_no();
        $data['company_profile']=$this->common->company_profile();
        $this->load->view('include/inner_header',$data);
        $this->load->view('purchases/new_purchase',$data);
        $this->load->view('include/inner_footer',$data);
    }
   /**
     * Purchases::save_purchase()
     * @return json
     */
       public function save_purchase(){
        $data["admin_data"] = $this->checkAccess();
        $is_submit_and_pay=$this->input->post('is_submit_and_pay');
        $this->form_validation->set_rules('date_purchased','Date Purchased','trim|required|xss_clean');
            if($this->form_validation->run()){
              if($purchase_id=$this->Purchase_return_model->save_purchase()){
                if($is_submit_and_pay){
                  $result["status"] = 1;
                  $result["message"] = $this->lang->line('purchase_successfully_added');
                  $result["redirect_url"] = base_url('purchases/payment/'.$purchase_id);
               }
                else{
                  $result["status"] = 1;
                  $result["message"] = $this->lang->line('purchase_successfully_added');
                  $result["redirect_url"] = base_url('purchases/new_purchase');
                }
              }else{
                $result["status"] = 0;
                $result["message"] =  $this->lang->line('error_occured');
              }
            }else{
              $result["status"] = 0;
              $result["message"] = validation_errors();
            }
        echo json_encode($result);
     }

      public function payment($id){
        $data['admin_data'] = $this->checkAccess();
        $data['permissions'] = getUserPermissions();
        $data["branches"] = $this->common->get_branches();
        $data["ledgers"] = $this->common->get_ledgers();
        $data["account_groups"] = $this->common->get_account_groups();
        $data['details']= $this->Purchase_return_model->get_purchase($id);
        $data["voucher_number"] = $this->common->get_voucher_no();
        $data["title"] = "Pay Purchase";
        $this->load->view('include/inner_header',$data);
        $this->load->view('purchases/pay_purchase',$data);
        $this->load->view('include/inner_footer',$data);
      }
     
     /**
     * Purchases::view_purchase()
     * @return json
     */
    public function view_purchase($id){

        $data['admin_data'] = $this->checkAccess();
       //$data['details'] = $this->Purchase_return_model->get_purchase($id);
        $data["admin_data"] = $this->checkAccess();
        $data['permissions'] = getUserPermissions();
        $data['details']= $this->Purchase_return_model->get_purchase($id);
        $data['company_profile']=$this->common->company_profile();
        $data["title"] = "View Purchase";
        $this->load->view('include/inner_header', $data);
        $this->load->view('purchases/view_purchase',$data);
        $this->load->view('include/inner_footer', $data);
    }

     /**
     * Purchases::search_product()
     * @return json
     */
    public function search_product(){
        $data["admin_data"] = $this->checkAccess();
        if (isset($_GET['term'])) {
          $result = $this->common->search_product($_GET['term']);
           echo json_encode($result);
        }
      }
 
     /**
     * Purchases::get_product()
     * @return json
     */  
     public function get_product($product_id)
      {
        $items = $this->common->get_products_details($product_id);
        echo json_encode($items);
      }  
    /**
     * Purchases::get_wherehouse_address()
     * @return json
     */ 
     public function get_wherehouse_address($id){
      $wherehouse= $this->Purchase_return_model->get_wherehouse_address($id);
      echo json_encode($wherehouse);
     }
      /**
     * Purchases::get_supplier_details()
     * @return json
     */ 
      public function get_supplier_details($id){
      $suppler = $this->Purchase_return_model->get_supplier_details($id);
      echo json_encode($suppler);
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
