<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Loader extends CI_Controller { 

	function __construct(){ 
		parent::__construct(); 
	} 

	function index(){ 
	
		$component['view_load'] = 'controlpanel/dashboard';
		$component['page_title'] = 'Dashboard';
		
		$this->authentication->cplayout($component);	
	} 
	
	function loaddirectory(){
		$moduleid = isset($_REQUEST['moduleid']) ? $_REQUEST['moduleid'] : false;
		
		$key = null;
		$where = array();
		$where["moduleid"] = $moduleid;
		$group = null;
		$order = "directory asc";
		$limit = null;
		$offset = 0;
		
		$return = array();
		$directory = $this->main->getData('view_directory',$key,$where,$group,$order,$limit,$offset);
		if($directory){
			foreach($directory as $dt_directory){
				$return[] = array('id'=>$dt_directory->directory, 'directory'=>$dt_directory->directory);
			}
		} else {
			$return[] = array('id'=>" ", 'directory'=>" ");
		}
		
		echo json_encode($return);
	}
	
	function loadclass(){
		$moduleid = isset($_REQUEST['moduleid']) ? $_REQUEST['moduleid'] : false;
		$directory = isset($_REQUEST['directory']) ? $_REQUEST['directory'] : false;
				
		$key = null;
		$where = array();
		$where["moduleid"] = $moduleid;
		
		if($directory){
			if($directory == 'parent'){
				$where["directory"] = '';
			} else {
				$where["directory"] = $directory;
			}
		} else {
			$where["directory"] = '';
		}
		
		$group = null;
		$order = null;
		$limit = null;
		$offset = 0;
		
		$return = array();
		$class = $this->main->getData('view_class',$key,$where,$group,$order,$limit,$offset);
		if($class){
			foreach($class as $dt_class){
				$return[] = array('id'=>$dt_class->id, 'class'=>$dt_class->class);
			}
		} else {
			$return[] = array('id'=>" ", 'class'=>" ");
		}
		
		echo json_encode($return);
	}
	
	function loadmethod(){		
		$classid = isset($_REQUEST['classid']) ? $_REQUEST['classid'] : false;
		
		$key = null;
		$where = array();
		$where["classid"] = $classid;
		$group = null;
		$order = null;
		$limit = null;
		$offset = 0;
		
		$return = array();
		$method = $this->main->getData('view_script',$key,$where,$group,$order,$limit,$offset);
		if($method){
			foreach($method as $dt_method){
				$return[] = array('id'=>$dt_method->id, 'method'=>$dt_method->method);
			}
		} else {
			$return[] = array('id'=>" ", 'method'=>" ");
		}
		
		echo json_encode($return);
	}

	function loadcustomercontact(){		
		$cusid = isset($_REQUEST['cusid']) ? $_REQUEST['cusid'] : false;
		
		$key = null;
		$where = array();
		$where["cusid"] = $cusid;
		$group = null;
		$order = null;
		$limit = null;
		$offset = 0;
		
		$return = array();
		$customeruser = $this->main->getData('view_customeruser',$key,$where,$group,$order,$limit,$offset);
		if($customeruser){
			foreach($customeruser as $dt_customeruser){
				$return[] = array('id'=>$dt_customeruser->userid, 'name'=>$dt_customeruser->name);
			}
		} else {
			$return[] = array('id'=>" ", 'name'=>" ");
		}
		
		echo json_encode($return);
	}

}