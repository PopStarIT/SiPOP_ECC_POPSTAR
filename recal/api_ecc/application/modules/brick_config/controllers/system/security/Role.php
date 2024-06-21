<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Role extends CI_Controller { 

	function __construct(){ 
		parent::__construct(); 
	} 

	function index(){ 
		$view = "view_role";
		
		$component['load_js'][] = 'controlpanel/system/security/role/role';
		
		$columnsetting = array();
		$component['columntable'] = $this->dbfunc->datatable($view,'column',$columnsetting);
		
		$component['view_load'] = 'controlpanel/system/security/role/role';
		$component['page_title'] = 'Roles';
		
		$this->authentication->cplayout($component);	
	} 
	
	function loaddata(){
		$view = "view_role";
		$this->dbfunc->datatable($view,'data');		
	}
		
	function frmadd(){
		$component['loadlayout'] = true;
		
		$component['load_js'][] = 'controlpanel/system/security/role/role_form';
		$component['view_load'] = 'controlpanel/system/security/role/role_form';
		$component['page_title'] = T_("New Role");
		
		$component['token'] = $this->main->getData('func_brick_get_token(0)');

		$this->authentication->cplayout($component);
	}
	
	function frmedit($key = '0'){
		$component['loadlayout'] = true;
		
		$component['id'] = $key;
		$component['role'] = '';
		$component['note'] = '';
		
		$where['id'] = $key;
		$role = $this->main->getData('view_role',null,$where);

		if($role && $key){
			foreach($role as $dt_role){
				$component['role'] = $dt_role->role;
				$component['note'] = $dt_role->note;
			}
		}
		
		$component['load_js'][] = 'controlpanel/system/security/role/role_form';
		$component['view_load'] = 'controlpanel/system/security/role/role_form';
		$component['page_title'] = T_("New Role");
		
		$component['token'] = $this->main->getData("func_brick_get_token('". $key ."')");

		$this->authentication->cplayout($component);
	}
	
	function postform(){
		$parameter = array();
		$return = array();
		
		$id =  isset($_POST['id']) ? $_POST['id'] : NULL;
		$role =  isset($_POST['role']) ? $_POST['role'] : NULL;
		$note =  isset($_POST['note']) ? $_POST['note'] : NULL;
		$tokenid =  isset($_POST['tokenid']) ? $_POST['tokenid'] : array();
		
		$array = array();
		if(count($_POST) > 0){
			if($id){
				$array['id'] = $id;
				$array['role'] = $role;
				$array['token'] = array();
				foreach($tokenid as $key=>$value){ 
					$array['token'][$key] = array('tokenid' => $key);	
				}
				$array['note'] = $note;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
								
				$edit_role = $this->main->executeSP('sp_brick_edit_role',$parameter);
				foreach($edit_role as $dt_edit_role){
					$return['valid'] = $dt_edit_role->valid;
					$return['message'] = $dt_edit_role->message;
				}
			} else {
				$array['role'] = $role;
				$array['token'] = array();
				foreach($tokenid as $key=>$value){ 
					$array['token'][$key] = array('tokenid' => $key);	
				}
				$array['note'] = $note;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
								
				$insert_role = $this->main->executeSP('sp_brick_insert_role',$parameter);
				foreach($insert_role as $dt_insert_role){
					$return['valid'] = $dt_insert_role->valid;
					$return['message'] = $dt_insert_role->message;
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
			
			$delete_role = $this->main->executeSP('sp_brick_delete_role',$parameter);
			foreach($delete_role as $dt_delete_role){
				$return['valid'] = $dt_delete_role->valid;
				$return['message'] = $dt_delete_role->message;
			}
		}
				
		echo json_encode($return);
	}
	
	function rolegroup(){ 
		$view = "view_rolegroup";
		
		$component['load_js'][] = 'controlpanel/system/security/role/rolegroup';
		
		$columnsetting = array();
		$component['columntable'] = $this->dbfunc->datatable($view,'column',$columnsetting);
		
		$component['view_load'] = 'controlpanel/system/security/role/rolegroup';
		$component['page_title'] = 'Role Groups';
		
		$this->authentication->cplayout($component);	
	} 
	
	function loaddatagroup(){
		$view = "view_rolegroup";
		$this->dbfunc->datatable($view,'data');		
	}
	
	function frmaddgroup(){
		$component['loadlayout'] = true;
		
		$component['load_js'][] = 'controlpanel/system/security/role/rolegroup_form';
		$component['view_load'] = 'controlpanel/system/security/role/rolegroup_form';
		$component['page_title'] = T_("New Role Group");
		
		$component['role'] = $this->main->getData('func_brick_get_role(0)');

		$this->authentication->cplayout($component);
	}
	
	function frmeditgroup($key = '0'){
		$component['loadlayout'] = true;
		
		$component['id'] = $key;
		$component['group'] = '';
		$component['note'] = '';
		
		$where['id'] = $key;
		$group = $this->main->getData('view_rolegroup',null,$where);

		if($group && $key){
			foreach($group as $dt_group){
				$component['group'] = $dt_group->group;
				$component['note'] = $dt_group->note;
			}
		}
		
		$component['loadlayout'] = true;
		
		$component['load_js'][] = 'controlpanel/system/security/role/rolegroup_form';
		$component['view_load'] = 'controlpanel/system/security/role/rolegroup_form';
		$component['page_title'] = T_("Edit Role Group");
		
		$component['role'] = $this->main->getData("func_brick_get_role('". $key ."')");

		$this->authentication->cplayout($component);	
	}
	
	function postformgroup(){
		$parameter = array();
		$return = array();
		
		$id =  isset($_POST['id']) ? $_POST['id'] : NULL;
		$group =  isset($_POST['group']) ? $_POST['group'] : NULL;
		$note =  isset($_POST['note']) ? $_POST['note'] : NULL;
		$roleid =  isset($_POST['roleid']) ? $_POST['roleid'] : array();
		
		$array = array();
		if(count($_POST) > 0){
			if($id){
				$array['id'] = $id;
				$array['group'] = $group;
				$array['role'] = array();
				foreach($roleid as $key=>$value){ 
					$array['role'][$key] = array('roleid' => $key);	
				}
				$array['note'] = $note;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
				
				$edit_rolegroup = $this->main->executeSP('sp_brick_edit_rolegroup',$parameter);
				foreach($edit_rolegroup as $dt_edit_rolegroup){
					$return['valid'] = $dt_edit_rolegroup->valid;
					$return['message'] = $dt_edit_rolegroup->message;
				}
			} else {
				$array['group'] = $group;
				$array['role'] = array();
				foreach($roleid as $key=>$value){ 
					$array['role'][$key] = array('roleid' => $key);	
				}
				$array['note'] = $note;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
				
				$insert_rolegroup = $this->main->executeSP('sp_brick_insert_rolegroup',$parameter);
				foreach($insert_rolegroup as $dt_insert_rolegroup){
					$return['valid'] = $dt_insert_rolegroup->valid;
					$return['message'] = $dt_insert_rolegroup->message;
				}
			}
		}

		echo json_encode($return);
	}
	
	function deletedatagroup(){
		$parameter = array();
		$return = array();
		
		$id = isset($_POST['id']) ? $_POST['id'] : null;
		
		$array = array();
		if(count($_POST) > 0){
			$array['id'] = $id;
			$array['userid'] = $this->mainconfig->userdata('userid');
			
			$this->load->library('array2xml', $array);
			$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
			
			$delete_rolegroup = $this->main->executeSP('sp_brick_delete_rolegroup',$parameter);
			foreach($delete_rolegroup as $dt_delete_rolegroup){
				$return['valid'] = $dt_delete_rolegroup->valid;
				$return['message'] = $dt_delete_rolegroup->message;
			}
		}
				
		echo json_encode($return);
	}
}