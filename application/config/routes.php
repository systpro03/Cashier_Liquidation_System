<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// $route['default_controller'] = 'main_controller';
// $route['default_controller'] = 'cashier_controller/cashier_dashboard_ctrl';
// $route['default_controller'] = 'cashier_controller/cashier_cashform_ctrl';
// $route['default_controller'] = 'liquidation_controller/liq_domination_ctrl';
// $route['default_controller'] = 'cfs_cashier_controller/cfscashier_dashboard_ctrl';
// $route['default_controller'] = 'treasury_controller/treasury_dashboard_ctrl';
// $route['default_controller'] = 'supervisor_controller/supervisor_dashboard_ctrl';
$route['default_controller'] = 'login_controller/login_ctrl';
// $route['default_controller'] = 'admin_controller/admin_dashboard_ctrl';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;




/*==================================================jay routes===================================================*/
/*==================================================cashier routes===============================================*/
$route['cashier_dashboard_route'] 					= 'cashier_controller/cashier_dashboard_ctrl';
$route['cashier_cashform_route'] 					= 'cashier_controller/cashier_cashform_ctrl';
$route['cashier_final_cashform_route'] 		        = 'cashier_controller/cashier_final_cashform_ctrl';
$route['cashier_noncashform_route'] 				= 'cashier_controller/cashier_noncashform_ctrl';
$route['save_cashdenomination_route'] 				= 'cashier_controller/cash_denomination_ctrl';
$route['save_cashdenomination_borrowed_route'] 		= 'cashier_controller/cash_denomination_borrowed_ctrl';
$route['save_noncashdenomination_route'] 			= 'cashier_controller/noncash_denomination_ctrl';
$route['save_noncashdenomination_route_v2'] 		= 'cashier_controller/noncash_denomination_ctrl_v2';
$route['save_noncashdenomination_borrowed_route']   = 'cashier_controller/noncash_denomination_borrowed_ctrl';
$route['save_noncashdenomination_borrowed_route_v2']   = 'cashier_controller/noncash_denomination_borrowed_ctrl_v2';
$route['display_mop_route'] 						= 'cashier_controller/display_mop_ctrl';
$route['noncash_js_route'] 							= 'cashier_controller/noncash_js_ctrl';
$route['hnoncash_js_route'] 						= 'cashier_controller/hnoncash_js_ctrl';
$route['cashier_historyform_route'] 				= 'cashier_controller/cashier_history_ctrl';
$route['cashier_previous_historyform_route'] 		= 'cashier_controller/cashier_previous_historyform_ctrl';
$route['displayhistory_cashform_route'] 			= 'cashier_controller/displayhistory_cashform_ctrl';
$route['update_historycashform_route'] 				= 'cashier_controller/update_historycashform_ctrl';
$route['update_historycashform_route_v2'] 			= 'cashier_controller/update_historycashform_ctrl_v2';
$route['update_historycashform_borrowed_route'] 	= 'cashier_controller/update_historycashform_borrowed_ctrl';
$route['disabled_saveresetbtn_route'] 				= 'cashier_controller/disabled_saveresetbtn_ctrl';
$route['disabled_saveresetbtn_route_v2'] 			= 'cashier_controller/disabled_saveresetbtn_ctrl_v2';
$route['disabled_saveresetbtn_route_v3'] 			= 'cashier_controller/disabled_saveresetbtn_ctrl_v3';
$route['get_batchid_route']           				= 'cashier_controller/get_batchid_ctrl';
$route['disabled_noncashform_route']            	= 'cashier_controller/disabled_noncashform_ctrl';
$route['view_noncashmodal_route']            		= 'cashier_controller/view_noncashmodal_ctrl';
$route['disabled_partialcheckbox_route']            = 'cashier_controller/disabled_partialcheckbox_ctrl';
$route['displayhistory_noncashform_route']          = 'cashier_controller/displayhistory_noncashform_ctrl';
$route['displayhistory_noncashform_route_v2']       = 'cashier_controller/displayhistory_noncashform_ctrl_v2';
$route['update_historynoncashform_route']           = 'cashier_controller/update_historynoncashform_ctrl';
$route['update_historynoncashform_borrowed_route']  = 'cashier_controller/update_historynoncashform_borrowed_ctrl';
$route['display_hpartialdetails_route']           	= 'cashier_controller/display_hpartialdetails_ctrl';
$route['get_section_route']           				= 'cashier_controller/get_section_ctrl';
$route['get_sub_section_route']           			= 'cashier_controller/get_sub_section_ctrl';
$route['validate_cash_borrowed_route']           	= 'cashier_controller/validate_cash_borrowed_ctrl';
$route['validate_cash_borrowed_route_v2']           = 'cashier_controller/validate_cash_borrowed_ctrl_v2';
$route['validate_noncash_borrowed_route']           = 'cashier_controller/validate_noncash_borrowed_ctrl';
$route['validate_cash_access_route']                = 'cashier_controller/validate_cash_access_ctrl';
$route['validate_edit_cash_route']                  = 'cashier_controller/validate_edit_cash_ctrl';
$route['get_noncash_trno_route']                    = 'cashier_controller/get_noncash_trno_ctrl';
$route['get_cash_trno_route']                       = 'cashier_controller/get_cash_trno_ctrl';
$route['view_previous_den_route']                   = 'cashier_controller/view_previous_den_ctrl';
$route['display_pos_name_route']                    = 'cashier_controller/display_pos_name_ctrl';
$route['display_history_pos_name_route']            = 'cashier_controller/display_history_pos_name_ctrl';
$route['validate_borrowed_route']                   = 'cashier_controller/validate_borrowed_ctrl';
$route['validate_borrowed_route_v2']                = 'cashier_controller/validate_borrowed_ctrl_v2';
$route['display_mop_route_v2']                      = 'cashier_controller/display_mop_ctrl_v2';
$route['validate_sample_route']                     = 'cashier_controller/validate_sample_ctrl';
$route['display_sample_route']                      = 'cashier_controller/display_sample_ctrl';
$route['delete_nc_sample_route']                    = 'cashier_controller/delete_nc_sample_ctrl';
$route['delete_history_noncash_pending_route']      = 'cashier_controller/delete_history_noncash_pending_ctrl';
$route['submit_noncash_route']                      = 'cashier_controller/submit_noncash_ctrl';
$route['check_pending_route']                       = 'cashier_controller/check_pending_ctrl';
$route['update_noncash_borrowed_route']             = 'cashier_controller/update_noncash_borrowed_ctrl';
$route['update_noncash_pos_route']                  = 'cashier_controller/update_noncash_pos_ctrl';
$route['get_edit_mop_route']                        = 'cashier_controller/get_edit_mop_ctrl';
$route['update_history_noncash_mop_route']          = 'cashier_controller/update_history_noncash_mop_ctrl';
$route['history_add_mop_route']                     = 'cashier_controller/history_add_mop_ctrl';
$route['update_remit_type_route']                   = 'cashier_controller/update_remit_type_ctrl';
/*================================================================================================================*/




