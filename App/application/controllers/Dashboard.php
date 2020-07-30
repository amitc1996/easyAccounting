<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{   
  
    
	function __construct()
	{
		parent::__construct();

	    $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('security');
        $this->load->library('Aauth');
        $this->load->library('form_validation');
         $this->load->model('Dashboard_model');
	}

 public function index() {
            $data["admin_data"] = $this->checkAccess();
            $data['user_id'] = $this->aauth->get_user_id();
            $data['permissions'] = getUserPermissions();
            $data['total_clients_city_wise'] = $this->get_client_city_data();
            $data['total_clients'] = $this->Dashboard_model->total_clients();
            $data['stock_value'] = $this->Dashboard_model->get_total_avl_stock_amount();
            
            
            $data["title"] = "Dashboard";
            $this->load->view('include/inner_header', $data);
            $this->load->view('dashboard', $data);
            $this->load->view('include/inner_footer', $data);
    }
    
    public function get_data(){
        $data['total_products'] = $this->Dashboard_model->get_products();
        $data['total_payble_amount'] = $this->Dashboard_model->total_payble_amount();
        $data['total_outstanding'] = $this->Dashboard_model->total_outstanding();
        $data['sales_outstanding_amount'] = $this->Dashboard_model->sales_outstanding_amount();
        $data['purchase_payable_amount'] = $this->Dashboard_model->purchase_payable_amount();

        
        // echo "<pre>";print_r($data);die;
       echo json_encode($data);
    }

    public function get_client_city_data(){
        $city_data=$this->Dashboard_model->total_clients_city_wise();
        $result_array=array();
        if(count($city_data)>0){
        foreach ($city_data as $key => $value) {
            $result_array['labels'][$key]=$value['client_city_b'];
            $result_array['data'][$key]=$value['total'];
            $result_array['colors'][$key]="#" . $this->getColor($key);
        }
       }
       else{
           $result_array['labels']=array();
           $result_array['data']=array();
           $result_array['colors']="#" . $this->getColor(0);
       }
       return $result_array;
    }
     function getColor($num) {
        $preset_colors=[
            "ff914d",
            "6c757d",
            "28a745",
            "17a2b8",
            "ffc107",
            "dc3545",
            "6610f2",
            "6f42c1",
            "e83e8c",
            "dc3545",
            "fd7e14",
            "ffc107",
            "28a745",
            "20c997",
            "17a2b8",
            "6c757d",
            "343a40",
            "343a40",
        ];
        if($num<=count($preset_colors)){
            return $preset_colors[$num];
        }
    $randomString = md5($num); // like "d73a6ef90dc6a ..."
    $r = substr($randomString,0,2); //1. and 2.
    $g = substr($randomString,1,2); //3. and 4.
    $b = substr($randomString,4,2); //5. and 6.
    $colors=$r.$g.$b;
    return $colors;
  }
    private function checkAccess()
      {  
         if($this->aauth->is_loggedin())
         {
            return  $this->session->all_userdata();
         }
         else
         {
            redirect('/auth/login/'); 
            die();
         }
      }
    
    
}
