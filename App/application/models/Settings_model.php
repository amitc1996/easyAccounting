<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends CI_Model
{
	private $table_name	= 'aauth_users';			// user accounts
	

	function __construct()
	{
		parent::__construct();
        $ci =& get_instance();
        $this->load->database();
        
    }

	/**
	 * Get user record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_user_by_id($user_id)
	{
        
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where($this->table_name.'.id', $user_id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) return $query->row();
        return NULL;
        
    }
    
     /**
	 * Update users basic information
	 *
	 * @param	string
	 * @param	string
     * @param	string
	 * @return	bool
	 */      
     public function update_user_profile($user_id)
     {

        $data['email'] = $this->input->post('email');
        $this->db->where('id', $user_id);
        if($this->db->update($this->table_name, $data))
        {
            return true; //returning true if query runs correctly
        } 
        else
        {
            return false; // return false if something goes wrong

        }

    }

    /**
     * Check email is  available
     * */

    function is_email_available($email)
    {
        $this->db->select('1', FALSE);
        $this->db->where('LOWER(email)=', strtolower($email));
        $this->db->or_where('LOWER(new_email)=', strtolower($email));

        $query = $this->db->get($this->table_name);
        return $query->num_rows() == 0;
    }

    /**
     * Set new email 
     * */

    function set_new_email($user_id, $new_email, $new_email_key)
    {
        $this->db->set('new_email_key', $new_email_key);
        $this->db->set('new_email', $new_email);
        $this->db->where('id', $user_id);
         //$this->db->where('activated', $activated ? 1 : 0);
        $this->db->update($this->table_name);
        return $this->db->affected_rows() > 0;
    }


    /**
     * Activate new email 
     * */

    function activate_new_email($user_id, $new_email_key)
    {
        $this->db->set('email', 'new_email', FALSE);
        $this->db->set('new_email', NULL);
        $this->db->set('new_email_key', NULL);
        $this->db->where('id', $user_id);
        $this->db->where('new_email_key', $new_email_key);

        $this->db->update($this->table_name);
        return $this->db->affected_rows() > 0;
    }
    
    /**
     * Update password 
     * */

    public function update_password($user_id)
    {
        $data['pass'] = $this->aauth->hash_password($this->input->post('confirm_new_password'), $user_id);
        $this->db->where('id', $user_id);
        if($this->db->update($this->table_name, $data))
        {
            return true; //returning true if query runs correctly
        } 
        else
        {
            return false; // return false if something goes wrong

        }

    }
    
}