/*==========================================cfs cashier side======================================================*/
$route['cfscashier_dashboard_route'] 				= 'cfs_cashier_controller/cfscashier_dashboard_ctrl';
$route['cfscashier_denomination_route'] 			= 'cfs_cashier_controller/cfscashier_denomination_ctrl';
$route['cfs_forex_denomination_route'] 				= 'cfs_cashier_controller/cfs_forex_denomination_ctrl';
$route['display_cfsothermop_route'] 				= 'cfs_cashier_controller/display_cfsothermop_ctrl';
$route['display_forex_currency_route'] 				= 'cfs_cashier_controller/display_forex_currency_ctrl';
$route['display_forex_denomination_form_route'] 	= 'cfs_cashier_controller/display_forex_denomination_form_ctrl';
$route['submit_cfscashiercash_route'] 				= 'cfs_cashier_controller/submit_cfscashiercash_ctrl';
$route['submit_cfscashiernoncash_route'] 			= 'cfs_cashier_controller/submit_cfscashiernoncash_ctrl';
$route['display_cfsncashmop_route'] 				= 'cfs_cashier_controller/display_cfsncashmop_ctrl';
$route['display_cfsncashbankname_route'] 			= 'cfs_cashier_controller/display_cfsncashbankname_ctrl';
$route['cfsnoncash_js_route'] 						= 'cfs_cashier_controller/cfsnoncash_js_ctrl';
$route['cfs_history_js_route'] 						= 'cfs_cashier_controller/cfs_history_js_ctrl';
$route['submit_cfsncash_route'] 					= 'cfs_cashier_controller/submit_cfsncash_ctrl';
$route['get_cfsbatchid_route'] 						= 'cashier_controller/get_batchid_ctrl';
$route['disabled_cfssaveresetbtn_route'] 			= 'cfs_cashier_controller/disabled_cfssaveresetbtn_ctrl';
$route['disabled_cfsnoncashform_route'] 			= 'cfs_cashier_controller/disabled_cfsnoncashform_ctrl';
$route['disabled_cfs_forex_form_route'] 			= 'cfs_cashier_controller/disabled_cfs_forex_form_ctrl';
$route['cash_duplicate_route'] 						= 'cfs_cashier_controller/cash_duplicate_ctrl';
$route['noncash_duplicate_route'] 					= 'cfs_cashier_controller/noncash_duplicate_ctrl';
$route['forex_form_duplicate_route'] 				= 'cfs_cashier_controller/forex_form_duplicate_ctrl';
$route['change_currency_route'] 					= 'cfs_cashier_controller/change_currency_ctrl';
$route['submit_forex_denomination_route'] 			= 'cfs_cashier_controller/submit_forex_denomination_ctrl';
$route['cfs_history_denomination_route'] 			= 'cfs_cashier_controller/cfs_history_denomination_ctrl';
$route['get_pending_cash_route'] 					= 'cfs_cashier_controller/get_pending_cash_ctrl';
$route['cfs_update_cash_history_route'] 			= 'cfs_cashier_controller/cfs_update_cash_history_ctrl';
$route['get_pending_noncash_route'] 				= 'cfs_cashier_controller/get_pending_noncash_ctrl';
$route['cfs_update_noncash_history_route'] 			= 'cfs_cashier_controller/cfs_update_noncash_history_ctrl';
$route['get_pending_forex_route'] 					= 'cfs_cashier_controller/get_pending_forex_ctrl';
$route['history_change_currency_route'] 			= 'cfs_cashier_controller/history_change_currency_ctrl';
$route['update_forex_denomination_route'] 			= 'cfs_cashier_controller/update_forex_denomination_ctrl';
/*================================================================================================================*/




