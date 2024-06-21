<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
//$config['PORTAL_PORT'] = "8082";
//define('PG_HOST', '192.168.99.8');
//define('PG_PORT', '5454');
//define('PG_DB', 'ECC-V3');
//define('PG_USER', 'postgres');
//define('PG_PASS', 'd5lO3fi98QIbNRiK6li5uQ==');
      //  $this->CI =& get_instance();
		//$this->CI->load->library('session');	
$autoload['libraries'] = array('session');	
$config['PORTAL_PORT'] = "8083";
$config['user_in'] = "who";
$data_user=array('eko');
  
if(isset($_POST['username'])){
	// Saat ini masih disable karena masih dalam proses pengeditan 
    // $user_login=$_POST['username'];
    //   if( in_array($user_login, $data_user)) {
	//      var_dump('Data array ');
	//      var_dump($user_login);
    //    }else{
	//      var_dump('tidak termasuk array ');
    //      var_dump($user_login);
    //  }
		
      if($_POST['username'] =='ekox'){
      	
         define('PG_HOST', '127.0.0.1');
         define('PG_PORT', '5432');
         define('PG_DB', 'SIPOP');
         define('PG_USER', 'postgres');
         define('PG_PASS', 'd5lO3fi98QIbNRiK6li5uQ==');
		 $config['user_in'] = "eko_hrd";
		// var_dump($config['user_in']);
	   //  $in=array('in_code' =>'eko_hrd');
       //  $this->session->set_userdata($in);	
      //var_dump($_POST['username']);
      }else{
		   $config['user_in'] = "no_name";
           define('PG_HOST', '192.168.99.8');
           define('PG_PORT', '5454');
           define('PG_DB', 'ECC_LIVE');
           define('PG_USER', 'postgres');
           define('PG_PASS', 'd5lO3fi98QIbNRiK6li5uQ==');
      
      }
}else{
	if($config['user_in']=='eko_hrd'){
		 define('PG_HOST', '127.0.0.1');
         define('PG_PORT', '5432');
         define('PG_DB', 'SIPOP');
         define('PG_USER', 'postgres');
         define('PG_PASS', 'd5lO3fi98QIbNRiK6li5uQ==');
		 $config['user_in'] = "eko_hrd";
	//	var_dump($config['user_in']);
	}else{
         define('PG_HOST', '192.168.99.8');
         define('PG_PORT', '5454');
         define('PG_DB', 'ECC_LIVE');
         define('PG_USER', 'postgres');
         define('PG_PASS', 'd5lO3fi98QIbNRiK6li5uQ==');
	     $config['user_in'] = "no_name";
		 
	}
}

define('PG_HOST2', '127.0.0.1');
define('PG_PORT2', '5432');
define('PG_DB2', 'SIPOP');
define('PG_USER2', 'postgres');
define('PG_PASS2', 'Bismill4hP4st1');

//$config['PORTAL_PORT'] = "8083";
//define('PG_HOST', '192.168.99.8');
//define('PG_PORT', '5454');
//define('PG_DB', 'ECC-V3');
//define('PG_USER', 'postgres');
//define('PG_PASS', 'd5lO3fi98QIbNRiK6li5uQ==');
