<?php

class Admin_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('pis', TRUE);
    $this->load->database();
  }

  public function get_bunit_model()
  {
    $this->db2->select('*');
    $this->db2->from('locate_business_unit');
    // $this->db2->where_in('bcode', array('0201','0202','0203','0204','0205','0206','0223','0301'));
    $this->db2->where('bcode <>', '0701');
    $this->db2->where('bcode <>', '0702');
    $this->db2->where('bcode <>', '0703');
    $this->db2->where('bcode <>', '0202');
    $this->db2->where('bcode <>', '0219');
    $this->db2->where('bcode <>', '1112');
    $this->db2->where('bcode <>', '1205');
    $this->db2->where('bcode <>', '1302');
    $this->db2->where('bcode <>', '1902');
    $this->db2->where('bcode <>', '0221');
    $this->db2->where('bcode <>', '0801');
    $this->db2->order_by('business_unit', 'asc');

    $query = $this->db2->get();
    return $query->result_array();
  }

  public function get_bunit_model_v2()
  {
    $this->db2->select('bcode, business_unit');
    $this->db2->from('locate_business_unit');
    $this->db2->order_by('business_unit', 'asc');
    $query = $this->db2->get();
    return $query->result_array();
  }

  public function get_emp_name_model($emp_name)
  {
    $this->db2->select('*');
    $this->db2->from('employee3');
    $this->db2->where('current_status', 'active');
    $this->db2->like('name', $emp_name);
    $this->db2->order_by('name', 'asc');
    $this->db2->limit(5);

    $query = $this->db2->get();
    return $query->result_array();
  }

  public function get_empid_model($emp_name)
  {
    $this->db2->select('*');
    $this->db2->from('employee3');
    $this->db2->like('name', $emp_name);
    $this->db2->limit(1);

    $query = $this->db2->get();
    return $query->result_array();
  }

  public function addpayment_user_model($emp_id)
  {
    $this->db->set('emp_id', $emp_id);
    $this->db->insert('cs_addpayment_user');
  }

  public function validate_empid_model($emp_id)
  {
    $this->db->select('*');
    $this->db->from('cs_addpayment_user');
    $this->db->where('emp_id', $emp_id);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_users_model()
  {
    $this->db->select('*');
    $this->db->from('cs_addpayment_user');

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_empname_model($emp_id)
  {
    $this->db2->select('*');
    $this->db2->from('employee3');
    $this->db2->where('emp_id', $emp_id);

    $query = $this->db2->get();
    return $query->result_array();
  }

  public function delete_user_model($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('cs_addpayment_user');
  }

  public function get_bunit_name_model()
  {
    $this->db2->select('*');
    $this->db2->from('locate_business_unit');
    // $this->db2->where_in('bcode', array('0203','0201','0223','0301','0202','0221'));
    $this->db2->where_in('bcode', array('0203','0201','0223','0301'));
    $this->db2->order_by('business_unit', 'asc');
    $query = $this->db2->get();
    return $query->result_array();
  }

  public function display_deptname_model($bcode)
  {
    $this->db2->select('*');
    $this->db2->from('locate_department');
    $this->db2->where('concat(company_code,bunit_code)', $bcode);
    $this->db2->order_by('dept_name', 'asc');
    $this->db2->group_by('dcode');

    $query = $this->db2->get();
    return $query->result_array();
  }

  public function get_cashier_transaction_model($dcode,$sales_date)
  {
    $this->db->select('a.tr_no, a.emp_id, a.emp_name, concat(a.section_code,a.sub_section_code) as sscode, b.pos_name as cash_terminal, c.pos_name as noncash_terminal');
    $this->db->from('cebo_cs_data as a');
    $this->db->where('concat(a.company_code,a.bunit_code,a.dept_code)', $dcode);
    $this->db->where('a.date_shrt', $sales_date);
    $this->db->where('a.tr_no <>', '');
    $this->db->where('a.delete_status <>', 'deleted');
    $this->db->join('cs_cashier_cashdenomination as b', 'a.tr_no = b.tr_no', 'a.emp_id = b.emp_id');
    $this->db->where('b.delete_status <>', 'DELETED');
    $this->db->group_by(array('b.tr_no', 'b.emp_id'));
    $this->db->join('cs_cashier_noncashdenomination as c', 'b.tr_no = c.tr_no', 'b.emp_id = c.emp_id');
    $this->db->where('c.delete_status <>', 'DELETED');
    $this->db->group_by(array('c.tr_no', 'c.emp_id'));
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cash_info_model($trno, $sales_date, $emp_id){
    $this->db->select('amount_shrt, type');
    $this->db->from('cebo_cs_data');
    $this->db->where('date_shrt', $sales_date);
    $this->db->where('tr_no', $trno);
    $this->db->where('emp_id', $emp_id);
    $query = $this->db->get();
    return $query->row_array();
  }
  public function get_cashier_cash_transaction_model($dcode,$sales_date)
  {
    $this->db->select('id, tr_no, emp_id, emp_name, pos_name, remit_type, borrowed, liq_status, concat(section_code,sub_section_code) as sscode');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('date(date_submit)', $sales_date);
    $this->db->where('status', 'TRANSFERRED');
    $this->db->where('status <>', 'SAMPLE');
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where('concat(company_code,bunit_code,dep_code)', $dcode);
    // $this->db->group_by(array('tr_no', 'emp_id'));
    // $this->db->order_by('tr_no', 'desc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cashier_noncash_transaction_model($dcode,$sales_date)
  {
    $this->db->select('tr_no, emp_id, emp_name, pos_name, remit_type, borrowed, concat(section_code,sub_section_code) as sscode');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('date(date_submit)', $sales_date);
    $this->db->where('status', 'TRANSFERRED');
    $this->db->where('status <>', 'SAMPLE');
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where('concat(company_code,bunit_code,dep_code)', $dcode);
    $this->db->group_by(array('tr_no', 'emp_id'));
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_section_name_model($scode)
  {
    $this->db2->select('section_name');
    $this->db2->from('locate_section');
    $this->db2->where('scode', $scode);
    $query = $this->db2->get();
    return $query->row();
  }

  public function get_sub_section_name_model($sscode)
  {
    $this->db2->select('sub_section_name');
    $this->db2->from('locate_sub_section');
    $this->db2->where('sscode', $sscode);
    $query = $this->db2->get();
    return $query->row();
  }

  public function get_cash_den_model($id,$tr_no,$emp_id,$date)
  {
    $this->db->where('id', $id);
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date(date_submit)', $date);
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->row();
  }

  public function get_den_data($tr_no,$emp_id,$location,$date)
  {
    $this->db->select('total_denomination, registered_sales, discount, tr_count');
    $this->db->from('cebo_cs_denomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_shrt', $date);
    $this->db->where('delete_status <>', 'deleted');
    $this->db->where('concat(company_code,bunit_code,dept_code,section_code,sub_sec_code)', $location);
    $query = $this->db->get();
    return $query->row();
  }

  public function update_cebo_cs_data_model($tr_no,$emp_id,$location,$date,$variance_amount,$variance_text,$deduction_date,$vms_cutoff_date)
  {
    $balance = 0;
    if($variance_text == 'S' && $variance_amount >= 10)
    {
      $balance = $variance_amount;
    }
    $data = array(
      'amount_shrt' => $variance_amount,
      'balance' => $balance,
      'type' => $variance_text,
      'cut_off_date' => $deduction_date,
      'vms_cutoff_date' => $vms_cutoff_date
      );

    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_shrt', $date);
    $this->db->where("CONCAT(company_code, bunit_code, dept_code, section_code, sub_section_code) =", $location, false);

    $this->db->update('cebo_cs_data', $data);
  }


  public function update_cebo_cs_data_model2($tr_no, $emp_id, $location, $date, $variance_amount2, $variance_text, $deduction_date, $vms_cutoff_date)
  {

    $balance = 0;
    if($variance_text == 'S' && $variance_amount2 >= 10)
    {
      $balance = $variance_amount2;
    }
    $data = array(
      'amount_shrt' => $variance_amount2,
      'balance' => $balance,
      'type' => $variance_text,
      'cut_off_date' => $deduction_date,
      'vms_cutoff_date' => $vms_cutoff_date
      );


    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_shrt', $date);
    $this->db->where("CONCAT(company_code, bunit_code, dept_code, section_code, sub_section_code) =", $location, false);

    $this->db->update('cebo_cs_data', $data);

    return $this->db->affected_rows();

  }


  // public function update_cebo_cs_data_model($tr_no, $emp_id, $location, $date, $variance_amount, $variance_text, $deduction_date, $vms_cutoff_date)
  // {
  //     $variance_amount = number_format((float)$variance_amount, 2, '.', '');
      
  //     $balance = 0;
  //     if ($variance_text == 'S' && $variance_amount >= 10) {
  //         $balance = number_format((float)$variance_amount, 2, '.', '');
  //     }

  //     $data = array(
  //         'amount_shrt' => $variance_amount,
  //         'balance' => $balance,
  //         'type' => $variance_text,
  //         'cut_off_date' => $deduction_date,
  //         'vms_cutoff_date' => $vms_cutoff_date
  //     );
      
  //     $this->db->where('tr_no', $tr_no);
  //     $this->db->where('emp_id', $emp_id);
  //     $this->db->where('date_shrt', $date);
  //     $this->db->where("CONCAT(company_code, bunit_code, dept_code, section_code, sub_section_code) =", $location, false);
  //     $this->db->update('cebo_cs_data', $data);
  // }


  // public function update_cebo_cs_den_model($tr_no,$emp_id,$location,$date,$new_total_amount2)
  // {
    
  //   // $this->db->set('total_denomination', $new_total_amount2);
  //   $update_data = array(
  //     'total_denomination' => $new_total_amount2,
  //   );
  //   // $this->db->set('total_denomination', $new_total_amount2);
  //   $this->db->where('tr_no', $tr_no);
  //   $this->db->where('emp_id', $emp_id);
  //   $this->db->where('date_shrt', $date);
  //   // $this->db->where('concat(company_code,bunit_code,dept_code,section_code,sub_sec_code)', $location);
  //   $this->db->where("CONCAT(company_code, bunit_code, dept_code, section_code, sub_sec_code) =", $location, false);

  //   $this->db->update('cebo_cs_denomination', $update_data);
  // }

  public function update_cebo_cs_den_model($tr_no, $emp_id, $location, $date, $new_total_amount2)
  {
    $new_total_amount2 = number_format((float) $new_total_amount2, 2, '.', '');

    $update_data = array(
      'total_denomination' => $new_total_amount2,
    );
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_shrt', $date);
    $this->db->where("CONCAT(company_code, bunit_code, dept_code, section_code, sub_sec_code) =", $location, false);
    $this->db->update('cebo_cs_denomination', $update_data);
  }


  public function update_cs_cash_den_model($id,$tr_no,$emp_id,$date,$onek,$fiveh,$twoh,$oneh,$fifty,$twenty,$ten,$five,$one,$twentyfive_cents,$ten_cents,$five_cents,$one_cents,$new_cash)
  {
    $data = array(
                  'onek' => $onek,
                  'fiveh' => $fiveh,
                  'twoh' => $twoh,
                  'oneh' => $oneh,
                  'fifty' => $fifty,
                  'twenty' => $twenty,
                  'ten' => $ten,
                  'five' => $five,
                  'one' => $one,
                  'twentyfive_cents' => $twentyfive_cents,
                  'ten_cents' => $ten_cents,
                  'five_cents' => $five_cents,
                  'one_cents' => $one_cents,
                  'total_cash' => $new_cash
    );
    
    $this->db->where('id', $id);
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date(date_submit)', $date);
    $this->db->update('cs_cashier_cashdenomination', $data);
  }

  public function get_noncash_model($tr_no,$emp_id,$location,$date)
  {
    $this->db->select('id, mop_name, noncash_qty, noncash_amount');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date(date_submit)', $date);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $location);
    $this->db->where('status <>', 'SAMPLE');
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->order_by('mop_name', 'asc');
    // $this->db->group_by('mop_name');
    $query = $this->db->get();
    return $query->result_array();
  }

    public function get_total_noncash_model($tr_no,$emp_id,$location,$date)
  {
    $this->db->select('SUM(noncash_amount) AS total_amount');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date(date_submit)', $date);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $location);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where('status <>', 'SAMPLE');
    $this->db->order_by('mop_name', 'asc');
    $query = $this->db->get();
    return $query->row_array();
  }

  public function get_mop_name_model($mop_name,$dcode)
  {
    $this->db->select('mop_name');
    $this->db->from('cs_bu_mode_of_payment');
    $this->db->where('mop_name <>', $mop_name);
    $this->db->where('dcode', $dcode);
    $this->db->where_not_in('mop_code', array(1,9,50));
    $this->db->order_by('mop_name', 'asc');
    // $this->db->group_by('mop_name');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function validate_noncash_model($id,$tr_no,$emp_id,$mop_name,$noncash_amount,$location,$date)
  {
    $this->db->where('id <>', $id);
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('mop_name', $mop_name);
    $this->db->where('noncash_amount', trim($noncash_amount));
    $this->db->where('date(date_submit)', $date);
    // louie added
    $this->db->where('delete_status <>', 'DELETED');
    // 
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $location);
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }


  public function noncash_amount($id,$tr_no,$emp_id,$mop_name,$noncash_amount,$location,$date)
  {

    $this->db->select('noncash_amount');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('id', $id);
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('mop_name', $mop_name);
    $this->db->where('noncash_amount', trim($noncash_amount));
    $this->db->where('date(date_submit)', $date);
    // louie added
    $this->db->where('delete_status <>', 'DELETED');
    // 
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $location);
    $query = $this->db->get();
    return $query->row_array();
  }


  public function update_noncash_model($id,$emp_id,$mop_name,$noncash_qty,$noncash_amount)
  {
    $data = array(
            'mop_name' => $mop_name,
            'noncash_qty' => $noncash_qty,
            'noncash_amount' => $noncash_amount
    );

    $this->db->where('id', $id);
    $this->db->where('emp_id', $emp_id);
    $this->db->update('cs_cashier_noncashdenomination', $data);
  }

  public function get_terminal_data($dcode,$pos_name)
  {
    $this->db->select('pos_name, counter_no');
    $this->db->from('cs_store_pos_counter_no');
    $this->db->where('pos_name <>', $pos_name);
    $this->db->where('dcode', $dcode);
    $this->db->order_by('pos_name', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_transfer_mop_name_model($mop_name,$dcode)
  {
    $this->db->select('mop_name');
    $this->db->from('cs_bu_mode_of_payment');
    $this->db->where_not_in('mop_name', $mop_name);
    $this->db->where('dcode', $dcode);
    $this->db->where_not_in('mop_code', array(1,9,50));
    $this->db->order_by('mop_name', 'asc');
    $this->db->group_by('mop_name');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_mop_data_model($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->row();
  }

  public function update_mop_model($id,$noncash_qty,$noncash_amount)
  {
    $data = array(
      'noncash_qty' => $noncash_qty,
      'noncash_amount' => $noncash_amount
    );

    $this->db->where('id', $id);
    $this->db->update('cs_cashier_noncashdenomination', $data);
  }

  public function insert_mop_model($tr_no,$emp_id,$sal_no,$emp_name,$emp_type,$company_code,$bunit_code,$dep_code,$section_code,$sub_section_code,$borrowed,$pos_name,$counter_no,$mop_name,$noncash_qty,$noncash_amount,$remit_type,$status,$date_submit)
  {
    $data = array(
      'tr_no' => $tr_no,
      'emp_id' => $emp_id,
      'sal_no' => $sal_no,
      'emp_name' => $emp_name,
      'emp_type' => $emp_type,
      'company_code' => $company_code,
      'bunit_code' => $bunit_code,
      'dep_code' => $dep_code,
      'section_code' => $section_code,
      'sub_section_code' => $sub_section_code,
      'borrowed' => $borrowed,
      'pos_name' => $pos_name,
      'counter_no' => $counter_no,
      'mop_name' => $mop_name,
      'noncash_qty' => $noncash_qty,
      'noncash_amount' => $noncash_amount,
      'remit_type' => $remit_type,
      'status' => $status,
      'date_submit' => $date_submit
    );

    $this->db->insert('cs_cashier_noncashdenomination', $data);
  }

  public function update_registered_sales_discount_model($tr_no,$emp_id,$location,$date,$registered_sales,$discount,$tr_count)
  {
    $this->db->set('registered_sales', $registered_sales);
    $this->db->set('discount', $discount);
    $this->db->set('tr_count', $tr_count);
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_shrt', $date);
    $this->db->where('concat(company_code,bunit_code,dept_code,section_code,sub_sec_code)', $location);
    $this->db->update('cebo_cs_denomination');
  }

  public function update_total_registered($new_total_sales,$tr_no,$emp_id,$location,$date,$registered_sales,$discount,$tr_count)
  {
    $this->db->set('registered_sales', $registered_sales);
    $this->db->set('total_denomination', $new_total_sales);
    $this->db->set('discount', $discount);
    $this->db->set('tr_count', $tr_count);
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_shrt', $date);
    $this->db->where('concat(company_code,bunit_code,dept_code,section_code,sub_sec_code)', $location);
    $this->db->update('cebo_cs_denomination');
  }


  public function update_terminal_no_model($tr_no,$emp_id,$location,$date,$pos_name,$counter_no)
  {
    // =================================update cs_cashier_cashdenomination=====================================
    $this->db->set('a.pos_name', $pos_name);
    $this->db->set('a.counter_no', $counter_no);
    $this->db->where('a.tr_no', $tr_no);
    $this->db->where('a.emp_id', $emp_id);
    $this->db->where('date(a.date_submit)', $date);
    $this->db->where('concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code)', $location);
    $this->db->update('cs_cashier_cashdenomination as a');
    
    // =================================update cs_cashier_noncashdenomination=====================================
    $this->db->set('b.pos_name', $pos_name);
    $this->db->set('b.counter_no', $counter_no);
    $this->db->where('b.tr_no', $tr_no);
    $this->db->where('b.emp_id', $emp_id);
    $this->db->where('date(b.date_submit)', $date);
    $this->db->where('concat(b.company_code,b.bunit_code,b.dep_code,b.section_code,b.sub_section_code)', $location);
    $this->db->update('cs_cashier_noncashdenomination as b');
  }

  public function update_sales_date_model($tr_no,$emp_id,$location,$old_date,$new_date)
  {
    // =================================update cs_cashier_cashdenomination=====================================
    $this->db->set('a.date_submit', $new_date);
    $this->db->where('a.tr_no', $tr_no);
    $this->db->where('a.emp_id', $emp_id);
    $this->db->where('date(a.date_submit)', $old_date);
    $this->db->where('concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code)', $location);
    $this->db->update('cs_cashier_cashdenomination as a');
    
    // =================================update cs_cashier_noncashdenomination=====================================
    $this->db->set('b.date_submit', $new_date);
    $this->db->where('b.tr_no', $tr_no);
    $this->db->where('b.emp_id', $emp_id);
    $this->db->where('date(b.date_submit)', $old_date);
    $this->db->where('concat(b.company_code,b.bunit_code,b.dep_code,b.section_code,b.sub_section_code)', $location);
    $this->db->update('cs_cashier_noncashdenomination as b');
    
    // =================================update cebo_cs_data=====================================
    $this->db->set('c.date_shrt', $new_date);
    $this->db->where('c.tr_no', $tr_no);
    $this->db->where('c.emp_id', $emp_id);
    $this->db->where('c.date_shrt', $old_date);
    $this->db->where('concat(c.company_code,c.bunit_code,c.dept_code,c.section_code,c.sub_section_code)', $location);
    $this->db->update('cebo_cs_data as c');
    
    // =================================update cebo_cs_denomination=====================================
    $this->db->set('d.date_shrt', $new_date);
    $this->db->where('d.tr_no', $tr_no);
    $this->db->where('d.emp_id', $emp_id);
    $this->db->where('d.date_shrt', $old_date);
    $this->db->where('concat(d.company_code,d.bunit_code,d.dept_code,d.section_code,d.sub_sec_code)', $location);
    $this->db->update('cebo_cs_denomination as d');

    // =================================update cs_liq_remitted_cash=====================================
    $this->db->set('e.date_remitted', $new_date);
    $this->db->where('e.tr_no', $tr_no);
    $this->db->where('e.emp_id', $emp_id);
    $this->db->where('e.sscode', $location);
    $this->db->update('cs_liq_remitted_cash as e');
  }

  public function get_deptname_model($bcode)
  {
    $this->db2->select('dcode, dept_name');
    $this->db2->from('locate_department');
    $this->db2->where('concat(company_code,bunit_code)', $bcode);
    $this->db2->order_by('dept_name', 'asc');
    $query = $this->db2->get();
    return $query->result_array();
  }

  public function get_sectionname_model($dcode)
  {
    $this->db2->select('scode, section_name');
    $this->db2->from('locate_section');
    $this->db2->where('concat(company_code,bunit_code,dept_code)', $dcode);
    $this->db2->order_by('section_name', 'asc');
    $query = $this->db2->get();
    return $query->result_array();
  }

  public function get_sub_sectionname_model($scode)
  {
    $this->db2->select('sscode, sub_section_name');
    $this->db2->from('locate_sub_section');
    $this->db2->where('concat(company_code,bunit_code,dept_code,section_code)', $scode);
    $this->db2->order_by('sub_section_name', 'asc');
    $query = $this->db2->get();
    return $query->result_array();
  }

  public function get_section_model($dcode)
  {
    $this->db2->select('scode, section_name');
    $this->db2->from('locate_section');
    $this->db2->where('LEFT(scode, 6) LIKE', $dcode);
    $this->db2->order_by('section_name', 'asc');
    $query = $this->db2->get();
    return $query->result_array();
  }

  public function get_sub_section_model($scode)
  {
    $this->db2->select('sscode, sub_section_name');
    $this->db2->from('locate_sub_section');
    $this->db2->where('LEFT(sscode, 8) LIKE', $scode);
    $this->db2->order_by('sub_section_name', 'asc');
    $query = $this->db2->get();
    return $query->result_array();
  }

  public function get_cashier_info_model($emp_id)
  {
    $this->db2->select('concat(company_code, bunit_code, dept_code, section_code, sub_section_code) as location');
    $this->db2->from('employee3');
    $this->db2->where('emp_id', $emp_id);
    $query = $this->db2->get();
    return $query->row();
  }

  public function update_location_ctrl($tr_no,$emp_id,$date,$borrowed,$dcode,$scode,$sscode,$remitted_dcode,$remitted_sscode)
  {
     // =================================update cs_cashier_cashdenomination=====================================
     $this->db->set('a.borrowed', $borrowed);
     $this->db->set('a.dep_code', $dcode);
     $this->db->set('a.section_code', $scode);
     $this->db->set('a.sub_section_code', $sscode);
     $this->db->where('a.tr_no', $tr_no);
     $this->db->where('a.emp_id', $emp_id);
     $this->db->where('date(a.date_submit)', $date);
     $this->db->update('cs_cashier_cashdenomination as a');
     
     // =================================update cs_cashier_noncashdenomination=====================================
     $this->db->set('b.borrowed', $borrowed);
     $this->db->set('b.dep_code', $dcode);
     $this->db->set('b.section_code', $scode);
     $this->db->set('b.sub_section_code', $sscode);
     $this->db->where('b.tr_no', $tr_no);
     $this->db->where('b.emp_id', $emp_id);
     $this->db->where('date(b.date_submit)', $date);
     $this->db->update('cs_cashier_noncashdenomination as b');
     
     // =================================update cebo_cs_data=====================================
     $this->db->set('c.dept_code', $dcode);
     $this->db->set('c.section_code', $scode);
     $this->db->set('c.sub_section_code', $sscode);
     $this->db->where('c.tr_no', $tr_no);
     $this->db->where('c.emp_id', $emp_id);
     $this->db->where('c.date_shrt', $date);
     $this->db->update('cebo_cs_data as c');
     
     // =================================update cebo_cs_denomination=====================================
     $this->db->set('d.dept_code', $dcode);
     $this->db->set('d.section_code', $scode);
     $this->db->set('d.sub_sec_code', $sscode);
     $this->db->where('d.tr_no', $tr_no);
     $this->db->where('d.emp_id', $emp_id);
     $this->db->where('d.date_shrt', $date);
     $this->db->update('cebo_cs_denomination as d');
 
     // =================================update cs_liq_remitted_cash=====================================
     $this->db->set('e.dcode', $remitted_dcode);
     $this->db->set('e.sscode', $remitted_sscode);
     $this->db->where('e.tr_no', $tr_no);
     $this->db->where('e.emp_id', $emp_id);
     $this->db->where('date(e.date_remitted)', $date);
     $this->db->update('cs_liq_remitted_cash as e');
  }

  public function get_batch_remittance_model($id,$tr_no,$emp_id,$location)
  {
    $this->db->select('id, cash_id, dcode, batch_remit, date(date_remitted) as date_remitted');
    $this->db->from('cs_liq_remitted_cash');
    $this->db->where('cash_id', $id);
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('sscode', $location);
    $this->db->order_by('batch_remit', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cash_data_model($id)
  {
    $this->db->select('pos_name, total_cash');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function update_batch_remittance_model($id,$batch,$date)
  {
    $this->db->set('batch_remit', $batch);
    $this->db->set('date_remitted', $date);
    $this->db->where('id', $id);
    $this->db->update('cs_liq_remitted_cash');
  }

  public function get_batch_counter($dcode,$batch_date)
  {
    $this->db->select('batch_remit');
    $this->db->from('cs_batch_remit_counter');
    $this->db->where('dcode', $dcode);
    $this->db->where('batch_date', $batch_date);
    $query = $this->db->get();
    return $query->row();
  }

  public function update_batch_counter($batch_remit,$dcode,$batch_date)
  {
    $this->db->set('batch_remit', $batch_remit);
    $this->db->where('dcode', $dcode);
    $this->db->where('batch_date', $batch_date);
    $this->db->update('cs_batch_remit_counter');
  }


  public function delete_zero_noncash_model($id, $mop_name, $amount)
  {
      $this->db->set('delete_status', 'DELETED');
      $this->db->where('id', $id);
      $this->db->where('mop_name', $mop_name);
      $this->db->where('noncash_amount', $amount);
  
      if ($this->db->update('cs_cashier_noncashdenomination')) {
          return true;
      } else {
          return false;
      }
  }

}