/*==========================================liquidation side======================================================*/
$route['cs_liq_domination_route'] 					    = 'liquidation_controller/liq_domination_ctrl';
$route['liq_domination_route'] 					        = 'liquidation_controller/liq_domination_ctrl';
$route['liq_transferred_den_route'] 					= 'liquidation_controller/liq_transferred_den_ctrl';
$route['cashier_partial_remitted_route'] 			    = 'liquidation_controller/cashier_partial_remitted_ctrl';
$route['end_of_day_report_route'] 			            = 'liquidation_controller/end_of_day_report_ctrl';
$route['productivity_report_route'] 			        = 'liquidation_controller/productivity_report_ctrl';
$route['productivity_report_all_cashier_route'] 	    = 'liquidation_controller/productivity_report_all_cashier_ctrl';
$route['received_cash_route'] 			                = 'liquidation_controller/received_cash_ctrl';
$route['partial_remitted_cash_route'] 			        = 'liquidation_controller/partial_remitted_cash_ctrl';
$route['liq_pending_noncash_route'] 			        = 'liquidation_controller/liq_pending_noncash_ctrl';
$route['liq_confiremd_den_route'] 				        = 'liquidation_controller/liq_confiremd_den_ctrl';
$route['view_pendingdenomination_route'] 		        = 'liquidation_controller/view_updated_pendingdenomination_ctrl';
$route['view_transferred_den_route'] 		            = 'liquidation_controller/view_transferred_den_ctrl';
$route['view_cashier_partial_remitted_route'] 		    = 'liquidation_controller/view_cashier_partial_remitted_ctrl';
$route['view_received_cash_route'] 		                = 'liquidation_controller/view_received_cash_ctrl';
$route['view_partial_remitted_cash_route'] 		        = 'liquidation_controller/view_partial_remitted_cash_ctrl';
$route['view_remit_modal_route'] 		                = 'liquidation_controller/view_remit_modal_ctrl';
$route['view_batch_partial_remitted_route'] 		    = 'liquidation_controller/view_batch_partial_remitted_ctrl';
$route['view_pending_noncash_den_route'] 		        = 'liquidation_controller/view_pending_noncash_den_ctrl';
$route['view_confirmed_denomination_route']             = 'liquidation_controller/view_confirmed_denomination_ctrl';
$route['get_pendingdenomination_route'] 		        = 'liquidation_controller/get_pendingdenomination_ctrl';
$route['get_variancemodal_route'] 				        = 'liquidation_controller/get_variancemodal_ctrl_v2';
$route['confirm_pcpmodal_route'] 				        = 'liquidation_controller/confirm_pcpmodal_ctrl_v2';
$route['confirm_noncash_denomination_route'] 	        = 'liquidation_controller/confirm_noncash_denomination_ctrl';
$route['edit_remittance_type_route'] 				    = 'liquidation_controller/edit_remittance_type_ctrl';
$route['get_pendingnoncashmodal_route'] 		        = 'liquidation_controller/get_pendingnoncashmodal_ctrl';
$route['cashier_linkaccess_route'] 				        = 'liquidation_controller/cashier_linkaccess_ctrl';
$route['display_cashierlinkaccess_route'] 		        = 'liquidation_controller/display_cashierlinkaccess_ctrl';
$route['view_partial_details_route'] 		            = 'liquidation_controller/view_partial_details_ctrl';
$route['cancel_borrowed_cashpending_modal_route'] 		= 'liquidation_controller/cancel_borrowed_cashpending_modal_ctrl';
$route['cancel_borrowed_noncashpending_modal_route'] 	= 'liquidation_controller/cancel_borrowed_noncashpending_modal_ctrl';
$route['enable_cashier_edit_borrowed_route'] 		    = 'liquidation_controller/enable_cashier_edit_borrowed_ctrl';
$route['enable_edit_cash_pos_route'] 		            = 'liquidation_controller/enable_edit_cash_pos_ctrl';
$route['enable_cashier_edit_noncashborrowed_route']     = 'liquidation_controller/enable_cashier_edit_noncashborrowed_ctrl';
$route['enable_edit_noncash_pos_route']                 = 'liquidation_controller/enable_edit_noncash_pos_ctrl';
$route['enable_add_mop_route']                          = 'liquidation_controller/enable_add_mop_ctrl';
$route['enable_cashier_edit_noncashden_route']          = 'liquidation_controller/enable_cashier_edit_noncashden_ctrl';
$route['enable_cashier_edit_noncashden_checked_route']  = 'liquidation_controller/enable_cashier_edit_noncashden_checked_ctrl';
$route['enable_cashier_edit_den_route']                 = 'liquidation_controller/enable_cashier_edit_den_ctrl';
$route['enable_submit_btn_route']                       = 'liquidation_controller/enable_submit_btn_ctrl';
$route['submit_cashierden_route']                       = 'liquidation_controller/submit_cashierden_ctrl';
$route['submit_cashierden_zero_rs_route']               = 'liquidation_controller/submit_cashierden_zero_rs_ctrl';
$route['insert_csdata_denomination_route']              = 'liquidation_controller/insert_csdata_denomination_ctrl';
$route['insert_csdata_denomination_zero_rs_route']      = 'liquidation_controller/insert_csdata_denomination_zero_rs_ctrl';
$route['print_cashierden_route']                        = 'liquidation_controller/print_cashierden_ctrl';
$route['print_submit_denomination_route']               = 'liquidation_controller/print_submit_denomination_ctrl';
$route['print_confirm_denomination_route']              = 'liquidation_controller/print_confirm_denomination_ctrl';
$route['print_liquidation_partial_cash_route']          = 'liquidation_controller/print_liquidation_partial_cash_ctrl';
$route['print_end_of_day_report_route']                 = 'liquidation_controller/print_end_of_day_report_ctrl';
$route['print_cashier_partial_denomination_route']      = 'liquidation_controller/print_cashier_partial_denomination_ctrl';
$route['remit_selected_cash_route']                     = 'liquidation_controller/remit_selected_cash_ctrl';
$route['change_sales_date_route']                       = 'liquidation_controller/change_sales_date_ctrl';
$route['validate_end_of_day_report_route']              = 'liquidation_controller/validate_end_of_day_report_ctrl';
$route['validate_supervisor_approve_route']             = 'liquidation_controller/validate_supervisor_approve_ctrl';
$route['get_year_route']                                = 'liquidation_controller/get_year_ctrl';
$route['view_productivity_route']                       = 'liquidation_controller/view_productivity_ctrl';
$route['save_productivivty_route']                      = 'liquidation_controller/save_productivivty_ctrl';
$route['update_productivity_route']                     = 'liquidation_controller/update_productivity_ctrl';
$route['print_cashier_productivivty_route']             = 'liquidation_controller/print_cashier_productivivty_ctrl';
$route['print_all_cashier_productivivty_route']         = 'liquidation_controller/print_all_cashier_productivivty_ctrl';
$route['print_cashier_monthly_productivivty_route']     = 'liquidation_controller/print_cashier_monthly_productivivty_ctrl';
$route['print_cashier_per_hour_productivivty_route']    = 'liquidation_controller/print_cashier_per_hour_productivivty_ctrl';

