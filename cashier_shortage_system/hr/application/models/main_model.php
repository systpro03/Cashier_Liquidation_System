<?php  
 
 class Main_model extends CI_Model  
 {  
    public function info_mod($emp_id)
    {
      $this->db->where('app_id', $emp_id);
      $data = $this->db->get('pis.applicant');

      return $data->row();
    }

    public function get_dcode($id)
    {
      $this->db->where('emp_id', $id);
      $data = $this->db->get('cebo_cs_dept_access');
      return $data->result_array();
    }

    public function get_dcode1($id)
    {
      $this->db->where('emp_id', $id);
      $data = $this->db->get('cebo_deduction_code');
      return $data->result_array();
    }

    public function user_mod($emp_id)
    {
      $this->db->where('emp_id', $emp_id);
      $data = $this->db->get('cebo_cs_emp_access');

      return $data->row();
    }

    public function transaction_table_mod($company_code, $bunit_code, $dept_code, $section_code, $sub_section_code)
    {
      $this->db->where_in('company_code', $company_code);
      $this->db->where_in('bunit_code', $bunit_code);
      $this->db->where_in('dept_code', $dept_code);
      $this->db->where_in('section_code', $section_code);
      $this->db->where_in('sub_section_code', $sub_section_code);
      $this->db->where('delete_status', "");
      $this->db->where('acctg_status', "");
      $this->db->group_by('emp_id');
      $data = $this->db->get('cebo_cs_data');

      return $data->result_array();
    }

    public function dept_mod($company_code, $bunit_code, $dept_code)
    {
      $this->db->where('company_code', $company_code);
      $this->db->where('bunit_code', $bunit_code);
      $this->db->where('dept_code', $dept_code);
      $data = $this->db->get('pis.locate_department');

      return $data->row();
    }

    public function trans_details_mod($emp_id)
    {
        $this->db->where('emp_id', $emp_id);
        $this->db->where('delete_status', "");
        $this->db->where('acctg_status', "");
        $data = $this->db->get('cebo_cs_data');

        return $data->result_array();
    }

    public function tag_delete_cs_data($id)
    {
        $this->db->where('id', $id);
        $this->db->set('delete_status', 'deleted');
        $this->db->update('cebo_cs_data');
    }

    public function tag_delete_cs_deno($id)
    {
        $this->db->where('cs_data_id', $id);
        $this->db->set('delete_status', 'deleted');
        $this->db->update('cebo_cs_denomination');
    }

    public function trans_edit_mod($id)
    {
        $this->db->select('cs.id, cs.emp_id, cs.emp_name, cs.amount_shrt, cs.date_shrt, cs.type, cs.company_code, cs.bunit_code, cs.dept_code, cs.section_code, cs.sub_section_code, den.total_denomination');
        $this->db->from('cebo_cs_data as cs');
        $this->db->join('cebo_cs_denomination as den', 'cs.id = den.cs_data_id');
        $this->db->where('cs.id', $id);
        $data = $this->db->get();

        return $data->row();
    }

    public function sec_mod($company_code, $bunit_code, $dept_code, $section_code)
    {
        $this->db->where('company_code', $company_code);
        $this->db->where('bunit_code', $bunit_code);
        $this->db->where('dept_code', $dept_code);
        $this->db->where('section_code', $section_code);
        $data = $this->db->get('pis.locate_section');

        return $data->row();
    }

    public function sub_sec_mod($company_code, $bunit_code, $dept_code, $section_code, $sub_sec_code)
    {
        $this->db->where('company_code', $company_code);
        $this->db->where('bunit_code', $bunit_code);
        $this->db->where('dept_code', $dept_code);
        $this->db->where('section_code', $section_code);
        $this->db->where('sub_section_code', $sub_sec_code);
        $data = $this->db->get('pis.locate_sub_section');

        return $data->row();
    }

    public function get_dept($d1, $d2)
    {
      $this->db->select('dept_name, company_code, bunit_code, dept_code');
      $this->db->where('company_code', $d1);
      $this->db->where('bunit_code', $d2);
      $data = $this->db->get('pis.locate_department');

      return $data->result_array();
    }

    public function get_section($d1, $d2, $d3)
    {
      $this->db->select('section_name, company_code, bunit_code, dept_code, section_code');
      $this->db->where('company_code', $d1);
      $this->db->where('bunit_code', $d2);
      $this->db->where('dept_code', $d3);
      $data = $this->db->get('pis.locate_section');

      return $data->result_array();
    }

    public function get_sub_section($d1, $d2, $d3, $d4)
    {
      $this->db->select('sub_section_name, company_code, bunit_code, dept_code, section_code, sub_section_code');
      $this->db->where('company_code', $d1);
      $this->db->where('bunit_code', $d2);
      $this->db->where('dept_code', $d3);
      $this->db->where('section_code', $d4);
      $data = $this->db->get('pis.locate_sub_section');

      return $data->result_array();
    }

    public function insert_history($data_insert)
    {
      $this->db->insert('cebo_history', $data_insert);
    }

    public function limit_amt_mod()
    {
      $this->db->order_by('id', 'DESC');
      $this->db->limit(1);
      $data = $this->db->get('cebo_shortage_limit');

      return $data->row();
    }

    public function date_infos_mod($emp_id)
    {
      $this->db->where('emp_id', $emp_id);
      $data = $this->db->get('pis.employee3');

      return $data->row();
    }

    public function cs_update_mod($id, $cs_data_update)
    {
      $this->db->where('id', $id);
      $this->db->update('cebo_cs_data', $cs_data_update);
    }

    public function den_amt_mod($id)
    {
      $this->db->where('cs_data_id', $id);
      $data = $this->db->get('cebo_cs_denomination');

      return $data->row();
    }

    public function denomination_mod($id, $denomination_data)
    {
      $this->db->where('cs_data_id', $id);
      $this->db->update('cebo_cs_denomination', $denomination_data);
    }

    public function violation_table_mod($company_code, $bunit_code, $dept_code, $section_code, $limit, $sub_section_code)
    {
      $this->db->where_in('company_code', $company_code);
      $this->db->where_in('bunit_code', $bunit_code);
      $this->db->where_in('dept_code', $dept_code);
      $this->db->where_in('section_code', $section_code);
      $this->db->where_in('sub_section_code', $sub_section_code);
      $this->db->where('delete_status', "");
      $this->db->where('amount_shrt >=', $limit);
      $this->db->where('vms_status', "");
      $data = $this->db->get('cebo_cs_data');

      return $data->result_array();
    }

    public function cebo_violation_data($id)
    {
        $this->db->where('id', $id);
        $this->db->where('vms_status', "");
        $this->db->where('delete_status', "");
        $data = $this->db->get('cebo_cs_data');

        return $data->row();
    }

    public function check_data_mod($id)
    {
      $this->db->where('cs_data_id', $id);
      $data = $this->db->get('negli');

      return $data->row();
    }

    public function insert_negli($data)
    {
      $this->db->insert('negli', $data);
    }

    public function update_cs_data($id, $sup_id)
    {
      $this->db->where('id', $id);
      $this->db->set('vms_status', 'approved');
      $this->db->set('vms_officer_for', $sup_id);
      $this->db->set('vms_date_time', date('Y-m-d H:i:s'));
      $this->db->update('cebo_cs_data');
    }

    public function violation_table_forwarded_mod($company_code, $bunit_code, $dept_code, $section_code, $sub_section_code)
    {
      $this->db->where_in('company_code', $company_code);
      $this->db->where_in('bunit_code', $bunit_code);
      $this->db->where_in('dept_code', $dept_code);
      $this->db->where_in('section_code', $section_code);
      $this->db->where_in('sub_section_code', $sub_section_code);
      $this->db->where('delete_status', "");
      $this->db->where('vms_status', "approved");
      $this->db->where('vms_cancel', "");
      $data = $this->db->get('cebo_cs_data');

      return $data->result_array();
    }

    public function cancel_vio_cs_data($id, $user_id)
    {
      $this->db->where('id', $id);
      $this->db->set('vms_cancel', 'cancelled');
      $this->db->set('vms_cancel_officer', $user_id);
      $this->db->set('vms_cancel_date', date('Y-m-d H:i:s'));
      $this->db->update('cebo_cs_data');
    }

    public function cancel_vio_negli($id)
    {
      $this->db->where('cs_data_id', $id);
      $this->db->set('cancelStat', '1');
      $this->db->update('negli');
    }

    public function negli_data_mod($id)
    {
       $this->db->where('cs_data_id', $id);
       $data = $this->db->get('negli');

       return $data->row();
    }

    public function short_over_mod($id)
    {
      $this->db->where('offenseId', $id);
      $data = $this->db->get('vsm.shortover');

      return $data->row();      
    }

    public function insert_off_cancel($off_can_data)
    {
      $this->db->insert('vsm.offense_cancel', $off_can_data);
    }

    public function update_vsm($id)
    {
      $this->db->where('offenseId', $id);
      $this->db->set('cancelStat', '1');
      $this->db->update('vsm.shortover');
    }

    public function vio_cutoff_mod($company_code, $bunit_code, $dept_code, $section_code, $sub_section_code)
    {
      $this->db->distinct();
      $this->db->select('vms_cutoff_date');
      $this->db->where_in('company_code', $company_code);
      $this->db->where_in('bunit_code', $bunit_code);
      $this->db->where_in('dept_code', $dept_code);
      $this->db->where_in('section_code', $section_code);
      $this->db->where_in('sub_section_code', $sub_section_code);
      $this->db->where('delete_status', "");
      $this->db->where('vms_status', "");
      $this->db->where('vms_cancel', "");
      $this->db->where('vms_cutoff_date !=', "");
      $this->db->where('date_shrt >=', '2019-03-24');
      $data = $this->db->get('cebo_cs_data');

      return $data->result_array();
    }

    public function violation_table_mods($company_code, $bunit_code, $dept_code, $section_code, $sub_section_code, $limit_amt, $from, $to)
    {
      $this->db->where('date_shrt BETWEEN "'.$from. '" AND "'.$to.'"');
      $this->db->where('amount_shrt >=', $limit_amt);
      $this->db->where_in('company_code', $company_code);
      $this->db->where_in('bunit_code', $bunit_code);
      $this->db->where_in('dept_code', $dept_code);
      $this->db->where_in('section_code', $section_code);
      $this->db->where_in('sub_section_code', $sub_section_code);
      $this->db->where('delete_status', "");
      $this->db->where('vms_status', "");
      $this->db->where('vms_cancel', "");
      $this->db->where('vms_cutoff_date !=', "");
      $data = $this->db->get('cebo_cs_data');

      return $data->result_array();
    }

}