   <?php  
 
 class Limit_amount extends CI_Model  
 {  
 	function __construct()
	{		
		parent::__construct();
	
	}	

	public function limit()
	{
		$this->db->order_by('limit_id', 'DESC');
		$this->db->limit(1);
		$data = $this->db->get('cs_limit_amount');
		return $data->row();
	}
}

/* End of file init_session_mod.php */
/* Location: /application/models/init_session_mod.php */