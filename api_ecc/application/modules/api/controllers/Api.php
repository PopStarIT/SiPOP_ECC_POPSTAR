<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


Class Api extends CI_Controller { 

	function __construct(){ 
		parent::__construct(); 
		$this->load->library('mainconfig');
		ini_set("pcre.backtrack_limit", "1000000000");
		ini_set("pcre.recursion_limit", "1000000000");
	} 
		
	function index($request = null){ 
		$this->load->library('bricksapi');
		
		$request_time = time();
		$return = array();
		$result = array();
		$return['status'] = "error"; 
		$return['data'] = array(); 
		
		if($request == 'authentication'){
			$result = $this->bricksapi->authentication();
		} else {
			$api_list = array();
			$api_list[] = 'app_config';
			$api_list[] = 'get_year_budget';
			$api_list[] = 'get_period';
			$api_list[] = 'get_period_by_date';
			$api_list[] = 'user_info';
			$api_list[] = 'gl_account_section';
			$api_list[] = 'gl_account_group';
			$api_list[] = 'gl_account';
			$api_list[] = 'project';
			$api_list[] = 'gl_tag';
			$api_list[] = 'bank';
			$api_list[] = 'gl_trans';
			$api_list[] = 'gl_period';
			$api_list[] = 'gl_account_detail';
			
			// $api_list[] = 'user_authentication';
			// $api_list[] = 'user_authentication_v2';
			// $api_list[] = 'check_username';
			// $api_list[] = 'check_email';
			// $api_list[] = 'user_register';
			// $api_list[] = 'user_register_confirmation';
			
			// $api_list[] = 'user_register_confirmation_resend';
			// $api_list[] = 'user_login_verify';
			// $api_list[] = 'user_token_verify';
			// $api_list[] = 'user_forgot_password';
			// $api_list[] = 'user_forgot_password_confirmation';
			// $api_list[] = 'user_twofactorauthentication';
			
			
			// $api_list[] = 'user_asset';
			// $api_list[] = 'generate_address';
			// $api_list[] = 'withdraw_email_code';
			// $api_list[] = 'check_address';
			// $api_list[] = 'withdraw';
			// $api_list[] = 'withdraw_confirmation';
			// $api_list[] = 'withdraw_cancel';
			// $api_list[] = 'history_account';
			// $api_list[] = 'history_deposit';
			// $api_list[] = 'history_reward';
			// $api_list[] = 'history_withdraw';
			// $api_list[] = 'history_referral';
			// $api_list[] = 'history_order';
			// $api_list[] = 'history_trade';
			// $api_list[] = 'referral';
			// $api_list[] = 'vote';
			// $api_list[] = 'vote_user';
			// $api_list[] = 'asset';
			// $api_list[] = 'withdraw_resend_confirmation';
			// $api_list[] = 'market';
			// $api_list[] = 'market_order';
			// $api_list[] = 'market_order_book';
			// $api_list[] = 'market_order_cancel';
			// $api_list[] = 'verify_ip';
			// $api_list[] = 'wallet';
			// $api_list[] = 'wallet_data';
			// $api_list[] = 'sendto_address';
			// $api_list[] = 'sendfrom_address';
			// $api_list[] = 'transaction_data';
			// $api_list[] = 'api_data';
			// $api_list[] = 'generate_api';
			// $api_list[] = 'delete_api';
			// $api_list[] = 'deploy_mn';
			// $api_list[] = 'coins';
			// $api_list[] = 'masternode_data';
			// $api_list[] = 'masternode_detail';
			// $api_list[] = 'generate_address_v2';
			// $api_list[] = 'exchange_payment';
			// $api_list[] = 'coin_lists';
			// $api_list[] = 'destroy_mn';
			// $api_list[] = 'user_pool';
			// $api_list[] = 'pool_reward';
			// $api_list[] = 'pool_deposit';
			// $api_list[] = 'pool_withdraw';
			// $api_list[] = 'pool_reinvest';
			// $api_list[] = 'my_pool_reward';
			
			if(in_array($request,$api_list)){
				$api_token = isset($_REQUEST['api_token']) ? htmlentities($_REQUEST['api_token']) : null;
				$authentication = $this->bricksapi->authentication_token($api_token);
				if($authentication){
					$result = $this->bricksapi->$request();	
				} else {
					$return['data']['error_message'] = 'Invalid Token';
				}				
				
			} else {
				$return['data']['error_message'] = 'Invalid API call. Check number of parameters and endpoint, and then try again';
			}
		}
		
		$return = array_merge($return,$result);
		
		// $this->mainconfig->action_log($request, $_REQUEST, $return);
		
		if($return['status'] == 'error'){
			header("HTTP/1.0 404 ERROR");
		} elseif($return['status'] == 'limit'){
			header("HTTP/1.1 429 Too Many Requests only allow ". $limit_request ." requests per second");
		}
		
		$this->session->sess_destroy();		
		header('Content-Type: application/json');
		echo json_encode($return,JSON_PRETTY_PRINT);
	}
	
	function test(){
		$return = array();
		$return['status'] = 'success';
		
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$start = $time;
		
		$datetime = strtotime(date('Y-m-d'));
		$date = date('Y-m-d');
		
		$where = array();
		$data_wallet = $this->main->getData('view_wallet',null,$where);
		if($data_wallet){
			foreach($data_wallet as $dt_wallet){
				$wallet_id = $dt_wallet['wallet_id'];
				
				$param = array();
				$param['wallet_id'] = $wallet_id;
				$param['date'] = $date;
				
				$this->load->library('array2xml', $param);
				$sp_parameter['parameter'] = $this->array2xml->generateXML($param); //this way you are passing array

				$sp = $this->main->executeSP('sp_pool_daily',$sp_parameter);
				
			}
		}
			
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$finish = $time;
		$total_time = round(($finish - $start), 4);
		$return['time'] = $total_time;	
		
		$this->session->sess_destroy();		
		echo json_encode($return,JSON_PRETTY_PRINT);
		header('Content-Type: application/json');
	}
}

?>