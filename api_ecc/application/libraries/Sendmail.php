<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPMailer/class.phpmailer.php";

Class Sendmail  {
	function __construct($array=array()){
		
		$this->smtp_host = $array['smtp_host'];
		$this->smtp_port = $array['smtp_port'];
		$this->smtp_user = $array['smtp_user'];
		$this->smtp_pass = $array['smtp_pass'];
		$this->smtp_secure = $array['smtp_secure'];
		$this->smtp_alias = $array['smtp_alias'];
		
		$this->CI =& get_instance();
		
		$this->phpmailer = new PHPMailer();
		$this->phpmailer->IsSMTP();
        $this->phpmailer->SMTPDebug = 1;
        $this->phpmailer->SMTPDebug = false;
        $this->phpmailer->SMTPAuth = true;
        $this->phpmailer->SMTPSecure = $this->smtp_secure;
        $this->phpmailer->Host = $this->smtp_host;
        $this->phpmailer->Port = $this->smtp_port; 
        $this->phpmailer->Username = $this->smtp_user;  
        $this->phpmailer->Password = $this->smtp_pass;
		$this->phpmailer->From = $this->smtp_user;		
        $this->phpmailer->FromName = $this->smtp_alias;
        $this->phpmailer->ClearAddresses();
		$this->phpmailer->IsHTML(TRUE);
				
	}
	
	function send($subject='',$message='',$to=false){	
		if(!$to){
			$to = $this->to;
		}
		
		foreach($to as $a){
			$this->phpmailer->AddAddress($a['email'], $a['name']);
		}
		
		$this->phpmailer->Subject = $subject;
        $this->phpmailer->Body = $message; 
		if($this->phpmailer->Send()){
			return true;
		}else{
			return false;
		}
	}
}
?>