<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Sitemap extends CI_Controller { 

	function __construct(){ 
		parent::__construct(); 
	} 

	function index(){ 
		$component['loadlayout'] = true;
		$component['page_title'] = T_("Sitemap");
		$component['load_js'][] = 'controlpanel/system/sitemap/sitemap';
		
		$component['menu'] = $this->loadmenu();
		$component['view_load'] = 'controlpanel/system/sitemap/sitemap';
		
		$this->authentication->cplayout($component);
	} 
	
	function loadmenu() {
		
		$return = '';
		
		$return .= "<ol class='dd-list'>Navigation";
		$menu_where['parentid'] = 0;
		$group = null;
		$menu_order = "sort asc";
		$menu = $this->main->getData('view_menu',null,$menu_where,$group,$menu_order);
		if($menu){
			foreach($menu as $dt_menu){
				$return .= $this->get_childmenu($dt_menu['id']);
			}
		}
		$return .= "</ol>";
		return $return;
	}
	
	function get_childmenu($id=0,$result=''){
		
		$menu_where['id'] = $id;
		$menu_group = null;
		$menu_order = "sort asc";

		$menu = $this->main->getData('view_menu',null,$menu_where,$menu_group,$menu_order);
		if($menu){
			foreach($menu as $dt_menu){
				$submenu_where['parentid'] = $dt_menu['id'];
				$submenu_group = null;
				$submenu_order = "sort asc";
				$submenu = $this->main->getData('view_menu',null,$submenu_where,$submenu_group,$submenu_order);
				
				$result .= "<li class='dd-item dd3-item' data-id='". $dt_menu['id'] ."'>";
				$result .= "<div class='dd-handle dd3-handle'>Drag</div><div class='dd3-content'><span>". $dt_menu['menu'] ."</span>";
				$result .= "<div class='pull-right'>";
				$result .= "<a href='javascript:editmenu(".$dt_menu['id'].");'><span class='fa fa-pencil'></span></a>";
				$result .= " ";
				$result .= "<a href='javascript:deletemenu(".$dt_menu['id'].");'><span class='fa fa-trash-o'></span></a>";
				$result .= "</div>";
				$result .= "</div>";
				if($submenu){
					$result .= "<ol>";
					foreach($submenu as $dt_submenu){
						$result .= $this->get_childmenu($dt_submenu['id']);
					}
					$result .= "</ol>";
				}
				$result .= "</li>";
			}
		}
				
		return $result;
	}
	
	function frmadd(){
		$component['loadlayout'] = true;
		
		$component['module'] = $this->main->getData('view_module');
		
		$component['load_js'][] = 'controlpanel/system/sitemap/sitemap_form';
		$component['view_load'] = 'controlpanel/system/sitemap/sitemap_form';
		$component['page_title'] = T_("Add Menu");
				
		$this->authentication->cplayout($component);
	}
	
	function frmedit($key=false){
		if($key){
			$component['loadlayout'] = true;
			
			$component['id'] = $key;
			
			$where['id'] = $key;
			$method = $this->main->getData('view_menu',null,$where);
			if($method && $key){
				foreach($method as $dt_method){
					$component['moduleid'] = $dt_method['moduleid'];
					$component['directory'] = $dt_method['directory'];
					$component['classid'] = $dt_method['classid'];
					$component['methodid'] = $dt_method['methodid'];
					$component['parentid'] = $dt_method['parentid'];
					$component['sort'] = $dt_method['sort'];
					$component['menu'] = $dt_method['menu'];
					$component['icon'] = $dt_method['icon'];
					$component['note'] = $dt_method['note'];
				}
			}
						
			$component['module'] = $this->main->getData('view_module');
			
			$where_dir = array();
			$where_dir['moduleid'] = $component['moduleid'] ;
			
			$order_dir = 'directory asc';
			$component['directories'] = $this->main->getData('view_directory',null,$where_dir,null,$order_dir);
			
			$where_class = array();
			$where_class['moduleid'] = $component['moduleid'] ;
			$where_class['directory'] = $component['directory'] ;
		
			$component['class'] = $this->main->getData('view_class',null,$where_class,null);
			
			$where_method = array();
			$where_method['classid'] = $component['classid'] ;
		
			$component['method'] = $this->main->getData('view_script',null,$where_method,null);
					
			$component['load_js'][] = 'controlpanel/system/sitemap/sitemap_form';
			$component['view_load'] = 'controlpanel/system/sitemap/sitemap_form';
			$component['page_title'] = T_("Edit Menu");
					
			$this->authentication->cplayout($component);	
		} else {
			redirect(base_url()."cpanel/system/module/classs/", 'refresh');
		}	
	}
	
	function postsitemap(){
		$parameter = array();
		$return = array();
		
		$id = isset($_POST['id']) ? $_POST['id'] : null;
		$menu = isset($_POST['menu']) ? $_POST['menu'] : null;
		$icon = isset($_POST['icon']) ? $_POST['icon'] : null;
		$methodid = isset($_POST['methodid']) ? $_POST['methodid'] : null;
		$note = isset($_POST['note']) ? $_POST['note'] : null;
		$parentid = isset($_POST['parentid']) ? $_POST['parentid'] != '' ? $_POST['parentid'] : 0 : 0;
		$sort = isset($_POST['sort']) ? $_POST['sort'] : 1000;
		
		$array = array();

		if(count($_POST) > 0){			
			if($id){
				$array['id'] = $id;
				$array['menu'] = $menu;
				$array['icon'] = $icon;
				$array['methodid'] = $methodid;
				$array['parentid'] = $parentid;
				$array['sort'] = $sort;
				$array['note'] = $note;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
				
				$edit_menu = $this->main->executeSP('sp_brick_sitemap_update',$parameter);
				foreach($edit_menu as $dt_edit_menu){
					$return['valid'] = $dt_edit_menu['valid'];
					$return['message'] = $dt_edit_menu['message'];
				}
			} else {
				$array['menu'] = $menu;
				$array['icon'] = $icon;
				$array['methodid'] = $methodid;
				$array['parentid'] = $parentid;
				$array['sort'] = $sort;
				$array['note'] = $note;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
										
				$insert_menu = $this->main->executeSP('sp_brick_sitemap_insert',$parameter);
				foreach($insert_menu as $dt_insert_menu){
					$return['valid'] = $dt_insert_menu['valid'];
					$return['message'] = $dt_insert_menu['message'];
				}
			}
		}		
			
		echo json_encode($return);
	}
	
	function sortsitemap(){
		$parameter = array();
		$return = array();
		
		$id = isset($_POST['id']) ? $_POST['id'] : null;
		$parentid = isset($_POST['parentid']) ? $_POST['parentid'] != '' ? $_POST['parentid'] : 0 : 0;
		$sort = isset($_POST['sort']) ? $_POST['sort'] : 0;
		$array = array();
		
		if(count($_POST) > 0){
			if($id){
				$array['id'] = $id;
				$array['parentid'] = $parentid;
				$array['sort'] = $sort;
				$array['userid'] = $this->mainconfig->userdata('userid');
				
				$this->load->library('array2xml', $array);
				$parameter['parameter'] = $this->array2xml->generateXML($array); //this way you are passing array
								
				$edit_menu = $this->main->executeSP('sp_brick_sitemap_sort',$parameter);
				foreach($edit_menu as $dt_edit_menu){
					$return['valid'] = $dt_edit_menu['valid'];
					$return['message'] = $dt_edit_menu['message'];
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
			
			$delete_module = $this->main->executeSP('sp_brick_sitemap_delete',$parameter);
			foreach($delete_module as $dt_delete_module){
				$return['valid'] = $dt_delete_module['valid'];
				$return['message'] = $dt_delete_module['message'];
			}
		}
				
		echo json_encode($return);
	}
}