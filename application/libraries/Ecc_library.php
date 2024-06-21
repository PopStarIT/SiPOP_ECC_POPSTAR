<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ecc_library {
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->model('main');	


		$config = $this->CI->config->config;
	    $this->base_config = $config['base_config'];
		//$this->base_config = 'base_config.json';
		$this->dir_template = "template";
		$this->template = $this->base_config['template'];
		$this->path_template = $this->dir_template ."/".$this->template;
	}
	
	function form($form_type=false,$form_label=false,$form_id=false,$form_param=false,$form_value=false,$form_default=false,$form_param_key_1=false,$extra_data=array()){
		$data = array();
		$data['form_type'] = $form_type;
		$data['form_label'] = $form_label;
		$data['form_id'] = $form_id;
		$data['form_param'] = $form_param;
		$data['form_value'] = $form_value;
		$data['form_default'] = $form_default;
		$data['form_param_key_1'] = $form_param_key_1;
		$data['form_param_key_1'] = $form_param_key_1;
		$data['extra_data'] = $extra_data;
		//print_r($data);
		$this->CI->load->view($this->path_template.'/library/content/form',$data);
	}
	
	function form2($form_type=false,$form_label=false,$form_id=false,$form_param=false,$form_value=false,$form_default=false,$form_param_key_1=false,$form_param_key_2=false,$extra_data=array()){
		$data = array();
		$data['form_type'] = $form_type;
		$data['form_label'] = $form_label;
		$data['form_id'] = $form_id;
		$data['form_param'] = $form_param;
		$data['form_value'] = $form_value;
		$data['form_default'] = $form_default;
		$data['form_param_key_1'] = $form_param_key_1;
		$data['form_param_key_2'] = $form_param_key_2;
		$data['extra_data'] = $extra_data;
		//print_r($data);
		$this->CI->load->view($this->path_template.'/library/content/form',$data);
	}
	
	function jqgrid($table_id,$field,$loaddata,$extra_data=array()){
		$data = array();
		//var_dump($table_id);
		$data['table_id'] = $table_id;
		$data['extra_data'] = $extra_data;
		$data['field'] = $field;
		$data['loaddata'] = $loaddata;
		
		$this->CI->load->view($this->path_template.'/library/content/dashboard_table_jqgrid',$data);
	}
	
	function loaddata($view,$field,$where=array(),$group=false,$order=array(),$limit=false,$offset=false){
		$rows = array();
		
		$user_id = $this->CI->session->userdata('user_id');
		$offset = isset($_REQUEST['start']) ? htmlentities($_REQUEST['start']) : 0;
		$columns = isset($_REQUEST['columns']) ? $_REQUEST['columns'] : array();
		
		$data_where_from_table = array();
		foreach($columns as $key => $value){
			if(isset($value['search']['value'])){
				if(strlen(trim($value['search']['value'])) > 0){
					if(isset($field[$key]['data_type'])){
						if($field[$key]['data_type'] == 'date'){
							if($this->validateDate($value['search']['value'])){
								$data_where_from_table[] = "(". $field[$key]['field'] ." = '". $value['search']['value'] ."')";
							}
						} else {
							$data_where_from_table[] = "(". $field[$key]['field'] ." like '%". $value['search']['value'] ."%')";
						}
					} else {
						$data_where_from_table[] = "(". $field[$key]['field'] ." like '%". $value['search']['value'] ."%')";
					}
					
					
				}
			}
		}
		
		$where_from_table = implode(" AND ",$data_where_from_table);
		if($where_from_table){
			$where[$where_from_table." AND 1="] = 1;
		}
		
		if(!$limit){
			$limit = isset($_REQUEST['length']) ? htmlentities($_REQUEST['length']) : 10;
		}
		
		if(!$order){
			$order = isset($_REQUEST['order']) ? $_REQUEST['order'] : array();
		}
		$draw = isset($_REQUEST['draw']) ? $_REQUEST['draw'] :1;
		
		if($limit == -1){
			$limit = null;
		}
		
		$sort =	false;	
		foreach($order as $key => $value){
			if($sort){
				$sort .= $field[$value['column']]['field'] . " ".$value['dir'] .",";
			} else {
				$sort = $field[$value['column']]['field'] . " ".$value['dir'] .",";
			}		
		}
		
		if($sort){
			$sort = rtrim($sort, ',');
		}
		
		$count = $this->CI->main->countData($view,$where) * 1;
		
		if($count > 0) {
			$data = $this->CI->main->getData($view, null, $where, null, $sort, $limit, $offset);
			if($data){
				foreach($data as $dt){
					$row = array();			
					foreach($field as $k=>$v){
						
						if(isset($v['data_type'])){
							switch($v['data_type']){
								case 'decimal':
									$row[] =  $this->CI->mainconfig->get_decimal_format($dt[$v['field']],$v['decimal_digit']);
								break;
								
								default:
									$row[] =  $dt[$v['field']];
								break;
							}					
						} else {
							if(is_numeric($dt[$v['field']])){
								$row[] =  $dt[$v['field']];
								// $row[] = $this->CI->mainconfig->get_decimal_format($dt[$v['field']],4);
							} else {
								$row[] =  $dt[$v['field']];
							}
						}	
					}
					$rows[] = $row;
				}
			}
		} else {
			$data = false;
		}

		$return['status'] = 'success';
		$return['draw'] = $draw;
		$return['data'] = $rows;
		$return['recordsFiltered'] = $count;
		$return['recordsTotal'] = $count;

		return $return;
		
	}
	
	function loaddata_pop($view,$field,$where=array(),$group=false,$order=array(),$limit=false,$offset=false){
		$rows = array();
		
		$user_id = $this->CI->session->userdata('user_id');
		$offset = isset($_REQUEST['start']) ? htmlentities($_REQUEST['start']) : 0;
		$columns = isset($_REQUEST['columns']) ? $_REQUEST['columns'] : array();
		
		$data_where_from_table = array();
		foreach($columns as $key => $value){
			if(isset($value['search']['value'])){
				if(strlen(trim($value['search']['value'])) > 0){
					if(isset($field[$key]['data_type'])){
						if($field[$key]['data_type'] == 'date'){
							if($this->validateDate($value['search']['value'])){
								$data_where_from_table[] = "(". $field[$key]['field'] ." = '". $value['search']['value'] ."')";
							}
						} else {
							$data_where_from_table[] = "(". $field[$key]['field'] ." like '%". $value['search']['value'] ."%')";
						}
					} else {
						$data_where_from_table[] = "(". $field[$key]['field'] ." like '%". $value['search']['value'] ."%')";
					}
					
					
				}
			}
		}
		
		$where_from_table = implode(" AND ",$data_where_from_table);
		if($where_from_table){
			$where[$where_from_table." AND 1="] = 1;
		}
		
		if(!$limit){
			$limit = isset($_REQUEST['length']) ? htmlentities($_REQUEST['length']) : 10;
		}
		
		if(!$order){
			$order = isset($_REQUEST['order']) ? $_REQUEST['order'] : array();
		}
		$draw = isset($_REQUEST['draw']) ? $_REQUEST['draw'] :1;
		
		if($limit == -1){
			$limit = null;
		}
		
		$sort =	false;	
		foreach($order as $key => $value){
			if($sort){
				$sort .= $field[$value['column']]['field'] . " ".$value['dir'] .",";
			} else {
				$sort = $field[$value['column']]['field'] . " ".$value['dir'] .",";
			}		
		}
		
		if($sort){
			$sort = rtrim($sort, ',');
		}
		
		$count = $this->CI->main->countData_pop($view,$where) * 1;
		
		if($count > 0) {
			$data = $this->CI->main->getData_pop($view, null, $where, null, $sort, $limit, $offset);
			if($data){
				foreach($data as $dt){
					$row = array();			
					foreach($field as $k=>$v){
						
						if(isset($v['data_type'])){
							switch($v['data_type']){
								case 'decimal':
									$row[] =  $this->CI->mainconfig->get_decimal_format($dt[$v['field']],$v['decimal_digit']);
								break;
								
								default:
									$row[] =  $dt[$v['field']];
								break;
							}					
						} else {
							if(is_numeric($dt[$v['field']])){
								$row[] =  $dt[$v['field']];
								// $row[] = $this->CI->mainconfig->get_decimal_format($dt[$v['field']],4);
							} else {
								$row[] =  $dt[$v['field']];
							}
						}	
					}
					$rows[] = $row;
				}
			}
		} else {
			$data = false;
		}

		$return['status'] = 'success';
		$return['draw'] = $draw;
		$return['data'] = $rows;
		$return['recordsFiltered'] = $count;
		$return['recordsTotal'] = $count;

		return $return;
		
	}
	
	function validateDate($date, $format = 'Y-m-d'){
		$d = DateTime::createFromFormat($format, $date);
		// The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
		return $d && $d->format($format) === $date;
	}

	function session(){
		$session = array();
		$session[] = 'purchase_request';
		
		$session_list = array();
	}
	
	function get_field($view){
		$return = array();
		
		$sp = "dbo.sp_ecc_load_view_field";
		//$this->CI->rpc_service_portal->setSP($sp);
		//$this->CI->rpc_service_portal->addField('view',$view);
		//$result = $this->CI->rpc_service_portal->resultJSON();	
		$this->CI->rpc_service->setSP($sp);
		$this->CI->rpc_service->addField('view',$view);
		$result = $this->CI->rpc_service->resultJSON();
				
		$data_result = json_decode($result['data'],true);
		//var_dump($data_result['xrow']);die();
		if($data_result){
			if(isset($data_result['xrow'])){
			
				foreach($data_result['xrow'] as $key=>$value){
					$data = array();
					if($value['udt_name'] == 'date' || $value['udt_name'] == 'timestamp'){
						$ctype = 'date';
						$align = 'center';
					} elseif($value['udt_name'] == 'numeric' || $value['udt_name'] == 'int2' || $value['udt_name'] == 'int4' || $value['udt_name'] == 'int8'){
						$ctype = 'int';
						$align = 'right';
						$data['formatter'] = 'formatNumerics';
					} else {
						$ctype = 'text';
						$align = 'left';
					}
					
					
					$data['sc'] = 'r'.$value['ordinal_position'];
					$data['ctype'] = $ctype;
					$data['bypassvalue'] = '';
					$data['title'] = $value['column_name'];
					$data['align'] = $align;
					
					
					$return['r'.$value['ordinal_position']] = $data;
				}
			}
		}
		
		return $return;
	}
	
  	function get_field_pop($view){
		$return = array();
		
		$sp = "dbo.sp_ecc_load_view_field";
		//$this->CI->rpc_service_portal->setSP($sp);
		//$this->CI->rpc_service_portal->addField('view',$view);
		//$result = $this->CI->rpc_service_portal->resultJSON();	
		//$this->CI->rpc_service->setPOP($sp);
		$this->CI->rpc_service->setSP($sp);
		$this->CI->rpc_service->addField('view',$view);
		$result = $this->CI->rpc_service->resultJSON_pop();
		//var_dump($view);
		
		$data_result = json_decode($result['data'],true);
		if($data_result){
			if(isset($data_result['xrow'])){
				foreach($data_result['xrow'] as $key=>$value){
					$data = array();
					if($value['udt_name'] == 'date' || $value['udt_name'] == 'timestamp'){
						$ctype = 'date';
						$align = 'center';
					} elseif($value['udt_name'] == 'numeric' || $value['udt_name'] == 'int2' || $value['udt_name'] == 'int4' || $value['udt_name'] == 'int8'){
						$ctype = 'int';
						$align = 'right';
						$data['formatter'] = 'formatNumerics';
					} else {
						$ctype = 'text';
						$align = 'left';
					}
					
					
					$data['sc'] = 'r'.$value['ordinal_position'];
					$data['ctype'] = $ctype;
					$data['bypassvalue'] = '';
					$data['title'] = $value['column_name'];
					$data['align'] = $align;
					
					
					$return['r'.$value['ordinal_position']] = $data;
				}
			}
		}
		
		return $return;
	}
	
	function get_field_data($view,$field,$extra_param=array()){
		$this->CI->authentication->plainlayout();
		$return = array();
		
		$page = isset($_POST['page'])?$_POST['page']:1; // get the requested page 
        $rows = isset($_POST['rows'])?$_POST['rows']:10; // get how many rows we want to have into the grid 
        $sidx = isset($_POST['sidx'])?$_POST['sidx']:'r1'; // get index row - i.e. user click to sort 
        $sord = isset($_POST['sord'])?$_POST['sord']:'desc'; // get the direction 
		$search = isset($_REQUEST['_search'])?$_REQUEST['_search']:false; 
		$filterRules =  isset($_POST['filters'])?$_POST['filters']:false;
		
		$decode_filterRules = json_decode($filterRules,true);
		if(isset($decode_filterRules)){
			if(isset($decode_filterRules['rules'])){
				$rules = $decode_filterRules['rules'];
			} else {
				$rules = array();
			}
		} else {
			$decode_filterRules['groupOp'] = 'AND';
			$rules = array();
		}
	
		if(isset($extra_param['where'])){
			foreach($extra_param['where'] as $dt_where){
				$have_key = false;
				
				foreach($rules as $key => $value){
					if($value['field'] == $dt_where['field']){
						$have_key = true;
						$rules[$key]['data'] = $dt_where['data'];
					
						break;
					}
				}
				
				if(!$have_key){
					$data_where = array();
					$data_where['field'] = $dt_where['field'];
					$data_where['op'] = 'eq';
					$data_where['data'] = $dt_where['data'];
					$rules[] = $data_where;
					
				}
			}
		}
	
		$decode_filterRules['rules'] = $rules;
		$filterRules = json_encode($decode_filterRules);
		
		$limit =  $rows;
		$offset =  $rows * ($page - 1);
		
		$order = isset($_REQUEST['order']) ? $_REQUEST['order'] : array();
		
		if($sord == 'asc'){
			$sord = 1;
		} else {
			$sord = 2;
		}
		
		$sort =	$sidx. '='.$sord;	
					
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";	
				
				
		$sp = "dbo.sp_ecc_load_view_data";		
		
		//$this->CI->rpc_service_portal->setSP($sp);
		//$this->CI->rpc_service_portal->addField('view',$view);
		//$this->CI->rpc_service_portal->addField('sort',$sort);
		//$this->CI->rpc_service_portal->addField('limit',$limit);
		//$this->CI->rpc_service_portal->addField('offset',$offset);
		//$this->CI->rpc_service_portal->setWhere($search,$filterRules,$field);
		//$result = $this->CI->rpc_service_portal->resultJSON();

        $this->CI->rpc_service->setSP($sp);
		$this->CI->rpc_service->addField('view',$view);
		$this->CI->rpc_service->addField('sort',$sort);
		$this->CI->rpc_service->addField('limit',$limit);
		
		$this->CI->rpc_service->addField('offset',$offset);
		$this->CI->rpc_service->setWhere($search,$filterRules,$field);
		
		$result = $this->CI->rpc_service->resultJSON();	
		
		$data_result = json_decode($result['data'],true);
		
		if(isset($data_result['detail']['result_count'])){
			$records = $data_result['detail']['result_count'];
			$total = ceil($data_result['detail']['result_count'] / $limit);
		} else {
			$records = 0;
			$total = 0;
		}
		
		$responce = new stdclass();
		$responce->page = $page;
		$responce->records = $records;
		$responce->total = $total;
		$i=0; 
		if($data_result){
			if(isset($data_result['xrow'])){
				foreach($data_result['xrow'] as $key=>$value){
					if(isset($extra_param['methodid'])){
						$responce->rows[$i]['methodid'] = $extra_param['methodid'];
					}
					
					foreach ($value as $k => $v) {
						$responce->rows[$i][$k] = $v;
					} 
					
					
					if(isset($extra_param['field'])){
						foreach($extra_param['field'] as $dt_field_key => $dt_field_value){
							$responce->rows[$i][$dt_field_key] = $dt_field_value;
						}
					}
					
					$i++;
				}
			}
		}
		
		if(isset($extra_param['sp_sum'])){
			$userdata = $this->get_field_data_sum($extra_param['sp_sum'],$field,$extra_param);
			foreach($field as $key => $value){
				if(isset($value['footer'])){
					if($value['footer'] != 'sum'){
						$userdata->$key = $value['footer'];
					} else {
						if(!isset($userdata->$key)){
							$userdata->$key = 0;
						}
					}
				}
			}
			$responce->userdata = $userdata; 
		}
		
	
		
		$return = json_encode($responce);
	
		
		return $return;
	}	
	
