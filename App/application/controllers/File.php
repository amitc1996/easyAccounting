 <?php if (!defined('BASEPATH')) exit('No direct script access allowed');

 class File extends CI_Controller
 {
  function __construct()
  {
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('Aauth');
    $this->load->helper('download');
  }


    /**
     * File::get_file()
     * @return void
     */

    public function get_file($path=NULL,$fileName=NULL)
    {
     
       $data["admin_data"] = $this->checkAccess();
       $uploadpath='uploads/'; 
       $directory=$uploadpath.'/'.$path; 
        if ($fileName) {
        $file = realpath ($directory) . "/" . $fileName;
          if (file_exists ( $file )) {
           force_download ( $file, NULL, true);
           header('Content-Disposition:inline');
         } else {
           show_404();
         }
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
    redirect('/auth/login'); 
    die();
  }
}
}
?>

