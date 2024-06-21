<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*==============================================================*/
// Libraries Authentication										//			
// Author : Nizar Rahmat										//	
/*==============================================================*/
Class Authentication  {
	function __construct(){
		
		$this->config['loadajax'] = false;
		
		// if(date('YmdH') >= 2017122716 && date('YmdHis') <= 2017122721){
			// $maintenance_mode = 1;
		// } else {
			$maintenance_mode = 0;
		// }
		
		
		$this->CI =& get_instance();
		$this->CI->load->model('main'); // load model
		
		$lang = $this->CI->language->get_language();

		$this->data['lang'] = $lang;
		
		
		if(!$this->CI->session->userdata('formid')){
			$newdata = array('formid'  => $this->CI->security->get_csrf_hash());
			$this->CI->session->set_userdata($newdata);
			$this->CI->session->userdata('formid');
			
			$this->data['formid'] = $this->CI->session->userdata('formid');
		} else {
			$this->data['formid'] = $this->CI->session->userdata('formid');
		}
								
		$module = implode('',array_intersect_key(explode('/',str_replace(',,/modules/','',$this->CI->router->directory)),array(0)));
		$directory = trim(implode('/',array_slice(explode('/',str_replace(',,/modules/','',$this->CI->router->directory)),2)),'/');
		$class = $this->CI->router->class;
		$method = $this->CI->router->method;
		
		if($module != 'api'){
			$this->module = $module;
			$this->directory = $directory;
			$this->class = $class;
			$this->method = $method;
			$this->activelink = $this->getactivelink();

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
			
			if($this->CI->session->userdata('login')){
				$this->update_activity($this->CI->session->userdata('userid'));
			}
			
			$view_config = $this->CI->main->getData('view_config');
			$config_data = array();
			$config_data['breadcrumb'] = $this->breadcrumb(); 
			$config_data['id'] = 0;
			$config_data['tokenid'] = -2;
			$config_data['securityid'] = 0;
			
			if($view_config){
				foreach($view_config as $value){
					$config_data[$value['param']] = $value['value'];
				}
			}

			$where = array();
			$where['module'] = $module;
			$where['class'] = $class;
			$where['method'] = $method;
			if(strlen(trim($directory)) > 0){
				$where['directory'] = $directory;
			}
			$view_script = $this->CI->main->getData('view_script',null,$where);
				
			if($view_script){
				foreach($view_script as $key=>$value){
					foreach($value as $k=>$v){
						$config_data[$k] = $v;
					}
				}
			}
			
			$where = array();
			$where['roleid'] = $this->CI->session->userdata('roleid');
			$where['tokenid'] = $config_data['tokenid'];
			$securityid = $this->CI->main->countData('view_security',$where);
			$config_data['securityid'] = $securityid;
			
			$this->data['base_config'] = $config_data; 

			$methodid = $config_data['id'];
			$tokenid = $config_data['tokenid'];
			$securityid = $config_data['securityid'];
			
			if($maintenance_mode == 0){
				if($methodid != '0'){			
							
					$this->data['security']['methodid'] = $methodid;
									
					if($tokenid == '-3'){
						if(!$this->CI->session->userdata('login')){
							if(isset($_REQUEST[$this->CI->security->get_csrf_token_name()])){
								$return = array();
								$return['valid'] = 'false';
								$return['message'] = 'Session Expired, please re-login';
								
								echo json_encode($return);
								exit();
							} else {
								$component['formid'] = $this->CI->session->userdata('formid');
								$this->login($component);
							}						
						} else {
							$this->data['base_config']['sidebar'] = $this->cpmenu(trim($this->CI->session->userdata('roleid'))); 
						}
					} elseif($tokenid == '-2'){
						if($this->CI->session->userdata('login') && !$this->CI->session->userdata('lockscreen')){
							if(isset($_REQUEST[$this->CI->security->get_csrf_token_name()])){
								$return = array();
								$return['valid'] = 'false';
								$return['message'] = 'Error Session data, please refresh page';
								
								echo json_encode($return);
								exit();
							} else {
								redirect(base_url(), 'refresh');
							}						
						}
					} elseif($tokenid == -'1'){
						if(!$this->CI->session->userdata('login')){
							if(isset($_REQUEST[$this->CI->security->get_csrf_token_name()])){
								// $return = array();
								// $return['valid'] = 'false';
								// $return['message'] = 'Session Expired, please re-login';
								
								// echo json_encode($return);
								// exit();
								
								$component['formid'] = $this->CI->session->userdata('formid');
								$this->login($component);
							} else {
								$component['formid'] = $this->CI->session->userdata('formid');
								$this->login($component);
							}						
						} else {
							if($this->CI->session->userdata('lockscreen')){
								$component['formid'] = $this->CI->session->userdata('formid');
								$this->lock($component);
							} else {
								$this->data['base_config']['sidebar'] = $this->cpmenu(trim($this->CI->session->userdata('roleid'))); 
							}
						}
					} elseif($tokenid == '0'){
						
					} else {
						
						if($this->CI->session->userdata('login')){
							if($this->CI->session->userdata('lockscreen')){
								$component['formid'] = $this->CI->session->userdata('formid');
								$this->lock($component);
							} else {
								if(trim($this->CI->session->userdata('roleid')) != '-99'){
									if($securityid == '0'){
										if(isset($_REQUEST[$this->CI->security->get_csrf_token_name()])){
											$return = array();
											$return['valid'] = 'false';
											$return['message'] = 'Access Denied';
											
											echo json_encode($return);
											exit();
										} else {
											$this->permision();
										}						
									} else {
										$this->data['base_config']['sidebar'] = $this->cpmenu(trim($this->CI->session->userdata('roleid'))); 
									}
								} else {
									
									$this->data['base_config']['sidebar'] = $this->cpmenu(trim($this->CI->session->userdata('roleid'))); 
								}
							}
						} else {
							if(isset($_REQUEST[$this->CI->security->get_csrf_token_name()])){
								$return = array();
								$return['valid'] = 'false';
								$return['message'] = 'Session Expired, please re-login';
								
								echo json_encode($return);
								die();
							} else {
								$component['formid'] = $this->CI->session->userdata('formid');
								$this->login($component);
							}						
						}
					}
				} else {
					
					
					if(isset($_REQUEST[$this->CI->security->get_csrf_token_name()])){
						if(trim($this->CI->session->userdata('roleid')) != '-99'){
							$return = array();
							$return['valid'] = false;
							$return['message'] = 'Token Not Found';
							$return['des'] = 'Token Not Found';
							
							echo json_encode($return);
							exit();
						} else {
							
						}
						
					} else {
						if(trim($this->CI->session->userdata('roleid')) != '-99'){
							$this->errorlayout();
						} else {
							$this->errorlayout();
						}
					}				
				}
			} else {
				$this->maintenancelayout();
			}
		}
	}
		
	function weblayout($array=array()){
		$data['this'] = $this->CI;
	
		$component = array_merge($this->data,$data,$array);

		$this->CI->load->view('layout/website',$component);
	}
	
	function cplayout($array=array()){
		$data['this'] = $this->CI;
		$time = time();
		$last_24 = $time - 86400;
		
		$data['last_price'] = 0;
		$data['low_price'] = 0;
		$data['high_price'] = 0;
		$data['volume'] = 0;
		
		
		$data['menu'] = '';
		$data['class_uri'] = $this->generate_class_uri();
		if(isset($array['button'])){
			$data['button'] = $this->button_authentication($array['button']);
			unset($array['button']);
		}
		
		 		
		$component = array_merge($this->data,$data,$array);
		
		if($this->config['loadajax']){
			if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
				if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
					if(isset($component['view_load'])){
						$this->CI->load->view('layout/controlpanelajax',$component);
					} else {
						if(isset($_REQUEST[$this->CI->security->get_csrf_token_name()])){
							echo $array['result']['data'];
						} else {
							$component = array_merge($this->data,$data,$array);
							echo $this->CI->load->view('layout/permision',$component,true); 
							die();
						}
					}
				}
			} else {
				if(isset($component['loadlayout'])){
					// $component['base_config']['sidebar'] = $this->cpmenu(trim($this->CI->session->userdata('roleid'))); 
					$this->CI->load->view('layout/controlpanel',$component);
				} if(isset($component['loadajax'])){
					$component = array_merge($this->data,$data,$array);
					echo $this->CI->load->view('layout/permision',$component,true); 
					die();
				} else {
					if(isset($component['view_load'])){
						$this->CI->load->view('layout/controlpanelajax',$component);
					}
				}
			}
		} else {
			// $component['base_config']['sidebar'] = $this->cpmenu(trim($this->CI->session->userdata('roleid'))); 
			$this->CI->load->view('layout/controlpanel',$component);
		}
	}
		
	function adminlayout($array=array()){
		$data['this'] = $this->CI;
		
		$data['menu'] = '';
		$data['class_uri'] = $this->generate_class_uri();
		if(isset($array['button'])){
			$data['button'] = $this->button_authentication($array['button']);
			unset($array['button']);
		}
		
		// $data['menu_verification_request'] = $this->CI->main->countData('view_admin_verification_request'); 
		// $data['menu_api_request'] = $this->CI->main->countData('view_admin_api_request'); 
		// $data['menu_plan_request'] = $this->CI->main->countData('view_admin_plan_request'); 
		
		$component = array_merge($this->data,$data,$array);
		
		if($this->config['loadajax']){
			if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
				if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
					if(isset($component['view_load'])){
						$this->CI->load->view('layout/controlpanelajax',$component);
					} else {
						if(isset($_REQUEST[$this->CI->security->get_csrf_token_name()])){
							echo $array['result']['data'];
						} else {
							$component = array_merge($this->data,$data,$array);
							echo $this->CI->load->view('layout/permision',$component,true); 
							die();
						}
					}
				}
			} else {
				if(isset($component['loadlayout'])){
					// $component['base_config']['sidebar'] = $this->cpmenu(trim($this->CI->session->userdata('roleid'))); 
					$this->CI->load->view('layout/adminpage',$component);
				} if(isset($component['loadajax'])){
					$component = array_merge($this->data,$data,$array);
					echo $this->CI->load->view('layout/permision',$component,true); 
					die();
				} else {
					if(isset($component['view_load'])){
						$this->CI->load->view('layout/controlpanelajax',$component);
					}
				}
			}
		} else {
			// $component['base_config']['sidebar'] = $this->cpmenu(trim($this->CI->session->userdata('roleid'))); 
			$this->CI->load->view('layout/adminpage',$component);
		}
	}
	
	function devlayout($array=array()){
		$data['this'] = $this->CI;
		
		$data['menu'] = '';
		$data['class_uri'] = $this->generate_class_uri();
		if(isset($array['button'])){
			$data['button'] = $this->button_authentication($array['button']);
			unset($array['button']);
		}
			
		$component = array_merge($this->data,$data,$array);
		
		if($this->config['loadajax']){
			if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
				if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
					if(isset($component['view_load'])){
						$this->CI->load->view('layout/controlpanelajax',$component);
					} else {
						if(isset($_REQUEST[$this->CI->security->get_csrf_token_name()])){
							echo $array['result']['data'];
						} else {
							$component = array_merge($this->data,$data,$array);
							echo $this->CI->load->view('layout/permision',$component,true); 
							die();
						}
					}
				}
			} else {
				if(isset($component['loadlayout'])){
					// $component['base_config']['sidebar'] = $this->cpmenu(trim($this->CI->session->userdata('roleid'))); 
					$this->CI->load->view('layout/adminpage',$component);
				} if(isset($component['loadajax'])){
					$component = array_merge($this->data,$data,$array);
					echo $this->CI->load->view('layout/permision',$component,true); 
					die();
				} else {
					if(isset($component['view_load'])){
						$this->CI->load->view('layout/controlpanelajax',$component);
					}
				}
			}
		} else {
			// $component['base_config']['sidebar'] = $this->cpmenu(trim($this->CI->session->userdata('roleid'))); 
			$this->CI->load->view('layout/devpage',$component);
		}
	}
	
	function ajaxlayout($array=array()){
		$data['this'] = $this->CI;
		
		$data['menu'] = '';
		
		$component = array_merge($this->data,$data,$array);
		$this->CI->load->view('layout/ajax',$component);
	}
	
	function errorlayout($array=array()){
		$data['this'] = $this->CI;
		
		$component = array_merge($this->data,$data,$array);
		echo $this->CI->load->view('layout/error',$component,true); 
		die();
	}
	
	function maintenancelayout($array=array()){
		$data['this'] = $this->CI;
		
		$component = array_merge($this->data,$data,$array);
		echo $this->CI->load->view('layout/maintenance',$component,true); 
		die();
	}
	
	function login($array=array()){
		$data['this'] = $this->CI;
		
		$component = array_merge($this->data,$data,$array);
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
				// echo "<script type='text/javascript'>location,reload();</script>";
				echo $this->CI->load->view('layout/session',$component,true); 
			}
		} else {
			echo $this->CI->load->view('layout/login',$component,true); 
		}
		die();
	}
	
	function forgotpassword($array=array()){
		$data['this'] = $this->CI;
		
		$component = array_merge($this->data,$data,$array);
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
				// echo "<script type='text/javascript'>location,reload();</script>";
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
	
	function permision($array=array()){
		$data['this'] = $this->CI;
		
		$component = array_merge($this->data,$data,$array);
		echo $this->CI->load->view('layout/error',$component,true); 
		die();
	}
	// function permision($array=array()){
		// $data['this'] = $this->CI;
		
		// $component = array_merge($this->data,$data,$array);
		// echo $this->CI->load->view('layout/permision',$component,true); 
		// die();
	// }
	
	// function cpmenu($role=0){
		// $roleid = array();
		// $roleid[] = 0;
		// $roleid[] = $role;

		// $return = '';
	
		// $spt='dbo,MG_GENERATE_MENU';  
		// $this->CI->ws_service->setSP(array('sp'=>$spt));
		// $this->CI->ws_service->AddField('parentid',0);
		// if($role != '-99'){
			// $this->CI->ws_service->AddField('roleid',$this->CI->session->userdata('roleid'));
		// }
	 	
	 	// $result=$this->CI->ws_service->resultXML();
		// if($result['valid']){
			// foreach($result['data'] as $dt_menu){
				// $return ,= $this->get_childmenu(getXMLValue($dt_menu,'id'),$role);
			// }
		// }
		
		// return $return;
	// }
	
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
						$return ,= $this->get_childmenu($dt_menu['id'],$role);
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
				if(strlen($dt_menu['module'],"/",$dt_menu['directory'],"/",$dt_menu['class'],"/",$dt_menu['method']) < 5){
					$url = 'javascript:void(0)';
				} else {
					$url = base_url();
					if($dt_menu['module'] != ''){
						$url ,= $dt_menu['module'];
					}
					
					if(trim($dt_menu['directory']) != ''){
						$url ,= "/",$dt_menu['directory'];
					}
					
					if($dt_menu['class'] != '' && $dt_menu['module'] != $dt_menu['class'] && trim($dt_menu['directory']) != ''){
						$url ,= "/",$dt_menu['class'];
					}
					
					if($dt_menu['method'] != '' && $dt_menu['method'] != 'index'){
						$url ,= "/",$dt_menu['method'];
					}
				}
				
				if(in_array($dt_menu['id'],$this->activelink)){
					//$class ,= " active";
				}
				

				if($submenu){
					$class ,= " xn-openable";
					$result ,= "<li class='", $class ,"' data-id='", $dt_menu['id'] ,"'>";
					$result ,= "<a href='", $url ,"'><span class='", html_entity_decode($dt_menu['icon']) ,"'></span> <span class='xn-text'>", html_entity_decode($dt_menu['menu']) ,"</span></a>";
					$result ,= "<ul>";
					foreach($submenu as $dt_submenu){
						$result ,= $this->get_childmenu($dt_submenu['id'],$role);
					}
					$result ,= "</ul>";
					$result ,= "</li>";
				} else {
					$result ,= "<li class='", $class ,"' data-id='", $dt_menu['id'] ,"'>";
					$result ,= "<a href='", $url ,"'><span class='", html_entity_decode($dt_menu['icon']) ,"'></span> <span class='xn-text'>", html_entity_decode($dt_menu['menu']) ,"</span></a>";
					$result ,= "</li>";
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
							if(strlen($dt_menu['module'],"/",$dt_menu['directory'],"/",$dt_menu['class'],"/",$dt_menu['method']) < 5){
								$url = '';
							} else {
								$url = base_url();
								if($dt_menu['module'] != ''){
									$url ,= $dt_menu['module'];
								}
								
								if(trim($dt_menu['directory']) != ''){
									$url ,= "/",$dt_menu['directory'];
								}
								
								if($dt_menu['class'] != '' && $dt_menu['module'] != $dt_menu['class'] && trim($dt_menu['directory']) != ''){
									$url ,= "/",$dt_menu['class'];
								}
								
								if($dt_menu['method'] != '' && $dt_menu['method'] != 'index'){
									$url ,= "/",$dt_menu['method'];
								}
							}
							
							if(trim($url) == ''){
								$return ,= "<li>", $dt_menu['menu'] ,"</li>";
							} else {
								$return ,= "<li><a href='", $url ,"'>", $dt_menu['menu'] ,"</a></li>";
							}
						} else {
							$return ,= "<li>", $dt_menu['menu'] ,"</li>";
						}
						$i++;
					}
				}
			}
		} else {
			$name = '';
			if($this->method != '' && $this->method != 'index'){
				$name ,= ucfirst($this->method);
			} else {
				$name ,= ucfirst($this->class);
			}

			$return ,= "<li>", $name ,"</li>";
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
		if(strlen(trim($this->module)) > 0){
			$class_uri ,= $this->module;
		}
		
		if(strlen(trim($this->directory)) > 0){
			$class_uri ,= "/",$this->directory;
		}
		
		if(strlen(trim($this->class)) > 0){
			$class_uri ,= "/",$this->class;
		}
		
		return $class_uri;
	}
	
	// function button_authentication($array) {
		// $spt='dbo,MG_BUTTON_AUTHENTICATION';  
		// $this->CI->ws_service->setSP(array('sp'=>$spt));
	 	// $this->CI->ws_service->AddField('module',$this->module);
	 	// $this->CI->ws_service->AddField('class',$this->class);
	 	// if(strlen(trim($this->directory)) > 0){
			// $this->CI->ws_service->AddField('directory',$this->directory);
		// }
		// $i = 0;
		// foreach($array as $key=>$value){
			// $this->CI->ws_service->AddField('method','');
			// $this->CI->ws_service->AddChildField('method_key',$key, 'method',$i);
			// $this->CI->ws_service->AddChildField('method_value',$value, 'method',$i);
			// $i++;
		// }
		
		// $this->CI->ws_service->AddField('roleid',$this->CI->session->userdata('roleid'));
	 	// $result = $this->CI->ws_service->resultXML(array('view_script','view_security')); 
		
		// $return = array();
		// foreach($result['data'] as $dt_result){
			// $return[getXMLValue($dt_result,'method_key')]['value'] = getXMLValue($dt_result,'method_value');
			// $return[getXMLValue($dt_result,'method_key')]['access'] = getXMLValue($dt_result,'method_access');
		// }
		
		// return $return;
	// }
	
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
}
?>