function get_field_data_pop($view2,$field,$extra_param=array()){
		$this->CI->authentication->plainlayout();
		$return = array();
		
		$page = isset($_POST['page'])?$_POST['page']:1; // get the requested page 
        $rows = isset($_POST['rows'])?$_POST['rows']:10; // get how many rows we want to have into the grid 
        $sidx = isset($_POST['sidx'])?$_POST['sidx']:'r1'; // get index row - i.e. user click to sort 
        $sord = isset($_POST['sord'])?$_POST['sord']:'desc'; // get the direction 
		$search = isset($_REQUEST['_search'])?$_REQUEST['_search']:false; 
		$filterRules =  isset($_POST['filters'])?$_POST['filters']:false;
		
		$decode_filterRules = json_decode($filterRules,true);
		if(isset($decode_filterRules)){
			if(isset($decode_filterRules['rules'])){
				$rules = $decode_filterRules['rules'];
			} else {
				$rules = array();
			}
		} else {
			$decode_filterRules['groupOp'] = 'AND';
			$rules = array();
		}
			
		if(isset($extra_param['where'])){
			foreach($extra_param['where'] as $dt_where){
				$have_key = false;
					
				foreach($rules as $key => $value){
					if($value['field'] == $dt_where['field']){
						$have_key = true;
						$rules[$key]['data'] = $dt_where['data'];
						break;
					}
				
				}
				
				if(!$have_key){
					$data_where = array();
					$data_where['field'] = $dt_where['field'];
					$data_where['op'] = 'eq';
					$data_where['data'] = $dt_where['data'];
					$rules[] = $data_where;
				}
			}
		}
		//var_dump($rules);
		$decode_filterRules['rules'] = $rules;
		$filterRules = json_encode($decode_filterRules);
		
		$limit =  $rows;
		$offset =  $rows * ($page - 1);
		
		$order = isset($_REQUEST['order']) ? $_REQUEST['order'] : array();
		
		if($sord == 'asc'){
			$sord = 1;
		} else {
			$sord = 2;
		}
		
		$sort =	$sidx. '='.$sord;	
					
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";	
				
				
		$sp = "dbo.sp_ecc_load_view_data";	
    		
		//$this->CI->rpc_service_portal->setSP($sp);
		//$this->CI->rpc_service_portal->addField('view',$view);
		//$this->CI->rpc_service_portal->addField('sort',$sort);
		//$this->CI->rpc_service_portal->addField('limit',$limit);
		//$this->CI->rpc_service_portal->addField('offset',$offset);
		//$this->CI->rpc_service_portal->setWhere($search,$filterRules,$field);
		//$result = $this->CI->rpc_service_portal->resultJSON();
        //$this->CI->rpc_service->setPOP($sp);
	    $this->CI->rpc_service->setSP($sp);
      //  $this->CI->rpc_service->setSP($sp);
		$this->CI->rpc_service->addField('view',$view2);
		$this->CI->rpc_service->addField('sort',$sort);
		$this->CI->rpc_service->addField('limit',$limit);
		
		$this->CI->rpc_service->addField('offset',$offset);
		$this->CI->rpc_service->setWhere($search,$filterRules,$field);
		
		//$result = $this->CI->rpc_service->resultJSON();	
		$result = $this->CI->rpc_service->resultJSON_pop();
		
		$data_result = json_decode($result['data'],true);
		//var_dump($data_result['xrow']);
		
		if(isset($data_result['detail']['result_count'])){
			$records = $data_result['detail']['result_count'];
			$total = ceil($data_result['detail']['result_count'] / $limit);
		} else {
			$records = 0;
			$total = 0;
		}
		
		$responce = new stdclass();
		$responce->page = $page;
		$responce->records = $records;
		$responce->total = $total;
		$i=0; 
		if($data_result){
			if(isset($data_result['xrow'])){
				foreach($data_result['xrow'] as $key=>$value){
					if(isset($extra_param['methodid'])){
						$responce->rows[$i]['methodid'] = $extra_param['methodid'];
					}
					
					foreach ($value as $k => $v) {
						     	$responce->rows[$i][$k] = $v;
					} 
										
					if(isset($extra_param['field'])){
						foreach($extra_param['field'] as $dt_field_key => $dt_field_value){
							//var_dump($dt_field_value);
							$responce->rows[$i][$dt_field_key] = $dt_field_value;
						}
					}
					
					$i++;
				}
			}
		}
		
		if(isset($extra_param['sp_sum'])){
			$userdata = $this->get_field_data_sum($extra_param['sp_sum'],$field,$extra_param);
			foreach($field as $key => $value){
				if(isset($value['footer'])){
					if($value['footer'] != 'sum'){
						$userdata->$key = $value['footer'];
					} else {
						if(!isset($userdata->$key)){
							$userdata->$key = 0;
						}
					}
				}
			}
			$responce->userdata = $userdata; 
		}
		
	
		
		$return = json_encode($responce);
	
		
		return $return;
	}

