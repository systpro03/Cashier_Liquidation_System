<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounting_supervisor_controller extends CI_Controller
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
		$this->load->model("accounting_supervisor_model");
        $this->load->model("admin_model");
		$this->load->helper('text');
	}

	public function accounting_supervisor_dashboard_ctrl()
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
         
            $this->load->view('accounting_supervisor_side/dashboard', $data);
        }
	}

    public function pending_adjustment_ctrl()
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
         
            $this->load->view('accounting_supervisor_side/pending_adjustment', $data);
            $this->load->view('accounting_supervisor_side/attached_file_modal');
        }
	}

    public function supervisor_approved_adjustment_ctrl()
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
         
            $this->load->view('accounting_supervisor_side/approved_adjustment', $data);
            $this->load->view('accounting_supervisor_side/attached_file_modal');
        }
	}

    public function get_pending_adjustment_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $html='
                    <table class="table table-striped table-bordered table-hover display" id="pending_adjustment_table" style="color: black; font-size: 12px;">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;">
                                    <center>ACCOUNTING OFFICER
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>ORIGIN
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TRANSFER TO
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TRANSFER AMOUNT
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>SALES DATE
                                </th>
                                
                                <th style="vertical-align: middle;">
                                    <center>REASON
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>DATE/TIME REQUESTED
                                </th>
                                <th style="vertical-align: middle; width: 65px;">
                                    <input id="th_checkbox" style="width: 25px; margin-left: 15%; height: 25px;" type="checkbox">
                                </th>
                            </tr>
                        </thead>
                            <tbody id="pending_adjustment_tbody">
                    ';
            // =====================================================================================================================================================
            $pending_adjustment_data = $this->accounting_supervisor_model->get_pending_adjustment_model($_SESSION['emp_id']);
            foreach($pending_adjustment_data as $pending)
            {
                $emp_data = $this->accounting_supervisor_model->get_emp_data($pending['emp_id']);
                // ================================================================================
                $html.='
                        <tr>
                            <td style="vertical-align: middle;">'.$emp_data->name.'</td>
                            <td style="vertical-align: middle;">'.$pending['origin'].'</td>
                            <td style="vertical-align: middle;">'.$pending['transfer'].'</td>
                            <td style="vertical-align: middle;">'.number_format($pending['t_amount'], 2).'</td>
                            <td style="vertical-align: middle;">'.$pending['sales_date'].'</td>
                            <td style="vertical-align: middle;">'.$pending['reason'].'</td>
                            <td style="vertical-align: middle;">'.$pending['date_requested'].'</td>
                            <td style="vertical-align: middle;">
                                <input type="checkbox" class="td_checkbox" style="width: 25px; height: 25px;" value="'.$pending['id'].'">
                                &nbsp;&nbsp;
                                <a onclick="view_attached_file_js('."'".$pending['attached_file']."'".')" style="font-size: x-large;">👁️</a>
                            </td>
                        </tr>
                    ';
            }
            // =====================================================================================================================================================
            $html.='
                        </tbody>
                    </table>

                    <script>
                        
                        $(".td_checkbox").click(function(){
                            $("#th_checkbox").prop( "checked", false );
                        });

                        $(".td_checkbox").change(function(){
                            if ($(".td_checkbox:checked").length == $(".td_checkbox").length) {
                            $("#th_checkbox").prop( "checked", true );
                            }
                        });
                
                        $("#th_checkbox").click(function(){
                            th_checked_js();
                        });

                    </script>
                ';
            // =====================================================================================================================================================

            $data['html'] = $html;
            echo json_encode($data);
        }
    }

    public function get_approved_adjustment_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $html='
                    <table class="table table-striped table-bordered table-hover display" id="approved_adjustment_table" style="color: black; font-size: 12px;">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;">
                                    <center>ACCOUNTING OFFICER
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>ORIGIN
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TRANSFER TO
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TRANSFER AMOUNT
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>SALES DATE
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>REASON
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>DATE/TIME APPROVED
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>ATTACHED FILE
                                </th>
                            </tr>
                        </thead>
                            <tbody id="approved_adjustment_tbody">
                    ';
            // =====================================================================================================================================================
            $approved_adjustment_data = $this->accounting_supervisor_model->get_approved_adjustment_model($_SESSION['emp_id']);
            foreach($approved_adjustment_data as $approved)
            {
                $emp_data = $this->accounting_supervisor_model->get_emp_data($approved['officer_incharge']);
                // ================================================================================
                $html.='
                        <tr>
                            <td style="vertical-align: middle;">'.$emp_data->name.'</td>
                            <td style="vertical-align: middle;">'.$approved['origin_name'].'</td>
                            <td style="vertical-align: middle;">'.$approved['transfer_name'].'</td>
                            <td style="vertical-align: middle;">'.number_format($approved['transfer_amount'], 2).'</td>
                            <td style="vertical-align: middle;">'.$approved['sales_date'].'</td>
                            <td style="vertical-align: middle;">'.$approved['reason'].'</td>
                            <td style="vertical-align: middle;">'.$approved['date_approved'].'</td>
                            <td style="vertical-align: middle;">
                                <a onclick="view_attached_file_js('."'".$approved['attached_file']."'".')" style="font-size: x-large;">👁️</a>
                            </td>
                        </tr>
                    ';
            }
            // =====================================================================================================================================================
            $html.='
                        </tbody>
                    </table>
                ';
            // =====================================================================================================================================================

            $data['html'] = $html;
            echo json_encode($data);
        }
    }

    public function approve_pending_request_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = 'success';
            for($i=0; $i<count($_POST['id']); $i++)
            {
                $this->accounting_supervisor_model->approve_pending_request_model($_POST['id'][$i],$_SESSION['emp_id']);
            }

            echo json_encode($message);
        }
    }

	

}
