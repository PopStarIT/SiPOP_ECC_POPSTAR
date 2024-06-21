<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct(){ 
		parent::__construct(); 
		
		$this->data_request = $_REQUEST;
		
		$module = $this->router->module;
		$directory = $this->router->directory;
		$class = $this->router->class;
		$method = $this->router->method;
		$directory = trim(str_replace('../modules/'.$module ,'',str_replace('/controllers/','',$directory)),'/');
		print_r($directory);
		$this->module = $module;
		if(trim($directory) != ''){
			$this->directory = $directory;
		} else {
			$this->directory = '0';
			$this->directory2 = '';
		}
		$this->class = $class;
		$this->method = $method;
	} 

	function index($label = false, $genkey = false){ 
		
	} 
	
	function account_submit(){
		$this->authentication->plainlayout();
		$parameter = array();
        $return = array();
        
		$return['valid'] = false;
		$return['message'] = 'Internal server error, please try again';
		
		$error = 0;
		$error_msg = "";
	
        $fname = isset($_POST['fname']) ? trim($_POST['fname']) : null;
        $lname = isset($_POST['lname']) ? trim($_POST['lname']) : null;
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $phone = isset($_POST['phone']) ? trim($_POST['phone']) : null;
        $password = isset($_POST['password']) ? trim($_POST['password']) : null;
        $user_id = $this->session->userdata('user_id');
        		
		if($error == 0){

			$array = array();
			$array['fname'] = $fname;
			$array['lname'] = $lname;
			$array['email'] = $email;
			$array['phone'] = $phone;
			$array['password'] = $password;
			$array['user_id'] = $user_id;
			
			$sp = $this->clientapi->user_account($array);
		
			if(isset($sp->status)){
				if($sp->status == 'success'){
					if(isset($sp->data)){
												
						$return['valid'] = true;
						$return['status_code'] = 200;
						$return['message'] = $sp->data->message;
					}
						
				} else {
					$return['message'] = $sp->data->error_message;
				}
			}
		} else {
			$return['valid'] = false;
			$return['message'] = $error_msg;
		}
		
        echo json_encode($return);
	}
	
	function security(){ 
		$component['loadlayout'] = true;
		
		$component['page_title'] = 'Change Password';
		$component['page_icon'] = 'fa fa-lock';
		$component['view_load'] = 'security';
		$component['load_js'][] = 'security';
		
				 
		$this->authentication->cplayout($component);
	} 
	
	function security_submit(){
		//print_r("test");
		$this->authentication->plainlayout();
		$parameter = array();
        $return = array();
        
		$return['valid'] = false;
		$return['message'] = 'Internal server error, please try again';
		
		$error = 0;
		$error_msg = "";
		
        $oldpassword = isset($_POST['oldpassword']) ? trim($_POST['oldpassword']) : null;
        $password = isset($_POST['password']) ? trim($_POST['password']) : null;
        $password2 = isset($_POST['password2']) ? trim($_POST['password2']) : null;
        $user_id = $this->session->userdata('user_id');
        		
		if($error == 0){

			$array = array();
			$array['oldpassword'] = $oldpassword;
			$array['password'] = $password;
			$array['password2'] = $password2;
			$array['user_id'] = $user_id;
			
			$sp = $this->clientapi->user_security($array);
		
			if(isset($sp->status)){
				if($sp->status == 'success'){
					if(isset($sp->data)){
												
						$return['valid'] = true;
						$return['status_code'] = 200;
						$return['message'] = $sp->data->message;
					}
						
				} else {
					$return['message'] = $sp->data->error_message;
				}
			}
		} else {
			$return['valid'] = false;
			$return['message'] = $error_msg;
		}
		
        echo json_encode($return);
	}
	
	function login (){
		//print_r("test");
		//var_dump("test");
		$this->authentication->plainlayout();
		$parameter = array();
		$return = array();
		
		$username = isset($_POST['username']) ? trim($_POST['username']) : '';
		$password = isset($_POST['password']) ? trim($_POST['password']) : '';
		$user_agent =  $_SERVER['HTTP_USER_AGENT'];
		$session_id = $this->session->session_id;
			
		$result = array();
		$return['valid'] = false;
		$return['status_code'] = 501;
		$return['message'] = "Internal Server Error";
		//print_r(count($_POST));
		if(count($_POST) > 0){		
			//$this->rpc_service_portal->setSP("dbo.sp_user_login");
			//$this->rpc_service_portal->addField('username',$username);
			//$this->rpc_service_portal->addField('password',md5($password));
			//
			//$result = $this->rpc_service_portal->resultJSON();
			
			$this->rpc_service->setSP("dbo.sp_user_login");
			$this->rpc_service->addField('username',$username);
			$this->rpc_service->addField('password',md5($password));
			
			$result = $this->rpc_service->resultJSON();
			//echo $result->XML->saveXML();die;
			//$kode='p4Lm7578t';
			//var_dump(md5($kode));
		    //var_dump($result['data'])or die;
			$data = array();
			if(isset($result)){
				if(isset($result['valid'])){
					if($result['valid']){
						if(isset($result['data'])){
							
							$data = json_decode($result['data'],TRUE);
							$user_id = $data['user_id'];
							$username = $data['username'];
							$role_id = $data['role_id'];
							$home_currencies = $data['home_currencies'];
							$nama_pt = $data['nama_pt'];
							$type_fasilitas_kode = $data['type_fasilitas_kode'];
							$retained_earning_gl_account_code = $data['retained_earning_gl_account_code'];
							
							//var_dump($data);die();
							$newdata = array(
								'user_id'  => $user_id,
								'username'  => $username,
								'role_id'  => $role_id,
								'lockscreen'  => FALSE,
								'login' => TRUE,
								'home_currencies' => $home_currencies,
								'decimal_price' => 4,
								'nama_pt' => $nama_pt,
								'type_fasilitas_kode' => $type_fasilitas_kode,
								'retained_earning_gl_account_code' => $retained_earning_gl_account_code
							);

							$this->session->set_userdata($newdata);	
							
							$return['valid'] = $result['valid'];
							$return['status_code'] = $result['no'];
							$return['message'] = $result['des'];
							
						}
					} else {
						$return['status_code'] = $result['no'];
						$return['message'] = $result['des'];
					}
				}
			}
		} else {
			$return['valid'] = false;
			$return['message'] = "Session expired";
		}
		
		echo json_encode($return);
	}
	
	function logout(){ 
		$component['loadlayout'] = true;
		
		$this->session->sess_destroy();
		$component['load_js'][] = 'logout';
		
		$this->authentication->blanklayout($component);
	}
	
	function generate_security_module(){	
		$this->rpc_service->setSP("dbo.sp_security_module_edit");
		$this->rpc_service->addField('module_method_id','');
		$this->rpc_service->addField('alias','');
		$this->rpc_service->addField('token_id','');
	
		$result = $this->rpc_service->resultJSON();
		print_r($result);
		$data = array();
		if(isset($result)){
			if(isset($result['valid'])){
				if($result['valid']){
					if(isset($result['data'])){
						$return['valid'] = $result['valid'];
						$return['status_code'] = $result['no'];
						$return['message'] = $result['des'];
						
						$data_result = json_decode($result['data'],true);
						$data_module = array();
						$data_class = array();
						$data_method = array();
						foreach($data_result as $key=>$value){
							$data_module[$value['module']] = $value['module_id'];
							$data_class[$value['module_id']][$value['module_directory']][$value['module_class']] = $value['module_class_id'];
							$data_method[$value['module_class_id']][$value['module_method']] = array('id'=>$value['module_method_id'], 'tokenid'=>$value['token_id']);
							
						}
						
						$myfile = fopen("bricks_data/module_config.json", "w");
						$txt = json_encode($data_module, JSON_PRETTY_PRINT);
						fwrite($myfile, $txt);
						fclose($myfile);

						$myfile = fopen("bricks_data/class_config.json", "w");
						$txt = json_encode($data_class, JSON_PRETTY_PRINT);
						fwrite($myfile, $txt);
						fclose($myfile);

						$myfile = fopen("bricks_data/method_config.json", "w");
						$txt = json_encode($data_method, JSON_PRETTY_PRINT);
						fwrite($myfile, $txt);
						fclose($myfile);

					}
				}
			}
		}
	}
	
	function redirect_error(){
		$url = "";
		if(strlen($this->module."/".$this->directory."/".$this->class."/".$this->method) < 5){
			$url = 'javascript:void(0)';
		} else {
			$url = base_url();
			if($this->module != ''){
				$url .= $this->module;
			}
			
			if(trim($this->directory) != '0'){
				$url .= "/".$this->directory;
			}
			
			if($this->class != '' && $this->module != $this->class && trim($this->directory) != '0'){
				$url .= "/".$this->class;
			}
		}
		echo $url;
		redirect($url);
	}
}
