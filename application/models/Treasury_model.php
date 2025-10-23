<?php

class Treasury_model extends CI_Model
{

  public function __construct()
  {
    $this->load->database();
    $this->db2 = $this->load->database('pis', TRUE);
  }

  public function get_bunit_name_model()
  {
    $query=$this->db2->query("
                            SELECT 
                                    * 
                              FROM 
                                   locate_business_unit
                              ORDER BY business_unit ASC
                            ");

     return $query->result_array();
  }

  public function get_bunit_code_model($bname)
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

  public function get_dept_name_model($bcode)
  {
    $query=$this->db2->query("
                            SELECT 
                                    * 
                              FROM 
                                   locate_department
                              WHERE concat(company_code,bunit_code) = '".$bcode."'
                              ORDER BY dept_name ASC
                            ");

     return $query->result_array();
  }

  public function get_dept_code_model($bcode,$dept_name)
  {
    $query=$this->db2->query("
                            SELECT 
                                    * 
                              FROM 
                                   locate_department
                              WHERE concat(company_code,bunit_code) = '".$bcode."' and dept_name = '".$dept_name."'
                            ");

    return $query->result_array();
  }

  public function get_banks_name_model()
  {
    $query=$this->db->query("
                            SELECT 
                                    * 
                              FROM 
                                   cs_treasury_banklist
                              ORDER BY bank_name ASC
                            ");

    return $query->result_array();
  }

  public function submit_bank_tagging_model(
                                            $emp_id,
                                            $bname,
                                            $deptname,
                                            $bunit_code,
                                            $dept_code,
                                            $bankname,
                                            $acctno,
                                            $acctname)
  {
    $data = array(
                  'bunit_name'                      => $this->security->xss_clean(trim($bname)),
                  'dept_name'                       => $this->security->xss_clean(trim($deptname)),
                  'company_bunit_code'              => $this->security->xss_clean(trim($bunit_code)),
                  'dept_code'                       => $this->security->xss_clean(trim($dept_code)),
                  'bank_name'                       => $this->security->xss_clean(trim($bankname)),
                  'bank_acct_no'                    => $this->security->xss_clean(trim($acctno)),
                  'bank_acct_name'                  => $this->security->xss_clean(trim($acctname)),
                  'treasury_officer_incharge'       => $this->security->xss_clean(trim($emp_id)),
                  'status'                          => $this->security->xss_clean(trim('ORIGINAL')),
                  'edited_status'                   => $this->security->xss_clean(trim('NOT EDITED'))
                 );
    $this->db->set('date_setup', 'NOW()', FALSE);
    $this->db->insert('cs_treasury_bank_setup', $data);
  }

  public function get_setup_bank_model($emp_id)
  {
    $query=$this->db->query("
                            SELECT 
                                    * 
                              FROM 
                                   cs_treasury_bank_setup
                              WHERE treasury_officer_incharge = '".$emp_id."' and status in ('ORIGINAL','EDITED') and edited_status != 'EDITED'
                            ");

     return $query->result_array();
  }

  public function delete_banksetup_model($id)
  {

    $query=$this->db->query("
                            UPDATE 
                                   cs_treasury_bank_setup
                            SET
                                status = 'DELETED'
                            WHERE id = '".$id."'
                            ");

  }

  public function get_selected_bank_model($id)
  {
    $query=$this->db->query("
                            SELECT 
                                    * 
                              FROM 
                                   cs_treasury_bank_setup
                              WHERE id = '".$id."'
                            ");

     return $query->result_array();
  }

  public function update_bank_tagging_model($id)
  {
        $this->db->query("
                            UPDATE 
                                   cs_treasury_bank_setup
                            SET
                                edited_status = 'EDITED',
                                datetime_edited = NOW()
                                
                            WHERE id = '".$id."'
                            ");
  }

  public function save_updated_banktagging_model($emp_id,$id,$buname,$dname,$dcode,$bankname,$acctno,$acctname)
  {
    $data = array(
                  'bunit_name'                      => $this->security->xss_clean(trim($buname)),
                  'dept_name'                       => $this->security->xss_clean(trim($dname)),
                  'dept_code'                       => $this->security->xss_clean(trim($dcode)),
                  'bank_name'                       => $this->security->xss_clean(trim($bankname)),
                  'bank_acct_no'                    => $this->security->xss_clean(trim($acctno)),
                  'bank_acct_name'                  => $this->security->xss_clean(trim($acctname)),
                  'treasury_officer_incharge'       => $this->security->xss_clean(trim($emp_id)),
                  'status'                          => $this->security->xss_clean(trim('EDITED')),
                  'edited_status'                   => $this->security->xss_clean(trim('NOT EDITED')),
                  'edited_id'                       => $this->security->xss_clean(trim($id))
                 );
    $this->db->set('date_setup', 'NOW()', FALSE);
    $this->db->set('datetime_edited', 'NOW()', FALSE);
    $this->db->insert('cs_treasury_bank_setup', $data);
  }
  
}
