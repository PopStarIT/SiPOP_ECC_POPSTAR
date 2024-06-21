<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Parameter extends CI_Controller { 

	function __construct(){ 
		parent::__construct(); 
	} 

	function index(){ 
		$view = "view_config";
		$component['loadlayout'] = true;
		
		$component['load_js'][] = 'controlpanel/system/parameter';
		
		$columnsetting = array();
		$columnsetting['hidden'][0] = true;
		$columnsetting['hidden'][3] = true;
		$columnsetting['hidden'][5] = true;
		$columnsetting['hidden'][6] = true;
		$columnsetting['hidden'][7] = true;
		
		$component['columntable'] = $this->dbfunc->datatable($view,'column',$columnsetting);
		
		$component['view_load'] = 'controlpanel/system/parameter';
		$component['page_title'] = 'Parameter';
		
		$this->authentication->cplayout($component);	
	} 
	
	function loaddata(){
		$view = "view_config";
		$this->dbfunc->datatable($view,'data');		
	}
	
	function frmadd(){
		$component['loadlayout'] = true;
		
		$component['load_js'][] = 'controlpanel/system/parameter_form';
		
		$component['view_load'] = 'controlpanel/system/parameter_form';
		$component['page_title'] = T_("New Parameter");
		
		$component['type'] = $this->main->getData('prm_configtype');
				
		$this->authentication->cplayout($component);
	}
	
	function frmedit($key = null){
		$component['loadlayout'] = true;
		
		$component['id'] = $key;
		$component['param'] = '';
		$component['typeid'] = '';
		
		$where['id'] = $key;
		
		$parameter = $this->main->getData('view_config',null,$where);
		if($parameter && $key){
			foreach($parameter as $dt_parameter){
				$component['param'] = $dt_parameter->param;
				$component['typeid'] = $dt_parameter->typeid;
			}
		}
		
		
		
		$component['load_js'][] = 'controlpanel/system/parameter_form';
		$component['view_load'] = 'controlpanel/system/parameter_form';
		$component['page_title'] = T_("Edit Parameter");
		
		$component['type'] = $this->main->getData('prm_configtype');
				
		$this->authentication->cplayout($component);
	}
	
	function postform(){
		$parameter = array();
		$return = array();
		
		$id =  isset($_POST['id']) ? $_POST['id'] : NULL;
		$param =  isset($_POST['param']) ? strtolower($_POST['param']) : NULL;
		$typeid =  isset($_POST['typeid']) ? $_POST['typeid'] : NULL;
		$value =  isset($_POST['value']) ? $_POST['value'] : NULL;
		
		$array = array();
		if(count($_POST) > 0){
			
			if($id){
				$array['id'] = $id;
				$array['param'] = $param;
				$array['typeid'] = $typeid;
				$array['value'] = $value;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
				
				$edit_config = $this->main->executeSP('sp_brick_edit_config',$parameter);
				foreach($edit_config as $dt_edit_config){
					$return['valid'] = $dt_edit_config->valid;
					$return['message'] = $dt_edit_config->message;
				}
			} else {
				$array['param'] = $param;
				$array['typeid'] = $typeid;
				$array['value'] = $value;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
				$insert_config = $this->main->executeSP('sp_brick_insert_config',$parameter);
				foreach($insert_config as $dt_insert_config){
					$return['valid'] = $dt_insert_config->valid;
					$return['message'] = $dt_insert_config->message;
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
						
			$delete_config = $this->main->executeSP('sp_brick_delete_config',$parameter);
			foreach($delete_config as $dt_delete_config){
				$return['valid'] = $dt_delete_config->valid;
				$return['message'] = $dt_delete_config->message;
			}
		}
				
		echo json_encode($return);
	}
	
	function baseconfig(){
		
		$component['load_js'][] = 'controlpanel/system/baseconfig';
		$component['parameter'] = $this->main->getData('view_config');
				
		$component['view_load'] = 'controlpanel/system/baseconfig';
		$component['page_title'] = 'Base Configuration';
		
		$this->authentication->cplayout($component);	
	}
	
	function postconfig(){
		
		$parameter = array();
		$return = array();
		
		$data = isset($_POST['data']) ? $_POST['data'] : array();
		
		$array = array();
		if(count($_POST) > 0){
			$array['param_config'] = array();
			foreach($data as $key=>$value){ 
				$array['param_config'][$key] = array('id' => $key, 'value' => trim(htmlentities($value, ENT_QUOTES)));	
			}
			
			$array['userid'] = $this->mainconfig->userdata('userid');
			
			$this->load->library('array2xml', $array);
			$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
			
			$edit_config = $this->main->executeSP('sp_brick_config_edit',$parameter);
			foreach($edit_config as $dt_edit_config){
				$return['valid'] = $dt_edit_config['valid'];
				$return['message'] = $dt_edit_config['message'];
			}
		}
				
		echo json_encode($return);
		
	}
}