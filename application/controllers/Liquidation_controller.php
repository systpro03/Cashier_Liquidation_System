<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Liquidation_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->library('nativesession');
		$this->load->model("main_model");
        $this->load->model("cashier_model");
		$this->load->model("liquidation_model");
        $this->load->model("supervisor_model");
		$this->load->helper('text');
        $this->load->library('ppdf');
	}

	public function liq_domination_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/liq_dominationform', $data);
            $this->load->view('liquidation_side/liq_pendingmodal_v2');
            $this->load->view('liquidation_side/view_partial_details_modal');
            $this->load->view('liquidation_side/zero_final_remittance_mkey_modal');
        }
	}
    public function liq_transferred_den_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/liq_transferred_den', $data);
        }
	}

    public function cashier_partial_remitted_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/cashier_partial_remitted', $data);
        }
	}

    public function end_of_day_report_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/end_of_day_report', $data);
        }
	}

    public function received_cash_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/received_cash', $data);
            $this->load->view('liquidation_side/remit_to_treasury_modal');
        }
	}

    public function partial_remitted_cash_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/partial_remitted_cash', $data);
            $this->load->view('liquidation_side/partial_remitted_modal');
            $this->load->view('liquidation_side/batch_sales_date_adjustment_modal');
            $this->load->view('liquidation_side/remitted_mkey_modal');
            $this->load->view('liquidation_side/batch_backdate_mkey_modal');
        }
	}

    public function liq_pending_noncash_ctrl()
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
            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/liq_pending_noncash_den', $data);
            $this->load->view('liquidation_side/liq_pendingmodal_v2');
        }
	}

    public function liq_confiremd_den_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/liq_confirmed_den', $data);
            $this->load->view('liquidation_side/liq_pendingmodal_v2');
        }
	}

    public function cashier_linkaccess_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
         
            $this->load->view('liquidation_side/addcashier_linkaccess', $data);
        }
    }

    public function liq_adjustment_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
          
            $this->load->view('liquidation_side/liq_adjustment_form_v2', $data);
            $this->load->view('liquidation_side/print_confirmationmodal');
        }
    }

    public function liq_masterfile_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
         
            $this->load->view('liquidation_side/liq_masterfile', $data);
        }    
    }

    public function setup_cashier_access_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
         
            $this->load->view('liquidation_side/setup_cashier_access', $data);
            $this->load->view('liquidation_side/view_cashier_default_access_modal');
        }    
    }

    public function setup_cashier_counter_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
         
            $this->load->view('liquidation_side/setup_cashier_counter', $data);
            $this->load->view('liquidation_side/view_counter_modal');
        }    
    }

    public function productivity_report_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
         
            $this->load->view('liquidation_side/productivity_report', $data);
        }    
    }

    public function productivity_report_all_cashier_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
         
            $this->load->view('liquidation_side/productivity_report_all_cashier', $data);
        }    
    }

    public function advance_setup_cashier_counter_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
         
            $this->load->view('liquidation_side/advance_setup_cashier_counter', $data);
            $this->load->view('liquidation_side/view_counter_modal');
        }    
    }

    public function setup_cashier_login_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
         
            $this->load->view('liquidation_side/setup_cashier_login_v2', $data);
        }  
    }

    public function adjustment_cash_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/adjustment_pending_cash', $data);
            $this->load->view('liquidation_side/managers_key_modal');
        }
	}

    public function adjustment_noncash_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/adjustment_pending_noncash', $data);
        }
	}

    public function deleted_pending_cash_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/deleted_pending_cash', $data);
        }
	}

    public function deleted_posted_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/deleted_posted_denomination', $data);
        }
	}

    public function view_deleted_remitted_cash_module_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/deleted_remitted_cash', $data);
        }
	}

    public function adjustment_posted__ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/posted_denomination', $data);
            $this->load->view('liquidation_side/adjustment_posted_mkey_modal');
        }
	}

    public function adjustment_posted_zero_rs_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/posted_zero_registered_sales', $data);
            $this->load->view('liquidation_side/zero_rs_adjustment_modal');
            $this->load->view('liquidation_side/zero_rs_mkey_modal');
        }
	}

    public function adjustment_sales_date_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/sales_date_adjustment', $data);
            $this->load->view('liquidation_side/sales_date_adjustment_modal');
            $this->load->view('liquidation_side/sales_date_mkey_modal');
        }
	}

    public function adjusted_posted_zero_rs_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/adjusted_zero_registered_sales', $data);
        }
	}

    public function adjusted_sales_date_ctrl()
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

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();
            
            $this->load->view('liquidation_side/adjusted_sales_date', $data);
        }
	}

	public function view_pendingdenomination_ctrl()
	{

        $liq_officer_emp_id = $_SESSION['emp_id'];
        $liq_officer_access = $this->liquidation_model->get_deptaccess($liq_officer_emp_id);

        $officer_acess_arr = ''; 
        foreach($liq_officer_access as $liq)
        {

            $officer_acess_arr .= $liq['company_code']."-".$liq['bunit_code']."-".$liq['dept_code']."-".$liq['section_code']."-".$liq['sub_section_code']."^";
          
        }
        
        $pending=$this->liquidation_model->view_pendingdenomination_model($officer_acess_arr);
     
         $html='
                <form>
                    <table class="table table-bordered table-hover table-condensed display" id="pending_denomination_table">
                        <thead>
                            <tr>                                                            
                            <th>
                            <center>CASHIER NAME</center>
                            </th>
                            <th>
                            <center>DEPARTMENT</center>
                            </th>
                            <th>
                            <center>REMIT TYPE</center>
                            </th> 
                            <th>
                            <center>STATUS</center>
                            </th>  
                            <th>
                            <center>DATE/TIME SUBMIT</center>
                            </th>
                            <th>
                            <center>ACTION</center>
                            </th>                            
                            </tr>
                        </thead>
                ';
      
/*========================================================IMPORTANT CODE BY SIR RIAN==============================================================*/
        $cashier_details = array();
        $emp_id          = array();            
        foreach($pending as $p)
        {
                array_push($cashier_details,$p['emp_id'],$p['emp_name'],$p['dept_name'],$p['remit_type'],$p['status'],$p['date_submit']);
                if(!in_array($p['emp_id'],$emp_id))
                {
                    array_push($emp_id,$p['emp_id']);        
                }
                
        }

        for($a=0;$a<count($emp_id);$a++)
        {             
            $status          = '';
            $emp_name        = '';
            $dept_name       = '';
            $remit_type      = '';
            $date_submit     = '';
            $emp_id2         = '';   

            for($b=0;$b<count($cashier_details);$b+=6)
            {
                if($cashier_details[$b] == $emp_id[$a])
                {
                     if($status == '')
                     {
                        $status = $cashier_details[$b+4];   
                     }     

                     if($cashier_details[$b+4] == "PENDING")
                     {
                        $status = 'PENDING';                       
                     }
                     else
                     if($status == 'CONFIRMED' && $cashier_details[$b+4] == "PENDING")   
                     {
                            $status = 'PENDING';
                     }
                     else 
                     {
                        $status  = $cashier_details[$b+4];
                     }

                      $emp_id2      = $cashier_details[$b+0];
                      $emp_name     = $cashier_details[$b+1];
                      $dept_name    = $cashier_details[$b+2];
                      $remit_type   = $cashier_details[$b+3];
                      $date_submit  = $cashier_details[$b+5];   

                }          
            }

             $html=$html.' 
                        <tr style="word-wrap:break-word;">
                          <td>'.$emp_name.'</td>
                          <td>'.$dept_name.'</td>
                          <td>'.$remit_type.'</td>
                          <td>'.$status.'</td>
                          <td>'.$date_submit.'</td>
                          <td>
                            <a style="font-size: x-large;" id="view_pendingbtn" onclick="view_pendingbtn_js('."'".$emp_id2."'".')"><i style="font-style: normal;">👁️</i></a>
                          </td>
                        </tr>
                      ';   
        }
/*================================================================END OF SIR RIAN CODE===================================================================*/
        
        // var_dump($ncashpending);
       /* foreach($pending as $p)
        {           
          
          $dcode = $p['company_code'].$p['bunit_code'].$p['dep_code'];
          $pis_department=$this->liquidation_model->get_pisdepartment($dcode);
          foreach($pis_department as $dept)
          {
            $department = $dept['dept_name'];
          }
          
          $html=$html.' 
                        <tr style="word-wrap:break-word;">
                          <td>'.$p['emp_name'].'</td>
                          <td>'.$department.'</td>
                          <td>'.$p['remit_type'].'</td>
                          <td>'.$p['status'].'</td>
                          <td>'.$p['date_submit'].'</td>
                          <td>
                            <a id="view_pendingbtn" onclick="view_pendingbtn_js('.$p['id'].')"><i style="font-style: normal; font-size: x-large;">👁️</i></a>
                          </td>
                        </tr>
                      ';                    
             
        }*/

         $html=$html.'      
                                                      
                         </table>
                        </form> 
                     ';

         $data['html']=$html;         
         echo json_encode($data);
        
	}

    public function view_pendingdenomination_ctrl_v2()
    {
        $pending_data = $this->liquidation_model->get_pendingdenomination_model_v2($_SESSION['emp_id']);
        $noncash_pending_data = $this->liquidation_model->get_noncash_pending_denomination_model($_SESSION['emp_id']);
        $confirmed_data = $this->liquidation_model->get_confirmed_denomination_model($_SESSION['emp_id']);
        
        $html='
                <form>
                    <table class="table table-bordered table-hover table-condensed display" id="pending_denomination_table">
                        <thead>
                            <tr>                                                            
                                <th>
                                    <center>CASHIER NAME</center>
                                </th>
                                <th>
                                    <center>B.U / DEPT.</center>
                                </th>
                                <th>
                                    <center>TERMINAL NO.</center>
                                </th> 
                                <th>
                                    <center>REMIT TYPE</center>
                                </th> 
                                <th>
                                    <center>MOP</center>
                                </th>
                                <th>
                                    <center>BORROWED</center>
                                </th>
                                <th>
                                    <center>STATUS</center>
                                </th>  
                                <th>
                                    <center>SALES DATE</center>
                                </th>
                                <th>
                                    <center>ACTION</center>
                                </th>                            
                            </tr>
                        </thead>
                ';
       
            foreach($pending_data as $pending)
            {
                $bcode = '';
                $dcode = '';
                $scode = '';
                $sscode = '';
                $dname = '';
                $sname = '';
                $ssname = '';
                $br1 = '';
                $br2 = '';
                $br3 = '';

                $bcode = $pending['ccode'].$pending['bcode'];
                $bunit_data = $this->liquidation_model->get_pisbunit_v2($bcode);

                $dcode = $pending['ccode'].$pending['bcode'].$pending['dcode'];
                $dept_data = $this->liquidation_model->get_pisdepartment_v2($dcode);
                if(!empty($dept_data))
                {
                    $dname = $dept_data->dept_name;
                    $br1 = '<br>';
                }

                $scode = $pending['ccode'].$pending['bcode'].$pending['dcode'].$pending['scode'];
                $section_data = $this->liquidation_model->get_section_v2($scode);
                if(!empty($section_data))
                {
                    $sname = $section_data->section_name;
                    $br2 = '<br>';
                }
                
                $sscode = $pending['ccode'].$pending['bcode'].$pending['dcode'].$pending['scode'].$pending['sscode'];
                $sub_section_data = $this->liquidation_model->get_subsection_v2($sscode);
                if(!empty($sub_section_data))
                {
                    $ssname = $sub_section_data->sub_section_name;
                    $br3 = '<br>';
                }
                // ===================================================================================================================
                $hide = 'hidden';
                $sales_date = '';
                $deleted_data = $this->liquidation_model->get_deleted_denomination_model($pending['cashier_id']);
                if(!empty($deleted_data))
                {
                    $hide = '';
                    foreach($deleted_data as $data)
                    {
                        $sales_date = $data['sales_date'];
                    }
                }
                // ===================================================================================================================
                $html.=' 
                    <tr style="word-wrap:break-word;">
                        <td style="vertical-align: middle;">'.$pending['cname'].'</td>
                        <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                        <td style="vertical-align: middle;">'.$pending['pos_name'].'</td>
                        <td style="vertical-align: middle;">'.$pending['rtype'].'</td>
                        <td style="vertical-align: middle;">'.'CASH'.'</td>
                        <td style="vertical-align: middle;">'.$pending['borrowed'].'</td>
                        <td style="vertical-align: middle;">'.$pending['status'].'</td>
                        <td style="vertical-align: middle;">'.$pending['date'].'</td>
                        <td style="vertical-align: middle;">
                            <a id="view_pendingbtn" onclick="view_pendingbtn_js('."'".$pending['tr_no']."','".$pending['cashier_id']."','".$sscode."','".$pending['pos_name']."','".$pending['borrowed']."','".$pending['date']."'".')"><i style="font-style: normal; font-size: x-large;">👁️</i></a>&nbsp;
                            <a '.$hide.' id="view_pendingbtn" onclick="edit_pendingbtn_js('."'".$pending['tr_no']."','".$pending['cashier_id']."','".$sscode."','".$pending['pos_name']."','".$pending['cname']."','".$sales_date."'".')"><i style="font-style: normal; font-size: large;">✏️</i></a>
                        </td>
                    </tr>
                    '; 
            }
            
            $noncash_sscode = '';
            foreach($noncash_pending_data as $pending)
            {
                $noncash_sscode = $pending['ccode'].$pending['bcode'].$pending['dcode'].$pending['scode'].$pending['sscode'];
                $validate_data = $this->liquidation_model->validate_pending_model($pending['cashier_id'],$noncash_sscode,$pending['pos_name'],$pending['borrowed']);
                if(empty($validate_data))
                {
                    $bcode = '';
                    $dcode = '';
                    $scode = '';
                    $sscode = '';
                    $dname = '';
                    $sname = '';
                    $ssname = '';
                    $br1 = '';
                    $br2 = '';
                    $br3 = '';

                    $bcode = $pending['ccode'].$pending['bcode'];
                    $bunit_data = $this->liquidation_model->get_pisbunit_v2($bcode);

                    $dcode = $pending['ccode'].$pending['bcode'].$pending['dcode'];
                    $dept_data = $this->liquidation_model->get_pisdepartment_v2($dcode);
                    if(!empty($dept_data))
                    {
                        $dname = $dept_data->dept_name;
                        $br1 = '<br>';
                    }

                    $scode = $pending['ccode'].$pending['bcode'].$pending['dcode'].$pending['scode'];
                    $section_data = $this->liquidation_model->get_section_v2($scode);
                    if(!empty($section_data))
                    {
                        $sname = $section_data->section_name;
                        $br2 = '<br>';
                    }
                    
                    $sscode = $pending['ccode'].$pending['bcode'].$pending['dcode'].$pending['scode'].$pending['sscode'];
                    $sub_section_data = $this->liquidation_model->get_subsection_v2($sscode);
                    if(!empty($sub_section_data))
                    {
                        $ssname = $sub_section_data->sub_section_name;
                        $br3 = '<br>';
                    }
                    // ===================================================================================================================
                    $hide = 'hidden';
                    $sales_date = '';
                    $deleted_data = $this->liquidation_model->get_deleted_denomination_model($pending['cashier_id']);
                    if(!empty($deleted_data))
                    {
                        $hide = '';
                        foreach($deleted_data as $data)
                        {
                            $sales_date = $data['sales_date'];
                        }
                    }
                    // ===================================================================================================================
                    $html.=' 
                        <tr style="word-wrap:break-word;">
                            <td style="vertical-align: middle;">'.$pending['cname'].'</td>
                            <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                            <td style="vertical-align: middle;">'.$pending['pos_name'].'</td>
                            <td style="vertical-align: middle;">'.$pending['rtype'].'</td>
                            <td style="vertical-align: middle;">'.'NONCASH'.'</td>
                            <td style="vertical-align: middle;">'.$pending['borrowed'].'</td>
                            <td style="vertical-align: middle;">'.$pending['status'].'</td>
                            <td style="vertical-align: middle;">'.$pending['date'].'</td>
                            <td style="vertical-align: middle;">
                                <a id="view_pendingbtn" onclick="view_pendingbtn_js('."'".$pending['tr_no']."','".$pending['cashier_id']."','".$sscode."','".$pending['pos_name']."','".$pending['borrowed']."','".$pending['date']."'".')"><i style="font-style: normal; font-size: x-large;">👁️</i></a>&nbsp;
                                <a '.$hide.' id="view_pendingbtn" onclick="edit_pendingbtn_js('."'".$pending['tr_no']."','".$pending['cashier_id']."','".$sscode."','".$pending['pos_name']."','".$pending['cname']."','".$sales_date."'".')"><i style="font-style: normal; font-size: large;">✏️</i></a>
                            </td>
                        </tr>
                        '; 
                }
            }

            $confirmed_sscode = '';
            foreach($confirmed_data as $confirmed)
            {
                $confirmed_sscode = $confirmed['ccode'].$confirmed['bcode'].$confirmed['dcode'].$confirmed['scode'].$confirmed['sscode'];
                $validate_data = $this->liquidation_model->validate_pending_model($confirmed['cashier_id'],$confirmed_sscode,$confirmed['pos_name'],$confirmed['borrowed']);
                if(empty($validate_data))
                {
                    $validate_data2 = $this->liquidation_model->validate_pending_model2($confirmed['cashier_id'],$confirmed_sscode,$confirmed['pos_name'],$confirmed['borrowed']);
                    if(empty($validate_data2))
                    {
                        $bcode = '';
                        $dcode = '';
                        $scode = '';
                        $sscode = '';
                        $dname = '';
                        $sname = '';
                        $ssname = '';
                        $br1 = '';
                        $br2 = '';
                        $br3 = '';

                        $bcode = $confirmed['ccode'].$confirmed['bcode'];
                        $bunit_data = $this->liquidation_model->get_pisbunit_v2($bcode);

                        $dcode = $confirmed['ccode'].$confirmed['bcode'].$confirmed['dcode'];
                        $dept_data = $this->liquidation_model->get_pisdepartment_v2($dcode);
                        if(!empty($dept_data))
                        {
                            $dname = $dept_data->dept_name;
                            $br1 = '<br>';
                        }

                        $scode = $confirmed['ccode'].$confirmed['bcode'].$confirmed['dcode'].$confirmed['scode'];
                        $section_data = $this->liquidation_model->get_section_v2($scode);
                        if(!empty($section_data))
                        {
                            $sname = $section_data->section_name;
                            $br2 = '<br>';
                        }
                        
                        $sscode = $confirmed['ccode'].$confirmed['bcode'].$confirmed['dcode'].$confirmed['scode'].$confirmed['sscode'];
                        $sub_section_data = $this->liquidation_model->get_subsection_v2($sscode);
                        if(!empty($sub_section_data))
                        {
                            $ssname = $sub_section_data->sub_section_name;
                            $br3 = '<br>';
                        }
                        // ===================================================================================================================
                        $hide = 'hidden';
                        $sales_date = '';
                        $deleted_data = $this->liquidation_model->get_deleted_denomination_model($confirmed['cashier_id']);
                        if(!empty($deleted_data))
                        {
                            $hide = '';
                            foreach($deleted_data as $data)
                            {
                                $sales_date = $data['sales_date'];
                            }
                        }
                        // ===================================================================================================================
                        $html.=' 
                            <tr style="word-wrap:break-word;">
                                <td style="vertical-align: middle;">'.$confirmed['cname'].'</td>
                                <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                                <td style="vertical-align: middle;">'.$confirmed['pos_name'].'</td>
                                <td style="vertical-align: middle;">'.$confirmed['rtype'].'</td>
                                <td style="vertical-align: middle;">'.'CASH'.'</td>
                                <td style="vertical-align: middle;">'.$confirmed['borrowed'].'</td>
                                <td style="vertical-align: middle;">'.$confirmed['status'].'</td>
                                <td style="vertical-align: middle;">'.$confirmed['date'].'</td>
                                <td style="vertical-align: middle;">
                                    <a id="view_confirmedbtn" onclick="view_pendingbtn_js('."'".$confirmed['tr_no']."','".$confirmed['cashier_id']."','".$sscode."','".$confirmed['pos_name']."','".$confirmed['borrowed']."','".$confirmed['date']."'".')"><i style="font-style: normal; font-size: x-large;">👁️</i></a>&nbsp;
                                    <a '.$hide.' id="view_confirmedbtn" onclick="edit_pendingbtn_js('."'".$confirmed['tr_no']."','".$confirmed['cashier_id']."','".$sscode."','".$confirmed['pos_name']."','".$confirmed['cname']."','".$sales_date."'".')"><i style="font-style: normal; font-size: large;">✏️</i></a>
                                </td>
                            </tr>
                            '; 
                    }
                }
            }
        
        $html.='                      
                        </table>
                    </form> 
                    ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function view_updated_pendingdenomination_ctrl()
    {
        $pending_data = $this->liquidation_model->get_pendingdenomination_model_v2($_SESSION['emp_id']);
        $noncash_pending_data = $this->liquidation_model->get_noncash_pending_denomination_model_v2($_SESSION['emp_id']);
        $confirmed_data = $this->liquidation_model->get_confirmed_denomination_model_v2($_SESSION['emp_id']);
        
        $html='
                <form>
                    <table class="table table-bordered table-hover table-condensed display" id="pending_denomination_table">
                        <thead>
                            <tr>                                                            
                                <th>
                                    <center>CASHIER NAME</center>
                                </th>
                                <th>
                                    <center>B.U / DEPT.</center>
                                </th>
                                <th>
                                    <center>TERMINAL NO.</center>
                                </th> 
                                <th>
                                    <center>REMIT TYPE</center>
                                </th> 
                                <th>
                                    <center>MOP</center>
                                </th>
                                <th>
                                    <center>BORROWED</center>
                                </th>
                                <th>
                                    <center>STATUS</center>
                                </th>  
                                <th>
                                    <center>SALES DATE</center>
                                </th>
                                <th>
                                    <center>ACTION</center>
                                </th>                            
                            </tr>
                        </thead>
                ';
       
            foreach($pending_data as $pending)
            {
                $bcode = '';
                $dcode = '';
                $scode = '';
                $sscode = '';
                $dname = '';
                $sname = '';
                $ssname = '';
                $br1 = '';
                $br2 = '';
                $br3 = '';

                $bcode = $pending['ccode'].$pending['bcode'];
                $bunit_data = $this->liquidation_model->get_pisbunit_v2($bcode);

                $dcode = $pending['ccode'].$pending['bcode'].$pending['dcode'];
                $dept_data = $this->liquidation_model->get_pisdepartment_v2($dcode);
                if(!empty($dept_data))
                {
                    $dname = $dept_data->dept_name;
                    $br1 = '<br>';
                }

                $scode = $pending['ccode'].$pending['bcode'].$pending['dcode'].$pending['scode'];
                $section_data = $this->liquidation_model->get_section_v2($scode);
                if(!empty($section_data))
                {
                    $sname = $section_data->section_name;
                    $br2 = '<br>';
                }
                
                $sscode = $pending['ccode'].$pending['bcode'].$pending['dcode'].$pending['scode'].$pending['sscode'];
                $sub_section_data = $this->liquidation_model->get_subsection_v2($sscode);
                if(!empty($sub_section_data))
                {
                    $ssname = $sub_section_data->sub_section_name;
                    $br3 = '<br>';
                }
                // ===================================================================================================================
                $html.=' 
                    <tr style="word-wrap:break-word;">
                        <td style="vertical-align: middle;">'.$pending['cname'].'</td>
                        <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                        <td style="vertical-align: middle;">'.$pending['pos_name'].'</td>
                        <td style="vertical-align: middle;">'.$pending['rtype'].'</td>
                        <td style="vertical-align: middle;">'.'CASH'.'</td>
                        <td style="vertical-align: middle;">'.$pending['borrowed'].'</td>
                        <td style="vertical-align: middle;">'.$pending['status'].'</td>
                        <td style="vertical-align: middle;">'.$pending['date'].'</td>
                        <td style="vertical-align: middle;">
                            <a id="view_pendingbtn" onclick="view_pendingbtn_js('."'".$pending['tr_no']."','".$pending['cashier_id']."','".$sscode."','".$pending['pos_name']."','".$pending['borrowed']."','".$pending['date']."'".')"><i style="font-style: normal; font-size: x-large;">👁️</i></a>
                        </td>
                    </tr>
                    '; 
            }
            
            $noncash_sscode = '';
            foreach($noncash_pending_data as $pending)
            {
                $noncash_sscode = $pending['ccode'].$pending['bcode'].$pending['dcode'].$pending['scode'].$pending['sscode'];
                $validate_data = $this->liquidation_model->validate_pending_model($pending['cashier_id'],$noncash_sscode,$pending['pos_name'],$pending['borrowed']);
                if(empty($validate_data))
                {
                    $bcode = '';
                    $dcode = '';
                    $scode = '';
                    $sscode = '';
                    $dname = '';
                    $sname = '';
                    $ssname = '';
                    $br1 = '';
                    $br2 = '';
                    $br3 = '';

                    $bcode = $pending['ccode'].$pending['bcode'];
                    $bunit_data = $this->liquidation_model->get_pisbunit_v2($bcode);

                    $dcode = $pending['ccode'].$pending['bcode'].$pending['dcode'];
                    $dept_data = $this->liquidation_model->get_pisdepartment_v2($dcode);
                    if(!empty($dept_data))
                    {
                        $dname = $dept_data->dept_name;
                        $br1 = '<br>';
                    }

                    $scode = $pending['ccode'].$pending['bcode'].$pending['dcode'].$pending['scode'];
                    $section_data = $this->liquidation_model->get_section_v2($scode);
                    if(!empty($section_data))
                    {
                        $sname = $section_data->section_name;
                        $br2 = '<br>';
                    }
                    
                    $sscode = $pending['ccode'].$pending['bcode'].$pending['dcode'].$pending['scode'].$pending['sscode'];
                    $sub_section_data = $this->liquidation_model->get_subsection_v2($sscode);
                    if(!empty($sub_section_data))
                    {
                        $ssname = $sub_section_data->sub_section_name;
                        $br3 = '<br>';
                    }
                    // ===================================================================================================================
                    $html.=' 
                        <tr style="word-wrap:break-word;">
                            <td style="vertical-align: middle;">'.$pending['cname'].'</td>
                            <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                            <td style="vertical-align: middle;">'.$pending['pos_name'].'</td>
                            <td style="vertical-align: middle;">'.$pending['rtype'].'</td>
                            <td style="vertical-align: middle;">'.'NONCASH'.'</td>
                            <td style="vertical-align: middle;">'.$pending['borrowed'].'</td>
                            <td style="vertical-align: middle;">'.$pending['status'].'</td>
                            <td style="vertical-align: middle;">'.$pending['date'].'</td>
                            <td style="vertical-align: middle;">
                                <a id="view_pendingbtn" onclick="view_pendingbtn_js('."'".$pending['tr_no']."','".$pending['cashier_id']."','".$sscode."','".$pending['pos_name']."','".$pending['borrowed']."','".$pending['date']."'".')"><i style="font-style: normal; font-size: x-large;">👁️</i></a>
                            </td>
                        </tr>
                        '; 
                }
            }
            
            $confirmed_sscode = '';
            foreach($confirmed_data as $confirmed)
            {
                $confirmed_sscode = $confirmed['ccode'].$confirmed['bcode'].$confirmed['dcode'].$confirmed['scode'].$confirmed['sscode'];
                $validate_data = $this->liquidation_model->validate_pending_model($confirmed['cashier_id'],$confirmed_sscode,$confirmed['pos_name'],$confirmed['borrowed']);
                if(empty($validate_data))
                {
                    $validate_data2 = $this->liquidation_model->validate_pending_model2($confirmed['cashier_id'],$confirmed_sscode,$confirmed['pos_name'],$confirmed['borrowed']);
                    if(empty($validate_data2))
                    {
                        $bcode = '';
                        $dcode = '';
                        $scode = '';
                        $sscode = '';
                        $dname = '';
                        $sname = '';
                        $ssname = '';
                        $br1 = '';
                        $br2 = '';
                        $br3 = '';

                        $bcode = $confirmed['ccode'].$confirmed['bcode'];
                        $bunit_data = $this->liquidation_model->get_pisbunit_v2($bcode);

                        $dcode = $confirmed['ccode'].$confirmed['bcode'].$confirmed['dcode'];
                        $dept_data = $this->liquidation_model->get_pisdepartment_v2($dcode);
                        if(!empty($dept_data))
                        {
                            $dname = $dept_data->dept_name;
                            $br1 = '<br>';
                        }

                        $scode = $confirmed['ccode'].$confirmed['bcode'].$confirmed['dcode'].$confirmed['scode'];
                        $section_data = $this->liquidation_model->get_section_v2($scode);
                        if(!empty($section_data))
                        {
                            $sname = $section_data->section_name;
                            $br2 = '<br>';
                        }
                        
                        $sscode = $confirmed['ccode'].$confirmed['bcode'].$confirmed['dcode'].$confirmed['scode'].$confirmed['sscode'];
                        $sub_section_data = $this->liquidation_model->get_subsection_v2($sscode);
                        if(!empty($sub_section_data))
                        {
                            $ssname = $sub_section_data->sub_section_name;
                            $br3 = '<br>';
                        }
                        // ===================================================================================================================
                        $html.=' 
                            <tr style="word-wrap:break-word;">
                                <td style="vertical-align: middle;">'.$confirmed['cname'].'</td>
                                <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                                <td style="vertical-align: middle;">'.$confirmed['pos_name'].'</td>
                                <td style="vertical-align: middle;">'.$confirmed['rtype'].'</td>
                                <td style="vertical-align: middle;">'.'CASH'.'</td>
                                <td style="vertical-align: middle;">'.$confirmed['borrowed'].'</td>
                                <td style="vertical-align: middle;">'.$confirmed['status'].'</td>
                                <td style="vertical-align: middle;">'.$confirmed['date'].'</td>
                                <td style="vertical-align: middle;">
                                    <a id="view_confirmedbtn" onclick="view_pendingbtn_js('."'".$confirmed['tr_no']."','".$confirmed['cashier_id']."','".$sscode."','".$confirmed['pos_name']."','".$confirmed['borrowed']."','".$confirmed['date']."'".')"><i style="font-style: normal; font-size: x-large;">👁️</i></a>
                                </td>
                            </tr>
                            '; 
                    }
                }
            }
        
        $html.='                      
                        </table>
                    </form> 
                    ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function view_pending_noncash_den_ctrl()
    {
        $pending_data = $this->liquidation_model->get_noncash_pending_denomination_model($_SESSION['emp_id']);
        
        $html='
                <form>
                    <table class="table table-bordered table-hover table-condensed display" id="pending_noncash_denomination_table">
                        <thead>
                            <tr>                                                            
                            <th>
                            <center>CASHIER NAME</center>
                            </th>
                            <th>
                            <center>B.U / DEPT.</center>
                            </th>
                            <th>
                            <center>REMIT TYPE</center>
                            </th> 
                            <th>
                            <center>STATUS</center>
                            </th>  
                            <th>
                            <center>DATE/TIME SUBMIT</center>
                            </th>
                            <th>
                            <center>ACTION</center>
                            </th>                            
                            </tr>
                        </thead>
                ';
        
       
            foreach($pending_data as $pending)
            {
                $bcode = '';
                $dcode = '';
                $scode = '';
                $sscode = '';
                $dname = '';
                $sname = '';
                $ssname = '';

                $bcode = $pending['ccode'].$pending['bcode'];
                $bunit_data = $this->liquidation_model->get_pisbunit_v2($bcode);

                $dcode = $pending['ccode'].$pending['bcode'].$pending['dcode'];
                $dept_data = $this->liquidation_model->get_pisdepartment_v2($dcode);
                if(!empty($dept_data))
                {
                    $dname = $dept_data->dept_name;
                }

                $scode = $pending['ccode'].$pending['bcode'].$pending['dcode'].$pending['scode'];
                $section_data = $this->liquidation_model->get_section_v2($scode);
                if(!empty($section_data))
                {
                    $sname = $section_data->section_name;
                }
                
                $sscode = $pending['ccode'].$pending['bcode'].$pending['dcode'].$pending['scode'].$pending['sscode'];
                $sub_section_data = $this->liquidation_model->get_subsection_v2($sscode);
                if(!empty($sub_section_data))
                {
                    $ssname = $sub_section_data->sub_section_name;
                }
                
                $html.=' 
                    <tr style="word-wrap:break-word;">
                        <td style="vertical-align: middle;">'.$pending['cname'].'</td>
                        <td>'.$bunit_data->business_unit."<br>".$dname."<br>".$sname."<br>".$ssname.'</td>
                        <td style="vertical-align: middle;">'.$pending['rtype'].'</td>
                        <td style="vertical-align: middle;">'.$pending['status'].'</td>
                        <td style="vertical-align: middle;">'.$pending['date'].'</td>
                        <td style="vertical-align: middle;">
                        <a id="view_pendingbtn" onclick="view_pendingbtn_js('."'".$pending['cashier_id']."'".')"><i style="font-style: normal; font-size: x-large;">👁️</i></a>
                        </td>
                    </tr>
                    '; 
            }
        
        
        $html.='                      
                        </table>
                    </form> 
                    ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function view_confirmed_denomination_ctrl()
    {
        $confirmed_data = $this->liquidation_model->get_confirmed_denomination_model($_SESSION['emp_id']);
        
        $html='
                <form>
                    <table class="table table-bordered table-hover table-condensed display" id="confirmed_denomination_table">
                        <thead>
                            <tr>                                                            
                            <th>
                            <center>CASHIER NAME</center>
                            </th>
                            <th>
                            <center>B.U / DEPT.</center>
                            </th>
                            <th>
                            <center>REMIT TYPE</center>
                            </th> 
                            <th>
                            <center>STATUS</center>
                            </th>  
                            <th>
                            <center>DATE/TIME SUBMIT</center>
                            </th>
                            <th>
                            <center>ACTION</center>
                            </th>                            
                            </tr>
                        </thead>
                ';
        
        foreach($confirmed_data as $confirmed)
        {
            $bcode = '';
            $dcode = '';
            $scode = '';
            $sscode = '';
            $dname = '';
            $sname = '';
            $ssname = '';

            $bcode = $confirmed['ccode'].$confirmed['bcode'];
            $bunit_data = $this->liquidation_model->get_pisbunit_v2($bcode);

            $dcode = $confirmed['ccode'].$confirmed['bcode'].$confirmed['dcode'];
            $dept_data = $this->liquidation_model->get_pisdepartment_v2($dcode);
            if(!empty($dept_data))
            {
                $dname = $dept_data->dept_name;
            }

            $scode = $confirmed['ccode'].$confirmed['bcode'].$confirmed['dcode'].$confirmed['scode'];
            $section_data = $this->liquidation_model->get_section_v2($scode);
            if(!empty($section_data))
            {
                $sname = $section_data->section_name;
            }
            
            $sscode = $confirmed['ccode'].$confirmed['bcode'].$confirmed['dcode'].$confirmed['scode'].$confirmed['sscode'];
            $sub_section_data = $this->liquidation_model->get_subsection_v2($sscode);
            if(!empty($sub_section_data))
            {
                $ssname = $sub_section_data->sub_section_name;
            }
            
            $html.=' 
                <tr style="word-wrap:break-word;">
                    <td style="vertical-align: middle;">'.$confirmed['cname'].'</td>
                    <td>'.$bunit_data->business_unit."<br>".$dname."<br>".$sname."<br>".$ssname.'</td>
                    <td style="vertical-align: middle;">'.$confirmed['rtype'].'</td>
                    <td style="vertical-align: middle;">'.$confirmed['status'].'</td>
                    <td style="vertical-align: middle;">'.$confirmed['date'].'</td>
                    <td style="vertical-align: middle;">
                    <a id="view_confirmedbtn" onclick="view_pendingbtn_js('."'".$confirmed['cashier_id']."'".')"><i style="font-style: normal; font-size: x-large;">👁️</i></a>
                    </td>
                </tr>
                '; 
        }

        $html.='                      
                        </table>
                    </form> 
                    ';

        $data['html']=$html;         
        echo json_encode($data);
    }

	public function get_pendingdenomination_ctrl()
	{
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $get=$this->liquidation_model->get_pendingdenomination_model_v3($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
            if(empty($get))
            {
                $html='';
                $data['emp_id']=$_POST['emp_id'];
                $data['remit_type']='';
                $data['name']='Denomination Details';
                $data['message']='EMPTY';
                $data['edit_denomination']='';
                $data['edit_status_denomination']='';
                $data['edit_remittance_type']='';
   
                $data['html']=$html;     
                echo json_encode($data);
            }
            else
            {
                $html="";
                $remit_type='';
                $edit_pos = '';
                $pending_data = $this->liquidation_model->get_pendingdenomination_model_v4($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
                if(empty($pending_data))
                {
                    foreach($get as $g)
                    {  
                        $html='';
                        $data['emp_id']=$g['emp_id'];
                        $data['remit_type']='';
                        $data['name']=$g['emp_name'].'  -  Denomination Details';
                        $data['message']='EMPTY';
                        $data['edit_denomination']='';
                        $data['edit_status_denomination']='';
                        $data['edit_remittance_type']='';         
                    }
                }
                else
                {
                    foreach($pending_data as $g)
                    {  
                        $remit_type=$g['remit_type'];
                        $data['emp_id']=$g['emp_id'];
                        $data['remit_type']=$g['remit_type'];
                        $data['name']=$g['emp_name'].'  -  Denomination Details';
                        $data['message']='NOT EMPTY';
                        $data['edit_denomination']=$g['edit_denomination'];
                        $data['edit_status_denomination']=$g['edit_status_denomination'];
                        $data['edit_remittance_type']=$g['edit_remittance_type'];
                        
                        $scode = '';
                        $sname = '';
                        $sscode = '';
                        $ssname = '';
                        if($g['borrowed'] == 'YES')
                        {
                            $scode = $g['company_code'].$g['bunit_code'].$g['dep_code'].$g['section_code'];
                            $section_data = $this->liquidation_model->get_section_v2($scode);
                            if(!empty($section_data))
                            {
                                $sname = $section_data->section_name;
                            }

                            $sscode = $g['company_code'].$g['bunit_code'].$g['dep_code'].$g['section_code'].$g['sub_section_code'];
                            $sub_section_data = $this->liquidation_model->get_subsection_v2($sscode);
                            if(!empty($sub_section_data))
                            {
                                $ssname = $sub_section_data->sub_section_name;
                            }

                            $data['borrowed_html']='
                                                    <label id="cash_borrow_lbl" style="font-weight: bold;">BORROWED</label>
                                                    <label class="inline" id="section_lbl" style="font-weight: bold;">SECTION:</label>
                                                    <label class="inline" id="section_txt" style="font-weight: bold;">'.$sname.'</label><br>
                                                    <label class="inline" id="sub_section_lbl" style="font-weight: bold;">SUB SECTION:</label>
                                                    <label class="inline" id="sub_section_txt" style="font-weight: bold;">'.$ssname.'</label><br>
                                                    <label class="inline" id="" style="font-weight: bold;">'.$g['pos_name'].' - '.'</label>
                                                    <label class="inline" id="" style="font-weight: bold;">'.$g['counter_no'].'</label>
                                                    ';
                        }
                        else
                        {
                            $data['borrowed_html']='
                                                    <label class="inline" id="" style="font-weight: bold;">'.$g['pos_name'].' - '.'</label>
                                                    <label class="inline" id="" style="font-weight: bold;">'.$g['counter_no'].'</label>
                                                    ';
                        }
                       
                        if($g['remit_type']=='PARTIAL')
                        {
                            $status='hidden';
                            $status2='';
                        }
                        else
                        {
                            $status = '';
                            $status2='hidden';
                        }

                    $html.='  
                                
                            <tr>
                                <td>
                                    <label id="d_onekm">₱1,000</label>
                                </td>
                                <td>
                                    <label class="quantity" id="q_onekm" value="'.$g['onek'].'">'.$g['onek'].'
                                </td>
                                <td>
                                    <label class="d_amount" id="a_onekm" value="0">
                                </td>
                                <td>
                                    <input type="checkbox" id="cb_1k" name="cashden_checkbox" class="ppcm_checkbox pfcm_checkbox" value="1k">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label id="d_fivehm">₱500</label>
                                </td>
                                <td>
                                    <label class="quantity1" id="q_fivehm" value="'.$g['fiveh'].'">'.$g['fiveh'].'
                                </td>
                                <td>
                                    <label class="d_amount" id="a_fivehm" value="0">
                                </td>
                                <td>
                                    <input type="checkbox" id="cb_5h" name="cashden_checkbox" class="ppcm_checkbox pfcm_checkbox" value="5h">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label id="d_twohm">₱200</label>
                                </td>
                                <td>
                                    <label class="quantity2" id="q_twohm" value="'.$g['twoh'].'">'.$g['twoh'].'
                                </td>
                                <td>
                                    <label class="d_amount" id="a_twohm" value="0">
                                </td>
                                <td>
                                    <input type="checkbox" id="cb_2h" name="cashden_checkbox" class="ppcm_checkbox pfcm_checkbox" value="2h">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label id="d_onehm">₱100</label>
                                </td>
                                <td>
                                    <label class="quantity3" id="q_onehm" value="'.$g['oneh'].'">'.$g['oneh'].'
                                </td>
                                <td>
                                    <label class="d_amount" id="a_onehm" value="0">
                                </td>
                                <td>
                                    <input type="checkbox" id="cb_1h" name="cashden_checkbox" class="ppcm_checkbox pfcm_checkbox" value="1h">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label id="d_fiftym">₱50</label>
                                </td>
                                <td>
                                    <label class="quantity4" id="q_fiftym" value="'.$g['fifty'].'">'.$g['fifty'].'
                                </td>
                                <td>
                                    <label class="d_amount" id="a_fiftym" value="0">
                                </td>
                                <td>
                                    <input type="checkbox" id="cb_fifty" name="cashden_checkbox" class="ppcm_checkbox pfcm_checkbox" value="fifty">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label id="d_twentym">₱20</label>
                                </td>
                                <td>
                                    <label class="quantity5" id="q_twentym" value="'.$g['twenty'].'">'.$g['twenty'].'
                                </td>
                                <td>
                                    <label class="d_amount" id="a_twentym" value="0">
                                </td>
                                <td>
                                    <input type="checkbox" id="cb_twenty" name="cashden_checkbox" class="ppcm_checkbox pfcm_checkbox" value="twenty">
                                </td>
                            </tr>

                            <tr '.$status.'>
                                <td>
                                    <label id="d_tenm">₱10</label>
                                </td>
                                <td>
                                    <label class="quantity6" id="q_tenm" value="'.$g['ten'].'">'.$g['ten'].'
                                </td>
                                <td>
                                    <label class="d_amount" id="a_tenm" value="0">
                                </td>
                                <td>
                                    <input type="checkbox" id="cb_ten" name="cashden_checkbox" class="pfcm_checkbox" value="ten">
                                </td>
                            </tr>

                            <tr '.$status.'>
                                <td>
                                    <label id="d_fivem">₱5</label>
                                </td>
                                <td>
                                    <label class="quantity7" id="q_fivem" value="'.$g['five'].'">'.$g['five'].'
                                </td>
                                <td>
                                    <label class="d_amount" id="a_fivem" value="0">
                                </td>
                                <td>
                                    <input type="checkbox" id="cb_five" name="cashden_checkbox" class="pfcm_checkbox" value="five">
                                </td>
                            </tr>

                            <tr '.$status.'>
                                <td>
                                    <label id="d_onem">₱1</label>
                                </td>
                                <td>
                                    <label class="quantity8" id="q_onem" value="'.$g['one'].'">'.$g['one'].'
                                </td>
                                <td>
                                    <label class="d_amount" id="a_onem" value="0">
                                </td>
                                <td>
                                    <input type="checkbox" id="cb_one" name="cashden_checkbox" class="pfcm_checkbox" value="one">
                                </td>
                            </tr>

                            <tr '.$status.'>
                                <td>
                                    <label id="d_twentyfivecentsm">₱0.25</label>
                                </td>
                                <td>
                                    <label class="quantity9" id="q_twentyfivecentsm" value="'.$g['twentyfive_cents'].'">'.$g['twentyfive_cents'].'
                                </td>
                                <td>
                                    <label class="d_amount" id="a_twentyfivecentsm" value="0">
                                </td>
                                <td>
                                    <input type="checkbox" id="cb_twenty_fc" name="cashden_checkbox" class="pfcm_checkbox" value="twenty_fc">
                                </td>
                            </tr>

                            <tr '.$status.'>
                                <td>
                                    <label id="d_tencentsm">₱0.10</label>
                                </td>
                                <td>
                                    <label class="quantity10" id="q_tencentsm" value="'.$g['ten_cents'].'">'.$g['ten_cents'].'
                                </td>
                                <td>
                                    <label class="d_amount" id="a_tencentsm" value="0">
                                </td>
                                <td>
                                    <input type="checkbox" id="cb_ten_c" name="cashden_checkbox" class="pfcm_checkbox" value="ten_c">
                                </td>
                            </tr>

                            <tr '.$status.'>
                                <td>
                                    <label id="d_fivecentsm">₱0.05</label>
                                </td>
                                <td>
                                    <label class="quantity11" id="q_fivecentsm" value="'.$g['five_cents'].'">'.$g['five_cents'].'
                                </td>
                                <td>
                                    <label class="d_amount" id="a_fivecentsm" value="0">
                                </td>
                                <td>
                                    <input type="checkbox" id="cb_five_c" name="cashden_checkbox" class="pfcm_checkbox" value="five_c">
                                </td>
                            </tr>

                            <tr '.$status.'>
                                <td>
                                    <label id="d_onecentsm">₱0.01</label>
                                </td>
                                <td>
                                    <label class="quantity12" id="q_onecentsm" value="'.$g['one_cents'].'">'.$g['one_cents'].'
                                </td>
                                <td>
                                    <label class="d_amount" id="a_onecentsm" value="0">
                                </td>
                                <td>
                                    <input type="checkbox" id="cb_one_c" name="cashden_checkbox" class="pfcm_checkbox" value="one_c">
                                </td>
                            </tr>

                            <tr> 
                                <td colspan="2" style="vertical-align: middle;">
                                    <label style="float: right;" id="total_cashtxtm">TOTAL CASH</label>
                                </td>
                                <td colspan="2" style="vertical-align: middle;">
                                    <label class="d_amount" id="total_cashm">
                                    <label hidden id="cashpending_idmodal">
                                </td>
                            </tr>
                        ';         
                    }
                }

                if($html == '')
                {
                    $html = '';
                }
                else
                {
                    if($remit_type == 'PARTIAL')
                    {
                        $html.='
                            <script>
                                
                                $(".ppcm_checkbox").click(function(){
                                    $("#thpcm_checkbox").prop( "checked", false );
                                    $("#edit_cashier_den_btn").prop("disabled", false);
                                    $("#cash_confirm_btn").prop("disabled", true);
                                });

                                $(".pfcm_checkbox").click(function(){
                                    $("#thpcm_checkbox").prop( "checked", false );
                                    $("#edit_cashier_den_btn").prop("disabled", false);
                                    $("#cash_confirm_btn").prop("disabled", true);
                                });
                        
                                $(".ppcm_checkbox").change(function(){
                                    if ($(".ppcm_checkbox:checked").length == $(".ppcm_checkbox").length) {
                                    $("#thpcm_checkbox").prop( "checked", true );
                                    $("#edit_cashier_den_btn").prop("disabled", true);
                                    $("#cash_confirm_btn").prop("disabled", false);
                                    }
                                });

                                $(".pfcm_checkbox").change(function(){
                                    if ($(".pfcm_checkbox:checked").length == $(".pfcm_checkbox").length) {
                                    $("#thpcm_checkbox").prop( "checked", true );
                                    $("#edit_cashier_den_btn").prop("disabled", true);
                                    $("#cash_confirm_btn").prop("disabled", false);
                                    }
                                });
                        
                                $("#thpcm_checkbox").click(function(){
                                    thpcm_checked_js();
                                });

                                liqcalculate_breakdown_js();

                            </script>
                            ';
                    }
                    else
                    {
                        $html.='
                            <script>
                                
                                $(".ppcm_checkbox").click(function(){
                                    $("#thpcm_checkbox").prop( "checked", false );
                                    $("#edit_cashier_den_btn").prop("disabled", false);
                                    $("#cash_confirm_btn").prop("disabled", true);
                                });

                                $(".pfcm_checkbox").click(function(){
                                    $("#thpcm_checkbox").prop( "checked", false );
                                    $("#edit_cashier_den_btn").prop("disabled", false);
                                    $("#cash_confirm_btn").prop("disabled", true);
                                });

                                $(".pfcm_checkbox").change(function(){
                                    if ($(".pfcm_checkbox:checked").length == $(".pfcm_checkbox").length) {
                                    $("#thpcm_checkbox").prop( "checked", true );
                                    $("#edit_cashier_den_btn").prop("disabled", true);
                                    $("#cash_confirm_btn").prop("disabled", false);
                                    }
                                });
                        
                                $("#thpcm_checkbox").click(function(){
                                    thpcm_checked_js();
                                });

                                liqcalculate_breakdown_js();

                            </script>
                            ';
                    }
                    
                }

                $data['html']=$html;     
                echo json_encode($data);
            }
        }
	}

    public function get_variancemodal_ctrl()
    { 

        $emp_id = $_POST['emp_id'];
        $query=$this->cashier_model->getpartialhistory_cashform_model($emp_id);
        $query2=$this->liquidation_model->getfinalcash_pmodal_model($emp_id);
        $query3=$this->liquidation_model->getnoncash_pmodal_model($emp_id);
        $query4=$this->liquidation_model->validate_borrowed_model($emp_id);
        $query5=$this->liquidation_model->validate_editnoncash_model($emp_id);
        $query6=$this->liquidation_model->validate_editnoncashden_model($emp_id);
        $query7=$this->liquidation_model->get_noncash_cbcheck_model($emp_id);
        
        $noncash_cbcheck = '';
        if(!empty($query7))
        {
            foreach($query7 as $check)
            {
                $noncash_cbcheck .= $check['id'].',';
            }
        }
        $noncash_edit_denomination = '';
        if(!empty($query6))
        {
            $noncash_edit_denomination = 'ENABLED';
        }
        $noncash_message = '';
        if(empty($query5))
        {
            $noncash_message = 'NO DATA';
        }
        $noncash_borrowed = '';
        $noncash_edit_borrowed = '';
        foreach($query5 as $q5)
        {
            $noncash_borrowed = $q5['borrowed'];
            $noncash_edit_borrowed = $q5['edit_borrowed'];
        }

        $cash_message = '';
        if(empty($query4))
        {
            $cash_message = 'NO DATA';
        }
        $borrowed = '';
        $edit_borrowed = '';
        $edit_denomination = '';
        $edit_den_status = '';
        foreach($query4 as $q4)
        {
            $borrowed = $q4['borrowed'];
            $edit_borrowed = $q4['edit_borrowed'];
            $edit_denomination = $q4['edit_denomination'];
            $edit_den_status = $q4['edit_status_denomination'];
        }

        $html='';
        $partial = 0;
        $partial_empid = '';
        foreach ($query as $q)
        {
            $partial += $q['total_cash'];
            $partial_empid = $q['emp_id'];
        }

        $final = 0;
        foreach ($query2 as $q2)
        {
            $final = $q2['total_cash'];
        }

        $noncash = 0;
        foreach ($query3 as $q3)
        {
            $noncash += $q3['noncash_amount'];
        }

            $html.='

                    <tr>
                        <td>
                            <label>
                                TOTAL PARTIAL CASH
                                <a onclick="view_partial_details_js('."'".$partial_empid."'".')"><i style="font-style: normal;">👁️</i></a> 
                            </label>
                        </td>
                        <td>
                            <label id="pc_vmodal" value="'.$partial.'">'.number_format($partial,2).'
                        </td>   
                    </tr>

                    <tr>
                        <td>
                            <label>TOTAL FINAL CASH
                        </td>
                        <td>
                            <label id="fc_vmodal" value="'.$final.'">'.number_format($final,2).'
                        </td>   
                    </tr>

                    <tr>
                        <td>
                            <label>TOTAL NONCASH
                        </td>
                        <td>
                            <label id="tnc_vmodal" value="'.$noncash.'">'.number_format($noncash,2).'
                        </td>   
                    </tr>

                    <tr>
                        <td>
                            <label>GRAND TOTAL
                        </td>
                        <td>
                            <label id="gt_vmodal" value="">
                        </td>   
                    </tr>

                    <tr>
                        <td>
                            <label>REGISTERED SALES
                        </td>
                        <td>
                            <input onkeyup="liqcalculate_breakdown_js()" style="text-align: center; font-size: 15px;" type="text" class="input-sm rs_vmodal d_amount" id="rs_variancemodal" placeholder="0.00" value="0.00">
                        </td>   
                    </tr>

                    <tr>
                        <td>
                            <label id="sop_vmodallbl">
                        </td>
                        <td>
                            <label id="sop_vmodal" value="">0
                        </td>   
                    </tr>


                    <script>
                            
                        liqcalculate_breakdown_js();

                        document.querySelector(".rs_vmodal").addEventListener("keypress", function (evt) {
                            if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                            {
                                evt.preventDefault();
                            }
                            });

                        $(".d_amount").maskMoney({thousands:",", decimal:".", allowZero: true, suffix: " "});

                    </script>

                    ';

         $data['noncash_borrowed']=$noncash_borrowed;          
         $data['noncash_edit_borrowed']=$noncash_edit_borrowed;          
         $data['noncash_edit_denomination']=$noncash_edit_denomination;          
         $data['noncash_cbcheck']=$noncash_cbcheck;    
         $data['noncash_message']=$noncash_message;    
        //=================================================================  
         $data['cash_message']=$cash_message;          
         $data['borrowed']=$borrowed;          
         $data['edit_borrowed']=$edit_borrowed;          
         $data['edit_denomination']=$edit_denomination;          
         $data['edit_den_status']=$edit_den_status;    
        //================================================================    
         $data['html']=$html;         
         echo json_encode($data);
    }

    public function get_variancemodal_ctrl_v2()
    { 
        $partial_data=$this->liquidation_model->get_total_partial_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
        $partial = 0;
        if(!empty($partial_data))
        {
            $partial = $partial_data->partial_total;
        }
        // =========================================================================================================================================================
        $final_data=$this->liquidation_model->getfinalcash_pmodal_model_v2($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
        $final = 0;
        if(!empty($final_data))
        {
            $final = $final_data->final_cash;
        }
        // =========================================================================================================================================================
        $noncash_data=$this->liquidation_model->getnoncash_pmodal_model_v2($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
        $noncash = 0; 
        if(!empty($noncash_data))
        {
            $noncash = $noncash_data->total_noncash_amount;
        }
        // =========================================================================================================================================================
        $dcode = '';
        if(!empty($final_data))
        {
            $dcode = $final_data->dcode;
        }
        else
        {
            if(!empty($noncash_data))
            {
                $dcode = $noncash_data->dcode;
            }
        } 
        // ===================================SHOW/HIDE WHOLESALE DISCOUNT================================================================
        $wholesale_counter=$this->liquidation_model->wholesale_counter_model($dcode,$_POST['pos_name']);
        $hide = 'hidden';
        if(!empty($wholesale_counter))
        {
            $hide = '';
        }
        // =========================================================================================================================================================
        $html='
                <tr>
                    <td>
                        <label>
                            TOTAL PARTIAL CASH
                            <a onclick="view_partial_details_js('."'".$_POST['tr_no']."','".$_POST['emp_id']."','".$_POST['sscode']."','".$_POST['pos_name']."','".$_POST['borrowed']."'".')"><i style="font-style: normal;">👁️</i></a> 
                        </label>
                    </td>
                    <td>
                        <label id="pc_vmodal" value="'.$partial.'">'.number_format($partial,2).'
                    </td>   
                </tr>

                <tr>
                    <td>
                        <label>TOTAL FINAL CASH
                    </td>
                    <td>
                        <label id="fc_vmodal" value="'.$final.'">'.number_format($final,2).'
                    </td>   
                </tr>

                <tr>
                    <td>
                        <label>TOTAL NONCASH
                    </td>
                    <td>
                        <label id="tnc_vmodal" value="'.$noncash.'">'.number_format($noncash,2).'
                    </td>   
                </tr>

                <tr>
                    <td>
                        <label>GRAND TOTAL
                    </td>
                    <td>
                        <label id="gt_vmodal" value="">
                    </td>   
                </tr>

                <tr>
                    <td>
                        <label>TRANSACTION COUNT
                    </td>
                    <td>
                        <center><input style="text-align: center; font-size: 15px; width: 60%;" class="tr_count" id="tr_count_variancemodal" placeholder="0"></center>
                    </td>   
                </tr>

                <tr>
                    <td>
                        <label>REGISTERED SALES
                    </td>
                    <td>
                        <input onkeyup="liqcalculate_breakdown_js()" style="text-align: center; font-size: 15px;" type="text" class="input-sm rs_vmodal d_amount" id="rs_variancemodal" placeholder="0.00" value="0.00">
                    </td>   
                </tr>

                <tr '.$hide.'>
                    <td>
                        <label>WHOLESALE DISCOUNT
                    </td>
                    <td>
                        <center><input onkeyup="wholesale_dicount_js()" style="text-align: center; font-size: 15px; width: 60%;" class="d_amount" id="wholesale_discount_variancemodal" placeholder="0.00"></center>
                    </td>   
                </tr>

                <tr>
                    <td>
                        <label id="sop_vmodallbl">
                    </td>
                    <td>
                        <label id="sop_vmodal" value="">0
                    </td>   
                </tr>

                <script>   
                    $("input.tr_count").keyup(function(event) {
                        if(event.which >= 37 && event.which <= 40) return;
                    
                        $(this).val(function(index, value) {
                        return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                        ;
                        });
                    });

                    liqcalculate_breakdown_js();

                    document.querySelector(".rs_vmodal").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                    });

                    $(".d_amount").maskMoney({thousands:",", decimal:".", allowZero: true, suffix: " "});
                </script>
                ';

         $data['html']=$html;         
         echo json_encode($data);
    }

    public function confirm_pcpmodal_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $emp_id = $_POST['emp_id'];
            $validate_code = $this->liquidation_model->validate_confirm_code_model($emp_id);
            if(!empty($validate_code))
            {   
                $validate_pending_code = $this->liquidation_model->validate_pending_model($emp_id);
                $partial_code = '';
                foreach($validate_code as $code)
                {
                    $partial_code = $code['company_code'].$code['bunit_code'].$code['dep_code'].$code['section_code'].$code['sub_section_code'];
                }
                // ======================================================================================================================================
                $pending_partial_code = '';
                foreach($validate_pending_code as $pcode)
                {
                    $pending_partial_code = $pcode['company_code'].$pcode['bunit_code'].$pcode['dep_code'].$pcode['section_code'].$pcode['sub_section_code'];
                }
                // ======================================================================================================================================
                if($partial_code == $pending_partial_code)
                {
                    $confirm = 'success';
                    $this->liquidation_model->confirm_pcpmodal_model($emp_id);

                    echo json_encode($confirm);  
                }
                else
                {
                    $confirm = 'MISMATCH';

                    echo json_encode($confirm);  
                }
            }
            else
            {
                $confirm = 'success';
                $this->liquidation_model->confirm_pcpmodal_model($emp_id);

                echo json_encode($confirm);  
            }
        }  
    }

    public function confirm_pcpmodal_ctrl_v2()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {  
            if($_POST['remit_type'] == 'PARTIAL')
            {
                $validate_confirm = $this->liquidation_model->validate_confirm_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
                if(!empty($validate_confirm))
                {   
                    $confirm = 'success';
                    $this->liquidation_model->confirm_pcpmodal_model_v2($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
    
                    echo json_encode($confirm);  
                }
                else
                {
                    $confirm = 'EMPTY';
    
                    echo json_encode($confirm);  
                }
            }
            else
            {
                $validate_confirm = $this->liquidation_model->validate_final_cash_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
                if(!empty($validate_confirm))
                {   
                    $confirm = 'success';
                    $this->liquidation_model->confirm_final_cash_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
    
                    echo json_encode($confirm);  
                }
                else
                {
                    $confirm = 'EMPTY';
    
                    echo json_encode($confirm);  
                }
            }
        }  
    }

    public function confirm_noncash_denomination_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {  
            $validate_confirm = $this->liquidation_model->validate_final_noncash_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
            if(!empty($validate_confirm))
            {   
                $confirm = 'success';
                $this->liquidation_model->confirm_final_noncash_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);

                echo json_encode($confirm);  
            }
            else
            {
                $confirm = 'EMPTY';

                echo json_encode($confirm);  
            }
        }  
    }

    public function edit_remittance_type_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {  
            $confirm = 'success';
            $this->liquidation_model->edit_remittance_type_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);

            echo json_encode($confirm);  
        }  
    }

    public function get_pendingnoncashmodal_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $query=$this->liquidation_model->displayhistory_noncashform_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
            if(!empty($query))
            {
                $validate_addmop=$this->liquidation_model->validate_addmop_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
                $add_mop = '';
                if(!empty($validate_addmop))
                {
                    $add_mop = 'ENABLED';
                }
                // =================================================================================================================================================
                $name = '';
                $scode = '';
                $sscode = '';
                $borrowed = '';
                $pos_name = '';
                $counter_no = '';
                $html = '';
                foreach ($query as $q)
                {
                    $name=$q['emp_name'];
                    $borrowed = $q['borrowed'];
                    $pos_name = $q['pos_name'];
                    $counter_no = $q['counter_no'];
                    $scode = $q['company_code'].$q['bunit_code'].$q['dep_code'].$q['section_code'];
                    $sscode = $q['company_code'].$q['bunit_code'].$q['dep_code'].$q['section_code'].$q['sub_section_code'];
                    
                    $html.='
                            <tr>
                                <td style="vertical-align: middle;">
                                    <label id="">'.$q['mop_name'].'
                                </td>
                                <td style="vertical-align: middle;">
                                    <label class="" id="" value="'.$q['noncash_qty'].'">'.$q['noncash_qty'].'
                                </td>
                                <td style="vertical-align: middle;">
                                    <label class="" id="" value="'.$q['noncash_amount'].'">'.number_format($q['noncash_amount'],2).'
                                </td>
                                <td style="vertical-align: middle;">
                                    <input type="checkbox" id="pncm_checkbox'.$q['id'].'" name="noncashden_checkbox" class="pncm_checkbox" value="'.$q['id'].'">
                                </td>
                            </tr>
                            ';
                }
                // ==========================================================================================================================================
                $noncash_data=$this->liquidation_model->getnoncash_pending_total_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
                $noncash = 0;
                if(!empty($noncash_data))
                {
                    $noncash = $noncash_data->total_noncash_amount;
                }
                // =========================================================================================================================================
                if(!empty($html))
                {
                    $html.='
                        <tr>
                            <td colspan="2" style="vertical-align: middle;">
                                <label style="float: right;">TOTAL NONCASH
                            </td>
                            <td colspan="2" style="vertical-align: middle;">
                                <label id="totalnc_pmodal" value="">'.number_format($noncash,2).'
                            </td>
                        </tr>
                        
                        <script>
                            
                            $(".pncm_checkbox").click(function(){
                                $("#thpncm_checkbox").prop( "checked", false );
                                $("#noncash_confirm_btn").prop( "disabled", true);
                                $("#edit_cashier_ncden_btn").prop("disabled", false);
                            });

                            $(".pncm_checkbox").change(function(){
                                if ($(".pncm_checkbox:checked").length == $(".pncm_checkbox").length) {
                                $("#thpncm_checkbox").prop( "checked", true);
                                $("#noncash_confirm_btn").prop( "disabled", false);
                                $("#edit_cashier_ncden_btn").prop("disabled", true);
                                }
                            });
                    
                            $("#thpncm_checkbox").click(function(){
                                thpncm_checked_js();
                            });

                            liqcalculate_breakdown_js();

                        </script>

                        ';
                }
                
                $sname = '';
                $ssname = '';
                $borrowed_html = '
                                <label class="inline" id="" style="font-weight: bold;">'.$pos_name.' - '.'</label>
                                <label class="inline" id="" style="font-weight: bold;">'.$counter_no.'</label>
                                ';
                if($borrowed == 'YES')
                {
                    $section_data = $this->liquidation_model->get_section_v2($scode);
                    if(!empty($section_data))
                    {
                        $sname = $section_data->section_name;
                    }

                    $sub_section_data = $this->liquidation_model->get_subsection_v2($sscode);
                    if(!empty($sub_section_data))
                    {
                        $ssname = $sub_section_data->sub_section_name;
                    }

                        $borrowed_html='
                                        <label id="cash_borrow_lbl" style="font-weight: bold;">BORROWED</label>
                                        <label class="inline" id="section_lbl" style="font-weight: bold;">SECTION:</label>
                                        <label class="inline" id="section_txt" style="font-weight: bold;">'.$sname.'</label><br>
                                        <label class="inline" id="sub_section_lbl" style="font-weight: bold;">SUB SECTION:</label>
                                        <label class="inline" id="sub_section_txt" style="font-weight: bold;">'.$ssname.'</label><br>
                                        <label class="inline" id="" style="font-weight: bold;">'.$pos_name.' - '.'</label>
                                        <label class="inline" id="" style="font-weight: bold;">'.$counter_no.'</label>
                                        ';
                }

                $data['name']=$name.'  -  Denomination Details';
                $data['nc_borrowed_html'] = $borrowed_html;
                $data['message'] = 'NOT EMPTY';
                $data['add_mop'] = $add_mop;
                $data['html']=$html;         
                echo json_encode($data);
            }
            else
            { 
                $data['message'] = 'EMPTY';      
                $data['add_mop'] = 'EMPTY';      
                echo json_encode($data);
            }
        }
    }

    public function display_cashierlinkaccess_ctrl()
    {
        $liq_officer_emp_id = $_SESSION['emp_id'];
       
        $pisdata=$this->liquidation_model->get_pisdata_model($liq_officer_emp_id);
        // var_dump($pisdata);
        $html= '
                <thead>
                    <tr>                                                            
                    <th>
                    <center>EMPLOYEE NAME</center>
                    </th>
                    <th>
                    <center>DEPARTMENT</center>
                    </th>
                    <th>
                    <center>ACTION</center>
                    </th>                            
                    </tr>
                </thead>
                ';
        foreach($pisdata as $p)
        {           
          
          $emp_id = $p['emp_id'];
          $validated_empid=$this->liquidation_model->validate_empid_model($emp_id);
          if(empty($validated_empid))
          {
            $hide = '';
            $hide2 = 'hidden';
          }
          else
          {
            $hide = 'hidden';
            $hide2 = '';
          }

          $dcode = $p['company_code'].$p['bunit_code'].$p['dept_code'];
          $pis_department=$this->liquidation_model->get_pisdepartment($dcode);
          foreach($pis_department as $dept)
          {
            $department = $dept['dept_name'];
          }
          
          $html.=' 
                    <tr style="word-wrap:break-word;">
                      <td>'.$p['name'].'</td>
                      <td>'.$department.'</td>
                      <td>
                        <input type="button" '.$hide.' class="btn-success waves-effect" id="add_'.$p['emp_id'].'" onclick="add_cashier_access_js('."'".$p['emp_id']."'".', '."'".$p['name']."'".', '."'".$p['emp_no']."'".', '."'".$p['emp_no']."'".', '."'".$dcode."'".')" value="Add Access"></input>
                        <input type="button" '.$hide2.' class="btn-danger waves-effect" id="delete_'.$p['emp_id'].'" onclick="delete_cashier_access_js('."'".$p['emp_id']."'".', '."'".$p['name']."'".')" value="Delete Access"></input>
                      </td>
                    </tr>
                  ';                    
        }

         $data['html']=$html;         
         echo json_encode($data);
    }

    public function get_businessunit_ctrl()
    {
        $liq_emp_id = $_SESSION['emp_id'];
        
// ================================GET TRANSACTION NO.====================================
        $tr_no = $this->liquidation_model->get_adjustment_trno_model();

        $trno='';
        foreach($tr_no as $no)
        {
            $trno = $no['id'] + 1;
        }
// =======================================================================================

// ================================GET DEPARTMENT ========================================
        $liq_dept_data = $this->liquidation_model->get_pisdepartment_access_model($liq_emp_id);

        $dept_html='';
        foreach($liq_dept_data as $liq_dept)
        {
            $dept_html.='

                    <option id="" style="text-align: center;" value="'.$liq_dept['dept_name'].'">'.$liq_dept['dept_name'].'</option>

                    ';
        }
// ========================================================================================

// =================================GET BUSINESS UNIT=======================================
        $liq_bunit_data = $this->liquidation_model->get_pisbunit_access_model($liq_emp_id);

        $bunit_html='';
        foreach($liq_bunit_data as $liq_bunit)
        {
            $bunit_html.='

                    <option id="" style="text-align: center;" value="'.$liq_bunit['business_unit'].'">'.$liq_bunit['business_unit'].'</option>

                    ';
        }
// =======================================================================================


         $data['dept_html']=$dept_html;         
         $data['bunit_html']=$bunit_html;              
         $data['trno']=$trno;         
         echo json_encode($data);
    }

    public function get_bunitcode_ctrl()
    {
        $bname = $_POST['bunit_list'];
        
        $bunit_code = $this->liquidation_model->get_bunitcode_model($bname);
        $bcode='';
        foreach($bunit_code as $code)
        {
            $bcode = $code['company_code'].$code['bunit_code'];
        }

        $data['bcode']=$bcode;                      
        echo json_encode($data);
    }

    public function get_department_ctrl()
    {
        $bcode = $_POST['bunit_code'];
        $deptname = $_POST['liq_department'];
    
        $dept_code = $this->liquidation_model->get_deptcode_model($bcode,$deptname);
        $dcode='';
        foreach($dept_code as $code)
        {
            $dcode = $code['dept_code'];
        }
        // var_dump($dcode);

        $data['dcode']=$dcode;                      
        echo json_encode($data);
    }

    public function get_deptamount_ctrl()
    {
        $dcode = $_POST['bunit_code'].$_POST['dept_code'];
        $date = $_POST['filter_date'];
        
        $dept_amount = $this->liquidation_model->get_deptamount_model($dcode,$date);
        // var_dump($dept_amount);
        $total = '';
        foreach($dept_amount as $amount)
        {
            $total = number_format($amount['total'], 2);
        }
        
        $data['total']=$total;                      
        echo json_encode($data);
    }

    public function submit_amount_adjustment_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $save = "EXPIRED SESSION";
            echo json_encode($save);
        }
        else
        {

            $emp_id = $_SESSION['emp_id'];
            $save = "success";
            $this->liquidation_model->submit_amount_adjustment_model(
                $emp_id,
                $_POST['tr_no'],
                $_POST['filter_date'],
                $_POST['bunit_name'],
                $_POST['dept_name'],
                $_POST['bunit_code'],
                $_POST['dept_code'],
                $_POST['dept_amount'],
                $_POST['adjustment_amount'],
                $_POST['gt_adjustment'],
                $_POST['adjustment_reason'],
                $_POST['date_submit']
            );

            echo json_encode($save);
        }
    }

    public function get_adjusted_data_ctrl()
    {
        $emp_id = $_SESSION['emp_id'];
        $adjusted_data = $this->liquidation_model->get_adjusted_data_model($emp_id);
        // var_dump($adjusted_data);
        $html='';
        foreach($adjusted_data as $data)
        {
            $html.=' 
                        <tr>
                          <td>'.$data['transaction_no'].'</td>
                          <td>'.$data['date_filter'].'</td>
                          <td>'.$data['bunit_name'].'</td>
                          <td>'.$data['dept_name'].'</td>
                          <td>'.number_format($data['old_amount'], 2).'</td>
                          <td>'.number_format($data['adjust_amount'], 2).'</td>
                          <td>'.number_format($data['adjustment_gtotal'], 2).'</td>
                          <td>'.$data['adjustment_reason'].'</td>
                          <td>'.$data['date_submit'].'</td>
                          <td>
                            <a id="" onclick=""><i style="font-style: normal; font-size: x-large;">🖨️</i></a>
                          </td>
                        </tr>
                      ';
        } 
        

        $data['html']=$html;                      
        echo json_encode($data);
    }

    public function display_variance_ctrl()
    {
        $emp_id = $_SESSION['emp_id'];
        $variance_data = $this->liquidation_model->get_variance_model($emp_id);
        
        $html='';
        $bcode='';
        foreach($variance_data as $data)
        {   
            /*=======================GET BUSINESS UNIT===========================*/
            $bcode = $data['company_code'].$data['bunit_code'];
            $bunit_data = $this->liquidation_model->get_businessunit_model($bcode);
            
            $bunit_name = '';
            foreach($bunit_data as $bunit)
            {
                $bunit_name = $bunit['business_unit'];
            }
            /*====================================================================*/

            /*===========================GET DEPARTMENT=============================*/
            $dcode = $data['company_code'].$data['bunit_code'].$data['dept_code'];
            $dept_data = $this->liquidation_model->get_pisdepartment($dcode);
            
            $dept_name = '';
            foreach($dept_data as $dept)
            {
                $dept_name = $dept['dept_name'];
            }
            /*=======================================================================*/

            /*===========================GET SECTION=============================*/
            $scode = $data['company_code'].$data['bunit_code'].$data['dept_code'].$data['section_code'];
            $section_data = $this->liquidation_model->get_pis_section_model($scode);
            
            $section_name = '';
            foreach($section_data as $sec)
            {
                $section_name = $sec['section_name'];
            }
            /*=======================================================================*/

            /*===========================GET SUB SECTION=============================*/
            $sub_scode = $data['company_code'].$data['bunit_code'].$data['dept_code'].$data['section_code'].$data['sub_sec_code'];
            $sub_section_data = $this->liquidation_model->get_pis_sub_section_model($sub_scode);
            
            $sub_section_name = '';
            foreach($sub_section_data as $sub_sec)
            {
                $sub_section_name = $sub_sec['sub_section_name'];
            }
            /*=======================================================================*/
            // var_dump($bunit_name,$dept_name,$section_name);
            $html.=' 
                    <tr>
                      <td>'.$data['sales_date'].'</td>
                      <td>'.$bunit_name.'<br>'.$dept_name.'<br>'.$section_name.'<br>'.$sub_section_name.'</td>
                      <td>'.$data['emp_name'].'</td>
                      <td>'.number_format($data['denomination_amt'], 2).'</td>
                      <td>'.number_format($data['amt_counted'], 2).'</td>
                      <td>'.number_format($data['variance_amt'], 2).'</td>
                      <td>'.$data['date_notified'].'</td>
                      <td><textarea type="text" style="text-align: left;" class="input-sm data" id="adjustment_reason'.$data['id'].'" placeholder=""></textarea></td>
                      <td>
                        <button style="margin-top: 10%;" type="button" id="" class="btn btn-warning waves-effect" onclick="adjust_variance_js('.$data['id'].','."'".$data['emp_id']."'".','."'".$data['emp_name']."'".','.$data['amt_counted'].')">ADJUST</button>
                      </td>
                    </tr>
                  ';
                  /* <a id="" onclick=""><i style="font-style: normal; font-size: x-large;">🖨️</i></a>*/
        } 
        

        $data['html']=$html;                      
        echo json_encode($data);
    }

    public function add_cashier_access_ctrl()
    {
        $emp_id = $_POST['emp_id'];
        $emp_no = $_POST['emp_no'];

        $liq_emp_id = $_SESSION['emp_id'];
        $liq_dcode = $this->liquidation_model->get_pisdata($liq_emp_id);

        $dcode = '';
        foreach($liq_dcode as $code)
        {
            $dcode = $code['company_code'].$code['bunit_code'].$code['dept_code'];
        }

        $dept_access = $this->liquidation_model->validate_liq_dept_access_model($dcode);

        $route = '';
        if(empty($dept_access))
        {
            // echo 'empty';
            $route = 'cashier_dashboard_route';
        }
        else
        {
            // echo 'not empty';
            $route = 'cfscashier_dashboard_route';
        }

        $message = "success";
        $this->liquidation_model->add_cashier_access_model($emp_id,$emp_no,$_POST['emp_pins'],$_POST['dcode'],$route);

        echo json_encode($message);

    }

    public function delete_cashier_access_ctrl()
    {
        $emp_id = $_POST['emp_id'];
        $message = "success";
        $this->liquidation_model->delete_cashier_access_model($emp_id);

        echo json_encode($message);
    }

    public function adjust_variance_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $lo_emp_id = $_SESSION['emp_id'];
            $message = "success";
            $this->liquidation_model->adjust_variance_model($lo_emp_id,$_POST['reason'],$_POST['adjusted_amt'],$_POST['id'],$_POST['emp_id']);

            echo json_encode($message);
        }
    }

    public function display_adjusted_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            // date_default_timezone_set('Asia/Manila');
            $emp_id = $_SESSION['emp_id'];
            $dtfrom = $_POST['dtfrom'];
            $dtto = $_POST['dtto'];
            $adjusted_data = $this->liquidation_model->get_adjusted_model($emp_id,$dtfrom,$dtto);//date('Y-m-d H:i:s', $dtendz)
            // var_dump($dtfrom,$dtto,$adjusted_data);
            $html='
                    <table class="table table-striped table-bordered table-hover display" id="adjusted_table" style="color: black; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>
                                    <center>SALES DATE
                                </th>
                                <th>
                                    <center>B.U / DEPT.
                                </th>
                                <th>
                                    <center>CASHIER INCHARGE
                                </th>
                                <th>
                                    <center>CLS AMT.
                                </th>
                                <th>
                                    <center>TMS AMT.
                                </th>
                                <th>
                                    <center>VAR. AMT.
                                </th>
                                <th>
                                    <center>CLS ADJ. AMT.
                                </th>
                                <th>
                                    <center>REASON
                                </th>
                                <th>
                                    <center>DATE ADJ.
                                </th>
                                <th>
                                    <center>ACTION
                                </th>
                            </tr>
                        </thead>
                        <form name="adjusted_viewing_form" id="adjusted_viewing_form">
                            <tbody id="adjusted_viewing_tbody">
                  ';

            $bcode='';
            foreach($adjusted_data as $data)
            {   
                /*=======================GET BUSINESS UNIT===========================*/
                $bcode = $data['company_code'].$data['bunit_code'];
                $bunit_data = $this->liquidation_model->get_businessunit_model($bcode);
                
                $bunit_name = '';
                foreach($bunit_data as $bunit)
                {
                    $bunit_name = $bunit['business_unit'];
                }
                /*====================================================================*/

                /*===========================GET DEPARTMENT=============================*/
                $dcode = $data['company_code'].$data['bunit_code'].$data['dept_code'];
                $dept_data = $this->liquidation_model->get_pisdepartment($dcode);
                
                $dept_name = '';
                foreach($dept_data as $dept)
                {
                    $dept_name = $dept['dept_name'];
                }
                /*=======================================================================*/

                /*===========================GET SECTION=============================*/
                $scode = $data['company_code'].$data['bunit_code'].$data['dept_code'].$data['section_code'];
                $section_data = $this->liquidation_model->get_pis_section_model($scode);
                
                $section_name = '';
                foreach($section_data as $sec)
                {
                    $section_name = $sec['section_name'];
                }
                /*=======================================================================*/

                /*===========================GET SUB SECTION=============================*/
                $sub_scode = $data['company_code'].$data['bunit_code'].$data['dept_code'].$data['section_code'].$data['sub_sec_code'];
                $sub_section_data = $this->liquidation_model->get_pis_sub_section_model($sub_scode);
                
                $sub_section_name = '';
                foreach($sub_section_data as $sub_sec)
                {
                    $sub_section_name = $sub_sec['sub_section_name'];
                }
                /*=======================================================================*/
                // var_dump($bunit_name,$dept_name,$section_name);
                $html.=' 
                        <tr>
                          <td>'.$data['sales_date'].'</td>
                          <td>'.$bunit_name.'<br>'.$dept_name.'<br>'.$section_name.'<br>'.$sub_section_name.'</td>
                          <td>'.$data['emp_name'].'</td>
                          <td>'.number_format($data['denomination_amt'], 2).'</td>
                          <td>'.number_format($data['amt_counted'], 2).'</td>
                          <td>'.number_format($data['variance_amt'], 2).'</td>
                          <td>'.number_format($data['cls_adjusted_amt'], 2).'</td>
                          <td>'.$data['reason'].'</td>
                          <td>'.$data['date_time_adjusted'].'</td>
                          <td>   
                            <a id="" onclick="print_adjusted_js('.$data['id'].','."'".$data['emp_id']."'".','."'".$data['emp_name']."'".')"><i style="font-style: normal; font-size: x-large;">🖨️</i></a>
                          </td>
                        </tr>
                      ';
                      /*<a id="" onclick=""><i style="font-style: normal; font-size: x-large;">🖨️</i></a>*/
                      // <a id="" onclick="print_adjusted_modal_js('.$data['id'].','."'".$data['emp_id']."'".','."'".$data['emp_name']."'".')"><i style="font-style: normal; font-size: x-large;">🖨️</i></a>
                      
            }

            $html.='
                            </tbody>
                        </form>
                    </table>
                    '; 
            
            // var_dump($html);
            $data['html']=$html;                      
            echo json_encode($data);

        }
    }

    public function print_adjusted_ctrl()
    {
        // $lo_emp_id = $_SESSION['emp_id'];
        $print_adjusted_data = $this->liquidation_model->print_adjusted_model($_POST['id'],$_POST['emp_id']);
        // var_dump($print_adjusted_data);
        
         date_default_timezone_set('Asia/Manila');
         $date = date('d-m-y h:i:s');
         $html = '';
         foreach($print_adjusted_data as $adjusted)
         {  

            /*=======================GET BUSINESS UNIT===========================*/
            $bcode = $adjusted['company_code'].$adjusted['bunit_code'];
            $bunit_data = $this->liquidation_model->get_businessunit_model($bcode);
            
            $bunit_name = '';
            foreach($bunit_data as $bunit)
            {
                $bunit_name = $bunit['business_unit'];
            }
            /*====================================================================*/

            /*===========================GET DEPARTMENT=============================*/
            $dcode = $adjusted['company_code'].$adjusted['bunit_code'].$adjusted['dept_code'];
            $dept_data = $this->liquidation_model->get_pisdepartment($dcode);
            
            $dept_name = '';
            foreach($dept_data as $dept)
            {
                $dept_name = $dept['dept_name'];
            }
            /*=======================================================================*/

            /*===========================GET SECTION=============================*/
            $scode = $adjusted['company_code'].$adjusted['bunit_code'].$adjusted['dept_code'].$adjusted['section_code'];
            $section_data = $this->liquidation_model->get_pis_section_model($scode);
            
            $section_name = '';
            foreach($section_data as $sec)
            {
                $section_name = $sec['section_name'];
            }
            /*=======================================================================*/

            /*===========================GET SUB SECTION=============================*/
            $sub_scode = $adjusted['company_code'].$adjusted['bunit_code'].$adjusted['dept_code'].$adjusted['section_code'].$adjusted['sub_sec_code'];
            $sub_section_data = $this->liquidation_model->get_pis_sub_section_model($sub_scode);
            
            $sub_section_name = '';
            foreach($sub_section_data as $sub_sec)
            {
                $sub_section_name = $sub_sec['sub_section_name'];
            }
            /*=======================================================================*/


            $print_counter = '';
            if($adjusted['cls_printing_counter'] == 0)
            {
                $print_counter = 1;
            }
            else
            {
                $print_counter = $adjusted['cls_printing_counter'];
            }

            $html=' 
                <table class="table table-striped table-bordered table-hover display" id="print_adjusted_tbl">
                    <thead>
                        <tr>
                            <th width="30%" class="th_border">
                                <center>ADJUSTMENT
                            </th>
                            <th width="70%" class="th_border">
                                <center>DATE/TIME: '.$date.' <br>PRINTING NO. '.$print_counter.'
                            </th>
                        </tr>
                    </thead>
                        <form name="print_form" id="print_form">
                            <tbody>
                                <tr>
                                    <td>
                                        <center><label style="float: right;">SALES DATE:</label></center>
                                    </td>
                                    <td>
                                        <center><label style="float: left;">&nbsp;&nbsp;'.$adjusted['sales_date'].'</label></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <center><label style="float: right;">BUSINES UNIT:</label></center>
                                    </td>
                                    <td>
                                        <center><label style="float: left;">&nbsp;&nbsp;'.$bunit_name.'</label></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <center><label style="float: right;">DEPARTMENT:</label></center>
                                    </td>
                                    <td>
                                        <center><label style="float: left;">&nbsp;&nbsp;'.$dept_name.' / '.$section_name.' / '.$sub_section_name.'</label></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <center><label style="float: right;">CASHIER NAME:</label></center>
                                    </td>
                                    <td>
                                        <center><label style="float: left;">&nbsp;&nbsp;'.$adjusted['emp_name'].'</label></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <center><label style="float: right;">CLS AMOUNT:</label></center>
                                    </td>
                                    <td>
                                        <center><label style="float: left;">&nbsp;&nbsp;'.number_format($adjusted['denomination_amt'], 2).'</label></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <center><label style="float: right;">TMS AMOUNT:</label></center>
                                    </td>
                                    <td>
                                        <center><label style="float: left;">&nbsp;&nbsp;'.number_format($adjusted['amt_counted'], 2).'</label></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <center><label style="float: right;">VARIANCE AMOUNT:</label></center>
                                    </td>
                                    <td>
                                        <center><label style="float: left;">&nbsp;&nbsp;'.number_format($adjusted['variance_amt'], 2).'</label></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <center><label style="float: right; font-weight: bold;">ADJUSTED AMOUNT:</label></center>
                                    </td>
                                    <td>
                                        <center><label style="float: left; font-weight: bold;">&nbsp;&nbsp;'.number_format($adjusted['cls_adjusted_amt'], 2).'</label></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <center><label style="float: right;">REASON:</label></center>
                                    </td>
                                    <td>
                                        <center><label style="float: left;">&nbsp;&nbsp;'.$adjusted['reason'].'</label></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td_bottom">
                                        <center><label style="float: right;">ADJUSTMENT DATE:</label></center>
                                    </td>
                                    <td class="td_bottom">
                                        <center><label style="float: left;">&nbsp;&nbsp;'.$adjusted['date_time_adjusted'].'</label></center>
                                        <center><label hidden id="printed_id" style="float: left;" value="'.$adjusted['id'].'">'.$adjusted['id'].'</label></center>
                                        <center><label hidden id="printed_emp_id" style="float: left;" value="'.$adjusted['emp_id'].'">'.$adjusted['emp_id'].'</label></center>
                                        <center><label hidden id="printed_counter_id" style="float: left;" value="'.$adjusted['cls_printing_counter'].'">'.$adjusted['cls_printing_counter'].'</label></center>
                                    </td>
                                </tr>
                        </form>
                    </table>
                  ';
         }

        $data['html']=$html;                      
        echo json_encode($data);        
    }

    public function update_printing_counter_ctrl()
    {   
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $id = $_POST['id'];
            $counter_id = $_POST['counter_id'];
            
            if($counter_id == 0)
            {
                $updated_counter_id = $counter_id + 2;
            }else
            {
                $updated_counter_id = $counter_id + 1;
            }

          
            $this->liquidation_model->update_printing_counter_model($id,$_POST['emp_id'],$updated_counter_id);

            $liq_emp_id = $_SESSION['emp_id'];
            $liq_data = $this->liquidation_model->get_pisdata($liq_emp_id);

            $name = '';
            foreach($liq_data as $data)
            {
                $name = $data['name'];
            }
            // var_dump($name);
            echo json_encode($name);
        }
    }

    public function load_pdf_ctrl()
    {
         $this->load->view('liquidation_side/pdfreport');
    }

    public function liq_display_mop_ctrl()
    {
        $mop_data = $this->liquidation_model->get_mop_model($_SESSION['emp_id'],$_POST['dcode']);
        $validate = '';
        if(empty($mop_data))
        {
            $validate = 'NO DATA';
        }
        $html = '
                <table class="table table-striped table-bordered table-hover display" id="masterfile_table" style="color: black; font-size: 12px;">
                    <thead>
                        <colgroup span="2"></colgroup>
                        <tr style="background-color: #fff;">
                            <th rowspan="2"><center style="margin-top: 8%;">MODE OF PAYMENT</center></th>
                            <th rowspan="2"><center style="margin-top: 16%;">TYPE</center></th>
                            <th colspan="2" scope="colgroup"><center>ALLOW ACCESS</center></th>
                        </tr>
                        <tr>
                            <th scope="col" style="vertical-align: middle">
                                <center>
                                    <span style="vertical-align: 7px;">YES&nbsp;</span><input onclick="yes_checkall_js()" class="th_yes_checkbox" style="width: 25px; height: 25px;" type="checkbox">
                                </center>
                            </th>
                            <th scope="col" style="vertical-align: middle">
                                <center>
                                    <span style="vertical-align: 7px;">NO&nbsp;</span><input onclick="no_checkall_js()" class="th_no_checkbox" style="width: 25px; height: 25px;" type="checkbox">
                                </center>
                            </th>
                        </tr>
                    </thead>
                    <form name="masterfile_viewing_form" id="masterfile_viewing_form">
                        <tbody id="masterfile_viewing_tbody">
                ';

        foreach($mop_data as $md)
        {
            $yes_checked = '';
            $no_checked = '';
            if($md['allow_access'] == 'YES')
            {
                $yes_checked = 'checked';
            }
            else if($md['allow_access'] == 'NO')
            {
                $no_checked = 'checked';
            }
            else
            {
                $yes_checked = '';
                $no_checked = '';
            }

            $html .= '
                    <tr style="background-color: #fff; text-align: center;">
                        <td style="padding-top: 15px;">'.$md['mop'].'</td>
                        <td style="padding-top: 15px;">'.$md['type'].'</td>
                        <td>
                            <input type="checkbox" class="check_box yes" style="width: 25px; height: 25px;" value="'.$md['id'].', '.'YES'.'" '.$yes_checked.' id="cb_yes'.$md['id'].'" onclick="cbyes_check_uncheck_js('.$md['id'].')" onchange="check_th_yes_js()">
                        </td>
                        <td>
                            <input type="checkbox" class="check_box no" style="width: 25px; height: 25px;" value="'.$md['id'].', '.'NO'.'" '.$no_checked.' id="cb_no'.$md['id'].'" onclick="cbno_check_uncheck_js('.$md['id'].')" onchange="check_th_no_js()">
                        </td>
                    </tr>
                    ';
        }

        $html .= '
                        </tbody>
                    </form>
                </table>

                <footer id="liq_masterfile_footer">
                  <div id="footer-content" style="float: right;">
                     <button type="button" id="save_btn" class="btn btn-warning waves-effect" onclick="save_mop_access_js()">SAVE</button>
                     <button type="button" id="" class="btn btn-primary waves-effect" onclick="reset_mop_js()">CANCEL</button>
                  </div>
                </footer>
                ';

       $data['validate'] = $validate;
       $data['html'] = $html;
       echo json_encode($data);
    }

    public function get_bunit_name_ctrl()
    {
        $bunit_data = $this->liquidation_model->get_bunit_name_model($_SESSION['emp_id']);
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

    public function get_deptname_ctrl()
    {
        $dept_data = $this->liquidation_model->display_deptname_model($_SESSION['emp_id'],$_POST['bcode']);
        $dept_name = '';
        foreach($dept_data as $dept)
        {
            $dept_name .= '
                            <option value="'.$dept['dcode'].'">'.$dept['dept_name'].'</option>
                            ';
        }

        $data['dept_name'] = $dept_name;
        echo json_encode($data);
    }

    public function save_mop_access_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = 'success';
            $this->liquidation_model->save_mop_access_model($_POST['id'],$_POST['access']);

            echo json_encode($message);
        }
        // var_dump($_POST['id'],$_POST['access']);
    }

    public function get_cashier_name_ctrl()
    {
        $cashier_data = $this->liquidation_model->get_cashier_name_model($_POST['dcode']);

        $html='
                    <table class="table table-striped table-bordered table-hover display" id="cashier_name_table" style="color: black; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>
                                    <center style="padding-bottom: 7px;">CASHIER NAME
                                </th>
                                <th width="15%">
                                    <input style="width: 25px; margin-left: 15%; height: 25px;" type="checkbox" id="thcs_checkbox" />
                                </th>
                            </tr>
                        </thead>
                        <form name="cashier_name_viewing_form" id="cashier_name_viewing_form">
                            <tbody id="cashier_name_viewing_tbody">
                  ';

        foreach($cashier_data as $cashier)
        {
            $cashier_name =$this->liquidation_model->get_pisdata($cashier['emp_id']);

            $name = '';
            foreach($cashier_name as $cn)
            {
                $name = $cn['name'];
            }

            $html .='
                    <tr>
                        <td style="padding-top: 15px;">'.$name.'</td>
                        <td>
                            <input type="checkbox" class="cs_checkbox" style="width: 25px; height: 25px;" value="'.$cashier['emp_id'].','.$cashier['dcode'].'" />
                        </td>
                    </tr>
                    '; 
        }

          $html.='
                            </tbody>
                        </form>
                    </table>

                    <script>

                        $(".cs_checkbox").click(function(){
                            $("#thcs_checkbox").prop( "checked", false );
                            validate_access_js();
                        });

                        $(".cs_checkbox").change(function(){
                            if ($(".cs_checkbox:checked").length == $(".cs_checkbox").length) {
                               $("#thcs_checkbox").prop( "checked", true );
                            }
                        });

                        $("#thcs_checkbox").click(function(){
                            thcs_checked_js();
                            validate_access_js();
                        });

                    </script>
                    ';

        $data['html'] = $html;
        echo json_encode($data);
    }

    public function get_dept_mop_ctrl()
    {
        $dept_mop_data = $this->liquidation_model->get_dept_mop_model($_POST['dcode']);

        $html='
                    <table class="table table-striped table-bordered table-hover display" id="dept_mop_table" style="color: black; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>
                                    <center style="padding-bottom: 7px;">MODE OF PAYMENT
                                </th>
                                <th>
                                    <center style="padding-bottom: 7px;">TYPE
                                </th>
                                <th width="15%">
                                    <input style="width: 25px; margin-left: 15%; height: 25px;" type="checkbox" id="thmop_checkbox">
                                </th>
                            </tr>
                        </thead>
                        <form name="dept_mop_viewing_form" id="dept_mop_viewing_form">
                            <tbody id="dept_mop_viewing_tbody">
                  ';

        foreach($dept_mop_data as $mop)
        {
            $html .='
                    <tr>
                        <td style="padding-top: 15px;">'.$mop['mop'].'</td>
                        <td style="padding-top: 15px;">'.$mop['type'].'</td>
                        <td>
                            <input type="checkbox" class="mop_checkbox" style="width: 25px; height: 25px;" value="'.$mop['mop'].','.$mop['type'].'" />
                        </td>
                    </tr>
                    '; 
        }

          $html.='
                            </tbody>
                        </form>
                    </table>

                    <footer id="footer" style="margin-right: 5%;">
                      <div id="footer-content" style="float: right;">
                         <button type="button" id="set_as_default_btn" class="btn btn-warning waves-effect" onclick="set_cashier_access_js()">SET AS DEFAULT</button>
                         <button type="button" id="" class="btn btn-primary waves-effect" onclick="cancel_set_cashier_access_js()">CANCEL</button>
                      </div>
                    </footer><br><br><br>

                    <script>

                        $(".mop_checkbox").click(function(){
                            $("#thmop_checkbox").prop( "checked", false );
                            validate_access_js();
                        });

                        $(".mop_checkbox").change(function(){
                            if ($(".mop_checkbox:checked").length == $(".mop_checkbox").length) {
                               $("#thmop_checkbox").prop( "checked", true );
                            }
                        });

                        $("#thmop_checkbox").click(function(){
                            thmop_checked_js();
                            validate_access_js();
                        });

                    </script>
                    '; 

        $data['html'] = $html;
        echo json_encode($data);
    }

    public function scl_get_cashier_name_ctrl()
    {
        $emp_data = $this->liquidation_model->scl_get_cashier_name_model($_SESSION['emp_id'],$_POST['dcode']);
        
        $html='
                    <table class="table table-striped table-bordered table-hover display" id="scl_empname_table" style="color: black; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>
                                    <center style="padding-bottom: 7px;">EMPLOYEE NAME
                                </th>
                                <th width="15%">
                                    <input id="thscl_checkbox" style="width: 25px; margin-left: 15%; height: 25px;" type="checkbox">
                                </th>
                            </tr>
                        </thead>
                        <form name="scl_empname_viewing_form" id="scl_empname_viewing_form">
                            <tbody id="scl_empname_viewing_tbody">
                  ';

        foreach($emp_data as $emp)
        {
            $validate_emp = $this->liquidation_model->validate_emp_model($emp['empid']);

            if(empty($validate_emp))
            {
                $html .='
                <tr>
                    <td style="padding-top: 15px;">'.$emp['empname'].'</td>
                    <td>
                        <input type="checkbox" class="scl_checkbox" style="width: 25px; height: 25px;" value="'.$emp['empid'].','.$emp['no'].','.$emp['pins'].','.$emp['dcode'].'">
                    </td>
                </tr>
                '; 
            }
        }

          $html.='
                            </tbody>
                        </form>
                    </table>

                    <footer id="footer">
                      <div id="footer-content" style="float: right;">
                         <button type="button" id="" class="btn btn-warning waves-effect" onclick="add_login_access_js()">ADD ACCESS</button>
                         <button type="button" id="" class="btn btn-primary waves-effect" onclick="cancel_add_login_access_js()">CANCEL</button>
                      </div>
                    </footer><br><br><br>

                    <script>

                        $(".scl_checkbox").click(function(){
                            $("#thscl_checkbox").prop( "checked", false );
                        });

                        $(".scl_checkbox").change(function(){
                            if ($(".scl_checkbox:checked").length == $(".scl_checkbox").length) {
                            $("#thscl_checkbox").prop( "checked", true );
                            }
                        });

                        $("#thscl_checkbox").click(function(){
                            thscl_checked_js();
                        });
                        
                    </script>
                    '; 

        $data['html'] = $html;
        echo json_encode($data); 
    }

    public function add_login_access_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $liq_data = $this->liquidation_model->get_pisdata($_SESSION['emp_id']);
            $dcode = '';
            foreach($liq_data as $liq)
            {
                $dcode = $liq['company_code'].$liq['bunit_code'].$liq['dept_code'];
            }

            $query = $this->liquidation_model->validate_form($dcode);
            $route = '';
            if(empty($query))
            {
                $route = 'cashier_dashboard_route';
            }
            else
            {
                $route = 'cfscashier_dashboard_route';
            }
            
            $message = 'success';
            $this->liquidation_model->add_login_access_model($_POST['emp_id'],$_POST['emp_no'],$_POST['emp_pins'],$_POST['dcode'],$route);
            
            echo json_encode($message);
        }
    }

    public function scl_get_cashier_personnel_route()
    {
        $cashier_personnel = $this->liquidation_model->get_cashier_personnel_model($_POST['dcode']);
        
        $html='
                    <table class="table table-striped table-bordered table-hover display" id="dept_cashier_personnel_table" style="color: black; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>
                                    <center style="padding-bottom: 7px;">CASHIER NAME
                                </th>
                                <th width="15%">
                                    <input id="thscl2_checkbox" style="width: 25px; margin-left: 15%; height: 25px;" type="checkbox">
                                </th>
                            </tr>
                        </thead>
                        <form name="dept_cashier_personnel_viewing_form" id="dept_cashier_personnel_viewing_form">
                            <tbody id="dept_cashier_personnel_viewing_tbody">
                  ';

        $cashier_name = '';
        foreach($cashier_personnel as $cashier)
        {
            $cashier_name = $this->liquidation_model->get_pisdata($cashier['emp_id']);

            $name = '';
            foreach($cashier_name as $cname)
            {
                $name = $cname['name'];
            }

            $html .='
                    <tr>
                        <td style="padding-top: 15px;">'.$name.'</td>
                        <td>
                            <input type="checkbox" class="scl2_checkbox" style="width: 25px; height: 25px;" value="'.$cashier['id'].','.$cashier['emp_id'].'">
                        </td>
                    </tr>
                    '; 
        }

          $html.='
                            </tbody>
                        </form>
                    </table>

                    <footer id="footer" style="margin-right: 5%;">
                      <div id="footer-content" style="float: right;">
                         <button type="button" id="" class="btn btn-warning waves-effect" onclick="delete_access_js()">DELETE ACCESS</button>
                         <button type="button" id="" class="btn btn-primary waves-effect" onclick="cancel_add_login_access_js()">CANCEL</button>
                      </div>
                    </footer><br><br><br>   

                    <script>

                        $(".scl2_checkbox").click(function(){
                            $("#thscl2_checkbox").prop( "checked", false );
                        });

                        $(".scl2_checkbox").change(function(){
                            if ($(".scl2_checkbox:checked").length == $(".scl2_checkbox").length) {
                            $("#thscl2_checkbox").prop( "checked", true );
                            }
                        });

                        $("#thscl2_checkbox").click(function(){
                            thscl2_checked_js();
                        });
                        
                    </script>
                    '; 

        $data['html'] = $html;
        echo json_encode($data);
    }

    public function delete_access_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = 'success';
            $this->liquidation_model->delete_access_model($_POST['id'],$_POST['emp_id']);

            echo json_encode($message);
        }
    }

    public function set_cashier_access_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $mop_arr = $_POST['mop_arr'];

            $mop = '';
            for ($x=0; $x<count($mop_arr); $x++) {
                $mop = explode(",",$mop_arr[$x]);
                $this->liquidation_model->set_cashier_access_model($_POST['emp_id'],$_POST['dcode'],$mop[0],$mop[1]);
            }

            $message = 'success';
           
            echo json_encode($message);
        }
    }

    public function validate_access_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $mop_arr = $_POST['mop_arr'];
            $mop = '';
            $validated_access = '';
            $message = '';
            for ($x=0; $x<count($mop_arr); $x++) {
                $mop = explode(",",$mop_arr[$x]);
                $validated_access = $this->liquidation_model->validate_access_model($_POST['emp_id'],$_POST['dcode'],$mop[0],$mop[1]);
               
                if(!empty($validated_access))
                {
                    $val_name = '';
                    $val_mop = '';
                    $val_type = '';
                    foreach($validated_access as $val)
                    {
                        $val_empdata = $this->liquidation_model->get_pisdata($val['emp_id']);

                        foreach($val_empdata as $valemp)
                        {
                            $val_name = $valemp['name'];
                        }
                        $val_mop = $val['mop_name'];
                        $val_type = $val['mop_type'];
                    }
                    $data['name'] = $val_name;
                    $data['mop'] = $val_mop;
                    $data['type'] = $val_type;
                    $data['message'] = 'DUPLICATE ACCESS';
                    echo json_encode($data);
                    break;
                }
            }
        }
    }

    public function display_cashier_default_assignment_ctrl()
    {
        $cda_data  = $this->liquidation_model->get_cashier_default_assignment_model($_SESSION['emp_id'],$_POST['dcode']);
        // var_dump($cda_data);
        $str = "'";
        $html = '
        <table class="table table-striped table-bordered table-hover display" id="cashier_default_access_table" style="color: black; font-size: 12px;">
        <thead>
            <tr>
                <th>
                    <center>CASHIER'.$str.'S NAME
                </th>
                <th>
                    <center>MODE OF PAYMENT AND TYPE
                </th>
                <th>
                    <center>ACTION
                </th>
            </tr>
        </thead>
        <form name="cashier_default_access_viewing_form" id="cashier_default_access_viewing_form">
            <tbody id="cashier_default_access_viewing_tbody">
                ';

        foreach($cda_data as $cda)
        {
            $emp_data = $this->liquidation_model->get_pisdata($cda['empid']);

            $name = '';
            foreach($emp_data as $emp)
            {
                $name = $emp['name'];
            }

            $default_assignment = $this->liquidation_model->get_default_assignment_model($cda['empid']);

            $mop_name = '';
            foreach($default_assignment as $assignment)
            {
                // $mop_name .= $assignment['mop_name'].'&nbsp; - &nbsp;'.$assignment['mop_type'].'&nbsp; / &nbsp;';
                $mop_name .= $assignment['mop_name'].'&nbsp; - &nbsp;'.$assignment['mop_type'].'<br>';
            }
            // var_dump($mop_name);
            $html .='
                    <tr>
                        <td style="vertical-align: middle;">'.$name.'</td>
                        <td style="vertical-align: middle;">'.$mop_name.'</td>
                        <td style="vertical-align: middle;">
                            <button type="button" class="btn btn-primary waves-effect" onclick="view_cda_modal_js('."'".$cda['empid']."'".')" value="">VIEW 👁️</button>
                        </td>
                    </tr>
                    '; 
            //<td>'.rtrim($mop_name, "&nbsp; / &nbsp;").'</td>
        }

        $html.='
                        </tbody>
                    </form>
                </table> 
                ';
        
        $data['html'] = $html;
        echo json_encode($data);
    }

    public function display_cda_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $cda_data = $this->liquidation_model->get_cda_model($_POST['emp_id']);
            $emp_data = $this->liquidation_model->get_pisdata($_POST['emp_id']);

            $cda_name = '';
            foreach($emp_data as $emp)
            {
                $cda_name = $emp['name'];
            }
            // var_dump($cda_data);

            $html = '
                    <table class="table table-striped table-bordered table-hover display" id="cda_modal_table" style="color: black; font-size: 12px;">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle;">
                                <center>MODE OF PAYMENT
                            </th>
                            <th style="vertical-align: middle;">
                                <center>TYPE
                            </th>
                            <th width="15%">
                                <input style="width: 25px; height: 25px; margin-left: 15%" type="checkbox" id="th_cdamodal_checkbox" />
                            </th>
                        </tr>
                    </thead>
                    <form name="cda_modal_viewing_form" id="cda_modal_viewing_form">
                        <tbody id="cda_modal_viewing_tbody">
                    ';
            
            foreach($cda_data as $cda)
            {
                $html .='
                    <tr>
                        <td style="vertical-align: middle;">'.$cda['mop_name'].'</td>
                        <td style="vertical-align: middle;">'.$cda['mop_type'].'</td>
                        <td>
                            <input style="width: 25px; height: 25px;" type="checkbox" class="cdamodal_checkbox" value="'.$cda['emp_id'].','.$cda['dcode'].','.$cda['mop_name'].','.$cda['mop_type'].'" />
                        </td>
                    </tr>
                    '; 
            }
            
            
            $html.='
                        </tbody>
                    </form>
                </table> 

                <script>

                        $(".cdamodal_checkbox").click(function(){
                            $("#th_cdamodal_checkbox").prop( "checked", false );
                        });

                        $(".cdamodal_checkbox").change(function(){
                            if ($(".cdamodal_checkbox:checked").length == $(".cdamodal_checkbox").length) {
                            $("#th_cdamodal_checkbox").prop( "checked", true );
                            }
                        });

                        $("#th_cdamodal_checkbox").click(function(){
                            th_cdamodal_checked_js();
                        });
                        
                    </script>
                    ';
        
            $data['cda_name'] = $cda_name;
            $data['html'] = $html;
            echo json_encode($data);
        }
    }

    public function delete_cda_modal_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = 'success';
            $this->liquidation_model->delete_cda_modal_model($_POST['emp_id'],$_POST['dcode'],$_POST['mop'],$_POST['type']);

            echo json_encode($message);
        }
    }

    public function view_partial_details_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        { 
            $query=$this->liquidation_model->getpartialhistory_cashform_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
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
                            <label id="cash_borrow_lbl" style="font-weight: bold;">BORROWED</label>
                            <label id="section_lbl" style="font-weight: bold;">SECTION: '.$section_name.'</label>
                            <label id="sub_section_lbl" style="font-weight: bold;">SUB SECTION: '.$sub_section_name.'</label>
                        </center>
                    </form>

                    <form>
                        <center>
                            <label style="font-weight: bold;">'.$_POST['pos_name'].' - '.$q['counter_no'].'</label>
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

    public function cancel_borrowed_cashpending_modal_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $cashier_data = $this->liquidation_model->get_pisdata($_POST['cashier_id']);

            $scode = '';
            $sscode = '';
            foreach($cashier_data as $cashier)
            {
                $scode = $cashier['section_code'];
                $sscode = $cashier['sub_section_code'];
            }

            $message = 'success';
            $this->liquidation_model->cancel_borrowed_cashpending_model($_POST['cashier_id'],$scode,$sscode);
            $this->liquidation_model->cancel_borrowed_noncashpending_model($_POST['cashier_id'],$scode,$sscode);

            echo json_encode($message);
        }
    }

    public function cancel_borrowed_noncashpending_modal_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $cashier_data = $this->liquidation_model->get_pisdata($_POST['cashier_id']);

            $scode = '';
            $sscode = '';
            foreach($cashier_data as $cashier)
            {
                $scode = $cashier['section_code'];
                $sscode = $cashier['sub_section_code'];
            }

            $message = 'success';
            $this->liquidation_model->cancel_borrowed_noncashpending_model($_POST['cashier_id'],$scode,$sscode);
            $this->liquidation_model->cancel_borrowed_cashpending_model($_POST['cashier_id'],$scode,$sscode);

            echo json_encode($message);
        }
    }

    public function enable_cashier_edit_borrowed_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = 'success';
            $this->liquidation_model->enable_cashier_edit_borrowed_model($_POST['cashier_id']);

            echo json_encode($message);
        }
    }

    public function enable_edit_cash_pos_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = 'success';
            $this->liquidation_model->enable_edit_cash_pos_model($_POST['cashier_id']);

            echo json_encode($message);
        }
    }

    public function enable_cashier_edit_noncashborrowed_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = 'success';
            $this->liquidation_model->enable_cashier_edit_noncashborrowed_model($_POST['cashier_id']);

            echo json_encode($message);
        }
    }

    public function enable_edit_noncash_pos_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = 'success';
            $this->liquidation_model->enable_edit_noncash_pos_model($_POST['cashier_id']);

            echo json_encode($message);
        }
    }

    public function enable_add_mop_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        { 
            $message = 'success';
            $this->liquidation_model->enable_add_mop_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);

            echo json_encode($message);
        }
    }

    public function enable_cashier_edit_noncashden_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = 'success'; 
            $this->liquidation_model->enable_cashier_edit_noncashden_model($_POST['id'],$_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);

            echo json_encode($message);
        }
    }

    public function enable_cashier_edit_noncashden_checked_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = 'success';
            $this->liquidation_model->enable_cashier_edit_noncashden_checked_model($_POST['id'],$_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);

            echo json_encode($message);
        }
    }

    public function enable_cashier_edit_den_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {  
            $message = 'success';
            $this->liquidation_model->enable_cashier_edit_den_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed'],$_POST['edit_data']);

            echo json_encode($message);
        }
    }

    public function submit_cashierden_ctrl()
    { 
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {   
            $query = $this->liquidation_model->enable_submit_btn_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
            $confirmedcash_data = $this->liquidation_model->validate_confirm_code_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
            $cash_data = $this->liquidation_model->get_pendingdenomination_model_v3($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
            $noncash_data = $this->liquidation_model->validate_pending_noncash_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
            // ===========================================================================================================================================================
            $validate_cash_pending = $this->liquidation_model->validate_cash_pending_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
            $validate_noncash_pending = $this->liquidation_model->validate_noncash_pending_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
            if(!empty($validate_cash_pending))
            {
                $message = "PENDING CASH";
                echo json_encode($message);
            }
            else if(!empty($validate_noncash_pending))
            {
                $message = "PENDING NONCASH";
                echo json_encode($message);
            }
            else
            {
                // ===========================================================================================================================================================
                $validate_submit = $this->liquidation_model->validate_submit_denomination_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['sales_date']);
                if(empty($validate_submit))
                {
                    $confirmed_code = ''; 
                    if(!empty($confirmedcash_data))
                    {
                        foreach($confirmedcash_data as $confirmed)
                        {
                            $confirmed_code = $confirmed['company_code'].$confirmed['bunit_code'].$confirmed['dep_code'].$confirmed['section_code'].$confirmed['sub_section_code'];
                        }
                    }
                    // ===========================================================================================================================================================
                    $cash_code = '';
                    $cash_trno = '';
                    if(!empty($cash_data))
                    {
                        foreach($cash_data as $cash)
                        {
                            $cash_code = $cash['company_code'].$cash['bunit_code'].$cash['dep_code'].$cash['section_code'].$cash['sub_section_code'];
                            $cash_trno = $cash['tr_no'];
                        }
                    }
                    // ========================================================================================================================================================
                    $noncash_code = '';
                    $noncash_trno = '';
                    if(!empty($noncash_data))
                    {
                        foreach($noncash_data as $noncash)
                        {
                            $noncash_code = $noncash['company_code'].$noncash['bunit_code'].$noncash['dep_code'].$noncash['section_code'].$noncash['sub_section_code'];
                            $noncash_trno = $noncash['tr_no'];
                        }
                    }
                    // ===========================================================================================================================================================
                    $sal_no = '';
                    $emp_name = '';
                    $emp_type = '';
                    $company_code = '';
                    $bunit_code = '';
                    $dep_code = '';
                    $section_code = '';
                    $sub_section_code = '';
                    if(!empty($cash_data))
                    {
                        foreach($cash_data as $cash)
                        {
                            $sal_no = $cash['sal_no'];
                            $emp_name = $cash['emp_name'];
                            $emp_type = $cash['emp_type'];
                            $company_code = $cash['company_code'];
                            $bunit_code = $cash['bunit_code'];
                            $dep_code = $cash['dep_code'];
                            $section_code = $cash['section_code'];
                            $sub_section_code = $cash['sub_section_code'];
                        }
                    }
                    else
                    {
                        foreach($noncash_data as $noncash)
                        {
                            $sal_no = $noncash['sal_no'];
                            $emp_name = $noncash['emp_name'];
                            $emp_type = $noncash['emp_type'];
                            $company_code = $noncash['company_code'];
                            $bunit_code = $noncash['bunit_code'];
                            $dep_code = $noncash['dep_code'];
                            $section_code = $noncash['section_code'];
                            $sub_section_code = $noncash['sub_section_code'];
                        }
                    }
                    //=================================OLD DEDUCTION DATE CODE=============================================================================
                    // $deduction_date = '';
                    // if($_POST['sop_txt'] == 'SHORT')
                    // {
                    //     if($_POST['sop_no'] >= 10)
                    //     {
                    //         $cutoff_data = $this->liquidation_model->get_cutoff_model($company_code,$bunit_code);
                    //         $start_fc = 24;
                    //         $end_fc = 8;
                    //         $pay_day_fc = 15;
                    //         $pay_day_sc = 30;
                    //         foreach($cutoff_data as $cutoff)
                    //         {
                    //             $start_fc = $cutoff['startFC'];
                    //             $end_fc = $cutoff['endFC'];
                    //             $pay_day_fc = $cutoff['pDayFC'];
                    //             $pay_day_sc = $cutoff['pDaySC'];
                    //         }
                    //         // ========================================================================================================================
                    //         $year = date("Y");
                    //         $year2 = date("Y")+1;
                    //         $month = date("m");
                    //         $month2 = date("m")+1;
                    //         $day = date("d");
                    //         if($month2 > 12)
                    //         {
                    //             $year = $year2;
                    //             $month2 = 1;
                    //         }
                    //         if(!empty($cutoff_data))
                    //         {
                    //             if($pay_day_fc == 15)
                    //             {
                    //                 if($day >= $start_fc)
                    //                 {
                    //                     $deduction_date = $year.'-'.$month2.'-'.$pay_day_fc;
                    //                 }
                    //                 else if($day <= $end_fc)
                    //                 {
                    //                     $deduction_date = $year.'-'.$month.'-'.$pay_day_fc;
                    //                 }
                    //                 else
                    //                 {
                    //                     $deduction_date = $year.'-'.$month.'-'.$pay_day_sc;
                    //                 }
                    //             }
                    //             else
                    //             {
                    //                 if($day >= $start_fc && $day <= $end_fc)
                    //                 {
                    //                     $deduction_date = $year.'-'.$month.'-'.$pay_day_fc;
                    //                 }
                    //                 else
                    //                 {
                    //                     $deduction_date = $year.'-'.$month2.'-'.$pay_day_sc;
                    //                 }
                    //             }
                    //         }
                    //         else
                    //         {
                    //             if($day >= $start_fc)
                    //             {
                    //                 $deduction_date = $year.'-'.$month2.'-'.$pay_day_fc;
                    //             }
                    //             else if($day <= $end_fc)
                    //             {
                    //                 $deduction_date = $year.'-'.$month.'-'.$pay_day_fc;
                    //             }
                    //             else
                    //             {
                    //                 $deduction_date = $year.'-'.$month.'-'.$pay_day_sc;
                    //             }
                    //         }
                    //     }
                    // }


                    //======================================UPDATED DEDUCTION DATE CODE========================================================================

                    // $deduction_date = '';
                    // if($_POST['sop_txt'] == 'SHORT')
                    // {
                    //     if($_POST['sop_no'] >= 10)
                    //     {
                    //         $bcode = $company_code.$bunit_code;
                    //         $start_fc = 6;
                    //         $end_fc = 20;
                    //         $pay_day_fc = 0;
                    //         $pay_day_sc = 0;
                    //         if($bcode == '0201' || $bcode == '0301')
                    //         {
                    //             $pay_day_fc = 30;
                    //             $pay_day_sc = 15;
                    //         }
                    //         else if($bcode == '0203' || $bcode == '0223')
                    //         {
                    //             $pay_day_fc = 5;
                    //             $pay_day_sc = 20;
                    //         }
                    //         // ========================================================================================================================
                    //         $year = date("Y");
                    //         $year2 = date("Y")+1;
                    //         $month = date("m");
                    //         $month2 = date("m")+1;
                    //         $day = date("d");
                    //         $last_day = date("t");
                    //         if($month2 > 12)
                    //         {
                    //             $year = $year2;
                    //             $month2 = 1;
                    //         }
                    //         // ============================================================================
                    //         if($pay_day_fc == 30)
                    //         {
                    //             if($month == '02')
                    //             {
                    //                 $pay_day_fc = $last_day;
                    //             }
                    //             // ==========================================================================
                    //             if($day >= $start_fc && $day <= $end_fc)
                    //             {
                    //                 $deduction_date = $year.'-'.$month.'-'.$pay_day_fc;
                    //             }
                    //             else if($day < $start_fc)
                    //             {
                    //                 $deduction_date = $year.'-'.$month.'-'.$pay_day_sc;
                    //             }
                    //             else if($day > $end_fc)
                    //             {
                    //                 $deduction_date = $year.'-'.$month2.'-'.$pay_day_sc;
                    //             }
                    //         }
                    //         else
                    //         {
                    //             if($day >= $start_fc && $day <= $end_fc)
                    //             {
                    //                 $deduction_date = $year.'-'.$month2.'-'.$pay_day_fc;
                    //             }
                    //             else if($day < $start_fc)
                    //             {
                    //                 $deduction_date = $year.'-'.$month.'-'.$pay_day_sc;
                    //             }
                    //             else if($day > $end_fc)
                    //             {
                    //                 $deduction_date = $year.'-'.$month2.'-'.$pay_day_sc;
                    //             }
                    //         }
                    //     }
                    // }


// edited
                    $deduction_date = '';
                    if ($_POST['sop_txt'] == 'SHORT' && $_POST['sop_no'] >= 10) {
                        $bcode = $company_code . $bunit_code;
                        $start_fc = 6;
                        $end_fc = 20;
                        $pay_day_fc = 0;
                        $pay_day_sc = 0;

                        // Set pay day parameters based on bcode
                        if ($bcode == '0201' || $bcode == '0301') {
                            $pay_day_fc = 30;
                            $pay_day_sc = 15;
                        } else if ($bcode == '0203' || $bcode == '0223') {
                            $pay_day_fc = 5;
                            $pay_day_sc = 20;
                        }

                        $year = date("Y");
                        $month = date("m");
                        $day = date("d");
                        $last_day = date("t");

                        // Calculate deduction date based on pay_day_fc
                        if ($pay_day_fc == 30) {
                            if ($month == '02') {
                                $pay_day_fc = $last_day;
                            }

                            if ($day >= $start_fc && $day <= $end_fc) {
                                $deduction_date = $year . '-' . $month . '-' . $pay_day_fc;
                            } else if ($day < $start_fc) {
                                $deduction_date = $year . '-' . $month . '-' . $pay_day_sc;
                            } else if ($day > $end_fc) {
                                // Handle month change and update the year
                                $year = ($month == 12) ? $year + 1 : $year;
                                $next_month = ($month == 12) ? 1 : $month + 1;
                                $deduction_date = $year . '-' . sprintf('%02d', $next_month) . '-' . $pay_day_sc;
                            }
                        } else {
                            if ($day >= $start_fc && $day <= $end_fc) {
                                // Handle month change and update the year
                                $year = ($month == 12) ? $year + 1 : $year;
                                $next_month = ($month == 12) ? 1 : $month + 1;
                                $deduction_date = $year . '-' . sprintf('%02d', $next_month) . '-' . $pay_day_fc;
                            } else if ($day < $start_fc) {
                                $deduction_date = $year . '-' . $month . '-' . $pay_day_sc;
                            } else if ($day > $end_fc) {
                                // Handle month change and update the year
                                $year = ($month == 12) ? $year + 1 : $year;
                                $next_month = ($month == 12) ? 1 : $month + 1;
                                $deduction_date = $year . '-' . sprintf('%02d', $next_month) . '-' . $pay_day_sc;
                            }
                        }
                    }

                    //==============================================================================================================
                    $vms_cutoff_date = '';
                    if($_POST['sop_no'] >= 30)
                    {
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
                        $year = date("Y");
                        $year2 = date("Y") - 1;
                        $month = date("m");
                        $month2 = date("m")+1;
                        $day = date("d");
                        $last_day = date("t");
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
                        
                            // $day = $day * 1;
                            // if($day >= 24 || $day <= 8)
                            // {
                            //     if($month == '01')
                            //     {
                            //         $vms_cutoff_date = '12-'.'24'.'-'.$year2.' / '.$month.'-'.'8'.'-'.$year;
                            //     }
                            //     else
                            //     {
                            //         $month3 = $month2 * 1;
                            //         if($month3 < 10){
                            //             $month3 = '0'.$month3;
                            //         }
                            //         $vms_cutoff_date = $month.'-'.'24'.'-'.$year.' / '.$month3.'-'.'8'.'-'.$year;
                            //     }
                            // }
                            // else
                            // {
                            //     $vms_cutoff_date = $month.'-'.'9'.'-'.$year.' / '.$month.'-'.'23'.'-'.$year;
                            // }  
                            // $day = $day * 1;

                            // if ($day >= 24 || $day <= 8) {
                            //     if ($month == '01') {
                            //         $vms_cutoff_date = '12-'.'24'.'-'.  $year2 . ' / ' . sprintf("%02d", $month) . '-' . '8' . '-' . ($year + 1);
                            //     } else {
                                    
                            //         $month3 = $month2 * 1;
                            //         if ($month3 > 12) {
                            //             $month3 = 1;
                            //         }
                            //         $year3 = ($month == '12') ? ($year + 1 ) : $year;

                            //         $vms_cutoff_date = $month . '-' . '24' . '-' . $year . ' / ' . sprintf("%02d", $month3) . '-' . '8' . '-' . $year3;
                            //     }
                            // } else {
                            //     $vms_cutoff_date = $month . '-' . '9' . '-' . $year . ' / ' . $month . '-' . '23' . '-' . $year;
                            // }
                        
                        }
                    }
                
                    // =============================================================================================================
                    $message = '';
                    if(!empty($query))
                    {
                        $message = 'DISABLED';
                        echo json_encode($message);
                    }
                    else if($cash_code != '' && $noncash_code != '')
                    {
                        if($cash_code == $noncash_code)
                        {
                            $liq_trno = '';
                            if($cash_trno == '')
                            {
                                $liq_trno = $noncash_trno;
                            }
                            else
                            {
                                $liq_trno = $cash_trno;
                            }
                            
                            $data['message'] = 'MATCHED';
                            $this->liquidation_model->submit_cashierden_model(
                                $liq_trno,
                                $_POST['emp_id'],
                                $sal_no,
                                $emp_name,
                                $emp_type,
                                $company_code,
                                $bunit_code,
                                $dep_code,
                                $section_code,
                                $sub_section_code,
                                $_POST['sop_txt'],
                                $_POST['sop_no'],
                                $_POST['sales_date'],
                                $deduction_date,
                                $vms_cutoff_date);
                            
                            $data['trno'] = $liq_trno;
                            $data['cid'] = $_POST['emp_id'];
                            $data['ccode'] = $company_code;
                            $data['bcode'] = $bunit_code;
                            $data['dcode'] = $dep_code;
                            $data['scode'] = $section_code;
                            $data['sscode'] = $sub_section_code;
                            $data['gtotal'] = $_POST['gtotal'];
                            $data['rsales'] = $_POST['rsales'];
                            echo json_encode($data);
                        }
                        else
                        {
                            $message = 'MISMATCH';
                            echo json_encode($message);
                        }
                    }
                    else if($confirmed_code != '' && $cash_code != '')
                    {
                        if($confirmed_code == $cash_code)
                        {
                            $liq_trno = '';
                            if($cash_trno == '')
                            {
                                $liq_trno = $noncash_trno;
                            }
                            else
                            {
                                $liq_trno = $cash_trno;
                            }
                            
                            $data['message'] = 'MATCHED';
                            $this->liquidation_model->submit_cashierden_model(
                                $liq_trno,
                                $_POST['emp_id'],
                                $sal_no,
                                $emp_name,
                                $emp_type,
                                $company_code,
                                $bunit_code,
                                $dep_code,
                                $section_code,
                                $sub_section_code,
                                $_POST['sop_txt'],
                                $_POST['sop_no'],
                                $_POST['sales_date'],
                                $deduction_date,
                                $vms_cutoff_date);

                            $data['trno'] = $liq_trno;
                            $data['cid'] = $_POST['emp_id'];
                            $data['ccode'] = $company_code;
                            $data['bcode'] = $bunit_code;
                            $data['dcode'] = $dep_code;
                            $data['scode'] = $section_code;
                            $data['sscode'] = $sub_section_code;
                            $data['gtotal'] = $_POST['gtotal'];
                            $data['rsales'] = $_POST['rsales'];
                            echo json_encode($data);
                        }
                        else
                        {
                            $message = 'MISMATCH PARTIAL';
                            echo json_encode($message);
                        }
                    }
                    else
                    {
                        $liq_trno = '';
                        if($cash_trno == '')
                        {
                            $liq_trno = $noncash_trno;
                        }
                        else
                        {
                            $liq_trno = $cash_trno;
                        }
                        
                        $data['message'] = 'MATCHED';
                        $this->liquidation_model->submit_cashierden_model(
                            $liq_trno,
                            $_POST['emp_id'],
                            $sal_no,
                            $emp_name,
                            $emp_type,
                            $company_code,
                            $bunit_code,
                            $dep_code,
                            $section_code,
                            $sub_section_code,
                            $_POST['sop_txt'],
                            $_POST['sop_no'],
                            $_POST['sales_date'],
                            $deduction_date,
                            $vms_cutoff_date);
                        
                        $data['trno'] = $liq_trno;
                        $data['cid'] = $_POST['emp_id'];
                        $data['ccode'] = $company_code;
                        $data['bcode'] = $bunit_code;
                        $data['dcode'] = $dep_code;
                        $data['scode'] = $section_code;
                        $data['sscode'] = $sub_section_code;
                        $data['gtotal'] = $_POST['gtotal'];
                        $data['rsales'] = $_POST['rsales'];
                        echo json_encode($data);
                    }
                }
                else
                {
                    $message = 'ALREADY LIQUIDATE';
                    echo json_encode($message);
                }
            }
        }
    }

    public function submit_cashierden_zero_rs_ctrl()
    { 
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {   
            $query = $this->liquidation_model->enable_submit_btn_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
            $confirmedcash_data = $this->liquidation_model->validate_confirm_code_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
            $cash_data = $this->liquidation_model->get_pendingdenomination_model_v3($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
            $noncash_data = $this->liquidation_model->validate_pending_noncash_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
            // ===========================================================================================================================================================
            $validate_cash_pending = $this->liquidation_model->validate_cash_pending_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
            $validate_noncash_pending = $this->liquidation_model->validate_noncash_pending_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
            if(!empty($validate_cash_pending))
            {
                $message = "PENDING CASH";
                echo json_encode($message);
            }
            else if(!empty($validate_noncash_pending))
            {
                $message = "PENDING NONCASH";
                echo json_encode($message);
            }
            else
            {
                // ===========================================================================================================================================================
                $validate_submit = $this->liquidation_model->validate_submit_denomination_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['sales_date']);
                if(empty($validate_submit))
                {
                    $confirmed_code = ''; 
                    if(!empty($confirmedcash_data))
                    {
                        foreach($confirmedcash_data as $confirmed)
                        {
                            $confirmed_code = $confirmed['company_code'].$confirmed['bunit_code'].$confirmed['dep_code'].$confirmed['section_code'].$confirmed['sub_section_code'];
                        }
                    }
                    // ===========================================================================================================================================================
                    $cash_code = '';
                    $cash_trno = '';
                    if(!empty($cash_data))
                    {
                        foreach($cash_data as $cash)
                        {
                            $cash_code = $cash['company_code'].$cash['bunit_code'].$cash['dep_code'].$cash['section_code'].$cash['sub_section_code'];
                            $cash_trno = $cash['tr_no'];
                        }
                    }
                    // ========================================================================================================================================================
                    $noncash_code = '';
                    $noncash_trno = '';
                    if(!empty($noncash_data))
                    {
                        foreach($noncash_data as $noncash)
                        {
                            $noncash_code = $noncash['company_code'].$noncash['bunit_code'].$noncash['dep_code'].$noncash['section_code'].$noncash['sub_section_code'];
                            $noncash_trno = $noncash['tr_no'];
                        }
                    }
                    // ===========================================================================================================================================================
                    $sal_no = '';
                    $emp_name = '';
                    $emp_type = '';
                    $company_code = '';
                    $bunit_code = '';
                    $dep_code = '';
                    $section_code = '';
                    $sub_section_code = '';
                    if(!empty($cash_data))
                    {
                        foreach($cash_data as $cash)
                        {
                            $sal_no = $cash['sal_no'];
                            $emp_name = $cash['emp_name'];
                            $emp_type = $cash['emp_type'];
                            $company_code = $cash['company_code'];
                            $bunit_code = $cash['bunit_code'];
                            $dep_code = $cash['dep_code'];
                            $section_code = $cash['section_code'];
                            $sub_section_code = $cash['sub_section_code'];
                        }
                    }
                    else
                    {
                        foreach($noncash_data as $noncash)
                        {
                            $sal_no = $noncash['sal_no'];
                            $emp_name = $noncash['emp_name'];
                            $emp_type = $noncash['emp_type'];
                            $company_code = $noncash['company_code'];
                            $bunit_code = $noncash['bunit_code'];
                            $dep_code = $noncash['dep_code'];
                            $section_code = $noncash['section_code'];
                            $sub_section_code = $noncash['sub_section_code'];
                        }
                    }
                    //==============================================================================================================
                    $deduction_date = '';
                    $vms_cutoff_date = '';
                    if($_POST['sop_txt'] == 'SHORT')
                    {
                        if($_POST['sop_no'] >= 10)
                        {
                            $cutoff_data = $this->liquidation_model->get_cutoff_model($company_code,$bunit_code);
                            $start_fc = '';
                            $end_fc = '';
                            $pay_day_fc = '';
                            $pay_day_sc = '';
                            foreach($cutoff_data as $cutoff)
                            {
                                $start_fc = $cutoff['startFC'];
                                $end_fc = $cutoff['endFC'];
                                $pay_day_fc = $cutoff['pDayFC'];
                                $pay_day_sc = $cutoff['pDaySC'];
                            }
                            // ========================================================================================================================
                            $year = date("Y");
                            $month = date("m");
                            $month2 = date("m")+1;
                            $day = date("d");
                            if(!empty($cutoff_data))
                            {
                                if($pay_day_fc == 15)
                                {
                                    if($day >= $start_fc)
                                    {
                                        $deduction_date = $year.'-'.$month2.'-'.$pay_day_fc;
                                    }
                                    else if($day <= $end_fc)
                                    {
                                        $deduction_date = $year.'-'.$month.'-'.$pay_day_fc;
                                    }
                                    else
                                    {
                                        $deduction_date = $year.'-'.$month.'-'.$pay_day_sc;
                                    }
                                }
                                else
                                {
                                    if($day >= $start_fc && $day <= $end_fc)
                                    {
                                        $deduction_date = $year.'-'.$month.'-'.$pay_day_fc;
                                    }
                                    else
                                    {
                                        $deduction_date = $year.'-'.$month2.'-'.$pay_day_sc;
                                    }
                                }
                            }
                            else
                            {
                                if($day >= $start_fc)
                                {
                                    $deduction_date = $year.'-'.$month2.'-'.$pay_day_fc;
                                }
                                else if($day <= $end_fc)
                                {
                                    $deduction_date = $year.'-'.$month.'-'.$pay_day_fc;
                                }
                                else
                                {
                                    $deduction_date = $year.'-'.$month.'-'.$pay_day_sc;
                                }
                            }
                        }
                    }
                    //==============================================================================================================
                    $vms_cutoff_date = '';
                    if($_POST['sop_no'] >= 30)
                    {
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
                        $year = date("Y");
                        $month = date("m");
                        $month2 = date("m")+1;
                        $day = date("d");
                        $last_day = date("t");
                        if(!empty($cutoff_data))
                        {
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
                            if($day >= 24 || $day <= 8)
                            {
                                $vms_cutoff_date = $month.'-'.'24'.'-'.$year.' / '.$month.'-'.'8'.'-'.$year;
                            }
                            else
                            {
                                $vms_cutoff_date = $month.'-'.'9'.'-'.$year.' / '.$month.'-'.'23'.'-'.$year;
                            }
                        }
                    }
                    // =============================================================================================================
                    $no_vms_cutoff = '';
                    $message = '';
                    if(!empty($query))
                    {
                        $message = 'DISABLED';
                        echo json_encode($message);
                    }
                    else if($cash_code != '' && $noncash_code != '')
                    {
                        if($cash_code == $noncash_code)
                        {
                            $liq_trno = '';
                            if($cash_trno == '')
                            {
                                $liq_trno = $noncash_trno;
                            }
                            else
                            {
                                $liq_trno = $cash_trno;
                            }
                            
                            $data['message'] = 'MATCHED';
                            $this->liquidation_model->submit_cashierden_model(
                                $liq_trno,
                                $_POST['emp_id'],
                                $sal_no,
                                $emp_name,
                                $emp_type,
                                $company_code,
                                $bunit_code,
                                $dep_code,
                                $section_code,
                                $sub_section_code,
                                $_POST['sop_txt'],
                                $_POST['sop_no'],
                                $_POST['sales_date'],
                                $deduction_date,
                                $no_vms_cutoff);
                            
                            $data['trno'] = $liq_trno;
                            $data['cid'] = $_POST['emp_id'];
                            $data['ccode'] = $company_code;
                            $data['bcode'] = $bunit_code;
                            $data['dcode'] = $dep_code;
                            $data['scode'] = $section_code;
                            $data['sscode'] = $sub_section_code;
                            $data['gtotal'] = $_POST['gtotal'];
                            $data['rsales'] = $_POST['rsales'];
                            echo json_encode($data);
                        }
                        else
                        {
                            $message = 'MISMATCH';
                            echo json_encode($message);
                        }
                    }
                    else if($confirmed_code != '' && $cash_code != '')
                    {
                        if($confirmed_code == $cash_code)
                        {
                            $liq_trno = '';
                            if($cash_trno == '')
                            {
                                $liq_trno = $noncash_trno;
                            }
                            else
                            {
                                $liq_trno = $cash_trno;
                            }
                            
                            $data['message'] = 'MATCHED';
                            $this->liquidation_model->submit_cashierden_model(
                                $liq_trno,
                                $_POST['emp_id'],
                                $sal_no,
                                $emp_name,
                                $emp_type,
                                $company_code,
                                $bunit_code,
                                $dep_code,
                                $section_code,
                                $sub_section_code,
                                $_POST['sop_txt'],
                                $_POST['sop_no'],
                                $_POST['sales_date'],
                                $deduction_date,
                                $no_vms_cutoff);

                            $data['trno'] = $liq_trno;
                            $data['cid'] = $_POST['emp_id'];
                            $data['ccode'] = $company_code;
                            $data['bcode'] = $bunit_code;
                            $data['dcode'] = $dep_code;
                            $data['scode'] = $section_code;
                            $data['sscode'] = $sub_section_code;
                            $data['gtotal'] = $_POST['gtotal'];
                            $data['rsales'] = $_POST['rsales'];
                            echo json_encode($data);
                        }
                        else
                        {
                            $message = 'MISMATCH PARTIAL';
                            echo json_encode($message);
                        }
                    }
                    else
                    {
                        $liq_trno = '';
                        if($cash_trno == '')
                        {
                            $liq_trno = $noncash_trno;
                        }
                        else
                        {
                            $liq_trno = $cash_trno;
                        }
                        
                        $data['message'] = 'MATCHED';
                        $this->liquidation_model->submit_cashierden_model(
                            $liq_trno,
                            $_POST['emp_id'],
                            $sal_no,
                            $emp_name,
                            $emp_type,
                            $company_code,
                            $bunit_code,
                            $dep_code,
                            $section_code,
                            $sub_section_code,
                            $_POST['sop_txt'],
                            $_POST['sop_no'],
                            $_POST['sales_date'],
                            $deduction_date,
                            $no_vms_cutoff);
                        
                        $data['trno'] = $liq_trno;
                        $data['cid'] = $_POST['emp_id'];
                        $data['ccode'] = $company_code;
                        $data['bcode'] = $bunit_code;
                        $data['dcode'] = $dep_code;
                        $data['scode'] = $section_code;
                        $data['sscode'] = $sub_section_code;
                        $data['gtotal'] = $_POST['gtotal'];
                        $data['rsales'] = $_POST['rsales'];
                        echo json_encode($data);
                    }
                }
                else
                {
                    $message = 'ALREADY LIQUIDATE';
                    echo json_encode($message);
                }
            }
        }
    }

    public function insert_csdata_denomination_ctrl()
    {
        $get_id = $this->liquidation_model->get_csdata_id_model($_POST['trno']);
        $csdata_id = $get_id->id;
        
        $this->liquidation_model->submit_cashierden_model2(
            $_POST['trno'],
            $_POST['cid'],
            $csdata_id,
            $_POST['ccode'],
            $_POST['bcode'],
            $_POST['dcode'],
            $_POST['scode'],
            $_POST['sscode'],
            $_POST['gtotal'],
            $_POST['rsales'],
            $_POST['sales_date'],
            $_POST['discount'],
            $_POST['tr_count']
        );
        
        $message = 'success';
        $this->liquidation_model->update_cs_cashden_model($_POST['trno'],$_POST['cid'],$_POST['pos_name']);
        $this->liquidation_model->update_cs_noncashden_model($_POST['trno'],$_POST['cid'],$_POST['pos_name']);
        
        echo json_encode($message);
    }

    public function insert_csdata_denomination_zero_rs_ctrl()
    {
        $get_id = $this->liquidation_model->get_csdata_id_model($_POST['trno']);
        $csdata_id = $get_id->id;
        
        $this->liquidation_model->insert_csdata_denomination_zero_rs_model(
            $_POST['trno'],
            $_POST['cid'],
            $csdata_id,
            $_POST['ccode'],
            $_POST['bcode'],
            $_POST['dcode'],
            $_POST['scode'],
            $_POST['sscode'],
            $_POST['gtotal'],
            $_POST['rsales'],
            $_POST['sales_date'],
            $_POST['discount'],
            $_POST['tr_count'],
            $_POST['sup_id']
        );
        
        $message = 'success';
        $this->liquidation_model->update_cs_cashden_model($_POST['trno'],$_POST['cid'],$_POST['pos_name']);
        $this->liquidation_model->update_cs_noncashden_model($_POST['trno'],$_POST['cid'],$_POST['pos_name']);
        
        echo json_encode($message);
    }

    public function print_cashierden_ctrl()
    { 
        $lo_data = $this->liquidation_model->get_pisdata($_SESSION['emp_id']);
        $lo_incharge = '';
        foreach($lo_data as $lo)
        {
            $lo_incharge = $lo['name'];
        }
// ==========================================================================================================================================
        $cashier_data = $this->liquidation_model->get_pisdata($_POST['cashier_id']);
        $cashier_emp_no = '';
        foreach($cashier_data as $cd)
        {
            $cashier_emp_no = $cd['emp_no'];
        }
// ===========================================================================================================================================
        $noncash_den_data = $this->liquidation_model->get_noncash_den_model($_POST['trno'],$_POST['cashier_id']);
        $denomination_data = $this->liquidation_model->get_denomination_data_model($_POST['trno'],$_POST['cashier_id']);
        $qonek = '';
        $aonek = '';
        $qfiveh = '';
        $afiveh = '';
        $qtwoh = '';
        $atwoh = '';
        $qoneh = '';
        $aoneh = '';
        $qfifty = '';
        $afifty = '';
        $qtwenty = '';
        $atwenty = '';
        $qten = '';
        $aten = '';
        $qfive = '';
        $afive = '';
        $qone = '';
        $aone = '';
        $q25c = '';
        $a25c = '';
        $qtenc = '';
        $atenc = '';
        $qfivec = '';
        $afivec = '';
        $qonec = '';
        $aonec = '';
        foreach($denomination_data as $den)
        {
            $qonek = $den['1k'];
            $aonek = $den['1k']*1000;
            $qfiveh = $den['5h'];
            $afiveh = $den['5h']*500;
            $qtwoh = $den['2h'];
            $atwoh = $den['2h']*200;
            $qoneh = $den['1h'];
            $aoneh = $den['1h']*100;
            $qfifty = $den['5f'];
            $afifty = $den['5f']*50;
            $qtwenty = $den['2t'];
            $atwenty = $den['2t']*20;
            $qten = $den['ten'];
            $aten = $den['ten']*10;
            $qfive = $den['five'];
            $afive = $den['five']*5;
            $qone = $den['one'];
            $aone = $den['one']*1;
            $q25c = $den['25c'];
            $a25c = $den['25c']*.25;
            $qtenc = $den['10c'];
            $atenc = $den['10c']*.10;
            $qfivec = $den['5c'];
            $afivec = $den['5c']*.05;
            $qonec = $den['1c'];
            $aonec = $den['1c']*.01;
        }
// ===========================================================================================================================================

        $cebo_cs_data = $this->liquidation_model->get_cebo_cs_data_model($_POST['trno'],$_POST['cashier_id']);
        $cashier_name = '';
        $bcode = '';
        $dcode = '';
        $scode = '';
        $sscode = '';
        $date_time = '';
        $trno = '';
        $sop = '';
        $sop_type = '';
        $overall_total = '';
        $registered_sales = '';
        foreach($cebo_cs_data as $cebo)
        {
            $cashier_name = $cebo['cname'];
            $bcode = $cebo['bcode'];
            $dcode = $cebo['dcode'];
            $scode = $cebo['scode'];
            $sscode = $cebo['sscode'];
            $date_time = $cebo['dt'];
            $trno = $cebo['trno'];
            $sop = $cebo['sop'];
            $sop_type = $cebo['sop_type'];
            $overall_total = $cebo['gtotal'];
            $registered_sales = $cebo['rsales'];
        }

        // ===================================BUSINESS UNIT================================================================
        $bunit_name = '';
        $bunit_data = $this->liquidation_model->get_pisbunit_v2($bcode);
        if(!empty($bunit_data))
        {
            $bunit_name = $bunit_data->business_unit;
        }
        // ====================================DEPARTMENT===================================================================
        $dept_name = '';
        $dept_data = $this->liquidation_model->get_pisdepartment_v2($dcode);
        if(!empty($dept_data))
        {
            $dept_name = $dept_data->dept_name;
        }
        // ======================================SECTION NAME==================================================================
        $section_name = '';
        $section_data = $this->liquidation_model->get_section_v2($scode);
        if(!empty($section_data))
        {
            $section_name = $section_data->section_name;
        }
        // ========================================SUB SECTION NAME=============================================================
        $sub_section_name = '';
        $sub_section_data = $this->liquidation_model->get_subsection_v2($sscode);
        if(!empty($sub_section_data))
        {
            $sub_section_name = $sub_section_data->sub_section_name;
        }

        $sseparator = '';
        $ssseparator = '';
        if($section_name != '')
        {
            $sseparator = ' - ';
        }
        if($sub_section_name != '')
        {
            $ssseparator = ' - ';
        }
        $department = $dept_name.$sseparator.$section_name.$ssseparator.$sub_section_name;
// ===================================================================================================================================================

        $partial_cash = $this->liquidation_model->get_partial_cash_model($_POST['trno'],$_POST['cashier_id']);
        $partial = '0.00';
        if(!empty($partial_cash))
        {
            $partial = number_format($partial_cash, 2);
        }

        $final_cash = $this->liquidation_model->get_final_cash_model($_POST['trno'],$_POST['cashier_id']);
        $final = '0.00';
        if(!empty($final_cash))
        {
            $final = number_format($final_cash, 2);
        }
        $gt_cash = number_format($partial_cash+$final_cash, 2);

        $total_noncash = $this->liquidation_model->get_total_noncash_model($_POST['trno'],$_POST['cashier_id']);
        $tnoncash = '0.00';
        if(!empty($total_noncash))
        {
            $tnoncash = number_format($total_noncash, 2);
        }
// ======================================================================================================================================

        $this->ppdf = new TCPDF();
        $width = '71.5';
        $height = '500';
        $this->ppdf->SetTitle("Cashier Denomination Details");
        // $this->ppdf->SetMargins(15, 20, 10);
        $this->ppdf->setPrintHeader(false);
        $this->ppdf->SetFont('', '', 10, '', true); 
        $this->ppdf->SetMargins(2, 0, 0.5);
        // $this->ppdf->AddPage("P","A7");
        $this->ppdf->AddPage('', array($width, $height));
        // $this->ppdf->AddPage("L");
        $this->ppdf->SetAutoPageBreak(false);

        $border = 1;
        $th_style = 'style="text-align: center; font-weight: bold;"';
        $th_style2 = 'style="width: 50%; font-weight: bold;"';
        $th_style3 = 'style="width: 25%; font-weight: bold;"';
        $td_style = 'style="text-align: center;"';
        $td_style2 = 'style="text-align: rigth;"';
    // =======================================================================
        $border2 = 0;
        $thnb_style2 = 'style="text-align: center;';
        $tdnb_style = 'style="text-align: center;"';
        $tdnb_style2 = 'style="text-align: center; font-size: 8px;"';
        $tdnb_style3 = 'style="text-align: rigth;"';
        $tdnb_style4 = 'style="text-align: right; font-size: 9px;"';
        $tdnb_style5 = 'style="text-align: left; font-size: 8px;"';
        $tdnb_style6 = 'style="text-align: left; font-size: 9px;"';

        $tbl = '
                <p '.$tdnb_style2.'>
                    '.$bunit_name.'<br>
                    '.$department.'<br>
                    CASHIER\'S LIQUIDATION FORM<br>
                    DATE & TIME: '.$date_time.'<br>
                    STAFF NO: '.$cashier_emp_no.'<br>
                    CLS TRANS NO: '.$trno.'
                </p>

                <table border="'.$border.'" cellpadding="1">
                 <thead>           
                    <tr '.$th_style.'>
                        <th '.$th_style3.'>DEN.</th>
                        <th '.$th_style3.'>QTY.</th>
                        <th '.$th_style2.'>AMOUNT</th>                  
                    </tr>
                 </thead>
                 <tbody>
                    <tr>
                        <td width="25%" '.$td_style.'>1,000</td>
                        <td width="25%" '.$td_style.'>'.$qonek.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aonek, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>500</td>
                        <td width="25%" '.$td_style.'>'.$qfiveh.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($afiveh, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>200</td>
                        <td width="25%" '.$td_style.'>'.$qtwoh.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($atwoh, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>100</td>
                        <td width="25%" '.$td_style.'>'.$qoneh.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aoneh, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>50</td>
                        <td width="25%" '.$td_style.'>'.$qfifty.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($afifty, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>20</td>
                        <td width="25%" '.$td_style.'>'.$qtwenty.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($atwenty, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>10</td>
                        <td width="25%" '.$td_style.'>'.$qten.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aten, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>5</td>
                        <td width="25%" '.$td_style.'>'.$qfive.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($afive, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>1</td>
                        <td width="25%" '.$td_style.'>'.$qone.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aone, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>.25</td>
                        <td width="25%" '.$td_style.'>'.$q25c.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($a25c, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>.10</td>
                        <td width="25%" '.$td_style.'>'.$qtenc.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($atenc, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>.05</td>
                        <td width="25%" '.$td_style.'>'.$qfivec.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($afivec, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>.01</td>
                        <td width="25%" '.$td_style.'>'.$qonec.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aonec, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="50%" colspan="2" '.$tdnb_style2.'>TOTAL PARTIAL CASH</td>
                        <td width="50%" '.$td_style2.'>'.$partial.'</td>             
                    </tr>
                    <tr>
                        <td width="50%" colspan="2" '.$tdnb_style2.'>TOTAL FINAL CASH</td>
                        <td width="50%" '.$td_style2.'>'.$final.'</td>             
                    </tr>
                    <tr>
                        <td width="50%" colspan="2" '.$tdnb_style2.'>GRAND TOTAL CASH</td>
                        <td width="50%" '.$td_style2.'>'.$gt_cash.'</td>             
                    </tr>
                    <tr>
                        <td width="50%" '.$th_style.'>NONCASH PAY.</td>
                        <td width="18%" '.$th_style.'>QTY.</td>
                        <td width="32%" '.$th_style.'>AMT.</td>                  
                    </tr>
                ';
        
        foreach($noncash_den_data as $ncden)
        {
            $tbl .= '
                <tr>
                    <td width="50%" '.$tdnb_style2.'>'.$ncden['mop_name'].'</td>
                    <td width="18%" '.$td_style.'>'.$ncden['noncash_qty'].'</td>
                    <td width="32%" '.$tdnb_style3.'>'.number_format($ncden['noncash_amount'], 2).'</td>                  
                </tr>
                ';
        }

        if($sop_type == 'S')
        {
            $sop_type = 'SHORT';
        }
        else if($sop_type == 'O')
        {
            $sop_type = 'OVER';
        }
        else if($sop_type == 'PF')
        {
            $sop_type = 'PERFECT';
        }
        $lowercase_soptype = strtolower($sop_type);
        $tbl .= ' 
                        <tr>
                            <td width="50%" colspan="2" '.$tdnb_style2.'>TOTAL NONCASH</td>
                            <td width="50%" '.$td_style2.'>'.$tnoncash.'</td>             
                        </tr>
                        <tr>
                            <td width="50%" colspan="2" '.$tdnb_style2.'>GRAND TOTAL CASH & NONCASH</td>
                            <td width="50%" '.$td_style2.'>'.number_format($overall_total, 2).'</td>             
                        </tr>
                        <tr>
                            <td width="50%" colspan="2" '.$tdnb_style2.'>REGISTERED SALES</td>
                            <td width="50%" '.$td_style2.'>'.number_format($registered_sales, 2).'</td>             
                        </tr>
                        <tr>
                            <td width="50%" colspan="2" '.$tdnb_style2.'>'.$sop_type.'</td>
                            <td width="50%" '.$td_style2.'>'.number_format($sop, 2).'</td>             
                        </tr>
                    </tbody>
                </table><br><br><br></br>

                <table border="'.$border2.'" cellpadding="1">
                    <thead>           
                        <tr>
                            <th>Remitted by:</th>
                            <th>Confirmed by:</th>            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>_________________</td>
                            <td>_________________</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style2.'>'.$cashier_name.'<br>Cashier</td>
                            <td '.$tdnb_style2.'>'.$lo_incharge.'<br>COC Sup. / Liquidation Officer</td>                 
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>                 
                        </tr>
                        <tr>
                            <th colspan="2" '.$td_style.'>Received by:</th>               
                        </tr>
                        <tr>
                            <td colspan="2" '.$td_style.'>_________________</td>              
                        </tr>
                        <tr>
                            <td colspan="2" '.$tdnb_style2.'>Treasury Personnel<br>Signature over printed name</td>              
                        </tr>
                    </tbody>
                </table><br>

                <hr>
                <div>
                <table border="'.$border2.'" cellpadding="1">
                    <thead>           
                        <tr '.$th_style.'>
                            <th colspan="2">CLS Remittance Clearance</th>      
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td '.$tdnb_style4.'>Cashier\'s Code:</td>
                            <td '.$tdnb_style5.'>'.$cashier_emp_no.'</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style4.'>Name:</td>
                            <td '.$tdnb_style5.'>'.$cashier_name.'</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style4.'>Date & Time:</td>
                            <td '.$tdnb_style5.'>'.$date_time.'</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style4.'>'.ucfirst($lowercase_soptype).':</td>
                            <td '.$tdnb_style6.'>'.number_format($sop, 2).'</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style4.'>Cashier\'s Signature:</td>
                            <td '.$td_style2.'>________________</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style4.'>Inspected by:</td>
                            <td '.$td_style2.'>________________</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style4.'>Approved by:</td>
                            <td '.$td_style2.'>________________</td>                 
                        </tr>
                    </tbody>
                </table>
                </div>
                ';
  
        $this->ppdf->writeHTML($tbl, true, false, false, false, '');
        ob_end_clean();
        $this->ppdf->Output();  
    }

    public function print_submit_denomination_ctrl()
    { 
        $lo_data = $this->liquidation_model->get_pisdata($_SESSION['emp_id']);
        $lo_incharge = '';
        foreach($lo_data as $lo)
        {
            $lo_incharge = $lo['name'];
        }
        // ==========================================================================================================================================
        $cashier_data = $this->liquidation_model->get_pisdata($_POST['emp_id']);
        $cashier_emp_no = '';
        foreach($cashier_data as $cd)
        {
            $cashier_emp_no = $cd['emp_no'];
        }      
        // ===========================================================================================================================================
        $cash_counter_data = $this->liquidation_model->get_cash_final_counter_model($_POST['tr_no'],$_POST['emp_id'],$_POST['pos_name'],$_POST['date']);
        $print_counter = 0;
        if(count($cash_counter_data) > 0){
            $print_counter = $cash_counter_data->print_counter;
        }else{
            $noncash_counter_data = $this->liquidation_model->get_noncash_final_counter_model($_POST['tr_no'],$_POST['emp_id'],$_POST['pos_name'],$_POST['date']);
            if(count($noncash_counter_data) > 0){
                $print_counter = $noncash_counter_data->print_counter;
            }
        }
        $print_text = 'ORIGINAL COPY';
        $new_print_counter = 1;
        if($print_counter > 0){
            $new_print_counter = $print_counter + 1;
            $print_text = 'REPRINTED: '.$print_counter;
        }
        $this->liquidation_model->update_cash_final_counter_model($_POST['tr_no'],$_POST['emp_id'],$_POST['pos_name'],$_POST['date'],$new_print_counter);
        $this->liquidation_model->update_noncash_final_counter_model($_POST['tr_no'],$_POST['emp_id'],$_POST['pos_name'],$_POST['date'],$new_print_counter);
        // ===========================================================================================================================================
        $borrowed = '';
        if($_POST['borrowed'] == 'YES')
        {
            $borrowed = '- BORROWED';
        }
        $denomination_data = $this->liquidation_model->get_denomination_data_model_v2($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed'],$_POST['date']);
        $noncash_den_data = $this->liquidation_model->get_noncash_den_model_v2($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed'],$_POST['date']);
        // ===========================================================================================================================================
        $qonek = 0;
        $aonek = 0;
        $qfiveh = 0;
        $afiveh = 0;
        $qtwoh = 0;
        $atwoh = 0;
        $qoneh = 0;
        $aoneh = 0;
        $qfifty = 0;
        $afifty = 0;
        $qtwenty = 0;
        $atwenty = 0;
        $qten = 0;
        $aten = 0;
        $qfive = 0;
        $afive = 0;
        $qone = 0;
        $aone = 0;
        $q25c = 0;
        $a25c = 0;
        $qtenc = 0;
        $atenc = 0;
        $qfivec = 0;
        $afivec = 0;
        $qonec = 0;
        $aonec = 0;
        $counter_no = '';
        foreach($denomination_data as $den)
        {
            $qonek = $den['1k'];
            $aonek = $den['1k']*1000;
            $qfiveh = $den['5h'];
            $afiveh = $den['5h']*500;
            $qtwoh = $den['2h'];
            $atwoh = $den['2h']*200;
            $qoneh = $den['1h'];
            $aoneh = $den['1h']*100;
            $qfifty = $den['5f'];
            $afifty = $den['5f']*50;
            $qtwenty = $den['2t'];
            $atwenty = $den['2t']*20;
            $qten = $den['ten'];
            $aten = $den['ten']*10;
            $qfive = $den['five'];
            $afive = $den['five']*5;
            $qone = $den['one'];
            $aone = $den['one']*1;
            $q25c = $den['25c'];
            $a25c = $den['25c']*.25;
            $qtenc = $den['10c'];
            $atenc = $den['10c']*.10;
            $qfivec = $den['5c'];
            $afivec = $den['5c']*.05;
            $qonec = $den['1c'];
            $aonec = $den['1c']*.01;
            $counter_no = $den['counter_no'];
        }
// ===========================================================================================================================================
        if($counter_no == '')
        {
            foreach($noncash_den_data as $noncash)
            {
                $counter_no = $noncash['counter_no'];
            }
        }
// ===========================================================================================================================================
        $cebo_cs_data = $this->liquidation_model->get_cebo_cs_data_model_v2($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['date']);
        $cashier_name = '';
        $bcode = '';
        $dcode = '';
        $scode = '';
        $sscode = '';
        $sales_date = '';
        $date_time = '';
        $trno = '';
        $sop = 0;
        $sop_type = '';
        $overall_total = 0;
        $registered_sales = 0;
        $discount = 0;
        $tr_count = 0;
        foreach($cebo_cs_data as $cebo)
        {
            $cashier_name = $cebo['cname'];
            $bcode = $cebo['bcode'];
            $dcode = $cebo['dcode'];
            $scode = $cebo['scode'];
            $sscode = $cebo['sscode'];
            $sales_date = $cebo['date_shrt'];
            $date_time = $cebo['date_time'];
            $trno = $cebo['trno'];
            $sop = $cebo['sop'];
            $sop_type = $cebo['sop_type'];
            $overall_total = $cebo['gtotal'];
            $registered_sales = $cebo['rsales'];
            $discount = $cebo['discount'];
            $tr_count = $cebo['tr_count'];
        }
        // ===================================SHOW/HIDE WHOLESALE DISCOUNT================================================================
        // $wholesale_counter=$this->liquidation_model->wholesale_counter_model($dcode,$_POST['pos_name']);
        $hide_wholesale_discount = '';
        if($discount > 0)
        {
            $hide_wholesale_discount = '       
                                    <tr>
                                        <td width="50%" colspan="2" style="text-align: center; font-size: 8px;">WHOLESALE DISCOUNT</td>
                                        <td width="50%" style="text-align: rigth;">'.number_format($discount, 2).'</td>             
                                    </tr>
                                ';
        }
        // ===================================BUSINESS UNIT================================================================
        $bunit_name = '';
        $bunit_data = $this->liquidation_model->get_pisbunit_v2($bcode);
        if(!empty($bunit_data))
        {
            $bunit_name = $bunit_data->business_unit;
        }
        // ====================================DEPARTMENT===================================================================
        $dept_name = '';
        $dept_data = $this->liquidation_model->get_pisdepartment_v2($dcode);
        if(!empty($dept_data))
        {
            $dept_name = $dept_data->dept_name;
        }
        // ======================================SECTION NAME==================================================================
        $section_name = '';
        $section_data = $this->liquidation_model->get_section_v2($scode);
        if(!empty($section_data))
        {
            $section_name = $section_data->section_name;
        }
        // ========================================SUB SECTION NAME=============================================================
        $sub_section_name = '';
        $sub_section_data = $this->liquidation_model->get_subsection_v2($sscode);
        if(!empty($sub_section_data))
        {
            $sub_section_name = $sub_section_data->sub_section_name;
        }

        $sseparator = '';
        $ssseparator = '';
        if($section_name != '')
        {
            $sseparator = ' - ';
        }
        if($sub_section_name != '')
        {
            $ssseparator = ' - ';
        }
        $department = $dept_name.$sseparator.$section_name.$ssseparator.$sub_section_name;
// ===================================================================================================================================================
        $partial_cash = $this->liquidation_model->get_partial_cash_model_v2($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed'],$_POST['date']);
        $partial = '0.00';
        if(!empty($partial_cash))
        {
            $partial = number_format($partial_cash, 2);
        }

        $final_cash = $this->liquidation_model->get_final_cash_model_v2($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed'],$_POST['date']);
        $final = '0.00';
        if(!empty($final_cash))
        {
            $final = number_format($final_cash, 2);
        }
        $gt_cash = number_format($partial_cash+$final_cash, 2);

        $total_noncash = $this->liquidation_model->get_total_noncash_model_v2($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed'],$_POST['date']);
        $tnoncash = '0.00';
        if(!empty($total_noncash))
        {
            $tnoncash = number_format($total_noncash, 2);
        }
// ======================================================================================================================================
        $this->ppdf = new TCPDF();
        $width = '71.5';
        $height = '500';
        $this->ppdf->SetTitle("Cashier Denomination Details");
        // $this->ppdf->SetMargins(15, 20, 10);
        $this->ppdf->setPrintHeader(false);
        $this->ppdf->SetFont('', '', 10, '', true); 
        $this->ppdf->SetMargins(2, 0, 0.5);
        // $this->ppdf->AddPage("P","A7");
        $this->ppdf->AddPage('', array($width, $height));
        // $this->ppdf->AddPage("L");
        $this->ppdf->SetAutoPageBreak(false);

        $border = 1;
        $th_style = 'style="text-align: center; font-weight: bold;"';
        $th_style2 = 'style="width: 50%; font-weight: bold;"';
        $th_style3 = 'style="width: 25%; font-weight: bold;"';
        $td_style = 'style="text-align: center;"';
        $td_style2 = 'style="text-align: rigth;"';
    // =======================================================================
        $border2 = 0;
        $thnb_style2 = 'style="text-align: center;';
        $tdnb_style = 'style="text-align: center;"';
        $tdnb_style2 = 'style="text-align: center; font-size: 8px;"';
        $tdnb_style3 = 'style="text-align: rigth;"';
        $tdnb_style4 = 'style="text-align: right; font-size: 9px;"';
        $tdnb_style5 = 'style="text-align: left; font-size: 8px;"';
        $tdnb_style6 = 'style="text-align: left; font-size: 9px;"';
        $tdnb_style7 = 'style="text-align: right; font-size: 8px;"';

        $tbl = '<span '.$tdnb_style7.'>'.$print_text.'</span>
                <p '.$tdnb_style2.'>
                    '.$bunit_name.'<br>
                    CASHIER\'S LIQUIDATION FORM<br>
                    <span style="font-weight: bold">FINAL REMITTANCE '.$borrowed.'</span><br>
                    '.$department.'<br>
                    TERMINAL NO: '.$_POST['pos_name'].'<br>
                    COUNTER NO: '.$counter_no.'<br>
                    SALES DATE: '.$sales_date.'<br>
                    STAFF NO: '.$cashier_emp_no.'<br>
                    CLS TRANS NO: '.$trno.'
                </p>

                <table border="'.$border.'" cellpadding="1">
                 <thead>           
                    <tr '.$th_style.'>
                        <th '.$th_style3.'>DEN.</th>
                        <th '.$th_style3.'>QTY.</th>
                        <th '.$th_style2.'>AMOUNT</th>                  
                    </tr>
                 </thead>
                 <tbody>
                    <tr>
                        <td width="25%" '.$td_style.'>1,000</td>
                        <td width="25%" '.$td_style.'>'.number_format($qonek).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aonek, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>500</td>
                        <td width="25%" '.$td_style.'>'.number_format($qfiveh).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($afiveh, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>200</td>
                        <td width="25%" '.$td_style.'>'.number_format($qtwoh).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($atwoh, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>100</td>
                        <td width="25%" '.$td_style.'>'.number_format($qoneh).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aoneh, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>50</td>
                        <td width="25%" '.$td_style.'>'.number_format($qfifty).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($afifty, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>20</td>
                        <td width="25%" '.$td_style.'>'.number_format($qtwenty).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($atwenty, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>10</td>
                        <td width="25%" '.$td_style.'>'.number_format($qten).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aten, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>5</td>
                        <td width="25%" '.$td_style.'>'.number_format($qfive).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($afive, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>1</td>
                        <td width="25%" '.$td_style.'>'.number_format($qone).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aone, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>.25</td>
                        <td width="25%" '.$td_style.'>'.number_format($q25c).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($a25c, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>.10</td>
                        <td width="25%" '.$td_style.'>'.number_format($qtenc).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($atenc, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>.05</td>
                        <td width="25%" '.$td_style.'>'.number_format($qfivec).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($afivec, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>.01</td>
                        <td width="25%" '.$td_style.'>'.number_format($qonec).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aonec, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="50%" colspan="2" '.$tdnb_style2.'>TOTAL PARTIAL CASH</td>
                        <td width="50%" '.$td_style2.'>'.$partial.'</td>             
                    </tr>
                    <tr>
                        <td width="50%" colspan="2" '.$tdnb_style2.'>TOTAL FINAL CASH</td>
                        <td width="50%" '.$td_style2.'>'.$final.'</td>             
                    </tr>
                    <tr>
                        <td width="50%" colspan="2" '.$tdnb_style2.'>GRAND TOTAL CASH</td>
                        <td width="50%" '.$td_style2.'>'.$gt_cash.'</td>             
                    </tr>
                    <tr>
                        <td width="50%" '.$th_style.'>NONCASH PAY.</td>
                        <td width="18%" '.$th_style.'>QTY.</td>
                        <td width="32%" '.$th_style.'>AMT.</td>                  
                    </tr>
                ';
        
        foreach($noncash_den_data as $ncden)
        {
            $tbl .= '
                <tr>
                    <td width="50%" '.$tdnb_style2.'>'.$ncden['mop_name'].'</td>
                    <td width="18%" '.$td_style.'>'.$ncden['noncash_qty'].'</td>
                    <td width="32%" '.$tdnb_style3.'>'.number_format($ncden['noncash_amount'], 2).'</td>                  
                </tr>
                ';
        }

        if($sop_type == 'S')
        {
            $sop_type = 'SHORT';
        }
        else if($sop_type == 'O')
        {
            $sop_type = 'OVER';
        }
        else if($sop_type == 'PF')
        {
            $sop_type = 'PERFECT';
        }
        $lowercase_soptype = strtolower($sop_type);
        $tbl .= ' 
                        <tr>
                            <td width="50%" colspan="2" '.$tdnb_style2.'>TOTAL NONCASH</td>
                            <td width="50%" '.$td_style2.'>'.$tnoncash.'</td>             
                        </tr>
                        <tr>
                            <td width="50%" colspan="2" '.$tdnb_style2.'>CASHIER\'S TOTAL SALES REMITTANCE</td>
                            <td width="50%" '.$td_style2.'>'.number_format($overall_total, 2).'</td>             
                        </tr>
                        <tr>
                            <td width="50%" colspan="2" '.$tdnb_style2.'>CASHIER\'S REGISTERED SALES</td>
                            <td width="50%" '.$td_style2.'>'.number_format($registered_sales, 2).'</td>             
                        </tr>
                        '.$hide_wholesale_discount.'
                        <tr>
                            <td width="50%" colspan="2" '.$tdnb_style2.'>VARIANCE - '.$sop_type.'</td>
                            <td width="50%" '.$td_style2.'>'.number_format($sop, 2).'</td>             
                        </tr>
                        <tr>
                            <td width="50%" colspan="2" '.$tdnb_style2.'>TRANSACTION COUNT</td>
                            <td width="50%" '.$td_style2.'>'.number_format($tr_count).'</td>             
                        </tr>
                    </tbody>
                </table><br><br><br></br>

                <table border="'.$border2.'" cellpadding="1">
                    <thead>           
                        <tr>
                            <th>Remitted by:</th>
                            <th>Confirmed by:</th>            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>_________________</td>
                            <td>_________________</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style2.'>'.$cashier_name.'<br>Cashier</td>
                            <td '.$tdnb_style2.'>'.$lo_incharge.'<br>COC Sup. / Liquidation Officer</td>                 
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>                 
                        </tr>
                        <tr>
                            <th colspan="2" '.$td_style.'>Received by:</th>               
                        </tr>
                        <tr>
                            <td colspan="2" '.$td_style.'>_________________</td>              
                        </tr>
                        <tr>
                            <td colspan="2" '.$tdnb_style2.'>Treasury Personnel<br>Signature over printed name</td>              
                        </tr>
                    </tbody>
                </table><br>

                <hr>
                <div>
                <table border="'.$border2.'" cellpadding="1">
                    <thead>           
                        <tr '.$th_style.'>
                            <th colspan="2">CLS Remittance Clearance</th>      
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td '.$tdnb_style4.'>Cashier\'s Code:</td>
                            <td '.$tdnb_style5.'>'.$cashier_emp_no.'</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style4.'>Name:</td>
                            <td '.$tdnb_style5.'>'.$cashier_name.'</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style4.'>Date & Time:</td>
                            <td '.$tdnb_style5.'>'.$date_time.'</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style4.'>'.ucfirst($lowercase_soptype).':</td>
                            <td '.$tdnb_style6.'>'.number_format($sop, 2).'</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style4.'>Cashier\'s Signature:</td>
                            <td '.$td_style2.'>________________</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style4.'>Inspected by:</td>
                            <td '.$td_style2.'>________________</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style4.'>Approved by:</td>
                            <td '.$td_style2.'>________________</td>                 
                        </tr>
                    </tbody>
                </table>
                </div>
                ';
  
        $this->ppdf->writeHTML($tbl, true, false, false, false, '');
        ob_end_clean();
        $this->ppdf->Output();  
    }

    public function print_confirm_denomination_ctrl()
    { 
        $lo_data = $this->liquidation_model->get_pisdata($_SESSION['emp_id']);
        $lo_incharge = '';
        foreach($lo_data as $lo)
        {
            $lo_incharge = $lo['name'];
        }
// ==========================================================================================================================================
        $cashier_data = $this->liquidation_model->get_pisdata($_POST['emp_id']);
        $cashier_emp_no = '';
        foreach($cashier_data as $cd)
        {
            $cashier_emp_no = $cd['emp_no'];
        } 
// ===========================================================================================================================================
        $denomination_data = $this->liquidation_model->get_partial_denomination_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed']);
        $trno = '';
        $cashier_name = '';
        $bcode = '';
        $dcode = '';
        $scode = '';
        $sscode = $_POST['sscode'];
        $qonek = 0;
        $aonek = 0;
        $qfiveh = 0;
        $afiveh = 0;
        $qtwoh = 0;
        $atwoh = 0;
        $qoneh = 0;
        $aoneh = 0;
        $qfifty = 0;
        $afifty = 0;
        $qtwenty = 0;
        $atwenty = 0;
        $partial = 0;
        $counter_no = '';
        $sales_date = '';
        $date_time = '';
        foreach($denomination_data as $den)
        {
            $trno = $den['tr_no'];
            $cashier_name = $den['emp_name'];
            $bcode = $den['bcode'];
            $dcode = $den['dcode'];
            $scode = $den['scode'];
            $qonek = $den['1k'];
            $aonek = $den['1k']*1000;
            $qfiveh = $den['5h'];
            $afiveh = $den['5h']*500;
            $qtwoh = $den['2h'];
            $atwoh = $den['2h']*200;
            $qoneh = $den['1h'];
            $aoneh = $den['1h']*100;
            $qfifty = $den['5f'];
            $afifty = $den['5f']*50;
            $qtwenty = $den['2t'];
            $atwenty = $den['2t']*20;
            $partial = $den['total_cash'];
            $counter_no = $den['counter_no'];
            $sales_date = $den['sales_date'];
            $date_time = $den['date_submit'];
        }
        // ================================================================================================================
        $borrowed = '';
        if($_POST['borrowed'] == 'YES')
        {
            $borrowed = '- BORROWED';
        }
        // ===================================BUSINESS UNIT================================================================
        $bunit_name = '';
        $bunit_data = $this->liquidation_model->get_pisbunit_v2($bcode);
        if(!empty($bunit_data))
        {
            $bunit_name = $bunit_data->business_unit;
        }
        // ====================================DEPARTMENT===================================================================
        $dept_name = '';
        $dept_data = $this->liquidation_model->get_pisdepartment_v2($dcode);
        if(!empty($dept_data))
        {
            $dept_name = $dept_data->dept_name;
        }
        // ======================================SECTION NAME==================================================================
        $section_name = '';
        $section_data = $this->liquidation_model->get_section_v2($scode);
        if(!empty($section_data))
        {
            $section_name = $section_data->section_name;
        }
        // ========================================SUB SECTION NAME=============================================================
        $sub_section_name = '';
        $sub_section_data = $this->liquidation_model->get_subsection_v2($sscode);
        if(!empty($sub_section_data))
        {
            $sub_section_name = $sub_section_data->sub_section_name;
        }

        $sseparator = '';
        $ssseparator = '';
        if($section_name != '')
        {
            $sseparator = ' - ';
        }
        if($sub_section_name != '')
        {
            $ssseparator = ' - ';
        }
        $department = $dept_name.$sseparator.$section_name.$ssseparator.$sub_section_name;
// ======================================================================================================================================
        $this->ppdf = new TCPDF();
        $width = '71.5';
        $height = '200';
        $this->ppdf->SetTitle("Cashier Denomination Details");
        // $this->ppdf->SetMargins(15, 20, 10);
        $this->ppdf->setPrintHeader(false);
        $this->ppdf->SetFont('', '', 10, '', true); 
        $this->ppdf->SetMargins(2, 0, 0.5);
        // $this->ppdf->AddPage("P","A7");
        $this->ppdf->AddPage('', array($width, $height));
        // $this->ppdf->AddPage("L");
        $this->ppdf->SetAutoPageBreak(false);

        $border = 1;
        $th_style = 'style="text-align: center; font-weight: bold;"';
        $th_style2 = 'style="width: 50%; font-weight: bold;"';
        $th_style3 = 'style="width: 25%; font-weight: bold;"';
        $td_style = 'style="text-align: center;"';
        $td_style2 = 'style="text-align: rigth;"';
    // =======================================================================
        $border2 = 0;
        $thnb_style2 = 'style="text-align: center;';
        $tdnb_style = 'style="text-align: center;"';
        $tdnb_style2 = 'style="text-align: center; font-size: 8px;"';
        $tdnb_style3 = 'style="text-align: rigth;"';
        $tdnb_style4 = 'style="text-align: right; font-size: 9px;"';
        $tdnb_style5 = 'style="text-align: left; font-size: 8px;"';
        $tdnb_style6 = 'style="text-align: left; font-size: 9px;"';
        $tdnb_style7 = 'style="text-align: right; font-size: 8px;"';

        $tbl = '<span '.$tdnb_style7 .'>ORIGINAL COPY</span>
                <p '.$tdnb_style2.'>
                    '.$bunit_name.'<br>
                    CASHIER\'S LIQUIDATION FORM<br>
                    <span style="font-weight: bold">PARTIAL REMITTANCE '.$borrowed.'</span><br>
                    '.$department.'<br>
                    TERMINAL NO: '.$_POST['pos_name'].'<br>
                    COUNTER NO: '.$counter_no.'<br>
                    SALES DATE: '.$sales_date.'<br>
                    STAFF NO: '.$cashier_emp_no.'<br>
                    CLS TRANS NO: '.$trno.'
                </p>

                <table border="'.$border.'" cellpadding="1">
                 <thead>           
                    <tr '.$th_style.'>
                        <th '.$th_style3.'>DEN.</th>
                        <th '.$th_style3.'>QTY.</th>
                        <th '.$th_style2.'>AMOUNT</th>                  
                    </tr>
                 </thead>
                 <tbody>
                    <tr>
                        <td width="25%" '.$td_style.'>1,000</td>
                        <td width="25%" '.$td_style.'>'.number_format($qonek).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aonek, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>500</td>
                        <td width="25%" '.$td_style.'>'.number_format($qfiveh).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($afiveh, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>200</td>
                        <td width="25%" '.$td_style.'>'.number_format($qtwoh).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($atwoh, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>100</td>
                        <td width="25%" '.$td_style.'>'.number_format($qoneh).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aoneh, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>50</td>
                        <td width="25%" '.$td_style.'>'.number_format($qfifty).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($afifty, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>20</td>
                        <td width="25%" '.$td_style.'>'.number_format($qtwenty).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($atwenty, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="50%" colspan="2" '.$tdnb_style2.'>TOTAL PARTIAL CASH</td>
                        <td width="50%" '.$td_style2.'>'.number_format($partial, 2).'</td>             
                    </tr>
                ';
        $tbl .= ' 
                    </tbody>
                </table><br><br><br></br>

                <table border="'.$border2.'" cellpadding="1">
                    <thead>           
                        <tr>
                            <th>Remitted by:</th>
                            <th>Confirmed by:</th>            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>_________________</td>
                            <td>_________________</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style2.'>'.$cashier_name.'<br>Cashier</td>
                            <td '.$tdnb_style2.'>'.$lo_incharge.'<br>COC Sup. / Liquidation Officer</td>                 
                        </tr>
                    </tbody>
                </table><br>

                <hr>
                <div>
                    <table border="'.$border2.'" cellpadding="1">
                        <thead>           
                            <tr '.$th_style.'>
                                <th colspan="2">CLS Remittance Clearance</th>      
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td '.$tdnb_style4.'>Cashier\'s Code:</td>
                                <td '.$tdnb_style5.'>'.$cashier_emp_no.'</td>                 
                            </tr>
                            <tr>
                                <td '.$tdnb_style4.'>Name:</td>
                                <td '.$tdnb_style5.'>'.$cashier_name.'</td>                 
                            </tr>
                            <tr>
                                <td '.$tdnb_style4.'>Terminal No:</td>
                                <td '.$tdnb_style5.'>'.$_POST['pos_name'].'</td>                 
                            </tr>
                            <tr>
                                <td '.$tdnb_style4.'>Counter No:</td>
                                <td '.$tdnb_style5.'>'.$counter_no.'</td>                 
                            </tr>
                            <tr>
                                <td '.$tdnb_style4.'>Date & Time:</td>
                                <td '.$tdnb_style5.'>'.$date_time.'</td>                 
                            </tr>
                            <tr>
                                <td '.$tdnb_style4.'>Cashier\'s Signature:</td>
                                <td '.$td_style2.'>________________</td>                 
                            </tr>
                            <tr>
                                <td '.$tdnb_style4.'>Inspected by:</td>
                                <td '.$td_style2.'>________________</td>                 
                            </tr>
                            <tr>
                                <td '.$tdnb_style4.'>Approved by:</td>
                                <td '.$td_style2.'>________________</td>                 
                            </tr>
                        </tbody>
                    </table>
                </div>
                ';
  
        $this->ppdf->writeHTML($tbl, true, false, false, false, '');
        ob_end_clean();
        $this->ppdf->Output();  
    }

    public function print_liquidation_partial_cash_ctrl()
    { 
        $lo_data = $this->liquidation_model->get_pisdata($_SESSION['emp_id']);
        $lo_incharge = '';
        foreach($lo_data as $lo)
        {
            $lo_incharge = $lo['name'];
        }
        // ===========================================================================================================================================
        $id = explode(",", $_POST['id']); 
        $denomination_data = $this->liquidation_model->get_remitted_partial_denomination_model($id);
        $partial_amount_data = $this->liquidation_model->get_cashier_partial_amount_model($id);
        $bcode = '';
        $dcode = '';
        $qonek = 0;
        $aonek = 0;
        $qfiveh = 0;
        $afiveh = 0;
        $qtwoh = 0;
        $atwoh = 0;
        $qoneh = 0;
        $aoneh = 0;
        $qfifty = 0;
        $afifty = 0;
        $qtwenty = 0;
        $atwenty = 0;
        $qten = 0;
        $aten = 0;
        $qfive = 0;
        $afive = 0;
        $qone = 0;
        $aone = 0;
        $q25c = 0;
        $a25c = 0;
        $qtenc = 0;
        $atenc = 0;
        $qfivec = 0;
        $afivec = 0;
        $qonec = 0;
        $aonec = 0;
        $partial = 0;
        $batch_remit = 0;
        $print_counter = 0;
        $sales_date = '';
        $date_time = '';
        foreach($denomination_data as $den)
        {
            $bcode = $den['company_code'].$den['bunit_code'];
            $dcode = $den['company_code'].$den['bunit_code'].$den['dep_code'];
            $qonek += $den['1k'];
            $aonek += $den['1k']*1000;
            $qfiveh += $den['5h'];
            $afiveh += $den['5h']*500;
            $qtwoh += $den['2h'];
            $atwoh += $den['2h']*200;
            $qoneh += $den['1h'];
            $aoneh += $den['1h']*100;
            $qfifty += $den['5f'];
            $afifty += $den['5f']*50;
            $qtwenty += $den['2t'];
            $atwenty += $den['2t']*20;
            $qten += $den['ten'];
            $aten += $den['ten']*10;
            $qfive += $den['five'];
            $afive += $den['five']*5;
            $qone += $den['one'];
            $aone += $den['one']*1;
            $q25c += $den['25c'];
            $a25c += $den['25c']*.25;
            $qtenc += $den['10c'];
            $atenc += $den['10c']*.10;
            $qfivec += $den['5c'];
            $afivec += $den['5c']*.05;
            $qonec += $den['1c'];
            $aonec += $den['1c']*.01;
            $partial += $den['total_cash'];
            $batch_remit = $den['batch_remit'];
            $sales_date = $den['sales_date'];
            $date_time = $den['date_remitted'];
            $print_counter = $den['print_counter'];
        }
        // ======================================================BUSINESS UNIT================================================================
        $bunit_name = '';
        $bunit_data = $this->liquidation_model->get_pisbunit_v2($bcode);
        if(!empty($bunit_data))
        {
            $bunit_name = $bunit_data->business_unit;
        }
        // ====================================DEPARTMENT===================================================================
        $dept_name = '';
        $dept_data = $this->liquidation_model->get_pisdepartment_v2($dcode);
        if(!empty($dept_data))
        {
            $dept_name = $dept_data->dept_name;
        }
        // ====================================TOTAL TRANSACTION===================================================================
        $batch_trno = 0;
        foreach($partial_amount_data as $par)
        {
            $batch_trno += 1;
        }
        // ===============================================================================================================================
        $print_text = 'ORIGINAL COPY';
        $new_print_counter = 1;
        if($print_counter > 0){
            $new_print_counter = $print_counter + 1;
            $print_text = 'REPRINTED: '.$print_counter;
        }
        $this->liquidation_model->update_remitted_print_counter_model($id,$new_print_counter);
        // ======================================================================================================================================
        $this->ppdf = new TCPDF();
        $width = '71.5';
        $height = '600';
        $this->ppdf->SetTitle("Liquidation Partial Remittance");
        // $this->ppdf->SetMargins(15, 20, 10);
        $this->ppdf->setPrintHeader(false);
        $this->ppdf->SetFont('', '', 10, '', true); 
        $this->ppdf->SetMargins(2, 0, 0.5);
        // $this->ppdf->AddPage("P","A7");
        $this->ppdf->AddPage('', array($width, $height));
        // $this->ppdf->AddPage("L");
        $this->ppdf->SetAutoPageBreak(false);

        $border = 1;
        $th_style = 'style="text-align: center; font-weight: bold;"';
        $th_style2 = 'style="width: 50%; font-weight: bold;"';
        $th_style3 = 'style="width: 25%; font-weight: bold;"';
        $td_style = 'style="text-align: center;"';
        $td_style2 = 'style="text-align: rigth;"';
    // =======================================================================
        $border2 = 0;
        $thnb_style2 = 'style="text-align: center;';
        $tdnb_style = 'style="text-align: center;"';
        $tdnb_style2 = 'style="text-align: center; font-size: 8px;"';
        $tdnb_style3 = 'style="text-align: rigth;"';
        $tdnb_style4 = 'style="text-align: right; font-size: 9px;"';
        $tdnb_style5 = 'style="text-align: left; font-size: 8px;"';
        $tdnb_style6 = 'style="text-align: left; font-size: 9px;"';
        $tdnb_style7 = 'style="text-align: right; font-size: 8px;"';

        $tbl = '<span '.$tdnb_style7.'>'.$print_text.'</span>
                <p '.$tdnb_style2.'>
                    '.$bunit_name.'<br>
                    '.$dept_name.' - LIQUIDATION FORM<br>
                    <span style="font-weight: bold">BATCH '.$batch_remit.' - SUMMARY REPORT</span><br>
                    TOTAL NO. OF TRANSACTION: '.$batch_trno.'<br>
                    SALES DATE: '.$sales_date.'<br>
                    DATE/TIME REMITTED: '.$date_time.'
                </p>

                <table border="'.$border.'" cellpadding="1">
                 <thead>           
                    <tr '.$th_style.'>
                        <th '.$th_style3.'>DEN.</th>
                        <th '.$th_style3.'>QTY.</th>
                        <th '.$th_style2.'>AMOUNT</th>                  
                    </tr>
                 </thead>
                 <tbody>
                    <tr>
                        <td width="25%" '.$td_style.'>1,000</td>
                        <td width="25%" '.$td_style.'>'.$qonek.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aonek, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>500</td>
                        <td width="25%" '.$td_style.'>'.$qfiveh.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($afiveh, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>200</td>
                        <td width="25%" '.$td_style.'>'.$qtwoh.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($atwoh, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>100</td>
                        <td width="25%" '.$td_style.'>'.$qoneh.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aoneh, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>50</td>
                        <td width="25%" '.$td_style.'>'.$qfifty.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($afifty, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>20</td>
                        <td width="25%" '.$td_style.'>'.$qtwenty.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($atwenty, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>10</td>
                        <td width="25%" '.$td_style.'>'.$qten.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aten, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>5</td>
                        <td width="25%" '.$td_style.'>'.$qfive.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($afive, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>1</td>
                        <td width="25%" '.$td_style.'>'.$qone.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aone, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>.25</td>
                        <td width="25%" '.$td_style.'>'.$q25c.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($a25c, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>.10</td>
                        <td width="25%" '.$td_style.'>'.$qtenc.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($atenc, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>.05</td>
                        <td width="25%" '.$td_style.'>'.$qfivec.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($afivec, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>.01</td>
                        <td width="25%" '.$td_style.'>'.$qonec.'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aonec, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="50%" colspan="2" style="font-weight: bold; text-align: right;">TOTAL</td>
                        <td width="50%" style="font-weight: bold; text-align: right;">'.number_format($partial, 2).'</td>             
                    </tr>      
                    <tr '.$th_style.'>
                        <th width="60%">CASHIER\'S NAME</th>
                        <th width="10%" style="font-size: 6px; vertical-align: middle;">TYPE</th>
                        <th width="30%">AMOUNT</th>                  
                    </tr>
                ';
        // ===========================================================================================================================================
        $partial2 = 0;
        foreach($partial_amount_data as $par)
        {
            $partial2 += $par['total_cash'];
            $type = '';
            if($par['remit_type'] == 'PARTIAL')
            {
                $type = 'P';
            }
            else
            {
                $type = 'F';
            }
            // ===========================================================================================================================
            $tbl .= '   
                <tr>
                    <td style="font-size: 8px;">'.$par['emp_name'].'</td>
                    <td style="font-size: 8px; text-align: center">'.$type.'</td>
                    <td style="text-align: right; font-size: 8px;">'.number_format($par['total_cash'], 2).'</td>                  
                </tr>
            ';
        }
        // ===========================================================================================================================================
        $tbl .= ' 
                <tr>
                    <td width="50%" style="font-weight: bold; text-align: right;">TOTAL</td>
                    <td width="50%" style="font-weight: bold; text-align: right;">'.number_format($partial2, 2).'</td>             
                </tr> 
                </tbody>
            </table><br><br><br></br>

            <table border="'.$border2.'" cellpadding="1">
                <thead>           
                    <tr>
                        <th>Remitted by:</th>
                        <th>Received by:</th>            
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>_________________</td>
                        <td>_________________</td>                 
                    </tr>
                    <tr>
                        <td '.$tdnb_style2.'>'.$lo_incharge.'<br>COC Sup. / Liquidation Officer</td>
                        <td '.$tdnb_style2.'>Treasury<br>Signature Over Printed Name</td>                 
                    </tr>
                </tbody>
            </table>
            ';
  
        $this->ppdf->writeHTML($tbl, true, false, false, false, '');
        ob_end_clean();
        $this->ppdf->Output();  
    }

    public function validate_end_of_day_report_ctrl()
    {
        $remitted_batch_data = $this->liquidation_model->get_remitted_batch_model($_POST['dcode'],$_POST['date']);
        $pending_cash_data = $this->liquidation_model->get_pending_cash_data_model($_POST['dcode'],$_POST['date']);
        $pending_noncash_data = $this->liquidation_model->get_pending_noncash_data_model($_POST['dcode'],$_POST['date']);
        $message = '';
        if(empty($remitted_batch_data))
        {
            $message = 'NO DATA';
        }
        else if(!empty($pending_cash_data))
        {
            $message = 'PENDING CASH';
        }
        else if(!empty($pending_noncash_data))
        {
            $message = 'PENDING NONCASH';
        }
        else
        {
            $message = 'READY TO PRINT';
        }

        echo json_encode($message);
    }

    public function print_end_of_day_report_ctrl()
    { 
        $lo_data = $this->liquidation_model->get_pisdata($_SESSION['emp_id']);
        $lo_incharge = '';
        foreach($lo_data as $lo)
        {
            $lo_incharge = $lo['name'];
        }
        // ================================================================================================================
        $remitted_batch_data = $this->liquidation_model->get_remitted_batch_model($_POST['dcode'],$_POST['date']);
        $wholesale_counter_data = $this->liquidation_model->get_wholesale_counter_model($_POST['dcode']);
        $wholesale_array = array();
        foreach($wholesale_counter_data as $counter)
        {
            array_push($wholesale_array,$counter['pos_name']);
        }
        // ================================================================================================================
        $snackbar_counter_data = $this->liquidation_model->get_snackbar_counter_model($_POST['dcode']);
        $snackbar_array = array();
        foreach($snackbar_counter_data as $counter)
        {
            array_push($snackbar_array, $counter['pos_name']);
        }
        // ================================================================================================================
        if(!empty($remitted_batch_data))
        {
            $qonek = 0;
            $aonek = 0;
            $qfiveh = 0;
            $afiveh = 0;
            $qtwoh = 0;
            $atwoh = 0;
            $qoneh = 0;
            $aoneh = 0;
            $qfifty = 0;
            $afifty = 0;
            $qtwenty = 0;
            $atwenty = 0;
            $qten = 0;
            $aten = 0;
            $qfive = 0;
            $afive = 0;
            $qone = 0;
            $aone = 0;
            $q25c = 0;
            $a25c = 0;
            $qtenc = 0;
            $atenc = 0;
            $qfivec = 0;
            $afivec = 0;
            $qonec = 0;
            $aonec = 0;
            $total_cash = 0;
            $sales_date = '';
            $date_time = '';
            $cash_id = array(); 
            $batch_remit = array();
            $wholesale_info = array();
            $snackbar_info = array();
            foreach($remitted_batch_data as $remitted)
            {
                $qonek += $remitted['1k'];
                $aonek += $remitted['1k']*1000;
                $qfiveh += $remitted['5h'];
                $afiveh += $remitted['5h']*500;
                $qtwoh += $remitted['2h'];
                $atwoh += $remitted['2h']*200;
                $qoneh += $remitted['1h'];
                $aoneh += $remitted['1h']*100;
                $qfifty += $remitted['5f'];
                $afifty += $remitted['5f']*50;
                $qtwenty += $remitted['2t'];
                $atwenty += $remitted['2t']*20;
                $qten += $remitted['ten'];
                $aten += $remitted['ten']*10;
                $qfive += $remitted['five'];
                $afive += $remitted['five']*5;
                $qone += $remitted['one'];
                $aone += $remitted['one']*1;
                $q25c += $remitted['25c'];
                $a25c += $remitted['25c']*.25;
                $qtenc += $remitted['10c'];
                $atenc += $remitted['10c']*.10;
                $qfivec += $remitted['5c'];
                $afivec += $remitted['5c']*.05;
                $qonec += $remitted['1c'];
                $aonec += $remitted['1c']*.01;
                $total_cash += $remitted['total_cash'];
                $sales_date = $remitted['sales_date'];
                $date_time = $remitted['date_remitted'];
                // ==============================================================
                if(!in_array($remitted['cash_id'],$cash_id))
                {
                    array_push($cash_id,$remitted['cash_id']);        
                }
                // ==============================================================
                if(!in_array($remitted['batch_remit'],$batch_remit))
                {
                    array_push($batch_remit,$remitted['batch_remit']);        
                }
                // ==============================================================
                if(in_array($remitted['pos_name'],$wholesale_array))
                {
                    if(!in_array($remitted['tr_no'].'|'.$remitted['emp_id'],$wholesale_info))
                    {      
                        array_push($wholesale_info,$remitted['tr_no'].'|'.$remitted['emp_id']);        
                    }
                }
                // ==============================================================
                if(in_array($remitted['pos_name'],$snackbar_array))
                {
                    if(!in_array($remitted['tr_no'].'|'.$remitted['emp_id'],$snackbar_info))
                    {      
                        array_push($snackbar_info,$remitted['tr_no'].'|'.$remitted['emp_id']);        
                    }
                }
            }
            // ======================================================BUSINESS UNIT================================================================
            $bunit_name = '';
            $bunit_data = $this->liquidation_model->get_pisbunit_v2($_POST['bcode']);
            if(!empty($bunit_data))
            {
                $bunit_name = $bunit_data->business_unit;
            }
            // ====================================DEPARTMENT===================================================================
            $dept_name = '';
            $dept_data = $this->liquidation_model->get_pisdepartment_v2($_POST['dcode']);
            if(!empty($dept_data))
            {
                $dept_name = $dept_data->dept_name;
            }
            // ====================================CASHIER DATA===================================================================
            $final_data = $this->liquidation_model->get_final_amount_model($_POST['dcode'],$_POST['date']);

            // ====================================TOTAL SHORTAGE===================================================================
            $shortage_data = $this->liquidation_model->get_total_shortage_model($_POST['dcode'],$_POST['date']);
            $total_shortage = 0;
            if(!empty($shortage_data))
            {
                $total_shortage = $shortage_data->short;
            }

            // ====================================TOTAL OVERAGE===================================================================
            $overage_data = $this->liquidation_model->get_total_overage_model($_POST['dcode'],$_POST['date']);
            $total_overage = 0;
            if(!empty($overage_data))
            {
                $total_overage = $overage_data->over;
            }

            // ====================================TOTAL WHOLESALE REMITTANCE===================================================================
            $total_wholesale = 0;
            for($i=0; $i<count($wholesale_info); $i++) 
            {
                $trno_id = explode('|',$wholesale_info[$i]);
                $wholesale_data = $this->liquidation_model->get_total_wholesale_model($trno_id[0],$trno_id[1],$_POST['dcode'],$_POST['date']);
                if(!empty($wholesale_data))
                {
                    $total_wholesale += $wholesale_data->total_denomination;
                }
            }

            // ====================================TOTAL SNACK BAR REMITTANCE===================================================================
            $total_snackbar = 0;
            for($i=0; $i<count($snackbar_info); $i++) 
            {
                $trno_id = explode('|',$snackbar_info[$i]);
                $snackbar_data = $this->liquidation_model->get_total_wholesale_model($trno_id[0],$trno_id[1],$_POST['dcode'],$_POST['date']);
                if(!empty($snackbar_data))
                {
                    $total_snackbar += $snackbar_data->total_denomination;
                }
            }

            // ====================================TOTAL REGISTERED SALES===================================================================
            $registered_sales_data = $this->liquidation_model->get_registered_sales_model($_POST['dcode'],$_POST['date']);
            $wholesale_discount = 0;
            $registered_sales_overage = 0;
            $eod_total_sales = 0;
            if(!empty($registered_sales_data))
            {
                $wholesale_discount = $registered_sales_data->discount;
                $registered_sales_overage = $registered_sales_data->total;
                $eod_total_sales = $registered_sales_data->total_sales;
            }

            // ======================================NONCASH DATA===================================================================
            $noncash_data = $this->liquidation_model->get_noncash_data_model($_POST['dcode'],$_POST['date']);

            // ====================================TOTAL TRANSACTION===================================================================
            $batch_trno = 0;
            foreach($final_data as $cashier)
            {
                $batch_trno += 1;
            }
            // ======================================================================================================================
            $counter_data = $this->liquidation_model->get_eod_print_counter_model($_POST['dcode'],$_POST['date']);
            $print_counter = 0;
            if(count($counter_data) > 0){
                $print_counter = $counter_data->print_counter;
            }
            $print_text = 'ORIGINAL COPY';
            $new_print_counter = 1;
            if($print_counter > 0){
                $new_print_counter = $print_counter + 1;
                $print_text = 'REPRINTED: '.$print_counter;
            }
            $this->liquidation_model->update_eod_print_counter_model($_POST['dcode'],$_POST['date'],$new_print_counter);
            // ======================================================================================================================================
            $this->ppdf = new TCPDF();
            $width = '71.5';
            $height = '900';
            $this->ppdf->SetTitle("End Of Day Summary Report");
            // $this->ppdf->SetMargins(15, 20, 10);
            $this->ppdf->setPrintHeader(false);
            $this->ppdf->SetFont('', '', 10, '', true); 
            $this->ppdf->SetMargins(2, 0, 0.5);
            // $this->ppdf->AddPage("P","A7");
            $this->ppdf->AddPage('', array($width, $height));
            // $this->ppdf->AddPage("L");
            $this->ppdf->SetAutoPageBreak(false);
    
            $border = 1;
            $th_style = 'style="text-align: center; font-weight: bold;"';
            $th_style2 = 'style="width: 50%; font-weight: bold;"';
            $th_style3 = 'style="width: 25%; font-weight: bold;"';
            $td_style = 'style="text-align: center;"';
            $td_style2 = 'style="text-align: rigth;"';
        // =======================================================================
            $border2 = 0;
            $thnb_style2 = 'style="text-align: center;';
            $tdnb_style = 'style="text-align: center;"';
            $tdnb_style2 = 'style="text-align: center; font-size: 8px;"';
            $tdnb_style3 = 'style="text-align: rigth;"';
            $tdnb_style4 = 'style="text-align: right; font-size: 9px;"';
            $tdnb_style5 = 'style="text-align: left; font-size: 8px;"';
            $tdnb_style6 = 'style="text-align: left; font-size: 9px;"';
            $tdnb_style7 = 'style="text-align: right; font-size: 8px;"';
    
            $tbl = '<span '.$tdnb_style7.'>'.$print_text.'</span>
                    <p '.$tdnb_style2.'>
                        '.$bunit_name.'<br>
                        '.$dept_name.' - LIQUIDATION FORM<br>
                        <span style="font-weight: bold">END OF DAY SUMMARY REPORT</span><br>
                        TOTAL TRANSACTION: '.$batch_trno.'<br>
                        SALES DATE: '.$sales_date.'
                    </p>
    
                    <table border="'.$border.'" cellpadding="1">
                     <thead>           
                        <tr '.$th_style.'>
                            <th '.$th_style3.'>DEN.</th>
                            <th '.$th_style3.'>QTY.</th>
                            <th '.$th_style2.'>AMOUNT</th>                  
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                            <td width="25%" '.$td_style.'>1,000</td>
                            <td width="25%" '.$td_style.'>'.$qonek.'</td>
                            <td width="50%" '.$td_style2.'>'.number_format($aonek, 2).'</td>                  
                        </tr>
                        <tr>
                            <td width="25%" '.$td_style.'>500</td>
                            <td width="25%" '.$td_style.'>'.$qfiveh.'</td>
                            <td width="50%" '.$td_style2.'>'.number_format($afiveh, 2).'</td>                  
                        </tr>
                        <tr>
                            <td width="25%" '.$td_style.'>200</td>
                            <td width="25%" '.$td_style.'>'.$qtwoh.'</td>
                            <td width="50%" '.$td_style2.'>'.number_format($atwoh, 2).'</td>                  
                        </tr>
                        <tr>
                            <td width="25%" '.$td_style.'>100</td>
                            <td width="25%" '.$td_style.'>'.$qoneh.'</td>
                            <td width="50%" '.$td_style2.'>'.number_format($aoneh, 2).'</td>                  
                        </tr>
                        <tr>
                            <td width="25%" '.$td_style.'>50</td>
                            <td width="25%" '.$td_style.'>'.$qfifty.'</td>
                            <td width="50%" '.$td_style2.'>'.number_format($afifty, 2).'</td>                  
                        </tr>
                        <tr>
                            <td width="25%" '.$td_style.'>20</td>
                            <td width="25%" '.$td_style.'>'.$qtwenty.'</td>
                            <td width="50%" '.$td_style2.'>'.number_format($atwenty, 2).'</td>                  
                        </tr>
                        <tr>
                            <td width="25%" '.$td_style.'>10</td>
                            <td width="25%" '.$td_style.'>'.$qten.'</td>
                            <td width="50%" '.$td_style2.'>'.number_format($aten, 2).'</td>                  
                        </tr>
                        <tr>
                            <td width="25%" '.$td_style.'>5</td>
                            <td width="25%" '.$td_style.'>'.$qfive.'</td>
                            <td width="50%" '.$td_style2.'>'.number_format($afive, 2).'</td>                  
                        </tr>
                        <tr>
                            <td width="25%" '.$td_style.'>1</td>
                            <td width="25%" '.$td_style.'>'.$qone.'</td>
                            <td width="50%" '.$td_style2.'>'.number_format($aone, 2).'</td>                  
                        </tr>
                        <tr>
                            <td width="25%" '.$td_style.'>.25</td>
                            <td width="25%" '.$td_style.'>'.$q25c.'</td>
                            <td width="50%" '.$td_style2.'>'.number_format($a25c, 2).'</td>                  
                        </tr>
                        <tr>
                            <td width="25%" '.$td_style.'>.10</td>
                            <td width="25%" '.$td_style.'>'.$qtenc.'</td>
                            <td width="50%" '.$td_style2.'>'.number_format($atenc, 2).'</td>                  
                        </tr>
                        <tr>
                            <td width="25%" '.$td_style.'>.05</td>
                            <td width="25%" '.$td_style.'>'.$qfivec.'</td>
                            <td width="50%" '.$td_style2.'>'.number_format($afivec, 2).'</td>                  
                        </tr>
                        <tr>
                            <td width="25%" '.$td_style.'>.01</td>
                            <td width="25%" '.$td_style.'>'.$qonec.'</td>
                            <td width="50%" '.$td_style2.'>'.number_format($aonec, 2).'</td>                  
                        </tr>
                        <tr>
                            <td width="50%" colspan="2" style="font-weight: bold; text-align: center;">CASH TOTAL</td>
                            <td width="50%" style="font-weight: bold; text-align: right;">'.number_format($total_cash, 2).'</td>             
                        </tr>      
                        <tr '.$th_style.'>
                            <th width="50%">BATCH</th>
                            <th width="50%">AMOUNT</th>                  
                        </tr>
                    ';
            // ==================================================BATCH DATA=====================================================================
            $batch_total = 0;
            for($x =0; $x<count($batch_remit); $x++) 
            {
                $batch_amount_data = $this->liquidation_model->get_batch_amount_model($cash_id,$batch_remit[$x]);
                foreach($batch_amount_data as $batch)
                {
                    $batch_total += $batch['total_cash'];
                    $tbl .= '   
                        <tr>
                            <td style="font-size: 8px; text-align: center;">BATCH '.$batch['batch_remit'].'</td>
                            <td style="text-align: right; font-size: 8px;">'.number_format($batch['total_cash'], 2).'</td>                  
                        </tr>
                    ';
                }
            }
            $tbl .= ' 
                    <tr>
                        <td width="50%" style="font-weight: bold; text-align: center;">BATCH TOTAL</td>
                        <td width="50%" style="font-weight: bold; text-align: right;">'.number_format($batch_total, 2).'</td>             
                    </tr> 
                    ';
            // ==================================================NONCASH DATA=====================================================================
            $tbl .= '
                    <tr '.$th_style.'>
                        <th width="50%">NONCASH PAY.</th>
                        <th width="50%">AMOUNT</th>                  
                    </tr>
                    ';
            $noncash_total = 0;
            $cash_ncash_total = 0;
            $grand_total = 0;
            foreach($noncash_data as $noncash)
            {
                $noncash_total += $noncash['amount'];
                $tbl .= '   
                    <tr>
                        <td style="font-size: 8px; text-align: center;">'.$noncash['mop_name'].'</td>
                        <td style="text-align: right;">'.number_format($noncash['amount'], 2).'</td>                  
                    </tr>
                ';
            }
            // =============================GRAND TOTAL=========================================
            $cash_ncash_total = $total_cash + $noncash_total;
            $grand_total = bcsub($cash_ncash_total, $total_wholesale, 4);
            $grand_total = bcsub($grand_total, $total_snackbar, 4);
            // =========================GRAND TOTAL SALES REMITTANCE============================
            $gtotal_sales_remittance = $eod_total_sales + $wholesale_discount;
            // ==============================TOTAL VARIANCE=====================================
            $total_variance = 0;
            $total_variance = bcsub($gtotal_sales_remittance, $registered_sales_overage, 4);
            // =================================================================================
            $wholesale_discount_html = '';
            if($wholesale_discount > 0)
            {
                $wholesale_discount_html = '
                    <tr>
                        <td width="50%" style="font-weight: bold; text-align: center; font-size: 6px;">TOTAL WHOLESALE DISCOUNT</td>
                        <td width="50%" style="font-weight: bold; text-align: right;">'.number_format($wholesale_discount, 2).'</td>             
                    </tr> 
                ';
            }
            // =================================================================================
            $snackbar_html = '';
            if($total_snackbar > 0)
            {
                $snackbar_html = '
                    <tr>
                        <td width="50%" style="font-weight: bold; text-align: center; font-size: 6px;">TOTAL SNACK BAR REMITTANCE</td>
                        <td width="50%" style="font-weight: bold; text-align: right;">'.number_format($total_snackbar, 2).'</td>             
                    </tr> 
                ';
            }
            // =================================================================================
            $tbl .= ' 
                    <tr>
                        <td width="50%" style="font-weight: bold; text-align: center;">NONCASH TOTAL</td>
                        <td width="50%" style="font-weight: bold; text-align: right;">'.number_format($noncash_total, 2).'</td>             
                    </tr> 
                    <tr>
                        <td width="50%" style="font-weight: bold; text-align: center; font-size: 6px;">TOTAL SALES REMITTANCE</td>
                        <td width="50%" style="font-weight: bold; text-align: right;">'.number_format($grand_total, 2).'</td>             
                    </tr> 
                    <tr>
                        <td width="50%" style="font-weight: bold; text-align: center; font-size: 6px;">TOTAL WHOLESALE REMITTANCE</td>
                        <td width="50%" style="font-weight: bold; text-align: right;">'.number_format($total_wholesale, 2).'</td>             
                    </tr> 
                    '.$wholesale_discount_html.'
                    '.$snackbar_html.'
                    <tr>
                        <td width="50%" style="font-weight: bold; text-align: center; font-size: 6px;">GRAND TOTAL SALES REMITTANCE</td>
                        <td width="50%" style="font-weight: bold; text-align: right;">'.number_format($gtotal_sales_remittance, 2).'</td>             
                    </tr> 
                    <tr>
                        <td width="50%" style="font-weight: bold; text-align: center; font-size: 6px;">TOTAL REGISTERED SALES</td>
                        <td width="50%" style="font-weight: bold; text-align: right;">'.number_format($registered_sales_overage, 2).'</td>             
                    </tr> 
                    <tr>
                        <td width="50%" style="font-weight: bold; text-align: center; font-size: 8px;">TOTAL VARIANCE</td>
                        <td width="50%" style="font-weight: bold; text-align: right;">'.number_format($total_variance, 2).'</td>             
                    </tr> 
                    <tr>
                        <td width="50%" style="font-weight: bold; text-align: center; font-size: 8px;">TOTAL SHORTAGE</td>
                        <td width="50%" style="font-weight: bold; text-align: right;">'.number_format($total_shortage, 2).'</td>             
                    </tr> 
                    <tr>
                        <td width="50%" style="font-weight: bold; text-align: center; font-size: 8px;">TOTAL OVERAGE</td>
                        <td width="50%" style="font-weight: bold; text-align: right;">'.number_format($total_overage, 2).'</td>             
                    </tr> 
                    ';
            // ================================================CASHIER'S DATA====================================================================
            $tbl .= '
                    <tr '.$th_style.'>
                        <th width="70%">CASHIER\'S NAME</th>
                        <th width="30%">AMOUNT</th>                  
                    </tr>
                    ';
            $cashier_amount = 0;
            foreach($final_data as $cashier)
            {
                $cashier_amount += $cashier['amount'];
                $tbl .= '   
                    <tr>
                        <td style="font-size: 8px;">'.$cashier['emp_name'].'</td>
                        <td style="text-align: right; font-size: 8px;">'.number_format($cashier['amount'], 2).'</td>                  
                    </tr>
                ';
            }
            $cashier_amount = $cashier_amount + $wholesale_discount;
            // ===========================================================================================================================================
            $tbl .= ' 
                    <tr>
                        <td width="50%" style="font-weight: bold; text-align: center;">CASHIER\'S TOTAL</td>
                        <td width="50%" style="font-weight: bold; text-align: right;">'.number_format($cashier_amount, 2).'</td>             
                    </tr> 
                    </tbody>
                </table><br><br><br></br>
    
                <table border="'.$border2.'" cellpadding="1">
                    <thead>           
                        <tr>
                            <th>Prepared by:</th>
                            <th>Received by:</th>            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>_________________</td>
                            <td>_________________</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style2.'>'.$lo_incharge.'<br>COC Sup. / Liquidation Officer</td>
                            <td '.$tdnb_style2.'>Treasury<br>Signature Over Printed Name</td>                 
                        </tr>
                    </tbody>
                </table>
                ';
      
            $this->ppdf->writeHTML($tbl, true, false, false, false, '');
            ob_end_clean();
            $this->ppdf->Output();  
        }
        else
        {
            $message = "
                        <center>
                            <h1 style='margin-top: 10%; font-size: 100px;'>
                                NO DATA 
                            </h1>
                        </center>
                        ";
            echo $message;
        }
    }

    public function print_cashier_partial_denomination_ctrl()
    { 
        $lo_data = $this->liquidation_model->get_pisdata($_SESSION['emp_id']);
        $lo_incharge = '';
        foreach($lo_data as $lo)
        {
            $lo_incharge = $lo['name'];
        }
// ==========================================================================================================================================
        $cashier_data = $this->liquidation_model->get_pisdata($_POST['emp_id']);
        $cashier_emp_no = '';
        foreach($cashier_data as $cd)
        {
            $cashier_emp_no = $cd['emp_no'];
        } 
// ===========================================================================================================================================
        $counter_data = $this->liquidation_model->get_partial_counter_model($_POST['id']);
        $print_no = $counter_data->print_counter + 1;
        $this->liquidation_model->update_partial_counter_model($_POST['id'],$print_no);
// ===========================================================================================================================================
        $denomination_data = $this->liquidation_model->get_cashier_partial_denomination_model($_POST['id'],$_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['borrowed'],$_POST['date']);
        $trno = '';
        $cashier_name = '';
        $bcode = '';
        $dcode = '';
        $scode = '';
        $sscode = $_POST['sscode'];
        $qonek = 0;
        $aonek = 0;
        $qfiveh = 0;
        $afiveh = 0;
        $qtwoh = 0;
        $atwoh = 0;
        $qoneh = 0;
        $aoneh = 0;
        $qfifty = 0;
        $afifty = 0;
        $qtwenty = 0;
        $atwenty = 0;
        $partial = 0;
        $counter_no = '';
        $sales_date = '';
        $date_time = '';
        foreach($denomination_data as $den)
        {
            $trno = $den['tr_no'];
            $cashier_name = $den['emp_name'];
            $bcode = $den['bcode'];
            $dcode = $den['dcode'];
            $scode = $den['scode'];
            $qonek = $den['1k'];
            $aonek = $den['1k']*1000;
            $qfiveh = $den['5h'];
            $afiveh = $den['5h']*500;
            $qtwoh = $den['2h'];
            $atwoh = $den['2h']*200;
            $qoneh = $den['1h'];
            $aoneh = $den['1h']*100;
            $qfifty = $den['5f'];
            $afifty = $den['5f']*50;
            $qtwenty = $den['2t'];
            $atwenty = $den['2t']*20;
            $partial = $den['total_cash'];
            $counter_no = $den['counter_no'];
            $sales_date = $den['sales_date'];
            $date_time = $den['date_submit'];
        }
        // ================================================================================================================
        $borrowed = '';
        if($_POST['borrowed'] == 'YES')
        {
            $borrowed = '- BORROWED';
        }
        // ===================================BUSINESS UNIT================================================================
        $bunit_name = '';
        $bunit_data = $this->liquidation_model->get_pisbunit_v2($bcode);
        if(!empty($bunit_data))
        {
            $bunit_name = $bunit_data->business_unit;
        }
        // ====================================DEPARTMENT===================================================================
        $dept_name = '';
        $dept_data = $this->liquidation_model->get_pisdepartment_v2($dcode);
        if(!empty($dept_data))
        {
            $dept_name = $dept_data->dept_name;
        }
        // ======================================SECTION NAME==================================================================
        $section_name = '';
        $section_data = $this->liquidation_model->get_section_v2($scode);
        if(!empty($section_data))
        {
            $section_name = $section_data->section_name;
        }
        // ========================================SUB SECTION NAME=============================================================
        $sub_section_name = '';
        $sub_section_data = $this->liquidation_model->get_subsection_v2($sscode);
        if(!empty($sub_section_data))
        {
            $sub_section_name = $sub_section_data->sub_section_name;
        }

        $sseparator = '';
        $ssseparator = '';
        if($section_name != '')
        {
            $sseparator = ' - ';
        }
        if($sub_section_name != '')
        {
            $ssseparator = ' - ';
        }
        $department = $dept_name.$sseparator.$section_name.$ssseparator.$sub_section_name;
// ======================================================================================================================================
        $this->ppdf = new TCPDF();
        $width = '71.5';
        $height = '200';
        $this->ppdf->SetTitle("Cashier Denomination Details");
        // $this->ppdf->SetMargins(15, 20, 10);
        $this->ppdf->setPrintHeader(false);
        $this->ppdf->SetFont('', '', 10, '', true); 
        $this->ppdf->SetMargins(2, 0, 0.5);
        // $this->ppdf->AddPage("P","A7");
        $this->ppdf->AddPage('', array($width, $height));
        // $this->ppdf->AddPage("L");
        $this->ppdf->SetAutoPageBreak(false);

        $border = 1;
        $th_style = 'style="text-align: center; font-weight: bold;"';
        $th_style2 = 'style="width: 50%; font-weight: bold;"';
        $th_style3 = 'style="width: 25%; font-weight: bold;"';
        $td_style = 'style="text-align: center;"';
        $td_style2 = 'style="text-align: rigth;"';
    // =======================================================================
        $border2 = 0;
        $thnb_style2 = 'style="text-align: center;';
        $tdnb_style = 'style="text-align: center;"';
        $tdnb_style2 = 'style="text-align: center; font-size: 8px;"';
        $tdnb_style3 = 'style="text-align: rigth;"';
        $tdnb_style4 = 'style="text-align: right; font-size: 9px;"';
        $tdnb_style5 = 'style="text-align: left; font-size: 8px;"';
        $tdnb_style6 = 'style="text-align: left; font-size: 9px;"';
        $tdnb_style7 = 'style="text-align: right; font-size: 8px;"';

        $tbl = '<span '.$tdnb_style7.'>REPRINTED: '.$print_no.'</span>
                <p '.$tdnb_style2.'>
                    '.$bunit_name.'<br>
                    CASHIER\'S LIQUIDATION FORM<br>
                    <span style="font-weight: bold">PARTIAL REMITTANCE '.$borrowed.'</span><br>
                    '.$department.'<br>
                    TERMINAL NO: '.$_POST['pos_name'].'<br>
                    COUNTER NO: '.$counter_no.'<br>
                    SALES DATE: '.$sales_date.'<br>
                    STAFF NO: '.$cashier_emp_no.'<br>
                    CLS TRANS NO: '.$trno.'
                </p>

                <table border="'.$border.'" cellpadding="1">
                 <thead>           
                    <tr '.$th_style.'>
                        <th '.$th_style3.'>DEN.</th>
                        <th '.$th_style3.'>QTY.</th>
                        <th '.$th_style2.'>AMOUNT</th>                  
                    </tr>
                 </thead>
                 <tbody>
                    <tr>
                        <td width="25%" '.$td_style.'>1,000</td>
                        <td width="25%" '.$td_style.'>'.number_format($qonek).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aonek, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>500</td>
                        <td width="25%" '.$td_style.'>'.number_format($qfiveh).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($afiveh, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>200</td>
                        <td width="25%" '.$td_style.'>'.number_format($qtwoh).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($atwoh, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>100</td>
                        <td width="25%" '.$td_style.'>'.number_format($qoneh).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($aoneh, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>50</td>
                        <td width="25%" '.$td_style.'>'.number_format($qfifty).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($afifty, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="25%" '.$td_style.'>20</td>
                        <td width="25%" '.$td_style.'>'.number_format($qtwenty).'</td>
                        <td width="50%" '.$td_style2.'>'.number_format($atwenty, 2).'</td>                  
                    </tr>
                    <tr>
                        <td width="50%" colspan="2" '.$tdnb_style2.'>TOTAL PARTIAL CASH</td>
                        <td width="50%" '.$td_style2.'>'.number_format($partial, 2).'</td>             
                    </tr>
                ';
        $tbl .= ' 
                    </tbody>
                </table><br><br><br></br>

                <table border="'.$border2.'" cellpadding="1">
                    <thead>           
                        <tr>
                            <th>Remitted by:</th>
                            <th>Confirmed by:</th>            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>_________________</td>
                            <td>_________________</td>                 
                        </tr>
                        <tr>
                            <td '.$tdnb_style2.'>'.$cashier_name.'<br>Cashier</td>
                            <td '.$tdnb_style2.'>'.$lo_incharge.'<br>COC Sup. / Liquidation Officer</td>                 
                        </tr>
                    </tbody>
                </table><br>

                <hr>
                <div>
                    <table border="'.$border2.'" cellpadding="1">
                        <thead>           
                            <tr '.$th_style.'>
                                <th colspan="2">CLS Remittance Clearance</th>      
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td '.$tdnb_style4.'>Cashier\'s Code:</td>
                                <td '.$tdnb_style5.'>'.$cashier_emp_no.'</td>                 
                            </tr>
                            <tr>
                                <td '.$tdnb_style4.'>Name:</td>
                                <td '.$tdnb_style5.'>'.$cashier_name.'</td>                 
                            </tr>
                            <tr>
                                <td '.$tdnb_style4.'>Terminal No:</td>
                                <td '.$tdnb_style5.'>'.$_POST['pos_name'].'</td>                 
                            </tr>
                            <tr>
                                <td '.$tdnb_style4.'>Counter No:</td>
                                <td '.$tdnb_style5.'>'.$counter_no.'</td>                 
                            </tr>
                            <tr>
                                <td '.$tdnb_style4.'>Date & Time:</td>
                                <td '.$tdnb_style5.'>'.$date_time.'</td>                 
                            </tr>
                            <tr>
                                <td '.$tdnb_style4.'>Cashier\'s Signature:</td>
                                <td '.$td_style2.'>________________</td>                 
                            </tr>
                            <tr>
                                <td '.$tdnb_style4.'>Inspected by:</td>
                                <td '.$td_style2.'>________________</td>                 
                            </tr>
                            <tr>
                                <td '.$tdnb_style4.'>Approved by:</td>
                                <td '.$td_style2.'>________________</td>                 
                            </tr>
                        </tbody>
                    </table>
                </div>
                ';
  
        $this->ppdf->writeHTML($tbl, true, false, false, false, '');
        ob_end_clean();
        $this->ppdf->Output();  
    }

    public function view_transferred_den_ctrl()
    {
        $lo_id = $_SESSION['emp_id'];
        $transferred_data = $this->liquidation_model->get_transferred_data_model_v2($lo_id,$_POST['date']);
        $html='
                <table class="table table-bordered table-hover table-condensed display" id="transferred_den_table">
                    <thead>
                        <tr>                                                            
                            <th style="vertical-align: middle;">
                                <center>CASHIER NAME</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>BUSINESS UNIT /<br>DEPARTMENT</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>TERMINAL &<br>COUNTER NO.</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>SALES DATE</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>TYPE</center>
                            </th> 
                            <th style="vertical-align: middle;">
                                <center>S.O.P AMT.</center>
                            </th>  
                            <th style="vertical-align: middle;">
                                <center>TOTAL DEN.</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>REG. SALES</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>BORROWED</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>ACTION</center>
                            </th>                            
                        </tr>
                    </thead>
                ';

        $total_sales = 0;
        foreach($transferred_data as $trans)
        {
            $dname = '';
            $sname = '';
            $ssname = '';
            $br1 = '';
            $br2 = '';
            $br3 = '';
            // ===============================================================================================================================
            $bunit_data = $this->liquidation_model->get_pisbunit_v2($trans['bcode']);
            // ================================================================================================================================
            $dept_data = $this->liquidation_model->get_pisdepartment_v2($trans['dcode']);
            if(!empty($dept_data))
            {
                $dname = $dept_data->dept_name;
                $br1 = '<br>';
            }
            // ==================================================================================================================================
            $section_data = $this->liquidation_model->get_section_v2($trans['scode']);
            if(!empty($section_data))
            {
                $sname = $section_data->section_name;
                $br2 = '<br>';
            }
            // ===================================================================================================================================
            $sub_section_data = $this->liquidation_model->get_subsection_v2($trans['sscode']);
            if(!empty($sub_section_data))
            {
                $ssname = $sub_section_data->sub_section_name;
                $br3 = '<br>';
            }
            // ==================================================================================================================================
            $cash_data = $this->liquidation_model->get_cash_denomination_data_model($trans['trno'],$trans['cashier_id'],$trans['sscode'],$_POST['date']);
            $noncash_data = $this->liquidation_model->get_noncash_denomination_model($trans['trno'],$trans['cashier_id'],$trans['sscode'],$_POST['date']);
            $pos_name = '';
            $counter_no = '';
            $borrowed = '';
            if(!empty($cash_data))
            {
                foreach($cash_data as $cash)
                {
                    $pos_name = $cash['pos_name'];
                    $counter_no = $cash['counter_no'];
                    $borrowed = $cash['borrowed'];
                }
            }
            else
            {
                if(!empty($noncash_data))
                {
                    foreach($noncash_data as $noncash)
                    {
                        $pos_name = $noncash['pos_name'];
                        $counter_no = $noncash['counter_no'];
                        $borrowed = $noncash['borrowed'];
                    }
                }
            }
            // ==================================================================================================================================
            $total_sales = $trans['gtotal'] + $trans['discount'];
            $html.=' 
                    <tr style="word-wrap:break-word;">
                        <td style="vertical-align: middle;">'.$trans['cname'].'</td>
                        <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                        <td style="vertical-align: middle;">'.$pos_name.'<br>'.$counter_no.'</td>
                        <td style="vertical-align: middle;">'.$trans['dsales'].'</td>
                        <td style="vertical-align: middle;">'.$trans['sop_type'].'</td>
                        <td style="vertical-align: middle;">'.number_format($trans['sop'], 2).'</td>
                        <td style="vertical-align: middle;">'.number_format($total_sales, 2).'</td>
                        <td style="vertical-align: middle;">'.number_format($trans['rsales'], 2).'</td>
                        <td style="vertical-align: middle;">'.$borrowed.'</td>
                        <td style="vertical-align: middle;">
                        <a id="transferred_btn" onclick="print_submit_denominations_js('."'".$trans['trno']."','".$trans['cashier_id']."','".$trans['sscode']."','".$pos_name."','".$borrowed."','".$_POST['date']."'".')"><i style="font-style: normal; font-size: large;">🖨️</i></a>
                        </td>
                    </tr>
            '; 
        }
        
        $html.='                      
                    </table>
                ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function view_cashier_partial_remitted_ctrl()
    { 
        $lo_id = $_SESSION['emp_id'];
        $partial_data = $this->liquidation_model->get_partial_data_model($lo_id,$_POST['date']);
        $html='
                <form>
                    <table class="table table-bordered table-hover table-condensed display" id="cashier_partial_remitted_table">
                        <thead>
                            <tr>                                                            
                                <th style="vertical-align: middle;">
                                    <center>CASHIER NAME</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BUSINESS UNIT /<br>DEPARTMENT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TERMINAL &<br>COUNTER NO.</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>SALES DATE</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>PARTIAL AMOUNT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BORROWED</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>ACTION</center>
                                </th>                            
                            </tr>
                        </thead>
                ';

        foreach($partial_data as $partial)
        {
            $dname = '';
            $sname = '';
            $ssname = '';
            $br1 = '';
            $br2 = '';
            $br3 = '';
            // ===============================================================================================================================
            $bunit_data = $this->liquidation_model->get_pisbunit_v2($partial['bcode']);
            // ================================================================================================================================
            $dept_data = $this->liquidation_model->get_pisdepartment_v2($partial['dcode']);
            if(!empty($dept_data))
            {
                $dname = $dept_data->dept_name;
                $br1 = '<br>';
            }
            // ==================================================================================================================================
            $section_data = $this->liquidation_model->get_section_v2($partial['scode']);
            if(!empty($section_data))
            {
                $sname = $section_data->section_name;
                $br2 = '<br>';
            }
            // ===================================================================================================================================
            $sub_section_data = $this->liquidation_model->get_subsection_v2($partial['sscode']);
            if(!empty($sub_section_data))
            {
                $ssname = $sub_section_data->sub_section_name;
                $br3 = '<br>';
            }
            // ==================================================================================================================================
            $html.=' 
                    <tr style="word-wrap:break-word;">
                        <td style="vertical-align: middle;">'.$partial['emp_name'].'</td>
                        <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                        <td style="vertical-align: middle;">'.$partial['pos_name'].'<br>'.$partial['counter_no'].'</td>
                        <td style="vertical-align: middle;">'.$partial['sales_date'].'</td>
                        <td style="vertical-align: middle;">'.number_format($partial['total_cash'], 2).'</td>
                        <td style="vertical-align: middle;">'.$partial['borrowed'].'</td>
                        <td style="vertical-align: middle;">
                        <a id="transferred_btn" onclick="print_cashier_partial_denomination_js('."'".$partial['id']."','".$partial['tr_no']."','".$partial['emp_id']."','".$partial['sscode']."','".$partial['pos_name']."','".$partial['borrowed']."','".$partial['sales_date']."'".')"><i style="font-style: normal; font-size: large;">🖨️</i></a>
                        </td>
                    </tr>
                    '; 
        }
        
        $html.='                      
                        </table>
                    </form> 
                    ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function view_received_cash_ctrl()
    { 
        // ===============================OLD CODE VERSION=================================================
        // $lo_id = $_SESSION['emp_id'];
        // $cash_data = $this->liquidation_model->get_received_cash_model($lo_id);
        // ===============================UPDATED CODE VERSION=================================================
        $cash_data = $this->liquidation_model->get_received_cash_model_v2($_POST['dcode']);
        $message = '';  
        if(empty($cash_data))
        {
            $message = 'EMPTY';  
        }
        // ==============================================================================================================
        $html='
                <table class="table table-bordered table-hover table-condensed display" id="received_cash_table">
                    <thead>
                        <tr>    
                            <th style="vertical-align: middle;">
                                <center>CASHIER NAME</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>TERMINAL & COUNTER NO.</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>SALES DATE</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>TYPE</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>AMOUNT</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>
                                    <input style="width: 25px; height: 25px; margin-left: 12px;" type="checkbox" id="th_checkbox" />
                                </center>
                            </th>                            
                        </tr>
                    </thead>
                ';
        
        foreach($cash_data as $cash)
        {
            $dept_data = $this->liquidation_model->get_pisdepartment_v2($cash['dcode']);
            $dname = '';
            if(!empty($dept_data))
            {
                $dname = $dept_data->dept_name;
            }
            // =========================================================================================================
            $html.=' 
                    <tr style="word-wrap:break-word;">
                        <td style="vertical-align: middle;">'.$cash['emp_name'].'</td>
                        <td style="vertical-align: middle;">'.$cash['pos_name'].' - '.$cash['counter_no'].'</td>
                        <td style="vertical-align: middle;">'.$cash['sales_date'].'</td>
                        <td style="vertical-align: middle;">'.$cash['remit_type'].'</td>
                        <td style="vertical-align: middle;">'.number_format($cash['total_cash'], 2).'</td>
                        <td style="vertical-align: middle;">
                            <center>
                                <input style="width: 25px; height: 25px;" type="checkbox" class="td_checkbox" value="'.$cash['id'].'" />
                            </center>
                        </td>
                    </tr>
                    '; 
        }
        
        $html.='                      
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
                        thrc_checked_js();
                    });
                </script>
                ';

        $data['message']=$message;         
        $data['html']=$html;         
        echo json_encode($data);
    }

    public function view_partial_remitted_cash_ctrl()
    { 
        $lo_id = $_SESSION['emp_id'];
        $partial_remitted_data = $this->liquidation_model->get_partial_remitted_cash_model($lo_id,$_POST['date']);
        $html='
                <table class="table table-bordered table-hover table-condensed display" id="partial_remitted_cash_table">
                    <thead>
                        <tr>    
                            <th style="vertical-align: middle;">
                                <center>DEPARTMENT</center>
                            </th>  
                            <th style="vertical-align: middle;">
                                <center>SALES DATE</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>BATCH</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>BATCH AMOUNT</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>OFFICER REMITTED</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>DATE/TIME REMITTED</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>ACTION</center>
                            </th>                            
                        </tr>
                    </thead>
                ';

        foreach($partial_remitted_data as $partial)
        {
            $dept_data = $this->liquidation_model->get_pisdepartment_v2($partial['dcode']);
            $dname = '';
            if(!empty($dept_data))
            {
                $dname = $dept_data->dept_name;
            }
            // ==================================================================================
            $lo_data = $this->liquidation_model->get_pisdata($partial['liq_officer']);
            $name = '';
            foreach($lo_data as $lo)
            {
                 $name = $lo['name'];
            }
            // ===================================================================================
            $batch_data = $this->liquidation_model->get_batch_data_model($partial['dcode'],$partial['batch_remit'],$partial['sales_date']);
            $batch_id = array(); 
            $cashier_info = array(); 
            foreach($batch_data as $batch)
            {
                array_push($batch_id,$batch['cash_id']);  
                if(!in_array($batch['tr_no'].'|'.$batch['emp_id'],$cashier_info))
                {
                    array_push($cashier_info,$batch['tr_no'].'|'.$batch['emp_id'].'|'.$partial['dcode']);        
                }
            }
            // ===================================================================================
            $batch_total_data = $this->liquidation_model->get_batch_total_model($batch_id);
            $batch_total = 0; 
            foreach($batch_total_data as $batch)
            {
                $batch_total = $batch['batch_total']; 
            } 
            // ===================================================================================
            $batchid_array = implode(",", $batch_id);
            $cashier_info_implode = implode("^", $cashier_info);
            // ===================================================================================
            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d');
            $edit_html = '';
            if($curr_date == $_POST['date'])
            {
                $edit_html = '
                    &nbsp;&nbsp;
                    <a style="font-size: x-large;" onclick="backdate_batch_remittance_js('."'".$cashier_info_implode."','".$partial['batch_remit']."'".')">✏️</a>
                ';
            }
            // ===================================================================================
            $html.=' 
                    <tr style="word-wrap:break-word;">
                        <td style="vertical-align: middle;">'.$dname.'</td>
                        <td style="vertical-align: middle;">'.$partial['sales_date'].'</td>
                        <td style="vertical-align: middle;">'.$partial['batch_remit'].'</td>
                        <td style="vertical-align: middle;">'.number_format($batch_total, 2).'</td>
                        <td style="vertical-align: middle;">'.$name.'</td>
                        <td style="vertical-align: middle;">'.$partial['date_remitted'].'</td>
                        <td style="vertical-align: middle;">
                            <a style="font-size: x-large;" onclick="view_batch_partial_remitted_js('."'".$batchid_array."','".$partial['batch_remit']."'".')">👁️</a> 
                                &nbsp;&nbsp;
                            <a style="font-size: x-large;" onclick="print_liquidation_partial_cash_js('."'".$batchid_array."'".')">🖨️</a>
                            '.$edit_html.'
                        </td>
                    </tr>
                    '; 
        }
        
        $html.='                      
                </table>
               ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function view_remit_modal_ctrl()
    { 
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d');
        $batch_data = $this->liquidation_model->get_batch_counter_model($_POST['dcode'],$curr_date);
        $batch_remit = 1;
        if(!empty($batch_data))
        {
            foreach($batch_data as $batch)
            {
                $batch_remit = $batch['batch_remit'];
            }
        }
        // =====================================================================================================================
        $cash_data = $this->liquidation_model->get_selected_cash_model($_POST['id']);
        $html='
                <table class="table table-bordered table-hover table-condensed display" id="selected_cash_table">
                    <thead>
                        <tr>                                                            
                            <th style="vertical-align: middle;">
                                <center>CASHIER NAME</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>TERMINAL NO.</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>SALES DATE</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>AMOUNT</center>
                            </th>                         
                        </tr>
                    </thead>
                ';

        $total_remit = 0;
        foreach($cash_data as $cash)
        {
            $total_remit += $cash['total_cash'];
            $html.=' 
                    <tr style="word-wrap:break-word;">
                        <td style="vertical-align: middle;">'.$cash['emp_name'].'</td>
                        <td style="vertical-align: middle;">'.$cash['pos_name'].'</td>
                        <td style="vertical-align: middle;">'.$cash['sales_date'].'</td>
                        <td style="vertical-align: middle;">'.number_format($cash['total_cash'], 2).'</td>
                    </tr>
                    '; 
        }
        
        $html.=' 
                <tfoot style="word-wrap:break-word;">
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle; font-weight: bold;">TOTAL</td>
                    <td style="vertical-align: middle; font-weight: bold;">'.number_format($total_remit, 2).'</td>
                </tfoot>                     
                </table>
               ';

        $data['html']=$html;              
        $data['batch_remit']=$batch_remit;         
        echo json_encode($data);
    }

    public function view_batch_partial_remitted_ctrl()
    { 
        $batch_id = explode(",", $_POST['id']);
        $cash_data = $this->liquidation_model->get_remitted_cash_model($batch_id);
        $html='
                <table class="table table-bordered table-hover table-condensed display" id="selected_cash_table">
                    <thead>
                        <tr>                                                            
                            <th style="vertical-align: middle;">
                                <center>CASHIER NAME</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>TERMINAL NO.</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>SALES DATE</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>AMOUNT</center>
                            </th>    
                            <th style="vertical-align: middle;">
                                <center>DATE/TIME REMITTED</center>
                            </th>   
                            <th style="vertical-align: middle;">
                                <center>ACTION</center>
                            </th>                     
                        </tr>
                    </thead>
                ';

        $total_remit = 0;
        foreach($cash_data as $cash)
        { 
            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d');
            // ==========================================================================================
            $hide = 'hidden';
            if($cash['batch_date'] == $curr_date)
            {
                $hide = '';
            }
            // ==========================================================================================
            $total_remit += $cash['total_cash'];
            // ==========================================================================================
            $html.=' 
                    <tr style="word-wrap:break-word;">
                        <td style="vertical-align: middle;">'.$cash['emp_name'].'</td>
                        <td style="vertical-align: middle;">'.$cash['pos_name'].'</td>
                        <td style="vertical-align: middle;">'.$cash['sales_date'].'</td>
                        <td style="vertical-align: middle;">'.number_format($cash['total_cash'], 2).'</td>
                        <td style="vertical-align: middle;">'.$cash['date_remitted'].'</td>
                        <td style="vertical-align: middle;">
                            <a '.$hide.' style="font-size: large;" onclick="remitted_cash_mkey_js('."'".$cash['remitted_id']."','".$cash['cash_id']."','".$cash['tr_no']."','".$cash['emp_id']."','".$cash['sscode']."','".$cash['pos_name']."','".$cash['sales_date']."','".$cash['remit_type']."','".$_POST['id']."'".')">❌</a>
                        </td>
                    </tr>
                    '; 
        }
        
        $html.=' 
                <tfoot style="word-wrap:break-word;">
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle; font-weight: bold;">TOTAL REMITTED</td>
                    <td style="vertical-align: middle; font-weight: bold;">'.number_format($total_remit, 2).'</td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                </tfoot>                     
                </table>
               ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function liq_search_emp_ctrl()
	{
		if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
			$emp_data = $this->liquidation_model->get_emp_name_model($_POST['emp_name'],$_POST['dcode']);
			$emp_name = '';
			foreach($emp_data as $data)
			{
				$emp_name .= $data['name'].'^';
			}
			
			$data['emp_name'] = $emp_name;
			echo json_encode($data);
		}
	}

    public function setup_counter_get_section_ctrl()
	{
		$query=$this->liquidation_model->setup_counter_get_section_model($_POST['dcode']);
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

    public function setup_counter_get_sub_section_ctrl()
	{
        $scode = $_POST['dcode'].$_POST['scode'];
		$query=$this->liquidation_model->setup_counter_get_sub_section_model($scode);
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

    public function setup_counter_display_pos_name_ctrl()
	{
		$pos_data = $this->liquidation_model->setup_counter_get_pos_counter_no_model($_POST['dcode']);
        $html = '
				<option disabled selected>Select POS</option>
				';
		foreach($pos_data as $pos)
		{
			$html .= '
				<option value="'.$pos['counter_no'].'">'.$pos['pos_name'].'</option>
				';
		}

		$data['html'] = $html;
		echo json_encode($data);
	}

    public function set_assigned_counter_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = "success";
            $cashier_data = $this->liquidation_model->get_emp_data_model($_POST['name'],$_POST['dcode']);
            if(!empty($cashier_data))
            {
                $date = new DateTime("now");
                $curr_date = $date->format('Y-m-d');
                // ==========================================================================================
                $emp_id = $cashier_data->emp_id;
                $default_sscode = $cashier_data->sscode;
                if($_POST['borrow'] == 'YES')
                {
                    $borrowed_sscode = $_POST['dcode'].$_POST['scode'].$_POST['sscode']; 
                    if($default_sscode == $borrowed_sscode)
                    {
                        $message = "INVALID BORROWED";
                        echo json_encode($message);
                    }
                    else
                    {
                        $validate_data = $this->liquidation_model->validate_assigned_counter_model($emp_id,$_POST['dcode'],$_POST['scode'],$_POST['sscode'],$_POST['pos_name'],$_POST['counter_no'],$_POST['borrow'],$curr_date);
                        if(empty($validate_data))
                        {
                            $this->liquidation_model->update_default_counter_model($emp_id,$_POST['dcode'],$curr_date);
                            // ===================================================================================================
                            $this->liquidation_model->set_assigned_counter_model($emp_id,$_POST['dcode'],$_POST['scode'],$_POST['sscode'],$_POST['pos_name'],$_POST['counter_no'],$_POST['borrow']);
                   
                            echo json_encode($message);
                        }
                        else
                        {
                            $message = "ALREADY EXIST";
                            echo json_encode($message);
                        }
                    }
                }
                else
                {
                    $scode = '';
                    $sscode = '';
                    $validate_data = $this->liquidation_model->validate_assigned_counter_model($emp_id,$_POST['dcode'],$scode,$sscode,$_POST['pos_name'],$_POST['counter_no'],$_POST['borrow'],$curr_date);
                    if(empty($validate_data))
                    {
                        $this->liquidation_model->update_default_counter_model($emp_id,$_POST['dcode'],$curr_date);
                        // ===================================================================================================
                        $this->liquidation_model->set_assigned_counter_model($emp_id,$_POST['dcode'],$scode,$sscode,$_POST['pos_name'],$_POST['counter_no'],$_POST['borrow']);
               
                        echo json_encode($message);
                    }
                    else
                    {
                        $message = "ALREADY EXIST";
                        echo json_encode($message);
                    }
                }
            }
            else
            {
                $message = "INVALID NAME";
                echo json_encode($message);
            }
		}
    }

    public function advance_set_assigned_counter_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = "success";
            $cashier_data = $this->liquidation_model->get_emp_data_model($_POST['name'],$_POST['dcode']);
            if(!empty($cashier_data))
            {
                $emp_id = $cashier_data->emp_id;
                $default_sscode = $cashier_data->sscode;
                if($_POST['borrow'] == 'YES')
                {
                    $borrowed_sscode = $_POST['dcode'].$_POST['scode'].$_POST['sscode']; 
                    if($default_sscode == $borrowed_sscode)
                    {
                        $message = "INVALID BORROWED";
                        echo json_encode($message);
                    }
                    else
                    {
                        $validate_data = $this->liquidation_model->validate_assigned_counter_model($emp_id,$_POST['dcode'],$_POST['scode'],$_POST['sscode'],$_POST['pos_name'],$_POST['counter_no'],$_POST['borrow'],$_POST['filter_date']);
                        if(empty($validate_data))
                        {
                            $this->liquidation_model->update_default_counter_model($emp_id,$_POST['dcode'],$_POST['filter_date']);
                            // ===================================================================================================
                            $this->liquidation_model->advance_set_assigned_counter_model($emp_id,$_POST['dcode'],$_POST['scode'],$_POST['sscode'],$_POST['pos_name'],$_POST['counter_no'],$_POST['borrow'],$_POST['filter_date']);
                   
                            echo json_encode($message);
                        }
                        else
                        {
                            $message = "ALREADY EXIST";
                            echo json_encode($message);
                        }
                    }
                }
                else
                {
                    $scode = '';
                    $sscode = '';
                    $validate_data = $this->liquidation_model->validate_assigned_counter_model($emp_id,$_POST['dcode'],$scode,$sscode,$_POST['pos_name'],$_POST['counter_no'],$_POST['borrow'],$_POST['filter_date']);
                    if(empty($validate_data))
                    {
                        $this->liquidation_model->update_default_counter_model($emp_id,$_POST['dcode'],$_POST['filter_date']);
                        // ===================================================================================================
                        $this->liquidation_model->advance_set_assigned_counter_model($emp_id,$_POST['dcode'],$scode,$sscode,$_POST['pos_name'],$_POST['counter_no'],$_POST['borrow'],$_POST['filter_date']);
               
                        echo json_encode($message);
                    }
                    else
                    {
                        $message = "ALREADY EXIST";
                        echo json_encode($message);
                    }
                }
            }
            else
            {
                $message = "INVALID NAME";
                echo json_encode($message);
            }
		}
    }

    public function cashier_assigned_counter_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d');
            $cashier_data = $this->liquidation_model->cashier_assigned_counter_model($_SESSION['emp_id'],$curr_date);
            $html='
                    <table class="table table-bordered table-hover table-condensed display" id="cashier_assigned_counter_table">
                        <thead>
                            <tr>                                                            
                                <th>
                                    <center style="font-size: 15px; vertical-align: middle;">CASHIER NAME</center>
                                </th>
                                <th>
                                    <center style="font-size: 15px; vertical-align: middle;">DEPARTMENT</center>
                                <th>
                                    <center style="font-size: 15px; vertical-align: middle;">ACTION</center>
                                </th>                            
                            </tr>
                        </thead>
                ';
            foreach($cashier_data as $cashier)
            {
                $emp_data = $this->liquidation_model->emp_data_model($cashier['emp_id']);
                $dept = $this->liquidation_model->get_pisdepartment_v2($cashier['dcode']);
                $html.='
                    <tr>
                        <td style="font-size: 15px; vertical-align: middle;">'.$emp_data->name.'</td>
                        <td style="font-size: 15px; vertical-align: middle;">'.$dept->dept_name.'</td>
                        <td style="font-size: 15px; vertical-align: middle;">
                            <a style="font-size: x-large;" onclick="view_counter_js('."'".$cashier['emp_id']."','".$emp_data->name."'".')">👁️</a>
                        </td>
                    </tr>
                    ';
            }
            $html.='
                    </table>
                    ';

            $data['html'] = $html;
            echo json_encode($data);
        }
    }

    public function advance_cashier_assigned_counter_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d');
            $cashier_data = $this->liquidation_model->advance_cashier_assigned_counter_model($_SESSION['emp_id'],$curr_date);
            $html='
                    <table class="table table-bordered table-hover table-condensed display" id="cashier_assigned_counter_table">
                        <thead>
                            <tr>                                                            
                                <th>
                                    <center style="font-size: 15px; vertical-align: middle;">CASHIER NAME</center>
                                </th>
                                <th>
                                    <center style="font-size: 15px; vertical-align: middle;">DEPARTMENT</center>
                                <th>
                                    <center style="font-size: 15px; vertical-align: middle;">ACTION</center>
                                </th>                            
                            </tr>
                        </thead>
                ';
            foreach($cashier_data as $cashier)
            {
                $emp_data = $this->liquidation_model->emp_data_model($cashier['emp_id']);
                $dept = $this->liquidation_model->get_pisdepartment_v2($cashier['dcode']);
                $html.='
                    <tr>
                        <td style="font-size: 15px; vertical-align: middle;">'.$emp_data->name.'</td>
                        <td style="font-size: 15px; vertical-align: middle;">'.$dept->dept_name.'</td>
                        <td style="font-size: 15px; vertical-align: middle;">
                            <a style="font-size: x-large;" onclick="advance_view_counter_js('."'".$cashier['emp_id']."','".$emp_data->name."'".')">👁️</a>
                        </td>
                    </tr>
                    ';
            }
            $html.='
                    </table>
                    ';

            $data['html'] = $html;
            echo json_encode($data);
        }
    }

    public function view_counter_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d');
            $counter_data = $this->liquidation_model->get_cashier_assigned_counter_model($_POST['emp_id'],$curr_date);
            $html='
                    <table class="table table-bordered table-hover table-condensed display" id="view_assigned_counter_table">
                        <thead>
                            <tr>                                                            
                                <th>
                                    <center>TERMINAL NO.</center>
                                </th>
                                <th>
                                    <center>COUNTER NO.</center>
                                </th>
                                <th>
                                    <center>SECTION</center>
                                </th>
                                <th>
                                    <center>SUB SECTION</center>
                                </th>
                                <th>
                                    <center>BORROWED</center>
                                </th>
                                <th>
                                    <center>ACTION</center>
                                </th>                            
                            </tr>
                        </thead>
                ';
            foreach($counter_data as $counter)
            {
                $sname = '';
                $ssname = '';
                $scode = $counter['dcode'].$counter['scode'];
                $sscode = $counter['dcode'].$counter['scode'].$counter['sscode'];
                $section_data = $this->liquidation_model->get_section_v2($scode);
                if(!empty($section_data))
                {
                    $sname = $section_data->section_name;
                }
                $sub_section_data = $this->liquidation_model->get_subsection_v2($sscode);
                if(!empty($sub_section_data))
                {
                    $ssname = $sub_section_data->sub_section_name;
                }
                // =================================================================================================================
                $status = '<a style="color: blue" onclick="update_default_counter_js('."'".$counter['id']."','".$_POST['emp_id']."','".$counter['dcode']."'".')">Set as default</a>';
                if($counter['status'] == 'DEFAULT')
                {
                    $status = $counter['status'];
                }
                // ===================================================================================================================
                $html.='
                    <tr>
                        <td>'.$counter['pos_name'].'</td>
                        <td>'.$counter['counter_no'].'</td>
                        <td>'.$sname.'</td>
                        <td>'.$ssname.'</td>
                        <td>'.$counter['borrowed'].'</td>
                        <td>'.$status.'</td>
                    </tr>
                    ';
            }
            $html.='
                    </table>
                    ';

            $data['html'] = $html;
            echo json_encode($data);
        }
    }

    public function view_advance_counter_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d');
            $counter_data = $this->liquidation_model->get_advance_cashier_assigned_counter_model($_POST['emp_id'],$curr_date);
            $html='
                    <table class="table table-bordered table-hover table-condensed display" id="view_assigned_counter_table">
                        <thead>
                            <tr>                                                            
                                <th>
                                    <center>TERMINAL NO.</center>
                                </th>
                                <th>
                                    <center>COUNTER NO.</center>
                                </th>
                                <th>
                                    <center>SECTION</center>
                                </th>
                                <th>
                                    <center>SUB SECTION</center>
                                </th>
                                <th>
                                    <center>BORROWED</center>
                                </th>
                                <th>
                                    <center>ASSIGNED DATE</center>
                                </th>
                                <th>
                                    <center>ACTION</center>
                                </th>                            
                            </tr>
                        </thead>
                ';
            foreach($counter_data as $counter)
            {
                $sname = '';
                $ssname = '';
                $scode = $counter['dcode'].$counter['scode'];
                $sscode = $counter['dcode'].$counter['scode'].$counter['sscode'];
                $section_data = $this->liquidation_model->get_section_v2($scode);
                if(!empty($section_data))
                {
                    $sname = $section_data->section_name;
                }
                $sub_section_data = $this->liquidation_model->get_subsection_v2($sscode);
                if(!empty($sub_section_data))
                {
                    $ssname = $sub_section_data->sub_section_name;
                }
                // =================================================================================================================
                $status = '<a style="color: blue" onclick="update_advance_default_counter_js('."'".$counter['id']."','".$_POST['emp_id']."','".$counter['dcode']."','".$counter['date_setup']."'".')">Set as default</a>';
                if($counter['status'] == 'DEFAULT')
                {
                    $status = $counter['status'];
                }
                // ===================================================================================================================
                $html.='
                    <tr>
                        <td>'.$counter['pos_name'].'</td>
                        <td>'.$counter['counter_no'].'</td>
                        <td>'.$sname.'</td>
                        <td>'.$ssname.'</td>
                        <td>'.$counter['borrowed'].'</td>
                        <td>'.$counter['date_setup'].'</td>
                        <td>'.$status.'</td>
                    </tr>
                    ';
            }
            $html.='
                    </table>
                    ';

            $data['html'] = $html;
            echo json_encode($data);
        }
    }

    public function update_default_counter_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = "success";
            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d');
            $this->liquidation_model->update_default_counter_model($_POST['emp_id'],$_POST['dcode'],$curr_date);
            $this->liquidation_model->update_default_counter_model2($_POST['id'],$_POST['emp_id'],$_POST['dcode'],$curr_date);
            
            echo json_encode($message);
        }
    }

    public function update_advance_default_counter_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = "success";
            $this->liquidation_model->update_advance_default_counter_model($_POST['emp_id'],$_POST['dcode'],$_POST['date_setup']);
            $this->liquidation_model->update_advance_default_counter_model2($_POST['id'],$_POST['emp_id'],$_POST['dcode'],$_POST['date_setup']);
            
            echo json_encode($message);
        }
    }

    public function remit_selected_cash_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $id = explode(",", $_POST['id']);
            $validate_cash_data = $this->liquidation_model->validate_selected_cash_model($id);
            if(empty($validate_cash_data))
            {
                $this->liquidation_model->update_selected_cash_model($id);
                // ===================================================================================
                $date = new DateTime("now");
                $curr_date = $date->format('Y-m-d');
                $batch_data = $this->liquidation_model->validate_batch_counter_model($_POST['dcode'],$curr_date);
                if(empty($batch_data))
                {
                    $this->liquidation_model->add_batch_counter_model($_POST['dcode'],$curr_date);
                }
                // ===================================================================================
                $updated_batch_data = $this->liquidation_model->get_batch_counter_model($_POST['dcode'],$curr_date);
                $batch_remit = 0;
                foreach($updated_batch_data as $batch)
                {
                    $batch_remit = $batch['batch_remit'];
                }
                // ===================================================================================
                for($x =0; $x<count($id); $x++) 
                {
                    $selected_cash = $this->liquidation_model->get_selected_remit_cash_model($id[$x]);
                    if(!empty($selected_cash))
                    {
                        $cash_id = '';
                        $tr_no = '';
                        $emp_id = '';
                        $sscode = '';
                        foreach($selected_cash as $cash)
                        {
                            $cash_id = $cash['id'];
                            $tr_no = $cash['tr_no'];
                            $emp_id = $cash['emp_id'];
                            $sscode = $cash['sscode'];
                        }
                        $this->liquidation_model->save_selected_remit_cash_model($cash_id,$tr_no,$emp_id,$_POST['dcode'],$sscode,$batch_remit);
                    }
                }
                // =======================================================================================
                $updated_batch_remit = $batch_remit + 1;
                $this->liquidation_model->update_batch_counter_model($_POST['dcode'],$updated_batch_remit,$curr_date);
                // ========================================================================================================================
                $message = "success";
                echo json_encode($message);
            }
            else
            {
                $message = "ALREADY REMITTED";
                echo json_encode($message);
            }
        }
    }

    public function change_sales_date_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = "success";
            $this->liquidation_model->change_sales_date_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['sales_date']);
            
            echo json_encode($message);
        }
    }

    public function adjustment_pending_cash_ctrl()
    {
        $lo_id = $_SESSION['emp_id']; 
        $pending_cash_data = $this->liquidation_model->adjustment_pending_cash_model($lo_id);
        $html='
                <form>
                    <table class="table table-bordered table-hover table-condensed display" id="pending_den_table">
                        <thead>
                            <tr>                                                            
                                <th style="vertical-align: middle;">
                                    <center>CASHIER NAME</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BUSINESS UNIT /<br>DEPARTMENT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TERMINAL &<br>COUNTER NO.</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>SALES DATE</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TYPE</center>
                                </th> 
                                <th style="vertical-align: middle;">
                                    <center>AMOUNT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BORROWED</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>ACTION</center>
                                </th>                            
                            </tr>
                        </thead>
                ';

        foreach($pending_cash_data as $cash)
        {
            $dname = '';
            $sname = '';
            $ssname = '';
            $br1 = '';
            $br2 = '';
            $br3 = '';
            // ===============================================================================================================================
            $bunit_data = $this->liquidation_model->get_pisbunit_v2($cash['bcode']);
            // ================================================================================================================================
            $dept_data = $this->liquidation_model->get_pisdepartment_v2($cash['dcode']);
            if(!empty($dept_data))
            {
                $dname = $dept_data->dept_name;
                $br1 = '<br>';
            }
            // ==================================================================================================================================
            $section_data = $this->liquidation_model->get_section_v2($cash['scode']);
            if(!empty($section_data))
            {
                $sname = $section_data->section_name;
                $br2 = '<br>';
            }
            // ===================================================================================================================================
            $sub_section_data = $this->liquidation_model->get_subsection_v2($cash['sscode']);
            if(!empty($sub_section_data))
            {
                $ssname = $sub_section_data->sub_section_name;
                $br3 = '<br>';
            }
            // ==================================================================================================================================
            $html.=' 
                    <tr style="word-wrap:break-word;">
                        <td style="vertical-align: middle;">'.$cash['cname'].'</td>
                        <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                        <td style="vertical-align: middle;">'.$cash['pos_name'].'<br>'.$cash['counter_no'].'</td>
                        <td style="vertical-align: middle;">'.$cash['sales_date'].'</td>
                        <td style="vertical-align: middle;">'.$cash['remit_type'].'</td>
                        <td style="vertical-align: middle;">'.number_format($cash['total_cash'], 2).'</td>
                        <td style="vertical-align: middle;">'.$cash['borrowed'].'</td>
                        <td style="vertical-align: middle;">
                            <a id="cancel_btn" onclick="delete_pending_cash_js_v2('."'".$cash['id']."'".')"><i style="font-style: normal; font-size: large;">❌</i></a>
                        </td>
                    </tr>
                    '; 
        }
        
        $html.='                      
                        </table>
                    </form> 
                    ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function adjustment_pending_noncash_ctrl()
    {
        $lo_id = $_SESSION['emp_id']; 
        $pending_noncash_data = $this->liquidation_model->adjustment_pending_noncash_model($lo_id);
        $html='
                <form>
                    <table class="table table-bordered table-hover table-condensed display" id="pending_den_table">
                        <thead>
                            <tr>                                                            
                                <th style="vertical-align: middle;">
                                    <center>CASHIER NAME</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BUSINESS UNIT /<br>DEPARTMENT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TERMINAL &<br>COUNTER NO.</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>SALES DATE</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>MODE OF PAYMENT</center>
                                </th> 
                                <th style="vertical-align: middle;">
                                    <center>QUANTITY</center>
                                </th> 
                                <th style="vertical-align: middle;">
                                    <center>AMOUNT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BORROWED</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>ACTION</center>
                                </th>                            
                            </tr>
                        </thead>
                ';

        foreach($pending_noncash_data as $noncash)
        {
            $dname = '';
            $sname = '';
            $ssname = '';
            $br1 = '';
            $br2 = '';
            $br3 = '';
            // ===============================================================================================================================
            $bunit_data = $this->liquidation_model->get_pisbunit_v2($noncash['bcode']);
            // ================================================================================================================================
            $dept_data = $this->liquidation_model->get_pisdepartment_v2($noncash['dcode']);
            if(!empty($dept_data))
            {
                $dname = $dept_data->dept_name;
                $br1 = '<br>';
            }
            // ==================================================================================================================================
            $section_data = $this->liquidation_model->get_section_v2($noncash['scode']);
            if(!empty($section_data))
            {
                $sname = $section_data->section_name;
                $br2 = '<br>';
            }
            // ===================================================================================================================================
            $sub_section_data = $this->liquidation_model->get_subsection_v2($noncash['sscode']);
            if(!empty($sub_section_data))
            {
                $ssname = $sub_section_data->sub_section_name;
                $br3 = '<br>';
            }
            // ==================================================================================================================================
            $html.=' 
                    <tr style="word-wrap:break-word;">
                        <td style="vertical-align: middle;">'.$noncash['cname'].'</td>
                        <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                        <td style="vertical-align: middle;">'.$noncash['pos_name'].'<br>'.$noncash['counter_no'].'</td>
                        <td style="vertical-align: middle;">'.$noncash['sales_date'].'</td>
                        <td style="vertical-align: middle;">'.$noncash['mop_name'].'</td>
                        <td style="vertical-align: middle;">'.$noncash['noncash_qty'].'</td>
                        <td style="vertical-align: middle;">'.number_format($noncash['noncash_amount'], 2).'</td>
                        <td style="vertical-align: middle;">'.$noncash['borrowed'].'</td>
                        <td style="vertical-align: middle;">
                            <a id="cancel_btn" onclick="delete_pending_noncash_js('."'".$noncash['id']."'".')"><i style="font-style: normal; font-size: large;">❌</i></a>
                        </td>
                    </tr>
                    '; 
        }
        
        $html.='                      
                        </table>
                    </form> 
                    ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function get_deleted_pending_cash_ctrl()
    {
        $lo_id = $_SESSION['emp_id']; 
        $pending_cash_data = $this->liquidation_model->get_deleted_pending_cash_model($lo_id);
        $html='
                <form>
                    <table class="table table-bordered table-hover table-condensed display" id="deleted_pending_den_table">
                        <thead>
                            <tr>                                                            
                                <th style="vertical-align: middle;">
                                    <center>CASHIER NAME</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BUSINESS UNIT /<br>DEPARTMENT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TERMINAL &<br>COUNTER NO.</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>SALES DATE</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TYPE</center>
                                </th> 
                                <th style="vertical-align: middle;">
                                    <center>AMOUNT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BORROWED</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>OFFICER DELETED</center>
                                </th> 
                                <th style="vertical-align: middle;">
                                    <center>DATE/TIME DELETED</center>
                                </th>                            
                            </tr>
                        </thead>
                ';

        foreach($pending_cash_data as $cash)
        {
            $dname = '';
            $sname = '';
            $ssname = '';
            $br1 = '';
            $br2 = '';
            $br3 = '';
            // ===============================================================================================================================
            $bunit_data = $this->liquidation_model->get_pisbunit_v2($cash['bcode']);
            // ================================================================================================================================
            $dept_data = $this->liquidation_model->get_pisdepartment_v2($cash['dcode']);
            if(!empty($dept_data))
            {
                $dname = $dept_data->dept_name;
                $br1 = '<br>';
            }
            // ==================================================================================================================================
            $section_data = $this->liquidation_model->get_section_v2($cash['scode']);
            if(!empty($section_data))
            {
                $sname = $section_data->section_name;
                $br2 = '<br>';
            }
            // ===================================================================================================================================
            $sub_section_data = $this->liquidation_model->get_subsection_v2($cash['sscode']);
            if(!empty($sub_section_data))
            {
                $ssname = $sub_section_data->sub_section_name;
                $br3 = '<br>';
            }
            // ==================================================================================================================================
            $lo_name = '';
            $lo_data = $this->liquidation_model->emp_data_model($cash['officer_deleted']);
            if(!empty($lo_data))
            {
                $lo_name = $lo_data->name;
            }
            // ==================================================================================================================================
            $html.=' 
                    <tr style="word-wrap:break-word;">
                        <td style="vertical-align: middle;">'.$cash['cname'].'</td>
                        <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                        <td style="vertical-align: middle;">'.$cash['pos_name'].'<br>'.$cash['counter_no'].'</td>
                        <td style="vertical-align: middle;">'.$cash['sales_date'].'</td>
                        <td style="vertical-align: middle;">'.$cash['remit_type'].'</td>
                        <td style="vertical-align: middle;">'.number_format($cash['total_cash'], 2).'</td>
                        <td style="vertical-align: middle;">'.$cash['borrowed'].'</td>
                        <td style="vertical-align: middle;">'.$lo_name.'</td>
                        <td style="vertical-align: middle;">'.$cash['date_deleted'].'</td>
                    </tr>
                    '; 
        }
        
        $html.='                      
                        </table>
                    </form> 
                    ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function delete_pending_denomination_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $lo_id = $_SESSION['emp_id'];
            // =================================================================================
            $sup_id = '';
            $managers_key_data = $this->liquidation_model->validate_managers_key_model($_POST['username'],$_POST['password']);
            if(!empty($managers_key_data))
            {
                $sup_id = $managers_key_data->emp_id;
                $matched_data = $this->liquidation_model->validate_subordinates_model($lo_id,$sup_id);
                if(!empty($matched_data))
                {
                    $message = 'success';
                    $this->liquidation_model->delete_pending_denomination_model($_POST['id'],$lo_id,$sup_id);
        
                    echo json_encode($message);
                }
                else
                {
                    $message = 'INVALID SUBORDINATES';
                    echo json_encode($message);
                }
            }
            else
            {
                $message = 'EMPTY';
                echo json_encode($message);
            }
        }
    }

    public function delete_pending_denomination_ctrl_v2()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $lo_id = $_SESSION['emp_id'];
            // =================================================================================
            $message = 'success';
            $this->liquidation_model->delete_pending_denomination_model_v2($_POST['id'],$lo_id);

            echo json_encode($message);
        }
    }

    public function delete_pending_noncash_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $lo_id = $_SESSION['emp_id'];
            // =================================================================================
            $message = 'success';
            $this->liquidation_model->delete_pending_noncash_model($_POST['id'],$lo_id);

            echo json_encode($message);
        }
    }

    public function delete_remitted_cash_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $lo_id = $_SESSION['emp_id'];
            // =================================================================================
            $sup_id = '';
            $managers_key_data = $this->liquidation_model->validate_managers_key_model($_POST['username'],$_POST['password']);
            if(!empty($managers_key_data))
            {
                $sup_id = $managers_key_data->emp_id;
                $matched_data = $this->liquidation_model->validate_subordinates_model($lo_id,$sup_id);
                if(!empty($matched_data))
                {
                    if($_POST['remit_type'] == 'PARTIAL')
                    {
                        $validate_partial_data = $this->liquidation_model->validate_partial_remitted_cash_model($_POST['cash_id']);
                        if(!empty($validate_partial_data))
                        {
                            $message = 'success';
                            $this->liquidation_model->delete_partial_remitted_cash_model($_POST['remitted_id'],$_POST['cash_id'],$lo_id,$sup_id);
                           
                            echo json_encode($message);
                        }
                        else
                        {
                            $final_remitted_data = $this->liquidation_model->get_final_remitted_cash_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['sales_date']);
                            $final_id = '';
                            if(!empty($final_remitted_data))
                            {
                                $final_id = $final_remitted_data->id;
                            }
                            $message = 'success';
                            $this->liquidation_model->delete_selected_partial_and_final_remitted_cash_model($_POST['remitted_id'],$_POST['cash_id'],$final_id,$_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['sales_date'],$lo_id,$sup_id);
                           
                            echo json_encode($message);
                        }
                    }
                    else
                    {
                        $message = 'success';
                        $this->liquidation_model->delete_final_remitted_cash_model($_POST['remitted_id'],$_POST['cash_id'],$_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['sales_date'],$lo_id,$sup_id);
                        
                        echo json_encode($message);
                    }
                }
                else
                {
                    $message = 'INVALID SUBORDINATES';
                    echo json_encode($message);
                }
            }
            else
            {
                $message = 'EMPTY';
                echo json_encode($message);
            }
        }
    }

    public function adjust_zero_rs_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $lo_id = $_SESSION['emp_id'];
            // =================================================================================
            $sup_id = '';
            $managers_key_data = $this->liquidation_model->validate_managers_key_model($_POST['username'],$_POST['password']);
            if(!empty($managers_key_data))
            {
                $sup_id = $managers_key_data->emp_id;
                $matched_data = $this->liquidation_model->validate_subordinates_model($lo_id,$sup_id);
                if(!empty($matched_data))
                {
                    $validate_zero_rs_data = $this->liquidation_model->validate_zero_rs_model($_POST['cs_den_id']);
                    if(!empty($validate_zero_rs_data))
                    {
                        $type = '';
                        $balance = 0;
                        if($_POST['variance_txt'] == 'Short')
                        {
                            $type = 'S';
                            $balance = $_POST['variance'];
                        }
                        else if($_POST['variance_txt'] == 'Over')
                        {
                            $type = 'O';
                        }
                        else
                        {
                            $type = 'PF';
                        }
                        //==============================================================================================================
                        $deduction_date = '';
                        if($_POST['variance_txt'] == 'Short')
                        {
                            if($_POST['variance'] >= 10)
                            {
                                $cutoff_data = $this->liquidation_model->get_cutoff_model($_POST['ccode'],$_POST['bcode']);
                                $start_fc = '';
                                $end_fc = '';
                                $pay_day_fc = '';
                                $pay_day_sc = '';
                                foreach($cutoff_data as $cutoff)
                                {
                                    $start_fc = $cutoff['startFC'];
                                    $end_fc = $cutoff['endFC'];
                                    $pay_day_fc = $cutoff['pDayFC'];
                                    $pay_day_sc = $cutoff['pDaySC'];
                                }
                                // ========================================================================================================================
                                $year = date("Y");
                                $month = date("m");
                                $month2 = date("m")+1;
                                $day = date("d");
                                if(!empty($cutoff_data))
                                {
                                    if($pay_day_fc == 15)
                                    {
                                        if($day >= $start_fc)
                                        {
                                            $deduction_date = $year.'-'.$month2.'-'.$pay_day_fc;
                                        }
                                        else if($day <= $end_fc)
                                        {
                                            $deduction_date = $year.'-'.$month.'-'.$pay_day_fc;
                                        }
                                        else
                                        {
                                            $deduction_date = $year.'-'.$month.'-'.$pay_day_sc;
                                        }
                                    }
                                    else
                                    {
                                        if($day >= $start_fc && $day <= $end_fc)
                                        {
                                            $deduction_date = $year.'-'.$month.'-'.$pay_day_fc;
                                        }
                                        else
                                        {
                                            $deduction_date = $year.'-'.$month2.'-'.$pay_day_sc;
                                        }
                                    }
                                }
                                else
                                {
                                    if($day >= $start_fc)
                                    {
                                        $deduction_date = $year.'-'.$month2.'-'.$pay_day_fc;
                                    }
                                    else if($day <= $end_fc)
                                    {
                                        $deduction_date = $year.'-'.$month.'-'.$pay_day_fc;
                                    }
                                    else
                                    {
                                        $deduction_date = $year.'-'.$month.'-'.$pay_day_sc;
                                    }
                                }
                            }
                        }
                        //==============================================================================================================
                        $vms_cutoff_date = '';
                        if($_POST['variance'] >= 30)
                        {
                            $cutoff_data = $this->liquidation_model->get_cutoff_model($_POST['ccode'],$_POST['bcode']);
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
                            $year = date("Y");
                            $month = date("m");
                            $month2 = date("m")+1;
                            $day = date("d");
                            $last_day = date("t");
                            if(!empty($cutoff_data))
                            {
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
                                if($day >= 24 || $day <= 8)
                                {
                                    $vms_cutoff_date = $month.'-'.'24'.'-'.$year.' / '.$month.'-'.'8'.'-'.$year;
                                }
                                else
                                {
                                    $vms_cutoff_date = $month.'-'.'9'.'-'.$year.' / '.$month.'-'.'23'.'-'.$year;
                                }
                            }
                        }
                        // ===============================================UPDATE==============================================================
                        $this->liquidation_model->adjust_zero_rs_model($_POST['cs_data_id'],$_POST['cs_den_id'],$_POST['tr_no'],$_POST['emp_id'],$_POST['registered_sales'],$_POST['variance'],$_POST['tr_count'],$balance,$type,$deduction_date,$vms_cutoff_date,$lo_id,$sup_id);
                        // ===============================================INSERT==============================================================
                        $message = 'success'; 
                        $this->liquidation_model->insert_adjusted_zero_rs_model($_POST['cs_data_id'],$_POST['cs_den_id'],$lo_id,$sup_id);
                        
                        echo json_encode($message);
                    }
                    else
                    {
                        $message = 'ALREADY ADJUSTED';
                        echo json_encode($message);
                    }
                }
                else
                {
                    $message = 'INVALID SUBORDINATES';
                    echo json_encode($message);
                }
            }
            else
            {
                $message = 'EMPTY';
                echo json_encode($message);
            }
        }
    }

    public function update_sales_date_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $lo_id = $_SESSION['emp_id'];
            // =================================================================================
            $sup_id = '';
            $managers_key_data = $this->liquidation_model->validate_managers_key_model($_POST['username'],$_POST['password']);
            if(!empty($managers_key_data))
            {
                $sup_id = $managers_key_data->emp_id;
                $matched_data = $this->liquidation_model->validate_subordinates_model($lo_id,$sup_id);
                if(!empty($matched_data))
                {
                    $batch_data = $this->liquidation_model->get_batch_remit_data_model($_POST['dcode'],$_POST['sales_date']);
                    $batch_remit = 1;
                    if(!empty($batch_data))
                    {
                        $batch_remit = $batch_data->batch_remit + 1;
                    }
                    // =======================================================================================================================
                    $date = new DateTime("now");
                    $curr_date = $date->format('Y-m-d');
                    $message = 'success'; 
                    $this->liquidation_model->update_sales_date_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['sales_date'],$batch_remit,$curr_date,$lo_id,$sup_id);
                
                    echo json_encode($message); 
                }
                else
                {
                    $message = 'INVALID SUBORDINATES';
                    echo json_encode($message);
                }
            }
            else
            {
                $message = 'EMPTY';
                echo json_encode($message);
            }
        }
    }

    public function adjust_batch_sales_date_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $lo_id = $_SESSION['emp_id'];
            // =================================================================================
            $sup_id = '';
            $managers_key_data = $this->liquidation_model->validate_managers_key_model($_POST['username'],$_POST['password']);
            if(!empty($managers_key_data))
            {
                $sup_id = $managers_key_data->emp_id;
                $matched_data = $this->liquidation_model->validate_subordinates_model($lo_id,$sup_id);
                if(!empty($matched_data))
                {
                    $date = new DateTime("now");
                    $curr_date = $date->format('Y-m-d');
                    // ========================================================================================
                    $info = explode("^",$_POST['info']);
                    $dcode = ''; 
                    $batch_remit = 0; 
                    for($a=0;$a<count($info);$a++)
                    {   
                        $info_exploded = explode("|",$info[$a]);
                        $dcode = $info_exploded[2]; 
                        $last_batch = $this->liquidation_model->get_last_batch_model($dcode,$_POST['new_date']);
                        $batch = 0;
                        if(!empty($last_batch))
                        {
                            $batch = $last_batch->batch_remit;
                            $batch_remit = $last_batch->batch_remit;
                        }
                        $this->liquidation_model->update_batch_sales_date_model($info_exploded[0],$info_exploded[1],$batch,$_POST['new_date'],$curr_date,$lo_id,$sup_id);
                    }
                    // =========================================================================================
                    $batch_remit = $batch_remit + 1; 
                    $message = 'success'; 
                    $this->liquidation_model->update_batch_counter_model($dcode,$batch_remit,$_POST['new_date']);
                    
                    echo json_encode($message); 
                }
                else
                {
                    $message = 'INVALID SUBORDINATES';
                    echo json_encode($message);
                }
            }
            else
            {
                $message = 'EMPTY';
                echo json_encode($message);
            }
        }
    }


    public function update_batch_counter_ctrl()
    {
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d');
        $batch_counter_data = $this->liquidation_model->get_last_batch_counter_model($_POST['dcode'],$curr_date);
        $batch = '';
        if(!empty($batch_counter_data))
        {
            $batch = $batch_counter_data->batch_remit + 1;
            $this->liquidation_model->update_batch_counter_model($_POST['dcode'],$batch,$curr_date);
        }
        else
        {
            $batch = 1;
            $this->liquidation_model->update_batch_counter_model($_POST['dcode'],$batch,$curr_date);
        }
    }

    public function view_mkey_modal_sales_date_adjustment_ctrl()
    {
        $cash_data =  $this->liquidation_model->validate_remitted_cash_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode']);
        $message = 'EMPTY';
        if(!empty($cash_data))
        {
            $message = 'NOT EMPTY';
        }

        echo json_encode($message);
    }

    public function validate_supervisor_approve_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $lo_id = $_SESSION['emp_id'];
            // =================================================================================
            $sup_id = '';
            $managers_key_data = $this->liquidation_model->validate_managers_key_model($_POST['username'],$_POST['password']);
            if(!empty($managers_key_data))
            {
                $sup_id = $managers_key_data->emp_id;
                $matched_data = $this->liquidation_model->validate_subordinates_model($lo_id,$sup_id);
                if(!empty($matched_data))
                {
                    $message = $sup_id;
                    echo json_encode($message);
                }
                else
                {
                    $message = 'INVALID SUBORDINATES';
                    echo json_encode($message);
                }
            }
            else
            {
                $message = 'EMPTY';
                echo json_encode($message);
            }
        }
    }

    public function delete_posted_denomination_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $lo_id = $_SESSION['emp_id'];
            // =================================================================================
            $sup_id = '';
            $managers_key_data = $this->liquidation_model->validate_managers_key_model($_POST['username'],$_POST['password']);
            if(!empty($managers_key_data))
            {
                $sup_id = $managers_key_data->emp_id;
                $matched_data = $this->liquidation_model->validate_subordinates_model($lo_id,$sup_id);
                if(!empty($matched_data))
                {
                    $message = 'success';
                    $this->liquidation_model->delete_posted_denomination_model($_POST['tr_no'],$_POST['emp_id'],$_POST['sscode'],$_POST['pos_name'],$_POST['sales_date'],$lo_id,$sup_id);
        
                    echo json_encode($message);
                }
                else
                {
                    $message = 'INVALID SUBORDINATES';
                    echo json_encode($message);
                }
            }
            else
            {
                $message = 'EMPTY';
                echo json_encode($message);
            }
        }
    }

    public function posted_denomination_ctrl()
    {
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d');
        // ===================================================================================
        $lo_id = $_SESSION['emp_id'];
        $transferred_data = $this->liquidation_model->posted_denomination_model($lo_id,$curr_date);
        $html='
                <form>
                    <table class="table table-bordered table-hover table-condensed display" id="posted_den_table">
                        <thead>
                            <tr>                                                            
                                <th style="vertical-align: middle;">
                                    <center>CASHIER NAME</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BUSINESS UNIT /<br>DEPARTMENT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TERMINAL &<br>COUNTER NO.</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>SALES DATE</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TYPE</center>
                                </th> 
                                <th style="vertical-align: middle;">
                                    <center>S.O.P AMT.</center>
                                </th>  
                                <th style="vertical-align: middle;">
                                    <center>TOTAL DEN.</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>REG. SALES</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BORROWED</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>ACTION</center>
                                </th>                            
                            </tr>
                        </thead>
                ';

        foreach($transferred_data as $trans)
        {
            $validate_cash_data = $this->liquidation_model->get_cash_denomination_model($trans['trno'],$trans['cashier_id'],$trans['sscode'],$curr_date);
            $validate_noncash_data = $this->liquidation_model->get_noncash_denomination_model($trans['trno'],$trans['cashier_id'],$trans['sscode'],$curr_date);
            if(!empty($validate_cash_data))
            {
                $dname = '';
                $sname = '';
                $ssname = '';
                $br1 = '';
                $br2 = '';
                $br3 = '';
                // ===============================================================================================================================
                $bunit_data = $this->liquidation_model->get_pisbunit_v2($trans['bcode']);
                // ================================================================================================================================
                $dept_data = $this->liquidation_model->get_pisdepartment_v2($trans['dcode']);
                if(!empty($dept_data))
                {
                    $dname = $dept_data->dept_name;
                    $br1 = '<br>';
                }
                // ==================================================================================================================================
                $section_data = $this->liquidation_model->get_section_v2($trans['scode']);
                if(!empty($section_data))
                {
                    $sname = $section_data->section_name;
                    $br2 = '<br>';
                }
                // ===================================================================================================================================
                $sub_section_data = $this->liquidation_model->get_subsection_v2($trans['sscode']);
                if(!empty($sub_section_data))
                {
                    $ssname = $sub_section_data->sub_section_name;
                    $br3 = '<br>';
                }
                // ==================================================================================================================================
                $cash_data = $this->liquidation_model->get_cash_denomination_model($trans['trno'],$trans['cashier_id'],$trans['sscode'],$curr_date);
                $noncash_data = $this->liquidation_model->get_noncash_denomination_model($trans['trno'],$trans['cashier_id'],$trans['sscode'],$curr_date);
                $pos_name = '';
                $counter_no = '';
                $borrowed = '';
                if(!empty($cash_data))
                {
                    foreach($cash_data as $cash)
                    {
                        $pos_name = $cash['pos_name'];
                        $counter_no = $cash['counter_no'];
                        $borrowed = $cash['borrowed'];
                    }
                }
                else
                {
                    if(!empty($noncash_data))
                    {
                        foreach($noncash_data as $noncash)
                        {
                            $pos_name = $noncash['pos_name'];
                            $counter_no = $noncash['counter_no'];
                            $borrowed = $noncash['borrowed'];
                        }
                    }
                }
                // ==================================================================================================================================
                $html.=' 
                        <tr style="word-wrap:break-word;">
                            <td style="vertical-align: middle;">'.$trans['cname'].'</td>
                            <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                            <td style="vertical-align: middle;">'.$pos_name.'<br>'.$counter_no.'</td>
                            <td style="vertical-align: middle;">'.$trans['dsales'].'</td>
                            <td style="vertical-align: middle;">'.$trans['sop_type'].'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['sop'], 2).'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['gtotal'], 2).'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['rsales'], 2).'</td>
                            <td style="vertical-align: middle;">'.$borrowed.'</td>
                            <td style="vertical-align: middle;">
                            <a id="cancel_btn" onclick="view_mkey_posted_denomination_js('."'".$trans['trno']."','".$trans['cashier_id']."','".$trans['sscode']."','".$pos_name."','".$curr_date."'".')"><i style="font-style: normal; font-size: large;">❌</i></a>
                            </td>
                        </tr>
                        '; 
            }
            else
            {
                if(!empty($validate_noncash_data))
                {
                    $validate_cash_data2 = $this->liquidation_model->validate_cash_model($trans['trno'],$trans['cashier_id'],$trans['sscode'],$curr_date);
                    if(empty($validate_cash_data2))
                    {
                        $dname = '';
                        $sname = '';
                        $ssname = '';
                        $br1 = '';
                        $br2 = '';
                        $br3 = '';
                        // ===============================================================================================================================
                        $bunit_data = $this->liquidation_model->get_pisbunit_v2($trans['bcode']);
                        // ================================================================================================================================
                        $dept_data = $this->liquidation_model->get_pisdepartment_v2($trans['dcode']);
                        if(!empty($dept_data))
                        {
                            $dname = $dept_data->dept_name;
                            $br1 = '<br>';
                        }
                        // ==================================================================================================================================
                        $section_data = $this->liquidation_model->get_section_v2($trans['scode']);
                        if(!empty($section_data))
                        {
                            $sname = $section_data->section_name;
                            $br2 = '<br>';
                        }
                        // ===================================================================================================================================
                        $sub_section_data = $this->liquidation_model->get_subsection_v2($trans['sscode']);
                        if(!empty($sub_section_data))
                        {
                            $ssname = $sub_section_data->sub_section_name;
                            $br3 = '<br>';
                        }
                        // ==================================================================================================================================
                        $cash_data = $this->liquidation_model->get_cash_denomination_model($trans['trno'],$trans['cashier_id'],$trans['sscode'],$curr_date);
                        $noncash_data = $this->liquidation_model->get_noncash_denomination_model($trans['trno'],$trans['cashier_id'],$trans['sscode'],$curr_date);
                        $pos_name = '';
                        $counter_no = '';
                        $borrowed = '';
                        if(!empty($cash_data))
                        {
                            foreach($cash_data as $cash)
                            {
                                $pos_name = $cash['pos_name'];
                                $counter_no = $cash['counter_no'];
                                $borrowed = $cash['borrowed'];
                            }
                        }
                        else
                        {
                            if(!empty($noncash_data))
                            {
                                foreach($noncash_data as $noncash)
                                {
                                    $pos_name = $noncash['pos_name'];
                                    $counter_no = $noncash['counter_no'];
                                    $borrowed = $noncash['borrowed'];
                                }
                            }
                        }
                        // ==================================================================================================================================
                        $html.=' 
                                <tr style="word-wrap:break-word;">
                                    <td style="vertical-align: middle;">'.$trans['cname'].'</td>
                                    <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                                    <td style="vertical-align: middle;">'.$pos_name.'<br>'.$counter_no.'</td>
                                    <td style="vertical-align: middle;">'.$trans['dsales'].'</td>
                                    <td style="vertical-align: middle;">'.$trans['sop_type'].'</td>
                                    <td style="vertical-align: middle;">'.number_format($trans['sop'], 2).'</td>
                                    <td style="vertical-align: middle;">'.number_format($trans['gtotal'], 2).'</td>
                                    <td style="vertical-align: middle;">'.number_format($trans['rsales'], 2).'</td>
                                    <td style="vertical-align: middle;">'.$borrowed.'</td>
                                    <td style="vertical-align: middle;">
                                    <a id="cancel_btn" onclick="view_mkey_posted_denomination_js('."'".$trans['trno']."','".$trans['cashier_id']."','".$trans['sscode']."','".$pos_name."','".$curr_date."'".')"><i style="font-style: normal; font-size: large;">❌</i></a>
                                    </td>
                                </tr>
                                '; 
                    }
                }
            }
        }
        
        $html.='                      
                        </table>
                    </form> 
                    ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function posted_zero_registered_sales_ctrl()
    {
        $lo_id = $_SESSION['emp_id'];
        $transferred_data = $this->liquidation_model->posted_zero_registered_sales_model($lo_id);
        $html='
                <form>
                    <table class="table table-bordered table-hover table-condensed display" id="posted_zero_rs_table">
                        <thead>
                            <tr>                                                            
                                <th style="vertical-align: middle;">
                                    <center>CASHIER NAME</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BUSINESS UNIT /<br>DEPARTMENT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TERMINAL &<br>COUNTER NO.</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>SALES DATE</center>
                                </th>  
                                <th style="vertical-align: middle;">
                                    <center>TOTAL SALES</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>REG. SALES</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TYPE</center>
                                </th> 
                                <th style="vertical-align: middle;">
                                    <center>AMOUNT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BORROWED</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>ACTION</center>
                                </th>                            
                            </tr>
                        </thead>
                ';

        foreach($transferred_data as $trans)
        {
            $validate_cash_data = $this->liquidation_model->get_cash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
            $validate_noncash_data = $this->liquidation_model->get_noncash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
            if(!empty($validate_cash_data))
            {
                $dname = '';
                $sname = '';
                $ssname = '';
                $br1 = '';
                $br2 = '';
                $br3 = '';
                // ===============================================================================================================================
                $bunit_data = $this->liquidation_model->get_pisbunit_v2($trans['bcode']);
                // ================================================================================================================================
                $dept_data = $this->liquidation_model->get_pisdepartment_v2($trans['dcode']);
                if(!empty($dept_data))
                {
                    $dname = $dept_data->dept_name;
                    $br1 = '<br>';
                }
                // ==================================================================================================================================
                $section_data = $this->liquidation_model->get_section_v2($trans['scode']);
                if(!empty($section_data))
                {
                    $sname = $section_data->section_name;
                    $br2 = '<br>';
                }
                // ===================================================================================================================================
                $sub_section_data = $this->liquidation_model->get_subsection_v2($trans['sscode']);
                if(!empty($sub_section_data))
                {
                    $ssname = $sub_section_data->sub_section_name;
                    $br3 = '<br>';
                }
                // ==================================================================================================================================
                $cash_data = $this->liquidation_model->get_cash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                $noncash_data = $this->liquidation_model->get_noncash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                $pos_name = '';
                $counter_no = '';
                $borrowed = '';
                if(!empty($cash_data))
                {
                    foreach($cash_data as $cash)
                    {
                        $pos_name = $cash['pos_name'];
                        $counter_no = $cash['counter_no'];
                        $borrowed = $cash['borrowed'];
                    }
                }
                else
                {
                    if(!empty($noncash_data))
                    {
                        foreach($noncash_data as $noncash)
                        {
                            $pos_name = $noncash['pos_name'];
                            $counter_no = $noncash['counter_no'];
                            $borrowed = $noncash['borrowed'];
                        }
                    }
                }
                // ==================================================================================================================================
                $html.=' 
                        <tr style="word-wrap:break-word;">
                            <td style="vertical-align: middle;">'.$trans['cname'].'</td>
                            <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                            <td style="vertical-align: middle;">'.$pos_name.'<br>'.$counter_no.'</td>
                            <td style="vertical-align: middle;">'.$trans['dsales'].'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['gtotal'], 2).'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['rsales'], 2).'</td>
                            <td style="vertical-align: middle;">'.$trans['sop_type'].'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['sop'], 2).'</td>
                            <td style="vertical-align: middle;">'.$borrowed.'</td>
                            <td style="vertical-align: middle;">
                            <a id="cancel_btn" onclick="view_rs_adjustment_modal_js('."'".$trans['cs_data_id']."','".$trans['cs_den_id']."','".$trans['trno']."','".$trans['cashier_id']."','".$trans['cname']."','".$trans['company_code']."','".$trans['bunit_code']."','".$trans['sscode']."','".$pos_name."','".$borrowed."','".$trans['dsales']."','".number_format($trans['gtotal'], 2)."'".')"><i style="font-style: normal; font-size: large;">✏️</i></a>
                            </td>
                        </tr>
                        '; 
            }
            else
            {
                if(!empty($validate_noncash_data))
                {
                    $dname = '';
                    $sname = '';
                    $ssname = '';
                    $br1 = '';
                    $br2 = '';
                    $br3 = '';
                    // ===============================================================================================================================
                    $bunit_data = $this->liquidation_model->get_pisbunit_v2($trans['bcode']);
                    // ================================================================================================================================
                    $dept_data = $this->liquidation_model->get_pisdepartment_v2($trans['dcode']);
                    if(!empty($dept_data))
                    {
                        $dname = $dept_data->dept_name;
                        $br1 = '<br>';
                    }
                    // ==================================================================================================================================
                    $section_data = $this->liquidation_model->get_section_v2($trans['scode']);
                    if(!empty($section_data))
                    {
                        $sname = $section_data->section_name;
                        $br2 = '<br>';
                    }
                    // ===================================================================================================================================
                    $sub_section_data = $this->liquidation_model->get_subsection_v2($trans['sscode']);
                    if(!empty($sub_section_data))
                    {
                        $ssname = $sub_section_data->sub_section_name;
                        $br3 = '<br>';
                    }
                    // ==================================================================================================================================
                    $cash_data = $this->liquidation_model->get_cash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                    $noncash_data = $this->liquidation_model->get_noncash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                    $pos_name = '';
                    $counter_no = '';
                    $borrowed = '';
                    if(!empty($cash_data))
                    {
                        foreach($cash_data as $cash)
                        {
                            $pos_name = $cash['pos_name'];
                            $counter_no = $cash['counter_no'];
                            $borrowed = $cash['borrowed'];
                        }
                    }
                    else
                    {
                        if(!empty($noncash_data))
                        {
                            foreach($noncash_data as $noncash)
                            {
                                $pos_name = $noncash['pos_name'];
                                $counter_no = $noncash['counter_no'];
                                $borrowed = $noncash['borrowed'];
                            }
                        }
                    }
                    // ==================================================================================================================================
                    $html.=' 
                            <tr style="word-wrap:break-word;">
                                <td style="vertical-align: middle;">'.$trans['cname'].'</td>
                                <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                                <td style="vertical-align: middle;">'.$pos_name.'<br>'.$counter_no.'</td>
                                <td style="vertical-align: middle;">'.$trans['dsales'].'</td>
                                <td style="vertical-align: middle;">'.number_format($trans['gtotal'], 2).'</td>
                                <td style="vertical-align: middle;">'.number_format($trans['rsales'], 2).'</td>
                                <td style="vertical-align: middle;">'.$trans['sop_type'].'</td>
                                <td style="vertical-align: middle;">'.number_format($trans['sop'], 2).'</td>
                                <td style="vertical-align: middle;">'.$borrowed.'</td>
                                <td style="vertical-align: middle;">
                                <a id="cancel_btn" onclick="view_rs_adjustment_modal_js('."'".$trans['cs_data_id']."','".$trans['cs_den_id']."','".$trans['trno']."','".$trans['cashier_id']."','".$trans['cname']."','".$trans['company_code']."','".$trans['bunit_code']."','".$trans['sscode']."','".$pos_name."','".$borrowed."','".$trans['dsales']."','".number_format($trans['gtotal'], 2)."'".')"><i style="font-style: normal; font-size: large;">✏️</i></a>
                                </td>
                            </tr>
                            '; 
                }
            }
        }
        
        $html.='                      
                        </table>
                    </form> 
                    ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function sales_date_adjustment_table_ctrl()
    {
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d');
        $lo_id = $_SESSION['emp_id']; 
        $transferred_data = $this->liquidation_model->sales_date_adjustment_table_model($lo_id,$curr_date);
        $html='
                <form>
                    <table class="table table-bordered table-hover table-condensed display" id="sales_date_adjustment_table">
                        <thead>
                            <tr>                                                            
                                <th style="vertical-align: middle;">
                                    <center>CASHIER NAME</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BUSINESS UNIT /<br>DEPARTMENT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TERMINAL &<br>COUNTER NO.</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>SALES DATE</center>
                                </th>  
                                <th style="vertical-align: middle;">
                                    <center>TOTAL SALES</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>REG. SALES</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TYPE</center>
                                </th> 
                                <th style="vertical-align: middle;">
                                    <center>AMOUNT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BORROWED</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>ACTION</center>
                                </th>                            
                            </tr>
                        </thead>
                ';

        foreach($transferred_data as $trans)
        {
            $validate_cash_data = $this->liquidation_model->get_cash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
            $validate_noncash_data = $this->liquidation_model->get_noncash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
            if(!empty($validate_cash_data))
            {
                $dname = '';
                $sname = '';
                $ssname = '';
                $br1 = '';
                $br2 = '';
                $br3 = '';
                // ===============================================================================================================================
                $bunit_data = $this->liquidation_model->get_pisbunit_v2($trans['bcode']);
                // ================================================================================================================================
                $dept_data = $this->liquidation_model->get_pisdepartment_v2($trans['dcode']);
                if(!empty($dept_data))
                {
                    $dname = $dept_data->dept_name;
                    $br1 = '<br>';
                }
                // ==================================================================================================================================
                $section_data = $this->liquidation_model->get_section_v2($trans['scode']);
                if(!empty($section_data))
                {
                    $sname = $section_data->section_name;
                    $br2 = '<br>';
                }
                // ===================================================================================================================================
                $sub_section_data = $this->liquidation_model->get_subsection_v2($trans['sscode']);
                if(!empty($sub_section_data))
                {
                    $ssname = $sub_section_data->sub_section_name;
                    $br3 = '<br>';
                }
                // ==================================================================================================================================
                $cash_data = $this->liquidation_model->get_cash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                $noncash_data = $this->liquidation_model->get_noncash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                $pos_name = '';
                $counter_no = '';
                $borrowed = '';
                if(!empty($cash_data))
                {
                    foreach($cash_data as $cash)
                    {
                        $pos_name = $cash['pos_name'];
                        $counter_no = $cash['counter_no'];
                        $borrowed = $cash['borrowed'];
                    }
                }
                else
                {
                    if(!empty($noncash_data))
                    {
                        foreach($noncash_data as $noncash)
                        {
                            $pos_name = $noncash['pos_name'];
                            $counter_no = $noncash['counter_no'];
                            $borrowed = $noncash['borrowed'];
                        }
                    }
                }
                // ==================================================================================================================================
                $html.=' 
                        <tr style="word-wrap:break-word;">
                            <td style="vertical-align: middle;">'.$trans['cname'].'</td>
                            <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                            <td style="vertical-align: middle;">'.$pos_name.'<br>'.$counter_no.'</td>
                            <td style="vertical-align: middle;">'.$trans['dsales'].'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['gtotal'], 2).'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['rsales'], 2).'</td>
                            <td style="vertical-align: middle;">'.$trans['sop_type'].'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['sop'], 2).'</td>
                            <td style="vertical-align: middle;">'.$borrowed.'</td>
                            <td style="vertical-align: middle;">
                            <a id="cancel_btn" onclick="view_sales_date_adjustment_modal_js('."'".$trans['trno']."','".$trans['cashier_id']."','".$trans['cname']."','".$trans['dcode']."','".$trans['sscode']."'".')"><i style="font-style: normal; font-size: large;">✏️</i></a>
                            </td>
                        </tr>
                        '; 
            }
            else
            {
                if(!empty($validate_noncash_data))
                {
                    $dname = '';
                    $sname = '';
                    $ssname = '';
                    $br1 = '';
                    $br2 = '';
                    $br3 = '';
                    // ===============================================================================================================================
                    $bunit_data = $this->liquidation_model->get_pisbunit_v2($trans['bcode']);
                    // ================================================================================================================================
                    $dept_data = $this->liquidation_model->get_pisdepartment_v2($trans['dcode']);
                    if(!empty($dept_data))
                    {
                        $dname = $dept_data->dept_name;
                        $br1 = '<br>';
                    }
                    // ==================================================================================================================================
                    $section_data = $this->liquidation_model->get_section_v2($trans['scode']);
                    if(!empty($section_data))
                    {
                        $sname = $section_data->section_name;
                        $br2 = '<br>';
                    }
                    // ===================================================================================================================================
                    $sub_section_data = $this->liquidation_model->get_subsection_v2($trans['sscode']);
                    if(!empty($sub_section_data))
                    {
                        $ssname = $sub_section_data->sub_section_name;
                        $br3 = '<br>';
                    }
                    // ==================================================================================================================================
                    $cash_data = $this->liquidation_model->get_cash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                    $noncash_data = $this->liquidation_model->get_noncash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                    $pos_name = '';
                    $counter_no = '';
                    $borrowed = '';
                    if(!empty($cash_data))
                    {
                        foreach($cash_data as $cash)
                        {
                            $pos_name = $cash['pos_name'];
                            $counter_no = $cash['counter_no'];
                            $borrowed = $cash['borrowed'];
                        }
                    }
                    else
                    {
                        if(!empty($noncash_data))
                        {
                            foreach($noncash_data as $noncash)
                            {
                                $pos_name = $noncash['pos_name'];
                                $counter_no = $noncash['counter_no'];
                                $borrowed = $noncash['borrowed'];
                            }
                        }
                    }
                    // ==================================================================================================================================
                    $html.=' 
                            <tr style="word-wrap:break-word;">
                                <td style="vertical-align: middle;">'.$trans['cname'].'</td>
                                <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                                <td style="vertical-align: middle;">'.$pos_name.'<br>'.$counter_no.'</td>
                                <td style="vertical-align: middle;">'.$trans['dsales'].'</td>
                                <td style="vertical-align: middle;">'.number_format($trans['gtotal'], 2).'</td>
                                <td style="vertical-align: middle;">'.number_format($trans['rsales'], 2).'</td>
                                <td style="vertical-align: middle;">'.$trans['sop_type'].'</td>
                                <td style="vertical-align: middle;">'.number_format($trans['sop'], 2).'</td>
                                <td style="vertical-align: middle;">'.$borrowed.'</td>
                                <td style="vertical-align: middle;">
                                <a id="cancel_btn" onclick="view_sales_date_adjustment_modal_js('."'".$trans['trno']."','".$trans['cashier_id']."','".$trans['cname']."','".$trans['dcode']."','".$trans['sscode']."'".')"><i style="font-style: normal; font-size: large;">✏️</i></a>
                                </td>
                            </tr>
                            '; 
                }
            }
        }
        
        $html.='                      
                        </table>
                    </form> 
                    ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function get_deleted_posted_denomination_ctrl()
    {
        $lo_id = $_SESSION['emp_id'];
        $transferred_data = $this->liquidation_model->get_deleted_posted_denomination_model($lo_id);
        $html='
                <form>
                    <table class="table table-bordered table-hover table-condensed display" id="deleted_posted_den_table">
                        <thead>
                            <tr>                                                            
                                <th style="vertical-align: middle;">
                                    <center>CASHIER NAME</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BUSINESS UNIT /<br>DEPARTMENT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TERMINAL &<br>COUNTER NO.</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>SALES DATE</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TYPE</center>
                                </th> 
                                <th style="vertical-align: middle;">
                                    <center>S.O.P AMT.</center>
                                </th>  
                                <th style="vertical-align: middle;">
                                    <center>TOTAL DEN.</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>REG. SALES</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BORROWED</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>REQUESTED DELETE</center>
                                </th> 
                                <th style="vertical-align: middle;">
                                    <center>APPROVED DELETE</center>
                                </th> 
                                <th style="vertical-align: middle;">
                                    <center>DATE/TIME DELETED</center>
                                </th>                            
                            </tr>
                        </thead>
                ';

        foreach($transferred_data as $trans)
        {
            $validate_cash_data = $this->liquidation_model->get_cash_denomination_model_v2($trans['trno'],$trans['cashier_id'],$trans['sscode']);
            $validate_noncash_data = $this->liquidation_model->get_noncash_denomination_model_v2($trans['trno'],$trans['cashier_id'],$trans['sscode']);
            if(!empty($validate_cash_data))
            {
                $dname = '';
                $sname = '';
                $ssname = '';
                $br1 = '';
                $br2 = '';
                $br3 = '';
                // ===============================================================================================================================
                $bunit_data = $this->liquidation_model->get_pisbunit_v2($trans['bcode']);
                // ================================================================================================================================
                $dept_data = $this->liquidation_model->get_pisdepartment_v2($trans['dcode']);
                if(!empty($dept_data))
                {
                    $dname = $dept_data->dept_name;
                    $br1 = '<br>';
                }
                // ==================================================================================================================================
                $section_data = $this->liquidation_model->get_section_v2($trans['scode']);
                if(!empty($section_data))
                {
                    $sname = $section_data->section_name;
                    $br2 = '<br>';
                }
                // ===================================================================================================================================
                $sub_section_data = $this->liquidation_model->get_subsection_v2($trans['sscode']);
                if(!empty($sub_section_data))
                {
                    $ssname = $sub_section_data->sub_section_name;
                    $br3 = '<br>';
                }
                // ==================================================================================================================================
                $cash_data = $this->liquidation_model->get_cash_denomination_model_v2($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                $noncash_data = $this->liquidation_model->get_noncash_denomination_model_v2($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                $pos_name = '';
                $counter_no = '';
                $borrowed = '';
                if(!empty($cash_data))
                {
                    foreach($cash_data as $cash)
                    {
                        $pos_name = $cash['pos_name'];
                        $counter_no = $cash['counter_no'];
                        $borrowed = $cash['borrowed'];
                    }
                }
                else
                {
                    if(!empty($noncash_data))
                    {
                        foreach($noncash_data as $noncash)
                        {
                            $pos_name = $noncash['pos_name'];
                            $counter_no = $noncash['counter_no'];
                            $borrowed = $noncash['borrowed'];
                        }
                    }
                }
                // ==================================================================================================================================
                $lo_name = '';
                $lo_data = $this->liquidation_model->emp_data_model($trans['requested_delete']);
                if(!empty($lo_data))
                {
                    $lo_name = $lo_data->name;
                }
                // ==================================================================================================================================
                $sup_name = '';
                $sup_data = $this->liquidation_model->emp_data_model($trans['approved_delete']);
                if(!empty($sup_data))
                {
                    $sup_name = $sup_data->name;
                }
                // ==================================================================================================================================
                $html.=' 
                        <tr style="word-wrap:break-word;">
                            <td style="vertical-align: middle;">'.$trans['cname'].'</td>
                            <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                            <td style="vertical-align: middle;">'.$pos_name.'<br>'.$counter_no.'</td>
                            <td style="vertical-align: middle;">'.$trans['dsales'].'</td>
                            <td style="vertical-align: middle;">'.$trans['sop_type'].'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['sop'], 2).'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['gtotal'], 2).'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['rsales'], 2).'</td>
                            <td style="vertical-align: middle;">'.$borrowed.'</td>
                            <td style="vertical-align: middle;">'.$lo_name.'</td>
                            <td style="vertical-align: middle;">'.$sup_name.'</td>
                            <td style="vertical-align: middle;">'.$trans['date_time_deleted'].'</td>
                        </tr>
                        '; 
            }
            else
            {
                if(!empty($validate_noncash_data))
                {
                    $dname = '';
                    $sname = '';
                    $ssname = '';
                    $br1 = '';
                    $br2 = '';
                    $br3 = '';
                    // ===============================================================================================================================
                    $bunit_data = $this->liquidation_model->get_pisbunit_v2($trans['bcode']);
                    // ================================================================================================================================
                    $dept_data = $this->liquidation_model->get_pisdepartment_v2($trans['dcode']);
                    if(!empty($dept_data))
                    {
                        $dname = $dept_data->dept_name;
                        $br1 = '<br>';
                    }
                    // ==================================================================================================================================
                    $section_data = $this->liquidation_model->get_section_v2($trans['scode']);
                    if(!empty($section_data))
                    {
                        $sname = $section_data->section_name;
                        $br2 = '<br>';
                    }
                    // ===================================================================================================================================
                    $sub_section_data = $this->liquidation_model->get_subsection_v2($trans['sscode']);
                    if(!empty($sub_section_data))
                    {
                        $ssname = $sub_section_data->sub_section_name;
                        $br3 = '<br>';
                    }
                    // ==================================================================================================================================
                    $cash_data = $this->liquidation_model->get_cash_denomination_model_v2($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                    $noncash_data = $this->liquidation_model->get_noncash_denomination_model_v2($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                    $pos_name = '';
                    $counter_no = '';
                    $borrowed = '';
                    if(!empty($cash_data))
                    {
                        foreach($cash_data as $cash)
                        {
                            $pos_name = $cash['pos_name'];
                            $counter_no = $cash['counter_no'];
                            $borrowed = $cash['borrowed'];
                        }
                    }
                    else
                    {
                        if(!empty($noncash_data))
                        {
                            foreach($noncash_data as $noncash)
                            {
                                $pos_name = $noncash['pos_name'];
                                $counter_no = $noncash['counter_no'];
                                $borrowed = $noncash['borrowed'];
                            }
                        }
                    }
                    // ==================================================================================================================================
                    $lo_name = '';
                    $lo_data = $this->liquidation_model->emp_data_model($trans['requested_delete']);
                    if(!empty($lo_data))
                    {
                        $lo_name = $lo_data->name;
                    }
                    // ==================================================================================================================================
                    $sup_name = '';
                    $sup_data = $this->liquidation_model->emp_data_model($trans['approved_delete']);
                    if(!empty($sup_data))
                    {
                        $sup_name = $sup_data->name;
                    }
                    // ==================================================================================================================================
                    $html.=' 
                            <tr style="word-wrap:break-word;">
                                <td style="vertical-align: middle;">'.$trans['cname'].'</td>
                                <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                                <td style="vertical-align: middle;">'.$pos_name.'<br>'.$counter_no.'</td>
                                <td style="vertical-align: middle;">'.$trans['dsales'].'</td>
                                <td style="vertical-align: middle;">'.$trans['sop_type'].'</td>
                                <td style="vertical-align: middle;">'.number_format($trans['sop'], 2).'</td>
                                <td style="vertical-align: middle;">'.number_format($trans['gtotal'], 2).'</td>
                                <td style="vertical-align: middle;">'.number_format($trans['rsales'], 2).'</td>
                                <td style="vertical-align: middle;">'.$borrowed.'</td>
                                <td style="vertical-align: middle;">'.$lo_name.'</td>
                                <td style="vertical-align: middle;">'.$sup_name.'</td>
                                <td style="vertical-align: middle;">'.$trans['date_time_deleted'].'</td>
                            </tr>
                            '; 
                }
            }
        }
        
        $html.='                      
                        </table>
                    </form> 
                    ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function view_deleted_remitted_cash_ctrl()
    { 
        $lo_id = $_SESSION['emp_id'];
        $deleted_remitted_data = $this->liquidation_model->get_deleted_remitted_cash_model($lo_id);
        $html='
                <table class="table table-bordered table-hover table-condensed display" id="partial_remitted_cash_table">
                    <thead>
                        <tr>    
                            <th style="vertical-align: middle;">
                                <center>DEPARTMENT</center>
                            </th>  
                            <th style="vertical-align: middle;">
                                <center>SALES DATE</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>BATCH</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>AMOUNT</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>REQUESTED DELETE</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>APPROVED DELETE</center>
                            </th>
                            <th style="vertical-align: middle;">
                                <center>DATE/TIME DELETED</center>
                            </th>                            
                        </tr>
                    </thead>
                ';

        foreach($deleted_remitted_data as $deleted)
        {
            $dept_data = $this->liquidation_model->get_pisdepartment_v2($deleted['dcode']);
            $dname = '';
            if(!empty($dept_data))
            {
                $dname = $dept_data->dept_name;
            }
            // ==================================================================================
            $lo_data = $this->liquidation_model->get_pisdata($deleted['requested_delete']);
            $lo_name = '';
            foreach($lo_data as $lo)
            {
                 $lo_name = $lo['name'];
            }
            // ==================================================================================
            $sup_data = $this->liquidation_model->get_pisdata($deleted['approved_delete']);
            $sup_name = '';
            foreach($sup_data as $sup)
            {
                 $sup_name = $sup['name'];
            }
            // ===================================================================================
            $cash_data = $this->liquidation_model->get_deleted_cash_amount_model($deleted['cash_id']);
            $deleted_amount = 0; 
            foreach($cash_data as $cash)
            {
                $deleted_amount = $cash['total_cash']; 
            } 
            // ===================================================================================
            $html.=' 
                    <tr style="word-wrap:break-word;">
                        <td style="vertical-align: middle;">'.$dname.'</td>
                        <td style="vertical-align: middle;">'.$deleted['sales_date'].'</td>
                        <td style="vertical-align: middle;">'.$deleted['batch_remit'].'</td>
                        <td style="vertical-align: middle;">'.number_format($deleted_amount, 2).'</td>
                        <td style="vertical-align: middle;">'.$lo_name.'</td>
                        <td style="vertical-align: middle;">'.$sup_name.'</td>
                        <td style="vertical-align: middle;">'.$deleted['date_deleted'].'</td>
                    </tr>
                    '; 
        }
        
        $html.='                      
                </table>
               ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function adjusted_zero_registered_sales_ctrl()
    {
        $lo_id = $_SESSION['emp_id'];
        $transferred_data = $this->liquidation_model->adjusted_zero_registered_sales_model($lo_id);
        $html='
                <form>
                    <table class="table table-bordered table-hover table-condensed display" id="adjusted_zero_rs_table">
                        <thead>
                            <tr>                                                            
                                <th style="vertical-align: middle;">
                                    <center>CASHIER NAME</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BUSINESS UNIT /<br>DEPARTMENT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TERMINAL &<br>COUNTER NO.</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>SALES DATE</center>
                                </th>  
                                <th style="vertical-align: middle;">
                                    <center>TOTAL SALES</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>REG. SALES</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TYPE</center>
                                </th> 
                                <th style="vertical-align: middle;">
                                    <center>AMOUNT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BORROWED</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>ADJUSTED OFFICER</center>
                                </th>     
                                <th style="vertical-align: middle;">
                                    <center>APPROVED OFFICER</center>
                                </th>   
                                <th style="vertical-align: middle;">
                                    <center>DATE/TIME ADJUSTED</center>
                                </th>                              
                            </tr>
                        </thead>
                ';

        foreach($transferred_data as $trans)
        {
            $lo_name = '';
            $lo_data = $this->liquidation_model->emp_data_model($trans['adjusted_officer']);
            if(!empty($lo_data))
            {
                $lo_name = $lo_data->name;
            }
            // ==================================================================================================================================
            $sup_name = '';
            $sup_data = $this->liquidation_model->emp_data_model($trans['approved_officer']);
            if(!empty($sup_data))
            {
                $sup_name = $sup_data->name;
            }
            // ==================================================================================================================================
            $validate_cash_data = $this->liquidation_model->get_cash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
            $validate_noncash_data = $this->liquidation_model->get_noncash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
            if(!empty($validate_cash_data))
            {
                $dname = '';
                $sname = '';
                $ssname = '';
                $br1 = '';
                $br2 = '';
                $br3 = '';
                // ===============================================================================================================================
                $bunit_data = $this->liquidation_model->get_pisbunit_v2($trans['bcode']);
                // ================================================================================================================================
                $dept_data = $this->liquidation_model->get_pisdepartment_v2($trans['dcode']);
                if(!empty($dept_data))
                {
                    $dname = $dept_data->dept_name;
                    $br1 = '<br>';
                }
                // ==================================================================================================================================
                $section_data = $this->liquidation_model->get_section_v2($trans['scode']);
                if(!empty($section_data))
                {
                    $sname = $section_data->section_name;
                    $br2 = '<br>';
                }
                // ===================================================================================================================================
                $sub_section_data = $this->liquidation_model->get_subsection_v2($trans['sscode']);
                if(!empty($sub_section_data))
                {
                    $ssname = $sub_section_data->sub_section_name;
                    $br3 = '<br>';
                }
                // ==================================================================================================================================
                $cash_data = $this->liquidation_model->get_cash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                $noncash_data = $this->liquidation_model->get_noncash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                $pos_name = '';
                $counter_no = '';
                $borrowed = '';
                if(!empty($cash_data))
                {
                    foreach($cash_data as $cash)
                    {
                        $pos_name = $cash['pos_name'];
                        $counter_no = $cash['counter_no'];
                        $borrowed = $cash['borrowed'];
                    }
                }
                else
                {
                    if(!empty($noncash_data))
                    {
                        foreach($noncash_data as $noncash)
                        {
                            $pos_name = $noncash['pos_name'];
                            $counter_no = $noncash['counter_no'];
                            $borrowed = $noncash['borrowed'];
                        }
                    }
                }
                // ==================================================================================================================================
                $html.=' 
                        <tr style="word-wrap:break-word;">
                            <td style="vertical-align: middle;">'.$trans['cname'].'</td>
                            <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                            <td style="vertical-align: middle;">'.$pos_name.'<br>'.$counter_no.'</td>
                            <td style="vertical-align: middle;">'.$trans['dsales'].'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['gtotal'], 2).'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['rsales'], 2).'</td>
                            <td style="vertical-align: middle;">'.$trans['sop_type'].'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['sop'], 2).'</td>
                            <td style="vertical-align: middle;">'.$borrowed.'</td>
                            <td style="vertical-align: middle;">'.$lo_name.'</td>
                            <td style="vertical-align: middle;">'.$sup_name.'</td>
                            <td style="vertical-align: middle;">'.$trans['date_adjusted'].'</td>
                        </tr>
                        '; 
            }
            else
            {
                if(!empty($validate_noncash_data))
                {
                    if(empty($validate_cash_data))
                    {
                        $dname = '';
                        $sname = '';
                        $ssname = '';
                        $br1 = '';
                        $br2 = '';
                        $br3 = '';
                        // ===============================================================================================================================
                        $bunit_data = $this->liquidation_model->get_pisbunit_v2($trans['bcode']);
                        // ================================================================================================================================
                        $dept_data = $this->liquidation_model->get_pisdepartment_v2($trans['dcode']);
                        if(!empty($dept_data))
                        {
                            $dname = $dept_data->dept_name;
                            $br1 = '<br>';
                        }
                        // ==================================================================================================================================
                        $section_data = $this->liquidation_model->get_section_v2($trans['scode']);
                        if(!empty($section_data))
                        {
                            $sname = $section_data->section_name;
                            $br2 = '<br>';
                        }
                        // ===================================================================================================================================
                        $sub_section_data = $this->liquidation_model->get_subsection_v2($trans['sscode']);
                        if(!empty($sub_section_data))
                        {
                            $ssname = $sub_section_data->sub_section_name;
                            $br3 = '<br>';
                        }
                        // ==================================================================================================================================
                        $cash_data = $this->liquidation_model->get_cash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                        $noncash_data = $this->liquidation_model->get_noncash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                        $pos_name = '';
                        $counter_no = '';
                        $borrowed = '';
                        if(!empty($cash_data))
                        {
                            foreach($cash_data as $cash)
                            {
                                $pos_name = $cash['pos_name'];
                                $counter_no = $cash['counter_no'];
                                $borrowed = $cash['borrowed'];
                            }
                        }
                        else
                        {
                            if(!empty($noncash_data))
                            {
                                foreach($noncash_data as $noncash)
                                {
                                    $pos_name = $noncash['pos_name'];
                                    $counter_no = $noncash['counter_no'];
                                    $borrowed = $noncash['borrowed'];
                                }
                            }
                        }
                        // ==================================================================================================================================
                        $html.=' 
                                <tr style="word-wrap:break-word;">
                                    <td style="vertical-align: middle;">'.$trans['cname'].'</td>
                                    <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                                    <td style="vertical-align: middle;">'.$pos_name.'<br>'.$counter_no.'</td>
                                    <td style="vertical-align: middle;">'.$trans['dsales'].'</td>
                                    <td style="vertical-align: middle;">'.number_format($trans['gtotal'], 2).'</td>
                                    <td style="vertical-align: middle;">'.number_format($trans['rsales'], 2).'</td>
                                    <td style="vertical-align: middle;">'.$trans['sop_type'].'</td>
                                    <td style="vertical-align: middle;">'.number_format($trans['sop'], 2).'</td>
                                    <td style="vertical-align: middle;">'.$borrowed.'</td>
                                    <td style="vertical-align: middle;">'.$lo_name.'</td>
                                    <td style="vertical-align: middle;">'.$sup_name.'</td>
                                    <td style="vertical-align: middle;">'.$trans['date_adjusted'].'</td>
                                </tr>
                                '; 
                    }
                }
            }
        }
        
        $html.='                      
                        </table>
                    </form> 
                    ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function get_adjusted_sales_date_ctrl()
    {
        $lo_id = $_SESSION['emp_id'];
        $transferred_data = $this->liquidation_model->get_adjusted_sales_date_model($lo_id);
        $html='
                <form>
                    <table class="table table-bordered table-hover table-condensed display" id="adjusted_sales_date_table">
                        <thead>
                            <tr>                                                            
                                <th style="vertical-align: middle;">
                                    <center>CASHIER NAME</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BUSINESS UNIT /<br>DEPARTMENT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TERMINAL &<br>COUNTER NO.</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>OLD SALES DATE</center>
                                </th> 
                                <th style="vertical-align: middle;">
                                    <center>NEW SALES DATE</center>
                                </th>  
                                <th style="vertical-align: middle;">
                                    <center>TOTAL SALES</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>REG. SALES</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>TYPE</center>
                                </th> 
                                <th style="vertical-align: middle;">
                                    <center>AMOUNT</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>BORROWED</center>
                                </th>
                                <th style="vertical-align: middle;">
                                    <center>ADJUSTED OFFICER</center>
                                </th>     
                                <th style="vertical-align: middle;">
                                    <center>APPROVED OFFICER</center>
                                </th>   
                                <th style="vertical-align: middle;">
                                    <center>DATE/TIME ADJUSTED</center>
                                </th>                              
                            </tr>
                        </thead>
                ';

        foreach($transferred_data as $trans)
        {
            $lo_name = '';
            $lo_data = $this->liquidation_model->emp_data_model($trans['requested']);
            if(!empty($lo_data))
            {
                $lo_name = $lo_data->name;
            }
            // ==================================================================================================================================
            $sup_name = '';
            $sup_data = $this->liquidation_model->emp_data_model($trans['approved']);
            if(!empty($sup_data))
            {
                $sup_name = $sup_data->name;
            }
            // ==================================================================================================================================
            $validate_cash_data = $this->liquidation_model->get_cash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
            $validate_noncash_data = $this->liquidation_model->get_noncash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
            if(!empty($validate_cash_data))
            {
                $dname = '';
                $sname = '';
                $ssname = '';
                $br1 = '';
                $br2 = '';
                $br3 = '';
                // ===============================================================================================================================
                $bunit_data = $this->liquidation_model->get_pisbunit_v2($trans['bcode']);
                // ================================================================================================================================
                $dept_data = $this->liquidation_model->get_pisdepartment_v2($trans['dcode']);
                if(!empty($dept_data))
                {
                    $dname = $dept_data->dept_name;
                    $br1 = '<br>';
                }
                // ==================================================================================================================================
                $section_data = $this->liquidation_model->get_section_v2($trans['scode']);
                if(!empty($section_data))
                {
                    $sname = $section_data->section_name;
                    $br2 = '<br>';
                }
                // ===================================================================================================================================
                $sub_section_data = $this->liquidation_model->get_subsection_v2($trans['sscode']);
                if(!empty($sub_section_data))
                {
                    $ssname = $sub_section_data->sub_section_name;
                    $br3 = '<br>';
                }
                // ==================================================================================================================================
                $cash_data = $this->liquidation_model->get_cash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                $noncash_data = $this->liquidation_model->get_noncash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                $pos_name = '';
                $counter_no = '';
                $borrowed = '';
                if(!empty($cash_data))
                {
                    foreach($cash_data as $cash)
                    {
                        $pos_name = $cash['pos_name'];
                        $counter_no = $cash['counter_no'];
                        $borrowed = $cash['borrowed'];
                    }
                }
                else
                {
                    if(!empty($noncash_data))
                    {
                        foreach($noncash_data as $noncash)
                        {
                            $pos_name = $noncash['pos_name'];
                            $counter_no = $noncash['counter_no'];
                            $borrowed = $noncash['borrowed'];
                        }
                    }
                }
                // ==================================================================================================================================
                $old_date = date('Y-m-d', strtotime($trans['dsales'] . ' +1 day'));
                $html.=' 
                        <tr style="word-wrap:break-word;">
                            <td style="vertical-align: middle;">'.$trans['cname'].'</td>
                            <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                            <td style="vertical-align: middle;">'.$pos_name.'<br>'.$counter_no.'</td>
                            <td style="vertical-align: middle;">'.$old_date.'</td>
                            <td style="vertical-align: middle;">'.$trans['dsales'].'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['gtotal'], 2).'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['rsales'], 2).'</td>
                            <td style="vertical-align: middle;">'.$trans['sop_type'].'</td>
                            <td style="vertical-align: middle;">'.number_format($trans['sop'], 2).'</td>
                            <td style="vertical-align: middle;">'.$borrowed.'</td>
                            <td style="vertical-align: middle;">'.$lo_name.'</td>
                            <td style="vertical-align: middle;">'.$sup_name.'</td>
                            <td style="vertical-align: middle;">'.$trans['date_time_adjusted'].'</td>
                        </tr>
                        '; 
            }
            else
            {
                if(!empty($validate_noncash_data))
                {
                    if(empty($validate_cash_data))
                    {
                        $dname = '';
                        $sname = '';
                        $ssname = '';
                        $br1 = '';
                        $br2 = '';
                        $br3 = '';
                        // ===============================================================================================================================
                        $bunit_data = $this->liquidation_model->get_pisbunit_v2($trans['bcode']);
                        // ================================================================================================================================
                        $dept_data = $this->liquidation_model->get_pisdepartment_v2($trans['dcode']);
                        if(!empty($dept_data))
                        {
                            $dname = $dept_data->dept_name;
                            $br1 = '<br>';
                        }
                        // ==================================================================================================================================
                        $section_data = $this->liquidation_model->get_section_v2($trans['scode']);
                        if(!empty($section_data))
                        {
                            $sname = $section_data->section_name;
                            $br2 = '<br>';
                        }
                        // ===================================================================================================================================
                        $sub_section_data = $this->liquidation_model->get_subsection_v2($trans['sscode']);
                        if(!empty($sub_section_data))
                        {
                            $ssname = $sub_section_data->sub_section_name;
                            $br3 = '<br>';
                        }
                        // ==================================================================================================================================
                        $cash_data = $this->liquidation_model->get_cash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                        $noncash_data = $this->liquidation_model->get_noncash_zero_rs_model($trans['trno'],$trans['cashier_id'],$trans['sscode']);
                        $pos_name = '';
                        $counter_no = '';
                        $borrowed = '';
                        if(!empty($cash_data))
                        {
                            foreach($cash_data as $cash)
                            {
                                $pos_name = $cash['pos_name'];
                                $counter_no = $cash['counter_no'];
                                $borrowed = $cash['borrowed'];
                            }
                        }
                        else
                        {
                            if(!empty($noncash_data))
                            {
                                foreach($noncash_data as $noncash)
                                {
                                    $pos_name = $noncash['pos_name'];
                                    $counter_no = $noncash['counter_no'];
                                    $borrowed = $noncash['borrowed'];
                                }
                            }
                        }
                        // ==================================================================================================================================
                        $old_date = date('Y-m-d', strtotime($trans['dsales'] . ' +1 day'));
                        $html.=' 
                                <tr style="word-wrap:break-word;">
                                    <td style="vertical-align: middle;">'.$trans['cname'].'</td>
                                    <td style="vertical-align: middle;">'.$bunit_data->business_unit.$br1.$dname.$br2.$sname.$br3.$ssname.'</td>
                                    <td style="vertical-align: middle;">'.$pos_name.'<br>'.$counter_no.'</td>
                                    <td style="vertical-align: middle;">'.$old_date.'</td>
                                    <td style="vertical-align: middle;">'.$trans['dsales'].'</td>
                                    <td style="vertical-align: middle;">'.number_format($trans['gtotal'], 2).'</td>
                                    <td style="vertical-align: middle;">'.number_format($trans['rsales'], 2).'</td>
                                    <td style="vertical-align: middle;">'.$trans['sop_type'].'</td>
                                    <td style="vertical-align: middle;">'.number_format($trans['sop'], 2).'</td>
                                    <td style="vertical-align: middle;">'.$borrowed.'</td>
                                    <td style="vertical-align: middle;">'.$lo_name.'</td>
                                    <td style="vertical-align: middle;">'.$sup_name.'</td>
                                    <td style="vertical-align: middle;">'.$trans['date_time_adjusted'].'</td>
                                </tr>
                                '; 
                    }
                }
            }
        }
        
        $html.='                      
                        </table>
                    </form> 
                    ';

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function get_year_ctrl()
    {
        $start_year = 2023;
        $current_year = date('Y');
        // =========================================================
        $html = '';
        for($a = $current_year; $a >= $start_year; $a--)
        {
            $html .= '
                    <option>'.$a.'</option>
                    ';
        }

        $data['html']=$html;         
        echo json_encode($data);
    }

    public function view_productivity_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $html = '
                    <table class="table table-bordered table-hover table-condensed display" id="productivity_tbl">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle; text-align: center; width: 10%;" rowspan="2">SALES DATE</th>
                                <th style="vertical-align: middle; text-align: center; width: 10%;" rowspan="2">TOTAL SALES</th>
                                <th style="vertical-align: middle; text-align: center; width: 5%;" rowspan="2">TRANS. COUNT</th>
                                <th style="vertical-align: middle; text-align: center; width: 9%;" rowspan="2">ITEM SOLD</th>
                                <th style="vertical-align: middle; text-align: center; width: 8%;" rowspan="2">FLOAT TIME</th>
                                <th style="vertical-align: middle; text-align: center; width: 8%;" rowspan="2">READING TIME</th>
                                <th style="vertical-align: middle; text-align: center; width: 6%;" rowspan="2">NO. OF HOURS</th>
                                <th style="vertical-align: middle; text-align: center; width: 8%;" colspan="2" scope="colgroup">TIME CON.</th>
                                <th style="vertical-align: middle; text-align: center; width: 4%;" rowspan="2">MIN.</th>
                                <th style="vertical-align: middle; text-align: center; width: 6%;" rowspan="2">TOTAL HOURS /<br> Conv. Sec.</th>
                                <th style="vertical-align: middle; text-align: center; width: 8%;" rowspan="2">AVE.SALES / HOURS</th>
                                <th style="vertical-align: middle; text-align: center; width: 6%;" rowspan="2">AVE.TC / HOURS</th>
                                <th style="vertical-align: middle; text-align: center; width: 8%;" rowspan="2">AVE. ITEM SOLD / HOUR</th>
                                <th style="vertical-align: middle; text-align: center; width: 4%;" rowspan="2">ACTION</th>
                            </tr>
                            <tr style="border-top: outset;">
                                <th style="vertical-align: middle; text-align: center;" scope="col">TIME</th>
                                <th style="vertical-align: middle; text-align: center; border-right: solid 1px;" scope="col">MIN.</th>
                            </tr>
                        </thead>
                        <tbody>
                    ';
            $emp_data = $this->liquidation_model->get_cashier_data_model($_POST['emp_name'],$_POST['dcode']);
            $message = 'EMPTY';
            $emp_id = '';
            $total_cash_sales = 0;
            $total_tr_count = 0;
            $total_item_sold = 0;
            $total_hours = 0;
            $total_minutes = 0;
            $total_ave_sales = 0;
            $total_ave_tr_count = 0;
            $total_ave_item_sold = 0;
            $max_id = 0;
            if(!empty($emp_data))
            {
                $message = 'VALID NAME';
                $emp_id = $emp_data->emp_id;
                // =============================================================================================
                $cashier_data = $this->liquidation_model->get_cashier_productivity_model_v2($emp_id,$_POST['dcode'],$_POST['month'],$_POST['year']);
                $cash_sales = 0;
                $id_counter = 0;
                foreach($cashier_data as $data)
                {
                    $message = 'NOT EMPTY';
                    $sales_date = date("m-d-Y", strtotime($data['date_shrt']));
                    $cash_sales = $data['cash_sale'];
                    $total_cash_sales += $data['cash_sale'];
                    $total_tr_count += $data['tr_count'];
                    $id_counter += 1;
                    $max_id += 1;
                    // ========================================================================================================================
                    $validated_data = $this->liquidation_model->validate_productivivty_model($emp_id,$_POST['dcode'],$data['date_shrt']);
                    $disabled = '';
                    $item_sold = '';
                    $float_time = '';
                    $reading_time = '';
                    $no_of_hours = '0:00';
                    $hours = '0';
                    $minutes = '0';
                    $total_hours_consec = 0;
                    $ave_sales = 0;
                    $ave_tr_count = 0;
                    $ave_item_sold = 0;
                    $action = '';
                    if(!empty($validated_data))
                    {
                        $disabled = 'disabled';
                        $item_sold = number_format($validated_data->item_sold);
                        $total_item_sold += $validated_data->item_sold;
                        $float_time = $validated_data->float_time;
                        $reading_time = $validated_data->reading_time;
                        $no_of_hours = substr($validated_data->no_of_hours, 0, -3);
                        $hours = $validated_data->hours;
                        $total_hours += $validated_data->hours;
                        $minutes = $validated_data->minutes;
                        $total_minutes += $validated_data->minutes;
                        $total_hours_consec = $validated_data->total_hours_consec;
                        $ave_sales = $validated_data->ave_sales;
                        $total_ave_sales += $validated_data->ave_sales;
                        $ave_tr_count = $validated_data->ave_tr_count;
                        $total_ave_tr_count += $validated_data->ave_tr_count;
                        $ave_item_sold = $validated_data->ave_item_sold;
                        $total_ave_item_sold += $validated_data->ave_item_sold;
                        // ===========================================================================
                        $action = '<a id="edit_btn'.$id_counter.'" onclick="edit_productivity_js('.$id_counter.')">
                                     <span>✏️</span>
                                   </a>
                                   <a hidden id="update_btn'.$id_counter.'" onclick="update_productivity_js('."'".$id_counter."','".$validated_data->id."'".')">
                                     <span>✔️</span>
                                   </a>';
                    }
                    // ========================================================================================================================
                    $html .= '
                            <tr>
                                <td id="sales_date_id'.$id_counter.'" class="row_data_txt'.$id_counter.'" style="vertical-align: middle; text-align: right;">'.$sales_date.'</td>
                                <td id="total_sales_id'.$id_counter.'" class="row_data_txt'.$id_counter.'" style="vertical-align: middle; text-align: right;">'.number_format($cash_sales, 2).'</td>
                                <td id="tr_count_id'.$id_counter.'" class="row_data_txt'.$id_counter.'" style="vertical-align: middle; text-align: right;">'.$data['tr_count'].'</td>
                                <td style="vertical-align: middle; text-align: right;">
                                    <input '.$disabled.' id="item_sold_id'.$id_counter.'" class="item_sold row_data_val'.$id_counter.'" type="text" min="1" onkeyup="auto_comma_number_js('.$id_counter.')" style="width: 100%; text-align: right;" value="'.$item_sold.'"></input>
                                </td>
                                <td style="vertical-align: middle; text-align: right;">
                                    <input '.$disabled.' id="float_time_id'.$id_counter.'" class="row_data_val'.$id_counter.'" type="time" style="width: 100%; height: 25px; text-align: right;" onchange="compute_hours_js('.$id_counter.')" value="'.$float_time.'"></input>
                                </td>
                                <td style="vertical-align: middle; text-align: right;">
                                    <input '.$disabled.' id="reading_time_id'.$id_counter.'" class="row_data_val'.$id_counter.'" type="time" style="width: 100%; height: 25px; text-align: right;" onchange="compute_hours_js('.$id_counter.')" value="'.$reading_time.'"></input>
                                </td>
                                <td id="no_of_hrs_id'.$id_counter.'" class="row_data_txt'.$id_counter.'" style="vertical-align: middle; text-align: center;">'.$no_of_hours.'</td>
                                <td id="hours_id'.$id_counter.'" class="hours_id row_data_txt'.$id_counter.'" style="vertical-align: middle; text-align: center;">'.$hours.'</td>
                                <td id="minute_id'.$id_counter.'" class="minute_id row_data_txt'.$id_counter.'" style="vertical-align: middle; text-align: center;">'.$minutes.'</td>
                                <td style="vertical-align: middle; text-align: center;">60</td>
                                <td id="total_hrs_id'.$id_counter.'" class="row_data_txt'.$id_counter.'" style="vertical-align: middle; text-align: center;">'.number_format($total_hours_consec, 2).'</td>
                                <td id="ave_sales_hrs_id'.$id_counter.'" class="ave_sales_hrs_id row_data_txt'.$id_counter.'" style="vertical-align: middle; text-align: right;">'.number_format($ave_sales, 2).'</td>
                                <td id="ave_tr_count_hrs_id'.$id_counter.'" class="ave_tr_count_hrs_id row_data_txt'.$id_counter.'" style="vertical-align: middle; text-align: right;">'.number_format($ave_tr_count, 2).'</td>
                                <td id="ave_item_sold_hrs_id'.$id_counter.'" class="ave_item_sold_hrs_id row_data_txt'.$id_counter.'" style="vertical-align: middle; text-align: right;">'.number_format($ave_item_sold, 2).'</td>
                                <td style="vertical-align: middle; text-align: center;">'.$action.'</td>
                            </tr>
                            ';
                }
            }
            
            $html .= '
                        <tr>
                            <td style="text-align: right; font-weight: bold;">TOTAL</td>
                            <td style="text-align: right; font-weight: bold;">'.number_format($total_cash_sales, 2).'</td>
                            <td style="text-align: right; font-weight: bold;">'.number_format($total_tr_count).'</td>
                            <td id="total_item_sold_id" style="text-align: right; font-weight: bold;">'.number_format($total_item_sold).'</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td id="total_hour_id" style="text-align: center; font-weight: bold;">'.number_format($total_hours).'</td>
                            <td id="total_minute_id" style="text-align: center; font-weight: bold;">'.number_format($total_minutes).'</td>
                            <td></td>
                            <td></td>
                            <td id="total_ave_sales_hr_id" style="text-align: right; font-weight: bold;">'.number_format($total_ave_sales, 2).'</td>
                            <td id="total_ave_tr_count_hr_id" style="text-align: right; font-weight: bold;">'.number_format($total_ave_tr_count, 2).'</td>
                            <td id="total_ave_item_sold_hr_id" style="text-align: right; font-weight: bold;">'.number_format($total_ave_item_sold, 2).'</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                    
                    <div>
                        <center>
                          <span hidden id="hidden_name">'.$_POST['emp_name'].'</span>
                          <span hidden id="emp_id">'.$emp_id.'</span>
                          <span hidden id="dcode">'.$_POST['dcode'].'</span>
                          <span hidden id="hidden_month">'.$_POST['month'].'</span>
                          <span hidden id="hidden_year">'.$_POST['year'].'</span>
                          <span hidden id="max_id">'.$max_id.'</span>
                          <button type="button" id="save_btn" class="btn btn-warning waves-effect" onclick="save_productivivty_js()">SAVE ✔️</button>
                          <button type="button" id="print_btn" class="btn waves-effect" style="background-color: maroon; color: white;" onclick="print_cashier_productivivty_js('."'".$_POST['emp_name']."','".$emp_id."','".$_POST['dcode']."','".$_POST['month']."','".$_POST['year']."'".')">PRINT 🖨️</button>
                        </center>
                    </div>
                    ';

            $data['message'] = $message;
            $data['html'] = $html;
            echo json_encode($data);
        }
    }

    public function save_productivivty_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = 'NO INSERTED';
            $data = '^'.$_POST['row_data'];
            $data = explode("|", $data);
            for($a=0; $a<count($data); $a++)
            {
                $row = substr($data[$a], 1, -1);
                $row = explode("^", $row);
                if($row[10] != '' && $row[11] != '' && $row[12] != '')
                {
                    $item_sold = str_replace(",","",$row[10]);
                    if($row[2] >= 1 && $row[6] >= 1 && $item_sold >= 1)
                    {
                        $sales_date = explode("-", $row[0]);
                        $sales_date = $sales_date[2].'-'.$sales_date[0].'-'.$sales_date[1];
                        $validated_data = $this->liquidation_model->validate_productivivty_model($_POST['emp_id'],$_POST['dcode'],$sales_date);
                        if(empty($validated_data))
                        {
                            $message = 'INSERTED';
                            $officer_id = $_SESSION['emp_id'];
                            $ave_sales =  str_replace(",","",$row[7]);
                            $ave_tr_count =  str_replace(",","",$row[8]);
                            $ave_item_sold =  str_replace(",","",$row[9]);
                            $this->liquidation_model->save_productivivty_model($_POST['emp_id'],$_POST['dcode'],$sales_date,$item_sold,$row[11],$row[12],$row[3],$row[4],$row[5],$row[6],$ave_sales,$ave_tr_count,$ave_item_sold,$officer_id);
                        }
                    }
                }
            }

            $data['message'] = $message;
            echo json_encode($data);
        }
    }

    public function update_productivity_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $message = 'UPDATED';
            $officer_incharge = $_SESSION['emp_id'];
            $this->liquidation_model->update_productivity_model($_POST['item_sold'],$_POST['float_time_id'],$_POST['reading_time_id'],$_POST['no_of_hrs_id'],$_POST['hours_id'],$_POST['minute_id'],$_POST['total_hrs_id'],$_POST['ave_sales_hrs_id'],$_POST['ave_tr_count_hrs_id'],$_POST['ave_item_sold_hrs_id'],$_POST['data_id'],$officer_incharge);

            $data['message'] = $message;
            echo json_encode($data);
        }
    }

    public function print_cashier_productivivty_ctrl()
    { 
        $month_name = date('F', mktime(0, 0, 0, $_POST['month'], 10)); 
        $cashier_data = $this->liquidation_model->cashier_productivivty_model($_POST['emp_id'],$_POST['dcode'],$_POST['month'],$_POST['year']);
        // ======================================================================================================================================
        $this->ppdf = new TCPDF();
        $this->ppdf->SetTitle("CASHIER DAILY PRODUCTIVITY");
        $this->ppdf->SetPrintHeader(true);
        $this->ppdf->SetFont('', '', 8, '', true); 
        $this->ppdf->SetMargins(7, 7, 7);
        $this->ppdf->AddPage("L","LETTER");
        $this->ppdf->SetFooterMargin(7);
        $this->ppdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        // $this->ppdf->SetAutoPageBreak(true, PDF_MARGIN_FOOTER);

        $pages = "Page: ".$this->ppdf->getAliasNumPage().'/'.$this->ppdf->getAliasNbPages();
        
        $tbl = '
                <p>
                    <span style="font-size: 12px;">'.$_POST['emp_name'].' Productivity Report Of '.$month_name.', '.$_POST['year'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$pages.'</span>
                </p>
            ';
        // ===============================================================================================================================================
        $tbl .= '
                    <table border="1" cellpadding="3">
                        <tr>
                            <th style="vertical-align: middle; text-align: center; width: 9%;" rowspan="2"><br><br>SALES DATE</th>
                            <th style="vertical-align: middle; text-align: center; width: 10%;" rowspan="2"><br><br>TOTAL SALES</th>
                            <th style="vertical-align: middle; text-align: center; width: 6%;" rowspan="2">TRANS. COUNT</th>
                            <th style="vertical-align: middle; text-align: center; width: 8%;" rowspan="2"><br><br>ITEM SOLD</th>
                            <th style="vertical-align: middle; text-align: center; width: 8%;" rowspan="2"><br><br>FLOAT TIME</th>
                            <th style="vertical-align: middle; text-align: center; width: 8%;" rowspan="2"><br><br>READING TIME</th>
                            <th style="vertical-align: middle; text-align: center; width: 6%;" rowspan="2">NO. OF HOURS</th>
                            <th style="vertical-align: middle; text-align: center; width: 8%;" colspan="2" scope="colgroup">TIME CON.</th>
                            <th style="vertical-align: middle; text-align: center; width: 4%;" rowspan="2"><br><br>MIN.</th>
                            <th style="vertical-align: middle; text-align: center; width: 7%;" rowspan="2">TOTAL HOURS /<br> Conv. Sec.</th>
                            <th style="vertical-align: middle; text-align: center; width: 9%;" rowspan="2">AVE.SALES / HOURS</th>
                            <th style="vertical-align: middle; text-align: center; width: 7%;" rowspan="2">AVE.TC / HOURS</th>
                            <th style="vertical-align: middle; text-align: center; width: 10%;" rowspan="2">AVE. ITEM SOLD / HOUR</th>
                        </tr>
                        <tr style="border-top: outset;">
                            <th style="vertical-align: middle; text-align: center;" scope="col">TIME</th>
                            <th style="vertical-align: middle; text-align: center;" scope="col">MIN.</th>
                        </tr>
                    ';

        $over_all_total_sales = 0;
        $over_all_tr_count = 0;
        $over_all_total_item_sold = 0;
        $over_all_total_hours = 0;
        $over_all_total_minutes = 0;
        $over_all_total_ave_sales = 0;
        $over_all_total_ave_tr_count = 0;
        $over_all_total_ave_item_sold = 0;
        foreach($cashier_data as $data)
        {
            $over_all_total_item_sold += $data['item_sold'];
            $over_all_total_hours += $data['hours'];
            $over_all_total_minutes += $data['minutes'];
            $over_all_total_ave_sales += $data['ave_sales'];
            $over_all_total_ave_tr_count += $data['ave_tr_count'];
            $over_all_total_ave_item_sold += $data['ave_item_sold'];
            // =====================================================================
            $cashier_data = $this->liquidation_model->get_cashier_sales_model_v2($data['emp_id'],$data['dcode'],$data['sales_date']);
            $total_sales = 0;
            $tr_count = 0;
            if(!empty($cashier_data))
            {
                $total_sales = $cashier_data->cash_sale;
                $over_all_total_sales += $cashier_data->cash_sale;
                $tr_count = $cashier_data->tr_count;
                $over_all_tr_count += $cashier_data->tr_count;
            }
            $tbl .= '
                    <tr>                                                          
                        <td style="text-align: right;">'.$data['sales_date'].'</td>
                        <td style="text-align: right;">'.number_format($total_sales, 2).'</td>
                        <td style="text-align: right;">'.number_format($tr_count).'</td>
                        <td style="text-align: right;">'.number_format($data['item_sold']).'</td>
                        <td style="text-align: right;">'.date('h:i A', strtotime($data['float_time'])).'</td>
                        <td style="text-align: right;">'.date('h:i A', strtotime($data['reading_time'])).'</td>
                        <td style="text-align: center;">'.substr($data['no_of_hours'], 0, -3).'</td>
                        <td style="text-align: center;">'.$data['hours'].'</td>
                        <td style="text-align: center;">'.$data['minutes'].'</td>
                        <td style="text-align: center;">60</td>
                        <td style="text-align: center;">'.$data['total_hours_consec'].'</td>
                        <td style="text-align: right;">'.number_format($data['ave_sales'], 2).'</td>
                        <td style="text-align: right;">'.number_format($data['ave_tr_count'], 2).'</td>
                        <td style="text-align: right;">'.number_format($data['ave_item_sold'], 2).'</td>
                    </tr>
                    ';
        }

        $tbl .= '
                    <tr>
                        <td style="text-align: right; font-weight: bold;">TOTAL</td>
                        <td style="text-align: right; font-weight: bold;">'.number_format($over_all_total_sales, 2).'</td>
                        <td style="text-align: right; font-weight: bold;">'.number_format($over_all_tr_count).'</td>
                        <td id="total_item_sold_id" style="text-align: right; font-weight: bold;">'.number_format($over_all_total_item_sold).'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td id="total_hour_id" style="text-align: center; font-weight: bold;">'.number_format($over_all_total_hours).'</td>
                        <td id="total_minute_id" style="text-align: center; font-weight: bold;">'.number_format($over_all_total_minutes).'</td>
                        <td></td>
                        <td></td>
                        <td id="total_ave_sales_hr_id" style="text-align: right; font-weight: bold;">'.number_format($over_all_total_ave_sales, 2).'</td>
                        <td id="total_ave_tr_count_hr_id" style="text-align: right; font-weight: bold;">'.number_format($over_all_total_ave_tr_count, 2).'</td>
                        <td id="total_ave_item_sold_hr_id" style="text-align: right; font-weight: bold;">'.number_format($over_all_total_ave_item_sold, 2).'</td>
                        <td></td>
                    </tr>
                </table>
                ';
  
        $this->ppdf->writeHTML($tbl, true, false, false, false, '');
        ob_end_clean();
        $this->ppdf->Output();  
    }

    public function print_all_cashier_productivivty_ctrl()
    { 
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 60); 
        $month_name = date('F', mktime(0, 0, 0, $_POST['month'], 10)); 
        $cashier_data = $this->liquidation_model->all_cashier_productivivty_model($_POST['dcode'],$_POST['month'],$_POST['year']);
        $cashier_name_array = array();
        foreach($cashier_data as $cashier)
        {
            $emp_data = $this->liquidation_model->emp_data_model($cashier['emp_id']);
            if(!is_null($emp_data->name))
            {
                array_push($cashier_name_array, $emp_data->name.'|'.$cashier['emp_id']);
            }
        }
        sort($cashier_name_array);
        // ======================================================================================================================================
        $this->ppdf = new TCPDF();
        $this->ppdf->SetTitle("CASHIER DAILY PRODUCTIVITY");
        $this->ppdf->SetPrintHeader(true);
        $this->ppdf->SetFont('', '', 8, '', true); 
        $this->ppdf->SetMargins(7, 7, 7);
        $this->ppdf->AddPage("L","LETTER");
        $this->ppdf->SetFooterMargin(7);
        $this->ppdf->SetAutoPageBreak(true, PDF_MARGIN_FOOTER);

        $pages = "Page: ".$this->ppdf->getAliasNumPage().'/'.$this->ppdf->getAliasNbPages();
        
        $tbl = '';
        for($a=0; $a<count($cashier_name_array); $a++)
        {
            $data_exploded = explode("|", $cashier_name_array[$a]);
            $tbl .= '
                    <p>
                        <span style="font-size: 12px;">'.$data_exploded[0].' Productivity Report Of '.$month_name.', '.$_POST['year'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$pages.'</span>
                    </p>
                ';
            // ===============================================================================================================================================
            $tbl .= '
                        <table border="1" cellpadding="2">
                            <tr>
                                <th style="vertical-align: middle; text-align: center; width: 9%;" rowspan="2"><br><br>SALES DATE</th>
                                <th style="vertical-align: middle; text-align: center; width: 10%;" rowspan="2"><br><br>TOTAL SALES</th>
                                <th style="vertical-align: middle; text-align: center; width: 6%;" rowspan="2">TRANS. COUNT</th>
                                <th style="vertical-align: middle; text-align: center; width: 8%;" rowspan="2"><br><br>ITEM SOLD</th>
                                <th style="vertical-align: middle; text-align: center; width: 8%;" rowspan="2"><br><br>FLOAT TIME</th>
                                <th style="vertical-align: middle; text-align: center; width: 8%;" rowspan="2"><br><br>READING TIME</th>
                                <th style="vertical-align: middle; text-align: center; width: 6%;" rowspan="2">NO. OF HOURS</th>
                                <th style="vertical-align: middle; text-align: center; width: 8%;" colspan="2" scope="colgroup">TIME CON.</th>
                                <th style="vertical-align: middle; text-align: center; width: 4%;" rowspan="2"><br><br>MIN.</th>
                                <th style="vertical-align: middle; text-align: center; width: 7%;" rowspan="2">TOTAL HOURS /<br> Conv. Sec.</th>
                                <th style="vertical-align: middle; text-align: center; width: 9%;" rowspan="2">AVE.SALES / HOURS</th>
                                <th style="vertical-align: middle; text-align: center; width: 7%;" rowspan="2">AVE.TC / HOURS</th>
                                <th style="vertical-align: middle; text-align: center; width: 10%;" rowspan="2">AVE. ITEM SOLD / HOUR</th>
                            </tr>
                            <tr style="border-top: outset;">
                                <th style="vertical-align: middle; text-align: center;" scope="col">TIME</th>
                                <th style="vertical-align: middle; text-align: center;" scope="col">MIN.</th>
                            </tr>
                        ';
            
            $cashier_data = $this->liquidation_model->cashier_productivivty_model($data_exploded[1],$_POST['dcode'],$_POST['month'],$_POST['year']);
            $over_all_total_sales = 0;
            $over_all_tr_count = 0;
            $over_all_total_item_sold = 0;
            $over_all_total_hours = 0;
            $over_all_total_minutes = 0;
            $over_all_total_ave_sales = 0;
            $over_all_total_ave_tr_count = 0;
            $over_all_total_ave_item_sold = 0;
            foreach($cashier_data as $data)
            {
                $over_all_total_item_sold += $data['item_sold'];
                $over_all_total_hours += $data['hours'];
                $over_all_total_minutes += $data['minutes'];
                $over_all_total_ave_sales += $data['ave_sales'];
                $over_all_total_ave_tr_count += $data['ave_tr_count'];
                $over_all_total_ave_item_sold += $data['ave_item_sold'];
                // =====================================================================
                $cashier_data = $this->liquidation_model->get_cashier_sales_model_v2($data['emp_id'],$data['dcode'],$data['sales_date']);
                $total_sales = 0;
                $tr_count = 0;
                if(!empty($cashier_data))
                {
                    $total_sales = $cashier_data->cash_sale;
                    $over_all_total_sales += $cashier_data->cash_sale;
                    $tr_count = $cashier_data->tr_count;
                    $over_all_tr_count += $cashier_data->tr_count;
                }
                $tbl .= '
                        <tr>                                                          
                            <td style="text-align: right;">'.$data['sales_date'].'</td>
                            <td style="text-align: right;">'.number_format($total_sales, 2).'</td>
                            <td style="text-align: right;">'.number_format($tr_count).'</td>
                            <td style="text-align: right;">'.number_format($data['item_sold']).'</td>
                            <td style="text-align: right;">'.date('h:i A', strtotime($data['float_time'])).'</td>
                            <td style="text-align: right;">'.date('h:i A', strtotime($data['reading_time'])).'</td>
                            <td style="text-align: center;">'.substr($data['no_of_hours'], 0, -3).'</td>
                            <td style="text-align: center;">'.$data['hours'].'</td>
                            <td style="text-align: center;">'.$data['minutes'].'</td>
                            <td style="text-align: center;">60</td>
                            <td style="text-align: center;">'.$data['total_hours_consec'].'</td>
                            <td style="text-align: right;">'.number_format($data['ave_sales'], 2).'</td>
                            <td style="text-align: right;">'.number_format($data['ave_tr_count'], 2).'</td>
                            <td style="text-align: right;">'.number_format($data['ave_item_sold'], 2).'</td>
                        </tr>
                        ';
            }
            
            $br = '';
            if($a < count($cashier_name_array) - 1)
            {
                $br = '<br pagebreak="true"/>';
            }
            $tbl .= '
                        <tr>
                            <td style="text-align: right; font-weight: bold;">TOTAL</td>
                            <td style="text-align: right; font-weight: bold;">'.number_format($over_all_total_sales, 2).'</td>
                            <td style="text-align: right; font-weight: bold;">'.number_format($over_all_tr_count).'</td>
                            <td id="total_item_sold_id" style="text-align: right; font-weight: bold;">'.number_format($over_all_total_item_sold).'</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td id="total_hour_id" style="text-align: center; font-weight: bold;">'.number_format($over_all_total_hours).'</td>
                            <td id="total_minute_id" style="text-align: center; font-weight: bold;">'.number_format($over_all_total_minutes).'</td>
                            <td></td>
                            <td></td>
                            <td id="total_ave_sales_hr_id" style="text-align: right; font-weight: bold;">'.number_format($over_all_total_ave_sales, 2).'</td>
                            <td id="total_ave_tr_count_hr_id" style="text-align: right; font-weight: bold;">'.number_format($over_all_total_ave_tr_count, 2).'</td>
                            <td id="total_ave_item_sold_hr_id" style="text-align: right; font-weight: bold;">'.number_format($over_all_total_ave_item_sold, 2).'</td>
                            <td></td>
                        </tr>
                    </table>'.$br.'
                    ';
        }
        
        $this->ppdf->writeHTML($tbl, true, false, false, false, '');
        ob_end_clean();
        $this->ppdf->Output();  
    }

    public function print_cashier_monthly_productivivty_ctrl()
    { 
        ini_set('max_execution_time', 60); 
        $month_name = date('F', mktime(0, 0, 0, $_POST['month'], 10)); 
        $bcode = substr($_POST['dcode'], 0, 4);
        $bunit_data = $this->liquidation_model->get_pisbunit_v2($bcode);
        $bname = '';
        if(!is_null($bunit_data->business_unit))
        {
            $bname = $bunit_data->business_unit;
        }
        // ==================================================================
        $jr_dept_name = $_POST['dept_name'];
        if($_POST['dept_name'] == 'SUPERMARKET')
        {
            $jr_dept_name = 'GCOC';
        }
        // ==================================================================================================
        $supervisor_data = $this->liquidation_model->get_cashier_productivity_officer_model($_POST['dcode']);
        $prepared_name = '';
        $prepared_position = '';
        $noted_name = '';
        $noted_position = '';
        foreach($supervisor_data as $data)
        {
            if($data['status'] == 'PREPARED')
            {
                $sup_data = $this->liquidation_model->emp_data_model($data['emp_id']);
                if(!is_null($sup_data->name))
                {
                    $prepared_name = $sup_data->name;
                    $prepared_position = $sup_data->position;
                }
            }
            // ===============================================================================
            if($data['status'] == 'NOTED')
            {
                $sup_data = $this->liquidation_model->emp_data_model($data['emp_id']);
                if(!is_null($sup_data->name))
                {
                    $noted_name = $sup_data->name;
                    $noted_position = $sup_data->position;
                }
            }
        }
        // ==========================================================================================
        $mall_manager_data = $this->liquidation_model->get_mall_manager_model($bcode);
        $approved_name = '';
        $approved_position = '';
        if(!is_null($mall_manager_data->emp_id))
        {
            $manager_data = $this->liquidation_model->emp_data_model($mall_manager_data->emp_id);
            if(!is_null($manager_data->name))
            {
                $approved_name = $manager_data->name;
                $approved_position = $manager_data->position;
            }
        }
        // ===========================================================================================
        $cashier_data = $this->liquidation_model->all_cashier_productivivty_model($_POST['dcode'],$_POST['month'],$_POST['year']);
        $cashier_name_array = array();
        $non_cashier_name_array = array();
        foreach($cashier_data as $cashier)
        {
            $emp_data = $this->liquidation_model->emp_data_model($cashier['emp_id']);
            if(!is_null($emp_data->name))
            {
                if($emp_data->position == 'Section Head' || $emp_data->position == 'COC Checker')
                {
                    array_push($non_cashier_name_array, $emp_data->name.'|'.$cashier['emp_id'].'|'.$emp_data->position);
                }
                else
                {
                    array_push($cashier_name_array, $emp_data->name.'|'.$cashier['emp_id'].'|'.$emp_data->position);
                }
            }
        }
        sort($cashier_name_array);
        sort($non_cashier_name_array);
        // ======================================================================================================================================
        $this->ppdf = new TCPDF();
        $this->ppdf->SetTitle("CASHIER MONTHLY PRODUCTIVITY");
        $this->ppdf->SetPrintHeader(true);
        $this->ppdf->SetFont('', '', 11, '', true); 
        $this->ppdf->SetMargins(30, 7, 7);
        $this->ppdf->AddPage("L","LEGAL");
        $this->ppdf->SetFooterMargin(7);
        // $this->ppdf->SetAutoPageBreak(true, PDF_MARGIN_FOOTER);

        $pages = "Page: ".$this->ppdf->getAliasNumPage().'/'.$this->ppdf->getAliasNbPages();

        $user_tbl = '<br><br><br><br>
                    <table>
                        <tr>
                            <th style="text-align: right; width: 8%;">Prepared by:</th>
                            <th style="text-align: center; width: 25.3%;"><u style="font-weight: bold;">'.strtoupper($prepared_name).'</u></th>
                            <th style="text-align: right; width: 8%;">Noted by:</th>
                            <th style="text-align: center; width: 25.3%;"><u style="font-weight: bold;">'.strtoupper($noted_name).'</u></th>
                            <th style="text-align: right; width: 8%;">Approved by:</th>
                            <th style="text-align: center; width: 25.3%;"><u style="font-weight: bold;">'.strtoupper($approved_name).'</u></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align: center;">'.$jr_dept_name.' - '.$prepared_position.'</td>
                            <td></td>
                            <td style="text-align: center;">'.ucfirst(strtolower($_POST['dept_name'])).' - '.$noted_position.'</td>
                            <td></td>
                            <td style="text-align: center;">'.$approved_position.'</td>
                        </tr>
                    </table>
                    ';
            
        $header_html = '
                        <p>
                            '.$bname.' &nbsp;&nbsp;&nbsp;&nbsp; '.$_POST['dept_name'].' <br>
                            CASHIER PRODUCTIVITY BASED ON SALES PER MONTH <br>
                            FOR THE MONTH OF '.strtoupper($month_name).', '.$_POST['year'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$pages.'
                        </p>
                    ';
        
        $header_html .= '
                        <table border="1" cellpadding="3">
                            <tr>
                                <th style="vertical-align: middle; text-align: center; width: 25%;" rowspan="2"><br><br>EMPLOYEE NAME</th>
                                <th style="vertical-align: middle; text-align: center; width: 10%;" rowspan="2"><br><br>POSITION</th>
                                <th style="vertical-align: middle; text-align: center; width: 10%;" rowspan="2"><br><br>TOTAL SALES</th>
                                <th style="vertical-align: middle; text-align: center; width: 7%;" rowspan="2"><br><br>ITEM SOLD</th>
                                <th style="vertical-align: middle; text-align: center; width: 6%;" rowspan="2">DAYS WORK</th>
                                <th style="vertical-align: middle; text-align: center; width: 9%;" rowspan="2"><br><br>SALES / DAY</th>
                                <th style="vertical-align: middle; text-align: center; width: 11%;" colspan="2" scope="colgroup">TIME CONSUMED</th>
                                <th style="vertical-align: middle; text-align: center; width: 7%;" rowspan="2">TOTAL HOURS / MOS</th>
                                <th style="vertical-align: middle; text-align: center; width: 6%;" rowspan="2"># OF HOURS/DUTY</th>
                                <th style="vertical-align: middle; text-align: center; width: 9%;" rowspan="2"><br><br>SALES / HOURS</th>
                            </tr>
                            <tr style="border-top: outset;">
                                <th style="vertical-align: middle; text-align: center;" scope="col">TIME</th>
                                <th style="vertical-align: middle; text-align: center;" scope="col">MIN.</th>
                            </tr>
                        ';

        $tbl = $header_html;
        
        $counter = 0;
        for($a=0; $a<count($cashier_name_array); $a++)
        { 
            $counter += 1;
            $break_html = '';
            if($counter == 19)
            {
                $break_html = '
                                </table><br pagebreak="true"/>'.$header_html.'
                            ';
                $counter = 0;
            }
            // ============================================================================
            $data_exploded = explode("|", $cashier_name_array[$a]);
            $productivity_data = $this->liquidation_model->get_cashier_productivivty_model($data_exploded[1],$_POST['dcode'],$_POST['month'],$_POST['year']);
            $sales_date_array = array();
            $item_sold = 0;
            $days_work = 0;
            $total_hours = 0;
            $total_minutes = 0;
            foreach($productivity_data as $productivity)
            {
                array_push($sales_date_array, $productivity['sales_date']);
                $item_sold += $productivity['item_sold'];
                if($productivity['hours'] > 4)
                {
                    $days_work += 1;
                }
                else if($productivity['hours'] <= 4)
                {
                    $days_work += 0.5;
                }
                $total_hours += $productivity['hours'];
                $total_minutes += $productivity['minutes'];
            }
            // ============================================================================
            $sales_data = $this->liquidation_model->get_productivivty_sales_model($data_exploded[1],$_POST['dcode'],$sales_date_array);
            $total_sales = 0;
            if(!is_null($sales_data->total_sales))
            {
                $total_sales = $sales_data->total_sales;
            }
            $sales_per_day = $total_sales / $days_work;
            $total_hrs_mos = $total_minutes / 60 + $total_hours;
            $no_of_hrs_duty = $total_hrs_mos / $days_work;
            $sales_per_hour = $sales_per_day / $no_of_hrs_duty;
            // ============================================================================
            $tbl .= '
                        <tr>
                            <td>'.$data_exploded[0].'</td>
                            <td>'.$data_exploded[2].'</td>
                            <td style="text-align: right;">'.number_format($total_sales, 2).'</td>
                            <td style="text-align: right;">'.number_format($item_sold).'</td>
                            <td style="text-align: center;">'.$days_work.'</td>
                            <td style="text-align: right;">'.number_format($sales_per_day, 2).'</td>
                            <td style="text-align: center;">'.number_format($total_hours).'</td>
                            <td style="text-align: center;">'.number_format($total_minutes).'</td>
                            <td style="text-align: right;">'.number_format($total_hrs_mos, 2).'</td>
                            <td style="text-align: center;">'.number_format($no_of_hrs_duty, 2).'</td>
                            <td style="text-align: right;">'.number_format($sales_per_hour, 2).'</td>
                        </tr>'.$break_html.'
                    ';
        }
        // ====================================================================================
        $non_cashier_html = '';
        if(!empty($non_cashier_name_array))
        {
            $counter = 0;
            for($a=0; $a<count($non_cashier_name_array); $a++)
            { 
                if($a == 0)
                {
                    $non_cashier_html .= '<br pagebreak="true"/>'.$header_html;
                }
                // ============================================================================
                $counter += 1;
                $break_html = '';
                if($counter == 19)
                {
                    $break_html = '
                                    </table><br pagebreak="true"/>'.$header_html.'
                                ';
                    $counter = 0;
                }
                // ============================================================================
                $data_exploded = explode("|", $non_cashier_name_array[$a]);
                $productivity_data = $this->liquidation_model->get_cashier_productivivty_model($data_exploded[1],$_POST['dcode'],$_POST['month'],$_POST['year']);
                $sales_date_array = array();
                $item_sold = 0;
                $days_work = 0;
                $total_hours = 0;
                $total_minutes = 0;
                foreach($productivity_data as $productivity)
                {
                    array_push($sales_date_array, $productivity['sales_date']);
                    $item_sold += $productivity['item_sold'];
                    if($productivity['hours'] > 4)
                    {
                        $days_work += 1;
                    }
                    else if($productivity['hours'] <= 4)
                    {
                        $days_work += 0.5;
                    }
                    $total_hours += $productivity['hours'];
                    $total_minutes += $productivity['minutes'];
                }
                // ============================================================================
                $sales_data = $this->liquidation_model->get_productivivty_sales_model($data_exploded[1],$_POST['dcode'],$sales_date_array);
                $total_sales = 0;
                if(!is_null($sales_data->total_sales))
                {
                    $total_sales = $sales_data->total_sales;
                }
                $sales_per_day = $total_sales / $days_work;
                $total_hrs_mos = $total_minutes / 60 + $total_hours;
                $no_of_hrs_duty = $total_hrs_mos / $days_work;
                $sales_per_hour = $sales_per_day / $no_of_hrs_duty;
                // ============================================================================
                $non_cashier_html .= '
                                        <tr>
                                            <td>'.$data_exploded[0].'</td>
                                            <td>'.$data_exploded[2].'</td>
                                            <td style="text-align: right;">'.number_format($total_sales, 2).'</td>
                                            <td style="text-align: right;">'.number_format($item_sold).'</td>
                                            <td style="text-align: center;">'.$days_work.'</td>
                                            <td style="text-align: right;">'.number_format($sales_per_day, 2).'</td>
                                            <td style="text-align: center;">'.number_format($total_hours).'</td>
                                            <td style="text-align: center;">'.number_format($total_minutes).'</td>
                                            <td style="text-align: right;">'.number_format($total_hrs_mos, 2).'</td>
                                            <td style="text-align: center;">'.number_format($no_of_hrs_duty, 2).'</td>
                                            <td style="text-align: right;">'.number_format($sales_per_hour, 2).'</td>
                                        </tr>'.$break_html.'
                                    ';
            }
            
            $non_cashier_html .= '</table>'.$user_tbl.'';
        }
        
        $tbl .= '
                </table>'.$user_tbl.$non_cashier_html.'
                ';

        $this->ppdf->writeHTML($tbl, true, false, false, false, '');
        ob_end_clean();
        $this->ppdf->Output();  
    }

    public function print_cashier_per_hour_productivivty_ctrl()
    { 
        ini_set('max_execution_time', 0); 
        $month_name = date('F', mktime(0, 0, 0, $_POST['month'], 10)); 
        $bcode = substr($_POST['dcode'], 0, 4);
        $bunit_data = $this->liquidation_model->get_pisbunit_v2($bcode);
        $bname = '';
        if(!is_null($bunit_data->business_unit))
        {
            $bname = $bunit_data->business_unit;
        }
        // ==================================================================
        $jr_dept_name = $_POST['dept_name'];
        if($_POST['dept_name'] == 'SUPERMARKET')
        {
            $jr_dept_name = 'GCOC';
        }
        // ==================================================================================================
        $supervisor_data = $this->liquidation_model->get_cashier_productivity_officer_model($_POST['dcode']);
        $prepared_name = '';
        $prepared_position = '';
        $noted_name = '';
        $noted_position = '';
        foreach($supervisor_data as $data)
        {
            if($data['status'] == 'PREPARED')
            {
                $sup_data = $this->liquidation_model->emp_data_model($data['emp_id']);
                if(!is_null($sup_data->name))
                {
                    $prepared_name = $sup_data->name;
                    $prepared_position = $sup_data->position;
                }
            }
            // ===============================================================================
            if($data['status'] == 'NOTED')
            {
                $sup_data = $this->liquidation_model->emp_data_model($data['emp_id']);
                if(!is_null($sup_data->name))
                {
                    $noted_name = $sup_data->name;
                    $noted_position = $sup_data->position;
                }
            }
        }
        // ==========================================================================================
        $mall_manager_data = $this->liquidation_model->get_mall_manager_model($bcode);
        $approved_name = '';
        $approved_position = '';
        if(!is_null($mall_manager_data->emp_id))
        {
            $manager_data = $this->liquidation_model->emp_data_model($mall_manager_data->emp_id);
            if(!is_null($manager_data->name))
            {
                $approved_name = $manager_data->name;
                $approved_position = $manager_data->position;
            }
        }
        // ===========================================================================================
        $cashier_data = $this->liquidation_model->all_cashier_productivivty_model($_POST['dcode'],$_POST['month'],$_POST['year']);
        $cashier_name_array = array();
        foreach($cashier_data as $cashier)
        {
            $emp_data = $this->liquidation_model->emp_data_model($cashier['emp_id']);
            if(!is_null($emp_data->name))
            {
                $excluded_sales = array('Section Head','COC Checker');
                if(!in_array($emp_data->position, $excluded_sales))
                {
                    array_push($cashier_name_array, $emp_data->name.'|'.$cashier['emp_id'].'|'.$emp_data->position);
                }
            }
        }
        sort($cashier_name_array);
        // ======================================================================================================================================
        $this->ppdf = new TCPDF();
        $this->ppdf->SetTitle("CASHIER PER HOUR PRODUCTIVITY");
        $this->ppdf->SetPrintHeader(true);
        $this->ppdf->SetFont('', '', 11, '', true); 
        $this->ppdf->SetMargins(30, 7, 7);
        $this->ppdf->AddPage("L","LEGAL");
        $this->ppdf->SetFooterMargin(7);
        // $this->ppdf->SetAutoPageBreak(true, PDF_MARGIN_FOOTER);

        $pages = "Page: ".$this->ppdf->getAliasNumPage().'/'.$this->ppdf->getAliasNbPages();

        $user_tbl = '<br><br><br><br>
                    <table>
                        <tr>
                            <th style="text-align: right; width: 8%;">Prepared by:</th>
                            <th style="text-align: center; width: 25.3%;"><u style="font-weight: bold;">'.strtoupper($prepared_name).'</u></th>
                            <th style="text-align: right; width: 8%;">Noted by:</th>
                            <th style="text-align: center; width: 25.3%;"><u style="font-weight: bold;">'.strtoupper($noted_name).'</u></th>
                            <th style="text-align: right; width: 8%;">Approved by:</th>
                            <th style="text-align: center; width: 25.3%;"><u style="font-weight: bold;">'.strtoupper($approved_name).'</u></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align: center;">'.$jr_dept_name.' - '.$prepared_position.'</td>
                            <td></td>
                            <td style="text-align: center;">'.ucfirst(strtolower($_POST['dept_name'])).' - '.$noted_position.'</td>
                            <td></td>
                            <td style="text-align: center;">'.$approved_position.'</td>
                        </tr>
                    </table>
                    ';
            
        $header_html = '
                        <p>
                            '.$bname.' &nbsp;&nbsp;&nbsp;&nbsp; '.$_POST['dept_name'].' <br>
                            CASHIER PRODUCTIVITY BASED ON SALES PER HOUR <br>
                            FOR THE MONTH OF '.strtoupper($month_name).', '.$_POST['year'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$pages.'
                        </p>
                    ';
        
        $header_html .= '
                        <table border="1" cellpadding="3">
                            <tr>
                                <th style="vertical-align: middle; text-align: center; width: 25%;" rowspan="2"><br><br>EMPLOYEE NAME</th>
                                <th style="vertical-align: middle; text-align: center; width: 10%;" rowspan="2"><br><br>POSITION</th>
                                <th style="vertical-align: middle; text-align: center; width: 10%;" rowspan="2"><br><br>TOTAL SALES</th>
                                <th style="vertical-align: middle; text-align: center; width: 7%;" rowspan="2"><br><br>ITEM SOLD</th>
                                <th style="vertical-align: middle; text-align: center; width: 6%;" rowspan="2">DAYS WORK</th>
                                <th style="vertical-align: middle; text-align: center; width: 9%;" rowspan="2"><br><br>SALES / DAY</th>
                                <th style="vertical-align: middle; text-align: center; width: 11%;" colspan="2" scope="colgroup">TIME CONSUMED</th>
                                <th style="vertical-align: middle; text-align: center; width: 7%;" rowspan="2">TOTAL HOURS / MOS</th>
                                <th style="vertical-align: middle; text-align: center; width: 6%;" rowspan="2"># OF HOURS/DUTY</th>
                                <th style="vertical-align: middle; text-align: center; width: 9%;" rowspan="2"><br><br>SALES / HOURS</th>
                            </tr>
                            <tr style="border-top: outset;">
                                <th style="vertical-align: middle; text-align: center;" scope="col">TIME</th>
                                <th style="vertical-align: middle; text-align: center;" scope="col">MIN.</th>
                            </tr>
                        ';
                
        $tbl = $header_html;
        
        $sales_per_hour_array = array();
        for($a=0; $a<count($cashier_name_array); $a++)
        { 
            $data_exploded = explode("|", $cashier_name_array[$a]);
            $productivity_data = $this->liquidation_model->get_cashier_productivivty_model($data_exploded[1],$_POST['dcode'],$_POST['month'],$_POST['year']);
            $sales_date_array = array();
            $item_sold = 0;
            $days_work = 0;
            $total_hours = 0;
            $total_minutes = 0;
            foreach($productivity_data as $productivity)
            {
                array_push($sales_date_array, $productivity['sales_date']);
                $item_sold += $productivity['item_sold'];
                if($productivity['hours'] > 4)
                {
                    $days_work += 1;
                }
                else if($productivity['hours'] <= 4)
                {
                    $days_work += 0.5;
                }
                $total_hours += $productivity['hours'];
                $total_minutes += $productivity['minutes'];
            }
            // ============================================================================
            $sales_data = $this->liquidation_model->get_productivivty_sales_model($data_exploded[1],$_POST['dcode'],$sales_date_array);
            $total_sales = 0;
            if(!is_null($sales_data->total_sales))
            {
                $total_sales = $sales_data->total_sales;
            }



            $sales_per_day = $total_sales / $days_work;

            $total_hrs_mos = $total_minutes / 60 + $total_hours;
            $no_of_hrs_duty = $total_hrs_mos / $days_work;
            $sales_per_hour = $sales_per_day / $no_of_hrs_duty;
            array_push($sales_per_hour_array, array($sales_per_hour,$sales_per_hour.'|'.$data_exploded[0].'|'.$data_exploded[2].'|'.$total_sales.'|'.$item_sold.'|'.$days_work.'|'.$sales_per_day.'|'.$total_hours.'|'.$total_minutes.'|'.$total_hrs_mos.'|'.$no_of_hrs_duty));
        }

        rsort($sales_per_hour_array);
        $counter = 0;
        for($b=0; $b<count($sales_per_hour_array); $b++)
        { 
            $counter += 1;
            $break_html = '';
            if($counter == 19)
            {
                $break_html = '
                                </table><br pagebreak="true"/>'.$header_html.'
                            ';
                $counter = 0;
            }
            // ============================================================================
            $data_exploded = explode("|", $sales_per_hour_array[$b][1]);
            // ============================================================================
            $tbl .= '
                        <tr>
                            <td>'.$data_exploded[1].'</td>
                            <td>'.$data_exploded[2].'</td>
                            <td style="text-align: right;">'.number_format($data_exploded[3], 2).'</td>
                            <td style="text-align: right;">'.number_format($data_exploded[4]).'</td>
                            <td style="text-align: center;">'.$data_exploded[5].'</td>
                            <td style="text-align: right;">'.number_format($data_exploded[6], 2).'</td>
                            <td style="text-align: center;">'.number_format($data_exploded[7]).'</td>
                            <td style="text-align: center;">'.number_format($data_exploded[8]).'</td>
                            <td style="text-align: right;">'.number_format($data_exploded[9], 2).'</td>
                            <td style="text-align: center;">'.number_format($data_exploded[10], 2).'</td>
                            <td style="text-align: right;">'.number_format($data_exploded[0], 2).'</td>
                        </tr>'.$break_html.'
                    ';
        }

        $tbl .= '
                </table>'.$user_tbl.'
                ';

        $this->ppdf->writeHTML($tbl, true, false, false, false, '');
        ob_end_clean();
        $this->ppdf->Output();  
    }






}