function get_field_data_pop_spec($view2,$field,$extra_param=array()){
		$this->CI->authentication->plainlayout();
		$return = array();
		
		$page = isset($_POST['page'])?$_POST['page']:1; // get the requested page 
        $rows = isset($_POST['rows'])?$_POST['rows']:10; // get how many rows we want to have into the grid 
        $sidx = isset($_POST['sidx'])?$_POST['sidx']:'r1'; // get index row - i.e. user click to sort 
        $sord = isset($_POST['sord'])?$_POST['sord']:'desc'; // get the direction 
		$search = isset($_REQUEST['_search'])?$_REQUEST['_search']:false; 
		$filterRules =  isset($_POST['filters'])?$_POST['filters']:false;
		
		$decode_filterRules = json_decode($filterRules,true);
		if(isset($decode_filterRules)){
			if(isset($decode_filterRules['rules'])){
				$rules = $decode_filterRules['rules'];
			} else {
				$rules = array();
			}
		} else {
			$decode_filterRules['groupOp'] = 'AND';
			$rules = array();
		}
			
		if(isset($extra_param['where'])){
			foreach($extra_param['where'] as $dt_where){
				$have_key = false;
					
				foreach($rules as $key => $value){
					if($value['field'] == $dt_where['field']){
						$have_key = true;
						$rules[$key]['data'] = $dt_where['data'];
						break;
					}
				
				}
				
				if(!$have_key){
					$data_where = array();
					$data_where['field'] = $dt_where['field'];
					$data_where['op'] = 'eq';
					$data_where['data'] = $dt_where['data'];
					$rules[] = $data_where;
				}
			}
		}
		//var_dump($rules);
		$decode_filterRules['rules'] = $rules;
		$filterRules = json_encode($decode_filterRules);
		
		$limit =  $rows;
		$offset =  $rows * ($page - 1);
		
		$order = isset($_REQUEST['order']) ? $_REQUEST['order'] : array();
		
		if($sord == 'asc'){
			$sord = 1;
		} else {
			$sord = 2;
		}
		
		$sort =	$sidx. '='.$sord;	
					
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";	
				
				
		$sp = "dbo.sp_ecc_load_view_data";	
    		
		//$this->CI->rpc_service_portal->setSP($sp);
		//$this->CI->rpc_service_portal->addField('view',$view);
		//$this->CI->rpc_service_portal->addField('sort',$sort);
		//$this->CI->rpc_service_portal->addField('limit',$limit);
		//$this->CI->rpc_service_portal->addField('offset',$offset);
		//$this->CI->rpc_service_portal->setWhere($search,$filterRules,$field);
		//$result = $this->CI->rpc_service_portal->resultJSON();
        //$this->CI->rpc_service->setPOP($sp);
	    $this->CI->rpc_service->setSP($sp);
      //  $this->CI->rpc_service->setSP($sp);
		$this->CI->rpc_service->addField('view',$view2);
		$this->CI->rpc_service->addField('sort',$sort);
		$this->CI->rpc_service->addField('limit',$limit);
		
		$this->CI->rpc_service->addField('offset',$offset);
		$this->CI->rpc_service->setWhere($search,$filterRules,$field);
		
		//$result = $this->CI->rpc_service->resultJSON();	
		$result = $this->CI->rpc_service->resultJSON_pop();
		
		$data_result = json_decode($result['data'],true);
		//var_dump($data_result['xrow']);
		
		if(isset($data_result['detail']['result_count'])){
			$records = $data_result['detail']['result_count'];
			$total = ceil($data_result['detail']['result_count'] / $limit);
		} else {
			$records = 0;
			$total = 0;
		}
		
		$data_arr=array();
		//$alphabet=array(0=>'A',1=>'B',2=>'C',3=>'D',4=>'E',5=>'F',6=>'G',7=>'H',8=>'I',9=>'J',10=>'K');
		$alphabet=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH');
		$responce = new stdclass();
		$responce->page = $page;
		$responce->records = $records;
		$responce->total = $total;
		$i=0; 
		if($data_result){
			if(isset($data_result['xrow'])){
				//var_dump($data_result['xrow']);
				foreach($data_result['xrow'] as $key=>$value){
					
					//-----------untuk menambahkan kolom alphabet -------------
					   array_push($data_arr, $value); 
					   $data_arr[$key]['r13'] = $alphabet[$i];
					 	//if(isset($key)){
					      $value=$data_arr[$key];
						//}
					//-----------Akhir untuk menambahkan kolom alphabet -------------
					
					if(isset($extra_param['methodid'])){
						$responce->rows[$i]['methodid'] = $extra_param['methodid'];
					}
					
					//foreach ($value as $k => $v) { ---Pengulangan awal
					foreach ($value as $k => $v) {
						
			        	//if ($k == 'r7' || $k == 'r8' || $k == 'r9' || $k == 'r10' ){
					  if ($k == 'r5' || $k == 'r6' || $k == 'r7' || $k == 'r8' ){
							//var_dump($k);
							$responce->rows[$i][$k] = $this->CI->mainconfig->decimalToFraction($v);
						}else{
							//var_dump($i);
					     	$responce->rows[$i][$k] = $v;
						}
					} 
					
					
					if(isset($extra_param['field'])){
						foreach($extra_param['field'] as $dt_field_key => $dt_field_value){
							//var_dump($dt_field_value);
							$responce->rows[$i][$dt_field_key] = $dt_field_value;
						}
					}
					
					$i++;
				}
			}
		}
		
		if(isset($extra_param['sp_sum'])){
			$userdata = $this->get_field_data_sum($extra_param['sp_sum'],$field,$extra_param);
			foreach($field as $key => $value){
				if(isset($value['footer'])){
					if($value['footer'] != 'sum'){
						$userdata->$key = $value['footer'];
					} else {
						if(!isset($userdata->$key)){
							$userdata->$key = 0;
						}
					}
				}
			}
			$responce->userdata = $userdata; 
		}
		
	
		
		$return = json_encode($responce);
	
		
		return $return;
	}		