// ============================================liquidation adjustment route========================================
$route['liq_adjustment_route'] 					= 'liquidation_controller/liq_adjustment_ctrl';
$route['get_businessunit_route'] 				= 'liquidation_controller/get_businessunit_ctrl';
$route['get_bunitcode_route'] 					= 'liquidation_controller/get_bunitcode_ctrl';
$route['get_department_route'] 					= 'liquidation_controller/get_department_ctrl';
$route['get_deptamount_route'] 					= 'liquidation_controller/get_deptamount_ctrl';
$route['submit_amount_adjustment_route'] 		= 'liquidation_controller/submit_amount_adjustment_ctrl';
$route['get_adjusted_data_route'] 				= 'liquidation_controller/get_adjusted_data_ctrl';
$route['display_variance_route'] 				= 'liquidation_controller/display_variance_ctrl';
$route['adjust_variance_route'] 				= 'liquidation_controller/adjust_variance_ctrl';
$route['display_adjusted_route'] 				= 'liquidation_controller/display_adjusted_ctrl';
$route['print_adjusted_route'] 					= 'liquidation_controller/print_adjusted_ctrl';
$route['update_printing_counter_route'] 		= 'liquidation_controller/update_printing_counter_ctrl';
$route['load_pdf_route'] 						= 'liquidation_controller/load_pdf_ctrl';

