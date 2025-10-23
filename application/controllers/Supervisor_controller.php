<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supervisor_controller extends CI_Controller
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

    public function supervisor_dashboard_ctrl()
    {
        $data['emp_id'] = $_SESSION['emp_id'];
        $data['username'] = $_SESSION['username'];

        if (empty($_SESSION['emp_id'])) {
            redirect('http://' . $_SERVER['HTTP_HOST'] . '/hrms/employee/');
        } else {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);


            $data['photo_url'] = '';
            if (count($info) > 0) {
                $data['photo_url'] = $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }

            $this->load->view('supervisor_side/dashboard', $data);
        }
    }

    public function supervisor_cashier_violation_ctrl()
    {
        $data['emp_id'] = $_SESSION['emp_id'];
        $data['username'] = $_SESSION['username'];

        if (empty($_SESSION['emp_id'])) {
            redirect('http://' . $_SERVER['HTTP_HOST'] . '/hrms/employee/');
        } else {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);


            $data['photo_url'] = '';
            if (count($info) > 0) {
                $data['photo_url'] = $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }

            $this->load->view('supervisor_side/sup_cashier_violation_form', $data);
            $this->load->view('supervisor_side/modal_loader', $data);
        }
    }

    public function supervisor_add_payment_ctrl()
    {
        $data['emp_id'] = $_SESSION['emp_id'];
        $data['username'] = $_SESSION['username'];

        if (empty($_SESSION['emp_id'])) {
            redirect('http://' . $_SERVER['HTTP_HOST'] . '/hrms/employee/');
        } else {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);


            $data['photo_url'] = '';
            if (count($info) > 0) {
                $data['photo_url'] = $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }

            $this->load->view('supervisor_side/sup_add_payment', $data);
        }
    }

    public function supervisor_add_payment_ctrl_v2()
    {
        $data['emp_id'] = $_SESSION['emp_id'];
        $data['username'] = $_SESSION['username'];

        if (empty($_SESSION['emp_id'])) {
            redirect('http://' . $_SERVER['HTTP_HOST'] . '/hrms/employee/');
        } else {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);


            $data['photo_url'] = '';
            if (count($info) > 0) {
                $data['photo_url'] = $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }

            $this->load->view('supervisor_side/sup_add_payment_v2', $data);
        }
    }

    public function sup_cashier_denomination_ctrl()
    {
        $data['emp_id'] = $_SESSION['emp_id'];
        $data['username'] = $_SESSION['username'];

        if (empty($_SESSION['emp_id'])) {
            redirect('http://' . $_SERVER['HTTP_HOST'] . '/hrms/employee/');
        } else {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);


            $data['photo_url'] = '';
            if (count($info) > 0) {
                $data['photo_url'] = $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();

            $this->load->view('supervisor_side/cashier_denomination', $data);
        }
    }

    public function sup_pending_denomination_ctrl()
    {
        $data['emp_id'] = $_SESSION['emp_id'];
        $data['username'] = $_SESSION['username'];

        if (empty($_SESSION['emp_id'])) {
            redirect('http://' . $_SERVER['HTTP_HOST'] . '/hrms/employee/');
        } else {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);


            $data['photo_url'] = '';
            if (count($info) > 0) {
                $data['photo_url'] = $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();

            $this->load->view('supervisor_side/pending_denomination', $data);
        }
    }

    public function sup_cashier_deleted_denomination_ctrl()
    {
        $data['emp_id'] = $_SESSION['emp_id'];
        $data['username'] = $_SESSION['username'];

        if (empty($_SESSION['emp_id'])) {
            redirect('http://' . $_SERVER['HTTP_HOST'] . '/hrms/employee/');
        } else {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);


            $data['photo_url'] = '';
            if (count($info) > 0) {
                $data['photo_url'] = $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();

            $this->load->view('supervisor_side/deleted_cashier_denomination', $data);
        }
    }

    public function sup_deleted_pending_denomination_ctrl()
    {
        $data['emp_id'] = $_SESSION['emp_id'];
        $data['username'] = $_SESSION['username'];

        if (empty($_SESSION['emp_id'])) {
            redirect('http://' . $_SERVER['HTTP_HOST'] . '/hrms/employee/');
        } else {
            $info = $this->main_model->info_mod($_SESSION['emp_id']);


            $data['photo_url'] = '';
            if (count($info) > 0) {
                $data['photo_url'] = $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
            }

            $data['badge_notif_counter'] = $this->liquidation_model->get_notif_counter_model();

            $this->load->view('supervisor_side/deleted_pending_cashier_denomination', $data);
        }
    }

    public function display_cashier_violation_ctrl()
    {
        if (empty($_SESSION['emp_id'])) {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        } else {
            $emp_id = $_SESSION['emp_id'];
            $vms_cutoff_date = $_POST['dt_from'] . ' / ' . $_POST['dt_to'];
            $cashier_violation_data = $this->supervisor_model->get_cashier_violation_model($emp_id, $vms_cutoff_date);
            $html = '
                    <table class="table table-striped table-bordered table-hover display" id="cashier_violation_table" style="color: black; font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle;">
                                                <center>CASHIER INCHARGE
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>B.U / DEPT.
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>SALES DATE
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>TOTAL SALES
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>REGISTERED SALES
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>VARIANCE AMT.
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>TYPE
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>LIQUIDATION OFFICER
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center><input type="checkbox" id="checkAll" style="height: 25px; width: 25px; float: right;">
                                            </th>
                                        </tr>
                                    </thead>
                                    <form name="cashier_violation_viewing_form" id="cashier_violation_viewing_form">
                                        <tbody id="cashier_violation_viewing_tbody">
                    ';

            $bcode = '';
            $total_sales = 0;
            foreach ($cashier_violation_data as $data) {
                /*=======================GET BUSINESS UNIT===========================*/
                $bunit_data = $this->liquidation_model->get_businessunit_model($data['bcode']);
                $bunit_name = '';
                foreach ($bunit_data as $bunit) {
                    $bunit_name = $bunit['business_unit'];
                }
                /*===========================GET DEPARTMENT=============================*/
                $dept_data = $this->liquidation_model->get_pisdepartment($data['dcode']);
                $dept_name = '';
                foreach ($dept_data as $dept) {
                    $dept_name = $dept['dept_name'];
                }
                /*===========================GET SECTION=============================*/
                $section_data = $this->liquidation_model->get_pis_section_model($data['scode']);
                $section_name = '';
                foreach ($section_data as $sec) {
                    $section_name = $sec['section_name'];
                }
                /*===========================GET SUB SECTION=============================*/
                $sub_section_data = $this->liquidation_model->get_pis_sub_section_model($data['sscode']);
                $sub_section_name = '';
                foreach ($sub_section_data as $sub_sec) {
                    $sub_section_name = $sub_sec['sub_section_name'];
                }
                /*===========================GET LIQUIDATION OFFICER=============================*/
                $liquidation_officer_data = $this->liquidation_model->get_pisdata($data['officer_id']);
                $liquidation_officer = '';
                foreach ($liquidation_officer_data as $lo_officer) {
                    $liquidation_officer = $lo_officer['name'];
                }
                /*=======================================================================*/
                $var_amt = '';
                $type = '';
                if ($data['sop_type'] == 'S') {
                    $type = 'SHORT';
                    $var_amt = '<label style="color:red; font-weight: bold;">' . number_format($data['sop'], 2) . '</label>';
                } else if ($data['sop_type'] == 'O') {
                    $type = 'OVER';
                    $var_amt = '<label style="color:green; font-weight: bold;">' . number_format($data['sop'], 2) . '</label>';
                } else if ($data['sop_type'] == 'PF') {
                    $type = 'PERFECT';
                    $var_amt = '<label style="color:green; font-weight: bold;">' . number_format($data['sop'], 2) . '</label>';
                }
                // ============================================================================================================
                $total_sales = $data['gtotal'] + $data['discount'];
                $html .= ' 
                        <tr>
                          <td style="vertical-align: middle;">' . $data['cname'] . '</td>
                          <td style="vertical-align: middle;">' . $bunit_name . '<br>' . $dept_name . '<br>' . $section_name . '<br>' . $sub_section_name . '</td>
                          <td style="vertical-align: middle;">' . $data['dsales'] . '</td>
                          <td style="vertical-align: middle;">' . number_format($total_sales, 2) . '</td>
                          <td style="vertical-align: middle;">' . number_format($data['rsales'], 2) . '</td>
                          <td style="vertical-align: middle;">' . $var_amt . '</td>
                          <td style="vertical-align: middle;">' . $type . '</td>
                          <td style="vertical-align: middle;">' . $liquidation_officer . '</td>
                          <td style="vertical-align: middle;">
                            <input type="checkbox" class="check_box" id="" onclick="uncheck_checkall_js()" value="' . $data['cs_data_id'] . '|' . $data['cashier_id'] . '|' . $data['sop_type'] . '|' . $data['sop'] . '|' . $data['dsales'] . '" style="width: 25px; height: 25px;">
                          </td>
                        </tr>
                      ';
            }

            $html .= '
                            </tbody>
                        </form>
                    </table>

                    <script>

                         $("#checkAll").click(function(){
                            $("input:checkbox").not(this).prop("checked", this.checked);
                        });

                        $(".check_box").change(function(){
                            if ($(".check_box:checked").length == $(".check_box").length) {
                            $("#checkAll").prop( "checked", true );
                            }
                        });
                        
                    </script>

                    ';


            $data['html'] = $html;
            echo json_encode($data);
        }
    }

    public function display_forwarded_violation_ctrl()
    {
        if (empty($_SESSION['emp_id'])) {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        } else {
            $emp_id = $_SESSION['emp_id'];
            // var_dump($_SESSION['emp_id']);
            // die();
            $cashier_violation_data = $this->supervisor_model->get_forwarded_violation_model($emp_id, $_POST['dtfrom'], $_POST['dtto']);

            // var_dump($cashier_violation_data);
            // die();
            $html = '
                    <table class="table table-striped table-bordered table-hover display" id="forwarded_violation_table" style="color: black; font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle;">
                                                <center>ACTION
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>CASHIER INCHARGE
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>BUSINESS UNIT<br>DEPARTMENT
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>SALES DATE
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>TOTAL SALES
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>REGISTERED SALES
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>VARIANCE AMT.
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>TYPE
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>LIQUIDATION OFFICER
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>SUBMITTED OFFICER
                                            </th>
                                            <th style="vertical-align: middle;">
                                                <center>DATE/TIME SUBMITTED
                                            </th>

                                        </tr>
                                    </thead>
                                    <form name="cashier_violation_viewing_form" id="cashier_violation_viewing_form">
                                        <tbody id="cashier_violation_viewing_tbody">
                    ';

            $bcode = '';
            $total_sales = 0;
            foreach ($cashier_violation_data as $data) {
                /*=======================GET BUSINESS UNIT===========================*/
                $bunit_data = $this->liquidation_model->get_businessunit_model($data['bcode']);
                $bunit_name = '';
                foreach ($bunit_data as $bunit) {
                    if ($bunit) {
                        $bunit_name = $bunit['business_unit'];
                    }
                }
                /*===========================GET DEPARTMENT=============================*/
                $dept_data = $this->liquidation_model->get_pisdepartment($data['dcode']);
                $dept_name = '';
                foreach ($dept_data as $dept) {
                    if ($dept) {
                        $dept_name = $dept['dept_name'];
                    }
                }
                /*===========================GET SECTION=============================*/
                $section_data = $this->liquidation_model->get_pis_section_model($data['scode']);
                $section_name = '';
                foreach ($section_data as $sec) {
                    if ($sec) {
                        $section_name = $sec['section_name'];
                    }
                }
                /*===========================GET SUB SECTION=============================*/
                $sub_section_data = $this->liquidation_model->get_pis_sub_section_model($data['sscode']);
                $sub_section_name = '';
                foreach ($sub_section_data as $sub_sec) {
                    if ($sub_sec) {
                        $sub_section_name = $sub_sec['sub_section_name'];
                    }
                }
                /*===========================GET LIQUIDATION OFFICER=============================*/
                $liquidation_officer_data = $this->liquidation_model->get_pisdata($data['officer_id']);
                $liquidation_officer = '';
                foreach ($liquidation_officer_data as $lo_officer) {
                    $liquidation_officer = $lo_officer['name'];
                }
                /*===========================GET SUBMITTED OFFICER=============================*/
                $submitted_officer_data = $this->liquidation_model->get_pisdata($data['vms_officer_for']);
                $submitted_officer = '';
                foreach ($submitted_officer_data as $sup_officer) {
                    $submitted_officer = $sup_officer['name'];
                }
                /*=======================================================================*/

                // Louei Added For The Supervisor Cancel
                $supervisor_requested = $this->liquidation_model->get_pisdata($emp_id);
                $supervisor_requested_by = '';
                foreach ($supervisor_requested as $sup) {
                    $supervisor_requested_by = $sup['name'];
                }



                $var_amt = '';
                $type = '';
                if ($data['sop_type'] == 'S') {
                    $type = 'SHORT';
                    $var_amt = '<label style="color:red; font-weight: bold;">' . number_format($data['sop'], 2) . '</label>';
                } else if ($data['sop_type'] == 'O') {
                    $type = 'OVER';
                    $var_amt = '<label style="color:green; font-weight: bold;">' . number_format($data['sop'], 2) . '</label>';
                } else if ($data['sop_type'] == 'PF') {
                    $type = 'PERFECT';
                    $var_amt = '<label style="color:green; font-weight: bold;">' . number_format($data['sop'], 2) . '</label>';
                }
                // ==========================================================================================================
                $total_sales = $data['gtotal'] + $data['discount'];
                $html .= ' 
                        <tr>
                          <td style="vertical-align: middle;"><button class="btn btn-sm btn-danger" onclick="cancel_violation(\'' . $data['cs_data_id'] . '\', \'' . $data['cname'] . '\',\'' . $data['cashier_id'] . '\', \'' . $data['sop'] . '\', \'' . $data['sop_type'] . '\' , \'' . date('F d, Y', strtotime($data['dsales'])) . '\', \'' . $supervisor_requested_by . '\',  \'' . $bunit_name . '\')">Cancel</button></td>
                          <td style="vertical-align: middle;">' . $data['cname'] . '</td>
                          <td style="vertical-align: middle;">' . $bunit_name . '<br>' . $dept_name . '<br>' . $section_name . '<br>' . $sub_section_name . '</td>
                          <td style="vertical-align: middle;">' . $data['dsales'] . '</td>
                          <td style="vertical-align: middle;">' . number_format($total_sales, 2) . '</td>
                          <td style="vertical-align: middle;">' . number_format($data['rsales'], 2) . '</td>
                          <td style="vertical-align: middle;">' . $var_amt . '</td>
                          <td style="vertical-align: middle;">' . $type . '</td>
                          <td style="vertical-align: middle;">' . $liquidation_officer . '</td>
                          <td style="vertical-align: middle;">' . $submitted_officer . '</td>
                          <td style="vertical-align: middle;">' . $data['vms_date_time'] . '</td>
                        </tr>
                      ';
            }

            $html .= '
                            </tbody>
                        </form>
                    </table>
                    ';


            $data['html'] = $html;
            echo json_encode($data);
        }
    }

    public function submit_violation_ctrl()
    {
        if (empty($_SESSION['emp_id'])) {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        } else {
            $officer_incharge = $_SESSION['emp_id'];
            $message = 'success';
            for ($i = 0; $i < count($_POST['id']); $i++) {
                $cashier_data = explode('|', $_POST['id'][$i]);
                $type = 'over';
                if ($cashier_data[2] == 'S') {
                    $type = 'short';
                }
                $this->supervisor_model->update_vms_cebocsdata_model($cashier_data[0], $officer_incharge);
                $this->supervisor_model->insert_negli_model($cashier_data[0], $cashier_data[1], $type, $cashier_data[3], $cashier_data[4], $officer_incharge);
            }

            echo json_encode($message);
        }
    }

    public function get_bunit_ctrl()
    {
        $bunit_data = $this->admin_model->get_bunit_model();

        $bunit_name = '';
        foreach ($bunit_data as $data) {
            $bunit_name .= '
                        <option value="' . $data['bcode'] . '">' . $data['business_unit'] . '</option>
                        ';
        }

        $data['bunit_name'] = $bunit_name;
        echo json_encode($data);
    }

    public function get_bunit_ctrl_v2()
    {
        $bunit_data = $this->supervisor_model->get_bunit_model_v2($_SESSION['emp_id']);
        $bname_array = array();
        foreach ($bunit_data as $data) {
            $bunit_info = $this->supervisor_model->get_bunitname_model($data['bcode']);
            foreach ($bunit_info as $info) {
                array_push($bname_array, $info['business_unit'] . '|' . $data['bcode']);
            }
        }
        sort($bname_array);
        $bunit_name = '
                    <option id="bu_option">Select Business Unit</option>
                    ';
        $bname_explode = '';
        for ($i = 0; $i < count($bname_array); $i++) {
            $bname_explode = explode('|', $bname_array[$i]);
            $bunit_name .= '
            <option value="' . $bname_explode[1] . '">' . $bname_explode[0] . '</option>
            ';
        }

        $data['bunit_name'] = $bunit_name;
        echo json_encode($data);
    }

    public function mop_get_bunit_name_ctrl()
    {
        $bunit_data = $this->liquidation_model->get_bunit_name_model($_SESSION['emp_id']);
        $bunit_name = '';
        foreach ($bunit_data as $bunit) {
            $bunit_name .= '
                            <option value="' . $bunit['bcode'] . '">' . $bunit['business_unit'] . '</option>
                            ';
        }

        $data['bunit_name'] = $bunit_name;
        echo json_encode($data);
    }

    public function display_department_ctrl()
    {
        $dept_data = $this->supervisor_model->display_department_model($_SESSION['emp_id'], $_POST['bunit_code']);
        $dept_name = '
                    <option id="dept_option">Select Department</option>
                    ';
        foreach ($dept_data as $dept) {
            $dept_name .= '<option value="' . $dept['dcode'] . '">' . $dept['dept_name'] . '</option>';
        }

        $data['dept_name'] = $dept_name;
        echo json_encode($data);
    }

    public function save_payment_ctrl()
    {
        if (empty($_SESSION['emp_id'])) {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        } else {
            $validate = $this->supervisor_model->validate_payment_model($_POST['type'], $_POST['mop'], $_POST['dept_code']);

            if (empty($validate)) {
                $message = 'success';
                $this->supervisor_model->save_payment_model($_POST['type'], $_POST['mop'], $_POST['bunit_code'], $_POST['dept_code']);

                echo json_encode($message);
            } else {
                $message = 'ALREADY EXIST';
                echo json_encode($message);
            }
        }
    }

    public function save_payment_ctrl_v2()
    {
        if (empty($_SESSION['emp_id'])) {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        } else {
            $message = 'success';
            for ($i = 0; $i < count($_POST['mop_data']); $i++) {
                $type = '';
                if ($_POST['mop_data'][$i] == 'Cash' || $_POST['mop_data'][$i] == 'CASH') {
                    $type = 'CASH';
                    $this->supervisor_model->save_payment_model($type, $_POST['mop_data'][$i], $_POST['bcode'], $_POST['dcode']);
                } else {
                    $type = 'NONCASH';
                    $this->supervisor_model->save_payment_model($type, $_POST['mop_data'][$i], $_POST['bcode'], $_POST['dcode']);
                }
            }

            echo json_encode($message);
        }
    }

    public function display_payment_list_ctrl()
    {
        $payment_list = $this->supervisor_model->get_payment_list_model($_SESSION['emp_id']);
        $html = '
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

        foreach ($payment_list as $list) {

            $bunitname_data = $this->supervisor_model->get_bunitname_model($list['bunit_code']);

            $bunit_name = '';
            foreach ($bunitname_data as $bname) {
                $bunit_name = $bname['business_unit'];
            }


            $deptname_data = $this->supervisor_model->get_deptname_model($list['dept_code']);

            $dept_name = '';
            foreach ($deptname_data as $dname) {
                $dept_name = $dname['dept_name'];
            }

            $html .= ' 
                    <tr>
                      <td style="vertical-align: middle;">' . $list['mop'] . '</td>
                      <td style="vertical-align: middle;">' . $list['type'] . '</td>
                      <td style="vertical-align: middle;">' . $bunit_name . '<br>' . $dept_name . '</td>
                      <td style="vertical-align: middle; font-size: large;">
                        <a id="" onclick="delete_mop_js(' . $list['id'] . ',' . "'" . $list['type'] . "'" . ',' . "'" . $list['mop'] . "'" . ',' . "'" . $list['dept_code'] . "'" . ',' . "'" . $bunit_name . "'" . ',' . "'" . $dept_name . "'" . ')">❌</a>
                      </td>
                    </tr>
                  ';
        }

        $html .= '
                        </tbody>
                    </form>
                </table>

                ';


        $data['html'] = $html;
        echo json_encode($data);
    }

    public function delete_mop_ctrl()
    {
        if (empty($_SESSION['emp_id'])) {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        } else {
            $this->supervisor_model->delete_mop_cashier_access($_POST['type'], $_POST['mop'], $_POST['dcode']);

            $message = 'success';
            $this->supervisor_model->delete_mop_model($_POST['id']);

            echo json_encode($message);
        }
    }

    public function display_sup_mop_ctrl()
    {
        $html = '';
        $th_checkbox = '';
        if ($_POST['bcode'] == '0203') {
            $icm_tenderTypeName = $this->supervisor_model->get_icm_tender_name_model();
            foreach ($icm_tenderTypeName as $type) {
                $validate = $this->supervisor_model->validate_payment_model($type['name'], $_POST['dcode']);
                $disabled = '';
                $uncheck = 'enable';
                if (!empty($validate)) {
                    $disabled = 'disabled';
                    $uncheck = 'unchecked';
                }

                if ($disabled == '') {
                    $th_checkbox = 'ENABLED';
                }

                $html .= '
                        <tr>
                            <td style="vertical-align: middle"><center>' . $type['name'] . '</center></td>
                            <td style="vertical-align: middle">
                                <center>
                                    <input ' . $disabled . ' class="td_checkbox ' . $uncheck . '" style="width: 25px; height: 25px;" type="checkbox" value="' . $type['name'] . '">
                                </center>
                            </td>
                        </tr>
                        ';
            }
        } else if ($_POST['bcode'] == '0201') {
            $asc_tenderTypeName = $this->supervisor_model->get_asc_tender_name_model();
            foreach ($asc_tenderTypeName as $type) {
                $validate = $this->supervisor_model->validate_payment_model($type['name'], $_POST['dcode']);
                $disabled = '';
                $uncheck = 'enable';
                if (!empty($validate)) {
                    $disabled = 'disabled';
                    $uncheck = 'unchecked';
                }

                if ($disabled == '') {
                    $th_checkbox = 'ENABLED';
                }

                $html .= '
                        <tr>
                            <td style="vertical-align: middle"><center>' . $type['name'] . '</center></td>
                            <td style="vertical-align: middle">
                                <center>
                                    <input ' . $disabled . ' class="td_checkbox ' . $uncheck . '" style="width: 25px; height: 25px;" type="checkbox" value="' . $type['name'] . '">
                                </center>
                            </td>
                        </tr>
                        ';
            }
        } else if ($_POST['bcode'] == '0301') {
            $pm_tenderTypeName = $this->supervisor_model->get_pm_tender_name_model();
            foreach ($pm_tenderTypeName as $type) {
                $validate = $this->supervisor_model->validate_payment_model($type['name'], $_POST['dcode']);
                $disabled = '';
                $uncheck = 'enable';
                if (!empty($validate)) {
                    $disabled = 'disabled';
                    $uncheck = 'unchecked';
                }

                if ($disabled == '') {
                    $th_checkbox = 'ENABLED';
                }

                $html .= '
                        <tr>
                            <td style="vertical-align: middle"><center>' . $type['name'] . '</center></td>
                            <td style="vertical-align: middle">
                                <center>
                                    <input ' . $disabled . ' class="td_checkbox ' . $uncheck . '" style="width: 25px; height: 25px;" type="checkbox" value="' . $type['name'] . '">
                                </center>
                            </td>
                        </tr>
                        ';
            }
        } else if ($_POST['bcode'] == '0223') {
            $alta_tenderTypeName = $this->supervisor_model->get_alta_tender_name_model();
            foreach ($alta_tenderTypeName as $type) {
                $validate = $this->supervisor_model->validate_payment_model($type['name'], $_POST['dcode']);
                $disabled = '';
                $uncheck = 'enable';
                if (!empty($validate)) {
                    $disabled = 'disabled';
                    $uncheck = 'unchecked';
                }

                if ($disabled == '') {
                    $th_checkbox = 'ENABLED';
                }

                $html .= '
                        <tr>
                            <td style="vertical-align: middle"><center>' . $type['name'] . '</center></td>
                            <td style="vertical-align: middle">
                                <center>
                                    <input ' . $disabled . ' class="td_checkbox ' . $uncheck . '" style="width: 25px; height: 25px;" type="checkbox" value="' . $type['name'] . '">
                                </center>
                            </td>
                        </tr>
                        ';
            }
        } else {
            $icm_tenderTypeName = $this->supervisor_model->get_icm_tender_name_model();
            foreach ($icm_tenderTypeName as $type) {
                $validate = $this->supervisor_model->validate_payment_model($type['name'], $_POST['dcode']);
                $disabled = '';
                $uncheck = 'enable';
                if (!empty($validate)) {
                    $disabled = 'disabled';
                    $uncheck = 'unchecked';
                }

                if ($disabled == '') {
                    $th_checkbox = 'ENABLED';
                }

                $html .= '
                        <tr>
                            <td style="vertical-align: middle"><center>' . $type['name'] . '</center></td>
                            <td style="vertical-align: middle">
                                <center>
                                    <input ' . $disabled . ' class="td_checkbox ' . $uncheck . '" style="width: 25px; height: 25px;" type="checkbox" value="' . $type['name'] . '">
                                </center>
                            </td>
                        </tr>
                        ';
            }
        }

        $html .= '
                <script>

                    $(".td_checkbox").click(function(){
                        $("#th_checkbox").prop( "checked", false );
                    });

                    $(".td_checkbox").change(function(){
                        if ($(".td_checkbox:checked").length == $(".td_checkbox").length) {
                            $("#th_checkbox").prop( "checked", true );
                        }
                    });

                    $(".enable").change(function(){
                        if ($(".enable:checked").length == $(".enable").length) {
                            $("#th_checkbox").prop( "checked", true );
                        }
                    });

                    $("#th_checkbox").click(function(){
                        th_checked_js();
                    });
                    
                </script>
                ';

        $data['th_checkbox'] = $th_checkbox;
        $data['html'] = $html;
        echo json_encode($data);
    }

    public function display_sup_mop_ctrl_v2()
    {
        $tender_type_data = $this->supervisor_model->get_tender_type_model($_POST['dcode']);
        $html = '';
        $th_checkbox = '';
        foreach ($tender_type_data as $type) {
            $validate = $this->supervisor_model->validate_payment_model($type['mop_name'], $_POST['dcode']);
            $disabled = '';
            $uncheck = 'enable';
            if (!empty($validate)) {
                $disabled = 'disabled';
                $uncheck = 'unchecked';
            }
            // =============================================================================================================================
            if ($disabled == '') {
                $th_checkbox = 'ENABLED';
            }
            // =============================================================================================================================
            $html .= '
                    <tr>
                        <td style="vertical-align: middle"><center>' . $type['mop_name'] . '</center></td>
                        <td style="vertical-align: middle">
                            <center>
                                <input ' . $disabled . ' class="td_checkbox ' . $uncheck . '" style="width: 25px; height: 25px;" type="checkbox" value="' . $type['mop_name'] . '">
                            </center>
                        </td>
                    </tr>
                    ';
        }
        // =============================================================================================================================
        $html .= '
                <script>

                    $(".td_checkbox").click(function(){
                        $("#th_checkbox").prop( "checked", false );
                    });

                    $(".td_checkbox").change(function(){
                        if ($(".td_checkbox:checked").length == $(".td_checkbox").length) {
                            $("#th_checkbox").prop( "checked", true );
                        }
                    });

                    $(".enable").change(function(){
                        if ($(".enable:checked").length == $(".enable").length) {
                            $("#th_checkbox").prop( "checked", true );
                        }
                    });

                    $("#th_checkbox").click(function(){
                        th_checked_js();
                    });
                    
                </script>
                ';
        // ====================================================================================================================
        $data['th_checkbox'] = $th_checkbox;
        $data['html'] = $html;
        echo json_encode($data);
    }

    public function view_cashier_denomination_ctrl()
    {
        $lo_id = $_SESSION['emp_id'];
        $transferred_data = $this->supervisor_model->view_cashier_denomination_model($lo_id, $_POST['date']);
        $html = '
                <form>
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

        foreach ($transferred_data as $trans) {
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
            if (!empty($dept_data)) {
                $dname = $dept_data->dept_name;
                $br1 = '<br>';
            }
            // ==================================================================================================================================
            $section_data = $this->liquidation_model->get_section_v2($trans['scode']);
            if (!empty($section_data)) {
                $sname = $section_data->section_name;
                $br2 = '<br>';
            }
            // ===================================================================================================================================
            $sub_section_data = $this->liquidation_model->get_subsection_v2($trans['sscode']);
            if (!empty($sub_section_data)) {
                $ssname = $sub_section_data->sub_section_name;
                $br3 = '<br>';
            }
            // ==================================================================================================================================
            $cash_data = $this->liquidation_model->get_cash_denomination_model($trans['trno'], $trans['cashier_id'], $trans['sscode'], $_POST['date']);
            $noncash_data = $this->liquidation_model->get_noncash_denomination_model($trans['trno'], $trans['cashier_id'], $trans['sscode'], $_POST['date']);
            $pos_name = '';
            $counter_no = '';
            $borrowed = '';
            if (!empty($cash_data)) {
                foreach ($cash_data as $cash) {
                    $pos_name = $cash['pos_name'];
                    $counter_no = $cash['counter_no'];
                    $borrowed = $cash['borrowed'];
                }
            } else {
                if (!empty($noncash_data)) {
                    foreach ($noncash_data as $noncash) {
                        $pos_name = $noncash['pos_name'];
                        $counter_no = $noncash['counter_no'];
                        $borrowed = $noncash['borrowed'];
                    }
                }
            }
            // ==================================================================================================================================
            $html .= ' 
                    <tr style="word-wrap:break-word;">
                        <td style="vertical-align: middle;">' . $trans['cname'] . '</td>
                        <td style="vertical-align: middle;">' . $bunit_data->business_unit . $br1 . $dname . $br2 . $sname . $br3 . $ssname . '</td>
                        <td style="vertical-align: middle;">' . $pos_name . '<br>' . $counter_no . '</td>
                        <td style="vertical-align: middle;">' . $trans['dsales'] . '</td>
                        <td style="vertical-align: middle;">' . $trans['sop_type'] . '</td>
                        <td style="vertical-align: middle;">' . number_format($trans['sop'], 2) . '</td>
                        <td style="vertical-align: middle;">' . number_format($trans['gtotal'], 2) . '</td>
                        <td style="vertical-align: middle;">' . number_format($trans['rsales'], 2) . '</td>
                        <td style="vertical-align: middle;">' . $borrowed . '</td>
                        <td style="vertical-align: middle;">
                        <a id="cancel_btn" onclick="cancel_denomination_js(' . "'" . $trans['trno'] . "','" . $trans['cashier_id'] . "','" . $trans['sscode'] . "','" . $pos_name . "','" . $_POST['date'] . "'" . ')"><i style="font-style: normal; font-size: large;">❌</i></a>
                        </td>
                    </tr>
                    ';
        }

        $html .= '                      
                        </table>
                    </form> 
                    ';

        $data['html'] = $html;
        echo json_encode($data);
    }

    public function view_pending_denomination_ctrl()
    {
        $lo_id = $_SESSION['emp_id'];
        $pending_cash_data = $this->supervisor_model->get_pending_cash_denomination_model($lo_id, $_POST['date']);
        $html = '
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

        foreach ($pending_cash_data as $cash) {
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
            if (!empty($dept_data)) {
                $dname = $dept_data->dept_name;
                $br1 = '<br>';
            }
            // ==================================================================================================================================
            $section_data = $this->liquidation_model->get_section_v2($cash['scode']);
            if (!empty($section_data)) {
                $sname = $section_data->section_name;
                $br2 = '<br>';
            }
            // ===================================================================================================================================
            $sub_section_data = $this->liquidation_model->get_subsection_v2($cash['sscode']);
            if (!empty($sub_section_data)) {
                $ssname = $sub_section_data->sub_section_name;
                $br3 = '<br>';
            }
            // ==================================================================================================================================
            $html .= ' 
                    <tr style="word-wrap:break-word;">
                        <td style="vertical-align: middle;">' . $cash['cname'] . '</td>
                        <td style="vertical-align: middle;">' . $bunit_data->business_unit . $br1 . $dname . $br2 . $sname . $br3 . $ssname . '</td>
                        <td style="vertical-align: middle;">' . $cash['pos_name'] . '<br>' . $cash['counter_no'] . '</td>
                        <td style="vertical-align: middle;">' . $cash['sales_date'] . '</td>
                        <td style="vertical-align: middle;">' . $cash['remit_type'] . '</td>
                        <td style="vertical-align: middle;">' . number_format($cash['total_cash'], 2) . '</td>
                        <td style="vertical-align: middle;">' . $cash['borrowed'] . '</td>
                        <td style="vertical-align: middle;">
                            <a id="cancel_btn" onclick="cancel_pending_denomination_js(' . "'" . $cash['id'] . "'" . ')"><i style="font-style: normal; font-size: large;">❌</i></a>
                        </td>
                    </tr>
                    ';
        }

        $html .= '                      
                        </table>
                    </form> 
                    ';

        $data['html'] = $html;
        echo json_encode($data);
    }

    public function view_cashier_deleted_denomination_ctrl()
    {
        $lo_id = $_SESSION['emp_id'];
        $transferred_data = $this->supervisor_model->view_cashier_deleted_denomination_model($lo_id);
        $html = '
                <form>
                    <table class="table table-bordered table-hover table-condensed display" id="deleted_denomination_table">
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
                                    <center>OFFICER DELETED</center>
                                </th>  
                                <th style="vertical-align: middle;">
                                    <center>DATE/TIME DELETED</center>
                                </th>                            
                            </tr>
                        </thead>
                ';

        foreach ($transferred_data as $trans) {
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
            if (!empty($dept_data)) {
                $dname = $dept_data->dept_name;
                $br1 = '<br>';
            }
            // ==================================================================================================================================
            $section_data = $this->liquidation_model->get_section_v2($trans['scode']);
            if (!empty($section_data)) {
                $sname = $section_data->section_name;
                $br2 = '<br>';
            }
            // ===================================================================================================================================
            $sub_section_data = $this->liquidation_model->get_subsection_v2($trans['sscode']);
            if (!empty($sub_section_data)) {
                $ssname = $sub_section_data->sub_section_name;
                $br3 = '<br>';
            }
            // ==================================================================================================================================
            $cash_data = $this->supervisor_model->get_cash_denomination_model($trans['trno'], $trans['cashier_id'], $trans['sscode'], $trans['dsales']);
            $noncash_data = $this->supervisor_model->get_noncash_denomination_model($trans['trno'], $trans['cashier_id'], $trans['sscode'], $trans['dsales']);
            $pos_name = '';
            $counter_no = '';
            $borrowed = '';
            if (!empty($cash_data)) {
                foreach ($cash_data as $cash) {
                    $pos_name = $cash['pos_name'];
                    $counter_no = $cash['counter_no'];
                    $borrowed = $cash['borrowed'];
                }
            } else {
                if (!empty($noncash_data)) {
                    foreach ($noncash_data as $noncash) {
                        $pos_name = $noncash['pos_name'];
                        $counter_no = $noncash['counter_no'];
                        $borrowed = $noncash['borrowed'];
                    }
                }
            }
            // ==================================================================================================================================
            $emp_data = $this->supervisor_model->get_emp_data($trans['officer_deleted']);
            $officer_deleted = '';
            if (!empty($emp_data)) {
                $officer_deleted = $emp_data->name;
            }
            // ==================================================================================================================================
            $html .= ' 
                    <tr style="word-wrap:break-word;">
                        <td style="vertical-align: middle;">' . $trans['cname'] . '</td>
                        <td style="vertical-align: middle;">' . $bunit_data->business_unit . $br1 . $dname . $br2 . $sname . $br3 . $ssname . '</td>
                        <td style="vertical-align: middle;">' . $pos_name . '<br>' . $counter_no . '</td>
                        <td style="vertical-align: middle;">' . $trans['dsales'] . '</td>
                        <td style="vertical-align: middle;">' . $trans['sop_type'] . '</td>
                        <td style="vertical-align: middle;">' . number_format($trans['sop'], 2) . '</td>
                        <td style="vertical-align: middle;">' . number_format($trans['gtotal'], 2) . '</td>
                        <td style="vertical-align: middle;">' . number_format($trans['rsales'], 2) . '</td>
                        <td style="vertical-align: middle;">' . $borrowed . '</td>
                        <td style="vertical-align: middle;">' . $officer_deleted . '</td>
                        <td style="vertical-align: middle;">' . $trans['date_time_deleted'] . '</td>
                    </tr>
                    ';
        }

        $html .= '                      
                        </table>
                    </form> 
                    ';

        $data['html'] = $html;
        echo json_encode($data);
    }

    public function cancel_denomination_ctrl()
    {
        if (empty($_SESSION['emp_id'])) {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        } else {
            $deleted_data = $this->liquidation_model->get_deleted_denomination_model($_POST['emp_id']);
            if (empty($deleted_data)) {
                $data['message'] = 'success';
                $this->supervisor_model->cancel_denomination_model($_POST['tr_no'], $_POST['emp_id'], $_POST['sscode'], $_POST['pos_name'], $_POST['date']);
                $this->supervisor_model->save_cancelled_denomination_model($_POST['tr_no'], $_POST['emp_id'], $_POST['sscode'], $_POST['pos_name'], $_POST['date']);

                echo json_encode($data);
            } else {
                $sales_date = '';
                foreach ($deleted_data as $deleted) {
                    $sales_date = $deleted['sales_date'];
                }

                $data['message'] = 'ALREADY EXIST';
                $data['sales_date'] = $sales_date;
                echo json_encode($data);
            }
        }
    }

    public function cancel_pending_denomination_ctrl()
    {
        if (empty($_SESSION['emp_id'])) {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        } else {
            $message = 'success';
            $this->supervisor_model->cancel_pending_denomination_model($_POST['id']);

            echo json_encode($message);
        }
    }

    public function get_cutoff_date_ctrl()
    {
        $emp_id = $_SESSION['emp_id'];
        $cutoff_date_data = $this->supervisor_model->get_cutoff_date_model($emp_id);
        $cutoff_date_html = '';

        foreach ($cutoff_date_data as $cutoff) {
            $value = str_replace("/", "to", $cutoff['cutoff_date']);
            $cutoff_date_html .= '<option value="' . $value . '">' . $value . '</option>';
        }

        $data['cutoff_date_html'] = $cutoff_date_html;
        echo json_encode($data);
    }



    public function get_violation_data()
    {

        $user_id = $_SESSION['emp_id'];

        $offense_rec = $this->supervisor_model->get_negli_data($_POST['cs_data_id']);

        $requestBy = $user_id == '03998-2019' ? $this->supervisor_model->hrms_info($offense_rec->sup_id) : $this->supervisor_model->hrms_info($user_id);
        $offense_id = '';
        $vms_check = '';

        if (!empty($offense_rec)) {

            $offense_id = $offense_rec->id;
            $vms_data = $this->supervisor_model->get_vms_shortover_data($offense_id, $offense_rec->empId);
            $vms_check = !empty($vms_data) ? 1 : '';

        }

        // echo json_encode($offense_id);
        $result = array(
            'offense_id' => $offense_id,
            'cs_data_id' => $_POST['cs_data_id'],
            'vms_check' => $vms_check,
            'requestBy' => $requestBy->name,
            'req_emp_id' => $requestBy->emp_id,
        );

        echo json_encode($result);
        exit();
    }

    public function submit_cancel_violation()
    {

        $requestBy      = $_POST['requested_by'];
        $cs_data_id     = $_POST['cs_data_id'];
        $offense_id     = $_POST['offense_id'];
        $cancel_reason  = $_POST['cancel_reason'];
        $emp_id         = $_POST['cashier_id'];
        $mode           = $_POST['request_type'];

        $data_received = array(
            'emp_id'        => $emp_id,
            'cs_data_id'    => $cs_data_id,
            'offense_id'    => $offense_id,
            'cancel_reason' => $cancel_reason,
            'cancel_mode'   => $mode,
            'requestBy'     => $requestBy
        );


        if ($mode != '') {

            $check_dups_request = $this->supervisor_model->get_vms_offense_cancel($offense_id, $emp_id);

            if (empty($check_dups_request)) {

                $vms_data = $this->supervisor_model->get_vms_shortover_data($offense_id, $emp_id);

                if (!empty($vms_data)) {
                    $this->cs_cancel_violation($data_received, 'request');
                    $data_received['dateRange'] = $vms_data->dateRange;
                    $this->vms_send_cancel_request($data_received);
                } else {
                    echo json_encode(array('data_received' => $data_received, 'mode' => 'error', 'msg' => 'VSM data not found', 'icon' => '', 'delay' => 4000));
                }
            } else {
                echo json_encode(array('data_received' => $data_received, 'mode' => 'error', 'msg' => 'Duplicate Request', 'icon' => '', 'delay' => 4000));
            }
        } else {
            $this->cs_cancel_violation($data_received);
        }

        exit();
    }
    public function cs_cancel_violation($data, $mode = '')
    {

        $update_cs_data = array(
            'vms_cancel' => 'cancelled',
            'vms_cancel_officer' => $data['requestBy'],
            'vms_cancel_date' => date('Y-m-d H:i:s'),
        );
        $update_negli_data = array('cancelStat' => 1);

        var_dump($update_cs_data, $update_negli_data);
        // $this->supervisor_model->update_record($update_cs_data, $data['cs_data_id']);
        // $this->supervisor_model->update_negli($update_negli_data, $data['offense_id']);

        if ($mode == '') {
            echo json_encode(array('data_received' => $data, 'mode' => 'success', 'msg' => 'Violation Cancelled', 'icon' => 'fa fa-check', 'delay' => 2000));
            exit();
        }
    }
    public function vms_send_cancel_request($data)
    {

        $update_shortover = array('cancelStat' => 1);
        $cancel_request = array(
            'violationId' => 29,
            'empId' => $data['emp_id'],
            'offenseId' => $data['offense_id'],
            'dateRange' => $data['dateRange'],
            'requestBy' => $data['requestBy'],
            'requestOn' => date('Y-m-d H:i:s'),
            'details' => $data['cancel_reason'],
            'status' => 1
        );

        var_dump($cancel_request, $update_shortover);
        // $this->supervisor_model->insert_cancel_request($cancel_request);
        // $this->supervisor_model->update_shortover($update_shortover, $data['offense_id'], $data['emp_id']);

        echo json_encode(array('data_received' => $cancel_request, 'mode' => 'success', 'msg' => 'Cancel Request Sent', 'icon' => 'fa fa-paper-plane', 'delay' => 2000));
        exit();
    }

}
