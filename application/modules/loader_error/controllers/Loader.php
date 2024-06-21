<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Loader extends CI_Controller { 

	function __construct(){ 
		parent::__construct(); 
	} 
	
	function index() {

		$param = isset($_POST['param']) ? $_POST['param'] : '';
		$q = isset($_REQUEST['q']) ? htmlentities($_REQUEST['q']) : false;
		$id = isset($_REQUEST['id']) ? htmlentities($_REQUEST['id']) : false;
		
		$return = array();
		
		$view_list = array();
		$view_list['date_format'] = array('view' => 'dbo.view_list_date_format');
		$view_list['month'] = array('view' => 'dbo.view_list_month', 'order'=>'id');
		$view_list['currencies'] = array('view' => 'dbo.view_list_currencies', 'order'=>'value');
		$view_list['currencies_rate'] = array('view' => 'dbo.view_list_currencies_rate', 'order'=>'value');
		$view_list['currencies_rate_type'] = array('view' => 'dbo.view_list_currencies_rate_type', 'order'=>'id');
		$view_list['gl_account'] = array('view' => 'dbo.view_list_gl_account', 'order'=>'value');
		$view_list['currencies_all'] = array('view' => 'dbo.view_list_currencies_all', 'order'=>'value');
		$view_list['tax_type'] = array('view' => 'dbo.view_list_tax_type', 'order'=>'value');
		$view_list['tax_item'] = array('view' => 'dbo.view_list_tax_item', 'order'=>'value');
		$view_list['uom'] = array('view' => 'dbo.view_list_uom', 'order'=>'value');
		$view_list['mb_flag'] = array('view' => 'dbo.view_list_mb_flag', 'order'=>'value');
		$view_list['custom_item_type'] = array('view' => 'dbo.view_list_custom_item_type', 'order'=>'value');
		$view_list['item_category'] = array('view' => 'dbo.view_list_item_category', 'order'=>'value');
		$view_list['custom_item_kite_type'] = array('view' => 'dbo.view_list_custom_item_kite_type', 'order'=>'value');
		$view_list['item_base'] = array('view' => 'dbo.view_list_item_base', 'order'=>'value');
		$view_list['item_fixed_asset'] = array('view' => 'dbo.view_list_item_fixed_asset', 'order'=>'value');
		$view_list['depriciation_method'] = array('view' => 'dbo.view_list_depriciation_method', 'order'=>'value');
		$view_list['warehouse'] = array('view' => 'dbo.view_list_warehouse', 'order'=>'value');
		$view_list['work_center'] = array('view' => 'dbo.view_list_work_center', 'order'=>'value');
		$view_list['manufacture_item'] = array('view' => 'dbo.view_list_manufacture_item', 'order'=>'value');
		$view_list['item_detail'] = array('view' => 'dbo.view_list_item_detail', 'order'=>'value');
		$view_list['work_process'] = array('view' => 'dbo.view_list_work_process', 'order'=>'value');
		$view_list['bom'] = array('view' => 'dbo.view_list_bom', 'order'=>'value');
		$view_list['country'] = array('view' => 'dbo.view_list_country', 'order'=>'value');
		$view_list['kppbc'] = array('view' => 'dbo.view_list_kppbc', 'order'=>'value');
		$view_list['identity'] = array('view' => 'dbo.view_list_identity', 'order'=>'id');
		$view_list['partner_api'] = array('view' => 'dbo.view_list_partner_api', 'order'=>'id');
		$view_list['supplier'] = array('view' => 'dbo.view_list_supplier', 'order'=>'value');
		$view_list['customer'] = array('view' => 'dbo.view_list_customer', 'order'=>'value');
		$view_list['partner'] = array('view' => 'dbo.view_list_partner', 'order'=>'value');
		$view_list['purchase_order_type_purchase'] = array('view' => 'dbo.view_list_purchase_order_type_purchase', 'order'=>'value');
		$view_list['purchase_order_type_memo'] = array('view' => 'dbo.view_list_purchase_order_type_memo', 'order'=>'value');
		$view_list['purchase_order_type_fixed_asset'] = array('view' => 'dbo.view_list_purchase_order_type_fixed_asset', 'order'=>'value');
		$view_list['sales_order_type_sales'] = array('view' => 'dbo.view_list_sales_order_type_sales', 'order'=>'value');
		$view_list['sales_order_type_memo'] = array('view' => 'dbo.view_list_sales_order_type_memo', 'order'=>'value');
		$view_list['bom_process'] = array('view' => 'dbo.view_list_bom_process', 'order'=>'value');
		$view_list['work_order_plan'] = array('view' => 'dbo.view_list_work_order_plan', 'order'=>'value');
		$view_list['work_order_item'] = array('view' => 'dbo.view_list_work_order_item', 'order'=>'value');
		$view_list['work_order_detail_process'] = array('view' => 'dbo.view_list_work_order_detail_process', 'order'=>'value');
		$view_list['work_order_request'] = array('view' => 'dbo.view_list_work_order_request', 'order'=>'value');
		$view_list['bank'] = array('view' => 'dbo.view_list_bank', 'order'=>'value');
		$view_list['bank_trans_type_deposit'] = array('view' => 'dbo.view_list_bank_trans_type_deposit', 'order'=>'value');
		$view_list['grn_custom'] = array('view' => 'dbo.view_list_grn_custom', 'order'=>'value');
		$view_list['grn_purchase'] = array('view' => 'dbo.view_list_grn_purchase', 'order'=>'value');
		$view_list['manufacture_item_with_bom_process'] = array('view' => 'dbo.view_list_manufacture_item_with_bom_process', 'order'=>'value');
		$view_list['jenis_tarif'] = array('view' => 'dbo.view_list_jenis_tarif', 'order'=>'id');
		$view_list['tax_group'] = array('view' => 'dbo.view_list_tax_group', 'order'=>'id');
		$view_list['hs_code'] = array('view' => 'dbo.view_list_hs', 'order'=>'id');
		$view_list['gl_tag'] = array('view' => 'dbo.view_list_gl_tag', 'order'=>'value');
		$view_list['calculate_type'] = array('view' => 'dbo.view_list_calculate_type', 'order'=>'id');
		$view_list['gl_account_section'] = array('view' => 'dbo.view_list_gl_account_section', 'order'=>'id');
		$view_list['gl_account_group'] = array('view' => 'dbo.view_list_gl_account_group', 'order'=>'value');
		$view_list['cashflow'] = array('view' => 'dbo.view_list_cashflow', 'order'=>'id');
		$view_list['contract_subcon_type'] = array('view' => 'dbo.view_list_contract_subcon_type', 'order'=>'id');
		$view_list['contract_subcon'] = array('view' => 'dbo.view_list_contract_subcon', 'order'=>'id');
		$view_list['item_cmt'] = array('view' => 'dbo.view_list_item_cmt', 'order'=>'id');
		$view_list['item_scrap'] = array('view' => 'dbo.view_list_item_scrap', 'order'=>'id');
		$view_list['item_reject'] = array('view' => 'dbo.view_list_item_reject', 'order'=>'id');
		$view_list['security_token'] = array('view' => 'dbo.view_list_security_token', 'order'=>'value');
		$view_list['work_process_user'] = array('view' => 'dbo.view_list_work_process_user', 'order'=>'value', 'where' => array(0 => array('field' => 'user_id', 'value' => $this->session->userdata('user_id')) ));
		$view_list['security_role'] = array('view' => 'dbo.view_list_security_role', 'order'=>'value');
		$view_list['user_status'] = array('view' => 'dbo.view_list_user_status', 'order'=>'value');
		$view_list['work_order_plan_type'] = array('view' => 'dbo.view_list_work_order_plan_type', 'order'=>'id');
		$view_list['contract_subcon_plan'] = array('view' => 'dbo.view_list_contract_subcon_plan', 'order'=>'id');
		$view_list['sales_order_plan'] = array('view' => 'dbo.view_list_sales_order_plan', 'order'=>'id');
		$view_list['work_order_production_type'] = array('view' => 'dbo.view_list_work_order_production_type', 'order'=>'id');
		$view_list['contract_subcon_production'] = array('view' => 'dbo.view_list_contract_subcon_production', 'order'=>'id');
		$view_list['work_order_costing_type'] = array('view' => 'dbo.view_list_work_order_costing_type', 'order'=>'id');
		$view_list['bank_trans_type_payment'] = array('view' => 'dbo.view_list_bank_trans_type_payment', 'key' => 'bank_trans_type_id');
		$view_list['port'] = array('view' => 'dbo.view_list_port', 'key' => 'port_id');
		$view_list['tujuan_tpb'] = array('view' => 'dbo.view_list_tujuan_tpb', 'key' => 'tujuan_tpb_id');
		$view_list['jenis_tpb'] = array('view' => 'dbo.view_list_jenis_tpb', 'key' => 'jenis_tpb_id');
		$view_list['tujuan_pengiriman'] = array('view' => 'dbo.view_list_tujuan_pengiriman', 'key' => 'tujuan_pengiriman_id');
		$view_list['tujuan_pemasukan'] = array('view' => 'dbo.view_list_tujuan_pemasukan', 'key' => 'tujuan_pemasukan_id');
		$view_list['cara_angkut'] = array('view' => 'dbo.view_list_cara_angkut', 'key' => 'cara_angkut_id');
		$view_list['tps'] = array('view' => 'dbo.view_list_tps', 'key' => 'tps_id');
		$view_list['insurance_type'] = array('view' => 'dbo.view_list_insurance_type', 'key' => 'insurance_type_id');
		$view_list['price_type'] = array('view' => 'dbo.view_list_price_type', 'key' => 'price_type_id');
		$view_list['pjt_status'] = array('view' => 'dbo.view_list_pjt_status', 'key' => 'pjt_status_id');
		$view_list['kategori_barang'] = array('view' => 'dbo.view_list_kategori_barang', 'key' => 'kategori_barang_id');
		$view_list['package'] = array('view' => 'dbo.view_list_package', 'key' => 'package_id');
		$view_list['fasilitas'] = array('view' => 'dbo.view_list_fasilitas', 'key' => 'fasilitas_id');
		$view_list['skema_tarif'] = array('view' => 'dbo.view_list_skema_tarif', 'key' => 'skema_tarif_id');
		$view_list['app_trans'] = array('view' => 'dbo.view_list_app_trans', 'key' => 'app_trans_id');
		$view_list['custom_item_kite_type_report'] = array('view' => 'dbo.view_list_custom_item_kite_type_report', 'key' => 'custom_item_kite_type_id');
		$view_list['voucher_type'] = array('view' => 'dbo.view_list_voucher_type', 'key' => 'app_trans_id');
		$view_list['jenis_ekspor'] = array('view' => 'dbo.view_list_jenis_ekspor', 'key' => 'jenis_ekspor_id');
		$view_list['kategori_ekspor'] = array('view' => 'dbo.view_list_kategori_ekspor', 'key' => 'kategori_ekspor_id');
		$view_list['cara_perdagangan'] = array('view' => 'dbo.view_list_cara_perdagangan', 'key' => 'cara_perdagangan_id');
		$view_list['cara_pembayaran_peb'] = array('view' => 'dbo.view_list_cara_pembayaran_peb', 'key' => 'cara_pembayaran_id');
		$view_list['cara_pembayaran_ceisa'] = array('view' => 'dbo.view_list_cara_pembayaran_ceisa', 'key' => 'cara_pembayaran_id');
		
		$data_list = array();
		$data_list['data_bank'] = array('view' => 'dbo.view_bank', 'key' => 'bank_id');
		$data_list['data_contract_subcon'] = array('view' => 'dbo.view_contract_subcon', 'key' => 'contract_subcon_id');
		$data_list['data_currencies'] = array('view' => 'dbo.view_currencies', 'key' => 'currencies_id');
		$data_list['data_tax_type'] = array('view' => 'dbo.view_tax_type', 'key' => 'tax_type_id');
		$data_list['data_item_category'] = array('view' => 'dbo.view_item_category', 'key' => 'item_category_id');
		$data_list['data_item_base'] = array('view' => 'dbo.view_item_base', 'key' => 'item_base_id');
		$data_list['data_item_detail'] = array('view' => 'dbo.view_item_detail', 'key' => 'item_id');
		$data_list['data_work_center'] = array('view' => 'dbo.view_work_center', 'key' => 'work_center_id');
		$data_list['data_work_process'] = array('view' => 'dbo.view_work_process', 'key' => 'work_process_id');
		$data_list['data_supplier'] = array('view' => 'dbo.view_supplier', 'key' => 'partner_id');
		$data_list['data_customer'] = array('view' => 'dbo.view_customer', 'key' => 'partner_id');
		$data_list['data_purchase_request'] = array('view' => 'dbo.view_purchase_request','view_detail' => 'dbo.view_purchase_request_detail','view_detail_session' => 'purchase_request','detail_session_key' => 'purchase_request_index','detail_session_seq' => 'purchase_request_seq', 'key' => 'purchase_request_id');
		$data_list['data_purchase_order'] = array('view' => 'dbo.view_purchase_order','view_detail' => 'dbo.view_purchase_order_detail','view_detail_session' => 'purchase_order','detail_session_key' => 'purchase_order_index','detail_session_seq' => 'purchase_order_seq', 'key' => 'purchase_order_id');
		$data_list['data_sales_order'] = array('view' => 'dbo.view_sales_order','view_detail' => 'dbo.view_sales_order_detail','view_detail_session' => 'sales_order','detail_session_key' => 'sales_order_index','detail_session_seq' => 'sales_order_seq', 'key' => 'sales_order_id');
		$data_list['data_memo_purchase'] = array('view' => 'dbo.view_memo_purchase','view_detail' => 'dbo.view_purchase_order_detail','view_detail_session' => 'memo_purchase','detail_session_key' => 'purchase_order_index','detail_session_seq' => 'memo_purchase_seq', 'key' => 'purchase_order_id');
		$data_list['data_memo_sales'] = array('view' => 'dbo.view_memo_sales','view_detail' => 'dbo.view_sales_order_detail','view_detail_session' => 'memo_sales','detail_session_key' => 'sales_order_index','detail_session_seq' => 'memo_sales_seq', 'key' => 'sales_order_id');
		$data_list['data_purchase_performa'] = array('view' => 'dbo.view_purchase_performa','view_detail' => 'dbo.view_purchase_performa_detail','view_detail_session' => 'purchase_performa','detail_session_key' => 'purchase_performa_index','detail_session_seq' => 'purchase_performa_seq', 'key' => 'purchase_performa_id');
		$data_list['data_sales_performa'] = array('view' => 'dbo.view_sales_performa','view_detail' => 'dbo.view_sales_performa_detail','view_detail_session' => 'sales_performa','detail_session_key' => 'sales_performa_index','detail_session_seq' => 'sales_performa_seq', 'key' => 'sales_performa_id');
		$data_list['data_sales_order_transfer'] = array('view' => 'dbo.view_sales_order_transfer','view_detail' => 'dbo.view_sales_order_transfer_detail','view_detail_session' => 'sales_order_transfer','detail_session_key' => 'sales_order_transfer_index','detail_session_seq' => 'sales_order_transfer_seq', 'key' => 'sales_order_transfer_id');
		$data_list['data_grn'] = array('view' => 'dbo.view_grn','view_detail' => 'dbo.view_grn_detail','view_detail_session' => 'grn','detail_session_key' => 'grn_index','detail_session_seq' => 'grn_seq', 'key' => 'grn_id');
		$data_list['data_delivery'] = array('view' => 'dbo.view_delivery','view_detail' => 'dbo.view_delivery_detail','view_detail_session' => 'delivery','detail_session_key' => 'delivery_index','detail_session_seq' => 'delivery_seq', 'key' => 'delivery_id');
		$data_list['data_custom_import'] = array('view' => 'dbo.view_custom_import', 'key' => 'bc_in_header_id');
		$data_list['data_custom_import_detail'] = array('view' => 'dbo.view_custom_import_detail', 'key' => 'bc_in_barang_id');
		$data_list['data_custom_export'] = array('view' => 'dbo.view_custom_export', 'key' => 'bc_out_header_id');
		$data_list['data_custom_export_detail'] = array('view' => 'dbo.view_custom_export_detail', 'key' => 'bc_out_barang_id');
		$data_list['data_work_order_plan'] = array('view' => 'dbo.view_work_order_plan','view_detail' => 'dbo.view_work_order','view_detail_session' => 'work_order_plan','detail_session_key' => 'work_order_plan_index','detail_session_seq' => 'work_order_plan_seq', 'key' => 'work_order_plan_id');
		$data_list['data_work_order_request'] = array('view' => 'dbo.view_work_order_request','view_detail' => 'dbo.view_work_order_request_detail','view_detail_session' => 'work_order_request','detail_session_key' => 'work_order_request_index','detail_session_seq' => 'work_order_request_seq', 'key' => 'work_order_request_id');
		$data_list['data_work_order_transfer'] = array('view' => 'dbo.view_work_order_transfer','view_detail' => 'dbo.view_work_order_transfer_detail','view_detail_session' => 'work_order_transfer','detail_session_key' => 'work_order_transfer_index','detail_session_seq' => 'work_order_transfer_seq', 'key' => 'work_order_transfer_id');
		$data_list['data_work_order_production'] = array('view' => 'dbo.view_work_order_production','view_detail' => 'dbo.view_work_order_production_detail','view_detail_session' => 'work_order_production','detail_session_key' => 'work_order_production_index','detail_session_seq' => 'work_order_production_seq', 'key' => 'work_order_production_id');
		$data_list['data_work_order_scrap'] = array('view' => 'dbo.view_work_order_scrap','view_detail' => 'dbo.view_work_order_scrap_detail','view_detail_session' => 'work_order_scrap','detail_session_key' => 'work_order_scrap_index','detail_session_seq' => 'work_order_scrap_seq', 'key' => 'work_order_scrap_id');
		$data_list['data_work_order_return'] = array('view' => 'dbo.view_work_order_return','view_detail' => 'dbo.view_work_order_return_detail','view_detail_session' => 'work_order_return','detail_session_key' => 'work_order_return_index','detail_session_seq' => 'work_order_return_seq', 'key' => 'work_order_return_id');
		$data_list['data_work_order_costing'] = array('view' => 'dbo.view_work_order_costing','view_detail' => 'dbo.view_work_order_costing_detail','view_detail_session' => 'work_order_costing','detail_session_key' => 'work_order_costing_index','detail_session_seq' => 'work_order_costing_seq', 'key' => 'work_order_costing_id');
		$data_list['data_work_order_costing_period'] = array('view' => 'dbo.view_work_order_costing_period','view_detail' => 'dbo.view_work_order_costing_period_detail','view_detail_session' => 'work_order_costing_period','detail_session_key' => 'work_order_costing_period_index','detail_session_seq' => 'work_order_costing_period_seq', 'key' => 'work_order_costing_period_id');
		$data_list['data_work_order_subcon'] = array('view' => 'dbo.view_work_order_subcon','view_detail' => 'dbo.view_work_order_subcon_detail','view_detail_session' => 'work_order_subcon','detail_session_key' => 'work_order_subcon_index','detail_session_seq' => 'work_order_subcon_seq', 'key' => 'work_order_subcon_id');
		$data_list['data_bank_trans_deposit'] = array('view' => 'dbo.view_bank_deposit','view_detail' => 'dbo.view_bank_trans_detail','view_detail_session' => 'bank_trans_deposit','detail_session_key' => 'bank_trans_index','detail_session_seq' => 'bank_trans_deposit_seq', 'key' => 'bank_trans_id');
		$data_list['data_bank_trans_payment'] = array('view' => 'dbo.view_bank_payment','view_detail' => 'dbo.view_bank_trans_detail','view_detail_session' => 'bank_trans_payment','detail_session_key' => 'bank_trans_index','detail_session_seq' => 'bank_trans_payment_seq', 'key' => 'bank_trans_id');
		$data_list['data_bank_trans_transfer'] = array('view' => 'dbo.view_bank_transfer', 'key' => 'bank_trans_id');
		$data_list['data_uom'] = array('view' => 'dbo.view_uom', 'key' => 'uom_id');
		$data_list['data_kppbc'] = array('view' => 'dbo.view_kppbc', 'key' => 'kppbc_id');
		$data_list['data_port'] = array('view' => 'dbo.view_port', 'key' => 'port_id');
		$data_list['data_warehouse'] = array('view' => 'dbo.view_warehouse', 'key' => 'warehouse_id');
		$data_list['data_package'] = array('view' => 'dbo.view_package', 'key' => 'package_id');
		$data_list['data_supp_trans_invoice'] = array('view' => 'dbo.view_supp_trans_invoice','view_detail' => 'dbo.view_supp_trans_invoice_detail_gl','view_detail_session' => 'supp_trans_invoice','detail_session_key' => 'supp_trans_index','detail_session_seq' => 'supp_trans_invoice_seq', 'key' => 'supp_trans_id');
		$data_list['data_cust_trans_invoice'] = array('view' => 'dbo.view_cust_trans_invoice','view_detail' => 'dbo.view_cust_trans_invoice_detail_gl','view_detail_session' => 'cust_trans_invoice','detail_session_key' => 'cust_trans_index','detail_session_seq' => 'cust_trans_invoice_seq', 'key' => 'cust_trans_id');
		$data_list['data_supp_trans_payment'] = array('view' => 'dbo.view_supp_trans_payment', 'key' => 'supp_trans_id');
		$data_list['data_cust_trans_payment'] = array('view' => 'dbo.view_cust_trans_payment', 'key' => 'cust_trans_id');
		$data_list['data_currencies_rate'] = array('view' => 'dbo.view_currencies_rate', 'key' => 'currencies_rate_id');
		$data_list['data_hs'] = array('view' => 'dbo.view_hs_code', 'key' => 'hs_id');
		$data_list['data_gl_account_section'] = array('view' => 'dbo.view_gl_account_section', 'key' => 'gl_account_section_id');
		$data_list['data_gl_account_group'] = array('view' => 'dbo.view_gl_account_group', 'key' => 'gl_account_group_id');
		$data_list['data_gl_account'] = array('view' => 'dbo.view_gl_account', 'key' => 'gl_account_id');
		$data_list['data_gl_tag'] = array('view' => 'dbo.view_gl_tag', 'key' => 'gl_tag_id');
		$data_list['data_security_module'] = array('view' => 'dbo.view_security_module', 'key' => 'module_method_id');
		$data_list['data_security_token'] = array('view' => 'dbo.view_security_token', 'key' => 'token_id');
		$data_list['data_work_order_request_detail'] = array('view' => 'dbo.view_work_order_request_detail', 'key' => 'work_order_request_detail_id');
		$data_list['data_work_order_production_detail'] = array('view' => 'dbo.view_work_order_production_detail', 'key' => 'work_order_production_detail_id');
		$data_list['data_work_order_scrap_detail'] = array('view' => 'dbo.view_work_order_scrap_detail', 'key' => 'work_order_scrap_detail_id');
		$data_list['data_work_order_subcon_detail'] = array('view' => 'dbo.view_work_order_subcon_detail', 'key' => 'work_order_subcon_detail_id');
		$data_list['data_tax_group'] = array('view' => 'dbo.view_tax_group','view_detail' => 'dbo.view_tax_group_detail','view_detail_session' => 'tax_group','detail_session_key' => 'tax_group_index','detail_session_seq' => 'tax_group_seq', 'key' => 'tax_group_id');
		$data_list['data_bom'] = array('view' => 'dbo.view_bom','view_detail' => 'dbo.view_bom_detail','view_detail_session' => 'bom','detail_session_key' => 'bom_index','detail_session_seq' => 'bom_seq', 'key' => 'bom_id');
		$data_list['data_bom_process'] = array('view' => 'dbo.view_bom_process','view_detail' => 'dbo.view_bom_process_detail','view_detail_session' => 'bom_process','detail_session_key' => 'bom_process_index','detail_session_seq' => 'bom_process_seq', 'key' => 'bom_process_id');
		$data_list['data_journal_entry'] = array('view' => 'dbo.view_gl_trans','view_detail' => 'dbo.view_gl_trans_detail','view_detail_session' => 'journal_entry','detail_session_key' => 'journal_entry_index','detail_session_seq' => 'journal_entry_seq', 'key' => 'gl_trans_id');
		$data_list['data_subcon_in'] = array('view' => 'dbo.view_subcon_in','view_detail' => 'dbo.view_subcon_in_detail','view_detail_session' => 'subcon_in','detail_session_key' => 'subcon_in_index','detail_session_seq' => 'subcon_in_seq', 'key' => 'subcon_in_id');
		$data_list['data_subcon_out'] = array('view' => 'dbo.view_subcon_out','view_detail' => 'dbo.view_subcon_out_detail','view_detail_session' => 'subcon_out','detail_session_key' => 'subcon_out_index','detail_session_seq' => 'subcon_out_seq', 'key' => 'subcon_out_id');
		$data_list['data_security_role_token'] = array('view' => 'dbo.view_security_role','view_detail' => 'dbo.view_security_role_token', 'key' => 'role_id');
		$data_list['data_user_management'] = array('view' => 'dbo.view_user','view_detail' => 'dbo.view_user_work_process', 'key' => 'user_id');
		$data_list['data_item_fixed_asset'] = array('view' => 'dbo.view_item_fixed_asset', 'key' => 'item_fixed_asset_id');
		$data_list['data_consumable'] = array('view' => 'dbo.view_consumable', 'key' => 'consumable_id');
		$data_list['data_work_order_costing_period_detail'] = array('view' => 'dbo.view_work_order_costing_period_detail', 'key' => 'work_order_costing_period_detail_id');
		$data_list['data_stock_adjustment'] = array('view' => 'dbo.view_stock_adjustment','view_detail' => 'dbo.view_stock_adjustment_detail','view_detail_session' => 'stock_adjustment','detail_session_key' => 'stock_adjustment_index','detail_session_seq' => 'stock_adjustment_seq', 'key' => 'stock_adjustment_id');
		$data_list['data_purchase_request_detail'] = array('view' => 'dbo.view_purchase_request_detail', 'key' => 'purchase_request_detail_id');
		$data_list['data_purchase_order_detail'] = array('view' => 'dbo.view_purchase_order_detail', 'key' => 'purchase_order_detail_id');
		$data_list['data_purchase_performa_detail'] = array('view' => 'dbo.view_purchase_performa_detail', 'key' => 'purchase_performa_detail_id');
		
		$data_list['data_sales_order_detail'] = array('view' => 'dbo.view_sales_order_detail', 'key' => 'sales_order_detail_id');
		$data_list['data_sales_performa_detail'] = array('view' => 'dbo.view_sales_performa_detail', 'key' => 'sales_performa_detail_id');
		
		$data_list['data_subcon_in_detail'] = array('view' => 'dbo.view_subcon_in_detail', 'key' => 'subcon_in_detail_id');
		$data_list['data_subcon_out_detail'] = array('view' => 'dbo.view_subcon_out_detail', 'key' => 'subcon_out_detail_id');
		$data_list['data_work_order'] = array('view' => 'dbo.view_work_order', 'key' => 'work_order_id');
		
		$data_list['data_tax_group_detail'] = array('view' => 'dbo.view_tax_group_detail', 'key' => 'tax_group_detail_id');
		$data_list['data_bom_detail'] = array('view' => 'dbo.view_bom_detail', 'key' => 'bom_detail_id');
		$data_list['data_bom_process_detail'] = array('view' => 'dbo.view_bom_process_detail', 'key' => 'bom_process_detail_id');
		
		$data_list['data_grn_detail'] = array('view' => 'dbo.view_grn_detail', 'key' => 'grn_detail_id');
		$data_list['data_consumable_detail'] = array('view' => 'dbo.view_consumable_detail', 'key' => 'consumable_detail_id');
		
		$data_list['data_journal_entry_detail'] = array('view' => 'dbo.view_gl_trans_detail', 'key' => 'gl_trans_detail_id');
		$data_list['data_bank_trans_detail'] = array('view' => 'dbo.view_bank_trans_detail', 'key' => 'bank_trans_detail_id');
		$data_list['data_fixed_asset_purchase'] = array('view' => 'dbo.view_fixed_asset_purchase', 'key' => 'purchase_order_id');
		$data_list['data_supp_trans_detail_gl'] = array('view' => 'dbo.view_supp_trans_invoice_detail_gl', 'key' => 'supp_trans_detail_id');
		$data_list['data_supp_trans_detail'] = array('view' => 'dbo.view_supp_trans_invoice_detail', 'key' => 'supp_trans_detail_id');
		$data_list['data_cust_trans_detail_gl'] = array('view' => 'dbo.view_cust_trans_invoice_detail_gl', 'key' => 'cust_trans_detail_id');
		$data_list['data_cust_trans_detail'] = array('view' => 'dbo.view_cust_trans_invoice_detail', 'key' => 'cust_trans_detail_id');
		
		$data_list['data_stock_opname'] = array('view' => 'dbo.view_stock_opname', 'key' => 'stock_opname_id');
		
		
		$custom = array();
		$custom[] = 'confirm';
		
		$custom_list = array();
		
		$confirm_data = array();
		$confirm_data[0] = "No";
		$confirm_data[1] = "Yes";
		
		$custom_list['confirm']['data'] = $confirm_data;
				
		$data_session = array();
		$data_session[] = 'data_sess_purchase_request';
		$data_session[] = 'data_sess_tax_group';
		$data_session[] = 'data_sess_bom';
		$data_session[] = 'data_sess_bom_process';
		$data_session[] = 'data_sess_purchase_order';
		$data_session[] = 'data_sess_memo_purchase';
		$data_session[] = 'data_sess_work_order_plan';
		$data_session[] = 'data_sess_bank_trans_deposit';
		$data_session[] = 'data_sess_bank_trans_payment';
		$data_session[] = 'data_sess_journal_entry';
		$data_session[] = 'data_sess_subcon_in';
		$data_session[] = 'data_sess_subcon_out';
		$data_session[] = 'data_sess_sales_order';
		$data_session[] = 'data_sess_supp_trans_invoice';
		$data_session[] = 'data_sess_cust_trans_invoice';
		$data_session[] = 'data_sess_stock_adjustment';
		
		$data_session_list = array();
		$data_session_list['data_sess_purchase_request'] = 'purchase_request';
		$data_session_list['data_sess_purchase_order'] = 'purchase_order';
		$data_session_list['data_sess_memo_purchase'] = 'memo_purchase';
		$data_session_list['data_sess_work_order_plan'] = 'work_order_plan';
		$data_session_list['data_sess_bank_trans_deposit'] = 'bank_trans_deposit';
		$data_session_list['data_sess_bank_trans_payment'] = 'bank_trans_payment';
		$data_session_list['data_sess_tax_group'] = 'tax_group';
		$data_session_list['data_sess_bom'] = 'bom';
		$data_session_list['data_sess_bom_process'] = 'bom_process';
		$data_session_list['data_sess_journal_entry'] = 'journal_entry';
		$data_session_list['data_sess_subcon_in'] = 'subcon_in';
		$data_session_list['data_sess_subcon_out'] = 'subcon_out';
		$data_session_list['data_sess_sales_order'] = 'sales_order';
		$data_session_list['data_sess_stock_adjustment'] = 'stock_adjustment';
		$data_session_list['data_sess_supp_trans_invoice'] = 'supp_trans_invoice';
		$data_session_list['data_sess_cust_trans_invoice'] = 'cust_trans_invoice';
		
		$get = array();
		$get[] = 'get_purchase_data';
		$get[] = 'get_sales_data';
		$get[] = 'get_grn_custom';
		$get[] = 'get_delivery_custom';
		$get[] = 'get_grn_purchase';
		$get[] = 'get_delivery_sales';
		$get[] = 'get_supply_sales';
		$get[] = 'get_bom_process';
		$get[] = 'get_item_from_work_order_detail';
		$get[] = 'get_item_from_work_order_plan_process';
		$get[] = 'get_work_order_detail_process';
		$get[] = 'get_bom_from_work_order';
		$get[] = 'get_bom';
		$get[] = 'get_gl_parent_group';
		$get[] = 'get_rate_data';
		$get[] = 'get_contract_subcon';
		$get[] = 'get_contract_subcon_type';
		$get[] = 'get_work_order_plan_process';
		$get[] = 'get_work_order_detail_item';
		$get[] = 'get_work_order_detail_item_from_plan';
		$get[] = 'get_app_trans_no';
		$get[] = 'get_good_receive_no';
		$get[] = 'get_item_detail';
		$get[] = 'get_bank_curr';
				
		$offset = 0;
		$limit = 100;
		
		if(in_array($param,$get)){
			if($param == 'get_item_detail'){
				$where = array();
				
				if($q){
					$where["value like '%". $q ."%' AND 1="] = 1;
				}
				
				$return[] = array("id"=>0,"value"=>'All',"text"=>'All');
				
				$data_table = $this->main->getData('dbo.view_list_item_detail', null, $where);
				if($data_table){
					foreach($data_table as $key => $value){
						$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
					}
				}
				
				$return['results'] = $return;
			}
			
			if($param == 'get_work_order_plan_process'){
				$work_process_id = isset($_REQUEST['work_process_id']) ? htmlentities($_REQUEST['work_process_id']) : false;
				
				$where = array();
				
				if($id){
					$where['id'] = $id;
				} else {
					if($work_process_id){
						$where['work_process_id'] = $work_process_id;
					} else {
						$where['work_process_id'] = -1;
					}
				}
				
				if($q){
					$where["value like '%". $q ."%' AND 1="] = 1;
				}
				
				$order = "value asc";
				
				$data_table = $this->main->getData('dbo.view_list_work_order_plan_process', null, $where, null, $order );
				
				if($data_table){
					$return = $data_table;
				} else {
					$return = array();
				}
				
				$return['results'] = $return;
			}
			
			if($param == 'get_contract_subcon_type'){
				$partner_id = isset($_REQUEST['partner_id']) ? is_numeric($_REQUEST['partner_id']) ? $_REQUEST['partner_id']  : -1 : -1;
				$contract_subcon_id = isset($_REQUEST['contract_subcon_id']) ? htmlentities($_REQUEST['contract_subcon_id']) : false;
				
				$where = array();
				
				if($id){
					$where['contract_subcon_id'] = $id;
				} else {
					$where['partner_id'] = $partner_id;
					if($contract_subcon_id){
						$where['contract_subcon_id'] = $contract_subcon_id;
					} else {
						$where['contract_subcon_id'] = -1;
					}
				}
				
				
				$order = "contract_subcon_id desc";
				
				$data_table = $this->main->getData('dbo.view_contract_subcon', null, $where, null, $order , 1);
				if($data_table){
					$return = $data_table;
				} else {
					$return = false;
				}
				
				$return['results'] = $return;
			}
			
			if($param == 'get_good_receive_no'){
				$bc_in_header_id = isset($_REQUEST['bc_in_header_id']) ? htmlentities($_REQUEST['bc_in_header_id']) : false;
				$po_no = '';
				$bc_no = '';
				
				$where = array();
				$where['bc_in_header_id'] = $bc_in_header_id;
				
				$order = null;
				
				$data_table = $this->main->getData('dbo.view_get_bc_no_po_no', null, $where, null, $order , 1);
				if($data_table){
					foreach($data_table as $key => $value){
						$bc_no = $value['doc_no'];
						$po_no = $value['po_no'];
						
						if(!$po_no){
							$where = array();
							$where['app_trans_id'] = 57;
											
							$order = null;
							
							$data_table = $this->main->getData('dbo.view_app_trans', null, $where, null, $order , 1);
							if($data_table){
								foreach($data_table as $key => $value){
									if(date('Ym',strtotime($value['app_trans_last_date'])) != date('Ym')){
										$app_trans_no = 0;
									} else {
										$app_trans_no = $value['app_trans_no'];
									}
									
									$app_trans_no++;
									
									$po_no .= $value['app_trans_prefix'];
									$po_no .= "-".date('Y/m/d');
									$po_no .= "-".str_pad($app_trans_no, 4, "0", STR_PAD_LEFT);
								}
							}
						}
					}
				}
				
				$return['po_no'] = $po_no;
				$return['bc_no'] = $bc_no;
				$return['results'] = $return;
			}
			
			if($param == 'get_bank_curr'){
				$return2 = false;
				
				$currencies_id = isset($_REQUEST['currencies_id']) ? htmlentities($_REQUEST['currencies_id']) : false;
				$bank_id = isset($_REQUEST['bank_id']) ? is_numeric($_REQUEST['bank_id']) ? $_REQUEST['bank_id']  : -1 : -1;
				
				$where = array();
				$where['bank_id'] = $bank_id;
				
				$order = null;
				
				$data_table = $this->main->getData('dbo.view_bank', null, $where, null, $order , 1);
				if($data_table){
					$bank_currencies_id = $data_table[0]['currencies_id'];
					if($bank_currencies_id == $currencies_id){
						$return2 = true;
					} else {
						$return2 = false;
					}
				} else {
					$return2 = false;
				}
				
				$return['results'] = $return2;
				
				
			}
			
			if($param == 'get_purchase_data'){
				$partner_id = isset($_REQUEST['partner_id']) ? htmlentities($_REQUEST['partner_id']) : false;
				$currencies_id = isset($_REQUEST['currencies_id']) ? htmlentities($_REQUEST['currencies_id']) : false;
				$item_id = isset($_REQUEST['item_id']) ? is_numeric($_REQUEST['item_id']) ? $_REQUEST['item_id']  : -1 : -1;
				
				$date = isset($_REQUEST['date']) ? htmlentities($_REQUEST['date']) : '1900-01-01';
				
				$where = array();
				// $where['partner_id'] = $partner_id;
				// $where['currencies_id'] = $currencies_id;
				$where['item_id'] = $item_id;
				
				$order = "purchase_data_id desc";
				
				$data_table = $this->main->getData('dbo.view_purchase_data', null, $where, null, $order , 1);
				if($data_table){
					$return = $data_table;
					$return[0]['unit_price'] = $this->mainconfig->get_decimal_format2($return[0]['unit_price'],4);
					$return[0]['conversion'] = $this->mainconfig->get_decimal_format2($return[0]['conversion']);
				} else {
					$return[0]['unit_price'] = 0;
					$return[0]['conversion'] = 1;
					$return[0]['partner_uom_id'] = 1;
				}
				
				
				$where = array();
				$where['currencies_date_start <='] = $date;
				$where['currencies_date_end >='] = $date;
				$where['currencies_id'] = $currencies_id;
								
				$home_currency = $this->session->userdata('home_currencies');
				if($home_currency == $currencies_id){
					$return[0]['rate'] = 1;
				} else {
					$data_table = $this->main->getData('dbo.view_currencies_rate', null, $where, null, null , 1);
					if($data_table){
						$return2 = $data_table;
						$return[0]['rate'] = $this->mainconfig->get_decimal_format2($return2[0]['currencies_rate'],8);
					} else {
						$return[0]['rate'] = 0;
					}
				}
				
				$return['results'] = $return;
			}
			
			if($param == 'get_sales_data'){
				$partner_id = isset($_REQUEST['partner_id']) ? htmlentities($_REQUEST['partner_id']) : false;
				$currencies_id = isset($_REQUEST['currencies_id']) ? htmlentities($_REQUEST['currencies_id']) : false;
				$item_id = isset($_REQUEST['item_id']) ? is_numeric($_REQUEST['item_id']) ? $_REQUEST['item_id']  : -1 : -1;
				$date = isset($_REQUEST['date']) ? htmlentities($_REQUEST['date']) : '1900-01-01';
				
				$where = array();
				// $where['partner_id'] = $partner_id;
				// $where['currencies_id'] = $currencies_id;
				$where['item_id'] = $item_id;
				
				$order = "sales_data_id desc";
				
				$data_table = $this->main->getData('dbo.view_sales_data', null, $where, null, $order , 1);
				if($data_table){
					$return = $data_table;
					$return[0]['unit_price'] = $this->mainconfig->get_decimal_format2($return[0]['unit_price'],4);
					$return[0]['conversion'] = $this->mainconfig->get_decimal_format2($return[0]['conversion']);
				} else {
					$return[0]['unit_price'] = 0;
					$return[0]['conversion'] = 1;
					$return[0]['partner_uom_id'] = 1;
				}
				
				$where = array();
				$where['currencies_date_start <='] = $date;
				$where['currencies_date_end >='] = $date;
				$where['currencies_id'] = $currencies_id;
								
				$home_currency = $this->session->userdata('home_currencies');
				if($home_currency == $currencies_id){
					$return[0]['rate'] = 1;
				} else {
					$data_table = $this->main->getData('dbo.view_currencies_rate', null, $where, null, null , 1);
					if($data_table){
						$return2 = $data_table;
						$return[0]['rate'] = $this->mainconfig->get_decimal_format2($return2[0]['currencies_rate'],8);
					} else {
						$return[0]['rate'] = 0;
					}
				}
				
				$return['results'] = $return;
			}
			
			if($param == 'get_grn_custom'){
				$partner_id = isset($_REQUEST['partner_id']) ? is_numeric($_REQUEST['partner_id']) ? $_REQUEST['partner_id']  : -1 : -1;
				
				$where = array();
				$where['vendor_partner_id'] = $partner_id;
				if($id){
					if($id == -1){
						$limit = 1;
					} else {
						$where["id"] = $id;
					}
				} else {
					if($q){
						$where["value like '%". $q ."%' AND 1="] = 1;
					}
				}
				
				$order = "value asc";
				
				$data_table = $this->main->getData('dbo.view_list_grn_custom', null, $where, null, $order , $limit, $offset);
				if($data_table){
					foreach($data_table as $key => $value){
						$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
					}
				}
				
				$return['results'] = $return;
			}
			
			if($param == 'get_delivery_custom'){
				$partner_id = isset($_REQUEST['partner_id']) ? is_numeric($_REQUEST['partner_id']) ? $_REQUEST['partner_id']  : -1 : -1;
				
				$where = array();
				$where['partner_id'] = $partner_id;
				if($id){
					if($id == -1){
						$limit = 1;
					} else {
						$where["id"] = $id;
					}
				} else {
					if($q){
						$where["value like '%". $q ."%' AND 1="] = 1;
					}
				}
				
				if($q){
						$where["value like '%". $q ."%' AND 1="] = 1;
					}
					
				$order = "value asc";
				
				$data_table = $this->main->getData('dbo.view_list_delivery_custom', null, $where, null, $order , $limit, $offset);
				if($data_table){
					foreach($data_table as $key => $value){
						$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
					}
				}
				
				$return['results'] = $return;
			}
			
			if($param == 'get_bom_process'){
				$item_id = isset($_REQUEST['item_id']) ? is_numeric($_REQUEST['item_id']) ? $_REQUEST['item_id']  : -1 : -1;
				
				$where = array();
				$where['fg_item_id'] = $item_id;
				if($id){
					if($id == -1){
						$limit = 1;
					} else {
						$where["id"] = $id;
					}
				} else {
					if($q){
						$where["value like '%". $q ."%' AND 1="] = 1;
					}
				}
				
				$order = "value asc";
				
				$data_table = $this->main->getData('dbo.view_list_bom_process', null, $where, null, $order , $limit, $offset);
				if($data_table){
					foreach($data_table as $key => $value){
						$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
					}
				}
				
				$return['results'] = $return;
			}
				
			if($param == 'get_item_from_work_order_detail'){
				$work_order_plan_id = isset($_REQUEST['work_order_plan_id']) ? is_numeric($_REQUEST['work_order_plan_id']) ? $_REQUEST['work_order_plan_id']  : -1 : -1;
				$work_order_detail_id = isset($_REQUEST['work_order_detail_id']) ? is_numeric($_REQUEST['work_order_detail_id']) ? $_REQUEST['work_order_detail_id']  : -1 : -1;
				
				$where = array();
				$where['work_order_plan_id'] = $work_order_plan_id;
				$where['work_order_detail_id'] = $work_order_detail_id;
				if($id){
					if($id == -1){
						$limit = 1;
					} else {
						$where["id"] = $id;
					}
				} else {
					if($q){
						$where["value like '%". $q ."%' AND 1="] = 1;
					}
				}
				
				$order = "value asc";
				
				$data_table = $this->main->getData('dbo.view_list_item_from_work_order_detail', null, $where, null, $order , $limit, $offset);
				if($data_table){
					foreach($data_table as $key => $value){
						$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
					}
				}
				
				$return['results'] = $return;
			}
			
			if($param == 'get_work_order_detail_item'){
				$work_order_plan_id = isset($_REQUEST['work_order_plan_id']) ? is_numeric($_REQUEST['work_order_plan_id']) ? $_REQUEST['work_order_plan_id']  : -1 : -1;
				$work_process_id = isset($_REQUEST['work_process_id']) ? is_numeric($_REQUEST['work_process_id']) ? $_REQUEST['work_process_id']  : -1 : -1;
				
				$where = array();
				$where['work_order_plan_id'] = $work_order_plan_id;
				$where['work_process_id'] = $work_process_id;
				if($id){
					if($id == -1){
						$limit = 1;
					} else {
						$where["id"] = $id;
					}
				} else {
					if($q){
						$where["value like '%". $q ."%' AND 1="] = 1;
					}
				}
				
				$order = "value asc";
				
				$data_table = $this->main->getData('dbo.view_list_work_order_detail_item', null, $where, null, $order , $limit, $offset);
				if($data_table){
					foreach($data_table as $key => $value){
						$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
					}
				}
				
				$return['results'] = $return;
			}
			
			if($param == 'get_work_order_detail_item_from_plan'){
				$work_order_plan_id = isset($_REQUEST['work_order_plan_id']) ? is_numeric($_REQUEST['work_order_plan_id']) ? $_REQUEST['work_order_plan_id']  : -1 : -1;
				
				$where = array();
				$where['work_order_plan_id'] = $work_order_plan_id;
				if($id){
					if($id == -1){
						$limit = 1;
					} else {
						$where["id"] = $id;
					}
				} 
				
				if($q){
					$where["value like '%". $q ."%' AND 1="] = 1;
				}
				
				$order = "value asc";
				
				$data_table = $this->main->getData('dbo.view_list_work_order_detail_item_from_plan', null, $where, null, $order , $limit, $offset);
				if($data_table){
					foreach($data_table as $key => $value){
						$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
					}
				}
				
				$return['results'] = $return;
			}
			
			if($param == 'get_item_from_work_order_plan_process'){
				$work_order_plan_id = isset($_REQUEST['work_order_plan_id']) ? is_numeric($_REQUEST['work_order_plan_id']) ? $_REQUEST['work_order_plan_id']  : -1 : -1;
				$work_process_id = isset($_REQUEST['work_process_id']) ? is_numeric($_REQUEST['work_process_id']) ? $_REQUEST['work_process_id']  : -1 : -1;
				$work_order_detail_id = isset($_REQUEST['work_order_detail_id']) ? is_numeric($_REQUEST['work_order_detail_id']) ? $_REQUEST['work_order_detail_id']  : -1 : -1;
				
				$where = array();
				$where['work_order_plan_id'] = $work_order_plan_id;
				$where['work_process_id'] = $work_process_id;
				$where['work_order_detail_id'] = $work_order_detail_id;
				if($id){
					if($id == -1){
						$limit = 1;
					} else {
						$where["id"] = $id;
					}
				} else {
					if($q){
						$where["value like '%". $q ."%' AND 1="] = 1;
					}
				}
				
				$order = "value asc";
				
				$data_table = $this->main->getData('dbo.view_list_item_from_work_order_plan_process', null, $where, null, $order , $limit, $offset);
				if($data_table){
					foreach($data_table as $key => $value){
						$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
					}
				}
				
				$return['results'] = $return;
			}
				
			if($param == 'get_work_order_detail_process'){
				$work_order_plan_id = isset($_REQUEST['work_order_plan_id']) ? is_numeric($_REQUEST['work_order_plan_id']) ? $_REQUEST['work_order_plan_id']  : -1 : -1;
				
				$where = array();
				$where['work_order_plan_id'] = $work_order_plan_id;
				if($id){
					if($id == -1){
						$limit = 1;
					} else {
						$where["id"] = $id;
					}
				} else {
					if($q){
						$where["value like '%". $q ."%' AND 1="] = 1;
					}
				}
				
				$order = "value asc";
				
				$data_table = $this->main->getData('dbo.view_list_work_order_detail_process', null, $where, null, $order , $limit, $offset);
				if($data_table){
					foreach($data_table as $key => $value){
						$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
					}
				}
				
				$return['results'] = $return;
			}
						
			if($param == 'get_bom_from_work_order'){
				$work_order_id = isset($_REQUEST['work_order_id']) ? is_numeric($_REQUEST['work_order_id']) ? $_REQUEST['work_order_id']  : -1 : -1;
				
				$where = array();
				$where['work_order_id'] = $work_order_id;
				if($id){
					if($id == -1){
						$limit = 1;
					} else {
						$where["id"] = $id;
					}
				} else {
					if($q){
						$where["value like '%". $q ."%' AND 1="] = 1;
					}
				}
				
				$order = "value asc";
				
				$data_table = $this->main->getData('dbo.view_list_bom_from_work_order', null, $where, null, $order , $limit, $offset);
				if($data_table){
					foreach($data_table as $key => $value){
						$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
					}
				}
				
				$return['results'] = $return;
			}
			
			if($param == 'get_bom'){
				$item_id = isset($_REQUEST['item_id']) ? is_numeric($_REQUEST['item_id']) ? $_REQUEST['item_id']  : -1 : -1;
				
				$where = array();
				if($id){
					if($id == -1){
						$where['fg_item_id'] = $item_id;
						$limit = 1;
					} else {
						$where["id"] = $id;
					}
				} else {
					$where['fg_item_id'] = $item_id;
					if($q){
						$where["value like '%". $q ."%' AND 1="] = 1;
					}
				}
				
				$order = "value asc";
				
				$data_table = $this->main->getData('dbo.view_list_bom', null, $where, null, $order , $limit, $offset);
				if($data_table){
					foreach($data_table as $key => $value){
						$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
					}
				}
				
				$return['results'] = $return;
			}
						
			if($param == 'get_grn_purchase'){
				$partner_id = isset($_REQUEST['partner_id']) ? is_numeric($_REQUEST['partner_id']) ? $_REQUEST['partner_id']  : -1 : -1;
				
				$where = array();
				$where['partner_id'] = $partner_id;
				if($id){
					if($id == -1){
						$limit = 1;
					} else {
						$where["id"] = $id;
					}
				} else {
					if($q){
						$where["value like '%". $q ."%' AND 1="] = 1;
					}
				}
				
				$order = "value asc";
				
				$data_table = $this->main->getData('dbo.view_list_grn_purchase', null, $where, null, $order , $limit, $offset);
				if($data_table){
					foreach($data_table as $key => $value){
						$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
					}
				}
				
				$return['results'] = $return;
			}
			
			if($param == 'get_delivery_sales'){
				$partner_id = isset($_REQUEST['partner_id']) ? is_numeric($_REQUEST['partner_id']) ? $_REQUEST['partner_id']  : -1 : -1;
				
				$where = array();
				$where['partner_id'] = $partner_id;
				if($id){
					if($id == -1){
						$limit = 1;
					} else {
						$where["id"] = $id;
					}
				} else {
					if($q){
						$where["value like '%". $q ."%' AND 1="] = 1;
					}
				}
				
				$order = "value asc";
				
				$data_table = $this->main->getData('dbo.view_list_delivery_sales', null, $where, null, $order , $limit, $offset);
				if($data_table){
					foreach($data_table as $key => $value){
						$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
					}
				}
				
				$return['results'] = $return;
			}
			
			if($param == 'get_supply_sales'){
				$partner_id = isset($_REQUEST['partner_id']) ? is_numeric($_REQUEST['partner_id']) ? $_REQUEST['partner_id']  : -1 : -1;
				
				$where = array();
				$where['partner_id'] = $partner_id;
				if($id){
					if($id == -1){
						$limit = 1;
					} else {
						$where["id"] = $id;
					}
				} else {
					if($q){
						$where["value like '%". $q ."%' AND 1="] = 1;
					}
				}
				
				$order = "value asc";
				
				$data_table = $this->main->getData('dbo.view_list_supply_sales', null, $where, null, $order , $limit, $offset);
				if($data_table){
					foreach($data_table as $key => $value){
						$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
					}
				}
				
				$return['results'] = $return;
			}
			
			if($param == 'get_gl_parent_group'){
				$gl_account_group_id = isset($_REQUEST['gl_account_group_id']) ? is_numeric($_REQUEST['gl_account_group_id']) ? $_REQUEST['gl_account_group_id']  : -2 : -2;
				$id = isset($_REQUEST['id']) ? is_numeric($_REQUEST['id']) ? $_REQUEST['id']  : -1 : -1;
				
				$where = array();
				if($gl_account_group_id != -2){
					$where['gl_account_group_id !='] = $gl_account_group_id;
				}				
				
				if($id){
					if($id == -1){
						$limit = 1;
					} else {
						$where["id"] = $id;
					}
					
					if($q){
						$where["value like '%". $q ."%' AND 1="] = 1;
					}
				} else {
					
					if($id == 0){
						$where["id"] = 0;
					}
					
					if($q){
						$where["value like '%". $q ."%' AND 1="] = 1;
					}
				}
				
				$order = "id asc";
				
				$data_table = $this->main->getData('dbo.view_list_gl_account_group_parent', null, $where, null, $order , null, $offset);
				
				if($data_table){
					foreach($data_table as $key => $value){
						$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
					}
				}
				
				$return['results'] = $return;
			}
			
			if($param == 'get_rate_data'){
				$currencies_id = isset($_REQUEST['currencies_id']) ? is_numeric($_REQUEST['currencies_id']) ? $_REQUEST['currencies_id']  : -2 : -2;
				$date = isset($_REQUEST['date']) ? $_REQUEST['date'] : '1900-01-01';
				
				$where = array();
				$where['currencies_date_start <='] = $date;
				$where['currencies_date_end >='] = $date;
				$where['currencies_id'] = $currencies_id;
					
				$home_currency = $this->session->userdata('home_currencies');
				if($home_currency == $currencies_id){
					$return[0]['rate'] = 1;
				} else {
					$data_table = $this->main->getData('dbo.view_currencies_rate', null, $where, null, null , 1);
					if($data_table){
						$return2 = $data_table;
						$return[0]['rate'] = $this->mainconfig->get_decimal_format2($return2[0]['currencies_rate'],8);
					} else {
						$return[0]['rate'] = 0;
					}
					
					$return['results'] = $return;
				}
			}
			
			if($param == 'get_contract_subcon'){
				$partner_id = isset($_REQUEST['partner_id']) ? is_numeric($_REQUEST['partner_id']) ? $_REQUEST['partner_id'] : -1: -1;
				
				$where = array();
				$where['partner_id'] = $partner_id;
				
				if($id){
					if($id == -1){
						$limit = 1;
					} else {
						$where["id"] = $id;
					}
				}
				
				if($q){
					$where["value like '%". $q ."%' AND 1="] = 1;
				}
				
				$order = "contract_subcon_date_start desc";
				
				$data_table = $this->main->getData('dbo.view_list_contract_subcon', null, $where, null, $order);
				if($data_table){
					foreach($data_table as $key => $value){
						$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
					}
				}
				
				$return['results'] = $return;
			}
			
			if($param == 'get_app_trans_no'){
				$app_trans_id = isset($_REQUEST['app_trans_id']) ? is_numeric($_REQUEST['app_trans_id']) ? $_REQUEST['app_trans_id'] : -1: -1;
				$return = "";
				
				$where = array();
				$where['app_trans_id'] = $app_trans_id;
								
				$order = null;
				
				$data_table = $this->main->getData('dbo.view_app_trans', null, $where, null, $order , 1);
				if($data_table){
					foreach($data_table as $key => $value){
						if(date('Ym',strtotime($value['app_trans_last_date'])) != date('Ym')){
							$app_trans_no = 0;
						} else {
							$app_trans_no = $value['app_trans_no'];
						}
						
						$app_trans_no++;
						
						$return .= $value['app_trans_prefix'];
						$return .= "-".date('Y/m/d');
						$return .= "-".str_pad($app_trans_no, 4, "0", STR_PAD_LEFT);
					}
				}
			}
		}
		
		if(isset($view_list[$param])){
			$where = array();
			
			if($id){
				if($id == -1){
					$limit = 1;
				} else {
					$where["id"] = $id;
				}
			} else {
				if($q){
					$where["value like '%". trim($q) ."%' AND 1="] = 1;
				}
			}
			
			if(isset($view_list[$param]['where'])){
				foreach($view_list[$param]['where'] as $key=>$value){
					$where[$value['field']] = $value['value'];
				}
			}
			
			if(isset($view_list[$param]['order'])){
				$order = $view_list[$param]['order'] ." asc";
			} else {
				$order = "value asc";
			}
			
			$data_table = $this->main->getData($view_list[$param]['view'], null, $where, null, $order , $limit, $offset);
			if($data_table){
				foreach($data_table as $key => $value){
					$return[] = array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
				}
			}
			
			$return['results'] = $return;
			
		}
		
		if(isset($data_list[$param])){
			$where = array();
			$return = array();
			
			if(isset($data_list[$param]['order'])){
				$order = $data_list[$param]['order'] ." asc";
			} else {
				$order = null;
			}
			
			if($id){
				if($id == -1){
					$limit = 1;
				} else {
					$where[$data_list[$param]['key']] = $id;
				}
				$data_table = $this->main->getData($data_list[$param]['view'], null, $where, null, $order , $limit, $offset);
				if($data_table){
					foreach($data_table as $key=>$data){
						foreach($data as $k=>$v){
							if(is_numeric($v)){
								if(substr(substr($v,-13),0,1) == '.'){
									$return[$key][$k] = $this->mainconfig->get_decimal_format3($v,12);
								} else {
									$return[$key][$k] = $v;
								}
							} else {
								$return[$key][$k] = $v;
							}
						}
					}
				}
				
				
				if(isset($data_list[$param]['view_detail'])){
					$where[$data_list[$param]['key']] = $id;
					$data_table = $this->main->getData($data_list[$param]['view_detail'], null, $where, null, $order , $limit, $offset);
					$return['detail'] = $data_table;
					if(isset($data_list[$param]['view_detail_session'])){
						if($data_table){
							$seq = 1;
							$session_data = array();
							foreach($data_table as $dt_table){
								$row[$data_list[$param]['detail_session_key']] = $seq;
								foreach($dt_table as $key=>$value){
									if(is_numeric($value)){
										if(substr(substr($value,-13),0,1) == '.'){
											$row[$key] = $this->mainconfig->get_decimal_format3($value,12);
										} else {
											$row[$key] = $value;
										}
									} else {
										$row[$key] = $value;
									}
								}
								
								$session_data[$seq] = $row;
								$seq++;
							}
							
							$newdata = array(
								$data_list[$param]['view_detail_session']  => $session_data
								,$data_list[$param]['detail_session_key']  => $seq
							);
							
							$this->session->set_userdata($newdata);	
						} else {
							$newdata = array(
								$data_list[$param]['view_detail_session']  => array()
								,$data_list[$param]['detail_session_key']  => 1
							);
							
							$this->session->set_userdata($newdata);	
						}
					}
				}
			}
		}
		
		if(in_array($param,$custom)){
			if(isset($custom_list[$param]['data'])){
				if(is_array($custom_list[$param]['data'])){
					foreach($custom_list[$param]['data'] as $key => $value){
						$return[] = array("id"=>$key,"value"=>$value);
					}
				}
			}
		}
		
		if(in_array($param,$data_session)){
			$where = array();
			
			if($id){
				
				$session_data = $this->session->userdata($data_session_list[$param]);
				
				$row_data = array();
				if(isset($session_data[$id])){
					// if(is_numeric($session_data[$id])){
						// $row_data[] = $this->mainconfig->get_decimal_format3($session_data[$id],12);
					// } else {
						$row_data[] = $session_data[$id];
					// }
				}
				
				$return = $row_data;
			}
		}
		
		
		echo json_encode($return);
	}
	
	function download_file() {
		$saveAs=isset($_POST['saveAs'])?$_POST['saveAs']:'';  
		$filename=isset($_POST['filename'])?$_POST['filename']:'';   
		$extension = strtolower( pathinfo( basename( $saveAs ), PATHINFO_EXTENSION ) );
		set_time_limit(0);

		// our list of mime types
		$mime_types = array(

		'txt' => 'text/plain',
		'htm' => 'text/html',
		'html' => 'text/html',
		'php' => 'text/html',
		'css' => 'text/css',
		'js' => 'application/javascript',
		'json' => 'application/json',
		'xml' => 'application/xml',
		'swf' => 'application/x-shockwave-flash',
		'flv' => 'video/x-flv',

		// images
		'png' => 'image/png',
		'jpe' => 'image/jpeg',
		'jpeg' => 'image/jpeg',
		'jpg' => 'image/jpeg',
		'gif' => 'image/gif',
		'bmp' => 'image/bmp',
		'ico' => 'image/vnd.microsoft.icon',
		'tiff' => 'image/tiff',
		'tif' => 'image/tiff',
		'svg' => 'image/svg+xml',
		'svgz' => 'image/svg+xml',

		// archives
		'zip' => 'application/zip',
		'rar' => 'application/x-rar-compressed',
		'exe' => 'application/x-msdownload',
		'msi' => 'application/x-msdownload',
		'cab' => 'application/vnd.ms-cab-compressed',

		// audio/video
		'mp3' => 'audio/mpeg',
		'qt' => 'video/quicktime',
		'mov' => 'video/quicktime',

		// adobe
		'pdf' => 'application/pdf',
		'psd' => 'image/vnd.adobe.photoshop',
		'ai' => 'application/postscript',
		'eps' => 'application/postscript',
		'ps' => 'application/postscript',

		// ms office
		'doc' => 'application/msword',
		'rtf' => 'application/rtf',
		'xls' => 'application/vnd.ms-excel',
		'ppt' => 'application/vnd.ms-powerpoint',

		// open office
		'odt' => 'application/vnd.oasis.opendocument.text',
		'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
		);

		// Set a default mime if we can't find it
		if( !isset( $mime_types[$extension] ) )
		{
		$mime = 'application/octet-stream';
		}
		else
		{
		$mime = ( is_array( $mime_types[$extension] ) ) ? $mime_types[$extension][0] : $mime_types[$extension];
		}

		if(file_exists($filename)) {
		
				if( strstr( $_SERVER['HTTP_USER_AGENT'], "MSIE" ) )
				{
					header("Content-Type: application/force-download");
					header( 'Content-Type: "'.$mime.'"' );
					header("Content-Disposition: attachment; filename=\"".basename($saveAs)."\";" ); 
					header( 'Expires: 0' );
					header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
					header( "Content-Transfer-Encoding: binary" );
					header( 'Pragma: public' );
					header( "Content-Length: ".filesize( $filename ) );
				}
				else
				{
					header( "Pragma: public" );
					header( "Expires: 0" );
					header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
					header( "Cache-Control: private", false );
					header("Content-Type: application/force-download");
					header( "Content-Type: ".$mime, true, 200 );
					header("Content-Type: application/download");
					header( 'Content-Length: '.filesize( $filename ) );
					header("Content-Disposition: attachment; filename=\"".basename($saveAs)."\";" ); 
					header( "Content-Transfer-Encoding: binary" );
				}
		
				flush(); // this doesn't really matter.
				$fp = fopen($filename, "r");
				while (!feof($fp))
				{
					echo fread($fp, 65536);
					flush(); // this is essential for large downloads
				} 
				fclose($fp); 
				exit("ok");
		}
		else {
			die('The provided file path: ' . $filename .' is not valid.');
		}  
	}	
}

?>