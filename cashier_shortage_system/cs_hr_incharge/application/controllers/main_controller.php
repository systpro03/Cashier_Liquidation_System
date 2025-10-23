<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();    
		$this->load->library('nativesession');   
		$this->load->model("main_model");  
    $this->load->library('form_validation');
	} 

	public function index()
	{	
		$user_data = $this->nativesession->get('user', 'id'); 

		$info = $this->main_model->info_mod($user_data['emp_id']);

		$data['firstname'] =  $info->firstname; 		
		$data['photo_url'] =  $_SERVER['HTTP_HOST']."/hrms/" . substr($info->photo, 3); 

    $data['store']         = $this->get_store_con();

    $access = $this->main_model->access1($user_data['emp_id']);

    if(sizeof($access) == 0)
    {
      redirect('http://'.$_SERVER['HTTP_HOST'].'/EBS/hr/');      
    }
    else
    {
      $this->load->view('dashboard', $data);
    }

	}

	public function log_out()
	{
		redirect('http://'.$_SERVER['HTTP_HOST'].'/hrms/employee/');      
	}


	public function get_store_con()
	{
	    $this->load->model('main_model');


	     $user_data = $this->nativesession->get('user', 'id');
	     $store = $this->main_model->get_store($user_data['emp_id']);

	     $stores = '';

	     if($store->section_code == '09')
	     {
	        $stores = 'PM';
	     }
	     elseif($store->section_code == '06')
	     {
	        $stores = 'ICM';
	     }
       elseif($store->section_code == '07')
       {
          $stores = 'ASC';
       }
	

	     return $stores;
	}


	public function pending_con()
	{	
		$user_data = $this->nativesession->get('user', 'id'); 

		$info = $this->main_model->info_mod($user_data['emp_id']);

		$data['firstname'] =  $info->firstname; 		
		$data['photo_url'] =  $_SERVER['HTTP_HOST']."/hrms/" . substr($info->photo, 3); 

   
    // $data['store']         = $this->get_store_con();

    $this->load->model("main_model"); 
  
    $emp_id = $user_data['emp_id'];

    $department_code = "";

    $dcode = $this->main_model->search_dcode($emp_id);
    foreach ($dcode as $key => $value) 
    {
      $department_code = $value['company_code'].$value['bunit_code'].$value['dept_code'];
    }  

    $dcode = $this->main_model->get_dcode($emp_id);

    $dcode_array = array();
    foreach ($dcode as $key => $value) 
    {
      $dcode_array[] = $value['dcode'];
    }

    $emp_dept_code = $this->main_model->emp_locate_department($dcode_array);

    $c_array = array();
    $b_array = array();
    $d_array = array();

    $code = array();
    foreach ($emp_dept_code as $key => $value) 
    {
      $code[] = $value['company_code'].$value['bunit_code'].$value['dept_code'];
    }

    $dept_data = $this->main_model->dept_data_mod($code);

    $dept_array = array();

    foreach ($dept_data as $key => $value) 
    {
      $dept_array[$key] = array('dcode' => $value['dcode'], 'dept_name' => $value['dept_name'],);
    }

    // var_dump($dept_array);
    $data['department'] = $dept_array;

    // $this->load->view('daily_report', $data); 
        		
		$this->load->view('pending_vio', $data);
	} 


  public function pending_violation()
  {
    $this->load->model('main_model');

    $dcode     = $_POST['dcode'];
    $date_from =  DateTime::createFromFormat('m/d/Y', $_POST['date_from'])->format('Y-m-d'); 
    $date_to   =  DateTime::createFromFormat('m/d/Y', $_POST['date_to'])->format('Y-m-d');

    $data = $this->main_model->pending_vio_mod($dcode, $date_from, $date_to);

    $result = array('data' => array());

    foreach ($data as $key => $value) 
    {
      $result['data'][$key] = array($value['emp_id'], $value['emp_name'], $value['dept'], $value['amount_shrt'], $value['type'], date('m-d-Y', strtotime($value['date_shrt'])));
    }

    echo json_encode($result);

  }


  public function forwarded_con()
  {
    $user_data = $this->nativesession->get('user', 'id'); 

    $info = $this->main_model->info_mod($user_data['emp_id']);

    $data['firstname'] =  $info->firstname;     
    $data['photo_url'] =  $_SERVER['HTTP_HOST']."/hrms/" . substr($info->photo, 3);  

        $this->load->model("main_model"); 
  
    $emp_id = $user_data['emp_id'];

    $department_code = "";

    $dcode = $this->main_model->search_dcode($emp_id);
    foreach ($dcode as $key => $value) 
    {
      $department_code = $value['company_code'].$value['bunit_code'].$value['dept_code'];
    }  

    $dcode = $this->main_model->get_dcode($emp_id);

    $dcode_array = array();
    foreach ($dcode as $key => $value) 
    {
      $dcode_array[] = $value['dcode'];
    }

    $emp_dept_code = $this->main_model->emp_locate_department($dcode_array);

    $c_array = array();
    $b_array = array();
    $d_array = array();

    $code = array();
    foreach ($emp_dept_code as $key => $value) 
    {
      $code[] = $value['company_code'].$value['bunit_code'].$value['dept_code'];
    }

    $dept_data = $this->main_model->dept_data_mod($code);

    $dept_array = array();

    foreach ($dept_data as $key => $value) 
    {
      $dept_array[$key] = array('dcode' => $value['dcode'], 'dept_name' => $value['dept_name'],);
    }

    // var_dump($dept_array);
    $data['department'] = $dept_array;
            
    $this->load->view('forwarded_vio', $data);
  }


  public function forwarded_vio_con()
  {
    $this->load->model('main_model');

    $dcode     = $_POST['dcode'];
    $date_from =  DateTime::createFromFormat('m/d/Y', $_POST['date_from'])->format('Y-m-d'); 
    $date_to   =  DateTime::createFromFormat('m/d/Y', $_POST['date_to'])->format('Y-m-d');

    $res = str_split($dcode, 2);

    $company_code = $res[0];
    $bunit_code = $res[1];
    $dept_code = $res[2];

    $data = $this->main_model->forwarded_vio_mod($company_code, $bunit_code, $dept_code, $date_from, $date_to);

    $result = array('data' => array());

    $dept_name = $this->main_model->dept_name_mod($dcode);

    foreach ($data as $key => $value) 
    {
      $sup_name = $this->main_model->sup_name_mod($value['sup_id']);

      $result['data'][$key] = array($value['emp_id'], $value['name'], $dept_name->dept_name, $value['amount'], strtoupper($value['type']), date('m-d-Y', strtotime($value['date_offense'])), $sup_name->name);
    }

    echo json_encode($result);


  }




}
