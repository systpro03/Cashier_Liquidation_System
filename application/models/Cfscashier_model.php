<?php

class Cfscashier_model extends CI_Model
{

  public function __construct()
  {
    $this->load->database();
  }

  public function display_cfsmop_model() 
  {

     $query=$this->db->query("select * from cs_cfsothermop where mop_name <> '' order by mop_name ASC");
   
     return $query->result_array();

  }

  public function display_forex_currency_model()
  {
    $query=$this->db->query("select * from cs_cfsothermop where forex_currency <> '' order by forex_currency ASC");
   
     return $query->result_array();
  }

  public function get_forex_currency_model()
  {
    $query=$this->db->query("select * from cs_cfsothermop where forex_currency <> '' order by id ASC limit 1");
   
     return $query->result_array();
  }

  public function get_forex_symbol_model($currency)
  {
    $query=$this->db->query("select * from cs_cfsothermop where forex_currency = '".$currency."' ");
   
     return $query->result_array();
  }

  public function display_cfsncashmop_model()
  {
    $query=$this->db->query("select * from cs_cfsothermop where ncash_mopname <> '' order by ncash_mopname ASC");
   
     return $query->result_array();
  }

  public function display_cfsncashbankname_model()
  {
     $query=$this->db->query("select * from cs_cfsothermop where bank_name <> '' order by bank_name ASC");
   
     return $query->result_array();
  }

  public function save_cfscashdenomination_model(
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
    $cfscash_type,
    $status,
    $date
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
      'remit_type'                  => $this->security->xss_clean(trim('FINAL')),
      'cfs_cashtype'                => $this->security->xss_clean(trim($cfscash_type)),
      'status'                      => $this->security->xss_clean(trim($status))/*,
      'date_submit'                 => $this->security->xss_clean($date)*/
    );

