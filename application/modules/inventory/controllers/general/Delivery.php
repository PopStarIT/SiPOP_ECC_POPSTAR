<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Delivery extends CI_Controller { 

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
	
	function delivery_table(){
		$field = array();
		$field[] = array('field' => 'delivery_id', 'title' => 'DELIVERY ID','visible'=>false);
		$field[] = array('field' => 'delivery_type', 'title' => 'DELIVERY TYPE');
		$field[] = array('field' => 'delivery_no', 'title' => 'DELIVERY NO');
		$field[] = array('field' => 'delivery_date', 'title' => 'DELIVERY DATE', 'data_type' => 'date');
		$field[] = array('field' => 'delivery_status', 'title' => 'DELIVERY STATUS');$field[] = array('field' => 'create_by', 'title' => 'CREATE BY');
		$field[] = array('field' => 'create_date', 'title' => 'CREATE DATE', 'data_type' => 'date');
		$field[] = array('field' => 'edit_by', 'title' => 'EDIT BY');
		$field[] = array('field' => 'edit_date', 'title' => 'EDIT DATE', 'data_type' => 'date');
		return $field;
	}
	
	function index(){
		$this->load->model('main');
		$component['loadlayout'] = true;
		$component['view_load'] = 'general/delivery/view';
		$component['view_load_form'] = 'general/delivery/form';
		$component['load_js'][] = 'general/delivery/view';
		$component['load_js'][] = 'general/delivery/form';
		
		$component['page_title'] = "Delivery";
		
		$dashboard_table = array();
		
		$nav_button = array();
		$nav_button[] = array('method_id' => 325,'title' => 'Add', 'icon' => 'fa fa-plus', 'load' => 'general/delivery/function_add');
		$nav_button[] = array('method_id' => 717,'title' => 'Add From Sales', 'icon' => 'fa fa-pencil', 'load' => 'general/delivery/function_add_from_sales');
		$nav_button[] = array('method_id' => 326,'title' => 'Edit', 'icon' => 'fa fa-pencil', 'load' => 'general/delivery/function_edit');
		$nav_button[] = array('method_id' => 328,'title' => 'Approve', 'icon' => 'fa fa-check', 'load' => 'general/delivery/function_approve');
		$nav_button[] = array('method_id' => 327,'title' => 'Delete', 'icon' => 'fa fa-trash-o', 'load' => 'general/delivery/function_delete');
		$nav_button[] = array('method_id' => 732,'title' => 'Print', 'icon' => 'fa fa-print', 'load' => 'general/delivery/function_print');
		$nav_button[] = array('method_id' => 754,'title' => 'Cancel Approve', 'icon' => 'fa fa-cross', 'load' => 'general/delivery/function_cancel_approve');
		
		$field = $this->delivery_table();
		
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
		
		$view = 'dbo.view_delivery';
		$field = $this->delivery_table();
		$loaddata = $this->ecc_library->loaddata($view,$field);
			
		echo json_encode($loaddata);
	}
	
	function approve(){
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
				
		$delivery_id = isset($_POST['delivery_id']) ? $_POST['delivery_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			
			if($delivery_id){
				$this->rpc_service->setSP("dbo.sp_delivery_approve");
				$this->rpc_service->addField('delivery_id',$delivery_id);
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
				
		$delivery_id = isset($_POST['delivery_id']) ? $_POST['delivery_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			
			if($delivery_id){
				$this->rpc_service->setSP("dbo.sp_delivery_cancel_approve");
				$this->rpc_service->addField('delivery_id',$delivery_id);
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
				
		$delivery_id = isset($_POST['delivery_id']) ? $_POST['delivery_id'] : false;
		
		$user_id = $this->session->userdata('user_id');
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			
			if($delivery_id){
				$this->rpc_service->setSP("dbo.sp_delivery_delete");
				$this->rpc_service->addField('delivery_id',$delivery_id);
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
				
		$delivery_id = isset($_POST['delivery_id']) ? $_POST['delivery_id'] : '';
		$delivery_no = isset($_POST['delivery_no']) ? $_POST['delivery_no'] : '';
		$delivery_date = isset($_POST['delivery_date']) ? $_POST['delivery_date'] : '';
		$delivery_type_id = isset($_POST['delivery_type_id']) ? $_POST['delivery_type_id'] : '';
		$partner_id = isset($_POST['partner_id']) ? $_POST['partner_id'] : '';
		$bc_out_header_id = isset($_POST['bc_out_header_id']) ? $_POST['bc_out_header_id'] : '';
		$sales_order_transfer_id = isset($_POST['sales_order_transfer_id']) ? $_POST['sales_order_transfer_id'] : '';
		$quantity_delivered = isset($_POST['quantity_delivered']) ? $_POST['quantity_delivered'] : array();
		$bc_out_barang_id = isset($_POST['bc_out_barang_id']) ? $_POST['bc_out_barang_id'] : array();
		
		$user_id = $this->session->userdata('user_id');
		
		if($sales_order_transfer_id == 'undefined'){
			$sales_order_transfer_id = null;
		}
		
		if($bc_out_header_id == 'undefined'){
			$bc_out_header_id = null;
		}
		
		
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		
		if(count($_POST) > 0){
			
			if($delivery_id){
				$this->rpc_service->setSP("dbo.sp_delivery_edit");
				$this->rpc_service->addField('delivery_id',$delivery_id);
			} else {
				$this->rpc_service->setSP("dbo.sp_delivery_add");
			}	
			
			if($delivery_type_id == 1){
				foreach($quantity_delivered as $key=>$value){
					if($value > 0){
						$data = array();
						$data['sales_order_detail_id'] = $key;
						$data['quantity_delivered'] = $value;
						$data['delivery_detail_id'] = 0;
						
						$this->rpc_service->addAttributeChild('dt' ,$data);
					}
				}
			} else if ($delivery_type_id == 2){
				foreach($quantity_delivered as $key=>$value){
					if($value > 0){
						$data = array();
						$data['bc_out_barang_id'] = $key;
						$data['quantity_delivered'] = $value;
						$data['delivery_detail_id'] = 0;
						
						$this->rpc_service->addAttributeChild('dt' ,$data);
					}
				}
			}
			
			$this->rpc_service->addField('delivery_no',$delivery_no);
			$this->rpc_service->addField('delivery_date',$delivery_date);
			$this->rpc_service->addField('delivery_type_id',$delivery_type_id);
			$this->rpc_service->addField('partner_id',$partner_id);
			$this->rpc_service->addField('bc_out_header_id',$bc_out_header_id);
			$this->rpc_service->addField('sales_order_transfer_id',$sales_order_transfer_id);
						
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

	function loaddata_custom_item(){
		$this->authentication->plainlayout();
		
		$field = array();
		$field[] = array('field' => 'bc_out_barang_id', 'title' => 'sales_order_detail_id');
		$field[] = array('field' => 'custom_type_name', 'title' => 'custom_type_name');
		$field[] = array('field' => 'car', 'title' => 'car');
		$field[] = array('field' => 'bc_no', 'title' => 'bc_no');
		$field[] = array('field' => 'bc_date', 'title' => 'quantity_ordered');
		$field[] = array('field' => 'item', 'title' => 'item');
		$field[] = array('field' => 'quantity_custom', 'title' => 'quantity_custom');
		$field[] = array('field' => 'quantity_delivered', 'title' => 'quantity_delivered');
		$field[] = array('field' => 'unit', 'title' => 'unit');
		$field[] = array('field' => 'unit_delivered', 'title' => 'unit_delivered');
		$field[] = array('field' => 'outstanding_qty', 'title' => 'outstanding_qty');
		$field[] = array('field' => 'conversion', 'title' => 'conversion');
		$field[] = array('field' => 'item_id', 'title' => 'item_id');
		
		$new_delivery = isset($_POST['new_delivery']) ? $_POST['new_delivery'] : 0;
		$delivery_id = isset($_POST['delivery_id']) ? $_POST['delivery_id'] : 0;
		$lock_data = isset($_POST['lock_data']) ? $_POST['lock_data'] : 0;
		$delivery_type_id = isset($_POST['delivery_type_id']) ? $_POST['delivery_type_id'] : 0;
		$bc_out_header_id = isset($_POST['bc_out_header_id']) ? is_numeric($_POST['bc_out_header_id']) ? $_POST['bc_out_header_id'] : -1  : -1;
		$partner_id = isset($_POST['partner_id']) ? is_numeric($_POST['partner_id']) ? $_POST['partner_id'] : -1  : -1;
		//print_r($delivery_type_id);
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";
		$loaddata_table = array();
		if($lock_data == 0){
			$where = array();
			if($delivery_type_id != '2'){
				$where['bc_out_barang_id'] = -1;
			}
			$where['bc_out_header_id'] = $bc_out_header_id;
			$where['partner_id'] = $partner_id;
			$view = 'dbo.view_custom_export_item';
			$loaddata = $this->ecc_library->loaddata($view,$field,$where);
			
			foreach($loaddata['data'] as $key => $value){
				$this_order[$key] = 0;
				
				$new_row = array();
				$new_row[] = $value[0];
				$new_row[] = $value[1];
				$new_row[] = $value[2];
				$new_row[] = $value[3];
				$new_row[] = $value[4];
				$new_row[] = $value[5];
				$new_row[] = $this->mainconfig->get_decimal_format($value[6],12);
				$new_row[] = $this->mainconfig->get_decimal_format($value[7],12);
				$new_row[] = $value[8];
				$new_row[] =  "<input name=\"bc_out_barang_id[". $value[0] ."]\" type=\"hidden\" value=\"". $value[0] ."\" /><input class=\"form-control\" name=\"quantity_delivered[". $value[0] ."]\" type=\"text\" placeholder=\"This Received\" value=\"".$this->mainconfig->get_decimal_format($value[6],12)."\" />";
				
				//$new_row[] = "<input name=\"bc_out_barang_id[". $value[0] ."]\" type=\"hidden\" value=\"". $value[0] ."\" /><input class=\"form-control\" name=\"quantity_delivered[". $value[0] ."]\" type=\"text\" placeholder=\"This Received\" value=\"". $this->mainconfig->get_decimal_format2($this_order[$key],12) ."\" />";
				$new_row[] = $value[9];
				$new_row[] = $this->mainconfig->get_decimal_format($value[11],12);
				$new_row[] = "";
				
				$new_row[] = "";
				
				
				$loaddata_table[$value[0]] = $new_row;
			}
		}
		
		if($new_delivery == '0' AND $delivery_type_id == '2'){
			$view = 'dbo.view_delivery_detail_custom';
			
			$field = array();
			$field[] = array('field' => 'bc_out_barang_id', 'title' => 'sales_order_detail_id');
			$field[] = array('field' => 'custom_type_name', 'title' => 'custom_type_name');
			$field[] = array('field' => 'car', 'title' => 'car');
			$field[] = array('field' => 'bc_no', 'title' => 'bc_no');
			$field[] = array('field' => 'bc_date', 'title' => 'quantity_ordered');
			$field[] = array('field' => 'item', 'title' => 'item');
			$field[] = array('field' => 'quantity_custom', 'title' => 'quantity_custom');
			$field[] = array('field' => 'quantity_delivered', 'title' => 'quantity_delivered');
			$field[] = array('field' => 'unit', 'title' => 'unit');
			$field[] = array('field' => 'unit_delivered', 'title' => 'unit_delivered');
			$field[] = array('field' => 'outstanding_qty', 'title' => 'outstanding_qty');
			$field[] = array('field' => 'conversion', 'title' => 'conversion');
			$field[] = array('field' => 'item_id', 'title' => 'item_id');
			
			$where = array();
			$where['delivery_id'] = $delivery_id;
			$loaddata_sales = $this->ecc_library->loaddata($view,$field,$where);
			
			foreach($loaddata_sales['data'] as $key => $value){
				if($lock_data == 0){
					$this_order[$value[0]] = $value[10];
					
					$new_row = array();
					$new_row[] = $value[0];
					$new_row[] = $value[1];
					$new_row[] = $value[2];
					$new_row[] = $value[3];
					$new_row[] = $value[4];
					$new_row[] = $value[5];
					$new_row[] = $value[6];
					$new_row[] = $value[7];
					$new_row[] = $value[8];
					$new_row[] = "<input name=\"bc_out_barang_id[". $value[0] ."]\" type=\"hidden\" value=\"". $value[0] ."\" /><input class=\"form-control\" name=\"quantity_delivered[". $value[0] ."]\" type=\"text\" placeholder=\"This Received\" value=\"". $this->mainconfig->get_decimal_format2($this_order[$value[0]],12) ."\" />";
					$new_row[] = $value[9];
					$new_row[] = $value[11];
					$new_row[] = "";
					
					$new_row[] = "";
					
					$loaddata_table[$value[0]] = $new_row;
				} else {
					$this_order[$value[0]] = $value[10];
					$new_row = array();
					$new_row[] = $value[0];
					$new_row[] = $value[1];
					$new_row[] = $value[2];
					$new_row[] = $value[3];
					$new_row[] = $value[4];
					$new_row[] = $value[5];
					$new_row[] = $value[6];
					$new_row[] = $value[7];
					$new_row[] = $value[8];
					$this_order[$value[0]];
					$new_row[] = $value[9];
					$new_row[] = $value[11];
					$new_row[] = "";
					
					$new_row[] = "";
					
					
					$loaddata_table[$value[0]] = $new_row;
				}					
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
			$data[] = $value[7];
			$data[] = $value[8];
			$data[] = $value[9];
			$data[] = $value[10];
			$data[] = $value[11];
			$data[] = $value[12];
			$data[] = $value[13];
			
			$loaddata['data'][] = $data;
		}
		
		echo json_encode($loaddata);
	}
	
	function loaddata_sales_item(){
		$this->authentication->plainlayout();
		
		$field = array();
		$field[] = array('field' => 'sales_order_detail_id', 'title' => 'sales_order_detail_id');
		$field[] = array('field' => 'sales_order_no', 'title' => 'sales_order_no');
		$field[] = array('field' => 'sales_order_date', 'title' => 'sales_order_date');
		$field[] = array('field' => 'item', 'title' => 'item');
		$field[] = array('field' => 'quantity_ordered', 'title' => 'quantity_ordered');
		$field[] = array('field' => 'quantity_delivered', 'title' => 'quantity_delivered');
		$field[] = array('field' => 'unit', 'title' => 'unit');
		$field[] = array('field' => 'unit', 'title' => 'unit');
		$field[] = array('field' => 'outstanding_qty', 'title' => 'outstanding_qty');
		$field[] = array('field' => 'conversion', 'title' => 'conversion');
		$field[] = array('field' => 'item_id', 'title' => 'item_id');
		
		$new_delivery = isset($_POST['new_delivery']) ? $_POST['new_delivery'] : 0;
		$delivery_id = isset($_POST['delivery_id']) ? $_POST['delivery_id'] : 0;
		$lock_data = isset($_POST['lock_data']) ? $_POST['lock_data'] : 0;
		$delivery_type_id = isset($_POST['delivery_type_id']) ? $_POST['delivery_type_id'] : 0;
		$sales_order_transfer_id = isset($_POST['sales_order_transfer_id']) ? is_numeric($_POST['sales_order_transfer_id']) ? $_POST['sales_order_transfer_id'] : -1  : -1;
		$partner_id = isset($_POST['partner_id']) ? is_numeric($_POST['partner_id']) ? $_POST['partner_id'] : -1  : -1;
		
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";
		$loaddata_table = array();
		if($lock_data == 0){
			$where = array();
			if($delivery_type_id != '1'){
				$where['sales_order_detail_id'] = -1;
			}
			$where['sales_order_transfer_id'] = $sales_order_transfer_id;
			$where['partner_id'] = $partner_id;
			$view = 'dbo.view_sales_order_delivery';
			$loaddata = $this->ecc_library->loaddata($view,$field,$where);
			
			foreach($loaddata['data'] as $key => $value){
				$this_order[$key] = 0;
				
				$new_row = array();
				$new_row[] = $value[0];
				$new_row[] = $value[1];
				$new_row[] = $value[2];
				$new_row[] = $value[3];
				$new_row[] = $this->mainconfig->get_decimal_format($value[4],12);
				$new_row[] = $this->mainconfig->get_decimal_format($value[5],12);
				$new_row[] = $value[6];
				$new_row[] = $this->mainconfig->get_decimal_format($value[8],12);
				$new_row[] = $value[7];
				$new_row[] = $this->mainconfig->get_decimal_format($value[9],12);
				
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
			$data[] = $value[5];
			$data[] = $value[6];
			$data[] = $value[7];
			$data[] = $value[8];
			$data[] = $value[9];
			
			$loaddata['data'][] = $data;
		}
		
		echo json_encode($loaddata);
	}
	
	function print_delivery() {
      $delivery_id = isset($_POST['delivery_id']) ? $_POST['delivery_id'] : false;
      $format = isset($_POST['format']) ? $_POST['format'] : 'pdf';
      $user_id = $this->session->userdata('user_id');

      $sp = "dbo.sp_rpt_delivery";
            
      $this->rpc_service->setSP(array("sp"=>$sp,"mode"=>"2","debug"=>"1"));
      $this->rpc_service->addField('delivery_id',$delivery_id);
      $this->rpc_service->addField('format',$format);
      $this->rpc_service->addField('temp_folder',sys_get_temp_dir());
      $this->rpc_service->addField('sort','b.item_code asc');  
     // $result = $this->rpc_service->resultJSON();
	// $result = $this->rpc_service->resultXML();
	//$result = $this->rpc_service->resultPrint2_coba();
      $result = $this->rpc_service->resultPrint2();
      echo json_encode($result);
   }
}

?>