/*==============================================cashier access route===========================================*/
$route['add_cashier_access_route'] 				            = 'liquidation_controller/add_cashier_access_ctrl';
$route['delete_cashier_access_route'] 			            = 'liquidation_controller/delete_cashier_access_ctrl';
$route['setup_cashier_access_route'] 			            = 'liquidation_controller/setup_cashier_access_ctrl';
$route['setup_cashier_counter_route'] 			            = 'liquidation_controller/setup_cashier_counter_ctrl';
$route['advance_setup_cashier_counter_route'] 			    = 'liquidation_controller/advance_setup_cashier_counter_ctrl';
$route['setup_cashier_login_route'] 			            = 'liquidation_controller/setup_cashier_login_ctrl';
$route['get_cashier_name_route'] 				            = 'liquidation_controller/get_cashier_name_ctrl';
$route['get_dept_mop_route'] 					            = 'liquidation_controller/get_dept_mop_ctrl';
$route['display_cashier_default_assignment_route'] 	        = 'liquidation_controller/display_cashier_default_assignment_ctrl';
$route['display_cda_route'] 	                            = 'liquidation_controller/display_cda_ctrl';
$route['delete_cda_modal_route'] 	                        = 'liquidation_controller/delete_cda_modal_ctrl';

/*===============================================cashier log-in access route========================================*/
$route['scl_get_cashier_name_route'] 			= 'liquidation_controller/scl_get_cashier_name_ctrl';
$route['add_login_access_route'] 			    = 'liquidation_controller/add_login_access_ctrl';
$route['scl_get_cashier_personnel_route'] 	    = 'liquidation_controller/scl_get_cashier_personnel_route';
$route['delete_access_route'] 	                = 'liquidation_controller/delete_access_ctrl';
$route['set_cashier_access_route'] 	            = 'liquidation_controller/set_cashier_access_ctrl';
$route['validate_access_route'] 	            = 'liquidation_controller/validate_access_ctrl';

/*==============================================masterfile route===================================================*/
$route['liq_masterfile_route'] 					= 'liquidation_controller/liq_masterfile_ctrl';
$route['liq_display_mop_route'] 				= 'liquidation_controller/liq_display_mop_ctrl';
$route['get_bunit_name_route'] 					= 'liquidation_controller/get_bunit_name_ctrl';
$route['get_deptname_route'] 					= 'liquidation_controller/get_deptname_ctrl';
$route['save_mop_access_route'] 				= 'liquidation_controller/save_mop_access_ctrl';

/*==============================================set-up assigned counter route===================================================*/
$route['liq_search_emp_route'] 				                = 'liquidation_controller/liq_search_emp_ctrl';
$route['setup_counter_get_section_route'] 	                = 'liquidation_controller/setup_counter_get_section_ctrl';
$route['setup_counter_get_sub_section_route'] 	            = 'liquidation_controller/setup_counter_get_sub_section_ctrl';
$route['setup_counter_display_pos_name_route'] 	            = 'liquidation_controller/setup_counter_display_pos_name_ctrl';
$route['set_assigned_counter_route'] 	                    = 'liquidation_controller/set_assigned_counter_ctrl';
$route['advance_set_assigned_counter_route'] 	            = 'liquidation_controller/advance_set_assigned_counter_ctrl';
$route['cashier_assigned_counter_route'] 	                = 'liquidation_controller/cashier_assigned_counter_ctrl';
$route['advance_cashier_assigned_counter_route'] 	        = 'liquidation_controller/advance_cashier_assigned_counter_ctrl';
$route['view_counter_route'] 	                            = 'liquidation_controller/view_counter_ctrl';
$route['view_advance_counter_route'] 	                    = 'liquidation_controller/view_advance_counter_ctrl';
$route['update_default_counter_route'] 	                    = 'liquidation_controller/update_default_counter_ctrl';
$route['update_advance_default_counter_route'] 	            = 'liquidation_controller/update_advance_default_counter_ctrl';

