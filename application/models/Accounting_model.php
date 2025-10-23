<?php

class Accounting_model extends CI_Model
{

  public function __construct()
  {
    $this->load->database();
    $this->db2 = $this->load->database('pis', TRUE);
  }


  public function get_emp($emp_no)
  {
    $query = $this->db2->query("
                                  SELECT * FROM  employee3 where emp_no ='".$emp_no."' and emp_no != '' and emp_no is not null
                              ");
    return $query->result_array();
  }

  public function get_cebo_cs_data_model($emp_id,$sales_date)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_shrt', $sales_date);
    $query = $this->db->get('cebo_cs_denomination');
    return $query->row();
  }

  public function get_cs_cashier_cashnoncashden_model($tr_no,$cashier_id)
  {
    $this->db->select('a.total_cash as total_cash, a.tr_no as tr_no, b.mop_name as mop_name, b.noncash_amount as noncash_amount');
    $this->db->from('cs_cashier_cashdenomination as a');
    $this->db->where('a.tr_no', $tr_no);
    $this->db->where('a.emp_id', $cashier_id);
    $this->db->join('cs_cashier_noncashdenomination as b', 'a.tr_no = b.tr_no', 'a.emp_id = b.emp_id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cs_cashier_noncashden_model($tr_no,$cashier_id)
  {
    $this->db->select('mop_name, noncash_amount');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where_in('tr_no', $tr_no);
    $this->db->where('emp_id', $cashier_id);
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cls_other_mop_model($tr_no,$cashier_id,$mop_name)
  {
    $this->db->select('sum(noncash_amount) as amount');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where_in('tr_no', $tr_no);
    $this->db->where('emp_id', $cashier_id);
    $this->db->where('mop_name', $mop_name);
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_partial_cash_model($tr_no,$cashier_id)
  {
    $this->db->select('sum(total_cash) as total');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where_in('tr_no', $tr_no);
    $this->db->where('emp_id', $cashier_id);
    $this->db->where('remit_type', 'PARTIAL');
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_final_cash_model($tr_no,$cashier_id)
  {
    // $this->db->select('sum(total_cash) as total');
    // $this->db->from('cs_cashier_cashdenomination');
    // $this->db->where_in('tr_no', $tr_no);
    // $this->db->where('emp_id', $cashier_id);
    // $this->db->where('remit_type', 'FINAL');
    // $this->db->where('delete_status <>', 'DELETED');
    // $query = $this->db->get();
    // return $query->row();
    
    $this->db->select('sum(ccd.total_cash) as total');
    $this->db->from('cs_cashier_cashdenomination AS ccd');
    $this->db->join('cebo_cs_dept_access AS cda', "CONCAT(ccd.company_code, ccd.bunit_code, ccd.dep_code, ccd.section_code, ccd.sub_section_code) = CONCAT(cda.company_code, cda.bunit_code, cda.dept_code, cda.section_code, cda.sub_section_code)");
    $this->db->where_in('ccd.tr_no', $tr_no);
    $this->db->where('ccd.emp_id', $cashier_id);
    $this->db->where('cda.emp_id', $_SESSION['emp_id']);
    $this->db->where('ccd.remit_type', 'FINAL');
    $this->db->where('ccd.delete_status <>', 'DELETED');
    $query = $this->db->get();
    return $query->row();
  }

  public function upload_file_model($tr_no,$receipt_no,$card_no,$tender_type,$amount_tendered,$card_or_account,$sales_date,$sales_time,$staff_id,$store_no,$pos_terminal_no,$bu_code,$dept_code)
  {
    $data = array(
      'tr_no'                    => $this->security->xss_clean(trim($tr_no)),
      'receipt_no'               => $this->security->xss_clean(trim($receipt_no)),
      'card_no'                  => $this->security->xss_clean(trim($card_no)),
      'tender_type'              => $this->security->xss_clean(trim($tender_type)),
      'amount_tendered'          => $this->security->xss_clean(trim($amount_tendered)),
      'card_or_account'          => $this->security->xss_clean(trim($card_or_account)),
      'sales_date'               => $this->security->xss_clean(trim($sales_date)),
      'sales_time'               => $this->security->xss_clean(trim($sales_time)),
      'staff_id'                 => $this->security->xss_clean(trim($staff_id)),
      'store_no'                 => $this->security->xss_clean(trim($store_no)),
      'pos_terminal_no'          => $this->security->xss_clean(trim($pos_terminal_no)),
      'bu_code'                  => $this->security->xss_clean(trim($bu_code)),
      'dept_code'                => $this->security->xss_clean(trim($dept_code)),
      'officer_incharge'         => $this->security->xss_clean(trim($_SESSION['emp_id']))
     );
    $this->db->set('date_time_uploaded', 'NOW()', FALSE);
    $this->db->insert('cs_nav_txtfile_uploaded', $data);
  }

  public function get_duplicate_textfile_model($staff_id,$sales_date,$store_no,$pos_terminal_no)
  {
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->limit(1);
    $query = $this->db->get('cs_nav_txtfile_uploaded');
    return $query->row();
  }

  public function get_sales_date_model($sales_date,$acctg_id)
  {
    $this->db->select('b.sales_date as sales_date, b.bu_code as bcode, b.dept_code as dcode, b.store_no as store_no');
    $this->db->from('cebo_cs_dept_access as a');
    $this->db->where('a.emp_id', $acctg_id);
    $this->db->join('cs_nav_txtfile_uploaded as b', 'concat(a.company_code,a.bunit_code,a.dept_code) = b.dept_code');
    $this->db->where('b.sales_date', $sales_date);
    // added
    $this->db->where('b.officer_incharge',  $_SESSION['emp_id']);
    // 
    $this->db->order_by('b.sales_date', 'desc');
    $this->db->group_by(array('b.sales_date', 'b.dept_code'));
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_store_no_model($sales_date,$dcode,$store_no)
  {
    $this->db->select('store_no');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('dept_code', $dcode);
    $this->db->where('store_no <>', $store_no);
    $this->db->group_by(array('sales_date', 'dept_code', 'store_no'));
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_sales_date_model2($acctg_id)
  {
    $this->db->select('b.sales_date as sales_date, b.bu_code as bcode, b.dept_code as dcode, b.store_no as store_no');
    $this->db->from('cebo_cs_dept_access as a');
    $this->db->where('a.emp_id', $acctg_id);
    $this->db->join('cs_nav_txtfile_uploaded as b', 'concat(a.company_code,a.bunit_code,a.dept_code) = b.dept_code');
    $this->db->where('b.status', 'ADJUSTED');
    $this->db->where('b.officer_incharge', $_SESSION['emp_id']);
    $this->db->order_by('b.sales_date', 'desc');
    $this->db->group_by(array('b.sales_date', 'b.dept_code'));
    $query = $this->db->get();
    return $query->result_array();
  }
// new sales date fetch-------------------------------------------------------
  public function get_sales_date_with_details($acctg_id) {
    $this->db->select("
        b.sales_date,
        b.bu_code AS bcode,
        b.dept_code AS dcode,
        GROUP_CONCAT(DISTINCT b.store_no SEPARATOR '|') AS store_nos,
        bu.acroname AS bname,
        bu.business_unit AS bname2,
        dept.dept_name AS dname
    ");
    $this->db->from('ebs.cebo_cs_dept_access AS a');
    $this->db->join('ebs.cs_nav_txtfile_uploaded AS b', 'CONCAT(a.company_code, a.bunit_code, a.dept_code) = b.dept_code', 'inner');
    $this->db->join('pis.locate_business_unit AS bu', 'bu.bcode = b.bu_code', 'left');
    $this->db->join('pis.locate_department AS dept', 'dept.dcode = b.dept_code', 'left');
    $this->db->where('a.emp_id', $acctg_id);
    $this->db->where('b.status', 'ADJUSTED');
    $this->db->where('b.officer_incharge', $_SESSION['emp_id']);
    $this->db->group_by(['b.sales_date', 'b.dept_code']);
    $this->db->order_by('b.sales_date', 'desc');

    return $this->db->get()->result_array();
}
// -----------------------------------------------------

  public function get_bcode_model($bname)
  {
    $this->db2->where('business_unit', $bname);
    $query = $this->db2->get('locate_business_unit');
    return $query->row();
  }

  public function get_bname_model($bcode)
  {
    $this->db2->where('bcode', $bcode);
    $query = $this->db2->get('locate_business_unit');
    return $query->row();
  }

  public function get_dcode_model($bcode,$dname)
  {
    $this->db2->where('dept_name', $dname);
    $this->db2->where('concat(company_code,bunit_code)', $bcode);
    $query = $this->db2->get('locate_department');
    return $query->row();
  }

  public function get_dname_model($dcode)
  {
    $this->db2->where('dcode', $dcode);
    $query = $this->db2->get('locate_department');
    return $query->row();
  }

  public function get_sname_model($scode)
  {
    $this->db2->where('scode', $scode);
    $query = $this->db2->get('locate_section');
    return $query->row();
  }

  public function get_ssname_model($sscode)
  {
    $this->db2->where('sscode', $sscode);
    $query = $this->db2->get('locate_sub_section');
    return $query->row();
  }

  public function get_staff_info_model($emp_no)
  {
    $this->db2->where('emp_no', $emp_no);
    $query = $this->db2->get('employee3');
    return $query->row();
  }

  public function get_staff_data_model($emp_no)
  {
    $this->db2->select('emp_id, name');
    $this->db2->from('employee3');
    $this->db2->where_in('emp_no', $emp_no);
    $query = $this->db2->get();
    return $query->row();
  }

  public function get_uploaded_navdata_model($sales_date,$store_no)
  {
    $this->db->select('staff_id');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->group_by('staff_id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_uploaded_navdata_model_v2($sales_date,$store_no)
  {
    $this->db->select('staff_id');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    // added
    $this->db->where('officer_incharge', $this->session->userdata('emp_id'));
    // 
    $this->db->where_in('store_no', $store_no);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->group_by('staff_id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_upload_adjusted_navdata_model($sales_date,$store_no)
  {
    $this->db->select('staff_id');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->group_by('staff_id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_upload_adjusted_navdata_model_v2($sales_date,$store_no)
  {
    $this->db->select('staff_id');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->group_by('staff_id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_adjusted_uploaded_navdata_model($sales_date,$store_no)
  {
    $this->db->select('staff_id');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->group_by('staff_id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_adjusted_uploaded_navdata_model_v2($sales_date,$store_no)
  {
    $this->db->select('staff_id');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->group_by('staff_id');

        // added
        $this->db->where('officer_incharge', $_SESSION['emp_id']);
        // 


    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_staff_net_amount_model($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_staff_net_amount_model_v2($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
        // $this->db->where('officer_incharge', $_SESSION['emp_id']);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_staff_net_amount_model($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_staff_net_amount_model_v2($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_tender_type_amount_model($sales_date,$store_no,$staff_id,$tender_type)
  {
    $this->db->select('sum(amount_tendered) as type_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where('tender_type', $tender_type);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_tender_type_amount_model_v2($sales_date,$store_no,$staff_id,$tender_type)
  {
    $this->db->select('sum(amount_tendered) as type_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where('tender_type', $tender_type);
    $this->db->where('officer_incharge', $_SESSION['emp_id']);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_cash_amount_model($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as type_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where_in('tender_type', array(1,50));
    $this->db->where('officer_incharge', $_SESSION['emp_id']);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_tender_type_amount_model($sales_date,$store_no,$staff_id,$tender_type)
  {
    $this->db->select('sum(amount_tendered) as type_amount, status');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where('tender_type', $tender_type);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_tender_type_amount_model_v2($sales_date,$store_no,$staff_id,$tender_type)
  {
    $this->db->select('sum(amount_tendered) as type_amount, status');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where('tender_type', $tender_type);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_nav_cash_amount_model($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as type_amount, status');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where_in('tender_type', array(1,50));
    $this->db->where('officer_incharge', $this->session->userdata('emp_id'));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_other_mop_amount_model($sales_date,$store_no,$staff_id,$tender_type)
  {
    $this->db->select('sum(amount_tendered) as amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where_in('tender_type', $tender_type);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_other_mop_amount_model_v2($sales_date,$store_no,$staff_id,$tender_type)
  {
    $this->db->select('sum(amount_tendered) as amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where('tender_type', $tender_type);
    $query = $this->db->get();
    return $query->row();
  }
  // public function get_nav_other_mop_amount_model_v3($sales_date,$store_no,$staff_id,$tender_type)
  // {
  //   $this->db->select('sum(amount_tendered) as amount');
  //   $this->db->from('cs_nav_txtfile_uploaded');
  //   $this->db->where('sales_date', $sales_date);
  //   $this->db->where_in('store_no', $store_no);
  //   $this->db->where('staff_id', $staff_id);
  //   $this->db->where('status <>', 'ADJUSTED');
  //   // $this->db->where('tender_type', $tender_type);
  //   if (is_array($tender_type)) {
  //       $this->db->where_in('tender_type', $tender_type); 
  //   } else {
  //       $this->db->where('tender_type', $tender_type);
  //   }

  //   $query = $this->db->get();
  //   return $query->row();
  // }

  //gi change
  public function get_nav_other_mop_amount_model_v3($sales_date, $store_no, $staff_id, $tender_type)
  {
      $this->db->select('IFNULL(SUM(amount_tendered), 0) as amount'); // Ensure result is 0 if no rows match
      $this->db->from('cs_nav_txtfile_uploaded');
      $this->db->where('sales_date', $sales_date);
      $this->db->where_in('store_no', $store_no);
      $this->db->where('staff_id', $staff_id);
      $this->db->where('status <>', 'ADJUSTED');
      
      if (!empty($tender_type)) {
          $this->db->where_in('tender_type', $tender_type);
      } else {
          // Add a condition that prevents matching any rows
          $this->db->where('1 = 0');
      }
      $this->db->where('officer_incharge', $this->session->userdata('emp_id'));
      $query = $this->db->get();
      return $query->row();
  }
  

  public function get_adjusted_nav_other_mop_amount_model($sales_date,$store_no,$staff_id,$tender_type)
  {
    $this->db->select('sum(amount_tendered) as amount, status');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where_in('tender_type', $tender_type);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_nav_other_mop_amount_model_v2($sales_date,$store_no,$staff_id,$tender_type)
  {
    $this->db->select('sum(amount_tendered) as amount, status');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where('tender_type', $tender_type);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_nav_other_mop_amount_model_v3($sales_date,$store_no,$staff_id,$tender_type)
  {
    $this->db->select('sum(amount_tendered) as amount, status');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where('tender_type', $tender_type);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_tender_type_amount_model2($sales_date,$store_no,$staff_id,$tender_type)
  {
    $this->db->select('sum(amount_tendered) as type_amount, status');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where('tender_type', $tender_type);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_giftcheck_tender_type_amount_model($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as type_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where_in('tender_type', array(8,34,35));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_giftcheck_tender_type_amount_model2($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as type_amount, status');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where_in('tender_type', array(8,34,35));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_atp_tender_type_amount_model($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as type_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where_in('tender_type', array(11,33));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_atp_tender_type_amount_model_v2($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as type_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where_in('tender_type', array(11,33));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_atp_tender_type_amount_model($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as type_amount, status');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where_in('tender_type', array(11,33));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_atp_tender_type_amount_model_v2($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as type_amount, status');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where_in('tender_type', array(11,33));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_empChargeCredit_tender_type_amount_model($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as type_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where_in('tender_type', array(13,36));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_empChargeCredit_tender_type_amount_model2($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as type_amount, status');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where_in('tender_type', array(13,36));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_otherpayment_tender_type_amount_model($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as type_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where_not_in('tender_type', array(1,3,8,9,11,13,14,15,28,33,34,35,36));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_otherpayment_tender_type_amount_model_v2($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as type_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where_not_in('tender_type', array(1,3,8,9,11,13,14,15,28,33,34,35,36));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_otherpayment_tender_type_amount_model($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as type_amount, status');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where_not_in('tender_type', array(1,3,8,9,11,13,14,15,28,33,34,35,36));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_otherpayment_tender_type_amount_model_v2($sales_date,$store_no,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as type_amount, status');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where_not_in('tender_type', array(1,3,8,9,11,13,14,15,28,33,34,35,36));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_other_tender_type_amount_model($sales_date,$store_no,$staff_id)
  {
    $this->db->select('tender_type as other_type');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->group_by('tender_type');
    $this->db->where_not_in('tender_type', array(1,3,8,9,11,13,14,15,28,33,34,35,36));
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_other_tender_type_amount_model_v2($sales_date,$store_no,$staff_id)
  {
    $this->db->select('tender_type as other_type');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->group_by('tender_type');
    $this->db->where_not_in('tender_type', array(1,3,8,9,11,13,14,15,28,33,34,35,36));
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_adjusted_other_tender_type_amount_model($sales_date,$store_no,$staff_id)
  {
    $this->db->select('tender_type as other_type');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->group_by('tender_type');
    $this->db->where_not_in('tender_type', array(1,3,8,9,11,13,14,15,28,33,34,35,36));
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_adjusted_other_tender_type_amount_model_v2($sales_date,$store_no,$staff_id)
  {
    $this->db->select('tender_type as other_type');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->group_by('tender_type');
    $this->db->where_not_in('tender_type', array(1,3,8,9,11,13,14,15,28,33,34,35,36));
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_icm_tender_name_model($tender_type)
  {
    $this->db->where('icm_payment_code', $tender_type);
    $query = $this->db->get('cs_nav_payment_type');
    return $query->row();
  }

  public function get_icm_tender_name_model_v2($tender_type)
  {
    $this->db->where('mop_code', $tender_type);
    $this->db->where('bcode', '0203');
    $query = $this->db->get('cs_bu_mode_of_payment');
    return $query->row();
  }

  public function get_alta_cita_tender_name_model($tender_type)
  {
    $this->db->where('mop_code', $tender_type);
    $this->db->where('bcode', '0223');
    $query = $this->db->get('cs_bu_mode_of_payment');
    return $query->row();
  }

  public function get_icm_tender_code_model($tender_name)
  {
    $this->db->where('icm_payment_name', $tender_name);
    $query = $this->db->get('cs_nav_payment_type');
    return $query->row();
  }

  public function get_icm_tender_code_model_v2($tender_name)
  {
    $this->db->where('mop_name', $tender_name);
    $this->db->where('bcode', '0203');
    $query = $this->db->get('cs_bu_mode_of_payment');
    return $query->row();
  }

  public function get_alta_cita_tender_code_model($tender_name)
  {
    $this->db->where('mop_name', $tender_name);
    $this->db->where('bcode', '0223');
    $query = $this->db->get('cs_bu_mode_of_payment');
    return $query->row();
  }

  public function get_icm_tender_type_model($tender_name)
  {
    $this->db->select('icm_payment_code as code');
    $this->db->from('cs_nav_payment_type');
    $this->db->where('icm_payment_name', $tender_name);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_icm_alltender_name_model($tender_type)
  {
    $this->db->select('icm_payment_name as name,icm_payment_code as code');
    $this->db->from('cs_nav_payment_type');
    $this->db->where('icm_payment_name <>', $tender_type);
    $this->db->where('icm_payment_name <>', '');
    // $this->db->where_not_in('icm_payment_code', array(1,9));
    $this->db->order_by('icm_payment_name', 'asc');
    $this->db->group_by('icm_payment_name');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_asc_tender_name_model($tender_type)
  {
    $this->db->where('asc_payment_code', $tender_type);
    $query = $this->db->get('cs_nav_payment_type');
    return $query->row();
  }

  public function get_mop_code_model($mop_name,$dcode)
  {
    $this->db->select('mop_code');
    $this->db->from('cs_bu_mode_of_payment');
    $this->db->where('mop_name', $mop_name);
    $this->db->where('dcode', $dcode);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_mop_name_model($tender_type,$dcode)
  {
    $this->db->select('mop_name');
    $this->db->from('cs_bu_mode_of_payment');
    $this->db->where('mop_code', $tender_type);
    $this->db->where('dcode', $dcode);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_asc_tender_name_model_v2($tender_type)
  {
    $this->db->where('mop_code', $tender_type);
    $this->db->where('bcode', '0201');
    $query = $this->db->get('cs_bu_mode_of_payment');
    return $query->row();
  }

  public function get_asc_tender_code_model($tender_name)
  {
    $this->db->where('asc_payment_name', $tender_name);
    $query = $this->db->get('cs_nav_payment_type');
    return $query->row();
  }

  public function get_asc_tender_code_model_v2($tender_name)
  {
    $this->db->where('mop_name', $tender_name);
    $this->db->where('bcode', '0201');
    $query = $this->db->get('cs_bu_mode_of_payment');
    return $query->row();
  }

  public function get_asc_tender_type_model($tender_name)
  {
    $this->db->select('asc_payment_code as code');
    $this->db->from('cs_nav_payment_type');
    $this->db->where('asc_payment_name', $tender_name);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_asc_alltender_name_model($tender_type)
  {
    $this->db->select('asc_payment_name as name,asc_payment_code as code');
    $this->db->from('cs_nav_payment_type');
    $this->db->where('asc_payment_name <>', $tender_type);
    $this->db->where('asc_payment_name <>', '');
    // $this->db->where_not_in('asc_payment_code', array(1,9));
    $this->db->order_by('asc_payment_name', 'asc');
    $this->db->group_by('asc_payment_name');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_pm_tender_name_model($tender_type)
  {
    $this->db->where('pm_payment_code', $tender_type);
    $query = $this->db->get('cs_nav_payment_type');
    return $query->row();
  }

  public function get_pm_tender_name_model_v2($tender_type)
  {
    $this->db->where('mop_code', $tender_type);
    $this->db->where('bcode', '0301');
    $query = $this->db->get('cs_bu_mode_of_payment');
    return $query->row();
  }

  public function get_pm_tender_code_model($tender_name)
  {
    $this->db->where('pm_payment_name', $tender_name);
    $query = $this->db->get('cs_nav_payment_type');
    return $query->row();
  }

  public function get_pm_tender_code_model_v2($tender_name)
  {
    $this->db->where('mop_name', $tender_name);
    $this->db->where('bcode', '0301');
    $query = $this->db->get('cs_bu_mode_of_payment');
    return $query->row();
  }

  public function get_pm_tender_type_model($tender_name)
  {
    $this->db->select('pm_payment_code as code');
    $this->db->from('cs_nav_payment_type');
    $this->db->where('pm_payment_name', $tender_name);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_pm_alltender_name_model($tender_type)
  {
    $this->db->select('pm_payment_name as name,pm_payment_code as code');
    $this->db->from('cs_nav_payment_type');
    $this->db->where('pm_payment_name <>', $tender_type);
    $this->db->where('pm_payment_name <>', '');
    // $this->db->where_not_in('pm_payment_code', array(1,9));
    $this->db->order_by('pm_payment_name', 'asc');
    $this->db->group_by('pm_payment_name');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cebo_cs_denomination_model($emp_id,$sales_date,$dcode)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_shrt', $sales_date);
    $this->db->where('concat(company_code,bunit_code,dept_code)', $dcode);
    $query = $this->db->get('cebo_cs_denomination');
    return $query->row();
  }

  public function get_cebo_cs_denomination_model_v2($emp_id,$sales_date,$dcode)
  {
    $this->db->select('tr_no, total_denomination as total, discount');
    $this->db->from('cebo_cs_denomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_shrt', $sales_date);
    $this->db->where('delete_status <>', 'deleted');
    $this->db->where('concat(company_code,bunit_code,dept_code)', $dcode);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_staff_terminal_counter_model($sales_date,$staff_id)
  {
    $this->db->select('store_no, pos_terminal_no');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->group_by('pos_terminal_no');
    $this->db->where('officer_incharge', $_SESSION['emp_id']);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_adjusted_staff_terminal_counter_model($sales_date,$staff_id)
  {
    $this->db->select('store_no, pos_terminal_no');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->group_by('pos_terminal_no');
    // added
    $this->db->where('officer_incharge', $_SESSION['emp_id']);
    // 
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_terminal_counter_amount_model($sales_date,$staff_id,$pos_terminal_no)
  {
    $this->db->select('sum(amount_tendered) as terminal_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $query = $this->db->get();
    return $query->row()->terminal_amount;
  }

  public function get_adjusted_terminal_counter_amount_model($sales_date,$staff_id,$pos_terminal_no)
  {
    $this->db->select('sum(amount_tendered) as terminal_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    // added
    // $this->db->where('officer_incharge', $_SESSION['emp_id']);
    // 
    $query = $this->db->get();
    return $query->row()->terminal_amount;
  }

  public function get_noncash_tender_type_model($sales_date,$staff_id)
  {
    $this->db->select('tender_type, store_no, dept_code');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    // $this->db->where_not_in('tender_type', array(1,9));
    $this->db->group_by('tender_type');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function update_navtextfile_upload_model($tender_array,$sales_date,$staff_id,$store_no)
  {
    $this->db->set('status', 'ORIGINAL');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('status', '');
    $this->db->where_in('tender_type', $tender_array);
    $this->db->update('cs_nav_txtfile_uploaded');
  }

  public function get_updated_navtextfile_model($tender_type,$sales_date,$staff_id,$store_no)
  {
    $this->db->select('tr_no,receipt_no,card_no,card_or_account,sales_time,pos_terminal_no,bu_code,dept_code');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', $tender_type);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->group_by('tender_type');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_updated_navtextfile_model2($tender_type_array,$sales_date,$staff_id,$store_no)
  {
    $this->db->select('tr_no,receipt_no,card_no,card_or_account,sales_time,pos_terminal_no,bu_code,dept_code');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', $tender_type_array);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->group_by('tender_type');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function insert_adjusted_model($tr_no,$receipt_no,$card_no,$tender_type,$amount_tendered,$card_or_account,$sales_date,$sales_time,$staff_id,$store_no,$pos_terminal_no,$bu_code,$dept_code,$status)
  {
    $data = array(
      'tr_no'                    => $this->security->xss_clean(trim($tr_no)),
      'receipt_no'               => $this->security->xss_clean(trim($receipt_no)),
      'card_no'                  => $this->security->xss_clean(trim($card_no)),
      'tender_type'              => $this->security->xss_clean(trim($tender_type)),
      'amount_tendered'          => $this->security->xss_clean(trim($amount_tendered)),
      'card_or_account'          => $this->security->xss_clean(trim($card_or_account)),
      'sales_date'               => $this->security->xss_clean(trim($sales_date)),
      'sales_time'               => $this->security->xss_clean(trim($sales_time)),
      'staff_id'                 => $this->security->xss_clean(trim($staff_id)),
      'store_no'                 => $this->security->xss_clean(trim($store_no)),
      'pos_terminal_no'          => $this->security->xss_clean(trim($pos_terminal_no)),
      'bu_code'                  => $this->security->xss_clean(trim($bu_code)),
      'dept_code'                => $this->security->xss_clean(trim($dept_code)),
      'officer_incharge'         => $this->security->xss_clean(trim($_SESSION['emp_id'])),
      'status'                   => $this->security->xss_clean(trim($status))
      // 'status'                   => 'ADJUSTED'
     );
    $this->db->set('date_time_uploaded', 'NOW()', FALSE);
    // $this->db->set('status', 'ADJUSTED');
    $this->db->insert('cs_nav_txtfile_uploaded', $data);
  }

  public function get_icmtender_type_model($tender_name)
  {
    $this->db->select('icm_payment_code as code');
    $this->db->from('cs_nav_payment_type');
    $this->db->where('icm_payment_name', $tender_name);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_asctender_type_model($tender_name)
  {
    $this->db->select('asc_payment_code as code');
    $this->db->from('cs_nav_payment_type');
    $this->db->where('asc_payment_name', $tender_name);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_pmtender_type_model($tender_name)
  {
    $this->db->select('pm_payment_code as code');
    $this->db->from('cs_nav_payment_type');
    $this->db->where('pm_payment_name', $tender_name);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_amount_transfer_tender_model($tender_array,$sales_date,$staff_id,$store_no)
  {
    $this->db->select('sum(amount_tendered) as amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where_in('tender_type', $tender_array);
    $query = $this->db->get();
    return $query->row();
  }

  public function update_adjusted_model($tender_type,$amount,$sales_date,$staff_id,$store_no)
  {
    $this->db->set('amount_tendered', $amount);
    $this->db->where('tender_type', $tender_type);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('status', 'ADJUSTED');
    $this->db->update('cs_nav_txtfile_uploaded');
  }

  public function validate_origin_update_model($origin_tender_type,$sales_date,$staff_id,$store_no)
  {
    $this->db->where('tender_type', $origin_tender_type);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('status', 'ADJUSTED');
    $query = $this->db->get('cs_nav_txtfile_uploaded');
    return $query->row();
  }

  public function validate_transfer_update_model($transfer_tender_type,$sales_date,$staff_id,$store_no)
  {
    $this->db->where('tender_type', $transfer_tender_type);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('status', 'ADJUSTED');
    $query = $this->db->get('cs_nav_txtfile_uploaded');
    return $query->row();
  }

  public function add_adjustment_model($origin_code,$origin_name,$transfer_code,$transfer_name,$transfer_amount,$sales_date,$staff_id,$store_no,$dcode,$reason,$file)
  {
    $data = array(
      'origin_code'              => $this->security->xss_clean(trim($origin_code)),
      'origin_name'              => $this->security->xss_clean(trim($origin_name)),
      'transfer_code'            => $this->security->xss_clean(trim($transfer_code)),
      'transfer_name'            => $this->security->xss_clean(trim($transfer_name)),
      'transfer_amount'          => $this->security->xss_clean(trim($transfer_amount)),
      'sales_date'               => $this->security->xss_clean(trim($sales_date)),
      'reason'                   => $this->security->xss_clean(trim($reason)),
      'attached_file'            => $this->security->xss_clean(trim($file)),
      'staff_id'                 => $this->security->xss_clean(trim($staff_id)),
      'store_no'                 => $this->security->xss_clean(trim($store_no)),
      'dcode'                    => $this->security->xss_clean(trim($dcode)),
      'officer_incharge'         => $this->security->xss_clean(trim($_SESSION['emp_id'])),
      'status'                   => $this->security->xss_clean(trim('PENDING'))
     );
    $this->db->set('date_requested', 'NOW()', FALSE);
    $this->db->insert('cs_nav_adjustment_history', $data);
  }

  public function get_adjustment_list_model($origin_code,$sales_date,$staff_id,$store_no)
  {
    $this->db->where('origin_code', $origin_code);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->order_by('id', 'asc');
    $query = $this->db->get('cs_nav_adjustment_history');
    return $query->result_array();
  }

  public function validate_mop_adjustment_model($origin_code,$transfer_code,$sales_date,$staff_id,$store_no,$dcode)
  {
    $this->db->where('origin_code', $origin_code);
    $this->db->where('transfer_code', $transfer_code);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('dcode', $dcode);
    $this->db->where('status', 'PENDING');
    $query = $this->db->get('cs_nav_adjustment_history');
    return $query->result_array();
  }

  public function delete_adjustment_model($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('cs_nav_adjustment_history');
  }

  public function get_adjusted_navtextfile_model($origin_code,$sales_date,$staff_id,$store_no)
  {
    $this->db->where('origin_code', $origin_code);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('status', 'APPROVED');
    $query = $this->db->get('cs_nav_adjustment_history');
    return $query->result_array();
  }

  public function update_nav_adjustment_model($origin_code,$sales_date,$staff_id,$store_no)
  {
    $this->db->set('status', 'ADJUSTED');
    $this->db->set('date_adjusted', 'NOW()', FALSE);
    $this->db->where('origin_code', $origin_code);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('status', 'APPROVED');
    $this->db->update('cs_nav_adjustment_history');
  }

  public function validate_mop_transfer_model($sales_date,$staff_id,$store_no,$origin_name,$transfer_name)
  {
    $this->db->select('status');
    $this->db->from('cs_nav_adjustment_history');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('transfer_name', $origin_name);
    $this->db->where('origin_name', $transfer_name);
    $query = $this->db->get();
    return $query->row()->status;
  }

  public function get_adjustment_history_model($officer_incharge)
  {
    $this->db->where('officer_incharge', $officer_incharge);
    $query = $this->db->get('cs_nav_adjustment_history');
    return $query->result_array();
  }

  public function get_cls_mop_model($sales_date,$dcode)
  {
    $this->db->select('mop_name');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('DATE_FORMAT(date_submit,"%Y-%m-%d")', $sales_date);
    $this->db->where('concat(company_code,bunit_code,dep_code)', $dcode);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->order_by('mop_name', 'asc');
    $this->db->group_by('mop_name');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cls_other_noncash_mop_model($sales_date,$dcode,$default_mop)
  {
    $this->db->select('mop_name');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('DATE_FORMAT(date_submit,"%Y-%m-%d")', $sales_date);
    $this->db->where('concat(company_code,bunit_code,dep_code)', $dcode);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where_not_in('mop_name', $default_mop);
    $this->db->order_by('mop_name', 'asc');
    $this->db->group_by('mop_name');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_nav_mop_model($sales_date,$store_no,$dept_code)
  {
    $this->db->select('tender_type');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where('tender_type <>', 9);
    $this->db->group_by('tender_type');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_nav_mop_model_v2($sales_date,$store_no,$dept_code)
  {
    $this->db->select('tender_type');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('status <>', 'ADJUSTED');
    // $this->db->where('tender_type <>', 9);
    $this->db->where_not_in('tender_type', array(9,50));
    $this->db->group_by('tender_type');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_adjusted_nav_mop_model($sales_date,$store_no,$dept_code)
  {
    $this->db->select('tender_type');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where('tender_type <>', 9);
    $this->db->group_by('tender_type');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_adjusted_nav_mop_model_v2($sales_date,$store_no,$dept_code)
  {
    $this->db->select('tender_type');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('status <>', 'ORIGINAL');
    // $this->db->where('tender_type <>', 9);
    $this->db->where_not_in('tender_type', array(9,50));
    $this->db->group_by('tender_type');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_nav_other_noncash_mop_model($sales_date,$store_no,$dept_code)
  {
    $this->db->select('tender_type');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where_not_in('tender_type', array(1,3,9,11,14,15,28,33,35,36));
    $this->db->group_by('tender_type');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_nav_other_noncash_mop_model_v2($sales_date,$store_no,$dept_code)
  {
    $bcode = substr($dept_code, 0, 4);
    $partial_code = 9;
    if($bcode == '0223'){
      $partial_code = 5;
    }
    $this->db->select('tender_type');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where_not_in('tender_type', array(1,3,$partial_code,11,14,15,28,33,35,36,50));
    $this->db->group_by('tender_type');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_adjusted_nav_other_noncash_mop_model($sales_date,$store_no,$dept_code)
  {
    $this->db->select('tender_type');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where_not_in('tender_type', array(1,3,9,11,14,15,28,33,35,36));
    $this->db->group_by('tender_type');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_adjusted_nav_other_noncash_mop_model_v2($sales_date,$store_no,$dept_code)
  {
    $this->db->select('tender_type');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where_not_in('tender_type', array(1,3,9,11,14,15,28,33,35,36,50));
    $this->db->group_by('tender_type');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cls_other_noncash_total_model($sales_date,$dcode,$mop_name)
  {
    // $this->db->select('sum(noncash_amount) as total');
    // $this->db->from('cs_cashier_noncashdenomination');
    // $this->db->where('DATE_FORMAT(date_submit,"%Y-%m-%d")', $sales_date);
    // $this->db->where('concat(company_code,bunit_code,dep_code)', $dcode);
    // $this->db->where('mop_name', $mop_name);
    // $this->db->where('delete_status !=', 'DELETED');
    // $this->db->where('status <>', 'SAMPLE'); /* gi add */
    // $query = $this->db->get();
    // return $query->row()->total;




    $this->db->select('sum(noncash_amount) as total');
    $this->db->from('cs_cashier_noncashdenomination AS ccd');
    $this->db->join('cebo_cs_dept_access AS cda', "CONCAT(ccd.company_code, ccd.bunit_code, ccd.dep_code, ccd.section_code, ccd.sub_section_code) = CONCAT(cda.company_code, cda.bunit_code, cda.dept_code, cda.section_code, cda.sub_section_code)", 'inner');
    $this->db->where('DATE_FORMAT(date_submit,"%Y-%m-%d")', $sales_date);
    $this->db->where('concat(ccd.company_code,ccd.bunit_code,ccd.dep_code)', $dcode);
    $this->db->where('ccd.mop_name', $mop_name);
    $this->db->where('cda.emp_id', $_SESSION['emp_id']);
    $this->db->where('ccd.status <>', 'SAMPLE');
    $this->db->where('ccd.delete_status <>', 'DELETED');

    $query = $this->db->get();
    return $query->row()->total;

  }

  public function get_nav_other_noncash_total_model($sales_date,$store_no,$dept_code,$tender_type)
  {
    $this->db->select('sum(amount_tendered) as total');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where('tender_type', $tender_type);
    $query = $this->db->get();
    return $query->row()->total;
  }

  // public function get_nav_other_noncash_total_model_v2($sales_date,$store_no,$dept_code,$tender_type)
  // {
  //   $this->db->select('sum(amount_tendered) as total');
  //   $this->db->from('cs_nav_txtfile_uploaded');
  //   $this->db->where('sales_date', $sales_date);
  //   $this->db->where_in('store_no', $store_no);
  //   $this->db->where('dept_code', $dept_code);
  //   $this->db->where('status <>', 'ADJUSTED');
  //   $this->db->where('officer_incharge', $this->session->userdata('emp_id'));
  //   $this->db->where_in('tender_type', $tender_type);
  //   $query = $this->db->get();
  //   return $query->row()->total;
  // }

  //gi change
  public function get_nav_other_noncash_total_model_v2($sales_date, $store_no, $dept_code, $tender_type)
  {
      $this->db->select('sum(amount_tendered) as total');
      $this->db->from('cs_nav_txtfile_uploaded');
      $this->db->where('sales_date', $sales_date);
      $this->db->where_in('store_no', $store_no);
      $this->db->where('dept_code', $dept_code);
      $this->db->where('status <>', 'ADJUSTED');
      $this->db->where('officer_incharge', $this->session->userdata('emp_id'));
      // Check if tender_type array is not empty before using where_in
      if (!empty($tender_type)) {
          $this->db->where_in('tender_type', $tender_type);
      }

      $query = $this->db->get();
      return $query->row()->total;
  }

  public function get_adjusted_nav_other_noncash_total_model($sales_date,$store_no,$dept_code,$tender_type)
  {
    $this->db->select('sum(amount_tendered) as total');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where('tender_type', $tender_type);
    $query = $this->db->get();
    return $query->row()->total;
  }

  public function get_adjusted_nav_other_noncash_total_model_v2($sales_date,$store_no,$dept_code,$tender_type)
  {
    $this->db->select('sum(amount_tendered) as total');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where('tender_type', $tender_type);

    // added
    $this->db->where('officer_incharge', $_SESSION['emp_id']);
    //

    $query = $this->db->get();
    return $query->row()->total;
  }

  public function get_cls_cash_terminal_no_model($tr_no,$emp_id)
  {
    // $this->db->select('tr_no, pos_name, concat(company_code,bunit_code,dep_code,section_code,sub_section_code) as location');
    // $this->db->from('cs_cashier_cashdenomination');
    // $this->db->where_in('tr_no', $tr_no);
    // $this->db->where('emp_id', $emp_id);
    // $this->db->where('delete_status <>', 'DELETED');
    // $this->db->group_by('pos_name');
    $this->db->select('ccd.tr_no, ccd.pos_name, CONCAT(ccd.company_code, ccd.bunit_code, ccd.dep_code, ccd.section_code, ccd.sub_section_code) as location');
    $this->db->from('cs_cashier_cashdenomination AS ccd');
    $this->db->join('cebo_cs_dept_access AS cda', "CONCAT(ccd.company_code, ccd.bunit_code, ccd.dep_code, ccd.section_code, ccd.sub_section_code) = CONCAT(cda.company_code, cda.bunit_code, cda.dept_code, cda.section_code, cda.sub_section_code)", 'inner');
    $this->db->where_in('ccd.tr_no', $tr_no);
    $this->db->where('ccd.emp_id', $emp_id);
    $this->db->where('cda.emp_id', $_SESSION['emp_id']);
    $this->db->where('ccd.delete_status <>', 'DELETED');
    $this->db->group_by('pos_name');

    $query = $this->db->get();
    return $query->result_array();

  }

  public function get_cls_noncash_terminal_no_model($tr_no,$emp_id)
  {
    // $this->db->select('tr_no, pos_name, concat(company_code,bunit_code,dep_code,section_code,sub_section_code) as location');
    // $this->db->from('cs_cashier_noncashdenomination');
    // $this->db->where_in('tr_no', $tr_no);
    // $this->db->where('emp_id', $emp_id);
    // $this->db->where('delete_status <>', 'DELETED');
    // $this->db->group_by('pos_name');

    $this->db->select('ccd.tr_no, ccd.pos_name, CONCAT(ccd.company_code, ccd.bunit_code, ccd.dep_code, ccd.section_code, ccd.sub_section_code) as location');
    $this->db->from('cs_cashier_noncashdenomination AS ccd');
    $this->db->join('cebo_cs_dept_access AS cda', "CONCAT(ccd.company_code, ccd.bunit_code, ccd.dep_code, ccd.section_code, ccd.sub_section_code) = CONCAT(cda.company_code, cda.bunit_code, cda.dept_code, cda.section_code, cda.sub_section_code)", 'inner');
    $this->db->where_in('ccd.tr_no', $tr_no);
    $this->db->where('ccd.emp_id', $emp_id);
    $this->db->where('cda.emp_id', $_SESSION['emp_id']);
    $this->db->where('ccd.delete_status <>', 'DELETED');
    $this->db->group_by('pos_name');
    $query = $this->db->get();

    return $query->result_array();
  }

  public function get_pos_cash_discount_model($tr_no,$emp_id)
  {
    $this->db->select('discount');
    $this->db->from('cebo_cs_denomination');
    $this->db->where_in('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('delete_status <>', 'deleted');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_cls_cash_terminal_no_total_model($tr_no,$emp_id,$pos_name)
  {
    // $this->db->select('sum(total_cash) as total');
    // $this->db->from('cs_cashier_cashdenomination');
    // $this->db->where_in('tr_no', $tr_no);
    // $this->db->where('emp_id', $emp_id);
    // $this->db->where('pos_name', $pos_name);
    // $this->db->where('delete_status <>', 'DELETED');

    $this->db->select('sum(ccd.total_cash) as total');
    $this->db->from('cs_cashier_cashdenomination AS ccd');
    $this->db->join('cebo_cs_dept_access AS cda', "CONCAT(ccd.company_code, ccd.bunit_code, ccd.dep_code, ccd.section_code, ccd.sub_section_code) = CONCAT(cda.company_code, cda.bunit_code, cda.dept_code, cda.section_code, cda.sub_section_code)", 'inner');
    $this->db->where_in('ccd.tr_no', $tr_no);
    $this->db->where('ccd.emp_id', $emp_id);
    $this->db->where('ccd.pos_name', $pos_name);
    $this->db->where('cda.emp_id', $_SESSION['emp_id']);
    $this->db->where('ccd.status <>', 'SAMPLE');
    $this->db->where('ccd.delete_status <>', 'DELETED');
    // $this->db->where('ccd.date_submit', $_POST['sales_date']);
    $query = $this->db->get();
    return $query->row()->total;




  }

  public function get_cls_noncash_terminal_no_total_model($tr_no,$emp_id,$pos_name)
  {
    // $this->db->select('sum(noncash_amount) as total');
    // $this->db->from('cs_cashier_noncashdenomination');
    // $this->db->where_in('tr_no', $tr_no);
    // $this->db->where('emp_id', $emp_id);
    // $this->db->where('pos_name', $pos_name);
    // $this->db->where('delete_status <>', 'DELETED');
    // $this->db->where('status <>', 'SAMPLE');

    $this->db->select('sum(ccd.noncash_amount) as total');
    $this->db->from('cs_cashier_noncashdenomination AS ccd');
    $this->db->join('cebo_cs_dept_access AS cda', "CONCAT(ccd.company_code, ccd.bunit_code, ccd.dep_code, ccd.section_code, ccd.sub_section_code) = CONCAT(cda.company_code, cda.bunit_code, cda.dept_code, cda.section_code, cda.sub_section_code)", 'inner');
    $this->db->where_in('ccd.tr_no', $tr_no);
    $this->db->where('ccd.emp_id', $emp_id);
    $this->db->where('ccd.pos_name', $pos_name);
    $this->db->where('cda.emp_id', $_SESSION['emp_id']);
    $this->db->where('ccd.status <>', 'SAMPLE'); /* gi add */
    $this->db->where('delete_status <>', 'DELETED');
    // $this->db->where('ccd.date_submit', $_POST['sales_date']);


    $query = $this->db->get();
    return $query->row()->total;
  }

  public function get_cls_cash_location_data_model($emp_id,$sales_date)
  {
    $this->db->select('concat(company_code,bunit_code,dep_code,section_code,sub_section_code) as sscode');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date(date_submit)', $sales_date);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->group_by('tr_no');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cls_noncash_location_data_model($emp_id,$sales_date)
  {
    $this->db->select('concat(company_code,bunit_code,dep_code,section_code,sub_section_code) as sscode');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date(date_submit)', $sales_date);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->group_by('tr_no');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cls_terminal_data_model($emp_id,$sales_date)
  {
    $this->db->select('tr_no, total_denomination, discount');
    $this->db->from('cebo_cs_denomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_shrt', $sales_date);
    $this->db->where('delete_status <>', 'deleted');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cls_cash_terminal_model($tr_no,$emp_id)
  {
    $this->db->select('pos_name');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->group_by('tr_no');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cls_noncash_terminal_model($tr_no,$emp_id)
  {
    $this->db->select('pos_name');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->group_by('tr_no');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_nav_terminal_data_model($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as terminal_sales, pos_terminal_no');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->group_by('pos_terminal_no');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_nav_terminal_data_model_v2($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as terminal_sales, pos_terminal_no');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->group_by('pos_terminal_no');
    $this->db->where('officer_incharge', $this->session->userdata('emp_id'));
    
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_nav_adjusted_terminal_data_model($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as terminal_sales, pos_terminal_no');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->group_by('pos_terminal_no');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_nav_adjusted_terminal_data_model_v2($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as terminal_sales, pos_terminal_no');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->group_by('pos_terminal_no');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cls_partial_cash_data_model($emp_id,$sales_date)
  {
    $this->db->select('sum(total_cash) as partial_cash');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('remit_type', 'PARTIAL');
    $this->db->where('status', 'TRANSFERRED');
    $this->db->where('date(date_submit)', $sales_date);
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_cls_final_cash_data_model($emp_id,$sales_date)
  {
    $this->db->select('sum(total_cash) as final_cash');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('remit_type', 'FINAL');
    $this->db->where('status', 'TRANSFERRED');
    $this->db->where('date(date_submit)', $sales_date);
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_cls_discount_data_model($emp_id,$sales_date)
  {
    $this->db->select('sum(discount) as discount');
    $this->db->from('cebo_cs_denomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_shrt', $sales_date);
    $this->db->where('delete_status <>', 'deleted');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_partial_cash_data_model($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as partial_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', 9);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_partial_cash_data_model_v2($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as partial_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', 9);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_adjusted_partial_cash_data_model($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as partial_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', 9);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_adjusted_partial_cash_data_model_v2($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as partial_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', 9);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_final_cash_data_model($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as final_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', 1);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_final_cash_data_model_v2($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as final_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', array(1,50));
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_adjusted_final_cash_data_model($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as final_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', 1);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_adjusted_final_cash_data_model_v2($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as final_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', array(1,50));
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_cls_noncash_data_model($emp_id,$mop_name,$sales_date)
  {
    $this->db->select('sum(noncash_amount) as noncash_amount');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('mop_name', $mop_name);
    $this->db->where('status', 'TRANSFERRED');
    $this->db->where('date(date_submit)', $sales_date);
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_noncash_data_model($tender_type,$staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as noncash_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', $tender_type);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_noncash_data_model_v2($tender_type,$staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as noncash_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', $tender_type);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_adjusted_noncash_data_model($tender_type,$staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as noncash_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', $tender_type);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_adjusted_noncash_data_model_v2($tender_type,$staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as noncash_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', $tender_type);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_total_nav_noncash_data_model($tender_type,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_noncash_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', $tender_type);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_total_nav_noncash_data_model_v2($tender_type,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_noncash_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', $tender_type);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where('officer_incharge', $this->session->userdata('emp_id'));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_total_adjusted_nav_noncash_data_model($tender_type,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_noncash_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', $tender_type);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_total_adjusted_nav_noncash_data_model_v2($tender_type,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_noncash_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', $tender_type);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_total_partial_cash_data_model($sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_partial_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', 9);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_total_partial_cash_data_model_v2($sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_partial_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', 9);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('officer_incharge', $_SESSION['emp_id']);
    $this->db->where('status <>', 'ADJUSTED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_adjusted_total_partial_cash_data_model($sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_partial_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', 9);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_adjusted_total_partial_cash_data_model_v2($sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_partial_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', 9);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_total_final_cash_data_model($sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_final_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', 1);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_total_final_cash_data_model_v2($sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_final_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', array(1,50));
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where('officer_incharge', $_SESSION['emp_id']);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_adjusted_total_final_cash_data_model($sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_final_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', 1);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_adjusted_total_final_cash_data_model_v2($sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_final_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', array(1,50));
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_cls_total_sales_data_model($emp_id,$sales_date)
  {
    $this->db->select('sum(total_denomination) as total_sales, sum(discount) as discount');
    $this->db->from('cebo_cs_denomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_shrt', $sales_date);
    $this->db->where('delete_status <>', 'deleted');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_total_sales_data_model($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_sales');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_total_sales_data_model_v2($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_sales');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_adjusted_total_sales_data_model($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_sales');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_adjusted_total_sales_data_model_v2($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_sales');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_grand_total_sales_data_model($sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_sales');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_grand_total_sales_data_model_v2($sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_sales');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where('officer_incharge', $this->session->userdata('emp_id'));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_adjusted_grand_total_sales_data_model($sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_sales');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_adjusted_grand_total_sales_data_model_v2($sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_sales');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_wholesale_tender_type_model($dcode,$mop_name)
  {
    $this->db->select('mop_code');
    $this->db->from('cs_bu_mode_of_payment');
    $this->db->where('dcode', $dcode);
    $this->db->where('mop_name', $mop_name);
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->row();
  }

  public function validate_cash_wholesale_model($sales_date,$store_no,$dept_code)
  {
    $this->db->select('sum(amount_tendered) as cash_wholesale');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where('officer_incharge', $_SESSION['emp_id']);
    $this->db->where('tender_type', 50);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_cash_wholesale_amount_model($sales_date,$store_no,$dept_code,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as cash_wholesale');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where('tender_type', 50);
    $query = $this->db->get();
    return $query->row();
  }

  public function validate_adjsuted_cash_wholesale_model($sales_date,$store_no,$dept_code)
  {
    $this->db->select('sum(amount_tendered) as cash_wholesale');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where('tender_type', 50);
    $query = $this->db->get();
    return $query->row();
  }

  public function ge_adjusted_cash_wholesale_amount_model($sales_date,$store_no,$dept_code,$staff_id)
  {
    $this->db->select('sum(amount_tendered) as cash_wholesale');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where('tender_type', 50);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_deduction_amount_model($tr_no,$emp_id)
  {
    $this->db->select('sum(amount_shrt) as deduction_amount');
    $this->db->from('cebo_cs_data');
    $this->db->where_in('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);

    // added louei
    $this->db->where('tr_no <>', '');

    $this->db->where('type', 'S');
    $this->db->where('delete_status <>', 'deleted');

    $this->db->where('amount_shrt >=', 10);
    $query = $this->db->get();
    return $query->row();
  }

  // added louei
  public function get_deduction_amount_model2($date_shrt, $emp_id)
  {
      $this->db->select('COALESCE(SUM(amount_shrt), 0) AS deduction_amount');
      $this->db->from('cebo_cs_data');
      $this->db->where('date_shrt', $date_shrt);
      $this->db->where('emp_id', $emp_id);
      $this->db->where('type', 'S');
      $this->db->where('amount_shrt >=', 10);
      $this->db->where('delete_status <>', 'deleted');
      $query = $this->db->get();
      return $query->row();
  }
  


  public function get_print_deduction_amount_model($emp_id,$sales_date)
  {
    $this->db->select('sum(amount_shrt) as deduction_amount');
    $this->db->from('cebo_cs_data');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_shrt', $sales_date);
    $this->db->where('type', 'S');
    $this->db->where('amount_shrt >=', 10);
    $this->db->where('delete_status <>', 'deleted');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_cls_cash_location_data_model_v2($emp_id,$sales_date,$pos_name)
  {
    $this->db->select('concat(company_code,bunit_code,dep_code,section_code,sub_section_code) as sscode, tr_no');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('date(date_submit)', $sales_date);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->group_by('tr_no');

    // $this->db->select('concat(ccd.company_code,ccd.bunit_code,ccd.dep_code,ccd.section_code,ccd.sub_section_code) as sscode, ccd.tr_no');
    // $this->db->from('cs_cashier_cashdenomination AS ccd');
    // $this->db->join('cebo_cs_dept_access AS cda', "CONCAT(ccd.company_code, ccd.bunit_code, ccd.dep_code, ccd.section_code, ccd.sub_section_code) = CONCAT(cda.company_code, cda.bunit_code, cda.dept_code, cda.section_code, cda.sub_section_code)", 'inner');
    // $this->db->where('ccd.emp_id', $emp_id);
    // $this->db->where('ccd.pos_name', $pos_name);
    // $this->db->where('date(ccd.date_submit)', $sales_date);
    // $this->db->where('cda.emp_id', $_SESSION['emp_id']);
    // $this->db->where('ccd.delete_status <>', 'DELETED');
    // $this->db->group_by('ccd.tr_no');


    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cls_noncash_location_data_model_v2($emp_id,$sales_date,$pos_name)
  {
    $this->db->select('concat(company_code,bunit_code,dep_code,section_code,sub_section_code) as sscode, tr_no');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('date(date_submit)', $sales_date);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->group_by('tr_no');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cls_terminal_data_model_v2($tr_no,$emp_id,$sales_date)
  {
    $this->db->select('a.tr_no, a.total_denomination, a.discount, b.pos_name as cash_terminal, c.pos_name as noncash_terminal');
    $this->db->from('cebo_cs_denomination as a');
    $this->db->where('a.tr_no', $tr_no);
    $this->db->where('a.emp_id', $emp_id);
    $this->db->where('a.date_shrt', $sales_date);
    $this->db->where('a.delete_status <>', 'deleted');
    $this->db->join('cs_cashier_cashdenomination as b', 'a.tr_no = b.tr_no', 'a.emp_id = b.emp_id');
    $this->db->where('b.delete_status <>', 'DELETED');
    $this->db->group_by('b.tr_no');
    $this->db->join('cs_cashier_noncashdenomination as c', 'b.tr_no = c.tr_no', 'b.emp_id = c.emp_id');
    $this->db->where('c.delete_status <>', 'DELETED');
    $this->db->group_by('c.tr_no');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_cls_cash_location_data_model_v3($emp_id,$sales_date)
  {
    // $this->db->select('pos_name');
    // $this->db->from('cs_cashier_cashdenomination');
    // $this->db->where('emp_id', $emp_id);
    // $this->db->where('date(date_submit)', $sales_date);
    // $this->db->where('delete_status <>', 'DELETED');
    // $this->db->group_by('pos_name');


    $this->db->select('ccd.pos_name');
    $this->db->from('cs_cashier_cashdenomination AS ccd');
    $this->db->join('cebo_cs_dept_access AS cda', "CONCAT(ccd.company_code, ccd.bunit_code, ccd.dep_code, ccd.section_code, ccd.sub_section_code) = CONCAT(cda.company_code, cda.bunit_code, cda.dept_code, cda.section_code, cda.sub_section_code)", 'inner');
    $this->db->where('ccd.emp_id', $emp_id);
    $this->db->where('date(ccd.date_submit)', $sales_date);
    $this->db->where('cda.emp_id', $_SESSION['emp_id']);
    $this->db->where('ccd.delete_status <>', 'DELETED');
    $this->db->group_by('ccd.pos_name');


    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cls_noncash_location_data_model_v3($emp_id,$sales_date)
  {
    // $this->db->select('pos_name');
    // $this->db->from('cs_cashier_noncashdenomination');
    // $this->db->where('emp_id', $emp_id);
    // $this->db->where('date(date_submit)', $sales_date);
    // $this->db->where('delete_status <>', 'DELETED');
    // $this->db->group_by('pos_name');
    $this->db->select('ccd.pos_name');
    $this->db->from('cs_cashier_noncashdenomination AS ccd');
    $this->db->join('cebo_cs_dept_access AS cda', "CONCAT(ccd.company_code, ccd.bunit_code, ccd.dep_code, ccd.section_code, ccd.sub_section_code) = CONCAT(cda.company_code, cda.bunit_code, cda.dept_code, cda.section_code, cda.sub_section_code)", 'inner');
    $this->db->where('ccd.emp_id', $emp_id);
    $this->db->where('date(ccd.date_submit)', $sales_date);
    $this->db->where('cda.emp_id', $_SESSION['emp_id']);
    $this->db->where('ccd.delete_status <>', 'DELETED');
    $this->db->group_by('ccd.pos_name');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cls_total_sales_data_model_v2($tr_no,$emp_id,$sales_date)
  {
    $this->db->select('sum(total_denomination) as total_sales, sum(discount) as discount');
    $this->db->from('cebo_cs_denomination');
    $this->db->where_in('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_shrt', $sales_date);
    $this->db->where('delete_status <>', 'deleted');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_total_sales_data_model_v3($staff_id,$sales_date,$store_no,$dcode,$pos_terminal_no)
  {
    $this->db->select('sum(amount_tendered) as total_sales');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    
    $query = $this->db->get();
    return $query->row();
  }

  public function get_cash_wholesale_amount_model_v2($sales_date,$store_no,$dept_code,$staff_id,$pos_terminal_no)
  {
    $this->db->select('sum(amount_tendered) as cash_wholesale');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where('tender_type', 50);

    
    
    $query = $this->db->get();
    return $query->row();
  }

  public function get_cls_partial_cash_data_model_v2($emp_id,$sales_date,$pos_name)
  {
    $this->db->select('sum(total_cash) as partial_cash');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('remit_type', 'PARTIAL');
    $this->db->where('status', 'TRANSFERRED');
    $this->db->where('date(date_submit)', $sales_date);
    $this->db->where('delete_status <>', 'DELETED');


    $query = $this->db->get();
    return $query->row();
  }

  public function get_cls_final_cash_data_model_v2($emp_id,$sales_date,$pos_name)
  {
    // $this->db->select('sum(total_cash) as final_cash, tr_no');
    // $this->db->from('cs_cashier_cashdenomination');
    // $this->db->where('emp_id', $emp_id);
    // $this->db->where('pos_name', $pos_name);
    // $this->db->where('remit_type', 'FINAL');
    // $this->db->where('status', 'TRANSFERRED');
    // $this->db->where('date(date_submit)', $sales_date);
    // $this->db->where('delete_status <>', 'DELETED');
    // $this->db->group_by('tr_no');


    // $query = $this->db->get();
    // return $query->result_array();
    $this->db->select('sum(ccd.total_cash) as final_cash, tr_no');
    $this->db->from('cs_cashier_cashdenomination AS ccd');
    $this->db->join('cebo_cs_dept_access AS cda', "CONCAT(ccd.company_code, ccd.bunit_code, ccd.dep_code, ccd.section_code, ccd.sub_section_code) = CONCAT(cda.company_code, cda.bunit_code, cda.dept_code, cda.section_code, cda.sub_section_code)", 'inner');
    $this->db->where('ccd.emp_id', $emp_id);
    $this->db->where('ccd.pos_name', $pos_name);
    $this->db->where('ccd.remit_type', 'FINAL');
    $this->db->where('ccd.status', 'TRANSFERRED');
    $this->db->where('date(ccd.date_submit)', $sales_date);
    $this->db->where('cda.emp_id', $_SESSION['emp_id']);
    $this->db->where('ccd.delete_status <>', 'DELETED');
    $this->db->group_by('tr_no');

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cls_discount_data_model_v2($tr_no,$emp_id,$sales_date)
  {
    $this->db->select('sum(discount) as discount');
    $this->db->from('cebo_cs_denomination');
    $this->db->where_in('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_shrt', $sales_date);
    $this->db->where('delete_status <>', 'deleted');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_partial_cash_data_model_v3($staff_id,$sales_date,$store_no,$dcode,$pos_terminal_no)
  {
    $bcode = substr($dcode, 0, 4);
    $partial_code = 9;
    if($bcode == '0223'){
      $partial_code = 5;
    }
    $this->db->select('sum(amount_tendered) as partial_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', $partial_code);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where('officer_incharge', $this->session->userdata('emp_id'));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_final_cash_data_model_v3($staff_id,$sales_date,$store_no,$dcode,$pos_terminal_no)
  {
    $this->db->select('sum(amount_tendered) as final_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', array(1,50));
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where('officer_incharge', $this->session->userdata('emp_id'));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_noncash_nav_terminal_data_model($tender_type,$staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('pos_terminal_no');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where_in('tender_type', $tender_type);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where('officer_incharge', $this->session->userdata('emp_id'));

    $this->db->group_by('pos_terminal_no');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cls_noncash_data_model_v2($emp_id,$mop_name,$sales_date,$pos_name)
  {
    $this->db->select('sum(noncash_amount) as noncash_amount');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('mop_name', $mop_name);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('status', 'TRANSFERRED');
    $this->db->where('date(date_submit)', $sales_date);
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get();
    return $query->row();
  }
  

  public function get_nav_noncash_data_model_v3($tender_type,$staff_id,$sales_date,$store_no,$dcode,$pos_terminal_no)
  {
    $this->db->select('sum(amount_tendered) as noncash_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', $tender_type);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where('officer_incharge', $this->session->userdata('emp_id'));
    $this->db->where('status <>', 'ADJUSTED');
    $query = $this->db->get();
    return $query->row();
  }
  public function get_nav_noncash($tender_type,$staff_id,$sales_date,$store_no,$dcode,$pos_terminal_no)
  {
    $this->db->select('sum(amount_tendered) as noncash_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', $tender_type);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where('officer_incharge', $this->session->userdata('emp_id'));
    $this->db->where('status <>', 'ADJUSTED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_cls_noncash_location_data_model_v4($emp_id,$sales_date,$mop_name)
  {
    // $this->db->select('pos_name');
    // $this->db->from('cs_cashier_noncashdenomination');
    // $this->db->where('emp_id', $emp_id);
    // $this->db->where('mop_name', $mop_name);
    // $this->db->where('date(date_submit)', $sales_date);
    // $this->db->where('delete_status <>', 'DELETED');
    // $this->db->group_by('pos_name');

    $this->db->select('ccd.pos_name');
    $this->db->from('cs_cashier_noncashdenomination AS ccd');
    $this->db->join('cebo_cs_dept_access AS cda', "CONCAT(ccd.company_code, ccd.bunit_code, ccd.dep_code, ccd.section_code, ccd.sub_section_code) = CONCAT(cda.company_code, cda.bunit_code, cda.dept_code, cda.section_code, cda.sub_section_code)", 'inner');
    $this->db->where('ccd.emp_id', $emp_id);
    $this->db->where('ccd.mop_name', $mop_name);
    $this->db->where('date(ccd.date_submit)', $sales_date);
    $this->db->where('cda.emp_id', $_SESSION['emp_id']);
    $this->db->where('ccd.delete_status <>', 'DELETED');
    $this->db->group_by('ccd.pos_name');


    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_nav_terminal_data_model_v3($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('pos_terminal_no');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('tender_type', array(1,9,50));
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->group_by('pos_terminal_no');

    // added
    $this->db->where('officer_incharge', $_SESSION['emp_id']);
    //

    $query = $this->db->get();
    return $query->result_array();
  }

  public function validate_adjusted_cash_wholesale_model($sales_date,$store_no,$dept_code)
  {
    $this->db->select('sum(amount_tendered) as cash_wholesale');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where('tender_type', 50);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_uploaded_adjusted_navdata_model($sales_date,$store_no)
  {
    $this->db->select('staff_id');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->group_by('staff_id');

    // added
    $this->db->where('officer_incharge', $_SESSION['emp_id']);
    //

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_adjusted_nav_terminal_data_model($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('pos_terminal_no');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('tender_type', array(1,9,50));
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->group_by('pos_terminal_no');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_adjusted_cash_wholesale_amount_model($sales_date,$store_no,$dept_code,$staff_id,$pos_terminal_no)
  {
    $this->db->select('sum(amount_tendered) as cash_wholesale');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dept_code);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->where('tender_type', 50);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_nav_partial_cash_data_model($staff_id,$sales_date,$store_no,$dcode,$pos_terminal_no)
  {
    $bcode = substr($dcode, 0, 4);
    $partial_code = 9;
    if($bcode == '0223'){
      $partial_code = 5;
    }
    $this->db->select('sum(amount_tendered) as partial_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', $partial_code);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where('status <>', 'ORIGINAL');

    // added
    $this->db->where('officer_incharge', $_SESSION['emp_id']);
    //


    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_nav_final_cash_data_model($staff_id,$sales_date,$store_no,$dcode,$pos_terminal_no)
  {
    $this->db->select('sum(amount_tendered) as final_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', array(1,50));
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where('status <>', 'ORIGINAL');

    // added
    $this->db->where('officer_incharge', $_SESSION['emp_id']);
    //


    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_noncash_nav_terminal_data_model($tender_type,$staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('pos_terminal_no');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where_in('tender_type', $tender_type);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->group_by('pos_terminal_no');

    // added
    $this->db->where('officer_incharge', $_SESSION['emp_id']);
    //
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_adjusted_nav_noncash_data_model($tender_type,$staff_id,$sales_date,$store_no,$dcode,$pos_terminal_no)
  {
    $this->db->select('sum(amount_tendered) as noncash_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', $tender_type);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('pos_terminal_no', $pos_terminal_no);

        // added
        $this->db->where('officer_incharge', $_SESSION['emp_id']);
        //

    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_nav_terminal_data_model_v2($staff_id,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as terminal_sales, pos_terminal_no');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $this->db->group_by('pos_terminal_no');

    // added
    $this->db->where('officer_incharge', $_SESSION['emp_id']);
    //
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_adjusted_nav_total_sales_data_model($staff_id,$sales_date,$store_no,$dcode,$pos_terminal_no)
  {
    $this->db->select('sum(amount_tendered) as total_sales');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_nav_total_partial_cash_data_model($sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_partial_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', 9);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');


        // added
        $this->db->where('officer_incharge', $_SESSION['emp_id']);
        //

    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_nav_total_final_cash_data_model($sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_final_cash');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', array(1,50));
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');
        // added
        $this->db->where('officer_incharge', $_SESSION['emp_id']);
        //

    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_total_nav_noncash_data_model($tender_type,$sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_noncash_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', $tender_type);
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');

            // added
            $this->db->where('officer_incharge', $_SESSION['emp_id']);
            //
    $query = $this->db->get();
    return $query->row();
  }

  public function get_adjusted_nav_grand_total_sales_data_model($sales_date,$store_no,$dcode)
  {
    $this->db->select('sum(amount_tendered) as total_sales');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where_in('store_no', $store_no);
    $this->db->where('dept_code', $dcode);
    $this->db->where('status <>', 'ORIGINAL');

    // added
    $this->db->where('officer_incharge', $_SESSION['emp_id']);
    //

    $query = $this->db->get();
    return $query->row();
  }

  public function get_nav_terminal_no($sales_date,$staff_id)
  {
    $this->db->select('pos_terminal_no');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->group_by('pos_terminal_no');
    $this->db->order_by('pos_terminal_no', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_noncash_tender_type_model_v2($sales_date,$staff_id,$pos_terminal_no)
  {
    $this->db->select('tender_type, store_no, bu_code, dept_code');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->group_by('tender_type');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_tender_name_model($tender_type,$bcode)
  {
    $this->db->where('mop_code', $tender_type);
    $this->db->where('bcode', $bcode);
    $this->db->limit(1);
    $query = $this->db->get('cs_bu_mode_of_payment');
    return $query->row();
  }

  public function get_tender_type_amount_model_v3($sales_date,$store_no,$staff_id,$tender_type,$pos_terminal_no)
  {
    $this->db->select('sum(amount_tendered) as type_amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where('tender_type', $tender_type);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_incharge_data_model($emp_id)
  {
    $this->db2->select('name');
    $this->db2->from('employee3');
    $this->db2->where('emp_id', $emp_id);
    $query = $this->db2->get();
    return $query->row();
  }

  public function validate_mop_adjustment_model_v2($origin_code,$transfer_code,$sales_date,$staff_id,$store_no,$dcode,$pos_terminal_no)
  {
    $this->db->where('origin_code', $origin_code);
    $this->db->where('transfer_code', $transfer_code);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('dcode', $dcode);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where('status', 'PENDING');
    $query = $this->db->get('cs_nav_adjustment_history');
    return $query->result_array();
  }

  public function add_adjustment_model_v2($origin_code,$origin_name,$transfer_code,$transfer_name,$transfer_amount,$sales_date,$staff_id,$store_no,$dcode,$reason,$file,$pos_terminal_no)
  {
    $data = array(
      'origin_code'              => $this->security->xss_clean(trim($origin_code)),
      'origin_name'              => $this->security->xss_clean(trim($origin_name)),
      'transfer_code'            => $this->security->xss_clean(trim($transfer_code)),
      'transfer_name'            => $this->security->xss_clean(trim($transfer_name)),
      'transfer_amount'          => $this->security->xss_clean(trim($transfer_amount)),
      'sales_date'               => $this->security->xss_clean(trim($sales_date)),
      'reason'                   => $this->security->xss_clean(trim($reason)),
      'attached_file'            => $this->security->xss_clean(trim($file)),
      'staff_id'                 => $this->security->xss_clean(trim($staff_id)),
      'pos_terminal_no'          => $this->security->xss_clean(trim($pos_terminal_no)),
      'store_no'                 => $this->security->xss_clean(trim($store_no)),
      'dcode'                    => $this->security->xss_clean(trim($dcode)),
      'officer_incharge'         => $this->security->xss_clean(trim($_SESSION['emp_id'])),
      'status'                   => $this->security->xss_clean(trim('PENDING'))
     );
    $this->db->set('date_requested', 'NOW()', FALSE);
    $this->db->insert('cs_nav_adjustment_history', $data);
  }

  public function get_adjustment_list_model_v2($origin_code,$sales_date,$staff_id,$store_no,$pos_terminal_no)
  {
    $this->db->where('origin_code', $origin_code);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->order_by('id', 'asc');
    $query = $this->db->get('cs_nav_adjustment_history');
    return $query->result_array();
  }

  public function get_alltender_name_model($tender_type,$dcode)
  {
    $this->db->select('mop_name as name, mop_code as code');
    $this->db->from('cs_bu_mode_of_payment');
    $this->db->where('mop_name <>', $tender_type);
    $this->db->where('dcode', $dcode);
    $this->db->order_by('mop_name', 'asc');
    $this->db->group_by('mop_name');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_updated_navtextfile_model_v2($tender_type,$sales_date,$staff_id,$store_no,$pos_terminal_no)
  {
    $this->db->select('tr_no,receipt_no,card_no,card_or_account,sales_time,bu_code,dept_code');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('tender_type', $tender_type);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->group_by('tender_type');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_adjusted_navtextfile_model_v2($origin_code,$sales_date,$staff_id,$store_no,$pos_terminal_no)
  {
    $this->db->where('origin_code', $origin_code);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where('status', 'APPROVED');
    $query = $this->db->get('cs_nav_adjustment_history');
    return $query->result_array();
  }

  public function get_alltender_code_model($tender_type,$bcode)
  {
    $this->db->select('mop_code as code');
    $this->db->from('cs_bu_mode_of_payment');
    $this->db->where('mop_name', $tender_type);
    $this->db->where('bcode', $bcode);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_updated_navtextfile_model_v3($tender_type_array,$sales_date,$staff_id,$store_no,$pos_terminal_no)
  {
    $this->db->select('tr_no,receipt_no,card_no,card_or_account,sales_time,bu_code,dept_code');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where_in('tender_type', $tender_type_array);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->group_by('tender_type');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_amount_transfer_tender_model_v2($tender_array,$sales_date,$staff_id,$store_no,$pos_terminal_no)
  {
    $this->db->select('sum(amount_tendered) as amount');
    $this->db->from('cs_nav_txtfile_uploaded');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where('status <>', 'ADJUSTED');
    $this->db->where_in('tender_type', $tender_array);
    $query = $this->db->get();
    return $query->row();
  }

  public function update_navtextfile_upload_model_v2($tender_array,$sales_date,$staff_id,$store_no,$pos_terminal_no)
  {
    $this->db->set('status', 'ORIGINAL');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where('status', '');
    $this->db->where_in('tender_type', $tender_array);
    $this->db->update('cs_nav_txtfile_uploaded');
  }

  public function update_nav_adjustment_model_v2($origin_code,$sales_date,$staff_id,$store_no,$pos_terminal_no)
  {
    $this->db->set('status', 'ADJUSTED');
    $this->db->set('date_adjusted', 'NOW()', FALSE);
    $this->db->where('origin_code', $origin_code);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where('status', 'APPROVED');
    $this->db->update('cs_nav_adjustment_history');
  }

  public function validate_mop_transfer_model_v2($sales_date,$staff_id,$store_no,$origin_name,$transfer_name,$pos_terminal_no)
  {
    $this->db->select('status');
    $this->db->from('cs_nav_adjustment_history');
    $this->db->where('sales_date', $sales_date);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('transfer_name', $origin_name);
    $this->db->where('origin_name', $transfer_name);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $query = $this->db->get();
    return $query->row()->status;
  }

  public function get_duplicate_textfile_model_v2($staff_id,$sales_date,$store_no,$pos_terminal_no)
  {
    $this->db->where('staff_id', $staff_id);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('store_no', $store_no);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->limit(1);
    $query = $this->db->get('cs_nav_txtfile_uploaded');
    return $query->row();
  }

  public function get_dcode_model_v2($bcode,$dname)
  {
    $this->db2->where_in('dept_name', $dname);
    $this->db2->where('concat(company_code,bunit_code)', $bcode);
    $query = $this->db2->get('locate_department');
    return $query->row();
  }

  public function get_duplicate_textfile_model_v3($tr_no,$receipt_no,$card_no,$tender_type,$amount_tendered,$card_or_account,$sales_date,$sales_time,$staff_id,$store_no,$pos_terminal_no,$bu_code,$dept_code)
  {
    $this->db->where('tr_no', $tr_no);
    $this->db->where('receipt_no', $receipt_no);
    $this->db->where('card_no', $card_no);
    $this->db->where('tender_type', $tender_type);
    $this->db->where('amount_tendered', $amount_tendered);
    $this->db->where('card_or_account', $card_or_account);
    $this->db->where('sales_date', $sales_date);
    $this->db->where('sales_time', $sales_time);
    $this->db->where('staff_id', $staff_id);
    $this->db->where('store_no', $store_no);
    $this->db->where('pos_terminal_no', $pos_terminal_no);
    $this->db->where('bu_code', $bu_code);
    $this->db->where('dept_code', $dept_code);
    $this->db->limit(1);
    $query = $this->db->get('cs_nav_txtfile_uploaded');
    return $query->row();
  }

  public function get_tender_name_model_v2($tender_type,$dcode)
  {
    $this->db->where('mop_code', $tender_type);
    $this->db->where('dcode', $dcode);
    $this->db->limit(1);
    $query = $this->db->get('cs_bu_mode_of_payment');
    return $query->row();
  }

  public function get_tender_code_model1($tender_name,$dcode)
  {
    $this->db->where('mop_name', $tender_name);
    $this->db->where('dcode', $dcode);
    // $this->db->limit(1);
    $query = $this->db->get('cs_bu_mode_of_payment');
    return $query->row();
  }

  public function get_tender_code_model($tender_name, $dcode)
{
    $this->db->select('mop_code');
    $this->db->where('mop_name', $tender_name);
    $this->db->where('dcode', $dcode);
    
    // Use result() to fetch multiple rows
    $query = $this->db->get('cs_bu_mode_of_payment');
    return $query->result();  // Return an array of results
}


  public function get_tender_code_model3($tender_name,$dcode)
  {
    $this->db->where('mop_name', $tender_name);
    $this->db->where('dcode', $dcode);
    // $this->db->limit(1);
    $query = $this->db->get('cs_bu_mode_of_payment');
    return $query->row();
  }


  public function get_tender_code_model2($tender_name, $dcode)
  {
      $this->db->where('mop_name', $tender_name);
      $this->db->where('dcode', $dcode);
      $this->db->limit(1);
      $query = $this->db->get('cs_bu_mode_of_payment');
      return $query->result_array(); 
  }

  //gi change
  // public function get_tender_code_model($tender_name, $dcode)
  // {
  //     $this->db->where('mop_name', $tender_name);
  //     $this->db->where('dcode', $dcode);
  //     $query = $this->db->get('cs_bu_mode_of_payment');
  //     return $query->result();
  // }



  // LOUEI NEW CODE


    

  // public function all_transactions($sales_date, $dname, $bname)
  // {
  //     $sql = '
  //         SELECT mop_name, mop_code, sales_date, business_unit, dept_name 
  //         FROM (
  //             SELECT non.mop_name, mop.mop_code, DATE(non.date_submit) AS sales_date, bu.business_unit, dept.dept_name 
  //             FROM cs_cashier_noncashdenomination AS non 
  //             JOIN cs_bu_mode_of_payment AS mop 
  //                 ON mop.mop_name = non.mop_name 
  //                 AND mop.dcode = CONCAT(non.company_code, non.bunit_code, non.dep_code) 
  //                 AND mop.bcode = CONCAT(non.company_code, non.bunit_code) 
  //             JOIN pis.locate_department AS dept 
  //                 ON dept.dcode = mop.dcode 
  //                 AND dept.dcode = CONCAT(non.company_code, non.bunit_code, non.dep_code) 
  //             JOIN pis.locate_business_unit AS bu 
  //                 ON bu.bcode = mop.bcode 
  //             WHERE non.delete_status <> "DELETED" 
  //                 AND DATE(non.date_submit) = ? 
  //                 AND dept.dept_name = ? 
  //                 AND bu.business_unit = ? 
  //                 AND mop.mop_code NOT IN (50) 
  //                 AND mop.status != "NOT APPLICABLE" 
  //             GROUP BY mop_code
              
  //             UNION ALL
              
  //             SELECT mop.mop_name, nav.tender_type AS mop_code, nav.sales_date, bu.business_unit, dept.dept_name 
  //             FROM cs_nav_txtfile_uploaded AS nav 
  //             JOIN cs_bu_mode_of_payment AS mop 
  //                 ON mop.mop_code = nav.tender_type 
  //                 AND mop.dcode = nav.dept_code 
  //                 AND mop.bcode = nav.bu_code 
  //             JOIN pis.locate_department AS dept 
  //                 ON dept.dcode = nav.dept_code 
  //             JOIN pis.locate_business_unit AS bu 
  //                 ON bu.bcode = nav.bu_code 
  //             WHERE DATE(nav.sales_date) = ? 
  //                 AND dept.dept_name = ? 
  //                 AND bu.business_unit = ? 
  //                 AND nav.tender_type NOT IN (50) 
  //                 AND mop.status != "NOT APPLICABLE" 
  //                 AND nav.status <> "ADJUSTED" 
  //             GROUP BY nav.tender_type
  //         ) AS combined_results
  //         WHERE mop_name IS NULL OR (mop_name IS NOT NULL AND mop_code IN (
  //             SELECT DISTINCT tender_type 
  //             FROM cs_nav_txtfile_uploaded 
  //             WHERE DATE(sales_date) = ?
  //         ))
  //         GROUP BY mop_code
  //         ORDER BY mop_name';
      
  //     $query = $this->db->query($sql, array($sales_date, $dname, $bname, $sales_date, $dname, $bname, $sales_date));
  //     return $query->result_array();
  // }

  public function all_transactions($sales_date, $dname, $bname)
  {
      $sql = '
          SELECT mop_name, GROUP_CONCAT(DISTINCT mop_code ORDER BY mop_code SEPARATOR "|") AS mop_code, sales_date, business_unit, dept_name 
          FROM (
              SELECT non.mop_name, mop.mop_code, DATE(non.date_submit) AS sales_date, bu.business_unit, dept.dept_name 
              FROM cs_cashier_noncashdenomination AS non 
              JOIN cs_bu_mode_of_payment AS mop 
                  ON mop.mop_name = non.mop_name 
                  AND mop.dcode = CONCAT(non.company_code, non.bunit_code, non.dep_code) 
                  AND mop.bcode = CONCAT(non.company_code, non.bunit_code) 
              JOIN pis.locate_department AS dept 
                  ON dept.dcode = mop.dcode 
                  AND dept.dcode = CONCAT(non.company_code, non.bunit_code, non.dep_code) 
              JOIN pis.locate_business_unit AS bu 
                  ON bu.bcode = mop.bcode 
              WHERE non.delete_status <> "DELETED" 
                  AND DATE(non.date_submit) = ? 
                  AND dept.dept_name = ? 
                  AND bu.business_unit = ? 
                  AND mop.mop_code NOT IN (50) 
                  AND mop.status != "NOT APPLICABLE"

              UNION ALL
              
              SELECT mop.mop_name, nav.tender_type AS mop_code, nav.sales_date, bu.business_unit, dept.dept_name 
              FROM cs_nav_txtfile_uploaded AS nav 
              JOIN cs_bu_mode_of_payment AS mop 
                  ON mop.mop_code = nav.tender_type 
                  AND mop.dcode = nav.dept_code 
                  AND mop.bcode = nav.bu_code 
              JOIN pis.locate_department AS dept 
                  ON dept.dcode = nav.dept_code 
              JOIN pis.locate_business_unit AS bu 
                  ON bu.bcode = nav.bu_code 
              WHERE DATE(nav.sales_date) = ? 
                  AND dept.dept_name = ? 
                  AND bu.business_unit = ? 
                  AND nav.tender_type NOT IN (50) 
                  AND mop.status != "NOT APPLICABLE" 
                  AND nav.status <> "ADJUSTED"

          ) AS combined_results
            WHERE mop_name IS NULL OR (mop_name IS NOT NULL AND mop_code IN (
            SELECT DISTINCT tender_type 
            FROM cs_nav_txtfile_uploaded 
            WHERE DATE(sales_date) = ?
           ))
          GROUP BY mop_code
          ORDER BY mop_code';
      
      $query = $this->db->query($sql, array($sales_date, $dname, $bname, $sales_date, $dname, $bname, $sales_date));
      return $query->result_array();
  }

  
}
