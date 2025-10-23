<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_controller extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model("main_model");
        $this->load->model("cashier_model");
		$this->load->model("liquidation_model");
		$this->load->model("cfscashier_model");
		$this->load->model("treasury_model");
		$this->load->model("supervisor_model");
        $this->load->model("admin_model");
		$this->load->helper('text');
	}

	public function admin_dashboard_ctrl()
	{
		$data['emp_id'] = $_SESSION['emp_id'];
		$data['username'] = $_SESSION['username'];

        if(empty($_SESSION['emp_id']))
        {
            redirect('http://'.$_SERVER['HTTP_HOST'].'/hrms/employee/');
        }
        else
        {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);

            
            $data['photo_url'] =  '';
            if(count($info) > 0){
                $data['photo_url'] =  $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }
         
            $this->load->view('admin_side/dashboard', $data);
        }
	}

	public function adduser_access_ctrl()
	{
		$data['emp_id'] = $_SESSION['emp_id'];
		$data['username'] = $_SESSION['username'];

        if(empty($_SESSION['emp_id']))
        {
            redirect('http://'.$_SERVER['HTTP_HOST'].'/hrms/employee/');
        }
        else
        {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);

            
            $data['photo_url'] =  '';
            if(count($info) > 0){
                $data['photo_url'] =  $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }
         
            $this->load->view('admin_side/addpayment_user_form', $data);
        }
	}

	public function admin_add_mop_ctrl()
    {
        $data['emp_id'] = $_SESSION['emp_id'];
        $data['username'] = $_SESSION['username'];

        if(empty($_SESSION['emp_id']))
        {
            redirect('http://'.$_SERVER['HTTP_HOST'].'/hrms/employee/');
        }
        else
        {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);

            
            $data['photo_url'] =  '';
            if(count($info) > 0){
                $data['photo_url'] =  $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }
         
            $this->load->view('admin_side/add_bu_mop', $data);
        }
    }

	public function cashier_transaction_ctrl()
	{
		$data['emp_id'] = $_SESSION['emp_id'];
		$data['username'] = $_SESSION['username'];

        if(empty($_SESSION['emp_id']))
        {
            redirect('http://'.$_SERVER['HTTP_HOST'].'/hrms/employee/');
        }
        else
        {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);

            
            $data['photo_url'] =  '';
            if(count($info) > 0){
                $data['photo_url'] =  $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }
         
            $this->load->view('admin_side/cashier_transaction', $data);
            $this->load->view('admin_side/cashier_transaction_modal');
        }
	}

	public function display_bunit_ctrl()
	{
		$bunit_data = $this->admin_model->get_bunit_model();
		// var_dump($bunit_data);
		
		$bunit_name = '';
		foreach($bunit_data as $data)
		{
			$bunit_name.='
						<option value="'.$data['bcode'].'">'.$data['business_unit'].'</option>
						';
		}

		$data['bunit_name'] = $bunit_name;
		echo json_encode($data);
	}

	public function search_emp_ctrl()
	{
		if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
			$emp_data = $this->admin_model->get_emp_name_model($_POST['emp_name']);
			
			$emp_name = '';
			foreach($emp_data as $data)
			{
				$emp_name .= $data['name']."^";
			}
			// var_dump($emp_name);
			
			$data['emp_name'] = $emp_name;
			echo json_encode($data);
		}
	}

	public function addpayment_user_ctrl()
	{
		if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
			$emp_data = $this->admin_model->get_empid_model($_POST['emp_name']);

			if(empty($emp_data))
			{
				$message = "INVALID EMPLOYEE";
            	echo json_encode($message);
			}
			else
			{	
				$emp_id = '';
				foreach($emp_data as $data)
				{
					$emp_id = $data['emp_id'];
				}
				
				$validate = $this->admin_model->validate_empid_model($emp_id);

				if(empty($validate))
				{
					$message = 'success';
					$this->admin_model->addpayment_user_model($emp_id);

					echo json_encode($message);
				}
				else
				{
					$message = "ALREADY EXIST";
            		echo json_encode($message);	
				}
			}
		}
	}

	public function display_user_ctrl()
	{
		$user_data = $this->admin_model->get_users_model();

		$html = '
				 <table class="table table-striped table-bordered table-hover display" id="addpayment_user_table" style="color: black; font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th>
                                                <center>EMPLOYEE NAME
                                            </th>
                                            <th>
                                                <center>ACTION
                                            </th>
                                        </tr>
                                    </thead>
                                    <form name="addpayment_user_viewing_form" id="addpayment_user_viewing_form">
                                        <tbody id="addpayment_user_viewing_tbody">
				';
		foreach($user_data as $data)
		{
			$emp_data = $this->admin_model->get_empname_model($data['emp_id']);
			
			$name = '';
			foreach($emp_data as $emp)
			{
				$name = $emp['name'];
			}

			$html.=' 
                        <tr>
                          <td>'.$name.'</td>
                          <td>
                            <input type="button" style="background-color: red; border: 0px; color: white;" onclick="delete_user_js('.$data['id'].', '."'".$name."'".')" value="DELETE">
                          </td>
                        </tr>
                      ';
		}

		$html.='
                            </tbody>
                        </form>
                    </table>

                    ';
                    // var_dump($html);
		$data['html'] = $html;
		echo json_encode($data);
	}

	public function delete_user_ctrl()
	{
		if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
        	$message = 'success';
        	$this->admin_model->delete_user_model($_POST['id']);

        	echo json_encode($message);
        }
	}

	public function admin_get_bunit_ctrl()
    {
        $bunit_data = $this->liquidation_model->get_bunit_model_v2();
        $bunit_name = '';
        foreach($bunit_data as $bunit)
        {
            $bunit_name .= '
                            <option value="'.$bunit['bcode'].'">'.$bunit['business_unit'].'</option>
                            ';
        }

        $data['bunit_name'] = $bunit_name;
        echo json_encode($data);
    }

	public function display_payment_list_ctrl()
    {
        $payment_list = $this->supervisor_model->get_payment_list_model($_SESSION['emp_id']);
        $html='
                <table class="table table-striped table-bordered table-hover display" id="payment_list_table" style="color: black; font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>MODE OF PAYMENT
                                        </th>
                                        <th>
                                            <center>TYPE
                                        </th>
                                        <th>
                                            <center>B.U / DEPT.
                                        </th>
                                        <th>
                                            <center>ACTION
                                        </th>
                                    </tr>
                                </thead>
                                <form name="payment_list_viewing_form" id="payment_list_viewing_form">
                                    <tbody id="payment_list_viewing_tbody">
                ';

        foreach($payment_list as $list)
        {   
            
            $bunitname_data = $this->supervisor_model->get_bunitname_model($list['bunit_code']);

            $bunit_name = '';
            foreach($bunitname_data as $bname)
            {
                $bunit_name = $bname['business_unit'];
            }


            $deptname_data = $this->supervisor_model->get_deptname_model($list['dept_code']);

            $dept_name = '';
            foreach($deptname_data as $dname)
            {
                $dept_name = $dname['dept_name'];
            }

            $html.=' 
                    <tr>
                      <td style="vertical-align: middle;">'.$list['mop'].'</td>
                      <td style="vertical-align: middle;">'.$list['type'].'</td>
                      <td style="vertical-align: middle;">'.$bunit_name.'<br>'.$dept_name.'</td>
                      <td style="vertical-align: middle; font-size: large;">
                        <a id="" onclick="delete_mop_js('.$list['id'].','."'".$list['type']."'".','."'".$list['mop']."'".','."'".$list['dept_code']."'".','."'".$bunit_name."'".','."'".$dept_name."'".')">❌</a>
                      </td>
                    </tr>
                  ';
        } 
     
        $html.='
                        </tbody>
                    </form>
                </table>

                ';
        

        $data['html']=$html;                      
        echo json_encode($data);
    }

    public function get_all_bu_ctrl()
    {
        $bunit_data = $this->admin_model->get_bunit_name_model();
        $bunit_name = '';
        foreach($bunit_data as $bunit)
        {
            $bunit_name .= '
                            <option value="'.$bunit['bcode'].'">'.$bunit['business_unit'].'</option>
                            ';
        }

        $data['bunit_name'] = $bunit_name;
        echo json_encode($data);
    }

    public function get_admin_deptname_ctrl()
    {
        $dept_data = $this->admin_model->display_deptname_model($_POST['bcode']);
        $dept_name = '';

        if ($_POST['bcode'] == '0223') {
            $acro_name = 'ALTA -';
        } else if ($_POST['bcode'] == '0201') {
            $acro_name = 'ASC -';
        } else if ($_POST['bcode'] == '0203') {
            $acro_name = 'ICM -';
        } else {
            $acro_name = 'PM';
        }


        foreach($dept_data as $dept)
        {
            $dept_name .= '
                            <option value="'.$dept['dcode'].'">'.$acro_name.' '.$dept['dept_name'].'</option>
                            ';
        }

        $data['dept_name'] = $dept_name;
        echo json_encode($data);
    }

    public function get_cashier_transaction_ctrl()
    {
        $transaction_data = $this->admin_model->get_cashier_transaction_model($_POST['dcode'],$_POST['date']);
        // ===================================================================================================
        $html = '
                <table class="table table-striped table-bordered table-hover" id="cashier_transaction_tbl">
                    <thead>
                        <tr>
                            <th width="25%" style="text-align: center;">CASHIER\'S NAME</th>
                            <th width="25%" style="text-align: center;">LOCATION</th>
                            <th width="10%" style="text-align: center;">TERMINAL NO.</th>
                            <th width="50%" style="text-align: center;">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($transaction_data as $data)
                    {
                        $location_code = $_POST['dcode'].$data['sscode'];
                        $location = $_POST['dname'];
                        if(strlen($location_code) >= 8)
                        {
                            $section_data = $this->admin_model->get_section_name_model(substr($location_code, 0, 8));
                            if(!is_null($section_data->section_name))
                            {
                                $location = $section_data->section_name;
                            }
                            // =======================================================================
                            if(strlen($location_code) == 10)
                            {
                                $sub_section_data = $this->admin_model->get_sub_section_name_model($location_code);
                                if(!is_null($sub_section_data->sub_section_name))
                                {
                                    $location .= '&nbsp; / &nbsp;'.$sub_section_data->sub_section_name;
                                }
                            }
                        }
                        // ===========================================================================
                        $terminal_no = $data['cash_terminal'];
                        if($terminal_no == '')
                        {
                            $terminal_no = $data['noncash_terminal'];
                        }
                        // ===========================================================================
                        $html .= '<tr>
                                    <td style="vertical-align: middle;">'.$data['emp_name'].'</td>
                                    <td style="vertical-align: middle;">'.$location.'</td>
                                    <td style="vertical-align: middle;">'.$terminal_no.'</td>
                                    <td style="vertical-align: middle;">
                                        <a title="Cash Denomination" onclick="view_cash_den_js('."'".$data['tr_no']."','".$data['emp_id']."','".$location_code."','".$_POST['date']."','".$data['emp_name']."'".')">💰</a>&nbsp; | &nbsp;
                                        <a title="NonCash Denomination" onclick="view_noncash_den_js('."'".$data['tr_no']."','".$data['emp_id']."','".$location_code."','".$_POST['date']."','".$data['emp_name']."'".')">💳</a>
                                    </td>
                                  </tr>';
                    }
                    $html .= '
                    </tbody>
                </table>
        ';

        $data['html'] = $html;
        echo json_encode($data);
    }

    public function get_cashier_transaction_ctrl_v2()
    {
        $cash_transaction_data = $this->admin_model->get_cashier_cash_transaction_model($_POST['dcode'],$_POST['date']);
        $noncash_transaction_data = $this->admin_model->get_cashier_noncash_transaction_model($_POST['dcode'],$_POST['date']);
        // ==============================================================================================================
        $html = '
                <table class="table table-striped table-bordered table-hover" id="cashier_transaction_tbl">
                    <thead>
                        <tr>
                            <th style="text-align: center; width: 192.889px;">CASHIER\'S NAME</th>

                            <th style="text-align: center; width: 82.8889px;">TR NO</th>

                            <th style="text-align: center; width: 192.889px;">LOCATION</th>
                            <th style="text-align: center; width: 82.8889px;">TERMINAL</th>
                            <th style="text-align: center; width: 82.8889px;">REMIT TYPE</th>
                            <th style="text-align: center; width: 215px;">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>';
                    $cash_info_array = array();
                    foreach($cash_transaction_data as $cash)
                    {
                        // $get_cash_info = $this->admin_model->get_cash_info_model($cash['tr_no'],$_POST['date'], $cash['emp_id']);

                        if(!in_array($cash['tr_no'].'|'.$cash['emp_id'], $cash_info_array))
                        {
                            array_push($cash_info_array, $cash['tr_no'].'|'.$cash['emp_id']);
                        }
                        // =============================================================================
                        $location_code = $_POST['dcode'].$cash['sscode'];
                        $location = $_POST['dname'];
                        if(strlen($location_code) >= 8)
                        {
                            $section_data = $this->admin_model->get_section_name_model(substr($location_code, 0, 8));
                            if(!is_null($section_data->section_name))
                            {
                                $location = $section_data->section_name;
                            }
                            // =======================================================================
                            if(strlen($location_code) == 10)
                            {
                                $sub_section_data = $this->admin_model->get_sub_section_name_model($location_code);
                                if(!is_null($sub_section_data->sub_section_name))
                                {
                                    $location .= '&nbsp; / &nbsp;'.$sub_section_data->sub_section_name;
                                }
                            }
                        }
                        // ===========================================================================
                        $noncash_den = '';
                        if($cash['remit_type'] == 'FINAL')
                            {
                                $noncash_den = '
                                    <button class="btn btn-xs btn-primary" title="NonCash Denomination" 
                                        onclick="view_noncash_den_js('."'".$cash['tr_no']."','".$cash['emp_id']."','".$location_code."','".$_POST['date']."','".$cash['emp_name']."'".')">
                                        <i class="glyphicon glyphicon-credit-card"></i>
                                    </button>';
                            }
                            // ===========================================================================
                            $batch_remittance = '';
                            if($cash['liq_status'] == 'TRANSFERRED'){
                                $batch_remittance = '
                                    <button class="btn btn-xs btn-warning" title="Batch Remittance" 
                                        onclick="view_batch_remittance_js('."'".$cash['id']."','".$cash['tr_no']."','".$cash['emp_id']."','".$location_code."','".$cash['emp_name']."'".')">
                                        <i class="glyphicon glyphicon-transfer"></i>
                                    </button>';
                            }
                            // ===========================================================================
                            $html .= '<tr>
                                        <td style="vertical-align: middle;">'.$cash['emp_name'].'</td>
                                        <td style="vertical-align: middle;" class="text-center"><b>'.$cash['tr_no'].'</b></td>
                                        <td style="vertical-align: middle;">'.$location.'</td>
                                        <td style="vertical-align: middle;">'.$cash['pos_name'].'</td>
                                        <td style="vertical-align: middle;">'.$cash['remit_type'].'</td>
                                        <td style="vertical-align: middle;">
                                            <button class="btn btn-xs btn-success" title="Cash Denomination"
                                                onclick="view_cash_den_js('."'".$cash['id']."','".$cash['tr_no']."','".$cash['emp_id']."','".$location_code."','".$_POST['date']."','".$cash['emp_name']."','".$cash['remit_type']."'".')">
                                                <i class="glyphicon glyphicon-ruble"></i>
                                            </button>
                                            '.$noncash_den.'
                                            
                                            <button class="btn btn-xs btn-secondary" title="Terminal No. / Registered Sales / Transaction Count"
                                                onclick="view_terminal_js(this)" 
                                                data-trno="'.$cash['tr_no'].'" 
                                                data-empid="'.$cash['emp_id'].'" 
                                                data-loc="'.$location_code.'" 
                                                data-date="'.$_POST['date'].'" 
                                                data-emp="'.$cash['emp_name'].'" 
                                                data-pos="'.$cash['pos_name'].'">
                                                <i class="glyphicon glyphicon-blackboard"></i>
                                            </button>
                                            
                                            <button class="btn btn-xs btn-info" title="Sales Date"
                                                onclick="view_sales_date_js('."'".$cash['tr_no']."','".$cash['emp_id']."','".$location_code."','".$_POST['date']."'".')">
                                                <i class="glyphicon glyphicon-calendar"></i>
                                            </button>
                                            
                                            <button class="btn btn-xs btn-danger" title="Location"
                                                onclick="view_location_js('."'".$cash['tr_no']."','".$cash['emp_id']."','".$location_code."','".$_POST['date']."','".$cash['borrowed']."'".')">
                                                <i class="glyphicon glyphicon-map-marker"></i>
                                            </button>
                                            
                                            '.$batch_remittance.'
                                        </td>
                                    </tr>';


                    }
                    // <a title="Terminal No. / Registered Sales / Transaction Count" onclick="view_terminal_js('."'".$cash['tr_no']."','".$cash['emp_id']."','".$location_code."','".$_POST['date']."','".$cash['emp_name']."','".$cash['pos_name']."'".')">🖥️</a> &nbsp; | &nbsp;

                    // ===============================================================================================
                    foreach($noncash_transaction_data as $noncash)
                    {
                        // $get_cash_info = $this->admin_model->get_cash_info_model($noncash['tr_no'],$_POST['date'], $noncash['emp_id']);

                        if(!in_array($noncash['tr_no'].'|'.$noncash['emp_id'], $cash_info_array))
                        {
                            $location_code = $_POST['dcode'].$noncash['sscode'];
                            $location = $_POST['dname'];
                            if(strlen($location_code) >= 8)
                            {
                                $section_data = $this->admin_model->get_section_name_model(substr($location_code, 0, 8));
                                if(!is_null($section_data->section_name))
                                {
                                    $location = $section_data->section_name;
                                }
                                // =======================================================================
                                if(strlen($location_code) == 10)
                                {
                                    $sub_section_data = $this->admin_model->get_sub_section_name_model($location_code);
                                    if(!is_null($sub_section_data->sub_section_name))
                                    {
                                        $location .= '&nbsp; / &nbsp;'.$sub_section_data->sub_section_name;
                                    }
                                }
                            }
                            // ===========================================================================
                            $html .= '<tr>
                                <td style="vertical-align: middle;">'.$noncash['emp_name'].'</td>

                                <td style="vertical-align: middle;" class="text-center"><b>'.$noncash['tr_no'].'</b></td>

                                <td style="vertical-align: middle;">'.$location.'</td>
                                <td style="vertical-align: middle;">'.$noncash['pos_name'].'</td>
                                <td style="vertical-align: middle;">'.$noncash['remit_type'].'</td>
                                <td style="vertical-align: middle;">

                                    <button class="btn btn-xs btn-primary" title="NonCash Denomination"
                                        onclick="view_noncash_den_js('."'".$noncash['tr_no']."','".$noncash['emp_id']."','".$location_code."','".$_POST['date']."','".$noncash['emp_name']."'".')">
                                        <i class="glyphicon glyphicon-credit-card"></i>
                                    </button>

                                    <button class="btn btn-xs btn-secondary" title="Terminal No. / Registered Sales / Transaction Count"
                                        onclick="view_terminal_js(this)" 
                                        data-trno="'.$noncash['tr_no'].'" 
                                        data-empid="'.$noncash['emp_id'].'" 
                                        data-loc="'.$location_code.'" 
                                        data-date="'.$_POST['date'].'" 
                                        data-emp="'.$noncash['emp_name'].'" 
                                        data-pos="'.$noncash['pos_name'].'">
                                        <i class="glyphicon glyphicon-blackboard"></i>
                                    </button>

                                    <button class="btn btn-xs btn-info" title="Sales Date"
                                        onclick="view_sales_date_js('."'".$noncash['tr_no']."','".$noncash['emp_id']."','".$location_code."','".$_POST['date']."'".')">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </button>

                                    <button class="btn btn-xs btn-danger" title="Location"
                                        onclick="view_location_js('."'".$noncash['tr_no']."','".$noncash['emp_id']."','".$location_code."','".$_POST['date']."','".$noncash['borrowed']."'".')">
                                        <i class="glyphicon glyphicon-map-marker"></i>
                                    </button>

                                </td>
                            </tr>';

                        }
                        //                                             <a title="Terminal No. / Registered Sales / Transaction Count" onclick="view_terminal_js('."'".$noncash['tr_no']."','".$noncash['emp_id']."','".$location_code."','".$_POST['date']."','".$noncash['emp_name']."','".$noncash['pos_name']."'".')">🖥️</a> &nbsp; | &nbsp;
                                           
                    }
                    $html .= '
                    </tbody>
                </table>
        ';

        $data['html'] = $html;
        echo json_encode($data);
    }

    public function get_cash_den_ctrl()
    {
        $cash_data = $this->admin_model->get_cash_den_model($_POST['id'],$_POST['tr_no'],$_POST['emp_id'],$_POST['date']);
        // =====================================================================================================================
        if(!is_null($cash_data))
        {
            $final_cash_html = '';
            $final_fifty_html = '';
            if($_POST['remit_type'] == 'FINAL')
            {
                $final_cash_html = '<td style="text-align: right;">10:</td> 
                                    <td><input type="number" style="width: 100%; text-align: center;" min="1" class="no-arrows form-control" oninput="calculate_cash_den_js()" id="ten" value="'.$cash_data->ten.'"></input></td> 
                                    <td style="text-align: right;">5:</td> 
                                    <td><input type="number" style="width: 100%; text-align: center;" min="1" class="no-arrows form-control" oninput="calculate_cash_den_js()" id="five" value="'.$cash_data->five.'"></input></td> 
                                    <td style="text-align: right;">1:</td> 
                                    <td><input type="number" style="width: 100%; text-align: center;" min="1" class="no-arrows form-control" oninput="calculate_cash_den_js()" id="one" value="'.$cash_data->one.'"></input></td> 
                                    <td style="text-align: right;">0.25:</td> 
                                    <td><input type="number" style="width: 100%; text-align: center;" min="1" class="no-arrows form-control" oninput="calculate_cash_den_js()" id="twentyfive_cents" value="'.$cash_data->twentyfive_cents.'"></input></td> 
                                </tr> 
                                <tr>           
                                    <td style="text-align: right;">0.10:</td> 
                                    <td><input type="number" style="width: 100%; text-align: center;" min="1" class="no-arrows form-control" oninput="calculate_cash_den_js()" id="ten_cents" value="'.$cash_data->ten_cents.'"></input></td> 
                                    <td style="text-align: right;">0.05:</td> 
                                    <td><input type="number" style="width: 100%; text-align: center;" min="1" class="no-arrows form-control" oninput="calculate_cash_den_js()" id="five_cents" value="'.$cash_data->five_cents.'"></input></td> 
                                    <td style="text-align: right;">0.01:</td> 
                                    <td><input type="number" style="width: 100%; text-align: center;" min="1" class="no-arrows form-control" oninput="calculate_cash_den_js()" id="one_cents" value="'.$cash_data->one_cents.'"></input></td>';
                
                $final_fifty_html = '<td style="text-align: right;">50:</td> 
                                     <td><input type="number" style="width: 100%; text-align: center;" min="1" class="no-arrows form-control" oninput="calculate_cash_den_js()" id="fifty" value="'.$cash_data->fifty.'"></input></td>';
            }
            // ================================================================================================
            $partial_fifty_html = '';
            if($_POST['remit_type'] == 'PARTIAL')
            {
                $partial_fifty_html = '<td style="text-align: right;">50:</td> 
                                     <td><input type="number" style="width: 100%; text-align: center;" min="1" class="no-arrows form-control" oninput="calculate_cash_den_js()" id="fifty" value="'.$cash_data->fifty.'"></input></td>';
            }
            // ================================================================================================
            $html = '
                    <table class="table table-striped table-bordered table-hover" id="cash_den_modal_tbl">
                        <tbody>
                            <tr>           
                                <td style="text-align: right;">1,000:</td> 
                                <td><input type="number" style="width: 100%; text-align: center;" min="1" step="any" class="no-arrows form-control" oninput="calculate_cash_den_js()" id="onek" value="'.$cash_data->onek.'"></input></td> 
                                <td style="text-align: right;">500:</td> 
                                <td><input type="number" style="width: 100%; text-align: center;" min="1" class="no-arrows form-control" oninput="calculate_cash_den_js()" id="fiveh" value="'.$cash_data->fiveh.'"></input></td> 
                                <td style="text-align: right;">200:</td> 
                                <td><input type="number" style="width: 100%; text-align: center;" min="1" class="no-arrows form-control" oninput="calculate_cash_den_js()" id="twoh" value="'.$cash_data->twoh.'"></input></td> 
                                <td style="text-align: right;">100:</td> 
                                <td><input type="number" style="width: 100%; text-align: center;" min="1" class="no-arrows form-control" oninput="calculate_cash_den_js()" id="oneh" value="'.$cash_data->oneh.'"></input></td> 
                                '.$final_fifty_html.'
                            </tr> 
                            <tr>  
                                '.$partial_fifty_html.'
                                <td style="text-align: right;">20:</td> 
                                <td><input type="number" style="width: 100%; text-align: center;" min="1" class="no-arrows form-control" oninput="calculate_cash_den_js()" id="twenty" value="'.$cash_data->twenty.'"></input></td>
                                '.$final_cash_html.'
                                <td colspan="4" style="text-align: center;">Total Cash: &nbsp;<span id="new_cash" style="font-weight: bold;">'.number_format($cash_data->total_cash, 2).'</span><span id="old_cash" hidden>'.number_format($cash_data->total_cash, 2).'</span></td> 
                            </tr> 
                        </tbody>
                    </table> 

                    
            ';
            
            $data['html'] = $html;
            echo json_encode($data);
        }
    }

    public function update_cash_den_ctrl()
    {
        $cs_den_data = $this->admin_model->get_den_data($_POST['tr_no'],$_POST['emp_id'],$_POST['location'],$_POST['date']);
        if(!empty($cs_den_data))
        {
            $new_total_amount = $cs_den_data->total_denomination + $cs_den_data->discount + $_POST['difference'];
            $new_total_amount2 = $cs_den_data->total_denomination + $_POST['difference'];
            $registered_sales = $cs_den_data->registered_sales;
            $variance_amount = bcsub($new_total_amount, $registered_sales, 2);

            $variance_text = 'PF';
            if($variance_amount < 0)
            {
                $variance_text = 'S';
                $variance_amount = preg_replace('/-/', '', $variance_amount);
            }
            else if($variance_amount > 0)
            {
                $variance_text = 'O';
            }
            // =======================================================================================
            $deduction_date = '';
            if($variance_text == 'S' && $variance_amount >= 10)
            {
                $bcode = substr($_POST['location'], 0, 4);
                $start_fc = 6;
                $end_fc = 20;
                $pay_day_fc = 0;
                $pay_day_sc = 0;
                // ==========================================================================================================================
                if($bcode == '0201' || $bcode == '0301')
                {
                    $pay_day_fc = 30;
                    $pay_day_sc = 15;
                }
                else if($bcode == '0203' || $bcode == '0223')
                {
                    $pay_day_fc = 5;
                    $pay_day_sc = 20;
                }
                // ========================================================================================================================
                $date_exploded = explode("-", $_POST['date']);
                $year = date($date_exploded[0]);
                $year2 = date($date_exploded[0])+1;
                $month = date($date_exploded[1]);
                $month2 = date($date_exploded[1])+1;
                $day = date($date_exploded[2]);
                $last_day = date('t', strtotime($_POST['date']));
                if($month2 > 12)
                {
                    $year = $year2;
                    $month2 = 1;
                }
                // ============================================================================
                if($pay_day_fc == 30)
                {
                    if($month == '02')
                    {
                        $pay_day_fc = $last_day;
                    }
                    // ==========================================================================
                    if($day >= $start_fc && $day <= $end_fc)
                    {
                        $deduction_date = $year.'-'.$month.'-'.$pay_day_fc;
                    }
                    else if($day < $start_fc)
                    {
                        $deduction_date = $year.'-'.$month.'-'.$pay_day_sc;
                    }
                    else if($day > $end_fc)
                    {
                        $deduction_date = $year.'-'.$month2.'-'.$pay_day_sc;
                    }
                }
                else
                {
                    if($day >= $start_fc && $day <= $end_fc)
                    {
                        $deduction_date = $year.'-'.$month2.'-'.$pay_day_fc;
                    }
                    else if($day < $start_fc)
                    {
                        $deduction_date = $year.'-'.$month.'-'.$pay_day_sc;
                    }
                    else if($day > $end_fc)
                    {
                        $deduction_date = $year.'-'.$month2.'-'.$pay_day_sc;
                    }
                }
            }
            // =======================================================================================
            $vms_cutoff_date = '';
            if($variance_amount >= 30)
            {
                $company_code = substr($_POST['location'], 0, 2);
                $bunit_code = substr($_POST['location'], 2, 2);
                $cutoff_data = $this->liquidation_model->get_cutoff_model($company_code,$bunit_code);
                $start_fc = '';
                $end_fc = '';
                $start_sc = '';
                $end_sc = '';
                foreach($cutoff_data as $cutoff)
                {
                    $start_fc = $cutoff['startFC'];
                    $end_fc = $cutoff['endFC'];
                    $start_sc = $cutoff['startSC'];
                    $end_sc = $cutoff['endSC'];
                }
                // ========================================================================================================================
                $date_exploded = explode("-", $_POST['date']);
                $year = date($date_exploded[0]);
                $year2 = date($date_exploded[0]) - 1;
                $month = date($date_exploded[1]);
                $month2 = date($date_exploded[1]) + 1;
                $day = date($date_exploded[2]);
                $last_day = date('t', strtotime($_POST['date']));
                if(!empty($cutoff_data))
                {
                    $day = $day * 1;
                    if($end_fc == 15)
                    {
                        if($day <= 15)
                        {
                            $vms_cutoff_date = $month.'-'.'1'.'-'.$year.' / '.$month.'-'.$end_fc.'-'.$year;
                        }
                        else
                        {
                            $vms_cutoff_date = $month.'-'.$start_sc.'-'.$year.' / '.$month.'-'.$last_day.'-'.$year;
                        }
                    }
                    else
                    {
                        $start_fc = $start_fc * 1;
                        if($day >= $start_fc || $day <= $end_fc)
                        {
                            $vms_cutoff_date = $month.'-'.$start_fc.'-'.$year.' / '.$month.'-'.$end_fc.'-'.$year;
                        }
                        else
                        {
                            $vms_cutoff_date = $month.'-'.$start_sc.'-'.$year.' / '.$month.'-'.$end_sc.'-'.$year;
                        }
                    }
                }
                else
                {
                    $day = $day * 1;
                    if($day >= 24 || $day <= 8)
                    {
                        if($month == '01')
                        {
                            $vms_cutoff_date = '12-'.'24'.'-'.$year2.' / '.$month.'-'.'8'.'-'.$year;
                        }
                        else
                        {
                            $month3 = $month2 * 1;
                            if($month3 < 10){
                                $month3 = '0'.$month3;
                            }
                            $vms_cutoff_date = $month.'-'.'24'.'-'.$year.' / '.$month3.'-'.'8'.'-'.$year;
                        }
                    }
                    else
                    {
                        $vms_cutoff_date = $month.'-'.'9'.'-'.$year.' / '.$month.'-'.'23'.'-'.$year;
                    }
                }
            }

            // var_dump($variance_amount, $variance_text);
            // var_dump($new_total_amount2);
            // die();

            // =======================================================================================
            $this->admin_model->update_cebo_cs_data_model($_POST['tr_no'],$_POST['emp_id'],$_POST['location'],$_POST['date'],$variance_amount,$variance_text,$deduction_date,$vms_cutoff_date);
            $this->admin_model->update_cebo_cs_den_model($_POST['tr_no'],$_POST['emp_id'],$_POST['location'],$_POST['date'],$new_total_amount2);
        }
        // ===========================================================================================
        $message = 'success';
        $this->admin_model->update_cs_cash_den_model($_POST['id'],$_POST['tr_no'],$_POST['emp_id'],$_POST['date'],$_POST['onek'],$_POST['fiveh'],$_POST['twoh'],$_POST['oneh'],$_POST['fifty'],$_POST['twenty'],$_POST['ten'],$_POST['five'],$_POST['one'],$_POST['twentyfive_cents'],$_POST['ten_cents'],$_POST['five_cents'],$_POST['one_cents'],$_POST['new_cash']);

        $data['message'] = $message;
        echo json_encode($data);
    }

    public function get_noncash_den_ctrl()
    {
        $noncash_data = $this->admin_model->get_noncash_model($_POST['tr_no'],$_POST['emp_id'],$_POST['location'],$_POST['date']);
        $total = $this->admin_model->get_total_noncash_model($_POST['tr_no'],$_POST['emp_id'],$_POST['location'],$_POST['date']);

        $total_amount = isset($total['total_amount']) ? number_format($total['total_amount'], 2) : '0.00';



        $html = '
                <table class="table table-striped table-bordered table-hover" id="cash_den_modal_tbl">
                    <thead>
                        <tr>
                            <th style="text-align: center;" width="30%">MODE OF PAYMENT</th>
                            <th style="text-align: center;" width="10%">QUANTITY</th>
                            <th style="text-align: center;" width="20%">AMOUNT</th>
                            <th style="text-align: center;" width="30%">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>';

           $mop_array = array();
           foreach($noncash_data as $data)
           {
              array_push($mop_array, $data['mop_name']);
              $dcode = substr($_POST['location'], 0, 6);
              $mop_name_data = $this->admin_model->get_mop_name_model($data['mop_name'],$dcode);
              $mop_name_html = '<option>'.$data['mop_name'].'</option>';
              foreach($mop_name_data as $mop)
              {
                $mop_name_html .= '<option>'.$mop['mop_name'].'</option>';
              }
             //================================================================================================================   



             $delete_btn = '';
             if($data['noncash_amount'] == 0.00){
               $delete_btn = '<a class="btn btn-danger btn-sm" title="DELETE" onclick="delete_zero_noncash_js('."'".$data['id']."','".$data['mop_name']."','".$data['noncash_amount']."'".')"><i class="fa fa-trash"></i></a>';
             }


              $html .= '<tr>
                            <td>
                                <select id="mop_name'.$data['id'].'" style="width: 100%" class="form-control">'.$mop_name_html.'</select>
                            </td>
                            <td>
                                <input type="number" id="noncash_qty'.$data['id'].'" class="no-arrows form-control" style="width: 100%; text-align: center;" min="1" value="'.$data['noncash_qty'].'"></input>
                            </td>
                            <td>
                                <input type="text" id="noncash_amount'.$data['id'].'" class="noncash_amount noncash_body_amount form-control" style="width: 100%; text-align: right;" value="'.number_format($data['noncash_amount'], 2).'"></input>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-around">
                                    <a class="btn btn-primary btn-sm" title="UPDATE" data-id="'.$data['id'].'" data-amount="'.$data['noncash_amount'].'" onclick="update_noncash_js_button(this)">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    <a class="btn btn-success btn-sm" title="TRANSFER" onclick="transfer_noncash_js('."'".$data['id']."','".$data['mop_name']."','".$data['noncash_amount']."'".')">
                                        <i class="fa fa-money"></i>
                                    </a>
                                    '.$delete_btn.'
                                </div>
                            </td>

                        </tr>';
           }

           $html .= '</tbody>
                    <tfoot>
                        <tr>
                        <td style="text-align: center; font-weight: bold;" width="30%">TOTAL NONCASH : </td>
                        <td style="text-align: center;" width="10%"></td>
                        <td style="text-align: right;" width="30%"><input id="total_amount" type="text" class="noncash_amount form-control" style="width: 100%; text-align: right;" value="'.$total_amount.'" disabled></input></td>
                        <td style="text-align: center;" width="10%"></td>
                        </tr>
                    </tfoot>
                </table>  
                <script>
                    $("input[type=number]").keydown(function(event) {
                        if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
                        event.preventDefault();
                        }
                    });
                    $(".noncash_amount").maskMoney({thousands:",", decimal:".", allowZero: true, suffix: " "});
                </script>
        ';
        
        $mop_array = implode("|", $mop_array);
        
        $data['mop_array'] = $mop_array;
        $data['html'] = $html;

        echo json_encode($data);
    }

    public function delete_zero_noncash_route()
    {
        $id = $_POST['id'];
        $mop_name = $_POST['mop_name'];
        $noncash_amount = $_POST['amount'];
        $result = $this->admin_model->delete_zero_noncash_model($id, $mop_name, $noncash_amount);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'DELETED']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Deletion failed']);
        }
    }

    public function update_noncash_ctrl()
    {
        $message = 'DUPLICATE';
        $validate_noncash_data = $this->admin_model->validate_noncash_model($_POST['id'],$_POST['tr_no'],$_POST['emp_id'],$_POST['mop_name'],$_POST['noncash_amount'],$_POST['location'],$_POST['date']);
        if(empty($validate_noncash_data))
        {
            if($_POST['variance'] != 0)
            {
                $cebo_cs_den_data = $this->admin_model->get_den_data($_POST['tr_no'],$_POST['emp_id'],$_POST['location'],$_POST['date']);
                if(!empty($cebo_cs_den_data))
                {
                    $new_total_amount = $cebo_cs_den_data->total_denomination + $cebo_cs_den_data->discount + $_POST['variance'];
                    $new_total_amount2 = $cebo_cs_den_data->total_denomination + $_POST['variance'];
                    $variance_amount = bcsub($new_total_amount, $cebo_cs_den_data->registered_sales, 2);
                    
                    $variance_text = 'PF';
                    if($variance_amount < 0)
                    {
                        $variance_text = 'S';
                        $variance_amount = preg_replace('/-/', '', $variance_amount);
                    }
                    else if($variance_amount > 0)
                    {
                        $variance_text = 'O';
                    }
                    // =======================================================================================
                    $deduction_date = '';
                    if($variance_text == 'S' && $variance_amount >= 10)
                    {
                        $bcode = substr($_POST['location'], 0, 4);
                        $start_fc = 6;
                        $end_fc = 20;
                        $pay_day_fc = 0;
                        $pay_day_sc = 0;
                        // ==========================================================================================================================
                        if($bcode == '0201' || $bcode == '0301')
                        {
                            $pay_day_fc = 30;
                            $pay_day_sc = 15;
                        }
                        else if($bcode == '0203' || $bcode == '0223')
                        {
                            $pay_day_fc = 5;
                            $pay_day_sc = 20;
                        }
                        // ========================================================================================================================
                        $date_exploded = explode("-", $_POST['date']);
                        $year = date($date_exploded[0]);
                        $year2 = date($date_exploded[0])+1;
                        $month = date($date_exploded[1]);
                        $month2 = date($date_exploded[1])+1;
                        $day = date($date_exploded[2]);
                        $last_day = date('t', strtotime($_POST['date']));
                        if($month2 > 12)
                        {
                            $year = $year2;
                            $month2 = 1;
                        }
                        // ============================================================================
                        if($pay_day_fc == 30)
                        {
                            if($month == '02')
                            {
                                $pay_day_fc = $last_day;
                            }
                            // ==========================================================================
                            if($day >= $start_fc && $day <= $end_fc)
                            {
                                $deduction_date = $year.'-'.$month.'-'.$pay_day_fc;
                            }
                            else if($day < $start_fc)
                            {
                                $deduction_date = $year.'-'.$month.'-'.$pay_day_sc;
                            }
                            else if($day > $end_fc)
                            {
                                $deduction_date = $year.'-'.$month2.'-'.$pay_day_sc;
                            }
                        }
                        else
                        {
                            if($day >= $start_fc && $day <= $end_fc)
                            {
                                $deduction_date = $year.'-'.$month2.'-'.$pay_day_fc;
                            }
                            else if($day < $start_fc)
                            {
                                $deduction_date = $year.'-'.$month.'-'.$pay_day_sc;
                            }
                            else if($day > $end_fc)
                            {
                                $deduction_date = $year.'-'.$month2.'-'.$pay_day_sc;
                            }
                        }
                    }
                    // =======================================================================================
                    $vms_cutoff_date = '';
                    if($variance_amount >= 30)
                    {
                        $company_code = substr($_POST['location'], 0, 2);
                        $bunit_code = substr($_POST['location'], 2, 2);
                        $cutoff_data = $this->liquidation_model->get_cutoff_model($company_code,$bunit_code);
                        $start_fc = '';
                        $end_fc = '';
                        $start_sc = '';
                        $end_sc = '';
                        foreach($cutoff_data as $cutoff)
                        {
                            $start_fc = $cutoff['startFC'];
                            $end_fc = $cutoff['endFC'];
                            $start_sc = $cutoff['startSC'];
                            $end_sc = $cutoff['endSC'];
                        }
                        // ========================================================================================================================
                        $date_exploded = explode("-", $_POST['date']);
                        $year = date($date_exploded[0]);
                        $year2 = date($date_exploded[0]) - 1;
                        $month = date($date_exploded[1]);
                        $month2 = date($date_exploded[1]) + 1;
                        $day = date($date_exploded[2]);
                        $last_day = date('t', strtotime($_POST['date']));
                        if(!empty($cutoff_data))
                        {
                            $day = $day * 1;
                            if($end_fc == 15)
                            {
                                if($day <= 15)
                                {
                                    $vms_cutoff_date = $month.'-'.'1'.'-'.$year.' / '.$month.'-'.$end_fc.'-'.$year;
                                }
                                else
                                {
                                    $vms_cutoff_date = $month.'-'.$start_sc.'-'.$year.' / '.$month.'-'.$last_day.'-'.$year;
                                }
                            }
                            else
                            {
                                $start_fc = $start_fc * 1;
                                if($day >= $start_fc || $day <= $end_fc)
                                {
                                    $vms_cutoff_date = $month.'-'.$start_fc.'-'.$year.' / '.$month.'-'.$end_fc.'-'.$year;
                                }
                                else
                                {
                                    $vms_cutoff_date = $month.'-'.$start_sc.'-'.$year.' / '.$month.'-'.$end_sc.'-'.$year;
                                }
                            }
                        }
                        else
                        {
                            $day = $day * 1;
                            if($day >= 24 || $day <= 8)
                            {
                                if($month == '01')
                                {
                                    $vms_cutoff_date = '12-'.'24'.'-'.$year2.' / '.$month.'-'.'8'.'-'.$year;
                                }
                                else
                                {
                                    $month3 = $month2 * 1;
                                    if($month3 < 10){
                                        $month3 = '0'.$month3;
                                    }
                                    $vms_cutoff_date = $month.'-'.'24'.'-'.$year.' / '.$month3.'-'.'8'.'-'.$year;
                                }
                            }
                            else
                            {
                                $vms_cutoff_date = $month.'-'.'9'.'-'.$year.' / '.$month.'-'.'23'.'-'.$year;
                            }
                        }
                    }
                    // var_dump($variance_amount, $variance_text);
                    // var_dump($new_total_amount2);
                    // die();
                    // =======================================================================================
                    $this->admin_model->update_cebo_cs_data_model($_POST['tr_no'],$_POST['emp_id'],$_POST['location'],$_POST['date'],$variance_amount,$variance_text,$deduction_date,$vms_cutoff_date);
                    $this->admin_model->update_cebo_cs_den_model($_POST['tr_no'],$_POST['emp_id'],$_POST['location'],$_POST['date'],$new_total_amount2);
                }
            }

            $message = 'UPDATED';


            $this->admin_model->update_noncash_model($_POST['id'],$_POST['emp_id'],$_POST['mop_name'],$_POST['noncash_qty'],$_POST['noncash_amount']);
        }

        $cebo_cs_den_data2 = $this->admin_model->noncash_amount($_POST['id'],$_POST['tr_no'],$_POST['emp_id'],$_POST['mop_name'],$_POST['noncash_amount'],$_POST['location'],$_POST['date']);

        $new_total_amount_save = $cebo_cs_den_data2['noncash_amount'];

        $data['message'] = $message;
        $data['new_amount'] = $new_total_amount_save;
        echo json_encode($data);
    }

    public function view_terminal_ctrl()
    {
        $dcode = substr($_POST['location'], 0, 6);
        $terminal_data = $this->admin_model->get_terminal_data($dcode,$_POST['pos_name']);
        $terminal_html = '<option value="DEFAULT">'.$_POST['pos_name'].'</option>';
        foreach($terminal_data as $terminal)
        {
            $terminal_html .= '<option value="'.$terminal['counter_no'].'">'.$terminal['pos_name'].'</option>';
        }
        // ==============================================================================================================

        $registered_sales_data = $this->admin_model->get_den_data($_POST['tr_no'],$_POST['emp_id'],$_POST['location'],$_POST['date']);

        $get_cash_info = $this->admin_model->get_cash_info_model($_POST['tr_no'],$_POST['date'],$_POST['emp_id']);
        $total_sales = 0;
        $registered_sales = 0;
        $discount = 0;
        $tr_count = 0;
        if(!empty($registered_sales_data))
        {
            $total_sales = number_format($registered_sales_data->total_denomination, 2);
            $registered_sales = number_format($registered_sales_data->registered_sales, 2);
            $discount = number_format($registered_sales_data->discount, 2);
            $tr_count = $registered_sales_data->tr_count;
        }

        $data['terminal'] = $terminal_html;
        $data['total_sales'] = $total_sales;
        $data['registered_sales'] = $registered_sales;
        $data['discount'] = $discount;
        $data['tr_count'] = $tr_count;
        $data['short'] = $get_cash_info['amount_shrt'];
        $data['type'] = $get_cash_info['type'];
        echo json_encode($data);
    }

    public function update_terminal_ctrl()
    {
        // =================================update registered sales, discount, variance and deduction date=====================================
        if(trim($_POST['registered_sales']) != $_POST['old_registered_sales'] || trim($_POST['discount']) != $_POST['old_discount'] || trim($_POST['tr_count']) != $_POST['old_tr_count'])
        {
            $cs_den_data = $this->admin_model->get_den_data($_POST['tr_no'],$_POST['emp_id'],$_POST['location'],$_POST['date']);
            // ==============================update registered sales and discount ==============================================
            $this->admin_model->update_registered_sales_discount_model($_POST['tr_no'],$_POST['emp_id'],$_POST['location'],$_POST['date'],trim($_POST['registered_sales']),trim($_POST['discount']),trim($_POST['tr_count']));

            // ==============================update variance and deduction=======================================================
            $new_total_amount = $cs_den_data->total_denomination + $_POST['discount'];
            $registered_sales = trim($_POST['registered_sales']);
            $variance_amount = bcsub($new_total_amount, $registered_sales, 2);

            $variance_text = 'PF';
            if($variance_amount < 0)
            {
                $variance_text = 'S';
                $variance_amount = preg_replace('/-/', '', $variance_amount);
            }
            else if($variance_amount > 0)
            {
                $variance_text = 'O';
            }
            // =======================================================================================
            $deduction_date = '';
            if($variance_text == 'S' && $variance_amount >= 10)
            {
                $bcode = substr($_POST['location'], 0, 4);
                $start_fc = 6;
                $end_fc = 20;
                $pay_day_fc = 0;
                $pay_day_sc = 0;
                // ==========================================================================================================================
                if($bcode == '0201' || $bcode == '0301')
                {
                    $pay_day_fc = 30;
                    $pay_day_sc = 15;
                }
                else if($bcode == '0203' || $bcode == '0223')
                {
                    $pay_day_fc = 5;
                    $pay_day_sc = 20;
                }
                // ========================================================================================================================
                $date_exploded = explode("-", $_POST['date']);
                $year = date($date_exploded[0]);
                $year2 = date($date_exploded[0])+1;
                $month = date($date_exploded[1]);
                $month2 = date($date_exploded[1])+1;
                $day = date($date_exploded[2]);
                $last_day = date('t', strtotime($_POST['date']));
                if($month2 > 12)
                {
                    $year = $year2;
                    $month2 = 1;
                }
                // ============================================================================
                if($pay_day_fc == 30)
                {
                    if($month == '02')
                    {
                        $pay_day_fc = $last_day;
                    }
                    // ==========================================================================
                    if($day >= $start_fc && $day <= $end_fc)
                    {
                        $deduction_date = $year.'-'.$month.'-'.$pay_day_fc;
                    }
                    else if($day < $start_fc)
                    {
                        $deduction_date = $year.'-'.$month.'-'.$pay_day_sc;
                    }
                    else if($day > $end_fc)
                    {
                        $deduction_date = $year.'-'.$month2.'-'.$pay_day_sc;
                    }
                }
                else
                {
                    if($day >= $start_fc && $day <= $end_fc)
                    {
                        $deduction_date = $year.'-'.$month2.'-'.$pay_day_fc;
                    }
                    else if($day < $start_fc)
                    {
                        $deduction_date = $year.'-'.$month.'-'.$pay_day_sc;
                    }
                    else if($day > $end_fc)
                    {
                        $deduction_date = $year.'-'.$month2.'-'.$pay_day_sc;
                    }
                }
            }
            // =======================================================================================
            $vms_cutoff_date = '';
            if($variance_amount >= 30)
            {
                $company_code = substr($_POST['location'], 0, 2);
                $bunit_code = substr($_POST['location'], 2, 2);
                $cutoff_data = $this->liquidation_model->get_cutoff_model($company_code,$bunit_code);
                $start_fc = '';
                $end_fc = '';
                $start_sc = '';
                $end_sc = '';
                foreach($cutoff_data as $cutoff)
                {
                    $start_fc = $cutoff['startFC'];
                    $end_fc = $cutoff['endFC'];
                    $start_sc = $cutoff['startSC'];
                    $end_sc = $cutoff['endSC'];
                }
                // ========================================================================================================================
                $date_exploded = explode("-", $_POST['date']);
                $year = date($date_exploded[0]);
                $year2 = date($date_exploded[0]) - 1;
                $month = date($date_exploded[1]);
                $month2 = date($date_exploded[1]) + 1;
                $day = date($date_exploded[2]);
                $last_day = date('t', strtotime($_POST['date']));
                if(!empty($cutoff_data))
                {
                    $day = $day * 1;
                    if($end_fc == 15)
                    {
                        if($day <= 15)
                        {
                            $vms_cutoff_date = $month.'-'.'1'.'-'.$year.' / '.$month.'-'.$end_fc.'-'.$year;
                        }
                        else
                        {
                            $vms_cutoff_date = $month.'-'.$start_sc.'-'.$year.' / '.$month.'-'.$last_day.'-'.$year;
                        }
                    }
                    else
                    {
                        $start_fc = $start_fc * 1;
                        if($day >= $start_fc || $day <= $end_fc)
                        {
                            $vms_cutoff_date = $month.'-'.$start_fc.'-'.$year.' / '.$month.'-'.$end_fc.'-'.$year;
                        }
                        else
                        {
                            $vms_cutoff_date = $month.'-'.$start_sc.'-'.$year.' / '.$month.'-'.$end_sc.'-'.$year;
                        }
                    }
                }
                else
                {
                    $day = $day * 1;
                    if($day >= 24 || $day <= 8)
                    {
                        if($month == '01')
                        {
                            $vms_cutoff_date = '12-'.'24'.'-'.$year2.' / '.$month.'-'.'8'.'-'.$year;
                        }
                        else
                        {
                            $month3 = $month2 * 1;
                            if($month3 < 10){
                                $month3 = '0'.$month3;
                            }
                            $vms_cutoff_date = $month.'-'.'24'.'-'.$year.' / '.$month3.'-'.'8'.'-'.$year;
                        }
                    }
                    else
                    {
                        $vms_cutoff_date = $month.'-'.'9'.'-'.$year.' / '.$month.'-'.'23'.'-'.$year;
                    }
                }
            }
            // =======================================================================================
            $this->admin_model->update_cebo_cs_data_model($_POST['tr_no'],$_POST['emp_id'],$_POST['location'],$_POST['date'],$variance_amount,$variance_text,$deduction_date,$vms_cutoff_date);

        }
        

            // ==============================update total sales and discount ==============================================
            $this->admin_model->update_total_registered($_POST['new_total_sales'],$_POST['tr_no'],$_POST['emp_id'],$_POST['location'],$_POST['date'],trim($_POST['registered_sales']),trim($_POST['discount']),trim($_POST['tr_count']));


            $cs_den_data = $this->admin_model->get_den_data($_POST['tr_no'],$_POST['emp_id'],$_POST['location'],$_POST['date']);


            
            // ==============================update variance and deduction=======================================================
            $new_total_amount = $cs_den_data->total_denomination + $_POST['discount'];
            $registered_sales = trim($_POST['registered_sales']);
            $variance_amount = bcsub($new_total_amount, $registered_sales, 2);

            $variance_text = 'PF';
            if($variance_amount < 0)
            {
                $variance_text = 'S';
                $variance_amount = preg_replace('/-/', '', $variance_amount);
            }
            else if($variance_amount > 0)
            {
                $variance_text = 'O';
            }
            // =======================================================================================
            $deduction_date = '';
            if($variance_text == 'S' && $variance_amount >= 10)
            {
                $bcode = substr($_POST['location'], 0, 4);
                $start_fc = 6;
                $end_fc = 20;
                $pay_day_fc = 0;
                $pay_day_sc = 0;
                // ==========================================================================================================================
                if($bcode == '0201' || $bcode == '0301')
                {
                    $pay_day_fc = 30;
                    $pay_day_sc = 15;
                }
                else if($bcode == '0203' || $bcode == '0223')
                {
                    $pay_day_fc = 5;
                    $pay_day_sc = 20;
                }
                // ========================================================================================================================
                $date_exploded = explode("-", $_POST['date']);
                $year = date($date_exploded[0]);
                $year2 = date($date_exploded[0])+1;
                $month = date($date_exploded[1]);
                $month2 = date($date_exploded[1])+1;
                $day = date($date_exploded[2]);
                $last_day = date('t', strtotime($_POST['date']));
                if($month2 > 12)
                {
                    $year = $year2;
                    $month2 = 1;
                }
                // ============================================================================
                if($pay_day_fc == 30)
                {
                    if($month == '02')
                    {
                        $pay_day_fc = $last_day;
                    }
                    // ==========================================================================
                    if($day >= $start_fc && $day <= $end_fc)
                    {
                        $deduction_date = $year.'-'.$month.'-'.$pay_day_fc;
                    }
                    else if($day < $start_fc)
                    {
                        $deduction_date = $year.'-'.$month.'-'.$pay_day_sc;
                    }
                    else if($day > $end_fc)
                    {
                        $deduction_date = $year.'-'.$month2.'-'.$pay_day_sc;
                    }
                }
                else
                {
                    if($day >= $start_fc && $day <= $end_fc)
                    {
                        $deduction_date = $year.'-'.$month2.'-'.$pay_day_fc;
                    }
                    else if($day < $start_fc)
                    {
                        $deduction_date = $year.'-'.$month.'-'.$pay_day_sc;
                    }
                    else if($day > $end_fc)
                    {
                        $deduction_date = $year.'-'.$month2.'-'.$pay_day_sc;
                    }
                }
            }
            // =======================================================================================
            $vms_cutoff_date = '';
            if($variance_amount >= 30)
            {
                $company_code = substr($_POST['location'], 0, 2);
                $bunit_code = substr($_POST['location'], 2, 2);
                $cutoff_data = $this->liquidation_model->get_cutoff_model($company_code,$bunit_code);
                $start_fc = '';
                $end_fc = '';
                $start_sc = '';
                $end_sc = '';
                foreach($cutoff_data as $cutoff)
                {
                    $start_fc = $cutoff['startFC'];
                    $end_fc = $cutoff['endFC'];
                    $start_sc = $cutoff['startSC'];
                    $end_sc = $cutoff['endSC'];
                }
                // ========================================================================================================================
                $date_exploded = explode("-", $_POST['date']);
                $year = date($date_exploded[0]);
                $year2 = date($date_exploded[0]) - 1;
                $month = date($date_exploded[1]);
                $month2 = date($date_exploded[1]) + 1;
                $day = date($date_exploded[2]);
                $last_day = date('t', strtotime($_POST['date']));
                if(!empty($cutoff_data))
                {
                    $day = $day * 1;
                    if($end_fc == 15)
                    {
                        if($day <= 15)
                        {
                            $vms_cutoff_date = $month.'-'.'1'.'-'.$year.' / '.$month.'-'.$end_fc.'-'.$year;
                        }
                        else
                        {
                            $vms_cutoff_date = $month.'-'.$start_sc.'-'.$year.' / '.$month.'-'.$last_day.'-'.$year;
                        }
                    }
                    else
                    {
                        $start_fc = $start_fc * 1;
                        if($day >= $start_fc || $day <= $end_fc)
                        {
                            $vms_cutoff_date = $month.'-'.$start_fc.'-'.$year.' / '.$month.'-'.$end_fc.'-'.$year;
                        }
                        else
                        {
                            $vms_cutoff_date = $month.'-'.$start_sc.'-'.$year.' / '.$month.'-'.$end_sc.'-'.$year;
                        }
                    }
                }
                else
                {
                    $day = $day * 1;
                    if($day >= 24 || $day <= 8)
                    {
                        if($month == '01')
                        {
                            $vms_cutoff_date = '12-'.'24'.'-'.$year2.' / '.$month.'-'.'8'.'-'.$year;
                        }
                        else
                        {
                            $month3 = $month2 * 1;
                            if($month3 < 10){
                                $month3 = '0'.$month3;
                            }
                            $vms_cutoff_date = $month.'-'.'24'.'-'.$year.' / '.$month3.'-'.'8'.'-'.$year;
                        }
                    }
                    else
                    {
                        $vms_cutoff_date = $month.'-'.'9'.'-'.$year.' / '.$month.'-'.'23'.'-'.$year;
                    }
                }
            }
            // =======================================================================================

            $tr_no      = $_POST['tr_no'];
            $emp_id     = $_POST['emp_id'];
            $location   = $_POST['location'];
            $date       = $_POST['date'];


            $this->admin_model->update_cebo_cs_data_model2($tr_no, $emp_id, $location, $date, $variance_amount, $variance_text, $deduction_date, $vms_cutoff_date);
        
        // =======================================update terminal no==================================================
        $message = $variance_amount;
        if($_POST['counter_no'] != 'DEFAULT')
        {
            $this->admin_model->update_terminal_no_model($_POST['tr_no'],$_POST['emp_id'],$_POST['location'],$_POST['date'],$_POST['terminal_no'],$_POST['counter_no']);
        }

        $data['message'] = $message;
        echo json_encode($data);
    }   

    public function transfer_noncash_ctrl()
    {
        $dcode = substr($_POST['location'], 0, 6);
        $mop_name_data = $this->admin_model->get_transfer_mop_name_model($_POST['mop_array'],$dcode);
        $html = '';
        foreach($mop_name_data as $mop)
        {
            $html .= '<option>'.$mop['mop_name'].'</option>';
        }

        $data['html'] = $html;
        echo json_encode($data);
    }

    public function transfer_mop_ctrl()
    {
        $mop_data = $this->admin_model->get_mop_data_model($_POST['id']);
        if(!empty($mop_data))
        {
            // ====================update mop===============================
            $new_qty = $mop_data->noncash_qty - $_POST['transfer_qty'];
            $new_amount = $mop_data->noncash_amount - $_POST['transfer_amount'];
            $this->admin_model->update_mop_model($_POST['id'],$new_qty,round($new_amount, 2));

            // ====================insert new mop===============================
            $tr_no = $mop_data->tr_no;
            $emp_id = $mop_data->emp_id;
            $sal_no = $mop_data->sal_no;
            $emp_name = $mop_data->emp_name;
            $emp_type = $mop_data->emp_type;
            $company_code = $mop_data->company_code;
            $bunit_code = $mop_data->bunit_code;
            $dep_code = $mop_data->dep_code;
            $section_code = $mop_data->section_code;
            $sub_section_code = $mop_data->sub_section_code;
            $borrowed = $mop_data->borrowed;
            $pos_name = $mop_data->pos_name;
            $counter_no = $mop_data->counter_no;
            $mop_name = $_POST['transfer_mop'];
            $noncash_qty = $_POST['transfer_qty'];
            $noncash_amount = $_POST['transfer_amount'];
            $remit_type = $mop_data->remit_type;
            $status = $mop_data->status;
            $date_submit = $mop_data->date_submit;
            // ==========================================================================================
            $message = 'inserted';
            $this->admin_model->insert_mop_model($tr_no,$emp_id,$sal_no,$emp_name,$emp_type,$company_code,$bunit_code,$dep_code,$section_code,$sub_section_code,$borrowed,$pos_name,$counter_no,$mop_name,$noncash_qty,$noncash_amount,$remit_type,$status,$date_submit);

            $data['message'] = $message;
            echo json_encode($data);
        }
    }

    public function update_sales_date_ctrl()
    {
        $message = 'updated';
        $this->admin_model->update_sales_date_model($_POST['tr_no'],$_POST['emp_id'],$_POST['location'],$_POST['old_sales_date'],$_POST['new_sales_date']);

        $data['message'] = $message;
        echo json_encode($data);
    }

    public function view_location_ctrl()
    {
        $bcode = substr($_POST['location'], 0, 4);
        $dcode = substr($_POST['location'], 0, 6);
        $scode = substr($_POST['location'], 0, 8);
        $sscode = substr($_POST['location'], 0, 10);
        $location_name = '';
        // ==================department code======================
        $dept_name = '';
        if(strlen($dcode) == 6){
            $dept_data = $this->admin_model->get_deptname_model($bcode);
            foreach($dept_data as $dept){
                $selected = '';
                if($dept['dcode'] == $dcode){
                    $selected = 'selected';
                    $location_name .= $dept['dept_name'];
                }
                $dept_name .= '<option '.$selected.' value="'.$dept['dcode'].'">'.$dept['dept_name'].'</option>';
            }
        }
        // ==================section code======================
        $section_name = '';
        if(strlen($scode) == 8){
            $section_data = $this->admin_model->get_sectionname_model($dcode);
            foreach($section_data as $section){
                $selected = '';
                if($section['scode'] == $scode){
                    $selected = 'selected';
                    $location_name .= ' - '.$section['section_name'];
                }
                $section_name .= '<option '.$selected.' value="'.$section['scode'].'">'.$section['section_name'].'</option>';
            }
        }
        // ==================sub section code======================
        $sub_section_name = '';
        if(strlen($sscode) == 10){
            $sub_section_data = $this->admin_model->get_sub_sectionname_model($scode);
            foreach($sub_section_data as $sub_section){
                $selected = '';
                if($sub_section['sscode'] == $sscode){
                    $selected = 'selected';
                    $location_name .= ' - '.$sub_section['sub_section_name'];
                }
                $sub_section_name .= '<option '.$selected.' value="'.$sub_section['sscode'].'">'.$sub_section['sub_section_name'].'</option>';
            }
        }

        $data['location_name'] = $location_name;
        $data['dept_name'] = $dept_name;
        $data['section_name'] = $section_name;
        $data['sub_section_name'] = $sub_section_name;
        echo json_encode($data);
    }

    public function admin_get_section_ctrl()
    {
        $section_data = $this->admin_model->get_section_model($_POST['dcode']);
        $section_html = '';
        foreach($section_data as $section){
            $section_html .= '<option value="'.$section['scode'].'">'.$section['section_name'].'</option>';
        }

        $data['section_html'] = $section_html;
        echo json_encode($data);
    }

    public function admin_get_sub_section_ctrl()
    {
        $sub_section_data = $this->admin_model->get_sub_section_model($_POST['scode']);
        $sub_section_html = '';
        foreach($sub_section_data as $sub_section){
            $sub_section_html .= '<option value="'.$sub_section['sscode'].'">'.$sub_section['sub_section_name'].'</option>';
        }

        $data['sub_section_html'] = $sub_section_html;
        echo json_encode($data);
    }

    public function update_location_ctrl()
    {
        $message = 'updated';
        $current_location = '';
        if($_POST['borrowed'] == 'YES'){
            $cashier_info = $this->admin_model->get_cashier_info_model($_POST['emp_id']);
            if(!empty($cashier_info)){
                $current_location = $cashier_info->location;
            }
            // ======================================
            if($current_location == $_POST['location']){
                $message = 'invalid';
            }
        }
        // ==========================================
        if($message == 'updated'){
            $remitted_dcode = substr($_POST['location'], 0, 6);
            $dcode = substr($_POST['location'], 4, 2);
            $scode = substr($_POST['location'], 6, 2);
            if($scode === false){
                $scode = '';
            }
            $sscode = substr($_POST['location'], 8, 2);
            if($sscode === false){
                $sscode = '';
            }
            // ===========================================================================
            $this->admin_model->update_location_ctrl($_POST['tr_no'],$_POST['emp_id'],$_POST['date'],$_POST['borrowed'],$dcode,$scode,$sscode,$remitted_dcode,$_POST['location']);
        }
        
        $data['message'] = $message;
        echo json_encode($data);
    }

    public function view_batch_remittance_ctrl()
    {
        $remittance_data = $this->admin_model->get_batch_remittance_model($_POST['id'],$_POST['tr_no'],$_POST['emp_id'],$_POST['location']);
        $remittance_html = '<table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle;" width="20%">TERMINAL NO.</th>
                                        <th style="text-align: center; vertical-align: middle;" width="30%">CASH REMITTED</th>
                                        <th style="text-align: center; vertical-align: middle;" width="20%">BATCH NO.</th>
                                        <th style="text-align: center; vertical-align: middle;" width="20%">DATE REMITTED</th>
                                        <th style="text-align: center; vertical-align: middle;" width="10%">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>';
            foreach($remittance_data as $remittance)
            {
                $cash_data = $this->admin_model->get_cash_data_model($remittance['cash_id']);
                $pos_name = '';
                $cash_remitted = '';
                if(!empty($cash_data)){
                    $pos_name = $cash_data->pos_name;
                    $cash_remitted = $cash_data->total_cash;
                }
                $remittance_html .= '<tr>
                                        <td style="text-align: center;">'.$pos_name.'</td>
                                        <td style="text-align: center;">'.number_format($cash_remitted, 2).'</td>
                                        <td><input type="number" class="no-arrows form-control" id="batch_no_remittance" min="1" value="'.$remittance['batch_remit'].'"></td>
                                        <td style="text-align: center;"><input type="date" class="form-control" id="date_remitted" value="'.$remittance['date_remitted'].'"></td>
                                        <td style="text-align: center;"><a onclick="update_batch_remittance_js('."'".$remittance['id']."','".$remittance['batch_remit']."','".$remittance['date_remitted']."','".$remittance['dcode']."'".')" class="btn btn-primary">UPDATE</a></td>
                                     </tr>';
            }
            $remittance_html .= '</tbody>
                            </table>
                            <script>
                                $("input[type=number]").keydown(function(event) {
                                    if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
                                    event.preventDefault();
                                    }
                                });
                            </script>';
        
        $data['remittance_html'] = $remittance_html;
        echo json_encode($data);
    }

    public function update_batch_remittance_ctrl()
    {
        $batch_counter = $this->admin_model->get_batch_counter($_POST['dcode'],$_POST['date']);
        $old_batch_counter = 0;
        if(!empty($batch_counter)){
            $old_batch_counter = $batch_counter->batch_remit;
        }
        // ====================================================
        if($_POST['batch'] >= $old_batch_counter){
            $new_batch_counter = $_POST['batch'] + 1;
            $this->admin_model->update_batch_counter($new_batch_counter,$_POST['dcode'],$_POST['date']);
        }
        // ====================================================
        $message = 'updated';
        $this->admin_model->update_batch_remittance_model($_POST['id'],$_POST['batch'],$_POST['date']);
        
        $data['message'] = $message;
        echo json_encode($data);
    }






}
