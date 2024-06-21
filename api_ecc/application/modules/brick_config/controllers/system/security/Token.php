<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Token extends CI_Controller { 

	function __construct(){ 
		parent::__construct(); 
	} 
	
	function index(){ 
		$view = "view_token";
		
		$component['load_js'][] = 'controlpanel/system/security/token';
		
		$columnsetting = array();
		$component['columntable'] = $this->dbfunc->datatable($view,'column',$columnsetting);
		
		$component['view_load'] = 'controlpanel/system/security/token';
		$component['page_title'] = 'Tokens';
		
		$this->authentication->cplayout($component);	
	} 
	
	function loaddata(){
		$view = "view_token";
		$this->dbfunc->datatable($view,'data');		
	}
	
	function frmadd(){
		$component['loadlayout'] = true;
		
		$component['load_js'][] = 'controlpanel/system/security/token_form';
		$component['view_load'] = 'controlpanel/system/security/token_form';
		$component['page_title'] = T_("New Token");
				
		$this->authentication->cplayout($component);
	}
	
	function frmedit($key = null){
		$component['loadlayout'] = true;
		
		$component['id'] = $key;
		$component['token'] = '';
		$component['note'] = '';
		
		$where['id'] = $key;
		
		$token = $this->main->getData('view_token',null,$where);
		if($token && $key){
			foreach($token as $dt_token){
				$component['token'] = $dt_token->token;
				$component['note'] = $dt_token->note;
			}
		}
		
		$component['load_js'][] = 'controlpanel/system/security/token_form';
		$component['view_load'] = 'controlpanel/system/security/token_form';
		$component['page_title'] = T_("Edit Token");

		$this->authentication->cplayout($component);
	}
	
	function postform(){
		$parameter = array();
		$return = array();
		
		$id =  isset($_POST['id']) ? $_POST['id'] : NULL;
		$token =  isset($_POST['token']) ? $_POST['token'] : NULL;
		$note =  isset($_POST['note']) ? $_POST['note'] : NULL;
		
		$array = array();
		if(count($_POST) > 0){
			
			if($id){
				$array['id'] = $id;
				$array['token'] = $token;
				$array['note'] = $note;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
								
				$edit_token = $this->main->executeSP('sp_brick_edit_token',$parameter);
				foreach($edit_token as $dt_edit_token){
					$return['valid'] = $dt_edit_token->valid;
					$return['message'] = $dt_edit_token->message;
				}
			} else {
				$array['token'] = $token;
				$array['note'] = $note;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
				
				$insert_token = $this->main->executeSP('sp_brick_insert_token',$parameter);
				foreach($insert_token as $dt_insert_token){
					$return['valid'] = $dt_insert_token->valid;
					$return['message'] = $dt_insert_token->message;
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
			
			$delete_token = $this->main->executeSP('sp_brick_delete_token',$parameter);
			foreach($delete_token as $dt_delete_token){
				$return['valid'] = $dt_delete_token->valid;
				$return['message'] = $dt_delete_token->message;
			}
		}
				
		echo json_encode($return);
	}
}