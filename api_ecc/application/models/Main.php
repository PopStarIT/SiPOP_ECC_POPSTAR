<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Main extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->db_sp = $this->load->database('sp',TRUE);
	}
	
	function mssql_escape($str){
		if(get_magic_quotes_gpc()) {
			$str= stripslashes($str);
		}
		return str_replace("'", "''", $str);
	}
	
	function audit($type='',$table='',$data=array(),$where=array(),$note=null,$set=array()){
		$userid = $this->session->userdata('userid');
		switch($type){
			case 'update': //Query Update
				foreach($set as $k=>$v){
					$this->db->set($k, $k."+".$v, FALSE);
				}
				$this->db->where($where);
				$this->db->update($table, $data); 
						
				break; // End Update
				
			case 'delete': //Query Delete
				
				// foreach($where as $key=>$value){
					// if(is_array($value)){
						// $first = true;
						// foreach($value as $val){
							// if($first){
								// $this->db->where($key,$val);
								// $first = false;
							// } else {
								// $this->db->or_where($key,$val);
							// }
						// }
					// } else {
						// $this->db->where($key,$value);
					// }
				// }
				foreach($where as $key=>$value){
					if(is_array($value)){
						$this->db->where_in($key,$value);	
					} else {
						$this->db->where($key,$value);
					}
				}
				$this->db->delete($table); 
								
				break; // End Delete

			case 'insert':
				$this->db->insert($table, $data);
				return $this->db->insert_id();
				break;
				
			case 'insert_batch':
				$this->db->insert_batch($table, $data);
				break;
		}
		
		$query = $this->db->last_query();
		
		$log_data = array(
		   'date' => date('Y-m-d H:i:s') ,
		   'tbl' => $table ,
		   'type' => $type ,
		   'query' => $query,
		   'note' => $note,
		   'userid' => $userid
		);

		//$this->db->insert('log_query', $log_data); 
		
	}
	function insert($table, $data=array(), $note=null){
		return $this->audit('insert',$table,$data,null,$note);	
	}
	
	function insert_batch($table, $data=array(), $note=null){
		$this->audit('insert_batch',$table,$data,null,$note);	
	}
	
	function update($table,$data=array(),$where=array(),$note=null,$set=array()){
		$this->audit('update',$table,$data,$where,$note,$set);	
	}
	
	function delete($table,$where=array(),$note=null){
		$this->audit('delete',$table,null,$where,$note);
	}
	
	function sp($sp, $param=array()){
		
		$parameter = array();
		foreach($param as $dt_param){
			if($dt_param == NULL){
				$parameter[] = 'NULL';
			} elseif(is_array($dt_param)) {
				$array_param = array();
				foreach($dt_param as $dt_array){
					$array_param[] = trim($dt_array);
				}
				$parameter[] = "'".json_encode($array_param)."'";
			} else {
				$parameter[] = "'". $dt_param ."'";
			}
		}
		
		$sql = "exec ".$sp."(";
		$sql .= implode(',',$parameter);
		$sql .= ")";
		$query = $this->db_sp->query($sql);
		
		if($this->db_sp->_error_number()){
			$return = new StdClass();
			$return->valid = 'false';
			$return->message = $this->db_sp->_error_message();
			return array($return);
		} else {
			if($query->num_rows() > 0){
				return $query->result();
			} else {
				return false;
			}
		}	
		
	}
	
	function extractarray($array = array(), $returnarray = array()){
		foreach($array as $key => $value){
			if($value == NULL){
				$returnarray[$key] = NULL;
			} elseif(is_array($value)) {
				$returnarray[$key] = $this->extractarray($value);
			} else {
				$returnarray[$key] = "'".htmlentities($value, ENT_QUOTES)."'";
			}
		}
		
		return $returnarray;
	}
	
	function executeSP($sp, $param = null, $type='default', $field_data = false){
		
		$parameter = "";
		if($param){
			foreach($param as $data){
				$parameter .= "'".$data ."',";
			}
			$parameter = trim($parameter,",");
		}
			
		$query = $this->db_sp->query("exec ".$sp." ".$parameter);
		
		$error = $this->db_sp->error();
		
		if($error['code'] !== '00000'){
			$return = new StdClass();
			$return->valid = 'false';
			$return->message = $error['message'];
			return array($return);
		} else {
			
			if($query->num_rows() > 0){
				if($field_data){
					$return['rows'] = $query->result_array();
					$return['field_data'] = $query->field_data();
							
					return $return;
				} else {
					$result_array = $query->result_array();
					// $query->next_result();
					// $query->free_result();
					
					return $result_array;
				}
			} else {
				$return = new StdClass();
				$return->valid = 'false';
				$return->message = $error['message'];
				return array($return);
			}
		}
	}
	
	function getData($table,$key=null,$where=null,$group=null,$order=null,$limit=null,$offset=0){
		$this->db->select('*');
		$this->db->from($table);
		
		if(isset($key)){
			$this->db->where('id', $key);
		}
		
		if(isset($where)){
			foreach($where as $key=>$value){
				if(is_array($value)){
					$this->db->where_in($key,$value);	
				} else {
					$this->db->where($key,$value);
				}
			}
		}
		
		if(isset($group)){
			$this->db->group_by($group); 
		}
		
		if(isset($order)){
			if(is_array($order)){
				$order = implode(',',$order);
			} 
			
			$this->db->order_by($order);
		}
		
		if(isset($limit)){
			$this->db->limit($limit,$offset);
		}
		
		$query = $this->db->get();
		
		// if(($limit) && $offset > 0){
			
			// $last_query = $this->db->last_query();
			// $replace_query = trim($last_query,"SELECT TOP");
			// $replace_query = trim($replace_query);
			// $limit2 = $limit + $offset;
			// $replace_query = trim($replace_query,$limit2);
			
			// $sql = "SELECT * FROM ( ";
			// $sql .= "SELECT ";
			// $sql .= "TOP ".$limit2." ROW_NUMBER() OVER (ORDER BY ".$order.") as row,";
			// $sql .= $replace_query;
			// $sql .= " ) a";
			// $sql .= " WHERE a.row > ".$offset." and a.row <= ".$limit2."";
			
			// $query = $this->db->query($sql);		
		// }
		
		$error = $this->db->error();
		if($error['code'] !== '00000'){
			$return = new StdClass();
			$return->valid = 'false';
			$return->message = $error['message'];
			return array($return);
		} else {
			if($query->num_rows() > 0){
				return $query->result_array();
			} else {
				return false;
			}
		}
	}
	
	function countData($table,$where=null,$group=null){
		$return = 0;
		
		$this->db->select('count(*) cnt');
		$this->db->from($table);
		
		if(isset($where)){
			$this->db->where($where);
		}
		
		if(isset($group)){
			$this->db->group_by($group); 
		}
		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach($query->result() as $data){
				$return = $data->cnt;
			}
		} 
		
		return $return;
	}
}

?>