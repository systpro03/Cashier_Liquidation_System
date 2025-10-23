<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cashier_controller extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model("main_model");
		$this->load->model("cashier_model");
		$this->load->model("cfscashier_model");
		$this->load->model("liquidation_model");
		$this->load->helper('text');
	}

	public function cashier_dashboard_ctrl()
	{
		$data['emp_id'] = $_SESSION['emp_id'];
		// $data['username'] = $_SESSION['username'];
		
		$username = $this->cashier_model->get_username_model($_SESSION['emp_id']);
		$data['username'] = $username[0]['username'];
		// var_dump($username[0]['username']);

		if(empty($_SESSION['emp_id']))
		{
			redirect('http://'.$_SERVER['HTTP_HOST'].'/EBS/cebo_cs_liquidation/');
		}
		else
		{
			$info = $this->main_model->info_mod($_SESSION['emp_id']);

			$data['photo_url'] =  '';
			if(count($info) > 0){
				$data['photo_url'] =  $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
			}
			
			$this->load->view('cashier_side/cashier_dashboard', $data);
		}

	}

	public function cashier_cashform_ctrl()
	{
		
		$data['emp_id'] = $_SESSION['emp_id'];
		// $data['username'] = $_SESSION['username'];
		
		$username = $this->cashier_model->get_username_model($_SESSION['emp_id']);
		$data['username'] = $username[0]['username'];
		

		if(empty($_SESSION['emp_id']))
		{
			redirect('http://'.$_SERVER['HTTP_HOST'].'/EBS/cebo_cs_liquidation/'); 
		}
		else
		{
			$info = $this->main_model->info_mod($_SESSION['emp_id']);

			$data['photo_url'] =  '';
			if(count($info) > 0){
				$data['photo_url'] =  $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
			}
			
			$this->load->view('cashier_side/cashier_cashform', $data);
			$this->load->view('cashier_side/cash_confirmationmodal');
			$this->load->view('cashier_side/cashier_js');
		}
		
	}

	public function cashier_final_cashform_ctrl()
	{
		$data['emp_id'] = $_SESSION['emp_id'];
		// $data['username'] = $_SESSION['username'];
		
		$username = $this->cashier_model->get_username_model($_SESSION['emp_id']);
		$data['username'] = $username[0]['username'];
		

		if(empty($_SESSION['emp_id']))
		{
			redirect('http://'.$_SERVER['HTTP_HOST'].'/EBS/cebo_cs_liquidation/'); 
		}
		else
		{
			$info = $this->main_model->info_mod($_SESSION['emp_id']);
			
			$data['photo_url'] =  '';
			if(count($info) > 0){
				$data['photo_url'] =  $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
			}
			
			$this->load->view('cashier_side/cashier_final_cashform', $data);
			$this->load->view('cashier_side/cash_confirmationmodal');
			$this->load->view('cashier_side/cashier_js');
		}
	}

	public function cashier_history_ctrl()
	{
		
		$data['emp_id'] = $_SESSION['emp_id'];
		// $data['username'] = $_SESSION['username'];
		
		$username = $this->cashier_model->get_username_model($_SESSION['emp_id']);
		$data['username'] = $username[0]['username'];

		if(empty($_SESSION['emp_id']))
		{
			redirect('http://'.$_SERVER['HTTP_HOST'].'/EBS/cebo_cs_liquidation/');
		}
		else
		{
			$info = $this->main_model->info_mod($_SESSION['emp_id']);

			$data['photo_url'] =  '';
			if(count($info) > 0){
				$data['photo_url'] =  $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
			}
		
			$this->load->view('cashier_side/cashier_historyform_v3', $data);
			$this->load->view('cashier_side/hpartialdetails_modal');
			$this->load->view('cashier_side/history_edit_modal');
		}
		
	}

	public function cashier_previous_historyform_ctrl()
	{
		$data['emp_id'] = $_SESSION['emp_id'];
		// $data['username'] = $_SESSION['username'];
		
		$username = $this->cashier_model->get_username_model($_SESSION['emp_id']);
		$data['username'] = $username[0]['username'];

		if(empty($_SESSION['emp_id']))
		{
			redirect('http://'.$_SERVER['HTTP_HOST'].'/EBS/cebo_cs_liquidation/');
		}
		else
		{
			$info = $this->main_model->info_mod($_SESSION['emp_id']);

			$data['photo_url'] =  '';
			if(count($info) > 0){
				$data['photo_url'] =  $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
			}
		
			$this->load->view('cashier_side/previous_history', $data);
		}
	}

	public function cashier_noncashform_ctrl()
	{
		$data['emp_id'] = $_SESSION['emp_id'];
		// $data['username'] = $_SESSION['username'];
		
		$username = $this->cashier_model->get_username_model($_SESSION['emp_id']);
		$data['username'] = $username[0]['username'];

		if(empty($_SESSION['emp_id']))
		{
			redirect('http://'.$_SERVER['HTTP_HOST'].'/EBS/cebo_cs_liquidation/');
		}
		else
		{
			$info = $this->main_model->info_mod($_SESSION['emp_id']);

			$data['photo_url'] =  '';
			if(count($info) > 0){
				$data['photo_url'] =  $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
			}
			
			$this->load->view('cashier_side/cashier_noncashform_v3', $data);
			$this->load->view('cashier_side/noncash_confirmationmodal');
			$this->load->view('cashier_side/cashier_js');
		}
		
	}

	public function cash_denomination_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$save = "EXPIRED SESSION";
			echo json_encode($save);
		}
		else
		{
			$emp_id = $_SESSION['emp_id'];
			$emp_data = $this->cashier_model->get_empdata($emp_id);
			$sal_no = '';
			$emp_name = '';
			$emp_type = '';
			$company_code = '';
			$bunit_code = '';
			$dep_code = '';
			$section_code = '';
			$sub_section_code = '';
			$borrowed = 'NO';
			foreach ($emp_data as $d)
			{
				$sal_no = $d['payroll_no'];
				$emp_name = $d['name'];
				$emp_type = $d['emp_type'];
				$company_code = $d['company_code'];
				$bunit_code = $d['bunit_code'];
				$dep_code = $d['dept_code'];
				$section_code = $d['section_code'];
				$sub_section_code = $d['sub_section_code'];
			}

			$validated_trno = $this->cashier_model->validate_pending_cash_model($emp_id);
			if(!empty($validated_trno))
			{
				$message = 'DUPLICATE';
				echo json_encode($message);
			}
			else
			{
				$save = "success";
				$this->cashier_model->save_cashdenomination_model(
					$_POST['tr_no'],
					$emp_id,
					$sal_no,
					$emp_name,
					$emp_type,
					$company_code,
					$bunit_code,
					$dep_code,
					$section_code,
					$sub_section_code,
					$borrowed,
					$_POST['onek'],
					$_POST['fiveh'],
					$_POST['twoh'],
					$_POST['oneh'],
					$_POST['fifty'],
					$_POST['twenty'],
					$_POST['ten'],
					$_POST['five'],
					$_POST['one'],
					$_POST['twentyfivecents'],
					$_POST['tencents'],
					$_POST['fivecents'],
					$_POST['onecents'],
					$_POST['total_cash'],
					$_POST['remit_type'],
					$_POST['status'],
					$_POST['date'],
					$_POST['pos_name'],
					$_POST['counter_no']
				);
				echo json_encode($save);
			}
		}
	}

	public function cash_denomination_borrowed_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$save = "EXPIRED SESSION";
			echo json_encode($save);
		}
		else
		{
			$emp_id = $_SESSION['emp_id'];
			$emp_data = $this->cashier_model->get_empdata($emp_id);

			$sal_no = '';
			$emp_name = '';
			$emp_type = '';
			$company_code = '';
			$bunit_code = '';
			$dep_code = '';
			$section_code = $_POST['cash_section'];
			$sub_section_code = $_POST['cash_subsection'];
			$borrowed = 'YES';
		// =========================================================================
			$default_code = '';
			$inputed_code = '';
			$dfsection_code = '';
			$dfsub_section_code = '';
			
			foreach ($emp_data as $d)
			{
				$sal_no = $d['payroll_no'];
				$emp_name = $d['name'];
				$emp_type = $d['emp_type'];
				$company_code = $d['company_code'];
				$bunit_code = $d['bunit_code'];
				$dep_code = $d['dept_code'];
				$dfsection_code = $d['section_code'];
				$dfsub_section_code = $d['sub_section_code'];
			}

			$default_code = $company_code.$bunit_code.$dep_code.$dfsection_code.$dfsub_section_code;
			$inputed_code = $company_code.$bunit_code.$dep_code.$section_code.$sub_section_code;
			if($default_code == $inputed_code)
			{
				$message = "INVALID";
				echo json_encode($message);
			}
			else
			{
				$validated_trno = $this->cashier_model->validate_pending_cash_model($emp_id);
				if(!empty($validated_trno))
				{
					$message = 'DUPLICATE';
					echo json_encode($message);
				}
				else
				{
					$save = "success";
					$this->cashier_model->save_cashdenomination_model(
						$_POST['tr_no'],
						$emp_id,
						$sal_no,
						$emp_name,
						$emp_type,
						$company_code,
						$bunit_code,
						$dep_code,
						$section_code,
						$sub_section_code,
						$borrowed,
						$_POST['onek'],
						$_POST['fiveh'],
						$_POST['twoh'],
						$_POST['oneh'],
						$_POST['fifty'],
						$_POST['twenty'],
						$_POST['ten'],
						$_POST['five'],
						$_POST['one'],
						$_POST['twentyfivecents'],
						$_POST['tencents'],
						$_POST['fivecents'],
						$_POST['onecents'],
						$_POST['total_cash'],
						$_POST['remit_type'],
						$_POST['status'],
						$_POST['date'],
						$_POST['pos_name'],
						$_POST['counter_no']
					);
					echo json_encode($save);
				}
			}
		}
	}


	public function display_mop_ctrl()
	{
		$emp_id = $_SESSION['emp_id'];
		$query2=$this->cashier_model->display_mop_model_v2($emp_id);
		
		$html="";
		$mop_id  = '';
		foreach ($query2 as $q)
		{
			$mop_id.="+mop_".$q['id'];
			$html.='
					<tr>
						<td>
						<input type="text" class="input-sm mop_'.$q['id'].'" disabled id="mop_name" value="'.$q['mop_name'].'">
						</td>
						<td>
						<input type="number" min="0" class="input-sm dis quantity quantity_'.$q['id'].'  mop_'.$q['id'].' " id="'.$q['id'].'_q" placeholder="0">
						</td>
						<td>
						<input type="tel" onkeyup="total_noncash_js()" onchange="total_noncash_js()" style="font-size: 22px; text-align: center; height: 50px; width: 100%;" class="input-sm dis d_amount mop_'.$q['id'].'" id="'.$q['id'].'_a" placeholder="0.00" value="0.00">
						</td>
					</tr>

					<script>

						total_noncash_js();
	
						document.querySelector(".quantity_'.$q['id'].'").addEventListener("keypress", function (evt) {
							if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
							{
								evt.preventDefault();
							}
							});

		                $(".quantity").on("change keyup top press", function() {
		                  var sanitized = $(this).val().replace(/[^0-9]/g, "");
		                  $(this).val(sanitized);
		                });

					</script>

						';


		}

		$html.='
				<tr>
					<td style="float: right;">
					<button type="button" id="btn_reset_noncashform" style="height: 50px; width: 100px; font-size: 22px;" class="btn btn-primary waves-effect" onclick="reset_noncashform()">RESET</button>
					<button type="button" id="btn_save_noncashform" style="height: 50px; width: 120px; font-size: 22px;" class="btn btn-warning waves-effect" onclick="view_noncashconfimation_modal()">SUBMIT</button>
					</td>
					<td>
					<input type="text" class="input-sm" id="total_noncashtxt" disabled="" value="TOTAL NONCASH">
					</td>
					<td>
					<input type="text" class="input-sm" readonly disabled id="total_noncash" placeholder="0.00">
					</td>
				</tr>

				<script>
					$("#load_js").load("'.base_url().'noncash_js_route");
					$("#data").val("'.$mop_id.'");
				</script>
				';

		$trno = '';
		$get_trno = $this->cashier_model->get_nctrno_model($_SESSION['emp_id']);
		$new_trno = $this->cashier_model->get_new_trno_model();
		if(!empty($get_trno))
		{
			$trno = $get_trno->tr_no;
		}
		else
		{
			if(!empty($new_trno))
			{	
				$trno = $new_trno->tr_no+1;
			}
			else
			{
				$trno = 1;
			}
		}
		
		$data['trno']=$trno;    	   
		$data['html']=$html;    	   
		echo json_encode($data);
	}

	public function get_cash_trno_ctrl()
	{ 
		$current_date = date("Y-m-d");
		$emp_id = $_SESSION['emp_id'];
		$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
		$dcode = '';
		$scode = '';
		$sscode = '';
		$pos_name = '';
		$borrowed = '';
		if(!empty($assigned_counter_data))
		{
			foreach($assigned_counter_data as $assigned)
			{
				$dcode = $assigned['dcode'];
				$scode = $assigned['scode'];
				$sscode = $assigned['sscode'];
				$pos_name = $assigned['pos_name'];
				$borrowed = $assigned['borrowed'];
			}
		}
		// =========================================================================================================
		$sscode2 = '';
		if($borrowed == 'YES')
		{
			$sscode2 = $dcode.$scode.$sscode;
		}
		else
		{
			$emp_data = $this->cashier_model->get_empdata($emp_id);
			$company_code = '';
			$bunit_code = '';
			$dept_code = '';
			$section_code = '';
			$sub_section_code = '';
			foreach($emp_data as $data)
			{
				$company_code = $data['company_code'];
				$bunit_code = $data['bunit_code'];
				$dept_code = $data['dept_code'];
				$section_code = $data['section_code'];
				$sub_section_code = $data['sub_section_code'];
			}
			$sscode2 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
		}
		// ==========================================jay update v1.0=============================================================
		$cash_tr_no = '';
		$get_trno = $this->cashier_model->get_trno_model_v2($emp_id,$sscode2,$pos_name,$borrowed);
		$get_trno2 = $this->cashier_model->get_trno_model2_v2($emp_id,$sscode2,$pos_name,$borrowed);
		$new_trno = $this->cashier_model->get_new_trno_model();
		if(!empty($get_trno))
		{
			$cash_tr_no = $get_trno->tr_no;
		}
		else
		{
			if(!empty($get_trno2))
			{
				$cash_tr_no = $get_trno2->tr_no;
			}
			else
			{
				if(!empty($new_trno))
				{	
					$validate_new_trno = $this->cashier_model->validate_new_trno_model();
					if(!empty($validate_new_trno))
					{
						$cash_tr_no = $new_trno->tr_no;
						$noncash_tr_no = $validate_new_trno->tr_no * 1;
						if($noncash_tr_no > $cash_tr_no)
						{
							$cash_tr_no = $noncash_tr_no+1;
						}
						else
						{
							$cash_tr_no = $cash_tr_no+1;
						}
					}
					else
					{
						$cash_tr_no = $new_trno->tr_no + 1; 
					}
				}
				else
				{
					$cash_tr_no = 1;
				}
			}
		}
		  	   
		$data['trno']=$cash_tr_no;     	   
		echo json_encode($data);
	}

	public function get_noncash_trno_ctrl()
	{ 
		$current_date = date("Y-m-d");
		$emp_id = $_SESSION['emp_id'];
		$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
		$dcode = '';
		$scode = '';
		$sscode = '';
		$pos_name = '';
		$borrowed = '';
		if(!empty($assigned_counter_data))
		{
			foreach($assigned_counter_data as $assigned)
			{
				$dcode = $assigned['dcode'];
				$scode = $assigned['scode'];
				$sscode = $assigned['sscode'];
				$pos_name = $assigned['pos_name'];
				$borrowed = $assigned['borrowed'];
			}
		}
		// =========================================================================================================
		$sscode2 = '';
		if($borrowed == 'YES')
		{
			$sscode2 = $dcode.$scode.$sscode;
		}
		else
		{
			$emp_data = $this->cashier_model->get_empdata($emp_id);
			$company_code = '';
			$bunit_code = '';
			$dept_code = '';
			$section_code = '';
			$sub_section_code = '';
			foreach($emp_data as $data)
			{
				$company_code = $data['company_code'];
				$bunit_code = $data['bunit_code'];
				$dept_code = $data['dept_code'];
				$section_code = $data['section_code'];
				$sub_section_code = $data['sub_section_code'];
			}
			$sscode2 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
		}
		// ==========================================jay update v1.0=============================================================
		$trno = ''; 
		$get_trno = $this->cashier_model->get_nctrno_model_v2($emp_id,$sscode2,$pos_name,$borrowed);
		$get_nctrno_v1 = $this->cashier_model->get_trno_model2_v2($emp_id,$sscode2,$pos_name,$borrowed);
		$new_trno = $this->cashier_model->get_new_trno_model();
		if(!empty($get_trno))
		{
			$trno = $get_trno->tr_no;
		}
		else
		{
			if(!empty($get_nctrno_v1))
			{
				$trno = $get_nctrno_v1->tr_no;
			}
			else
			{
				if(!empty($new_trno))
				{	
					$validate_new_trno = $this->cashier_model->validate_new_trno_model();
					if(!empty($validate_new_trno))
					{
						$trno = $new_trno->tr_no;
						$noncash_tr_no = $validate_new_trno->tr_no * 1;
						if($noncash_tr_no > $trno)
						{
							$trno = $noncash_tr_no+1;
						}
						else
						{
							$trno = $trno+1;
						}
					}
					else
					{
						$trno = $new_trno->tr_no + 1;
					}
				}
				else
				{
					$trno = 1;
				}
			}
		}
		
		$data['trno']=$trno;     	   
		echo json_encode($data);
	}

	public function noncash_js_ctrl()
	{
		$this->load->view('cashier_side/noncash_js');
	}

	public function hnoncash_js_ctrl()
	{
		$this->load->view('cashier_side/hnoncash_js');
	}

	public function cashtable_history($onek,$fiveh,$twoh,$oneh,$fifty,$twenty,$ten,$five,$one,$twentyfive_cents,$ten_cents,$five_cents,$one_cents,$id)
	{
		$html='
			<tr>
				<td>
					<input type="text" class="input-sm" id="d_onek" disabled="" placeholder="₱1,000">
				</td>
				<td>
					<input type="number" min="0" class="input-sm quantity cash_quantity" id="q_onek" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" placeholder="0" value="'.$onek.'">
				</td>
				<td>
					<input type="text" class="input-sm d_amount" readonly="" id="a_onek" placeholder="0" value="0">
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="₱500">
				</td>
				<td>
					<input type="number" min="0" class="input-sm quantity1 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fiveh" placeholder="0" value="'.$fiveh.'">
				</td>
				<td>
					<input type="text" class="input-sm d_amount" readonly="" id="a_fiveh" placeholder="0" value="0">
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="₱200">
				</td>
				<td>
					<input type="number" min="0" class="input-sm quantity2 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twoh" placeholder="0" value="'.$twoh.'">
				</td>
				<td>
					<input type="text" class="input-sm d_amount" readonly="" id="a_twoh" placeholder="0" value="0">
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="₱100">
				</td>
				<td>
					<input type="number" min="0" class="input-sm quantity3 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_oneh" placeholder="0" value="'.$oneh.'">
				</td>
				<td>
					<input type="text" class="input-sm d_amount" readonly="" id="a_oneh" placeholder="0" value="0">
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="₱50">
				</td>
				<td>
					<input type="number" min="0" class="input-sm quantity4 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fifty" placeholder="0" value="'.$fifty.'">
				</td>
				<td>
					<input type="text" class="input-sm d_amount" readonly="" id="a_fifty" placeholder="0" value="0">
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="₱20">
				</td>
				<td>
					<input type="number" min="0" class="input-sm quantity5 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twenty" placeholder="0" value="'.$twenty.'">
				</td>
				<td>
					<input type="text" class="input-sm d_amount" readonly="" id="a_twenty" placeholder="0" value="0">
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" class="input-sm" id="d_ten" disabled="" placeholder="₱10">
				</td>
				<td>
					<input type="number" min="0" class="input-sm quantity6 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_ten" placeholder="0" value="'.$ten.'">
				</td>
				<td>
					<input type="text" class="input-sm d_amount" readonly="" id="a_ten" placeholder="0" value="0">
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" class="input-sm" id="d_five" disabled="" placeholder="₱5">
				</td>
				<td>
					<input type="number" min="0" class="input-sm quantity7 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_five" placeholder="0" value="'.$five.'">
				</td>
				<td>
					<input type="text" class="input-sm d_amount" readonly="" id="a_five" placeholder="0" value="0">
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" class="input-sm" id="d_one" disabled="" placeholder="₱1">
				</td>
				<td>
					<input type="number" min="0" class="input-sm quantity8 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_one" placeholder="0" value="'.$one.'">
				</td>
				<td>
					<input type="text" class="input-sm d_amount" readonly="" id="a_one" placeholder="0" value="0">
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" class="input-sm" id="d_twentyfivecents" disabled="" placeholder="₱0.25">
				</td>
				<td>
					<input type="number" min="0" class="input-sm quantity9 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twentyfivecents" placeholder="0" value="'.$twentyfive_cents.'">
				</td>
				<td>
					<input type="text" class="input-sm d_amount" readonly="" id="a_twentyfivecents" placeholder="0" value="0">
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" class="input-sm" id="d_tencents" disabled="" placeholder="₱0.10">
				</td>
				<td>
					<input type="number" min="0" class="input-sm quantity10 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_tencents" placeholder="0" value="'.$ten_cents.'">
				</td>
				<td>
					<input type="text" class="input-sm d_amount" readonly="" id="a_tencents" placeholder="0" value="0">
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" class="input-sm" id="d_fivecents" disabled="" placeholder="₱0.05">
				</td>
				<td>
					<input type="number" min="0" class="input-sm quantity11 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fivecents" placeholder="0" value="'.$five_cents.'">
				</td>
				<td>
					<input type="text" class="input-sm d_amount" readonly="" id="a_fivecents" placeholder="0" value="0">
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" class="input-sm" id="d_onecents" disabled="" placeholder="₱0.01">
				</td>
				<td>
					<input type="number" min="0" class="input-sm quantity12 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_onecents" placeholder="0" value="'.$one_cents.'">
				</td>
				<td>
					<input type="text" class="input-sm d_amount" readonly="" id="a_onecents" placeholder="0" value="0">
					<input type="number" min="0" hidden class="input-sm number" readonly="" id="history_cashform_id" placeholder="0" value="'.$id.'">
				</td>   
			</tr>


			<script>


			</script>

			';

		return $html;
	}

	public function displayhistory_cashform_ctrl()
	{
		$current_date = date("Y-m-d");
		$emp_id = $_SESSION['emp_id'];
		$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
		$dcode = '';
		$scode = '';
		$sscode = '';
		$pos_name = '';
		$borrowed = '';
		if(!empty($assigned_counter_data))
		{
			foreach($assigned_counter_data as $assigned)
			{
				$dcode = $assigned['dcode'];
				$scode = $assigned['scode'];
				$sscode = $assigned['sscode'];
				$pos_name = $assigned['pos_name'];
				$borrowed = $assigned['borrowed'];
			}
		}
		// =========================================================================================================
		$scode2 = '';
		$sscode2 = '';
		if($borrowed == 'YES')
		{
			$scode2 = $dcode.$scode;
			$sscode2 = $dcode.$scode.$sscode;
		}
		else
		{
			$emp_data = $this->cashier_model->get_empdata($emp_id);
			$company_code = '';
			$bunit_code = '';
			$dept_code = '';
			$section_code = '';
			$sub_section_code = '';
			foreach($emp_data as $data)
			{
				$company_code = $data['company_code'];
				$bunit_code = $data['bunit_code'];
				$dept_code = $data['dept_code'];
				$section_code = $data['section_code'];
				$sub_section_code = $data['sub_section_code'];
			}
			$scode2 = $company_code.$bunit_code.$dept_code.$section_code;
			$sscode2 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
		}
		// ===============================jay update v1.0============================================================
		if(!empty($assigned_counter_data))
		{
			$query2=$this->cashier_model->getpartialhistory_cashform_model_v2($emp_id,$sscode2,$pos_name,$borrowed);
			if(empty($query2))
			{
				$query=$this->cashier_model->displayhistory_cashform_model_v2($emp_id,$sscode2,$pos_name,$borrowed);
				if(!empty($query))
				{
					$html="";
					$edit_den = '';
					$edit_den_status = '';
					$edit_remittance_type = '';
					foreach ($query as $q)
					{
						$edit_den = $q['edit_denomination'];
						$edit_den_status = $q['edit_status_denomination'];
						$edit_remittance_type = $q['edit_remittance_type'];
						if($q['remit_type'] == 'PARTIAL')
						{
							$hide = 'hidden';
						}
						else
						{
							$hide = '';
						}
					
						$html.='
	
									<tr>
									<td>
										<input type="text" class="input-sm" id="d_onek" disabled="" placeholder="₱1,000">
									</td>
									<td>
										<input type="number" min="0" class="input-sm cash_quantity" id="q_onek" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" placeholder="0" value="'.$q['onek'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_onek" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="₱500">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity1 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fiveh" placeholder="0" value="'.$q['fiveh'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_fiveh" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="₱200">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity2 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twoh" placeholder="0" value="'.$q['twoh'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_twoh" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="₱100">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity3 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_oneh" placeholder="0" value="'.$q['oneh'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_oneh" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="₱50">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity4 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fifty" placeholder="0" value="'.$q['fifty'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_fifty" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="₱20">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity5 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twenty" placeholder="0" value="'.$q['twenty'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_twenty" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$hide.'>
									<td>
										<input type="text" class="input-sm" id="d_ten" disabled="" placeholder="₱10">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity6 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_ten" placeholder="0" value="'.$q['ten'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_ten" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$hide.'>
									<td>
										<input type="text" class="input-sm" id="d_five" disabled="" placeholder="₱5">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity7 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_five" placeholder="0" value="'.$q['five'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_five" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$hide.'>
									<td>
										<input type="text" class="input-sm" id="d_one" disabled="" placeholder="₱1">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity8 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_one" placeholder="0" value="'.$q['one'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_one" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$hide.'>
									<td>
										<input type="text" class="input-sm" id="d_twentyfivecents" disabled="" placeholder="₱0.25">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity9 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twentyfivecents" placeholder="0" value="'.$q['twentyfive_cents'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_twentyfivecents" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$hide.'>
									<td>
										<input type="text" class="input-sm" id="d_tencents" disabled="" placeholder="₱0.10">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity10 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_tencents" placeholder="0" value="'.$q['ten_cents'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_tencents" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$hide.'>
									<td>
										<input type="text" class="input-sm" id="d_fivecents" disabled="" placeholder="₱0.05">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity11 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fivecents" placeholder="0" value="'.$q['five_cents'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_fivecents" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$hide.'>
									<td>
										<input type="text" class="input-sm" id="d_onecents" disabled="" placeholder="₱0.01">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity12 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_onecents" placeholder="0" value="'.$q['one_cents'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_onecents" placeholder="0" value="0">
										<input type="number" min="0" hidden class="input-sm number" readonly="" id="history_cashform_id" placeholder="0" value="'.$q['id'].'">
									</td>   
								</tr>
	
	
								<script>
									calculate_breakdown_js();
									disabled_scharacter_js();
	
								</script>
									';
	
						$data['cashremit_type']= $q['remit_type'];			
					}
						$html.='
	
								<tr>
									<td style="float: right">
										<button type="button" disabled="" id="btn_cancel_cashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-info waves-effect" onclick="canceledit_cash_denomination()">CANCEL</button>
										<button type="button" disabled="" id="btn_update_cashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-warning waves-effect" onclick="update_historycashform_js_v2()">UPDATE</button>
									</td>
									<td>
										<input type="text" class="input-sm" id="total_cashtxt" disabled="" placeholder="TOTAL CASH">
									</td>
									<td>
										<input type="text" class="input-sm" disabled readonly id="historytotal_cash" placeholder="0.00">
									</td>
								</tr>
	
								<script>
								
									disabled_editbtn();
									disabled_cash_quantity_js();
	
								</script>
								';

					$data['sname'] = '';    	   
					$data['ssname'] = '';    
					$data['pos_name'] = '';    
					$data['counter_no'] = '';   
					$data['edit_den']=$edit_den;    	   
					$data['edit_den_status']=$edit_den_status;    	   
					$data['edit_remittance_type']=$edit_remittance_type;    	   
					$data['html']=$html;    	   
					echo json_encode($data);
				}
			}
			else
			{
				$query=$this->cashier_model->displayhistory_cashform_model_v2($emp_id,$sscode2,$pos_name,$borrowed);
				if(empty($query))
				{
					$html='';
					$partial_data = $this->cashier_model->get_total_partial_model($emp_id,$sscode2,$pos_name,$borrowed);
					$partial_total = 0;
					$cashremit_type = '';
					$counter_no = '';
					if(!empty($partial_data))
					{
						$partial_total = $partial_data->partial;
						$cashremit_type = $partial_data->remit_type;
						$counter_no = $partial_data->counter_no;
					}
					// ========================================================================================================
					$section_name = '';
					$sub_section_name = '';
					if($borrowed == 'YES')
					{
						$sname = $this->cashier_model->get_section_name($scode2);
						if(!empty($sname))
						{
							$section_name = $sname->section_name;
						}
						// =====================================================================================================
						$ssname = $this->cashier_model->get_sub_section_name($sscode2);
						if(!empty($ssname))
						{
							$sub_section_name = $ssname->sub_section_name;
						}
					}
					// =======================================================================================================
						$html.='
								<tr id="tr_partial">
									<td>
									<button type="button" id="view_hpartialdetails" style="height: 50px; width: 120px; font-size: 22px; float: right;" class="btn btn-primary waves-effect" onclick="view_hpartialdetails_js()">VIEW 👁️</button>
									</td>
									<td>
										<input type="text" class="input-sm" disabled id="" placeholder="PARTIAL REMITTANCE">
									</td>
									<td>
										<input type="text" class="input-sm" disabled readonly="" id="ch_partial" value="'.number_format($partial_total,2).'">
									</td>   
								</tr>
								';
	
						$data['html']=$html;    
						$data['sname'] = $section_name;    	   
						$data['ssname'] = $sub_section_name; 
						$data['pos_name'] = $pos_name;    
						$data['counter_no'] = $counter_no;      	   
						$data['edit_den'] = '';    	   
						$data['edit_den_status'] = '';
						$data['edit_remittance_type'] = '';    	   
						$data['cashremit_type']= $cashremit_type;	   
						echo json_encode($data);
				}
				else
				{
					$html="";
					$edit_den = '';
					$edit_den_status = '';
					$edit_remittance_type = '';
					foreach ($query as $q)
					{
						$edit_den = $q['edit_denomination'];
						$edit_den_status = $q['edit_status_denomination'];
						$edit_remittance_type = $q['edit_remittance_type'];
						if($q['remit_type']=='PARTIAL')
						{
						$status='hidden';
						}
						else
						{
						$status = '';
						}
	
						$html.='
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_onek" disabled="" placeholder="₱1,000">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity cash_quantity" id="q_onek" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" placeholder="0" value="'.$q['onek'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_onek" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="₱500">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity1 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fiveh" placeholder="0" value="'.$q['fiveh'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_fiveh" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="₱200">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity2 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twoh" placeholder="0" value="'.$q['twoh'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_twoh" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="₱100">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity3 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_oneh" placeholder="0" value="'.$q['oneh'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_oneh" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="₱50">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity4 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fifty" placeholder="0" value="'.$q['fifty'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_fifty" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="₱20">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity5 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twenty" placeholder="0" value="'.$q['twenty'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_twenty" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$status.'>
									<td>
										<input type="text" class="input-sm" id="d_ten" disabled="" placeholder="₱10">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity6 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_ten" placeholder="0" value="'.$q['ten'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_ten" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$status.'>
									<td>
										<input type="text" class="input-sm" id="d_five" disabled="" placeholder="₱5">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity7 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_five" placeholder="0" value="'.$q['five'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_five" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$status.'>
									<td>
										<input type="text" class="input-sm" id="d_one" disabled="" placeholder="₱1">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity8 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_one" placeholder="0" value="'.$q['one'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_one" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$status.'>
									<td>
										<input type="text" class="input-sm" id="d_twentyfivecents" disabled="" placeholder="₱0.25">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity9 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twentyfivecents" placeholder="0" value="'.$q['twentyfive_cents'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_twentyfivecents" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$status.'>
									<td>
										<input type="text" class="input-sm" id="d_tencents" disabled="" placeholder="₱0.10">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity10 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_tencents" placeholder="0" value="'.$q['ten_cents'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_tencents" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$status.'>
									<td>
										<input type="text" class="input-sm" id="d_fivecents" disabled="" placeholder="₱0.05">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity11 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fivecents" placeholder="0" value="'.$q['five_cents'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_fivecents" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$status.'>
									<td>
										<input type="text" class="input-sm" id="d_onecents" disabled="" placeholder="₱0.01">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity12 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_onecents" placeholder="0" value="'.$q['one_cents'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_onecents" placeholder="0" value="0">
										<input type="number" min="0" hidden class="input-sm number" readonly="" id="history_cashform_id" placeholder="0" value="'.$q['id'].'">
									</td>   
								</tr>
	
								<script>
	
									disabled_scharacter_js();
	
								</script>
	
								';
						$data['cashremit_type']= $q['remit_type'];		
					}
					// ======================================================================================================
					$partial_total = 0;
					$partial_data = $this->cashier_model->get_total_partial_model($emp_id,$sscode2,$pos_name,$borrowed);
					if(!empty($partial_data))
					{
						$partial_total = $partial_data->partial;
					}
					// =======================================================================================================
					$html.='
							<tr>
								<td style="float: right">
									<button type="button" disabled="" id="btn_cancel_cashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-info waves-effect" onclick="canceledit_cash_denomination()">CANCEL</button>
									<button type="button" disabled="" id="btn_update_cashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-warning waves-effect" onclick="update_historycashform_js_v2()">UPDATE</button>
								</td>
								<td>
									<input type="text" class="input-sm" id="total_cashtxt" disabled="" placeholder="FINAL CASH">
								</td>
								<td>
									<input type="text" class="input-sm" disabled readonly id="historytotal_cash" placeholder="0.00">
								</td>
							</tr>
	
							<tr id="tr_partial">
								<td>
								<button type="button" id="view_hpartialdetails" style="height: 50px; width: 120px; font-size: 22px; float: right;" class="btn btn-primary waves-effect" onclick="view_hpartialdetails_js()">VIEW 👁️</button>
								</td>
								<td>
									<input type="text" class="input-sm" disabled id="" placeholder="PARTIAL REMITTANCE">
								</td>
								<td>
									<input type="text" class="input-sm" disabled readonly="" id="ch_partial" value="'.number_format($partial_total,2).'">
								</td>   
							</tr>
	
							<tr id="tr_gtotal">
								<td>
									
								</td>
								<td>
									<input type="text" class="input-sm" disabled id="" placeholder="GRAND TOTAL">
								</td>
								<td>
									<input type="text" class="input-sm" disabled readonly="" id="gtotal_cash" placeholder="0.00">
								</td>   
							</tr>
	
							<script>
							
								disabled_cash_quantity_js();
								calculate_breakdown_js();
	
							</script>
							';
						
						
						$data['sname'] = '';    	   
						$data['ssname'] = '';    
						$data['pos_name'] = '';    
						$data['counter_no'] = '';    
						$data['edit_den']=$edit_den;    	   
						$data['edit_den_status']=$edit_den_status;    	   
						$data['edit_remittance_type']=$edit_remittance_type;     	   
						$data['html']=$html;    	   
						echo json_encode($data);
					}
			}
		}
		else
		{
			$query2=$this->cashier_model->getpartialhistory_cashform_model($emp_id);
			if(empty($query2))
			{
				$query=$this->cashier_model->displayhistory_cashform_model($emp_id); 
				if(!empty($query))
				{
					$html="";
					$borrowed = '';
					$scode2 = '';
					$sscode2 = '';
					$pos_name = '';    
					$counter_no = '';    
					$edit_den = '';
					$edit_den_status = '';
					$edit_remittance_type = '';
					foreach ($query as $q)
					{
						$borrowed = $q['borrowed'];
						$scode2 = $q['company_code'].$q['bunit_code'].$q['dep_code'].$q['section_code'];
						$sscode2 = $q['company_code'].$q['bunit_code'].$q['dep_code'].$q['section_code'].$q['sub_section_code'];
						$pos_name = $q['pos_name'];    
						$counter_no = $q['counter_no'];   
						$edit_den = $q['edit_denomination'];
						$edit_den_status = $q['edit_status_denomination'];
						$edit_remittance_type = $q['edit_remittance_type'];
						if($q['remit_type'] == 'PARTIAL')
						{
							$hide = 'hidden';
						}
						else
						{
							$hide = '';
						}

						$html.='
	
									<tr>
									<td>
										<input type="text" class="input-sm" id="d_onek" disabled="" placeholder="₱1,000">
									</td>
									<td>
										<input type="number" min="0" class="input-sm cash_quantity" id="q_onek" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" placeholder="0" value="'.$q['onek'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_onek" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="₱500">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity1 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fiveh" placeholder="0" value="'.$q['fiveh'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_fiveh" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="₱200">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity2 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twoh" placeholder="0" value="'.$q['twoh'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_twoh" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="₱100">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity3 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_oneh" placeholder="0" value="'.$q['oneh'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_oneh" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="₱50">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity4 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fifty" placeholder="0" value="'.$q['fifty'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_fifty" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="₱20">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity5 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twenty" placeholder="0" value="'.$q['twenty'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_twenty" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$hide.'>
									<td>
										<input type="text" class="input-sm" id="d_ten" disabled="" placeholder="₱10">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity6 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_ten" placeholder="0" value="'.$q['ten'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_ten" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$hide.'>
									<td>
										<input type="text" class="input-sm" id="d_five" disabled="" placeholder="₱5">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity7 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_five" placeholder="0" value="'.$q['five'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_five" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$hide.'>
									<td>
										<input type="text" class="input-sm" id="d_one" disabled="" placeholder="₱1">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity8 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_one" placeholder="0" value="'.$q['one'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_one" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$hide.'>
									<td>
										<input type="text" class="input-sm" id="d_twentyfivecents" disabled="" placeholder="₱0.25">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity9 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twentyfivecents" placeholder="0" value="'.$q['twentyfive_cents'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_twentyfivecents" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$hide.'>
									<td>
										<input type="text" class="input-sm" id="d_tencents" disabled="" placeholder="₱0.10">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity10 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_tencents" placeholder="0" value="'.$q['ten_cents'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_tencents" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$hide.'>
									<td>
										<input type="text" class="input-sm" id="d_fivecents" disabled="" placeholder="₱0.05">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity11 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fivecents" placeholder="0" value="'.$q['five_cents'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_fivecents" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$hide.'>
									<td>
										<input type="text" class="input-sm" id="d_onecents" disabled="" placeholder="₱0.01">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity12 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_onecents" placeholder="0" value="'.$q['one_cents'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_onecents" placeholder="0" value="0">
										<input type="number" min="0" hidden class="input-sm number" readonly="" id="history_cashform_id" placeholder="0" value="'.$q['id'].'">
									</td>   
								</tr>
	
	
								<script>
									calculate_breakdown_js();
									disabled_scharacter_js();
	
								</script>
									';
	
						$data['cashremit_type']= $q['remit_type'];			
					}
					// ========================================================================================================
					$section_name = '';
					$sub_section_name = '';
					if($borrowed == 'YES')
					{
						$sname = $this->cashier_model->get_section_name($scode2);
						if(!empty($sname))
						{
							$section_name = $sname->section_name;
						}
						// =====================================================================================================
						$ssname = $this->cashier_model->get_sub_section_name($sscode2);
						if(!empty($ssname))
						{
							$sub_section_name = $ssname->sub_section_name;
						}
					}
					// =========================================================================================================
					$html.='

							<tr>
								<td style="float: right">
									<button type="button" disabled="" id="btn_cancel_cashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-info waves-effect" onclick="canceledit_cash_denomination()">CANCEL</button>
									<button type="button" disabled="" id="btn_update_cashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-warning waves-effect" onclick="update_historycashform_js_v2()">UPDATE</button>
								</td>
								<td>
									<input type="text" class="input-sm" id="total_cashtxt" disabled="" placeholder="TOTAL CASH">
								</td>
								<td>
									<input type="text" class="input-sm" disabled readonly id="historytotal_cash" placeholder="0.00">
								</td>
							</tr>

							<script>
							
								disabled_editbtn();
								disabled_cash_quantity_js();

							</script>
							';
					 
					$data['sname'] = $section_name;    	   
					$data['ssname'] = $sub_section_name;  
					$data['pos_name'] = $pos_name;    
					$data['counter_no'] = $counter_no;       
					$data['edit_den']=$edit_den;    	   
					$data['edit_den_status']=$edit_den_status;    	   
					$data['edit_remittance_type']=$edit_remittance_type;    	   
					$data['html']=$html;    	   
					echo json_encode($data);
				}
			}
			else
			{
				$query=$this->cashier_model->displayhistory_cashform_model($emp_id);
				if(empty($query))
				{
					$html='';
					$partial_data = $this->cashier_model->get_total_partial_model_v2($emp_id);
					$partial_total = 0;
					$cashremit_type = '';
					$borrowed = '';
					$pos_name = '';
					$counter_no = '';
					$scode2 = '';
					$sscode2 = '';
					if(!empty($partial_data))
					{
						$partial_total = $partial_data->partial;
						$cashremit_type = $partial_data->remit_type;
						$borrowed = $partial_data->borrowed;
						$pos_name = $partial_data->pos_name;
						$counter_no = $partial_data->counter_no;
						$scode2 = $partial_data->scode;
						$sscode2 = $partial_data->sscode;
					}
					// ========================================================================================================
					$section_name = '';
					$sub_section_name = '';
					if($borrowed == 'YES')
					{
						$sname = $this->cashier_model->get_section_name($scode2);
						if(!empty($sname))
						{
							$section_name = $sname->section_name;
						}
						// =====================================================================================================
						$ssname = $this->cashier_model->get_sub_section_name($sscode2);
						if(!empty($ssname))
						{
							$sub_section_name = $ssname->sub_section_name;
						}
					}
					// =======================================================================================================
						$html.='
								<tr id="tr_partial">
									<td>
									<button type="button" id="view_hpartialdetails" style="height: 50px; width: 120px; font-size: 22px; float: right;" class="btn btn-primary waves-effect" onclick="view_hpartialdetails_js()">VIEW 👁️</button>
									</td>
									<td>
										<input type="text" class="input-sm" disabled id="" placeholder="PARTIAL REMITTANCE">
									</td>
									<td>
										<input type="text" class="input-sm" disabled readonly="" id="ch_partial" value="'.number_format($partial_total,2).'">
									</td>   
								</tr>
								';
						
						$data['html']=$html;    
						$data['sname'] = $section_name;    	   
						$data['ssname'] = $sub_section_name;    
						$data['pos_name'] = $pos_name;    
						$data['counter_no'] = $counter_no;      	   
						$data['edit_den'] = '';    	   
						$data['edit_den_status'] = '';
						$data['edit_remittance_type'] = '';    	   
						$data['cashremit_type']= $cashremit_type;	   
						echo json_encode($data);
				}
				else
				{
					$html="";
					$borrowed = '';
					$scode2 = '';
					$sscode2 = '';
					$pos_name = '';
					$counter_no = '';
					$edit_den = '';
					$edit_den_status = '';
					$edit_remittance_type = '';
					foreach ($query as $q)
					{
						$borrowed = $q['borrowed'];
						$scode2 = $q['company_code'].$q['bunit_code'].$q['dep_code'].$q['section_code'];
						$sscode2 = $q['company_code'].$q['bunit_code'].$q['dep_code'].$q['section_code'].$q['sub_section_code'];
						$pos_name = $q['pos_name'];
						$counter_no = $q['counter_no'];
						$edit_den = $q['edit_denomination'];
						$edit_den_status = $q['edit_status_denomination'];
						$edit_remittance_type = $q['edit_remittance_type'];
						if($q['remit_type']=='PARTIAL')
						{
						$status='hidden';
						}
						else
						{
						$status = '';
						}
	
						$html.='
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_onek" disabled="" placeholder="₱1,000">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity cash_quantity" id="q_onek" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" placeholder="0" value="'.$q['onek'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_onek" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="₱500">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity1 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fiveh" placeholder="0" value="'.$q['fiveh'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_fiveh" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="₱200">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity2 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twoh" placeholder="0" value="'.$q['twoh'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_twoh" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="₱100">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity3 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_oneh" placeholder="0" value="'.$q['oneh'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_oneh" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="₱50">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity4 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fifty" placeholder="0" value="'.$q['fifty'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_fifty" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr>
									<td>
										<input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="₱20">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity5 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twenty" placeholder="0" value="'.$q['twenty'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_twenty" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$status.'>
									<td>
										<input type="text" class="input-sm" id="d_ten" disabled="" placeholder="₱10">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity6 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_ten" placeholder="0" value="'.$q['ten'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_ten" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$status.'>
									<td>
										<input type="text" class="input-sm" id="d_five" disabled="" placeholder="₱5">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity7 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_five" placeholder="0" value="'.$q['five'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_five" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$status.'>
									<td>
										<input type="text" class="input-sm" id="d_one" disabled="" placeholder="₱1">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity8 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_one" placeholder="0" value="'.$q['one'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_one" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$status.'>
									<td>
										<input type="text" class="input-sm" id="d_twentyfivecents" disabled="" placeholder="₱0.25">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity9 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twentyfivecents" placeholder="0" value="'.$q['twentyfive_cents'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_twentyfivecents" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$status.'>
									<td>
										<input type="text" class="input-sm" id="d_tencents" disabled="" placeholder="₱0.10">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity10 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_tencents" placeholder="0" value="'.$q['ten_cents'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_tencents" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$status.'>
									<td>
										<input type="text" class="input-sm" id="d_fivecents" disabled="" placeholder="₱0.05">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity11 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fivecents" placeholder="0" value="'.$q['five_cents'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_fivecents" placeholder="0" value="0">
									</td>
								</tr>
	
								<tr '.$status.'>
									<td>
										<input type="text" class="input-sm" id="d_onecents" disabled="" placeholder="₱0.01">
									</td>
									<td>
										<input type="number" min="0" class="input-sm quantity12 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_onecents" placeholder="0" value="'.$q['one_cents'].'">
									</td>
									<td>
										<input type="text" class="input-sm d_amount" readonly="" disabled id="a_onecents" placeholder="0" value="0">
										<input type="number" min="0" hidden class="input-sm number" readonly="" id="history_cashform_id" placeholder="0" value="'.$q['id'].'">
									</td>   
								</tr>
	
								<script>
	
									disabled_scharacter_js();
	
								</script>
	
								';
						$data['cashremit_type']= $q['remit_type'];		
					}
					// ======================================================================================================
					$partial_total = 0;
					$partial_data = $this->cashier_model->get_total_partial_model_v2($emp_id);
					if(!empty($partial_data))
					{
						$partial_total = $partial_data->partial;
					}
					// ========================================================================================================
					$section_name = '';
					$sub_section_name = '';
					if($borrowed == 'YES')
					{
						$sname = $this->cashier_model->get_section_name($scode2);
						if(!empty($sname))
						{
							$section_name = $sname->section_name;
						}
						// =====================================================================================================
						$ssname = $this->cashier_model->get_sub_section_name($sscode2);
						if(!empty($ssname))
						{
							$sub_section_name = $ssname->sub_section_name;
						}
					}
					// =======================================================================================================
					$html.='
							<tr>
								<td style="float: right">
									<button type="button" disabled="" id="btn_cancel_cashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-info waves-effect" onclick="canceledit_cash_denomination()">CANCEL</button>
									<button type="button" disabled="" id="btn_update_cashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-warning waves-effect" onclick="update_historycashform_js_v2()">UPDATE</button>
								</td>
								<td>
									<input type="text" class="input-sm" id="total_cashtxt" disabled="" placeholder="FINAL CASH">
								</td>
								<td>
									<input type="text" class="input-sm" disabled readonly id="historytotal_cash" placeholder="0.00">
								</td>
							</tr>
	
							<tr id="tr_partial">
								<td>
								<button type="button" id="view_hpartialdetails" style="height: 50px; width: 120px; font-size: 22px; float: right;" class="btn btn-primary waves-effect" onclick="view_hpartialdetails_js()">VIEW 👁️</button>
								</td>
								<td>
									<input type="text" class="input-sm" disabled id="" placeholder="PARTIAL REMITTANCE">
								</td>
								<td>
									<input type="text" class="input-sm" disabled readonly="" id="ch_partial" value="'.number_format($partial_total,2).'">
								</td>   
							</tr>
	
							<tr id="tr_gtotal">
								<td>
									
								</td>
								<td>
									<input type="text" class="input-sm" disabled id="" placeholder="GRAND TOTAL">
								</td>
								<td>
									<input type="text" class="input-sm" disabled readonly="" id="gtotal_cash" placeholder="0.00">
								</td>   
							</tr>
	
							<script>
							
								disabled_cash_quantity_js();
								calculate_breakdown_js();
	
							</script>
							';
						
						
						
						$data['sname'] = $section_name;    	   
						$data['ssname'] = $sub_section_name;    
						$data['pos_name'] = $pos_name;    
						$data['counter_no'] = $counter_no;    
						$data['edit_den']=$edit_den;    	   
						$data['edit_den_status']=$edit_den_status;    	   
						$data['edit_remittance_type']=$edit_remittance_type;     	   
						$data['html']=$html;    	   
						echo json_encode($data);
					}
			}
		}
	}

	public function update_historycashform_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$edit_project = 'success';
			$emp_id = $_SESSION['emp_id'];
			$this->cashier_model->update_historycashform_model($emp_id,
														$_POST['id'],
														$_POST['onek'],
														$_POST['fiveh'],
														$_POST['twoh'],
														$_POST['oneh'],
														$_POST['fifty'],
														$_POST['twenty'],
														$_POST['ten'],
														$_POST['five'],
														$_POST['one'],
														$_POST['twentyfivecents'],
														$_POST['tencents'],
														$_POST['fivecents'],
														$_POST['onecents'],
														$_POST['total_cash'],
														$_POST['pos_name'],
														$_POST['counter_no']);	
										
			$this->cashier_model->update_history_noncash_pos_model($emp_id,$_POST['pos_name'],$_POST['counter_no']);

			echo json_encode($edit_project);	
		}
	}

	public function update_historycashform_ctrl_v2()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$edit_project = 'success';
			$emp_id = $_SESSION['emp_id'];
			$this->cashier_model->update_historycashform_model_v2($emp_id,
																$_POST['id'],
																$_POST['onek'],
																$_POST['fiveh'],
																$_POST['twoh'],
																$_POST['oneh'],
																$_POST['fifty'],
																$_POST['twenty'],
																$_POST['ten'],
																$_POST['five'],
																$_POST['one'],
																$_POST['twentyfivecents'],
																$_POST['tencents'],
																$_POST['fivecents'],
																$_POST['onecents'],
																$_POST['total_cash']);	

			echo json_encode($edit_project);	
		}
	}

	public function update_historycashform_borrowed_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$section_code = $_POST['cash_section'];
			$sub_section_code = $_POST['cash_subsection'];
			$borrowed = 'YES';
			
			$edit_project = 'success';
			$emp_id = $_SESSION['emp_id'];
			$this->cashier_model->update_historycashform2_model($emp_id,
														$_POST['id'],
														$_POST['onek'],
														$_POST['fiveh'],
														$_POST['twoh'],
														$_POST['oneh'],
														$_POST['fifty'],
														$_POST['twenty'],
														$_POST['ten'],
														$_POST['five'],
														$_POST['one'],
														$_POST['twentyfivecents'],
														$_POST['tencents'],
														$_POST['fivecents'],
														$_POST['onecents'],
														$_POST['total_cash'],
														$section_code,
														$sub_section_code,
														$borrowed,
														$_POST['pos_name'],
														$_POST['counter_no']);	
			
			$this->cashier_model->update_history_noncash_borrowed_model($emp_id,$section_code,$sub_section_code,$_POST['pos_name'],$_POST['counter_no']);


			echo json_encode($edit_project);
		}
	}

	public function disabled_saveresetbtn_ctrl()
	{

		$emp_id = $_SESSION['emp_id'];
		$query=$this->cashier_model->disabled_saveresetbtn_model($emp_id);
		$validate_noncash_pending=$this->cashier_model->validate_noncash_pending_checkbox_model($emp_id);
		$noncash_pending = 'WALAY PENDING';
		if(!empty($validate_noncash_pending))
		{
			$noncash_pending = 'NAAY PENDING';
		}

		$status="";
		foreach ($query as $q)
		{
			$status = $q['status'];
		}

		$cash_tr_no = '';
		$get_trno = $this->cashier_model->get_trno_model($_SESSION['emp_id']);
		$get_trno2 = $this->cashier_model->get_trno_model2($_SESSION['emp_id']);
		$new_trno = $this->cashier_model->get_new_trno_model();
		if(!empty($get_trno))
		{
			$cash_tr_no = $get_trno->tr_no;
		}
		else
		{
			if(!empty($get_trno2))
			{
				$cash_tr_no = $get_trno2->tr_no;
			}
			else
			{
				if(!empty($new_trno))
				{	
					$cash_tr_no = $new_trno->id+1;
				}
				else
				{
					$cash_tr_no = 1;
				}
			}
		}

        $data['noncash_pending']=$noncash_pending;  
        $data['trno']=$cash_tr_no;  
		$data['status']=$status;    	   
		echo json_encode($data);
	}

	public function disabled_saveresetbtn_ctrl_v2()
	{
		$emp_id = $_SESSION['emp_id'];
		$validate_cash_confirmed=$this->cashier_model->validate_cash_confirmed_model($emp_id);
		$validate_noncash_pending=$this->cashier_model->validate_noncash_pending_model($emp_id);
		$pos_name = '';
		$counter_no = '';
		$borrowed = '';
		$scode = '';
		$sscode = '';
		if(!empty($validate_cash_confirmed))
		{
			foreach($validate_cash_confirmed as $cash)
			{
				$pos_name = '
							<option value="'.$cash['counter_no'].'">'.$cash['pos_name'].'</option>
							';
				$counter_no = $cash['counter_no'];
				$borrowed = $cash['borrowed'];
				$scode = $cash['scode'];
				$sscode = $cash['sscode'];
			}
		}
		else
		{
			foreach($validate_noncash_pending as $noncash)
			{
				$pos_name = '
							<option value="'.$noncash['counter_no'].'">'.$noncash['pos_name'].'</option>
							';
				$counter_no = $noncash['counter_no'];
				$borrowed = $noncash['borrowed'];
				$scode = $noncash['scode'];
				$sscode = $noncash['sscode'];
			}
		}
		
		$sname = '';
		$ssname = '';
		if($borrowed == 'YES')
		{
			$section_data = $this->cashier_model->get_section_name($scode);
			$sub_section_data = $this->cashier_model->get_sub_section_name($sscode);
			if(!empty($section_data))
			{
				$sname = '
						<option value="'.$section_data->section_code.'">'.$section_data->section_name.'</option>
						';
				if(!empty($sub_section_data))
				{
					$ssname = '
							<option value="'.$sub_section_data->sub_section_code.'">'.$sub_section_data->sub_section_name.'</option>
							';
				}
			}
		}
		// =========================================================================================================
		$query=$this->cashier_model->disabled_saveresetbtn_model($emp_id);
		$status="";
		foreach ($query as $q)
		{
			$status = $q['status'];
		}
		// ==============================================================================================================
		$cash_tr_no = '';
		$get_trno = $this->cashier_model->get_trno_model($_SESSION['emp_id']);
		$get_trno2 = $this->cashier_model->get_trno_model2($_SESSION['emp_id']);
		$new_trno = $this->cashier_model->get_new_trno_model();
		if(!empty($get_trno))
		{
			$cash_tr_no = $get_trno->tr_no;
		}
		else
		{
			if(!empty($get_trno2))
			{
				$cash_tr_no = $get_trno2->tr_no;
			}
			else
			{
				if(!empty($new_trno))
				{	
					$cash_tr_no = $new_trno->id+1;
				}
				else
				{
					$cash_tr_no = 1;
				}
			}
		}

        $data['pos_name']=$pos_name;  
        $data['counter_no']=$counter_no;  
        $data['borrowed']=$borrowed;  
        $data['sname']=$sname;  
        $data['ssname']=$ssname;  
        $data['trno']=$cash_tr_no;  
		$data['status']=$status;    	   
		echo json_encode($data);
	}

	public function disabled_saveresetbtn_ctrl_v3()
	{
		$current_date = date("Y-m-d");
		$emp_id = $_SESSION['emp_id'];
		$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
		$assigned_counter = '';
		$dcode = '';
		$scode = '';
		$sscode = '';
		$pos_name = '';
		$pos_name2 = '';
		$counter_no = '';
		$borrowed = '';
		if(!empty($assigned_counter_data))
		{
			$assigned_counter = 'NOT EMPTY';
			foreach($assigned_counter_data as $assigned)
			{
				$dcode = $assigned['dcode'];
				$scode = $assigned['scode'];
				$sscode = $assigned['sscode'];
				$pos_name = '
							<option value="'.$assigned['counter_no'].'">'.$assigned['pos_name'].'</option>
							';
				$pos_name2 = $assigned['pos_name'];
				$counter_no = $assigned['counter_no'];
				$borrowed = $assigned['borrowed'];
			}
		}
		// =========================================================================================================
		$scode2 = '';
		$sscode2 = '';
		$sscode3 = '';
		$sname = '';
		$ssname = '';
		if($borrowed == 'YES')
		{
			$scode2 = $dcode.$scode;
			$sscode2 = $dcode.$scode.$sscode;
			$sscode3 = $dcode.$scode.$sscode;
			$section_data = $this->cashier_model->get_section_name($scode2);
			$sub_section_data = $this->cashier_model->get_sub_section_name($sscode2);
			if(!empty($section_data))
			{
				$sname = '
						<option value="'.$section_data->section_code.'">'.$section_data->section_name.'</option>
						';
				if(!empty($sub_section_data))
				{
					$ssname = '
							<option value="'.$sub_section_data->sub_section_code.'">'.$sub_section_data->sub_section_name.'</option>
							';
				}
			}
		}
		else
		{
			$emp_data = $this->cashier_model->get_empdata($emp_id);
			$company_code = '';
			$bunit_code = '';
			$dept_code = '';
			$section_code = '';
			$sub_section_code = '';
			foreach($emp_data as $data)
			{
				$company_code = $data['company_code'];
				$bunit_code = $data['bunit_code'];
				$dept_code = $data['dept_code'];
				$section_code = $data['section_code'];
				$sub_section_code = $data['sub_section_code'];
			}
			$sscode3 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
		}
		// =========================================================================================================
		$query=$this->cashier_model->disabled_saveresetbtn_model($emp_id);
		$status="";
		foreach ($query as $q)
		{
			$status = $q['status'];
		}
		// ===================================================jay update v1.0===========================================================
		$cash_tr_no = '';
		$get_trno = $this->cashier_model->get_trno_model_v2($emp_id,$sscode3,$pos_name2,$borrowed);
		$get_trno2 = $this->cashier_model->get_trno_model2_v2($emp_id,$sscode3,$pos_name2,$borrowed);
		$new_trno = $this->cashier_model->get_new_trno_model();
		if(!empty($get_trno))
		{
			$cash_tr_no = $get_trno->tr_no;
		}
		else
		{
			if(!empty($get_trno2))
			{
				$cash_tr_no = $get_trno2->tr_no;
			}
			else
			{
				if(!empty($new_trno))
				{	
					$cash_tr_no = $new_trno->tr_no+1;
				}
				else
				{
					$cash_tr_no = 1;
				}
			}
		}

        $data['assigned_counter']=$assigned_counter;  
        $data['pos_name']=$pos_name;  
        $data['counter_no']=$counter_no;  
        $data['borrowed']=$borrowed;  
        $data['sname']=$sname;  
        $data['ssname']=$ssname;  
        $data['trno']=$cash_tr_no;  
		$data['status']=$status;    	   
		echo json_encode($data);
	}

	public function noncash_denomination_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$emp_id = $_SESSION['emp_id'];
			$emp_data = $this->cashier_model->get_empdata($emp_id);
			$validate_cashpending = $this->cashier_model->validate_cashpending_checkbox_model($emp_id);
			$valborrowed = '';
			foreach($validate_cashpending as $valb)
			{
				$valborrowed = $valb['borrowed'];
			}
			if($valborrowed == 'YES')
			{
				$sal_no = '';
				$emp_name = '';
				$emp_type = '';
				$company_code = '';
				$bunit_code = '';
				$dep_code = '';
				$section_code = '';
				$sub_section_code = '';
				$borrowed = 'YES';
				foreach ($validate_cashpending as $d)
				{
					$sal_no = $d['sal_no'];
					$emp_name = $d['emp_name'];
					$emp_type = $d['emp_type'];
					$company_code = $d['company_code'];
					$bunit_code = $d['bunit_code'];
					$dep_code = $d['dep_code'];
					$section_code = $d['section_code'];
					$sub_section_code = $d['sub_section_code'];
				}
				
				$message = 'success';
				$this->cashier_model->insert_non_cash_model($_POST['tr_no'],
															$_POST['batch_id'],
															$emp_id,
															$sal_no,
															$emp_name,
															$emp_type,
															$company_code,
															$bunit_code,
															$dep_code,
															$section_code,
															$sub_section_code,
															$borrowed,
															$_POST['amount_Arr']);
				
				echo json_encode($message);
			}
			else
			{
				$sal_no = '';
				$emp_name = '';
				$emp_type = '';
				$company_code = '';
				$bunit_code = '';
				$dep_code = '';
				$section_code = '';
				$sub_section_code = '';
				$borrowed = 'NO';
				foreach ($emp_data as $d)
				{
					$sal_no = $d['payroll_no'];
					$emp_name = $d['name'];
					$emp_type = $d['emp_type'];
					$company_code = $d['company_code'];
					$bunit_code = $d['bunit_code'];
					$dep_code = $d['dept_code'];
					$section_code = $d['section_code'];
					$sub_section_code = $d['sub_section_code'];
				}
				
				$message = 'success';
				$this->cashier_model->insert_non_cash_model($_POST['tr_no'],
															$_POST['batch_id'],
															$emp_id,
															$sal_no,
															$emp_name,
															$emp_type,
															$company_code,
															$bunit_code,
															$dep_code,
															$section_code,
															$sub_section_code,
															$borrowed,
															$_POST['amount_Arr']);
				
				echo json_encode($message);
			}
		}
	}

	public function noncash_denomination_ctrl_v2()
	{
		
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$emp_id = $_SESSION['emp_id'];
			$emp_data = $this->cashier_model->get_empdata($emp_id);
			$validate_cashpending = $this->cashier_model->validate_cashpending_checkbox_model($emp_id);
			$valborrowed = '';
			foreach($validate_cashpending as $valb)
			{
				$valborrowed = $valb['borrowed'];
			}
			if($valborrowed == 'YES')
			{
				$sal_no = '';
				$emp_name = '';
				$emp_type = '';
				$company_code = '';
				$bunit_code = '';
				$dep_code = '';
				$section_code = '';
				$sub_section_code = '';
				$borrowed = 'YES';
				foreach ($validate_cashpending as $d)
				{
					$sal_no = $d['sal_no'];
					$emp_name = $d['emp_name'];
					$emp_type = $d['emp_type'];
					$company_code = $d['company_code'];
					$bunit_code = $d['bunit_code'];
					$dep_code = $d['dep_code'];
					$section_code = $d['section_code'];
					$sub_section_code = $d['sub_section_code'];
				}
				// =====================================================================================================================
				$current_date = date("Y-m-d");
				$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
				$dcode = '';
				$scode = '';
				$sscode = '';
				$pos_name = '';
				$borrowed = '';
				if(!empty($assigned_counter_data))
				{
					foreach($assigned_counter_data as $assigned)
					{
						$dcode = $assigned['dcode'];
						$scode = $assigned['scode'];
						$sscode = $assigned['sscode'];
						$pos_name = $assigned['pos_name'];
						$borrowed = $assigned['borrowed'];
					}
				}
				// =========================================================================================================
				$sscode2 = '';
				if($borrowed == 'YES')
				{
					$sscode2 = $dcode.$scode.$sscode;
				}
				else
				{
					$emp_data = $this->cashier_model->get_empdata($emp_id);
					$company_code = '';
					$bunit_code = '';
					$dept_code = '';
					$section_code = '';
					$sub_section_code = '';
					foreach($emp_data as $data)
					{
						$company_code = $data['company_code'];
						$bunit_code = $data['bunit_code'];
						$dept_code = $data['dept_code'];
						$section_code = $data['section_code'];
						$sub_section_code = $data['sub_section_code'];
					}
					$sscode2 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
				}
				// ==========================================jay update v1.0=============================================================
				$message = 'success';
				$validate_data = $this->cashier_model->validate_ncmop_model($emp_id,$_POST['mop_name'],$sscode2,$pos_name,$borrowed);
				if(empty($validate_data))
				{
					// $validated_trno = $this->cashier_model->validate_trno_model($_POST['tr_no'],$emp_id);
					// if(!empty($validated_trno))
					// {
					// 	$message = 'TRNO ALREADY USED';
					// 	echo json_encode($message);
					// }
					// else
					// {
						$this->cashier_model->insert_non_cash_model_v2($_POST['tr_no'],
																   $emp_id,
																   $sal_no,
																   $emp_name,
																   $emp_type,
																   $company_code,
																   $bunit_code,
																   $dep_code,
																   $section_code,
																   $sub_section_code,
																   $borrowed,
																   $_POST['pos_name'],
																   $_POST['counter_no'],
																   $_POST['mop_name'],
																   $_POST['nc_quantity'],
																   $_POST['nc_amount']);
					// }
				}
				else
				{
					$message = 'ALREADY EXIST';
				}

				echo json_encode($message);
			}
			else
			{
				$sal_no = '';
				$emp_name = '';
				$emp_type = '';
				$company_code = '';
				$bunit_code = '';
				$dep_code = '';
				$section_code = '';
				$sub_section_code = '';
				$borrowed = 'NO';
				foreach ($emp_data as $d)
				{
					$sal_no = $d['payroll_no'];
					$emp_name = $d['name'];
					$emp_type = $d['emp_type'];
					$company_code = $d['company_code'];
					$bunit_code = $d['bunit_code'];
					$dep_code = $d['dept_code'];
					$section_code = $d['section_code'];
					$sub_section_code = $d['sub_section_code'];
				}
				// =====================================================================================================================
				$current_date = date("Y-m-d");
				$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
				$dcode = '';
				$scode = '';
				$sscode = '';
				$pos_name = '';
				$borrowed = '';
				if(!empty($assigned_counter_data))
				{
					foreach($assigned_counter_data as $assigned)
					{
						$dcode = $assigned['dcode'];
						$scode = $assigned['scode'];
						$sscode = $assigned['sscode'];
						$pos_name = $assigned['pos_name'];
						$borrowed = $assigned['borrowed'];
					}
				}
				// =========================================================================================================
				$sscode2 = '';
				if($borrowed == 'YES')
				{
					$sscode2 = $dcode.$scode.$sscode;
				}
				else
				{
					$emp_data = $this->cashier_model->get_empdata($emp_id);
					$company_code = '';
					$bunit_code = '';
					$dept_code = '';
					$section_code = '';
					$sub_section_code = '';
					foreach($emp_data as $data)
					{
						$company_code = $data['company_code'];
						$bunit_code = $data['bunit_code'];
						$dept_code = $data['dept_code'];
						$section_code = $data['section_code'];
						$sub_section_code = $data['sub_section_code'];
					}
					$sscode2 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
				}
				// ====================================jay update v1.0=======================================================
				$message = 'success';
				$validate_data = $this->cashier_model->validate_ncmop_model($emp_id,$_POST['mop_name'],$sscode2,$pos_name,$borrowed);
				if(empty($validate_data))
				{
					// $validated_trno = $this->cashier_model->validate_trno_model($_POST['tr_no'],$emp_id);
					// if(!empty($validated_trno))
					// {
					// 	$message = 'TRNO ALREADY USED';
					// 	echo json_encode($message);
					// }
					// else
					// {
						$this->cashier_model->insert_non_cash_model_v2($_POST['tr_no'],
																   $emp_id,
																   $sal_no,
																   $emp_name,
																   $emp_type,
																   $company_code,
																   $bunit_code,
																   $dep_code,
																   $section_code,
																   $sub_section_code,
																   $borrowed,
																   $_POST['pos_name'],
																   $_POST['counter_no'],
																   $_POST['mop_name'],
																   $_POST['nc_quantity'],
																   $_POST['nc_amount']);
					// }
				}
				else
				{
					$message = 'ALREADY EXIST';
				}

				echo json_encode($message);
			}
		}
	}

	public function noncash_denomination_borrowed_ctrl()
	{
		
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$emp_id = $_SESSION['emp_id'];
			$emp_data = $this->cashier_model->get_empdata($emp_id);

			$sal_no = '';
			$emp_name = '';
			$emp_type = '';
			$company_code = '';
			$bunit_code = '';
			$dep_code = '';
			$section_code = $_POST['cash_section'];
			$sub_section_code = $_POST['cash_subsection'];
			$borrowed = 'YES';
		// =========================================================================
			$default_code = '';
			$inputed_code = '';
			$dfsection_code = '';
			$dfsub_section_code = '';

			foreach ($emp_data as $d)
			{
				$sal_no = $d['payroll_no'];
				$emp_name = $d['name'];
				$emp_type = $d['emp_type'];
				$company_code = $d['company_code'];
				$bunit_code = $d['bunit_code'];
				$dep_code = $d['dept_code'];
				$dfsection_code = $d['section_code'];
				$dfsub_section_code = $d['sub_section_code'];
			}

			$default_code = $company_code.$bunit_code.$dep_code.$dfsection_code.$dfsub_section_code;
			$inputed_code = $company_code.$bunit_code.$dep_code.$section_code.$sub_section_code;
			if($default_code == $inputed_code)
			{
				$message = "INVALID";
				echo json_encode($message);
			}
			else
			{
				$message = 'success';
				$this->cashier_model->insert_non_cash_model($_POST['tr_no'],
															$_POST['batch_id'],
															$emp_id,
															$sal_no,
															$emp_name,
															$emp_type,
															$company_code,
															$bunit_code,
															$dep_code,
															$section_code,
															$sub_section_code,
															$borrowed,
															$_POST['amount_Arr']);
				
				echo json_encode($message);
			}
		}
	}

	public function noncash_denomination_borrowed_ctrl_v2()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$emp_id = $_SESSION['emp_id'];
			$current_date = date("Y-m-d");
			$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
			$dcode = '';
			$scode = '';
			$sscode = '';
			$pos_name = '';
			$borrowed = '';
			if(!empty($assigned_counter_data))
			{
				foreach($assigned_counter_data as $assigned)
				{
					$dcode = $assigned['dcode'];
					$scode = $assigned['scode'];
					$sscode = $assigned['sscode'];
					$pos_name = $assigned['pos_name'];
					$borrowed = $assigned['borrowed'];
				}
			}
			// =========================================================================================================
			$emp_data = $this->cashier_model->get_empdata($emp_id);
			$sal_no = '';
			$emp_name = '';
			$emp_type = '';
			$company_code = '';
			$bunit_code = '';
			$dept_code = '';
			$section_code = '';
			$sub_section_code = '';
			$sscode2 = '';
			if($borrowed == 'YES')
			{
				$section_code = $scode;
				$sub_section_code = $sscode;
				foreach($emp_data as $data)
				{
					$sal_no = $data['payroll_no'];
					$emp_name = $data['name'];
					$emp_type = $data['emp_type'];
					$company_code = $data['company_code'];
					$bunit_code = $data['bunit_code'];
					$dept_code = $data['dept_code'];
				}
				$sscode2 = $dcode.$scode.$sscode;
			}
			else
			{
				foreach($emp_data as $data)
				{
					$sal_no = $data['payroll_no'];
					$emp_name = $data['name'];
					$emp_type = $data['emp_type'];
					$company_code = $data['company_code'];
					$bunit_code = $data['bunit_code'];
					$dept_code = $data['dept_code'];
					$section_code = $data['section_code'];
					$sub_section_code = $data['sub_section_code'];
					$sscode2 = $data['company_code'].$data['bunit_code'].$data['dept_code'].$data['section_code'].$data['sub_section_code'];
				}
			}
			// =====================================jay update v1.0=================================================
			$message = 'success';
			$validate_data = $this->cashier_model->validate_ncmop_model($emp_id,$_POST['mop_name'],$sscode2,$pos_name,$borrowed);
			if(empty($validate_data))
			{ 
				// $validated_trno = $this->cashier_model->validate_trno_model($_POST['tr_no'],$emp_id);
				// if(!empty($validated_trno))
				// {
				// 	$message = 'TRNO ALREADY USED';
				// 	echo json_encode($message);
				// }
				// else
				// {
					$this->cashier_model->insert_non_cash_model_v2($_POST['tr_no'],
																	$emp_id,
																	$sal_no,
																	$emp_name,
																	$emp_type,
																	$company_code,
																	$bunit_code,
																	$dept_code,
																	$section_code,
																	$sub_section_code,
																	$borrowed,
																	$_POST['pos_name'],
																	$_POST['counter_no'],
																	$_POST['mop_name'],
																	$_POST['nc_quantity'],
																	$_POST['nc_amount']);
				// }
			}
			else
			{
				$message = 'ALREADY EXIST';
			}
			echo json_encode($message);
		}
	}

	public function get_batchid_ctrl()
	{
		$emp_id = $_SESSION['emp_id'];
		$batch_id = $this->cashier_model->get_batchid($emp_id);
		$validate_cashpending_checkbox = $this->cashier_model->validate_cashpending_checkbox_model($emp_id);
		$cashpending = 'WALAY PENDING';
		if(!empty($validate_cashpending_checkbox))
		{
			$cashpending = 'NAAY PENDING';
		}

		if(empty($batch_id))
		{
			$b_id = 1;
		}
		else
		{
			foreach ($batch_id as $batch)
			{	
				$id = $batch['batch_id'];
				$b_id = $id+1;
			}
		}

		$data['cashpending'] = $cashpending;
		$data['batchid'] = $b_id;
		echo json_encode($data);
	}

	public function disabled_noncashform_ctrl()
	{

		$emp_id = $_SESSION['emp_id'];
		$query=$this->cashier_model->disabled_noncashform_model($emp_id);

		$status="";
		foreach ($query as $q)
		{
			$status = $q['status'];
		}
			   
		$data=$status;    	   
		echo json_encode(trim($data));

	}

	public function view_noncashmodal_ctrl()
	{
		
		$noncash_data=$this->input->post('amount_Arr');
		
			$html='';
			for($a=0;$a<count($noncash_data);$a+=3)
			{
				if(($noncash_data[$a+1] > 0 && $noncash_data[$a+2] <= 0) || (($noncash_data[$a+1] == '' || $noncash_data[$a+1] <= 0) && $noncash_data[$a+2] > 0))
				{
					$message = 'MISSING DATA';
					echo json_encode($message);
					die;
				}
				else
				{
					$html.='
						<tr>
			                <td>
			                    <center><label>'.$noncash_data[$a].'</label></center>
			                </td>
			                <td>
			                    <center><label>'.$noncash_data[$a+1].'</label></center>
			                </td>
			                <td>
			                    <center><label>'.$noncash_data[$a+2].'</label></center>
			                </td>
			           	</tr>
						';
				}
			}

			$html.='

					 <tr>
	                	<td>
	                        <label></label>
	                    </td>
	                    <td>
	                        <center><label id="total_cashtxtm" style="font-weight: bold;">TOTAL NONCASH</label></center>
	                    </td>
	                    <td>
	                        <center><label id="total_noncashm_modal" style="font-weight: bold;"></label></center>
	                    </td>
	                </tr>

					';
		
		$data['html']=$html;    	      
		echo json_encode($data);

	}

	public function disabled_partialcheckbox_ctrl()
	{
		$current_date = date("Y-m-d");
		$emp_id = $_SESSION['emp_id'];
		$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
		$dcode = '';
		$scode = '';
		$sscode = '';
		$pos_name = '';
		$borrowed = '';
		if(!empty($assigned_counter_data))
		{
			foreach($assigned_counter_data as $assigned)
			{
				$dcode = $assigned['dcode'];
				$scode = $assigned['scode'];
				$sscode = $assigned['sscode'];
				$pos_name = $assigned['pos_name'];
				$borrowed = $assigned['borrowed'];
			}
		}
		// =========================================================================================================
		$sscode2 = '';
		if($borrowed == 'YES')
		{
			$sscode2 = $dcode.$scode.$sscode;
		}
		else
		{
			$emp_data = $this->cashier_model->get_empdata($emp_id);
			$company_code = '';
			$bunit_code = '';
			$dept_code = '';
			$section_code = '';
			$sub_section_code = '';
			foreach($emp_data as $data)
			{
				$company_code = $data['company_code'];
				$bunit_code = $data['bunit_code'];
				$dept_code = $data['dept_code'];
				$section_code = $data['section_code'];
				$sub_section_code = $data['sub_section_code'];
			}
			$sscode2 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
		}
		// ===============================jay update v1.0============================================================
		$query=$this->cashier_model->getpartialhistory_cashform_model_v2($emp_id,$sscode2,$pos_name,$borrowed);

		if(empty($query))
		{
			$status = 'EMPTY';
		}
		else
		{
			$status = 'NOT EMPTY';
		}

		echo json_encode($status);
	}

	public function displayhistory_noncashform_ctrl()
	{
		$emp_id = $_SESSION['emp_id'];
		$query=$this->cashier_model->displayhistory_noncashform_model($emp_id);

		if(!empty($query))
		{
			$edit_borrowed = '';
			//=================================================================
			$html="";
			$historyncashid="";
			$hmop_id = "";
			foreach ($query as $q)
			{
				$edit_borrowed = $q['edit_borrowed'];
				//=============================================================
				$hmop_id.="+hmop_".$q['id'];
				$historyncashid.="+".$q['id']."_q";
				$historyncashid.="+".$q['id']."_a";

				$disabled = 'disabled';
				if($q['edit_denomination'] == 'ENABLED')
				{
					$disabled = '';
				}
				$html.='

						<tr>
							<td>
							<input type="text" class="input-sm hmop_'.$q['id'].'" disabled id="" value="'.$q['mop_name'].'">
							</td>
							<td>
							<input type="number" min="0" '.$disabled.' class="input-sm quantity quantity_'.$q['id'].' hmop_'.$q['id'].'" id="'.$q['id'].'_q" value="'.$q['noncash_qty'].'">
							</td>
							<td>
							<input type="tel" '.$disabled.' onkeyup="total_hnoncash_js()" style="font-size: 22px; text-align: center; height: 50px; width: 100%;" class="input-sm hd_amount hmop_'.$q['id'].'" id="'.$q['id'].'_a" value="'.number_format($q['noncash_amount'],2).'">
							</td>
						</tr>

						
						<script>

							total_hnoncash_js();
		
							document.querySelector(".quantity_'.$q['id'].'").addEventListener("keypress", function (evt) {
								if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
								{
									evt.preventDefault();
								}
								});

							 $(".quantity").on("change keyup top press", function() {
			                  var sanitized = $(this).val().replace(/[^0-9]/g, "");
			                  $(this).val(sanitized);
			                });

						</script>

							';
				$data["noncashremit_type"]= $q["remit_type"];
				$data["hncash_bid"]= $q["batch_id"];


			}

				$html.='

						<tr>
							<td style="float: right">
	                        <button type="button" disabled="" id="btn_cancel_historyncashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-info waves-effect" onclick="canceledit_historynoncash_denomination()">CANCEL</button>
	                        <button type="button" disabled="" id="btn_update_historyncashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-warning waves-effect" onclick="update_historynoncashform_js()">UPDATE</button>
		                    </td>
							<td>
							<input type="text" class="input-sm" id="total_noncashtxt" disabled="" placeholder="TOTAL NONCASH">
							</td>
							<td>
							<input type="text" class="input-sm" disabled readonly id="historytotal_noncash" placeholder="0.00">
							</td>
						</tr>

						<script>

							$("#historyncashid").text("'.$historyncashid.'");
							$("#hncash_data").text("'.$hmop_id.'");
							$("#load_js").load("'.base_url().'hnoncash_js_route");

						</script>
						';
						// <button type="button" id="btn_edit_historyncashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-primary waves-effect" onclick="enabled_historynoncash_quantity_js()">EDIT</button>
			
			$data['edit_borrowed']=$edit_borrowed;    	   
			$data['html']=$html;    	   
			echo json_encode($data);
		}
	}

	public function displayhistory_noncashform_ctrl_v2()
	{
		$current_date = date("Y-m-d");
		$emp_id = $_SESSION['emp_id'];
		$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
		$dcode = '';
		$scode = '';
		$sscode = '';
		$pos_name = '';
		$counter_no = '';
		$borrowed = '';
		if(!empty($assigned_counter_data))
		{
			foreach($assigned_counter_data as $assigned)
			{
				$dcode = $assigned['dcode'];
				$scode = $assigned['scode'];
				$sscode = $assigned['sscode'];
				$pos_name = $assigned['pos_name'];
				$counter_no = $assigned['counter_no'];
				$borrowed = $assigned['borrowed'];
			}
		}
		// =========================================================================================================
		$scode2 = '';
		$sscode2 = '';
		$sname = '';
		$ssname = '';
		if($borrowed == 'YES')
		{
			$scode2 = $dcode.$scode;
			$sscode2 = $dcode.$scode.$sscode;
			$section_data = $this->cashier_model->get_section_name($scode2);
			$sub_section_data = $this->cashier_model->get_sub_section_name($sscode2);
			if(!empty($section_data))
			{
				$sname = $section_data->section_name;
				if(!empty($sub_section_data))
				{
					$ssname = $sub_section_data->sub_section_name;
				}
			}
		}
		else
		{
			$emp_data = $this->cashier_model->get_empdata($emp_id);
			$company_code = '';
			$bunit_code = '';
			$dept_code = '';
			$section_code = '';
			$sub_section_code = '';
			foreach($emp_data as $data)
			{
				$company_code = $data['company_code'];
				$bunit_code = $data['bunit_code'];
				$dept_code = $data['dept_code'];
				$section_code = $data['section_code'];
				$sub_section_code = $data['sub_section_code'];
			}
			$sscode2 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
		}
		// ===============================jay update v1.0============================================================
		if(!empty($assigned_counter_data))
		{
			$query=$this->cashier_model->displayhistory_noncashform_model_v2($emp_id,$sscode2,$pos_name,$borrowed);
			$html = '
					<table class="table table-striped table-bordered table-hover display" style="color: black; font-size: 12px;" id="historync_mop_table">
						<thead>
							<tr>
								<th>
									<center>MODE OF PAYMENT
								</th>
								<th>
									<center>QUANTITY
								</th>
								<th>
									<center>AMOUNT
								</th>
								<th>
									<center>ACTION
								</th>
							</tr>
						</thead>
						<tbody>
					';
			// ==================================================================================================================================
			$mop_name_array = array();
			$mop_name = '';
			$edit_borrowed = '';
			$add_mop = '';
			$edit_pos = '';
			$remit_type = '';
			$qty_total = 0;
			$amount_total = 0;
			foreach ($query as $q)
			{
				array_push($mop_name_array,$q['mop_name']);
				$disabled = 'style="cursor:not-allowed; text-decoration: none"';
				$mop_name = explode("'",$q['mop_name']);
				$mop_name = implode("",$mop_name);
				$edit_borrowed = $q['edit_borrowed'];
				$add_mop = $q['add_mop'];
				$edit_pos = $q['edit_pos'];
				$remit_type = $q['remit_type'];
				$qty_total += $q['noncash_qty'];
				$amount_total += $q['noncash_amount'];
				if($q['edit_denomination'] == 'ENABLED')
				{
					$disabled = '';
				}
				$html .= '
						<tr>
							<td style="text-align: center; font-size: 17px;">'.$q['mop_name'].'</td>
							<td style="text-align: center; font-size: 17px;">'.$q['noncash_qty'].'</td>
							<td style="text-align: center; font-size: 17px;">'.number_format($q['noncash_amount'], 2).'</td>
							<td style="text-align: center; font-size: 17px;">
								<a '.$disabled.' onclick="edit_history_noncash_pending_js('."'".$q['id']."','".$q['noncash_qty']."','".$q['noncash_amount']."','".$q['edit_denomination']."'".')">✏️</a>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<a '.$disabled.' onclick="delete_history_noncash_pending_js('."'".$q['id']."','".$mop_name."','".$q['edit_denomination']."'".')">❌</a>
							</td>
						</tr>
						';
			}

			$html .= '
							<tr>
								<td style="font-weight: bold; text-align: center; font-size: 17px;">TOTAL</td>
								<td style="font-weight: bold; text-align: center; font-size: 17px;">'.$qty_total.'</td>
								<td style="font-weight: bold; text-align: center; font-size: 17px;">'.number_format($amount_total, 2).'</td>
								<td style="font-weight: bold;"></td>
							</td>
						</tbody>
					</table>
					';
			
			$mop_list = '
						<option disabled selected>Select MOP</option>
						';
			if(!empty($mop_name_array))
			{
				$mop_name_data = $this->cashier_model->get_history_noncash_mop_name_model($emp_id,$mop_name_array);
				foreach($mop_name_data as $mop)
				{
					$mop_list .= '
								<option>'.$mop['mop_name'].'</option>
								';
				}
			}
			
			$data['mop_list']=$mop_list;       	   
			$data['add_mop']=$add_mop;    	   
			$data['pos_name']=$pos_name;    	   
			$data['counter_no']=$counter_no;    	   
			$data['borrowed']=$borrowed;    	   
			$data['sname']=$sname;    	   
			$data['ssname']=$ssname;    	   
			$data['remit_type']=$remit_type;    	   
			$data['html']=$html;    	   
			echo json_encode($data);
		}
		else
		{	
			$query=$this->cashier_model->displayhistory_noncashform_model($emp_id);
			$html = '
					<table class="table table-striped table-bordered table-hover display" style="color: black; font-size: 12px;" id="historync_mop_table">
						<thead>
							<tr>
								<th>
									<center>MODE OF PAYMENT
								</th>
								<th>
									<center>QUANTITY
								</th>
								<th>
									<center>AMOUNT
								</th>
								<th>
									<center>ACTION
								</th>
							</tr>
						</thead>
						<tbody>
					';
			// ==================================================================================================================================
			$mop_name_array = array();
			$mop_name = '';
			$edit_borrowed = '';
			$add_mop = '';
			$edit_pos = '';
			$remit_type = '';
			$pos_name = '';
			$counter_no = '';
			$borrowed = '';
			$scode = '';
			$sscode = '';
			$qty_total = 0;
			$amount_total = 0;
			foreach ($query as $q)
			{
				array_push($mop_name_array,$q['mop_name']);
				$disabled = 'style="cursor:not-allowed; text-decoration: none"';
				$mop_name = explode("'",$q['mop_name']);
				$mop_name = implode("",$mop_name);
				$edit_borrowed = $q['edit_borrowed'];
				$add_mop = $q['add_mop'];
				$edit_pos = $q['edit_pos'];
				$remit_type = $q['remit_type'];
				$pos_name = $q['pos_name'];
				$counter_no = $q['counter_no'];
				$borrowed = $q['borrowed'];
				$scode = $q['company_code'].$q['bunit_code'].$q['dep_code'].$q['section_code'];
				$sscode = $q['company_code'].$q['bunit_code'].$q['dep_code'].$q['section_code'].$q['sub_section_code'];
				$qty_total += $q['noncash_qty'];
				$amount_total += $q['noncash_amount'];
				if($q['edit_denomination'] == 'ENABLED')
				{
					$disabled = '';
				}
				$html .= '
						<tr>
							<td style="text-align: center; font-size: 17px;">'.$q['mop_name'].'</td>
							<td style="text-align: center; font-size: 17px;">'.$q['noncash_qty'].'</td>
							<td style="text-align: center; font-size: 17px;">'.number_format($q['noncash_amount'], 2).'</td>
							<td style="text-align: center; font-size: 17px;">
								<a '.$disabled.' onclick="edit_history_noncash_pending_js('."'".$q['id']."','".$q['noncash_qty']."','".number_format($q['noncash_amount'], 2)."','".$q['edit_denomination']."'".')">✏️</a>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<a '.$disabled.' onclick="delete_history_noncash_pending_js('."'".$q['id']."','".$mop_name."','".$q['edit_denomination']."'".')">❌</a>
							</td>
						</tr>
						';
			}

			$html .= '
							<tr>
								<td style="font-weight: bold; text-align: center; font-size: 17px;">TOTAL</td>
								<td style="font-weight: bold; text-align: center; font-size: 17px;">'.$qty_total.'</td>
								<td style="font-weight: bold; text-align: center; font-size: 17px;">'.number_format($amount_total, 2).'</td>
								<td style="font-weight: bold;"></td>
							</td>
						</tbody>
					</table>
					';
			
			$mop_list = '
						<option disabled selected>Select MOP</option>
						';
			if(!empty($mop_name_array))
			{
				$mop_name_data = $this->cashier_model->get_history_noncash_mop_name_model($emp_id,$mop_name_array);
				foreach($mop_name_data as $mop)
				{
					$mop_list .= '
								<option>'.$mop['mop_name'].'</option>
								';
				}
			}
			// =========================================================================================================
			$sname = '';
			$ssname = '';
			if($borrowed == 'YES')
			{
				$section_data = $this->cashier_model->get_section_name($scode);
				$sub_section_data = $this->cashier_model->get_sub_section_name($sscode);
				if(!empty($section_data))
				{
					$sname = $section_data->section_name;
					if(!empty($sub_section_data))
					{
						$ssname = $sub_section_data->sub_section_name;
					}
				}
			}
			else
			{
				$emp_data = $this->cashier_model->get_empdata($emp_id);
				$company_code = '';
				$bunit_code = '';
				$dept_code = '';
				$section_code = '';
				$sub_section_code = '';
				foreach($emp_data as $data)
				{
					$company_code = $data['company_code'];
					$bunit_code = $data['bunit_code'];
					$dept_code = $data['dept_code'];
					$section_code = $data['section_code'];
					$sub_section_code = $data['sub_section_code'];
				}
				$sscode2 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
			}
			// ============================================================================================================================================
			$data['mop_list']=$mop_list;       	   
			$data['add_mop']=$add_mop;    	   
			$data['pos_name']=$pos_name;    	   
			$data['counter_no']=$counter_no;    	   
			$data['borrowed']=$borrowed;    	   
			$data['sname']=$sname;    	   
			$data['ssname']=$ssname;    	   
			$data['remit_type']=$remit_type;    	   
			$data['html']=$html;    	   
			echo json_encode($data);
		}
	}

	public function update_historynoncashform_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$emp_id = $_SESSION['emp_id'];

			$update_hnc = 'success';
			$this->cashier_model->update_historynoncashform_model($emp_id,
																$_POST['batch_id'],
																$_POST['amount_Arr']);	

			echo json_encode($update_hnc);
		}
	}

	public function update_historynoncashform_borrowed_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$emp_id = $_SESSION['emp_id'];
			$section_code = $_POST['noncash_section'];
			$sub_section_code = $_POST['noncash_subsection'];
			$borrowed = 'YES';

			$update_hnc = 'success';
			$this->cashier_model->update_historynoncashform_model2($emp_id,
																$_POST['batch_id'],
																$_POST['amount_Arr'],
																$section_code,
																$sub_section_code,
																$borrowed);	

			echo json_encode($update_hnc);
		}
	}

	public function expired_session()
	{
		redirect('http://'.$_SERVER['HTTP_HOST'].'/EBS/cebo_cs_liquidation/'); 
	}

	public function display_hpartialdetails_ctrl()
	{
		$current_date = date("Y-m-d");
		$emp_id = $_SESSION['emp_id'];
		$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
		$dcode = '';
		$scode = '';
		$sscode = '';
		$pos_name = '';
		$counter_no = '';
		$borrowed = '';
		if(!empty($assigned_counter_data))
		{
			foreach($assigned_counter_data as $assigned)
			{
				$dcode = $assigned['dcode'];
				$scode = $assigned['scode'];
				$sscode = $assigned['sscode'];
				$pos_name = $assigned['pos_name'];
				$counter_no = $assigned['counter_no'];
				$borrowed = $assigned['borrowed'];
			}
		}
		// =========================================================================================================
		$sscode2 = '';
		if($borrowed == 'YES')
		{
			$sscode2 = $dcode.$scode.$sscode;
		}
		else
		{
			$emp_data = $this->cashier_model->get_empdata($emp_id);
			$company_code = '';
			$bunit_code = '';
			$dept_code = '';
			$section_code = '';
			$sub_section_code = '';
			foreach($emp_data as $data)
			{
				$company_code = $data['company_code'];
				$bunit_code = $data['bunit_code'];
				$dept_code = $data['dept_code'];
				$section_code = $data['section_code'];
				$sub_section_code = $data['sub_section_code'];
			}
			$sscode2 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
		}
		// ===============================jay update v1.0============================================================
		if(!empty($assigned_counter_data))
		{
			$query=$this->cashier_model->getpartialhistory_cashform_model_v2($emp_id,$sscode2,$pos_name,$borrowed);
			$html='';
			foreach($query as $q)
			{
				$onek = $q['onek'] * 1000;
				$fiveh = $q['fiveh'] * 500;
				$twoh = $q['twoh'] * 200;
				$oneh = $q['oneh'] * 100;
				$fifty = $q['fifty'] * 50;
				$twenty = $q['twenty'] * 20;
	
				
				$hide = '';
				$scode = '';
				$sscode = '';
				$section_name = '';
				$sub_section_name = '';
				if($q['borrowed'] == 'YES')
				{
					$hide = '';
					$scode = $q['company_code'].$q['bunit_code'].$q['dep_code'].$q['section_code'];
					$section_data = $this->cashier_model->get_section_name($scode);
					if(!empty($section_data))
					{
						$section_name = $section_data->section_name;
						$sscode = $q['company_code'].$q['bunit_code'].$q['dep_code'].$q['section_code'].$q['sub_section_code'];
						$sub_section_data = $this->cashier_model->get_sub_section_name($sscode);
						if(!empty($sub_section_data))
						{
							$sub_section_name = $sub_section_data->sub_section_name;
						}
						else
						{
							$sub_section_name = '';
						}
					}
					else
					{
						$section_name = '';
						$sub_section_name = '';
					}
				}
				else
				{
					$hide = 'hidden';
					$scode = '';
					$sscode = '';
					$section_name = '';
					$sub_section_name = '';
				}
	
				$html.='
	
					<form '.$hide.'>
						<center>
							<label id="cash_borrow_lbl" style="font-weight: bold;">BORROWED</label><br>
							<label id="section_lbl" style="font-weight: bold;">SECTION:</label>
							<label id="section_txt" style="font-weight: bold;">'.$section_name.'</label><br>
							<label id="sub_section_lbl" style="font-weight: bold;">SUB SECTION:</label>
							<label id="sub_section_txt" style="font-weight: bold;">'.$sub_section_name.'</label>
						</center>
					</form>
	
					<form>
						<center>
							<label id="" style="font-weight: bold;">'.$pos_name.'</label>
							<label id="" style="font-weight: bold;">'.$counter_no.'</label><br>
							<label id="hpartialdetails_datelblmodal" style="font-weight: bold;">Date/Time Submitted -- '.$q['date_submit'].'</label>
						</center>
					</form>
	
					<div class="table-scrollable">
					  <table class="table table-striped table-bordered table-hover display">
						  <thead>
							  <tr>
								  <th width="40%">
									  <center>DENOMINATION
								  </th>
								  <th width="30%">
									  <center>QUANTITY
								  </th>
								  <th width="30%">
									  <center>AMOUNT
								  </th>
							  </tr>
						  </thead>
							  <form name="hpartialdetails_formmodal" id="hpartialdetails_formmodal">
								  <tbody id="hpartialdetails_tbodymmodal">
	
					<tr>
						<td>
							<center><label id="d_onekm">₱1,000</label></center>
						</td>
						<td>
							<center><label class="quantity" id="q_onek">'.$q['onek'].'</label></center>
						</td>
						<td>
							<center><label class="d_amount" id="a_onek">'.number_format($onek, 2).'</label></center>
						</td>
					</tr>
	
					<tr>
						<td>
							<center><label id="d_fivehm">₱500</label></center>
						</td>
						<td>
							<center><label class="quantity1" id="q_fiveh">'.$q['fiveh'].'</label></center>
						</td>
						<td>
							<center><label class="d_amount" id="a_fiveh">'.number_format($fiveh, 2).'</label></center>
						</td>
					</tr>
	
					<tr>
						<td>
							<center><label id="d_twohm">₱200</label></center>
						</td>
						<td>
							<center><label class="quantity2" id="q_twoh">'.$q['twoh'].'</label></center>
						</td>
						<td>
							<center><label class="d_amount" id="a_twoh">'.number_format($twoh, 2).'</label></center>
						</td>
					</tr>
	
					<tr>
						<td>
							<center><label id="d_onehm">₱100</label></center>
						</td>
						<td>
							<center><label class="quantity3" id="q_oneh">'.$q['oneh'].'</label></center>
						</td>
						<td>
							<center><label class="d_amount" id="a_oneh">'.number_format($oneh, 2).'</label></center>
						</td>
					</tr>
	
					<tr>
						<td>
							<center><label id="d_fiftym">₱50</label></center>
						</td>
						<td>
							<center><label class="quantity4" id="q_fifty">'.$q['fifty'].'</label></center>
						</td>
						<td>
							<center><label class="d_amount" id="a_fifty">'.number_format($fifty, 2).'</label></center>
						</td>
					</tr>
	
					<tr>
						<td>
							<center><label id="d_twentym">₱20</label></center>
						</td>
						<td>
							<center><label class="quantity5" id="q_twenty">'.$q['twenty'].'</label></center>
						</td>
						<td>
							<center><label class="d_amount" id="a_twenty">'.number_format($twenty, 2).'</label></center>
						</td>
					</tr>
	
					<tr>
						<td>
							<label></label>
						</td>
						<td>
							<center><label id="total_cashtxtm" style="font-weight: bold;">TOTAL PARTIAL CASH</label></center>
						</td>
						<td>
							<center><label class="d_amount" id="total_cashm" style="font-weight: bold;">'.number_format($q['total_cash'], 2).'</label></center>
						</td>
					</tr>
	
						  </tbody>
						</form>
					  </table>
					</div><br>
	
					';
			}
	
			$data['html']=$html;    	   
			echo json_encode($data);
		}
		else
		{
			$query=$this->cashier_model->getpartialhistory_cashform_model($emp_id);
			$html='';
			foreach($query as $q)
			{
				$onek = $q['onek'] * 1000;
				$fiveh = $q['fiveh'] * 500;
				$twoh = $q['twoh'] * 200;
				$oneh = $q['oneh'] * 100;
				$fifty = $q['fifty'] * 50;
				$twenty = $q['twenty'] * 20;
	
				$hide = '';
				$scode = '';
				$sscode = '';
				$section_name = '';
				$sub_section_name = '';
				if($q['borrowed'] == 'YES')
				{
					$hide = '';
					$scode = $q['company_code'].$q['bunit_code'].$q['dep_code'].$q['section_code'];
					$section_data = $this->cashier_model->get_section_name($scode);
					if(!empty($section_data))
					{
						$section_name = $section_data->section_name;
						$sscode = $q['company_code'].$q['bunit_code'].$q['dep_code'].$q['section_code'].$q['sub_section_code'];
						$sub_section_data = $this->cashier_model->get_sub_section_name($sscode);
						if(!empty($sub_section_data))
						{
							$sub_section_name = $sub_section_data->sub_section_name;
						}
						else
						{
							$sub_section_name = '';
						}
					}
					else
					{
						$section_name = '';
						$sub_section_name = '';
					}
				}
				else
				{
					$hide = 'hidden';
					$scode = '';
					$sscode = '';
					$section_name = '';
					$sub_section_name = '';
				}
	
				$html.='
	
					<form '.$hide.'>
						<center>
							<label id="cash_borrow_lbl" style="font-weight: bold;">BORROWED</label><br>
							<label id="section_lbl" style="font-weight: bold;">SECTION:</label>
							<label id="section_txt" style="font-weight: bold;">'.$section_name.'</label><br>
							<label id="sub_section_lbl" style="font-weight: bold;">SUB SECTION:</label>
							<label id="sub_section_txt" style="font-weight: bold;">'.$sub_section_name.'</label>
						</center>
					</form>
	
					<form>
						<center>
							<label id="" style="font-weight: bold;">'.$q['pos_name'].'</label>
							<label id="" style="font-weight: bold;">'.$q['counter_no'].'</label><br>
							<label id="hpartialdetails_datelblmodal" style="font-weight: bold;">Date/Time Submitted -- '.$q['date_submit'].'</label>
						</center>
					</form>
	
					<div class="table-scrollable">
					  <table class="table table-striped table-bordered table-hover display">
						  <thead>
							  <tr>
								  <th width="40%">
									  <center>DENOMINATION
								  </th>
								  <th width="30%">
									  <center>QUANTITY
								  </th>
								  <th width="30%">
									  <center>AMOUNT
								  </th>
							  </tr>
						  </thead>
							  <form name="hpartialdetails_formmodal" id="hpartialdetails_formmodal">
								  <tbody id="hpartialdetails_tbodymmodal">
	
					<tr>
						<td>
							<center><label id="d_onekm">₱1,000</label></center>
						</td>
						<td>
							<center><label class="quantity" id="q_onek">'.$q['onek'].'</label></center>
						</td>
						<td>
							<center><label class="d_amount" id="a_onek">'.number_format($onek, 2).'</label></center>
						</td>
					</tr>
	
					<tr>
						<td>
							<center><label id="d_fivehm">₱500</label></center>
						</td>
						<td>
							<center><label class="quantity1" id="q_fiveh">'.$q['fiveh'].'</label></center>
						</td>
						<td>
							<center><label class="d_amount" id="a_fiveh">'.number_format($fiveh, 2).'</label></center>
						</td>
					</tr>
	
					<tr>
						<td>
							<center><label id="d_twohm">₱200</label></center>
						</td>
						<td>
							<center><label class="quantity2" id="q_twoh">'.$q['twoh'].'</label></center>
						</td>
						<td>
							<center><label class="d_amount" id="a_twoh">'.number_format($twoh, 2).'</label></center>
						</td>
					</tr>
	
					<tr>
						<td>
							<center><label id="d_onehm">₱100</label></center>
						</td>
						<td>
							<center><label class="quantity3" id="q_oneh">'.$q['oneh'].'</label></center>
						</td>
						<td>
							<center><label class="d_amount" id="a_oneh">'.number_format($oneh, 2).'</label></center>
						</td>
					</tr>
	
					<tr>
						<td>
							<center><label id="d_fiftym">₱50</label></center>
						</td>
						<td>
							<center><label class="quantity4" id="q_fifty">'.$q['fifty'].'</label></center>
						</td>
						<td>
							<center><label class="d_amount" id="a_fifty">'.number_format($fifty, 2).'</label></center>
						</td>
					</tr>
	
					<tr>
						<td>
							<center><label id="d_twentym">₱20</label></center>
						</td>
						<td>
							<center><label class="quantity5" id="q_twenty">'.$q['twenty'].'</label></center>
						</td>
						<td>
							<center><label class="d_amount" id="a_twenty">'.number_format($twenty, 2).'</label></center>
						</td>
					</tr>
	
					<tr>
						<td>
							<label></label>
						</td>
						<td>
							<center><label id="total_cashtxtm" style="font-weight: bold;">TOTAL PARTIAL CASH</label></center>
						</td>
						<td>
							<center><label class="d_amount" id="total_cashm" style="font-weight: bold;">'.number_format($q['total_cash'], 2).'</label></center>
						</td>
					</tr>
	
						  </tbody>
						</form>
					  </table>
					</div><br>
	
					';
			}
	
			$data['html']=$html;    	   
			echo json_encode($data);
		}
	}

	public function get_section_ctrl()
	{

		$emp_id = $_SESSION['emp_id'];
		$emp_data = $this->cashier_model->get_empdata($emp_id);
		
		$company_code = '';
		$bunit_code = '';
		$dept_code = '';
		foreach($emp_data as $data)
		{
			// $dept_code = $data['company_code'].$data['bunit_code'].$data['dept_code'];
			$company_code = $data['company_code'];
			$bunit_code = $data['bunit_code'];
			$dept_code = $data['dept_code'];
		}

		$query=$this->cashier_model->get_section_model($company_code,$bunit_code,$dept_code);
		
		$html = '
				<option id="" disabled selected value="">SELECT SECTION</option>
				';
		foreach ($query as $q)
		{
	
			$html.='
					<option id="" value="'.$q['section_code'].'">'.$q['section_name'].'</option>
				   ';
		}

		$data['html']=$html;    	   
		echo json_encode($data);
	}

	public function get_sub_section_ctrl()
	{
		$emp_id = $_SESSION['emp_id'];
		$emp_data = $this->cashier_model->get_empdata($emp_id);
		
		$company_code = '';
		$bunit_code = '';
		$dept_code = '';
		$section_code = $_POST['section_code'];
		foreach($emp_data as $data)
		{
			// $dept_code = $data['company_code'].$data['bunit_code'].$data['dept_code'];
			$company_code = $data['company_code'];
			$bunit_code = $data['bunit_code'];
			$dept_code = $data['dept_code'];
			// $section_code = $data['section_code'];
		}

		$query=$this->cashier_model->get_sub_section_model($company_code,$bunit_code,$dept_code,$section_code);
		
		$html = '
				<option id="" disabled selected value="">SELECT SUB SECTION</option>
				';
		foreach ($query as $q)
		{
	
			$html.='

					<option id="" value="'.$q['sub_section_code'].'">'.$q['sub_section_name'].'</option>

						';
		}

		$data['html']=$html;    	   
		echo json_encode($data);
	}

	public function validate_cash_borrowed_ctrl()
	{
		$emp_id = $_SESSION['emp_id'];
		$borrowed_data = $this->cashier_model->validate_cash_borrowed_model($emp_id);
		if (empty($borrowed_data))
		{
			$pos_data = $this->cashier_model->get_cash_pos_model($emp_id);
			$edit_pos = '';
			$pos_name = '';
			$counter_no = '';
			foreach($pos_data as $pos)
			{
				$edit_pos = $pos['edit_pos'];
				$pos_name = $pos['pos_name'];
				$counter_no = $pos['counter_no'];
			}

			$data['edit_pos'] = $edit_pos;
			$data['pos_name'] = $pos_name;
			$data['counter_no'] = $counter_no;
			$data['message'] = 'NOT BORROWED';
			echo json_encode($data);
		}
		else
		{
			$edit_pos = '';
			$pos_name = '';
			$counter_no = '';
			$scode = '';
			$sscode = '';
			foreach($borrowed_data as $borrow)
			{
				$edit_pos = $borrow['edit_pos'];
				$pos_name = $borrow['pos_name'];
				$counter_no = $borrow['counter_no'];
				$scode = $borrow['company_code'].$borrow['bunit_code'].$borrow['dep_code'].$borrow['section_code'];
				$sscode = $borrow['company_code'].$borrow['bunit_code'].$borrow['dep_code'].$borrow['section_code'].$borrow['sub_section_code'];
			}

			$section_name = '';
			$sname = $this->cashier_model->get_section_name($scode);
			if(!empty($sname))
			{
				$section_name = $sname->section_name;
			}
			
			$sub_section_name = '';
			$ssname = $this->cashier_model->get_sub_section_name($sscode);
			if(!empty($ssname))
			{
				$sub_section_name = $ssname->sub_section_name;
			}

			$data['edit_pos'] = $edit_pos;
			$data['pos_name'] = $pos_name;
			$data['counter_no'] = $counter_no;
			$data['sname'] = $section_name;
			$data['ssname'] = $sub_section_name;
			$data['message'] = 'BORROWED';
			echo json_encode($data);
		}
	}

	public function validate_cash_borrowed_ctrl_v2()
	{
		$current_date = date("Y-m-d");
		$emp_id = $_SESSION['emp_id'];
		$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
		$dcode = '';
		$scode = '';
		$sscode = '';
		$pos_name = '';
		$counter_no = '';
		$borrowed = '';
		if(!empty($assigned_counter_data))
		{
			foreach($assigned_counter_data as $assigned)
			{
				$dcode = $assigned['dcode'];
				$scode = $assigned['scode'];
				$sscode = $assigned['sscode'];
				$pos_name = $assigned['pos_name'];
				$counter_no = $assigned['counter_no'];
				$borrowed = $assigned['borrowed'];
			}
		}
		// =========================================================================================================
		$scode2 = '';
		$sscode2 = '';
		if($borrowed == 'YES')
		{
			$scode2 = $dcode.$scode;
			$sscode2 = $dcode.$scode.$sscode;
		}
		else
		{
			$emp_data = $this->cashier_model->get_empdata($emp_id);
			$company_code = '';
			$bunit_code = '';
			$dept_code = '';
			$section_code = '';
			$sub_section_code = '';
			foreach($emp_data as $data)
			{
				$company_code = $data['company_code'];
				$bunit_code = $data['bunit_code'];
				$dept_code = $data['dept_code'];
				$section_code = $data['section_code'];
				$sub_section_code = $data['sub_section_code'];
			}
			$scode2 = $company_code.$bunit_code.$dept_code.$section_code;
			$sscode2 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
		}
		// ===============================jay update noncash v1.0============================
		$borrowed_data = $this->cashier_model->validate_cash_borrowed_model_v2($emp_id,$sscode2,$pos_name,$borrowed);
		if (empty($borrowed_data))
		{
			$data['pos_name'] = $pos_name;
			$data['counter_no'] = $counter_no;
			$data['message'] = 'NOT BORROWED';
			echo json_encode($data);
		}
		else
		{
			$section_name = '';
			$sname = $this->cashier_model->get_section_name($scode2);
			if(!empty($sname))
			{
				$section_name = $sname->section_name;
			}
			
			$sub_section_name = '';
			$ssname = $this->cashier_model->get_sub_section_name($sscode2);
			if(!empty($ssname))
			{
				$sub_section_name = $ssname->sub_section_name;
			}

			$data['pos_name'] = $pos_name;
			$data['counter_no'] = $counter_no;
			$data['sname'] = $section_name;
			$data['ssname'] = $sub_section_name;
			$data['message'] = 'BORROWED';
			echo json_encode($data);
		}
	}

	public function validate_noncash_borrowed_ctrl()
	{
		$borrowed_data = $this->cashier_model->validate_noncash_borrowed_model($_SESSION['emp_id']);

		if (empty($borrowed_data))
		{
			$message = 'NOT BORROWED';

			echo json_encode($message);
		}
		else
		{
			$scode = '';
			$sscode = '';
			foreach($borrowed_data as $borrow)
			{
				$scode = $borrow['company_code'].$borrow['bunit_code'].$borrow['dep_code'].$borrow['section_code'];
				$sscode = $borrow['company_code'].$borrow['bunit_code'].$borrow['dep_code'].$borrow['section_code'].$borrow['sub_section_code'];
			}

			$section_name = '';
			$sname = $this->cashier_model->get_section_name($scode);
			if(!empty($sname))
			{
				$section_name = $sname->section_name;
			}
			
			$sub_section_name = '';
			$ssname = $this->cashier_model->get_sub_section_name($sscode);
			if(!empty($ssname))
			{
				$sub_section_name = $ssname->sub_section_name;
			}

			$data['sname'] = $section_name;
			$data['ssname'] = $sub_section_name;
			$data['message'] = 'BORROWED';
			echo json_encode($data);
		}
	}

	public function validate_cash_access_ctrl()
	{
		$validated_data = $this->cashier_model->validate_cash_access_model($_SESSION['emp_id']);
		
		if(empty($validated_data))
		{
			$message = 'NO ACCESS';

			echo json_encode($message);
		}
		else
		{
			$message = 'VALIDATED';

			echo json_encode($message);
		}
	}

	public function validate_edit_cash_ctrl()
	{
		$edit_data = $this->cashier_model->validate_edit_cash_model($_SESSION['emp_id']);
		
		if(!empty($edit_data))
		{
			$edit_den = '';
			$edit_den_status = '';
			foreach($edit_data as $edit)
			{
				$edit_den = $edit['edit_denomination'];
				$edit_den_status = $edit['edit_status_denomination'];
			}
			
			$data['edit_den'] = $edit_den;
			$data['edit_den_status'] = $edit_den_status;
			echo json_encode($data);
		}
	}

	public function view_previous_den_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$previous_data = $this->cashier_model->get_previous_data_model($_SESSION['emp_id'],$_POST['from'],$_POST['to']);
			if(!empty($previous_data))
			{
				$html='
						<form>
							<table class="table table-bordered table-hover table-condensed display" id="previous_den_table">
								<thead>
									<tr>                                                            
										<th>
											<center>SALES DATE</center>
										</th>
										<th>
											<center>B.U / DEPT.</center>
										</th>
										<th>
											<center>SALES REMITTANCE</center>
										</th>
										<th>
											<center>REGISTERED SALES</center>
										</th>   
										<th>
											<center>TYPE</center>
										</th> 
										<th>
											<center>AMOUNT</center>
										</th>                        
									</tr>
								</thead>
						';
					// <th>
					// 	<center>STATUS</center>
					// </th>   
				foreach($previous_data as $prev)
				{
					$dname = '';
					$sname = '';
					$ssname = '';
					$type = '';
					$status = '';
					$br1 = '';
					$br2 = '';
					$br3 = '';

					$bunit_data = $this->liquidation_model->get_pisbunit_v2($prev['bcode']);

					$dept_data = $this->liquidation_model->get_pisdepartment_v2($prev['dcode']);
					if(!empty($dept_data))
					{
						$dname = $dept_data->dept_name;
						$br1 = '<br>';
					}

					$section_data = $this->liquidation_model->get_section_v2($prev['scode']);
					if(!empty($section_data))
					{
						$sname = $section_data->section_name;
						$br2 = '<br>';
					}
					
					$sub_section_data = $this->liquidation_model->get_subsection_v2($prev['sscode']);
					if(!empty($sub_section_data))
					{
						$ssname = $sub_section_data->sub_section_name;
						$br3 = '<br>';
					}

					if($prev['sop_type'] == 'S')
					{
						$type = 'SHORT';
					}
					else if($prev['sop_type'] == 'O')
					{
						$type = 'OVER';
					}
					else if($prev['sop_type'] == 'PF')
					{
						$type = 'PERFECT';
					}

					if($prev['sop_type'] == 'S' && $prev['sop'] > 0)
					{
						$status = 'UNPAID';
					}
					else if($prev['sop_type'] == 'S' && $prev['sop'] <= 0)
					{
						$status = 'PAID';
					}
					else if($prev['sop_type'] == 'O' || $prev['sop_type'] == 'PF')
					{
						$status = '------';
					}
					$html.=' 
							<tr style="word-wrap:break-word;">
								<td style="vertical-align: middle;">'.$prev['dsales'].'</td>
								<td>'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
								<td style="vertical-align: middle;">'.number_format($prev['gtotal'], 2).'</td>
								<td style="vertical-align: middle;">'.number_format($prev['rsales'], 2).'</td>
								<td style="vertical-align: middle;">'.$type.'</td>
								<td style="vertical-align: middle;">'.number_format($prev['sop'], 2).'</td>
							</tr>
							'; 
								// <td style="vertical-align: middle;">'.$status.'</td>
				}
				
				$html.='                      
								</table>
							</form> 
							';

				$data['html']=$html;         
				echo json_encode($data);
			}
		}
	}

	public function display_pos_name_ctrl()
	{
		$emp_info = $this->cashier_model->get_empdata($_SESSION['emp_id']);
		$dcode = '';
		foreach($emp_info as $info)
		{
			$dcode = $info['company_code'].$info['bunit_code'].$info['dept_code'];
		}
		
		$html = '
				<option disabled selected>Select POS</option>
				';
		$pos_data = $this->cashier_model->get_pos_counter_no_model($dcode);
		foreach($pos_data as $pos)
		{
			$html .= '
				<option value="'.$pos['counter_no'].'">'.$pos['pos_name'].'</option>
				';
		}

		$data['html'] = $html;
		echo json_encode($data);
	}

	public function display_history_pos_name_ctrl()
	{
		$emp_info = $this->cashier_model->get_empdata($_SESSION['emp_id']);
		$dcode = '';
		foreach($emp_info as $info)
		{
			$dcode = $info['company_code'].$info['bunit_code'].$info['dept_code'];
		}
		
		$html = '
				<option disabled selected>Select POS</option>
				';
		$pos_data = $this->cashier_model->get_history_pos_counter_no_model($_POST['pos_name'],$dcode);
		foreach($pos_data as $pos)
		{
			$html .= '
				<option value="'.$pos['counter_no'].'">'.$pos['pos_name'].'</option>
				';
		}

		$data['html'] = $html;
		echo json_encode($data);
	}

	public function validate_borrowed_ctrl()
	{
		$validate_data =  $this->cashier_model->validate_borrowed_model($_SESSION['emp_id']);
		$sample_data = $this->cashier_model->get_allsample_model($_SESSION['emp_id']);
		$message = '';
		if(empty($validate_data))
		{
			if(empty($sample_data))
			{
				$message = 'WALAY PENDING';
			}
		}
		$borrowed = '';
		$pos_name = '';
		$counter_no = '';
		$scode = '';
		$sscode = '';
		if(!empty($validate_data))
		{
			foreach($validate_data as $data)
			{
				$borrowed = $data['borrowed'];
				$pos_name = $data['pos_name'];
				$counter_no = $data['counter_no'];
				$scode = $data['scode'];
				$sscode = $data['sscode'];
			}
		}
		// =======================================================================================
		$tr_no = '';
		$get_trno = $this->cashier_model->get_nctrno_model($_SESSION['emp_id']);
		$new_trno = $this->cashier_model->get_new_trno_model();
		if(!empty($get_trno))
		{
			$tr_no = $get_trno->tr_no;
		}
		else
		{
			if(!empty($new_trno))
			{	
				$tr_no = $new_trno->id+1;
			}
			else
			{
				$tr_no = 1;
			}
		}
		// =======================================================================================
		$sname = '';
		$ssname = '';
		$section_data =  $this->cashier_model->get_section_name($scode);
		$sub_section_data =  $this->cashier_model->get_sub_section_name($sscode);
		if(!empty($section_data))
		{
			$sname = $section_data->section_name;
			$sname = '
					<option value="'.$section_data->section_code.'">'.$sname.'</option>
					';

			// ======================================================================================
			if(!empty($sub_section_data))
			{
				$ssname = $sub_section_data->sub_section_name;
				$ssname = '
						<option value="'.$sub_section_data->sub_section_code.'">'.$ssname.'</option>
						';
			}
		}
		// ======================================================================================
		$pos_name = '
					<option>'.$pos_name.'</option>
					';
		
		$data['message'] = $message;
		$data['tr_no'] = $tr_no;
		$data['borrowed'] = $borrowed;
		$data['pos_name'] = $pos_name;
		$data['counter_no'] = $counter_no;
		$data['sname'] = $sname;
		$data['ssname'] = $ssname;
		echo json_encode($data);
	}

	public function validate_borrowed_ctrl_v2()
	{
		$current_date = date("Y-m-d");
		$emp_id = $_SESSION['emp_id'];
		$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
		$assigned_counter = '';
		$dcode = '';
		$scode = '';
		$sscode = '';
		$pos_name = '';
		$pos_name2 = '';
		$counter_no = '';
		$borrowed = '';
		if(!empty($assigned_counter_data))
		{
			$assigned_counter = 'NOT EMPTY';
			foreach($assigned_counter_data as $assigned)
			{
				$dcode = $assigned['dcode'];
				$scode = $assigned['scode'];
				$sscode = $assigned['sscode'];
				$pos_name = '
							<option value="'.$assigned['counter_no'].'">'.$assigned['pos_name'].'</option>
							';
				$pos_name2 = $assigned['pos_name'];
				$counter_no = $assigned['counter_no'];
				$borrowed = $assigned['borrowed'];
			}
		}
		// =========================================================================================================
		$scode2 = '';
		$sscode2 = '';
		$sscode3 = '';
		$sname = '';
		$ssname = '';
		if($borrowed == 'YES')
		{
			$scode2 = $dcode.$scode;
			$sscode2 = $dcode.$scode.$sscode;
			$sscode3 = $dcode.$scode.$sscode;
			$section_data = $this->cashier_model->get_section_name($scode2);
			$sub_section_data = $this->cashier_model->get_sub_section_name($sscode2);
			if(!empty($section_data))
			{
				$sname = '
						<option value="'.$section_data->section_code.'">'.$section_data->section_name.'</option>
						';
				if(!empty($sub_section_data))
				{
					$ssname = '
							<option value="'.$sub_section_data->sub_section_code.'">'.$sub_section_data->sub_section_name.'</option>
							';
				}
			}
		}
		else
		{
			$emp_data = $this->cashier_model->get_empdata($emp_id);
			$company_code = '';
			$bunit_code = '';
			$dept_code = '';
			$section_code = '';
			$sub_section_code = '';
			foreach($emp_data as $data)
			{
				$company_code = $data['company_code'];
				$bunit_code = $data['bunit_code'];
				$dept_code = $data['dept_code'];
				$section_code = $data['section_code'];
				$sub_section_code = $data['sub_section_code'];
			}
			$sscode3 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
		}
		// ========================================jay update noncash v1.0===============================================
		$tr_no = '';
		$get_trno = $this->cashier_model->get_nctrno_model_v2($emp_id,$sscode3,$pos_name2,$borrowed);
		$new_trno = $this->cashier_model->get_new_trno_model();
		if(!empty($get_trno))
		{
			$tr_no = $get_trno->tr_no;
		}
		else
		{
			if(!empty($new_trno))
			{	
				$tr_no = $new_trno->tr_no+1;
			}
			else
			{
				$tr_no = 1;
			}
		}

		$data['assigned_counter'] = $assigned_counter;
		$data['tr_no'] = $tr_no;
		$data['borrowed'] = $borrowed;
		$data['pos_name'] = $pos_name;
		$data['counter_no'] = $counter_no;
		$data['sname'] = $sname;
		$data['ssname'] = $ssname;
		echo json_encode($data);
	}

	public function display_mop_ctrl_v2()
	{
		$mop_data = $this->cashier_model->get_mop_model($_SESSION['emp_id']);
		$message = '';
		$html = '
				<option disabled selected>Select MOP</option>
				';
		if(!empty($mop_data))
		{
			foreach($mop_data as $mop)
			{
				$html .= '
						<option>'.$mop['mop_name'].'</option>
						';
			}
		}
		else
		{
			$message = 'NO ACCESS';
		}

		$data['message'] = $message;
		$data['html'] = $html;
		echo json_encode($data);
	}

	public function validate_sample_ctrl()
	{
		$current_date = date("Y-m-d");
		$emp_id = $_SESSION['emp_id'];
		$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
		$dcode = '';
		$scode = '';
		$sscode = '';
		$pos_name = '';
		$pos_name2 = '';
		$counter_no = '';
		$borrowed = '';
		if(!empty($assigned_counter_data))
		{
			foreach($assigned_counter_data as $assigned)
			{
				$dcode = $assigned['dcode'];
				$scode = $assigned['scode'];
				$sscode = $assigned['sscode'];
				$pos_name = '
							<option value="'.$assigned['counter_no'].'">'.$assigned['pos_name'].'</option>
							';
				$pos_name2 = $assigned['pos_name'];
				$counter_no = $assigned['counter_no'];
				$borrowed = $assigned['borrowed'];
			}
		}
		// =========================================================================================================
		$scode2 = '';
		$sscode2 = '';
		$sscode3 = '';
		$sname = '';
		$ssname = '';
		if($borrowed == 'YES')
		{
			$scode2 = $dcode.$scode;
			$sscode2 = $dcode.$scode.$sscode;
			$sscode3 = $dcode.$scode.$sscode;
			$section_data = $this->cashier_model->get_section_name($scode2);
			$sub_section_data = $this->cashier_model->get_sub_section_name($sscode2);
			if(!empty($section_data))
			{
				$sname = '
						<option value="'.$section_data->section_code.'">'.$section_data->section_name.'</option>
						';
				if(!empty($sub_section_data))
				{
					$ssname = '
							<option value="'.$sub_section_data->sub_section_code.'">'.$sub_section_data->sub_section_name.'</option>
							';
				}
			}
		}
		else
		{
			$emp_data = $this->cashier_model->get_empdata($emp_id);
			$company_code = '';
			$bunit_code = '';
			$dept_code = '';
			$section_code = '';
			$sub_section_code = '';
			foreach($emp_data as $data)
			{
				$company_code = $data['company_code'];
				$bunit_code = $data['bunit_code'];
				$dept_code = $data['dept_code'];
				$section_code = $data['section_code'];
				$sub_section_code = $data['sub_section_code'];
			}
			$sscode3 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
		}

		$data['pos_name'] = $pos_name;
		$data['counter_no'] = $counter_no;
		$data['borrowed'] = $borrowed;
		$data['sname'] = $sname;
		$data['ssname'] = $ssname;
		echo json_encode($data);
	}

	public function display_sample_ctrl()
	{
		$current_date = date("Y-m-d");
		$emp_id = $_SESSION['emp_id'];
		$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
		$dcode = '';
		$scode = '';
		$sscode = '';
		$pos_name = '';
		$counter_no = '';
		$borrowed = '';
		if(!empty($assigned_counter_data))
		{
			foreach($assigned_counter_data as $assigned)
			{
				$dcode = $assigned['dcode'];
				$scode = $assigned['scode'];
				$sscode = $assigned['sscode'];
				$pos_name = $assigned['pos_name'];
				$counter_no = $assigned['counter_no'];
				$borrowed = $assigned['borrowed'];
			}
		}
		// =========================================================================================================
		$sscode2 = '';
		if($borrowed == 'YES')
		{
			$sscode2 = $dcode.$scode.$sscode;
		}
		else
		{
			$emp_data = $this->cashier_model->get_empdata($emp_id);
			$company_code = '';
			$bunit_code = '';
			$dept_code = '';
			$section_code = '';
			$sub_section_code = '';
			foreach($emp_data as $data)
			{
				$company_code = $data['company_code'];
				$bunit_code = $data['bunit_code'];
				$dept_code = $data['dept_code'];
				$section_code = $data['section_code'];
				$sub_section_code = $data['sub_section_code'];
			}
			$sscode2 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
		}
		// ===============================jay update noncash v1.0============================
		$sample_data = $this->cashier_model->get_allsample_model_v2($emp_id,$sscode2,$pos_name,$borrowed);
		$message = '';
		if(!empty($sample_data))
		{
			$message = 'NAAY SAMPLE';
		}
		$html = '
				<table class="table table-striped table-bordered table-hover display" style="color: black; font-size: 12px;" id="nc_mop_table">
								<thead>
									<tr>
										<th>
											<center>MODE OF PAYMENT
										</th>
										<th>
											<center>QUANTITY
										</th>
										<th>
											<center>AMOUNT
										</th>
										<th>
											<center>ACTION
										</th>
									</tr>
								</thead>
									<tbody>
							';
		$mop_name = '';
		$qty_total = 0;
		$amount_total = 0;
		foreach($sample_data as $sample)
		{
			$qty_total += $sample['qty'];
			$amount_total += $sample['amount'];
			$mop_name = explode("'",$sample['name']);
			$mop_name = implode("",$mop_name);
			$html .= '
					<tr>
						<td style="text-align: center; font-size: 17px;">'.$sample['name'].'</td>
						<td style="text-align: center; font-size: 17px;">'.$sample['qty'].'</td>
						<td style="text-align: center; font-size: 17px;">'.number_format($sample['amount'], 2).'</td>
						<td style="text-align: center; font-size: 17px;">
							<a><span onclick="delete_nc_sample_js('."'".$sample['id']."','".$mop_name."'".')">❌</span></a>
						</td>
					</tr>
					';
		}

		$html .= '
						<tr>
							<td style="font-weight: bold; text-align: center; font-size: 17px;">TOTAL</td>
							<td style="font-weight: bold; text-align: center; font-size: 17px;">'.$qty_total.'</td>
							<td style="font-weight: bold; text-align: center; font-size: 17px;">'.number_format($amount_total, 2).'</td>
							<td style="font-weight: bold;"></td>
						</td>
					</tbody>
				</table>
				';
		
		$data['message'] = $message;
		$data['html'] = $html;
		echo json_encode($data);
	}

	public function delete_nc_sample_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$message = 'success';
			$this->cashier_model->delete_nc_sample_model($_POST['id'],$_SESSION['emp_id']);
	
			echo json_encode($message);
		}
	}

	public function delete_history_noncash_pending_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$message = 'success';
			$this->cashier_model->delete_history_noncash_pending_model($_POST['id'],$_SESSION['emp_id']);
	
			echo json_encode($message);
		}
	}

	public function submit_noncash_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$current_date = date("Y-m-d");
			$emp_id = $_SESSION['emp_id'];
			$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
			$dcode = '';
			$scode = '';
			$sscode = '';
			$pos_name = '';
			$borrowed = '';
			if(!empty($assigned_counter_data))
			{
				foreach($assigned_counter_data as $assigned)
				{
					$dcode = $assigned['dcode'];
					$scode = $assigned['scode'];
					$sscode = $assigned['sscode'];
					$pos_name = $assigned['pos_name'];
					$borrowed = $assigned['borrowed'];
				}
			}
			// =========================================================================================================
			$sscode2 = '';
			if($borrowed == 'YES')
			{
				$sscode2 = $dcode.$scode.$sscode;
			}
			else
			{
				$emp_data = $this->cashier_model->get_empdata($emp_id);
				$company_code = '';
				$bunit_code = '';
				$dept_code = '';
				$section_code = '';
				$sub_section_code = '';
				foreach($emp_data as $data)
				{
					$company_code = $data['company_code'];
					$bunit_code = $data['bunit_code'];
					$dept_code = $data['dept_code'];
					$section_code = $data['section_code'];
					$sub_section_code = $data['sub_section_code'];
				}
				$sscode2 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
			}
			// =====================================jay update v1.0===============================
			$message = 'success';
			$this->cashier_model->update_sample_model($emp_id,$sscode2,$pos_name,$borrowed);
	
			echo json_encode($message);
		}
	}

	public function check_pending_ctrl()
	{
		$check_data = $this->cashier_model->check_noncash_pending_model($_SESSION['emp_id']);
		$message = '';
		if(!empty($check_data))
		{
			$message = 'NAAY PENDING';
		}

		echo json_encode($message);
	}

	public function update_noncash_borrowed_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$message = 'success';
			$validate_default_code = $this->cashier_model->get_empdata($_SESSION['emp_id']);
			$default_code = '';
			foreach ($validate_default_code as $dfcode)
			{
				$default_code = $dfcode['company_code'].$dfcode['bunit_code'].$dfcode['dept_code'].$dfcode['section_code'].$dfcode['sub_section_code'];
			}
			$sscode = $_POST['scode'].$_POST['sscode'];
			$validate_update = $this->cashier_model->validate_update_noncash_borrowed_model($_SESSION['emp_id']);
			$allcode = $validate_update->dcode.$sscode;
			if($validate_update->sscode == $sscode)
			{
				$message = 'ALREADY EXIST';
			}
			else if($allcode == $default_code)
			{
				$message = 'INVALID BORROWED';
			}
			else
			{
				$this->cashier_model->update_noncash_borrowed_model($_SESSION['emp_id'],$_POST['scode'],$_POST['sscode']);
				$this->cashier_model->update_cash_borrowed_model($_SESSION['emp_id'],$_POST['scode'],$_POST['sscode']);
			}
					
			echo json_encode($message); 
		}
	}

	public function update_noncash_pos_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$message = 'success';
			$this->cashier_model->update_noncash_pos_model($_SESSION['emp_id'],$_POST['pos_name'],$_POST['counter_no']);
			$this->cashier_model->update_cash_pos_model($_SESSION['emp_id'],$_POST['pos_name'],$_POST['counter_no']);
	
			echo json_encode($message);
		}
	}

	public function get_edit_mop_ctrl()
	{
		$edit_data = $this->cashier_model->get_edit_mop_model($_POST['id'],$_SESSION['emp_id']);
		$mop_data = $this->cashier_model->get_exmop_model($_SESSION['emp_id'],$edit_data);
		$html = '
				<option selected>'.$edit_data.'</option>
				';
		foreach($mop_data as $mop)
		{
			$html .= '
				<option>'.$mop['mop_name'].'</option>
				';
		}

		$data['html'] = $html;
		echo json_encode($data);
	}

	public function update_history_noncash_mop_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$current_date = date("Y-m-d");
			$emp_id = $_SESSION['emp_id'];
			$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
			$dcode = '';
			$scode = '';
			$sscode = '';
			$pos_name = '';
			$borrowed = '';
			if(!empty($assigned_counter_data))
			{
				foreach($assigned_counter_data as $assigned)
				{
					$dcode = $assigned['dcode'];
					$scode = $assigned['scode'];
					$sscode = $assigned['sscode'];
					$pos_name = $assigned['pos_name'];
					$borrowed = $assigned['borrowed'];
				}
			}
			// =========================================================================================================
			$sscode2 = '';
			if($borrowed == 'YES')
			{
				$sscode2 = $dcode.$scode.$sscode;
			}
			else
			{
				$emp_data = $this->cashier_model->get_empdata($emp_id);
				$company_code = '';
				$bunit_code = '';
				$dept_code = '';
				$section_code = '';
				$sub_section_code = '';
				foreach($emp_data as $data)
				{
					$company_code = $data['company_code'];
					$bunit_code = $data['bunit_code'];
					$dept_code = $data['dept_code'];
					$section_code = $data['section_code'];
					$sub_section_code = $data['sub_section_code'];
				}
				$sscode2 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
			}
			// ===============================jay update v1.0============================================================
			$message = 'success';
			$validate_update = $this->cashier_model->validate_update_history_noncash_mop_model($_POST['id'],$emp_id,$_POST['mop_name'],$sscode2,$pos_name,$borrowed);
			if(empty($validate_update))
			{
				$this->cashier_model->update_history_noncash_mop_model($_POST['id'],$emp_id,$_POST['mop_name'],$_POST['qty'],$_POST['amount']);
			}
			else
			{
				$message = 'ALREADY EXIST';
			}
	
			echo json_encode($message);
		}
	}

	public function history_add_mop_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$current_date = date("Y-m-d");
			$emp_id = $_SESSION['emp_id'];
			$assigned_counter_data=$this->cashier_model->get_assigned_counter_model($emp_id,$current_date);
			$dcode = '';
			$scode = '';
			$sscode = '';
			$pos_name = '';
			$borrowed = '';
			if(!empty($assigned_counter_data))
			{
				foreach($assigned_counter_data as $assigned)
				{
					$dcode = $assigned['dcode'];
					$scode = $assigned['scode'];
					$sscode = $assigned['sscode'];
					$pos_name = $assigned['pos_name'];
					$borrowed = $assigned['borrowed'];
				}
			}
			// =========================================================================================================
			$sscode2 = '';
			if($borrowed == 'YES')
			{
				$sscode2 = $dcode.$scode.$sscode;
			}
			else
			{
				$emp_data = $this->cashier_model->get_empdata($emp_id);
				$company_code = '';
				$bunit_code = '';
				$dept_code = '';
				$section_code = '';
				$sub_section_code = '';
				foreach($emp_data as $data)
				{
					$company_code = $data['company_code'];
					$bunit_code = $data['bunit_code'];
					$dept_code = $data['dept_code'];
					$section_code = $data['section_code'];
					$sub_section_code = $data['sub_section_code'];
				}
				$sscode2 = $company_code.$bunit_code.$dept_code.$section_code.$sub_section_code;
			}
			// ===============================jay update v1.0============================================================
			$validate_add = $this->cashier_model->validate_add_history_noncash_mop_model($emp_id,$sscode2,$pos_name,$borrowed); 
			if(empty($validate_add))
			{
				$message = 'NO DATA';
			}
			else
			{
				$tr_no = '';
				$emp_id = '';
				$sal_no = '';
				$emp_name = '';
				$emp_type = '';
				$company_code = '';
				$bunit_code = '';
				$dep_code = '';
				$section_code = '';
				$sub_section_code = '';
				$borrowed = '';
				$pos_name = '';
				$counter_no = '';
				foreach($validate_add as $add)
				{
					$tr_no = $add['tr_no'];
					$emp_id = $add['emp_id'];
					$sal_no = $add['sal_no'];
					$emp_name = $add['emp_name'];
					$emp_type = $add['emp_type'];
					$company_code = $add['company_code'];
					$bunit_code = $add['bunit_code'];
					$dep_code = $add['dep_code'];
					$section_code = $add['section_code'];
					$sub_section_code = $add['sub_section_code'];
					$borrowed = $add['borrowed'];
					$pos_name = $add['pos_name'];
					$counter_no = $add['counter_no'];
				}

				$message = 'success';
				$this->cashier_model->history_add_mop_model($tr_no,$emp_id,$sal_no,$emp_name,$emp_type,$company_code,$bunit_code,$dep_code,$section_code,$sub_section_code,$borrowed,$pos_name,$counter_no,$_POST['mop_name'],$_POST['qty'],$_POST['amount']);

				$this->cashier_model->update_pending_noncash_mop_model($emp_id,$sscode2,$pos_name,$borrowed);
			}

			echo json_encode($message);
		}
	}

	public function update_remit_type_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$remit_type_data = $this->cashier_model->get_remit_type_denomination_model($_POST['id']);
			$onek = 0;
			$fiveh = 0;
			$twoh = 0;
			$oneh = 0;
			$fifty = 0;
			$twenty = 0;
			$total_cash = 0;
			foreach($remit_type_data as $data)
			{
				$onek = $data['onek'] * 1000;
				$fiveh = $data['fiveh'] * 500;
				$twoh = $data['twoh'] * 200;
				$oneh = $data['oneh'] * 100;
				$fifty = $data['fifty'] * 50;
				$twenty = $data['twenty'] * 20;
			}
			$total_cash = $onek+$fiveh+$twoh+$oneh+$fifty+$twenty;
			// =============================================================================================
			$message = 'success';
			$this->cashier_model->update_remit_type_model($_POST['id'],$_POST['type'],$total_cash);
	
			echo json_encode($message);
		}
	}


}
