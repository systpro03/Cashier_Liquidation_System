<?php  
 
 class Main_model extends CI_Model  
 {  
    public function info_mod($emp_id)
    {
      $this->db->where('app_id', $emp_id);
      $data = $this->db->get('pis.applicant');

      return $data->row();
    }

    public function get_emp_info($emp_id)
    {
      $this->db->where('emp_id', $emp_id);
      $data = $this->db->get('pis.employee3');
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
    
    public function bu_mod($company_code, $bunit_code)
    {
      $this->db->where('company_code', $company_code);
      $this->db->where('bunit_code', $bunit_code);
      // $this->db->where('dept_code', $dept_code);
      $data = $this->db->get('pis.locate_business_unit');

      return $data->row();
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

    public function search_name_mod($name, $company_code, $bunit_code, $dept_code, $section_code, $sub_section_code)
    {    
      $this->db->select('name, emp_id');
      $this->db->like('name', $name, 'after');
      $this->db->like('current_status', 'active', 'both');
      $this->db->where_in('company_code', $company_code);
      $this->db->where_in('bunit_code', $bunit_code);
      $this->db->where_in('dept_code', $dept_code);
      $this->db->where_in('section_code', $section_code);      
      $this->db->where_in('sub_section_code', $sub_section_code);      
      $this->db->limit(10);
      $data = $this->db->get('pis.employee3');
      return $data->result_array();
    }

    public function get_dept_model($s_code)
    {
      $this->db->where('scode', $s_code);
      $data = $this->db->get('pis.locate_section');
      return $data->row();
    }

    public function insert_data_to_cs_cebo($data)
    {
      $this->db->insert('cebo_cs_data', $data);
    }

    public function insert_data_to_cs_den($data)
    {
      $this->db->insert('cebo_cs_denomination', $data);
    }

    public function trans_no_mod($emp_id)
    {
      $this->db->where('emp_id', $emp_id);
      $this->db->order_by('id', 'DESC');
      $this->db->limit(1);
      $data = $this->db->get('cebo_cs_data');

      return $data->row();
    }

    public function cs_data_mod($group_code)
    {
      $this->db->select('cs.emp_id, cs.emp_name, cs.amount_shrt, cs.type, cs.date_shrt, cs.company_code, cs.bunit_code, cs.dept_code, cs.section_code, den.total_denomination');
      $this->db->from('cebo_cs_data as cs');
      $this->db->join('cebo_cs_denomination as den',  'cs.id = den.cs_data_id');
       // $this->db->where('cs.date_shrt BETWEEN CURDATE() - INTERVAL 60 DAY AND CURDATE()'); // Cx Edit: Dec 28 19: Uncomment this to limit display records
       //$this->db->where('cs.date_time BETWEEN CURDATE() - INTERVAL 60 DAY AND CURDATE()'); // Cx Edit: Aug 23 19
      // $this->db->where('cs.date_shrt >', DATE_ADD(day, -60, Current_TimeStamp));
      // $this->db->where_in('cs.company_code', $company_code);
      // $this->db->where_in('cs.bunit_code', $bunit_code);
      // $this->db->where_in('cs.dept_code', $dept_code);
      // $this->db->where_in('cs.section_code', $section_code);
      // $this->db->where_in('cs.sub_section_code', $sub_section_code);
       $this->db->where_in("CONCAT(cs.company_code, cs.bunit_code, cs.dept_code, cs.section_code, cs.sub_section_code)", $group_code, FALSE);
      $this->db->where('cs.delete_status', "");
      $this->db->order_by('cs.id', 'DESC');
      $data = $this->db->get();


      return $data->result_array();

    }

      public function cs_data_mod1($company_code, $bunit_code, $dept_code, $section_code, $sub_section_code, $group_code)
    {
      $this->db->select('cs.emp_id, cs.emp_name, cs.amount_shrt, cs.type, cs.date_shrt, cs.company_code, cs.bunit_code, cs.dept_code, cs.section_code, den.total_denomination');
      $this->db->from('cebo_cs_data as cs');
      $this->db->join('cebo_cs_denomination as den',  'cs.id = den.cs_data_id');
      $this->db->where('cs.type', 'S');
      $this->db->where('cs.amount_shrt >=', 11);
      $this->db->where_in("CONCAT(cs.company_code, cs.bunit_code, cs.dept_code, cs.section_code, cs.sub_section_code)", $group_code, FALSE);
      $this->db->where('cs.delete_status', "");
      $this->db->order_by('cs.id', 'DESC');
      $data = $this->db->get();


      return $data->result_array();

    }

    // public function ae_get_setup_date($company_code, $bunit_code, $dept_code, $section_code, $sub_section_code, $group_code)
    public function ae_get_setup_date($company_code, $bunit_code, $dept_code, $section_code, $sub_section_code, $group_code)
    {         

      $this->db->distinct();
      $this->db->select('cut_off_date');   
      $this->db->where('cut_off_date !=', '0000-00-00');
      $this->db->where('acctg_status', "");
      $this->db->where('delete_status', "");
      // $this->db->where_in('company_code', $company_code);
      // $this->db->where_in('bunit_code', $bunit_code);
      // $this->db->where_in('dept_code', $dept_code);
      // $this->db->where_in('section_code', $section_code);
      // $this->db->where_in('sub_section_code', $sub_section_code);
      $this->db->where_in("CONCAT(company_code, bunit_code, dept_code, section_code, sub_section_code)", $group_code, FALSE);
      
      $this->db->order_by('cut_off_date', 'DESC');
      $data = $this->db->get('cebo_cs_data');
      return $data->result_array();
    }

    public function deduction_table_mod($company_code, $bunit_code, $dept_code, $section_code, $deduction_date, $sub_section_code,$group_code)
    {
      $this->db->select('emp_id, emp_name, company_code, bunit_code, dept_code, section_code, sum(amount_shrt) as amount_shrt, cut_off_date');
      $this->db->where('cut_off_date', $deduction_date);
      $this->db->where('acctg_status', "");
      // $this->db->where_in('company_code', $company_code);
      // $this->db->where_in('bunit_code', $bunit_code);
      // $this->db->where_in('dept_code', $dept_code);
      // $this->db->where_in('section_code', $section_code);
      // $this->db->where_in('sub_section_code', $sub_section_code);
      $this->db->where_in("CONCAT(company_code, bunit_code, dept_code, section_code, sub_section_code)", $group_code, FALSE);
      $this->db->where('delete_status', "");
      $this->db->where('type', 'S');
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

    public function details_mod($emp_id, $deduction_date)
    {
      $this->db->where('emp_id', $emp_id);
      $this->db->where('delete_status', "");
      $this->db->where('cut_off_date', $deduction_date);
      $data = $this->db->get('cebo_cs_data');

      return $data->result_array();
    }

    public function submit_ded_mod($emp_id, $deduction_date)
    {
      $this->db->where('emp_id', $emp_id);
      $this->db->where('cut_off_date', $deduction_date);
      $this->db->where('acctg_status', "");
      $this->db->where('delete_status', "");
      $data = $this->db->get('cebo_cs_data');

      return $data->result_array();
    }

    public function liquidation_data_insert($data)
    {
      $this->db->insert('cs_liquidation_report', $data);
    }

    public function cs_cebo_data_update($id, $officer_id)
    {
      $this->db->where('id', $id);
      $this->db->set('acctg_status', 'forwarded');
      $this->db->set('acctg_officer_for', $officer_id);
      $this->db->set('acctg_date_time', date('Y-m-d H:i:s'));
      $this->db->update('cebo_cs_data');
    }

    public function deduction_forwarded_table_mod($company_code, $bunit_code, $dept_code, $section_code, $sub_section_code, $group_code)
    {
      // $this->db->where_in('company_code', $company_code);
      // $this->db->where_in('bunit_code', $bunit_code);
      // $this->db->where_in('dept_code', $dept_code);
      // $this->db->where_in('section_code', $section_code);
      // $this->db->where_in('sub_section_code', $sub_section_code);
      $this->db->where_in("CONCAT(company_code, bunit_code, dept_code, section_code, sub_section_code)", $group_code, FALSE);
      $this->db->where('acctg_status', 'forwarded');
      $this->db->where('delete_status', "");
      $this->db->order_by('cut_off_date', 'desc');
      $data = $this->db->get('cebo_cs_data');

      return $data->result_array();
    }

    public function off_name_mod($emp_id)
    {
      $this->db->where('emp_id', $emp_id);
      $data = $this->db->get('pis.employee3');

      return $data->row();
    }

    public function limit_amt_mod()
    {
      $this->db->order_by('id', 'DESC');
      $this->db->limit(1);
      $data = $this->db->get('cebo_shortage_limit');

      return $data->row();
    }

    public function bu_name($code)
    {
      $this->db->where('bcode', $code);
      $data = $this->db->get('pis.locate_business_unit');

      return $data->row();
    }

    public function date_exist($date, $emp_id)
    {
      $this->db->where('date_shrt', $date);
      $this->db->where('emp_id', $emp_id);
      $this->db->where('delete_status', '');
      $data = $this->db->get('cebo_cs_data');

      return $data->row();
    }

    public function validate_managers_key_num_mod($username, $password)
    {
      $this->db->select('emp_id');
      $this->db->where('username', $username);
      $this->db->where('password', md5($password));
      // $this->db->where('current_status', 'Active');
      $this->db->from('pis.users');
      $data = $this->db->get();

      return $data->num_rows();
    }    

    public function validate_managers_key_mod($username, $password)
    {
      $this->db->select('emp_id');
      $this->db->where('username', $username);
      $this->db->where('password', md5($password));
      // $this->db->where('current_status', 'Active');
      $this->db->from('pis.users');
      $data = $this->db->get();

      return $data->row();
    }

    // public function validate_managers_key_to_leveling_mod($incharge_emp_id, $sup_emp_id)
    // {
    //   $this->db->select('*');
    //   $this->db->where('subordinates_rater', $incharge_emp_id);
    //   $this->db->where('ratee', $sup_emp_id);
    //   // $this->db->where('current_status', 'Active');
    //   $this->db->from('pis.leveling_subordinates');
    //   $data = $this->db->get();

    //   return $data->row();
    // }

    public function validate_managers_key_to_leveling_row_mod($incharge_emp_id, $sup_emp_id)
    {
      $this->db->select('*');
      $this->db->where('subordinates_rater', $incharge_emp_id);
      $this->db->where('ratee', $sup_emp_id);
      // $this->db->where('current_status', 'Active');
      $this->db->from('pis.leveling_subordinates');
      $data = $this->db->get();

      return $data->num_rows();
    }
}