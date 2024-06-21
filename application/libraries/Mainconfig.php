<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mainconfig {
	function __construct(){
		$this->CI =& get_instance();	
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
	
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
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
	
	function get_decimal_format($value,$max_decimal = 12,$fixed=false){
		$value = $value + 0;
		$string = strval($value);
		$get_decimal = explode('.',$string);
				
		if($fixed){
			$return = number_format($value,$max_decimal,'.',',');
		} else {				
			if(isset($get_decimal[1])){
				$get_decimal_digit = rtrim(number_format($value,$max_decimal),0);
				$get_decimal2 = explode('.',$get_decimal_digit);
				
				$decimal_digit = strlen($get_decimal2[1]);
				
				if($decimal_digit > $max_decimal){
					$return = number_format($value,$max_decimal,'.','');
				} else {
					$return = number_format($value,$decimal_digit,'.','');
				}

				$return = $value;
			} else {
				$return = $value;
			}
		}
		
		return $return;
	}
	
	function get_decimal_format2($value,$max_decimal = 12,$fixed=false){
		$value = $value + 0;
		$string = strval($value);
		
		if($fixed){
			$return = number_format($value,$max_decimal,'.','');
		} else {				
			$return = $value + 0;
		}
		
		return $return;
	}
	
	function get_decimal_format3($value,$max_decimal = 12,$fixed=false){
		$value = $value + 0;
		
		if($fixed){
			$return = number_format($value,$max_decimal,'.','');
		} else {				
			$return = $value + 0;
		}
		
		return $return;
	}
	
	function get_decimal_format4($value,$max_decimal = 12,$fixed=false){
		$return = 0;
		
		
		$value = $value + 0;
		
		return $value;
	}
	
	function number_format_string($number) {
		return strrev(implode(',', str_split(strrev($number), 3)));
	}

	function app_config($param = null){
		$data = array();
		$value = false;
	
		$array = array();
		$array['param'] = $param;
		
		$sp = $this->CI->clientapi->app_config($array);
		if(isset($sp->status)){
			if($sp->status == 'success'){
				if(isset($sp->data)){
					$data = $sp->data;
					if($data->value){
						$value = $data->value;
					}
				}					
			}
		}
		
		return $value;
	}

	function get_year_ended($increment = 0){
		$Financial_Year_Ends = $this->app_config('Financial_Year_Ends');
		$DefaultDateFormat = $this->app_config('DefaultDateFormat');
		
		if (Date('m') > $Financial_Year_Ends) {
			$year = Date('Y')+1+$increment;
		} else {
			$year = Date('Y')+$increment;
		}
		
		return mktime(0,0,0,$Financial_Year_Ends+1,0,$year);
	}

	function get_year_budget($year){
		$value = false;
		$next_year = $year + 1;
		
		$this_year_end = $this->get_year_ended($year);
		$next_year_end = $this->get_year_ended($next_year);
		
		$array = array();
		$array['this_year_end'] = $this_year_end;
		$array['next_year_end'] = $next_year_end;
		
		$sp = $this->CI->clientapi->get_year_budget($array);
		if(isset($sp->status)){
			if($sp->status == 'success'){
				if(isset($sp->data)){
					$data = $sp->data;
					if($data->value){
						$value = $data->value;
					}
				}					
			}
		}
		
		return $value;
	}
	
	function create_period($LastPeriodid, $LastPeriodDate){
		if(!$this->check_period($LastPeriodDate)){
			
			$this->CI->rpc_service->setSP("dbo.sp_gl_create_period");
			$this->CI->rpc_service->addField('gl_last_period_id',$LastPeriodid);
			$this->CI->rpc_service->addField('gl_period_start',date('Y-m-01',$LastPeriodDate));
			$this->CI->rpc_service->addField('gl_period_end',date('Y-m-d',$LastPeriodDate));
			
			$result = $this->CI->rpc_service->resultJSON('create_period_'.$LastPeriodDate);
		}
	}
	
	function check_period($date){
		$date = date('Y-m-d',$date);
		
		$value = false;
		
		$array = array();
		$array['date'] = $date;
		
		$sp = $this->CI->clientapi->get_period_by_date($array);
		if(isset($sp->status)){
			if($sp->status == 'success'){
				if(isset($sp->data)){
					$data = $sp->data;
					if($data){
						foreach($data as $dt){
							$value =  true;
						}
					}
				}					
			}
		}
		
		return $value;
	}
	
	function get_periodid($date){
		$date = date('Y-m-d',$date);
		
		$value = false;
		
		$array = array();
		$array['date'] = $date;
		
		$sp = $this->CI->clientapi->get_period_by_date($array);
		if(isset($sp->status)){
			if($sp->status == 'success'){
				if(isset($sp->data)){
					$data = $sp->data;
					if($data){
						foreach($data as $dt){
							$value =  $dt->gl_period_id;
						}
					}
				}					
			}
		}
		
		return $value;
	}
	
	function get_start_period($gl_period_id = 1){
		$value = false;
		
		$array = array();
		$array['gl_period_id'] = $gl_period_id;
		
		$sp = $this->CI->clientapi->get_period($array);
		if(isset($sp->status)){
			if($sp->status == 'success'){
				if(isset($sp->data)){
					$data = $sp->data;
					if($data){
						foreach($data as $dt){
							$value =  strtotime($dt->gl_period_start);
						}
					}
				}					
			}
		}
		
		return $value;
	}
	
	function get_end_period($gl_period_id = 1){
		$value = false;
		
		$array = array();
		$array['gl_period_id'] = $gl_period_id;
		
		$sp = $this->CI->clientapi->get_period($array);
		if(isset($sp->status)){
			if($sp->status == 'success'){
				if(isset($sp->data)){
					$data = $sp->data;
					if($data){
						foreach($data as $dt){
							$value =  strtotime($dt->gl_period_end);
						}
					}
				}					
			}
		}
		
		return $value;
	}
	
	function get_first_period(){
		$value = false;
		
		$array = array();
		$array['gl_period_id'] = 1;
		
		$sp = $this->CI->clientapi->get_period($array);
		if(isset($sp->status)){
			if($sp->status == 'success'){
				if(isset($sp->data)){
					$data = $sp->data;
					if($data){
						foreach($data as $dt){
							$value =  $dt->gl_period_id;
						}
					} else {
						$LastPeriodDate = mktime(0,0,0,Date('m')+1, 0, Date('Y'));
						$value = $this->create_period(1, $LastPeriodDate);
					}
				}					
			}
		}
		
		return $value;
	}
	
	function get_last_period(){
		$value = false;
		
		$array = array();
		$array['gl_period_id'] = -1;
		$array['last'] = 1;
		
		$sp = $this->CI->clientapi->get_period($array);
		if(isset($sp->status)){
			if($sp->status == 'success'){
				if(isset($sp->data)){
					$data = $sp->data;
					if($data){
						foreach($data as $dt){
							$value =  $dt->gl_period_id;
						}
					}
				}					
			}
		}
		
		return $value;
	}
	
	function get_period ($date){
		$DefaultDateFormat = $this->app_config('DefaultDateFormat');
		$ProhibitPostingsBefore = $this->app_config('ProhibitPostingsBefore');
		$Periodid = 0;
		
		if (mb_strpos($date,'/')) {
			$date_array = explode('/',$date);
			$date_format_array = explode('/',$DefaultDateFormat);
		} elseif (mb_strpos ($date,'-')) {
			$date_array = explode('-',$date);
			$date_format_array = explode('-',$DefaultDateFormat);
		} elseif (mb_strpos ($date,'.')) {
			$date_array = explode('.',$date);
			$date_format_array = explode('.',$DefaultDateFormat);
		} 
		
		foreach($date_format_array as $key => $value){
			if($value == 'm'){
				$date_pos[0] = $date_array[$key];
			} elseif($value == 'd'){
				$date_pos[1] = $date_array[$key];
			} elseif($value == 'Y'){
				$date_pos[2] = $date_array[$key];
			} 
		}
		
		$transdate = mktime(0,0,0,$date_pos[0],$date_pos[1],$date_pos[2]);
		$ProhibitPostingsDate = $this->get_start_period($ProhibitPostingsBefore);
		
		$FirstPeriodid = $this->get_first_period();
		$LastPeriodid = $this->get_last_period();
		
		$FirstPeriodDate = $this->get_end_period($FirstPeriodid);
		$LastPeriodDate = $this->get_end_period($LastPeriodid);
				
		$exist_period = $this->check_period($transdate);
		if(!$exist_period){
			if ($transdate > $LastPeriodDate) {
				$PeriodEnd = mktime(0,0,0,Date('m', $transdate), 0, Date('Y', $transdate));
		
				while ($PeriodEnd >= $LastPeriodDate) {
					if (Date('m', $LastPeriodDate)<=13) {
						$LastPeriodDate = mktime(0,0,0,Date('m', $LastPeriodDate)+2, 0, Date('Y', $LastPeriodDate));
					} else {
						$LastPeriodDate = mktime(0,0,0,2, 0, Date('Y', $LastPeriodDate)+1);
					}
					$LastPeriodid++;
					$this->create_period($LastPeriodid, $LastPeriodDate);
				}
				
			} else {
				$PeriodEnd = mktime(0,0,0,Date('m', $transdate)+1, 0, Date('Y', $transdate));
				while ($FirstPeriodDate > $PeriodEnd) {
					
					$FirstPeriodid--;
					if (Date('m', $FirstPeriodDate)>0) {
						$FirstPeriodDate = mktime(0,0,0,Date('m', $FirstPeriodDate), 0, Date('Y', $FirstPeriodDate));
					} else {
						$FirstPeriodDate = mktime(0,0,0,13, 0, Date('Y', $FirstPeriodDate));
					}
					$this->create_period($FirstPeriodid, $FirstPeriodDate);
				}
			}
		}
		
		return $this->get_periodid($transdate);
	}
	
	function get_month_text($month){
		switch ($month) {
			case '01':
				$text ='January';
				break;
			case '02':
				$text ='February';
				break;
			case '03':
				$text ='March';
				break;
			case '04':
				$text ='April';
				break;
			case '05':
				$text ='May';
				break;
			case '06':
				$text ='June';
				break;
			case '07':
				$text ='July';
				break;
			case '08':
				$text ='August';
				break;
			case '09':
				$text ='September';
				break;
			case '10':
				$text ='October';
				break;
			case '11':
				$text ='November';
				break;
			case '12':
				$text ='December';
				break;
			default:
				$text ='error';
				break;
		}
		return $text;
	}
	
      function fractionToDecimal($fraction) 
        {
            // Split fraction into whole number and fraction components
            preg_match('/^(?P<whole>\d+)?\s?((?P<numerator>\d+)\/(?P<denominator>\d+))?$/', $fraction, $components);
            
            // Extract whole number, numerator, and denominator components
			//sscanf($fraction, "%d/%d", $numerator, $denominator);
            $whole = $components['whole'] ?: 0;
            $numerator = $components['numerator'] ?: 0;
            $denominator = $components['denominator'] ?: 0;
            
            // Create decimal value
            $decimal = $whole;
            $numerator && $denominator && $decimal += ($numerator/$denominator);
            
            return $decimal;
        }

      function decimalToFraction($decimal) 
      {
          // Determine decimal precision and extrapolate multiplier required to convert to integer
          $precision = strpos(strrev($decimal), '.') ?: 0;
          $multiplier = pow(10, $precision);
          
          // Calculate initial numerator and denominator
          $numerator = $decimal * $multiplier;
          $denominator = 1 * $multiplier;
          
          // Extract whole number from numerator
          $whole = floor($numerator / $denominator);
          $numerator = $numerator % $denominator;
          
          // Find greatest common divisor between numerator and denominator and reduce accordingly
          $factor = gmp_intval(gmp_gcd($numerator, $denominator));
          $numerator /= $factor;
          $denominator /= $factor;
          
          // Create fraction value
          $fraction = [];
          $whole && $fraction[] = $whole;
          $numerator && $fraction[] = "{$numerator}/{$denominator}";
          
          return implode(' ', $fraction);
      }
	
	
}

?>