<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Brick_config extends CI_Controller { 

	function __construct(){ 
		parent::__construct(); 
	} 
		
	function index(){ 
		// $component['load_js'][] = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places';
		// $component['load_js'][] = 'website/map';
		// $component['load_js'][] = 'website/login';
		
		$component['loadlayout'] = true;
		$component['view_load'] = 'controlpanel/dashboard';
		$component['load_js'][] = 'controlpanel/dashboard';
		
		$this->authentication->cplayout($component);	
	} 

	function connectterminal(){ 
		$IP="192.168.2.7";  // ip mesin absen / finger print
		$Key="0";
		
		try {
			$Connect = fsockopen($IP, "80", $errno, $errstr, 1);

			// This is not useful.
			if (!$Connect){
				throw new Exception();
			} else {
				echo "berhasil";
			}
		} catch (Exception $e) {
			echo "gagal";
			echo "<pre>";
			print_r($e);
		}
	} 

}