<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Module extends CI_Controller { 

	function __construct(){ 
		parent::__construct(); 
	} 

	function index(){ 
		$view = "view_module";
		
		$component['load_js'][] = 'controlpanel/system/module/module';
		
		$columnsetting = array();
		$component['columntable'] = $this->dbfunc->datatable($view,'column',$columnsetting);
		
		
		$component['view_load'] = 'controlpanel/system/module/module';
		$component['page_title'] = 'Module';
		
		$this->authentication->cplayout($component);	
	} 
	
	function loaddata(){
		$view = "view_module";
		$this->dbfunc->datatable($view,'data');		
	}
		
	function frmadd(){
		$component['loadlayout'] = true;
		
		$component['load_js'][] = 'controlpanel/system/module/module_form';
		$component['view_load'] = 'controlpanel/system/module/module_form';
		$component['page_title'] = T_("Add Module");
				
		$this->authentication->cplayout($component);
	}
	
	function frmedit($key = null){
		$component['loadlayout'] = true;
		
		$component['id'] = $key;
		$component['module'] = '';
		$component['note'] = '';
		
		$component['type'] = $this->main->getData('prm_configtype');
		
		$where['id'] = $key;
		
		$module = $this->main->getData('view_module',null,$where);
		if($module && $key){
			foreach($module as $dt_module){
				$component['module'] = $dt_module->module;
				$component['note'] = $dt_module->note;
			}
		}
		
		$component['load_js'][] = 'controlpanel/system/module/module_form';
		$component['view_load'] = 'controlpanel/system/module/module_form';
		$component['page_title'] = T_("Edit Module");
				
		$this->authentication->cplayout($component);	
	}
	
	function postform(){
		$parameter = array();
		$return = array();
		
		$id =  isset($_POST['id']) ? $_POST['id'] : NULL;
		$module =  isset($_POST['module']) ? $_POST['module'] : NULL;
		$note =  isset($_POST['note']) ? $_POST['note'] : NULL;
		
		$array = array();
		if(count($_POST) > 0){
			if($id){
				$array['id'] = $id;
				$array['module'] = $module;
				$array['note'] = $note;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
				
				$edit_module = $this->main->executeSP('sp_brick_edit_module',$parameter);
				foreach($edit_module as $dt_edit_module){
					$return['valid'] = $dt_edit_module->valid;
					$return['message'] = $dt_edit_module->message;
				}
			} else {
				$array['module'] = $module;
				$array['note'] = $note;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
				
				$edit_module = $this->main->executeSP('sp_brick_edit_module',$parameter);
				foreach($edit_module as $dt_edit_module){
					$return['valid'] = $dt_edit_module->valid;
					$return['message'] = $dt_edit_module->message;
				}
				
				$insert_module = $this->main->executeSP('sp_brick_insert_module',$parameter);
				foreach($insert_module as $dt_insert_module){
					$return['valid'] = $dt_insert_module->valid;
					$return['message'] = $dt_insert_module->message;
				}
			}
		}

		echo json_encode($return);
	}
	
	function deletedata(){
		$parameter = array();
		$return = array();
		
		$id = isset($_POST['id']) ? $_POST['id'] : null;
		
		$array = array();
		if(count($_POST) > 0){
			$array['id'] = $id;
			$array['userid'] = $this->mainconfig->userdata('userid');
			
			$this->load->library('array2xml', $array);
			$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
				
			$delete_module = $this->main->executeSP('sp_brick_delete_module',$parameter);
			foreach($delete_module as $dt_delete_module){
				$return['valid'] = $dt_delete_module->valid;
				$return['message'] = $dt_delete_module->message;
			}
		}
				
		echo json_encode($return);
	}
	
}