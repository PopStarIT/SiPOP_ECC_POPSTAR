<?php 
// if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * ws service class
 *
 * Authentication library for Code Igniter.
 *
 * @author		Adi tio Priambodo
 * @type 		ECC
 * @version		1.0.0 
 * @license		MIT License Copyright (c) 2008 Adi tio Priambodo 
 */ 
class Rpc_service_portal{   
	var $session_id 		= '';
	var $groupSearchKe		= 0;
	var $group				= null;
	var $sp				= '';
	var $my_rpc;
	var $XML;
	var $CI;   
	var $url;    
 	var $key	 			= "PalapaTcoTidCyb3rC3ycl3V2012XVIP";  // 32 * 8 = 256 bit key 
	var $iv 				= "741952uiexyt66#c"; // 32 * 8 = 256 bit iv 
	var $method 			= 'aes-256-cbc';
	var $DB='CC';
	var $my_soap;
	 
	public function __construct($params = array()) {
		$this->CI =& get_instance(); 
		$newdata = array('last_activity'  => $this->_get_time2());
		$this->CI->session->set_userdata($newdata);
	}
	 
	function _get_time2()
	{
		$now = time();
		$time = mktime(gmdate("H", $now), gmdate("i", $now), gmdate("s", $now), gmdate("m", $now), gmdate("d", $now), gmdate("Y", $now));
	 	return $time;
	}
	
	public function setSP($params)
	{
		$mode='1';
		$mode_db='1';
		$debug='0';
		//print_r($params);
		//var_dump($params) ;die();
		if (!is_array($params)){ 
			$this->sp=$params;
 		}else{ 
			if (array_key_exists('sp', $params)){
				$this->sp=$params['sp'];
			}else{
				$this->sp='UN_SET_STOREPROCEDURE';
			}   
			if (array_key_exists('mode_db', $params)){
				$mode_db=$params['mode_db'];
			} 
			if (array_key_exists('debug', $params)){
				$debug=$params['debug'];
			} 
			if (array_key_exists('mode', $params)){
				$mode=$params['mode'];
			} 
	}
		
		// $this->CI->load->library('Session');
		// if ($this->CI->session->userdata('axData')){
				// $session_data 	=$this->CI->session->userdata('axData');
				// $this->session_id= $session_data['rID'];
		// }else{
	  	     // $this->session_id='';
		// } 
		
		// $this->XML 				= new DOMDocument( "1.0", "ISO-8859-15" );
		$timeout = 0;
		
		$config = $this->CI->config->config;
		$PORTAL_PORT = $config['PORTAL_PORT'];
		ini_set('default_socket_timeout', $timeout==0?-1:$timeout); 
        // print_r($config['PORTAL_PORT']);
		$this->XML 				= new DOMDocument( "1.0" );
	//   	$wsdlUrl = 'http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl';
    //     $arr= array('trace' => 1,
	//									"exceptions" => true,                                                  
	//									'features' => SOAP_SINGLE_ELEMENT_ARRAYS + SOAP_USE_XSI_ARRAY_TYPE ,
	//									'cache_wsdl'=> WSDL_CACHE_NONE,
	//									'style'    => SOAP_DOCUMENT,
	//									'use'      => SOAP_LITERAL,
	//									'connection_timeout' =>$timeout
	//								);
    //    // print_r($arr);
	
      $this->my_soap = new SoapClient( "http://localhost:". $PORTAL_PORT ."/ecc/http?wsdl" , array('trace' => 1,
										"exceptions" => true,                                                  
										'features' => SOAP_SINGLE_ELEMENT_ARRAYS + SOAP_USE_XSI_ARRAY_TYPE ,
										'cache_wsdl'=> WSDL_CACHE_NONE,
										'style'    => SOAP_DOCUMENT,
										'use'      => SOAP_LITERAL,
										'connection_timeout' =>$timeout
									));
	//$PORTAL_PORTX='8082';
	//$this->my_soap = new SoapClient( "http://192.168.99.8:". $PORTAL_PORTX ."/ecc/http?wsdl" , array('trace' => 1,
	//									"exceptions" => true,                                                  
	//									'features' => SOAP_SINGLE_ELEMENT_ARRAYS + SOAP_USE_XSI_ARRAY_TYPE ,
	//									'cache_wsdl'=> WSDL_CACHE_NONE,
	//									'style'    => SOAP_DOCUMENT,
	//									'use'      => SOAP_LITERAL,
	//									'connection_timeout' =>$timeout
	//								));
	//								
		//var_dump($this->my_soap) ;die();
     	$ua=$this->getBrowser();
		print_r($ua);
		$XMLDATA_info = '<param>'
							.'<command>'
							.'<spt>'.$this->sp.'</spt>'
							.'<db>'.$this->DB.'</db>'
							.'<mode_db>'.$mode_db.'</mode_db>'
							.'<timeout>'.($mode==2?0:$timeout).'</timeout>'
								.'</command>'
							.'<session>' 
								.'<imode>'.$mode.'</imode>'
								.'<debug>'.$debug.'</debug>'
								.'<code>111111</code>'
								.'<user_id>'.$this->CI->session->userdata('user_id').'</user_id>'
								.'<ip_address>'.$this->get_client_ip().'</ip_address>'
								.'<user_agent>'.$ua['platform'].'_'.$ua['namex'].'_'.$ua['version'].'</user_agent>'
							.'</session>' 
							.'<search>'
							.'</search>'
							.'<search2>'
							.'</search2>' 
							.'<field>'
							.'<data_by>'.$this->CI->session->userdata('user_id').'</data_by>'
							.'<ip_address>'.$this->get_client_ip().'</ip_address>'
							.'</field>'
							.'</param>' ;
		//  print_r($wsdlUrl);
		$this->XML = new DOMDocument();
		$this->XML->loadXML($XMLDATA_info, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);

		unset($ua);
		unset($session_data); 
	} 
	
	
		
