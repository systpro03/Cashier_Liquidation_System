<?php

class Login_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('pis', TRUE);
    $this->load->database();
  }

  public function validate_user_model($front,$back)
  {
    $this->db->select('*');
    $this->db->from('cs_cashier_personnel');
    $this->db->where('emp_no', $front);
    $this->db->where('emp_pins', $back);
    $this->db->where('cashier_path <>', '');

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_pisdata_model($emp_id)
  {
    $this->db2->where('emp_id', $emp_id);
    $query = $this->db2->get('employee3');
    return $query->row();
  }

  
}
