<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class System extends CI_Controller { 

	function __construct(){ 
		parent::__construct(); 
	} 

	function index(){ 
	
		$component['view_load'] = 'controlpanel/dashboard';
		$component['page_title'] = 'Dashboard';
		
		$this->authentication->cplayout($component);	
	} 

}