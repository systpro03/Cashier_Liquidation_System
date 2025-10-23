<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cfs_cashier_controller extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model("main_model");
        $this->load->model("cashier_model");
		$this->load->model("liquidation_model");
		$this->load->model("cfscashier_model");
		$this->load->helper('text');
	}

	public function cfscashier_dashboard_ctrl()
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
         
            $this->load->view('cfs_cashier_side/cfs_cashier_dashboard', $data);
        }
	}

	public function cfscashier_denomination_ctrl()
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
         
            $this->load->view('cfs_cashier_side/cfs_cashier_denomination', $data);
        }

	}

	public function cfs_forex_denomination_ctrl()
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
         
            $this->load->view('cfs_cashier_side/cfs_forex_denomination', $data);
        }

	}

	public function cfs_history_denomination_ctrl()
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
         
            $this->load->view('cfs_cashier_side/cfs_history_denomination', $data);
        }
	}

	public function display_cfsothermop_ctrl()
	{

		$query=$this->cfscashier_model->display_cfsmop_model();
		// var_dump($query);
		
		$html="";
		foreach ($query as $q)
		{
	
			$html.='

					<option id="" style="text-align: center;" value="'.$q['mop_name'].'">'.$q['mop_name'].'</option>

						';
		}

		$cash_result_trno = $this->cfscashier_model->get_cash_trno_model();
        $cash_tr_no = '';
        foreach($cash_result_trno as $cash_trno)
        {
            $cash_tr_no = $cash_trno['id'] + 1;
        }

        $noncash_result_trno = $this->cfscashier_model->get_noncash_trno_model();
        $noncash_tr_no = '';
        foreach($noncash_result_trno as $noncash_trno)
        {
            $noncash_tr_no = $noncash_trno['id'] + 1;
        }

		$data['cash_tr_no']=$cash_tr_no;    	   
		$data['noncash_tr_no']=$noncash_tr_no;    	   
		$data['html']=$html;    	   
		echo json_encode($data);

	}

	public function display_forex_currency_ctrl()
	{
		$query=$this->cfscashier_model->display_forex_currency_model();
		// var_dump($query);
		$html='';
		foreach ($query as $q)
		{
			$html.='

					<option id="" style="text-align: center;" value="'.$q['forex_currency'].'">'.$q['forex_currency'].'</option>

						';
		}

		$result_trno = $this->cfscashier_model->get_cash_trno_model();
		$tr_no = '';
		foreach($result_trno as $trno)
		{
			$tr_no = $trno['id'] + 1;
		}
	   
		$data['html']=$html;    	   
		$data['tr_no']=$tr_no;    	   
		echo json_encode($data);
	}

	public function display_forex_denomination_form_ctrl()
	{

		$currency = $_POST['currency'];
	 	$query=$this->cfscashier_model->get_forex_symbol_model($currency);

	 	foreach ($query as $q)
		{
			$symbol=$q['forex_symbol'];
			$total_currency=$q['forex_currency'];
		}

		if($symbol == '$')
		{
			$dollar='hidden';
			$euro='';
		}
		else if($symbol == '€')
		{
			$euro='hidden';
			$dollar='';
		}
		// var_dump($dollar);

		$html='
				<tr '.$dollar.'>
	                <td>
	                    <input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="'.$symbol.'500">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val0" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_fiveh" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_fiveh" disabled id="tfc_fiveh" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val1" onchange="cfsforex_ercalculation_js()" onkeyup="cfsforex_ercalculation_js()" id="er_fiveh" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_fiveh" disabled id="pa_fiveh" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr '.$dollar.'>
	                <td>
	                    <input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="'.$symbol.'200">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val2" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_twoh" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_twoh" disabled id="tfc_twoh" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val3" onchange="cfsforex_ercalculation_js()" onkeyup="cfsforex_ercalculation_js()" id="er_twoh" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_twoh" disabled id="pa_twoh" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="'.$symbol.'100">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val4" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_oneh" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_oneh" disabled id="tfc_oneh" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_oneh er_amount val5" onchange="cfsforex_ercalculation_js()" onkeyup="cfsforex_ercalculation_js()" id="er_oneh" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_oneh" disabled id="pa_oneh" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="'.$symbol.'50">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val6" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_fifty" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_fifty" disabled id="tfc_fifty" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val7" onchange="cfsforex_ercalculation_js()" onkeyup="cfsforex_ercalculation_js()" id="er_fifty" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_fifty" disabled id="pa_fifty" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="'.$symbol.'20">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val8" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_twenty" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_twenty" disabled id="tfc_twenty" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val9" onchange="cfsforex_ercalculation_js()" onkeyup="cfsforex_ercalculation_js()" id="er_twenty" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_twenty" disabled id="pa_twenty" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_ten" disabled="" placeholder="'.$symbol.'10">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val10" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_ten" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_ten" disabled id="tfc_ten" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val11" onchange="cfsforex_ercalculation_js()" onkeyup="cfsforex_ercalculation_js()" id="er_ten" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_ten" disabled id="pa_ten" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_five" disabled="" placeholder="'.$symbol.'5">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val12" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_five" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_five" disabled id="tfc_five" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val13" onchange="cfsforex_ercalculation_js()" onkeyup="cfsforex_ercalculation_js()" id="er_five" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_five" disabled id="pa_five" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr '.$euro.'>
	                <td>
	                    <input type="text" class="input-sm" id="d_two" disabled="" placeholder="'.$symbol.'2">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val14" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_two" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_two" disabled id="tfc_two" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val15" onchange="cfsforex_ercalculation_js()" onkeyup="cfsforex_ercalculation_js()" id="er_two" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_two" disabled id="pa_two" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr '.$euro.'>
	                <td>
	                    <input type="text" class="input-sm" id="d_one" disabled="" placeholder="'.$symbol.'1">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val16" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_one" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_one" disabled id="tfc_one" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val17" onchange="cfsforex_ercalculation_js()" onkeyup="cfsforex_ercalculation_js()" id="er_one" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_one" disabled id="pa_one" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    
	                </td>
	                <td>
	                    <input type="text" class="input-sm" id="forex_total_fctxt" disabled="" placeholder="TOTAL '.$total_currency.' ">
	                </td>
	                <td>
	                    <input type="text" class="input-sm val18" disabled id="total_forex_fc" placeholder="0.00">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" id="forex_total_pesotxt" disabled="" placeholder="TOTAL PESO AMOUNT">
	                </td>
	                <td>
	                    <input type="text" class="input-sm val19" disabled id="total_forex_peso" placeholder="0.00">
	                </td>
	            </tr>


	            <script>
	            	$("#load_js").load("'.base_url().'cfsnoncash_js_route");
	            	document.querySelector("#q_fiveh").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

			        document.querySelector("#q_twoh").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

			        document.querySelector("#q_oneh").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

			        document.querySelector("#q_fifty").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

			        document.querySelector("#q_twenty").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

			        document.querySelector("#q_ten").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

			        document.querySelector("#q_five").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

			        document.querySelector("#q_two").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

			        document.querySelector("#q_one").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

	            </script>

				';
	   
		$data['html']=$html;    	   
		echo json_encode($data);
	}

	public function submit_cfscashiercash_ctrl()
	{

		/*$datas_arr = explode("_",$_POST['datas']);

	    $result =$datas_arr[0]."".$datas_arr[1]."".$datas_arr[2]."".$datas_arr[3]."".$datas_arr[4]."".$datas_arr[5]."".$datas_arr[6]."".$datas_arr[7]."".$datas_arr[8]."".$datas_arr[9]."".$datas_arr[10]."".$datas_arr[11]."".$datas_arr[12]." ".$datas_arr[13]." ".$datas_arr[14]."\n" ;
	
          
		$data['result'] = $result;   
        echo json_encode($data);*/

		if(empty($_SESSION['emp_id']))
		{
			$save = "EXPIRED SESSION";
			echo json_encode($save);
		}
		else
		{
			$datas_arr = explode("_",$_POST['datas']);
			$tr_no = $_POST['tr_no'];

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

			$save = "success";
			$this->cfscashier_model->save_cfscashdenomination_model(
				$tr_no,
				$emp_id,
				$sal_no,
				$emp_name,
				$emp_type,
				$company_code,
				$bunit_code,
				$dep_code,
				$section_code,
				$sub_section_code,
				$datas_arr[1],
				$datas_arr[2],
				$datas_arr[3],
				$datas_arr[4],
				$datas_arr[5],
				$datas_arr[6],
				$datas_arr[7],
				$datas_arr[8],
				$datas_arr[9],
				$datas_arr[10],
				$datas_arr[11],
				$datas_arr[12],
				$datas_arr[13],
				$datas_arr[14],
				$datas_arr[15],
				$_POST['status'],
				$_POST['date']
			);

			echo json_encode($save);
		}
	}

	public function submit_cfscashiernoncash_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$save = "EXPIRED SESSION";
			echo json_encode($save);
		}
		else
		{
			$datas_arr = explode("_",$_POST['datas']);
			$tr_no = $_POST['tr_no'];

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

			$save = "success";
			$this->cfscashier_model->save_cfsnoncashdenomination_model(
				$tr_no,
				$emp_id,
				$sal_no,
				$emp_name,
				$emp_type,
				$company_code,
				$bunit_code,
				$dep_code,
				$section_code,
				$sub_section_code,
				$datas_arr[1],
				$datas_arr[2],
				$datas_arr[3],
				$datas_arr[4],
				$_POST['status'],
				$_POST['date']
			);

			echo json_encode($save);
		}
	}

	public function display_cfsncashmop_ctrl()
	{
		$query=$this->cfscashier_model->display_cfsncashmop_model();
		// var_dump($query);
		
		$html="";
		foreach ($query as $q)
		{
	
			$html.='

					<option id="" style="text-align: center;" value="'.$q['ncash_mopname'].'">'.$q['ncash_mopname'].'</option>

						';
		}

		$data['html']=$html;    	   
		echo json_encode($data);

	}

	public function display_cfsncashbankname_ctrl()
	{
		$query=$this->cfscashier_model->display_cfsncashbankname_model();
		// var_dump($query);
		
		$html="";
		foreach ($query as $q)
		{
	
			$html.='

					<option id="" value="'.$q['bank_name'].'">'.$q['bank_name'].'</option>

						';
		}

		$data['html']=$html;    	   
		echo json_encode($data);
	}

	public function display_cfsncashmop_ctrl_old()
	{
		$query=$this->cfscashier_model->display_cfsncashmop_model();
		// var_dump($query);
		
		$html="";
		$mop_id  = '';
		foreach ($query as $q)
		{
			$mop_id.="+mop_".$q['id'];
			$html.='

					<tr>
						<td>
						<input type="text" class="input-sm mop_'.$q['id'].'" disabled id="" value="'.$q['ncash_mopname'].'">
						<input type="text" class="input-sm mop_'.$q['id'].'" hidden disabled id="mop_name" value="'.$q['id'].'">
						</td>
						<td>
						<input type="number" min="0" class="input-sm quantity quantity_'.$q['id'].'  mop_'.$q['id'].' " id="'.$q['id'].'_q" placeholder="0">
						</td>
						<td>
						<input type="tel" onkeyup="cfstotal_noncash_js()" onchange="cfstotal_noncash_js()" class="input-sm cfsncash_d_amount mop_'.$q['id'].'" id="'.$q['id'].'_a" placeholder="0.00" value="0.00">
						</td>
					</tr>

					<script>

						cfstotal_noncash_js();
	
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
						<button type="button" id="btn_reset_noncashform" class="btn btn-primary waves-effect" onclick="reset_cfscashierform_js()">RESET</button>
						<button type="button" id="btn_save_noncashform" class="btn btn-warning waves-effect" onclick="submit_cfsncash_js()">SUBMIT</button>
						</td>
						<td>
						<input type="text" class="input-sm" id="total_noncashtxt" disabled="" value="TOTAL NONCASH">
						</td>
						<td>
						<input type="text" class="input-sm" disabled id="cfstotal_noncash" placeholder="0.00">
						</td>
					</tr>

					<script>

						$("#load_js").load("'.base_url().'cfsnoncash_js_route");
						$("#cfsdata").val("'.$mop_id.'");

					</script>
					';

			$data['html']=$html;    	   
			echo json_encode($data);

	}

	public function cfsnoncash_js_ctrl()
	{
		$this->load->view('cfs_cashier_side/cfsnoncash_js');
	}

	public function cfs_history_js_ctrl()
	{
		$this->load->view('cfs_cashier_side/cfs_history_js');
	}

	public function submit_cfsncash_ctrl()
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
			$section_code = '';
			$sub_section_code = '';
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
			$this->cfscashier_model->insert_cfsncash_model($_POST['cfsbatch_id'],
														$emp_id,
														$sal_no,
														$emp_name,
														$emp_type,
														$company_code,
														$bunit_code,
														$dep_code,
														$section_code,
														$sub_section_code,
														$_POST['amount_Arr'],
														$_POST['status'],
														$_POST['date']);
			
			echo json_encode($message);
		}
	}

	public function cash_duplicate_ctrl()
	{
		
		$query=$this->cfscashier_model->display_cfsmop_model();
		
		$cash_mop='';
		foreach ($query as $q)
		{
			$cash_mop.='
						<option id="" style="text-align: center;" value="'.$q['mop_name'].'">'.$q['mop_name'].'</option>
						';
		}

		$id                = $_POST['id'];
		$cash_form_counter = $_POST['cash_form_counter'];



		$html='

			<div id="div'.$id.'"><br>
                <form>
                  <center>
                    <label id="pending_cashlbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;">SELECT CASH TYPE&nbsp;</label>
                    <select class="quantity'.($cash_form_counter+14).'" style="font-size: 15px; margin-top: -1%; font-weight: bold; border: solid 2px;" name="cfs_cashmop'.$id.'" id="cfs_cashmop'.$id.'">
                      '.$cash_mop.'
                    </select>
                  </center>
                </form>

          <div class="table-scrollable">
            <table class="table table-striped table-bordered table-hover display">
              <thead>
                <tr>

                  <th style="font-weight: bold; font-size: 15px;" width="35%">
                    <center>DENOMINATION
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="30%">
                    <center>QUANTITY
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="35%">
                    <center>AMOUNT
                  </th>
                  </tr>
              </thead>
                <form name="cfscashier_cashform" id="cfscashier_cashform">
                    <tbody id="cfscashier_cashtbody">
                      
                        <tr>
                            <td>
                                <input type="text" class="input-sm" id="d_onek" disabled="" placeholder="₱1,000">
                            </td>
                            <td>
                                <input type="number" min="0" android:inputType="number" class="input-sm quantity quantity'.($cash_form_counter).' " id="q_onek'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_onek'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="₱500">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+1).'" id="q_fiveh'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_fiveh'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="₱200">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+2).'" id="q_twoh'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_twoh'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="₱100">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+3).'" id="q_oneh'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_oneh'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="₱50">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+4).'" id="q_fifty'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_fifty'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="₱20">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+5).'" id="q_twenty'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_twenty'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr id="trcash_ten">
                            <td>
                                <input type="text" class="input-sm" id="d_ten" disabled="" placeholder="₱10">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+6).'" id="q_ten'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_ten'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr id="trcash_five">
                            <td>
                                <input type="text" class="input-sm" id="d_five" disabled="" placeholder="₱5">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+7).'" id="q_five'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_five'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr id="trcash_one">
                            <td>
                                <input type="text" class="input-sm" id="d_one" disabled="" placeholder="₱1">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+8).'" id="q_one'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_one'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr id="trcash_twentyfivecents">
                            <td>
                                <input type="text" class="input-sm" id="d_twentyfivecents" disabled="" placeholder="₱0.25">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+9).'" id="q_twentyfivecents'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_twentyfivecents'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr id="trcash_tencents">
                            <td>
                                <input type="text" class="input-sm" id="d_tencents" disabled="" placeholder="₱0.10">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+10).'" id="q_tencents'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_tencents'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr id="trcash_fivecents">
                            <td>
                                <input type="text" class="input-sm" id="d_fivecents" disabled="" placeholder="₱0.05">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+11).'" id="q_fivecents'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_fivecents'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr id="trcash_onecents">
                            <td>
                                <input type="text" class="input-sm" id="d_onecents" disabled="" placeholder="₱0.01">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+12).'" id="q_onecents'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_onecents'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                
                            </td>
                            <td>
                                <input type="text" class="input-sm" id="total_cashtxt" disabled="" placeholder="TOTAL CASH">
                            </td>
                            <td>
                                <input type="text" class="input-sm quantity'.($cash_form_counter+13).'" disabled id="total_cash'.$id.'" placeholder="0.00">
                            </td>
                        </tr>

                    </tbody>
                </form>
            </table>
          </div>
          

          <script>

          	 $("#q_onek'.$id.',#q_fiveh'.$id.',#q_twoh'.$id.',#q_oneh'.$id.',#q_fifty'.$id.',#q_twenty'.$id.',#q_ten'.$id.',#q_five'.$id.',#q_one'.$id.',#q_twentyfivecents'.$id.',#q_tencents'.$id.',#q_fivecents'.$id.',#q_onecents'.$id.'").on("change keyup", function() {
	         
	          var res = $("#q_onek'.$id.'").val() * 1000;
			  var res1 = $("#q_fiveh'.$id.'").val() * 500;
			  var res2 = $("#q_twoh'.$id.'").val() * 200;
			  var res3 = $("#q_oneh'.$id.'").val() * 100;
			  var res4 = $("#q_fifty'.$id.'").val() * 50;
			  var res5 = $("#q_twenty'.$id.'").val() * 20;
			  var res6 = $("#q_ten'.$id.'").val() * 10;
			  var res7 = $("#q_five'.$id.'").val() * 5;
			  var res8 = $("#q_one'.$id.'").val() * 1;
			  var res9 = $("#q_twentyfivecents'.$id.'").val() * 0.25;
			  var res10 = $("#q_tencents'.$id.'").val() * 0.10;
			  var res11 = $("#q_fivecents'.$id.'").val() * 0.05;
			  var res12 = $("#q_onecents'.$id.'").val() * 0.01;
			   
			    var amount = res;
			    var amount1 = res1;
			    var amount2 = res2;
			    var amount3 = res3;
			    var amount4 = res4;
			    var amount5 = res5;
			    var amount6 = res6;
			    var amount7 = res7;
			    var amount8 = res8;
			    var amount9 = res9;
			    var amount10 = res10;
			    var amount11 = res11;
			    var amount12 = res12;

			    var amount13 = parseFloat(amount) + 
			    parseFloat(amount1) + 
			    parseFloat(amount2) + 
			    parseFloat(amount3) + 
			    parseFloat(amount4) + 
			    parseFloat(amount5) + 
			    parseFloat(amount6) + 
			    parseFloat(amount7) + 
			    parseFloat(amount8) + 
			    parseFloat(amount9) + 
			    parseFloat(amount10) + 
			    parseFloat(amount11) + 
			    parseFloat(amount12) ;

			    $("#a_onek'.$id.'").val(amount.toLocaleString());
			    $("#a_fiveh'.$id.'").val(amount1.toLocaleString());
			    $("#a_twoh'.$id.'").val(amount2.toLocaleString());
			    $("#a_oneh'.$id.'").val(amount3.toLocaleString());
			    $("#a_fifty'.$id.'").val(amount4.toLocaleString());
			    $("#a_twenty'.$id.'").val(amount5.toLocaleString());
			    $("#a_ten'.$id.'").val(amount6.toLocaleString());
			    $("#a_five'.$id.'").val(amount7.toLocaleString());
			    $("#a_one'.$id.'").val(amount8.toLocaleString());
			    $("#a_twentyfivecents'.$id.'").val(amount9.toLocaleString());
			    $("#a_tencents'.$id.'").val(amount10.toLocaleString());
			    $("#a_fivecents'.$id.'").val(amount11.toLocaleString());
			    $("#a_onecents'.$id.'").val(amount12.toLocaleString());

			    $("#total_cash'.$id.'").val(amount13.toLocaleString());
	
	        });


	        document.querySelector("#q_onek'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_fiveh'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_twoh'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_oneh'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_fifty'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_twenty'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_ten'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_five'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_one'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_twentyfivecents'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_tencents'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_fivecents'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_onecents'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });


          </script>
          </div>
				';
		
        
        $data['cash_form_counter_last'] = $cash_form_counter+15; 
		$data['html']=$html;    	   
		echo json_encode($data);
	}

	public function noncash_duplicate_ctrl()
	{

		$query=$this->cfscashier_model->display_cfsncashmop_model();
		$query2=$this->cfscashier_model->display_cfsncashbankname_model();
		
		$noncash_mop='';
		foreach ($query as $q)
		{
			$noncash_mop.='
						<option id="" value="'.$q['ncash_mopname'].'">'.$q['ncash_mopname'].'</option>
						';
		}

		$noncash_bankname='';
		foreach ($query2 as $q2)
		{
			$noncash_bankname.='
							<option id="" value="'.$q2['bank_name'].'">'.$q2['bank_name'].'</option>
							';
		}

		$id = $_POST['id'];
		$noncash_form_counter = $_POST['noncash_form_counter'];

		$html='

		<div id="divnoncash'.$id.'"><br>
            <form>
              <center>
                <label id="cfscashier_ncashlbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;">SELECT NONCASH TYPE&nbsp;</label>
                <select class="noncash_class'.($noncash_form_counter).'" style="font-size: 15px; margin-top: -1%; font-weight: bold; border: solid 2px; text-align: center;" name="cfs_ncashmop'.$id.'" id="cfs_ncashmop'.$id.'">
                  '.$noncash_mop.'
                </select>
              </center>
            </form>

          <div class="table-scrollable">
            <table class="table table-striped table-bordered table-hover display">
              <thead>
                <tr>

                  <th style="font-weight: bold; font-size: 15px;" width="40%">
                    <center>DENOMINATION
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="60%">
                    <center>BANK NAME / CHECK NO. / AMOUNT
                  </th>
                 
                  </tr>
              </thead>

                <form name="cfscashier_ncashform'.$id.'" id="cfscashier_ncashform'.$id.'">
                    <tbody id="cfscashier_ncashtbody">
                      
                      <tr>
                            <td>
                                <input type="text" class="input-sm" id="" disabled="" placeholder="BANK NAME">
                            </td>
                            <td>
                                <center><select class="noncash_class'.($noncash_form_counter+1).'" style="font-size: 20px; margin-top: -1%; font-weight: bold; border: solid 2px; text-align: center; margin-top: 0%;" name="cfs_ncash_bankname'.$id.'" id="cfs_ncash_bankname'.$id.'">
                  					'.$noncash_bankname.'
                                </select></center>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="input-sm" id="" disabled="" placeholder="CHEQUE NO.">
                            </td>
                            <td>
                                <input type="text" class="input-sm noncash_class'.($noncash_form_counter+2).' cheq_no" required id="cfs_noncash_cheqno'.$id.'" placeholder="CHEQUE NO.">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="input-sm" id="" disabled="" placeholder="AMOUNT">
                            </td>
                            <td>
                                <input type="text" class="input-sm noncash_class'.($noncash_form_counter+3).' ncashd_amount" required id="cfs_noncash_amount'.$id.'" placeholder="₱ 0.00">
                            </td>
                        </tr>

                    </tbody>
                </form>
            </table>
          </div>
          

          <script>

          	  $(".cheq_no").on("change keyup keypress keydown", function() {
		          var sanitized = $(this).val().replace(/[^0-9]/g, "");
		          $(this).val(sanitized);
		        });

          	 $(".ncashd_amount").maskMoney({thousands:",", decimal:".", allowZero: true, suffix: " "});

          </script>
          </div>
				';
		

		$data['noncash_form_counter_last'] = $noncash_form_counter+4; 
		$data['html']=$html;    	   
		echo json_encode($data);
	}


	public function forex_form_duplicate_ctrl()
	{

		$query1=$this->cfscashier_model->display_forex_currency_model();
		$forex_currency='';
		foreach ($query1 as $q1)
		{
			$forex_currency.='

					<option id="" style="text-align: center;" value="'.$q1['forex_currency'].'">'.$q1['forex_currency'].'</option>

						';
		}


		$id                = $_POST['id'];
		$forex_form_counter = $_POST['forex_form_counter'];
		/*$currency = $_POST['currency'];
	 	$query=$this->cfscashier_model->get_forex_symbol_model($currency);*/
	 	$query=$this->cfscashier_model->get_forex_currency_model();
	 	foreach ($query as $q)
		{
			$symbol=$q['forex_symbol'];
			$total_currency=$q['forex_currency'];
		}

		if($symbol == '$')
		{
			$dollar='hidden';
			$euro='';
		}
		else if($symbol == '€')
		{
			$euro='hidden';
			$dollar='';
		}

		$html = '
				<div id="div'.$id.'"><br>
                <form>
                  <center>
                    <label id="forex_selectlbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;">SELECT CURRENCY&nbsp;</label>
                    <select class="val'.($forex_form_counter+20).'" onchange="change_currency_js('.$id.', '.$forex_form_counter.')" style="font-size: 15px; margin-top: -1%; font-weight: bold; border: solid 2px;" name="cfs_forex_list'.$id.'" id="cfs_forex_list'.$id.'">
    					'.$forex_currency.'
                    </select>
                  </center>
                </form>

          <div class="table-scrollable">
            <table class="table table-striped table-bordered table-hover display">
              <thead>
                <tr>

                  <th style="font-weight: bold; font-size: 15px;" width="20%">
                    <center>DENOMINATION
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="20%">
                    <center>QUANTITY
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="20%">
                    <center>TOTAL FRGN. CUR.
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="20%">
                    <center>EXCHANGE RATE
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="20%">
                    <center>PESO AMOUNT
                  </th>

                  </tr>
              </thead>
              	<input hidden value="'.$id.'" id="val_id'.$id.'">
                <form name="cfscashier_cashform" id="cfscashier_cashform">
                    <tbody id="cfscashier_forextbody'.$id.'">
                      
                        <tr '.$dollar.'>
			                <td>
			                    <input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="'.$symbol.'500">
			                </td>
			                <td>
			                    <input type="number" min="0" class="input-sm val'.($forex_form_counter).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_fiveh'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm tfc_fiveh" disabled id="tfc_fiveh'.$id.'" placeholder="0" value="0">
			                </td>
			                <td>
			                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+1).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_fiveh'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm pa_fiveh" disabled id="pa_fiveh'.$id.'" placeholder="0" value="0">
			                </td>
			            </tr>

			            <tr '.$dollar.'>
			                <td>
			                    <input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="'.$symbol.'200">
			                </td>
			                <td>
			                    <input type="number" min="0" class="input-sm val'.($forex_form_counter+2).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_twoh'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm tfc_twoh" disabled id="tfc_twoh'.$id.'" placeholder="0" value="0">
			                </td>
			                <td>
			                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+3).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_twoh'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm pa_twoh" disabled id="pa_twoh'.$id.'" placeholder="0" value="0">
			                </td>
			            </tr>

			            <tr>
			                <td>
			                    <input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="'.$symbol.'100">
			                </td>
			                <td>
			                    <input type="number" min="0" class="input-sm val'.($forex_form_counter+4).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_oneh'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm tfc_oneh" disabled id="tfc_oneh'.$id.'" placeholder="0" value="0">
			                </td>
			                <td>
			                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+5).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_oneh'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm pa_oneh" disabled id="pa_oneh'.$id.'" placeholder="0" value="0">
			                </td>
			            </tr>

			            <tr>
			                <td>
			                    <input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="'.$symbol.'50">
			                </td>
			                <td>
			                    <input type="number" min="0" class="input-sm val'.($forex_form_counter+6).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_fifty'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm tfc_fifty" disabled id="tfc_fifty'.$id.'" placeholder="0" value="0">
			                </td>
			                <td>
			                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+7).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_fifty'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm pa_fifty" disabled id="pa_fifty'.$id.'" placeholder="0" value="0">
			                </td>
			            </tr>

			            <tr>
			                <td>
			                    <input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="'.$symbol.'20">
			                </td>
			                <td>
			                    <input type="number" min="0" class="input-sm val'.($forex_form_counter+8).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_twenty'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm tfc_twenty" disabled id="tfc_twenty'.$id.'" placeholder="0" value="0">
			                </td>
			                <td>
			                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+9).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_twenty'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm pa_twenty" disabled id="pa_twenty'.$id.'" placeholder="0" value="0">
			                </td>
			            </tr>

			            <tr>
			                <td>
			                    <input type="text" class="input-sm" id="d_ten" disabled="" placeholder="'.$symbol.'10">
			                </td>
			                <td>
			                    <input type="number" min="0" class="input-sm val'.($forex_form_counter+10).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_ten'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm tfc_ten" disabled id="tfc_ten'.$id.'" placeholder="0" value="0">
			                </td>
			                <td>
			                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+11).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_ten'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm pa_ten" disabled id="pa_ten'.$id.'" placeholder="0" value="0">
			                </td>
			            </tr>

			            <tr>
			                <td>
			                    <input type="text" class="input-sm" id="d_five" disabled="" placeholder="'.$symbol.'5">
			                </td>
			                <td>
			                    <input type="number" min="0" class="input-sm val'.($forex_form_counter+12).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_five'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm tfc_five" disabled id="tfc_five'.$id.'" placeholder="0" value="0">
			                </td>
			                <td>
			                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+13).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_five'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm pa_five" disabled id="pa_five'.$id.'" placeholder="0" value="0">
			                </td>
			            </tr>

			            <tr '.$euro.'>
			                <td>
			                    <input type="text" class="input-sm" id="d_two" disabled="" placeholder="'.$symbol.'2">
			                </td>
			                <td>
			                    <input type="number" min="0" class="input-sm val'.($forex_form_counter+14).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_two'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm tfc_two" disabled id="tfc_two'.$id.'" placeholder="0" value="0">
			                </td>
			                <td>
			                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+15).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_two'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm pa_two" disabled id="pa_two'.$id.'" placeholder="0" value="0">
			                </td>
			            </tr>

			            <tr '.$euro.'>
			                <td>
			                    <input type="text" class="input-sm" id="d_one" disabled="" placeholder="'.$symbol.'1">
			                </td>
			                <td>
			                    <input type="number" min="0" class="input-sm val'.($forex_form_counter+16).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_one'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm tfc_one" disabled id="tfc_one'.$id.'" placeholder="0" value="0">
			                </td>
			                <td>
			                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+17).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_one'.$id.'" placeholder="0">
			                </td>
			                <td>
			                    <input type="text" class="input-sm pa_one" disabled id="pa_one'.$id.'" placeholder="0" value="0">
			                </td>
			            </tr>

			            <tr>
			                <td>
			                    
			                </td>
			                <td>
			                    <input type="text" class="input-sm" id="forex_total_fctxt" disabled="" placeholder="TOTAL '.$total_currency.' ">
			                </td>
			                <td>
			                    <input type="text" class="input-sm val'.($forex_form_counter+18).'" disabled id="total_forex_fc'.$id.'" placeholder="0.00">
			                </td>
			                <td>
			                    <input type="text" class="input-sm" id="forex_total_pesotxt" disabled="" placeholder="TOTAL PESO AMOUNT">
			                </td>
			                <td>
			                    <input type="text" class="input-sm val'.($forex_form_counter+19).'" disabled id="total_forex_peso'.$id.'" placeholder="0.00">
			                </td>
			            </tr>

                    </tbody>
                </form>
            </table>
          </div>
          

          <script>

          		$("#load_js").load("'.base_url().'cfsnoncash_js_route");
          		var id = $("#val_id'.$id.'").val();
	       		disabled_spcharater_js(id);
	            	
          </script>
          </div>
				';


		$data['forex_form_counter_last'] = $forex_form_counter+21; 
		$data['html']=$html;    	   
		echo json_encode($data);
	}

	public function change_currency_ctrl()
	{
		$id = $_POST['id'];
		$forex_form_counter = $_POST['counter'];
		$currency = $_POST['currency'];
	 	$query=$this->cfscashier_model->get_forex_symbol_model($currency);

	 	foreach ($query as $q)
		{
			$symbol=$q['forex_symbol'];
			$total_currency=$q['forex_currency'];
		}

		if($symbol == '$')
		{
			$dollar='hidden';
			$euro='';
		}
		else if($symbol == '€')
		{
			$euro='hidden';
			$dollar='';
		}
		// var_dump($dollar);

		$html='
				<tr '.$dollar.'>
	                <td>
	                    <input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="'.$symbol.'500">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val'.($forex_form_counter).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_fiveh'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_fiveh" disabled id="tfc_fiveh'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+1).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_fiveh'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_fiveh" disabled id="pa_fiveh'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr '.$dollar.'>
	                <td>
	                    <input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="'.$symbol.'200">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val'.($forex_form_counter+2).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_twoh'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_twoh" disabled id="tfc_twoh'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+3).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_twoh'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_twoh" disabled id="pa_twoh'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="'.$symbol.'100">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val'.($forex_form_counter+4).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_oneh'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_oneh" disabled id="tfc_oneh'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+5).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_oneh'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_oneh" disabled id="pa_oneh'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="'.$symbol.'50">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val'.($forex_form_counter+6).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_fifty'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_fifty" disabled id="tfc_fifty'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+7).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_fifty'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_fifty" disabled id="pa_fifty'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="'.$symbol.'20">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val'.($forex_form_counter+8).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_twenty'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_twenty" disabled id="tfc_twenty'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+9).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_twenty'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_twenty" disabled id="pa_twenty'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_ten" disabled="" placeholder="'.$symbol.'10">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val'.($forex_form_counter+10).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_ten'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_ten" disabled id="tfc_ten'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+11).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_ten'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_ten" disabled id="pa_ten'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_five" disabled="" placeholder="'.$symbol.'5">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val'.($forex_form_counter+12).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_five'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_five" disabled id="tfc_five'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+13).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_five'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_five" disabled id="pa_five'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr '.$euro.'>
	                <td>
	                    <input type="text" class="input-sm" id="d_two" disabled="" placeholder="'.$symbol.'2">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val'.($forex_form_counter+14).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_two'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_two" disabled id="tfc_two'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+15).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_two'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_two" disabled id="pa_two'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr '.$euro.'>
	                <td>
	                    <input type="text" class="input-sm" id="d_one" disabled="" placeholder="'.$symbol.'1">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val'.($forex_form_counter+16).'" onchange="duplicate_tfccalculation_js('.$id.')" onkeyup="duplicate_tfccalculation_js('.$id.')" id="q_one'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_one" disabled id="tfc_one'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val'.($forex_form_counter+17).'" onchange="duplicate_ercalculation_js('.$id.')" onkeyup="duplicate_ercalculation_js('.$id.')" id="er_one'.$id.'" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_one" disabled id="pa_one'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    
	                </td>
	                <td>
	                    <input type="text" class="input-sm" id="forex_total_fctxt" disabled="" placeholder="TOTAL '.$total_currency.' ">
	                </td>
	                <td>
	                    <input type="text" class="input-sm val'.($forex_form_counter+18).'" disabled id="total_forex_fc'.$id.'" placeholder="0.00">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" id="forex_total_pesotxt" disabled="" placeholder="TOTAL PESO AMOUNT">
	                </td>
	                <td>
	                    <input type="text" class="input-sm val'.($forex_form_counter+19).'" disabled id="total_forex_peso'.$id.'" placeholder="0.00">
	                </td>
	            </tr>


	            <script>

	            	$("#load_js").load("'.base_url().'cfsnoncash_js_route");

	            	var id = $("#val_id'.$id.'").val();
	       			disabled_spcharater_js(id);

	            </script>

				';
	   
		$data['html']=$html;    	   
		echo json_encode($data);
	}

	public function submit_forex_denomination_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$datas_arr = explode("_",$_POST['datas']);
			$tr_no = $_POST['tr_no'];
			
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
			
			$this->cfscashier_model->save_forex_denomination_model(
				$tr_no,
				$emp_id,
				$sal_no,
				$emp_name,
				$emp_type,
				$company_code,
				$bunit_code,
				$dep_code,
				$section_code,
				$sub_section_code,
				$datas_arr[1],
				$datas_arr[3],
				$datas_arr[5],
				$datas_arr[7],
				$datas_arr[9],
				$datas_arr[11],
				$datas_arr[13],
				$datas_arr[15],
				$datas_arr[17],
				$datas_arr[20],
				$datas_arr[21]
			);

			// var_dump($datas_arr[2],$datas_arr[4],$datas_arr[6],$datas_arr[8],$datas_arr[10],$datas_arr[12],$datas_arr[14],$datas_arr[16],$datas_arr[18]);
			$message = "success";
			$this->cfscashier_model->save_forex_exchange_rate_model(
				$tr_no,
				$emp_id,
				$datas_arr[21],
				$datas_arr[2],
				$datas_arr[4],
				$datas_arr[6],
				$datas_arr[8],
				$datas_arr[10],
				$datas_arr[12],
				$datas_arr[14],
				$datas_arr[16],
				$datas_arr[18]
			);

			echo json_encode($message);
		}
	}

	public function get_pending_cash_ctrl()
	{
		
		$emp_id = $_SESSION['emp_id'];
		$cash_pending = $this->cfscashier_model->get_pending_cash_model($emp_id);

		$html = '';
		foreach($cash_pending as $cash)
		{
			$id = $cash['id'];

			$query2=$this->cfscashier_model->get_cfsothermop_model($cash['cfs_cashtype']);
			$cash_mop='';
			foreach ($query2 as $q2)
			{
				$cash_mop.='
							<option id="" style="text-align: center;" value="'.$q2['mop_name'].'">'.$q2['mop_name'].'</option>
							';
			}

			$html.='
				<div class="form-body" id="form_body">
				<div id="div'.$cash['id'].'"><br>
	                <form>
	                  <center>
	                    <label id="pending_cashlbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;">SELECT CASH TYPE&nbsp;</label>
	                    <select class="quantity0" style="font-size: 15px; margin-top: -1%; font-weight: bold; border: solid 2px;" name="cfs_cashmop'.$cash['id'].'" id="cfs_cashmop'.$cash['id'].'" value="">
	                      <option id="" style="text-align: center;" value="'.$cash['cfs_cashtype'].'">'.$cash['cfs_cashtype'].'</option>
	                      '.$cash_mop.'
	                    </select>
	                  </center>
	                </form>

	          <div class="table-scrollable">
	            <table class="table table-striped table-bordered table-hover display">
	              <thead>
	                <tr>

	                  <th style="font-weight: bold; font-size: 15px;" width="35%">
	                    <center>DENOMINATION
	                  </th>
	                  <th style="font-weight: bold; font-size: 15px;" width="30%">
	                    <center>QUANTITY
	                  </th>
	                  <th style="font-weight: bold; font-size: 15px;" width="35%">
	                    <center>AMOUNT
	                  </th>
	                  </tr>
	              </thead>
	                <form name="cfscashier_cashform" id="cfscashier_cashform">
	                    <tbody id="cfscashier_cashtbody">
	                      
	                        <tr>
	                            <td>
	                                <input type="text" class="input-sm" id="d_onek" disabled="" placeholder="₱1,000">
	                            </td>
	                            <td>
	                                <input type="number" min="0" android:inputType="number" class="input-sm quantity quantity1" id="q_onek'.$cash['id'].'" placeholder="0" value="'.$cash['onek'].'">
	                            </td>
	                            <td>
	                                <input type="text" class="input-sm d_amount" disabled id="a_onek'.$cash['id'].'" placeholder="0" value="0">
	                            </td>
	                        </tr>

	                        <tr>
	                            <td>
	                                <input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="₱500">
	                            </td>
	                            <td>
	                                <input type="number" min="0" class="input-sm quantity quantity2" id="q_fiveh'.$cash['id'].'" placeholder="0" value="'.$cash['fiveh'].'">
	                            </td>
	                            <td>
	                                <input type="text" class="input-sm d_amount" disabled id="a_fiveh'.$cash['id'].'" placeholder="0" value="0">
	                            </td>
	                        </tr>

	                        <tr>
	                            <td>
	                                <input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="₱200">
	                            </td>
	                            <td>
	                                <input type="number" min="0" class="input-sm quantity quantity3" id="q_twoh'.$cash['id'].'" placeholder="0" value="'.$cash['twoh'].'">
	                            </td>
	                            <td>
	                                <input type="text" class="input-sm d_amount" disabled id="a_twoh'.$cash['id'].'" placeholder="0" value="0">
	                            </td>
	                        </tr>

	                        <tr>
	                            <td>
	                                <input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="₱100">
	                            </td>
	                            <td>
	                                <input type="number" min="0" class="input-sm quantity quantity4" id="q_oneh'.$cash['id'].'" placeholder="0" value="'.$cash['oneh'].'">
	                            </td>
	                            <td>
	                                <input type="text" class="input-sm d_amount" disabled id="a_oneh'.$cash['id'].'" placeholder="0" value="0">
	                            </td>
	                        </tr>

	                        <tr>
	                            <td>
	                                <input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="₱50">
	                            </td>
	                            <td>
	                                <input type="number" min="0" class="input-sm quantity quantity5" id="q_fifty'.$cash['id'].'" placeholder="0" value="'.$cash['fifty'].'">
	                            </td>
	                            <td>
	                                <input type="text" class="input-sm d_amount" disabled id="a_fifty'.$cash['id'].'" placeholder="0" value="0">
	                            </td>
	                        </tr>

	                        <tr>
	                            <td>
	                                <input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="₱20">
	                            </td>
	                            <td>
	                                <input type="number" min="0" class="input-sm quantity quantity6" id="q_twenty'.$cash['id'].'" placeholder="0" value="'.$cash['twenty'].'">
	                            </td>
	                            <td>
	                                <input type="text" class="input-sm d_amount" disabled id="a_twenty'.$cash['id'].'" placeholder="0" value="0">
	                            </td>
	                        </tr>

	                        <tr id="trcash_ten">
	                            <td>
	                                <input type="text" class="input-sm" id="d_ten" disabled="" placeholder="₱10">
	                            </td>
	                            <td>
	                                <input type="number" min="0" class="input-sm quantity quantity7" id="q_ten'.$cash['id'].'" placeholder="0" value="'.$cash['ten'].'">
	                            </td>
	                            <td>
	                                <input type="text" class="input-sm d_amount" disabled id="a_ten'.$cash['id'].'" placeholder="0" value="0">
	                            </td>
	                        </tr>

	                        <tr id="trcash_five">
	                            <td>
	                                <input type="text" class="input-sm" id="d_five" disabled="" placeholder="₱5">
	                            </td>
	                            <td>
	                                <input type="number" min="0" class="input-sm quantity quantity8" id="q_five'.$cash['id'].'" placeholder="0" value="'.$cash['five'].'">
	                            </td>
	                            <td>
	                                <input type="text" class="input-sm d_amount" disabled id="a_five'.$cash['id'].'" placeholder="0" value="0">
	                            </td>
	                        </tr>

	                        <tr id="trcash_one">
	                            <td>
	                                <input type="text" class="input-sm" id="d_one" disabled="" placeholder="₱1">
	                            </td>
	                            <td>
	                                <input type="number" min="0" class="input-sm quantity quantity9" id="q_one'.$cash['id'].'" placeholder="0" value="'.$cash['one'].'">
	                            </td>
	                            <td>
	                                <input type="text" class="input-sm d_amount" disabled id="a_one'.$cash['id'].'" placeholder="0" value="0">
	                            </td>
	                        </tr>

	                        <tr id="trcash_twentyfivecents">
	                            <td>
	                                <input type="text" class="input-sm" id="d_twentyfivecents" disabled="" placeholder="₱0.25">
	                            </td>
	                            <td>
	                                <input type="number" min="0" class="input-sm quantity quantity10" id="q_twentyfivecents'.$cash['id'].'" placeholder="0" value="'.$cash['twentyfive_cents'].'">
	                            </td>
	                            <td>
	                                <input type="text" class="input-sm d_amount" disabled id="a_twentyfivecents'.$cash['id'].'" placeholder="0" value="0">
	                            </td>
	                        </tr>

	                        <tr id="trcash_tencents">
	                            <td>
	                                <input type="text" class="input-sm" id="d_tencents" disabled="" placeholder="₱0.10">
	                            </td>
	                            <td>
	                                <input type="number" min="0" class="input-sm quantity quantity11" id="q_tencents'.$cash['id'].'" placeholder="0" value="'.$cash['ten_cents'].'">
	                            </td>
	                            <td>
	                                <input type="text" class="input-sm d_amount" disabled id="a_tencents'.$cash['id'].'" placeholder="0" value="0">
	                            </td>
	                        </tr>

	                        <tr id="trcash_fivecents">
	                            <td>
	                                <input type="text" class="input-sm" id="d_fivecents" disabled="" placeholder="₱0.05">
	                            </td>
	                            <td>
	                                <input type="number" min="0" class="input-sm quantity quantity12" id="q_fivecents'.$cash['id'].'" placeholder="0" value="'.$cash['five_cents'].'">
	                            </td>
	                            <td>
	                                <input type="text" class="input-sm d_amount" disabled id="a_fivecents'.$cash['id'].'" placeholder="0" value="0">
	                            </td>
	                        </tr>

	                        <tr id="trcash_onecents">
	                            <td>
	                                <input type="text" class="input-sm" id="d_onecents" disabled="" placeholder="₱0.01">
	                            </td>
	                            <td>
	                                <input type="number" min="0" class="input-sm quantity quantity13" id="q_onecents'.$cash['id'].'" placeholder="0" value="'.$cash['one_cents'].'">
	                            </td>
	                            <td>
	                                <input type="text" class="input-sm d_amount" disabled id="a_onecents'.$cash['id'].'" placeholder="0" value="0">
	                            </td>
	                        </tr>

	                        <tr>
	                            <td style="float: right;">
                 					<button type="button" id="reset_cfscashden" class="btn btn-primary waves-effect" onclick="cfs_reset_history_js()">RESET</button>
	                                <button type="button" id="submit_cfscashden" class="btn btn-warning waves-effect" onclick="cfs_update_cash_history_js('.$cash['id'].')">UPDATE</button>
	                            </td>
	                            <td>
	                                <input type="text" class="input-sm" id="total_cashtxt" disabled="" placeholder="TOTAL CASH">
	                            </td>
	                            <td>
	                                <input type="text" class="input-sm quantity14" disabled id="total_cash'.$cash['id'].'" placeholder="0.00">
	                            </td>
	                        </tr>

	                    </tbody>
	                </form>
	            </table>
	          </div>
	          

	          <script>

	          	 cfs_cash_history_js('.$id.');

	          	 $("#q_onek'.$cash['id'].',#q_fiveh'.$cash['id'].',#q_twoh'.$cash['id'].',#q_oneh'.$cash['id'].',#q_fifty'.$cash['id'].',#q_twenty'.$cash['id'].',#q_ten'.$cash['id'].',#q_five'.$cash['id'].',#q_one'.$cash['id'].',#q_twentyfivecents'.$cash['id'].',#q_tencents'.$cash['id'].',#q_fivecents'.$cash['id'].',#q_onecents'.$cash['id'].'").on("change keyup", function() {
		         
		          var res = $("#q_onek'.$cash['id'].'").val() * 1000;
				  var res1 = $("#q_fiveh'.$cash['id'].'").val() * 500;
				  var res2 = $("#q_twoh'.$cash['id'].'").val() * 200;
				  var res3 = $("#q_oneh'.$cash['id'].'").val() * 100;
				  var res4 = $("#q_fifty'.$cash['id'].'").val() * 50;
				  var res5 = $("#q_twenty'.$cash['id'].'").val() * 20;
				  var res6 = $("#q_ten'.$cash['id'].'").val() * 10;
				  var res7 = $("#q_five'.$cash['id'].'").val() * 5;
				  var res8 = $("#q_one'.$cash['id'].'").val() * 1;
				  var res9 = $("#q_twentyfivecents'.$cash['id'].'").val() * 0.25;
				  var res10 = $("#q_tencents'.$cash['id'].'").val() * 0.10;
				  var res11 = $("#q_fivecents'.$cash['id'].'").val() * 0.05;
				  var res12 = $("#q_onecents'.$cash['id'].'").val() * 0.01;
				   
				    var amount = res;
				    var amount1 = res1;
				    var amount2 = res2;
				    var amount3 = res3;
				    var amount4 = res4;
				    var amount5 = res5;
				    var amount6 = res6;
				    var amount7 = res7;
				    var amount8 = res8;
				    var amount9 = res9;
				    var amount10 = res10;
				    var amount11 = res11;
				    var amount12 = res12;

				    var amount13 = parseFloat(amount) + 
				    parseFloat(amount1) + 
				    parseFloat(amount2) + 
				    parseFloat(amount3) + 
				    parseFloat(amount4) + 
				    parseFloat(amount5) + 
				    parseFloat(amount6) + 
				    parseFloat(amount7) + 
				    parseFloat(amount8) + 
				    parseFloat(amount9) + 
				    parseFloat(amount10) + 
				    parseFloat(amount11) + 
				    parseFloat(amount12) ;

				    $("#a_onek'.$cash['id'].'").val(amount.toLocaleString());
				    $("#a_fiveh'.$cash['id'].'").val(amount1.toLocaleString());
				    $("#a_twoh'.$cash['id'].'").val(amount2.toLocaleString());
				    $("#a_oneh'.$cash['id'].'").val(amount3.toLocaleString());
				    $("#a_fifty'.$cash['id'].'").val(amount4.toLocaleString());
				    $("#a_twenty'.$cash['id'].'").val(amount5.toLocaleString());
				    $("#a_ten'.$cash['id'].'").val(amount6.toLocaleString());
				    $("#a_five'.$cash['id'].'").val(amount7.toLocaleString());
				    $("#a_one'.$cash['id'].'").val(amount8.toLocaleString());
				    $("#a_twentyfivecents'.$cash['id'].'").val(amount9.toLocaleString());
				    $("#a_tencents'.$cash['id'].'").val(amount10.toLocaleString());
				    $("#a_fivecents'.$cash['id'].'").val(amount11.toLocaleString());
				    $("#a_onecents'.$cash['id'].'").val(amount12.toLocaleString());

				    $("#total_cash'.$cash['id'].'").val(amount13.toLocaleString());
		
		        });

	          </script>
	          </div>
					';
		}
    
		$data['html']=$html;    	   
		echo json_encode($data);
	}

	public function cfs_update_cash_history_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$emp_id = $_SESSION['emp_id'];
			$id = $_POST['id'];
			$cash_type = $_POST['cash_type'];
			$cash_type_result = $this->cfscashier_model->validate_cashtype_model($id,$emp_id,$cash_type);
			// var_dump($cash_type_result);
			
			if(empty($cash_type_result))
			{
				$message = "OKAY";
				$this->cfscashier_model->cfs_update_cash_history_model(
					$emp_id,
					$id,
					$cash_type,
					$_POST['onek'],
					$_POST['fiveh'],
					$_POST['twoh'],
					$_POST['oneh'],
					$_POST['fifty'],
					$_POST['twenty'],
					$_POST['ten'],
					$_POST['five'],
					$_POST['one'],
					$_POST['twentyfive_cents'],
					$_POST['ten_cents'],
					$_POST['five_cents'],
					$_POST['one_cents'],
					$_POST['total_cash']
				);
				
				echo json_encode($message);
			}
			else
			{
				$message = $cash_type;

				echo json_encode($message);	
			}
		}
	}

	public function get_pending_noncash_ctrl()
	{
		$emp_id = $_SESSION['emp_id'];
		$noncash_pending = $this->cfscashier_model->get_pending_noncash_model($emp_id);


		$html = '';
		foreach($noncash_pending as $noncash)
		{

			$query=$this->cfscashier_model->get_pending_ncash_type_model($noncash['cfs_noncashtype']);
			$query2=$this->cfscashier_model->get_pending_ncash_bank_model($noncash['cfs_bankname']);
			
			$noncash_mop='';
			foreach ($query as $q)
			{
				$noncash_mop.='
							<option id="" value="'.$q['ncash_mopname'].'">'.$q['ncash_mopname'].'</option>
							';
			}

			$noncash_bankname='';
			foreach ($query2 as $q2)
			{
				$noncash_bankname.='
								<option id="" value="'.$q2['bank_name'].'">'.$q2['bank_name'].'</option>
								';
			}

		$id = $noncash['id'];
		$amount = number_format($noncash['cfs_amount'], 2);
		$html.='
				<div id="divnoncash'.$id.'"><br>
		            <form>
		              <center>
		                <label id="cfscashier_ncashlbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;">SELECT NONCASH TYPE&nbsp;</label>
		                <select class="noncash_class" style="font-size: 15px; margin-top: -1%; font-weight: bold; border: solid 2px; text-align: center;" name="cfs_ncashmop'.$id.'" id="cfs_ncashmop'.$id.'">
		                	<option id="" style="text-align: center;" value="">'.$noncash['cfs_noncashtype'].'</option>
		                  '.$noncash_mop.'
		                </select>
		              </center>
		            </form>

		          <div class="table-scrollable">
		            <table class="table table-striped table-bordered table-hover display">
		              <thead>
		                <tr>

		                  <th style="font-weight: bold; font-size: 15px;" width="40%">
		                    <center>DENOMINATION
		                  </th>
		                  <th style="font-weight: bold; font-size: 15px;" width="60%">
		                    <center>BANK NAME / CHECK NO. / AMOUNT
		                  </th>
		                 
		                  </tr>
		              </thead>

		                <form name="cfscashier_ncashform'.$id.'" id="cfscashier_ncashform'.$id.'">
		                    <tbody id="cfscashier_ncashtbody">
		                      
		                      <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="" disabled="" placeholder="BANK NAME">
		                            </td>
		                            <td>
		                                <center><select class="noncash_class" style="font-size: 20px; margin-top: -1%; font-weight: bold; border: solid 2px; text-align: center; margin-top: 0%;" name="cfs_ncash_bankname'.$id.'" id="cfs_ncash_bankname'.$id.'">
		                                	<option id="" value="">'.$noncash['cfs_bankname'].'</option>
		                  					'.$noncash_bankname.'
		                                </select></center>
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="" disabled="" placeholder="CHEQUE NO.">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm noncash_class cheq_no" required id="cfs_noncash_cheqno'.$id.'" placeholder="CHEQUE NO." value="'.$noncash['cfs_cheqno'].'">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="" disabled="" placeholder="AMOUNT">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm noncash_class ncashd_amount" required id="cfs_noncash_amount'.$id.'" placeholder="₱ 0.00" value="'.$amount.'">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td style="float: right;">
		                                <button type="button" id="reset_cfscashden" class="btn btn-primary waves-effect" onclick="cfs_reset_history_js()">RESET</button>
	                                	<button type="button" id="submit_cfscashden" class="btn btn-warning waves-effect" onclick="cfs_update_noncash_history_js('.$id.')">UPDATE</button>
		                            </td>
		                            <td>
		                                
		                            </td>
		                        </tr>

		                    </tbody>
		                </form>
		            </table>
		          </div>
		          

		          <script>

		          	  $(".cheq_no").on("change keyup keypress keydown", function() {
				          var sanitized = $(this).val().replace(/[^0-9]/g, "");
				          $(this).val(sanitized);
				        });

		          	 $(".ncashd_amount").maskMoney({thousands:",", decimal:".", allowZero: true, suffix: " "});

		          </script>
		          </div>
				';

			}


		$data['html']=$html;    	   
		echo json_encode($data);
	}

	public function cfs_update_noncash_history_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$emp_id = $_SESSION['emp_id'];
			
			$message = "success";
			$this->cfscashier_model->cfs_update_noncash_history_model(
				$emp_id,
				$_POST['id'],
				$_POST['noncash_type'],
				$_POST['bank_name'],
				$_POST['cheq_no'],
				$_POST['amount']
			);
			
			echo json_encode($message);
		}
	}

	public function get_pending_forex_ctrl()
	{
		$emp_id = $_SESSION['emp_id'];
		$pending_forex = $this->cfscashier_model->get_pending_forex_model($emp_id);

		$html = '';
		foreach($pending_forex as $forex)
		{
			$tr_no = $forex['tr_no'];
			$exchange_rate = $this->cfscashier_model->get_forex_exchange_rate_history_model($tr_no,$emp_id,$forex['forex_currency']);

			$fiveh = '';
			$twoh = '';
			$oneh = '';
			$fifty = '';
			$twenty = '';
			$ten = '';
			$five = '';
			$two = '';
			$one = '';
			foreach($exchange_rate as $rate) 
			{
				$fiveh = $rate['fiveh'];
				$twoh = $rate['twoh'];
				$oneh = $rate['oneh'];
				$fifty = $rate['fifty'];
				$twenty = $rate['twenty'];
				$ten = $rate['ten'];
				$five = $rate['five'];
				$two = $rate['two'];
				$one = $rate['one'];
			}

			$query1=$this->cfscashier_model->get_forex_symbol_history_model($forex['forex_currency']);
			$forex_currency='';
			foreach ($query1 as $q1)
			{
				$forex_currency.='

						<option id="" style="text-align: center;" value="'.$q1['forex_currency'].'">'.$q1['forex_currency'].'</option>

							';
			}

			$query=$this->cfscashier_model->get_forex_symbol_model($forex['forex_currency']);
		 	foreach ($query as $q)
			{
				$symbol=$q['forex_symbol'];
				$total_currency=$q['forex_currency'];
			}

			if($symbol == '$')
			{
				$dollar='hidden';
				$euro='';
			}
			else if($symbol == '€')
			{
				$euro='hidden';
				$dollar='';
			}

			$id = $forex['id'];
			$html.='
					<div id="div'.$id.'"><br>
	                <form>
	                  <center>
	                    <label id="forex_selectlbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;">SELECT CURRENCY&nbsp;</label>
	                    <select class="val" onchange="history_change_currency_js('.$id.','."'".$tr_no."'".')" style="font-size: 15px; margin-top: -1%; font-weight: bold; border: solid 2px;" name="cfs_forex_list'.$id.'" id="cfs_forex_list'.$id.'">
	                    	<option id="" style="text-align: center;" value="'.$forex['forex_currency'].'">'.$forex['forex_currency'].'</option>
	    					'.$forex_currency.'
	                    </select>
	                  </center>
	                </form>

	          <div class="table-scrollable">
	            <table class="table table-striped table-bordered table-hover display">
	              <thead>
	                <tr>

	                  <th style="font-weight: bold; font-size: 15px;" width="20%">
	                    <center>DENOMINATION
	                  </th>
	                  <th style="font-weight: bold; font-size: 15px;" width="20%">
	                    <center>QUANTITY
	                  </th>
	                  <th style="font-weight: bold; font-size: 15px;" width="20%">
	                    <center>TOTAL FRGN. CUR.
	                  </th>
	                  <th style="font-weight: bold; font-size: 15px;" width="20%">
	                    <center>EXCHANGE RATE
	                  </th>
	                  <th style="font-weight: bold; font-size: 15px;" width="20%">
	                    <center>PESO AMOUNT
	                  </th>

	                  </tr>
	              </thead>
	              	<input hidden value="'.$id.'" id="val_id'.$id.'">
	                <form name="cfscashier_cashform" id="cfscashier_cashform">
	                    <tbody id="cfscashier_forextbody'.$id.'">
	                      
	                        <tr '.$dollar.'>
				                <td>
				                    <input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="'.$symbol.'500">
				                </td>
				                <td>
				                    <input type="number" min="0" class="input-sm val" value="'.$forex['fiveh'].'" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_fiveh'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm tfc_fiveh" disabled id="htfc_fiveh'.$id.'" placeholder="0" value="0">
				                </td>
				                <td>
				                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" value="'.$fiveh.'" id="her_fiveh'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm pa_fiveh" disabled id="hpa_fiveh'.$id.'" placeholder="0" value="0">
				                </td>
				            </tr>

				            <tr '.$dollar.'>
				                <td>
				                    <input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="'.$symbol.'200">
				                </td>
				                <td>
				                    <input type="number" min="0" class="input-sm val" value="'.$forex['twoh'].'" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_twoh'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm tfc_twoh" disabled id="htfc_twoh'.$id.'" placeholder="0" value="0">
				                </td>
				                <td>
				                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" value="'.$twoh.'" id="her_twoh'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm pa_twoh" disabled id="hpa_twoh'.$id.'" placeholder="0" value="0">
				                </td>
				            </tr>

				            <tr>
				                <td>
				                    <input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="'.$symbol.'100">
				                </td>
				                <td>
				                    <input type="number" min="0" class="input-sm val" value="'.$forex['oneh'].'" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_oneh'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm tfc_oneh" disabled id="htfc_oneh'.$id.'" placeholder="0" value="0">
				                </td>
				                <td>
				                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" value="'.$oneh.'" id="her_oneh'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm pa_oneh" disabled id="hpa_oneh'.$id.'" placeholder="0" value="0">
				                </td>
				            </tr>

				            <tr>
				                <td>
				                    <input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="'.$symbol.'50">
				                </td>
				                <td>
				                    <input type="number" min="0" class="input-sm val" value="'.$forex['fifty'].'" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_fifty'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm tfc_fifty" disabled id="htfc_fifty'.$id.'" placeholder="0" value="0">
				                </td>
				                <td>
				                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" value="'.$fifty.'" id="her_fifty'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm pa_fifty" disabled id="hpa_fifty'.$id.'" placeholder="0" value="0">
				                </td>
				            </tr>

				            <tr>
				                <td>
				                    <input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="'.$symbol.'20">
				                </td>
				                <td>
				                    <input type="number" min="0" class="input-sm val" value="'.$forex['twenty'].'" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_twenty'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm tfc_twenty" disabled id="htfc_twenty'.$id.'" placeholder="0" value="0">
				                </td>
				                <td>
				                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" value="'.$twenty.'" id="her_twenty'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm pa_twenty" disabled id="hpa_twenty'.$id.'" placeholder="0" value="0">
				                </td>
				            </tr>

				            <tr>
				                <td>
				                    <input type="text" class="input-sm" id="d_ten" disabled="" placeholder="'.$symbol.'10">
				                </td>
				                <td>
				                    <input type="number" min="0" class="input-sm val" value="'.$forex['ten'].'" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_ten'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm tfc_ten" disabled id="htfc_ten'.$id.'" placeholder="0" value="0">
				                </td>
				                <td>
				                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" value="'.$ten.'" id="her_ten'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm pa_ten" disabled id="hpa_ten'.$id.'" placeholder="0" value="0">
				                </td>
				            </tr>

				            <tr>
				                <td>
				                    <input type="text" class="input-sm" id="d_five" disabled="" placeholder="'.$symbol.'5">
				                </td>
				                <td>
				                    <input type="number" min="0" class="input-sm val" value="'.$forex['five'].'" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_five'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm tfc_five" disabled id="htfc_five'.$id.'" placeholder="0" value="0">
				                </td>
				                <td>
				                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" value="'.$five.'" id="her_five'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm pa_five" disabled id="hpa_five'.$id.'" placeholder="0" value="0">
				                </td>
				            </tr>

				            <tr '.$euro.'>
				                <td>
				                    <input type="text" class="input-sm" id="d_two" disabled="" placeholder="'.$symbol.'2">
				                </td>
				                <td>
				                    <input type="number" min="0" class="input-sm val" value="'.$forex['two'].'" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_two'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm tfc_two" disabled id="htfc_two'.$id.'" placeholder="0" value="0">
				                </td>
				                <td>
				                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" value="'.$two.'" id="her_two'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm pa_two" disabled id="hpa_two'.$id.'" placeholder="0" value="0">
				                </td>
				            </tr>

				            <tr '.$euro.'>
				                <td>
				                    <input type="text" class="input-sm" id="d_one" disabled="" placeholder="'.$symbol.'1">
				                </td>
				                <td>
				                    <input type="number" min="0" class="input-sm val" value="'.$forex['one'].'" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_one'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm tfc_one" disabled id="htfc_one'.$id.'" placeholder="0" value="0">
				                </td>
				                <td>
				                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" value="'.$one.'" id="her_one'.$id.'" placeholder="0">
				                </td>
				                <td>
				                    <input type="text" class="input-sm pa_one" disabled id="hpa_one'.$id.'" placeholder="0" value="0">
				                </td>
				            </tr>

				            <tr>
				                <td style="float: right;">
				                    <button type="button" id="btn_reset_noncashform" class="btn btn-primary waves-effect" onclick="cfs_reset_history_js()">RESET</button>
									<button type="button" id="btn_save_noncashform" class="btn btn-warning waves-effect" onclick="update_forex_denomination_js('.$id.','."'".$tr_no."'".')">UPDATE</button>
				                </td>
				                <td>
				                    <input type="text" class="input-sm" id="forex_total_fctxt" disabled="" placeholder="TOTAL '.$total_currency.' ">
				                </td>
				                <td>
				                    <input type="text" class="input-sm val" disabled id="htotal_forex_fc'.$id.'" placeholder="0.00">
				                </td>
				                <td>
				                    <input type="text" class="input-sm" id="forex_total_pesotxt" disabled="" placeholder="TOTAL PESO AMOUNT">
				                </td>
				                <td>
				                    <input type="text" class="input-sm val" disabled id="htotal_forex_peso'.$id.'" placeholder="0.00">
				                </td>
				            </tr>

	                    </tbody>
	                </form>
	            </table>
	          </div>
	          

	          <script>

	          		history_disabled_exchange_rate_js('.$id.');
	        		history_tfccalculation_js('.$id.');
		       		history_disabled_spcharater_js('.$id.');

	          		$(".er_amount").maskMoney({thousands:",", decimal:".", allowZero: true, suffix: " "}).attr("maxlength", 7);

	          </script>
	          </div>
					';
		}

		
		// var_dump($pending_forex);
		$data['html']=$html;    	   
		echo json_encode($data);
	}

	public function history_change_currency_ctrl()
	{
		$id = $_POST['id'];
		$selected_trno = $_POST['tr_no'];
		$currency = $_POST['currency'];
	 	$query=$this->cfscashier_model->get_forex_symbol_model($currency);

	 	foreach ($query as $q)
		{
			$symbol=$q['forex_symbol'];
			$total_currency=$q['forex_currency'];
		}

		if($symbol == '$')
		{
			$dollar='hidden';
			$euro='';
		}
		else if($symbol == '€')
		{
			$euro='hidden';
			$dollar='';
		}
		

		$emp_id = $_SESSION['emp_id'];
		$forex_denomination = $this->cfscashier_model->get_forex_denomination_model($id,$emp_id,$currency);
		
		$tr_no = '';
		$fiveh = '';
		$twoh = '';
		$oneh = '';
		$fifty = '';
		$twenty = '';
		$ten = '';
		$five = '';
		$two = '';
		$one = '';
		if(!empty($forex_denomination))
		{
			foreach($forex_denomination as $forex)
			{
				$tr_no = $forex['tr_no'];
				$fiveh = $forex['fiveh'];
				$twoh = $forex['twoh'];
				$oneh = $forex['oneh'];
				$fifty = $forex['fifty'];
				$twenty = $forex['twenty'];
				$ten = $forex['ten'];
				$five = $forex['five'];
				$two = $forex['two'];
				$one = $forex['one'];
			}
		}


		$forex_exchange_rate = $this->cfscashier_model->get_forex_exchange_rate_history_model($tr_no,$emp_id,$currency);

		$er_fiveh = '';
		$er_twoh = '';
		$er_oneh = '';
		$er_fifty = '';
		$er_twenty = '';
		$er_ten = '';
		$er_five = '';
		$er_two = '';
		$er_one = '';
		if(!empty($forex_exchange_rate))
		{
			foreach($forex_exchange_rate as $rate)
			{
				$er_fiveh = $rate['fiveh'];
				$er_twoh = $rate['twoh'];
				$er_oneh = $rate['oneh'];
				$er_fifty = $rate['fifty'];
				$er_twenty = $rate['twenty'];
				$er_ten = $rate['ten'];
				$er_five = $rate['five'];
				$er_two = $rate['two'];
				$er_one = $rate['one'];
			}
		}
		// var_dump($forex_exchange_rate);

		$html='
				<tr '.$dollar.'>
	                <td>
	                    <input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="'.$symbol.'500">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_fiveh'.$id.'" placeholder="0" value="'.$fiveh.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_fiveh" disabled id="htfc_fiveh'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" id="her_fiveh'.$id.'" placeholder="0" value="'.$er_fiveh.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_fiveh" disabled id="hpa_fiveh'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr '.$dollar.'>
	                <td>
	                    <input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="'.$symbol.'200">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_twoh'.$id.'" placeholder="0" value="'.$twoh.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_twoh" disabled id="htfc_twoh'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" id="her_twoh'.$id.'" placeholder="0" value="'.$er_twoh.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_twoh" disabled id="hpa_twoh'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="'.$symbol.'100">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_oneh'.$id.'" placeholder="0" value="'.$oneh.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_oneh" disabled id="htfc_oneh'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" id="her_oneh'.$id.'" placeholder="0" value="'.$er_oneh.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_oneh" disabled id="hpa_oneh'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="'.$symbol.'50">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_fifty'.$id.'" placeholder="0" value="'.$fifty.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_fifty" disabled id="htfc_fifty'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" id="her_fifty'.$id.'" placeholder="0" value="'.$er_fifty.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_fifty" disabled id="hpa_fifty'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="'.$symbol.'20">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_twenty'.$id.'" placeholder="0" value="'.$twenty.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_twenty" disabled id="htfc_twenty'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" id="her_twenty'.$id.'" placeholder="0" value="'.$er_twenty.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_twenty" disabled id="hpa_twenty'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_ten" disabled="" placeholder="'.$symbol.'10">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_ten'.$id.'" placeholder="0" value="'.$ten.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_ten" disabled id="htfc_ten'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" id="her_ten'.$id.'" placeholder="0" value="'.$er_ten.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_ten" disabled id="hpa_ten'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_five" disabled="" placeholder="'.$symbol.'5">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_five'.$id.'" placeholder="0" value="'.$five.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_five" disabled id="htfc_five'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" id="her_five'.$id.'" placeholder="0" value="'.$er_five.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_five" disabled id="hpa_five'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr '.$euro.'>
	                <td>
	                    <input type="text" class="input-sm" id="d_two" disabled="" placeholder="'.$symbol.'2">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_two'.$id.'" placeholder="0" value="'.$two.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_two" disabled id="htfc_two'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" id="her_two'.$id.'" placeholder="0" value="'.$er_two.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_two" disabled id="hpa_two'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr '.$euro.'>
	                <td>
	                    <input type="text" class="input-sm" id="d_one" disabled="" placeholder="'.$symbol.'1">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm val" onchange="history_tfccalculation_js('.$id.')" onkeyup="history_tfccalculation_js('.$id.')" id="hq_one'.$id.'" placeholder="0" value="'.$one.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm tfc_one" disabled id="htfc_one'.$id.'" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm er_amount val" onchange="history_ercalculation_js('.$id.')" onkeyup="history_ercalculation_js('.$id.')" id="her_one'.$id.'" placeholder="0" value="'.$er_one.'">
	                </td>
	                <td>
	                    <input type="text" class="input-sm pa_one" disabled id="hpa_one'.$id.'" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td style="float: right;">
	                    <button type="button" id="btn_reset_noncashform" class="btn btn-primary waves-effect" onclick="cfs_reset_history_js()">RESET</button>
						<button type="button" id="btn_save_noncashform" class="btn btn-warning waves-effect" onclick="update_forex_denomination_js('.$id.','."'".$selected_trno."'".')">UPDATE</button>
	                </td>
	                <td>
	                    <input type="text" class="input-sm" id="forex_total_fctxt" disabled="" placeholder="TOTAL '.$total_currency.' ">
	                </td>
	                <td>
	                    <input type="text" class="input-sm val" disabled id="htotal_forex_fc'.$id.'" placeholder="0.00">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" id="forex_total_pesotxt" disabled="" placeholder="TOTAL PESO AMOUNT">
	                </td>
	                <td>
	                    <input type="text" class="input-sm val" disabled id="htotal_forex_peso'.$id.'" placeholder="0.00">
	                </td>
	            </tr>


	            <script>

	            	history_disabled_exchange_rate_js('.$id.');
	            	history_tfccalculation_js('.$id.');
		       		history_disabled_spcharater_js('.$id.');
	         		
	         		$(".er_amount").maskMoney({thousands:",", decimal:".", allowZero: true, suffix: " "}).attr("maxlength", 7);

	            </script>

				';
	   
		$data['html']=$html;    	   
		echo json_encode($data);
	}

	public function disabled_cfssaveresetbtn_ctrl()
	{
		$emp_id = $_SESSION['emp_id'];
		$query=$this->cfscashier_model->disabled_cfssaveresetbtn_model($emp_id);

		$status="";
		foreach ($query as $q)
		{
			$status = $q['status'];

		}

		$data=$status;    	   
		echo json_encode(trim($data));
	}

	public function disabled_cfs_forex_form_ctrl()
	{
		$emp_id = $_SESSION['emp_id'];
		$query=$this->cfscashier_model->disabled_cfs_forex_form_model($emp_id);

		$status="";
		foreach ($query as $q)
		{
			$status = $q['status'];

		}

		$data=$status;    	   
		echo json_encode(trim($data));
	}

	public function disabled_cfsnoncashform_ctrl()
	{
		$emp_id = $_SESSION['emp_id'];
		$query=$this->cfscashier_model->disabled_cfsnoncashform_model($emp_id);

		$status="";
		foreach ($query as $q)
		{
			$status = $q['status'];

		}

		$data=$status;    	   
		echo json_encode(trim($data));
	}

	public function update_forex_denomination_ctrl()
	{
		if(empty($_SESSION['emp_id']))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$emp_id = $_SESSION['emp_id'];
			$id = $_POST['id'];
			$tr_no = $_POST['tr_no'];
			$currency = $_POST['currency'];
			$currency_result = $this->cfscashier_model->validate_currency_model($id,$emp_id,$currency);
			// var_dump($tr_no);
			
			if(empty($currency_result))
			{
				$this->cfscashier_model->update_forex_denomination_fc_model(
					$id,
					$emp_id,
					$currency,
					$_POST['q_fiveh'],
					$_POST['q_twoh'],
					$_POST['q_oneh'],
					$_POST['q_fifty'],
					$_POST['q_twenty'],
					$_POST['q_ten'],
					$_POST['q_five'],
					$_POST['q_two'],
					$_POST['q_one'],
					$_POST['total_peso']
				);


				$message = "OKAY";
				$this->cfscashier_model->update_forex_denomination_exchange_rate_model(
					$tr_no,
					$emp_id,
					$currency,
					$_POST['er_fiveh'],
					$_POST['er_twoh'],
					$_POST['er_oneh'],
					$_POST['er_fifty'],
					$_POST['er_twenty'],
					$_POST['er_ten'],
					$_POST['er_five'],
					$_POST['er_two'],
					$_POST['er_one']
				);
				
				echo json_encode($message);
			}
			else
			{
				$message = $currency;

				echo json_encode($message);	
			}
		}
	}


}