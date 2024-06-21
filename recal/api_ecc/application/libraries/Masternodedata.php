<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Masternodedata {
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->model('main');	
		$this->CI->load->library('mainconfig');	
	}
		
	function masternode_update_info(){
		$return = array();
		
		$label = isset($_REQUEST['label']) ? htmlentities($_REQUEST['label']) : null;
		$genkey = isset($_REQUEST['genkey']) ? htmlentities($_REQUEST['genkey']) : null;
		$blockchain_status = isset($_REQUEST['blockchain_status']) ? htmlentities($_REQUEST['blockchain_status']) : null;
		$masternode_status = isset($_REQUEST['masternode_status']) ? htmlentities($_REQUEST['masternode_status']) : null;
		
		$array = array();
		$array['label'] = $label;
		$array['genkey'] = $genkey;
		$array['blockchain_status'] = $blockchain_status;
		$array['masternode_status'] = $masternode_status;
		
		$where = array();
		$where['label'] = $label;
		$where['genkey'] = $genkey;
		
		$update = array();
		$update['masternode_status'] = $masternode_status;
		$update['blockchain_status'] = $blockchain_status;
		
		$this->CI->main->update('dt_masternode',$update,$where);
		
		return $return;
	}
}
?>