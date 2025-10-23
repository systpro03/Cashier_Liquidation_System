<?php

class Accounting_supervisor_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('pis', TRUE);
    $this->load->database();
  }

  public function get_pending_adjustment_model($emp_id)
  {
    $this->db->select('b.id as id, b.origin_name as origin, b.transfer_name as transfer, b.transfer_amount as t_amount, b.sales_date as sales_date, b.reason, b.attached_file, b.status as status, b.officer_incharge as emp_id, b.date_requested as date_requested');
    $this->db->from('cebo_cs_dept_access as a');
    $this->db->where('a.emp_id', $emp_id);
    $this->db->join('cs_nav_adjustment_history as b', 'concat(a.company_code,a.bunit_code,a.dept_code) = b.dcode');
    $this->db->where('b.status', 'PENDING');
    $this->db->group_by('b.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_emp_data($emp_id)
  {
    $this->db2->select('name');
    $this->db2->from('employee3');
    $this->db2->where('emp_id', $emp_id);
    $query = $this->db2->get();
    return $query->row();
  }

  public function approve_pending_request_model($id,$emp_id)
  {
    $this->db->set('officer_approved', $emp_id);
    $this->db->set('status', 'APPROVED');
    $this->db->set('date_approved', 'NOW()', FALSE);
    $this->db->where('id', $id);
    $this->db->where('status', 'PENDING');
    $this->db->update('cs_nav_adjustment_history');
  }

  public function get_approved_adjustment_model($emp_id)
  {
    $this->db->select('origin_name, transfer_name, transfer_amount, sales_date, reason, attached_file, officer_incharge, date_approved');
    $this->db->from('cs_nav_adjustment_history');
    $this->db->where('officer_approved', $emp_id);
    $query = $this->db->get();
    return $query->result_array();
  }


}

