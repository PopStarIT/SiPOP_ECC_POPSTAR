<?php

class array2xml {
  
  protected $array;
  
  public function __construct($array) {
    //make some constructor or whatever,,, for example we will pass array, but you could do this the other way around,
    $this->array = $array;
	$this->CI =& get_instance();
	$this->CI->load->model('main'); // load model
  }
  
  public function generateXMLInternally() {
    $xml_data = new SimpleXMLElement('<?xml version="1.0"?><root></root>');
  	$this->array_to_xml($this->array,$xml_data);
  	return $xml_data->asXML();
  }
  
  public function generateXML($array) {
		$array['createuserid'] = $this->CI->session->userdata('userid');
		$array['createdate'] = date('Y-m-d H:i:s');
		
		$xml_data = new SimpleXMLElement('<?xml version="1.0"?><root></root>');
		$this->array_to_xml($array,$xml_data);
		 
		$return = $xml_data->asXML();
		$return = str_replace("'","&amp;#039;",$return);
		return $return;
  }
  
  public function array_to_xml( $data, &$xml_data ) {
  	 foreach( $data as $key => $value ) {
  	       if( is_array($value) ) {
  	            $this->parse_array_to_xml($value, $xml_data, $key);
  	        } else {
  	            $xml_data->addChild($key,htmlentities(trim($value)));
  	        }
  	 }
  }
  
  public function parse_array_to_xml( $data, &$xml_data, $nodekey ) {
  	 foreach( $data as $key => $value ) {
  	       if( is_array($value) ) {
  	            $subnode = $xml_data->addChild($nodekey);
  	            $this->array_to_xml($value, $subnode);
  	        } else {
  	            $xml_data->addChild($key,htmlentities(trim($value)));
  	        }
  	 }
  }
}

?>