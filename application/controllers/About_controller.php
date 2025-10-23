<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About_controller extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model("main_model");
		$this->load->model("cashier_model");
		// $this->load->model("cfscashier_model");
		// $this->load->helper('text');
        $this->load->model('About_model');
	}
    public function cashier_side() {
        $data['emp_id'] = $this->session->userdata('emp_id');
        $data['username'] = $this->session->userdata('username');

        if(empty($_SESSION['emp_id'])) {
            redirect('http://'.$_SERVER['HTTP_HOST'].'/hrms/employee/');
        }
        else
        {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);

            $data['employees'] = $this->About_model->getSpecificEmployees();

            $data['photo_url'] = '';
            if (count($info) > 0) {
                $data['photo_url'] = $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }
            $this->load->view('cashier_side/header', $data);
            $this->load->view('About', $data);

        }
    }
    public function accounting_side() {
        $data['emp_id'] = $this->session->userdata('emp_id');
        $data['username'] = $this->session->userdata('username');

        if(empty($_SESSION['emp_id'])) {
            redirect('http://'.$_SERVER['HTTP_HOST'].'/hrms/employee/');
        }
        else
        {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);

            $data['employees'] = $this->About_model->getSpecificEmployees();

            $data['photo_url'] = '';
            if (count($info) > 0) {
                $data['photo_url'] = $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }
            $this->load->view('accounting_side/header', $data);
            $this->load->view('About', $data);

        }
    }
    public function acounting_supervisor_side() {
        $data['emp_id'] = $this->session->userdata('emp_id');
        $data['username'] = $this->session->userdata('username');

        if(empty($_SESSION['emp_id'])) {
            redirect('http://'.$_SERVER['HTTP_HOST'].'/hrms/employee/');
        }
        else
        {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);

            $data['employees'] = $this->About_model->getSpecificEmployees();

            $data['photo_url'] = '';
            if (count($info) > 0) {
                $data['photo_url'] = $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }
            $this->load->view('accounting_supervisor_side/header', $data);
            $this->load->view('About', $data);

        }
    }
    public function supervisor_side() {
        $data['emp_id'] = $this->session->userdata('emp_id');
        $data['username'] = $this->session->userdata('username');

        if(empty($_SESSION['emp_id'])) {
            redirect('http://'.$_SERVER['HTTP_HOST'].'/hrms/employee/');
        }
        else
        {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);

            $data['employees'] = $this->About_model->getSpecificEmployees();

            $data['photo_url'] = '';
            if (count($info) > 0) {
                $data['photo_url'] = $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }
            $this->load->view('supervisor_side/header', $data);
            $this->load->view('About', $data);

        }
    }
    public function liquidation_supervisor_side() {
        $data['emp_id'] = $this->session->userdata('emp_id');
        $data['username'] = $this->session->userdata('username');

        if(empty($_SESSION['emp_id'])) {
            redirect('http://'.$_SERVER['HTTP_HOST'].'/hrms/employee/');
        }
        else
        {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);

            $data['employees'] = $this->About_model->getSpecificEmployees();

            $data['photo_url'] = '';
            if (count($info) > 0) {
                $data['photo_url'] = $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }
            $this->load->view('header', $data);
            $this->load->view('About', $data);

        }
    }
}