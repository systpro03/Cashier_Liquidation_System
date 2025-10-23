<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Treasury_controller extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model("main_model");
        $this->load->model("cashier_model");
		$this->load->model("liquidation_model");
		$this->load->model("cfscashier_model");
		$this->load->model("treasury_model");
		$this->load->helper('text');
	}

    public function treasury_dashboard_ctrl()
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
         
            $this->load->view('treasury_side/dashboard', $data);
        }
    }

	public function treasury_ctrl()
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
         
            $this->load->view('treasury_side/bank_tagging', $data);
        }
	}

	public function get_allbusinessunit_ctrl()
	{

        $bunit_name = $this->treasury_model->get_bunit_name_model();
        $html='';
        foreach($bunit_name as $name)
        {
            $html.='
            		<option id="" style="text-align: center;" value="'.$name['business_unit'].'">'.$name['business_unit'].'</option>
            		';
        }
        // var_dump($bunit_name);

        $data['html']=$html;                      
        echo json_encode($data);
	}

	public function get_bunit_code_ctrl()
	{
		$bname = $_POST['bname'];
		$bunit_code = $this->treasury_model->get_bunit_code_model($bname);
        $bcode='';
        foreach($bunit_code as $code)
        {
            $bcode=$code['company_code'].$code['bunit_code'];
        }
        // var_dump($bcode);

        $data['bcode']=$bcode;                      
        echo json_encode($data);

	}

	public function get_dept_name_ctrl()
	{
		$bcode = $_POST['bunit_code'];
		$dept_name = $this->treasury_model->get_dept_name_model($bcode);
        $html='';
        foreach($dept_name as $name)
        {
            $html.='
            		<option id="" style="text-align: center;" value="'.$name['dept_name'].'">'.$name['dept_name'].'</option>
            		';
        }
        // var_dump($dept);

        $data['html']=$html;                      
        echo json_encode($data);
	}

	public function get_dept_code_ctrl()
	{
		$bunit_code = $_POST['bunit_code'];
		$dept_name = $_POST['dept_name'];
		$dept_code = $this->treasury_model->get_dept_code_model($bunit_code,$dept_name);

        $dcode='';
        foreach($dept_code as $code)
        {
            $dcode=$code['company_code'].$code['bunit_code'].$code['dept_code'];
        }
        // var_dump($dept_code);

        $data['dcode']=$dcode;                      
        echo json_encode($data);
	}

	public function get_banks_ctrl()
	{
		$banks_name = $this->treasury_model->get_banks_name_model();
        $html='';
        foreach($banks_name as $bank)
        {
            $html.='
            		<option id="" style="text-align: center;" value="'.$bank['bank_name'].'">'.$bank['bank_name'].'</option>
            		';
        }
        // var_dump($dept);

        $data['html']=$html;                      
        echo json_encode($data);
	}

    public function submit_bank_tagging_ctrl()
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
            $this->treasury_model->submit_bank_tagging_model(
                $emp_id,
                $_POST['bunit_name'],
                $_POST['department_name'],
                $_POST['bunit_code'],
                $_POST['dept_code'],
                $_POST['bank_name'],
                $_POST['bank_acctno'],
                $_POST['acct_name']
            );

            echo json_encode($save);
        }
    }

    public function get_setup_bank_ctrl()
    {
        $emp_id = $_SESSION['emp_id'];
        $setup_bank_data = $this->treasury_model->get_setup_bank_model($emp_id);
        // var_dump($adjusted_data);
        $html='';
        foreach($setup_bank_data as $bank)
        {
            $html.=' 
                        <tr>
                          <td>'.$bank['id'].'</td>
                          <td>'.$bank['bunit_name'].'</td>
                          <td>'.$bank['dept_name'].'</td>
                          <td>'.$bank['bank_name'].'</td>
                          <td>'.$bank['bank_acct_no'].'</td>
                          <td>'.$bank['bank_acct_name'].'</td>
                          <td>
                            <a id="" onclick="edit_banksetup_js('.$bank['id'].')"><i style="font-style: normal; font-size: small;">✍️</i></a>&nbsp;&nbsp;&nbsp;
                            <a id="" onclick="delete_banksetup_js('.$bank['id'].')"><i style="font-style: normal; font-size: small;">❌</i></a>
                          </td>
                        </tr>
                      ';
        } 
        

        $data['html']=$html;                      
        echo json_encode($data);
    }

    public function delete_banksetup_ctrl()
    {

        $id = $_POST['id'];
        $message = 'deleted';
        $this->treasury_model->delete_banksetup_model($id);

        echo json_encode($message);
    }

    public function get_selected_bank_ctrl()
    {
        $id = $_POST['id'];
        $bank_details = $this->treasury_model->get_selected_bank_model($id);

        $edited_id  ='';
        $buname     ='';
        $dname      ='';
        $cbcode     ='';
        $dcode      ='';
        $bankname   ='';
        $acctno     ='';
        $acctname   ='';
        foreach($bank_details as $bank)
        {
            $edited_id  = $bank['id'];
            $buname     = $bank['bunit_name'];
            $dname      = $bank['dept_name'];
            $cbcode     = $bank['company_bunit_code'];
            $dcode      = $bank['dept_code'];
            $bankname   = $bank['bank_name'];
            $acctno     = $bank['bank_acct_no'];
            $acctname   = $bank['bank_acct_name'];
        }
        // var_dump($bank_details);

        $data['edited_id']  = $edited_id;                      
        $data['buname']     = $buname;                      
        $data['dname']      = $dname;                      
        $data['cbcode']     = $cbcode;                      
        $data['dcode']      = $dcode;                      
        $data['bankname']   = $bankname;                      
        $data['acctno']     = $acctno;                      
        $data['acctname']   = $acctname;                      
        echo json_encode($data);
    }

    public function update_bank_tagging_ctrl()
    {
        if(empty($_SESSION['emp_id']))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $id = $_POST['id'];

            $message = 'updated';
            $this->treasury_model->update_bank_tagging_model($id);

            echo json_encode($message);
        }
    }

    public function save_updated_banktagging_ctrl()
    {
        $id = $_POST['id'];
        $buname = $_POST['buname'];
        $dname = $_POST['dname'];
        $dcode = $_POST['dcode'];
        $bankname = $_POST['bankname'];
        $acctno = $_POST['acctno'];
        $acctname = $_POST['acctname'];

        $emp_id = $_SESSION['emp_id'];
        $message = 'saved';
        $this->treasury_model->save_updated_banktagging_model($emp_id,$id,$buname,$dname,$dcode,$bankname,$acctno,$acctname);

        echo json_encode($message);
    }

}