/*==============================================adjustment route===================================================*/
$route['adjustment_cash_route'] 	                        = 'liquidation_controller/adjustment_cash_ctrl';
$route['adjustment_noncash_route'] 	                        = 'liquidation_controller/adjustment_noncash_ctrl';
$route['adjustment_posted_route'] 	                        = 'liquidation_controller/adjustment_posted__ctrl';
$route['adjustment_posted_zero_rs_route'] 	                = 'liquidation_controller/adjustment_posted_zero_rs_ctrl';
$route['adjustment_sales_date_route'] 	                    = 'liquidation_controller/adjustment_sales_date_ctrl';
$route['adjusted_posted_zero_rs_route'] 	                = 'liquidation_controller/adjusted_posted_zero_rs_ctrl';
$route['adjusted_sales_date_route'] 	                    = 'liquidation_controller/adjusted_sales_date_ctrl';
$route['deleted_pending_cash_route'] 	                    = 'liquidation_controller/deleted_pending_cash_ctrl';
$route['deleted_posted_route'] 	                            = 'liquidation_controller/deleted_posted_ctrl';
$route['adjustment_pending_cash_route'] 	                = 'liquidation_controller/adjustment_pending_cash_ctrl';
$route['adjustment_pending_noncash_route'] 	                = 'liquidation_controller/adjustment_pending_noncash_ctrl';
$route['get_deleted_pending_cash_route'] 	                = 'liquidation_controller/get_deleted_pending_cash_ctrl';
$route['get_deleted_posted_denomination_route'] 	        = 'liquidation_controller/get_deleted_posted_denomination_ctrl';
$route['delete_pending_denomination_route'] 	            = 'liquidation_controller/delete_pending_denomination_ctrl';
$route['delete_pending_denomination_route_v2'] 	            = 'liquidation_controller/delete_pending_denomination_ctrl_v2';
$route['delete_pending_noncash_route'] 	                    = 'liquidation_controller/delete_pending_noncash_ctrl';
$route['delete_remitted_cash_route'] 	                    = 'liquidation_controller/delete_remitted_cash_ctrl';
$route['adjust_zero_rs_route'] 	                            = 'liquidation_controller/adjust_zero_rs_ctrl';
$route['update_sales_date_route'] 	                        = 'liquidation_controller/update_sales_date_ctrl';
$route['adjust_batch_sales_date_route'] 	                = 'liquidation_controller/adjust_batch_sales_date_ctrl';
$route['update_batch_counter_route'] 	                    = 'liquidation_controller/update_batch_counter_ctrl';
$route['view_mkey_modal_sales_date_adjustment_route'] 	    = 'liquidation_controller/view_mkey_modal_sales_date_adjustment_ctrl';
$route['delete_posted_denomination_route'] 	                = 'liquidation_controller/delete_posted_denomination_ctrl';
$route['posted_denomination_route'] 	                    = 'liquidation_controller/posted_denomination_ctrl';
$route['posted_zero_registered_sales_route'] 	            = 'liquidation_controller/posted_zero_registered_sales_ctrl';
$route['sales_date_adjustment_table_route'] 	            = 'liquidation_controller/sales_date_adjustment_table_ctrl';
$route['adjusted_zero_registered_sales_route'] 	            = 'liquidation_controller/adjusted_zero_registered_sales_ctrl';
$route['get_adjusted_sales_date_route'] 	                = 'liquidation_controller/get_adjusted_sales_date_ctrl';
$route['view_deleted_remitted_cash_module_route'] 	        = 'liquidation_controller/view_deleted_remitted_cash_module_ctrl';
$route['view_deleted_remitted_cash_route'] 	                = 'liquidation_controller/view_deleted_remitted_cash_ctrl';

/*================================================================================================================*/




// =================================================ACCOUNTING ROUTES==================================================
$route['cs_accounting_dashboard_route'] 		= 'accounting_controller/accounting_dashboard_ctrl';
$route['accounting_dashboard_route'] 			= 'accounting_controller/accounting_dashboard_ctrl';
$route['unadjusted_navcls_route'] 			    = 'accounting_controller/unadjusted_navcls_ctrl';
$route['adjusted_navcls_route'] 			    = 'accounting_controller/adjusted_navcls_ctrl';
$route['view_navcls_variance_route'] 			= 'accounting_controller/view_navcls_variance_ctrl';
$route['upload_file_route']                     = 'accounting_controller/upload_file_ctrl_v2'; 
$route['display_sales_date_uploaded_route']     = 'accounting_controller/display_sales_date_uploaded_ctrl'; 
$route['display_sales_date_uploaded_route_v2']  = 'accounting_controller/display_sales_date_uploaded_ctrl_v2'; 
$route['display_sales_date_uploaded_route2']    = 'accounting_controller/display_sales_date_uploaded_ctrl2'; 
$route['view_variance_navcls_route']            = 'accounting_controller/view_variance_navcls_ctrl'; 
$route['view_variance_navcls_route_v2']         = 'accounting_controller/view_variance_navcls_ctrl_v3'; 
$route['view_adjusted_variance_navcls_route']   = 'accounting_controller/view_adjusted_variance_navcls_ctrl'; 
$route['view_variance_navcls_route2']           = 'accounting_controller/view_variance_navcls_ctrl2'; 
$route['nav_adjustment_route']                  = 'accounting_controller/nav_adjustment_ctrl_v2'; 
$route['get_all_mop_route']                     = 'accounting_controller/get_all_mop_ctrl_v2'; 
$route['sumbmit_adjustment_route']              = 'accounting_controller/sumbmit_adjustment_ctrl'; 
$route['sumbmit_adjustment_route_v2']           = 'accounting_controller/sumbmit_adjustment_ctrl_v3'; 
$route['add_adjustment_route']                  = 'accounting_controller/add_adjustment_ctrl_v2'; 
$route['upload_attached_file_route']            = 'accounting_controller/upload_attached_file_ctrl'; 
$route['pending_adjustment_route']              = 'accounting_controller/pending_adjustment_ctrl_v2'; 
$route['delete_adjustment_route']               = 'accounting_controller/delete_adjustment_ctrl'; 
$route['validate_mop_transfer_route']           = 'accounting_controller/validate_mop_transfer_ctrl'; 
$route['adjustment_history_route']              = 'accounting_controller/adjustment_history_ctrl'; 
$route['display_adjustment_history_route']      = 'accounting_controller/display_adjustment_history_ctrl'; 
$route['print_unadjusted_navcls_route']         = 'accounting_controller/print_unadjusted_navcls_ctrl_v3'; 
$route['print_adjusted_navcls_route']           = 'accounting_controller/print_adjusted_navcls_ctrl_v3'; 
$route['get_nav_terminal_data_route']           = 'accounting_controller/get_nav_terminal_data_ctrl'; 

