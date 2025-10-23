<?php

class Cashier_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('pis', TRUE);
    $this->load->database();
  }

  public function save_cashdenomination_model(
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
    $borrowed,
    $onek,
    $fiveh,
    $twoh,
    $oneh,
    $fifty,
    $twenty,
    $ten,
    $five,
    $one,
    $twentyfivecents,
    $tencents,
    $fivecents,
    $onecents,
    $total_cash,
    $remit_type,
    $status,
    $date,
    $pos_name,
    $counter_no
  ) {

    $data = array(
      'tr_no'                      => $this->security->xss_clean(trim($tr_no)),
      'emp_id'                      => $this->security->xss_clean(trim($emp_id)),
      'sal_no'                      => $this->security->xss_clean(trim($sal_no)),
      'emp_name'                    => $this->security->xss_clean(trim($emp_name)),
      'emp_type'                    => $this->security->xss_clean(trim($emp_type)),
      'company_code'                => $this->security->xss_clean(trim($company_code)),
      'bunit_code'                  => $this->security->xss_clean(trim($bunit_code)),
      'dep_code'                    => $this->security->xss_clean(trim($dep_code)),
      'section_code'                => $this->security->xss_clean(trim($section_code)),
      'sub_section_code'            => $this->security->xss_clean(trim($sub_section_code)),
      'borrowed'                    => $this->security->xss_clean(trim($borrowed)),
      'onek'                        => $this->security->xss_clean(trim($onek)),
      'fiveh'                       => $this->security->xss_clean(trim($fiveh)),
      'twoh'                        => $this->security->xss_clean(trim($twoh)),
      'oneh'                        => $this->security->xss_clean(trim($oneh)),
      'fifty'                       => $this->security->xss_clean(trim($fifty)),
      'twenty'                      => $this->security->xss_clean(trim($twenty)),
      'ten'                         => $this->security->xss_clean(trim($ten)),
      'five'                        => $this->security->xss_clean(trim($five)),
      'one'                         => $this->security->xss_clean(trim($one)),
      'twentyfive_cents'            => $this->security->xss_clean(trim($twentyfivecents)),
      'ten_cents'                   => $this->security->xss_clean(trim($tencents)),
      'five_cents'                  => $this->security->xss_clean(trim($fivecents)),
      'one_cents'                   => $this->security->xss_clean(trim($onecents)),
      'total_cash'                  => $this->security->xss_clean(trim($total_cash)),
      'remit_type'                  => $this->security->xss_clean(trim($remit_type)),
      'status'                      => $this->security->xss_clean(trim($status)),
      'pos_name'                    => $this->security->xss_clean(trim($pos_name)),
      'counter_no'                  => $this->security->xss_clean(trim($counter_no))
    );

    $this->db->set('date_submit', 'NOW()', FALSE);
    $this->db->insert('cs_cashier_cashdenomination', $data);
  }

  public function validate_trno_model($tr_no,$emp_id)
  {
    $this->db->where('tr_no',$tr_no);
    $this->db->where('emp_id <>',$emp_id);
    $this->db->limit(1);
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function validate_pending_cash_model($emp_id)
  {
    $this->db->where('emp_id',$emp_id);
    $this->db->where_in('status', array('PENDING','CHECKED'));
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->limit(1);
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function display_mop_model()
  {

     $query=$this->db->query("select * from cs_cashier_othermop order by id ASC");
   
    return $query->result_array();

  }

  public function display_mop_model_v2($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('mop_type', 'NONCASH');
    $this->db->order_by('mop_name', 'ASC');
    $query = $this->db->get('cs_cashier_mop_access');
    return $query->result_array();
  }

  public function search_mopaccess_model($emp_id)
  {
    $query=$this->db->query("select * from cs_cfscashier_mopaccess where emp_id = '".$emp_id."' ");
    return $query->result_array();
  }

  public function displayhistory_cashform_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where_in('status', array('PENDING','CHECKED'));
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }
  
  public function displayhistory_cashform_model_v2($emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('pos_name', $pos_name);
    $this->db->where_in('status', array('PENDING','CHECKED'));
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function getpartialhistory_cashform_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('remit_type', 'PARTIAL');
    $this->db->where('status', 'CONFIRMED');
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function getpartialhistory_cashform_model_v2($emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('remit_type', 'PARTIAL');
    $this->db->where('status', 'CONFIRMED');
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function update_historycashform_model($emp_id,$id,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p)
  {
    $this->db->query(" 

          UPDATE cs_cashier_cashdenomination
          
          SET onek = '".$a."',
              fiveh = '".$b."',
              twoh = '".$c."',
              oneh = '".$d."',
              fifty = '".$e."',
              twenty = '".$f."',
              ten = '".$g."',
              five = '".$h."',
              one = '".$i."',
              twentyfive_cents = '".$j."',
              ten_cents = '".$k."',
              five_cents = '".$l."',
              one_cents = '".$m."',
              total_cash = '".$n."',
              edit_pos = 'DISABLED',
              edit_status_denomination = 'DISABLED',
              pos_name = '".$o."',
              counter_no = '".$p."'

          WHERE id = '".$id."' and emp_id = '".$emp_id."'
          
        ");   
  }

  public function update_historycashform_model_v2($emp_id,$id,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n)
  {
    $this->db->query(" 

          UPDATE cs_cashier_cashdenomination
          
          SET onek = '".$a."',
              fiveh = '".$b."',
              twoh = '".$c."',
              oneh = '".$d."',
              fifty = '".$e."',
              twenty = '".$f."',
              ten = '".$g."',
              five = '".$h."',
              one = '".$i."',
              twentyfive_cents = '".$j."',
              ten_cents = '".$k."',
              five_cents = '".$l."',
              one_cents = '".$m."',
              total_cash = '".$n."',
              edit_status_denomination = 'DISABLED'

          WHERE id = '".$id."' and emp_id = '".$emp_id."'
        ");   
  }

  public function update_historycashform2_model($emp_id,$id,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$section_code,$sub_section_code,$borrowed,$pos_name,$counter_no)
  {
    $this->db->query(" 

          UPDATE cs_cashier_cashdenomination
          
          SET onek = '".$a."',
              fiveh = '".$b."',
              twoh = '".$c."',
              oneh = '".$d."',
              fifty = '".$e."',
              twenty = '".$f."',
              ten = '".$g."',
              five = '".$h."',
              one = '".$i."',
              twentyfive_cents = '".$j."',
              ten_cents = '".$k."',
              five_cents = '".$l."',
              one_cents = '".$m."',
              total_cash = '".$n."',
              section_code = '".$section_code."',
              sub_section_code = '".$sub_section_code."',
              borrowed = '".$borrowed."',
              edit_borrowed = 'DISABLED',
              edit_pos = 'DISABLED',
              pos_name = '".$pos_name."',
              counter_no = '".$counter_no."'

          WHERE id = '".$id."' and emp_id = '".$emp_id."'
          
        ");   
  }

  public function disabled_saveresetbtn_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('forex_currency', '');
    $this->db->where('cfs_cashtype', '');
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where_in('status', array('PENDING','CHECKED'));
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function insert_non_cash_model(
    $tr_no,
    $b_id,
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
    $amount_Arr)
  {
    
    $noncash_amount = str_replace(",","",$amount_Arr[2]);
   
    $data = array(
      'tr_no'                       => $this->security->xss_clean(trim($tr_no)),
      'batch_id'                    => $this->security->xss_clean(trim($b_id)),
      'emp_id'                      => $this->security->xss_clean(trim($emp_id)),
      'sal_no'                      => $this->security->xss_clean(trim($sal_no)),
      'emp_name'                    => $this->security->xss_clean(trim($emp_name)),
      'emp_type'                    => $this->security->xss_clean(trim($emp_type)),
      'company_code'                => $this->security->xss_clean(trim($company_code)),
      'bunit_code'                  => $this->security->xss_clean(trim($bunit_code)),
      'dep_code'                    => $this->security->xss_clean(trim($dep_code)),
      'section_code'                => $this->security->xss_clean(trim($section_code)),
      'sub_section_code'            => $this->security->xss_clean(trim($sub_section_code)),
      'borrowed'                    => $this->security->xss_clean(trim($borrowed)),
      'mop_name'                    => $this->security->xss_clean(trim($amount_Arr[0])),
      'noncash_qty'                 => $this->security->xss_clean(trim($amount_Arr[1])),
      'noncash_amount'              => $this->security->xss_clean(trim($noncash_amount)),
      'remit_type'                  => $this->security->xss_clean(trim('FINAL')),
      'status'                      => $this->security->xss_clean(trim('PENDING'))
      
    );

    $this->db->set('date_submit', 'NOW()', FALSE);
    $this->db->insert('cs_cashier_noncashdenomination', $data);
  }

  public function insert_non_cash_model_v2(
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
    $borrowed,
    $pos_name,
    $counter_no,
    $mop_name,
    $nc_quantity,
    $nc_amount)
  {
    $data = array(
      'tr_no'                       => $this->security->xss_clean(trim($tr_no)),
      'emp_id'                      => $this->security->xss_clean(trim($emp_id)),
      'sal_no'                      => $this->security->xss_clean(trim($sal_no)),
      'emp_name'                    => $this->security->xss_clean(trim($emp_name)),
      'emp_type'                    => $this->security->xss_clean(trim($emp_type)),
      'company_code'                => $this->security->xss_clean(trim($company_code)),
      'bunit_code'                  => $this->security->xss_clean(trim($bunit_code)),
      'dep_code'                    => $this->security->xss_clean(trim($dep_code)),
      'section_code'                => $this->security->xss_clean(trim($section_code)),
      'sub_section_code'            => $this->security->xss_clean(trim($sub_section_code)),
      'borrowed'                    => $this->security->xss_clean(trim($borrowed)),
      'pos_name'                    => $this->security->xss_clean(trim($pos_name)),
      'counter_no'                  => $this->security->xss_clean(trim($counter_no)),
      'mop_name'                    => $this->security->xss_clean(trim($mop_name)),
      'noncash_qty'                 => $this->security->xss_clean(trim($nc_quantity)),
      'noncash_amount'              => $this->security->xss_clean(trim($nc_amount)),
      'remit_type'                  => $this->security->xss_clean(trim('FINAL')),
      'status'                      => $this->security->xss_clean(trim('SAMPLE'))
    );

    $this->db->set('date_submit', 'NOW()', FALSE);
    $this->db->insert('cs_cashier_noncashdenomination', $data);
  }

  public function get_batchid($emp_id)
  {
     $query = $this->db->query(" 
                                SELECT 
                                      * 
                                  FROM 
                                      cs_cashier_noncashdenomination    
                                  WHERE 
                                      emp_id='".$emp_id."'
                                      order by id desc limit 1 
                              ");
     return $query->result_array();
  }

  public function get_empdata($emp_id)
  {
    $query=$this->db2->query("
                            SELECT 
                                    * 
                              FROM 
                                   employee3
                              WHERE emp_id = '".$emp_id."'
                            ");
     return $query->result_array();
  }

  public function disabled_noncashform_model($emp_id)
  {

    $query=$this->db->query("select * from cs_cashier_noncashdenomination where emp_id='".$emp_id."' and cfs_noncashtype = '' and cfs_bankname = '' and cfs_cheqno = '' and status = 'PENDING'");

    return $query->result_array();

  }

  public function displayhistory_noncashform_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('cfs_noncashtype', '');
    $this->db->where('cfs_bankname', '');
    $this->db->where('cfs_cheqno', '');
    $this->db->where_in('status', array('PENDING','CHECKED'));
    $this->db->order_by('mop_name', 'asc');
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function displayhistory_noncashform_model_v2($emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->select('id, edit_borrowed, edit_pos, edit_denomination, add_mop, remit_type, pos_name, counter_no, mop_name, noncash_qty, noncash_amount');
    $this->db->from('cs_cashier_noncashdenomination'); 
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('cfs_noncashtype', '');
    $this->db->where('cfs_bankname', '');
    $this->db->where('cfs_cheqno', '');
    $this->db->where_in('status', array('PENDING','CHECKED'));
    $this->db->where('delete_status <>', 'DELETED'); 
    $this->db->order_by('mop_name', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function update_historynoncashform_model($emp_id,$bid,$mop_arr)
  {
      $hncash_amount = str_replace(",","",$mop_arr[2]);
      $this->db->query(" 

            UPDATE cs_cashier_noncashdenomination
            
            SET noncash_qty = '".$mop_arr[1]."',
                noncash_amount = '".$hncash_amount."'

            WHERE batch_id = '".$bid."' and emp_id = '".$emp_id."' and mop_name = '".$mop_arr[0]."'
            
                                 ");   
  }

  public function update_historynoncashform_model2($emp_id,$bid,$mop_arr,$section_code,$sub_section_code,$borrowed)
  {
    $hncash_amount = str_replace(",","",$mop_arr[2]);
    $data = array(
      'section_code'                => $this->security->xss_clean(trim($section_code)),
      'sub_section_code'            => $this->security->xss_clean(trim($sub_section_code)),
      'borrowed'                    => $this->security->xss_clean(trim($borrowed)),
      'edit_borrowed'               => $this->security->xss_clean(trim('DISABLED')),
      'noncash_qty'                 => $this->security->xss_clean(trim($mop_arr[1])),
      'noncash_amount'              => $this->security->xss_clean(trim($hncash_amount))
      );

    $this->db->where('batch_id', $bid);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('mop_name', $mop_arr[0]);
    $this->db->update('cs_cashier_noncashdenomination', $data);
  }

  public function get_username_model($emp_id)
  {
    $this->db2->select('username'); 
    $this->db2->from('users');
    $this->db2->where('emp_id', $emp_id);
    $query = $this->db2->get();
    return $query->result_array();
  }

  public function get_section_model($company_code,$bunit_code,$dept_code)
  {
    $this->db2->select('*'); 
    $this->db2->from('locate_section');
    $this->db2->where('company_code', $company_code);
    $this->db2->where('bunit_code', $bunit_code);
    $this->db2->where('dept_code', $dept_code);
    
    $query = $this->db2->get();
    return $query->result_array();
  }

  public function get_sub_section_model($company_code,$bunit_code,$dept_code,$section_code)
  {
    $this->db2->select('*'); 
    $this->db2->from('locate_sub_section');
    $this->db2->where('company_code', $company_code);
    $this->db2->where('bunit_code', $bunit_code);
    $this->db2->where('dept_code', $dept_code);
    $this->db2->where('section_code', $section_code);
    
    $query = $this->db2->get();
    return $query->result_array();
  }

  public function validate_cash_borrowed_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('borrowed', 'YES');
    $this->db->where('forex_currency', '');
    $this->db->where('cfs_cashtype', '');
    $this->db->where('status', 'PENDING');
    $this->db->limit(1);

    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function validate_cash_borrowed_model_v2($emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', 'YES');
    $this->db->where('forex_currency', '');
    $this->db->where('cfs_cashtype', '');
    $this->db->where_in('status', array('PENDING','CHECKED'));
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->limit(1);

    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function validate_noncash_borrowed_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('borrowed', 'YES');
    $this->db->where('cfs_noncashtype', '');
    $this->db->where('cfs_bankname', '');
    $this->db->where('cfs_cheqno', '');
    $this->db->where('status', 'PENDING');
    $this->db->limit(1);
    
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function validate_noncash_editden_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('edit_denomination', 'ENABLED');
    $this->db->where('cfs_noncashtype', '');
    $this->db->where('cfs_bankname', '');
    $this->db->where('cfs_cheqno', '');
    $this->db->where('status', 'PENDING');
    $this->db->limit(1);
    
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function get_section_name($scode)
  {
    $this->db2->where('scode', $scode);
    $query = $this->db2->get('locate_section');
    return $query->row();
  }

  public function get_sub_section_name($sscode)
  {
    $this->db2->where('sscode', $sscode);
    $query = $this->db2->get('locate_sub_section');
    return $query->row();
  }

  public function validate_cash_access_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('mop_name', 'CASH');
    $this->db->where('mop_type', 'CASH');
    $query = $this->db->get('cs_cashier_mop_access');
    return $query->result_array();
  }

  public function validate_edit_cash_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('status', 'PENDING');
    $this->db->where('delete_status <>', 'DELETED');
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function get_trno_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('status', 'CONFIRMED');
    $this->db->limit(1);
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->row();
  }

  public function get_trno_model_v2($emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('status', 'CONFIRMED');
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->limit(1);
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->row();
  }

  public function get_nctrno_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where_in('status', array('CONFIRMED','PENDING'));
    $this->db->limit(1);
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->row();
  }

  public function get_nctrno_model_v2($emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where_in('status', array('CONFIRMED','PENDING','CHECKED'));
    $this->db->limit(1);
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->row();
  }

  public function get_trno_model2($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where_in('status', array('PENDING','SAMPLE'));
    $this->db->limit(1);
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->row();
  }

  public function get_trno_model2_v2($emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->where_in('status', array('SAMPLE','PENDING','CHECKED'));
    $this->db->limit(1);
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->row();
  }

  public function get_new_trno_model()
  {
    $this->db->order_by('tr_no', 'desc');
    $this->db->limit(1);
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->row();
  }

  public function validate_new_trno_model()
  {
    $this->db->order_by('tr_no', 'desc');
    $this->db->limit(1);
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->row();
  }

  public function get_new_nctrno_model()
  {
    $this->db->order_by('id', 'desc');
    $this->db->limit(1);
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->row();
  }

  public function validate_cashtrno_model($trno)
  {
    $this->db->where('tr_no', $trno);
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->row();
  }

  public function get_previous_data_model($emp_id,$from,$to) 
  {
    $this->db->select('a.tr_no as trno, a.emp_id as cashier_id, a.emp_name as cname, concat(a.company_code,a.bunit_code) as bcode, concat(a.company_code,a.bunit_code,a.dept_code) as dcode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code) as scode, concat(a.company_code,a.bunit_code,a.dept_code,a.section_code,a.sub_section_code) as sscode, a.amount_shrt as sop, a.type as sop_type, a.date_shrt as dsales, b.total_denomination as gtotal, b.registered_sales as rsales');
    $this->db->from('cebo_cs_data as a');
    $this->db->join('cebo_cs_denomination as b', 'a.tr_no = b.tr_no AND a.emp_id = b.emp_id AND a.id = b.cs_data_id');
    $this->db->where('a.tr_no <>', '');
    $this->db->where('a.emp_id', $emp_id);
    $this->db->where('a.date_shrt BETWEEN "'.$from.'" and "'.$to.'" ');

    $query = $this->db->get();
    return $query->result_array();
  }

  public function validate_cashpending_checkbox_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where_in('status', array('CONFIRMED','PENDING','CHECKED'));
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->limit(1);
    $query = $this->db->get('cs_cashier_cashdenomination');
    return $query->result_array();
  }

  public function validate_noncash_pending_checkbox_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where_in('status', array('PENDING','SAMPLE','CHECKED'));
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->limit(1);
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function validate_noncash_pending_model($emp_id)
  {
    $this->db->select('pos_name, counter_no, borrowed, concat(company_code,bunit_code,dep_code,section_code) as scode, concat(company_code,bunit_code,dep_code,section_code,sub_section_code) as sscode');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where_in('status', array('PENDING','SAMPLE','CHECKED'));
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_pos_counter_no_model($dcode)
  {
    $this->db->where('dcode', $dcode);
    $this->db->order_by('pos_name', 'asc');
    $query = $this->db->get('cs_store_pos_counter_no');
    return $query->result_array();
  }

  public function get_history_pos_counter_no_model($pos_name,$dcode)
  {
    $this->db->where('pos_name <>', $pos_name);
    $this->db->where('dcode', $dcode);
    $this->db->order_by('pos_name', 'asc');
    $query = $this->db->get('cs_store_pos_counter_no');
    return $query->result_array();
  }

  public function validate_borrowed_model($emp_id)
  {
    $this->db->select('tr_no, borrowed, pos_name, counter_no, concat(company_code,bunit_code,dep_code,section_code) as scode, concat(company_code,bunit_code,dep_code,section_code,sub_section_code) as sscode');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where_in('status', array('CONFIRMED','PENDING'));
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_mop_model($emp_id)
  {
    $this->db->select('mop_name');
    $this->db->from('cs_cashier_mop_access');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('mop_type', 'NONCASH');
    $this->db->order_by('mop_name', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function validate_ncmop_model($emp_id,$mop_name,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where('mop_name', $mop_name);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('status', 'SAMPLE');
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->row();
  }

  public function get_sample_model($emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->select('tr_no');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('status', 'SAMPLE');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_allsample_model($emp_id)
  {
    $this->db->select('id, mop_name as name, noncash_qty as qty, noncash_amount as amount');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('status', 'SAMPLE');
    $this->db->order_by('id', 'desc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_allsample_model_v2($emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->select('id, mop_name as name, noncash_qty as qty, noncash_amount as amount');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('status', 'SAMPLE');
    $this->db->order_by('id', 'desc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function delete_nc_sample_model($id,$emp_id)
  {
    $this->db->where('id', $id);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('status', 'SAMPLE');
    $this->db->delete('cs_cashier_noncashdenomination');
  }

  public function delete_history_noncash_pending_model($id,$emp_id)
  {
    $this->db->where('id', $id);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('status', 'PENDING');
    $this->db->delete('cs_cashier_noncashdenomination');
  }

  public function update_sample_model($emp_id,$sscode,$pos_name,$borrowed)
  {
    $this->db->set('status', 'PENDING'); 
    $this->db->set('date_submit', 'NOW()', FALSE);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('status', 'SAMPLE');
    $this->db->update('cs_cashier_noncashdenomination');
  }

  public function check_noncash_pending_model($emp_id)
  {
    $this->db->where('emp_id', $emp_id);
    $this->db->where_in('status', array('PENDING','CHECKED'));
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->limit(1);
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function validate_cash_confirmed_model($emp_id)
  {
    $this->db->select('pos_name, counter_no, borrowed, concat(company_code,bunit_code,dep_code,section_code) as scode, concat(company_code,bunit_code,dep_code,section_code,sub_section_code) as sscode');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('status', 'CONFIRMED');
    $this->db->where('delete_status <>', 'DELETED');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function validate_update_noncash_borrowed_model($emp_id)
  {
    $this->db->select('concat(company_code,bunit_code,dep_code) as dcode, concat(section_code,sub_section_code) as sscode');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('cfs_noncashtype', '');
    $this->db->where('cfs_bankname', '');
    $this->db->where('cfs_cheqno', '');
    $this->db->where('status', 'PENDING');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->row();
  }

  public function update_noncash_borrowed_model($emp_id,$scode,$sscode)
  {
    $this->db->set('section_code', $scode);
    $this->db->set('sub_section_code', $sscode);
    $this->db->set('edit_borrowed', 'DISABLED');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('cfs_noncashtype', '');
    $this->db->where('cfs_bankname', '');
    $this->db->where('cfs_cheqno', '');
    $this->db->where('status', 'PENDING');
    $this->db->update('cs_cashier_noncashdenomination');
  }

  public function update_noncash_pos_model($emp_id,$pos_name,$counter_no)
  {
    $this->db->set('pos_name', $pos_name);
    $this->db->set('counter_no', $counter_no);
    $this->db->set('edit_pos', 'DISABLED');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('cfs_noncashtype', '');
    $this->db->where('cfs_bankname', '');
    $this->db->where('cfs_cheqno', '');
    $this->db->where('status', 'PENDING');
    $this->db->update('cs_cashier_noncashdenomination');
  }

  public function get_cash_pos_model($emp_id)
  {
    $this->db->select('edit_pos, pos_name, counter_no');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('status', 'PENDING');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_edit_mop_model($id,$emp_id)
  {
    $this->db->select('mop_name as mop');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('id', $id);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('status', 'PENDING');
    $query = $this->db->get();
    return $query->row()->mop;
  }

  public function get_exmop_model($emp_id,$mop_name)
  {
    $this->db->select('mop_name');
    $this->db->from('cs_cashier_mop_access');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('mop_name <>', $mop_name);
    $this->db->where('mop_type', 'NONCASH');
    $this->db->order_by('mop_name', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function update_history_noncash_mop_model($id,$emp_id,$mop_name,$noncash_qty,$noncash_amount)
  {
    $this->db->set('mop_name', $mop_name);
    $this->db->set('noncash_qty', $noncash_qty);
    $this->db->set('noncash_amount', $noncash_amount);
    $this->db->set('edit_denomination', 'DISABLED');
    $this->db->where('id', $id);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('status', 'PENDING');
    $this->db->update('cs_cashier_noncashdenomination');
  }

  public function validate_update_history_noncash_mop_model($id,$emp_id,$mop_name,$sscode,$pos_name,$borrowed)
  {
    $this->db->where('id <>', $id);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('mop_name', $mop_name);
    $this->db->where('status', 'PENDING');
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function get_history_noncash_mop_name_model($emp_id,$mop_arr)
  {
    $this->db->select('mop_name');
    $this->db->from('cs_cashier_mop_access');
    $this->db->where('emp_id', $emp_id);
    $this->db->where_not_in('mop_name', $mop_arr);
    $this->db->where('mop_type', 'NONCASH');
    $this->db->order_by('mop_name', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function validate_add_history_noncash_mop_model($emp_id,$sscode,$pos_name,$borrowed)
  { 
    $this->db->where('emp_id', $emp_id);
    $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
    $this->db->where('pos_name', $pos_name);
    $this->db->where('borrowed', $borrowed);
    $this->db->where('status', 'PENDING');
    $this->db->limit(1);
    $query = $this->db->get('cs_cashier_noncashdenomination');
    return $query->result_array();
  }

  public function history_add_mop_model(
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
  $borrowed,
  $pos_name,
  $counter_no,
  $mop_name,
  $nc_quantity,
  $nc_amount)
{
  $data = array(
    'tr_no'                       => $this->security->xss_clean(trim($tr_no)),
    'emp_id'                      => $this->security->xss_clean(trim($emp_id)),
    'sal_no'                      => $this->security->xss_clean(trim($sal_no)),
    'emp_name'                    => $this->security->xss_clean(trim($emp_name)),
    'emp_type'                    => $this->security->xss_clean(trim($emp_type)),
    'company_code'                => $this->security->xss_clean(trim($company_code)),
    'bunit_code'                  => $this->security->xss_clean(trim($bunit_code)),
    'dep_code'                    => $this->security->xss_clean(trim($dep_code)),
    'section_code'                => $this->security->xss_clean(trim($section_code)),
    'sub_section_code'            => $this->security->xss_clean(trim($sub_section_code)),
    'borrowed'                    => $this->security->xss_clean(trim($borrowed)),
    'pos_name'                    => $this->security->xss_clean(trim($pos_name)),
    'counter_no'                  => $this->security->xss_clean(trim($counter_no)),
    'mop_name'                    => $this->security->xss_clean(trim($mop_name)),
    'noncash_qty'                 => $this->security->xss_clean(trim($nc_quantity)),
    'noncash_amount'              => $this->security->xss_clean(trim($nc_amount)),
    'add_mop'                     => $this->security->xss_clean(trim('DISABLED')),
    'remit_type'                  => $this->security->xss_clean(trim('FINAL')),
    'status'                      => $this->security->xss_clean(trim('PENDING'))
  );

  $this->db->set('date_submit', 'NOW()', FALSE);
  $this->db->insert('cs_cashier_noncashdenomination', $data);
}

public function update_pending_noncash_mop_model($emp_id,$sscode,$pos_name,$borrowed)
{ 
  $this->db->set('add_mop', 'DISABLED');
  $this->db->where('emp_id', $emp_id);
  $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
  $this->db->where('pos_name', $pos_name);
  $this->db->where('borrowed', $borrowed);
  $this->db->where('status', 'PENDING');
  $this->db->update('cs_cashier_noncashdenomination');
}

public function update_history_noncash_borrowed_model($emp_id,$section_code,$sub_section_code,$pos_name,$counter_no)
{
  $this->db->set('section_code', $section_code);
  $this->db->set('sub_section_code', $sub_section_code);
  $this->db->set('pos_name', $pos_name);
  $this->db->set('counter_no', $counter_no);
  $this->db->set('borrowed', 'YES');
  $this->db->where('emp_id', $emp_id);
  $this->db->where_in('status', array('SAMPLE','PENDING'));
  $this->db->update('cs_cashier_noncashdenomination');
}

public function update_history_noncash_pos_model($emp_id,$pos_name,$counter_no)
{
  $this->db->set('pos_name', $pos_name);
  $this->db->set('counter_no', $counter_no);
  $this->db->where('emp_id', $emp_id);
  $this->db->where_in('status', array('SAMPLE','PENDING'));
  $this->db->update('cs_cashier_noncashdenomination');
}

public function update_cash_borrowed_model($emp_id,$section_code,$sub_section_code)
{
  $this->db->set('section_code', $section_code);
  $this->db->set('sub_section_code', $sub_section_code);
  $this->db->where('emp_id', $emp_id);
  $this->db->where_in('status', array('CONFIRMED','PENDING'));
  $this->db->update('cs_cashier_cashdenomination');
}

public function update_cash_pos_model($emp_id,$pos_name,$counter_no)
{
  $this->db->set('pos_name', $pos_name);
  $this->db->set('counter_no', $counter_no);
  $this->db->where('emp_id', $emp_id);
  $this->db->where_in('status', array('CONFIRMED','PENDING'));
  $this->db->update('cs_cashier_cashdenomination');
}

public function get_assigned_counter_model($emp_id,$current_date)
{
  $this->db->where('emp_id', $emp_id);
  $this->db->where('status', 'DEFAULT');
  $this->db->where('date_setup', $current_date);
  $query = $this->db->get('cs_cashier_assigned_counter');
  return $query->result_array();
}

public function get_total_partial_model($emp_id,$sscode,$pos_name,$borrowed)
{
  $this->db->select('sum(total_cash) as partial, remit_type, counter_no');
  $this->db->from('cs_cashier_cashdenomination');
  $this->db->where('emp_id', $emp_id);
  $this->db->where('concat(company_code,bunit_code,dep_code,section_code,sub_section_code)', $sscode);
  $this->db->where('borrowed', $borrowed);
  $this->db->where('pos_name', $pos_name);
  $this->db->where('remit_type', 'PARTIAL');
  $this->db->where('status', 'CONFIRMED');
  $this->db->where('delete_status <>', 'DELETED');
  $query = $this->db->get();
  return $query->row();
}

public function get_total_partial_model_v2($emp_id)
{
  $this->db->select('sum(total_cash) as partial, remit_type, borrowed, pos_name, counter_no, concat(company_code,bunit_code,dep_code,section_code) as scode, concat(company_code,bunit_code,dep_code,section_code,sub_section_code) as sscode');
  $this->db->from('cs_cashier_cashdenomination');
  $this->db->where('emp_id', $emp_id);
  $this->db->where('remit_type', 'PARTIAL');
  $this->db->where('status', 'CONFIRMED');
  $this->db->where('delete_status <>', 'DELETED');
  $query = $this->db->get();
  return $query->row();
}

public function get_remit_type_denomination_model($id)
{
  $this->db->where('id', $id);
  $this->db->where('status', 'PENDING');
  $query = $this->db->get('cs_cashier_cashdenomination');
  return $query->result_array();
}

public function update_remit_type_model($id,$type,$total_cash)
{
  $this->db->set('ten', 0);
  $this->db->set('five', 0);
  $this->db->set('two', 0);
  $this->db->set('one', 0);
  $this->db->set('twentyfive_cents', 0);
  $this->db->set('ten_cents', 0);
  $this->db->set('five_cents', 0);
  $this->db->set('one_cents', 0);
  $this->db->set('total_cash', $total_cash);
  $this->db->set('remit_type', $type);
  $this->db->set('edit_remittance_type', 'DISABLED');
  $this->db->where('id', $id);
  $this->db->where('status', 'PENDING');
  $this->db->update('cs_cashier_cashdenomination');
}
  
}
