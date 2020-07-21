<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('security');
		$this->load->library('Datatables');
		$this->load->library('Aauth');
		$this->load->library('form_validation');
		$this->load->model('Company_model');
		$this->load->library('Common');
	}
    
     /**
     * Company::index()
     * @return void
     */

    public function index() {
            $data["admin_data"] = $this->checkAccess();
            $data['user_id'] = $this->aauth->get_user_id();
            $data['permissions'] = getUserPermissions();
    		$data['details'] = $this->Company_model->get_details($data['user_id']);
    	    $data["currencies"] = $this->common->get_currencies();
            $data["title"] = "Settings";
            $data['setting_aside']=$this->load->view('settings/setting_aside', '', TRUE);
            $this->load->view('include/inner_header', $data);
            $this->load->view('settings/company_profile', $data);
            $this->load->view('include/inner_footer', $data);
    }

	/**
	* Company::update_company()
	* @return json
	*/
	function update_company($id){
		$data['admin_data'] = $this->checkAccess();
		$this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('company_email', 'Email', 'required|trim|xss_clean');
		$this->form_validation->set_rules('workphone', 'Phone', 'required|trim|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'required|trim|xss_clean');
		$this->form_validation->set_rules('country_name', 'Country', 'required|trim|xss_clean');
		$this->form_validation->set_rules('state', 'Country', 'required|trim|xss_clean');
		$this->form_validation->set_rules('city', 'City', 'required|trim|xss_clean');
		$this->form_validation->set_rules('zip', 'Zip', 'required|trim|xss_clean');
		$this->form_validation->set_rules('note', 'Note', 'trim|xss_clean');

		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|xss_clean');
		$this->form_validation->set_rules('tax', 'Tax', 'trim|xss_clean');
		$this->form_validation->set_rules('website', 'Website', 'trim|xss_clean');
		// $this->form_validation->set_rules('declaration', 'Declaration', 'xss_clean');
		// $this->form_validation->set_rules('terms', 'Declaration', 'xss_clean');

		$this->form_validation->set_rules('financial_year_start', 'Financial year start', 'trim|xss_clean');
		$this->form_validation->set_rules('financial_year_end', 'Financial year end', 'trim|xss_clean');
		$this->form_validation->set_rules('currency', 'Currency', 'trim|xss_clean');

		$this->form_validation->set_rules('gstin', 'Gstin', 'trim|xss_clean');
		$this->form_validation->set_rules('bank_name', 'Bank name', 'trim|xss_clean');
		$this->form_validation->set_rules('account_number', 'Account number', 'trim|xss_clean');
		$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|xss_clean');
		$this->form_validation->set_rules('ifsc_code', 'Ifsc Code', 'trim|xss_clean');
		$this->form_validation->set_rules('ad_code', 'Ad code', 'trim|xss_clean');

		$this->form_validation->set_rules('swift_code', 'Swift Code', 'trim|xss_clean');
		$this->form_validation->set_rules('logo', 'Logo', 'trim|xss_clean');
		$this->form_validation->set_rules('sign', 'Sign', 'trim|xss_clean');
		$this->form_validation->set_rules('signature', 'Signature', 'trim|xss_clean');

		if($this->form_validation->run()){
			if($this->Company_model->updateCompany($id)){
				$result['message'] = $this->lang->line('company_update_success');
				$result['status'] = 1;
			}else {
				$result['message'] = $this->lang->line('company_update_error');
				$result['status'] = 0;
			}

		}else {
			$result['message'] = validation_errors();
			$result['status'] = 0;
		}

		echo json_encode($result);

	}
 /**
	* Company::upload files()
	* @return json
	*/

	function do_upload(){

		$user = $this->aauth->get_user_id();
		$filename = time().'_'.$user;
		$path = 'logo_sign';

		$config['upload_path'] = 'uploads/'.$path;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']     = '100';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$config['file_name'] = $filename;

		if (!is_dir('uploads/'.$path)) {
			mkdir('uploads/'.$path, 0777, TRUE);
		}
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('file')){
			$result['error'] = $this->upload->display_errors();
			$result['status'] = 0;
		}else{
			$image = $_FILES['file']['name'];
			$ext = ".".pathinfo($image, PATHINFO_EXTENSION);
			$filename = $filename.$ext;
			$result['image_url'] = base_url('uploads/'.$path.'/'.$filename);
			$result['img'] = $filename;
			$result['status'] = 1;
		}
		echo json_encode($result);
	}


	/**
	* Access function
	**/
	function checkAccess(){
		if($this->aauth->is_loggedin()){
			return $this->session->userdata();
		}else {
			redirect('auth/login');
		}
	}
}
?>