// ====================================================================================================================




/*==================================================TREASURY ROUTE=====================================================*/
$route['treasury_dashboard_route'] 				= 'treasury_controller/treasury_dashboard_ctrl';
$route['treasury_route'] 						= 'treasury_controller/treasury_ctrl';
$route['get_allbusinessunit_route'] 			= 'treasury_controller/get_allbusinessunit_ctrl';
$route['get_bunit_code_route'] 					= 'treasury_controller/get_bunit_code_ctrl';
$route['get_dept_name_route'] 					= 'treasury_controller/get_dept_name_ctrl';
$route['get_dept_code_route'] 					= 'treasury_controller/get_dept_code_ctrl';
$route['get_banks_route'] 						= 'treasury_controller/get_banks_ctrl';
$route['submit_bank_tagging_route'] 			= 'treasury_controller/submit_bank_tagging_ctrl';
$route['get_setup_bank_route'] 					= 'treasury_controller/get_setup_bank_ctrl';
$route['delete_banksetup_route'] 				= 'treasury_controller/delete_banksetup_ctrl';
$route['get_selected_bank_route'] 				= 'treasury_controller/get_selected_bank_ctrl';
$route['update_bank_tagging_route'] 			= 'treasury_controller/update_bank_tagging_ctrl';
$route['save_updated_banktagging_route'] 		= 'treasury_controller/save_updated_banktagging_ctrl';
/*================================================================================================================*/




/*===================================================SUPERVISOR ROUTE=================================================*/
$route['cs_supervisor_dashboard_route'] 			            = 'supervisor_controller/supervisor_dashboard_ctrl';
$route['supervisor_dashboard_route'] 			                = 'supervisor_controller/supervisor_dashboard_ctrl';
$route['supervisor_cashier_violation_route'] 	                = 'supervisor_controller/supervisor_cashier_violation_ctrl';
$route['display_cashier_violation_route'] 		                = 'supervisor_controller/display_cashier_violation_ctrl';
$route['display_forwarded_violation_route'] 	                = 'supervisor_controller/display_forwarded_violation_ctrl';
$route['submit_violation_route'] 				                = 'supervisor_controller/submit_violation_ctrl';
$route['supervisor_add_payment_route'] 			                = 'supervisor_controller/supervisor_add_payment_ctrl';
$route['supervisor_add_payment_route_v2'] 		                = 'supervisor_controller/supervisor_add_payment_ctrl_v2';
$route['get_bunit_route'] 						                = 'supervisor_controller/get_bunit_ctrl';
$route['get_bunit_route_v2'] 					                = 'supervisor_controller/get_bunit_ctrl_v2';
$route['mop_get_bunit_name_route'] 					            = 'supervisor_controller/mop_get_bunit_name_ctrl';
$route['display_department_route'] 				                = 'supervisor_controller/display_department_ctrl';
$route['save_payment_route'] 					                = 'supervisor_controller/save_payment_ctrl';
$route['save_payment_route_v2'] 			                    = 'supervisor_controller/save_payment_ctrl_v2';
$route['display_payment_list_route'] 			                = 'supervisor_controller/display_payment_list_ctrl';
$route['delete_mop_route'] 						                = 'supervisor_controller/delete_mop_ctrl';
$route['display_sup_mop_route'] 			                    = 'supervisor_controller/display_sup_mop_ctrl_v2';
$route['sup_cashier_denomination_route'] 	                    = 'supervisor_controller/sup_cashier_denomination_ctrl';
$route['sup_pending_denomination_route'] 	                    = 'supervisor_controller/sup_pending_denomination_ctrl';
$route['sup_cashier_deleted_denomination_route']                = 'supervisor_controller/sup_cashier_deleted_denomination_ctrl';
$route['sup_deleted_pending_denomination_route']                = 'supervisor_controller/sup_deleted_pending_denomination_ctrl';
$route['view_cashier_denomination_route'] 		                = 'supervisor_controller/view_cashier_denomination_ctrl';
$route['view_pending_denomination_route'] 		                = 'supervisor_controller/view_pending_denomination_ctrl';
$route['view_cashier_deleted_denomination_route'] 		        = 'supervisor_controller/view_cashier_deleted_denomination_ctrl';
$route['view_cashier_deleted_pending_denomination_route'] 		= 'supervisor_controller/view_cashier_deleted_pending_denomination_ctrl';
$route['cancel_denomination_route'] 		                    = 'supervisor_controller/cancel_denomination_ctrl';
$route['cancel_pending_denomination_route'] 		            = 'supervisor_controller/cancel_pending_denomination_ctrl';
$route['get_cutoff_date_route'] 		                        = 'supervisor_controller/get_cutoff_date_ctrl';
/*=====================================================================================================================*/





