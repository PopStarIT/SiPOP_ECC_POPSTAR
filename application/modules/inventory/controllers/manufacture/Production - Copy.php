<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Production extends CI_Controller { 

	function __construct(){ 
		parent::__construct(); 
		
		$this->data_production = $_REQUEST;
		
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
	
	function work_order_production_table(){
		$field = array();
		$field[] = array('field' => 'work_order_production_id', 'title' => 'TRANSFER ID','visible'=>false);
		$field[] = array('field' => 'work_order_production_type', 'title' => 'PRODUCTION TYPE');
		$field[] = array('field' => 'work_order_production_no', 'title' => 'PRODUCTION NO');
		$field[] = array('field' => 'work_order_production_date', 'title' => 'PRODUCTION DATE', 'data_type' => 'date');
		$field[] = array('field' => 'work_order_plan_no', 'title' => 'PLAN NO');
		$field[] = array('field' => 'work_order_plan_date', 'title' => 'PLAN DATE', 'data_type' => 'date');
		$field[] = array('field' => 'work_order_production_status', 'title' => 'STATUS');
		$field[] = array('field' => 'create_by', 'title' => 'CREATE BY');
		$field[] = array('field' => 'create_date', 'title' => 'CREATE DATE', 'data_type' => 'date');
		$field[] = array('field' => 'edit_by', 'title' => 'EDIT BY');
		$field[] = array('field' => 'edit_date', 'title' => 'EDIT DATE', 'data_type' => 'date');
		$field[] = array('field' => 'reject', 'title' => 'REJECT','visible'=>false);
		
		return $field;
	}
	
	function index(){
		$this->load->model('main');
		$component['loadlayout'] = true;
		$component['view_load'] = 'manufacture/production/view';
		$component['view_load_form'] = 'manufacture/production/form';
		$component['load_js'][] = 'manufacture/production/view';
		$component['load_js'][] = 'manufacture/production/form';
		
		$component['page_title'] = "Production";
		
		$dashboard_table = array();
		
		$nav_button = array();
		$nav_button[] = array('method_id' => 522,'title' => 'Add', 'icon' => 'fa fa-plus', 'load' => 'manufacture/production/function_add');
		$nav_button[] = array('method_id' => 523,'title' => 'Edit', 'icon' => 'fa fa-pencil', 'load' => 'manufacture/production/function_edit');
		$nav_button[] = array('method_id' => 532,'title' => 'Supply', 'icon' => 'fa fa-pencil', 'load' => 'manufacture/production/function_supply');
		$nav_button[] = array('method_id' => 526,'title' => 'Approve', 'icon' => 'fa fa-pencil', 'load' => 'manufacture/production/function_approve');
		$nav_button[] = array('method_id' => 525,'title' => 'Delete', 'icon' => 'fa fa-trash-o', 'load' => 'manufacture/production/function_delete');
		$nav_button[] = array('method_id' => 733,'title' => 'Print', 'icon' => 'fa fa-print', 'load' => 'manufacture/production/function_print');
		$nav_button[] = array('method_id' => 770,'title' => 'Cancel Approve', 'icon' => 'fa fa-pencil', 'load' => 'manufacture/production/function_cancel_approve');
		
		$field = $this->work_order_production_table();
		
		$dashboard_table['nav_button'] = $nav_button;
		$dashboard_table['field'] = $field;
		
		$component['dashboard_table'] = $dashboard_table;
		
		$this->authentication->ajaxlayout($component);
	}
	
	function loaddata(){
		$this->authentication->plainlayout();
		
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";
		
		$view = 'dbo.view_work_order_production';
		$field = $this->work_order_production_table();
		$loaddata = $this->ecc_library->loaddata($view,$field);
			
		echo json_encode($loaddata);
	}
	
	function approve(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$work_order_production_id = isset($_POST['work_order_production_id']) ? $_POST['work_order_production_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			
			if($work_order_production_id){
				$this->rpc_service->setSP("dbo.sp_work_order_production_approve");
				$this->rpc_service->addField('work_order_production_id',$work_order_production_id);
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
	
	function cancel_approve(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$work_order_production_id = isset($_POST['work_order_production_id']) ? $_POST['work_order_production_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			
			if($work_order_production_id){
				$this->rpc_service->setSP("dbo.sp_work_order_production_cancel_approve");
				$this->rpc_service->addField('work_order_production_id',$work_order_production_id);
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
	
	
	function delete(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$work_order_production_id = isset($_POST['work_order_production_id']) ? $_POST['work_order_production_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			
			if($work_order_production_id){
				$this->rpc_service->setSP("dbo.sp_work_order_production_delete");
				$this->rpc_service->addField('work_order_production_id',$work_order_production_id);
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
	
	function post_add_edit(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
								
		$work_order_production_id = isset($_POST['work_order_production_id']) ? $_POST['work_order_production_id'] : '';
		$work_order_production_no = isset($_POST['work_order_production_no']) ? $_POST['work_order_production_no'] : '';
		$work_order_production_date = isset($_POST['work_order_production_date']) ? $_POST['work_order_production_date'] : '';
		$work_order_plan_id = isset($_POST['work_order_plan_id']) ? $_POST['work_order_plan_id'] : '';
		$work_process_id = isset($_POST['work_process_id']) ? $_POST['work_process_id'] : '';
		$work_order_production_type_id = isset($_POST['work_order_production_type_id']) ? $_POST['work_order_production_type_id'] : '';
		
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			if($work_order_production_id){
				$this->rpc_service->setSP("dbo.sp_work_order_production_edit");
				$this->rpc_service->addField('work_order_production_id',$work_order_production_id);
			} else {
				$this->rpc_service->setSP("dbo.sp_work_order_production_add");
			}
			
			$this->rpc_service->addField('work_order_production_no',$work_order_production_no);
			$this->rpc_service->addField('work_order_production_date',$work_order_production_date);
			$this->rpc_service->addField('work_order_plan_id',$work_order_plan_id);
			$this->rpc_service->addField('work_process_id',$work_process_id);
			$this->rpc_service->addField('work_order_production_type_id',$work_order_production_type_id);
			
			
			$result = $this->rpc_service->resultJSON();
			
			
			$data = array();
			if(isset($result)){
				if(isset($result['valid'])){
					if($result['valid']){
						if(isset($result['data'])){
							$data = json_decode($result['data'],TRUE);
							$work_order_production_id = $data['work_order_production_id'];
							
							$return['valid'] = $result['valid'];
							$return['status_code'] = $result['no'];
							$return['message'] = $result['des'];
							$return['work_order_production_id'] = $work_order_production_id;
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
	
	function loaddata_bom(){
		$this->authentication->plainlayout();
		
		$field = array();
		$field[] = array('field' => 'item', 'title' => 'item');
		$field[] = array('field' => 'unit', 'title' => 'unit');
		$field[] = array('field' => 'mat_quantity', 'title' => 'mat_quantity');
		
		$new_work_order_production = isset($_POST['new_work_order_production']) ? $_POST['new_work_order_production'] : 0;
		$work_order_production_bom_id = isset($_POST['work_order_production_bom_id']) ? is_numeric($_POST['work_order_production_bom_id']) ? $_POST['work_order_production_bom_id'] : -1: -1;
		$work_order_production_quantity = isset($_POST['work_order_production_quantity']) ? $_POST['work_order_production_quantity'] : 0;
		$lock_data = isset($_POST['lock_data']) ? $_POST['lock_data'] : 0;
		
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";
		$loaddata_table = array();
		
		if($lock_data == 0){
			$view = 'dbo.view_bom_detail';
			$where = array();
			$where['bom_id'] = $work_order_production_bom_id;
			$loaddata = $this->ecc_library->loaddata($view,$field, $where);
				
			foreach($loaddata['data'] as $key => $value){
				
				$new_row = array();
				$new_row[] = $value[0];
				$new_row[] = $this->mainconfig->get_decimal_format($value[2] * $work_order_production_quantity,12);
				$new_row[] = $value[1];
				
				$loaddata_table[$value[0]] = $new_row;
			}
		}
		
		
		$loaddata['data'] = array();
		foreach($loaddata_table as $value){
			
			$data = array();
			$data[] = $value[0];
			$data[] = $value[1];
			$data[] = $value[2];
			
			$loaddata['data'][] = $data;
		}
		
		echo json_encode($loaddata);
	}
	
	function loaddata_detail(){
		$this->authentication->plainlayout();
		
		$field = array();
		$field[] = array('field' => 'work_order_production_detail_id', 'title' => 'item');
		$field[] = array('field' => 'item', 'title' => 'unit');
		$field[] = array('field' => 'bom', 'title' => 'mat_quantity');
		$field[] = array('field' => 'quantity_production', 'title' => 'mat_quantity');
		
		$new_work_order_production = isset($_POST['new_work_order_production']) ? $_POST['new_work_order_production'] : 0;
		$work_order_production_id = isset($_POST['work_order_production_id']) ? is_numeric($_POST['work_order_production_id']) ? $_POST['work_order_production_id'] : -1: -1;

		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";
		$loaddata_table = array();
		
		
		$view = 'dbo.view_work_order_production_detail';
		$where = array();
		$where['work_order_production_id'] = $work_order_production_id;
		$loaddata = $this->ecc_library->loaddata($view,$field, $where);
			
		foreach($loaddata['data'] as $key => $value){
			
			$new_row = array();
			$new_row[] = $value[0];
			$new_row[] = $value[1];
			$new_row[] = $value[2];
			$new_row[] = $this->mainconfig->get_decimal_format($value[3],12);
			
			$new_row[] = "<div class='btn-group'>
					<button class='btn btn-sm btn-info text-white' onclick=javascript:work_order_production_edit('". $value[0] ."') data-toggle='tooltip' title='Edit'>
						<i class='fa fa-pencil'></i>
					</button>
					 
					<button class='btn btn-sm btn-danger text-white' onclick=javascript:work_order_production_delete('". $value[0] ."') data-toggle='tooltip' title='Delete'>
						<i class='fa fa-trash-o'></i>
					</button>
				</div>";
				
			$loaddata_table[$value[0]] = $new_row;
		}
		
		
		
		$loaddata['data'] = array();
		foreach($loaddata_table as $value){
			
			$data = array();
			$data[] = $value[0];
			$data[] = $value[1];
			$data[] = $value[2];
			$data[] = $value[3];
			$data[] = $value[4];
			
			$loaddata['data'][] = $data;
		}
		
		echo json_encode($loaddata);
	}
		
	function post_add_edit_detail(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
		
		$work_order_production_detail_id = isset($_POST['work_order_production_detail_id']) ? $_POST['work_order_production_detail_id'] : false;
		$work_order_production_id = isset($_POST['work_order_production_id']) ? $_POST['work_order_production_id'] : false;
		$item_id = isset($_POST['item_id']) ? $_POST['item_id'] : '';
		$bom_id = isset($_POST['bom_id']) ? $_POST['bom_id'] : '';
		$quantity_production = isset($_POST['quantity_production']) ? $_POST['quantity_production'] : '';
		$work_order_detail_id = isset($_POST['work_order_detail_id']) ? $_POST['work_order_detail_id'] : '';
		$reject_item_id = isset($_POST['reject_item_id']) ? $_POST['reject_item_id'] : '';
		$user_id = $this->session->userdata('user_id');
		
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			if($work_order_production_detail_id){
				$this->rpc_service->setSP("dbo.sp_work_order_production_detail_edit");
				$this->rpc_service->addField('work_order_production_detail_id',$work_order_production_detail_id);
			} else {
				$this->rpc_service->setSP("dbo.sp_work_order_production_detail_add");
			}
			
			$this->rpc_service->addField('work_order_production_id',$work_order_production_id);
			$this->rpc_service->addField('item_id',$item_id);
			$this->rpc_service->addField('bom_id',$bom_id);
			$this->rpc_service->addField('quantity_production',$quantity_production);
			$this->rpc_service->addField('work_order_detail_id',$work_order_detail_id);
			$this->rpc_service->addField('reject_item_id',$reject_item_id);
			
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
	
	function loaddata_detail_total(){
		$this->authentication->plainlayout();
		
		$field = array();
		$field[] = array('field' => 'item', 'title' => 'item');
		$field[] = array('field' => 'quantity_requirement', 'title' => 'unit');
		$field[] = array('field' => 'uom_code', 'title' => 'mat_quantity');
		$field[] = array('field' => 'fg_item', 'title' => 'mat_quantity');
		$field[] = array('field' => 'quantity_production', 'title' => 'mat_quantity');
	
		$new_work_order_production = isset($_POST['new_work_order_production']) ? $_POST['new_work_order_production'] : 0;
		$work_order_production_id = isset($_POST['work_order_production_id']) ? is_numeric($_POST['work_order_production_id']) ? $_POST['work_order_production_id'] : -1: -1;

		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";
		$loaddata_table = array();
		
		
		$view = 'dbo.view_work_order_production_list';
		$where = array();
		$where['work_order_production_id'] = $work_order_production_id;
		$loaddata = $this->ecc_library->loaddata($view,$field, $where);
			
		foreach($loaddata['data'] as $key => $value){
			
			$new_row = array();
			$new_row[] = $value[0];
			$new_row[] = $this->mainconfig->get_decimal_format($value[1],12);
			$new_row[] = $value[2];
			$new_row[] = $value[3];
			$new_row[] = $this->mainconfig->get_decimal_format($value[4],12);
							
			$loaddata_table[$value[0]] = $new_row;
		}
		
		
		
		$loaddata['data'] = array();
		foreach($loaddata_table as $value){
			
			$data = array();
			$data[] = $value[0];
			$data[] = $value[1];
			$data[] = $value[2];
			$data[] = $value[3];
			$data[] = $value[4];
			
			$loaddata['data'][] = $data;
		}
		
		echo json_encode($loaddata);
	}
	
	function delete_detail(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		$work_order_production_detail_id = isset($_POST['work_order_production_detail_id']) ? $_POST['work_order_production_detail_id'] : '';
		$user_id = $this->session->userdata('user_id');
		
		if(count($_POST) > 0){
			
			if($work_order_production_detail_id){
				$this->rpc_service->setSP("dbo.sp_work_order_production_detail_delete");
				$this->rpc_service->addField('work_order_production_detail_id',$work_order_production_detail_id);
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
	
	function loaddata_detail_supply(){
		$this->authentication->plainlayout();
		
		$field = array();
		$field[] = array('field' => 'work_order_production_list_id', 'title' => 'work_order_production_list_id');
		$field[] = array('field' => 'item', 'title' => 'item');
		$field[] = array('field' => 'uom_code', 'title' => 'uom_code');
		$field[] = array('field' => 'quantity_requirement', 'title' => 'quantity_requirement');
		$field[] = array('field' => 'quantity_supply', 'title' => 'quantity_supply');
		
		$new_work_order_transfer = isset($_POST['new_work_order_transfer']) ? $_POST['new_work_order_transfer'] : 0;
		$work_order_production_id = isset($_POST['work_order_production_id']) ? is_numeric($_POST['work_order_production_id']) ? $_POST['work_order_production_id'] : 0: 0;
		$lock_data = isset($_POST['lock_data']) ? $_POST['lock_data'] : 0;
		
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";
		$loaddata_table = array();
		
		if($lock_data == 0){
			$view = 'dbo.view_work_order_production_list';
			$where = array();
			$where['work_order_production_id'] = $work_order_production_id;
			$loaddata = $this->ecc_library->loaddata($view,$field, $where);
				
			foreach($loaddata['data'] as $key => $value){
				$this_order[$key] = 0;
				
				$new_row = array();
				$new_row[] = $value[0];
				$new_row[] = $value[1];
				$new_row[] = $value[2];
				$new_row[] = $this->mainconfig->get_decimal_format3($value[3],12);
				$new_row[] = $this->mainconfig->get_decimal_format3($value[4],12);
				
				
				$loaddata_table[$value[0]] = $new_row;
			}
		}
		
		$loaddata['data'] = array();
		foreach($loaddata_table as $value){
			
			$data = array();
			$data[] = $value[0];
			$data[] = $value[1];
			$data[] = $value[2];
			$data[] = $value[3];
			$data[] = $value[4];
			
			$loaddata['data'][] = $data;
		}
		
		echo json_encode($loaddata);
	}
	
	function loaddata_transfer_item(){
		$this->authentication->plainlayout();
		
		$field = array();
		$field[] = array('field' => 'stock_move_id', 'title' => 'stock_move_id');
		$field[] = array('field' => 'work_order_production_list_id', 'title' => 'work_order_production_list_id');
		$field[] = array('field' => 'doc_from', 'title' => 'doc_from');
		$field[] = array('field' => 'receive_date', 'title' => 'receive_date');
		$field[] = array('field' => 'receive_no', 'title' => 'receive_no');
		$field[] = array('field' => 'doc_date', 'title' => 'doc_date');
		$field[] = array('field' => 'doc_no', 'title' => 'doc_no');
		$field[] = array('field' => 'outstanding_qty', 'title' => 'outstanding_qty');
		$field[] = array('field' => 'unit', 'title' => 'unit');
		$field[] = array('field' => 'car', 'title' => 'car');
		$field[] = array('field' => 'seq', 'title' => 'seq');
		$field[] = array('field' => 'note', 'title' => 'note');
	
		$new_work_order_production = isset($_POST['new_work_order_production']) ? $_POST['new_work_order_production'] : 0;
		$work_order_production_list_id = isset($_POST['work_order_production_list_id']) ? $_POST['work_order_production_list_id'] : 0;
		$work_order_production_supply_id = isset($_POST['work_order_production_supply_id']) ? $_POST['work_order_production_supply_id'] : 0;
		$work_order_production_id = isset($_POST['work_order_production_id']) ? $_POST['work_order_production_id'] : 0;
		$lock_data = isset($_POST['lock_data']) ? $_POST['lock_data'] : 0;
		
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";
		$loaddata_table = array();
		
		if($lock_data == 0){
			$view = 'dbo.view_stock_move_item_production';
			$where = array();
			$where['work_order_production_list_id'] = $work_order_production_list_id;
			$loaddata = $this->ecc_library->loaddata($view,$field, $where);
				
			foreach($loaddata['data'] as $key => $value){
				$this_order[$key] = 0;
				
				$new_row = array();
				$new_row[] = $value[0];
				$new_row[] = $value[1];
				$new_row[] = $value[2];
				$new_row[] = $value[3];
				$new_row[] = $value[4];
				$new_row[] = $value[5];
				$new_row[] = $value[6];
				$new_row[] = $this->mainconfig->get_decimal_format3($value[7],12);
				$new_row[] = $value[8];
				$new_row[] = $value[9];
				$new_row[] = $value[10];
				$new_row[] = $value[11];
				$new_row[] = 0;
				$new_row[] = 0;
								
				$loaddata_table[$value[0]] = $new_row;
			}
		}
		
		
		$view = 'dbo.view_stock_move_supply_production';
		
		$field = array();
		$field[] = array('field' => 'stock_move_id', 'title' => 'stock_move_id');
		$field[] = array('field' => 'work_order_production_list_id', 'title' => 'work_order_production_list_id');
		$field[] = array('field' => 'doc_from', 'title' => 'doc_from');
		$field[] = array('field' => 'receive_date', 'title' => 'receive_date');
		$field[] = array('field' => 'receive_no', 'title' => 'receive_no');
		$field[] = array('field' => 'doc_date', 'title' => 'doc_date');
		$field[] = array('field' => 'doc_no', 'title' => 'doc_no');
		$field[] = array('field' => 'outstanding_qty', 'title' => 'outstanding_qty');
		$field[] = array('field' => 'unit', 'title' => 'unit');
		$field[] = array('field' => 'car', 'title' => 'car');
		$field[] = array('field' => 'seq', 'title' => 'seq');
		$field[] = array('field' => 'note', 'title' => 'note');
		$field[] = array('field' => 'work_order_production_supply_id', 'title' => 'work_order_production_supply_id');
		$field[] = array('field' => 'quantity_supply', 'title' => 'quantity_supply');

		$where = array();
		$where['work_order_production_id'] = $work_order_production_id;
		$where['work_order_production_list_id'] = $work_order_production_list_id;
		$loaddata_supply = $this->ecc_library->loaddata($view,$field,$where);
		
		foreach($loaddata_supply['data'] as $key => $value){
			if(isset($loaddata_table[$value[0]])){
				$loaddata_table[$value[0]][12] = $value[12];
				$loaddata_table[$value[0]][13] = $value[13];	
			}
		}
		
		$loaddata['data'] = array();
		foreach($loaddata_table as $value){
			
			$data = array();
			$data[] = $value[0];
			$data[] = $value[1];
			$data[] = $value[2];
			$data[] = $value[3];
			$data[] = $value[4];
			$data[] = $value[5];
			$data[] = $value[6];
			$data[] = $this->mainconfig->get_decimal_format2($value[7],12);
			$data[] = $value[8];
			$data[] = $value[9];
			$data[] = $value[10];
			$data[] = $value[11];
			$data[] = $value[12];
			$data[] = $this->mainconfig->get_decimal_format2($value[13],12);
			
			
			$loaddata['data'][] = $data;
		}
		
		echo json_encode($loaddata);
	}
	
	function loaddata_supply_item(){
		$this->authentication->plainlayout();
		
		$field = array();
		$field[] = array('field' => 'stock_move_id', 'title' => 'stock_move_id');
		$field[] = array('field' => 'work_order_production_list_id', 'title' => 'work_order_production_list_id');
		$field[] = array('field' => 'doc_from', 'title' => 'doc_from');
		$field[] = array('field' => 'receive_date', 'title' => 'receive_date');
		$field[] = array('field' => 'receive_no', 'title' => 'receive_no');
		$field[] = array('field' => 'doc_date', 'title' => 'doc_date');
		$field[] = array('field' => 'doc_no', 'title' => 'doc_no');
		$field[] = array('field' => 'outstanding_qty', 'title' => 'outstanding_qty');
		$field[] = array('field' => 'unit', 'title' => 'unit');
		$field[] = array('field' => 'car', 'title' => 'car');
		$field[] = array('field' => 'seq', 'title' => 'seq');
		$field[] = array('field' => 'note', 'title' => 'note');
		$field[] = array('field' => 'work_order_production_supply_id', 'title' => 'work_order_production_supply_id');
		$field[] = array('field' => 'quantity_supply', 'title' => 'quantity_supply');
	
		$new_work_order_production = isset($_POST['new_work_order_production']) ? $_POST['new_work_order_production'] : 0;
		$work_order_production_list_id = isset($_POST['work_order_production_list_id']) ? $_POST['work_order_production_list_id'] : 0;
		$work_order_production_supply_id = isset($_POST['work_order_production_supply_id']) ? $_POST['work_order_production_supply_id'] : 0;
		$lock_data = isset($_POST['lock_data']) ? $_POST['lock_data'] : 0;
		
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";
		$loaddata_table = array();
		
		if($lock_data == 0){
			$view = 'dbo.view_stock_move_supply_production';
			$where = array();
			$where['work_order_production_list_id'] = $work_order_production_list_id;
			$loaddata = $this->ecc_library->loaddata($view,$field, $where);
				
			foreach($loaddata['data'] as $key => $value){
				$this_order[$key] = 0;
				
				$new_row = array();
				$new_row[] = $value[0];
				$new_row[] = $value[1];
				$new_row[] = $value[2];
				$new_row[] = $value[3];
				$new_row[] = $value[4];
				$new_row[] = $value[5];
				$new_row[] = $value[6];
				$new_row[] = $this->mainconfig->get_decimal_format3($value[7],12);
				$new_row[] = $value[8];
				$new_row[] = $value[9];
				$new_row[] = $value[10];
				$new_row[] = $value[11];
				$new_row[] = $value[12];
				$new_row[] = $this->mainconfig->get_decimal_format3($value[13],12);
								
				$loaddata_table[$value[0]] = $new_row;
			}
		}
		
		$loaddata['data'] = array();
		foreach($loaddata_table as $value){
			
			if($value[12] != 0){
				$data = array();
				$data[] = $value[0];
				$data[] = $value[1];
				$data[] = $value[2];
				$data[] = $value[3];
				$data[] = $value[4];
				$data[] = $value[5];
				$data[] = $value[6];
				$data[] = $value[7];
				$data[] = $value[8];
				$data[] = $value[9];
				$data[] = $value[10];
				$data[] = $value[11];
				$data[] = $value[12];
				$data[] = $value[13];
							
				$loaddata['data'][] = $data;
			}
		}
		
		echo json_encode($loaddata);
	}
	
	function post_add_edit_supply(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
		
		$stock_move_id = isset($_POST['stock_move_id']) ? $_POST['stock_move_id'] : false;
		$work_order_production_list_id = isset($_POST['work_order_production_list_id']) ? $_POST['work_order_production_list_id'] : 0;
		$work_order_production_supply_id = isset($_POST['work_order_production_supply_id']) ? $_POST['work_order_production_supply_id'] : '';
		$quantity_supply = isset($_POST['quantity_supply']) ? $_POST['quantity_supply'] : 0;
		$work_order_production_id = isset($_POST['work_order_production_id']) ? $_POST['work_order_production_id'] : 0;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			if($work_order_production_supply_id){
				$this->rpc_service->setSP("dbo.sp_work_order_production_supply_edit");
				$this->rpc_service->addField('work_order_production_supply_id',$work_order_production_supply_id);
			} else {
				$this->rpc_service->setSP("dbo.sp_work_order_production_supply_add");
			}
			
			$this->rpc_service->addField('work_order_production_id',$work_order_production_id);
			$this->rpc_service->addField('work_order_production_list_id',$work_order_production_list_id);
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
				
		$work_order_production_id = isset($_POST['work_order_production_id']) ? $_POST['work_order_production_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			
			if($work_order_production_id){
				$this->rpc_service->setSP("dbo.sp_work_order_production_supply_fifo");
				$this->rpc_service->addField('work_order_production_id',$work_order_production_id);
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
				
		$work_order_production_id = isset($_POST['work_order_production_id']) ? $_POST['work_order_production_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			
			if($work_order_production_id){
				$this->rpc_service->setSP("dbo.sp_work_order_production_supply_lifo");
				$this->rpc_service->addField('work_order_production_id',$work_order_production_id);
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
	
	function print_production()
   {
      $work_order_production_id = isset($_POST['work_order_production_id']) ? $_POST['work_order_production_id'] : false;
      $reject = isset($_POST['reject']) ? $_POST['reject'] : false;
      $format = isset($_POST['format']) ? $_POST['format'] : 'xlsx';
      $user_id = $this->session->userdata('user_id');
      
      // echo $reject;
      // die();
      if($reject==0){
         $sp = "dbo.sp_rpt_slip_penerimaan_barang_jadi";
               
         $this->rpc_service_portal->setSP(array("sp"=>$sp,"mode"=>"2","debug"=>"1"));
         $this->rpc_service_portal->addField('work_order_production_id',$work_order_production_id);
         $this->rpc_service_portal->addField('format',$format);
         $this->rpc_service_portal->addField('temp_folder',sys_get_temp_dir());
         $this->rpc_service_portal->addField('sort','e.item_code asc');  
         
         $result = $this->rpc_service_portal->resultPrint2();
         echo json_encode($result);
      }else{
         $sp = "dbo.sp_rpt_slip_penerimaan_reject";
               
         $this->rpc_service_portal->setSP(array("sp"=>$sp,"mode"=>"2","debug"=>"1"));
         $this->rpc_service_portal->addField('work_order_production_id',$work_order_production_id);
         $this->rpc_service_portal->addField('format',$format);
         $this->rpc_service_portal->addField('temp_folder',sys_get_temp_dir());
         $this->rpc_service_portal->addField('sort','e.item_code asc');  
         
         $result = $this->rpc_service_portal->resultPrint2();
         echo json_encode($result);
      }
      
   }
}

?>