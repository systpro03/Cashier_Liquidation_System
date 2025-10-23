<?php  
 
 class Main_model extends CI_Model  
 {  
    public function info_mod($emp_id)
    {
      $this->db->where('app_id', $emp_id);
      $data = $this->db->get('pis.applicant');

      return $data->row();
    }

    public function access1($emp_id)
    {
      $this->db->where('emp_id', $emp_id);
      $data = $this->db->get('cs_access');
      return $data->result_array();
    }


    public function get_store($emp_id)
    {
      $this->db->where('emp_id', $emp_id);
      $data = $this->db->get('pis.employee3');
      return $data->row();
    }

    public function search_dcode($emp_id)
    {    
      $this->db->where('emp_id', $emp_id);
      $data = $this->db->get('pis.employee3');
      return $data->result_array();
    }

    public function get_dcode($id)
    {
      $this->db->select('dcode');
      $this->db->where('emp_id', $id);
      $data = $this->db->get('cs_dept_access');
      return $data->result_array();
    }


    public function emp_locate_department($dcode)
    {
      $this->db->where_in('dcode', $dcode);
      $data = $this->db->get('pis.locate_department');
      return $data->result_array();
    }

     public function deduction_data_mod($code)
    {
      $type = array('NESCO','NESCO-PTA', 'NESCO-PTP', 'NESCO Probationary', 'NESCO Regular', 'NESCO Regular Partimer', 'NESCO Partimer', 'NESCO Contractual');

      $this->db->distinct();
      $this->db->select('au.debit, au.emp_id, au.deduc_date, cd.amount_balance, cl.cs_liq_dcode, emp3.name');
      $this->db->from('cs_audit as au');
      $this->db->join('cs_acc_setup_data as cd', 'au.emp_id = cd.emp_id');
      $this->db->join('cs_liquidation_report as cl', 'cl.cs_liq_emp_id = au.emp_id');
      $this->db->join('pis.employee3 as emp3', 'emp3.emp_id = au.emp_id');
      $this->db->where('au.audit_status', 'pending'); 
      $this->db->where('cd.payment_status', 'unclosed');
      $this->db->where('cl.cs_liq_acctg_status', 'set-up');
      $this->db->where_not_in('cl.cs_liq_emp_type', $type);
      $this->db->where_in('cl.cs_liq_dcode', $code);
      $this->db->order_by('cl.cs_liq_id', 'DESC');
      $data = $this->db->get();

      return $data->result_array();
    }

    public function NESCO_deduction_data_mod($code)
    {
      $type = array('NESCO','NESCO-PTA', 'NESCO-PTP', 'NESCO Probationary', 'NESCO Regular', 'NESCO Regular Partimer', 'NESCO Partimer', 'NESCO Contractual');

      $this->db->distinct();
      $this->db->select('au.debit, au.emp_id, au.deduc_date, cd.amount_balance, cl.cs_liq_dcode, emp3.name');
      $this->db->from('cs_audit as au');
      $this->db->join('cs_acc_setup_data as cd', 'au.emp_id = cd.emp_id');
      $this->db->join('cs_liquidation_report as cl', 'cl.cs_liq_emp_id = au.emp_id');
      $this->db->join('pis.employee3 as emp3', 'emp3.emp_id = au.emp_id');
      $this->db->where('au.audit_status', 'pending'); 
      $this->db->where('cd.payment_status', 'unclosed');
      $this->db->where('cl.cs_liq_acctg_status', 'set-up');
      $this->db->where_in('cl.cs_liq_emp_type', $type);
      $this->db->where_in('cl.cs_liq_dcode', $code);
      $this->db->order_by('cl.cs_liq_id', 'DESC');
      $data = $this->db->get();

      return $data->result_array();
    }

    public function get_dept_mod($code)
    {
      $this->db->where('dcode', $code);
      $data = $this->db->get('pis.locate_department');

      return $data->row();
    }

    public function au_data_mod($emp_id)
    {
      $this->db->where('emp_id', $emp_id);
      $this->db->where('audit_status', 'pending');
      $data = $this->db->get('cs_audit');

      return $data->row();
    }

    public function insert_au_record($au_data_insert)
    {
      $this->db->insert('cs_iad_report', $au_data_insert);
    }


    public function update_cs_audit($emp_id)
    {
      $this->db->where('emp_id', $emp_id);
      $this->db->where('audit_status', 'pending');
      $this->db->set('audit_status', 'audited');
      $this->db->update('cs_audit');
    }


    public function update_cs_liq($emp_id)
    {
      $type = array('NESCO','NESCO-PTA', 'NESCO-PTP', 'NESCO Probationary', 'NESCO Regular', 'NESCO Regular Partimer', 'NESCO Partimer', 'NESCO Contractual');

      $this->db->where('cs_liq_emp_id', $emp_id);
      $this->db->where('cs_liq_acctg_status', 'set-up');
      $this->db->where('cs_liq_iad_status', 'pending');
      $this->db->where_not_in('cs_liq_emp_type', $type);
      $this->db->set('cs_liq_iad_status', 'audited');
      $this->db->set('cs_liq_iad_date', date('Y-m-d H:i:s'));
      $this->db->update('cs_liquidation_report');
    }

    public function NESCO_update_cs_liq($emp_id)
    {
      $type = array('NESCO','NESCO-PTA', 'NESCO-PTP', 'NESCO Probationary', 'NESCO Regular', 'NESCO Regular Partimer', 'NESCO Partimer', 'NESCO Contractual');

      $this->db->where('cs_liq_emp_id', $emp_id);
      $this->db->where('cs_liq_acctg_status', 'set-up');
      $this->db->where('cs_liq_iad_status', 'pending');
      $this->db->where_in('cs_liq_emp_type', $type);
      $this->db->set('cs_liq_iad_status', 'audited');
      $this->db->set('cs_liq_iad_date', date('Y-m-d H:i:s'));
      $this->db->update('cs_liquidation_report');
    }

    public function emp3_mod($emp_id)
    {
      $this->db->where('emp_id', $emp_id);
      $data = $this->db->get('pis.employee3');

      return $data->row();
    }

    public function insert_ldg_modal($data)
    {
      $this->db->insert('ebm_consolidated_ledger', $data);
    }

    public function insert_ldg_nesco($nesco_ld_data)
    {
      $this->db->insert('cs_nesco_ledger', $nesco_ld_data);
    }

    public function audited_data_mod($code)
    {
      $type = array('NESCO','NESCO-PTA', 'NESCO-PTP', 'NESCO Probationary', 'NESCO Regular', 'NESCO Regular Partimer', 'NESCO Partimer', 'NESCO Contractual');

      $this->db->select('au.au_emp_id, au.au_dcode, au.au_amount, au.au_deduc_date, emp3.name, emp3.payroll_no');
      $this->db->from('cs_iad_report as au');
      $this->db->join('pis.employee3 as emp3', 'emp3.emp_id = au.au_emp_id');
      $this->db->where_in('au.au_dcode', $code);
      $this->db->where_not_in('emp3.emp_type', $type);
      $data = $this->db->get();

      return $data->result_array();
    }

    public function NESCO_audited_data_mod($code)
    {
      $type = array('NESCO','NESCO-PTA', 'NESCO-PTP', 'NESCO Probationary', 'NESCO Regular', 'NESCO Regular Partimer', 'NESCO Partimer', 'NESCO Contractual');

      $this->db->select('au.au_emp_id, au.au_dcode, au.au_amount, au.au_deduc_date, emp3.name, emp3.payroll_no');
      $this->db->from('cs_iad_report as au');
      $this->db->join('pis.employee3 as emp3', 'emp3.emp_id = au.au_emp_id');
      $this->db->where_in('au.au_dcode', $code);
      $this->db->where_in('emp3.emp_type', $type);
      $data = $this->db->get();

      return $data->result_array();
    }

    public function get_dcode_mod($emp_id)
    {
      $this->db->where('cs_liq_emp_id', $emp_id);
      $this->db->where('cs_liq_acctg_status', 'set-up');
      $this->db->where('cs_liq_iad_status', 'pending');
      $this->db->order_by('cs_liq_id', 'DESC');
      $data = $this->db->get('cs_liquidation_report');

      return $data->row();
    }


    public function ded_data_mod($code)
    {
      $type = array('NESCO','NESCO-PTA', 'NESCO-PTP', 'NESCO Probationary', 'NESCO Regular', 'NESCO Regular Partimer', 'NESCO Partimer', 'NESCO Contractual');

      $this->db->select('liq.cs_liq_dcode, liq.cs_liq_emp_id, liq.cs_liq_charge_amount, liq.cs_liq_charge_balance, liq.cs_liq_payroll_status, liq.cs_liq_date_shrt, liq.cs_liq_payroll_date, emp3.name, emp3.payroll_no');
      $this->db->from('cs_liquidation_report as liq');
      $this->db->join('pis.employee3 as emp3', 'liq.cs_liq_emp_id = emp3.emp_id');
      $this->db->where('cs_liq_iad_status', 'audited');
      $this->db->where_in('liq.cs_liq_dcode', $code);
      $this->db->where_not_in('emp3.emp_type', $type);
      $data = $this->db->get();

      return $data->result_array();
    }

    public function nesco_ded_data_mod($code)
    {
      $type = array('NESCO','NESCO-PTA', 'NESCO-PTP', 'NESCO Probationary', 'NESCO Regular', 'NESCO Regular Partimer', 'NESCO Partimer', 'NESCO Contractual');

      $this->db->select('liq.cs_liq_dcode, liq.cs_liq_emp_id, liq.cs_liq_charge_amount, liq.cs_liq_charge_balance, liq.cs_liq_payroll_status, liq.cs_liq_date_shrt, liq.cs_liq_payroll_date, emp3.name, emp3.payroll_no');
      $this->db->from('cs_liquidation_report as liq');
      $this->db->join('pis.employee3 as emp3', 'liq.cs_liq_emp_id = emp3.emp_id');
      $this->db->where('cs_liq_iad_status', 'audited');
      $this->db->where_in('liq.cs_liq_dcode', $code);
      $this->db->where_in('emp3.emp_type', $type);
      $data = $this->db->get();

      return $data->result_array();
    }


    public function charge_breakdown_mod($emp_id, $date)
    {
      $this->load->model('limit_amount');
      $limit = $this->limit_amount->limit()->limit_amount;

      $this->db->where('cs_liq_emp_id', $emp_id);
      $this->db->where('cs_liq_ded_date', $date);
      $this->db->where('cs_liq_charge_amount >=', $limit);
      $data = $this->db->get('cs_liquidation_report');

      return $data->result_array();
    }

    public function dept_data_mod($code)
    {
      $this->db->where_in('dcode', $code);
      // $this->db->group_by('dept');
      $data = $this->db->get('pis.locate_department');

      return $data->result_array();
    }

    public function pending_vio_mod($dcode, $date_from, $date_to)
    {
      $this->db->where('dcode', $dcode);
      $this->db->where('sup_status', "");
      $this->db->where('amount_shrt >=', 10);
      $this->db->where('date_shrt between "'.$date_from.'" and "'.$date_to.'"');
      $data = $this->db->get('cs');

      return $data->result_array();
    }


    public function forwarded_vio_mod($company_code, $bunit_code, $dept_code, $date_from, $date_to)
    {
      $this->db->select('emp3.emp_id, emp3.name, neg.date_offense, neg.type, neg.amount, neg.sup_id');
      $this->db->from('negli as neg');
      $this->db->join('pis.employee3 as emp3', 'neg.empId = emp3.emp_id');
      $this->db->where('emp3.company_code', $company_code);
      $this->db->where('emp3.bunit_code', $bunit_code);
      $this->db->where('emp3.dept_code', $dept_code);
      $this->db->where('neg.date_offense between "'.$date_from.'" and "'.$date_to.'"');
      $data = $this->db->get();

      return $data->result_array();
    }

    public function dept_name_mod($dcode)
    {
      $this->db->where('dcode', $dcode);
      $data = $this->db->get('pis.locate_department');

      return $data->row();
    }

    public function sup_name_mod($emp_id)
    {
      $this->db->where('emp_id', $emp_id);
      $data = $this->db->get('pis.employee3');

      return $data->row();
    }




 }
