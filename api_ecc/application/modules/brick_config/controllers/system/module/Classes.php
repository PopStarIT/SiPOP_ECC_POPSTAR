<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Classes extends CI_Controller { 

	function __construct(){ 
		parent::__construct(); 
	} 

	function index(){ 
		$view = "view_class";
		
		$component['load_js'][] = 'controlpanel/system/module/class';
		
		$columnsetting = array();
		$columnsetting['hidden'][5] = true;
		$columnsetting['hidden'][6] = true;
		$component['columntable'] = $this->dbfunc->datatable($view,'column',$columnsetting);
		
		
		$component['view_load'] = 'controlpanel/system/module/class';
		$component['page_title'] = 'Classes';
		
		$this->authentication->cplayout($component);	
	} 
	
	function loaddata(){
		$view = "view_class";
		$this->dbfunc->datatable($view,'data');		
	}
	
	function frmadd(){
		$component['loadlayout'] = true;
		
		$component['module'] = $this->main->getData('view_module');
		$component['load_js'][] = 'controlpanel/system/module/class_form';
		$component['view_load'] = 'controlpanel/system/module/class_form';
		$component['page_title'] = T_("Add Class");
				
		$this->authentication->cplayout($component);
	}
	
	function frmedit($key = null){
		$component['loadlayout'] = true;
		
		$component['id'] = $key;
		
		$component['type'] = $this->main->getData('prm_configtype');
		
		$where['id'] = $key;
		$class = $this->main->getData('view_class',null,$where);
		if($class && $key){
			foreach($class as $dt_class){
				$component['moduleid'] = $dt_class->moduleid;
				$component['directory'] = $dt_class->directory;
				$component['class'] = $dt_class->class;
				$component['construct'] = $dt_class->construct;
				$component['note'] = $dt_class->note;
			}
		}
		$component['module'] = $this->main->getData('view_module');
		$component['load_js'][] = 'controlpanel/system/module/class_form';
		$component['view_load'] = 'controlpanel/system/module/class_form';
		$component['page_title'] = T_("Edit Class");
				
		$this->authentication->cplayout($component);	
	}
		
	function postform(){
		$parameter = array();
		$return = array();
		
		$id =  isset($_POST['id']) ? $_POST['id'] : NULL;
		$moduleid =  isset($_POST['moduleid']) ? $_POST['moduleid'] : NULL;
		$directory =  isset($_POST['directory']) ? $_POST['directory'] : NULL;
		$class =  isset($_POST['class']) ? $_POST['class'] : NULL;
		$construct =  isset($_POST['construct']) ? trim(ltrim(rtrim(trim(html_entity_decode($_POST['construct'])), "?>"),"<?php")) : NULL;
		$note =  isset($_POST['note']) ? $_POST['note'] : NULL;
		
		$array = array();
		if(count($_POST) > 0){
			if($id){
				$array['id'] = $id;
				$array['moduleid'] = $moduleid;
				$array['directory'] = $directory;
				$array['class'] = $class;
				$array['construct'] = $construct;
				$array['note'] = $note;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
								
				$edit_module = $this->main->executeSP('sp_brick_edit_class',$parameter);
				foreach($edit_module as $dt_edit_module){
					$return['valid'] = $dt_edit_module->valid;
					$return['message'] = $dt_edit_module->message;
				}
			} else {
				$array['moduleid'] = $moduleid;
				$array['directory'] = $directory;
				$array['class'] = $class;
				$array['construct'] = $construct;
				$array['note'] = $note;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
								
				$insert_module = $this->main->executeSP('sp_brick_insert_class',$parameter);
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
			
			$delete_module = $this->main->executeSP('sp_brick_delete_class',$parameter);
			foreach($delete_module as $dt_delete_module){
				$return['valid'] = $dt_delete_module->valid;
				$return['message'] = $dt_delete_module->message;
			}
		}
				
		echo json_encode($return);
	}
	
}