<?php

class Liquidation_model extends CI_Model
{

  public function __construct()
  {
  	parent::__construct();
    $this->db2 = $this->load->database('pis', TRUE);
    $this->load->database();
  }

  public function view_pendingdenomination_model($officer_acess_arr)
  {
      
     $officer_line_arr = explode("^",$officer_acess_arr);  

      $company_code      = ''; 
      $bunit_code        = ''; 
      $dept_code         = '';
      $section_code      = ''; 
      $sub_section_code  = '';  
     for($a=0;$a<count($officer_line_arr);$a++)//loop sa per line
     {
          $officer_line_per_column_arr = explode("-",$officer_line_arr[$a]);
          for($b=0;$b<count($officer_line_per_column_arr);$b++)
          {
              $company_code      .= "'".@$officer_line_per_column_arr[0]."',"; 
              $bunit_code        .= "'".@$officer_line_per_column_arr[1]."',"; 
              $dept_code         .= "'".@$officer_line_per_column_arr[2]."',";
              $section_code      .= "'".@$officer_line_per_column_arr[3]."',"; 
              $sub_section_code  .= "'".@$officer_line_per_column_arr[4]."',";
          }

     }

     $company_code       = substr($company_code ,0,-1); 
     $bunit_code         = substr($bunit_code,0,-1 );
     $dept_code          = substr($dept_code,0,-1 );
     $section_code       = substr($section_code,0,-1 ); 
     $sub_section_code   = substr($sub_section_code,0,-1 );

     $query=$this->db->query("

                                  SELECT
                                              cash.id,cash.emp_id,cash.emp_name,cash.status,cash.remit_type,cash.date_submit,locDept.dept_name

                                  FROM 
                                              cs_cashier_cashdenomination as cash
                                  INNER JOIN
                                              pis.locate_department AS locDept  on locDept.dcode = concat(cash.company_code,cash.bunit_code,cash.dep_code)

                                  WHERE
                                              cash.status in ('PENDING','CONFIRMED') and cash.company_code in ( ".$company_code.") and cash.bunit_code in  (".$bunit_code.") and cash.dep_code in   (".$dept_code.") and cash.section_code in (".$section_code.") and cash.sub_section_code in  (".$sub_section_code.")            

                                  UNION

                                  SELECT    
                                             nonc.batch_id,nonc.emp_id,nonc.emp_name,nonc.status,nonc.remit_type,nonc.date_submit,loc_Dept.dept_name
                                  
                                  FROM   
                                             cs_cashier_noncashdenomination as nonc
                                  INNER JOIN
                                             pis.locate_department AS loc_Dept   on loc_Dept.dcode = concat(nonc.company_code,nonc.bunit_code,nonc.dep_code)

                                  WHERE
                                             nonc.status = 'PENDING' and nonc.company_code in  (".$company_code.") and nonc.bunit_code in  (".$bunit_code.") and nonc.dep_code in (".$dept_code.") and nonc.section_code in (".$section_code.") and nonc.sub_section_code in (".$sub_section_code.") 
                            ");
                            
     return $query->result_array();

  }

  public function get_pisdata($emp_id)
  {
  	$query=$this->db2->query("
                            SELECT 
                                    * 
                              FROM 
                                   employee3
                              WHERE emp_id = '".$emp_id."'
                            ");

     return $query->result_array();
  }

  public function get_pisdepartment($dcode)
  {

    $query=$this->db2->query("
                            SELECT 
                                    * 
                              FROM 
                                   locate_department
                              WHERE dcode = '".$dcode."'
                            ");

     return $query->result_array();
  }

  public function get_pis_section_model($scode)
  {
    $query=$this->db2->select('*')
                     ->from('locate_section')
                     ->where('scode', $scode)
                     ->get();
    return $query->result_array();
  }

  public function get_pis_sub_section_model($sscode)
  {
    $query=$this->db2->select('*')
                     ->from('locate_sub_section')
                     ->where('sscode', $sscode)
                     ->get();
    return $query->result_array();
  }

  public function get_businessunit_model($bcode)
  {
    $query=$this->db2->query("
                            SELECT 
                                    * 
                              FROM 
                                   locate_business_unit
                              WHERE bcode = '".$bcode."'
                            ");

     return $query->result_array();
  }

  public function get_deptcode_model($bcode,$deptname)
  {
    $query=$this->db2->query("
                            SELECT 
                                    * 
                              FROM 
                                   locate_department
                              WHERE concat(company_code,bunit_code) = '".$bcode."' and dept_name = '".$deptname."'
                            ");

     return $query->result_array();
  }

  public function get_deptamount_model($dcode,$date)
  {
    $query=$this->db->query("
                            SELECT 
                                    sum(total_denomination) as total
                              FROM 
                                    cebo_cs_denomination
                              WHERE concat(company_code,bunit_code,dept_code) = '".$dcode."' and date_shrt = '".$date."'
                            ");

     return $query->result_array();
  }

  public function get_bunitcode_model($bname)
  {
    $query=$this->db2->query("
                            SELECT 
                                    * 
                              FROM 
                                   locate_business_unit
                              WHERE business_unit = '".$bname."'
                            ");

     return $query->result_array();
  }

  public function get_pendingdenomination_model($emp_id)
  {
  	 $query=$this->db->query("
                            SELECT 
                                    * 
                              FROM 
                                   cs_cashier_cashdenomination
                              WHERE emp_id = '".$emp_id."' and status in ('PENDING','CONFIRMED')
                            ");
  	 return $query->result_array();
  }

  public function get_pendingdenomination_model_v3($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  { 
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where_in('status', array('PENDING','CHECKED','CONFIRMED'));
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function validate_cash_pending_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  { 
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where('status', 'PENDING');
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function validate_noncash_pending_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  { 
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where('status', 'PENDING');
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function get_pendingdenomination_model_v4($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  { 
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where('status', 'PENDING');
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function displayhistory_noncashform_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('cfs_noncashtype', '');
    $this->db->where('cfs_bankname', '');
    $this->db->where('cfs_cheqno', '');
    $this->db->where('status', 'PENDING');
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->order_by('mop_name', 'asc');
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function validate_addmop_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('cfs_noncashtype', '');
    $this->db->where('cfs_bankname', '');
    $this->db->where('cfs_cheqno', '');
    $this->db->where('edit_denomination', 'ENABLED');
    $this->db->where('status', 'PENDING');
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function confirm_pcpmodal_model($emp_id)
  {
       $this->db->query(" 

            UPDATE cs_cashier_cashdenomination
            
            SET status = 'CONFIRMED'

            WHERE emp_id = '".$emp_id."' and status = 'PENDING'
            
         ");   
  }

  public function confirm_pcpmodal_model_v2($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->set('status', 'CONFIRMED');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('status', 'PENDING');
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->update('cs_cashier_cashdenomination');
  }

  public function confirm_final_cash_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->set('status', 'CHECKED');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('status', 'PENDING');
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->update('cs_cashier_cashdenomination');
  }

  public function confirm_final_noncash_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->set('status', 'CHECKED');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('status', 'PENDING');
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->update('cs_cashier_noncashdenomination');
  }

  public function edit_remittance_type_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->set('edit_remittance_type', 'ENABLED');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('status', 'PENDING');
    $this->db->update('cs_cashier_cashdenomination');
  }

  public function getfinalcash_pmodal_model($emp_id)
  {
    $query=$this->db->query("select * from cs_cashier_cashdenomination where emp_id = '".$emp_id."' and remit_type = 'FINAL' and status = 'PENDING'");

    return $query->result_array();
  }

  public function getfinalcash_pmodal_model_v2($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->select('total_cash as final_cash, concat(company_code,bunit_code,dep_code) as dcode');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('remit_type', 'FINAL');
    $this->db->where('status', 'CHECKED');
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get();
    return $query->row();
  }

  public function getnoncash_pmodal_model($emp_id)
  {
    $query=$this->db->query("select * from cs_cashier_noncashdenomination where emp_id = '".$emp_id."' and status = 'PENDING'");

    return $query->result_array();
  }

  public function getnoncash_pending_total_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->select('sum(noncash_amount) as total_noncash_amount');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('cfs_noncashtype', '');
    $this->db->where('cfs_bankname', '');
    $this->db->where('cfs_cheqno', '');
    $this->db->where('status', 'PENDING');
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get();
    return $query->row();
  }

  public function getnoncash_pmodal_model_v2($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->select('sum(noncash_amount) as total_noncash_amount, concat(company_code,bunit_code,dep_code) as dcode');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('cfs_noncashtype', '');
    $this->db->where('cfs_bankname', '');
    $this->db->where('cfs_cheqno', '');
    $this->db->where('status', 'CHECKED');
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get();
    return $query->row();
  }

  public function wholesale_counter_model($dcode,$pos_name)
  {
    $this->db->where('dcode', $dcode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('counter_info', 'WHOLESALE');
    $query = $this->db->get('cs_store_pos_counter_no');
    return $query->result_array();
  }

  public function get_deptaccess($emp_id)
  {
    $query=$this->db->query("
                            SELECT 
                                    * 
                              FROM 
                                   cebo_cs_dept_access
                              WHERE emp_id = '".$emp_id."'
                            ");

     return $query->result_array();
  }

  public function get_pisdepartment_access_model($emp_id)
  {
   
    $query=$this->db->query("select a.*, b.* from cebo_cs_dept_access a INNER JOIN pis.locate_department b ON a.company_code = b.company_code and a.bunit_code = b.bunit_code and a.dept_code = b.dept_code where a.emp_id = '".$emp_id."' group by b.dept_name order by b.dept_name ASC ");

     return $query->result_array();
  }

  public function get_pisbunit_access_model($emp_id)
  {
    $query=$this->db->query("select a.*, b.* from cebo_cs_dept_access a INNER JOIN pis.locate_business_unit b ON a.company_code = b.company_code and a.bunit_code = b.bunit_code where a.emp_id = '".$emp_id."' group by b.business_unit order by b.business_unit ASC ");

     return $query->result_array();
  }

  public function get_pisdata_model($emp_id)
  {

    $query=$this->db->query("select a.*, b.* from cebo_cs_dept_access a INNER JOIN pis.employee3 b ON a.company_code = b.company_code and a.bunit_code = b.bunit_code and a.dept_code = b.dept_code and a.section_code = b.section_code and a.sub_section_code = b.sub_section_code where a.emp_id = '".$emp_id."' and b.current_status = 'active' group by b.emp_id order by b.name ASC ");

    return $query->result_array();
  }

  public function get_adjustment_trno_model()
  {
    $query=$this->db->query("
                            SELECT 
                                    * 
                              FROM 
                                   cs_liq_adjustment
                              ORDER BY id DESC
                              LIMIT 1
                            ");

     return $query->result_array();
  }

  public function submit_amount_adjustment_model(
                                                $emp_id,
                                                $tr_no,
                                                $filter_date,
                                                $bunit_name,
                                                $dept_name,
                                                $bunit_code,
                                                $dept_code,
                                                $dept_amount,
                                                $adjustment_amount,
                                                $gt_adjustment,
                                                $adjustment_reason,
                                                $date_submit)
  {
    $data = array(
                  'transaction_no'              => $this->security->xss_clean(trim($tr_no)),
                  'date_filter'                 => $this->security->xss_clean(trim($filter_date)),
                  'bunit_name'                  => $this->security->xss_clean(trim($bunit_name)),
                  'dept_name'                   => $this->security->xss_clean(trim($dept_name)),
                  'company_bunit_code'          => $this->security->xss_clean(trim($bunit_code)),
                  'dept_code'                   => $this->security->xss_clean(trim($dept_code)),
                  'old_amount'                  => $this->security->xss_clean(trim($dept_amount)),
                  'adjust_amount'               => $this->security->xss_clean(trim($adjustment_amount)),
                  'adjustment_gtotal'           => $this->security->xss_clean(trim($gt_adjustment)),
                  'adjustment_reason'           => $this->security->xss_clean(trim($adjustment_reason)),
                  'liq_officer_incharge'        => $this->security->xss_clean(trim($emp_id))/*,
                  'date_submit'                 => $this->security->xss_clean(trim($date_submit))*/
                 );

    $this->db->set('date_submit', 'NOW()', FALSE);
    $this->db->insert('cs_liq_adjustment', $data);
  }

  public function get_adjusted_data_model($emp_id)
  {
    $query=$this->db->query("
                            SELECT 
                                    * 
                              FROM 
                                   cs_liq_adjustment
                              WHERE liq_officer_incharge = '".$emp_id."'
                            ");

     return $query->result_array();
  }

  public function get_variance_model($emp_id)
  {
    $query=$this->db->query("select b.*, a.* from cebo_cs_dept_access b INNER JOIN cs_tms_notification a ON a.company_code = b.company_code and a.bunit_code = b.bunit_code and a.dept_code = b.dept_code and a.section_code = b.section_code and a.sub_sec_code = b.sub_section_code where b.emp_id = '".$emp_id."' and a.status = 'Pending' group by a.id ");

     return $query->result_array();
  }

  public function get_adjusted_model($emp_id,$dtfrom,$dtto)
  {
    $query=$this->db->query("select b.*, a.* from cebo_cs_dept_access b INNER JOIN cs_tms_notification a ON a.company_code = b.company_code and a.bunit_code = b.bunit_code and a.dept_code = b.dept_code and a.section_code = b.section_code and a.sub_sec_code = b.sub_section_code where b.emp_id = '".$emp_id."' and date(a.date_time_adjusted) >= '".$dtfrom."' and date(a.date_time_adjusted) <= '".$dtto."' and a.status = 'ADJUSTED' group by a.id ");

     return $query->result_array();
  }

  public function validate_liq_dept_access_model($dcode)
  {
    $query=$this->db->query("
                            SELECT 
                                    * 
                              FROM 
                                   cs_cfsothermop
                              WHERE dept_access = '".$dcode."'
                            ");

     return $query->result_array();
  }

  public function add_cashier_access_model($emp_id,$emp_no,$emp_pins,$dcode,$route)
  {
    $data = array(
                  'emp_id'                      => $this->security->xss_clean(trim($emp_id)),
                  'emp_no'                      => $this->security->xss_clean(trim($emp_no)),
                  'emp_pins'                    => $this->security->xss_clean(trim($emp_pins)),
                  'dcode'                       => $this->security->xss_clean(trim($dcode)),
                  'cashier_path'                => $this->security->xss_clean(trim($route))
                );

    $this->db->insert('cs_cashier_personnel', $data);
  }

  public function validate_empid_model($emp_id)
  {
    $query=$this->db->query("
                            SELECT 
                                    * 
                              FROM 
                                   cs_cashier_personnel
                              WHERE emp_id = '".$emp_id."'
                            ");

     return $query->result_array();
  }

  public function delete_cashier_access_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->delete('cs_cashier_personnel');
  }

  public function adjust_variance_model($lo_emp_id,$reason,$adjusted_amt,$id,$emp_id)
  {
     $data = array(
      'status'                        => $this->security->xss_clean(trim('ADJUSTED')),
      'reason'                        => $this->security->xss_clean(trim($reason)),
      'cls_adjusted_amt'              => $this->security->xss_clean(trim($adjusted_amt)),
      'cls_officer_incharge'          => $this->security->xss_clean(trim($lo_emp_id))
    );

    $this->db->where('id', $id);
    $this->db->where('emp_id', $emp_id);
    $this->db->set('date_time_adjusted', 'NOW()', FALSE);
    $this->db->update('cs_tms_notification', $data);
  }

  public function print_adjusted_model($id,$emp_id)
  {
    $query=$this->db->select('*')
                    ->from('cs_tms_notification')
                    ->where('id', $id)
                    ->where('emp_id', $emp_id)
                    ->where('status', 'ADJUSTED')
                    ->get();
    return $query->result_array();
  }

  public function update_printing_counter_model($id,$emp_id,$updated_counter_id)
  {
    $data = array(
      'cls_printing_counter'          => $this->security->xss_clean(trim($updated_counter_id))
    );
    
    $this->db->where('id', $id)
             ->where('emp_id', $emp_id)
             ->update('cs_tms_notification', $data);

  }

  public function get_mop_model($emp_id,$dcode)
  {
    $this->db->select('*');
    $this->db->from('cs_payment_list');
    $this->db->where('dept_code', $dcode);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_bunit_name_model($emp_id)
  {
    $query = $this->db->query("select a.*, b.* from cebo_cs_dept_access a INNER JOIN pis.locate_business_unit b ON concat(a.company_code,a.bunit_code) = b.bcode where a.emp_id = '".$emp_id."' group by b.business_unit order by b.business_unit ASC ");
    return $query->result_array();
  }

  public function display_deptname_model($emp_id,$bcode)
  {
    $this->db2->select('*');
    $this->db2->from('locate_department as a');
    $this->db2->join('ebs.cebo_cs_dept_access as b', 'a.dcode = concat(b.company_code,b.bunit_code,b.dept_code)');
    $this->db2->where('b.emp_id', $emp_id);
    $this->db2->where('concat(a.company_code,a.bunit_code)', $bcode);
    $this->db2->order_by('a.dept_name', 'asc');
    $this->db2->group_by('a.dcode');

    $query = $this->db2->get();
    return $query->result_array();
  }

  public function save_mop_access_model($id,$access)
  {
    $this->db->set('allow_access', $access);
    $this->db->where('id', $id);
    $this->db->update('cs_payment_list');
  }

  public function get_cashier_name_model($dcode)
  {
    $this->db->select('*');
    $this->db->from('cs_cashier_personnel');
    $this->db->where('dcode', $dcode);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_dept_mop_model($dcode)
  {
    $this->db->select('*');
    $this->db->from('cs_payment_list');
    $this->db->where('dept_code', $dcode);
    $this->db->where('allow_access', 'YES');

    $query = $this->db->get();
    return $query->result_array();
  }

  public function scl_get_cashier_name_model($emp_id,$dcode)
  {
    $this->db2->select('a.emp_id as empid, a.emp_no as no, a.emp_pins as pins, a.name as empname, concat(b.company_code,b.bunit_code,b.dept_code) as dcode');
    $this->db2->from('pis.employee3 as a');
    $this->db2->join('ebs.cebo_cs_dept_access as b', 'concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) = concat(b.company_code,b.bunit_code,b.dept_code,b.section_code,b.sub_section_code)');
    $this->db2->where('b.emp_id', $emp_id);
    $this->db2->where('concat(b.company_code,b.bunit_code,b.dept_code)', $dcode);
    $this->db2->where('a.current_status', 'active');
    $this->db2->group_by('a.emp_id');

    $query = $this->db2->get();
    return $query->result_array();
  }

  public function validate_emp_model($emp_id)
  {
    $this->db->select('*');
    $this->db->from('cs_cashier_personnel');
    $this->db->where('emp_id', $emp_id);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function add_login_access_model($emp_id,$emp_no,$emp_pins,$dcode,$route)
  {
    $data = array(
      'emp_id'                        => $this->security->xss_clean(trim($emp_id)),
      'emp_no'                        => $this->security->xss_clean(trim($emp_no)),
      'emp_pins'                      => $this->security->xss_clean(trim($emp_pins)),
      'dcode'                         => $this->security->xss_clean(trim($dcode)),
      'cashier_path'                  => $this->security->xss_clean(trim($route))
    );

    $this->db->set('date_added', 'NOW()', FALSE);
    $this->db->insert('cs_cashier_personnel', $data);
  }

  public function get_cashier_personnel_model($dcode)
  {
    $this->db->select('*');
    $this->db->from('cs_cashier_personnel');
    $this->db->where('dcode', $dcode);
    
    $query = $this->db->get();
    return $query->result_array();
  }

  public function delete_access_model($id,$emp_id)
  {
    $this->db->where('id', $id);
    $this->db->where('emp_id', $emp_id);
    $this->db->delete('cs_cashier_personnel');
  }

  public function set_cashier_access_model($emp_id,$dcode,$mop,$type)
  {
    $data = array(
      'emp_id'                        => $this->security->xss_clean(trim($emp_id)),
      'dcode'                        => $this->security->xss_clean(trim($dcode)),
      'mop_name'                      => $this->security->xss_clean(trim($mop)),
      'mop_type'                         => $this->security->xss_clean(trim($type))
    );

    $this->db->set('date_setup', 'NOW()', FALSE);
    $this->db->insert('cs_cashier_mop_access', $data);
  }

  public function validate_access_model($emp_id,$dcode,$mop,$type)
  {
    $this->db->select('*');
    $this->db->from('cs_cashier_mop_access');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('dcode', $dcode);
    $this->db->where('mop_name', $mop);
    $this->db->where('mop_type', $type);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cashier_default_assignment_model($emp_id,$dcode)
  {
    $this->db->select('a.emp_id as empid');
    $this->db->from('cs_cashier_mop_access as a');
    $this->db->join('cebo_cs_dept_access as b', 'a.dcode = concat(b.company_code,b.bunit_code,b.dept_code)');
    $this->db->where('b.emp_id', $emp_id);
    $this->db->where('a.dcode', $dcode);
    $this->db->group_by('a.emp_id');
    // $this->db->group_by(array('a.emp_id', 'a.mop_name', 'a.mop_type'));

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_default_assignment_model($emp_id)
  {
    $this->db->select('*');
    $this->db->from('cs_cashier_mop_access');
    $this->db->where('emp_id', $emp_id);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cda_model($emp_id)
  {
    $this->db->select('*');
    $this->db->from('cs_cashier_mop_access');
    $this->db->where('emp_id', $emp_id);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function delete_cda_modal_model($emp_id,$dcode,$mop,$type)
  {
    $this->db->where('emp_id',$emp_id);
    $this->db->where('dcode',$dcode);
    $this->db->where('mop_name',$mop);
    $this->db->where('mop_type',$type);
    
    $this->db->delete('cs_cashier_mop_access');
  }

  public function get_notif_counter_model()
  {
    $emp_id = $_SESSION['emp_id'];

    $query=$this->db->query("select b.*, a.* from cebo_cs_dept_access b INNER JOIN cs_tms_notification a ON a.company_code = b.company_code and a.bunit_code = b.bunit_code and a.dept_code = b.dept_code and a.section_code = b.section_code and a.sub_sec_code = b.sub_section_code where b.emp_id = '".$emp_id."' and a.status = 'Pending' group by a.id ");
    return $query->num_rows();
  }

  public function validate_form($dcode)
  {
    $this->db->where('dcode', $dcode);
    $query = $this->db->get('cs_cashier_form');
    return $query->row();
  }

  public function get_pendingdenomination_model_v2($emp_id)
  {
    $this->db->select('a.tr_no as tr_no, a.emp_id as cashier_id, a.company_code as ccode, a.bunit_code as bcode, a.dep_code as dcode, a.section_code as scode, a.sub_section_code as sscode, a.emp_name as cname, a.pos_name as pos_name, a.borrowed as borrowed, a.remit_type as rtype, a.status as status, date(a.date_submit) as date');
    $this->db->from('cs_cashier_cashdenomination as a');
    $this->db->join('cebo_cs_dept_access as b', 'concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code) = concat(b.company_code,b.bunit_code,b.dept_code,b.section_code,b.sub_section_code)');
    $this->db->where('b.emp_id', $emp_id);
    $this->db->where('a.status', 'PENDING');
    $this->db->where('a.delete_status <>', 'DELETED');
    $this->db->group_by('a.id');

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_noncash_pending_denomination_model($emp_id)
  {
    $this->db->select('a.tr_no as tr_no, a.emp_id as cashier_id, a.company_code as ccode, a.bunit_code as bcode, a.dep_code as dcode, a.section_code as scode, a.sub_section_code as sscode, a.emp_name as cname, a.pos_name as pos_name, a.borrowed as borrowed, a.remit_type as rtype, a.status as status, date(a.date_submit) as date');
    $this->db->from('cs_cashier_noncashdenomination as a');
    $this->db->join('cebo_cs_dept_access as b', 'concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code) = concat(b.company_code,b.bunit_code,b.dept_code,b.section_code,b.sub_section_code)');
    $this->db->where('b.emp_id', $emp_id);
    $this->db->where_in('a.status', array('PENDING','CHECKED'));
    $this->db->where('a.delete_status <>', 'DELETED');
    $this->db->order_by('a.id', 'desc');
    $this->db->group_by(array('a.tr_no','a.emp_id','concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code)','a.pos_name','a.borrowed'));
    $this->db->limit(1);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_noncash_pending_denomination_model_v2($emp_id)
  {
    $this->db->select('a.tr_no as tr_no, a.emp_id as cashier_id, a.company_code as ccode, a.bunit_code as bcode, a.dep_code as dcode, a.section_code as scode, a.sub_section_code as sscode, a.emp_name as cname, a.pos_name as pos_name, a.borrowed as borrowed, a.remit_type as rtype, a.status as status, date(a.date_submit) as date');
    $this->db->from('cs_cashier_noncashdenomination as a');
    $this->db->join('cebo_cs_dept_access as b', 'concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code) = concat(b.company_code,b.bunit_code,b.dept_code,b.section_code,b.sub_section_code)');
    $this->db->where('b.emp_id', $emp_id);
    $this->db->where_in('a.status', array('PENDING','CHECKED'));
    $this->db->where('a.delete_status <>', 'DELETED');
    $this->db->order_by('a.id', 'desc');
    $this->db->group_by(array('a.tr_no','a.emp_id','concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code)','a.pos_name','a.borrowed'));

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_confirmed_denomination_model($emp_id)
  {
    $this->db->select('a.tr_no as tr_no, a.emp_id as cashier_id, a.company_code as ccode, a.bunit_code as bcode, a.dep_code as dcode, a.section_code as scode, a.sub_section_code as sscode, a.emp_name as cname, a.pos_name as pos_name, a.borrowed as borrowed, a.remit_type as rtype, a.status as status, date(a.date_submit) as date');
    $this->db->from('cs_cashier_cashdenomination as a');
    $this->db->join('cebo_cs_dept_access as b', 'concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code) = concat(b.company_code,b.bunit_code,b.dept_code,b.section_code,b.sub_section_code)');
    $this->db->where('b.emp_id', $emp_id);
    $this->db->where_in('a.status', array('CONFIRMED','CHECKED'));
    $this->db->where('a.delete_status <>', 'DELETED');
    $this->db->order_by('a.id', 'desc');
    $this->db->group_by(array('a.tr_no','a.emp_id','concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code)','a.pos_name','a.borrowed'));
    $this->db->limit(1);

    $query = $this->db->get();
    return $query->result_array();
  }
  
  public function get_confirmed_denomination_model_v2($emp_id)
  {
    $this->db->select('a.tr_no as tr_no, a.emp_id as cashier_id, a.company_code as ccode, a.bunit_code as bcode, a.dep_code as dcode, a.section_code as scode, a.sub_section_code as sscode, a.emp_name as cname, a.pos_name as pos_name, a.borrowed as borrowed, a.remit_type as rtype, a.status as status, date(a.date_submit) as date');
    $this->db->from('cs_cashier_cashdenomination as a');
    $this->db->join('cebo_cs_dept_access as b', 'concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code) = concat(b.company_code,b.bunit_code,b.dept_code,b.section_code,b.sub_section_code)');
    $this->db->where('b.emp_id', $emp_id);
    $this->db->where_in('a.status', array('CONFIRMED','CHECKED'));
    $this->db->where('a.delete_status <>', 'DELETED');
    $this->db->order_by('a.id', 'desc');
    $this->db->group_by(array('a.tr_no','a.emp_id','concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code)','a.pos_name','a.borrowed'));

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_pisdepartment_v2($dcode)
  {
    $this->db2->where('dcode', $dcode);
    $query = $this->db2->get('locate_department');
    return $query->row();
  }

  public function get_pisbunit_v2($bcode)
  {
    $this->db2->where('bcode', $bcode);
    $query = $this->db2->get('locate_business_unit');
    return $query->row();
  }

  public function get_section_v2($scode)
  {
    $this->db2->where('scode', $scode);
    $query = $this->db2->get('locate_section');
    return $query->row();
  }

  public function get_subsection_v2($sscode)
  {
    $this->db2->where('sscode', $sscode);
    $query = $this->db2->get('locate_sub_section');
    return $query->row();
  }

  public function validate_pending_model($cashier_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('emp_id', $cashier_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('status', 'PENDING');
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function validate_pending_model2($cashier_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('emp_id', $cashier_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('pos_name', $pos_name);
    $this->db->where_in('status', array('PENDING','CHECKED'));
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function validate_pending_noncash_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  { 
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where_in('status', array('PENDING','CHECKED'));
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function cancel_borrowed_cashpending_model($emp_id,$scode,$sscode)
  {
    $data = array(
      'section_code'            => $this->security->xss_clean(trim($scode)),
      'sub_section_code'        => $this->security->xss_clean(trim($sscode)),
      'borrowed'                => $this->security->xss_clean(trim('NO'))
    );

    $this->db->where('emp_id', $emp_id);
    $this->db->where_in('status', array('CONFIRMED','PENDING'));
    $this->db->update('cs_cashier_cashdenomination', $data);
  }

  public function cancel_borrowed_noncashpending_model($emp_id,$scode,$sscode)
  {
    $data = array(
      'section_code'            => $this->security->xss_clean(trim($scode)),
      'sub_section_code'        => $this->security->xss_clean(trim($sscode)),
      'borrowed'                => $this->security->xss_clean(trim('NO'))
    );

    $this->db->where('emp_id', $emp_id);
    $this->db->where_in('status', array('SAMPLE','PENDING'));
    $this->db->update('cs_cashier_noncashdenomination', $data);
  }

  public function validate_borrowed_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('status', 'PENDING');
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function validate_editnoncash_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('status', 'PENDING');
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function validate_editnoncashden_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('edit_denomination', 'ENABLED');
    $this->db->where('status', 'PENDING');
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function get_noncash_cbcheck_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('edit_denomination', 'CHECKED');
    $this->db->where('status', 'PENDING');
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function enable_cashier_edit_borrowed_model($emp_id)
  {
    $this->db->set('edit_borrowed', 'ENABLED');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('status', 'PENDING');
    $this->db->update('cs_cashier_cashdenomination');
  }

  public function enable_edit_cash_pos_model($emp_id)
  {
    $this->db->set('edit_pos', 'ENABLED');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('status', 'PENDING');
    $this->db->update('cs_cashier_cashdenomination');
  }

  public function enable_cashier_edit_noncashborrowed_model($emp_id)
  {
    $this->db->set('edit_borrowed', 'ENABLED');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('status', 'PENDING');
    $this->db->update('cs_cashier_noncashdenomination');
  }

  public function enable_edit_noncash_pos_model($emp_id)
  {
    $this->db->set('edit_pos', 'ENABLED');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('status', 'PENDING');
    $this->db->update('cs_cashier_noncashdenomination');
  }

  public function enable_add_mop_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  { 
    $this->db->set('add_mop', 'ENABLED');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('status', 'PENDING');
    $this->db->update('cs_cashier_noncashdenomination');
  }

  public function enable_cashier_edit_noncashden_model($id,$tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->set('edit_denomination', 'ENABLED');
    $this->db->where('id', $id);
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('status', 'PENDING');
    $this->db->update('cs_cashier_noncashdenomination');
  }

  public function enable_cashier_edit_noncashden_checked_model($id,$tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->set('edit_denomination', 'CHECKED');
    $this->db->where('id', $id);
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('status', 'PENDING');
    $this->db->update('cs_cashier_noncashdenomination');
  }

  public function enable_cashier_edit_den_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed,$edit_data)
  {
    $this->db->set('edit_denomination', $edit_data);
    $this->db->set('edit_status_denomination', 'ENABLED');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('status', 'PENDING');
    $this->db->update('cs_cashier_cashdenomination');
  }

  public function enable_submit_btn_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('remit_type', 'PARTIAL');
    $this->db->where('status', 'PENDING');
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function validate_confirm_code_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('status', 'CONFIRMED');
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function validate_confirm_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('remit_type', 'PARTIAL');
    $this->db->where('status', 'PENDING');
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function validate_final_cash_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('remit_type', 'FINAL');
    $this->db->where('status', 'PENDING');
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function validate_final_noncash_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('remit_type', 'FINAL');
    $this->db->where('status', 'PENDING');
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function submit_cashierden_model(
    $liq_trno,
    $cashier_id,
    $sal_no,
    $emp_name,
    $emp_type,
    $company_code,
    $bunit_code,
    $dep_code,
    $section_code,
    $sub_section_code,
    $sop_txt,
    $sop_no,
    $sales_date,
    $deduction_date,
    $vms_cutoff_date)
  {
    $balance = 0;
    if($sop_txt == 'SHORT')
    {
      $sop_txt = 'S';
      if($sop_no >= 10)
      {
        $balance = $sop_no;
      }
    }
    else if($sop_txt == 'OVER')
    {
      $sop_txt = 'O';
    }
    else 
    {
      $sop_txt = 'PF';
    }

    // $deduction_date = date('Y-m-d', strtotime($deduction_date));

    $data = array(
      'tr_no'                        => $this->security->xss_clean(trim($liq_trno)),
      'emp_id'                       => $this->security->xss_clean(trim($cashier_id)),
      'sal_no'                       => $this->security->xss_clean(trim($sal_no)),
      'emp_name'                     => $this->security->xss_clean(trim($emp_name)),
      'emp_type'                     => $this->security->xss_clean(trim($emp_type)),
      'company_code'                 => $this->security->xss_clean(trim($company_code)),
      'bunit_code'                   => $this->security->xss_clean(trim($bunit_code)),
      'dept_code'                    => $this->security->xss_clean(trim($dep_code)),
      'section_code'                 => $this->security->xss_clean(trim($section_code)),
      'sub_section_code'             => $this->security->xss_clean(trim($sub_section_code)),
      'amount_shrt'                  => $this->security->xss_clean(trim($sop_no)),
      'balance'                      => $this->security->xss_clean(trim($balance)),
      'type'                         => $this->security->xss_clean(trim($sop_txt)),
      'date_shrt'                    => $this->security->xss_clean(trim($sales_date)),
      'cut_off_date'                 => $this->security->xss_clean(trim($deduction_date)),
      'vms_cutoff_date'              => $this->security->xss_clean(trim($vms_cutoff_date)),
      'officer_id'                   => $this->security->xss_clean(trim($_SESSION['emp_id']))
    );

    $this->db->set('date_time', 'NOW()', FALSE);
    $this->db->insert('cebo_cs_data', $data);
  }

  public function submit_cashierden_model2(
    $trno,
    $cashier_id,
    $csdata_id,
    $company_code,
    $bunit_code,
    $dept_code,
    $section_code,
    $sub_section_code,
    $gtotal,
    $rsales,
    $sales_date,
    $discount,
    $tr_count
  )
  {
    $data = array(
      'tr_no'                        => $this->security->xss_clean(trim($trno)),
      'emp_id'                       => $this->security->xss_clean(trim($cashier_id)),
      'cs_data_id'                   => $this->security->xss_clean(trim($csdata_id)),
      'company_code'                 => $this->security->xss_clean(trim($company_code)),
      'bunit_code'                   => $this->security->xss_clean(trim($bunit_code)),
      'dept_code'                    => $this->security->xss_clean(trim($dept_code)),
      'section_code'                 => $this->security->xss_clean(trim($section_code)),
      'sub_sec_code'                 => $this->security->xss_clean(trim($sub_section_code)),
      'total_denomination'           => $this->security->xss_clean(trim($gtotal)),
      'registered_sales'             => $this->security->xss_clean(trim($rsales)),
      'discount'                     => $this->security->xss_clean(trim($discount)),
      'tr_count'                     => $this->security->xss_clean(trim($tr_count)),
      'date_shrt'                    => $this->security->xss_clean(trim($sales_date)),
      'officer_id'                   => $this->security->xss_clean(trim($_SESSION['emp_id']))
    );
    
    $this->db->set('date_time', 'NOW()', FALSE);
    $this->db->insert('cebo_cs_denomination', $data);
  }

  public function insert_csdata_denomination_zero_rs_model(
    $trno,
    $cashier_id,
    $csdata_id,
    $company_code,
    $bunit_code,
    $dept_code,
    $section_code,
    $sub_section_code,
    $gtotal,
    $rsales,
    $sales_date,
    $discount,
    $tr_count,
    $sup_id
  )
  {
    $data = array(
      'tr_no'                        => $this->security->xss_clean(trim($trno)),
      'emp_id'                       => $this->security->xss_clean(trim($cashier_id)),
      'cs_data_id'                   => $this->security->xss_clean(trim($csdata_id)),
      'company_code'                 => $this->security->xss_clean(trim($company_code)),
      'bunit_code'                   => $this->security->xss_clean(trim($bunit_code)),
      'dept_code'                    => $this->security->xss_clean(trim($dept_code)),
      'section_code'                 => $this->security->xss_clean(trim($section_code)),
      'sub_sec_code'                 => $this->security->xss_clean(trim($sub_section_code)),
      'total_denomination'           => $this->security->xss_clean(trim($gtotal)),
      'registered_sales'             => $this->security->xss_clean(trim($rsales)),
      'discount'                     => $this->security->xss_clean(trim($discount)),
      'tr_count'                     => $this->security->xss_clean(trim($tr_count)),
      'date_shrt'                    => $this->security->xss_clean(trim($sales_date)),
      'approved_zero_rs'             => $this->security->xss_clean(trim($sup_id)),
      'officer_id'                   => $this->security->xss_clean(trim($_SESSION['emp_id']))
    );
    
    $this->db->set('date_time', 'NOW()', FALSE);
    $this->db->insert('cebo_cs_denomination', $data);
  }

  public function get_csdata_id_model($trno)
  {
    $this->db->where('tr_no', $trno);
    $this->db->order_by('id', 'desc');
    $this->db->limit(1);
    $query = $this->db->get('cebo_cs_data');
    return $query->row();
  }

  public function update_cs_cashden_model($trno,$emp_id,$pos_name)
  {
    $this->db->set('status', 'TRANSFERRED');
    $this->db->where('tr_no', $trno);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->update('cs_cashier_cashdenomination');
  }

  public function update_cs_noncashden_model($trno,$emp_id,$pos_name)
  {
    $this->db->set('status', 'TRANSFERRED');
    $this->db->where('tr_no', $trno);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->update('cs_cashier_noncashdenomination');
  }

  public function get_cebo_cs_data_model($trno,$cashier_id)
  {
    $this->db->select('a.tr_no as trno, a.emp_id as empid, a.emp_name as cname, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dept_code) as dcode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) as sscode, a.amount_shrt as sop, a.type as sop_type, a.officer_id as lo_id, a.date_time as dt, b.total_denomination as gtotal, b.registered_sales as rsales');
    $this->db->from('cebo_cs_data as a');
    $this->db->where('a.tr_no', $trno);
    $this->db->where('a.emp_id', $cashier_id);
    $this->db->join('cebo_cs_denomination as b', 'a.tr_no = b.tr_no', 'a.emp_id = b.emp_id', 'a.id = b.cs_data_id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cebo_cs_data_model_v2($tr_no,$emp_id,$sscode,$date)
  { 
    $this->db->select('a.tr_no as trno, a.emp_id as empid, a.emp_name as cname, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dept_code) as dcode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) as sscode, a.amount_shrt as sop, a.type as sop_type, a.officer_id as lo_id, a.date_shrt, a.date_time , b.total_denomination as gtotal, b.registered_sales as rsales, b.discount, b.tr_count');
    $this->db->from('cebo_cs_data as a');
    $this->db->where('a.tr_no', $tr_no);
    $this->db->where('a.emp_id', $emp_id);
    $this->db->where('a.date_shrt', $date);
    $this->db->where('a.delete_status <>', 'deleted');
    $this->db->where('concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code)', $sscode);
    $this->db->join('cebo_cs_denomination as b', 'a.tr_no = b.tr_no', 'a.emp_id = b.emp_id', 'a.id = b.cs_data_id', 'concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) = concat(b.company_code,b.bunit_code,b.dept_code,b.section_code,b.sub_section_code)');
    $this->db->where('b.tr_no', $tr_no);
    $this->db->where('b.emp_id', $emp_id);
    $this->db->where('b.date_shrt', $date);
    $this->db->where('b.delete_status <>', 'deleted');
    $this->db->where('concat(b.company_code,b.bunit_code,b.dept_code,b.section_code,b.sub_sec_code)', $sscode);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_partial_cash_model($trno,$cashier_id)
  {
    $this->db->select('sum(total_cash) as tcash');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $trno);
    $this->db->where('emp_id', $cashier_id);
    $this->db->where('remit_type', 'PARTIAL');
    $query = $this->db->get();
    return $query->row()->tcash;
  }

  public function get_partial_cash_model_v2($tr_no,$emp_id,$sscode,$pos_name,$borrowed,$date)
  { 
    $this->db->select('sum(total_cash) as tcash');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where('date(date_submit)', $date);
    $this->db->where('remit_type', 'PARTIAL');
    $query = $this->db->get();
    return $query->row()->tcash;
  }

  public function get_final_cash_model($trno,$cashier_id)
  {
    $this->db->select('sum(total_cash) as tcash');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $trno);
    $this->db->where('emp_id', $cashier_id);
    $this->db->where('remit_type', 'FINAL');
    $query = $this->db->get();
    return $query->row()->tcash;
  }

  public function get_final_cash_model_v2($tr_no,$emp_id,$sscode,$pos_name,$borrowed,$date)
  {
    $this->db->select('sum(total_cash) as tcash');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where('date(date_submit)', $date);
    $this->db->where('remit_type', 'FINAL');
    $query = $this->db->get();
    return $query->row()->tcash;
  }

  public function get_denomination_data_model($trno,$cashier_id)
  {
    $this->db->select('sum(onek) as 1k, sum(fiveh) as 5h, sum(twoh) as 2h, sum(oneh) as 1h, sum(fifty) as 5f, sum(twenty) as 2t, sum(ten) as ten, sum(five) as five, sum(one) as one, sum(twentyfive_cents) as 25c, sum(ten_cents) as 10c, sum(five_cents) as 5c, sum(one_cents) as 1c');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $trno);
    $this->db->where('emp_id', $cashier_id);
    $this->db->where_in('remit_type', array('PARTIAL','FINAL'));
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_denomination_data_model_v2($tr_no,$emp_id,$sscode,$pos_name,$borrowed,$date)
  { 
    $this->db->select('sum(onek) as 1k, sum(fiveh) as 5h, sum(twoh) as 2h, sum(oneh) as 1h, sum(fifty) as 5f, sum(twenty) as 2t, sum(ten) as ten, sum(five) as five, sum(one) as one, sum(twentyfive_cents) as 25c, sum(ten_cents) as 10c, sum(five_cents) as 5c, sum(one_cents) as 1c, counter_no');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where('date(date_submit)', $date);
    $this->db->where('remit_type', 'FINAL');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_partial_denomination_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  { 
    $this->db->select('tr_no, emp_name, concat(company_code,bunit_code) as bcode, concat(company_code,bunit_code,dep_code) as dcode, concat(company_code,bunit_code,dep_code,section_code) as scode, onek as 1k, fiveh as 5h, twoh as 2h, oneh as 1h, fifty as 5f, twenty as 2t, total_cash, counter_no, date(date_submit) as sales_date, date_submit');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('remit_type', 'PARTIAL');
    $this->db->order_by('id', 'desc'); 
    $this->db->limit(1); 
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cashier_partial_denomination_model($id,$tr_no,$emp_id,$sscode,$pos_name,$borrowed,$date)
  { 
    $this->db->select('tr_no, emp_name, concat(company_code,bunit_code) as bcode, concat(company_code,bunit_code,dep_code) as dcode, concat(company_code,bunit_code,dep_code,section_code) as scode, onek as 1k, fiveh as 5h, twoh as 2h, oneh as 1h, fifty as 5f, twenty as 2t, total_cash, counter_no, date(date_submit) as sales_date, date_submit');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('id', $id);
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where('date(date_submit)', $date);
    $this->db->where('remit_type', 'PARTIAL');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_noncash_den_model($trno,$cashier_id)
  {
    $this->db->where('tr_no', $trno);
    $this->db->where('emp_id', $cashier_id);
    $this->db->order_by('mop_name', 'asc');
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function get_noncash_den_model_v2($tr_no,$emp_id,$sscode,$pos_name,$borrowed,$date)
  { 
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where('date(date_submit)', $date);
    $this->db->order_by('mop_name', 'asc');
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function get_total_noncash_model($trno,$cashier_id)
  {
    $this->db->select('sum(noncash_amount) as tnoncash');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('tr_no', $trno);
    $this->db->where('emp_id', $cashier_id);
    $query = $this->db->get();
    return $query->row()->tnoncash;
  }

  public function get_total_noncash_model_v2($tr_no,$emp_id,$sscode,$pos_name,$borrowed,$date)
  {
    $this->db->select('sum(noncash_amount) as tnoncash');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where('date(date_submit)', $date);
    $query = $this->db->get();
    return $query->row()->tnoncash;
  }

  public function get_transferred_data_model($date) 
  {
    $this->db->select('a.tr_no as trno, a.emp_id as cashier_id, a.emp_name as cname, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dept_code) as dcode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) as sscode, a.amount_shrt as sop, a.type as sop_type, a.date_shrt as dsales, b.total_denomination as gtotal, b.registered_sales as rsales');
    $this->db->from('cebo_cs_data as a');
    $this->db->where('a.tr_no <>', '');
    $this->db->where('a.date_shrt', $date);
    $this->db->join('cebo_cs_denomination as b', 'a.tr_no = b.tr_no', 'a.emp_id = b.emp_id', 'a.id = b.cs_data_id');
    $query = $this->db->get();
    return $query->result_array();
  }

  //gi change
  public function get_transferred_data_model_v2($emp_id,$date) 
  {
    $this->db->select('a.tr_no as trno, a.emp_id as cashier_id, a.emp_name as cname, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dept_code) as dcode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) as sscode, a.amount_shrt as sop, a.type as sop_type, a.date_shrt as dsales, b.total_denomination as gtotal, b.registered_sales as rsales, b.discount');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->join('cebo_cs_data as a', 'concat(c.company_code,c.bunit_code,c.dept_code,c.section_code,c.sub_section_code) = concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code)');
    // $this->db->join('cebo_cs_denomination as b', 'a.tr_no = b.tr_no', 'a.emp_id = b.emp_id', 'a.id = b.cs_data_id');
    $this->db->join('cebo_cs_denomination as b', 'a.tr_no = b.tr_no AND a.emp_id = b.emp_id AND a.id = b.cs_data_id');

    $this->db->where('c.emp_id', $emp_id);

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

  public function get_cutoff_model($cc,$bc)
  {
    $this->db2->where('cc', $cc);
    $this->db2->where('bc', $bc);
    $query = $this->db2->get('cut_off');
    return $query->result_array();
  }
//liq_search_emp_route
  public function get_emp_name_model($emp_name,$dcode)
  {
    $this->db2->select('emp_id,name');
    $this->db2->from('employee3');
    $this->db2->where('current_status', 'active');
    $this->db2->like('name', $emp_name);
    $this->db2->where('concat(company_code,bunit_code,dept_code)', $dcode);
    $this->db2->order_by('name', 'asc');
    $this->db2->limit(5);

    $query = $this->db2->get();
    return $query->result_array();
  }

  public function setup_counter_get_section_model($dcode)
  {
    $this->db2->select('section_name,section_code'); 
    $this->db2->from('locate_section');
    $this->db2->where('concat(company_code,bunit_code,dept_code)', $dcode);
    
    $query = $this->db2->get();
    return $query->result_array();
  }

  public function setup_counter_get_sub_section_model($scode)
  {
    $this->db2->select('sub_section_name,sub_section_code'); 
    $this->db2->from('locate_sub_section');
    $this->db2->where('concat(company_code,bunit_code,dept_code,section_code)', $scode);
    
    $query = $this->db2->get();
    return $query->result_array();
  }

  public function setup_counter_get_pos_counter_no_model($dcode)
  {
    $this->db->where('dcode', $dcode);
    $this->db->order_by('pos_name', 'asc');
    $query = $this->db->get('cs_store_pos_counter_no');
    return $query->result_array();
  }

  public function get_emp_data_model($emp_name,$dcode)
  {
    $this->db2->select('emp_id, concat(company_code,bunit_code,dept_code,section_code,sub_section_code) as sscode');
    $this->db2->from('employee3');
    $this->db2->where('current_status', 'active');
    $this->db2->where('name', $emp_name);
    $this->db2->where('concat(company_code,bunit_code,dept_code)', $dcode);
    $this->db2->limit(1);

    $query = $this->db2->get();
    return $query->row();
  }

  public function set_assigned_counter_model($emp_id,$dcode,$scode,$sscode,$pos_name,$counter_no,$borrowed)
  {
    $data = array(
      'emp_id'                       => $this->security->xss_clean(trim($emp_id)),
      'dcode'                        => $this->security->xss_clean(trim($dcode)),
      'scode'                        => $this->security->xss_clean(trim($scode)),
      'sscode'                       => $this->security->xss_clean(trim($sscode)),
      'pos_name'                     => $this->security->xss_clean(trim($pos_name)),
      'counter_no'                   => $this->security->xss_clean(trim($counter_no)),
      'borrowed'                     => $this->security->xss_clean(trim($borrowed)),
      'status'                       => $this->security->xss_clean(trim('DEFAULT')),
      'officer_incharge'             => $this->security->xss_clean(trim($_SESSION['emp_id']))
    );
    
    $this->db->set('date_setup', 'NOW()', FALSE);
    $this->db->insert('cs_cashier_assigned_counter', $data);
  }

  public function advance_set_assigned_counter_model($emp_id,$dcode,$scode,$sscode,$pos_name,$counter_no,$borrowed,$filter_date)
  {
    $data = array(
      'emp_id'                       => $this->security->xss_clean(trim($emp_id)),
      'dcode'                        => $this->security->xss_clean(trim($dcode)),
      'scode'                        => $this->security->xss_clean(trim($scode)),
      'sscode'                       => $this->security->xss_clean(trim($sscode)),
      'pos_name'                     => $this->security->xss_clean(trim($pos_name)),
      'counter_no'                   => $this->security->xss_clean(trim($counter_no)),
      'borrowed'                     => $this->security->xss_clean(trim($borrowed)),
      'status'                       => $this->security->xss_clean(trim('DEFAULT')),
      'officer_incharge'             => $this->security->xss_clean(trim($_SESSION['emp_id'])),
      'date_setup'                   => $this->security->xss_clean(trim($filter_date))
    );
    
    $this->db->insert('cs_cashier_assigned_counter', $data);
  }

  public function validate_assigned_counter_model($emp_id,$dcode,$scode,$sscode,$pos_name,$counter_no,$borrowed,$curr_date)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('dcode', $dcode);
    $this->db->where('scode', $scode);
    $this->db->where('sscode', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('counter_no', $counter_no);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('date_setup', $curr_date);
    $query = $this->db->get('cs_cashier_assigned_counter');
    return $query->result_array();
  }

  public function update_default_counter_model($emp_id,$dcode,$curr_date)
  {
    $this->db->set('status', '');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('dcode', $dcode);
    $this->db->where('date_setup', $curr_date);
    $this->db->update('cs_cashier_assigned_counter');
  }

  public function update_advance_default_counter_model($emp_id,$dcode,$date_setup)
  {
    $this->db->set('status', '');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('dcode', $dcode);
    $this->db->where('date_setup', $date_setup);
    $this->db->update('cs_cashier_assigned_counter');
  }

  public function update_default_counter_model2($id,$emp_id,$dcode,$curr_date)
  {
    $this->db->set('status', 'DEFAULT');
    $this->db->where('id', $id);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('dcode', $dcode);
    $this->db->where('date_setup', $curr_date);
    $this->db->update('cs_cashier_assigned_counter');
  }

  public function update_advance_default_counter_model2($id,$emp_id,$dcode,$date_setup)
  {
    $this->db->set('status', 'DEFAULT');
    $this->db->where('id', $id);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('dcode', $dcode);
    $this->db->where('date_setup', $date_setup);
    $this->db->update('cs_cashier_assigned_counter');
  }

  public function cashier_assigned_counter_model($emp_id,$curr_date)
  {
    $this->db->select('b.emp_id as emp_id, b.dcode as dcode');
    $this->db->from('cebo_cs_dept_access as a');
    $this->db->where('a.emp_id', $emp_id);
    $this->db->join('cs_cashier_assigned_counter as b', 'concat(a.company_code,a.bunit_code,a.dept_code) = b.dcode');
    $this->db->where('b.date_setup', $curr_date);
    $this->db->group_by('b.emp_id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function advance_cashier_assigned_counter_model($emp_id,$curr_date)
  {
    $this->db->select('b.emp_id as emp_id, b.dcode as dcode');
    $this->db->from('cebo_cs_dept_access as a');
    $this->db->where('a.emp_id', $emp_id);
    $this->db->join('cs_cashier_assigned_counter as b', 'concat(a.company_code,a.bunit_code,a.dept_code) = b.dcode');
    $this->db->where('b.date_setup >', $curr_date);
    $this->db->group_by('b.emp_id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function emp_data_model($emp_id)
  {
    $this->db2->where('emp_id', $emp_id);
    $query = $this->db2->get('employee3');
    return $query->row();
  }

  public function get_cashier_assigned_counter_model($emp_id,$curr_date)
  {
    $this->db->select('id,dcode,scode,sscode,pos_name,counter_no,borrowed,status');
    $this->db->from('cs_cashier_assigned_counter');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_setup', $curr_date);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_advance_cashier_assigned_counter_model($emp_id,$curr_date)
  {
    $this->db->select('id,dcode,scode,sscode,pos_name,counter_no,borrowed,status,date_setup');
    $this->db->from('cs_cashier_assigned_counter');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date_setup >', $curr_date);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_total_partial_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->select('sum(total_cash) as partial_total');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('remit_type', 'PARTIAL');
    $this->db->where('status', 'CONFIRMED');
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get();
    return $query->row();
  }

  public function getpartialhistory_cashform_model($tr_no,$emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('remit_type', 'PARTIAL');
    $this->db->where('status', 'CONFIRMED');
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function validate_submit_denomination_model($tr_no,$emp_id,$sscode,$sales_date)
  { 
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dept_code,section_code,sub_section_code)', $sscode);
    $this->db->where('delete_status <>', 'deleted'); 
    $this->db->where('date_shrt', $sales_date); 
    $query = $this->db->get('cebo_cs_data');
    return $query->result_array();
  }

  public function get_cash_denomination_data_model($tr_no,$emp_id,$sscode,$sales_date)
  {
    $this->db->select('pos_name, counter_no, borrowed');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('remit_type', 'FINAL');
    $this->db->where('status', 'TRANSFERRED');
    $this->db->where('DATE(date_submit)', $sales_date);
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cash_denomination_model($tr_no,$emp_id,$sscode,$sales_date)
  {
    $this->db->select('pos_name, counter_no, borrowed');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('remit_type', 'FINAL');
    $this->db->where('status', 'TRANSFERRED');
    $this->db->where('liq_status <>', 'TRANSFERRED');
    $this->db->where('DATE(date_submit)', $sales_date);
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cash_denomination_model_v2($tr_no,$emp_id,$sscode)
  {
    $this->db->select('pos_name, counter_no, borrowed');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('remit_type', 'FINAL');
    $this->db->where('status', 'TRANSFERRED');
    $this->db->where('liq_status <>', 'TRANSFERRED');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cash_zero_rs_model($tr_no,$emp_id,$sscode)
  {
    $this->db->select('pos_name, counter_no, borrowed');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('remit_type', 'FINAL');
    $this->db->where('status', 'TRANSFERRED');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function validate_cash_model($tr_no,$emp_id,$sscode,$sales_date)
  {
    $this->db->select('pos_name, counter_no, borrowed');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('remit_type', 'FINAL');
    $this->db->where('status', 'TRANSFERRED');
    $this->db->where('DATE(date_submit)', $sales_date);
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_noncash_denomination_model($tr_no,$emp_id,$sscode,$sales_date)
  {
    $this->db->select('pos_name, counter_no, borrowed');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('status', 'TRANSFERRED');
    $this->db->where('DATE(date_submit)', $sales_date);
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_noncash_denomination_model_v2($tr_no,$emp_id,$sscode)
  {
    $this->db->select('pos_name, counter_no, borrowed');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('status', 'TRANSFERRED');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_noncash_zero_rs_model($tr_no,$emp_id,$sscode)
  {
    $this->db->select('pos_name, counter_no, borrowed');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('status', 'TRANSFERRED');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_partial_data_model($emp_id,$filter_date)
  {
    $this->db->select('b.id, b.tr_no, b.emp_id, b.emp_name, concat(b.company_code,b.bunit_code) as bcode, concat(b.company_code,b.bunit_code,b.dep_code) as dcode, concat(b.company_code,b.bunit_code,b.dep_code,b.section_code) as scode, concat(b.company_code,b.bunit_code,b.dep_code,b.section_code,b.sub_section_code) as sscode, b.total_cash, b.pos_name, b.counter_no, b.borrowed, date(b.date_submit) as sales_date');
    $this->db->from('cebo_cs_dept_access as a');
    $this->db->where('a.emp_id', $emp_id);
    $this->db->join('cs_cashier_cashdenomination as b', 'concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) = concat(b.company_code,b.bunit_code,b.dep_code,b.section_code,b.sub_section_code)');
    $this->db->where('b.delete_status <>', 'DELETED');
    $this->db->where_in('b.remit_type', 'PARTIAL');
    $this->db->where_in('b.status', array('CONFIRMED','TRANSFERRED'));
    $this->db->where('DATE(b.date_submit)', $filter_date);
    $this->db->group_by('b.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_received_cash_model($emp_id)
  {
    $this->db->select('b.id, b.tr_no, b.emp_id, b.emp_name, concat(b.company_code,b.bunit_code) as bcode, concat(b.company_code,b.bunit_code,b.dep_code) as dcode, concat(b.company_code,b.bunit_code,b.dep_code,b.section_code) as scode, concat(b.company_code,b.bunit_code,b.dep_code,b.section_code,b.sub_section_code) as sscode, b.total_cash, b.pos_name, b.counter_no, b.borrowed, b.remit_type, date(b.date_submit) as sales_date');
    $this->db->from('cebo_cs_dept_access as a');
    $this->db->where('a.emp_id', $emp_id);
    $this->db->join('cs_cashier_cashdenomination as b', 'concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) = concat(b.company_code,b.bunit_code,b.dep_code,b.section_code,b.sub_section_code)');
    $this->db->where_in('b.status', array('CONFIRMED','TRANSFERRED'));
    $this->db->where('b.liq_status <>', 'TRANSFERRED');
    $this->db->where('b.delete_status <>', 'DELETED');
    $this->db->group_by('b.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_received_cash_model_v2($dcode)
  {
    $this->db->select('id, tr_no, emp_id, emp_name, concat(company_code,bunit_code) as bcode, concat(company_code,bunit_code,dep_code) as dcode, concat(company_code,bunit_code,dep_code,section_code) as scode, concat(company_code,bunit_code,dep_code,section_code,sub_section_code) as sscode, total_cash, pos_name, counter_no, borrowed, remit_type, date(date_submit) as sales_date');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('concat(company_code,bunit_code,dep_code)', $dcode);
    $this->db->where_in('status', array('CONFIRMED','TRANSFERRED'));
    $this->db->where('liq_status <>', 'TRANSFERRED');
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->group_by('id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_selected_cash_model($id)
  {
    $this->db->select('id, tr_no, emp_id, emp_name, concat(company_code,bunit_code) as bcode, concat(company_code,bunit_code,dep_code) as dcode, concat(company_code,bunit_code,dep_code,section_code) as scode, concat(company_code,bunit_code,dep_code,section_code,sub_section_code) as sscode, total_cash, pos_name, counter_no, borrowed, remit_type, date(date_submit) as sales_date');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where_in('id', $id);
    $this->db->where_in('status', array('CONFIRMED','TRANSFERRED'));
    $this->db->where('liq_status <>', 'TRANSFERRED');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_remitted_cash_model($id)
  {
    $this->db->select('a.emp_name, a.total_cash, a.pos_name, a.remit_type, date(a.date_submit) as sales_date, b.id as remitted_id, b.cash_id, b.tr_no, b.emp_id, b.sscode, b.date_remitted, date(b.date_remitted) as batch_date');
    $this->db->from('cs_cashier_cashdenomination as a');
    $this->db->where_in('a.id', $id);
    $this->db->where_in('a.status', array('CONFIRMED','TRANSFERRED'));
    $this->db->where('a.liq_status', 'TRANSFERRED');
    $this->db->where('a.delete_status <>', 'DELETED');
    $this->db->join('cs_liq_remitted_cash as b', 'a.id = b.cash_id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function validate_selected_cash_model($id)
  {
    $this->db->where_in('id', $id);
    $this->db->where('liq_status', 'TRANSFERRED');
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function update_selected_cash_model($id)
  {
    $this->db->set('liq_status', 'TRANSFERRED');
    $this->db->where_in('id', $id);
    $this->db->update('cs_cashier_cashdenomination');
  }

  public function get_selected_remit_cash_model($id)
  {
    $this->db->select('id, tr_no, emp_id, concat(company_code,bunit_code,dep_code,section_code,sub_section_code) as sscode');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('id', $id);
    $this->db->where_in('status', array('CONFIRMED','TRANSFERRED'));
    $this->db->where('liq_status', 'TRANSFERRED');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function validate_batch_counter_model($dcode,$date)
  {
    $this->db->where('dcode', $dcode);
    $this->db->where('batch_date', $date);
    $query = $this->db->get('cs_batch_remit_counter');
    return $query->result_array();
  }

  public function get_batch_counter_model($dcode,$date)
  {
    $this->db->where('dcode', $dcode);
    $this->db->where('batch_date', $date);
    $query = $this->db->get('cs_batch_remit_counter');
    return $query->result_array();
  }

  public function add_batch_counter_model($dcode,$date)
  {
    $data = array(
      'dcode'                        => $this->security->xss_clean(trim($dcode)),
      'batch_remit'                  => $this->security->xss_clean(trim('1')),
      'batch_date'                   => $this->security->xss_clean(trim($date))
    );
    $this->db->insert('cs_batch_remit_counter', $data);
  }

  public function save_selected_remit_cash_model($cash_id,$tr_no,$emp_id,$dcode,$sscode,$batch_remit)
  {
    $data = array(
      'cash_id'                      => $this->security->xss_clean(trim($cash_id)),
      'tr_no'                        => $this->security->xss_clean(trim($tr_no)),
      'emp_id'                       => $this->security->xss_clean(trim($emp_id)),
      'dcode'                        => $this->security->xss_clean(trim($dcode)),
      'sscode'                       => $this->security->xss_clean(trim($sscode)),
      'batch_remit'                  => $this->security->xss_clean(trim($batch_remit)),
      'liq_officer'                  => $this->security->xss_clean(trim($_SESSION['emp_id']))
    );
    
    $this->db->set('date_remitted', 'NOW()', FALSE);
    $this->db->insert('cs_liq_remitted_cash', $data);
  }

  public function update_batch_counter_model($dcode,$batch_remit,$date)
  {
    $this->db->set('batch_remit', $batch_remit);
    $this->db->where('dcode', $dcode);
    $this->db->where('batch_date', $date);
    $this->db->update('cs_batch_remit_counter');
  }

  public function get_partial_remitted_cash_model_old_code($emp_id,$date)
  {
    $this->db->select('b.tr_no, b.emp_id, b.sscode, c.total_cash');
    $this->db->from('cebo_cs_dept_access as a');
    $this->db->where('a.emp_id', $emp_id);
    $this->db->join('cs_liq_remitted_cash as b', 'concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) = b.sscode');
    $this->db->join('cs_cashier_cashdenomination as c', 'concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) = concat(c.company_code,c.bunit_code,c.dep_code,c.section_code,c.sub_section_code)', 'b.cash_id = c.id', 'b.tr_no = c.tr_no', 'b.emp_id = c.emp_id');
    $this->db->where('date(b.date_remitted)', $date);
    $this->db->where('c.liq_status', 'TRANSFERRED');
    $this->db->group_by('b.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_partial_remitted_cash_model($emp_id,$date)
  {
    $this->db->select('b.dcode, b.batch_remit, b.liq_officer, date(b.date_remitted) as sales_date, b.date_remitted as date_remitted');
    $this->db->from('cebo_cs_dept_access as a');
    $this->db->where('a.emp_id', $emp_id);
    $this->db->join('cs_liq_remitted_cash as b', 'concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) = b.sscode');
    $this->db->where('b.delete_status <>', 'DELETED');
    $this->db->where('date(b.date_remitted)', $date);
    $this->db->group_by(array('b.dcode','b.batch_remit','date(b.date_remitted)'));
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_deleted_remitted_cash_model($emp_id)
  {
    $this->db->select('b.cash_id, b.dcode, b.batch_remit, b.liq_officer, date(b.date_remitted) as sales_date, b.date_remitted as date_remitted, b.requested_delete, b.approved_delete, b.date_deleted');
    $this->db->from('cebo_cs_dept_access as a');
    $this->db->where('a.emp_id', $emp_id);
    $this->db->join('cs_liq_remitted_cash as b', 'concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) = b.sscode');
    $this->db->where('b.delete_status', 'DELETED');
    $this->db->group_by('b.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_batch_data_model($dcode,$batch_remit,$date_remitted)
  {
    $this->db->select('cash_id, tr_no, emp_id');
    $this->db->from('cs_liq_remitted_cash');
    $this->db->where('dcode', $dcode);
    $this->db->where('batch_remit', $batch_remit);
    $this->db->where('date(date_remitted)', $date_remitted);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_last_batch_model($dcode,$date)
  {
    $this->db->select('batch_remit');
    $this->db->from('cs_batch_remit_counter');
    $this->db->where('dcode', $dcode);
    $this->db->where('batch_date', $date);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_batch_total_model($batch_id)
  {
    $this->db->select('sum(total_cash) as batch_total');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where_in('id', $batch_id);
    $this->db->where_in('status', array('CONFIRMED','TRANSFERRED'));
    $this->db->where('liq_status', 'TRANSFERRED');
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_deleted_cash_amount_model($id)
  {
    $this->db->select('total_cash');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_remitted_partial_denomination_model($id)
  { 
    $this->db->select('a.emp_name, a.company_code, a.bunit_code, a.dep_code, a.onek as 1k, a.fiveh as 5h, a.twoh as 2h, a.oneh as 1h, a.fifty as 5f, a.twenty as 2t, a.ten, a.five, a.one, a.twentyfive_cents as 25c, a.ten_cents as 10c, a.five_cents as 5c, a.one_cents as 1c, a.total_cash, date(a.date_submit) as sales_date, b.tr_no, b.emp_id, b.batch_remit, b.liq_officer, b.date_remitted as date_remitted, b.print_counter');
    $this->db->from('cs_cashier_cashdenomination as a');
    $this->db->where_in('a.id', $id);
    $this->db->where('a.liq_status', 'TRANSFERRED');
    $this->db->where('a.delete_status <>', 'DELETED');
    $this->db->join('cs_liq_remitted_cash as b', 'a.id = b.cash_id');
    $this->db->order_by('a.emp_name', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cashier_partial_amount_model($id)
  {
    $this->db->select('sum(total_cash) as total_cash, emp_name, remit_type');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where_in('id', $id);
    $this->db->where('liq_status', 'TRANSFERRED');
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->group_by('emp_id');
    $this->db->order_by('emp_name', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_batch_amount_model($cash_id,$batch_remit)
  {
    $this->db->select('a.batch_remit, sum(b.total_cash) as total_cash');
    $this->db->from('cs_liq_remitted_cash as a');
    $this->db->where_in('a.cash_id', $cash_id);
    $this->db->where('a.batch_remit', $batch_remit);
    $this->db->where('a.delete_status <>', 'DELETED');
    $this->db->join('cs_cashier_cashdenomination as b', 'a.cash_id = b.id');
    $this->db->where('b.liq_status', 'TRANSFERRED');
    $this->db->where('b.delete_status <>', 'DELETED');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_remitted_batch_model($dcode,$date)
  {
    $this->db->select('a.tr_no, a.emp_id, a.emp_name, a.onek as 1k, a.fiveh as 5h, a.twoh as 2h, a.oneh as 1h, a.fifty as 5f, a.twenty as 2t, a.ten, a.five, a.one, a.twentyfive_cents as 25c, a.ten_cents as 10c, a.five_cents as 5c, a.one_cents as 1c, a.total_cash, a.pos_name, date(a.date_submit) as sales_date, b.cash_id, b.tr_no, b.emp_id, b.batch_remit, b.liq_officer, b.date_remitted');
    $this->db->from('cs_liq_remitted_cash as b');
    $this->db->where('b.dcode', $dcode);
    $this->db->where('b.delete_status <>', 'DELETED');
    $this->db->where('date(b.date_remitted)', $date);
    $this->db->join('cs_cashier_cashdenomination as a', 'b.cash_id = a.id');
    $this->db->where('a.delete_status <>', 'DELETED');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_wholesale_counter_model($dcode)
  {
    $this->db->select('pos_name');
    $this->db->from('cs_store_pos_counter_no');
    $this->db->where('dcode', $dcode);
    $this->db->where('wholesale_counter', 'WHOLESALE');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_snackbar_counter_model($dcode)
  {
    $this->db->select('pos_name');
    $this->db->from('cs_store_pos_counter_no');
    $this->db->where('dcode', $dcode);
    $this->db->where('wholesale_counter', 'SNACK BAR');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_noncash_data_model($dcode,$date)
  {
    $this->db->select('mop_name, sum(noncash_amount) as amount');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('concat(company_code,bunit_code,dep_code)', $dcode);
    $this->db->where('status', 'TRANSFERRED'); 
    $this->db->where('delete_status <>', 'DELETED'); 
    $this->db->where('date(date_submit)', $date);
    $this->db->group_by('mop_name');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_final_amount_model($dcode,$date)
  {
    $this->db->select('sum(a.total_denomination) as amount, b.emp_name');
    $this->db->from('cebo_cs_denomination as a');
    $this->db->where('concat(a.company_code,a.bunit_code,a.dept_code)', $dcode);
    $this->db->where('a.delete_status <>', 'deleted'); 
    $this->db->where('a.date_shrt', $date);
    $this->db->group_by('a.emp_id');
    $this->db->join('cebo_cs_data as b', 'a.cs_data_id = b.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_total_shortage_model($dcode,$date)
  {
    $this->db->select('sum(amount_shrt) as short');
    $this->db->from('cebo_cs_data');
    $this->db->where('concat(company_code,bunit_code,dept_code)', $dcode);
    $this->db->where('type', 'S'); 
    $this->db->where('delete_status <>', 'deleted'); 
    $this->db->where('date_shrt', $date);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_total_overage_model($dcode,$date)
  {
    $this->db->select('sum(amount_shrt) as over');
    $this->db->from('cebo_cs_data');
    $this->db->where('concat(company_code,bunit_code,dept_code)', $dcode);
    $this->db->where('type', 'O'); 
    $this->db->where('delete_status <>', 'deleted'); 
    $this->db->where('date_shrt', $date);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_registered_sales_model($dcode,$date)
  {
    $this->db->select('sum(total_denomination) as total_sales, sum(registered_sales) as total, sum(discount) as discount');
    $this->db->from('cebo_cs_denomination');
    $this->db->where('concat(company_code,bunit_code,dept_code)', $dcode);
    $this->db->where('delete_status <>', 'deleted'); 
    $this->db->where('date_shrt', $date);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_total_wholesale_model($tr_no,$emp_id,$dcode,$date)
  {
    $this->db->select('total_denomination');
    $this->db->from('cebo_cs_denomination');
    $this->db->where('tr_no', $tr_no); 
    $this->db->where('emp_id', $emp_id); 
    $this->db->where('concat(company_code,bunit_code,dept_code)', $dcode);
    $this->db->where('delete_status <>', 'deleted'); 
    $this->db->where('date_shrt', $date);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_deleted_denomination_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('status', 'DELETED');
    $query = $this->db->get('cs_cashier_deleted_pos_denomination');
    return $query->result_array();
  }

  public function change_sales_date_model($tr_no,$emp_id,$sscode,$pos_name,$sales_date)
  {
    // ====================================cs_cashier_cashdenomination==============================================
    $this->db->set('a.date_submit', $sales_date);
    $this->db->where('a.tr_no', $tr_no);
    $this->db->where('a.emp_id', $emp_id);
    $this->db->where('concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code)', $sscode);
    $this->db->where('a.pos_name', $pos_name);
    $this->db->where_in('a.status', array('CONFIRMED','PENDING'));
    $this->db->update('cs_cashier_cashdenomination as a');

    // ====================================cs_cashier_noncashdenomination==============================================
    $this->db->set('b.date_submit', $sales_date);
    $this->db->where('b.tr_no', $tr_no);
    $this->db->where('b.emp_id', $emp_id);
    $this->db->where('concat(b.company_code,b.bunit_code,b.dep_code,b.section_code,b.sub_section_code)', $sscode);
    $this->db->where('b.pos_name', $pos_name);
    $this->db->where_in('b.status', array('SAMPLE','PENDING'));
    $this->db->update('cs_cashier_noncashdenomination as b');
  }

  public function adjustment_pending_cash_model($emp_id) 
  {
    $this->db->select('a.id, a.tr_no as trno, a.emp_id as cashier_id, a.emp_name as cname, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dep_code) as dcode, concat(a.company_code,a.bunit_code,a.dep_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code) as sscode, a.borrowed, a.pos_name, a.counter_no, a.total_cash, a.remit_type, date(a.date_submit) as sales_date');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->where('c.emp_id', $emp_id);
    $this->db->join('cs_cashier_cashdenomination as a', 'concat(c.company_code,c.bunit_code,c.dept_code,c.section_code,c.sub_section_code) = concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code)');
    $this->db->where_in('a.status', array('CONFIRMED','PENDING','CHECKED'));
    $this->db->where('a.liq_status <>', 'TRANSFERRED');
    $this->db->where('a.delete_status <>', 'DELETED');
    $this->db->group_by('a.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function adjustment_pending_noncash_model($emp_id) 
  {
    $this->db->select('a.id, a.tr_no as trno, a.emp_id as cashier_id, a.emp_name as cname, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dep_code) as dcode, concat(a.company_code,a.bunit_code,a.dep_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code) as sscode, a.borrowed, a.pos_name, a.counter_no, a.mop_name, a.noncash_qty, a.noncash_amount, a.remit_type, date(a.date_submit) as sales_date');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->where('c.emp_id', $emp_id);
    $this->db->join('cs_cashier_noncashdenomination as a', 'concat(c.company_code,c.bunit_code,c.dept_code,c.section_code,c.sub_section_code) = concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code)');
    $this->db->where_in('a.status', array('CHECKED','PENDING'));
    $this->db->where('a.delete_status <>', 'DELETED');
    $this->db->group_by('a.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_deleted_pending_cash_model($emp_id) 
  {
    $this->db->select('a.id, a.tr_no as trno, a.emp_id as cashier_id, a.emp_name as cname, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dep_code) as dcode, concat(a.company_code,a.bunit_code,a.dep_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code) as sscode, a.borrowed, a.pos_name, a.counter_no, a.total_cash, a.remit_type, a.officer_deleted, a.date_deleted, date(a.date_submit) as sales_date');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->where('c.emp_id', $emp_id);
    $this->db->join('cs_cashier_cashdenomination as a', 'concat(c.company_code,c.bunit_code,c.dept_code,c.section_code,c.sub_section_code) = concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code)');
    $this->db->where('a.status', 'PENDING');
    $this->db->where('a.delete_status', 'DELETED');
    $this->db->group_by('a.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function delete_pending_denomination_model($id,$lo_id,$sup_id)
  {
    $this->db->set('delete_status', 'DELETED');
    $this->db->set('requested_delete', $lo_id);
    $this->db->set('approved_delete', $sup_id); 
    $this->db->set('date_deleted', 'NOW()', FALSE);
    $this->db->where('id', $id);
    $this->db->update('cs_cashier_cashdenomination');
  }

  public function delete_pending_denomination_model_v2($id,$lo_id)
  {
    $this->db->set('delete_status', 'DELETED');
    $this->db->set('officer_deleted', $lo_id);
    $this->db->set('date_deleted', 'NOW()', FALSE);
    $this->db->where('id', $id);
    $this->db->update('cs_cashier_cashdenomination');
  }

  public function delete_pending_noncash_model($id,$lo_id)
  {
    $this->db->set('delete_status', 'DELETED');
    $this->db->set('deleted_officer', $lo_id);
    $this->db->set('datetime_deleted', 'NOW()', FALSE);
    $this->db->where('id', $id);
    $this->db->update('cs_cashier_noncashdenomination');
  }

  public function validate_partial_remitted_cash_model($cash_id)
  {
    $this->db->where('id', $cash_id);
    $this->db->where('status', 'CONFIRMED');
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function validate_zero_rs_model($cs_den_id)
  {
    $this->db->where('id', $cs_den_id);
    $this->db->where('registered_sales', 0);
    $query = $this->db->get('cebo_cs_denomination');
    return $query->result_array();
  }

  public function get_final_remitted_cash_model($tr_no,$emp_id,$sscode,$pos_name,$sales_date)
  {
    $this->db->select('id');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('date(date_submit)', $sales_date);
    $this->db->where('remit_type', 'FINAL');
    $this->db->where('status', 'TRANSFERRED');
    $query = $this->db->get();
    return $query->row();
  }

  public function delete_partial_remitted_cash_model($remitted_id,$cash_id,$lo_id,$sup_id)
  {
    // ====================================cs_liq_remitted_cash===============================================
    $this->db->set('a.delete_status', 'DELETED');
    $this->db->set('a.requested_delete', $lo_id);
    $this->db->set('a.approved_delete', $sup_id); 
    $this->db->set('a.date_deleted', 'NOW()', FALSE);
    $this->db->where('a.id', $remitted_id);
    $this->db->update('cs_liq_remitted_cash as a');
    
    // ====================================cs_cashier_cashdenomination===============================================
    $this->db->set('b.delete_status', 'DELETED');
    $this->db->where('b.id', $cash_id);
    $this->db->update('cs_cashier_cashdenomination as b');
  }

  public function delete_selected_partial_and_final_remitted_cash_model($remitted_id,$cash_id,$final_id,$tr_no,$emp_id,$sscode,$pos_name,$sales_date,$lo_id,$sup_id)
  {
    // ====================================cs_liq_remitted_cash===============================================
    $this->db->set('a.delete_status', 'DELETED');
    $this->db->set('a.requested_delete', $lo_id);
    $this->db->set('a.approved_delete', $sup_id); 
    $this->db->set('a.date_deleted', 'NOW()', FALSE);
    $this->db->where('a.id', $remitted_id);
    $this->db->update('cs_liq_remitted_cash as a');

    // ====================================cs_liq_remitted_cash===============================================
    $this->db->set('g.delete_status', 'DELETED');
    $this->db->set('g.requested_delete', $lo_id);
    $this->db->set('g.approved_delete', $sup_id); 
    $this->db->set('g.date_deleted', 'NOW()', FALSE);
    $this->db->where('g.cash_id', $final_id);
    $this->db->update('cs_liq_remitted_cash as g');
    
    // ====================================cs_cashier_cashdenomination===============================================
    $this->db->set('b.delete_status', 'DELETED');
    $this->db->where('b.id', $cash_id);
    $this->db->update('cs_cashier_cashdenomination as b');

    // ====================================cs_cashier_cashdenomination===============================================
    $this->db->set('c.delete_status', 'DELETED');
    $this->db->where('c.id', $final_id);
    $this->db->update('cs_cashier_cashdenomination as c');

    // ====================================cs_cashier_cashdenomination===============================================
    $this->db->set('d.status', 'CONFIRMED');
    $this->db->where('d.id <>', $cash_id);
    $this->db->where('d.tr_no', $tr_no);
    $this->db->where('d.emp_id', $emp_id);
    $this->db->where('concat(d.company_code,d.bunit_code,d.dep_code,d.section_code,d.sub_section_code)', $sscode);
    $this->db->where('d.pos_name', $pos_name);
    $this->db->where('date(d.date_submit)', $sales_date);
    $this->db->where('d.remit_type', 'PARTIAL');
    $this->db->where('d.status', 'TRANSFERRED');
    $this->db->where('d.liq_status', 'TRANSFERRED');
    $this->db->update('cs_cashier_cashdenomination as d');

    // ====================================cs_cashier_noncashdenomination===============================================
    $this->db->set('h.delete_status', 'DELETED');
    $this->db->where('h.tr_no', $tr_no);
    $this->db->where('h.emp_id', $emp_id);
    $this->db->where('concat(h.company_code,h.bunit_code,h.dep_code,h.section_code,h.sub_section_code)', $sscode);
    $this->db->where('h.pos_name', $pos_name);
    $this->db->where('date(h.date_submit)', $sales_date);
    $this->db->where('h.status', 'TRANSFERRED');
    $this->db->update('cs_cashier_noncashdenomination as h');

    // ====================================cebo_cs_data===============================================
    $this->db->set('e.cut_off_date', '');
    $this->db->set('e.vms_cutoff_date', '');
    $this->db->set('e.delete_status', 'deleted');
    $this->db->where('e.tr_no', $tr_no);
    $this->db->where('e.emp_id', $emp_id);
    $this->db->where('concat(e.company_code,e.bunit_code,e.dept_code,e.section_code,e.sub_section_code)', $sscode);
    $this->db->where('e.date_shrt', $sales_date);
    $this->db->update('cebo_cs_data as e');

    // ====================================cebo_cs_denomination===============================================
    $this->db->set('f.delete_status', 'deleted');
    $this->db->set('f.requested_delete', $lo_id);
    $this->db->set('f.approved_delete', $sup_id); 
    $this->db->set('f.date_time_deleted', 'NOW()', FALSE);
    $this->db->where('f.tr_no', $tr_no);
    $this->db->where('f.emp_id', $emp_id);
    $this->db->where('concat(f.company_code,f.bunit_code,f.dept_code,f.section_code,f.sub_sec_code)', $sscode);
    $this->db->where('f.date_shrt', $sales_date);
    $this->db->update('cebo_cs_denomination as f');
  }

  public function delete_final_remitted_cash_model($remitted_id,$cash_id,$tr_no,$emp_id,$sscode,$pos_name,$sales_date,$lo_id,$sup_id)
  {
    // ====================================cs_liq_remitted_cash===============================================
    $this->db->set('a.delete_status', 'DELETED');
    $this->db->set('a.requested_delete', $lo_id);
    $this->db->set('a.approved_delete', $sup_id); 
    $this->db->set('a.date_deleted', 'NOW()', FALSE);
    $this->db->where('a.id', $remitted_id);
    $this->db->update('cs_liq_remitted_cash as a');
    
    // ====================================cs_cashier_cashdenomination===============================================
    $this->db->set('b.delete_status', 'DELETED');
    $this->db->where('b.id', $cash_id);
    $this->db->update('cs_cashier_cashdenomination as b');

    // ====================================cs_cashier_cashdenomination===============================================
    $this->db->set('d.status', 'CONFIRMED');
    $this->db->where('d.tr_no', $tr_no);
    $this->db->where('d.emp_id', $emp_id);
    $this->db->where('concat(d.company_code,d.bunit_code,d.dep_code,d.section_code,d.sub_section_code)', $sscode);
    $this->db->where('d.pos_name', $pos_name);
    $this->db->where('date(d.date_submit)', $sales_date);
    $this->db->where('d.remit_type', 'PARTIAL');
    $this->db->where('d.status', 'TRANSFERRED');
    $this->db->where('d.liq_status', 'TRANSFERRED');
    $this->db->update('cs_cashier_cashdenomination as d');

    // ====================================cs_cashier_noncashdenomination===============================================
    $this->db->set('c.delete_status', 'DELETED');
    $this->db->where('c.tr_no', $tr_no);
    $this->db->where('c.emp_id', $emp_id);
    $this->db->where('concat(c.company_code,c.bunit_code,c.dep_code,c.section_code,c.sub_section_code)', $sscode);
    $this->db->where('c.pos_name', $pos_name);
    $this->db->where('date(c.date_submit)', $sales_date);
    $this->db->where('c.status', 'TRANSFERRED');
    $this->db->update('cs_cashier_noncashdenomination as c');

    // ====================================cebo_cs_data===============================================
    $this->db->set('e.cut_off_date', '');
    $this->db->set('e.vms_cutoff_date', '');
    $this->db->set('e.delete_status', 'deleted');
    $this->db->where('e.tr_no', $tr_no);
    $this->db->where('e.emp_id', $emp_id);
    $this->db->where('concat(e.company_code,e.bunit_code,e.dept_code,e.section_code,e.sub_section_code)', $sscode);
    $this->db->where('e.date_shrt', $sales_date);
    $this->db->update('cebo_cs_data as e');

    // ====================================cebo_cs_denomination===============================================
    $this->db->set('f.delete_status', 'deleted');
    $this->db->set('f.requested_delete', $lo_id);
    $this->db->set('f.approved_delete', $sup_id); 
    $this->db->set('f.date_time_deleted', 'NOW()', FALSE);
    $this->db->where('f.tr_no', $tr_no);
    $this->db->where('f.emp_id', $emp_id);
    $this->db->where('concat(f.company_code,f.bunit_code,f.dept_code,f.section_code,f.sub_sec_code)', $sscode);
    $this->db->where('f.date_shrt', $sales_date);
    $this->db->update('cebo_cs_denomination as f');
  }

  public function delete_posted_denomination_model($tr_no,$emp_id,$sscode,$pos_name,$sales_date,$lo_id,$sup_id)
  {
    // ====================================cs_cashier_cashdenomination===============================================
    $this->db->set('a.delete_status', 'DELETED');
    $this->db->where('a.tr_no', $tr_no);
    $this->db->where('a.emp_id', $emp_id);
    $this->db->where('concat(a.company_code,a.bunit_code,a.dep_code,a.section_code,a.sub_section_code)', $sscode);
    $this->db->where('a.pos_name', $pos_name);
    $this->db->where('date(a.date_submit)', $sales_date);
    $this->db->where('a.status', 'TRANSFERRED');
    $this->db->where('a.liq_status <>', 'TRANSFERRED');
    $this->db->update('cs_cashier_cashdenomination as a');

    // ====================================cs_cashier_cashdenomination===============================================
    $this->db->set('e.status', 'CONFIRMED');
    $this->db->where('e.tr_no', $tr_no);
    $this->db->where('e.emp_id', $emp_id);
    $this->db->where('concat(e.company_code,e.bunit_code,e.dep_code,e.section_code,e.sub_section_code)', $sscode);
    $this->db->where('e.pos_name', $pos_name);
    $this->db->where('date(e.date_submit)', $sales_date);
    $this->db->where('e.remit_type', 'PARTIAL');
    $this->db->where('e.status', 'TRANSFERRED');
    $this->db->where('e.liq_status', 'TRANSFERRED');
    $this->db->update('cs_cashier_cashdenomination as e');

    // ====================================cs_cashier_noncashdenomination===============================================
    $this->db->set('b.delete_status', 'DELETED');
    $this->db->where('b.tr_no', $tr_no);
    $this->db->where('b.emp_id', $emp_id);
    $this->db->where('concat(b.company_code,b.bunit_code,b.dep_code,b.section_code,b.sub_section_code)', $sscode);
    $this->db->where('b.pos_name', $pos_name);
    $this->db->where('date(b.date_submit)', $sales_date);
    $this->db->where('b.status', 'TRANSFERRED');
    $this->db->update('cs_cashier_noncashdenomination as b');

    // ====================================cebo_cs_data===============================================
    $this->db->set('c.cut_off_date', '');
    $this->db->set('c.vms_cutoff_date', '');
    $this->db->set('c.delete_status', 'deleted');
    $this->db->where('c.tr_no', $tr_no);
    $this->db->where('c.emp_id', $emp_id);
    $this->db->where('concat(c.company_code,c.bunit_code,c.dept_code,c.section_code,c.sub_section_code)', $sscode);
    $this->db->where('c.date_shrt', $sales_date);
    $this->db->update('cebo_cs_data as c');

    // ====================================cebo_cs_denomination===============================================
    $this->db->set('d.delete_status', 'deleted');
    $this->db->set('d.requested_delete', $lo_id);
    $this->db->set('d.approved_delete', $sup_id); 
    $this->db->set('d.date_time_deleted', 'NOW()', FALSE);
    $this->db->where('d.tr_no', $tr_no);
    $this->db->where('d.emp_id', $emp_id);
    $this->db->where('concat(d.company_code,d.bunit_code,d.dept_code,d.section_code,d.sub_sec_code)', $sscode);
    $this->db->where('d.date_shrt', $sales_date);
    $this->db->update('cebo_cs_denomination as d');
  }

  public function update_batch_sales_date_model($tr_no,$emp_id,$batch_remit,$new_date,$curr_date,$lo_id,$sup_id)
  {
    // ====================================cs_liq_remitted_cash===============================================
    $this->db->set('a.batch_remit', $batch_remit);
    $this->db->set('a.date_remitted', $new_date);
    $this->db->where('a.tr_no', $tr_no);
    $this->db->where('a.emp_id', $emp_id);
    $this->db->where('date(a.date_remitted)', $curr_date);
    $this->db->where('a.delete_status <>', 'DELETED');
    $this->db->update('cs_liq_remitted_cash as a');

    // ====================================cebo_cs_data===============================================
    $this->db->set('b.date_shrt', $new_date);
    $this->db->where('b.tr_no', $tr_no);
    $this->db->where('b.emp_id', $emp_id);
    $this->db->where('b.date_shrt', $curr_date);
    $this->db->where('b.delete_status <>', 'deleted');
    $this->db->update('cebo_cs_data as b');

    // ====================================cebo_cs_denomination===============================================
    $this->db->set('c.date_shrt', $new_date);
    $this->db->set('c.sales_date_status', 'ADJUSTED');
    $this->db->set('c.requested_delete', $lo_id);
    $this->db->set('c.approved_delete', $sup_id);
    $this->db->set('c.date_time_deleted', 'NOW()', FALSE);
    $this->db->where('c.tr_no', $tr_no);
    $this->db->where('c.emp_id', $emp_id);
    $this->db->where('c.date_shrt', $curr_date);
    $this->db->where('c.delete_status <>', 'deleted');
    $this->db->update('cebo_cs_denomination as c');

    // ====================================cs_cashier_cashdenomination===============================================
    $this->db->set('d.date_submit', $new_date);
    $this->db->where('d.tr_no', $tr_no);
    $this->db->where('d.emp_id', $emp_id);
    $this->db->where('date(d.date_submit)', $curr_date);
    $this->db->where('d.delete_status <>', 'DELETED');
    $this->db->update('cs_cashier_cashdenomination as d');

    // ====================================cs_cashier_noncashdenomination===============================================
    $this->db->set('e.date_submit', $new_date);
    $this->db->where('e.tr_no', $tr_no);
    $this->db->where('e.emp_id', $emp_id);
    $this->db->where('date(e.date_submit)', $curr_date);
    $this->db->where('e.delete_status <>', 'DELETED');
    $this->db->update('cs_cashier_noncashdenomination as e');
  }

  public function validate_managers_key_model($username,$password)
  {
    $this->db2->select('emp_id');
    $this->db2->from('users');
    $this->db2->where('username', $username);
    $this->db2->where('password', md5($password));
    $this->db2->where('user_status', 'active');
    $query = $this->db2->get();
    return $query->row();
  }

  public function validate_subordinates_model($lo_id,$sup_id)
  {
    $this->db2->where('subordinates_rater', $lo_id);
    $this->db2->where('ratee', $sup_id);
    $query = $this->db2->get('leveling_subordinates');
    return $query->row();
  }

  public function posted_denomination_model($emp_id,$date) 
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

  public function get_deleted_posted_denomination_model($emp_id) 
  {
    $this->db->select('a.tr_no as trno, a.emp_id as cashier_id, a.emp_name as cname, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dept_code) as dcode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) as sscode, a.amount_shrt as sop, a.type as sop_type, a.date_shrt as dsales, b.total_denomination as gtotal, b.registered_sales as rsales, b.requested_delete, b.approved_delete, b.date_time_deleted');
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

  public function posted_zero_registered_sales_model($emp_id) 
  {
    $this->db->select('a.id as cs_data_id, a.tr_no as trno, a.emp_id as cashier_id, a.emp_name as cname, a.company_code, a.bunit_code, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dept_code) as dcode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) as sscode, a.amount_shrt as sop, a.type as sop_type, a.date_shrt as dsales, b.id as cs_den_id, b.total_denomination as gtotal, b.registered_sales as rsales, b.approved_zero_rs');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->where('c.emp_id', $emp_id);
    $this->db->join('cebo_cs_data as a', 'concat(c.company_code,c.bunit_code,c.dept_code,c.section_code,c.sub_section_code) = concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code)');
    $this->db->join('cebo_cs_denomination as b', 'a.tr_no = b.tr_no', 'a.emp_id = b.emp_id', 'a.id = b.cs_data_id');
    $this->db->where('a.tr_no <>', '');
    $this->db->where('a.delete_status <>', 'deleted');
    $this->db->where('b.tr_no <>', '');
    $this->db->where('b.delete_status <>', 'deleted');
    $this->db->where('b.registered_sales', 0);
    $this->db->order_by('a.date_shrt', 'asc');
    $this->db->group_by('a.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function sales_date_adjustment_table_model($emp_id,$curr_date) 
  {
    $this->db->select('a.id as cs_data_id, a.tr_no as trno, a.emp_id as cashier_id, a.emp_name as cname, a.company_code, a.bunit_code, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dept_code) as dcode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) as sscode, a.amount_shrt as sop, a.type as sop_type, a.date_shrt as dsales, b.id as cs_den_id, b.total_denomination as gtotal, b.registered_sales as rsales, b.approved_zero_rs');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->where('c.emp_id', $emp_id);
    $this->db->join('cebo_cs_data as a', 'concat(c.company_code,c.bunit_code,c.dept_code,c.section_code,c.sub_section_code) = concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code)');
    $this->db->join('cebo_cs_denomination as b', 'a.tr_no = b.tr_no', 'a.emp_id = b.emp_id', 'a.id = b.cs_data_id');
    $this->db->where('a.date_shrt', $curr_date);
    $this->db->where('a.tr_no <>', '');
    $this->db->where('a.delete_status <>', 'deleted');
    $this->db->where('b.tr_no <>', '');
    $this->db->where('b.delete_status <>', 'deleted');
    $this->db->group_by('a.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_pending_cash_data_model($dcode,$date)
  {
    $this->db->select('id as cash');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('concat(company_code,bunit_code,dep_code)', $dcode);
    $this->db->where('liq_status <>', 'TRANSFERRED');
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where('date(date_submit)', $date);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_pending_noncash_data_model($dcode,$date)
  {
    $this->db->select('id as noncash');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('concat(company_code,bunit_code,dep_code)', $dcode);
    $this->db->where_in('status', array('PENDING','CHECKED'));
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where('date(date_submit)', $date);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function adjust_zero_rs_model($cs_data_id,$cs_den_id,$tr_no,$emp_id,$registered_sales,$amount_shrt,$tr_count,$balance,$type,$cut_off_date,$vms_cutoff_date,$lo_id,$sup_id)
  {
    // var_dump($cs_data_id,$cs_den_id,$tr_no,$emp_id,$registered_sales,$amount_shrt,$balance,$type,$cut_off_date,$vms_cutoff_date,$lo_id,$sup_id);
    // ====================================update cebo_cs_data===============================================
    $this->db->set('e.amount_shrt', $amount_shrt);
    $this->db->set('e.balance', $balance);
    $this->db->set('e.type', $type);
    $this->db->set('e.cut_off_date', $cut_off_date);
    $this->db->set('e.vms_cutoff_date', $vms_cutoff_date);
    $this->db->where('e.id', $cs_data_id);
    $this->db->where('e.tr_no', $tr_no);
    $this->db->where('e.emp_id', $emp_id);
    $this->db->update('cebo_cs_data as e');

    // ====================================update cebo_cs_denomination===============================================
    $this->db->set('f.registered_sales', $registered_sales);
    $this->db->set('f.tr_count', $tr_count);
    $this->db->where('f.id', $cs_den_id);
    $this->db->where('f.tr_no', $tr_no);
    $this->db->where('f.emp_id', $emp_id);
    $this->db->update('cebo_cs_denomination as f');
  }

  public function insert_adjusted_zero_rs_model($cs_data_id,$cs_den_id,$lo_id,$sup_id)
  {
    $data = array(
      'cs_data_id'                   => $this->security->xss_clean(trim($cs_data_id)),
      'cs_den_id'                    => $this->security->xss_clean(trim($cs_den_id)),
      'lo_officer'                   => $this->security->xss_clean(trim($lo_id)),
      'sup_officer'                  => $this->security->xss_clean(trim($sup_id))
    );
    $this->db->set('date_adjusted', 'NOW()', FALSE);
    $this->db->insert('cs_adjusted_zero_rs', $data);
  }

  public function adjusted_zero_registered_sales_model($emp_id) 
  {
    $this->db->select('a.id as cs_data_id, a.tr_no as trno, a.emp_id as cashier_id, a.emp_name as cname, a.company_code, a.bunit_code, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dept_code) as dcode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) as sscode, a.amount_shrt as sop, a.type as sop_type, a.date_shrt as dsales, b.id as cs_den_id, b.total_denomination as gtotal, b.registered_sales as rsales, b.approved_zero_rs, d.lo_officer as adjusted_officer, d.sup_officer as approved_officer, d.date_adjusted');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->where('c.emp_id', $emp_id);
    $this->db->join('cebo_cs_data as a', 'concat(c.company_code,c.bunit_code,c.dept_code,c.section_code,c.sub_section_code) = concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code)');
    $this->db->join('cebo_cs_denomination as b', 'a.tr_no = b.tr_no', 'a.emp_id = b.emp_id', 'a.id = b.cs_data_id');
    $this->db->join('cs_adjusted_zero_rs as d', 'a.id = d.cs_data_id', 'b.id = d.cs_den_id');
    $this->db->where('a.tr_no <>', '');
    $this->db->where('a.delete_status <>', 'deleted');
    $this->db->where('b.tr_no <>', '');
    $this->db->where('b.delete_status <>', 'deleted');
    $this->db->group_by('a.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_adjusted_sales_date_model($emp_id) 
  {
    $this->db->select('a.id as cs_data_id, a.tr_no as trno, a.emp_id as cashier_id, a.emp_name as cname, a.company_code, a.bunit_code, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dept_code) as dcode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) as sscode, a.amount_shrt as sop, a.type as sop_type, a.date_shrt as dsales, b.id as cs_den_id, b.total_denomination as gtotal, b.registered_sales as rsales, b.requested_delete as requested, b.approved_delete as approved, b.date_time_deleted as date_time_adjusted');
    $this->db->from('cebo_cs_dept_access as c');
    $this->db->where('c.emp_id', $emp_id);
    $this->db->join('cebo_cs_data as a', 'concat(c.company_code,c.bunit_code,c.dept_code,c.section_code,c.sub_section_code) = concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code)');
    $this->db->join('cebo_cs_denomination as b', 'a.tr_no = b.tr_no', 'a.emp_id = b.emp_id', 'a.id = b.cs_data_id');
    $this->db->where('a.tr_no <>', '');
    $this->db->where('a.delete_status <>', 'deleted');
    $this->db->where('b.tr_no <>', '');
    $this->db->where('b.sales_date_status', 'ADJUSTED');
    $this->db->where('b.delete_status <>', 'deleted');
    $this->db->group_by('a.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_batch_remit_data_model($dcode,$sales_date)
  {
    $this->db->where('dcode', $dcode);
    $this->db->where('batch_date', $sales_date);
    $query = $this->db->get('cs_batch_remit_counter');
    return $query->row();
  }

  public function update_sales_date_model($tr_no,$emp_id,$sscode,$sales_date,$batch_remit,$curr_date,$lo_id,$sup_id)
  {
    // ==========================================cebo_cs_denomination====================================================
    $this->db->set('a.date_shrt', $sales_date);
    $this->db->set('a.sales_date_status', 'ADJUSTED');
    $this->db->set('a.requested_delete', $lo_id);
    $this->db->set('a.approved_delete', $sup_id);
    $this->db->set('a.date_time_deleted', 'NOW()', FALSE);
    $this->db->where('a.tr_no', $tr_no);
    $this->db->where('a.emp_id', $emp_id);
    $this->db->where('concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_sec_code)', $sscode);
    $this->db->where('a.date_shrt', $curr_date);
    $this->db->where('a.delete_status <>', 'deleted');
    $this->db->update('cebo_cs_denomination as a');

    // ==========================================cebo_cs_data====================================================
    $this->db->set('b.date_shrt', $sales_date);
    $this->db->where('b.tr_no', $tr_no);
    $this->db->where('b.emp_id', $emp_id);
    $this->db->where('concat(b.company_code,b.bunit_code,b.dept_code,b.section_code,b.sub_section_code)', $sscode);
    $this->db->where('b.date_shrt', $curr_date);
    $this->db->where('b.delete_status <>', 'deleted');
    $this->db->update('cebo_cs_data as b');

    // ==========================================cs_cashier_cashdenomination====================================================
    $this->db->set('c.date_submit', $sales_date);
    $this->db->where('c.tr_no', $tr_no);
    $this->db->where('c.emp_id', $emp_id);
    $this->db->where('concat(c.company_code,c.bunit_code,c.dep_code,c.section_code,c.sub_section_code)', $sscode);
    $this->db->where('date(c.date_submit)', $curr_date);
    $this->db->where('c.status', 'TRANSFERRED');
    $this->db->where('c.delete_status <>', 'DELETED');
    $this->db->update('cs_cashier_cashdenomination as c');

    // ==========================================cs_cashier_noncashdenomination====================================================
    $this->db->set('d.date_submit', $sales_date);
    $this->db->where('d.tr_no', $tr_no);
    $this->db->where('d.emp_id', $emp_id);
    $this->db->where('concat(d.company_code,d.bunit_code,d.dep_code,d.section_code,d.sub_section_code)', $sscode);
    $this->db->where('date(d.date_submit)', $curr_date);
    $this->db->where('d.status', 'TRANSFERRED');
    $this->db->where('d.delete_status <>', 'DELETED');
    $this->db->update('cs_cashier_noncashdenomination as d');

    // ==========================================cs_liq_remitted_cash====================================================
    $this->db->set('e.batch_remit', $batch_remit);
    $this->db->set('e.date_remitted', $sales_date);
    $this->db->where('e.tr_no', $tr_no);
    $this->db->where('e.emp_id', $emp_id);
    $this->db->where('e.sscode', $sscode);
    $this->db->where('date(e.date_remitted)', $curr_date);
    $this->db->where('e.delete_status <>', 'DELETED');
    $this->db->update('cs_liq_remitted_cash as e');
  }

  public function validate_remitted_cash_model($tr_no,$emp_id,$sscode)
  {
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('liq_status <>', 'TRANSFERRED');
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function get_last_batch_counter_model($dcode,$curr_date)
  {
    $this->db->select('batch_remit');
    $this->db->from('cs_liq_remitted_cash');
    $this->db->where('dcode', $dcode);
    $this->db->where('date(date_remitted)', $curr_date);
    $this->db->order_by('batch_remit', 'desc');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_cashier_data_model($emp_name,$dcode)
  {
    $this->db2->select('emp_id');
    $this->db2->from('employee3');
    $this->db2->where('name', $emp_name);
    $this->db2->where('concat(company_code,bunit_code,dept_code)', $dcode);
    $this->db2->limit(1);
    $query = $this->db2->get();
    return $query->row();
  }

  public function get_cashier_productivity_model($emp_id,$docde,$month,$year)
  {
    $this->db->select('sum(total_denomination) as cash_sale, sum(discount) as discount, sum(tr_count) as tr_count, date_shrt');
    $this->db->from('cebo_cs_denomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dept_code)', $docde);
    $this->db->where('month(date_shrt)', $month);
    $this->db->where('year(date_shrt)', $year);
    $this->db->where('delete_status <>', 'deleted');
    $this->db->order_by('date_shrt', 'asc');
    $this->db->group_by('date_shrt');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cashier_productivity_model_v2($emp_id,$docde,$month,$year)
  {
    $this->db->select('sum(registered_sales) as cash_sale, sum(tr_count) as tr_count, date_shrt');
    $this->db->from('cebo_cs_denomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dept_code)', $docde);
    $this->db->where('month(date_shrt)', $month);
    $this->db->where('year(date_shrt)', $year);
    $this->db->where('delete_status <>', 'deleted');
    $this->db->order_by('date_shrt', 'asc');
    $this->db->group_by('date_shrt');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function save_productivivty_model($emp_id,$dcode,$sales_date,$item_sold,$float_time,$reading_time,$no_of_hours,$hours,$minutes,$total_hours_consec,$ave_sales,$ave_tr_count,$ave_item_sold,$officer_id)
  {
    $data = array(
      'emp_id'                       => $this->security->xss_clean(trim($emp_id)),
      'dcode'                        => $this->security->xss_clean(trim($dcode)),
      'sales_date'                   => $this->security->xss_clean($sales_date),
      'item_sold'                    => $this->security->xss_clean(trim($item_sold)),
      'float_time'                   => $this->security->xss_clean(trim($float_time)),
      'reading_time'                 => $this->security->xss_clean(trim($reading_time)),
      'no_of_hours'                  => $this->security->xss_clean(trim($no_of_hours)),
      'hours'                        => $this->security->xss_clean(trim($hours)),
      'minutes'                      => $this->security->xss_clean(trim($minutes)),
      'total_hours_consec'           => $this->security->xss_clean(trim($total_hours_consec)),
      'ave_sales'                    => $this->security->xss_clean(trim($ave_sales)),
      'ave_tr_count'                 => $this->security->xss_clean(trim($ave_tr_count)),
      'ave_item_sold'                => $this->security->xss_clean(trim($ave_item_sold)),
      'officer_incharge'             => $this->security->xss_clean(trim($officer_id))
    );
    $this->db->set('date_time_saved', 'NOW()', FALSE);
    $this->db->insert('cs_cashier_productivity', $data);
  }

  public function validate_productivivty_model($emp_id,$dcode,$sales_date)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('dcode', $dcode);
    $this->db->where('sales_date', $sales_date);
    $query = $this->db->get('cs_cashier_productivity');
    return $query->row();
  }

  public function update_productivity_model($item_sold,$float_time_id,$reading_time_id,$no_of_hrs_id,$hours_id,$minute_id,$total_hrs_id,$ave_sales_hrs_id,$ave_tr_count_hrs_id,$ave_item_sold_hrs_id,$data_id,$officer_incharge)
  {
    $this->db->set('item_sold', $item_sold);
    $this->db->set('float_time', $float_time_id);
    $this->db->set('reading_time', $reading_time_id);
    $this->db->set('no_of_hours', $no_of_hrs_id);
    $this->db->set('hours', $hours_id);
    $this->db->set('minutes', $minute_id);
    $this->db->set('total_hours_consec', $total_hrs_id);
    $this->db->set('ave_sales', $ave_sales_hrs_id);
    $this->db->set('ave_tr_count', $ave_tr_count_hrs_id);
    $this->db->set('ave_item_sold', $ave_item_sold_hrs_id);
    $this->db->set('officer_incharge', $officer_incharge);
    $this->db->where('id', $data_id);
    $this->db->update('cs_cashier_productivity');
  }

  public function cashier_productivivty_model($emp_id,$dcode,$month,$year)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('dcode', $dcode);
    $this->db->where('month(sales_date)', $month);
    $this->db->where('year(sales_date)', $year);
    $this->db->order_by('sales_date', 'asc');
    $query = $this->db->get('cs_cashier_productivity');
    return $query->result_array();
  }

  public function get_cashier_sales_model($emp_id,$docde,$sales_date)
  {
    $this->db->select('sum(total_denomination) as cash_sale, sum(discount) as discount, sum(tr_count) as tr_count, date_shrt');
    $this->db->from('cebo_cs_denomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dept_code)', $docde);
    $this->db->where('date_shrt', $sales_date);
    $this->db->where('delete_status <>', 'deleted');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_cashier_sales_model_v2($emp_id,$dcode,$sales_date)
  {
    $this->db->select('sum(registered_sales) as cash_sale, sum(tr_count) as tr_count, date_shrt');
    $this->db->from('cebo_cs_denomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dept_code)', $dcode);
    $this->db->where('date_shrt', $sales_date);
    $this->db->where('delete_status <>', 'deleted');
    $query = $this->db->get();
    return $query->row();
  }

  public function all_cashier_productivivty_model($dcode,$month,$year)
  {
    $this->db->select('emp_id');
    $this->db->from('cs_cashier_productivity');
    $this->db->where('dcode', $dcode);
    $this->db->where('month(sales_date)', $month);
    $this->db->where('year(sales_date)', $year);
    $this->db->group_by('emp_id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_cashier_productivity_officer_model($dcode)
  {
    $this->db->select('emp_id, status');
    $this->db->from('cs_cashier_productivity_officer');
    $this->db->where('dcode', $dcode);
    $this->db->where_in('status', array('PREPARED', 'NOTED'));
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_mall_manager_model($bcode)
  {
    $this->db->select('emp_id');
    $this->db->from('cs_cashier_productivity_officer');
    $this->db->where('bcode', $bcode);
    $this->db->where('status', 'APPROVED');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_cashier_productivivty_model($emp_id,$dcode,$month,$year)
  {
    $this->db->select('sales_date, item_sold, hours, minutes');
    $this->db->from('cs_cashier_productivity');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('dcode', $dcode);
    $this->db->where('month(sales_date)', $month);
    $this->db->where('year(sales_date)', $year);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_productivivty_sales_model($emp_id,$dcode,$sales_date)
  {
    $this->db->select('sum(registered_sales) as total_sales');
    $this->db->from('cebo_cs_denomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dept_code)', $dcode);
    $this->db->where_in('date_shrt', $sales_date);
    $this->db->where('delete_status <>', 'deleted');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_partial_counter_model($id)
  {
    $this->db->select('print_counter');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function update_partial_counter_model($id,$counter)
  {
    $this->db->set('print_counter', $counter);
    $this->db->where('id', $id);
    $this->db->update('cs_cashier_cashdenomination');
  }

  public function get_cash_final_counter_model($tr_no,$emp_id,$pos_name,$date)
  {
    $this->db->select('print_counter');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('date(date_submit)', $date);
    $this->db->where('remit_type', 'FINAL');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_noncash_final_counter_model($tr_no,$emp_id,$pos_name,$date)
  {
    $this->db->select('print_counter');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('date(date_submit)', $date);
    $this->db->where('remit_type', 'FINAL');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->row();
  }

  public function update_cash_final_counter_model($tr_no,$emp_id,$pos_name,$date,$print_counter)
  {
    $this->db->set('print_counter', $print_counter);
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('date(date_submit)', $date);
    $this->db->where('remit_type', 'FINAL');
    $this->db->update('cs_cashier_cashdenomination');
  }

  public function update_noncash_final_counter_model($tr_no,$emp_id,$pos_name,$date,$print_counter)
  {
    $this->db->set('print_counter', $print_counter);
    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('date(date_submit)', $date);
    $this->db->where('remit_type', 'FINAL');
    $this->db->update('cs_cashier_noncashdenomination');
  }

  public function update_remitted_print_counter_model($id,$counter)
  {
    $this->db->set('print_counter', $counter);
    $this->db->where_in('cash_id', $id);
    $this->db->update('cs_liq_remitted_cash');
  }

  public function get_eod_print_counter_model($dcode,$sales_date)
  {
    $this->db->select('print_counter');
    $this->db->from('cs_batch_remit_counter');
    $this->db->where('dcode', $dcode);
    $this->db->where('batch_date', $sales_date);
    $query = $this->db->get();
    return $query->row();
  }

  public function update_eod_print_counter_model($dcode,$sales_date,$counter)
  {
    $this->db->set('print_counter', $counter);
    $this->db->where('dcode', $dcode);
    $this->db->where('batch_date', $sales_date);
    $this->db->update('cs_batch_remit_counter');
  }
}

