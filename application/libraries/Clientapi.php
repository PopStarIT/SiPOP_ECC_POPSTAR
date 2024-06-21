<?php

class Clientapi {
    public $api_url;
    public $api_username;
    public $api_key;
    public $api_version;
    public $pin = "";
    private $encryption_key = "";
    private $version;
    private $withdrawal_methods;
    private $sweep_methods;
    public function __construct($array=array()) { // the constructor
		$this->CI =& get_instance();
		$config = $this->CI->config->config;
		
		$array['api_url'] = $config['api_url'];
		$array['api_username'] = $config['api_username'];
		$array['api_key'] = $config['api_key'];
		empty($array) OR $this->initialize($array, FALSE);
    }
	
	public function initialize(array $config = array(), $reset = TRUE) {
		$reflection = new ReflectionClass($this);

		if ($reset === TRUE)
		{
			$defaults = $reflection->getDefaultProperties();
			foreach (array_keys($defaults) as $key)
			{
				if ($key[0] === '_')
				{
					continue;
				}

				if (isset($config[$key]))
				{
					if ($reflection->hasMethod('set_'.$key))
					{
						$this->{'set_'.$key}($config[$key]);
					}
					else
					{
						$this->$key = $config[$key];
					}
				}
				else
				{
					$this->$key = $defaults[$key];
				}
			}
		}
		else
		{
			foreach ($config as $key => &$value)
			{
				if ($key[0] !== '_' && $reflection->hasProperty($key))
				{
					if ($reflection->hasMethod('set_'.$key))
					{
						$this->{'set_'.$key}($value);
					}
					else
					{
						$this->$key = $value;
					}
				}
			}
		}
		
		$this->withdrawal_methods = array("xx");
		$this->sweep_methods = array("sweep_from_address");
		
		return $this;
	}
	
    public function __call($name, array $args) { // method_missing for PHP
		$response = "";
	
		if (empty($args)) { $args = array(); }
		else { $args = $args[0]; }
			
		$response = $this->_request($name, $args);
		
		return $response;
    }
    
    private function _request($path, $args = array(), $method = 'POST') {
        // Generate cURL URL
		$this->CI =& get_instance();
		$this->CI->load->library('mainconfig');	
		
		$ip_address = $this->CI->mainconfig->get_client_ip();
		
		if($path == 'authentication'){
			$url =  str_replace("API_CALL",$path,$this->api_url . "API_CALL") . "/?ip_address=". $ip_address ."&api_key=" . $this->api_key . "&username=" . $this->api_username;
		} else {
			$url =  str_replace("API_CALL",$path,$this->api_url . "API_CALL") . "/?ip_address=". $ip_address ."&api_token=" . $this->CI->session->userdata('api_token');
		}
		$addedData = "";
		foreach ($args as $pkey => $pval) {
			if (strlen($addedData) > 0) { $addedData .= '&'; }
			$addedData .= $pkey . "=" . urlencode($pval);
		}
		// Initiate cURL and set headers/options
		$ch  = curl_init();
	
		// it's a GET method
		if ($method == 'GET') { 
			$url .= '&' . $addedData; 
		}
		
		// curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2); // enforce use of TLSv1.2
		curl_setopt($ch, CURLOPT_URL, $url);
		if ($method == 'POST') { // this was a POST method
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $addedData);
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Execute the cURL request
		$result = curl_exec($ch);
		curl_close($ch);
		// print_r($url);
		$json_result = json_decode($result);
		
		return $result ? $json_result : false;        
    }   
}

?>