function get_field_data_pop_spec_temporary($view2,$field,$extra_param=array()){
		$this->CI->authentication->plainlayout();
		$return = array();
		
		$page = isset($_POST['page'])?$_POST['page']:1; // get the requested page 
        $rows = isset($_POST['rows'])?$_POST['rows']:10; // get how many rows we want to have into the grid 
        $sidx = isset($_POST['sidx'])?$_POST['sidx']:'r1'; // get index row - i.e. user click to sort 
        $sord = isset($_POST['sord'])?$_POST['sord']:'desc'; // get the direction 
		$search = isset($_REQUEST['_search'])?$_REQUEST['_search']:false; 
		$filterRules =  isset($_POST['filters'])?$_POST['filters']:false;
		
		$decode_filterRules = json_decode($filterRules,true);
		if(isset($decode_filterRules)){
			if(isset($decode_filterRules['rules'])){
				$rules = $decode_filterRules['rules'];
			} else {
				$rules = array();
			}
		} else {
			$decode_filterRules['groupOp'] = 'AND';
			$rules = array();
		}
			
		if(isset($extra_param['where'])){
			foreach($extra_param['where'] as $dt_where){
				$have_key = false;
					
				foreach($rules as $key => $value){
					if($value['field'] == $dt_where['field']){
						$have_key = true;
						$rules[$key]['data'] = $dt_where['data'];
						break;
					}
				
				}
				
				if(!$have_key){
					$data_where = array();
					$data_where['field'] = $dt_where['field'];
					$data_where['op'] = 'eq';
					$data_where['data'] = $dt_where['data'];
					$rules[] = $data_where;
				}
			}
		}
		//var_dump($rules);
		$decode_filterRules['rules'] = $rules;
		$filterRules = json_encode($decode_filterRules);
		
		$limit =  $rows;
		$offset =  $rows * ($page - 1);
		
		$order = isset($_REQUEST['order']) ? $_REQUEST['order'] : array();
		
		if($sord == 'asc'){
			$sord = 1;
		} else {
			$sord = 2;
		}
		
		$sort =	$sidx. '='.$sord;	
					
		$return = array();
		$return['valid'] = false;
		$return['message'] = "Internal Server Error";	
				
				
		$sp = "dbo.sp_ecc_load_view_data";	
    		
		//$this->CI->rpc_service_portal->setSP($sp);
		//$this->CI->rpc_service_portal->addField('view',$view);
		//$this->CI->rpc_service_portal->addField('sort',$sort);
		//$this->CI->rpc_service_portal->addField('limit',$limit);
		//$this->CI->rpc_service_portal->addField('offset',$offset);
		//$this->CI->rpc_service_portal->setWhere($search,$filterRules,$field);
		//$result = $this->CI->rpc_service_portal->resultJSON();
        //$this->CI->rpc_service->setPOP($sp);
	    $this->CI->rpc_service->setSP($sp);
      //  $this->CI->rpc_service->setSP($sp);
		$this->CI->rpc_service->addField('view',$view2);
		$this->CI->rpc_service->addField('sort',$sort);
		$this->CI->rpc_service->addField('limit',$limit);
		
		$this->CI->rpc_service->addField('offset',$offset);
		$this->CI->rpc_service->setWhere($search,$filterRules,$field);
		
		//$result = $this->CI->rpc_service->resultJSON();	
		$result = $this->CI->rpc_service->resultJSON_pop();
		
		$data_result = json_decode($result['data'],true);
		//var_dump($data_result['xrow']);
		
		if(isset($data_result['detail']['result_count'])){
			$records = $data_result['detail']['result_count'];
			$total = ceil($data_result['detail']['result_count'] / $limit);
		} else {
			$records = 0;
			$total = 0;
		}
		
		$data_arr=array();
		//$alphabet=array(0=>'A',1=>'B',2=>'C',3=>'D',4=>'E',5=>'F',6=>'G',7=>'H',8=>'I',9=>'J',10=>'K');
		$alphabet=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH');
		$responce = new stdclass();
		$responce->page = $page;
		$responce->records = $records;
		$responce->total = $total;
		$i=0; 
		if($data_result){
			if(isset($data_result['xrow'])){
				//var_dump($data_result['xrow']);
				foreach($data_result['xrow'] as $key=>$value){
					
					//-----------untuk menambahkan kolom alphabet -------------
					   array_push($data_arr, $value); 
					   $data_arr[$key]['alphabet'] = $alphabet[$i];
					 	//if(isset($key)){
					      $value=$data_arr[$key];
						//}
					//-----------Akhir untuk menambahkan kolom alphabet -------------
					
					if(isset($extra_param['methodid'])){
						$responce->rows[$i]['methodid'] = $extra_param['methodid'];
					}
					
					//foreach ($value as $k => $v) { ---Pengulangan awal
					foreach ($value as $k => $v) {
						
			        	if ($k == 'r7' || $k == 'r8' || $k == 'r9' || $k == 'r10' ){
							//var_dump($k);
							$responce->rows[$i][$k] = $this->CI->mainconfig->decimalToFraction($v);
						}else{
							//var_dump($i);
					     	$responce->rows[$i][$k] = $v;
						}
					} 
					
					
					if(isset($extra_param['field'])){
						foreach($extra_param['field'] as $dt_field_key => $dt_field_value){
							//var_dump($dt_field_value);
							$responce->rows[$i][$dt_field_key] = $dt_field_value;
						}
					}
					
					$i++;
				}
			}
		}
		
		if(isset($extra_param['sp_sum'])){
			$userdata = $this->get_field_data_sum($extra_param['sp_sum'],$field,$extra_param);
			foreach($field as $key => $value){
				if(isset($value['footer'])){
					if($value['footer'] != 'sum'){
						$userdata->$key = $value['footer'];
					} else {
						if(!isset($userdata->$key)){
							$userdata->$key = 0;
						}
					}
				}
			}
			$responce->userdata = $userdata; 
		}
		
	
		
		$return = json_encode($responce);
	
		
		return $return;
	}		


	function get_field_data_sum($sp,$field,$extra_param=array()){
		$this->CI->authentication->plainlayout();
		$return = array();
		
		$page = isset($_POST['page'])?$_POST['page']:1; // get the requested page 
        $rows = isset($_POST['rows'])?$_POST['rows']:10; // get how many rows we want to have into the grid 
        $sidx = isset($_POST['sidx'])?$_POST['sidx']:'r1'; // get index row - i.e. user click to sort 
        $sord = isset($_POST['sord'])?$_POST['sord']:'desc'; // get the direction 
		$search = isset($_REQUEST['_search'])?$_REQUEST['_search']:false; 
		$filterRules =  isset($_POST['filters'])?$_POST['filters']:false;
		
		$decode_filterRules = json_decode($filterRules,true);
		if(isset($decode_filterRules)){
			if(isset($decode_filterRules['rules'])){
				$rules = $decode_filterRules['rules'];
			} else {
				$rules = array();
			}
		} else {
			$decode_filterRules['groupOp'] = 'AND';
			$rules = array();
		}
			
		
		if(isset($extra_param['where'])){
			foreach($extra_param['where'] as $dt_where){
				$have_key = false;
				
				foreach($rules as $key => $value){
					if($value['field'] == $dt_where['field']){
						$have_key = true;
						$rules[$key]['data'] = $dt_where['data'];
						break;
					}
				}
				
				if(!$have_key){
					$data_where = array();
					$data_where['field'] = $dt_where['field'];
					$data_where['op'] = 'eq';
					$data_where['data'] = $dt_where['data'];
					$rules[] = $data_where;
				}
			}
		}
		
		$decode_filterRules['rules'] = $rules;
		$filterRules = json_encode($decode_filterRules);
		
		$limit =  $rows;
		$offset =  $rows * ($page - 1);
		
		$order = isset($_REQUEST['order']) ? $_REQUEST['order'] : array();
		
		if($sord == 'asc'){
			$sord = 1;
		} else {
			$sord = 2;
		}
		
		$sort =	$sidx. '='.$sord;	
	
		$this->CI->rpc_service->setSP($sp);
		$this->CI->rpc_service->addField('sort',$sort);
		$this->CI->rpc_service->addField('limit',$limit);
		$this->CI->rpc_service->addField('offset',$offset);
		
		
		$this->CI->rpc_service->setWhere($search,$filterRules,$field);
		
		$result = $this->CI->rpc_service->resultJSON();	
		$data_result = json_decode($result['data'],true);
		
		$userdata = new stdclass();
		$i=0; 
		if($data_result){
			if(isset($data_result['xrow'])){
				foreach($data_result['xrow'] as $key=>$value){			
					foreach ($value as $k => $v) {
						$userdata->$k  = $v;
					}
					$i++;
				}
			}
		}
		
		
		return $userdata;
	}
	
	function load_uom(){
		$return = '';
		$data_table = $this->CI->main->getData('dbo.view_list_uom');
		if($data_table){
			foreach($data_table as $key => $value){
				array("id"=>$value['id'],"value"=>$value['value'],"text"=>$value['text']);
				$return .= $value['id'] .":". $value['value'] .";";
			}
		}
		
		return $return;
	}
	
}