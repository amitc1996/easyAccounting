<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'third_party/PhpOffice/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        // $this->form_validation->set_rules('vendor_name','Vendor Name','trim|required|xss_clean');
        $is_submit_and_pay=$this->input->post('is_submit_and_pay');
        $this->form_validation->set_rules('client_name','Client Name','trim|required|xss_clean');
        $this->form_validation->set_rules('invoice_date','Invoice Date','trim|required|xss_clean');
            if($this->form_validation->run()){
              if($sale_id=$this->Sales_model->save_sale()){
                if($sale_id){
                  $result["status"] = 1;
                  $result["message"] = $this->lang->line('sale_successfully_added');
                  $result["redirect_url"] = base_url('sales/receipt/'.$sale_id);
               }else{
                $result["status"] = 1;
                $result["message"] = $this->lang->line('sale_successfully_added');
               }
              }
              else{
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
        $this->load->view('sales/add_sale', $data);
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
        // $this->form_validation->set_rules('vendor_name','Vendor Name','trim|required|xss_clean');
        $this->form_validation->set_rules('marketplace_name','Marketplace Name','trim|required|xss_clean');
        $this->form_validation->set_rules('date_saled','Date Saled','trim|required|xss_clean');
            if($this->form_validation->run()){
              if($stock=$this->Sales_model->update_sale($sid)){
                $result["status"] = 1;
                $result["message"] = $this->lang->line('sale_successfully_updated');
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
           //$data['details'] = $this->Purchase_model->get_purchase($id);
            $data["admin_data"] = $this->checkAccess();
            $data['permissions'] = getUserPermissions();
            $data['company_profile']=$this->common->company_profile();
            $data["details"] = $this->Sales_model->get_sale($sid);

            $data["title"] = "View Sale";
            $this->load->view('include/inner_header', $data);
            $this->load->view('sales/view_sale',$data);
            $this->load->view('include/inner_footer', $data);
        }

  /**
  * generate excel file of the reords
  **/

  function generate_xlsx(){
    $fileName = 'coid_sales-'.time().'.csv';
    $productData = $this->Sales_model->get_sale_for_document();
  /*  echo '<pre>';
    print_r($productData);die;*/
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Invoice Id');
    $sheet->setCellValue('B1', 'Bill Date');
    $sheet->setCellValue('C1', 'Marketplace');
    $sheet->setCellValue('D1', 'Total Cost');
    $sheet->setCellValue('E1', 'Total Marketplace Fee');
    $sheet->setCellValue('F1', 'Total Paypal fee');
    $sheet->setCellValue('G1', 'Total Shipping Price');
    $sheet->setCellValue('H1', 'Total Net Cost');
    $sheet->setCellValue('I1', 'Total Selling Price');
    $sheet->setCellValue('J1', 'Total Net Profit');
    $sheet->setCellValue('K1', 'Created Date');
    $sheet->setCellValue('L1', 'Item Title');
    $sheet->setCellValue('M1', 'SKU');
    $sheet->setCellValue('N1', 'Category');
    $sheet->setCellValue('O1', 'Location');
    $sheet->setCellValue('P1', 'Stock');
    $sheet->setCellValue('Q1', 'Item Quantity');
    $sheet->setCellValue('R1', 'Unit Cost');
    $sheet->setCellValue('S1', 'Total Cost');
    $sheet->setCellValue('T1', 'Marketplace Fee');
    $sheet->setCellValue('U1', 'Paypal fee');
    $sheet->setCellValue('V1', 'Shipping Cost');
    $sheet->setCellValue('W1', 'Net Cost');
    $sheet->setCellValue('X1', 'Salling Price');
    $sheet->setCellValue('Y1', 'Net Profit');
    
    $rows = 2;

    foreach ($productData as $val){
      $cols = array('D'.$rows,'E'.$rows,'F'.$rows,'G'.$rows,'H'.$rows,'I'.$rows);
      foreach ($cols as $key => $value) {
        $sheet->getStyle($value)
        ->getNumberFormat()
        ->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
      }


      $sheet->setCellValue('A' . $rows, $val['invoice_id']);
      $sheet->setCellValue('B' . $rows, date('m/d/Y',strtotime($val['date_sold'])));
      $sheet->setCellValue('C' . $rows, $val['marketplace_name']);
      $sheet->setCellValue('D' . $rows, $val['total_final_cost']);
      $sheet->setCellValue('E' . $rows, $val['total_ebay_fee']);
      $sheet->setCellValue('F' . $rows, $val['total_pay_pal_fee']);
      $sheet->setCellValue('G' . $rows, $val['total_shipping_cost']);
      $sheet->setCellValue('H' . $rows, $val['total_net_cost']);
      $sheet->setCellValue('I' . $rows, $val['total_selling_price']);
      $sheet->setCellValue('J' . $rows, $val['total_net_profit']);
      $sheet->setCellValue('K' . $rows, date('m/d/Y',strtotime($val['created'])));
      $sheet->setCellValue('L' . $rows, $val['item_title']);
      $sheet->setCellValue('M' . $rows, $val['sku']);
      $sheet->setCellValue('N' . $rows, $val['category_name']);
      $sheet->setCellValue('O' . $rows, $val['location']);
      $sheet->setCellValue('P' . $rows, $val['stock']);
      $sheet->setCellValue('Q' . $rows, $val['item_qty']);
      $sheet->setCellValue('R' . $rows, $val['unit_cost']);
      $sheet->setCellValue('S' . $rows, $val['total_cost']);
      $sheet->setCellValue('T' . $rows, $val['ebay_fee']);
      $sheet->setCellValue('U' . $rows, $val['paypal_fee']);
      $sheet->setCellValue('V' . $rows, $val['shipping_cost']);
      $sheet->setCellValue('W' . $rows, $val['net_cost']);
      $sheet->setCellValue('X' . $rows, $val['selling_price']);
      $sheet->setCellValue('Y' . $rows, $val['net_profit']);
      
      $rows++;
    }

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $writer->save("uploads/".$fileName);
    redirect(base_url()."/uploads/".$fileName);
  }


  function import_csv(){
    $data["admin_data"] = $this->checkAccess();
    $data['permissions'] = getUserPermissions();
    $config['upload_path'] = 'uploads';
    $config['allowed_types'] = 'csv';
    $this->load->library('upload', $config);
     if (!$this->upload->do_upload('import_file'))
        {
                $error = array('error' => $this->upload->display_errors());
                echo "<pre>";
                print_r($error);
                echo "</pre>";

        }
        else
        {
            $file_data = $this->upload->data();
             $fields = array('Invoice Id', 'Bill Date', 'Marketplace', 'Total Cost', 'Total Marketplace Fee', 'Total Paypal fee','Total Shipping Price','Total Net Cost','Total Selling Price','Total Net Profit','Created Date','Item Title','SKU','Category','Location','Stock','Item Quantity','Unit Cost','Total Cost','Marketplace Fee','Paypal fee','Shipping Cost','Net Cost','Salling Price','Net Profit');
            $data["sales"] = array(); $i = 0;
            $handle = @fopen($file_data["full_path"], "r");

            if ($handle) {
                while (($row = fgetcsv ($handle, 4096)) !== false) {
                    
                    foreach ($row as $k=>$value) {
                        @$data["sales"][$i][$fields[$k]] = $value;
                    }
                    $i++;
                }
               
               
                if (!feof($handle)) {
                    echo "Error: unexpected fgets() fail\n";
                }
                fclose($handle);
            }
            unlink($file_data["full_path"]);
            $data["title"] = "Sales";
            $data["vendors"] = $this->Sales_model->get_vendors();
            $data["marketplaces"] = $this->Sales_model->get_marketplaces();
            $data["categories"] = $this->Sales_model->get_categories();
            $this->load->view('include/inner_header', $data);
            $this->load->view('sales/import_via_csv', $data);
            $this->load->view('include/inner_footer', $data);
        }
   }

    public function save_import()
      {
         $data["admin_data"] = $this->checkAccess();
          $user_id=$this->aauth->get_user_id();
          $post_data = $this->input->post();
  /*       echo "<pre>";print_r($post_data);die;*/
         if(count($post_data)>0){
            
              foreach($post_data['invoice_id'] as $key => $val)
              {
               $sale[$key]= array(
                  "invoice_id"=>$val,
                  "marketplace_id"=>$post_data['marketplace_name'][$val],
                  "date_sold"=>date("Y-m-d", strtotime($post_data['bill_date'][$val])),
                  "total_final_cost"=>$post_data['total_cost'][$val],
                  "total_ebay_fee"=>$post_data['total_marketplace_fee'][$val],
                  "total_pay_pal_fee"=>$post_data['total_paypal_fee'][$val],
                  "total_shipping_cost"=>$post_data['total_shipping_price'][$val],
                  "total_net_cost"=>$post_data['total_net_cost'][$val],
                  "total_selling_price"=>$post_data['total_selling_price'][$val],
                  "total_net_profit"=>$post_data['total_net_profit'][$val],
                  "created_by"=>  $user_id,
                  "created" => date("Y-m-d", strtotime($post_data['created_date'][$val])),
                  "item_title"=>$post_data['item_title'][$val],
                  "sku"=>$post_data['sku'][$val],
                  "category_name"=>$post_data['category_name'][$val],
                  "location"=>$post_data['location'][$val],
                  "stock"=>$post_data['stock'][$val],
                  "item_quantity"=>$post_data['item_quantity'][$val],
                  "unit_cost"=>$post_data['unit_cost'][$val],
                  "marketplace_fee"=>$post_data['marketplace_fee'][$val],
                  "paypal_fee"=>$post_data['paypal_fee'][$val],
                  "shipping_cost"=>$post_data['shipping_cost'][$val],
                  "net_cost"=>$post_data['net_cost'][$val],
                  "salling_price"=>$post_data['salling_price'][$val],
                  "net_profit"=>$post_data['net_profit'][$val],
                  );
                }
              if($inserted = $this->Sales_model->import_sales($sale))
                $msgdata = array('count'  => $inserted, 'status'  => '1' );
              else
                $msgdata = array('count'  => "0", 'status' => '0' );
          }
          else
            $msgdata = array( 'count'  => "0",'status'     => '0');
            
          echo json_encode($msgdata); 
      }

  public function redirect_to_list()
       {
           $inserted = $this->input->post('count');
           if($inserted=="0")
              {
                      $msgdata = array(
                       'message'  => 'Error occured.',
                       'class'     => 'danger'
                        );
                        $this->session->set_flashdata($msgdata);
                       
              }
              else{
                   $msgdata = array(
                       'message'  => $inserted.' records have been successfully imported.',
                       'class'     => 'success'
                        );
                        $this->session->set_flashdata($msgdata);
                       
              }
               redirect('sales'); 
       }

  /**
  * generate PDF
  * @param int $id
  * @return html
  **/

  function print_sale()
  {
      $data["admin_data"] = $this->checkAccess();
      $data['permissions'] = getUserPermissions();
    
      $data['print_type']=$this->input->post('print_type');
      $data['company_profile']=$this->common->company_profile(1);
      $data["details"] = $this->Sales_model->get_sale($this->input->post('sale_id'));

      $this->load->library('pdf');
      $html=$this->load->view('invoice', $data, true);

      $this->pdf->createPDF($html, 'mypdf', false);
      /*$this->pdf->createPDF($html, 'mypdf');*/

    
  }
   function print_salea()
  {
     
      $this->load->view('invoice');
  }


public function get_client_details($id){
 $clients = $this->Sales_model->get_client_details($id);
 echo json_encode($clients);
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
