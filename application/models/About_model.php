<?php

class About_model extends CI_Model
{
    public function getSpecificEmployees() {
        $EmployeeIDs = array(
            '43864-2013',
            '21114-2013',
            '15797-2018',
            '00902-2014',
            '02483-2023',
            '20528-2013',
            '01779-2016',
            '05157-2015'
        );
    
        $this->db->select('app.app_id, emp.name, emp.current_status, emp.position, app.photo');
        $this->db->from('pis.applicant app');
        $this->db->join('pis.employee3 emp', 'app.app_id = emp.emp_id', 'inner');
        $this->db->where_in('app.app_id', $EmployeeIDs);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $result = $query->result();
    
            $image_server = $_SERVER['HTTP_HOST'] . "/hrms/";
            $emp = array();
    
            foreach ($result as $row) {
                $row->photo = $image_server . str_replace('../', '', $row->photo);
                $emp[$row->app_id] = $row;
            }
    
            return $emp;
        }
    }
    
}
