<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bricksapi {
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->model('main');
		$this->CI->load->library('mainconfig');
	}
	
	function app_config(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$param = isset($_REQUEST['param']) ? htmlentities($_REQUEST['param']) : '';
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
	
		$where = array();
		$where['param'] = $param;
		$data_config = $this->CI->main->getData('dbo.dt_app_config',null,$where);
		if($data_config){
			foreach($data_config as $dt_config){
				$return['status'] = 'success';
				$return['data']['config_id'] = $dt_config['config_id'];
				$return['data']['param'] = $dt_config['param'];
				$return['data']['value'] = $dt_config['value'];
				$return['data']['default'] = $dt_config['default'];
			}
		} else {
			$return['data']['error_message'] = "Config not found";
		}
		
		return $return;
	}
	
	function get_period(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$gl_period_id = isset($_REQUEST['gl_period_id']) ? htmlentities($_REQUEST['gl_period_id']) : 1;
		$last = isset($_REQUEST['last']) ? htmlentities($_REQUEST['last']) : -1;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		
		$order = null;
		$limit = null;
		
		$where = array();
		if($gl_period_id != -1){
			$where['gl_period_id'] = $gl_period_id;
		}
		
		
		$count = $this->CI->main->countData('dbo.dt_gl_period',$where) * 1;
		
		if($last == 1){
			$order = 'gl_period_id desc';
			$limit = 'gl_period_id desc';
		} else {
			if($count > 0){
				$count = 1;
			}
		}

		if($count > 0) {
			$data = $this->CI->main->getData('dbo.dt_gl_period', null, $where, null, $order, $limit);
		} else {
			$data = false;
		}
		
		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		
		return $return;
	}
	
	function get_period_by_date(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$date = isset($_REQUEST['date']) ? htmlentities($_REQUEST['date']) : 1;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
	
		$where = array();
		$where['gl_period_start <='] = $date; 
		$where['gl_period_end >='] = $date; 
		$count = $this->CI->main->countData('dbo.dt_gl_period',$where) * 1;

		if($count > 0) {
			$data = $this->CI->main->getData('dbo.dt_gl_period', null, $where);
		} else {
			$data = false;
		}
		
		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		
		return $return;
	}
	
	function get_year_budget(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$this_year_end = isset($_REQUEST['this_year_end']) ? htmlentities($_REQUEST['this_year_end']) : false;
		$next_year_end = isset($_REQUEST['next_year_end']) ? htmlentities($_REQUEST['next_year_end']) : false;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where[" (gl_period_end between DATE_ADD('". $this_year_end ."', INTERVAL 1 DAY) AND '". $next_year_end ."' ) AND 1="] = 1;
		
		$count = $this->CI->main->countData('dbo.dt_gl_period',$where) * 1;

		if($count > 0) {
			$data = $this->CI->main->getData('dbo.dt_gl_period', null, $where);
		} else {
			$data = false;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;

		return $return;
	}
	
	function gl_account_section(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$offset = isset($_REQUEST['offset']) ? htmlentities($_REQUEST['offset']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$sort = isset($_REQUEST['sort']) ? htmlentities($_REQUEST['sort']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$count = $this->CI->main->countData('dbo.view_gl_account_section',$where) * 1;

		if($count > 0) {
			
			$data = $this->CI->main->getData('dbo.view_gl_account_section', null, $where, null, $sort, $limit, $offset);

		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;

		return $return;
	}
	
	function gl_account_group(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$offset = isset($_REQUEST['offset']) ? htmlentities($_REQUEST['offset']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$sort = isset($_REQUEST['sort']) ? htmlentities($_REQUEST['sort']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		
		$gl_account_section_id = isset($_REQUEST['gl_account_section_id']) ? htmlentities($_REQUEST['gl_account_section_id']) : false;
		$gl_account_group_parent_id = isset($_REQUEST['gl_account_group_parent_id']) ? htmlentities($_REQUEST['gl_account_group_parent_id']) : false;
		
		
		$where = array();
		if($gl_account_section_id){
			$where['gl_account_section_id'] = $gl_account_section_id;
		}
		
		if($gl_account_group_parent_id){
			if($gl_account_group_parent_id == -1){
				$where['gl_account_group_parent_id is null AND 1='] = 1;
			} else {
				$where['gl_account_group_parent_id'] = $gl_account_group_parent_id;
			}
		}
		
		$count = $this->CI->main->countData('dbo.view_gl_account_group',$where) * 1;

		if($count > 0) {
			
			$data = $this->CI->main->getData('dbo.view_gl_account_group', null, $where, null, $sort, $limit, $offset);

		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;

		return $return;
	}
		
	function gl_account(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$offset = isset($_REQUEST['offset']) ? htmlentities($_REQUEST['offset']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$sort = isset($_REQUEST['sort']) ? htmlentities($_REQUEST['sort']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$count = $this->CI->main->countData('dbo.view_gl_account',$where) * 1;

		if($count > 0) {
			
			$data = $this->CI->main->getData('dbo.view_gl_account', null, $where, null, $sort, $limit, $offset);

		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;

		return $return;
	}
	
	function project(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$offset = isset($_REQUEST['offset']) ? htmlentities($_REQUEST['offset']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$sort = isset($_REQUEST['sort']) ? htmlentities($_REQUEST['sort']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$count = $this->CI->main->countData('dbo.view_project',$where) * 1;

		if($count > 0) {
			
			$data = $this->CI->main->getData('dbo.view_project', null, $where, null, $sort, $limit, $offset);

		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;

		return $return;
	}
	
	function gl_tag(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$offset = isset($_REQUEST['offset']) ? htmlentities($_REQUEST['offset']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$sort = isset($_REQUEST['sort']) ? htmlentities($_REQUEST['sort']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$count = $this->CI->main->countData('dbo.view_gl_tag',$where) * 1;

		if($count > 0) {
			
			$data = $this->CI->main->getData('dbo.view_gl_tag', null, $where, null, $sort, $limit, $offset);

		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;

		return $return;
	}
	
	function bank(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$offset = isset($_REQUEST['offset']) ? htmlentities($_REQUEST['offset']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$sort = isset($_REQUEST['sort']) ? htmlentities($_REQUEST['sort']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$count = $this->CI->main->countData('dbo.view_bank',$where) * 1;

		if($count > 0) {
			
			$data = $this->CI->main->getData('dbo.view_bank', null, $where, null, $sort, $limit, $offset);

		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;

		return $return;
	}
	
	function gl_trans(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$offset = isset($_REQUEST['offset']) ? htmlentities($_REQUEST['offset']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$sort = isset($_REQUEST['sort']) ? htmlentities($_REQUEST['sort']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$count = $this->CI->main->countData('dbo.view_gl_trans',$where) * 1;

		if($count > 0) {
			
			$data = $this->CI->main->getData('dbo.view_gl_trans', null, $where, null, $sort, $limit, $offset);

		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;

		return $return;
	}
	
	function gl_period(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$offset = isset($_REQUEST['offset']) ? htmlentities($_REQUEST['offset']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$sort = isset($_REQUEST['sort']) ? htmlentities($_REQUEST['sort']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$count = $this->CI->main->countData('dbo.view_gl_period',$where) * 1;

		if($count > 0) {
			
			$data = $this->CI->main->getData('dbo.view_gl_period', null, $where, null, $sort, $limit, $offset);

		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;

		return $return;
	}
	
	function gl_account_detail(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$offset = isset($_REQUEST['offset']) ? htmlentities($_REQUEST['offset']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$sort = isset($_REQUEST['sort']) ? htmlentities($_REQUEST['sort']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		
		$gl_account_group_id = isset($_REQUEST['gl_account_group_id']) ? htmlentities($_REQUEST['gl_account_group_id']) : false;
		$gl_period_id = isset($_REQUEST['gl_period_id']) ? htmlentities($_REQUEST['gl_period_id']) : false;
		
		
		$where = array();
		if($gl_account_group_id){
			$where['gl_account_group_id'] = $gl_account_group_id;
		}
		if($gl_period_id){
			$where['gl_period_id'] = $gl_period_id;
		}
				
		$count = $this->CI->main->countData('dbo.view_gl_account_detail',$where) * 1;

		if($count > 0) {
			
			$data = $this->CI->main->getData('dbo.view_gl_account_detail', null, $where, null, $sort, $limit, $offset);

		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;

		return $return;
	}
	
	function user_login(){
		$return = array();

		$api_token = $this->CI->mainconfig->generateRandomString(32,true);
		$username = isset($_REQUEST['username']) ? htmlentities($_REQUEST['username']) : null;
		$password = isset($_REQUEST['password']) ? htmlentities($_REQUEST['password']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		
		$array = array();
		$array['api_token'] = $api_token;
		$array['username'] = $username;
		$array['password'] = $password;
		$array['ip_address'] = $ip_address;
		
		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_user_login',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
			$result['user_id'] = $dt_sp['user_id'];
			$result['email'] = $dt_sp['email'];
			$result['username'] = $dt_sp['username'];
			$result['role_id'] = $dt_sp['role_id'];
			$result['api_token'] = $dt_sp['api_token'];
		}
		
		if($result['valid'] == true){
			$return['status'] = 'success';
			$return['data']['message'] = 'Login Successful';
			$return['data']['user_id'] = $result['user_id'];
			$return['data']['username'] = $result['username'];
			$return['data']['email'] = $result['email'];
			$return['data']['role_id'] = $result['role_id'];
			$return['data']['api_token'] = $result['api_token'];

		} else {
			$return['data']['error_message'] = $result['message'];
		}
		
		return $return;
	}
	
	function user_info(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
	
		$where = array();
		$where['user_id'] = $user_id;
		$data_user = $this->CI->main->getData('dt_user',null,$where);
		if($data_user){
			foreach($data_user as $dt_user){
				$return['status'] = 'success';
				$return['data']['user_id'] = $dt_user['user_id'];
				$return['data']['username'] = $dt_user['username'];
				$return['data']['email'] = $dt_user['email'];
				$return['data']['phone'] = $dt_user['phone'];
				$return['data']['fname'] = $dt_user['fname'];
				$return['data']['lname'] = $dt_user['lname'];
			}
		} else {
			$return['data']['error_message'] = "User not found";
		}
		
		return $return;
	}
	
	function user_account(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$fname = isset($_REQUEST['fname']) ? htmlentities($_REQUEST['fname']) : null;
		$lname = isset($_REQUEST['lname']) ? htmlentities($_REQUEST['lname']) : null;
		$email = isset($_REQUEST['email']) ? htmlentities($_REQUEST['email']) : null;
		$phone = isset($_REQUEST['phone']) ? htmlentities($_REQUEST['phone']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$password = isset($_REQUEST['password']) ? htmlentities($_REQUEST['password']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
	
		$array = array();
		$array['api_token'] = $api_token;
		$array['fname'] = $fname;
		$array['lname'] = $lname;
		$array['email'] = $email;
		$array['phone'] = $phone;
		$array['password'] = $password;
		$array['user_id'] = $user_id;
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_user_account',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == true){
			$return['status'] = 'success';
			$return['data']['message'] = "Success";
		} else {
			$return['data']['error_message'] = $result['message'];
		}


		return $return;
	}
	
	function user_security(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$oldpassword = isset($_REQUEST['oldpassword']) ? htmlentities($_REQUEST['oldpassword']) : null;
		$password = isset($_REQUEST['password']) ? htmlentities($_REQUEST['password']) : null;
		$password2 = isset($_REQUEST['password2']) ? htmlentities($_REQUEST['password2']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['api_token'] = $api_token;
		$array['oldpassword'] = $oldpassword;
		$array['password'] = $password;
		$array['password2'] = $password2;
		$array['user_id'] = $user_id;
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_user_security',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == true){
			$return['status'] = 'success';
			$return['data']['message'] = "Success";
		} else {
			$return['data']['error_message'] = $result['message'];
		}


		return $return;
	}
	
	function setting_user(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$offset = isset($_REQUEST['offset']) ? htmlentities($_REQUEST['offset']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$sort = isset($_REQUEST['sort']) ? htmlentities($_REQUEST['sort']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$count = $this->CI->main->countData('view_user',$where) * 1;

		if($count > 0) {
			
			$data = $this->CI->main->getData('view_user', null, $where, null, $sort, $limit, $offset);

		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;

		return $return;
	}
	
	function setting_user_param(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where['user_id'] = $user_id;
		
		$data = $this->CI->main->getData('view_user', null, $where, null, null, 1);
		
		$return['status'] = 'success';
		$return['data'] = $data;

		return $return;
	}
	
	function setting_user_add(){
		$return = array();

		$api_token = $this->CI->mainconfig->generateRandomString(32,true);
		$username = isset($_REQUEST['username']) ? htmlentities($_REQUEST['username']) : null;
		$password = isset($_REQUEST['password']) ? htmlentities($_REQUEST['password']) : null;
		$password2 = isset($_REQUEST['password2']) ? htmlentities($_REQUEST['password2']) : null;
		$fname = isset($_REQUEST['fname']) ? htmlentities($_REQUEST['fname']) : null;
		$lname = isset($_REQUEST['lname']) ? htmlentities($_REQUEST['lname']) : null;
		$phone = isset($_REQUEST['phone']) ? htmlentities($_REQUEST['phone']) : null;
		$email = isset($_REQUEST['email']) ? htmlentities($_REQUEST['email']) : null;
		$role_id = isset($_REQUEST['role_id']) ? htmlentities($_REQUEST['role_id']) : null;
		$status_id = isset($_REQUEST['status_id']) ? htmlentities($_REQUEST['status_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		
		$array = array();
		$array['api_token'] = $api_token;
		$array['username'] = $username;
		$array['password'] = $password;
		$array['password2'] = $password2;
		$array['fname'] = $fname;
		$array['lname'] = $lname;
		$array['phone'] = $phone;
		$array['email'] = $email;
		$array['role_id'] = $role_id;
		$array['status_id'] = $status_id;
		$array['ip_address'] = $ip_address;
		
		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_setting_user_add',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}
		
		if($result['valid'] == true){
			$return['status'] = 'success';
			$return['data']['message'] = 'Success';

		} else {
			$return['data']['error_message'] = $result['message'];
		}
		
		return $return;
	}
	
	function setting_user_edit(){
		$return = array();

		$api_token = $this->CI->mainconfig->generateRandomString(32,true);
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$username = isset($_REQUEST['username']) ? htmlentities($_REQUEST['username']) : null;
		$password = isset($_REQUEST['password']) ? htmlentities($_REQUEST['password']) : null;
		$password2 = isset($_REQUEST['password2']) ? htmlentities($_REQUEST['password2']) : null;
		$fname = isset($_REQUEST['fname']) ? htmlentities($_REQUEST['fname']) : null;
		$lname = isset($_REQUEST['lname']) ? htmlentities($_REQUEST['lname']) : null;
		$phone = isset($_REQUEST['phone']) ? htmlentities($_REQUEST['phone']) : null;
		$email = isset($_REQUEST['email']) ? htmlentities($_REQUEST['email']) : null;
		$role_id = isset($_REQUEST['role_id']) ? htmlentities($_REQUEST['role_id']) : null;
		$status_id = isset($_REQUEST['status_id']) ? htmlentities($_REQUEST['status_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		
		$array = array();
		$array['api_token'] = $api_token;
		$array['user_id'] = $user_id;
		$array['username'] = $username;
		$array['password'] = $password;
		$array['password2'] = $password2;
		$array['fname'] = $fname;
		$array['lname'] = $lname;
		$array['phone'] = $phone;
		$array['email'] = $email;
		$array['role_id'] = $role_id;
		$array['status_id'] = $status_id;
		$array['ip_address'] = $ip_address;
		
		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_setting_user_edit',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}
		
		if($result['valid'] == true){
			$return['status'] = 'success';
			$return['data']['message'] = 'Success';

		} else {
			$return['data']['error_message'] = $result['message'];
		}
		
		return $return;
	}
	
	
	
	function cleansing_jo(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$job = isset($_REQUEST['job']) ? htmlentities($_REQUEST['job']) : null;
		$suffix = isset($_REQUEST['suffix']) ? htmlentities($_REQUEST['suffix']) : null;
		$wc = isset($_REQUEST['wc']) ? htmlentities($_REQUEST['wc']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
	
		$where = array();
		$where['job'] = $job;
		$where['suffix'] = $suffix;
		$where['wc'] = $wc;
		$data_user = $this->CI->main->getData('view_jo',null,$where);
		if($data_user){
			foreach($data_user as $dt_user){
				$return['status'] = 'success';
				$return['data']['job'] = $dt_user['job'];
				$return['data']['suffix'] = $dt_user['suffix'];
				$return['data']['wc'] = $dt_user['wc'];
				$return['data']['work_center'] = $dt_user['work_center'];
				$return['data']['part_name'] = $dt_user['part_name'];
				$return['data']['part_number'] = $dt_user['part_number'];
				$return['data']['model'] = $dt_user['model'];
				$return['data']['cavity'] = $dt_user['cavity'];
				$return['data']['order_qty'] = $dt_user['order_qty'];
				$return['data']['order_shoot'] = $dt_user['order_shoot'];
				$return['data']['total_weight'] = $dt_user['total_weight'];
				$return['data']['UF_PR23_CycleTime'] = $dt_user['UF_PR23_CycleTime'];
				$return['data']['customer'] = $dt_user['customer'];
				$return['data']['daily_qty'] = $dt_user['daily_qty'];
				$return['data']['daily_shoot'] = $dt_user['daily_shoot'];
				$return['data']['form_no'] = $dt_user['form_no'];
				$return['data']['std_prod_time'] = $dt_user['std_prod_time'];
				$return['data']['rev_date'] = $dt_user['rev_date'];
				$return['data']['tool_no'] = $dt_user['tool_no'];
				$return['data']['purging'] = $dt_user['purging'];
				$return['data']['allowance'] = $dt_user['allowance'];
				$return['data']['act_weight'] = $dt_user['act_weight'];
				$return['data']['type_id'] = $dt_user['type_id'];
				$return['data']['start_date'] = $dt_user['start_date'];
				$return['data']['start_time_plan'] = $dt_user['start_time_plan'];
				$return['data']['finish_date'] = $dt_user['finish_date'];
				$return['data']['finish_time_plan'] = $dt_user['finish_time_plan'];
				$return['data']['total_injection'] = $dt_user['total_injection'];
				$return['data']['total_counter'] = $dt_user['total_counter'];
				$return['data']['rgid'] = $dt_user['rgid'];
			}
		} else {
			$return['data']['error_message'] = "Work Order not found";
		}
		
		return $return;
	}
	
	function user_login_verify(){
		$return = array();
		$success = false;

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$authentication = isset($_REQUEST['authentication']) ? htmlentities($_REQUEST['authentication']) : null;
		$authentication_code = isset($_REQUEST['authentication_code']) ? htmlentities($_REQUEST['authentication_code']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		$user_agent = isset($_REQUEST['user_agent']) ? htmlentities($_REQUEST['user_agent']) : "";
		$app_id = isset($_REQUEST['app_id']) ? htmlentities($_REQUEST['app_id']) : 1;
		$session_id = isset($_REQUEST['session_id']) ? htmlentities($_REQUEST['session_id']) : 1;

		$location = "NA";

		$url = "https://ipinfo.io/";
		$url .= $ip_address;
		$url .= "/json";
		$ip_info = file_get_contents($url);
		$ip_info = json_decode($ip_info,true);

		if(isset($ip_info['country'])){
			$location = $ip_info['country'];
		}

		$array = array();
		$array['api_token'] = $api_token;
		$array['user_id'] = $user_id;
		$array['authentication_code'] = $authentication_code;
		$array['ip_address'] = $ip_address;
		$array['user_agent'] = $user_agent;
		$array['app_id'] = $app_id;
		$array['location'] = $location;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_user_login_verify',$parameter);
		// print_r($sp);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
			$result['user_id'] = $dt_sp['user_id'];
			$result['email'] = $dt_sp['email'];
			$result['username'] = $dt_sp['username'];
			$result['user_2fa'] = $dt_sp['user_2fa'];
			$result['send_2fa'] = $dt_sp['send_2fa'];
			$result['role_id'] = $dt_sp['role_id'];
			$result['token_id'] = $dt_sp['token_id'];
		}
		// print_r($parameter);
		// print_r($sp);
		if($result['valid'] == 'true'){
			$return['data']['user_id'] = $result['user_id'];
			$return['data']['username'] = $result['username'];
			$return['data']['email'] = $result['email'];
			$return['data']['role_id'] = $result['role_id'];
			$return['data']['token_id'] = $result['token_id'];

			if($result['send_2fa'] == 0){
				$this->CI->load->library('googleauthenticator');
				$authenticator = $this->CI->googleauthenticator->verifyCode($result['user_2fa'], $authentication_code);
				if($authenticator){
					$success = true;
				} else {
					$return['data']['error_message'] = 'Invalid Code';
				}
			} else {
				$success = true;
			}

			if($success){
				$return['status'] = 'success';
				$return['data']['message'] = 'Login Successful';
				$return['api_token'] = $api_token;
				$return['user_id'] = $user_id;

				
			}

		} else {
			$return['data']['error_message'] = $result['message'];
		}
		return $return;
	}
	
	function authentication_token($token){
		$return = array();

		return true;
	}
	
	function user_authentication(){
		$return = array();

		$user_data = array();

		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['user_id'] = $user_id;
		$array['api_token'] = $api_token;
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$authentication = $this->CI->main->executeSP('sp_user_authentication',$parameter);
		foreach($authentication as $dt_authentication){
			$result['valid'] = $dt_authentication['valid'];
			$result['message'] = $dt_authentication['message'];
		}

		if($result['valid'] == 'true'){
			$sessions = array();
			$sessions[$ip_address] = array();
			$sessions[$ip_address][$api_token] = 1;

			$where = array();
			$where['user_id'] = $user_id;
			$rows = array();
			$data = $this->CI->main->getData('view_user_wallet', null, $where);
			if($data){
				foreach($data as $dt){
					$row = array();
					$row['wallet_code'] = $dt['wallet_code'];
					$row['wallet'] = $dt['wallet'];
					$row['balance'] = $this->CI->mainconfig->get_decimal_format($dt['balance']);
					$row['pending_balance'] = $this->CI->mainconfig->get_decimal_format($dt['pending_balance']);
					$row['default_address'] = $dt['default_address'];

					$rows[$row['wallet_code']] = $row;
				}
			}

			$user_data['sessions'] = $sessions;
			$user_data['wallet'] = $rows;

			$return['status'] = 'success';
			$return['user_data'] = $user_data;
		} else {
			$return['data']['error_message'] = $result['message'];
		}

		return $return;
	}

	function user_authentication_v2(){
		$return = array();

		$user_data = array();

		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		$device_id = isset($_REQUEST['device_id']) ? htmlentities($_REQUEST['device_id']) : null;

		$array = array();
		$array['user_id'] = $user_id;
		$array['api_token'] = $api_token;
		$array['ip_address'] = $ip_address;
		$array['device_id'] = $device_id;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$authentication = $this->CI->main->executeSP('sp_user_authentication_v2',$parameter);
		foreach($authentication as $dt_authentication){
			$result['valid'] = $dt_authentication['valid'];
			$result['message'] = $dt_authentication['message'];
			$result['username'] = $dt_authentication['username'];
			$result['scn_address'] = $dt_authentication['scn_address'];
			$result['balance'] = $dt_authentication['balance'];
		}

		if($result['valid'] == 'true'){
			$where = array();
			$where['user_id'] = $user_id;

			$rows = array();
			$data_wallet = $this->CI->main->getData('view_asset_details', null, $where);
			if($data_wallet){
				foreach($data_wallet as $dt){
					$row = array();
					$row['is_exchange'] = $dt['is_exchange'];
					$row['exchange_bonus'] = $dt['exchange_bonus'];
					$row['wallet_id'] = $dt['wallet_id'];
					$row['wallet_code'] = $dt['wallet_code'];
					$row['wallet'] = $dt['wallet'];
					$row['wallet_actived'] = $dt['wallet_actived'];
					$row['deposit_actived'] = $dt['deposit_actived'];
					$row['withdraw_actived'] = $dt['withdraw_actived'];
					$row['pool_actived'] = $dt['pool_actived'];
					$row['pool_last_reward'] = $dt['pool_last_reward'];
					$row['reinvest'] = $dt['reinvest'];
					$row['balance'] = $this->CI->mainconfig->get_decimal_format($dt['balance']);
					$row['pending_balance'] = $this->CI->mainconfig->get_decimal_format($dt['pending_balance']);
					$row['lock_balance'] = $this->CI->mainconfig->get_decimal_format($dt['lock_balance']);
					$row['total_balance'] = $this->CI->mainconfig->get_decimal_format($dt['total_balance']);
					$row['staking_balance'] = $this->CI->mainconfig->get_decimal_format($dt['staking_balance']);
					$row['lock_staking_balance'] = $this->CI->mainconfig->get_decimal_format($dt['lock_staking_balance']);
					$row['pool_balance'] = $this->CI->mainconfig->get_decimal_format($dt['pool_balance']);
					$row['pool_fee'] = $this->CI->mainconfig->get_decimal_format($dt['pool_fee'],2);
					$row['pool_daily'] = $this->CI->mainconfig->get_decimal_format($dt['pool_daily'],2);
					$row['ROI'] = $this->CI->mainconfig->get_decimal_format($dt['ROI'],2);
					$row['est_daily'] = $this->CI->mainconfig->get_decimal_format($dt['est_daily']);
					$row['pool_staking_balance'] = $this->CI->mainconfig->get_decimal_format($dt['pool_staking_balance']);
					$rows[$dt['wallet_id']] = $row;
				}
			}

			$return['user_asset'] = $rows;

			$sessions = array();
			$sessions[$api_token] = $device_id;

			$user_info = array();
			$user_info['username'] = $result['username'];
			$user_info['scn_address'] = $result['scn_address'];
			$user_info['balance'] = $this->CI->mainconfig->get_decimal_format($result['balance']);

			$user_data['sessions'] = $sessions;
			$user_data['user_info'] = $user_info;
			$user_data['user_asset'] = $rows;

			$return['status'] = 'success';
			$return['user_data'] = $user_data;
		} else {
			$return['data']['error_message'] = $result['message'];
		}

		return $return;
	}

	function authentication($array=array()){
		$return = array();

		$username = isset($_REQUEST['username']) ? htmlentities($_REQUEST['username']) : null;
		$api_key = isset($_REQUEST['api_key']) ? htmlentities($_REQUEST['api_key']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['username'] = $username;
		$array['api_key'] = $api_key;
		$array['ip_address'] = $ip_address;
		$array['api_token'] = $this->CI->mainconfig->generateRandomString(32,true);
		$array['expired_date'] = date('Y-m-d H:i:s',(time() + (60 * 20)));

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$authentication = $this->CI->main->executeSP('sp_api_authentication',$parameter);
		foreach($authentication as $dt_authentication){
			$result['valid'] = $dt_authentication['valid'];
			$result['message'] = $dt_authentication['message'];
			$result['api_key'] = $dt_authentication['api_key'];
			$result['ip_address'] = $dt_authentication['ip_address'];
			$result['api_token'] = $dt_authentication['api_token'];
			$result['expired_date'] = $dt_authentication['expired_date'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
			$return['data']['api_token'] = $result['api_token'];
		} else {
			$return['data']['error_message'] = $result['message'];
		}

		return $return;
	}

	function exchange_payment(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$wallet_id = isset($_REQUEST['wallet_id']) ? htmlentities($_REQUEST['wallet_id']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$exchange_amount = isset($_REQUEST['exchange_amount']) ? htmlentities($_REQUEST['exchange_amount']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['api_token'] = $api_token;
		$array['wallet_id'] = $wallet_id;
		$array['user_id'] = $user_id;
		$array['exchange_amount'] = $exchange_amount;
		$array['ip_address'] = $ip_address;
		$array['transdate'] = date('Y-m-d H:i:s');

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array
		// print_r($parameter);
		$sp = $this->CI->main->executeSP('sp_exchange_payment',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
			$result['user_id'] = $dt_sp['user_id'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
			$return['data']['message'] = $result['message'];
			$return['data']['user_id'] = $result['user_id'];
		} else {
			$return['data']['error_message'] = $result['message'];
		}

		return $return;
	}

	function verify_ip(){
		$return = array();

		$token = isset($_REQUEST['token']) ? htmlentities($_REQUEST['token']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['api_token'] = $token;
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_verify_ip',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
		} else {
			$return['data']['error_message'] = $result['message'];
		}
		return $return;
	}

	function check_username(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$username = isset($_REQUEST['username']) ? htmlentities($_REQUEST['username']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['api_token'] = $api_token;
		$array['username'] = $username;
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_check_username',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
		} else {
			$return['data']['error_message'] = $result['message'];
		}
		return $return;
	}

	function check_email(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$email = isset($_REQUEST['email']) ? htmlentities($_REQUEST['email']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['api_token'] = $api_token;
		$array['email'] = $email;
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_check_email',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
		} else {
			$return['data']['error_message'] = $result['message'];
		}
		return $return;
	}

	function user_register(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$role_id = isset($_REQUEST['role_id']) ? htmlentities($_REQUEST['role_id']) : null;
		$status_id = isset($_REQUEST['status_id']) ? htmlentities($_REQUEST['status_id']) : null;
		$username = isset($_REQUEST['username']) ? htmlentities($_REQUEST['username']) : null;
		$email = isset($_REQUEST['email']) ? htmlentities($_REQUEST['email']) : null;
		$password = isset($_REQUEST['password']) ? htmlentities($_REQUEST['password']) : null;
		$password2 = isset($_REQUEST['password2']) ? htmlentities($_REQUEST['password2']) : null;
		$register_ip = isset($_REQUEST['ip']) ? htmlentities($_REQUEST['ip']) : null;
		$register_code = isset($_REQUEST['code']) ? htmlentities($_REQUEST['code']) : null;
		$link = isset($_REQUEST['link']) ? htmlentities($_REQUEST['link']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['api_token'] = $api_token;
		$array['role_id'] = $role_id;
		$array['status_id'] = $status_id;
		$array['username'] = $username;
		$array['email'] = $email;
		$array['password'] = $password;
		$array['password2'] = $password2;
		$array['register_ip'] = $register_ip;
		$array['register_code'] = $register_code;
		$array['ip_address'] = $ip_address;
		$array['link'] = $link . '?username='. $username .'&activation_code='.$register_code;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array
		// print_r($parameter);
		$sp = $this->CI->main->executeSP('sp_user_register',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
			$result['user_id'] = $dt_sp['user_id'];
		}

		if($result['valid'] == 'true'){
			if($this->CI->mainconfig->send_template_mail('register',$email,$array)){
				$return['status'] = 'success';
				$return['data']['message'] = "An email has been sent to <b>". $email ."</b>, please click the activation link in the email to complete your registration process..";
				$return['data']['user_id'] = $result['user_id'];
			} else {
				$return['data']['error_message'] = "Error send email, Please contact our support";
			}
		} else {
			$return['data']['error_message'] = $result['message'];
		}

		return $return;
	}

	function user_register_confirmation(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		$username = isset($_REQUEST['username']) ? htmlentities($_REQUEST['username']) : null;
		$activation_code = isset($_REQUEST['activation_code']) ? htmlentities($_REQUEST['activation_code']) : null;

		$array = array();
		$array['api_token'] = $api_token;
		$array['ip_address'] = $ip_address;
		$array['username'] = $username;
		$array['activation_code'] = $activation_code;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_user_register_confirmation',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
		} else {
			$return['data']['error_message'] = $result['message'];
		}
		return $return;
	}

	function user_forgot_password_confirmation(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		$username = isset($_REQUEST['username']) ? htmlentities($_REQUEST['username']) : null;
		$reset_code = isset($_REQUEST['reset_code']) ? htmlentities($_REQUEST['reset_code']) : null;

		$array = array();
		$array['api_token'] = $api_token;
		$array['ip_address'] = $ip_address;
		$array['username'] = $username;
		$array['reset_code'] = $reset_code;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_user_forgot_password_confirmation',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
		} else {
			$return['data']['error_message'] = $result['message'];
		}
		return $return;
	}

	

	function user_register_confirmation_resend(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : 0;
		$link = isset($_REQUEST['link']) ? htmlentities($_REQUEST['link']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['api_token'] = $api_token;
		$array['user_id'] = $user_id;
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_user_register_confirmation_resend',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
			$result['user_id'] = $dt_sp['user_id'];
			$result['username'] = $dt_sp['username'];
			$result['email'] = $dt_sp['email'];
			$result['register_code'] = $dt_sp['register_code'];
		}
		// print_r($parameter);
		// print_r($sp);
		if($result['valid'] == 'true'){
			$return['status'] = 'success';
			$return['data']['message'] = $result['message'];

			$array = array();
			$array['username'] = $result['username'];
			$array['register_code'] = $result['register_code'];
			$array['email'] = $result['email'];
			$array['ip_address'] = $ip_address;
			$array['link'] = $link . '?username='. $result['username'] .'&activation_code='.$result['register_code'];

			if($this->CI->mainconfig->send_template_mail('register',$result['email'],$array)){

				$return['data']['message'] = "An email has been sent to <b>". $result['email'] ."</b>, please click the activation link in the email to complete your registration process..";
				$return['data']['user_id'] = $result['user_id'];
			} else {
				$return['data']['message'] = "Error send confirmation email, Please contact our support";
			}
		} else {
			$return['data']['error_message'] = $result['message'];
		}
		return $return;
	}

	function user_token_verify(){
		$return = array();
		$success = false;

		$data_auth = isset($_REQUEST['data_auth']) ? htmlentities($_REQUEST['data_auth']) : null;

		$roll = 12;
		$strlen_auth = strlen($data_auth);
		$mod = $strlen_auth % $roll;
		$mod_len = $strlen_auth - $mod;
		$roll_len = $mod_len / $roll;
		$roll_start = $strlen_auth - $roll_len;

		$str = array();
		for($i=1;$i<=$roll;$i++){
			$str[$i] = substr($data_auth,$roll_start,$roll_len);
			$roll_start -= $roll_len;
		}

		if($mod > 0){
			$str[$i++] = substr($data_auth,0,$mod);
		}

		$auth = "";
		foreach($str as $value){
			$auth .= $value;
		}

		$auth = base64_decode($auth);
		$data_auth = json_decode($auth,true);

		if(is_array($data_auth)){
			$user_id = 0;
			$api_token = "";
			$device_id = "";

			if(isset($data_auth['user_id'])){
				$user_id = $data_auth['user_id'];
			}
			if(isset($data_auth['api_token'])){
				$api_token = $data_auth['api_token'];
			}
			if(isset($data_auth['device_id'])){
				$device_id = $data_auth['device_id'];
			}

			$array = array();
			$array['user_id'] = $user_id;
			$array['api_token'] = $api_token;
			$array['device_id'] = $device_id;

			$this->CI->load->library('array2xml', $array);
			$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

			$sp = $this->CI->main->executeSP('sp_user_token_verify',$parameter);
			foreach($sp as $dt_sp){
				$result['valid'] = $dt_sp['valid'];
				$result['message'] = $dt_sp['message'];
				$result['user_id'] = $dt_sp['user_id'];
				$result['email'] = $dt_sp['email'];
				$result['username'] = $dt_sp['username'];
				$result['user_2fa'] = $dt_sp['user_2fa'];
				$result['send_2fa'] = $dt_sp['send_2fa'];
				$result['role_id'] = $dt_sp['role_id'];
				$result['token_id'] = $dt_sp['token_id'];
				$result['mode_template'] = $dt_sp['mode_template'];
				$result['user_plan_id'] = $dt_sp['user_plan_id'];
				$result['expired_plan'] = $dt_sp['expired_plan'];
				$result['send_2fa'] = $dt_sp['send_2fa'];
			}

			if($result['valid'] == 'true'){
				$return['data']['user_id'] = $result['user_id'];
				$return['data']['username'] = $result['username'];
				$return['data']['email'] = $result['email'];
				$return['data']['role_id'] = $result['role_id'];
				$return['data']['api_token'] = $api_token;
				$return['data']['mode_template'] = $result['mode_template'];
				$return['data']['user_plan_id'] = $result['user_plan_id'];
				$return['data']['expired_plan'] = $result['expired_plan'];

				if($result['send_2fa'] == 1){
					$return['data']['authentication'] = 'email';
				} else {
					$return['data']['authentication'] = 'google';
				}

				$return['status'] = 'success';
				$return['data']['message'] = 'Login Successful';
				$return['api_token'] = $api_token;
				$return['user_id'] = $user_id;
				$return['data']['device_id'] = $device_id;

				$auth = array();
				$auth['user_id'] = $user_id;
				$auth['api_token'] = $api_token;
				$auth['device_id'] = $device_id;

				$auth = json_encode($auth);
				$auth = base64_encode($auth);

				$roll = 12;
				$strlen_auth = strlen($auth);
				$mod = $strlen_auth % $roll;
				$mod_len = $strlen_auth - $mod;
				$roll_len = $mod_len / $roll;
				$roll_start = 0;

				$str = array();
				for($i=1;$i<=$roll;$i++){
					$str[$i] = substr($auth,$roll_start,$roll_len);
					$roll_start += $roll_len;
				}

				if($mod > 0){
					$str[$i++] = substr($auth,$roll_start,$mod);
				}

				krsort($str);
				$auth = "";
				foreach($str as $value){
					$auth .= $value;
				}

				$return['data']['auth'] = $auth;
			} else {
				$return['data']['error_message'] = $result['message'];
			}
		} else {
			$return['data']['error_message'] = "Invalid parameter";
		}

		return $return;
	}

	

	function user_forgot_password(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$username = isset($_REQUEST['username']) ? htmlentities($_REQUEST['username']) : null;
		$email = isset($_REQUEST['email']) ? htmlentities($_REQUEST['email']) : null;
		$password_code = isset($_REQUEST['password_code']) ? htmlentities($_REQUEST['password_code']) : null;
		$link = isset($_REQUEST['link']) ? htmlentities($_REQUEST['link']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['api_token'] = $api_token;
		$array['username'] = $username;
		$array['email'] = $email;
		$array['password_code'] = $password_code;
		$array['password'] = $this->CI->mainconfig->generateRandomString(8);
		$array['ip_address'] = $ip_address;
		$array['link'] = $link . '?username='. $username .'&reset_code='.$password_code;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_user_forgot_password',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == 'true'){
			if($this->CI->mainconfig->send_template_mail('forgot_password',$email,$array)){
				$return['status'] = 'success';
				$return['data']['message'] = "Reset Password confirmation has been send to <b>". $email ."</b>, please click the confirmation link in the email to complete process..";
			} else {
				$return['data']['error_message'] = "Error send email, Please contact our support";
			}
		} else {
			$return['data']['error_message'] = $result['message'];
		}

		return $return;
	}

	function user_twofactorauthentication(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$authentication_code = isset($_REQUEST['authentication_code']) ? htmlentities($_REQUEST['authentication_code']) : null;
		$secret = isset($_REQUEST['secret']) ? htmlentities($_REQUEST['secret']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$this->CI->load->library('googleauthenticator');
		$authenticator = $this->CI->googleauthenticator->verifyCode($secret, $authentication_code);
		if($authenticator){
			$array = array();
			$array['api_token'] = $api_token;
			$array['authentication_code'] = $authentication_code;
			$array['secret'] = $secret;
			$array['user_id'] = $user_id;
			$array['ip_address'] = $ip_address;

			$this->CI->load->library('array2xml', $array);
			$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

			$sp = $this->CI->main->executeSP('sp_user_twofactorauthentication',$parameter);
			foreach($sp as $dt_sp){
				$result['valid'] = $dt_sp['valid'];
				$result['message'] = $dt_sp['message'];
			}

			if($result['valid'] == 'true'){
				$return['status'] = 'success';
				$return['data']['message'] = "Success";
			} else {
				$return['data']['error_message'] = $result['message'];
			}
		} else {
			$return['data']['error_message'] = 'Invalid Code';
		}

		return $return;
	}

	

	function user_asset(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$wallet_code = isset($_REQUEST['wallet_code']) ? htmlentities($_REQUEST['wallet_code']) : false;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where['wallet_hidden'] = 0;
		$where['user_id'] = $user_id;
		if($wallet_code){
			$where['wallet_code'] = $wallet_code;
		} else {
			$where["(wallet_code like '%". $search ."%' OR wallet like '%". $search ."%') AND 1="] = 1;
		}
		$count = $this->CI->main->countData('view_asset_details',$where) * 1;


		if($count > 0) {
			$total_page = ceil($count / $limit);
			if($page == -1) {
				$page = $total_page;
			} elseif($page > $total_page){
				$page = $total_page;
			}

			$offset = ($page - 1) * $limit;
			$data = $this->CI->main->getData('view_asset_details', null, $where, null, $order, $limit, $offset);

			$start_row = $offset + 1;
			$max_row = $start_row + ($limit - 1);

			if($max_row > $count){
				$max_row = $count;
			}
		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		$return['start_row'] = $start_row;
		$return['max_row'] = $max_row;
		$return['page'] = $page;
		$return['total_page'] = $total_page;
		$return['offset'] = $offset;

		return $return;
	}

	function generate_address(){
		$return = array();

		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : 0;
		$socket_id = isset($_REQUEST['socket_id']) ? htmlentities($_REQUEST['socket_id']) : 0;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : 0;

		$array = array();
		$array['user_id'] = $user_id;
		$array['socket_id'] = $socket_id;
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array
		// print_r($parameter);
		$sp = $this->CI->main->executeSP('sp_generate_address',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
			$return['data']['message'] = "Success";
		} else {
			$return['data']['error_message'] = $result['message'];
		}

		return $return;
	}

	function generate_address_v2(){
		$return = array();

		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : 0;
		$wallet_id = isset($_REQUEST['wallet_id']) ? htmlentities($_REQUEST['wallet_id']) : 0;
		$socket_id = isset($_REQUEST['socket_id']) ? htmlentities($_REQUEST['socket_id']) : 0;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : 0;

		$array = array();
		$array['user_id'] = $user_id;
		$array['socket_id'] = $socket_id;
		$array['wallet_id'] = $wallet_id;
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array
		// print_r($parameter);
		$sp = $this->CI->main->executeSP('sp_generate_address_v2',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
			$return['data']['message'] = "Success";
		} else {
			$return['data']['error_message'] = $result['message'];
		}

		return $return;
	}

	function withdraw(){
		$return = array();

		$error = 0;
		$wallet_maintenance = 0;

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$wallet_id = isset($_REQUEST['wallet_id']) ? htmlentities($_REQUEST['wallet_id']) : null;
		$withdraw_amount = isset($_REQUEST['withdraw_amount']) ? htmlentities($_REQUEST['withdraw_amount']) : null;
		$withdraw_address = isset($_REQUEST['withdraw_address']) ? htmlentities($_REQUEST['withdraw_address']) : null;
		$withdraw_authenticator = isset($_REQUEST['withdraw_authenticator']) ? htmlentities($_REQUEST['withdraw_authenticator']) : null;
		$link = isset($_REQUEST['link']) ? htmlentities($_REQUEST['link']) : null;
		$cancel_link = isset($_REQUEST['cancel_link']) ? htmlentities($_REQUEST['cancel_link']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		$withdrawal_code = $this->CI->mainconfig->generateRandomString(32);
		$socket_id = isset($_REQUEST['socket_id']) ? htmlentities($_REQUEST['socket_id']) : 0;

		$array = array();
		$array['api_token'] = $api_token;
		$array['user_id'] = $user_id;
		$array['wallet_id'] = $wallet_id;
		$array['authentication_code'] = $withdraw_authenticator;
		$array['withdraw_amount'] = $withdraw_amount;
		$array['withdraw_address'] = $withdraw_address;
		$array['transdate'] = date('Y-m-d H:i:s');
		$array['withdrawal_code'] = $withdrawal_code;
		$array['ip_address'] = $ip_address;
		$array['socket_id'] = $socket_id;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_user_login_verify',$parameter);

		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
			$result['user_id'] = $dt_sp['user_id'];
			$result['email'] = $dt_sp['email'];
			$result['username'] = $dt_sp['username'];
			$result['user_2fa'] = $dt_sp['user_2fa'];
			$result['send_2fa'] = $dt_sp['send_2fa'];
			$result['role_id'] = $dt_sp['role_id'];

			$username = $result['username'];
			$email = $result['email'];
		}

		if($result['valid'] == 'true'){
			$return['data']['user_id'] = $result['user_id'];
			$return['data']['username'] = $result['username'];
			$return['data']['email'] = $result['email'];
			$return['data']['role_id'] = $result['role_id'];

			if($result['send_2fa'] == 0){
				$this->CI->load->library('googleauthenticator');
				$authenticator = $this->CI->googleauthenticator->verifyCode($result['user_2fa'], $withdraw_authenticator);
				if($authenticator){
					$return['data']['message'] = 'Successful';
				} else {
					$error++;
					$return['data']['error_message'] = 'Invalid Code';
				}
			} else {
				$return['data']['message'] = 'Successful';
			}
		} else {
			$error++;
			$return['data']['error_message'] = $result['message'];
		}

		if($error == 0){
			$where = array();
			$where['wallet_id'] = $wallet_id;
			$where['user_id'] = $user_id;
			$where['wallet_hidden'] = 0;
			$data = $this->CI->main->getData('view_asset_details',null,$where,null,null,1);

			if($data){
				foreach($data as $dt){
					if($dt['withdraw_actived'] == 1){
						$withdraw = $this->CI->main->executeSP('sp_withdraw',$parameter);
						foreach($withdraw as $dt_withdraw){
							$result2['valid'] = $dt_withdraw['valid'];
							$result2['message'] = $dt_withdraw['message'];
							$result2['user_id'] = $dt_withdraw['user_id'];
						}

						if($result2['valid'] == 'true'){
							$return['status'] = 'success';
							$return['data']['message'] = "Success";
						} else {
							$return['data']['error_message'] = $result2['message'];
						}
					} else {
						$return['data']['error_message'] = $dt['withdraw_note'];
					}
				}
			} else {
				$return['data']['error_message'] = "Wallet not found";
			}

		}

		return $return;
	}

	function withdraw2(){
		$return = array();

		$error = 0;
		$wallet_maintenance = 0;

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$wallet_id = isset($_REQUEST['wallet_id']) ? htmlentities($_REQUEST['wallet_id']) : null;
		$withdraw_amount = isset($_REQUEST['withdraw_amount']) ? htmlentities($_REQUEST['withdraw_amount']) : null;
		$withdraw_address = isset($_REQUEST['withdraw_address']) ? htmlentities($_REQUEST['withdraw_address']) : null;
		$withdraw_authenticator = isset($_REQUEST['withdraw_authenticator']) ? htmlentities($_REQUEST['withdraw_authenticator']) : null;
		$link = isset($_REQUEST['link']) ? htmlentities($_REQUEST['link']) : null;
		$cancel_link = isset($_REQUEST['cancel_link']) ? htmlentities($_REQUEST['cancel_link']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		$withdrawal_code = $this->CI->mainconfig->generateRandomString(32);
		$socket_id = isset($_REQUEST['socket_id']) ? htmlentities($_REQUEST['socket_id']) : 0;

		$array = array();
		$array['api_token'] = $api_token;
		$array['user_id'] = $user_id;
		$array['wallet_id'] = $wallet_id;
		$array['authentication_code'] = $withdraw_authenticator;
		$array['withdraw_amount'] = $withdraw_amount;
		$array['withdraw_address'] = $withdraw_address;
		$array['transdate'] = date('Y-m-d H:i:s');
		$array['withdrawal_code'] = $withdrawal_code;
		$array['ip_address'] = $ip_address;
		$array['socket_id'] = $socket_id;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_user_login_verify',$parameter);

		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
			$result['user_id'] = $dt_sp['user_id'];
			$result['email'] = $dt_sp['email'];
			$result['username'] = $dt_sp['username'];
			$result['user_2fa'] = $dt_sp['user_2fa'];
			$result['send_2fa'] = $dt_sp['send_2fa'];
			$result['role_id'] = $dt_sp['role_id'];

			$username = $result['username'];
			$email = $result['email'];
		}

		if($result['valid'] == 'true'){
			$return['data']['user_id'] = $result['user_id'];
			$return['data']['username'] = $result['username'];
			$return['data']['email'] = $result['email'];
			$return['data']['role_id'] = $result['role_id'];

			if($result['send_2fa'] == 0){
				$this->CI->load->library('googleauthenticator');
				$authenticator = $this->CI->googleauthenticator->verifyCode($result['user_2fa'], $withdraw_authenticator);
				if($authenticator){
					$return['data']['message'] = 'Successful';
				} else {
					$error++;
					$return['data']['error_message'] = 'Invalid Code';
				}
			} else {
				$return['data']['message'] = 'Successful';
			}
		} else {
			$error++;
			$return['data']['error_message'] = $result['message'];
		}

		if($error == 0){
			$where = array();
			$where['wallet_id'] = $wallet_id;
			$where['user_id'] = $user_id;
			$where['wallet_hidden'] = 0;
			$data = $this->CI->main->getData('view_asset_details',null,$where,null,null,1);

			if($data){
				foreach($data as $dt){
					if($dt['withdraw_actived'] == 1){
						$withdraw = $this->CI->main->executeSP('sp_withdraw',$parameter);
						foreach($withdraw as $dt_withdraw){
							$result2['valid'] = $dt_withdraw['valid'];
							$result2['message'] = $dt_withdraw['message'];
							$result2['user_id'] = $dt_withdraw['user_id'];
						}

						if($result2['valid'] == 'true'){
							$return['status'] = 'success';
							$array['link'] = $link . '?username='. $username .'&withdraw_code='.$withdrawal_code;
							$array['cancel_link'] = $cancel_link . '?username='. $username .'&withdraw_code='.$withdrawal_code;

							$this->CI->mainconfig->send_template_mail('withdrawal_confirmation',$email,$array);


							$message = "An email has been sent to <b>". $email ."</b>, please click the confirm link in the email to complete your withdraw process<br><br>";

							$return['data']['message'] = $message;

						} else {
							$return['data']['error_message'] = $result2['message'];
						}
					} else {
						$return['data']['error_message'] = $dt['withdraw_note'];
					}
				}
			} else {
				$return['data']['error_message'] = "Wallet not found";
			}

		}

		return $return;
	}

	function withdraw_email_code(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : 0;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['api_token'] = $api_token;
		$array['user_id'] = $user_id;
		$array['app_code'] = $this->CI->mainconfig->generateRandomNumber(6);
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_withdraw_email_code',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
			$result['user_id'] = $dt_sp['user_id'];
			$result['username'] = $dt_sp['username'];
			$result['email'] = $dt_sp['email'];
			$result['user_code'] = $dt_sp['user_code'];
		}
		// print_r($parameter);
		// print_r($sp);
		if($result['valid'] == 'true'){
			$return['status'] = 'success';
			$return['data']['message'] = $result['message'];

			$array = array();
			$array['username'] = $result['username'];
			$array['user_code'] = $result['user_code'];
			$array['email'] = $result['email'];
			$array['ip_address'] = $ip_address;

			if($this->CI->mainconfig->send_template_mail('request_withdrawal_email_code',$result['email'],$array)){

				$return['data']['message'] = "An email has been sent to <b>". $result['email'] ."</b>";
				$return['data']['user_id'] = $result['user_id'];
			} else {
				$return['data']['message'] = "Error send confirmation email, Please contact our support";
			}
		} else {
			$return['data']['error_message'] = $result['message'];
		}
		return $return;
	}

	function check_address(){
		$return = array();
		$wallet_maintenance = 0;

		// $api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		// $wallet_code = isset($_REQUEST['wallet_code']) ? htmlentities($_REQUEST['wallet_code']) : null;
		// $address = isset($_REQUEST['address']) ? htmlentities($_REQUEST['address']) : null;
		// $user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		// $ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		// $where = array();
		// $where['wallet_code'] = $wallet_code;
		// $where['user_id'] = $user_id;
		// $where['hidden'] = 0;
		// $data = $this->CI->main->getData('view_asset_details',null,$where,null,null,1);

		// if($data){
			// foreach($data as $dt){
				// if($dt['actived'] == 1){

					// $this->CI->load->library('walletapi',$dt);
					// $this->CI->walletapi->initialize($dt);

					// $array = array();
					// $array['address'] = $address;
					// $validate_address = $this->CI->walletapi->validate_address($array);

					// if(isset($validate_address->status)){
						// if($validate_address->status == 'success'){
							// if($validate_address->data->isvalid){
								// $return['status'] = 'success';
							// } else {
								// $return['data']['error_message'] = $validate_address->data->error_message;
							// }
						// } else {
							// switch($validate_address->data->error_message){
								// default:
									// $wallet_maintenance = 1;
								// break;
							// }
						// }
					// } else {
						// $wallet_maintenance = 1;
					// }

					// if($wallet_maintenance == 1){
						// $note = "We are in maintenance At the moment. Please come back later.";

						// $where = array();
						// $where['wallet_code'] = $wallet_code;

						// $data = array();
						// $data['status_id'] = 2;
						// $data['deposit_status_id'] = 2;
						// $data['withdraw_status_id'] = 2;
						// $data['note'] = $note;
						// $data['deposit_note'] = $note;
						// $data['withdraw_note'] = $note;

						// $this->CI->main->update('dt_wallet',$data,$where);

						// $return['data']['error_message'] = $note;
						// $return['data']['status'] = "Maintenance";
					// }
				// } else {
					// $return['data']['error_message'] = $dt['note'];
				// }
			// }
			// $return['rows'] = $dt;
		// } else {
			// $return['data']['error_message'] = "Wallet not found";
		// }

		// $return['wallet_maintenance'] = $wallet_maintenance;
		$return['status'] = 'success';
		return $return;
	}

	function withdraw_confirmation(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		$username = isset($_REQUEST['username']) ? htmlentities($_REQUEST['username']) : null;
		$withdraw_code = isset($_REQUEST['withdraw_code']) ? htmlentities($_REQUEST['withdraw_code']) : null;

		$array = array();
		$array['api_token'] = $api_token;
		$array['ip_address'] = $ip_address;
		$array['username'] = $username;
		$array['withdraw_code'] = $withdraw_code;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_withdraw_confirmation',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
		} else {
			$return['data']['error_message'] = $result['message'];
		}
		return $return;
	}

	function withdraw_cancel(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		$username = isset($_REQUEST['username']) ? htmlentities($_REQUEST['username']) : null;
		$withdraw_code = isset($_REQUEST['withdraw_code']) ? htmlentities($_REQUEST['withdraw_code']) : null;

		$array = array();
		$array['api_token'] = $api_token;
		$array['ip_address'] = $ip_address;
		$array['username'] = $username;
		$array['withdraw_code'] = $withdraw_code;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_withdraw_cancel',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
		} else {
			$return['data']['error_message'] = $result['message'];
		}
		return $return;
	}

	function history_account(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where['user_id'] = $user_id;

		$count = $this->CI->main->countData('view_history_account',$where) * 1;

		if($count > 0) {
			$total_page = ceil($count / $limit);
			if($page == -1) {
				$page = $total_page;
			} elseif($page > $total_page){
				$page = $total_page;
			}

			$offset = ($page - 1) * $limit;
			$data = $this->CI->main->getData('view_history_account', null, $where, null, $order, $limit, $offset);

			$start_row = $offset + 1;
			$max_row = $start_row + ($limit - 1);

			if($max_row > $count){
				$max_row = $count;
			}
		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		$return['start_row'] = $start_row;
		$return['max_row'] = $max_row;
		$return['page'] = $page;
		$return['total_page'] = $total_page;
		$return['offset'] = $offset;

		return $return;
	}
	
	function history_deposit(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where['user_id'] = $user_id;

		$count = $this->CI->main->countData('view_history_deposit',$where) * 1;

		if($count > 0) {
			$total_page = ceil($count / $limit);
			if($page == -1) {
				$page = $total_page;
			} elseif($page > $total_page){
				$page = $total_page;
			}

			$offset = ($page - 1) * $limit;
			$data = $this->CI->main->getData('view_history_deposit', null, $where, null, $order, $limit, $offset);

			$start_row = $offset + 1;
			$max_row = $start_row + ($limit - 1);

			if($max_row > $count){
				$max_row = $count;
			}
		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		$return['start_row'] = $start_row;
		$return['max_row'] = $max_row;
		$return['page'] = $page;
		$return['total_page'] = $total_page;
		$return['offset'] = $offset;

		return $return;
	}

	function history_withdraw(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where['user_id'] = $user_id;

		$count = $this->CI->main->countData('view_history_withdraw',$where) * 1;

		if($count > 0) {
			$total_page = ceil($count / $limit);
			if($page == -1) {
				$page = $total_page;
			} elseif($page > $total_page){
				$page = $total_page;
			}

			$offset = ($page - 1) * $limit;
			$data = $this->CI->main->getData('view_history_withdraw', null, $where, null, $order, $limit, $offset);

			$start_row = $offset + 1;
			$max_row = $start_row + ($limit - 1);

			if($max_row > $count){
				$max_row = $count;
			}
		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		$return['start_row'] = $start_row;
		$return['max_row'] = $max_row;
		$return['page'] = $page;
		$return['total_page'] = $total_page;
		$return['offset'] = $offset;

		return $return;
	}

	function history_reward(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where['user_id'] = $user_id;

		$count = $this->CI->main->countData('view_history_reward',$where) * 1;

		if($count > 0) {
			$total_page = ceil($count / $limit);
			if($page == -1) {
				$page = $total_page;
			} elseif($page > $total_page){
				$page = $total_page;
			}

			$offset = ($page - 1) * $limit;
			$data = $this->CI->main->getData('view_history_reward', null, $where, null, $order, $limit, $offset);

			$start_row = $offset + 1;
			$max_row = $start_row + ($limit - 1);

			if($max_row > $count){
				$max_row = $count;
			}
		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		$return['start_row'] = $start_row;
		$return['max_row'] = $max_row;
		$return['page'] = $page;
		$return['total_page'] = $total_page;
		$return['offset'] = $offset;

		return $return;
	}

	function history_referral(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where['user_id'] = $user_id;

		$count = $this->CI->main->countData('view_history_referral',$where) * 1;

		if($count > 0) {
			$total_page = ceil($count / $limit);
			if($page == -1) {
				$page = $total_page;
			} elseif($page > $total_page){
				$page = $total_page;
			}

			$offset = ($page - 1) * $limit;
			$data = $this->CI->main->getData('view_history_referral', null, $where, null, $order, $limit, $offset);

			$start_row = $offset + 1;
			$max_row = $start_row + ($limit - 1);

			if($max_row > $count){
				$max_row = $count;
			}
		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		$return['start_row'] = $start_row;
		$return['max_row'] = $max_row;
		$return['page'] = $page;
		$return['total_page'] = $total_page;
		$return['offset'] = $offset;

		return $return;
	}

	function referral(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where['upline_id'] = $user_id;

		$count = $this->CI->main->countData('view_referral',$where) * 1;

		if($count > 0) {
			$total_page = ceil($count / $limit);
			if($page == -1) {
				$page = $total_page;
			} elseif($page > $total_page){
				$page = $total_page;
			}

			$offset = ($page - 1) * $limit;
			$data = $this->CI->main->getData('view_referral', null, $where, null, $order, $limit, $offset);

			$start_row = $offset + 1;
			$max_row = $start_row + ($limit - 1);

			if($max_row > $count){
				$max_row = $count;
			}
		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		$return['start_row'] = $start_row;
		$return['max_row'] = $max_row;
		$return['page'] = $page;
		$return['total_page'] = $total_page;
		$return['offset'] = $offset;

		return $return;
	}

	function vote(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$order = 'vote_free_count desc';
		$where = array();
		$data = $this->CI->main->getData('view_vote', null,null,null,$order);

		$return['status'] = 'success';
		$return['data'] = $data;

		return $return;
	}

	function vote_user(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where['vote_user_id'] = $user_id;

		$data = $this->CI->main->getData('view_vote_user', null,$where);

		$return['status'] = 'success';
		$return['data'] = $data;

		return $return;
	}

	function vote_submit(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : 0;
		$vote_detail_id = isset($_REQUEST['vote_detail_id']) ? htmlentities($_REQUEST['vote_detail_id']) : 0;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['api_token'] = $api_token;
		$array['user_id'] = $user_id;
		$array['vote_detail_id'] = $vote_detail_id;
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_vote',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
			$return['data']['message'] = $message;

		} else {
			$return['data']['error_message'] = $result['message'];
		}

		return $return;
	}

	function asset(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$wallet_code = isset($_REQUEST['wallet_code']) ? htmlentities($_REQUEST['wallet_code']) : false;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where['hidden'] = 0;
		if($wallet_code){
			$where['wallet_code'] = $wallet_code;
		} else {
			$where["(wallet_code like '%". $search ."%' OR wallet like '%". $search ."%') AND 1="] = 1;
		}
		$count = $this->CI->main->countData('view_assets',$where) * 1;

		if($count > 0) {
			$total_page = ceil($count / $limit);
			if($page == -1) {
				$page = $total_page;
			} elseif($page > $total_page){
				$page = $total_page;
			}

			$offset = ($page - 1) * $limit;
			$data = $this->CI->main->getData('view_assets', null, $where, null, $order, $limit, $offset);

			$start_row = $offset + 1;
			$max_row = $start_row + ($limit - 1);

			if($max_row > $count){
				$max_row = $count;
			}
		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		$return['start_row'] = $start_row;
		$return['max_row'] = $max_row;
		$return['page'] = $page;
		$return['total_page'] = $total_page;
		$return['offset'] = $offset;

		return $return;
	}

	function withdraw_resend_confirmation(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : 0;
		$withdraw_id = isset($_REQUEST['withdraw_id']) ? htmlentities($_REQUEST['withdraw_id']) : 0;
		$withdrawal_code = isset($_REQUEST['withdrawal_code']) ? htmlentities($_REQUEST['withdrawal_code']) : 0;
		$link = isset($_REQUEST['link']) ? htmlentities($_REQUEST['link']) : null;
		$cancel_link = isset($_REQUEST['cancel_link']) ? htmlentities($_REQUEST['cancel_link']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['api_token'] = $api_token;
		$array['user_id'] = $user_id;
		$array['withdraw_id'] = $withdraw_id;
		$array['withdrawal_code'] = $withdrawal_code;
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_withdraw_resend_confirmation',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
			$result['user_id'] = $dt_sp['user_id'];
			$result['username'] = $dt_sp['username'];
			$result['email'] = $dt_sp['email'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
			$array['link'] = $link . '?username='. $result['username'] .'&withdraw_code='.$withdrawal_code;
			$array['cancel_link'] = $cancel_link . '?username='. $result['username'] .'&withdraw_code='.$withdrawal_code;

			$this->CI->mainconfig->send_template_mail('withdrawal_confirmation',$result['email'],$array);

			$message = "An email has been sent to <b>". $result['email'] ."</b>, please click the confirm link in the email to complete your withdraw process<br><br>";

			$return['data']['message'] = $message;

		} else {
			$return['data']['error_message'] = $result['message'];
		}

		return $return;
	}


	function market(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		$market_link = isset($_REQUEST['market_link']) ? htmlentities($_REQUEST['market_link']) : false;

		$where = array();
		if($market_link){
			$where['market_link'] = $market_link;
		}

		$count = $this->CI->main->countData('view_market',$where) * 1;

		if($count > 0) {
			$total_page = ceil($count / $limit);
			if($page == -1) {
				$page = $total_page;
			} elseif($page > $total_page){
				$page = $total_page;
			}

			$offset = ($page - 1) * $limit;
			$data = $this->CI->main->getData('view_market', null, $where, null, $order, $limit, $offset);

			$start_row = $offset + 1;
			$max_row = $start_row + ($limit - 1);

			if($max_row > $count){
				$max_row = $count;
			}
		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		$return['start_row'] = $start_row;
		$return['max_row'] = $max_row;
		$return['page'] = $page;
		$return['total_page'] = $total_page;
		$return['offset'] = $offset;

		return $return;
	}

	function market_order(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$market_id = isset($_REQUEST['market_id']) ? htmlentities($_REQUEST['market_id']) : null;
		$order_type_id = isset($_REQUEST['order_type_id']) ? htmlentities($_REQUEST['order_type_id']) : null;
		$price = isset($_REQUEST['price']) ? htmlentities($_REQUEST['price']) : null;
		$quantity = isset($_REQUEST['quantity']) ? htmlentities($_REQUEST['quantity']) : null;
		$amount = isset($_REQUEST['amount']) ? htmlentities($_REQUEST['amount']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$order_date = date('Y-m-d H:i:s');

		$array = array();
		$array['api_token'] = $api_token;
		$array['user_id'] = $user_id;
		$array['market_id'] = $market_id;
		$array['order_type_id'] = $order_type_id;
		$array['price'] = $price;
		$array['quantity'] = $quantity;
		$array['amount'] = $amount;
		$array['order_date'] = $order_date;
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_exchange_trade',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
			$result['user_id'] = $dt_sp['user_id'];
			$result['order_id'] = $dt_sp['order_id'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
			$return['message'] = $result['message'];
			$return['order_id'] = $result['order_id'];
		} else {
			$return['data']['error_message'] = $result['message'];
		}

		return $return;
	}

	function market_order_cancel(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$order_id = isset($_REQUEST['order_id']) ? htmlentities($_REQUEST['order_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['api_token'] = $api_token;
		$array['user_id'] = $user_id;
		$array['order_id'] = $order_id;
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_exchange_trade_cancel',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
			$result['user_id'] = $dt_sp['user_id'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
			$return['message'] = $result['message'];
		} else {
			$return['data']['error_message'] = $result['message'];
		}

		return $return;
	}

	function market_order_book(){
		$return = array();
		$result = array();
		$return['status'] = "error";
		$return['data'] = array();

		$market_id = isset($_REQUEST['market_id']) ? htmlentities($_REQUEST['market_id']) : 0;

		$where = array();
		$where['market_id'] = $market_id;
		$where['order_type_id'] = 1;

		$order = "price desc";

		$rows = array();
		$data = $this->CI->main->getData('view_market_order_book', null, $where, null, $order);
		if($data){
			foreach($data as $dt){
				$row = array();
				$row[] = $this->CI->mainconfig->get_decimal_format($dt['price']);
				$row[] = $this->CI->mainconfig->get_decimal_format($dt['quantity']);
				$row[] = $this->CI->mainconfig->get_decimal_format($dt['amount']);

				$rows[] = $row;
			}
			$return['data']['buy'] = $rows;
		}

		$where['order_type_id'] = 2;

		$order = "price asc";

		$rows = array();
		$data = $this->CI->main->getData('view_market_order_book', null, $where, null, $order);
		if($data){
			foreach($data as $dt){
				$row = array();
				$row[] = $this->CI->mainconfig->get_decimal_format($dt['price']);
				$row[] = $this->CI->mainconfig->get_decimal_format($dt['quantity']);
				$row[] = $this->CI->mainconfig->get_decimal_format($dt['amount']);

				$rows[] = $row;
			}
			$return['data']['sell'] = $rows;
		}
		$return['status'] = 'success';
		return $return;
	}

	function history_order(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where['user_id'] = $user_id;

		$count = $this->CI->main->countData('view_market_user_order_book',$where) * 1;

		if($count > 0) {
			$total_page = ceil($count / $limit);
			if($page == -1) {
				$page = $total_page;
			} elseif($page > $total_page){
				$page = $total_page;
			}

			$offset = ($page - 1) * $limit;
			$data = $this->CI->main->getData('view_market_user_order_book', null, $where, null, $order, $limit, $offset);

			$start_row = $offset + 1;
			$max_row = $start_row + ($limit - 1);

			if($max_row > $count){
				$max_row = $count;
			}
		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		$return['start_row'] = $start_row;
		$return['max_row'] = $max_row;
		$return['page'] = $page;
		$return['total_page'] = $total_page;
		$return['offset'] = $offset;

		return $return;
	}

	function history_trade(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where['user_id'] = $user_id;

		$count = $this->CI->main->countData('view_market_user_order_history',$where) * 1;

		if($count > 0) {
			$total_page = ceil($count / $limit);
			if($page == -1) {
				$page = $total_page;
			} elseif($page > $total_page){
				$page = $total_page;
			}

			$offset = ($page - 1) * $limit;
			$data = $this->CI->main->getData('view_market_user_order_history', null, $where, null, $order, $limit, $offset);

			$start_row = $offset + 1;
			$max_row = $start_row + ($limit - 1);

			if($max_row > $count){
				$max_row = $count;
			}
		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		$return['start_row'] = $start_row;
		$return['max_row'] = $max_row;
		$return['page'] = $page;
		$return['total_page'] = $total_page;
		$return['offset'] = $offset;

		return $return;
	}

	function wallet(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		$wallet_code = isset($_REQUEST['wallet_code']) ? htmlentities($_REQUEST['wallet_code']) : false;

		$where = array();
		if($wallet_code){
			$where['wallet_code'] = $wallet_code;
		}

		$count = $this->CI->main->countData('view_wallet_data',$where) * 1;

		if($count > 0) {
			$total_page = ceil($count / $limit);
			if($page == -1) {
				$page = $total_page;
			} elseif($page > $total_page){
				$page = $total_page;
			}

			$offset = ($page - 1) * $limit;
			$data = $this->CI->main->getData('view_wallet_data', null, $where, null, $order, $limit, $offset);

			$start_row = $offset + 1;
			$max_row = $start_row + ($limit - 1);

			if($max_row > $count){
				$max_row = $count;
			}
		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		$return['start_row'] = $start_row;
		$return['max_row'] = $max_row;
		$return['page'] = $page;
		$return['total_page'] = $total_page;
		$return['offset'] = $offset;

		return $return;
	}

	function wallet_data(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$offset = isset($_REQUEST['offset']) ? htmlentities($_REQUEST['offset']) : null;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;

		$wallet_code = isset($_REQUEST['wallet_code']) ? htmlentities($_REQUEST['wallet_code']) : false;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : false;
		$search_param = isset($_REQUEST['search_param']) ? htmlentities($_REQUEST['search_param']) : false;

		$where = array();
		if($wallet_code){
			$where['wallet_code'] = $wallet_code;
		}

		if($user_id){
			$where['user_id'] = $user_id;
		}

		if($search_param){
			$where["(label like '%". $search_param ."%' or address like '%". $search_param ."%') And 1 ="] = 1;
		}

		$count = $this->CI->main->countData('view_wallet_data_detail',$where) * 1;
		$data = $this->CI->main->getData('view_wallet_data_detail', null, $where, null, $order, $limit, $offset);

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;

		return $return;
	}

	function transaction_data(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$offset = isset($_REQUEST['offset']) ? htmlentities($_REQUEST['offset']) : null;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;

		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : false;
		$search_param = isset($_REQUEST['search_param']) ? htmlentities($_REQUEST['search_param']) : false;

		$where = array();

		if($user_id){
			$where['user_id'] = $user_id;
		}

		// if($search_param){
			// $where["(label like '%". $search_param ."%' or address like '%". $search_param ."%') And 1 ="] = 1;
		// }

		$count = $this->CI->main->countData('view_wallet_transaction',$where) * 1;
		$data = $this->CI->main->getData('view_wallet_transaction', null, $where, null, $order, $limit, $offset);

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;

		return $return;
	}

	function api_data(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$offset = isset($_REQUEST['offset']) ? htmlentities($_REQUEST['offset']) : null;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;

		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : false;
		$search_param = isset($_REQUEST['search_param']) ? htmlentities($_REQUEST['search_param']) : false;

		$where = array();

		if($user_id){
			$where['user_id'] = $user_id;
		}

		// if($search_param){
			// $where["(label like '%". $search_param ."%' or address like '%". $search_param ."%') And 1 ="] = 1;
		// }

		$count = $this->CI->main->countData('view_user_api',$where) * 1;
		$data = $this->CI->main->getData('view_user_api', null, $where, null, $order, $limit, $offset);

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;

		return $return;
	}

	function generate_api(){
		$return = array();

		$user_api_key_name = isset($_REQUEST['user_api_key_name']) ? htmlentities($_REQUEST['user_api_key_name']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$user_api_key = $this->CI->mainconfig->generateRandomString(54,true);
		$user_api_secret = $this->CI->mainconfig->generateRandomString(54,true);

		$array = array();
		$array['user_api_key_name'] = $user_api_key_name;
		$array['user_id'] = $user_id;
		$array['ip_address'] = $ip_address;
		$array['user_api_key'] = $user_api_key;
		$array['user_api_secret'] = $user_api_secret;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_generate_api',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
		} else {
			$return['data']['error_message'] = $result['message'];
		}
		return $return;
	}

	function delete_api(){
		$return = array();

		$user_api_id = isset($_REQUEST['user_api_id']) ? htmlentities($_REQUEST['user_api_id']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['user_api_id'] = $user_api_id;
		$array['user_id'] = $user_id;
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_delete_api',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
		} else {
			$return['data']['error_message'] = $result['message'];
		}
		return $return;
	}

	function sendto_address(){
		$return = array();

		$test = 0;
		$test2 = 0;
		$error = 0;
		$error_msg = "";

		$total_byte = 0;
		$network_fee = 0;
		$default_network_fee = 0.0002;
		$basic_byte = 12;
		$input_byte = 180;
		$output_byte = 34;
		$network_fee_byte = 0.00000200;

		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$socket_id = isset($_REQUEST['socket_id']) ? htmlentities($_REQUEST['socket_id']) : null;
		$wallet_code = isset($_REQUEST['wallet_code']) ? htmlentities($_REQUEST['wallet_code']) : null;
		$amounts = isset($_REQUEST['amounts']) ? htmlentities($_REQUEST['amounts']) : null;
		$to_addresses = isset($_REQUEST['to_addresses']) ? htmlentities($_REQUEST['to_addresses']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		$command = "rawtransaction";

		$where = array();
		$where['wallet_code'] = $wallet_code;
		$data = $this->CI->main->getData('view_wallet_data', null, $where);
		if($data){
			foreach($data as $dt){
				$wallet_id = $dt['wallet_id'];
				$default_network_fee = $dt['transaction_fee'];
			}
		} else {
			$error++;
			$error_msg = "Wallet not found";
		}

		$count_addresses = 0;
		$count_amounts = 0;
		$to_address_list = array();

		if($amounts){
			$amounts = explode(',',$amounts);

			$count_amounts = count($amounts);

			foreach($amounts as $dt_amounts){
				if(!is_numeric($dt_amounts)) {
					$error += 1;
					$error_msg = "Amount ". $dt_amounts ." Must numeric ";
					break;
				}
			}

			if($error == 0){
				if($to_addresses){
					$to_addresses = explode(',',$to_addresses);
					$count_addresses = count($to_addresses);

					$output_count = $count_addresses;

					if($count_amounts == $count_addresses){
						foreach($to_addresses as $dt_to_addresses){
							if(!in_array($dt_to_addresses, $to_address_list)){
								$to_address_list[] = $dt_to_addresses;
							} else {
								$error++;
								$error_msg = "The number of amounts specified must match the number of unique destination addresses specified";
								break;
							}
						}

						if($error == 0){
							$data_transaction = array();
							$send_amount = 0;
							$data = 0;
							while($data < $count_amounts){
								$amount = $amounts[$data];
								$send_amount += $amount;
								$to_address = $to_addresses[$data];
								$data_transaction[] = array('amount' => $amount, 'to_address' => $to_address);

								$data++;
							}

							$list_address = array();

							$where = array();
							$where['user_id'] = $user_id;
							$where['wallet_code'] = $wallet_code;
							$where['status_id'] = 0;

							$data_unspent = array();
							$data = $this->CI->main->getData('view_wallet_unspent', null, $where);
							if($data){
								$back_address = '';
								$total_amount = 0;

								$raw = array();
								$sender = array();
								$receiver = array();
								$rawtransaction = array();

								$total_byte += ($output_count * $output_byte);
								$network_fee += ($total_byte * $network_fee_byte);

								if($default_network_fee > 0){
									$send_amount += $default_network_fee;
								} else {
									$send_amount += $network_fee;
								}


								foreach($data as $dt_unspent){
									$data_unspent[] = $dt_unspent['wallet_unspent_id'];
									$total_byte += $input_byte;
									$network_fee += ($input_byte * $network_fee_byte);
									if($default_network_fee > 0){

									} else {
										$send_amount += $input_byte * $network_fee_byte;
									}

									$total_amount += $dt_unspent['amount'];
									$data = array();
									$data['txid'] = $dt_unspent['txid'];
									$data['vout'] = intval($dt_unspent['vout']);

									$raw[] = $data;

									$data['address'] = $dt_unspent['address'];
									$data['amount'] = $dt_unspent['amount'];
									$sender[] = $data;

									$back_address = $dt_unspent['address'];

									if($total_amount >= $send_amount){
										break;
									}
								}

								$send_amount = $this->CI->mainconfig->get_decimal_format($send_amount);
								$total_amount = $this->CI->mainconfig->get_decimal_format($total_amount);

								$balance_change = array();
								if($total_amount >= $send_amount){
									foreach($data_transaction as $dt_data_transaction){
										$receiver[$dt_data_transaction['to_address']] = ($dt_data_transaction['amount'] - 0);
									}

									if($total_amount > $send_amount){
										if(isset($receiver[$back_address])){
											$receiver[$back_address] += $total_amount - $send_amount;
										} else {
											$receiver[$back_address] = $total_amount - $send_amount;
										}
									}

									$array = array();
									$array['raw'] = $raw;
									$array['receiver'] = $receiver;
									$array['wallet_unspent'] = $data_unspent;
									$array['send_amount'] = $send_amount;
									$array['test'] = $test;
									$array['test2'] = $test2;

									$parameter = json_encode($array);

									$array = array();
									$array['user_id'] = $user_id;
									$array['wallet_code'] = $wallet_code;
									$array['socket_id'] = $socket_id;
									$array['command'] = $command;
									$array['parameter'] = $parameter;
									$array['ip_address'] = $ip_address;
									$array['wallet_unspent'] = array();
									foreach($data_unspent as $key=>$value){
										$array['wallet_unspent'][$key] = array('wallet_unspent_id' => $value);
									}

									$this->CI->load->library('array2xml', $array);
									$sp_parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array
									// print_r($parameter);
									$sp = $this->CI->main->executeSP('sp_withdraw',$sp_parameter);

									foreach($sp as $dt_sp){
										$result['valid'] = $dt_sp['valid'];
										$result['message'] = $dt_sp['message'];
									}

									if($result['valid'] == 'true'){
										$return['status'] = "success";
									} else {
										$error++;
										$error_msg = $result['message'];
									}
								} else {
									$error++;
									$error_msg = "The amount exceeds your balance.";
								}


							} else {
								$error++;
								$error_msg = "The amount exceeds your balance.";
							}
						}
					} else {
						$error++;
						if($count_amounts > $count_addresses){
							$error_msg = "You specified ". $count_amounts ." amounts, but ". $count_addresses ." unique destination addresses. The number of amounts specified must match the number of unique destination addresses specified.";
						} else {
							$error_msg = "You specified ". $count_addresses ." unique destination addresses, but ". $count_amounts ." amounts. The number of unique destination addresses specified must match the number of amounts specified.";
						}
					}
				} else {
					$error++;
					$error_msg = "Must provide exactly ". $count_amounts ." destination(s).";
				}
			}
		} else {
			$error++;
			$error_msg = "Must specify the amount(s) to send to withdrawal destination(s).";
		}


		if($error == 0){
			$return['status'] = "success";
		} else {
			$return['data']['error_message'] = $error_msg;
		}

		return $return;
	}

	function sendfrom_address(){
		$return = array();

		$error = 0;
		$error_msg = "";

		$total_byte = 0;
		$network_fee = 0;
		$default_network_fee = 0.0002;
		$basic_byte = 12;
		$input_byte = 180;
		$output_byte = 34;
		$network_fee_byte = 0.00000200;

		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$from = isset($_REQUEST['from']) ? htmlentities($_REQUEST['from']) : null;
		$socket_id = isset($_REQUEST['socket_id']) ? htmlentities($_REQUEST['socket_id']) : null;
		$wallet_code = isset($_REQUEST['wallet_code']) ? htmlentities($_REQUEST['wallet_code']) : null;
		$amounts = isset($_REQUEST['amounts']) ? htmlentities($_REQUEST['amounts']) : null;
		$to_addresses = isset($_REQUEST['to_addresses']) ? htmlentities($_REQUEST['to_addresses']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		$command = "rawtransaction";

		$where = array();
		$where['wallet_code'] = $wallet_code;
		$data = $this->CI->main->getData('view_wallet_data', null, $where);
		if($data){
			foreach($data as $dt){
				$wallet_id = $dt['wallet_id'];
				$default_network_fee = $dt['transaction_fee'];
			}
		} else {
			$error++;
			$error_msg = "Wallet not found";
		}

		$count_addresses = 0;
		$count_amounts = 0;
		$to_address_list = array();

		if($amounts){
			$amounts = explode(',',$amounts);

			$count_amounts = count($amounts);

			foreach($amounts as $dt_amounts){
				if(!is_numeric($dt_amounts)) {
					$error += 1;
					$error_msg = "Amount ". $dt_amounts ." Must numeric ";
					break;
				}
			}

			if($error == 0){
				if($to_addresses){
					$to_addresses = explode(',',$to_addresses);
					$count_addresses = count($to_addresses);

					$output_count = $count_addresses;

					if($count_amounts == $count_addresses){
						foreach($to_addresses as $dt_to_addresses){
							if(!in_array($dt_to_addresses, $to_address_list)){
								$to_address_list[] = $dt_to_addresses;
							} else {
								$error++;
								$error_msg = "The number of amounts specified must match the number of unique destination addresses specified";
								break;
							}
						}

						if($error == 0){
							$data_transaction = array();
							$send_amount = 0;
							$data = 0;
							while($data < $count_amounts){
								$amount = $amounts[$data];
								$send_amount += $amount;
								$to_address = $to_addresses[$data];
								$data_transaction[] = array('amount' => $amount, 'to_address' => $to_address);

								$data++;
							}

							$list_address = array();

							$where = array();
							$where['user_id'] = $user_id;
							$where['wallet_code'] = $wallet_code;
							$where['status_id'] = 0;
							$where['address'] = $from;

							$data_unspent = array();
							$data = $this->CI->main->getData('view_wallet_unspent', null, $where);
							if($data){
								$back_address = '';
								$total_amount = 0;

								$raw = array();
								$sender = array();
								$receiver = array();
								$rawtransaction = array();

								$total_byte += ($output_count * $output_byte);
								$network_fee += ($total_byte * $network_fee_byte);
								if($default_network_fee > 0){
									$send_amount += $default_network_fee;
								} else {
									$send_amount += $network_fee;
								}


								foreach($data as $dt_unspent){
									$data_unspent[] = $dt_unspent['wallet_unspent_id'];
									$total_byte += $input_byte;
									$network_fee += ($input_byte * $network_fee_byte);
									if($default_network_fee > 0){

									} else {
										$send_amount += $input_byte * $network_fee_byte;
									}

									$total_amount += $dt_unspent['amount'];
									$data = array();
									$data['txid'] = $dt_unspent['txid'];
									$data['vout'] = intval($dt_unspent['vout']);

									$raw[] = $data;

									$data['address'] = $dt_unspent['address'];
									$data['amount'] = $dt_unspent['amount'];
									$sender[] = $data;

									$back_address = $dt_unspent['address'];

									if($total_amount >= $send_amount){
										break;
									}
								}

								$balance_change = array();
								if($total_amount >= $send_amount){
									foreach($data_transaction as $dt_data_transaction){
										$receiver[$dt_data_transaction['to_address']] = ($dt_data_transaction['amount'] - 0);
									}

									if($total_amount > $send_amount){
										if(isset($receiver[$back_address])){
											$receiver[$back_address] += $total_amount - $send_amount;
										} else {
											$receiver[$back_address] = $total_amount - $send_amount;
										}
									}

									$array = array();
									$array['raw'] = $raw;
									$array['receiver'] = $receiver;
									$array['wallet_unspent'] = $data_unspent;

									$parameter = json_encode($array);

									$array = array();
									$array['user_id'] = $user_id;
									$array['wallet_code'] = $wallet_code;
									$array['socket_id'] = $socket_id;
									$array['command'] = $command;
									$array['parameter'] = $parameter;
									$array['ip_address'] = $ip_address;
									$array['wallet_unspent'] = array();
									foreach($data_unspent as $key=>$value){
										$array['wallet_unspent'][$key] = array('wallet_unspent_id' => $value);
									}

									$this->CI->load->library('array2xml', $array);
									$sp_parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array
									// print_r($parameter);
									$sp = $this->CI->main->executeSP('sp_withdraw',$sp_parameter);

									foreach($sp as $dt_sp){
										$result['valid'] = $dt_sp['valid'];
										$result['message'] = $dt_sp['message'];
									}

									if($result['valid'] == 'true'){
										$return['status'] = "success";
									} else {
										$error++;
										$error_msg = $result['message'];
									}
								} else {
									$error++;
									$error_msg = "The amount exceeds your balance.";
								}


							} else {
								$error++;
								$error_msg = "The amount exceeds your balance.";
							}
						}
					} else {
						$error++;
						if($count_amounts > $count_addresses){
							$error_msg = "You specified ". $count_amounts ." amounts, but ". $count_addresses ." unique destination addresses. The number of amounts specified must match the number of unique destination addresses specified.";
						} else {
							$error_msg = "You specified ". $count_addresses ." unique destination addresses, but ". $count_amounts ." amounts. The number of unique destination addresses specified must match the number of amounts specified.";
						}
					}
				} else {
					$error++;
					$error_msg = "Must provide exactly ". $count_amounts ." destination(s).";
				}
			}
		} else {
			$error++;
			$error_msg = "Must specify the amount(s) to send to withdrawal destination(s).";
		}


		if($error == 0){
			$return['status'] = "success";
		} else {
			$return['data']['error_message'] = $error_msg;
		}

		return $return;
	}

	function coins(){
		$return = array();

		$where = array();
		$data = $this->CI->main->getData('view_wallet');

		$return['status'] = 'success';
		$return['data'] = $data;

		return $return;
	}

	function coin_lists(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$wallet_code = isset($_REQUEST['wallet_code']) ? htmlentities($_REQUEST['wallet_code']) : false;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where['wallet_hidden'] = 0;
		if($wallet_code){
			$where['wallet_code'] = $wallet_code;
		} else {
			$where["(wallet_code like '%". $search ."%' OR wallet_name like '%". $search ."%') AND 1="] = 1;
		}
		$count = $this->CI->main->countData('view_wallet',$where) * 1;


		if($count > 0) {
			$total_page = ceil($count / $limit);
			if($page == -1) {
				$page = $total_page;
			} elseif($page > $total_page){
				$page = $total_page;
			}

			$offset = ($page - 1) * $limit;
			$data = $this->CI->main->getData('view_wallet', null, $where, null, $order, $limit, $offset);

			$start_row = $offset + 1;
			$max_row = $start_row + ($limit - 1);

			if($max_row > $count){
				$max_row = $count;
			}
		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		$return['start_row'] = $start_row;
		$return['max_row'] = $max_row;
		$return['page'] = $page;
		$return['total_page'] = $total_page;
		$return['offset'] = $offset;

		return $return;
	}

	function deploy_mn(){
		$return = array();
		$error = 0;
		$error_msg = "";

		$wallet_code = isset($_REQUEST['wallet_code']) ? htmlentities($_REQUEST['wallet_code']) : null;
		$collateral = isset($_REQUEST['collateral']) ? htmlentities($_REQUEST['collateral']) : null;
		$txid = isset($_REQUEST['txid']) ? htmlentities($_REQUEST['txid']) : null;
		$masternode_address = isset($_REQUEST['masternode_address']) ? htmlentities($_REQUEST['masternode_address']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['wallet_code'] = $wallet_code;
		$array['collateral'] = $collateral;
		$array['txid'] = $txid;
		$array['masternode_address'] = $masternode_address;
		$array['user_id'] = $user_id;
		$array['date_start'] = date('Y-m-d');

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_deploy_mn',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
			$result['url_api'] = $dt_sp['url_api'];
			$result['wallet_code'] = $dt_sp['wallet_code'];
			$result['masternode_id'] = $dt_sp['masternode_id'];
		}

		if($result['valid'] == 'true'){
			$error = 0;
			// $return['status'] = 'success';
			$masternode_id = $result['masternode_id'];
			$url_api = $result['url_api'];
			$command = 'check_masternode_outputs';

			$args = array();
			$args['wallet_code'] = $wallet_code;
			$args['txid'] = $txid;
			$args['masternode_address'] = $masternode_address;
			$args['collateral'] = $collateral;

			$check_masternode_outputs = $this->CI->masternodeapi->call_request($url_api,$command,$args);
			if(isset($check_masternode_outputs->status)){
				if($check_masternode_outputs->status == 'success'){
					$vout = $check_masternode_outputs->data->vout;
					$command = 'deploy_mn';
					$args = array();
					$args['wallet_code'] = $wallet_code;

					$deploy = $this->CI->masternodeapi->call_request($url_api,$command,$args);

					if(isset($deploy->status)){
						if($deploy->status == 'success'){
							$return['status'] = "success";
							$label = $deploy->data->label;
							$genkey = $deploy->data->genkey;
							$masternode_ip_address = $deploy->data->ip_address;
							$port = $deploy->data->port;

							$return['data']['label'] = $label;
							$return['data']['genkey'] = $genkey;

							$array = array();
							$array['masternode_id'] = $masternode_id;
							$array['label'] = $label;
							$array['genkey'] = $genkey;
							$array['masternode_ip_address'] = $masternode_ip_address;
							$array['port'] = $port;
							$array['vout'] = $vout;

							$this->CI->load->library('array2xml', $array);
							$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

							$sp = $this->CI->main->executeSP('sp_deploy_mn_success',$parameter);
						} else {
							$error++;
							$return['data']['error_message'] = $deploy->data->error_message;

						}
					} else {
						$error++;
						$return['data']['error_message'] = "Internal Server Error, Please contact our support";
					}
				} else {
					$error++;
					$return['data']['error_message'] = $check_masternode_outputs->data->error_message;
				}
			} else {
				$error++;
				$return['data']['error_message'] = "Unknown reason";
			}

			if($error != 0){
				$array = array();
				$array['masternode_id'] = $masternode_id;

				$this->CI->load->library('array2xml', $array);
				$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

				$sp = $this->CI->main->executeSP('sp_deploy_mn_failed',$parameter);
			}
		} else {
			$return['data']['error_message'] = $result['message'];
		}

		return $return;
	}

	function masternode_data(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$offset = isset($_REQUEST['offset']) ? htmlentities($_REQUEST['offset']) : null;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;

		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : false;
		$search_param = isset($_REQUEST['search_param']) ? htmlentities($_REQUEST['search_param']) : false;

		$where = array();

		if($user_id){
			$where['user_id'] = $user_id;
		}

		if($search_param){
			$where["(label like '%". $search_param ."%' or wallet_name like '%". $search_param ."%' or wallet_code like '%". $search_param ."%') And 1 ="] = 1;
		}

		$count = $this->CI->main->countData('view_masternode',$where) * 1;
		$data = $this->CI->main->getData('view_masternode', null, $where, null, $order, $limit, $offset);

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;

		return $return;
	}

	function masternode_detail(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();
		$label = isset($_REQUEST['label']) ? htmlentities($_REQUEST['label']) : null;
		$genkey = isset($_REQUEST['genkey']) ? htmlentities($_REQUEST['genkey']) : null;

		$where = array();
		$where['user_id'] = $user_id;
		$where['label'] = $label;
		$where['genkey'] = $genkey;

		$data = $this->CI->main->getData('view_masternode', null, $where,null,null,1);
		if($data){
			$return['status'] = 'success';
			$return['data'] = $data;
		} else {
			$return['data']['error_message'] = "Masternode not found";
		}

		return $return;
	}

	function update_masternode_status(){
		$return = array();

		$label = isset($_REQUEST['label']) ? htmlentities($_REQUEST['label']) : null;
		$genkey = isset($_REQUEST['genkey']) ? htmlentities($_REQUEST['genkey']) : null;
		$masternode_ip_address = isset($_REQUEST['masternode_ip_address']) ? htmlentities($_REQUEST['masternode_ip_address']) : null;
		$masternode_status = isset($_REQUEST['masternode_status']) ? htmlentities($_REQUEST['masternode_status']) : null;
		$blockchain_status = isset($_REQUEST['blockchain_status']) ? htmlentities($_REQUEST['blockchain_status']) : null;

		$where = array();
		$where['label'] = $label;
		$where['genkey'] = $genkey;
		$where['ip_address'] = $masternode_ip_address;

		$update = array();
		$update['masternode_status'] = $masternode_status;
		$update['blockchain_status'] = $blockchain_status;

		$this->CI->main->update('dt_masternode', $update, $where);


		return $return;
	}

	function destroy_mn(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$masternode_id = isset($_REQUEST['masternode_id']) ? htmlentities($_REQUEST['masternode_id']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['api_token'] = $api_token;
		$array['user_id'] = $user_id;
		$array['masternode_id'] = $masternode_id;
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_destroy_mn',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
			$result['wallet_code'] = $dt_sp['wallet_code'];
			$result['label'] = $dt_sp['label'];
			$result['url_api'] = $dt_sp['url_api'];
		}

		if($result['valid'] == 'true'){
			$wallet_code = $result['wallet_code'];
			$label = $result['label'];
			$url_api = $result['url_api'];

			$return['status'] = 'success';
			$return['data']['message'] = 'success';
			$command = 'delete_mn';

			$args = array();
			$args['wallet_code'] = $wallet_code;
			$args['label'] = $label;

			$stop = $this->CI->masternodeapi->call_request($url_api,$command,$args);


		} else {
			$return['data']['error_message'] = $result['message'];
		}
		return $return;
	}
	
	function user_pool(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$wallet_code = isset($_REQUEST['wallet_code']) ? htmlentities($_REQUEST['wallet_code']) : false;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where['pool_hidden'] = 0;
		if($wallet_code){
			$where['wallet_code'] = $wallet_code;
		} else {
			$where["(wallet_code like '%". $search ."%' OR wallet like '%". $search ."%') AND 1="] = 1;
		}
		$count = $this->CI->main->countData('view_pools',$where) * 1;


		if($count > 0) {
			$total_page = ceil($count / $limit);
			if($page == -1) {
				$page = $total_page;
			} elseif($page > $total_page){
				$page = $total_page;
			}

			$offset = ($page - 1) * $limit;
			$data = $this->CI->main->getData('view_pools', null, $where, null, $order, $limit, $offset);

			$start_row = $offset + 1;
			$max_row = $start_row + ($limit - 1);

			if($max_row > $count){
				$max_row = $count;
			}
		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		$return['start_row'] = $start_row;
		$return['max_row'] = $max_row;
		$return['page'] = $page;
		$return['total_page'] = $total_page;
		$return['offset'] = $offset;

		return $return;
	}
	
	function pool_reward(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$wallet_code = isset($_REQUEST['wallet_code']) ? htmlentities($_REQUEST['wallet_code']) : '';
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where['wallet_code'] = $wallet_code;

		$count = $this->CI->main->countData('view_pool_reward',$where) * 1;

		if($count > 0) {
			$total_page = ceil($count / $limit);
			if($page == -1) {
				$page = $total_page;
			} elseif($page > $total_page){
				$page = $total_page;
			}

			$offset = ($page - 1) * $limit;
			$data = $this->CI->main->getData('view_pool_reward', null, $where, null, $order, $limit, $offset);

			$start_row = $offset + 1;
			$max_row = $start_row + ($limit - 1);

			if($max_row > $count){
				$max_row = $count;
			}
		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		$return['start_row'] = $start_row;
		$return['max_row'] = $max_row;
		$return['page'] = $page;
		$return['total_page'] = $total_page;
		$return['offset'] = $offset;

		return $return;
	}
	
	function my_pool_reward(){
		$return = array();

		$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
		$limit = isset($_REQUEST['limit']) ? htmlentities($_REQUEST['limit']) : null;
		$search = isset($_REQUEST['search']) ? htmlentities($_REQUEST['search']) : null;
		$page = isset($_REQUEST['page']) ? htmlentities($_REQUEST['page']) : 1;
		$order = isset($_REQUEST['order']) ? htmlentities($_REQUEST['order']) : null;
		$wallet_code = isset($_REQUEST['wallet_code']) ? htmlentities($_REQUEST['wallet_code']) : '';
		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : '';
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$where = array();
		$where['wallet_code'] = $wallet_code;
		$where['user_id'] = $user_id;

		$count = $this->CI->main->countData('view_history_reward',$where) * 1;

		if($count > 0) {
			$total_page = ceil($count / $limit);
			if($page == -1) {
				$page = $total_page;
			} elseif($page > $total_page){
				$page = $total_page;
			}

			$offset = ($page - 1) * $limit;
			$data = $this->CI->main->getData('view_history_reward', null, $where, null, $order, $limit, $offset);

			$start_row = $offset + 1;
			$max_row = $start_row + ($limit - 1);

			if($max_row > $count){
				$max_row = $count;
			}
		} else {
			$total_page = 1;
			$data = false;
			$start_row = 0;
			$max_row = 0;
			$offset = 0;
		}

		$return['status'] = 'success';
		$return['data'] = $data;
		$return['count'] = $count;
		$return['start_row'] = $start_row;
		$return['max_row'] = $max_row;
		$return['page'] = $page;
		$return['total_page'] = $total_page;
		$return['offset'] = $offset;

		return $return;
	}
	
	function pool_deposit(){
		$return = array();

		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$wallet_code = isset($_REQUEST['wallet_code']) ? htmlentities($_REQUEST['wallet_code']) : null;
		$deposit_amount = isset($_REQUEST['deposit_amount']) ? htmlentities($_REQUEST['deposit_amount']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['user_id'] = $user_id;
		$array['wallet_code'] = $wallet_code;
		$array['deposit_amount'] = $deposit_amount;
		$array['transdate'] = date('Y-m-d H:i:s');
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_pool_deposit',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
		} else {
			$return['data']['error_message'] = $result['message'];
		}
		return $return;
	}
	
	function pool_withdraw(){
		$return = array();

		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$wallet_code = isset($_REQUEST['wallet_code']) ? htmlentities($_REQUEST['wallet_code']) : null;
		$withdraw_amount = isset($_REQUEST['withdraw_amount']) ? htmlentities($_REQUEST['withdraw_amount']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['user_id'] = $user_id;
		$array['wallet_code'] = $wallet_code;
		$array['withdraw_amount'] = $withdraw_amount;
		$array['transdate'] = date('Y-m-d H:i:s');
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_pool_withdraw',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
		} else {
			$return['data']['error_message'] = $result['message'];
		}
		return $return;
	}

	function pool_reinvest(){
		$return = array();

		$user_id = isset($_REQUEST['user_id']) ? htmlentities($_REQUEST['user_id']) : null;
		$wallet_code = isset($_REQUEST['wallet_code']) ? htmlentities($_REQUEST['wallet_code']) : null;
		$reinvest = isset($_REQUEST['reinvest']) ? htmlentities($_REQUEST['reinvest']) : null;
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->CI->mainconfig->get_client_ip();

		$array = array();
		$array['user_id'] = $user_id;
		$array['wallet_code'] = $wallet_code;
		$array['reinvest'] = $reinvest;
		$array['transdate'] = date('Y-m-d H:i:s');
		$array['ip_address'] = $ip_address;

		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array

		$sp = $this->CI->main->executeSP('sp_pool_reinvest',$parameter);
		foreach($sp as $dt_sp){
			$result['valid'] = $dt_sp['valid'];
			$result['message'] = $dt_sp['message'];
		}

		if($result['valid'] == 'true'){
			$return['status'] = 'success';
		} else {
			$return['data']['error_message'] = $result['message'];
		}
		return $return;
	}

}
?>
