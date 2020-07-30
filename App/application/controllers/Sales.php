<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sales extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->library('Datatables');
        $this->load->library('Aauth');
        $this->load->library('Common');
        $this->load->library('form_validation');
        $this->load->model('Sales_model');
    }
    /**
     *
     *Sales index
     * */

     public function index()
     {
        $data["admin_data"] = $this->checkAccess();
        $data['permissions'] = getUserPermissions();
        $data["title"] = "Sales";
        $this->load->view('include/inner_header', $data);
        $this->load->view('sales/sales_listing', $data);
        $this->load->view('include/inner_footer', $data);
    }

    /**
    * Load sales list for datatable
    *
    * @return json
    */
    public function sales_listing()
    {
        $_POST['sColumns'] = '';
        $data["admin_data"] = $this->checkAccess();
        $looged_in_user_id=$this->aauth->get_user_id();
        $this->datatables->select('sales.invoice_number,clients.client_name,sales.invoice_date,sales.paid_amount,sales.grand_total,sales.is_paid,sales.created,sales.sale_id')
        ->where('sales.is_deleted',0)
        ->from('sales')
        ->join('clients','clients.client_id=sales.client_id','left');
        echo $this->datatables->generate();
    }

  /**
     *
    * add_sale
     * */

     public function add_sale()
     {
        $data["admin_data"] = $this->checkAccess();
        $data['permissions'] = getUserPermissions();
        $data["title"] = "New Sale";
        $data["clients"] = $this->common->get_clients();
        $data["wherehouses"] = $this->common->get_wherehouses();
        $data["measurements"] = $this->common->get_measurements();
        $data["invoice_number"] = $this->common->get_invoice_no();
        $data['company_profile']=$this->common->company_profile();
        $this->load->view('include/inner_header', $data);
        $this->load->view('sales/add_sale', $data);
        $this->load->view('include/inner_footer', $data);
    }

   /**
     * save_sale
     * */

       public function save_sale(){
        $data["admin_data"] = $this->checkAccess();
        $is_submit_and_pay=$this->input->post('is_submit_and_pay');
        $this->form_validation->set_rules('client_name','Client Name','trim|required|xss_clean');
        $this->form_validation->set_rules('invoice_date','Invoice Date','trim|required|xss_clean');
             if($this->form_validation->run()){
              if($sale_id=$this->Sales_model->save_sale()){
                if($is_submit_and_pay){
                  $result["status"] = 1;
                  $result["message"] = $this->lang->line('sale_successfully_added');
                  $result["redirect_url"] = base_url('sales/receipt/'.$sale_id);
               }
                else{
                  $result["status"] = 1;
                  $result["message"] = $this->lang->line('sale_successfully_added');
                  $result["redirect_url"] = base_url('sales/add_sale');
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

     public function receipt($id){
        $data['admin_data'] = $this->checkAccess();
        $data['permissions'] = getUserPermissions();
        $data["branches"] = $this->common->get_branches();
        $data["ledgers"] = $this->common->get_ledgers();
        $data["account_groups"] = $this->common->get_account_groups();
        $data["details"] = $this->Sales_model->get_sale($id);
        $data["receipt_number"] = $this->common->get_receipt_no();
        $data['company_profile']=$this->common->company_profile();
        $data["title"] = "Pay Sale";
        $this->load->view('include/inner_header',$data);
        $this->load->view('sales/pay_sale',$data);
        $this->load->view('include/inner_footer',$data);
      }

      public function edit_sale($sid){
        $data["admin_data"] = $this->checkAccess();
        $data['permissions'] = getUserPermissions();
        $data["title"] = "Edit Sale";
        $data["clients"] = $this->common->get_clients();
        $data["wherehouses"] = $this->common->get_wherehouses();
        $data["measurements"] = $this->common->get_measurements();
        $data["invoice_number"] = $this->common->get_invoice_no();
        $data['company_profile']=$this->common->company_profile();
        $data["details"] = $this->Sales_model->get_sale($sid);

        $this->load->view('include/inner_header', $data);
        $this->load->view('sales/edit_sale', $data);
        $this->load->view('include/inner_footer', $data);
      }

        public function search_product(){
        $data["admin_data"] = $this->checkAccess();
        if (isset($_GET['term'])) {
          $result = $this->common->search_product($_GET['term']);
           echo json_encode($result);
        }
      }

      public function get_product($product_id)
      {
        $items = $this->Sales_model->get_products($product_id);
        echo json_encode($items);
      }

      public function update_sale($sid){
        $data["admin_data"] = $this->checkAccess();
       $is_submit_and_pay=$this->input->post('is_submit_and_pay');
        $this->form_validation->set_rules('client_name','Client Name','trim|required|xss_clean');
        $this->form_validation->set_rules('invoice_date','Invoice Date','trim|required|xss_clean');
            if($this->form_validation->run()){
              if($sid=$this->Sales_model->update_sale($sid)){
                if($is_submit_and_pay){
                  $result["status"] = 1;
                  $result["message"] = $this->lang->line('sale_successfully_updated');
                  $result["redirect_url"] = base_url('sales/receipt/'.$sid);
               }
                else{
                  $result["status"] = 1;
                  $result["message"] = $this->lang->line('sale_successfully_updated');
                  $result["redirect_url"] = base_url('sales/edit_sale/'.$sid);
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


     /**
    * Sales::view_sale_records()
    */
   public function view_sale($sid)
        {

            $data['admin_data'] = $this->checkAccess();
            $data["admin_data"] = $this->checkAccess();
            $data['permissions'] = getUserPermissions();
            $data['company_profile']=$this->common->company_profile();
            $data["details"] = $this->Sales_model->get_sale($sid);

            $data["title"] = "View Sale";
            $this->load->view('include/inner_header', $data);
            $this->load->view('sales/view_sale',$data);
            $this->load->view('include/inner_footer', $data);
        }


 public function delete_sale($sid){
        $data["admin_data"] = $this->checkAccess();
       
        if($stock=$this->Sales_model->delete_sale($sid)){
            $result["status"] = 1;
            $result["message"] = $this->lang->line('sale_delete_success');
           
          }else{
            $result["status"] = 0;
            $result["message"] =  $this->lang->line('error_occured');
          }
            
        echo json_encode($result);
     }

 public function send_invoice($sid){
    $data["admin_data"] = $this->checkAccess();
    $data["details"] = $this->Sales_model->get_sale($sid);
    $data['site_name'] = $this->config->item('name', 'aauth');
    $email=$data["details"]['sale_details'][0]['client_email'];
    $filename=$data["details"]['sale_details'][0]['sale_id'].'.pdf';

    if($email){
      if($this->_send_email('send_invoice', $email, $data)){
            unlink('uploads/invoices/'.$filename);
            $result["status"] = 1;
            $result["message"] = $this->lang->line('email_successfully_sent');
      }
      else{
           $result["status"] = 0;
            $result["message"] =  $this->lang->line('error_occured');
      }
    }
    else{
       $result["status"] = 0;
       $result["message"] =  $this->lang->line('no_email_available');
    }
     echo json_encode($result);
 }    
 
  /**
  * generate PDF
  * @param int $id
  * @return html
  **/

  public function print_sale()
  {

      $data["admin_data"] = $this->checkAccess();
      $data['permissions'] = getUserPermissions();
    
      $data['print_type']=$this->input->post('print_type');
      $data['company_profile']=$this->common->company_profile(1);
      $data["details"] = $this->Sales_model->get_sale($this->input->post('sale_id'));

      $this->load->library('pdf');
      $html=$this->load->view('invoice', $data, true);
      $this->pdf->createPDF($html,'mypdf',false);
  }

  public function get_pdf_path($data)
  {
      $data["admin_data"] = $this->checkAccess();
      $data['permissions'] = getUserPermissions();
      $data['company_profile']=$this->common->company_profile(1);
      $data['print_type']="Orignal Copy";
      $filename=$data['sale_details'][0]['sale_id'].'.pdf';
      $this->load->library('pdf');
      $html=$this->load->view('invoice', $data, true);
      $this->pdf->createPDFEmail($html,$filename);
      return base_url('uploads/invoices/'.$filename);
  }


    public function get_client_details($id){
     $clients = $this->Sales_model->get_client_details($id);
     echo json_encode($clients);
    }

/**
     * Send email message of given type (activate, email, etc.)
     *
     * @param   string
     * @param   string
     * @param   array
     * @return  void
     */
function _send_email($type, $email, &$data)
{
  $data["admin_data"] = $this->checkAccess();
  $this->load->library('email');
  $this->email->from($this->config->item('email', 'aauth'), $this->config->item('name', 'aauth'));
  $this->email->reply_to($this->config->item('email', 'aauth'), $this->config->item('name', 'aauth'));
  $this->email->to($email);
  $this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('name', 'aauth')));
  $this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
  $this->email->attach($this->get_pdf_path($data['details']));
  $this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
  
  if($this->email->send()){
    return true;
  }
  else{
    return false;
  }
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
