<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Application constant string
| -------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Website details
|--------------------------------------------------------------------------
|
| These details are     used in this application
|
*/
$config['APP_CLIENT'] = "";
$config['APP_tagline'] = '<span class="tagLine-1"><img src="assets/images/cycycle3x_small,png" class="tagLIne-1-img" />'.$config['APP_CLIENT'].'</span>';
$config['APP_ver'] = '0,1';
$config['APP_title'] = 'Cyber Cycle APPLICATION';
$config['APP_upload_path'] = 'c:/xampp/htdocs/upload/';

//  WS URL Path
//define('APPWSPATH', 'http://202,129,187,226:8282/CyberC/PHPService?wsdl'); 
//define('APPWSPATH', 'http://192,168,100,100:8282/CyberC/PHPService?wsdl'); 
define('APPWSPATH', 'http://localhost:8282/CyberC/PHPService?wsdl'); 
define('SUBPATH', 'inventori'); 
define('RID', '9999'); //rootid
define('AID', '0'); //adminid
define('LAID', '1'); //leveladminid
define('LRID', '0'); //levelrootid
define('CCS_TYPE', 'BASIC');
define('MAX_USER', '5');
define('MAX_ADMIN_USER', '2');