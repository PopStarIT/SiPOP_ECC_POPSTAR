<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Method extends CI_Controller { 

	function __construct(){ 
		parent::__construct(); 
	} 

	function index(){ 
		$view = "view_script";
		
		$component['load_js'][] = 'controlpanel/system/module/method';
		
		$columnsetting = array();
		$columnsetting['hidden'][5] = true;
		$columnsetting['hidden'][6] = true;
		$columnsetting['hidden'][7] = true;
		$columnsetting['hidden'][8] = true;
		$columnsetting['hidden'][9] = true;
		$component['columntable'] = $this->dbfunc->datatable($view,'column',$columnsetting);
		
		
		$component['view_load'] = 'controlpanel/system/module/method';
		$component['page_title'] = 'Methods';
		
		$this->authentication->cplayout($component);	
	} 
	
	function loaddata(){
		$view = "view_script";
		$this->dbfunc->datatable($view,'data');		
	}
	
	function frmadd(){
		$component['loadlayout'] = true;
		
		$component['module'] = $this->main->getData('view_module');
		$component['token'] = $this->main->getData('view_token');
		
		$component['load_js'][] = 'controlpanel/system/module/method_form';
		$component['view_load'] = 'controlpanel/system/module/method_form';
		$component['page_title'] = T_("Add Method");
				
		$this->authentication->cplayout($component);
	}
	
	function frmedit($key=false){
		if($key){
			$component['loadlayout'] = true;
			
			$component['id'] = $key;
			
			$where['id'] = $key;
			$method = $this->main->getData('view_script',null,$where);
			if($method && $key){
				foreach($method as $dt_method){
					$component['moduleid'] = $dt_method->moduleid;
					$component['directory'] = $dt_method->directory;
					$component['classid'] = $dt_method->classid;
					$component['method'] = $dt_method->method;
					$component['script'] = $dt_method->script;
					$component['tokenid'] = $dt_method->tokenid;
					$component['note'] = $dt_method->note;
				}
			}
			
			$where_dir = array();
			$where_dir['moduleid'] = $component['moduleid'] ;
			
			$order_dir = 'directory asc';
			$component['directories'] = $this->main->getData('view_directory',null,$where_dir,null,$order_dir);
			
			$where_class = array();
			$where_class['moduleid'] = $component['moduleid'] ;
			$where_class['directory'] = $component['directory'] ;
		
			$component['class'] = $this->main->getData('view_class',null,$where_dir,null);
			
			
			$component['module'] = $this->main->getData('view_module');
			$component['token'] = $this->main->getData('view_token');
			
			$component['load_js'][] = 'controlpanel/system/module/method_form';
			$component['view_load'] = 'controlpanel/system/module/method_form';
			$component['page_title'] = T_("Edit Method");
					
			$this->authentication->cplayout($component);
		} else {
			redirect(base_url()."cpanel/system/module/classs/", 'refresh');
		}	
	}
	
	function postform(){
		$parameter = array();
		$return = array();
		
		$id =  isset($_POST['id']) ? $_POST['id'] : NULL;
		$moduleid =  isset($_POST['moduleid']) ? $_POST['moduleid'] : NULL;
		$directory =  isset($_POST['directory']) ? $_POST['directory'] : NULL;
		$classid =  isset($_POST['classid']) ? $_POST['classid'] : NULL;
		$method =  isset($_POST['method']) ? $_POST['method'] : NULL;
		$script =  isset($_POST['script']) ? trim(ltrim(rtrim(trim(html_entity_decode($_POST['script'])), "?>"),"<?php")) : NULL;
		$tokenid =  isset($_POST['tokenid']) ? $_POST['tokenid'] : 0;
		$note =  isset($_POST['note']) ? $_POST['note'] : NULL;
		
		$array = array();
		if(count($_POST) > 0){
			if($id){			
				$array['id'] = $id;
				$array['moduleid'] = $moduleid;
				$array['directory'] = $directory;
				$array['classid'] = $classid;
				$array['method'] = $method;
				$array['script'] = $script;
				$array['tokenid'] = $tokenid;
				$array['note'] = $note;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
				
				$edit_module = $this->main->executeSP('sp_brick_edit_method',$parameter);
				foreach($edit_module as $dt_edit_module){
					$return['valid'] = $dt_edit_module->valid;
					$return['message'] = $dt_edit_module->message;
				}
			} else {
				$array['moduleid'] = $moduleid;
				$array['directory'] = $directory;
				$array['classid'] = $classid;
				$array['method'] = $method;
				$array['script'] = $script;
				$array['tokenid'] = $tokenid;
				$array['note'] = $note;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
				
				$insert_module = $this->main->executeSP('sp_brick_insert_method',$parameter);
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
			
			$delete_module = $this->main->executeSP('sp_brick_delete_method',$parameter);
			foreach($delete_module as $dt_delete_module){
				$return['valid'] = $dt_delete_module->valid;
				$return['message'] = $dt_delete_module->message;
			}
		}
				
		echo json_encode($return);
	}
	
}