	function go2($request,$rpcurl){
				
			$context = stream_context_create(array('http' => array(
				'method' => "POST",
				'header' => "Content-Type: text/xml",
				'content' => $request
			)));
			$file = file_get_contents($rpcurl, false, $context);
			$response = xmlrpc_decode($file); 
			if ($response && xmlrpc_is_fault(array($response))) {
			trigger_error("xmlrpc: $response[faultString] ($response[faultCode])");
			} else {
		return $response;
			}
	}
	 
	 
	public function resultXML($withLog=false,$jsonformat=false,$die=false){
		$sts;
		$stshdr;
		$des;
		$rows;
		$detail; 
		try 
		{  
			$node = $this->XML->getElementsByTagName('param')->item(0);
			$search = $node->getElementsByTagName('field')->item(0);
			$search->setAttribute('rowformat','xml'); 
			$param_text= $this->encrypt($this->XML->saveXML());  
			// var_dump($param_text);die();
		
	 		xmlrpc_set_type($param_text,'base64'); // <-- required! 
		    $params =array($param_text) ;
			$request = xmlrpc_encode_request('Exec.init',$params);  
			$result = $this->go2($request,$this->url); 
			 // var_dump(base64_decode( $result));die();
			$doc_report = DOMDocument::loadXML(base64_decode( $result)); 
			$xpath_report = new DOMXpath($doc_report);
			if ($xpath_report ->query('//result/sts/no')->item(0) !=null)
			{
				$sts = $xpath_report ->query('//result/sts/no')->item(0)->nodeValue ; 
				$sts=substr ($sts,2,2);
				$stshdr=substr ($sts,0,2);
				$des = $xpath_report ->query('//result/sts/msg')->item(0)->nodeValue;
			}
			else
			{
				$sts='99';
				$des ='Unknown Error';
			}
			
			// $this->CI->session->sess_update();
			if ($sts=="00")
			{ 
				$rows = $xpath_report->query('//result/xrow');
			}else if ($sts=="85")
			{ 
									$this->CI->session->sess_destroy();
									header('HTTP/1.1 401 '.$des);
			}  
			if ($xpath_report ->query("//result/detail[1]/*")->length>0)
			{
				foreach ($xpath_report ->query('//result/detail')->item(0)->childNodes as $field) 
				{
				$detail[$field->nodeName]=$field->nodeValue;
				}
				
			}
			else
			{
				$detail=  array(  'sort'=> 0,
							  'desc'=> 0,
							  'rowspage'=> 0,
							  'rows'=> 0,
							  'pages'=> 0
							);
			}
		 
		} catch(Exception $e) {
			var_dump($e);die();
		}
			unset($strXMLData_info);
			unset($doc_report);
			unset($xpath_report);
			   if ($withLog)
		  {
			  if ($jsonformat){
					echo '<pre>';
					print_r (array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>json_encode( array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text)),'data'=>$rows,'detail'=>$detail));
						if ($die)
						die(); 
				  }
			  else{
					echo '<pre>';
					print_r (array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text),'data'=>$rows,'detail'=>$detail));
						if ($die)
						die(); 
				  } 
		  }
			return array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des, 'sts'=>json_encode(array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des)),'data'=>$rows,'detail'=>$detail);
	}      
	
	public function resultPrint2($prepare='my_query',$withLog=false,$jsonformat=false,$die=false){
		$sts;
		$stshdr;
		$des;
		$data;
		try { 

			$node = $this->XML->getElementsByTagName('param')->item(0);
			$search = $node->getElementsByTagName('field')->item(0);
			$search->setAttribute('rowformat','json'); 
			$param_text= $this->XML->saveXML(); 
			$params_info = array('Param'=>$this->encryptRJ256($param_text));  
			$webService_info = $this->my_soap->ExecECC($params_info); 
			$strXMLData_info = $webService_info->ExecECCResult; 

			$hasildescript=$this->decryptRJ256($strXMLData_info);
			// $doc_report = DOMDocument::loadXML($hasildescript);
			$doc_report = new DOMDocument();
			$doc_report->loadXML($hasildescript, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
			$xpath_report = new DOMXpath($doc_report);
			$sts = $xpath_report ->query('//result/sts/no')->item(0)->nodeValue ;
			$sts=substr ($sts,2,2);
			$des = $xpath_report ->query('//result/sts/des')->item(0)->nodeValue;
			 $namafile="";
			$xfile="";
			if ($sts=='00'){
				$rows = $xpath_report->query('//result/xrow');
                foreach ($rows as $per_row) {
                        $namafile=$per_row->getElementsByTagName('xfilename')->item(0)->nodeValue;
                        $xfile= $per_row->getElementsByTagName('xfile')->item(0)->nodeValue ;
                        break;
                } 
		    }
			
		} catch(Exception $e) { 
			var_dump($e);die();			 
		}
		
		
		
		unset($strXMLData_info);
		unset($doc_report);
		unset($xpath_report);
		// if ($withLog) {
			// if ($jsonformat){
				// echo '<pre>';
				// print_r (array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>json_encode( array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text)),'data'=>$rows,'detail'=>$detail));
				// if ($die)
				// die(); 
			// } else {
				// echo '<pre>';
				// print_r (array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text),'data'=>$rows,'detail'=>$detail));
				// if ($die)
				// die(); 
			// } 
		// }
		
		return array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'xfile'=>$xfile,'namafile'=>$namafile);
	}    
	
	public function resultPrint($prepare='my_query',$withLog=false,$jsonformat=false,$die=false){
		$sts;
		$stshdr;
		$des;
		$data;
		try { 

			$node = $this->XML->getElementsByTagName('param')->item(0);
			$search = $node->getElementsByTagName('field')->item(0);
			$search->setAttribute('rowformat','json'); 
			$param_text= $this->XML->saveXML(); 
			$params_info = array('Param'=>$this->encryptRJ256($param_text));  
			$webService_info = $this->my_soap->ExecECC($params_info); 
			$strXMLData_info = $webService_info->ExecECCResult; 

			$hasildescript=$this->decryptRJ256($strXMLData_info);
			// $doc_report = DOMDocument::loadXML($hasildescript);
			$doc_report = new DOMDocument();
			$doc_report->loadXML($hasildescript, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
			$xpath_report = new DOMXpath($doc_report);
			$sts = $xpath_report ->query('//result/sts/no')->item(0)->nodeValue ;
			$sts=substr ($sts,2,2);
			$des = $xpath_report ->query('//result/sts/des')->item(0)->nodeValue;
			 
			
			if ($sts=='00'){
				$rows = $xpath_report->query('//result/xrow');
                foreach ($rows as $per_row) {
                        $namafile=$per_row->getElementsByTagName('xfilename')->item(0)->nodeValue;
                        $xfile= $per_row->getElementsByTagName('xfile')->item(0)->nodeValue ;
                        break;
                } 
                 $this->saveDownload($xfile,$namafile); 
                
            exit;
			 }else{
				echo('
									<script type="text/javascript">
									try {
										 alert('.$des.'); 
										}
										catch(err) { 
										}
									
									</script>
									');
				exit;
			}
			
			// var_dump($doc_report->saveXML());die(); 
			 
		} catch(Exception $e) { 
			var_dump($e);die();			 
		}
		
		
		
		unset($strXMLData_info);
		unset($doc_report);
		unset($xpath_report);
		// if ($withLog) {
			// if ($jsonformat){
				// echo '<pre>';
				// print_r (array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>json_encode( array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text)),'data'=>$rows,'detail'=>$detail));
				// if ($die)
				// die(); 
			// } else {
				// echo '<pre>';
				// print_r (array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text),'data'=>$rows,'detail'=>$detail));
				// if ($die)
				// die(); 
			// } 
		// }
		
		return array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des, 'sts'=>json_encode(array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des)),'data'=>$rows);
	}    
	
	public function resultJSON5($prepare='my_query',$withLog=false,$jsonformat=false,$die=false){
		$sts;
		$stshdr;
		$des;
		$data;
		try { 
			$this->addField('data_by',$this->CI->session->userdata('user_id'));
			
			$node = $this->XML->getElementsByTagName('param')->item(0);
			$search = $node->getElementsByTagName('field')->item(0);
			$search->setAttribute('rowformat','xml'); 
			$param_text= $this->XML->saveXML();  
		
			$dbconn = pg_connect("dbname=". PG_DB ." user=". PG_USER ." password=". db_decryptRJ256(PG_PASS) ." port=". PG_PORT );
			if(!$dbconn) {
				echo "Unable to connect to test database\n";
				exit;
			}
			pg_query("BEGIN") or die("Could not start transaction\n");
			$result = pg_prepare($dbconn, $prepare, 'SELECT * FROM '.$this->sp.'($1)');
			$result = pg_execute($dbconn, $prepare, array($param_text));
			$sts = substr(pg_fetch_result($result, 0, 0),2,2);
			$des = pg_fetch_result($result, 0, 1);
			$data = pg_fetch_result($result, 0, 2);
			if ($result) {
				// echo "Commiting transaction\n";
				pg_query("COMMIT") or die("Transaction commit failed\n");
			} else {
				// echo "Rolling back transaction\n";
				pg_query("ROLLBACK") or die("Transaction rollback failed\n");;
			}
			pg_close($dbconn);

		} catch(Exception $e) {
			$stat = pg_connection_status($dbconn);
			if ($stat === PGSQL_CONNECTION_OK) {
				pg_close($dbconn);
			} 
			var_dump($e);die();			 
		}
		
		
		
		unset($strXMLData_info);
		unset($doc_report);
		unset($xpath_report);
		if ($withLog) {
			if ($jsonformat){
				echo '<pre>';
				print_r (array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>json_encode( array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text)),'data'=>$rows,'detail'=>$detail));
				if ($die)
				die(); 
			} else {
				echo '<pre>';
				print_r (array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text),'data'=>$rows,'detail'=>$detail));
				if ($die)
				die(); 
			} 
		}
		
		return array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des, 'sts'=>json_encode(array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des)),'data'=>$data);
	}
	
	public function resultJSON($prepare='my_query',$withLog=false,$jsonformat=false,$die=false){
		$sts;
		$stshdr;
		$des;
		$data;
		//print_r($prepare);
		try { 

			$node = $this->XML->getElementsByTagName('param')->item(0);
			$search = $node->getElementsByTagName('field')->item(0);
			$search->setAttribute('rowformat','json'); 
			$param_text= $this->XML->saveXML(); 
			$params_info = array('Param'=>$this->encryptRJ256($param_text));  
			$webService_info = $this->my_soap->ExecECC($params_info); 
			$strXMLData_info = $webService_info->ExecECCResult; 

			$hasildescript=$this->decryptRJ256($strXMLData_info);
			// $doc_report = DOMDocument::loadXML($hasildescript);
			$doc_report = new DOMDocument();
			$doc_report->loadXML($hasildescript, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
			$xpath_report = new DOMXpath($doc_report);
			$sts = $xpath_report ->query('//result/sts/no')->item(0)->nodeValue ;
			$sts=substr ($sts,2,2);
			$des = $xpath_report ->query('//result/sts/des')->item(0)->nodeValue;
			if ($sts=="00")
			{
					$jsondata_node=$xpath_report ->query('//result/dataJSON');
					
 					if ($jsondata_node!=null){
						if(isset($jsondata_node->item(0)->nodeValue)){
							$rows = base64_decode($jsondata_node->item(0)->nodeValue) ;
						} else {
							$rows = '[]';
						}
						
					}else
						$rows = '[]';
 			} else {
				$rows = '[]';
			}
			// var_dump($doc_report->saveXML());die(); 
			 
		} catch(Exception $e) { 
			var_dump($e);die();			 
		}
		
		
		
		unset($strXMLData_info);
		unset($doc_report);
		unset($xpath_report);
		// if ($withLog) {
			// if ($jsonformat){
				// echo '<pre>';
				// print_r (array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>json_encode( array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text)),'data'=>$rows,'detail'=>$detail));
				// if ($die)
				// die(); 
			// } else {
				// echo '<pre>';
				// print_r (array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text),'data'=>$rows,'detail'=>$detail));
				// if ($die)
				// die(); 
			// } 
		// }
		
		return array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des, 'sts'=>json_encode(array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des)),'data'=>$rows);
	}      
	
	public function resultJSON3($prepare='my_query',$withLog=false,$jsonformat=false,$die=false){
		$sts;
		$stshdr;
		$des;
		$data;
		try { 

			$node = $this->XML->getElementsByTagName('param')->item(0);
			$search = $node->getElementsByTagName('field')->item(0);
			$search->setAttribute('rowformat','xml'); 
			$param_text= $this->XML->saveXML();  

			$dbconn = pg_connect("dbname=ECC_DEV user=postgres password=Dunhill399 port=5433");
			if(!$dbconn) {
				echo "Unable to connect to test database\n";
				exit;
			}
			pg_query("BEGIN") or die("Could not start transaction\n");
			$result = pg_prepare($dbconn, $prepare, 'SELECT * FROM '.$this->sp.'($1)');
			$result = pg_execute($dbconn, $prepare, array($param_text));
			$sts = substr(pg_fetch_result($result, 0, 0),2,2);
			$des = pg_fetch_result($result, 0, 1);
			$data = pg_fetch_result($result, 0, 2);
			if ($result) {
				// echo "Commiting transaction\n";
				pg_query("COMMIT") or die("Transaction commit failed\n");
			} else {
				// echo "Rolling back transaction\n";
				pg_query("ROLLBACK") or die("Transaction rollback failed\n");;
			}
			pg_close($dbconn);

		} catch(Exception $e) {
			$stat = pg_connection_status($dbconn);
			if ($stat === PGSQL_CONNECTION_OK) {
				pg_close($dbconn);
			} 
			var_dump($e);die();			 
		}
		
		
		
		unset($strXMLData_info);
		unset($doc_report);
		unset($xpath_report);
		if ($withLog) {
			if ($jsonformat){
				echo '<pre>';
				print_r (array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>json_encode( array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text)),'data'=>$rows,'detail'=>$detail));
				if ($die)
				die(); 
			} else {
				echo '<pre>';
				print_r (array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text),'data'=>$rows,'detail'=>$detail));
				if ($die)
				die(); 
			} 
		}
		
		return array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des, 'sts'=>json_encode(array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des)),'data'=>$data);
	}      
	
	public function resultJSON2($withLog=false,$jsonformat=false,$die=false){
		$sts;
		$stshdr;
		$des;
		$rows;
		$detail; 
		try { 
		
			$node = $this->XML->getElementsByTagName('param')->item(0);
			$search = $node->getElementsByTagName('field')->item(0);
			$search->setAttribute('rowformat','xml'); 
			$param_text= $this->XML->saveXML();  
			xmlrpc_set_type($param_text,'base64'); // <-- required! 
		    $params =array($param_text) ;
			$request = xmlrpc_encode_request('Exec.init',$params);  
			$result = $this->go2($request,$this->url); 
			 
			$doc_report = DOMDocument::loadXML(base64_decode( $result));
			
			$xpath_report = new DOMXpath($doc_report);
			if ($xpath_report ->query('//result/sts/no')->item(0) !=null)
			{
				$sts = $xpath_report ->query('//result/sts/no')->item(0)->nodeValue ; 
				$sts=substr ($sts,2,2);
				$stshdr=substr ($sts,0,2);
				$des = $xpath_report ->query('//result/sts/msg')->item(0)->nodeValue;
			}
			else
			{
				$sts='99';
				$des ='Unknown Error';
			}
			
			// $this->CI->session->sess_update();
			if ($sts=="00"){ 
				$rows = $xpath_report->query('//result/xrow');
			}else if ($sts=="85"    ){ 
									$this->CI->session->sess_destroy();
									header('HTTP/1.1 401 '.$des);
			}  
			if ($xpath_report ->query("//result/detail[1]/*")->length>0)
			{
				foreach ($xpath_report ->query('//result/detail')->item(0)->childNodes as $field) 
				{
				$detail[$field->nodeName]=$field->nodeValue;
				}
				
			}else{
				$detail=  array(  'sort'=> 0,
							  'desc'=> 0,
							  'rowspage'=> 0,
							  'rows'=> 0,
							  'pages'=> 0
							);
			}
		 
		} catch(Exception $e) {
			var_dump($e);die();
		}
			unset($strXMLData_info);
			unset($doc_report);
			unset($xpath_report);
			   if ($withLog)
		  {
			  if ($jsonformat){
					echo '<pre>';
					print_r (array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>json_encode( array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text)),'data'=>$rows,'detail'=>$detail));
						if ($die)
						die(); 
				  }
			  else{
					echo '<pre>';
					print_r (array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text),'data'=>$rows,'detail'=>$detail));
						if ($die)
						die(); 
				  } 
		  }
			return array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des, 'sts'=>json_encode(array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des)),'data'=>$rows,'detail'=>$detail);
	}      
	 /*
	public function resultJSON($postData='',$withLog=false,$jsonformat=false,$die=false)
	{
		  $sts;
		  $des;
		  $rows = '[]';
		  $detail; 
 		try {
			$node = $this->XML->getElementsByTagName('param')->item(0);
			$search = $node->getElementsByTagName('field')->item(0);
			$search->setAttribute('rowformat','json'); 

			$param_text= $this->XML->saveXML();
			$params_info = array('Param'=>$this->encryptRJ256($this->key,$param_text));  
			$webService_info = $this->my_rpc->OlahDataOutStringWithEncrypt($params_info); 
			$strXMLData_info = $webService_info->OlahDataOutStringWithEncryptResult; 

			$hasildescript=$this->decryptRJ256($this->key,$strXMLData_info);
			$doc_report = DOMDocument::loadXML($hasildescript);

			$xpath_report = new DOMXpath($doc_report);
			$sts = $xpath_report ->query('//result/sts/no')->item(0)->nodeValue ;
			$sts=substr ($sts,2,2);
			$des = $xpath_report ->query('//result/sts/des')->item(0)->nodeValue;
			$this->CI->session->sess_update();
		  	if ($sts=="00"){
					$jsondata_node=$xpath_report ->query('//result/jsondata');
 					if ($jsondata_node!=null){
						$rows = base64_decode($jsondata_node->item(0)->nodeValue) ;
					}else
						$rows = '[]';
 			}else if ($sts=="85"){ 
								$this->CI->session->sess_destroy();
								header('HTTP/1.1 401 '.$des);die('Session Expire a4'); 
							// $this->showAlertErrorLogin($des);
			} 
        	// echo $sts;
			if ($xpath_report ->query("//result/detail[1]/*")->length>0){
				foreach ($xpath_report ->query('//result/detail')->item(0)->childNodes as $field) {
				$detail[$field->nodeName]=$field->nodeValue;
				}
				
			}else{
				$detail=  array(  'sort'=> 0,
							  'desc'=> 0,
							  'rowspage'=> 0,
							  'rows'=> 0,
							  'pages'=> 0
							);
			}
			} catch(Exception $e) {
				var_dump($e);die();
			} 
			unset($strXMLData_info);
			unset($doc_report);
			unset($xpath_report);  
			
		  if ($withLog)
		  {
			  if ($jsonformat){
					echo '<pre>';
					print_r (array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>json_encode( array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text)),'data'=>$rows,'detail'=>$detail));
						if ($die)
						die(); 
				  }
			  else{
					echo '<pre>';
					print_r (array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text),'data'=>$rows,'detail'=>$detail));
						if ($die)
						die(); 
				  } 
		  }
		   
			return array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,'sts'=>json_encode( array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des ,'post'=>$postData,'param'=>$param_text)),'data'=>$rows,'detail'=>$detail);
        }     
		
	public function dataXML(){
		return $this->XML->saveXML();
	}
	public function resultXMLother($other_nodes='')
		{	  
		$other_nodes_result;
		$sts;
		$des;
		$rows ;
		$detail;  
			try { 
			$node = $this->XML->getElementsByTagName('param')->item(0);
			$search = $node->getElementsByTagName('field')->item(0);
			$search->setAttribute('rowformat','xml'); 
			
			$params_info = array('Param'=>$this->encryptRJ256($this->key, $this->XML->saveXML()));  
			$webService_info = $this->my_rpc->OlahDataOutStringWithEncrypt($params_info); 
			$strXMLData_info = $webService_info->OlahDataOutStringWithEncryptResult; 
			
			$hasildescript=$this->decryptRJ256($this->key,$strXMLData_info); 
			
			$doc_report = DOMDocument::loadXML($hasildescript);
			 
			$xpath_report = new DOMXpath($doc_report);
			$sts = $xpath_report ->query('//result/sts/no')->item(0)->nodeValue ;
			$sts=substr ($sts,2,2);
			$des = $xpath_report ->query('//result/sts/des')->item(0)->nodeValue;
			$this->CI->session->sess_update();
			if ($sts=="00"){  
				$rows = $xpath_report->query('//result/xrow');
				if (is_array($other_nodes)){ 
					foreach ($other_nodes as &$value) {
						$other_nodes_result[$value] = $xpath_report->query('//result/'.$value); 
					}
				}else{
					if ($other_nodes != '')
					$other_nodes_result = $xpath_report->query('//result/'.$other_nodes); 
			
				}
			}else if ($sts=="85"    ){ 
								$this->CI->session->sess_destroy();
								header('HTTP/1.1 401 '.$des);die('Session Expire a5'); 
			} 
			// echo $sts;
			if ($xpath_report ->query("//result/detail[1]/*")->length>0){
				foreach ($xpath_report ->query('//result/detail')->item(0)->childNodes as $field) {
				$detail[$field->nodeName]=$field->nodeValue;
				}
				
			}else{
				$detail=  array(  'sort'=> 0,
							  'desc'=> 0,
							  'rowspage'=> 0,
							  'rows'=> 0,
							  'pages'=> 0
							);
			}
			} catch(Exception $e) {
				var_dump($e);die();
			}
			unset($strXMLData_info);
			unset($doc_report);
			unset($xpath_report);  
			
 		return array('session'=>$this->CI->session->userdata,'valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des,
					'sts'=>json_encode(array('valid'=>$sts=='00'?true:false,'no'=>$sts,'des'=>$des)), 
					'data'=>$rows,
					'detail'=>$detail,
					'param_other'=>$other_nodes,
					'data_other'=>$other_nodes_result
					);
	}  
 	
	function showAlertErrorLogin($message){
					 		  $this->CI->session->unset_userdata('logged_in');
							  echo('
								<script type="text/javascript">
								try {
									$.messager.alert("User Authentication","'.$message.'","error",function(){;
									 	window.location.href="'.base_url().'ctLogin";
									}); 
									}
									catch(err) {
									   window.location.href="'.base_url().'ctLogin";
									}
								
								</script>
								');
								die();
	}
 	*/
	function setView($rowspage,$page,$sort,$order,$def_col){
			$node = $this->XML->getElementsByTagName('param')->item(0);
			$search = $node->getElementsByTagName('field')->item(0);
			$search->setAttribute('rowspage',$rowspage);
			$search->setAttribute('page',$page);
			$search->setAttribute('sort',$this->getSort($sort,$order,$def_col)); 
			$search->setAttribute('desc',''); 
	} 
 
	function getSort($sortsd,$ordersd,$def_col){ 
		$sorts = explode(",", $sortsd);
		$sort='';
		$orders = explode(",", $ordersd);
		$i=0;
		foreach ($sorts as &$value) { 
		 	if (array_key_exists($value, $def_col)) {  
				$fsidx=$def_col[$value];
				if ($orders[$i]=='asc'){
					if ($sort==''){
						$sort=$sort.$fsidx['db'].'=1' ;
					}else{
						$sort=$sort.','.$fsidx['db'].'=1' ;
					}
			 	}else{
					if ($sort==''){
						$sort=$sort.$fsidx['db'].'=2' ;
					}else{
						$sort=$sort.','.$fsidx['db'].'=2' ;
					}
				}
			}
			 
			$i=$i+1;
		} 
		
	 	 if ($sort==''){
		 $sort=$def_col[0]['db'].'=1';
		 }
		 return $sort;
	}
	 
	function setWhere($search,$filters=false,$def_col=false){  
		 $this->group = null;
			
		 $array_decode = json_decode($filters,true);
		
		 if(isset($array_decode['rules'])){ 

			$array = $array_decode['rules'];
					$max = sizeof($array);
			if ($max>0){
				for($i = 0; $i < $max;$i++)
				{
					$fcr=$def_col[$array[$i]['field']];
					
					if ($fcr != null) 
					{ 
						if  ($this->group == null) {
							$this->group=$this->searchAddGroup(0);  
						} 
						$searchString = $array[$i]['data'];
						if ($fcr['ctype']=='int'){  
							if ($searchString!=$fcr['bypassvalue'])  
								$this->searchAddNum($this->group,$fcr['sc'],0,$this->getPersamaan($array[$i]['op']),$searchString,'');   
						} 
						elseif ($fcr['ctype']=='text'){ 
 						 	if ($searchString!=$fcr['bypassvalue']) 
								$this->searchAddText($this->group,$fcr['sc'],0,$this->getPersamaan($array[$i]['op']),$searchString);   
						}  
						elseif ($fcr['ctype']=='date'){ 
						 	// if (trim($searchString) != '' ){ 
								// $dateArray=explode('/',$searchString);  
								// $searchString = $dateArray[2].'-'.$dateArray[1].'-'.$dateArray[0]; 
							// } 
							$this->searchAddDate($this->group,$fcr['sc'],0,$this->getPersamaan($array[$i]['op']),$searchString,'');   
			 			}  
				
					}
			 	} 
			}
			 
		}
	}
	
	function searchAddGroup($modeGroup) {	//$modeGroup 0=AND ,1 =OR
		$node = $this->XML->getElementsByTagName('param')->item(0);
		$search = $node->getElementsByTagName('search2')->item(0);
		$listGroupSearch = $search->getElementsByTagName('fg');
	 	if ($listGroupSearch ->item(0) != null){
			$this->groupSearchKe =$listGroupSearch ->length;
		}
		$this->groupSearchKe++; 
		$element = $this->XML->createElement('fg', '');
		$element->setAttribute('gID',$this->groupSearchKe);
		$element->setAttribute('mg',$modeGroup);
		$search->appendChild($element);
		return $element;
	}
 
	function searchAddText(	$groupSearch	// target group 
							,$name			// field code ex: rID, r1
							,$modesearch	//0:AND	,1:OR
							,$modepersamaan //1:equal , 2:< , 3:> , 4:between
							,$FindString
						   ){ 
			$list_find =$this->XML->getElementsByTagName('listf');
			$ke=0;
			if ($list_find->item(0)!= null)  
			$ke = $list_find ->length;

			$ke++;

			$element = $this->XML->createElement('listf', '');
			$element->setAttribute('fid',$ke);
			$element->setAttribute('fn',$name);
			$element->setAttribute('mg',$modesearch);
			$element->setAttribute('mp',$modepersamaan);
			$element->setAttribute('mf','1');//--= 1= STRING ,2=ANGKA , 3=DATETIME 
			$element->setAttribute('ft1',$FindString);
			$element->setAttribute('ft2','');//di pakai untuk between
			$groupSearch->appendChild($element);
			return $element;
	}

	function searchAddNum(	 $groupSearch	// target group 
						,$name			// field code ex: rID, r1
						,$modesearch	//0:AND	,1:OR
						,$modepersamaan //1:equal , 2:< , 3:> , 4:between
						,$num1
						,$num2
						){
	
			$list_find =$this->XML->getElementsByTagName('listf');
			$ke=0;
			if ($list_find->item(0)!= null)  
			$ke = $list_find ->length;
			
			$ke++;
			
			$element = $this->XML->createElement('listf', '');
			$element->setAttribute('fid',$ke);
			$element->setAttribute('fn',$name);
			$element->setAttribute('mg',$modesearch);
			$element->setAttribute('mp',$modepersamaan);
			$element->setAttribute('mf','2');//--= 1= STRING ,2=ANGKA , 3=DATETIME 
			$element->setAttribute('ft1',$num1);
			$element->setAttribute('ft2',$num2);//di pakai untuk between
			$groupSearch->appendChild($element);
			return $element;
	}
 

	function searchAddDate(	$groupSearch	// target group 
							,$name			// field code ex: rID, r1
							,$modesearch	//0:AND	,1:OR
							,$modepersamaan //1:equal , 2:< , 3:> , 4:between
							,$FindDate
							,$FindDate2
							){ 
			$list_find =$this->XML->getElementsByTagName('listf');
			$ke=0;
			if ($list_find->item(0)!= null)  
			$ke = $list_find ->length;

			$ke++;

			$element = $this->XML->createElement('listf', '');
			$element->setAttribute('fid',$ke);
			$element->setAttribute('fn',$name);
			$element->setAttribute('mg',$modesearch);
			$element->setAttribute('mp',$modepersamaan);
			$element->setAttribute('mf','3');//--= 1= STRING ,2=ANGKA , 3=DATETIME 
			$element->setAttribute('ft1',$FindDate);
			$element->setAttribute('ft2',$FindDate2);//di pakai untuk between
			$groupSearch->appendChild($element);
			return $element;
	}

	
	function getPersamaan($op ){
		if ($op=='equal')
			return 0;
		else if ($op=='contains')
			return 1;
		else if ($op=='less')
			return 2;
		else if ($op=='lessorequal')
			return 3;
		else if ($op=='greater')
			return 4;
		else if ($op=='greaterorequal')
			return 5;
		else if ($op=='between')
			return 6;
		else if ($op=='notequal')
    		return 7;
		else if ($op=='notcontains')
    		return 8;
 		else
			return 1;
	  
   }
   
	function getXMLValue($xmlnode,$tagName){ 
		$hasil='';
		if ($xmlnode !=null) {
			if ($xmlnode->getElementsByTagName($tagName)->item(0)!=null){
					$hasil = $xmlnode->getElementsByTagName($tagName)->item(0)->nodeValue;
				}
 				
			}
			return $hasil;
	}
	
	function getXMLValueWithDefault($xmlnode,$tagName,$defaultValue=''){ 
			$hasil='';
			if ($xmlnode !=null) {
				if ($xmlnode->getElementsByTagName($tagName)->item(0)!=null){
					$hasil = $xmlnode->getElementsByTagName($tagName)->item(0)->nodeValue;
				}else{
				$hasil=$defaultValue;
				}
  			}else{
				$hasil=$defaultValue;
			}
			return $hasil;
	}
	
	function addField($name,$value){
		$node = $this->XML->getElementsByTagName('param')->item(0);
		$search = $node->getElementsByTagName('field')->item(0);
		$element = $this->XML->createElement($name,  htmlentities($value));
		$search->appendChild($element); 
	}
	
	function addAttributeChild($fieldsub ,$child_data = array()) {

		$node = $this->XML->getElementsByTagName('param')->item(0);
		$field = $node->getElementsByTagName('field')->item(0);

		if ($field->getElementsByTagName($fieldsub)->item(0)!=null){
			$dtl_item = $field->getElementsByTagName($fieldsub)->item(0);
		} else {
			$dtl_item = $this->XML->createElement($fieldsub, '');
			$field->appendChild($dtl_item);
		};

		if(is_array($child_data)){
			$element = $this->XML->createElement('lst', '');
			foreach($child_data as $key=>$value){
				$element->setAttribute("r".$key,$value);
			}
			$dtl_item->appendChild($element);
		}
		
	}
		
	 
	
	function addFieldFile($ori_name,$tmp_name,$is_upload){
			$param = $this->XML->getElementsByTagName('param')->item(0);
			$field = $param->getElementsByTagName('field')->item(0);
			$lst = $this->XML->createElement("lst","");
			$field->appendChild($lst); 
			$tmp = $this->XML->createElement("f_tmp",$tmp_name);
			$lst->appendChild($tmp); 
			$ori = $this->XML->createElement("f_ori",$ori_name);
			$lst->appendChild($ori);  
			$up = $this->XML->createElement("f_up",$is_upload);
			$lst->appendChild($up);   
			return $lst; 
	}
	function decryptRJ256($string_to_decrypt){ 
		$keyX = substr(hash('sha256', $this->key, true), 0, 32);
		$rtn = openssl_decrypt(base64_decode($string_to_decrypt), $this->method, $keyX, OPENSSL_RAW_DATA, $this->iv);
	// $rtn = rtrim($rtn, "\4");
		return($rtn); 
    }
     
    function encryptRJ256($string_to_encrypt){
		$keyX = substr(hash('sha256', $this->key, true), 0, 32);
    	$rtn = base64_encode(openssl_encrypt($string_to_encrypt, $this->method, $keyX, OPENSSL_RAW_DATA, $this->iv));
	  	return($rtn); 
    }
    /**
     * Encrypt data using AES Cipher (CBC) with 128 bit key
     * 
     * @param type $key - key to use should be 16 bytes long (128 bits)
     * @param type $iv - initialization vector
     * @param type $data - data to encrypt
     * @return encrypted data in base64 encoding with iv attached at end after a :
     */
 
    // function decryptRJ256($key,$string_to_decrypt){ 
		// $string_to_decrypt = base64_decode($string_to_decrypt); 
		// $rtn = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, $string_to_decrypt, MCRYPT_MODE_CBC, $this->iv);
		// $rtn = rtrim($rtn, "\4");
		// return($rtn); 
    // }
     
    // function encryptRJ256($key,$string_to_encrypt){
     	// $rtn = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $string_to_encrypt, MCRYPT_MODE_CBC,$this->iv);
     	// $rtn = base64_encode($rtn);
     	// return($rtn); 
	
    // }
	
	public function encrypt($plainText)
    {
	     try { 
            $initVector = bin2hex(openssl_random_pseudo_bytes($this->INIT_VECTOR_LENGTH / 2));
            // Encrypt input text
            $raw = openssl_encrypt(
                $plainText,
                $this->CIPHER,
                $this->secretKey,
                OPENSSL_RAW_DATA,
                $initVector
            );
          
            return  base64_encode($initVector . $raw);
        } catch (\Exception $e) {
             return new static(isset($initVector), null, $e->getMessage());
        }
    }
    /**
     * Decrypt encoded text by AES-128-CBC algorithm
     *
     * @param string $this->secretKey  16/24/32 -characters secret password
     * @param string $cipherText Encrypted text
     *
     * @return self Self object instance with data or error message
     */
    public static function decrypt($cipherText) {
		  try { 
            $encoded = base64_decode($cipherText);
            // Slice initialization vector
            $initVector = substr($encoded, 0, $this->INIT_VECTOR_LENGTH);
            // Slice encoded data
            $data = substr($encoded, $this->INIT_VECTOR_LENGTH);
            // Trying to get decrypted text
            $decoded = openssl_decrypt(
                $data,
                $this->CIPHER,
                $this->secretKey,
                OPENSSL_RAW_DATA,
                $initVector
            );
            if ($decoded === false) {
                // Operation failed
                return new static(isset($initVector), null, openssl_error_string());
            }
            // Return successful decoded object
            return new static($initVector, $decoded);
        } catch (\Exception $e) {
            // Operation failed
            return new static(isset($initVector), null, $e->getMessage());
        }
    }
	
	public static function isKeyLengthValid()
    {
        $length = strlen($this->secretKey);
        return $length == 16 || $length == 24 || $length == 32;
    }
    
    function _get_time(){ 
	 	    return (strtolower($CI ->time_reference) === 'gmt')
			? mktime(gmdate('H'), gmdate('i'), gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y'))
			: time();
	} 
	
	function push_file($path, $name){
	 	if(is_file($path))
		{
	 //	required for IE
			if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off'); }

		///	get the file mime type using the file extension
			$this->load->helper('file');

			$mime = get_mime_by_extension($path);

		//	Build the headers to push out the file properly.
			header('Pragma: public');     // required
			header('Expires: 0');         // no cache
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($path)).' GMT');
			header('Cache-Control: private',false);
			header('Content-Type: '.$mime);  // Add the mime type from Code igniter.
			header('Content-Disposition: attachment; filename="'.basename($name).'"');  // Add the file name
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: '.filesize($path)); // provide file size
			header('Connection: close');
			readfile($path); // push it out
			exit();
		}
	} 
	 
	 
	 function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'namex'      => $ub,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
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
		function saveDownload($filename,$saveAs)
        {
							 
			ignore_user_abort (); 
			$extension = strtolower( pathinfo( basename( $saveAs ), PATHINFO_EXTENSION ) );
			set_time_limit(0);
			
			// our list of mime types
			$mime_types = array(

			'txt' => 'text/plain',
			'htm' => 'text/html',
			'html' => 'text/html',
			'php' => 'text/html',
			'css' => 'text/css',
			'js' => 'application/javascript',
			'json' => 'application/json',
			'xml' => 'application/xml',
			'swf' => 'application/x-shockwave-flash',
			'flv' => 'video/x-flv',

			// images
			'png' => 'image/png',
			'jpe' => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'jpg' => 'image/jpeg',
			'gif' => 'image/gif',
			'bmp' => 'image/bmp',
			'ico' => 'image/vnd.microsoft.icon',
			'tiff' => 'image/tiff',
			'tif' => 'image/tiff',
			'svg' => 'image/svg+xml',
			'svgz' => 'image/svg+xml',

			// archives
			'zip' => 'application/zip',
			'rar' => 'application/x-rar-compressed',
			'exe' => 'application/x-msdownload',
			'msi' => 'application/x-msdownload',
			'cab' => 'application/vnd.ms-cab-compressed',

			// audio/video
			'mp3' => 'audio/mpeg',
			'qt' => 'video/quicktime',
			'mov' => 'video/quicktime',

			// adobe
			'pdf' => 'application/pdf',
			'psd' => 'image/vnd.adobe.photoshop',
			'ai' => 'application/postscript',
			'eps' => 'application/postscript',
			'ps' => 'application/postscript',

			// ms office
			'doc' => 'application/msword',
			'rtf' => 'application/rtf',
			'xls' => 'application/vnd.ms-excel',
			'ppt' => 'application/vnd.ms-powerpoint',

			// open office
			'odt' => 'application/vnd.oasis.opendocument.text',
			'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
			);

			// Set a default mime if we can't find it
			if( !isset( $mime_types[$extension] ) )
			{
			$mime = 'application/octet-stream';
			}
			else
			{
			$mime = ( is_array( $mime_types[$extension] ) ) ? $mime_types[$extension][0] : $mime_types[$extension];
			}
		
			if(file_exists($filename)) {
			
					if( strstr( $_SERVER['HTTP_USER_AGENT'], "MSIE" ) )
					{
						header("Content-Type: application/force-download");
						header( 'Content-Type: "'.$mime.'"' );
					 	header("Content-Disposition: attachment; filename=\"".basename($saveAs)."\";" ); 
						header( 'Expires: 0' );
						header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
					 	header( "Content-Transfer-Encoding: binary" );
						header( 'Pragma: public' );
						header( "Content-Length: ".filesize( $filename ) );
					}
					else
					{
						header( "Pragma: public" );
						header( "Expires: 0" );
						header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
						header( "Cache-Control: private", false );
						header("Content-Type: application/force-download");
						header( "Content-Type: ".$mime, true, 200 );
						header("Content-Type: application/download");
						header( 'Content-Length: '.filesize( $filename ) );
						header("Content-Disposition: attachment; filename=\"".basename($saveAs)."\";" ); 
				 		header( "Content-Transfer-Encoding: binary" );
					}
			
					flush(); // this doesn't really matter.
					$fp = fopen($filename, "r");
					while (!feof($fp))
					{
						echo fread($fp, 65536);
						flush(); // this is essential for large downloads
					} 
					fclose($fp);
					unlink($filename);
					exit();
			}
			else {
				die('The provided file path: ' . $filename .' is not valid.');
			}  
		}
}