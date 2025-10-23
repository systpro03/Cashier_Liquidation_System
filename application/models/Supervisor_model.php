<?php

class Supervisor_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('pis', TRUE);
    $this->load->database();
  }

  public function get_cashier_violation_model_old_code($emp_id, $dt_from, $dt_to)
  {
    $short = -10;
    $over = 10;

    $query = $this->db->query("select b.*, a.* from cebo_cs_dept_access b INNER JOIN cs_tms_notification a ON a.company_code = b.company_code and a.bunit_code = b.bunit_code and a.dept_code = b.dept_code where b.emp_id = '" . $emp_id . "' and date(a.date_time_adjusted) >= '" . $dt_from . "' and date(a.date_time_adjusted) <= '" . $dt_to . "' and (a.variance_amt <= '" . $short . "' or a.variance_amt >= '" . $over . "') and a.status = 'ADJUSTED' and vms_status <> 'FORWARDED' group by a.id ");

    return $query->result_array();
  }

  public function get_cashier_violation_model($emp_id, $vms_cutoff_date)
  {
    $this->db->select('a.id as cs_data_id, a.tr_no as trno, a.emp_id as cashier_id, a.emp_name as cname, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dept_code) as dcode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) as sscode, a.amount_shrt as sop, a.type as sop_type, a.date_shrt as dsales, b.cs_data_id as cs_den_id, b.total_denomination as gtotal, b.registered_sales as rsales, b.discount, b.officer_id');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->where('c.emp_id', $emp_id);
    $this->db->join('cebo_cs_data as a', 'concat(c.company_code,c.bunit_code,c.dept_code,c.section_code,c.sub_section_code) = concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code)');
    $this->db->join('cebo_cs_denomination as b', 'a.id = b.cs_data_id');
    $this->db->where('a.vms_cutoff_date', $vms_cutoff_date);
    $this->db->where('a.vms_status', '');
    $this->db->where('a.delete_status <>', 'deleted');
    $this->db->group_by('a.id');
    $this->db->limit(300);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_forwarded_violation_model($emp_id, $from, $to)
  {
    $this->db->select('a.id as cs_data_id, a.tr_no as trno, a.emp_id as cashier_id, a.emp_name as cname, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dept_code) as dcode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) as sscode, a.amount_shrt as sop, a.type as sop_type, a.date_shrt as dsales, a.vms_officer_for, a.vms_date_time, b.total_denomination as gtotal, b.registered_sales as rsales, b.discount, b.officer_id');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->join('cebo_cs_data as a', 'concat(c.company_code,c.bunit_code,c.dept_code,c.section_code,c.sub_section_code) = concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code)');
    $this->db->join('cebo_cs_denomination as b', 'a.id = b.cs_data_id');
    $this->db->where('c.emp_id', $emp_id);
    $this->db->where('a.vms_status', 'approved');
    $this->db->where('a.vms_cancel <>', 'cancelled');
    $this->db->where('a.delete_status <>', 'deleted');
    $this->db->where('date(a.vms_date_time) >=', $from);
    $this->db->where('date(a.vms_date_time) <=', $to);
    $this->db->group_by('a.id');
    $this->db->limit(5000);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function submit_violation_model($id, $emp_id, $officer_incharge)
  {
    $this->db->set('vms_status', 'FORWARDED');
    $this->db->set('violation_officer_forward', $officer_incharge);
    $this->db->set('violation_date_forwarded', 'NOW()', FALSE);
    $this->db->where('id', $id);
    $this->db->where('emp_id', $emp_id);
    $this->db->update('cs_tms_notification');
  }

  public function update_vms_cebocsdata_model($id, $officer_incharge)
  {
    $this->db->set('vms_status', 'approved');
    $this->db->set('vms_officer_for', $officer_incharge);
    $this->db->set('vms_date_time', 'NOW()', FALSE);
    $this->db->where('id', $id);
    $this->db->update('cebo_cs_data');
  }

  public function get_forwarded_violation_model_old_code($emp_id, $dtfrom, $dtto)
  {
    $query = $this->db->query("select b.*, a.* from cebo_cs_dept_access b INNER JOIN cs_tms_notification a ON a.company_code = b.company_code and a.bunit_code = b.bunit_code and a.dept_code = b.dept_code where b.emp_id = '" . $emp_id . "' and date(a.violation_date_forwarded) >= '" . $dtfrom . "' and date(a.violation_date_forwarded) <= '" . $dtto . "' and a.vms_status = 'FORWARDED' group by a.id ");

    return $query->result_array();
  }

  public function display_department_model($emp_id, $bcode)
  {
    $this->db->select('a.dcode, a.dept_name');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->where('c.emp_id', $emp_id);
    $this->db->join('pis.locate_department as a', 'concat(c.company_code,c.bunit_code,c.dept_code) = concat(a.company_code,a.bunit_code,a.dept_code)');
    $this->db->where('concat(a.company_code,a.bunit_code)', $bcode);
    $this->db->order_by('a.dept_name', 'asc');
    $this->db->group_by('a.dcode');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function save_payment_model($type, $mop, $bunit_code, $dept_code)
  {
    $data = array(
      'type' => $this->security->xss_clean(trim($type)),
      'mop' => $this->security->xss_clean(trim($mop)),
      'bunit_code' => $this->security->xss_clean(trim($bunit_code)),
      'dept_code' => $this->security->xss_clean(trim($dept_code))
    );
    $this->db->set('date_added', 'NOW()', FALSE);
    $this->db->insert('cs_payment_list', $data);
  }

  public function get_payment_list_model($emp_id)
  {
    $this->db->select('a.*');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->where('c.emp_id', $emp_id);
    $this->db->join('cs_payment_list as a', 'concat(c.company_code,c.bunit_code,c.dept_code) = a.dept_code');
    $this->db->group_by('a.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_deptname_model($dcode)
  {
    $this->db2->select('*');
    $this->db2->from('locate_department');
    $this->db2->where('dcode', $dcode);

    $query = $this->db2->get();
    return $query->result_array();
  }

  public function delete_mop_model($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('cs_payment_list');
  }

  public function get_bunitname_model($bcode)
  {
    $this->db2->select('*');
    $this->db2->from('locate_business_unit');
    $this->db2->where('bcode', $bcode);

    $query = $this->db2->get();
    return $query->result_array();
  }

  public function get_bunit_name_model($emp_id)
  {
    $this->db->select('a.bcode, a.business_unit');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->where('c.emp_id', $emp_id);
    $this->db->join('pis.locate_business_unit as a', 'concat(c.company_code,c.bunit_code) = concat(a.company_code,a.bunit_code)');
    $this->db->order_by('a.business_unit', 'asc');
    $this->db->group_by('a.bcode');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function validate_payment_model($mop, $dept_code)
  {
    $this->db->where('mop', $mop);
    $this->db->where('dept_code', $dept_code);
    $query = $this->db->get('cs_payment_list');
    return $query->row();
  }

  public function delete_mop_cashier_access($type, $mop, $dcode)
  {
    $this->db->where('mop_type', $type);
    $this->db->where('mop_name', $mop);
    $this->db->where('dcode', $dcode);
    $this->db->delete('cs_cashier_mop_access');
  }

  public function get_bunit_model_v2($emp_id)
  {
    $this->db->select('concat(company_code,bunit_code) as bcode');
    $this->db->from('cebo_cs_dept_access');
    $this->db->where('emp_id', $emp_id);
    $this->db->group_by('concat(company_code,bunit_code)');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_icm_tender_name_model()
  {
    $this->db->select('icm_payment_name as name, icm_payment_code as code');
    $this->db->from('cs_nav_payment_type');
    $this->db->where('icm_payment_code <>', 9);
    $this->db->where('icm_payment_name <>', '');
    $this->db->order_by('icm_payment_name', 'asc');
    $this->db->group_by('icm_payment_name');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_asc_tender_name_model()
  {
    $this->db->select('asc_payment_name as name, asc_payment_code as code');
    $this->db->from('cs_nav_payment_type');
    $this->db->where('asc_payment_code <>', 9);
    $this->db->where('asc_payment_name <>', '');
    $this->db->order_by('asc_payment_name', 'asc');
    $this->db->group_by('asc_payment_name');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_pm_tender_name_model()
  {
    $this->db->select('pm_payment_name as name, pm_payment_code as code');
    $this->db->from('cs_nav_payment_type');
    $this->db->where('pm_payment_code <>', 9);
    $this->db->where('pm_payment_name <>', '');
    $this->db->order_by('pm_payment_name', 'asc');
    $this->db->group_by('pm_payment_name');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_alta_tender_name_model()
  {
    $this->db->select('alta_payment_name as name, alta_payment_code as code');
    $this->db->from('cs_nav_payment_type');
    $this->db->where('alta_payment_code <>', 5);
    $this->db->where('alta_payment_name <>', '');
    $this->db->order_by('alta_payment_name', 'asc');
    $this->db->group_by('alta_payment_name');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function cancel_denomination_model($tr_no, $emp_id, $sscode, $pos_name, $sales_date)
  {
    // ===========================cebo_cs_data=================================================
    $this->db->set('a.delete_status', 'deleted');
    $this->db->where('a.tr_no', $tr_no);
    $this->db->where('a.emp_id', $emp_id);
    $this->db->where('concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code)', $sscode);
    $this->db->where('a.date_shrt', $sales_date);
    $this->db->update('cebo_cs_data as a');

    // ===========================cebo_cs_denomination=========================================
    $this->db->set('b.delete_status', 'deleted');
    $this->db->set('b.officer_deleted', $_SESSION['emp_id']);
    $this->db->set('date_time_deleted', 'NOW()', FALSE);
    $this->db->where('b.tr_no', $tr_no);
    $this->db->where('b.emp_id', $emp_id);
    $this->db->where('concat(b.company_code,b.bunit_code,b.dept_code,b.section_code,b.sub_sec_code)', $sscode);
    $this->db->where('b.date_shrt', $sales_date);
    $this->db->update('cebo_cs_denomination as b');

    // ===========================cs_cashier_cashdenomination=================================================
    $this->db->set('c.delete_status', 'DELETED');
    $this->db->where('c.tr_no', $tr_no);
    $this->db->where('c.emp_id', $emp_id);
    $this->db->where('concat(c.company_code,c.bunit_code,c.dep_code,c.section_code,c.sub_section_code)', $sscode);
    $this->db->where('c.pos_name', $pos_name);
    $this->db->where('c.status', 'TRANSFERRED');
    $this->db->where('date(c.date_submit)', $sales_date);
    $this->db->update('cs_cashier_cashdenomination as c');

    // ===========================cs_cashier_noncashdenomination=================================================
    $this->db->set('d.delete_status', 'DELETED');
    $this->db->where('d.tr_no', $tr_no);
    $this->db->where('d.emp_id', $emp_id);
    $this->db->where('concat(d.company_code,d.bunit_code,d.dep_code,d.section_code,d.sub_section_code)', $sscode);
    $this->db->where('d.pos_name', $pos_name);
    $this->db->where('d.status', 'TRANSFERRED');
    $this->db->where('date(d.date_submit)', $sales_date);
    $this->db->update('cs_cashier_noncashdenomination as d');
  }

  public function view_cashier_denomination_model($emp_id, $date)
  {
    $this->db->select('a.tr_no as trno, a.emp_id as cashier_id, a.emp_name as cname, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dept_code) as dcode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) as sscode, a.amount_shrt as sop, a.type as sop_type, a.date_shrt as dsales, b.total_denomination as gtotal, b.registered_sales as rsales');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->where('c.emp_id', $emp_id);
    $this->db->join('cebo_cs_data as a', 'concat(c.company_code,c.bunit_code,c.dept_code,c.section_code,c.sub_section_code) = concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code)');
    $this->db->join('cebo_cs_denomination as b', 'a.tr_no = b.tr_no', 'a.emp_id = b.emp_id', 'a.id = b.cs_data_id');
    $this->db->where('a.tr_no <>', '');
    $this->db->where('a.delete_status <>', 'deleted');
    $this->db->where('a.date_shrt', $date);
    $this->db->where('b.tr_no <>', '');
    $this->db->where('b.delete_status <>', 'deleted');
    $this->db->where('b.date_shrt', $date);
    $this->db->group_by('a.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_pending_cash_denomination_model($emp_id, $date)
  {
    $this->db->select('a.id, a.tr_no as trno, a.emp_id as cashier_id, a.emp_name as cname, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dep_code) as dcode, concat(a.company_code,a.bunit_code,a.dep_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code) as sscode, a.borrowed, a.pos_name, a.counter_no, a.total_cash, a.remit_type, date(a.date_submit) as sales_date');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->where('c.emp_id', $emp_id);
    $this->db->join('cs_cashier_cashdenomination as a', 'concat(c.company_code,c.bunit_code,c.dept_code,c.section_code,c.sub_section_code) = concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code)');
    $this->db->where_in('a.status', array('CONFIRMED', 'PENDING'));
    $this->db->where('a.delete_status <>', 'DELETED');
    $this->db->where('date(a.date_submit)', $date);
    $this->db->group_by('a.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function view_cashier_deleted_denomination_model($emp_id)
  {
    $this->db->select('a.tr_no as trno, a.emp_id as cashier_id, a.emp_name as cname, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dept_code) as dcode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) as sscode, a.amount_shrt as sop, a.type as sop_type, a.date_shrt as dsales, b.total_denomination as gtotal, b.officer_deleted, b.date_time_deleted, b.registered_sales as rsales');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->where('c.emp_id', $emp_id);
    $this->db->join('cebo_cs_data as a', 'concat(c.company_code,c.bunit_code,c.dept_code,c.section_code,c.sub_section_code) = concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code)');
    $this->db->join('cebo_cs_denomination as b', 'a.tr_no = b.tr_no', 'a.emp_id = b.emp_id', 'a.id = b.cs_data_id');
    $this->db->where('a.tr_no <>', '');
    $this->db->where('a.delete_status', 'deleted');
    $this->db->where('b.tr_no <>', '');
    $this->db->where('b.delete_status', 'deleted');
    $this->db->group_by('a.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function save_cancelled_denomination_model($tr_no, $emp_id, $sscode, $pos_name, $sales_date)
  {
    $data = array(
      'tr_no' => $this->security->xss_clean(trim($tr_no)),
      'emp_id' => $this->security->xss_clean(trim($emp_id)),
      'sscode' => $this->security->xss_clean(trim($sscode)),
      'pos_name' => $this->security->xss_clean(trim($pos_name)),
      'sales_date' => $this->security->xss_clean(trim($sales_date)),
      'officer_deleted' => $this->security->xss_clean(trim($_SESSION['emp_id'])),
      'status' => $this->security->xss_clean(trim('DELETED'))
    );
    $this->db->set('date_deleted', 'NOW()', FALSE);
    $this->db->insert('cs_cashier_deleted_pos_denomination', $data);
  }

  public function get_emp_data($emp_id)
  {
    $this->db2->select('name');
    $this->db2->from('employee3');
    $this->db2->where('emp_id', $emp_id);
    $query = $this->db2->get();
    return $query->row();
  }

  public function get_cash_denomination_model($tr_no, $emp_id, $sscode, $sales_date)
  {
    $this->db->select('pos_name, counter_no, borrowed');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('status', 'TRANSFERRED');
    $this->db->where('delete_status', 'DELETED');
    $this->db->where('DATE(date_submit)', $sales_date);
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_noncash_denomination_model($tr_no, $emp_id, $sscode, $sales_date)
  {
    $this->db->select('pos_name, counter_no, borrowed');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('status', 'TRANSFERRED');
    $this->db->where('delete_status', 'DELETED');
    $this->db->where('DATE(date_submit)', $sales_date);
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function cancel_pending_denomination_model($id)
  {
    $this->db->set('delete_status', 'DELETED');
    $this->db->where('id', $id);
    $this->db->update('cs_cashier_cashdenomination');
  }

  public function insert_negli_model($cs_data_id, $emp_id, $type, $sop_amount, $sales_date, $sup_id)
  {
    $data = array(
      'empId' => $this->security->xss_clean(trim($emp_id)),
      'date_offense' => $this->security->xss_clean(trim($sales_date)),
      'type' => $this->security->xss_clean(trim($type)),
      'amount' => $this->security->xss_clean(trim($sop_amount)),
      'cancelStat' => $this->security->xss_clean(trim(0)),
      'cs_data_id' => $this->security->xss_clean(trim($cs_data_id)),
      'sup_id' => $this->security->xss_clean(trim($sup_id))
    );
    $this->db->set('date_time', 'NOW()', FALSE);
    $this->db->insert('negli', $data);
  }

  public function get_tender_type_model($dcode)
  {
    $this->db->where('dcode', $dcode);
    $this->db->where('status <>', 'NOT APPLICABLE');
    $this->db->order_by('mop_name', 'asc');
    $this->db->group_by('mop_name');
    $query = $this->db->get('cs_bu_mode_of_payment');
    return $query->result_array();
  }

  public function get_cutoff_date_model($emp_id)
  {
    $this->db->select('a.vms_cutoff_date as cutoff_date');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->where('c.emp_id', $emp_id);
    $this->db->join('cebo_cs_data as a', 'concat(c.company_code,c.bunit_code,c.dept_code,c.section_code,c.sub_section_code) = concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code)');
    $this->db->where('a.vms_cutoff_date <>', '');
    $this->db->where('a.vms_status', '');
    $this->db->where('a.vms_cancel', '');
    $this->db->where('a.delete_status <>', 'deleted');
    $this->db->order_by('a.date_shrt', 'desc');
    $this->db->where('a.date_shrt >=', '2023-01-01');
    $this->db->group_by('a.vms_cutoff_date');
    $query = $this->db->get();
    return $query->result_array();
  }





  public function hrms_info($id)
  {

    $this->db->select('*');
    $this->db->from('pis.employee3');
    $this->db->where('emp_id', "$id");
    $data = $this->db->get();

    return $data->row();
  }


  public function get_negli_data($id)
  {
    $this->db->select('*');
    $this->db->from('negli');
    $this->db->where('cs_data_id', "$id");
    $data = $this->db->get();

    return $data->row();
  }

  public function get_vms_shortover_data($id, $empId)
  {
    $this->db->select('*');
    $this->db->from('vsm.shortover');
    $this->db->where('offenseId', "$id");
    $this->db->where('empId', "$empId");
    $data = $this->db->get();

    return $data->row();
  }
  public function get_vms_offense_cancel($id, $empId)
  {
    $this->db->select('*');
    $this->db->from('vsm.offense_cancel');
    $this->db->where('offenseId', "$id");
    $this->db->where('empId', "$empId");
    $this->db->where('violationId', 29);
    $data = $this->db->get();

    return $data->row();
  }
  public function update_record($data, $rec_id)
  {
    $this->db->set($data);
    $this->db->where("id", $rec_id);
    $this->db->update("cebo_cs_data", $data);
  }
  public function update_negli($data, $rec_id)
  {

    $this->db->set($data);
    $this->db->where("id", $rec_id);
    $this->db->update("negli", $data);
  }
  public function insert_cancel_request($data)
  {
    $this->db->insert('vsm.offense_cancel', $data);
  }
  public function update_shortover($data, $rec_id, $empId)
  {
    $this->db->set($data);
    $this->db->where('empId', "$empId");
    $this->db->where("offenseId", "$rec_id");
    $this->db->update("vsm.shortover", $data);
  }
}