    $this->db->set('date_submit', 'NOW()', FALSE);
    $this->db->insert('cs_cashier_cashdenomination', $data);

  }

  public function save_cfsnoncashdenomination_model(
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
    $type,
    $bank_name,
    $cheq_no,
    $amount,
    $status,
    $date
  ) {

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
      'cfs_noncashtype'             => $this->security->xss_clean(trim($type)),
      'cfs_bankname'                => $this->security->xss_clean(trim($bank_name)),
      'cfs_cheqno'                  => $this->security->xss_clean(trim($cheq_no)),
      'cfs_amount'                  => $this->security->xss_clean(trim($amount)),
      'remit_type'                  => $this->security->xss_clean(trim('FINAL')),
      'status'                      => $this->security->xss_clean(trim($status))/*,
      'date_submit'                 => $this->security->xss_clean($date)*/
    );

    $this->db->set('date_submit', 'NOW()', FALSE);
    $this->db->insert('cs_cashier_noncashdenomination', $data);

  }

  public function insert_cfsncash_model($b_id,$emp_id,$sal_no,$emp_name,$emp_type,$company_code,$bunit_code,$dep_code,$section_code,$sub_section_code,$amount_Arr,$status,$date)
  {

    $noncash_amount = str_replace(",","",$amount_Arr[3]);
     $query = $this->db->query("
                                  INSERT INTO
                                              cs_cashier_noncashdenomination
                                            (
                                              id,
                                              batch_id,
                                              emp_id,
                                              sal_no,
                                              emp_name,
                                              emp_type,
                                              company_code,
                                              bunit_code,
                                              dep_code,
                                              section_code,
                                              sub_section_code,
                                              mop_id,
                                              noncash_qty,
                                              noncash_amount,
                                              remit_type,
                                              status,
                                              date_submit
                                            )  
                                    values
                                            (
                                              null,
                                              '".$b_id."',
                                              '".$emp_id."',
                                              '".$sal_no."',
                                              '".$emp_name."',
                                              '".$emp_type."',
                                              '".$company_code."',
                                              '".$bunit_code."',
                                              '".$dep_code."',
                                              '".$section_code."',
                                              '".$sub_section_code."',
                                              '".$amount_Arr[1]."',
                                              '".$amount_Arr[2]."',
                                              '".$noncash_amount."',
                                              'FINAL',
                                              '".$status."',
                                              NOW()
                                            )

                               "); //'".$date."'

  }

  public function save_forex_denomination_model(
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
  $fiveh,
  $twoh,
  $oneh,
  $fifty,
  $twenty,
  $ten,
  $five,
  $two,
  $one,
  $total_peso,
  $forex_cur)
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
      'fiveh'                       => $this->security->xss_clean(trim($fiveh)),
      'twoh'                        => $this->security->xss_clean(trim($twoh)),
      'oneh'                        => $this->security->xss_clean(trim($oneh)),
      'fifty'                       => $this->security->xss_clean(trim($fifty)),
      'twenty'                      => $this->security->xss_clean(trim($twenty)),
      'ten'                         => $this->security->xss_clean(trim($ten)),
      'five'                        => $this->security->xss_clean(trim($five)),
      'two'                         => $this->security->xss_clean(trim($two)),
      'one'                         => $this->security->xss_clean(trim($one)),
      'forex_total_peso'            => $this->security->xss_clean(trim($total_peso)),
      'forex_currency'              => $this->security->xss_clean(trim($forex_cur)),
      'remit_type'                  => $this->security->xss_clean(trim('FINAL')),
      'status'                      => $this->security->xss_clean(trim('PENDING'))
    );

    $this->db->set('date_submit', 'NOW()', FALSE);
    $this->db->insert('cs_cashier_cashdenomination', $data);
  }

  public function save_forex_exchange_rate_model(
  $tr_no,
  $emp_id,
  $forex_currency,
  $fiveh,
  $twoh,
  $oneh,
  $fifty,
  $twenty,
  $ten,
  $five,
  $two,
  $one)
  {
    $data = array(
      'tr_no'                       => $this->security->xss_clean(trim($tr_no)),
      'emp_id'                      => $this->security->xss_clean(trim($emp_id)),
      'forex_currency'              => $this->security->xss_clean(trim($forex_currency)),
      'fiveh'                       => $this->security->xss_clean(trim($fiveh)),
      'twoh'                        => $this->security->xss_clean(trim($twoh)),
      'oneh'                        => $this->security->xss_clean(trim($oneh)),
      'fifty'                       => $this->security->xss_clean(trim($fifty)),
      'twenty'                      => $this->security->xss_clean(trim($twenty)),
      'ten'                         => $this->security->xss_clean(trim($ten)),
      'five'                        => $this->security->xss_clean(trim($five)),
      'two'                         => $this->security->xss_clean(trim($two)),
      'one'                         => $this->security->xss_clean(trim($one))
    );

    $this->db->set('date_time', 'NOW()', FALSE);
    $this->db->insert('cs_forex_exchange_rate', $data);
  }

  public function get_cash_trno_model()
  {
    $this->db->select('id');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->order_by('id', 'desc');
    $this->db->limit(1);
    
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_noncash_trno_model()
  {
    $this->db->select('id');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->order_by('id', 'desc');
    $this->db->limit(1);
    
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_pending_cash_model($emp_id)
  {

    $this->db->select('*');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('forex_currency', '');
    $this->db->where('cfs_cashtype <>', '');
    $this->db->where('status', 'PENDING');

    $query=$this->db->get();
    return $query->result_array();

  }

  public function get_pending_noncash_model($emp_id)
  {
    $this->db->select('*');
    $this->db->from('cs_cashier_noncashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('cfs_noncashtype <>', '');
    $this->db->where('cfs_bankname <>', '');
    $this->db->where('cfs_cheqno <>', '');
    $this->db->where('status', 'PENDING');

    $query=$this->db->get();
    return $query->result_array();
  }

  public function get_cfsothermop_model($type)
  {

     // $query=$this->db->query("select * from cs_cfsothermop where mop_name <> '' order by mop_name ASC");
     $this->db->select('*');
     $this->db->from('cs_cfsothermop');
     $this->db->where('mop_name <>', '');
     $this->db->where('mop_name <>', $type);
     $this->db->order_by('mop_name', 'ASC');
   
     $query=$this->db->get();
     return $query->result_array();

  }

  public function get_pending_ncash_type_model($type)
  {
     $this->db->select('*');
     $this->db->from('cs_cfsothermop');
     $this->db->where('ncash_mopname <>', '');
     $this->db->where('ncash_mopname <>', $type);
     $this->db->order_by('ncash_mopname', 'ASC');
   
     $query=$this->db->get();
     return $query->result_array();
  }

  public function get_pending_ncash_bank_model($bank)
  {
     // $query=$this->db->query("select * from cs_cfsothermop where bank_name <> '' order by bank_name ASC");
     $this->db->select('*');
     $this->db->from('cs_cfsothermop');
     $this->db->where('bank_name <>', '');
     $this->db->where('bank_name <>', $bank);
     $this->db->order_by('bank_name', 'ASC');
   
     $query=$this->db->get();
     return $query->result_array();
  }

  public function cfs_update_cash_history_model(
    $emp_id,
    $id,
    $cash_type,
    $onek,
    $fiveh,
    $twoh,
    $oneh,
    $fifty,
    $twenty,
    $ten,
    $five,
    $one,
    $twentyfive_cents,
    $ten_cents,
    $five_cents,
    $one_cents,
    $total_cash)
  {
    $data = array(
      'onek'                        => $this->security->xss_clean(trim($onek)),
      'fiveh'                       => $this->security->xss_clean(trim($fiveh)),
      'twoh'                        => $this->security->xss_clean(trim($twoh)),
      'oneh'                        => $this->security->xss_clean(trim($oneh)),
      'fifty'                       => $this->security->xss_clean(trim($fifty)),
      'twenty'                      => $this->security->xss_clean(trim($twenty)),
      'ten'                         => $this->security->xss_clean(trim($ten)),
      'five'                        => $this->security->xss_clean(trim($five)),
      'one'                         => $this->security->xss_clean(trim($one)),
      'twentyfive_cents'            => $this->security->xss_clean(trim($twentyfive_cents)),
      'ten_cents'                   => $this->security->xss_clean(trim($ten_cents)),
      'five_cents'                  => $this->security->xss_clean(trim($five_cents)),
      'one_cents'                   => $this->security->xss_clean(trim($one_cents)),
      'total_cash'                  => $this->security->xss_clean(trim($total_cash)),
      'cfs_cashtype'                => $this->security->xss_clean(trim($cash_type))
    );

    $this->db->where('id', $id);
    $this->db->where('emp_id', $emp_id);
    $this->db->update('cs_cashier_cashdenomination', $data);
  }

  public function cfs_update_noncash_history_model(
    $emp_id,
    $id,
    $noncash_type,
    $bank_name,
    $cheq_no,
    $amount
  )
  {
    $data = array(
      'cfs_noncashtype'       => $this->security->xss_clean(trim($noncash_type)),
      'cfs_bankname'          => $this->security->xss_clean(trim($bank_name)),
      'cfs_cheqno'            => $this->security->xss_clean(trim($cheq_no)),
      'cfs_amount'            => $this->security->xss_clean(trim($amount))
    );

    $this->db->where('id', $id);
    $this->db->where('emp_id', $emp_id);
    $this->db->update('cs_cashier_noncashdenomination', $data);
  }

  public function get_pending_forex_model($emp_id)
  {
    $this->db->select('*');
    $this->db->from('cs_cashier_cashdenomination');
    $this->db->where('emp_id', $emp_id);
    $this->db->where('forex_currency <>', '');
    $this->db->where('cfs_cashtype', '');
    $this->db->where('status', 'PENDING');

    $query=$this->db->get();
    return $query->result_array();
  }

  public function get_forex_symbol_history_model($currency)
  {
    // $query=$this->db->query("select * from cs_cfsothermop where forex_currency <> '' order by forex_currency ASC");
     $this->db->select('*');
     $this->db->from('cs_cfsothermop');
     $this->db->where('forex_currency <>', '');
     $this->db->where('forex_currency <>', $currency);
     $this->db->order_by('forex_currency', 'ASC');
   
     $query=$this->db->get();
     return $query->result_array();
  }

  public function disabled_cfssaveresetbtn_model($emp_id)
  {
    // $query=$this->db->query("select * from cs_cashier_cashdenomination where emp_id='".$emp_id."' and status = 'PENDING'");
     $this->db->select('*');
     $this->db->from('cs_cashier_cashdenomination');
     $this->db->where('emp_id', $emp_id);
     $this->db->where('forex_currency', '');
     $this->db->where('cfs_cashtype <>', '');
     $this->db->where('status', 'PENDING');
     
     $query=$this->db->get();
     return $query->result_array();
  }

  public function disabled_cfs_forex_form_model($emp_id)
  {
     $this->db->select('*');
     $this->db->from('cs_cashier_cashdenomination');
     $this->db->where('emp_id', $emp_id);
     $this->db->where('forex_currency <>', '');
     $this->db->where('cfs_cashtype', '');
     $this->db->where('status', 'PENDING');
     
     $query=$this->db->get();
     return $query->result_array();
  }

  public function disabled_cfsnoncashform_model($emp_id)
  {
     $this->db->select('*');
     $this->db->from('cs_cashier_noncashdenomination');
     $this->db->where('emp_id', $emp_id);
     $this->db->where('cfs_noncashtype <>', '');
     $this->db->where('cfs_bankname <>', '');
     $this->db->where('cfs_cheqno <>', '');
     $this->db->where('status', 'PENDING');
     
     $query=$this->db->get();
     return $query->result_array();
  }

  public function validate_cashtype_model($id,$emp_id,$cash_type)
  {
     $this->db->select('cfs_cashtype');
     $this->db->from('cs_cashier_cashdenomination');
     $this->db->where('emp_id', $emp_id);
     $this->db->where('cfs_cashtype', $cash_type);
     $this->db->where('status', 'PENDING');
     $this->db->where('id <>', $id);
     
     $query=$this->db->get();
     return $query->result_array();
  }

  public function get_forex_exchange_rate_history_model($tr_no,$emp_id,$currency)
  {
     $this->db->select('*');
     $this->db->from('cs_forex_exchange_rate');
     $this->db->where('tr_no', $tr_no);
     $this->db->where('emp_id', $emp_id);
     $this->db->where('forex_currency', $currency);
     
     $query=$this->db->get();
     return $query->result_array();
  }

  public function get_forex_denomination_model($id,$emp_id,$currency)
  {
     $this->db->select('*');
     $this->db->from('cs_cashier_cashdenomination');
     $this->db->where('id', $id);
     $this->db->where('emp_id', $emp_id);
     $this->db->where('forex_currency', $currency);
     
     $query=$this->db->get();
     return $query->result_array();
  }

  public function validate_currency_model($id,$emp_id,$currency)
  {
     $this->db->select('forex_currency');
     $this->db->from('cs_cashier_cashdenomination');
     $this->db->where('emp_id', $emp_id);
     $this->db->where('forex_currency', $currency);
     $this->db->where('status', 'PENDING');
     $this->db->where('id <>', $id);
     
     $query=$this->db->get();
     return $query->result_array();
  }

  public function update_forex_denomination_fc_model(
    $id,
    $emp_id,
    $currency,
    $fiveh,
    $twoh,
    $oneh,
    $fifty,
    $twenty,
    $ten,
    $five,
    $two,
    $one,
    $total_peso)
  {
    $data = array(
      'fiveh'                       => $this->security->xss_clean(trim($fiveh)),
      'twoh'                        => $this->security->xss_clean(trim($twoh)),
      'oneh'                        => $this->security->xss_clean(trim($oneh)),
      'fifty'                       => $this->security->xss_clean(trim($fifty)),
      'twenty'                      => $this->security->xss_clean(trim($twenty)),
      'ten'                         => $this->security->xss_clean(trim($ten)),
      'five'                        => $this->security->xss_clean(trim($five)),
      'two'                         => $this->security->xss_clean(trim($two)),
      'one'                         => $this->security->xss_clean(trim($one)),
      'forex_total_peso'            => $this->security->xss_clean(trim($total_peso))
    );

    $this->db->where('id', $id);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('forex_currency', $currency);
    $this->db->where('status', 'PENDING');
    $this->db->update('cs_cashier_cashdenomination', $data);
  }

  public function update_forex_denomination_exchange_rate_model(
    $tr_no,
    $emp_id,
    $currency,
    $fiveh,
    $twoh,
    $oneh,
    $fifty,
    $twenty,
    $ten,
    $five,
    $two,
    $one)
  {
    $data = array(
      'fiveh'                       => $this->security->xss_clean(trim($fiveh)),
      'twoh'                        => $this->security->xss_clean(trim($twoh)),
      'oneh'                        => $this->security->xss_clean(trim($oneh)),
      'fifty'                       => $this->security->xss_clean(trim($fifty)),
      'twenty'                      => $this->security->xss_clean(trim($twenty)),
      'ten'                         => $this->security->xss_clean(trim($ten)),
      'five'                        => $this->security->xss_clean(trim($five)),
      'two'                         => $this->security->xss_clean(trim($two)),
      'one'                         => $this->security->xss_clean(trim($one))
    );

    $this->db->where('tr_no', $tr_no);
    $this->db->where('emp_id', $emp_id);
    $this->db->where('forex_currency', $currency);
    $this->db->update('cs_forex_exchange_rate', $data);
  }


}