/*===================================================ACCOUNTING SUPERVISOR ROUTE=================================================*/
$route['cs_accounting_supervisor_dashboard_route'] 			= 'accounting_supervisor_controller/accounting_supervisor_dashboard_ctrl';
$route['accounting_supervisor_dashboard_route'] 			= 'accounting_supervisor_controller/accounting_supervisor_dashboard_ctrl';
$route['supervisor_pending_adjustment_route'] 			    = 'accounting_supervisor_controller/pending_adjustment_ctrl';
$route['supervisor_approved_adjustment_route'] 			    = 'accounting_supervisor_controller/supervisor_approved_adjustment_ctrl';
$route['get_pending_adjustment_route'] 			            = 'accounting_supervisor_controller/get_pending_adjustment_ctrl';
$route['get_approved_adjustment_route'] 			        = 'accounting_supervisor_controller/get_approved_adjustment_ctrl';
$route['approve_pending_request_route'] 			        = 'accounting_supervisor_controller/approve_pending_request_ctrl';
/*=====================================================================================================================*/





/*===================================================LOG-IN ROUTE=======================================================*/
$route['login_route'] 							= 'login_controller/login_ctrl';
$route['logout_route'] 							= 'login_controller/logout_ctrl';
$route['validate_user_route'] 					= 'login_controller/validate_user_ctrl';
/*=======================================================================================================================*/





/*========================================================ADMIN ROUTE=======================================================*/
$route['admin_dashboard_route'] 						= 'admin_controller/admin_dashboard_ctrl';
$route['adduser_access_route'] 							= 'admin_controller/adduser_access_ctrl';
$route['display_bunit_route'] 							= 'admin_controller/display_bunit_ctrl';
$route['search_emp_route'] 								= 'admin_controller/search_emp_ctrl';
$route['addpayment_user_route'] 						= 'admin_controller/addpayment_user_ctrl';
$route['display_user_route'] 							= 'admin_controller/display_user_ctrl';
$route['delete_user_route'] 							= 'admin_controller/delete_user_ctrl';
$route['admin_add_mop_route'] 							= 'admin_controller/admin_add_mop_ctrl';
$route['admin_get_bunit_route'] 				        = 'admin_controller/admin_get_bunit_ctrl';
$route['cashier_transaction_route'] 				    = 'admin_controller/cashier_transaction_ctrl';
$route['get_all_bu_route'] 				                = 'admin_controller/get_all_bu_ctrl';
$route['get_admin_deptname_route'] 				        = 'admin_controller/get_admin_deptname_ctrl';
$route['get_cashier_transaction_route'] 				= 'admin_controller/get_cashier_transaction_ctrl_v2';
$route['get_cash_den_route'] 				            = 'admin_controller/get_cash_den_ctrl';
$route['update_cash_den_route'] 				        = 'admin_controller/update_cash_den_ctrl';
$route['get_noncash_den_route'] 				        = 'admin_controller/get_noncash_den_ctrl';
$route['update_noncash_route'] 				            = 'admin_controller/update_noncash_ctrl';
$route['view_terminal_route'] 				            = 'admin_controller/view_terminal_ctrl';
$route['update_terminal_route'] 				        = 'admin_controller/update_terminal_ctrl';
$route['transfer_noncash_route'] 				        = 'admin_controller/transfer_noncash_ctrl';
$route['transfer_mop_route'] 				            = 'admin_controller/transfer_mop_ctrl';
$route['admin_update_sales_date_route'] 				= 'admin_controller/update_sales_date_ctrl';
$route['view_location_route'] 				            = 'admin_controller/view_location_ctrl';
$route['admin_get_section_route'] 				        = 'admin_controller/admin_get_section_ctrl';
$route['admin_get_sub_section_route'] 				    = 'admin_controller/admin_get_sub_section_ctrl';
$route['update_location_route'] 				        = 'admin_controller/update_location_ctrl';
$route['view_batch_remittance_route'] 				    = 'admin_controller/view_batch_remittance_ctrl';
$route['update_batch_remittance_route'] 				= 'admin_controller/update_batch_remittance_ctrl';
/*==========================================================================================================================*/

// ============================================ end jay routes=========================================================



/*=================================================LOuei About Us=========================================================================*/
$route['cashier_side_about']                                     = 'About_controller/cashier_side';
$route['accounting_side_about']                                  = 'About_controller/accounting_side';
$route['accounting_supervisor_about']                            = 'About_controller/acounting_supervisor_side';
$route['supervisor_side_about']                                  = 'About_controller/supervisor_side';
$route['liquidation_side_about']                                 = 'About_controller/liquidation_supervisor_side';