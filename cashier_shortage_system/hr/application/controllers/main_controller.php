<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller {


	public function __construct() 
	{
		parent::__construct();    
		$this->load->library('nativesession');   
		$this->load->model("main_model");  
		$this->load->helper('text');
	} 
	public function index()
	{
		$user_data = $this->nativesession->get('user', 'id'); 
		$data['emp_id'] = $user_data['emp_id'];
		$data['username'] = $user_data['username'];

		$info = $this->main_model->info_mod($user_data['emp_id']);

		$data['photo_url'] =  $_SERVER['HTTP_HOST']."/hrms/" . substr($info->photo, 3);

		$user = $this->main_model->user_mod($user_data['emp_id']);

		if(empty($user))
		{
			redirect('http://'.$_SERVER['HTTP_HOST'].'/EBS/supervisor/');   
		}
		else
		{
			$this->load->view('dashboard', $data);
		}

	}	

	public function system_demo()
	{
		$user_data = $this->nativesession->get('user', 'id'); 
		$data['emp_id'] = $user_data['emp_id'];
		$data['username'] = $user_data['username'];

		$info = $this->main_model->info_mod($user_data['emp_id']);

		$data['photo_url'] =  $_SERVER['HTTP_HOST']."/hrms/" . substr($info->photo, 3);

		$user = $this->main_model->user_mod($user_data['emp_id']);

	
		$this->load->view('demo', $data);
		
	}

	public function cashier_transaction()
	{
		$user_data = $this->nativesession->get('user', 'id'); 
		$data['emp_id'] = $user_data['emp_id'];
		$data['username'] = $user_data['username'];

		$info = $this->main_model->info_mod($user_data['emp_id']);

		$data['photo_url'] =  $_SERVER['HTTP_HOST']."/hrms/" . substr($info->photo, 3);

		$this->load->view('cashier_transaction', $data);
	}

	public function transaction_table_con()
	{
		$user_data = $this->nativesession->get('user', 'id');		
		$user_id  = $user_data['emp_id'];

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

		$data = $this->main_model->transaction_table_mod($company_code, $bunit_code, $dept_code, $section_code, $sub_section_code);

		$result = array('data' => array());

		foreach ($data as $key => $value) 
		{
			$button = '<a href="#" class="btn btn-link btn-xs" role="button" style="margin: 0; padding: 0px; color: #333;" onclick="trans_details(\''.$value['emp_id'].'\')"><span class="fa fa-bars fa-lg spn" aria-hidden="true"></span></a>';

			$dept = $this->main_model->dept_mod($value['company_code'], $value['bunit_code'], $value['dept_code']);


			$result['data'][] = array($value['emp_name'], $dept->dept_name, $button);
		}

		echo json_encode($result);
	}

	public function trans_details_con($emp_id)
	{
		// $emp_id = $_POST['emp_id'];

		$data = $this->main_model->trans_details_mod($emp_id);

		$result = array('data' => array());

		foreach ($data as $key => $value) 
		{
			$btn_edit = '<a href="#" class="btn btn-link btn-xs" role="button" style="margin: 0; padding: 0px; color: #333;" onclick="trans_edit(\''.$value['id'].'\')"><span class="fa fa-edit fa-lg spn" aria-hidden="true"></span></a>';

			$btn_delete = '<a href="#" class="btn btn-link btn-xs" role="button" style="margin: 0; padding: 0px; color: #333;" onclick="trans_delete(\''.$value['id'].'\')"><span class="fa fa-remove fa-lg spn" aria-hidden="true"></span></a>';

			$den_amt = $this->main_model->den_amt_mod($value['id']);

			$result['data'][] = array($value['emp_name'], 
				$value['type'], 
				number_format($value['amount_shrt'], 2), 
				number_format($den_amt->total_denomination, 2), 
				date('m-d-Y', strtotime($value['date_shrt'])), $btn_edit, $btn_delete);
		} 

		echo json_encode($result);
	}

	public function trans_delete_con()
	{
		$id = $_POST['id'];

		$user_data = $this->nativesession->get('user', 'id');		
		$user_id  = $user_data['emp_id'];

		$data_insert = array('cs_data_id' => $id, 'update_status' => 'deleted', 'officer_id' => $user_id, 'date_time' => date('Y-m-d H:i:s'));

		$this->main_model->tag_delete_cs_data($id);
		$this->main_model->tag_delete_cs_deno($id);
		$this->main_model->insert_history($data_insert);
	}

	public function trans_edit_con()
	{
		$id = $_POST['id'];

		$data = $this->main_model->trans_edit_mod($id);

		$dept = $this->main_model->dept_mod($data->company_code, $data->bunit_code, $data->dept_code);
		
		$section_name = "";
		if($data->section_code != "")
		{
			$section = $this->main_model->sec_mod($data->company_code, $data->bunit_code, $data->dept_code, $data->section_code);
			$section_name = $section->section_name;
		}
		else
		{
			$section_name = "";
		}

		$sub_section_name = "";
		if($data->sub_section_code != "")
		{
			$sub_section = $this->main_model->sub_sec_mod($data->company_code, $data->bunit_code, $data->dept_code, $data->section_code, $data->sub_section_code);
			$sub_section_name = $sub_section->sub_section_name;
		}
		else
		{
			$sub_section_name = "";
		}

		$data_array = array('id' 				 => $data->id,
							'emp_id' 			 => $data->emp_id,
							'emp_name' 			 => $data->emp_name,
							'amount_shrt' 		 => $data->amount_shrt,
							'total_denomination' => $data->total_denomination,
							'date_shrt' 		 => $data->date_shrt,
							'type' 				 => $data->type,
							'dept' 				 => substr($dept->dept_name,0,3)."-".substr($section_name,0,3).'-'.substr($sub_section_name,0,3),
							'code' 				 => $data->company_code.'-'.$data->bunit_code.'-'.$data->dept_code.'-'.$data->section_code.'-'.$data->sub_section_code,
		);

		echo json_encode($data_array);
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

	public function cs_update_con()
	{
		$id 			 = $this->input->post('h_id_edit');
		$emp_id 		 = $this->input->post('emp_id');
		$cs_amount_edit  = $this->input->post('cs_amount_edit');
		$den_amount_edit = $this->input->post('den_amount_edit');
		$date_shrt_edit  = $this->input->post('date_shrt_edit');
		$type_edit 		 = $this->input->post('type_edit');
		$borrow_edit  	 = $this->input->post('borrow_edit');

		$h_cs_amount_edit  = $this->input->post('h_cs_amount_edit');
		$h_den_amount_edit = $this->input->post('h_den_amount_edit');
		$h_date_shrt_edit  = $this->input->post('h_date_shrt_edit');
		$h_type_edit 	   = $this->input->post('h_type_edit');
		$h_borrow_edit 	   = $this->input->post('h_borrow_edit');
		$h_borrow_edit_org = $this->input->post('h_borrow_edit_org');


		$c_code = "";
		$b_code = "";
		$d_code = "";
		$sec_code = "";
		$sub_sec_code = "";

		if($h_borrow_edit == "")
        {
        	$c_code = $date_infos->company_code;
	        $b_code = $date_infos->bunit_code;
	        $d_code = $date_infos->dept_code;
	        $sec_code = $date_infos->section_code;
	        $sub_sec_code = $date_infos->sub_section_code;
        }
        else
        {
        	$section_option = explode("-", $h_borrow_edit);

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

		if($type_edit == 'S')
		{
			$limit_amt = $this->main_model->limit_amt_mod();

			if($cs_amount_edit >= $limit_amt->limit_amount)
			{
				$date_infos = $this->main_model->date_infos_mod($emp_id);

				$deduction_date = '';
				$ded_date = '';

				$day30 =  date('d', strtotime($date_shrt_edit));

				$days30 = array("6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20");

				if($date_infos->company_code.$date_infos->bunit_code == '0203')
				{
					if (in_array($day30, $days30))
					{
						$month =  date('m', strtotime($date_shrt_edit));

						if($month == 12)
						{
							$month =  date('m', strtotime($date_shrt_edit));
							$year  =  date('Y', strtotime($date_shrt_edit));
							$month = $month + 1;
							$year += 1;
							$deduction_date = $year.'-'.'01'.'-'.'05';
						}
						else
						{
							$month =  date('m', strtotime($date_shrt_edit));
							$year  =  date('Y', strtotime($date_shrt_edit));
							$month = $month + 1;
							$deduction_date = $year.'-'.$month.'-'.'05';
						}
					}
					else
					{
						$month =  date('m', strtotime($date_shrt_edit));

						if($month == 12)
						{
							$dec_day = array("21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");

							$day15_1 =  date('d', strtotime($date_shrt_edit));

							if(in_array($day15_1, $dec_day))
							{
								$m =  date('m', strtotime($date_shrt_edit));
								$year  =  date('Y', strtotime($date_shrt_edit));
								$month = $m + 1;
								$years = $year + 1;
								$deduction_date = $years.'-'.'01'.'-'.'20';
							}
							else
							{
								$month =  date('m', strtotime($date_shrt_edit));
								$year  =  date('Y', strtotime($date_shrt_edit));				
								$deduction_date = $year.'-'.$month.'-'.'20';
							}
						}
						else
						{
							$days15_1 = array("21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");

							$day15_1 =  date('d', strtotime($date_shrt_edit));

							if(in_array($day15_1, $days15_1))
							{
								$m =  date('m', strtotime($date_shrt_edit));
								$year  =  date('Y', strtotime($date_shrt_edit));
								$month = $m + 1;
								$deduction_date = $year.'-'.$month.'-'.'20';
							}
							else
							{
								$month =  date('m', strtotime($date_shrt_edit));
								$year  =  date('Y', strtotime($date_shrt_edit));				
								$deduction_date = $year.'-'.$month.'-'.'20';
							}
						}
					}
				}
				else
				{
					if (in_array($day30, $days30))
					{
						$month =  date('m', strtotime($date_shrt_edit));
						$year  =  date('Y', strtotime($date_shrt_edit));
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
						$month =  date('m', strtotime($date_shrt_edit));

						if($month == 12)
						{
							$dec_day = array("21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");

							$day15_1 =  date('d', strtotime($date_shrt_edit));

							if(in_array($day15_1, $dec_day))
							{
								$m =  date('m', strtotime($date_shrt_edit));
								$year  =  date('Y', strtotime($date_shrt_edit));
								$month = $m + 1;
								$years = $year + 1;
								$deduction_date = $years.'-'.'01'.'-'.'15';
							}
							else
							{
								$month =  date('m', strtotime($date_shrt_edit));
								$year  =  date('Y', strtotime($date_shrt_edit));				
								$deduction_date = $year.'-'.$month.'-'.'15';
							}
						}
						else
						{
							$days15_1 = array("21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");

							$day15_1 =  date('d', strtotime($date_shrt_edit));

							if(in_array($day15_1, $days15_1))
							{
								$m =  date('m', strtotime($date_shrt_edit));
								$year  =  date('Y', strtotime($date_shrt_edit));
								$month = $m + 1;  
								$deduction_date = $year.'-'.$month.'-'.'15';
							}
							else
							{
								$month =  date('m', strtotime($date_shrt_edit));
								$year  =  date('Y', strtotime($date_shrt_edit));				
								$deduction_date = $year.'-'.$month.'-'.'15';
							}
						}
					}
				}

				$cs_data_update = array('company_code'    => $c_code,
										'bunit_code' 	  => $b_code,
										'dept_code' 	  => $d_code,
										'section_code'    => $sec_code,
										'sub_section_code'=> $sub_sec_code,
										'amount_shrt'     => $cs_amount_edit,
										'date_shrt' 	  => $date_shrt_edit,
										'type' 			  => $type_edit,
										'cut_off_date' 	  => $deduction_date,
									);

				$this->main_model->cs_update_mod($id, $cs_data_update);
			}
			else
			{
				$cs_data_update = array('company_code'    => $c_code,
										'bunit_code' 	  => $b_code,
										'dept_code' 	  => $d_code,
										'section_code'    => $sec_code,
										'sub_section_code'=> $sub_sec_code,
										'amount_shrt'     => $cs_amount_edit,
										'date_shrt' 	  => $date_shrt_edit,
										'type' 			  => $type_edit,
										'cut_off_date' 	  => '',										
									);

				$this->main_model->cs_update_mod($id, $cs_data_update);
			}
		}
		elseif($type_edit == 'O' || $type_edit == 'PF')
		{
			$cs_data_update = array('company_code'    => $c_code,
									'bunit_code' 	  => $b_code,
									'dept_code' 	  => $d_code,
									'section_code'    => $sec_code,
									'sub_section_code'=> $sub_sec_code,
									'amount_shrt'     => $cs_amount_edit,
									'date_shrt' 	  => $date_shrt_edit,
									'type' 			  => $type_edit,
									'cut_off_date' 	  => '',										
									);

			$this->main_model->cs_update_mod($id, $cs_data_update);
		}


		$denomination_data = array('company_code'     	 => $c_code,
									'bunit_code' 	  	 => $b_code,
									'dept_code' 	  	 => $d_code,
									'section_code'    	 => $sec_code,
									'sub_sec_code'       => $sub_sec_code,
									'total_denomination' => $den_amount_edit,
									'date_shrt' 	  	 => $date_shrt_edit,																		
									);

		$this->main_model->denomination_mod($id, $denomination_data);


		$user_data = $this->nativesession->get('user', 'id');		
		$user_id  = $user_data['emp_id'];

		$cs_history = array('cs_data_id'     	 => $id,
							'amount_shrt_edit' 	 => $cs_amount_edit,
							'den_amt_edit'       => $den_amount_edit,
							'date_shrt_edit' 	 => $date_shrt_edit,																		
							'type_edit' 	  	 => $type_edit,																		
							'code_edit' 	  	 => $h_borrow_edit,	
							'amount_shrt_orig' 	 => $h_cs_amount_edit,
							'den_amt_orig'    	 => $h_den_amount_edit,
							'date_shrt_orig' 	 => $h_date_shrt_edit,
							'type_orig' 	  	 => $h_type_edit,																		
							'code_orig' 	  	 => $h_borrow_edit_org,																
							'update_status' 	 => 'updated',																		
							'officer_id' 	  	 => $user_id,																		
							'date_time' 	  	 => date('Y-m-d H:i:s'),																		
							);

		$this->main_model->insert_history($cs_history);
	}

	public function cashier_violation()
	{
		$user_data = $this->nativesession->get('user', 'id'); 
		$data['emp_id'] = $user_data['emp_id'];
		$data['username'] = $user_data['username'];

		$info = $this->main_model->info_mod($user_data['emp_id']);

		$data['photo_url'] =  $_SERVER['HTTP_HOST']."/hrms/" . substr($info->photo, 3);


		$dcode = $this->main_model->get_dcode1($user_data['emp_id']);

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

		$data['vio_cutoff'] = $this->main_model->vio_cutoff_mod($company_code, $bunit_code, $dept_code, $section_code, $sub_section_code);

		$this->load->view('cashier_violation', $data);
	}

	public function violation_table_con()
	{
		$user_data = $this->nativesession->get('user', 'id');		
		$user_id  = $user_data['emp_id'];

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

		$limit_amt = $this->main_model->limit_amt_mod();

		$data = $this->main_model->violation_table_mod($company_code, $bunit_code, $dept_code, $section_code, $limit_amt->limit_amount, $sub_section_code);

		$result = array('data' => array());

		foreach($data as $key => $value) 
		{
			$checkbox = "<label><input type='checkbox' name='check_box' id='check_box' class='check_box' value='".$value["id"]."'><span></span></label>";

			$dept = $this->main_model->dept_mod($value['company_code'], $value['bunit_code'], $value['dept_code']);

			$result['data'][] = array($checkbox,
									$value['emp_name'], 
									$dept->dept_name, 
									number_format($value['amount_shrt'], 2), 
									$value['type'], 
									date('m-d-Y', strtotime($value['date_shrt']))
			);
		}

		echo json_encode($result);
	}

	public function submit_violation_con()
	{
		$user_data = $this->nativesession->get('user', 'id');		
		$user_id  = $user_data['emp_id'];

		$size = count($_POST['check']);

		for($i=0; $i <= $size - 1; $i++) 
		{
			$data = $this->main_model->cebo_violation_data($_POST['check'][$i]);

			$type = "";

			if($data->type == 'S')
			{
				$type = "short";
			}
			else
			{
				$type = "over";
			}

			$negli_data = array('empId' 	   => $data->emp_id,
								'date_offense' => $data->date_shrt,
								'type' 		   => $type,
								'amount'       => $data->amount_shrt,
								'cancelStat'   => 0,
								'cs_data_id'   => $_POST['check'][$i],
								'sup_id' 	   => $user_id,
								'date_time'    => date('Y-m-d H:i:s')
								);

			$check_data = $this->main_model->check_data_mod($_POST['check'][$i]);

			if(empty($check_data))
			{
				$this->main_model->insert_negli($negli_data);
				$this->main_model->update_cs_data($_POST['check'][$i], $user_id);
			}
		}
	}

	public function log_out()
	{       
		redirect('http://'.$_SERVER['HTTP_HOST'].'/hrms/employee/');     
	}

	public function old_system()
	{       
		redirect('http://'.$_SERVER['HTTP_HOST'].'/ebs/supervisor/template/cashier_shortage_supervisor');     
	}

	public function cashier_violation_forwarded()
	{
		$user_data = $this->nativesession->get('user', 'id'); 
		$data['emp_id'] = $user_data['emp_id'];
		$data['username'] = $user_data['username'];

		$info = $this->main_model->info_mod($user_data['emp_id']);

		$data['photo_url'] =  $_SERVER['HTTP_HOST']."/hrms/" . substr($info->photo, 3);

		$this->load->view('cashier_violation_forwarded', $data);
	}

	public function violation_table_forwarded_con()
	{
		$user_data = $this->nativesession->get('user', 'id');		
		$user_id  = $user_data['emp_id'];

		$dcode = $this->main_model->get_dcode1($user_id);

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

		$data = $this->main_model->violation_table_forwarded_mod($company_code, $bunit_code, $dept_code, $section_code, $sub_section_code);

		$result = array('data' => array());

		foreach ($data as $key => $value) 
		{
			$dept = $this->main_model->dept_mod($value['company_code'], $value['bunit_code'], $value['dept_code']);
			$name = $this->main_model->date_infos_mod($value['vms_officer_for']);

			$button = '<a href="#" class="btn btn-link btn-xs" role="button" style="margin: 0; padding: 0px; color: #333;" onclick="cancel_violation(\''.$value['id'].'\')"><span class="fa fa-remove fa-lg spn" aria-hidden="true"></span></a>';


			$result['data'][] = array($value['emp_name'], 
				$dept->dept_name, 
				$value['amount_shrt'], 
				$value['type'], 
				date('m-d-Y', strtotime($value['date_shrt'])), 
				$name->name." / ".date('m-d-Y', strtotime($value['vms_date_time'])), 
				$button
			);
		}
		echo json_encode($result);
	}

	public function cancel_violation_con()
	{
		$user_data = $this->nativesession->get('user', 'id');		
		$user_id  = $user_data['emp_id'];

		$id = $_POST['id'];
		$reason = $_POST['reason'];

		$this->main_model->cancel_vio_cs_data($id, $user_id);
		$this->main_model->cancel_vio_negli($id);

		$negli_data = $this->main_model->negli_data_mod($id);

		$short_over = $this->main_model->short_over_mod($negli_data->id);

		$off_can_data = array('violationId' => '29', 
                        'empId'       => $short_over->empId, 
                        'offenseId'   => $short_over->offenseId, 
                        'dateRange'   => $short_over->dateRange, 
                        'requestBy'   => $user_id,
                        'requestOn'   => date("Y-m-d h:i:s"),
                        'details'     => $reason,
                        'status'      => '0'                             
                      );

		$this->main_model->insert_off_cancel($off_can_data);

		$this->main_model->update_vsm($negli_data->id);
		
	}

	public function violation_table_cons()
	{
		$cut = $this->input->post("vio_cutoff_date");

		$from = "";
		$to = "";

		if($cut != '')
		{            
			$vio_cutoff_date =  explode("/", $cut);
			$from = DateTime::createFromFormat('m-d-Y', trim($vio_cutoff_date[0]))->format('Y-m-d');     
			$to = DateTime::createFromFormat('m-d-Y', trim($vio_cutoff_date[1]))->format('Y-m-d');   
		}	


		$user_data = $this->nativesession->get('user', 'id');		
		$user_id  = $user_data['emp_id'];

		$dcode = $this->main_model->get_dcode1($user_id);

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

		
		$limit_amt = $this->main_model->limit_amt_mod();  
// echo $limit_amt->limit_amount;

		$data = $this->main_model->violation_table_mods($company_code, $bunit_code, $dept_code, $section_code, $sub_section_code, $limit_amt->limit_amount, $from, $to);


		$result = array('data' => array());

		foreach ($data as $key => $value) 
		{
			$checkbox = "<label><input type='checkbox' name='check_box' id='check_box' class='check_box' value='".$value["id"]."'><span></span></label>";

			$dept = $this->main_model->dept_mod($value['company_code'], $value['bunit_code'], $value['dept_code']);

			$result['data'][] = array($checkbox,
									$value['emp_name'], 
									$dept->dept_name, 
									number_format($value['amount_shrt'], 2), 
									$value['type'], 
									date('m-d-Y', strtotime($value['date_shrt']))
			);
		}

		echo json_encode($result);
	}

}