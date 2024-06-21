<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mainconfig {
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->model('main');	
	}
	
	function generateRandomString($length = 10, $token = false) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		
		if($token){
			$where = array();
			$where['api_token'] = $randomString;
			$check_label = $this->CI->main->countData('dt_api_token',$where);
			if($check_label > 0){
				$this->generateRandomString($length);
			} else {
				return $randomString;
			}
		} else {
			return $randomString;
		}
	}
	
	function get_rate($from,$to){
		$return = false;
		
		$data_rate = array();
		
		$where = array();
		$data_currencies = $this->CI->main->getData('dt_currencies',null,$where);
		if($data_currencies){
			foreach($data_currencies as $dt_currencies){
				$data_rate[$dt_currencies['currency_code']] = $dt_currencies['rate'];
			}
		}
		
		if(isset($data_rate[$from])){
			if(isset($data_rate[$to])){
				$from_rate = $data_rate[$from];
				$to_rate = $data_rate[$to];
				
				$rate = $to_rate / $from_rate;
				$return = $this->get_decimal_format($rate);
			}
		}
		
		return $return;
	}
	
	function webconfig($parameter = null){
		
		$data = array();
		$config = $this->CI->main->getData('view_config');
		if($config){
			foreach($config as $dt_config){
				$data[$dt_config['param']] = array('value'=>$dt_config['value'], 'default'=>$dt_config['default']);
			}
		}
		
		if(isset($data[$parameter]['value'])){
			if(strlen(trim($data[$parameter]['value'])) > 0){
				$value = $data[$parameter]['value'];
			} else {
				$value = $data[$parameter]['default'];
			}
		} else {
			$value = false;
		}
		
		return $value;
	}
	
	function config($parameter = null){
		
		$data = array();
		$config = $this->CI->main->getData('view_config');
		if($config){
			foreach($config as $dt_config){
				$data[$dt_config['param']] = array('value'=>$dt_config['value'], 'default'=>$dt_config['default']);
			}
		}
		
		if(isset($data[$parameter]['value'])){
			if(strlen(trim($data[$parameter]['value'])) > 0){
				$value = $data[$parameter]['value'];
			} else {
				$value = $data[$parameter]['default'];
			}
		} else {
			$value = 'undefined';
		}
		
		return $value;
	}	
	
	function generate_label($api_username, $api_key){
		$label = $this->createSecret(12);
		$where = array();
		$where['username'] = $api_username;
		$where['key'] = $api_key;
		$where['label'] = $label;
		$check_label = $this->CI->main->countData('view_user_address',$where);
		if($check_label > 0){
			$this->generate_label($api_username, $api_key);
		} else {
			return $label;
		}
	}
	
	function createSecret($secretLength = 16) {
        $validChars = $this->_getBase32LookupTable();
        unset($validChars[32]);
        $secret = '';
        for ($i = 0; $i < $secretLength; $i++) {
            $secret .= $validChars[array_rand($validChars)];
        }
        return $secret;
    }
	
	protected function _getBase32LookupTable() {
        return array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', //  7
            'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', // 15
            'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', // 23
            'Y', 'Z', '2', '3', '4', '5', '6', '7', // 31
            '='  // padding char
        );
    }
	
	function check_label($api_username, $api_key, $label){
		$where = array();
		$where['username'] = $api_username;
		$where['key'] = $api_key;
		$where['label'] = $label;
		$check_label = $this->CI->main->countData('view_user_address',$where);
		
		return $check_label;
	}
	
	function get_squence_address($api_username, $api_key){
		$where = array();
		$where['username'] = $api_username;
		$where['key'] = $api_key;
		$order = 'squence desc';
		$limit = 1;
		$address = $this->CI->main->getData('view_user_address',null,$where,null,$order,$limit);
		if($address){
			foreach($address as $dt_address){
				return $dt_address['squence'] + 1;
			}
		} else {
			return 0;
		}
	}
	
	function idinfo($id,$parameter = null){
		
		$data = array();
		$config = $this->CI->main->getData('view_users',$id);
		if($config){
			foreach($config as $k=>$v){
				$data = $v;
			}
		}
		
		if(isset($data[$parameter])){
			return $data[$parameter];
		} else {
			return null;
		}	
	
	}	
	
	function apiinfo($walletid,$userid,$parameter = null){
		
		$data = array();
		$where = array();
		$where['userid'] = $userid;
		$where['walletid'] = $walletid;
		$config = $this->CI->main->getData('view_user_api',null,$where);
		if($config){
			foreach($config as $k=>$v){
				$data = $v;
			}
		}
		
		if(isset($data[$parameter])){
			return $data[$parameter];
		} else {
			return null;
		}	
	
	}
	
	function getNextTransNo($type){
		
		$number = 1;
		
		$table = 'dt_systype';
		$this->CI->db->query("update dt_systype Set typeno = typeno + 1 Where id = '", $type ,"'");
		$systype = $this->CI->main->getData($table,$type);
		if($systype){
			foreach($systype as $dt_systype){
				$number = $dt_systype['typeno'];
			}
		}
		
		return $number;
	}
	
	function getUser($userid = 0) {
		return $this->CI->main->getData('view_users',$userid);
	}
	
	function send_template_mail($template = '', $email = '',$array = array()){
		
		$config = array();
		$config['smtp_host'] = $this->webconfig('smtp_host');
		$config['smtp_port'] = $this->webconfig('smtp_port');
		$config['smtp_user'] = $this->webconfig('smtp_user');
		$config['smtp_pass'] = $this->webconfig('smtp_pass');
		$config['smtp_secure'] = $this->webconfig('smtp_secure');
		$config['smtp_alias'] = $this->webconfig('smtp_alias');
		
		$this->CI->load->library('sendmail',$config);
		
		$where = array();
		$where['param'] = $template;
		
		$email_template = $this->CI->main->getData('dt_mail_template',null,$where,null,null,1);
		if($email_template){
			foreach($email_template as $dt_email_template){
				$message= '';
				$message.= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1,0 Strict//EN" "http://www,w3,org/TR/xhtml1/DTD/xhtml1-strict,dtd">';
				$message.= '<html xmlns="http://www,w3,org/1999/xhtml" xml:lang="en" lang="en">';
				$message.= '<meta content="text/html; charset=utf-8" http-equiv="Content-type">';
				$message.= '<head>';
				$message.= "<title>". html_entity_decode($dt_email_template['title'] , ENT_QUOTES) ."</title>"; 
				$message.= '</head>';
				$message.= '<body>';
				$message_body = html_entity_decode($dt_email_template['message'] , ENT_QUOTES);
				foreach($array as $key => $value){
					$message_body = str_replace("%".$key."%",$value,$message_body);
				}
				$message.= $message_body;
				$message.= '</body></html>';
				
				$subject = html_entity_decode($dt_email_template['title'] , ENT_QUOTES);
				
				$send_email = array();
				$send_email[] = array('email'=>$email, 'name'=>"User");
				$send = $this->CI->sendmail->send($subject,$message,$send_email);		
				
				return $send;
			}
		} else {
			return false;
		}
	}
	
	function send_template_mail2($template = '', $email = '',$array = array()){
		
		$config = array();
		$config['smtp_host'] = $this->webconfig('smtp_host');
		$config['smtp_port'] = $this->webconfig('smtp_port');
		$config['smtp_user'] = $this->webconfig('smtp_user');
		$config['smtp_pass'] = $this->webconfig('smtp_pass');
		$config['smtp_secure'] = $this->webconfig('smtp_secure');
		$config['smtp_alias'] = $this->webconfig('smtp_alias');
		
		$this->CI->load->library('sendmail',$config);
		
		$where = array();
		$where['param'] = $template;
		
		$email_template = $this->CI->main->getData('dt_mail_template',null,$where,null,null,1);
		if($email_template){
			foreach($email_template as $dt_email_template){
				
				$title = html_entity_decode($dt_email_template['title'] , ENT_QUOTES);
				
				$array['title'] = $title;
				
				$message = html_entity_decode($dt_email_template['message'] , ENT_QUOTES);
				foreach($array as $key => $value){
					$message = str_replace("%".$key."%",$value,$message);
				}
				
				// $message= '';
				// $message.= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1,0 Strict//EN" "http://www,w3,org/TR/xhtml1/DTD/xhtml1-strict,dtd">';
				// $message.= '<html xmlns="http://www,w3,org/1999/xhtml" xml:lang="en" lang="en">';
				// $message.= '<meta content="text/html; charset=utf-8" http-equiv="Content-type">';
				// $message.= '<head>';
				// $message.= "<title>". html_entity_decode($dt_email_template['title'] , ENT_QUOTES) ."</title>"; 
				// $message.= '</head>';
				// $message.= '<body>';
				// $message_body = html_entity_decode($dt_email_template['message'] , ENT_QUOTES);
				// foreach($array as $key => $value){
					// $message_body = str_replace("%".$key."%",$value,$message_body);
				// }
				// $message.= $message_body;
				// $message.= '</body></html>';
				
				$subject = html_entity_decode($dt_email_template['title'] , ENT_QUOTES);
				
				$send_email = array();
				$send_email[] = array('email'=>$email, 'name'=>"User");
				$send = $this->CI->sendmail->send($subject,$message,$send_email);		
				
				return $send;
			}
		} else {
			return false;
		}
	}
	
	function get_decimal_format($value,$max_decimal = 8){
		$return = 0;
		$value = floor(($value * (pow(10,$max_decimal)))) / (pow(10,$max_decimal));
		$get_decimal = explode('.',$value);
		
		if(isset($get_decimal[1])){
			$get_decimal_digit = rtrim(number_format($value,$max_decimal),0);
			$get_decimal2 = explode('.',$get_decimal_digit);
			
			$decimal_digit = strlen($get_decimal2[1]);
			
			if($decimal_digit > $max_decimal){
				$return = number_format($value,$max_decimal,'.','');
			} else {
				$return = number_format($value,$decimal_digit,'.','');
			}			
		} else {
			$return = $value;
		}
		
		return $return;
	}
	
	function configinfo($id,$parameter = null){
		
		$data = array();
		$config = $this->CI->main->getData('view_config',$id);
		if($config){
			foreach($config as $k=>$v){
				$data = $v;
			}
		}
		
		if(isset($data[$parameter])){
			return $data[$parameter];
		} else {
			return null;
		}	
	
	}	
	
	function coinpayment_convert_coin($currencycode="BTC"){
		$return = 1;
		
		$where = array();
		$where['currencycode'] = $currencycode;
		
		$rates = $this->CI->main->getData('dt_currencies',null,$where);
		if($rates){
			foreach($rates as $dt_rate){
				$return = $dt_rate['rate'];
			}
		}	

		return $return;
	}
	
	function coinpayments_api_call($cmd, $req = array()) {
		 // Fill these in from your API Keys page 
		$public_key = $this->webconfig('coinpayment_public'); 
		$private_key = $this->webconfig('coinpayment_private'); 
		
		$req['version'] = 1; 
		$req['cmd'] = $cmd; 
		$req['key'] = $public_key; 
		$req['format'] = 'json'; //supported values are json and xml 
		
		 // Generate the query string 
		$post_data = http_build_query($req, '', '&'); 
		 
		// Calculate the HMAC signature on the POST data 
		$hmac = hash_hmac('sha512', $post_data, $private_key); 
		 
		// Create cURL handle and initialize (if needed) 
		static $ch = NULL; 
		if ($ch === NULL) { 
			$ch = curl_init('https://www,coinpayments,net/api,php'); 
			curl_setopt($ch, CURLOPT_FAILONERROR, TRUE); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
		} 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ',$hmac)); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data); 
		 
		// Execute the call and close cURL handle      
		$data = curl_exec($ch);                 
		// Parse and return data if successful, 
		if ($data !== FALSE) { 
			if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5,4,0') >= 0) { 
				// We are on 32-bit PHP, so use the bigint as string option, If you are using any API calls with Satoshis it is highly NOT recommended to use 32-bit PHP 
				$dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING); 
			} else { 
				$dec = json_decode($data, TRUE); 
			} 
			if ($dec !== NULL && count($dec)) { 
				return $dec; 
			} else { 
				// If you are using PHP 5,5,0 or higher you can use json_last_error_msg() for a better error message 
				return array('error' => 'Unable to parse JSON result (',json_last_error(),')'); 
			} 
		} else { 
			return array('error' => 'cURL error: ',curl_error($ch)); 
		} 
	}	
	
	function action_log($action, $param, $result, $user_id = 0){
		$this->CI->load->model('main');
		
		$ip_address = isset($_REQUEST['ip_address']) ? htmlentities($_REQUEST['ip_address']) : $this->get_client_ip();
		
		$array['action'] = $action;
		$array['parameter'] = urlencode(json_encode($param));
		$array['result'] = urlencode(json_encode($result));
		$array['ip_address'] = $ip_address;
		$array['datetime'] = date('Y-m-d H:i:s');
		$array['user_id'] = $user_id;
		
		$this->CI->load->library('array2xml', $array);
		$parameter['parameter'] = $this->CI->array2xml->generateXML($array); //this way you are passing array
		$edit_menu = $this->CI->main->executeSP('sp_action_log',$parameter);
		
	}
	
	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	
	function generateRandomNumber($length = 6) {
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function user_asset_detail($user_id = false, $wallet_id = false){
		$value = false;
		if($user_id){
			if($wallet_id){
				$where = array();
				$where['user_id'] = $user_id;
				$where['wallet_id'] = $wallet_id;
				$value = $this->CI->main->getData('view_asset_details',null,$where);
			}
		}
		
		return $value;
	}
}
?>