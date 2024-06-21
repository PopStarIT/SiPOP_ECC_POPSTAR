<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*==============================================================*/
// Libraries Authentication										//			
// Author : Nizar Rahmat										//	
/*==============================================================*/
Class Authentication  {
	function __construct(){
		
		$this->CI =& get_instance();
		$this->CI->load->library('mainconfig');	
		
		/* Application Config */
		$config = $this->CI->config->config;
		$base_config = $config['base_config'];
		$module_config = $config['module_config'];
		$class_config = $config['class_config'];
		$method_config = $config['method_config'];
		$role_config = $config['role_config'];
		$menu_config = $config['menu_config'];
		
		$this->role_config = $role_config;
		$dir_template = "template";
		$template = $base_config['template'];
		$path_template = $base_config['template'];
		
		
		
		// if(!$this->CI->session->userdata('api_token')){
			// $array = array();
			// $array['ip_address'] = $this->CI->mainconfig->get_client_ip();
			// $authentication = $this->CI->clientapi->authentication();
			// if(isset($authentication->status)){
				// if($authentication->status == 'success'){
					// if(isset($authentication->data)){
						// if(isset($authentication->data->api_token)){
							// $api_token = $authentication->data->api_token;
							// $newdata = array('api_token'  => $api_token);
							// $this->CI->session->set_userdata($newdata);
						// }
					// }
				// }
			// } 
		// }
		
		$data_module = array();
		foreach($module_config as $key=>$value){
			$data_module[$value] = $key;
		}
		
		$data_class = array();
		foreach($class_config as $key=>$value){
			foreach($value as $k=>$v){
				foreach($v as $k1=>$v1){
					$data_class[$v1] = array();
					$data_class[$v1]['class'] = $k1;
					$directory = "";
					if($k != '0'){
						$directory = $k;
					} 
					$data_class[$v1]['directory'] = $directory;
					$data_class[$v1]['module_id'] = $key;
				}
			}
		}
		
		$data_method = array();
		foreach($method_config as $key=>$value){
			foreach($value as $k=>$v){
				$data_method[$v['id']] = array();
				$data_method[$v['id']]['method'] = $k;
				$data_method[$v['id']]['token_id'] = $v['tokenid'];
				$data_method[$v['id']]['class_id'] = $key;
				$data_method[$v['id']]['class'] = $data_class[$key]['class'];
				$data_method[$v['id']]['directory'] = $data_class[$key]['directory'];
				$module_id = $data_class[$key]['module_id'];
				$data_method[$v['id']]['module_id'] = $module_id;
				$data_method[$v['id']]['module'] = $data_module[$module_id];
			}
		}
		
		$this->data['data_method'] = $data_method;
		$this->data['base_config'] = $base_config;
		$this->data['menu_config'] = $menu_config;
		
		foreach($data_method as $key=>$value){
			$data_method[$key]['link'] = $this->generate_link($key);
		}
		
		$this->data['data_method'] = $data_method;
		
		$this->data['dir_template'] = $dir_template;
		$this->data['template'] = $template;
		$this->data['path_template'] = $dir_template ."/". $template;
				
		$module = trim(implode('',array_intersect_key(explode('/',str_replace('../modules/','',$this->CI->router->directory)),array(0))));
		$directory = trim(implode('/',array_slice(explode('/',str_replace('../modules/','',$this->CI->router->directory)),2)),'/');
		$class = trim($this->CI->router->class);
		$method = trim($this->CI->router->method);
		
		$this->module = $module;
		$this->directory = $directory;
		$this->class = $class;
		$this->method = $method;
				
		$role_id = $this->CI->session->userdata('role_id'); //Role ID
		
		$moduleid = 0;
		if(isset($module_config)){
			if(array_key_exists($module,$module_config)){
				$moduleid = $module_config[$module];
			} 
		}
		
		$directory_name = "0";
		if(strlen($directory) > 0){
			$directory_name = $directory;
		}
		
		$classid = 0;
		if(isset($class_config[$moduleid][$directory_name])){
			if(array_key_exists($class,$class_config[$moduleid][$directory_name])){
				$classid = $class_config[$moduleid][$directory_name][$class];
			} 
		}
		
		$methodid = 0;
		$tokenid = 0;
				
		if(isset($method_config[$classid])){
			if(array_key_exists($method,$method_config[$classid])){
				if(isset($method_config[$classid][$method]['id'])){
					$methodid = $method_config[$classid][$method]['id'];
				}
				if(isset($method_config[$classid][$method]['tokenid'])){
					$tokenid = $method_config[$classid][$method]['tokenid'];
				}
			} 
		}
		
		
		// echo $role_id;
		// print_r($role_config[$role_id]);
		// print_r($tokenid);
		// print_r($methodid);
		
		
		$securityid = 0;
		if ($role_id == '-99'){
			$securityid = 1;
		} elseif(isset($role_config[$role_id])){
			if(array_key_exists($role_id,$role_config)){
				if(array_key_exists($tokenid, $role_config[$role_id])){
					$securityid = 1;
				}
			} 
		}
		
		$this->data['methodid'] = $methodid;		
		$this->data['tokenid'] = $tokenid;
		$this->data['generate_menu'] = $this->generate_menu();
		$this->data['role_config'] = $role_config;
		/* End Application File Load */
		
		
		// echo "<pre>";
		// print_r($this->CI->router);
		// echo "</pre>";
		// echo $module;
		// echo "<br>";
		// echo $directory;
		// echo "<br>";
		// echo $class;
		// echo "<br>";
		// echo $method;
		
		/* Authentication Config */
		
		$maintenance_mode = false;	// Maintenance mode
		$referral_param_url = 'ref';	// Referral url parameter 
		$api_module = 'api';	// API Module 
		
		
		
		/* End Authentication Config */
		
		if(!$this->CI->session->userdata('login')){
			if(isset($_GET[$referral_param_url])){
				
			}
		}
		
		if($module != $api_module){
			if($this->CI->session->userdata('login')){
				// $this->update_activity($this->CI->session->userdata('userid'));
			}
			
			if(!$maintenance_mode) {
				if($methodid != 0){					
					if($tokenid == -'3'){
						if(!$this->CI->session->userdata('login')){
							if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
								if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
									$return = array();
									$return['valid'] = 'false';
									$return['message'] = 'Session Expired, please re-login';
									
									echo json_encode($return);
									exit();
								}
							} else {
								
							}		
						} else {
							if($this->CI->session->userdata('lockscreen')){
								$component = array();
								$this->lock($component);
							} 
						}
					}elseif($tokenid == '-2'){
						if($this->CI->session->userdata('login') && !$this->CI->session->userdata('lockscreen')){
							if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
								if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
									$return = array();
									$return['valid'] = 'false';
									$return['message'] = 'Error Session data, please refresh page';
									
									echo json_encode($return);
									exit();
								}
							} else {
								redirect(base_url(), 'refresh');
							}
						}
					} elseif($tokenid == -'1'){
						if(!$this->CI->session->userdata('login')){
							if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
								if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
									$return = array();
									$return['valid'] = 'false';
									$return['message'] = 'Session Expired, please re-login';
									
									echo json_encode($return);
									exit();
								}
							} else {
								$component =array();
								$this->loginlayout($component);
							}		
						} else {
							if($this->CI->session->userdata('lockscreen')){
								$component = array();
								$this->lock($component);
							} 
						}
					} elseif($tokenid == '0'){
						
					} else {
						if($securityid == '0'){
							if(!$this->CI->session->userdata('login')){
								$this->loginlayout();
							} else {
								$this->errorlayout();	
							}						
						}
					}
				} else {
					if($this->CI->session->userdata('role_id') != -99){
						if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
							if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
								$return = array();
								$return['valid'] = false;
								$return['message'] = 'Token Not Found';
								$return['des'] = 'Token Not Found';
								
								echo json_encode($return);
								exit();
							}
						} else {
							$this->errorlayout();
						}	
					} else {
						
					}		
				}
			} else {
				$this->maintenancelayout();
			}
		}
	}
	
	function plainlayout($array=array()){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
				
			}
		} else {
			$this->errorlayout();
		}
	}
	
	function ajaxlayout($array=array()){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
				$data['menu'] = '';
				$data['class_uri'] = $this->generate_class_uri();
				
				$component = array_merge($this->data,$data,$array);
				
				$this->CI->load->view($this->data['path_template'] ."/ajax",$component); 
			}
		} else {
			$this->errorlayout();
		}
	}
	
	function blanklayout($array=array()){
		$data['menu'] = '';
		$data['class_uri'] = $this->generate_class_uri();
		
		$component = array_merge($this->data,$data,$array);
		
		$this->CI->load->view($this->data['path_template'] ."/blank",$component);
	}
	
	function loginlayout($array=array()){
		$data['this'] = $this->CI;
		$data['class_uri'] = $this->generate_class_uri();
		
		$data['load_js'][] = 'login';
		
		$data['view_load'] = 'login';
		$data['page_title'] = 'Login';
		 		
		
		$component = array_merge($this->data,$data,$array);
		echo $this->CI->load->view($this->data['path_template'] ."/login",$component,true); 
		die();
	}
	
	function informationlayout($array=array()){
		$data['this'] = $this->CI;
		$data['class_uri'] = $this->generate_class_uri();
		
		$data['load_js'][] = 'information';
		
		$data['view_load'] = 'information';
		$data['page_title'] = 'Contact Us';
		 		
		
		$component = array_merge($this->data,$data,$array);
		echo $this->CI->load->view($this->data['path_template'] ."/information",$component,true); 
		die();
	}
	
	function errorlayout($array=array()){
		$data['this'] = $this->CI;
		
		$component = array_merge($this->data,$data,$array);
		echo $this->CI->load->view($this->data['path_template'] ."/error",$component,true); 
		die();
	}
	
	function permision($array=array()){
		$data['this'] = $this->CI;
		
		$component = array_merge($this->data,$data,$array);
		echo $this->CI->load->view($this->data['path_template'] ."/error",$component,true); 
		die();
	}
	
	function weblayout($array=array()){
		$data['menu'] = '';
		$data['class_uri'] = $this->generate_class_uri();
		// $data['class_uri'] = $this->generate_class_uri();
		// if(isset($array['button'])){
			// $data['button'] = $this->button_authentication($array['button']);
			// unset($array['button']);
		// }
		
		 		
		$component = array_merge($this->data,$data,$array);
		
		$this->CI->load->view($this->data['path_template'] ."/website",$component); 
	}
	
	function cplayout($array=array()){
		$data['menu'] = '';
		$data['class_uri'] = $this->generate_class_uri();
		
		$component = array_merge($this->data,$data,$array);
		
		$this->CI->load->view($this->data['path_template'] ."/control_panel",$component); 
	}

	function maintenancelayout($array=array()){
		$data['this'] = $this->CI;
		
		$component = array_merge($this->data,$data,$array);
		echo $this->CI->load->view('layout/maintenance',$component,true); 
		die();
	}
		
	function forgotpassword($array=array()){
		$data['this'] = $this->CI;
		
		$component = array_merge($this->data,$data,$array);
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
				// echo "<script type='text/javascript'>location.reload();</script>";
				echo $this->CI->load->view('layout/session',$component,true); 
			}
		} else {
			echo $this->CI->load->view('layout/forgotpassword',$component,true); 
		}
		die();
	}
	
	function lock($array=array()){
		$data['this'] = $this->CI;
		$data['username'] = $this->CI->session->userdata('username');
		$component = array_merge($this->data,$data,$array);
		echo $this->CI->load->view('layout/lockscreen',$component,true); 
		die();
	}
			
	function cpmenu($role=0){
		$roleid = array();
		$roleid[] = 0;
		$roleid[] = $role;

		$return = '';
		// $navigation_order = 'sort asc';
		// $navigation = $this->CI->main->getData('View_navigation',null,null,null,$navigation_order);
		// if($navigation){
			// foreach($navigation as $dt_navigation){
				
				// $menu_where['navigationid'] = $dt_navigation->id;
				$menu_where['parentid'] = 0;
				if($role != '-99'){
					$menu_where['roleid'] = $roleid;
				} 
				$group_menu = 'id';

				$menu_order = "sort asc";
				$menu = $this->CI->main->getData('view_menu',null,$menu_where,$group_menu,$menu_order);
				if($menu){
					foreach($menu as $dt_menu){
						$return .= $this->get_childmenu($dt_menu['id'],$role);
					}
				}
			// }
		// }
		
		return $return;
	}
	
	function get_childmenu($id=0,$role=0,$result=''){
		
		$menu_where['id'] = $id;
		$roleid = array();
		
		$roleid[] = 0;
		$roleid[] = $role;
		
		if($role != '-99'){
			$menu_where['roleid'] = $roleid;
		}
			
		$group_menu = 'id';
	
		
		$menu_order = "sort asc";
		
		
		$menu = $this->CI->main->getData('view_menu',null,$menu_where,$group_menu,$menu_order);
		if($menu){
			foreach($menu as $dt_menu){
				$submenu_where['parentid'] = $dt_menu['id'];
				$submenu_group = 'id';
				$submenu_order = "sort asc";
				$submenu = $this->CI->main->getData('view_menu',null,$submenu_where,$submenu_group,$submenu_order);
				$class = "";
							
				//class="xn-openable"
				if(strlen($dt_menu['module']."/".$dt_menu['directory']."/".$dt_menu['class']."/".$dt_menu['method']) < 5){
					$url = 'javascript:void(0)';
				} else {
					$url = base_url();
					if($dt_menu['module'] != ''){
						$url .= $dt_menu['module'];
					}
					
					if(trim($dt_menu['directory']) != ''){
						$url .= "/".$dt_menu['directory'];
					}
					
					if($dt_menu['class'] != '' && $dt_menu['module'] != $dt_menu['class']){
						$url .= "/".$dt_menu['class'];
					}
					
					if($dt_menu['method'] != '' && $dt_menu['method'] != 'index'){
						$url .= "/".$dt_menu['method'];
					}
				}
				
				if(in_array($dt_menu['id'],$this->activelink)){
					$class .= " active";
				}
				

				if($submenu){
					$class .= " xn-openable";
					$result .= "<li class='". $class ."' data-id='". $dt_menu['id'] ."'>";
					$result .= "<a href='". $url ."'><span class='". html_entity_decode($dt_menu['icon']) ."'></span> <span class='xn-text'>". html_entity_decode($dt_menu['menu']) ."</span></a>";
					$result .= "<ul>";
					foreach($submenu as $dt_submenu){
						$result .= $this->get_childmenu($dt_submenu['id'],$role);
					}
					$result .= "</ul>";
					$result .= "</li>";
				} else {
					$result .= "<li class='". $class ."' data-id='". $dt_menu['id'] ."'>";
					$result .= "<a href='". $url ."'><span class='". html_entity_decode($dt_menu['icon']) ."'></span> <span class='xn-text'>". html_entity_decode($dt_menu['menu']) ."</span></a>";
					$result .= "</li>";
				}
			}
		}
				
		return $result;
	}
	
	function getactivelink($return=array(),$id=0){
		
		$menu_where = array();
		if($id != 0){
			$menu_where['id'] = $id;
		} else {
			$menu_where['method'] = $this->method;
			$menu_where['module'] = $this->module;
			$menu_where['class'] = $this->class;
		}
		
		$group_menu = 'id';
		$menu_order = 'sort asc';
		
		$menu = $this->CI->main->getData('view_menu',null,$menu_where,$group_menu,$menu_order);
		if($menu){
			foreach($menu as $dt_menu){
				$return[] = $dt_menu['id'];
				if($dt_menu['parentid'] != 0){
					$return2 = $this->getactivelink($return, $dt_menu['parentid']);
					$return = array_merge($return2);
				}
			}
		}
		
		return $return;
	}
	
	function breadcrumb(){
	
		$return = '';		
		$count = count($this->getactivelink());
		if($count > 0){
			$i = 1;
			$array = $this->getactivelink();
			krsort($array);
			foreach($array as $dt_breadcrumb){
				$menu_where = array();
				$menu_where['id'] = $dt_breadcrumb;
				$menu = $this->CI->main->getData('view_menu',null,$menu_where,'id',null);
				if($menu){
					foreach($menu as $dt_menu){
						if($i < $count){	
							if(strlen($dt_menu['module']."/".$dt_menu['directory']."/".$dt_menu['class']."/".$dt_menu['method']) < 5){
								$url = '';
							} else {
								$url = base_url();
								if($dt_menu['module'] != ''){
									$url .= $dt_menu['module'];
								}
								
								if(trim($dt_menu['directory']) != ''){
									$url .= "/".$dt_menu['directory'];
								}
								
								if($dt_menu['class'] != '' && $dt_menu['module'] != $dt_menu['class'] && trim($dt_menu['directory']) != ''){
									$url .= "/".$dt_menu['class'];
								}
								
								if($dt_menu['method'] != '' && $dt_menu['method'] != 'index'){
									$url .= "/".$dt_menu['method'];
								}
							}
							
							if(trim($url) == ''){
								$return .= "<li>". $dt_menu['menu'] ."</li>";
							} else {
								$return .= "<li><a href='". $url ."'>". $dt_menu['menu'] ."</a></li>";
							}
						} else {
							$return .= "<li>". $dt_menu['menu'] ."</li>";
						}
						$i++;
					}
				}
			}
		} else {
			$name = '';
			if($this->method != '' && $this->method != 'index'){
				$name .= ucfirst($this->method);
			} else {
				$name .= ucfirst($this->class);
			}

			$return .= "<li>". $name ."</li>";
		}
		
		return $return;
	}
		
	/* Admpg Layout */	
	function component($array=array()){
		$this->layout($array);	
	}
	
	function layout($array=array()){
		$data['this'] = $this->CI;
		$data['sidebarmenu'] = $this->generateMenu();
		$component = array_merge($data,$array);
		$this->CI->load->view('layout',$component); 
	}

	function blocked($array=array()){
		$data['this'] = $this->CI;
		
		$component = array_merge($data,$array);
		echo $this->CI->load->view('blocked',$component,true); 
		die();
	}
	
	function generate_class_uri(){
		$class_uri = '';
		$last_class = '';
		$last_class2 = '';
		if(strlen(trim($this->module)) > 0){
			$class_uri .= $this->module;
			$last_class = $this->module;
		}
		
		if(strlen(trim($this->directory)) > 0){
			$class_uri .= "/".$this->directory;
			$explode = explode('/',$this->directory);
			$count_explode = count($explode);
			
			$last_class2 = $explode[($count_explode - 1)];
			if($last_class != $last_class2){
				$last_class = $last_class2;
			}
			
		}
		
		if(strlen(trim($this->class)) > 0){
			if($last_class != $this->class){
				$class_uri .= "/".$this->class;
			}
		}

		return $class_uri;
	}
	
	function button_authentication($array) {
		$return = array();
		$where = array();
		$where['module'] = $this->module;
		$where['class'] = $this->class;
		foreach($array as $key=>$value){
			$where['method'][] = $value;
		}
		if(strlen(trim($this->directory)) > 0){
			$where['directory'] = $this->directory;
		}
		// if($this->CI->session->userdata('roleid') != '-99'){
			// $where['roleid'] = $this->CI->session->userdata('roleid');
		// }
				
		$view_script = $this->CI->main->getData('view_script',null,$where);
		if($view_script){
			foreach($view_script as $dt_script){
				$method = $dt_script['method'];
				$where_securirty['tokenid'] = $dt_script['tokenid'];
				$where_securirty['roleid'] = $this->CI->session->userdata('roleid');
				$check = $this->CI->main->countData('dt_securitygroup',$where_securirty);
				if($check > 0) {
					foreach($array as $key=>$value){
						if($value == $method){
							$return[$key]['value'] = $value;
							$return[$key]['access'] = 1;
						}
					}	
				} else {
					if($this->CI->session->userdata('roleid') == '-99'){
						foreach($array as $key=>$value){
							if($value == $method){
								$return[$key]['value'] = $value;
								$return[$key]['access'] = 1;
							}
						
						}	
					}
				}				
			}
		}
				
		return $return;
	}
	
	function update_activity($uid) {
		$time = time();
		
		$update = array();
		$update['time_activity'] = $time;
		
		$where = array();
		$where['id'] = $this->CI->session->userdata('userid');
		
		$this->CI->main->update('dt_user',$update,$where);
	}
	
	function generate_menu($menu=""){
		$active_menu = $this->active_menu();
		if(isset($this->data['menu_config'])){
			if(is_array($this->data['menu_config'])){
				foreach($this->data['menu_config'] as $key=>$value){
					$submenu = 0;
					$active = 0;
					$class_active = "active";
					$class_submenu_active = "";
					$attr_submenu = "class='nav-main-link'";
					$link = $this->generate_link($value['method_id']);
					$permission_check = $this->permission_check($value['method_id']);
					if($permission_check){
						if(in_array($key,$active_menu)){
							$active = 1;
						}
						
						if(is_array($value['child'])){
							if(!empty($value['child'])){
								$submenu = 1;
								$attr_submenu = "class='nav-main-link nav-main-link-submenu' data-toggle='submenu' aria-haspopup='true' aria-expanded='false'";
								$link = "javascript:void();";
								if($active == 1){
									$class_submenu_active = "open";
								}
							} else {
								if($active == 1){
									$attr_submenu = "class='nav-main-link active'";
								}
							}
						} else {
							if($active == 1){
								$attr_submenu = "class='nav-main-link active'";
							}
						}
						
						$menu .= "<li class='nav-main-item ".$class_submenu_active."'>";
						$menu .= "<a ". $attr_submenu ." href='". $link ."'>";
						$menu .= "<i class='nav-main-link-icon ".$value['icon']."'></i>";
						$menu .= "<span class='nav-main-link-name'>";
						$menu .= $value['name'];
						$menu .= "</span>";
						$menu .= "</a>";
						
						if($submenu ==1){
							$menu = $this->generate_submenu($menu,$value['child']);
						}
						
						$menu .= "</li>";
					}
					
				}
				
			}
		} 
		
		return $menu;
	}
	
	function generate_submenu($menu="",$array=array()){
		$active_menu = $this->active_menu();
		if(isset($array)){
			if(is_array($array)){
				$menu .= "<ul class='nav-main-submenu'>";
				foreach($array as $key=>$value){
					$submenu = 0;
					$active = 0;
					$class_active = "active";
					$class_submenu_active = "";
					$attr_submenu = "class='nav-main-link'";
					$link = $this->generate_link($value['method_id']);
					$permission_check = $this->permission_check($value['method_id']);
					if($permission_check){
						if(in_array($key,$active_menu)){
							$active = 1;
						}
						
						if(is_array($value['child'])){
							if(!empty($value['child'])){
								$submenu = 1;
								$attr_submenu = "class='nav-main-link nav-main-link-submenu' data-toggle='submenu' aria-haspopup='true' aria-expanded='false'";
								$link = "javascript:void();";
								if($active == 1){
									$class_submenu_active = "open";
								}
							} else {
								if($active == 1){
									$attr_submenu = "class='nav-main-link active'";
								}
							}
						} else {
							if($active == 1){
								$attr_submenu = "class='nav-main-link active'";
							}
						}
						
						
						$menu .= "<li class='nav-main-item ".$class_submenu_active."'>";
						$menu .= "<a ". $attr_submenu ." href='". $link ."'>";
						$menu .= "<i class='nav-main-link-icon ".$value['icon']."'></i>";
						$menu .= "<span class='nav-main-link-name'>";
						$menu .= $value['name'];
						$menu .= "</span>";
						$menu .= "</a>";
						
						if($submenu ==1){
							$menu = $this->generate_submenu($menu,$value['child']);
						}
						
						$menu .= "</li>";
					}
					
				}
				$menu .= "</ul>";
				
			}
		} 
		
		return $menu;
	}
	
	function generate_link($method_id = 0){
		$link = 'javascript:void();';
		if($method_id != 0){
			$data_method = $this->data['data_method'];
			if(isset($data_method[$method_id])){
				$dt_menu = $data_method[$method_id];
				$length = strlen($dt_menu['module']."/".$dt_menu['directory']."/".$dt_menu['class']."/".$dt_menu['method']);
				if($length >= 5){
					// $link = base_url();
					$link = "";
					if($dt_menu['module'] != ''){
						$link .= $dt_menu['module'];
					}
					
					if(trim($dt_menu['directory']) != ''){
						$link .= "/".$dt_menu['directory'];
					}
					
					if($dt_menu['class'] != '' && $dt_menu['module'] != $dt_menu['class']){
						$link .= "/".$dt_menu['class'];
					}
					
					if($dt_menu['method'] != '' && $dt_menu['method'] != 'index'){
						$link .= "/".$dt_menu['method'];
					}
				}
			}			
		}
		
		return $link;
	}
	
	function permission_check($method_id=0){
		$permission = false;
		$role_id  = $this->CI->session->userdata('role_id');
		if($method_id != 0){
			$data_method = $this->data['data_method'];
			if(isset($data_method[$method_id])){
				$dt_menu = $data_method[$method_id];
				$token_id = $dt_menu['token_id'];
				
				if($token_id == -2){
					if(!$this->CI->session->userdata('login')){
						$permission = true;
					}
				} elseif($token_id == -1){
					if($this->CI->session->userdata('login')){
						$permission = true;
					}
				} elseif($token_id == 0){
					$permission = true;
				} else {
					if(isset($this->role_config[$role_id])){
						if(array_key_exists($role_id,$this->role_config)){
							if(array_key_exists($token_id, $this->role_config[$role_id])){
								$permission = true;
							}
						} 
					}
					if($this->CI->session->userdata('role_id') == -99){
						$permission = true;
					}
				}			
			}
		}		
		return $permission;
	}
	
	function generate_menu_parent($data_menu=array(),$array=array()){
		if(empty($array)){
			$array = $this->data['menu_config'];
		}
		
		if(isset($array)){
			if(is_array($array)){
				foreach($array as $key=>$value){
					$submenu = 0;
					$data_menu[$key] = $value['parent_id'];
					if(is_array($value['child'])){
						if(!empty($value['child'])){
							$submenu = 1;
						}
					}
					if($submenu ==1){
						$data_menu = $this->generate_menu_parent($data_menu,$value['child']);
					}					
				}
			}
		} 
		
		return $data_menu;
	}
	
	function generate_menu_method($data_menu=array(),$array=array()){
		if(empty($array)){
			$array = $this->data['menu_config'];
		}
		
		if(isset($array)){
			if(is_array($array)){
				foreach($array as $key=>$value){
					$submenu = 0;
					$data_menu[$key] = $value['method_id'];
					if(is_array($value['child'])){
						if(!empty($value['child'])){
							$submenu = 1;
						}
					}
					if($submenu ==1){
						$data_menu = $this->generate_menu_method($data_menu,$value['child']);
					}					
				}
			}
		} 
		
		return $data_menu;
	}
	
	function active_menu(){
		$generate_menu_method = $this->generate_menu_method();
		$data_menu = array();
		foreach($generate_menu_method as $key=>$value){
			if($this->data['methodid'] == $value){
				$data_menu[] = $key;
				$data_menu2 = $this->check_parent_menu($key);
				$data_menu = array_merge($data_menu,$data_menu2);
			}
		}
		
		return $data_menu;
	}
	
	function check_parent_menu($menu_id = 0, $array=array()){
		$generate_menu_parent = $this->generate_menu_parent();

		if($menu_id !=0){
			$parent_id =  $generate_menu_parent[$menu_id];
			$array[] = $parent_id;
			if($parent_id != 0){
				$array = $this->check_parent_menu($parent_id,$array);
			}
		}
		
		return $array;
	}
}
?>