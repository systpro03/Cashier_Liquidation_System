<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller {


	public function __construct() 
	{
		parent::__construct();    
		// $this->load->library('nativesession');   
		$this->load->model("main_model");  
		$this->load->model("liquidation_model");
		$this->load->helper('text');
	} 
	public function index()
	{
		//array(2) { ["username"]=> string(10) "03827-2017" ["emp_id"]=> string(10) "03827-2017" }
		// $this->session->userdata(= $this-)nativesession->get('user', 'id'); 
		$data['emp_id'] = $_SESSION['emp_id'];
		$data['username'] = $_SESSION['username'];

		$info = $this->main_model->info_mod($_SESSION['emp_id']);

		//172.16.161.34:8080 + "/hrms/" + images/users/06050-2015=2015-10-14=Profile=14-27-16-PM.JPG
		$data['photo_url'] =  $_SERVER['HTTP_HOST']."/hrms/" . substr($info->photo, 3);
		//Data Value : array(3) { ["emp_id"]=> string(10) "06050-2015" ["username"]=> string(8) "SimpleAB" ["photo_url"]=> string(82) "172.16.161.34:8080/hrms/images/users/06050-2015=2015-10-14=Profile=14-27-16-PM.JPG" }
		//var_dump($info);
		$this->load->view('dashboard', $data);
	}



	public function demo_con()
	{
		// $this->session->userdata(= $this-)nativesession->get('user', 'id'); 
		$data['emp_id'] = $_SESSION['emp_id'];
		$data['username'] = $_SESSION['username'];

		$info = $this->main_model->info_mod($_SESSION['emp_id']);

		$data['photo_url'] =  $_SERVER['HTTP_HOST']."/hrms/" . substr($info->photo, 3);

		$this->load->view('demo', $data);
	}

	public function bu_denomination_form()
	{
		// $this->session->userdata(= $this-)nativesession->get('user', 'id'); 
		$data['emp_id'] = $_SESSION['emp_id'];
		$data['username'] = $_SESSION['username'];

		$info = $this->main_model->info_mod($_SESSION['emp_id']);
		
		$data['photo_url'] =  $_SERVER['HTTP_HOST']."/hrms/" . substr($info->photo, 3);

		$emp_info = $this->main_model->get_emp_info($_SESSION['emp_id']);

		$data['dept'] = $emp_info->company_code."-".$emp_info->bunit_code."-".$emp_info->dept_code;

		
		$this->load->view('bu_denomination_form', $data);
	}

	 public function bu_data()
	 {
	 	// $this->session->userdata(= $this-)nativesession->get('user', 'id');		
		$user_id  = $_SESSION['emp_id'];

		$dcode = $this->main_model->get_dcode1($user_id);

		$company_code = array();
		$bunit_code   = array();
		$dept_code 	  = array();
		$section_code = array();
		$sub_section_code = array();
		$group_code = array();

		foreach ($dcode as $key => $value) 
		{

			$group_code[] = $value['company_code'].$value['bunit_code'].$value['dept_code'].$value['section_code'].$value['sub_section_code'];
		}

	 	$data = $this->main_model->cs_data_mod($group_code);

	 	$result = array('data' => array());

	 	foreach ($data as $key => $value) 
	 	{
	 		$get_dept = $this->main_model->bu_mod($value['company_code'], $value['bunit_code']);

	 		$result['data'][] = array(
	 			$value['emp_name'], 
	 			$get_dept->business_unit,
	 			number_format($value['total_denomination'], 2), 
	 			number_format($value['amount_shrt'], 2), 
	 			$value['type'], date('m-d-Y', strtotime($value['date_shrt'])));
	 	}

	 	echo json_encode($result);
	 }

	 public function bu_search_name()
	{
		$response = array();
		$request = $_POST['request']; 

		if($request == 1)
		{
			$search = $_POST['search'];
			// $this->session->userdata(= $this-)nativesession->get('user', 'id');		
			$user_id  = $_SESSION['emp_id'];

			$dcode = $this->main_model->get_dcode($user_id);

			$company_code = array();
			$bunit_code   = array();
			$dept_code 	  = array();
			$section_code = array();
			$sub_section_code = array();

			foreach ($dcode as $key => $value) 
			{
				$company_code[]  =  $value['company_code'];
				$bunit_code[] 	 =  $value['bunit_code'];
				$dept_code[]	 =  $value['dept_code'];
				$section_code[]  =  $value['section_code'];
				$sub_section_code[]  =  $value['sub_section_code'];
			}

			$data = $this->main_model->search_name_mod($search, $company_code, $bunit_code, $dept_code, $section_code, $sub_section_code);

			foreach ($data as $key => $value) 
			{
				$response[] = array("value" => $value['emp_id'], "label" => strtoupper($value['name']));
			}    
			echo json_encode($response);
			exit;	    
		}

		if($request == 2)
		{
			$emp_id = $_POST['emp_id'];

			$emp_info = $this->main_model->get_emp_info($emp_id);

			$users_arr = array();

			$emp_id = $emp_info->emp_id;
			$sal_no = $emp_info->payroll_no;
			$emp_name = $emp_info->name;

			$s_code = $emp_info->company_code.$emp_info->bunit_code;

			$get_dept = $this->main_model->bu_mod($emp_info->company_code, $emp_info->bunit_code, $emp_info->dept_code);

			$users_arr[] = array("emp_id" => $emp_info->emp_id, "emp_name" => $emp_info->name,"dept" => $get_dept->business_unit);

			echo json_encode($users_arr);
			exit;
		}
	}
	

	public function denomination_form()
	{
		// $this->session->userdata(= $this-)nativesession->get('user', 'id'); 
		$data['emp_id'] = $_SESSION['emp_id'];
		$data['username'] = $_SESSION['username'];

		$info = $this->main_model->info_mod($_SESSION['emp_id']);
		
		$data['photo_url'] =  $_SERVER['HTTP_HOST']."/hrms/" . substr($info->photo, 3);

		$emp_info = $this->main_model->get_emp_info($_SESSION['emp_id']);

		$data['dept'] = $emp_info->company_code."-".$emp_info->bunit_code."-".$emp_info->dept_code;

		$data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();

		//var_dump($emp_info);
		
		$this->load->view('denomination_form', $data);
	}


	public function log_out()
	{
		redirect('http://'.$_SERVER['HTTP_HOST'].'/hrms/employee/');      
	}

	public function old_system()
	{
		// redirect('http://'.$_SERVER['HTTP_HOST'].'/EBS/cs_liquidation_incharge'); 
		redirect('http://'.$_SERVER['SERVER_ADDR'].':'.$_SERVER['SERVER_PORT'].'/EBS/supervisor/template/cebo_cs_supervisor/');      
	}

	public function dept_con()
	{	
		$dept_code = explode("-", $_POST['dept_code']);

		$data = $this->main_model->get_dept($dept_code[0], $dept_code[1]);

		echo json_encode($data);		
	}

	public function section_con()
	{
		$dept_option = explode("-", $_POST['dept_option']);

		$data = $this->main_model->get_section($dept_option[0], $dept_option[1], $dept_option[2]);

		echo json_encode($data);	
	}

	public function sub_section_con()
	{
		$section_option = explode("-", $_POST['section_option']);

		$data = $this->main_model->get_sub_section($section_option[0], $section_option[1], $section_option[2], $section_option[3]);

		echo json_encode($data);	
	}

	public function search_name()
	{
		$response = array();
		$request = $_POST['request']; 

		if($request == 1)
		{
			$search = $_POST['search'];
			// $this->session->userdata(= $this-)nativesession->get('user', 'id');		
			$user_id  = $_SESSION['emp_id'];

			$dcode = $this->main_model->get_dcode($user_id);

			$company_code = array();
			$bunit_code   = array();
			$dept_code 	  = array();
			$section_code = array();
			$sub_section_code = array();

			foreach ($dcode as $key => $value) 
			{
				$company_code[]  =  $value['company_code'];
				$bunit_code[] 	 =  $value['bunit_code'];
				$dept_code[]	 =  $value['dept_code'];
				$section_code[]  =  $value['section_code'];
				$sub_section_code[]  =  $value['sub_section_code'];
			}

			$data = $this->main_model->search_name_mod($search, $company_code, $bunit_code, $dept_code, $section_code, $sub_section_code);

			foreach ($data as $key => $value) 
			{
				$response[] = array("value" => $value['emp_id'], "label" => strtoupper($value['name']));
			}    
			echo json_encode($response);
			exit;	    
		}

		if($request == 2)
		{
			$emp_id = $_POST['emp_id'];

			$emp_info = $this->main_model->get_emp_info($emp_id);

			$users_arr = array();

			$emp_id = $emp_info->emp_id;
			$sal_no = $emp_info->payroll_no;
			$emp_name = $emp_info->name;

			$s_code = $emp_info->company_code.$emp_info->bunit_code.$emp_info->dept_code;

			$get_dept = $this->main_model->dept_mod($emp_info->company_code, $emp_info->bunit_code, $emp_info->dept_code);

			$users_arr[] = array("emp_id" => $emp_info->emp_id, "emp_name" => $emp_info->name,"dept" => $get_dept->dept_name);

			echo json_encode($users_arr);
			exit;
		}
	}

 public function validate_managers_key()
 {

	  $emp_id_matched = "";

	  // $this->session->userdata(= $this-)nativesession->get('user', 'id'); 
	  $data['emp_id'] = $_SESSION['emp_id'];

	  $this->load->model('main_model');
	  $username = $_POST["username"];
	  $password = $_POST["password"];

	  //get supervisor emp_id...
	  $supervisor_emp_id_num = $this->main_model->validate_managers_key_num_mod($username, $password);

	  if($supervisor_emp_id_num > 0)
	  {
		  //Match supervisor emp_id to leveling table...
		  $supervisor_emp_id = $this->main_model->validate_managers_key_mod($username, $password);
		  $emp_id_matched = $this->main_model->validate_managers_key_to_leveling_row_mod($data['emp_id'], $supervisor_emp_id->emp_id);

		  // var_dump($data['emp_id']);
		  // var_dump($supervisor_emp_id->emp_id);

		  if($emp_id_matched > 0)
		  {

				  $blank_array = array();
				  $duplicate_array = array();

				  $number = count($_POST["names"]);

				  $limit_amt = $this->main_model->limit_amt_mod();

				  for($i=0; $i<$number; $i++)
				  {
				  	$ded_date = '';
				  	$balance_amount = '';
				  	
				   	if(trim($_POST["names"][$i] != ''))
				    {

							    $date_infos 	= $this->main_model->get_emp_info($_POST["emp_id"][$i]);	        
							    $dcode      	= $date_infos->company_code.$date_infos->bunit_code.$date_infos->dept_code;
							    // $this->session->userdata( 	= $thi)->nativesession->get('user', 'id');
							    $id         	= $_SESSION['emp_id'];
							    $type 			= '';
							    $status  		= '';
							    $amount_balance = '';


							    $deduction_date = '';

								 $day30 =  date('d', strtotime($_POST["date"][$i]));

								 $days30 = array("6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20");

								 if($date_infos->company_code.$date_infos->bunit_code == '0203' || $date_infos->company_code.$date_infos->bunit_code == '0223')
								 {
									if (in_array($day30, $days30))
									{
										$month =  date('m', strtotime($_POST["date"][$i]));

										if($month == 12)
										{
											$month =  date('m', strtotime($_POST["date"][$i]));
											$year  =  date('Y', strtotime($_POST["date"][$i]));
											$month = $month + 1;
											$year += 1;
											$deduction_date = $year.'-'.'01'.'-'.'05';
										}
										else
										{
											$month =  date('m', strtotime($_POST["date"][$i]));
											$year  =  date('Y', strtotime($_POST["date"][$i]));
											$month = $month + 1;
											$deduction_date = $year.'-'.$month.'-'.'05';
										}
									}
									else
									{
										$month =  date('m', strtotime($_POST["date"][$i]));

										if($month == 12)
										{
											$dec_day = array("21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");

											$day15_1 =  date('d', strtotime($_POST["date"][$i]));

											if(in_array($day15_1, $dec_day))
											{
												$m =  date('m', strtotime($_POST["date"][$i]));
												$year  =  date('Y', strtotime($_POST["date"][$i]));
												$month = $m + 1;
												$years = $year + 1;
												$deduction_date = $years.'-'.'01'.'-'.'20';
											}
											else
											{
												$month =  date('m', strtotime($_POST["date"][$i]));
												$year  =  date('Y', strtotime($_POST["date"][$i]));				
												$deduction_date = $year.'-'.$month.'-'.'20';
											}
										}
										else
										{
											$days15_1 = array("21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");

											$day15_1 =  date('d', strtotime($_POST["date"][$i]));

											if(in_array($day15_1, $days15_1))
											{
												$m =  date('m', strtotime($_POST["date"][$i]));
												$year  =  date('Y', strtotime($_POST["date"][$i]));
												$month = $m + 1;
												$deduction_date = $year.'-'.$month.'-'.'20';
											}
											else
											{
												$month =  date('m', strtotime($_POST["date"][$i]));
												$year  =  date('Y', strtotime($_POST["date"][$i]));				
												$deduction_date = $year.'-'.$month.'-'.'20';
											}
										}
									}
								 }
								 else
								 {
									if (in_array($day30, $days30))
									{
										$month =  date('m', strtotime($_POST["date"][$i]));
										$year  =  date('Y', strtotime($_POST["date"][$i]));
										if($month == '2')
										{
											$deduction_date = $year.'-'.$month.'-'.'28';
										}
										else
										{
											$deduction_date = $year.'-'.$month.'-'.'30';
										}	
									}
									else
									{
										$month =  date('m', strtotime($_POST["date"][$i]));

										if($month == 12)
										{
											$dec_day = array("21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");

											$day15_1 =  date('d', strtotime($_POST["date"][$i]));

											if(in_array($day15_1, $dec_day))
											{
												$m =  date('m', strtotime($_POST["date"][$i]));
												$year  =  date('Y', strtotime($_POST["date"][$i]));
												$month = $m + 1;
												$years = $year + 1;
												$deduction_date = $years.'-'.'01'.'-'.'15';
											}
											else
											{
												$month =  date('m', strtotime($_POST["date"][$i]));
												$year  =  date('Y', strtotime($_POST["date"][$i]));				
												$deduction_date = $year.'-'.$month.'-'.'15';
											}
										}
										else
										{
											$days15_1 = array("21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");

											$day15_1 =  date('d', strtotime($_POST["date"][$i]));

											if(in_array($day15_1, $days15_1))
											{
												$m =  date('m', strtotime($_POST["date"][$i]));
												$year  =  date('Y', strtotime($_POST["date"][$i]));
												$month = $m + 1;  
												$deduction_date = $year.'-'.$month.'-'.'15';
											}
											else
											{
												$month =  date('m', strtotime($_POST["date"][$i]));
												$year  =  date('Y', strtotime($_POST["date"][$i]));				
												$deduction_date = $year.'-'.$month.'-'.'15';
											}
										}
									}
								 }	

							    if($_POST["type"][$i] == 'S')
							    {	          
							    
							    $str_replace = str_replace( ',', '', $_POST["amount"][$i]);
							      if(floatval($str_replace) < $limit_amt->limit_amount)
							      {
							      	$type 			= 'S';
							      	$ded_date = "";
							      	$balance_amount = "";
							      }
							      else
							      {	       
							      	$type 			= 'S';
							    	$status  		= 'unpaid';
							    	$amount_balance = str_replace( ',', '', $_POST["amount"][$i]);
							    	$balance_amount = str_replace( ',', '', $_POST["amount"][$i]);
							    	$ded_date = $deduction_date;
							      }
							    }
							    elseif($_POST["type"][$i] == 'O')
							    {
							    	$type = 'O';
							    	$ded_date = "";	           
							    	$balance_amount = "";	           
							    }
							    else
							    {
							    	$type = 'PF';	
							    	$ded_date = "";
							    	$balance_amount = "";
							    }	

							    $c_code = "";
							    $b_code = "";
							    $d_code = "";
							    $sec_code = "";
							    $sub_sec_code = "";


							    if($_POST["input_br"][$i] == "")
							    {
							    	$c_code = $date_infos->company_code;
							        $b_code = $date_infos->bunit_code;
							        $d_code = $date_infos->dept_code;
							        $sec_code = $date_infos->section_code;
							        $sub_sec_code = $date_infos->sub_section_code;
							    }
							    else
							    {
							    	$section_option = explode("-", $_POST["hidden_input_br"][$i]);

							    	if(count($section_option) == 3)
							    	{
										$c_code = $section_option[0];
										$b_code = $section_option[1];
										$d_code = $section_option[2];
								  		
							    	}
							    	elseif(count($section_option) == 4)
							    	{
							    		$c_code = $section_option[0];
								        $b_code = $section_option[1];
								        $d_code = $section_option[2];
								        $sec_code = $section_option[3];		
							    	}
							    	else
							    	{
							    		$c_code = $section_option[0];
								        $b_code = $section_option[1];
								        $d_code = $section_option[2];
								        $sec_code = $section_option[3];			       
								        $sub_sec_code = $section_option[4];
							    	}
							    }


							    $vms_cutoff_date = "";

							    $str_replace1 = str_replace( ',', '', $_POST["amount"][$i]);
							    if($c_code.$b_code == "0301" || $c_code.$b_code == "0201") // Cx Edit: Aug 23 19: Placed "" inbetween the condition target
							    {
									if(floatval($str_replace1) >= 30.00)
									{
										$date_day =  date('d', strtotime($_POST["date"][$i]));

										$vio_1 = array("9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23");
										$vio_2 = array("24", "25", "26", "27", "28", "29", "30", "31");
										$vio_3 = array("1", "2", "3", "4", "5", "6", "7", "8");

										if(in_array($date_day, $vio_1))
										{
											$M =  date('m', strtotime($_POST["date"][$i]));				
											$Y =  date('Y', strtotime($_POST["date"][$i]));

											$vms_cutoff_date = $M.'-'.'9'.'-'.$Y.' / '.$M.'-'.'23'.'-'.$Y;
										}
										elseif(in_array($date_day, $vio_2))
										{
											$M =  date('m', strtotime($_POST["date"][$i]));				
											$Y =  date('Y', strtotime($_POST["date"][$i]));

											$next_mos = date('Y-m-d', strtotime('+15 day', strtotime($_POST["date"][$i])));
											$NM =  date('m', strtotime($next_mos));				
											$NY =  date('Y', strtotime($next_mos));

											$vms_cutoff_date = $M.'-'.'24'.'-'.$Y.' / '.$NM.'-'.'8'.'-'.$NY;
										}
										elseif(in_array($date_day, $vio_3))
										{
											$M =  date('m', strtotime($_POST["date"][$i]));				
											$Y =  date('Y', strtotime($_POST["date"][$i]));

											$prev_mos = date('Y-m-d', strtotime('-15 day', strtotime($_POST["date"][$i])));
											$PM =  date('m', strtotime($prev_mos));				
											$PY =  date('Y', strtotime($prev_mos));

											$vms_cutoff_date = $PM.'-'.'24'.'-'.$PY.' / '.$M.'-'.'8'.'-'.$Y;
										}
									}
							    }
							    else
							    {
							    	
									    $float = str_replace(",", "", $_POST["amount"][$i]);  
										if(floatval($str_replace1) >= 30.00)
										{
											$date_day =  date('d', strtotime($_POST["date"][$i]));
											$vio_1 = range(1,15);
											$vio_2 = range(16,31);

											$last_day =  date('t', strtotime($_POST["date"][$i]));


											if(in_array($date_day, $vio_1))
											{
												$M =  date('m', strtotime($_POST["date"][$i]));				
												$Y =  date('Y', strtotime($_POST["date"][$i]));

												$vms_cutoff_date = $M.'-'.'1'.'-'.$Y.' / '.$M.'-'.'15'.'-'.$Y;
											}
											elseif(in_array($date_day, $vio_2))
											{
												$M =  date('m', strtotime($_POST["date"][$i]));				
												$Y =  date('Y', strtotime($_POST["date"][$i]));

												$next_mos = date('Y-m-d', strtotime('+15 day', strtotime($_POST["date"][$i])));
												$vms_cutoff_date = $M.'-'.'16'.'-'.$Y.' / '.$M.'-'.$last_day.'-'.$Y;
											}

										}

									// Cx Edit: Sep 19 2019

									
							    }

							    $cx_amount_shrt = str_replace( ',', '', $_POST["amount"][$i]);
								if ($c_code.$b_code.$d_code == "020301") {
									if ($type == "O" && $cx_amount_shrt < "30.00") {
										$vms_cutoff_date = "";
									}
								}
								
								

								$cs_array_data = array('emp_id'    	=> $_POST["emp_id"][$i],
							                      'sal_no'         	=> $date_infos->payroll_no,
							                      'emp_name'      	=> $date_infos->name,
							                      'emp_type'       	=> $date_infos->emp_type,
							                      'company_code'   	=> $c_code,
							                      'bunit_code'     	=> $b_code,
							                      'dept_code'      	=> $d_code,
							                      'section_code'   	=> $sec_code,
							                      'sub_section_code'=> $sub_sec_code,
							                      'amount_shrt'    	=> str_replace( ',', '', $_POST["amount"][$i]),
							                      'balance'      	=> $balance_amount,
							                      'date_shrt'      	=> date('Y-m-d', strtotime($_POST["date"][$i])),
							                      'type'           	=> $type,
							                      'cut_off_date'   	=> $ded_date,
							                      'vms_cutoff_date' => $vms_cutoff_date,
							                      'officer_id'     	=> $id,
							                      'date_time'      	=> date('Y-m-d H:i:s a')
								                   );

								// $get_dept = $this->main_model->get_dept_mod($date_infos->company_code.$date_infos->bunit_code.$date_infos->dept_code);
								// $get_bu = $this->main_model->get_bu_mod($date_infos->company_code.$date_infos->bunit_code);
							    $this->main_model->insert_data_to_cs_cebo($cs_array_data);

								$trans_no = $this->main_model->trans_no_mod($_POST["emp_id"][$i]);

								$cs_den_array_data = array('emp_id'      		=> $_POST["emp_id"][$i],
															'cs_data_id'   		=> $trans_no->id,
															'company_code'   	=> $c_code,
															'bunit_code'     	=> $b_code,
															'dept_code'      	=> $d_code,
															'section_code'   	=> $sec_code,
															'sub_sec_code'		=> $sub_sec_code,			                            
															'total_denomination'=> str_replace( ',', '', $_POST["den_total"][$i]),	                      
															'date_shrt'    		=> date('Y-m-d', strtotime($_POST["date"][$i])),	                      
															'officer_id'     	=> $id,
							                      			'date_time'      	=> date('Y-m-d H:i:s a')                     
										                   );

								$this->main_model->insert_data_to_cs_den($cs_den_array_data);

							
						


				    }
				  }
		  }
		  else
		  {
		  	//echo "Subordinates doesnt matched!";
			$blank_array[] = array(
								"error"           => 'Subordinates doesnt matched!', 
					        	); 
		  }
	  }
	  else
	  {
	  	  //echo "Incorrect Username/Password";
	  	  $blank_array[] = array(
								"error"           => 'Incorrect Username/Password', 
					        	); 
	  	  $emp_id_matched = "";
	  }



	  //$number = count($_POST["names"]);
	  echo json_encode($blank_array);
 }

 public function save_emp_data_con()
 {
  $this->load->model('main_model');

  $blank_array = array();
  $duplicate_array = array();

  $number = count($_POST["names"]);

  $limit_amt = $this->main_model->limit_amt_mod();

  for($i=0; $i<$number; $i++)
  {
  	$ded_date = '';
  	$balance_amount = '';
  	
   	if(trim($_POST["names"][$i] != ''))
    {
    	
    	$date_exist = $this->main_model->date_exist(date('Y-m-d', strtotime($_POST["date"][$i])), $_POST["emp_id"][$i]);

    	// if ($_SESSION['emp_id'] == "03998-2019") { // Cx Edit: Aug 24 19
    	// 	echo "Is Cx".$_SESSION['emp_id'];
    	// 	$date_exist = "";
    	// }
    	// 	else{
    	// 		echo "Not Cx".$_SESSION['emp_id'];
    	// 		$date_exist = $this->main_model->date_exist(date('Y-m-d', strtotime($_POST["date"][$i])), $_POST["emp_id"][$i]);
    	// 	}

			if(trim($_POST["den_total"][$i]) == "0.00")
			{
			$blank_array[] = array("index"        => $i, 
					        	"error"           => 'blank', 
					        	"emp_id"          => $_POST["emp_id"][$i], 
					        	"names"           => $_POST["names"][$i], 
					        	"dept"            => $_POST["dept"][$i],				        
					        	"den_total"       => $_POST["den_total"][$i],
					        	"amount"       	  => $_POST["amount"][$i],
					        	"date"     		  => $_POST["date"][$i],
					        	"types"    		  => $_POST["type"][$i],
					        	"input_br"    	  => $_POST["input_br"][$i],
					        	"hidden_input_br" => $_POST["hidden_input_br"][$i],
					        	);        	
			}
			else
			{
				if(empty($date_exist))
    			{
				    $date_infos 	= $this->main_model->get_emp_info($_POST["emp_id"][$i]);	        
				    $dcode      	= $date_infos->company_code.$date_infos->bunit_code.$date_infos->dept_code;
				    // $this->session->userdata( 	= $thi)->nativesession->get('user', 'id');
				    $id         	= $_SESSION['emp_id'];
				    $type 			= '';
				    $status  		= '';
				    $amount_balance = '';


				    $deduction_date = '';

					 $day30 =  date('d', strtotime($_POST["date"][$i]));

					 $days30 = array("6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20");

					 if($date_infos->company_code.$date_infos->bunit_code == '0203' || $date_infos->company_code.$date_infos->bunit_code == '0223')
					 {
						if (in_array($day30, $days30))
						{
							$month =  date('m', strtotime($_POST["date"][$i]));

							if($month == 12)
							{
								$month =  date('m', strtotime($_POST["date"][$i]));
								$year  =  date('Y', strtotime($_POST["date"][$i]));
								$month = $month + 1;
								$year += 1;
								$deduction_date = $year.'-'.'01'.'-'.'05';
							}
							else
							{
								$month =  date('m', strtotime($_POST["date"][$i]));
								$year  =  date('Y', strtotime($_POST["date"][$i]));
								$month = $month + 1;
								$deduction_date = $year.'-'.$month.'-'.'05';
							}
						}
						else
						{
							$month =  date('m', strtotime($_POST["date"][$i]));

							if($month == 12)
							{
								$dec_day = array("21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");

								$day15_1 =  date('d', strtotime($_POST["date"][$i]));

								if(in_array($day15_1, $dec_day))
								{
									$m =  date('m', strtotime($_POST["date"][$i]));
									$year  =  date('Y', strtotime($_POST["date"][$i]));
									$month = $m + 1;
									$years = $year + 1;
									$deduction_date = $years.'-'.'01'.'-'.'20';
								}
								else
								{
									$month =  date('m', strtotime($_POST["date"][$i]));
									$year  =  date('Y', strtotime($_POST["date"][$i]));				
									$deduction_date = $year.'-'.$month.'-'.'20';
								}
							}
							else
							{
								$days15_1 = array("21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");

								$day15_1 =  date('d', strtotime($_POST["date"][$i]));

								if(in_array($day15_1, $days15_1))
								{
									$m =  date('m', strtotime($_POST["date"][$i]));
									$year  =  date('Y', strtotime($_POST["date"][$i]));
									$month = $m + 1;
									$deduction_date = $year.'-'.$month.'-'.'20';
								}
								else
								{
									$month =  date('m', strtotime($_POST["date"][$i]));
									$year  =  date('Y', strtotime($_POST["date"][$i]));				
									$deduction_date = $year.'-'.$month.'-'.'20';
								}
							}
						}
					 }
					 else
					 {
						if (in_array($day30, $days30))
						{
							$month =  date('m', strtotime($_POST["date"][$i]));
							$year  =  date('Y', strtotime($_POST["date"][$i]));
							if($month == '2')
							{
								$deduction_date = $year.'-'.$month.'-'.'28';
							}
							else
							{
								$deduction_date = $year.'-'.$month.'-'.'30';
							}	
						}
						else
						{
							$month =  date('m', strtotime($_POST["date"][$i]));

							if($month == 12)
							{
								$dec_day = array("21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");

								$day15_1 =  date('d', strtotime($_POST["date"][$i]));

								if(in_array($day15_1, $dec_day))
								{
									$m =  date('m', strtotime($_POST["date"][$i]));
									$year  =  date('Y', strtotime($_POST["date"][$i]));
									$month = $m + 1;
									$years = $year + 1;
									$deduction_date = $years.'-'.'01'.'-'.'15';
								}
								else
								{
									$month =  date('m', strtotime($_POST["date"][$i]));
									$year  =  date('Y', strtotime($_POST["date"][$i]));				
									$deduction_date = $year.'-'.$month.'-'.'15';
								}
							}
							else
							{
								$days15_1 = array("21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");

								$day15_1 =  date('d', strtotime($_POST["date"][$i]));

								if(in_array($day15_1, $days15_1))
								{
									$m =  date('m', strtotime($_POST["date"][$i]));
									$year  =  date('Y', strtotime($_POST["date"][$i]));
									$month = $m + 1;  
									$deduction_date = $year.'-'.$month.'-'.'15';
								}
								else
								{
									$month =  date('m', strtotime($_POST["date"][$i]));
									$year  =  date('Y', strtotime($_POST["date"][$i]));				
									$deduction_date = $year.'-'.$month.'-'.'15';
								}
							}
						}
					 }



				    if($_POST["type"][$i] == 'S')
				    {	          
				    
				    $str_replace = str_replace( ',', '', $_POST["amount"][$i]);
				      if(floatval($str_replace) < $limit_amt->limit_amount)
				      {
				      	$type 			= 'S';
				      	$ded_date = "";
				      	$balance_amount = "";
				      }
				      else
				      {	       
				      	$type 			= 'S';
				    	$status  		= 'unpaid';
				    	$amount_balance = str_replace( ',', '', $_POST["amount"][$i]);
				    	$balance_amount = str_replace( ',', '', $_POST["amount"][$i]);
				    	$ded_date = $deduction_date;
				      }
				    }
				    elseif($_POST["type"][$i] == 'O')
				    {
				    	$type = 'O';
				    	$ded_date = "";	           
				    	$balance_amount = "";	           
				    }
				    else
				    {
				    	$type = 'PF';	
				    	$ded_date = "";
				    	$balance_amount = "";
				    }	

				    $c_code = "";
				    $b_code = "";
				    $d_code = "";
				    $sec_code = "";
				    $sub_sec_code = "";


				    if($_POST["input_br"][$i] == "")
				    {
				    	$c_code = $date_infos->company_code;
				        $b_code = $date_infos->bunit_code;
				        $d_code = $date_infos->dept_code;
				        $sec_code = $date_infos->section_code;
				        $sub_sec_code = $date_infos->sub_section_code;
				    }
				    else
				    {
				    	$section_option = explode("-", $_POST["hidden_input_br"][$i]);

				    	if(count($section_option) == 3)
				    	{
							$c_code = $section_option[0];
							$b_code = $section_option[1];
							$d_code = $section_option[2];
					  		
				    	}
				    	elseif(count($section_option) == 4)
				    	{
				    		$c_code = $section_option[0];
					        $b_code = $section_option[1];
					        $d_code = $section_option[2];
					        $sec_code = $section_option[3];		
				    	}
				    	else
				    	{
				    		$c_code = $section_option[0];
					        $b_code = $section_option[1];
					        $d_code = $section_option[2];
					        $sec_code = $section_option[3];			       
					        $sub_sec_code = $section_option[4];
				    	}
				    }


				    $vms_cutoff_date = "";

				    $str_replace1 = str_replace( ',', '', $_POST["amount"][$i]);
				    if($c_code.$b_code == "0301" || $c_code.$b_code == "0201") // Cx Edit: Aug 23 19: Placed "" inbetween the condition target
				    {
						if(floatval($str_replace1) >= 30.00)
						{
							$date_day =  date('d', strtotime($_POST["date"][$i]));

							$vio_1 = array("9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23");
							$vio_2 = array("24", "25", "26", "27", "28", "29", "30", "31");
							$vio_3 = array("1", "2", "3", "4", "5", "6", "7", "8");

							if(in_array($date_day, $vio_1))
							{
								$M =  date('m', strtotime($_POST["date"][$i]));				
								$Y =  date('Y', strtotime($_POST["date"][$i]));

								$vms_cutoff_date = $M.'-'.'9'.'-'.$Y.' / '.$M.'-'.'23'.'-'.$Y;
							}
							elseif(in_array($date_day, $vio_2))
							{
								$M =  date('m', strtotime($_POST["date"][$i]));				
								$Y =  date('Y', strtotime($_POST["date"][$i]));

								$next_mos = date('Y-m-d', strtotime('+15 day', strtotime($_POST["date"][$i])));
								$NM =  date('m', strtotime($next_mos));				
								$NY =  date('Y', strtotime($next_mos));

								$vms_cutoff_date = $M.'-'.'24'.'-'.$Y.' / '.$NM.'-'.'8'.'-'.$NY;
							}
							elseif(in_array($date_day, $vio_3))
							{
								$M =  date('m', strtotime($_POST["date"][$i]));				
								$Y =  date('Y', strtotime($_POST["date"][$i]));

								$prev_mos = date('Y-m-d', strtotime('-15 day', strtotime($_POST["date"][$i])));
								$PM =  date('m', strtotime($prev_mos));				
								$PY =  date('Y', strtotime($prev_mos));

								$vms_cutoff_date = $PM.'-'.'24'.'-'.$PY.' / '.$M.'-'.'8'.'-'.$Y;
							}
						}
				    }
				    else
				    {
				    	
						    $float = str_replace(",", "", $_POST["amount"][$i]);  
							if(floatval($str_replace1) >= 30.00)
							{
								$date_day =  date('d', strtotime($_POST["date"][$i]));
								$vio_1 = range(1,15);
								$vio_2 = range(16,31);

								$last_day =  date('t', strtotime($_POST["date"][$i]));
								// $vio_1 = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15");
								// $vio_2 = array("16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");
								// $vio_1 = array("9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23");
								// $vio_2 = array("24", "25", "26", "27", "28", "29", "30", "31");
								// $vio_3 = array("1", "2", "3", "4", "5", "6", "7", "8");

								if(in_array($date_day, $vio_1))
								{
									$M =  date('m', strtotime($_POST["date"][$i]));				
									$Y =  date('Y', strtotime($_POST["date"][$i]));
									/// Cx Edit: August 7 2019: Changed from: 9 - 23 into 1 - 15
									$vms_cutoff_date = $M.'-'.'1'.'-'.$Y.' / '.$M.'-'.'15'.'-'.$Y;
								}
								elseif(in_array($date_day, $vio_2))
								{
									$M =  date('m', strtotime($_POST["date"][$i]));				
									$Y =  date('Y', strtotime($_POST["date"][$i]));

									$next_mos = date('Y-m-d', strtotime('+15 day', strtotime($_POST["date"][$i])));
									//$NM =  date('m', strtotime($next_mos));				
									//$NY =  date('Y', strtotime($next_mos));
									/// Cx Edit: August 7 2019: Changed from: 24 - 8 into 16 - 30
									//$vms_cutoff_date = $M.'-'.'16'.'-'.$Y.' / '.$NM.'-'.$last_day.'-'.$NY;

									//  Cx Edit: Aug 23 19 vv
									$vms_cutoff_date = $M.'-'.'16'.'-'.$Y.' / '.$M.'-'.$last_day.'-'.$Y;
								}
								// elseif(in_array($date_day, $vio_3))
								// {
								// 	$M =  date('m', strtotime($_POST["date"][$i]));				
								// 	$Y =  date('Y', strtotime($_POST["date"][$i]));

								// 	$prev_mos = date('Y-m-d', strtotime('-15 day', strtotime($_POST["date"][$i])));
								// 	$PM =  date('m', strtotime($prev_mos));				
								// 	$PY =  date('Y', strtotime($prev_mos));
								// 	/// August 7 2019: Changed from: 24 - 8 into 16 - 30
								// 	$vms_cutoff_date = $PM.'-'.'16'.'-'.$PY.' / '.$M.'-'.'30'.'-'.$Y;
								// }

							}

						// Cx Edit: Sep 19 2019

						
				    }

				    $cx_amount_shrt = str_replace( ',', '', $_POST["amount"][$i]);
					if ($c_code.$b_code.$d_code == "020301") {
						if ($type == "O" && $cx_amount_shrt < "30.00") {
							$vms_cutoff_date = "";
						}
					}
					
					

					$cs_array_data = array('emp_id'    	=> $_POST["emp_id"][$i],
				                      'sal_no'         	=> $date_infos->payroll_no,
				                      'emp_name'      	=> $date_infos->name,
				                      'emp_type'       	=> $date_infos->emp_type,
				                      'company_code'   	=> $c_code,
				                      'bunit_code'     	=> $b_code,
				                      'dept_code'      	=> $d_code,
				                      'section_code'   	=> $sec_code,
				                      'sub_section_code'=> $sub_sec_code,
				                      'amount_shrt'    	=> str_replace( ',', '', $_POST["amount"][$i]),
				                      'balance'      	=> $balance_amount,
				                      'date_shrt'      	=> date('Y-m-d', strtotime($_POST["date"][$i])),
				                      'type'           	=> $type,
				                      'cut_off_date'   	=> $ded_date,
				                      'vms_cutoff_date' => $vms_cutoff_date,
				                      'officer_id'     	=> $id,
				                      'date_time'      	=> date('Y-m-d H:i:s a')
					                   );

					// $get_dept = $this->main_model->get_dept_mod($date_infos->company_code.$date_infos->bunit_code.$date_infos->dept_code);
					// $get_bu = $this->main_model->get_bu_mod($date_infos->company_code.$date_infos->bunit_code);
				    $this->main_model->insert_data_to_cs_cebo($cs_array_data);

					$trans_no = $this->main_model->trans_no_mod($_POST["emp_id"][$i]);

					$cs_den_array_data = array('emp_id'      		=> $_POST["emp_id"][$i],
												'cs_data_id'   		=> $trans_no->id,
												'company_code'   	=> $c_code,
												'bunit_code'     	=> $b_code,
												'dept_code'      	=> $d_code,
												'section_code'   	=> $sec_code,
												'sub_sec_code'		=> $sub_sec_code,			                            
												'total_denomination'=> str_replace( ',', '', $_POST["den_total"][$i]),	                      
												'date_shrt'    		=> date('Y-m-d', strtotime($_POST["date"][$i])),	                      
												'officer_id'     	=> $id,
				                      			'date_time'      	=> date('Y-m-d H:i:s a')                     
							                   );

					$this->main_model->insert_data_to_cs_den($cs_den_array_data);
				}
				else
				{
					$blank_array[] = array("index"        => $i, 
						        	"error"           => 'date', 
						        	"emp_id"          => $_POST["emp_id"][$i], 
						        	"names"           => $_POST["names"][$i], 
						        	"dept"            => $_POST["dept"][$i],				        
						        	"den_total"       => $_POST["den_total"][$i],
						        	"amount"       	  => $_POST["amount"][$i],
						        	"date"     		  => $_POST["date"][$i],
						        	"types"    		  => $_POST["type"][$i],
						        	"input_br"    	  => $_POST["input_br"][$i],
						        	"hidden_input_br" => $_POST["hidden_input_br"][$i],
						        	);    

				}
			}

    }
  }

  echo json_encode($blank_array);
 }

 //Denomination Query...
 public function cs_data_con()
 {
 	// $this->session->userdata(= $this-)nativesession->get('user', 'id');		
	$user_id  = $_SESSION['emp_id'];

	$dcode = $this->main_model->get_dcode1($user_id);

	$company_code = array();
	$bunit_code   = array();
	$dept_code 	  = array();
	$section_code = array();
	$sub_section_code = array();

	$group_code = array();

	foreach ($dcode as $key => $value) 
	{
		$group_code[] = $value['company_code'].$value['bunit_code'].$value['dept_code'].$value['section_code'].$value['sub_section_code'];

		$company_code[]  =  $value['company_code'];
		$bunit_code[] 	 =  $value['bunit_code'];
		$dept_code[]	 =  $value['dept_code'];
		$section_code[]  =  $value['section_code'];
		$sub_section_code[]  =  $value['sub_section_code'];
	}

	if($user_id == '04512-2016')
	{
		$data = $this->main_model->cs_data_mod1($company_code, $bunit_code, $dept_code, $section_code, $sub_section_code, $group_code);
	}
	else
	{		
 		$data = $this->main_model->cs_data_mod($group_code);
	}

 	$result = array('data' => array());

 	foreach ($data as $key => $value) 
 	{
 		$get_dept = $this->main_model->dept_mod($value['company_code'], $value['bunit_code'], $value['dept_code']);
 		$bu_name = $this->main_model->bu_name($value['company_code'].$value['bunit_code']);
 		$section_name = '';

 		if(!empty($value['section_code']))
 		{
 			$get_dept_model = $this->main_model->get_dept_model($value['company_code'].$value['bunit_code'].$value['dept_code'].$value['section_code']);
 			$section_name = ' '.$get_dept_model->section_name;
 		}

 		$result['data'][] = array(
 			$value['emp_name'], 
 			// $value['emp_name'], 
 			'[ '.$bu_name->acroname.' ] '.$get_dept->dept_name.$section_name, 
 			number_format($value['total_denomination'], 2), 
 			number_format($value['amount_shrt'], 2), 
 			$value['type'], date('m-d-Y', strtotime($value['date_shrt'])));
 	}

 	echo json_encode($result);
 }

 //Liquidation Deduction QUery...
 public function deduction_con()
 {
	// $this->session->userdata(= $this-)nativesession->get('user', 'id'); 
	$data['emp_id'] = $_SESSION['emp_id'];
	$data['username'] = $_SESSION['username'];

	$info = $this->main_model->info_mod($_SESSION['emp_id']);

	$data['photo_url'] =  $_SERVER['HTTP_HOST']."/hrms/" . substr($info->photo, 3);

	//Employee3 info...
	$emp_info = $this->main_model->get_emp_info($_SESSION['emp_id']);

	//$data['dept'] = 02-03-01
	$data['dept'] = $emp_info->company_code."-".$emp_info->bunit_code."-".$emp_info->dept_code;

	$data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();

	//Liquidation emp_id...
	$user_id  = $_SESSION['emp_id'];

	$dcode = $this->main_model->get_dcode1($user_id);
	//var_dump($dcode);

	$company_code = array();
	$bunit_code   = array();
	$dept_code 	  = array();
	$section_code = array();
	$sub_section_code = array();

	$group_code = array();

	foreach ($dcode as $key => $value) 
	{
		$group_code[] = $value['company_code'].$value['bunit_code'].$value['dept_code'].$value['section_code'].$value['sub_section_code'];
		$company_code[]  =  $value['company_code'];
		$bunit_code[] 	 =  $value['bunit_code'];
		$dept_code[]	 =  $value['dept_code'];
		$section_code[]  =  $value['section_code'];
		$sub_section_code[]  =  $value['sub_section_code'];
	}

	//var_dump($group_code);
	// var_dump($company_code);
	// var_dump($bunit_code);
	// var_dump($dept_code);
	// var_dump($section_code);
	// var_dump($sub_section_code);

	$data['deduction_date_data'] = $this->main_model->ae_get_setup_date($company_code, $bunit_code, $dept_code, $section_code, $sub_section_code, $group_code);
	// var_dump($data['deduction_date_data']);
	$this->load->view('deduction', $data);
 }

 public function deduction_table_con()
 {
	$deduction_date   = $this->input->post("deduction_date");

	if($deduction_date!='')
	{            
		$deduction_date = DateTime::createFromFormat('m-d-Y', $deduction_date)->format('Y-m-d');   
	}

	// $this->session->userdata(= $this-)nativesession->get('user', 'id'); 
	$user_id  = $_SESSION['emp_id'];

	$dcode = $this->main_model->get_dcode1($user_id);

	$company_code = array();
	$bunit_code   = array();
	$dept_code 	  = array();
	$section_code = array();
	$sub_section_code = array();
	$group_code = array();

	foreach ($dcode as $key => $value) 
	{
		$group_code[]  =  $value['company_code'].$value['bunit_code'].$value['dept_code'].$value['section_code'].$value['sub_section_code'];
		$company_code[]  =  $value['company_code'];
		$bunit_code[] 	 =  $value['bunit_code'];
		$dept_code[]	 =  $value['dept_code'];
		$section_code[]  =  $value['section_code'];
		$sub_section_code[]  =  $value['sub_section_code'];
	}


	$data = $this->main_model->deduction_table_mod($company_code, $bunit_code, $dept_code, $section_code, $deduction_date, $sub_section_code, $group_code);

	$result = array('data' => array());
	foreach ($data as $key => $value) 
	{
		$checkbox = "<label><input type='checkbox' name='check_box' id='check_box' class='check_box' value='".$value["emp_id"]."'><span></span></label>";  

		$button = '<a href="#" class="btn btn-link btn-xs" role="button" style="margin: 0; padding: 0px; color: #333;" onclick="details(\''.$value['emp_id'].'\', \''.date('m/d/Y', strtotime($deduction_date)).'\')"><span class="fa fa-bars fa-lg spn" aria-hidden="true" title="AMORTIZE"></span></a>';

		$section_name = "";

		$bu_name = $this->main_model->bu_name($value['company_code'].$value['bunit_code']);
		$dept = $this->main_model->dept_mod($value['company_code'], $value['bunit_code'], $value['dept_code']);

		if(!empty($value['section_code']))
 		{
 			$get_dept_model = $this->main_model->get_dept_model($value['company_code'].$value['bunit_code'].$value['dept_code'].$value['section_code']);
 			$section_name = ' '.$get_dept_model->section_name;
 		}


		$result['data'][] = array($checkbox, 
								$value['emp_name'], 
								'[ '.$bu_name->acroname.' ] '.$dept->dept_name.$section_name, 
								$value['amount_shrt'], 
								date('m-d-Y', strtotime($value['cut_off_date'])), 
								$button);
	}

	echo json_encode($result);
 }

 public function details_con()
 {
 	$emp_id = $_POST['emp_id'];
 	$deduction_date = DateTime::createFromFormat('m/d/Y', $_POST['deduction_date'])->format('Y-m-d');  

 	$data = $this->main_model->details_mod($emp_id, $deduction_date); 

 	$result = array('data' =>array());

 	foreach ($data as $key => $value) 
 	{
 		$result['data'][] = array(date('m-d-Y', strtotime($value['date_shrt'])), $value['amount_shrt']);
 	}

 	echo json_encode($result);
 }

 public function submit_ded_con()
 {
 	// $this->session->userdata(= $this-)nativesession->get('user', 'id');
    $officer_id  = $_SESSION['emp_id'];

    $this->load->model('main_model');     
  
    $deduction_date = DateTime::createFromFormat('m-d-Y', $_POST['deduction_date'])->format('Y-m-d'); 

    $size = count($_POST['check']);

    for ($i=0; $i <= $size - 1; $i++) 
    {
    	$data = $this->main_model->submit_ded_mod($_POST['check'][$i], $deduction_date);

    	foreach ($data as $key => $value) 
    	{
    		$liquidation_data = array('cs_liq_emp_id' 		=> $value['emp_id'],
    								'cs_liq_dcode' 			=> $value['company_code'].$value['bunit_code'].$value['dept_code'].$value['section_code'].$value['sub_section_code'],
    								'cs_liq_emp_type' 		=> $value['emp_type'],
    								'cs_liq_charge_amount'  => $value['amount_shrt'],
    								'cs_liq_charge_balance' => $value['amount_shrt'],
    								'cs_liq_date_shrt' 		=> $value['date_shrt'],
    								'cs_liq_ded_date' 		=> $value['cut_off_date'],
    								'cs_liq_acctg_status' 	=> 'pending',
    								'cs_liq_iad_status' 	=> 'pending',
    								'cs_liq_payroll_status' => 'pending',
    								'cs_liq_officer' 		=> $officer_id,
    								'cs_liq_officer_date' 	=> date('Y-m-d H:i:s'),
    								'cs_liq_data_id' 	    => $value['id'],
    								 );

    		$this->main_model->liquidation_data_insert($liquidation_data);

    		$this->main_model->cs_cebo_data_update($value['id'], $officer_id);
    	}
    }
 }

 public function deduction_for_con()
 {
 	// $this->session->userdata(= $this-)nativesession->get('user', 'id'); 
	$data['emp_id'] = $_SESSION['emp_id'];
	$data['username'] = $_SESSION['username'];

	$info = $this->main_model->info_mod($_SESSION['emp_id']);

	$data['photo_url'] =  $_SERVER['HTTP_HOST']."/hrms/" . substr($info->photo, 3);

	$data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();

	$this->load->view('deduction_forwarded', $data);
 }

 public function deduction_forwarded_table_con()
 { 	
	// $this->session->userdata(= $this-)nativesession->get('user', 'id'); 
	$user_id  = $_SESSION['emp_id'];

	$dcode = $this->main_model->get_dcode1($user_id);

	$company_code = array();
	$bunit_code   = array();
	$dept_code 	  = array();
	$section_code = array();
	$sub_section_code = array();
	$group_code = array();

	foreach ($dcode as $key => $value) 
	{
		$group_code[]  =  $value['company_code'].$value['bunit_code'].$value['dept_code'].$value['section_code'].$value['sub_section_code'];
		$company_code[]  =  $value['company_code'];
		$bunit_code[] 	 =  $value['bunit_code'];
		$dept_code[]	 =  $value['dept_code'];
		$section_code[]  =  $value['section_code'];
		$sub_section_code[]  =  $value['sub_section_code'];
	}

	$data = $this->main_model->deduction_forwarded_table_mod($company_code, $bunit_code, $dept_code, $section_code, $sub_section_code, $group_code);

	$result = array('data' => array());
	foreach ($data as $key => $value) 
	{
		$dept = $this->main_model->dept_mod($value['company_code'], $value['bunit_code'], $value['dept_code']);

		$off_name = $this->main_model->off_name_mod($value['acctg_officer_for']);

		$result['data'][] = array($value['emp_name'], $dept->dept_name, $value['amount_shrt'], date('m-d-Y', strtotime($value['date_shrt'])), date('m-d-Y', strtotime($value['cut_off_date'])), $off_name->name." / ". date('m-d-Y', strtotime($value['date_time'])));
	}
	// var_dump($data);
	echo json_encode($result);
 }

}