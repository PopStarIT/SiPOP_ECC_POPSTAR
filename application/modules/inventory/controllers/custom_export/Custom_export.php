<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Custom_export extends CI_Controller { 
	function __construct(){ 
		parent::__construct(); 
		
		$this->data_request = $_REQUEST;
		
		$module = $this->router->module;
		$directory = $this->router->directory;
		$class = $this->router->class;
		$method = $this->router->method;
		$directory = trim(str_replace('../modules/'.$module ,'',str_replace('/controllers/','',$directory)),'/');
		
		$this->module = $module;
		if(trim($directory) != ''){
			$this->directory = $directory;
		} else {
			$this->directory = '0';
			$this->directory2 = '';
		}
		$this->class = $class;
		$this->method = $method;
	}
	
	function custom_export_table() {
		$view = 'view_custom_export';
		$get_field = $this->ecc_library->get_field($view);
		
		$get_field['r1']['hidden'] = true;
		$get_field['r2']['hidden'] = true;
		$get_field['r3']['hidden'] = true;
		
		$get_field['r16']['hidden'] = true;
		$get_field['r17']['hidden'] = true;
		$get_field['r18']['hidden'] = true;
		$get_field['r19']['hidden'] = true;
		$get_field['r20']['hidden'] = true;
		$get_field['r21']['hidden'] = true;
		$get_field['r22']['hidden'] = true;
		$get_field['r23']['hidden'] = true;
		$get_field['r24']['hidden'] = true;
		$get_field['r25']['hidden'] = true;
		$get_field['r26']['hidden'] = true;
		$get_field['r27']['hidden'] = true;
		$get_field['r28']['hidden'] = true;
		$get_field['r29']['hidden'] = true;
		$get_field['r30']['hidden'] = true;
		$get_field['r31']['hidden'] = true;
		$get_field['r32']['hidden'] = true;
		$get_field['r33']['hidden'] = true;
		$get_field['r34']['hidden'] = true;
		$get_field['r35']['hidden'] = true;
		$get_field['r36']['hidden'] = true;
		$get_field['r37']['hidden'] = true;
		$get_field['r38']['hidden'] = true;
		$get_field['r39']['hidden'] = true;
		$get_field['r40']['hidden'] = true;
		$get_field['r41']['hidden'] = true;
		$get_field['r42']['hidden'] = true;
		$get_field['r43']['hidden'] = true;
		$get_field['r44']['hidden'] = true;
		$get_field['r45']['hidden'] = true;
		$get_field['r46']['hidden'] = true;
		$get_field['r47']['hidden'] = true;
		$get_field['r48']['hidden'] = true;
		
		return $get_field;
	}
	
	function custom_export_detail_table() {
		$view = 'view_custom_export_detail';
		$get_field = $this->ecc_library->get_field($view);
		
		$get_field['r1']['hidden'] = true;
		$get_field['r2']['hidden'] = true;
		$get_field['r18']['hidden'] = true;
		$get_field['r19']['hidden'] = true;
		$get_field['r20']['hidden'] = true;
		$get_field['r21']['hidden'] = true;
		$get_field['r22']['hidden'] = true;
		$get_field['r23']['hidden'] = true;
		$get_field['r24']['hidden'] = true;
		$get_field['r25']['hidden'] = true;
		$get_field['r26']['hidden'] = true;
		$get_field['r27']['hidden'] = true;
		$get_field['r28']['hidden'] = true;
		$get_field['r29']['hidden'] = true;
		$get_field['r30']['hidden'] = true;
				
		$get_field['act']['sc'] = 'act';
		$get_field['act']['title'] = '#';
		$get_field['act']['bypassvalue'] = '';
		$get_field['act']['ctype'] = 'text';
		$get_field['act']['align'] = 'center';
		$get_field['act']['search'] = false;
		$get_field['act']['sortable'] = false;
		$get_field['act']['formatter'] = 'formatOperations';
		$get_field['act']['width'] = 300;
		
		return $get_field;
	}
	
	function custom_export_detail_supply_table() {
		$view = 'view_custom_export_detail_supply';
		$get_field = $this->ecc_library->get_field($view);
		
		$get_field['r1']['hidden'] = true;
		$get_field['r2']['hidden'] = true;
		
		return $get_field;
	}
	
	function custom_export_transfer_item_table() {
		$view = 'view_stock_move_item_bc_out';
		$get_field = $this->ecc_library->get_field($view);
		
		$get_field['r1']['hidden'] = true;
		$get_field['r2']['hidden'] = true;
		
		return $get_field;
	}
	
	function custom_export_supply_item_table() {
		$view = 'view_stock_move_supply_bc_out';
		$get_field = $this->ecc_library->get_field($view);
		
		$get_field['r1']['hidden'] = true;
		$get_field['r2']['hidden'] = true;
		$get_field['r3']['hidden'] = true;
		
		$get_field['r14']['hidden'] = true;
		
		return $get_field;
	}
	
	function config_dashboard_table(){
		$dashboard_table = array();
		
		$field = $this->custom_export_table();
		$field_detail = $this->custom_export_detail_table();
		$field_detail_supply = $this->custom_export_detail_supply_table();
		$field_transfer_item = $this->custom_export_transfer_item_table();
		$field_supply_item = $this->custom_export_supply_item_table();
		
		$dashboard_table['field'] = $field;
		$dashboard_table['field_detail'] = $field_detail;
		$dashboard_table['field_detail_supply'] = $field_detail_supply;
		$dashboard_table['field_detail_loaddata'] = 'loaddata_detail';
		$dashboard_table['field_detail_supply_loaddata'] = 'loaddata_detail_supply';
		$dashboard_table['field_transfer_item'] = $field_transfer_item;
		$dashboard_table['field_transfer_item_loaddata'] = 'loaddata_transfer_item';
		$dashboard_table['field_supply_item'] = $field_supply_item;
		$dashboard_table['field_supply_item_loaddata'] = 'loaddata_supply_item';
		
		return $dashboard_table;
	}
	
	function index(){
		$this->load->model('main');
		$component['loadlayout'] = true;
		$component['view_load'] = 'custom_export/view';
		$component['view_load_form'] = 'custom_export/form';
		$component['load_js'][] = 'custom_export/view';
		$component['load_js'][] = 'custom_export/form';
				
		$dashboard_table = array();
		
		$nav_button = array();
		$nav_button[] = array('method_id' => 141,'title' => 'Add', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add');
		$nav_button[] = array('method_id' => 149,'title' => 'Add From Request', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add_from_request');
		$nav_button[] = array('method_id' => 142,'title' => 'Edit', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_edit');
		$nav_button[] = array('method_id' => 144,'title' => 'Approve', 'icon' => 'fa fa-check', 'load' => 'custom_export/function_approve');
		$nav_button[] = array('method_id' => 143,'title' => 'Delete', 'icon' => 'fa fa-trash-o', 'load' => 'custom_export/function_delete');
		
		$field = $this->custom_export_table();
		
		$dashboard_table['nav_button'] = $nav_button;
		$dashboard_table['field'] = $field;
		$dashboard_table['nav_button'] = $nav_button;
		$component['dashboard_table'] = $dashboard_table;
		
		$this->authentication->ajaxlayout($component);
	}
	
	function bc24(){
		$this->load->model('main');
		$custom_type_id = 6;
		
		$component['loadlayout'] = true;
		
		$component['view_load'] = 'custom_export/view';
		$component['view_load_form'] = 'custom_export/form';
		$component['load_js'][] = 'custom_export/view';
		$component['load_js'][] = 'custom_export/form';
		
		
		$component['custom_type_id'] = $custom_type_id;
		$component['search_param'] = 'custom_type_id';
		$component['search_param_value'] = $custom_type_id;
		$component['page_title'] = 'BC 2.4';
		
		$nav_button = array();
		$nav_button[] = array('method_id' => 267,'title' => 'New', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add');
		$nav_button[] = array('method_id' => 271,'title' => 'New From Proforma', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add_from_performa');
		$nav_button[] = array('method_id' => 268,'title' => 'Edit', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_edit');
		$nav_button[] = array('method_id' => 595,'title' => 'Supply', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_supply');
		$nav_button[] = array('method_id' => 270,'title' => 'Approve', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_approve');
		$nav_button[] = array('method_id' => 269,'title' => 'Delete', 'icon' => 'fa fa-trash-o', 'load' => 'custom_export/function_delete');
		$nav_button[] = array('method_id' => 762,'title' => 'Cancel Approve', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_cancel_approve');
		
		$dashboard_table = $this->config_dashboard_table();
		
		$extra_data = array();
		$extra_data['custom_type_id'] = $custom_type_id;
		$dashboard_table['extra_data'] = $extra_data;
		$dashboard_table['nav_button'] = $nav_button;
		$component['dashboard_table'] = $dashboard_table;
		
		$this->authentication->ajaxlayout($component);
	}
	
	function bc25(){
		$this->load->model('main');
		$custom_type_id = 7;
		
		$component['loadlayout'] = true;
		
		$component['view_load'] = 'custom_export/view';
		$component['view_load_form'] = 'custom_export/form';
		$component['load_js'][] = 'custom_export/view';
		$component['load_js'][] = 'custom_export/form';
		
		
		$component['custom_type_id'] = $custom_type_id;
		$component['search_param'] = 'custom_type_id';
		$component['search_param_value'] = $custom_type_id;
		$component['page_title'] = 'BC 2.5';
		
		$nav_button = array();
		$nav_button[] = array('method_id' => 273,'title' => 'New', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add');
		$nav_button[] = array('method_id' => 277,'title' => 'New From Proforma', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add_from_performa');
		$nav_button[] = array('method_id' => 278,'title' => 'New From Sales', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add_from_sales');
		$nav_button[] = array('method_id' => 274,'title' => 'Edit', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_edit');
		$nav_button[] = array('method_id' => 596,'title' => 'Supply', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_supply');
		$nav_button[] = array('method_id' => 276,'title' => 'Approve', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_approve');
		$nav_button[] = array('method_id' => 275,'title' => 'Delete', 'icon' => 'fa fa-trash-o', 'load' => 'custom_export/function_delete');
		$nav_button[] = array('method_id' => 763,'title' => 'Cancel Approve', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_cancel_approve');
		$nav_button[] = array('method_id' => 759,'title' => 'Send To TPB Ceisa', 'icon' => 'fa fa-upload', 'load' => 'custom_export/function_ceisa_send');
		$nav_button[] = array('method_id' => 760,'title' => 'Get Register No', 'icon' => 'fa fa-download', 'load' => 'custom_export/function_ceisa_get_respon');
		$nav_button[] = array('method_id' => 761,'title' => 'Cancel Send', 'icon' => 'fa fa-cross', 'load' => 'custom_export/function_ceisa_cancel_send');
		
		$dashboard_table = $this->config_dashboard_table();
		
		$extra_data = array();
		$extra_data['custom_type_id'] = $custom_type_id;
		$dashboard_table['extra_data'] = $extra_data;
		$dashboard_table['nav_button'] = $nav_button;
		$component['dashboard_table'] = $dashboard_table;
		
		$this->authentication->ajaxlayout($component);
	}
	
	function bc261(){
		$this->load->model('main');
		$custom_type_id = 8;
		
		$component['loadlayout'] = true;
		
		$component['view_load'] = 'custom_export/view';
		$component['view_load_form'] = 'custom_export/form';
		$component['load_js'][] = 'custom_export/view';
		$component['load_js'][] = 'custom_export/form';
		
		
		$component['custom_type_id'] = $custom_type_id;
		$component['search_param'] = 'custom_type_id';
		$component['search_param_value'] = $custom_type_id;
		$component['page_title'] = 'BC 2.6.1';
		
		$nav_button = array();
		$nav_button[] = array('method_id' => 279,'title' => 'New', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add');
		$nav_button[] = array('method_id' => 283,'title' => 'New From Proforma', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add_from_performa');
		$nav_button[] = array('method_id' => 602,'title' => 'New From Contract Subcon', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add_from_contract_subcon');
		$nav_button[] = array('method_id' => 280,'title' => 'Edit', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_edit');
		$nav_button[] = array('method_id' => 597,'title' => 'Supply', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_supply');
		$nav_button[] = array('method_id' => 282,'title' => 'Approve', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_approve');
		$nav_button[] = array('method_id' => 281,'title' => 'Delete', 'icon' => 'fa fa-trash-o', 'load' => 'custom_export/function_delete');
		$nav_button[] = array('method_id' => 764,'title' => 'Cancel Approve', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_cancel_approve');
		$nav_button[] = array('method_id' => 759,'title' => 'Send To TPB Ceisa', 'icon' => 'fa fa-upload', 'load' => 'custom_export/function_ceisa_send');
		$nav_button[] = array('method_id' => 760,'title' => 'Get Register No', 'icon' => 'fa fa-download', 'load' => 'custom_export/function_ceisa_get_respon');
		$nav_button[] = array('method_id' => 761,'title' => 'Cancel Send', 'icon' => 'fa fa-cross', 'load' => 'custom_export/function_ceisa_cancel_send');
		
		$dashboard_table = $this->config_dashboard_table();
		
		$extra_data = array();
		$extra_data['custom_type_id'] = $custom_type_id;
		$dashboard_table['extra_data'] = $extra_data;
		$dashboard_table['nav_button'] = $nav_button;
		$component['dashboard_table'] = $dashboard_table;
		
		$this->authentication->ajaxlayout($component);
	}
	
	function bc27(){
		$this->load->model('main');
		$custom_type_id = 9;
		
		$component['loadlayout'] = true;
		
		$component['view_load'] = 'custom_export/view';
		$component['view_load_form'] = 'custom_export/form';
		$component['load_js'][] = 'custom_export/view';
		$component['load_js'][] = 'custom_export/form';
		
		
		$component['custom_type_id'] = $custom_type_id;
		$component['search_param'] = 'custom_type_id';
		$component['search_param_value'] = $custom_type_id;
		$component['page_title'] = 'BC 2.7';
		
		$nav_button = array();
		$nav_button[] = array('method_id' => 285,'title' => 'New', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add');
		$nav_button[] = array('method_id' => 289,'title' => 'New From Proforma', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add_from_performa');
		$nav_button[] = array('method_id' => 603,'title' => 'New From Contract Subcon', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add_from_contract_subcon');
		$nav_button[] = array('method_id' => 286,'title' => 'Edit', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_edit');
		$nav_button[] = array('method_id' => 598,'title' => 'Supply', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_supply');
		$nav_button[] = array('method_id' => 288,'title' => 'Approve', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_approve');
		$nav_button[] = array('method_id' => 287,'title' => 'Delete', 'icon' => 'fa fa-trash-o', 'load' => 'custom_export/function_delete');
		$nav_button[] = array('method_id' => 765,'title' => 'Cancel Approve', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_cancel_approve');
		$nav_button[] = array('method_id' => 759,'title' => 'Send To TPB Ceisa', 'icon' => 'fa fa-upload', 'load' => 'custom_export/function_ceisa_send');
		$nav_button[] = array('method_id' => 760,'title' => 'Get Register No', 'icon' => 'fa fa-download', 'load' => 'custom_export/function_ceisa_get_respon');
		$nav_button[] = array('method_id' => 761,'title' => 'Cancel Send', 'icon' => 'fa fa-cross', 'load' => 'custom_export/function_ceisa_cancel_send');
		
		$dashboard_table = $this->config_dashboard_table();
		
		$extra_data = array();
		$extra_data['custom_type_id'] = $custom_type_id;
		$dashboard_table['extra_data'] = $extra_data;
		$dashboard_table['nav_button'] = $nav_button;
		$component['dashboard_table'] = $dashboard_table;
		
		$this->authentication->ajaxlayout($component);
	}
	
	function bc30(){
		$this->load->model('main');
		$custom_type_id = 10;
		
		$component['loadlayout'] = true;
		
		$component['view_load'] = 'custom_export/view';
		$component['view_load_form'] = 'custom_export/form';
		$component['load_js'][] = 'custom_export/view';
		$component['load_js'][] = 'custom_export/form';
		
		
		$component['custom_type_id'] = $custom_type_id;
		$component['search_param'] = 'custom_type_id';
		$component['search_param_value'] = $custom_type_id;
		$component['page_title'] = 'BC 3.0';
		
		$nav_button = array();
		$nav_button[] = array('method_id' => 291,'title' => 'New', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add');
		$nav_button[] = array('method_id' => 295,'title' => 'New From Proforma', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add_from_performa');
		$nav_button[] = array('method_id' => 604,'title' => 'New From Contract Subcon', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add_from_contract_subcon');
		$nav_button[] = array('method_id' => 292,'title' => 'Edit', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_edit');
		$nav_button[] = array('method_id' => 599,'title' => 'Supply', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_supply');
		$nav_button[] = array('method_id' => 294,'title' => 'Approve', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_approve');
		$nav_button[] = array('method_id' => 293,'title' => 'Delete', 'icon' => 'fa fa-trash-o', 'load' => 'custom_export/function_delete');
		$nav_button[] = array('method_id' => 766,'title' => 'Cancel Approve', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_cancel_approve');
		$nav_button[] = array('method_id' => 1019,'title' => 'Send To Module', 'icon' => 'fa fa-upload', 'load' => 'custom_export/function_peb_send');
		$nav_button[] = array('method_id' => 1020,'title' => 'Get Register No PEB', 'icon' => 'fa fa-download', 'load' => 'custom_export/function_peb_get_respon');
		$nav_button[] = array('method_id' => 1021,'title' => 'Cancel Send Module', 'icon' => 'fa fa-cross', 'load' => 'custom_export/function_peb_cancel_send');
		
		$dashboard_table = $this->config_dashboard_table();
		
		$extra_data = array();
		$extra_data['custom_type_id'] = $custom_type_id;
		$dashboard_table['extra_data'] = $extra_data;
		$dashboard_table['nav_button'] = $nav_button;
		$component['dashboard_table'] = $dashboard_table;
		
		$this->authentication->ajaxlayout($component);
	}
	
	function bc33(){
		$this->load->model('main');
		$custom_type_id = 11;
		
		$component['loadlayout'] = true;
		
		$component['view_load'] = 'custom_export/view';
		$component['view_load_form'] = 'custom_export/form';
		$component['load_js'][] = 'custom_export/view';
		$component['load_js'][] = 'custom_export/form';
		
		
		$component['custom_type_id'] = $custom_type_id;
		$component['search_param'] = 'custom_type_id';
		$component['search_param_value'] = $custom_type_id;
		$component['page_title'] = 'BC 3.3';
		
		$nav_button = array();
		$nav_button[] = array('method_id' => 297,'title' => 'New', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add');
		$nav_button[] = array('method_id' => 301,'title' => 'New From Proforma', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add_from_performa');
		$nav_button[] = array('method_id' => 605,'title' => 'New From Contract Subcon', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add_from_contract_subcon');
		$nav_button[] = array('method_id' => 298,'title' => 'Edit', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_edit');
		$nav_button[] = array('method_id' => 600,'title' => 'Supply', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_supply');
		$nav_button[] = array('method_id' => 300,'title' => 'Approve', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_approve');
		$nav_button[] = array('method_id' => 299,'title' => 'Delete', 'icon' => 'fa fa-trash-o', 'load' => 'custom_export/function_delete');
		$nav_button[] = array('method_id' => 767,'title' => 'Cancel Approve', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_cancel_approve');
		
		$dashboard_table = $this->config_dashboard_table();
		
		$extra_data = array();
		$extra_data['custom_type_id'] = $custom_type_id;
		$dashboard_table['extra_data'] = $extra_data;
		$dashboard_table['nav_button'] = $nav_button;
		$component['dashboard_table'] = $dashboard_table;
		
		$this->authentication->ajaxlayout($component);
	}
	
	function bc41(){
		$this->load->model('main');
		$custom_type_id = 12;
		
		$component['loadlayout'] = true;
		
		$component['view_load'] = 'custom_export/view';
		$component['view_load_form'] = 'custom_export/form';
		$component['load_js'][] = 'custom_export/view';
		$component['load_js'][] = 'custom_export/form';
		
		
		$component['custom_type_id'] = $custom_type_id;
		$component['search_param'] = 'custom_type_id';
		$component['search_param_value'] = $custom_type_id;
		$component['page_title'] = 'BC 4.1';
		
		$nav_button = array();
		$nav_button[] = array('method_id' => 303,'title' => 'New', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add');
		$nav_button[] = array('method_id' => 307,'title' => 'New From Proforma', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add_from_performa');
		$nav_button[] = array('method_id' => 308,'title' => 'New From Contract Subcon', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add_from_contract_subcon');
		$nav_button[] = array('method_id' => 304,'title' => 'Edit', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_edit');
		$nav_button[] = array('method_id' => 601,'title' => 'Supply', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_supply');
		$nav_button[] = array('method_id' => 306,'title' => 'Approve', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_approve');
		$nav_button[] = array('method_id' => 305,'title' => 'Delete', 'icon' => 'fa fa-trash-o', 'load' => 'custom_export/function_delete');
		$nav_button[] = array('method_id' => 768,'title' => 'Cancel Approve', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_cancel_approve');	
		$nav_button[] = array('method_id' => 759,'title' => 'Send To TPB Ceisa', 'icon' => 'fa fa-upload', 'load' => 'custom_export/function_ceisa_send');
		$nav_button[] = array('method_id' => 760,'title' => 'Get Register No', 'icon' => 'fa fa-download', 'load' => 'custom_export/function_ceisa_get_respon');
		$nav_button[] = array('method_id' => 761,'title' => 'Cancel Send', 'icon' => 'fa fa-cross', 'load' => 'custom_export/function_ceisa_cancel_send');
		
		$dashboard_table = $this->config_dashboard_table();
		
		$extra_data = array();
		$extra_data['custom_type_id'] = $custom_type_id;
		$dashboard_table['extra_data'] = $extra_data;
		$dashboard_table['nav_button'] = $nav_button;
		$component['dashboard_table'] = $dashboard_table;
		
		$this->authentication->ajaxlayout($component);
	}
	
	function pemusnahan(){
		$this->load->model('main');
		$custom_type_id = 13;
		
		$component['loadlayout'] = true;
		
		$component['view_load'] = 'custom_export/view';
		$component['view_load_form'] = 'custom_export/form';
		$component['load_js'][] = 'custom_export/view';
		$component['load_js'][] = 'custom_export/form';
		
		
		$component['custom_type_id'] = $custom_type_id;
		$component['search_param'] = 'custom_type_id';
		$component['search_param_value'] = $custom_type_id;
		$component['page_title'] = 'Disposal';
		
		$nav_button = array();
		$nav_button[] = array('method_id' => 309,'title' => 'New', 'icon' => 'fa fa-plus', 'load' => 'custom_export/function_add');
		$nav_button[] = array('method_id' => 310,'title' => 'Edit', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_edit');
		$nav_button[] = array('method_id' => 601,'title' => 'Supply', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_supply');
		$nav_button[] = array('method_id' => 312,'title' => 'Approve', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_approve');
		$nav_button[] = array('method_id' => 311,'title' => 'Delete', 'icon' => 'fa fa-trash-o', 'load' => 'custom_export/function_delete');
		$nav_button[] = array('method_id' => 769,'title' => 'Cancel Approve', 'icon' => 'fa fa-pencil', 'load' => 'custom_export/function_cancel_approve');
		
		$dashboard_table = $this->config_dashboard_table();
		
		$extra_data = array();
		$extra_data['custom_type_id'] = $custom_type_id;
		$dashboard_table['extra_data'] = $extra_data;
		$dashboard_table['nav_button'] = $nav_button;
		$component['dashboard_table'] = $dashboard_table;
		
		$this->authentication->ajaxlayout($component);
	}
	
	function loaddata() {
		$this->authentication->plainlayout();
		
		$custom_type_id = isset($_REQUEST['custom_type_id']) ? is_numeric($_REQUEST['custom_type_id']) ? $_REQUEST['custom_type_id']  : -1 : -1;
		
		$view = 'view_custom_export';
		$field = $this->custom_export_table();
		
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";
 
		$extra_param = array();
		$extra_param['where']['0']['field'] = 'r2';
		$extra_param['where']['0']['data'] = $custom_type_id;
		
		$loaddata = $this->ecc_library->get_field_data($view,$field,$extra_param);
			
		echo $loaddata;
	}
		
	function approve(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$bc_out_header_id = isset($_POST['bc_out_header_id']) ? $_POST['bc_out_header_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			
			if($bc_out_header_id){
				$this->rpc_service_portal->setSP("dbo.sp_custom_export_approve");
				$this->rpc_service_portal->addField('bc_out_header_id',$bc_out_header_id);
			}
					
			$result = $this->rpc_service_portal->resultJSON();
			// print_r($result);
			
			$data = array();
			if(isset($result)){
				if(isset($result['valid'])){
					if($result['valid']){
						if(isset($result['data'])){
							$return['valid'] = $result['valid'];
							$return['status_code'] = $result['no'];
							$return['message'] = $result['des'];
						}
					} else {
						$return['status_code'] = $result['no'];
						$return['message'] = $result['des'];
					}
				}
			}
			
		} else {
			$return['valid'] = false;
			$return['message'] = "Session expired";
		}
		
		echo json_encode($return);
	}
	
	function cancel_approve(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$bc_out_header_id = isset($_POST['bc_out_header_id']) ? $_POST['bc_out_header_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			
			if($bc_out_header_id){
				$this->rpc_service_portal->setSP("dbo.sp_custom_export_cancel_approve");
				$this->rpc_service_portal->addField('bc_out_header_id',$bc_out_header_id);
			}
					
			$result = $this->rpc_service_portal->resultJSON();
			// print_r($result);
			
			$data = array();
			if(isset($result)){
				if(isset($result['valid'])){
					if($result['valid']){
						if(isset($result['data'])){
							$return['valid'] = $result['valid'];
							$return['status_code'] = $result['no'];
							$return['message'] = $result['des'];
						}
					} else {
						$return['status_code'] = $result['no'];
						$return['message'] = $result['des'];
					}
				}
			}
			
		} else {
			$return['valid'] = false;
			$return['message'] = "Session expired";
		}
		
		echo json_encode($return);
	}
	
	function delete(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$bc_out_header_id = isset($_POST['bc_out_header_id']) ? $_POST['bc_out_header_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			
			if($bc_out_header_id){
				$this->rpc_service_portal->setSP("dbo.sp_custom_export_delete");
				$this->rpc_service_portal->addField('bc_out_header_id',$bc_out_header_id);
			}
					
			$result = $this->rpc_service_portal->resultJSON();
			// print_r($result);
			
			$data = array();
			if(isset($result)){
				if(isset($result['valid'])){
					if($result['valid']){
						if(isset($result['data'])){
							$return['valid'] = $result['valid'];
							$return['status_code'] = $result['no'];
							$return['message'] = $result['des'];
						}
					} else {
						$return['status_code'] = $result['no'];
						$return['message'] = $result['des'];
					}
				}
			}
			
		} else {
			$return['valid'] = false;
			$return['message'] = "Session expired";
		}
		
		echo json_encode($return);
	}
		
	function post_add_edit(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$bc_out_header_id = isset($_POST['bc_out_header_id']) ? $_POST['bc_out_header_id'] : '';
		$custom_type_id = isset($_POST['custom_type_id']) ? $_POST['custom_type_id'] : '';
		$bc_out_type_id = isset($_POST['bc_out_type_id']) ? $_POST['bc_out_type_id'] : '';
		$car = isset($_POST['car']) ? $_POST['car'] : '';
		$bc_no = isset($_POST['bc_no']) ? $_POST['bc_no'] : '';
		$bc_date = isset($_POST['bc_date']) ? $_POST['bc_date'] : '';
		$partner_id = isset($_POST['partner_id']) ? $_POST['partner_id'] : '';
		$vendor_partner_id = isset($_POST['vendor_partner_id']) ? $_POST['vendor_partner_id'] : '';
		$currencies_id = isset($_POST['currencies_id']) ? $_POST['currencies_id'] : '';
		$sales_performa_id = isset($_POST['sales_performa_id']) ? $_POST['sales_performa_id'] : '';
		$sales_order_id = isset($_POST['sales_order_id']) ? $_POST['sales_order_id'] : '';
		$contract_subcon = isset($_POST['contract_subcon']) ? $_POST['contract_subcon'] : '';
		
		$muat_kppbc_id = isset($_POST['muat_kppbc_id']) ? $_POST['muat_kppbc_id'] : '';
		$kppbc_id = isset($_POST['kppbc_id']) ? $_POST['kppbc_id'] : '';
		$jenis_ekspor_id = isset($_POST['jenis_ekspor_id']) ? $_POST['jenis_ekspor_id'] : '';
		$kategori_ekspor_id = isset($_POST['kategori_ekspor_id']) ? $_POST['kategori_ekspor_id'] : '';
		$cara_perdagangan_id = isset($_POST['cara_perdagangan_id']) ? $_POST['cara_perdagangan_id'] : '';
		$cara_pembayaran_id = isset($_POST['cara_pembayaran_id']) ? $_POST['cara_pembayaran_id'] : '';
		$cara_angkut_id = isset($_POST['cara_angkut_id']) ? $_POST['cara_angkut_id'] : '';
		$nama_pengangkut = isset($_POST['nama_pengangkut']) ? $_POST['nama_pengangkut'] : false;
		$nama_pengangkut2 = isset($_POST['nama_pengangkut2']) ? $_POST['nama_pengangkut2'] : '';
		if(strlen(trim($nama_pengangkut)) == 0){
			$nama_pengangkut = $nama_pengangkut2;
		}
		$kode_bendera = isset($_POST['kode_bendera']) ? $_POST['kode_bendera'] : '';
		$nomor_voy_flight = isset($_POST['nomor_voy_flight']) ? $_POST['nomor_voy_flight'] : '';
		$tanggal_perkiraan_ekspor = isset($_POST['tanggal_perkiraan_ekspor']) ? $_POST['tanggal_perkiraan_ekspor'] : '';
		$ndpbm = isset($_POST['ndpbm']) ? $_POST['ndpbm'] : 1;
		$price_type_id = isset($_POST['price_type_id']) ? $_POST['price_type_id'] : '';
		$amount_origin = isset($_POST['amount_origin']) ? $_POST['amount_origin'] : '';
		$insurance_type_id = isset($_POST['insurance_type_id']) ? $_POST['insurance_type_id'] : '';
		$amount_insurance = isset($_POST['amount_insurance']) ? $_POST['amount_insurance'] : '';
		$amount_freight = isset($_POST['amount_freight']) ? $_POST['amount_freight'] : '';
		$maklon = isset($_POST['maklon']) ? $_POST['maklon'] : '';
		$muat_port_id = isset($_POST['muat_port_id']) ? $_POST['muat_port_id'] : '';
		$muat2_port_id = isset($_POST['muat2_port_id']) ? $_POST['muat2_port_id'] : '';
		$bongkar_port_id = isset($_POST['bongkar_port_id']) ? $_POST['bongkar_port_id'] : '';
		$tujuan_port_id = isset($_POST['tujuan_port_id']) ? $_POST['tujuan_port_id'] : '';
		$tujuan_country_id = isset($_POST['tujuan_country_id']) ? $_POST['tujuan_country_id'] : '';
		
		$jenis_tpb_id = isset($_POST['jenis_tpb_id']) ? $_POST['jenis_tpb_id'] : '';
		$tujuan_jenis_tpb_id = isset($_POST['tujuan_jenis_tpb_id']) ? $_POST['tujuan_jenis_tpb_id'] : '';
		$tujuan_pengiriman_id = isset($_POST['tujuan_pengiriman_id']) ? $_POST['tujuan_pengiriman_id'] : '';
		$nomor_polisi = isset($_POST['nomor_polisi']) ? $_POST['nomor_polisi'] : '';
		
		$sales_performa = explode(',',$sales_performa_id);
		$sales_order = explode(',',$sales_order_id);
		$contract_subcon = explode(',',$contract_subcon);
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			if($bc_out_header_id){
				$this->rpc_service_portal->setSP("dbo.sp_custom_export_edit");
				$this->rpc_service_portal->addField('bc_out_header_id',$bc_out_header_id);
			} else {
				switch($bc_out_type_id){
					case '1':
						$this->rpc_service_portal->setSP("dbo.sp_custom_export_add");
					break;
					
					case '2':
						$this->rpc_service_portal->setSP("dbo.sp_custom_export_add_from_performa");
						
						foreach($sales_performa as $dt_data){
							$data = array('sales_performa_id'=>$dt_data);
							$this->rpc_service_portal->addAttributeChild('dt' ,$data);
						}
					break;
					
					case '3':
						$this->rpc_service_portal->setSP("dbo.sp_custom_export_add_from_sales");
						
						foreach($sales_order as $dt_data){
							$data = array('sales_order_id'=>$dt_data);
							$this->rpc_service_portal->addAttributeChild('dt' ,$data);
						}
					break;
					
					case '4':
						$this->rpc_service_portal->setSP("dbo.sp_custom_export_add_from_contract_subcon");
						
						foreach($contract_subcon as $dt_data){
							$data = array('contract_subcon_id'=>$dt_data);
							$this->rpc_service_portal->addAttributeChild('dt' ,$data);
						}
						
					break;
					
					default:
						$this->rpc_service_portal->setSP("dbo.sp_custom_export_add");
					break;
				}
			}			
						
			$this->rpc_service_portal->addField('custom_type_id',$custom_type_id);
			$this->rpc_service_portal->addField('bc_out_type_id',$bc_out_type_id);
			$this->rpc_service_portal->addField('car',$car);
			$this->rpc_service_portal->addField('bc_no',$bc_no);
			$this->rpc_service_portal->addField('bc_date',$bc_date);
			$this->rpc_service_portal->addField('partner_id',$partner_id);					
			$this->rpc_service_portal->addField('vendor_partner_id',$vendor_partner_id);					
			$this->rpc_service_portal->addField('currencies_id',$currencies_id);
			
			$this->rpc_service_portal->addField('muat_kppbc_id',$muat_kppbc_id);			
			$this->rpc_service_portal->addField('kppbc_id',$kppbc_id);			
			$this->rpc_service_portal->addField('jenis_ekspor_id',$jenis_ekspor_id);			
			$this->rpc_service_portal->addField('kategori_ekspor_id',$kategori_ekspor_id);			
			$this->rpc_service_portal->addField('cara_perdagangan_id',$cara_perdagangan_id);
			$this->rpc_service_portal->addField('cara_pembayaran_id',$cara_pembayaran_id);
			$this->rpc_service_portal->addField('cara_angkut_id',$cara_angkut_id);
			$this->rpc_service_portal->addField('nama_pengangkut',$nama_pengangkut);
			$this->rpc_service_portal->addField('kode_bendera',$kode_bendera);
			$this->rpc_service_portal->addField('nomor_voy_flight',$nomor_voy_flight);
			$this->rpc_service_portal->addField('tanggal_perkiraan_ekspor',$tanggal_perkiraan_ekspor);
			$this->rpc_service_portal->addField('ndpbm',$ndpbm);
			$this->rpc_service_portal->addField('price_type_id',$price_type_id);
			$this->rpc_service_portal->addField('amount_origin',$amount_origin);
			$this->rpc_service_portal->addField('insurance_type_id',$insurance_type_id);
			$this->rpc_service_portal->addField('amount_insurance',$amount_insurance);
			$this->rpc_service_portal->addField('amount_freight',$amount_freight);
			$this->rpc_service_portal->addField('maklon',$maklon);
			$this->rpc_service_portal->addField('muat_port_id',$muat_port_id);
			$this->rpc_service_portal->addField('muat2_port_id',$muat2_port_id);
			$this->rpc_service_portal->addField('bongkar_port_id',$bongkar_port_id);
			$this->rpc_service_portal->addField('tujuan_port_id',$tujuan_port_id);
			$this->rpc_service_portal->addField('tujuan_country_id',$tujuan_country_id);
			
			$this->rpc_service_portal->addField('jenis_tpb_id',$jenis_tpb_id);
			$this->rpc_service_portal->addField('tujuan_jenis_tpb_id',$tujuan_jenis_tpb_id);
			$this->rpc_service_portal->addField('tujuan_pengiriman_id',$tujuan_pengiriman_id);
			$this->rpc_service_portal->addField('nomor_polisi',$nomor_polisi);
					
			$result = $this->rpc_service_portal->resultJSON();
			
			$data = array();
			if(isset($result)){
				if(isset($result['valid'])){
					if($result['valid']){
						if(isset($result['data'])){
							$data_result = json_decode($result['data'],true);
							
							$return['valid'] = $result['valid'];
							$return['status_code'] = $result['no'];
							$return['message'] = $result['des'];
							$return['bc_out_header_id'] = $data_result['bc_out_header_id'];
						}
					} else {
						$return['status_code'] = $result['no'];
						$return['message'] = $result['des'];
					}
				}
			}
			
		} else {
			$return['valid'] = false;
			$return['message'] = "Session expired";
		}
		
		echo json_encode($return);
	}
	
	function loaddata_detail(){
		$this->authentication->plainlayout();
		
		$bc_out_header_id = isset($_REQUEST['bc_out_header_id']) ? is_numeric($_REQUEST['bc_out_header_id']) ? $_REQUEST['bc_out_header_id']  : -1 : -1;
		$methodid = isset($_REQUEST['methodid']) ? is_numeric($_REQUEST['methodid']) ? $_REQUEST['methodid']  : -1 : -1;
		
		$view = 'view_custom_export_detail';
		$field = $this->custom_export_detail_table();
		
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";
		
		$extra_param = array();
		$extra_param['where']['0']['field'] = 'r2';
		$extra_param['where']['0']['data'] = $bc_out_header_id;
		$extra_param['methodid'] = $methodid;
		
		$loaddata = $this->ecc_library->get_field_data($view,$field,$extra_param);
			
		echo $loaddata;
	}

	function post_add_edit_detail(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
		
		$bc_out_barang_id = isset($_POST['bc_out_barang_id']) ? $_POST['bc_out_barang_id'] : false;
		$bc_out_header_id = isset($_POST['bc_out_header_id']) ? $_POST['bc_out_header_id'] : 0;
		$seri = isset($_POST['seri']) ? $_POST['seri'] : 0;
		$item_id = isset($_POST['item_id']) ? $_POST['item_id'] : '';
		$hs_id = isset($_POST['hs_id']) ? $_POST['hs_id'] : '';
		$kategori_barang_id = isset($_POST['kategori_barang_id']) ? $_POST['kategori_barang_id'] : '';
		$quantity_custom = isset($_POST['quantity_custom']) ? $_POST['quantity_custom'] : '';
		$uom_id = isset($_POST['uom_id']) ? $_POST['uom_id'] : '';
		$conversion = isset($_POST['conversion']) ? $_POST['conversion'] : '';
		$unit_price = isset($_POST['unit_price']) ? $_POST['unit_price'] : '';
		$merk = isset($_POST['merk']) ? $_POST['merk'] : '';
		$tipe = isset($_POST['tipe']) ? $_POST['tipe'] : '';
		$ukuran = isset($_POST['ukuran']) ? $_POST['ukuran'] : '';
		$volume = isset($_POST['volume']) ? $_POST['volume'] : '';
		$spesifikasi_lain = isset($_POST['spesifikasi_lain']) ? $_POST['spesifikasi_lain'] : '';
		$bruto = isset($_POST['bruto']) ? $_POST['bruto'] : '';
		$netto = isset($_POST['netto']) ? $_POST['netto'] : '';
		$quantity_package = isset($_POST['quantity_package']) ? $_POST['quantity_package'] : '';
		$package_id = isset($_POST['package_id']) ? $_POST['package_id'] : '';
		$origin_country_id = isset($_POST['origin_country_id']) ? $_POST['origin_country_id'] : '';
		$fasilitas_id = isset($_POST['fasilitas_id']) ? $_POST['fasilitas_id'] : '';
		$skema_tarif_id = isset($_POST['skema_tarif_id']) ? $_POST['skema_tarif_id'] : '';
		$bm_jenis_tarif_id = isset($_POST['bm_jenis_tarif_id']) ? $_POST['bm_jenis_tarif_id'] : '';
		$bm_tarif = isset($_POST['bm_tarif']) ? $_POST['bm_tarif'] : '';
		$bm_uom_id = isset($_POST['bm_uom_id']) ? $_POST['bm_uom_id'] : '';
		$cukai_jenis_tarif_id = isset($_POST['cukai_jenis_tarif_id']) ? $_POST['cukai_jenis_tarif_id'] : '';
		$cukai_tarif = isset($_POST['cukai_tarif']) ? $_POST['cukai_tarif'] : '';
		$cukai_uom_id = isset($_POST['cukai_uom_id']) ? $_POST['cukai_uom_id'] : '';
		$ppn_tarif = isset($_POST['ppn_tarif']) ? $_POST['ppn_tarif'] : '';
		$pph_tarif = isset($_POST['pph_tarif']) ? $_POST['pph_tarif'] : '';
		$ppnbm_tarif = isset($_POST['ppnbm_tarif']) ? $_POST['ppnbm_tarif'] : '';
		$note = isset($_POST['note']) ? $_POST['note'] : '';
		$subcon_price = isset($_POST['subcon_price']) ? $_POST['subcon_price'] : '';
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			if($bc_out_barang_id){
				$this->rpc_service_portal->setSP("dbo.sp_custom_export_detail_edit");
				$this->rpc_service_portal->addField('bc_out_barang_id',$bc_out_barang_id);
			} else {
				$this->rpc_service_portal->setSP("dbo.sp_custom_export_detail_add");
			}
			
			$this->rpc_service_portal->addField('bc_out_header_id',$bc_out_header_id);
			
			$this->rpc_service_portal->addField('seri',$seri);
			$this->rpc_service_portal->addField('item_id',$item_id);
			$this->rpc_service_portal->addField('hs_id',$hs_id);
			$this->rpc_service_portal->addField('kategori_barang_id',$kategori_barang_id);
			$this->rpc_service_portal->addField('quantity_custom',$quantity_custom);
			$this->rpc_service_portal->addField('uom_id',$uom_id);
			$this->rpc_service_portal->addField('conversion',$conversion);
			$this->rpc_service_portal->addField('unit_price',$unit_price);
			$this->rpc_service_portal->addField('merk',$merk);
			$this->rpc_service_portal->addField('tipe',$tipe);
			$this->rpc_service_portal->addField('ukuran',$ukuran);
			$this->rpc_service_portal->addField('volume',$volume);
			$this->rpc_service_portal->addField('spesifikasi_lain',$spesifikasi_lain);
			$this->rpc_service_portal->addField('bruto',$bruto);
			$this->rpc_service_portal->addField('netto',$netto);
			$this->rpc_service_portal->addField('quantity_package',$quantity_package);
			$this->rpc_service_portal->addField('package_id',$package_id);
			$this->rpc_service_portal->addField('origin_country_id',$origin_country_id);
			$this->rpc_service_portal->addField('fasilitas_id',$fasilitas_id);
			$this->rpc_service_portal->addField('skema_tarif_id',$skema_tarif_id);
			$this->rpc_service_portal->addField('bm_jenis_tarif_id',$bm_jenis_tarif_id);
			$this->rpc_service_portal->addField('bm_tarif',$bm_tarif);
			$this->rpc_service_portal->addField('bm_uom_id',$bm_uom_id);
			$this->rpc_service_portal->addField('cukai_jenis_tarif_id',$cukai_jenis_tarif_id);
			$this->rpc_service_portal->addField('cukai_tarif',$cukai_tarif);
			$this->rpc_service_portal->addField('cukai_uom_id',$cukai_uom_id);
			$this->rpc_service_portal->addField('ppn_tarif',$ppn_tarif);
			$this->rpc_service_portal->addField('pph_tarif',$pph_tarif);
			$this->rpc_service_portal->addField('ppnbm_tarif',$ppnbm_tarif);
			$this->rpc_service_portal->addField('note',$note);
			$this->rpc_service_portal->addField('subcon_price',$subcon_price);
			
			$result = $this->rpc_service_portal->resultJSON();
			
			$data = array();
			if(isset($result)){
				if(isset($result['valid'])){
					if($result['valid']){
						if(isset($result['data'])){
							$data = json_decode($result['data'],TRUE);
							
							$return['valid'] = $result['valid'];
							$return['status_code'] = $result['no'];
							$return['message'] = $result['des'];
						
						
						}
					} else {
						$return['status_code'] = $result['no'];
						$return['message'] = $result['des'];
					}
				}
			}
			
		} else {
			$return['valid'] = false;
			$return['message'] = "Session expired";
		}
		
		echo json_encode($return);
	}
	
	function delete_detail(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$bc_out_barang_id = isset($_POST['bc_out_barang_id']) ? $_POST['bc_out_barang_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			
			if($bc_out_barang_id){
				$this->rpc_service_portal->setSP("dbo.sp_custom_export_detail_delete");
				$this->rpc_service_portal->addField('bc_out_barang_id',$bc_out_barang_id);
			}
					
			$result = $this->rpc_service_portal->resultJSON();
			// print_r($result);
			
			$data = array();
			if(isset($result)){
				if(isset($result['valid'])){
					if($result['valid']){
						if(isset($result['data'])){
							$return['valid'] = $result['valid'];
							$return['status_code'] = $result['no'];
							$return['message'] = $result['des'];
						}
					} else {
						$return['status_code'] = $result['no'];
						$return['message'] = $result['des'];
					}
				}
			}
			
		} else {
			$return['valid'] = false;
			$return['message'] = "Session expired";
		}
		
		echo json_encode($return);
	}
	
	function loaddata_performa(){
		$this->authentication->plainlayout();
		
		$partner_id = isset($_POST['partner_id']) ? is_numeric($_POST['partner_id']) ?  $_POST['partner_id'] : -1 : -1;
		$currencies_id = isset($_POST['currencies_id']) ? is_numeric($_POST['currencies_id']) ?  $_POST['currencies_id'] : -1 : -1;
		
		$view = 'view_sales_performa_custom';
		$field = $this->custom_export_detail_table();
		
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";
		
		$extra_param = array();
		$extra_param['where']['0']['field'] = 'r4';
		$extra_param['where']['0']['data'] = $partner_id;
		$extra_param['where']['1']['field'] = 'r5';
		$extra_param['where']['1']['data'] = $currencies_id;
		
		$loaddata = $this->ecc_library->get_field_data($view,$field,$extra_param);
			
		echo $loaddata;
	}
	
	function loaddata_contract_subcon(){
		$this->authentication->plainlayout();
		
		$partner_id = isset($_POST['partner_id']) ? is_numeric($_POST['partner_id']) ?  $_POST['partner_id'] : -1 : -1;
		$currencies_id = isset($_POST['currencies_id']) ? is_numeric($_POST['currencies_id']) ?  $_POST['currencies_id'] : -1 : -1;
		
		$view = 'view_subcon_out_custom_cmt';
		$field = $this->custom_export_detail_table();
		
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";
		
		$extra_param = array();
		$extra_param['where']['0']['field'] = 'r4';
		$extra_param['where']['0']['data'] = $partner_id;
		$extra_param['where']['1']['field'] = 'r5';
		$extra_param['where']['1']['data'] = $currencies_id;
		
		$loaddata = $this->ecc_library->get_field_data($view,$field,$extra_param);
			
		echo $loaddata;
	}
	
	
	function send_to_ceisa(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$tpb_header_id = isset($_POST['tpb_header_id']) ? $_POST['tpb_header_id'] : false;
		$custom_type_id = isset($_POST['custom_type_id']) ? $_POST['custom_type_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			$sp = "dbo.sp_ceisa_send_to_module";	
			if($tpb_header_id){
				$this->rpc_service_portal->setSP(array("sp"=> $sp,"mode"=>"1","debug"=>"1"));
			}
			

			$this->rpc_service_portal->addField('tpb_header_id',$tpb_header_id);
			$this->rpc_service_portal->addField('custom_type_id',$custom_type_id);
				
			$result = $this->rpc_service_portal->resultJSON();
			// print_r($result);
			
			$data = array();
			if(isset($result)){
				if(isset($result['valid'])){
					if($result['valid']){
						if(isset($result['data'])){
							$return['valid'] = $result['valid'];
							$return['status_code'] = $result['no'];
							$return['message'] = $result['des'];
						}
					} else {
						$return['status_code'] = $result['no'];
						$return['message'] = $result['des'];
					}
				}
			}
			
		} else {
			$return['valid'] = false;
			$return['message'] = "Session expired";
		}
		
		echo json_encode($return);
	}
	
	function get_register_no(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$tpb_header_id = isset($_POST['tpb_header_id']) ? $_POST['tpb_header_id'] : false;
		$custom_type_id = isset($_POST['custom_type_id']) ? $_POST['custom_type_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			$sp = "dbo.sp_ceisa_get_respon";	
			if($tpb_header_id){
				$this->rpc_service_portal->setSP(array("sp"=> $sp,"mode"=>"1","debug"=>"1"));
			}
			

			$this->rpc_service_portal->addField('tpb_header_id',$tpb_header_id);
			$this->rpc_service_portal->addField('custom_type_id',$custom_type_id);
				
			$result = $this->rpc_service_portal->resultJSON();
			// print_r($result);
			
			$data = array();
			if(isset($result)){
				if(isset($result['valid'])){
					if($result['valid']){
						if(isset($result['data'])){
							$return['valid'] = $result['valid'];
							$return['status_code'] = $result['no'];
							$return['message'] = $result['des'];
						}
					} else {
						$return['status_code'] = $result['no'];
						$return['message'] = $result['des'];
					}
				}
			}
			
		} else {
			$return['valid'] = false;
			$return['message'] = "Session expired";
		}
		
		echo json_encode($return);
	}
	
	function cancel_send_ceisa(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$tpb_header_id = isset($_POST['tpb_header_id']) ? $_POST['tpb_header_id'] : false;
		$custom_type_id = isset($_POST['custom_type_id']) ? $_POST['custom_type_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			$sp = "dbo.sp_ceisa_cancel_dokumen";	
			if($tpb_header_id){
				$this->rpc_service_portal->setSP(array("sp"=> $sp,"mode"=>"1","debug"=>"1"));
			}
			

			$this->rpc_service_portal->addField('tpb_header_id',$tpb_header_id);
			$this->rpc_service_portal->addField('custom_type_id',$custom_type_id);
				
			$result = $this->rpc_service_portal->resultJSON();
			// print_r($result);
			
			$data = array();
			if(isset($result)){
				if(isset($result['valid'])){
					if($result['valid']){
						if(isset($result['data'])){
							$return['valid'] = $result['valid'];
							$return['status_code'] = $result['no'];
							$return['message'] = $result['des'];
						}
					} else {
						$return['status_code'] = $result['no'];
						$return['message'] = $result['des'];
					}
				}
			}
			
		} else {
			$return['valid'] = false;
			$return['message'] = "Session expired";
		}
		
		echo json_encode($return);
	}
	
	
	function send_to_peb(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$tpb_header_id = isset($_POST['tpb_header_id']) ? $_POST['tpb_header_id'] : false;
		$custom_type_id = isset($_POST['custom_type_id']) ? $_POST['custom_type_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Connection Error";
		
		// if(count($_POST) > 0){
			// $sp = "dbo.sp_ceisa_send_to_module";	
			// if($tpb_header_id){
				// $this->rpc_service_portal->setSP(array("sp"=> $sp,"mode"=>"1","debug"=>"1"));
			// }
			

			// $this->rpc_service_portal->addField('tpb_header_id',$tpb_header_id);
			// $this->rpc_service_portal->addField('custom_type_id',$custom_type_id);
				
			// $result = $this->rpc_service_portal->resultJSON();
			// // print_r($result);
			
			// $data = array();
			// if(isset($result)){
				// if(isset($result['valid'])){
					// if($result['valid']){
						// if(isset($result['data'])){
							// $return['valid'] = $result['valid'];
							// $return['status_code'] = $result['no'];
							// $return['message'] = $result['des'];
						// }
					// } else {
						// $return['status_code'] = $result['no'];
						// $return['message'] = $result['des'];
					// }
				// }
			// }
			
		// } else {
			// $return['valid'] = false;
			// $return['message'] = "Session expired";
		// }
		
		echo json_encode($return);
	}
	
	function get_register_no_peb(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$tpb_header_id = isset($_POST['tpb_header_id']) ? $_POST['tpb_header_id'] : false;
		$custom_type_id = isset($_POST['custom_type_id']) ? $_POST['custom_type_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Connection Error";
		
		// if(count($_POST) > 0){
			// $sp = "dbo.sp_ceisa_get_respon";	
			// if($tpb_header_id){
				// $this->rpc_service_portal->setSP(array("sp"=> $sp,"mode"=>"1","debug"=>"1"));
			// }
			

			// $this->rpc_service_portal->addField('tpb_header_id',$tpb_header_id);
			// $this->rpc_service_portal->addField('custom_type_id',$custom_type_id);
				
			// $result = $this->rpc_service_portal->resultJSON();
			// // print_r($result);
			
			// $data = array();
			// if(isset($result)){
				// if(isset($result['valid'])){
					// if($result['valid']){
						// if(isset($result['data'])){
							// $return['valid'] = $result['valid'];
							// $return['status_code'] = $result['no'];
							// $return['message'] = $result['des'];
						// }
					// } else {
						// $return['status_code'] = $result['no'];
						// $return['message'] = $result['des'];
					// }
				// }
			// }
			
		// } else {
			// $return['valid'] = false;
			// $return['message'] = "Session expired";
		// }
		
		echo json_encode($return);
	}
	
	function cancel_send_peb(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$tpb_header_id = isset($_POST['tpb_header_id']) ? $_POST['tpb_header_id'] : false;
		$custom_type_id = isset($_POST['custom_type_id']) ? $_POST['custom_type_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Connection Error";
		
		// if(count($_POST) > 0){
			// $sp = "dbo.sp_ceisa_cancel_dokumen";	
			// if($tpb_header_id){
				// $this->rpc_service_portal->setSP(array("sp"=> $sp,"mode"=>"1","debug"=>"1"));
			// }
			

			// $this->rpc_service_portal->addField('tpb_header_id',$tpb_header_id);
			// $this->rpc_service_portal->addField('custom_type_id',$custom_type_id);
				
			// $result = $this->rpc_service_portal->resultJSON();
			// // print_r($result);
			
			// $data = array();
			// if(isset($result)){
				// if(isset($result['valid'])){
					// if($result['valid']){
						// if(isset($result['data'])){
							// $return['valid'] = $result['valid'];
							// $return['status_code'] = $result['no'];
							// $return['message'] = $result['des'];
						// }
					// } else {
						// $return['status_code'] = $result['no'];
						// $return['message'] = $result['des'];
					// }
				// }
			// }
			
		// } else {
			// $return['valid'] = false;
			// $return['message'] = "Session expired";
		// }
		
		echo json_encode($return);
	}
	
	function loaddata_detail_supply(){
		$this->authentication->plainlayout();
		
		$bc_out_header_id = isset($_REQUEST['bc_out_header_id']) ? is_numeric($_REQUEST['bc_out_header_id']) ? $_REQUEST['bc_out_header_id']  : -1 : -1;
		$methodid = isset($_REQUEST['methodid']) ? is_numeric($_REQUEST['methodid']) ? $_REQUEST['methodid']  : -1 : -1;
		
		$view = 'view_custom_export_detail_supply';
		$field = $this->custom_export_detail_supply_table();
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";
		
		$extra_param = array();
		$extra_param['where']['0']['field'] = 'r2';
		$extra_param['where']['0']['data'] = $bc_out_header_id;
		$extra_param['methodid'] = $methodid;
		
		$loaddata = $this->ecc_library->get_field_data($view,$field,$extra_param);
			
		echo $loaddata;
	}
	
	function loaddata_transfer_item(){
		$this->authentication->plainlayout();
		
		$bc_out_barang_id = isset($_REQUEST['bc_out_barang_id']) ? is_numeric($_REQUEST['bc_out_barang_id']) ? $_REQUEST['bc_out_barang_id']  : -1 : -1;
		$methodid = isset($_REQUEST['methodid']) ? is_numeric($_REQUEST['methodid']) ? $_REQUEST['methodid']  : -1 : -1;
		
		$view = 'view_stock_move_item_bc_out';
		$field = $this->custom_export_transfer_item_table();
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";
		
		$extra_param = array();
		$extra_param['where']['0']['field'] = 'r2';
		$extra_param['where']['0']['data'] = $bc_out_barang_id;
		$extra_param['methodid'] = $methodid;
		
		$loaddata = $this->ecc_library->get_field_data($view,$field,$extra_param);
			
		echo $loaddata;
	}
	
	function loaddata_supply_item(){
		$this->authentication->plainlayout();
		
		$bc_out_barang_supply_id = isset($_REQUEST['bc_out_barang_supply_id']) ? is_numeric($_REQUEST['bc_out_barang_supply_id']) ? $_REQUEST['bc_out_barang_supply_id']  : -1 : -1;
		$bc_out_barang_id = isset($_REQUEST['bc_out_barang_id']) ? is_numeric($_REQUEST['bc_out_barang_id']) ? $_REQUEST['bc_out_barang_id']  : -1 : -1;
		$methodid = isset($_REQUEST['methodid']) ? is_numeric($_REQUEST['methodid']) ? $_REQUEST['methodid']  : -1 : -1;
		
		$view = 'view_stock_move_supply_bc_out';
		$field = $this->custom_export_supply_item_table();
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";
		
		$extra_param = array();
		$extra_param['where']['0']['field'] = 'r2';
		$extra_param['where']['0']['data'] = $bc_out_barang_id;
		$extra_param['methodid'] = $methodid;
		
		$loaddata = $this->ecc_library->get_field_data($view,$field,$extra_param);
			
		echo $loaddata;
	}
	
	function post_add_edit_supply(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
		
		$stock_move_id = isset($_POST['stock_move_id']) ? $_POST['stock_move_id'] : false;
		$bc_out_barang_id = isset($_POST['bc_out_barang_id']) ? $_POST['bc_out_barang_id'] : 0;
		$bc_out_barang_supply_id = isset($_POST['bc_out_barang_supply_id']) ? $_POST['bc_out_barang_supply_id'] : '';
		$quantity_supply = isset($_POST['quantity_supply']) ? $_POST['quantity_supply'] : 0;
		$bc_out_header_id = isset($_POST['bc_out_header_id']) ? $_POST['bc_out_header_id'] : 0;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			if($bc_out_barang_supply_id){
				$this->rpc_service->setSP("dbo.sp_custom_export_supply_edit");
				$this->rpc_service->addField('bc_out_barang_supply_id',$bc_out_barang_supply_id);
			} else {
				$this->rpc_service->setSP("dbo.sp_custom_export_supply_add");
			}
			
			$this->rpc_service->addField('bc_out_header_id',$bc_out_header_id);
			$this->rpc_service->addField('bc_out_barang_id',$bc_out_barang_id);
			$this->rpc_service->addField('quantity_supply',$quantity_supply);
			$this->rpc_service->addField('stock_move_id',$stock_move_id);
			
			$result = $this->rpc_service->resultJSON();
			
			$data = array();
			if(isset($result)){
				if(isset($result['valid'])){
					if($result['valid']){
						if(isset($result['data'])){
							$return['valid'] = $result['valid'];
							$return['status_code'] = $result['no'];
							$return['message'] = $result['des'];
						}
					} else {
						$return['status_code'] = $result['no'];
						$return['message'] = $result['des'];
					}
				}
			}
			
		} else {
			$return['valid'] = false;
			$return['message'] = "Session expired";
		}
		
		echo json_encode($return);
	}
	
	function auto_supply_fifo(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$bc_out_header_id = isset($_POST['bc_out_header_id']) ? $_POST['bc_out_header_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			
			if($bc_out_header_id){
				$this->rpc_service->setSP("dbo.sp_custom_export_supply_fifo");
				$this->rpc_service->addField('bc_out_header_id',$bc_out_header_id);
			}
					
			$result = $this->rpc_service->resultJSON();
			// print_r($result);
			
			$data = array();
			if(isset($result)){
				if(isset($result['valid'])){
					if($result['valid']){
						if(isset($result['data'])){
							$return['valid'] = $result['valid'];
							$return['status_code'] = $result['no'];
							$return['message'] = $result['des'];
						}
					} else {
						$return['status_code'] = $result['no'];
						$return['message'] = $result['des'];
					}
				}
			}
			
		} else {
			$return['valid'] = false;
			$return['message'] = "Session expired";
		}
		
		echo json_encode($return);
	}
	
	function auto_supply_lifo(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$bc_out_header_id = isset($_POST['bc_out_header_id']) ? $_POST['bc_out_header_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			
			if($bc_out_header_id){
				$this->rpc_service->setSP("dbo.sp_custom_export_supply_lifo");
				$this->rpc_service->addField('bc_out_header_id',$bc_out_header_id);
			}
					
			$result = $this->rpc_service->resultJSON();
			// print_r($result);
			
			$data = array();
			if(isset($result)){
				if(isset($result['valid'])){
					if($result['valid']){
						if(isset($result['data'])){
							$return['valid'] = $result['valid'];
							$return['status_code'] = $result['no'];
							$return['message'] = $result['des'];
						}
					} else {
						$return['status_code'] = $result['no'];
						$return['message'] = $result['des'];
					}
				}
			}
			
		} else {
			$return['valid'] = false;
			$return['message'] = "Session expired";
		}
		
		echo json_encode($return);
	}
}

?>