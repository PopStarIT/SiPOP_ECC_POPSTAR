<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class dbfunc  {
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->library('mainconfig');
	}
	
	function mssql_escape($data) {
		if(is_numeric($data))
			return $data;
		$unpacked = unpack('H*hex', $data);
		return '0x' . $unpacked['hex'];
	}
	//Datatables
	function getfield($table) {
		$this->CI->load->model('main');
		$where['TABLE_NAME'] = $table;
		$where['TABLE_SCHEMA'] = $this->CI->db->database;
		
		$return = array();
		$field = $this->CI->main->getData('view_field',null,$where);
		if($field){
			foreach($field as $dt_field){
				$return[] = array('field'=>$dt_field['COLUMN_NAME'], 'datatype'=>$dt_field['DATA_TYPE']);
			}
		}
		
		return $return;
	}
	
	function datatable($view,$request='',$columnsetting=array(), $filter = array(), $group = null, $order = array(),$array = array()){
		$field = $this->getfield($view);
		$columns = array();
		foreach($field as $key => $dt_field){
			$columns[] = array('db' => $dt_field['field'], 'dt' => $key, 'datatype' => $dt_field['datatype'], 'title' => $dt_field['field']);
		}
		
		switch($request){
			case 'column':
				return $this->loadcolumntable($view,$columns,$columnsetting,$array);
			break;
			
			case 'data':
				return $this->loaddatatable($view, $columns, $filter, $group, $order,$array);
			break;
			
			case 'bricks_search':
				$return = array();
				if(isset($columnsetting['bricks_search'])){
					if(is_array($columnsetting['bricks_search'])){
						foreach($columnsetting['bricks_search'] as $key=>$value){
							if($value){
								$return[$key] = $columns[$key];
							}
						}
						
						
						if(isset($columnsetting['title'])){
							foreach($columnsetting['title'] as $key=>$value){
								$return[$key]['title'] = $value;
							}
						}
						
						if(isset($columnsetting['datatype'])){
							foreach($columnsetting['datatype'] as $key=>$value){
								$return[$key]['datatype'] = $value;
							}
						}
						
						if(isset($columnsetting['field_target'])){
							foreach($columnsetting['field_target'] as $key=>$value){
								$return[$key]['field_target'] = $value;
							}
						}
						
						
						if(isset($columnsetting['enum'])){
							foreach($columnsetting['enum'] as $key=>$value){
								$return[$key]['enum'] = $value;
							}
						}
					}
				}
				
				return $return;				
			break;
		}
	}
	
	function loadcolumntable($view, $columns,$columnsetting,$array=array()){
		foreach($columns as $key=>$value){
			$data = array();
			$data['orderable'] =  false;
			$data['targets'] =  $value['dt'];
			$data['title'] =  ucwords(str_replace('_',' ',$value['db']));

			$field[] = $data;
		}
		
		$count = count($columns);
		
		if(isset($array['additional'])){
			foreach($array['additional'] as $key=>$value){
				$data = array();
				$data['orderable'] =  false;
				$data['targets'] =  $count++;
				$data['title'] =  ucwords(str_replace('_',' ',$value['field']));

				$field[] = $data;
			}
		}
		
		foreach($columnsetting as $key=>$value){
			foreach($value as $k=>$v){
				$field[$k][$key] = $v;
			}
		}
		
		return json_encode($field);
	}
		
	function loaddatatable($view='',$columns=array(), $filter = array(), $group = null, $order_col = array(),$array=array()){
		
		$formid = isset($_POST['formid']) ? $_POST['formid'] : false;
		
		$limit = isset($_POST['length']) ? $_POST['length'] : 10;
		$offset = isset($_POST['start']) ? $_POST['start'] : 0;
		$order = isset($_POST['order']) ? $_POST['order'] : false;
		$draw = isset($_POST['draw']) ? $_POST['draw'] : 0;
		
		if($limit == -1){
			$limit = 50;
		}
		$key = null;
		$where = array();
		
		foreach($filter as $k => $v){
			$where[$k] = $v;
		}				
		$order_data = array();
		if($order){
			if(is_array($order)){
				foreach($order as $k=>$v){
					// if($columns[$v['column']]['datatype'] == 'text'){
						// $order_data[] = "convert(varchar(max),".$columns[$v['column']]['db'].") ".$v['dir'];
					// } else {
						$order_data[] = $columns[$v['column']]['db']." ".$v['dir'];

					// }
				}
			} else {
				$order_data[] = $order;
			}
		}
		
		if(isset($order_col)){
			if($order_col){
				if(is_array($order_col)){
					foreach($order_col as $k=>$v){
						// if($columns[$v['column']]['datatype'] == 'text'){
							// $order_data[] = "convert(varchar(max),".$columns[$v['column']]['db'].") ".$v['dir'];
						// } else {
							$order_data[] = $columns[$v['column']]['db']." ".$v['dir'];

						// }
					}
				} else {
					$order_data[] = $order_col;
				}
			}
		}
		
		$total = $this->CI->main->countData($view,$where,$group);
		$data = $this->CI->main->getData($view,$key,$where,$group,$order_data,$limit,$offset);


		$row = array();
		$result = array();
		if($data){
			foreach($data as $isi) {
				$field = array();
				foreach($columns as $key=>$value){
					if($value['datatype'] == 'decimal'){
						$field[] = html_entity_decode($this->CI->mainconfig->get_decimal_format($isi[$value['db']]));
					} else {
						$field[] = html_entity_decode($isi[$value['db']]);
					}
				}
				
				if(isset($array['additional'])){
					foreach($array['additional'] as $key=>$value){
						eval($value['data']);
					}
				}

				$row['data'][] = $field;
				unset($field);
			}
		} else {
			$row['data']= array();
		}
		
		$result['recordsTotal'] = $total;
		$result['recordsFiltered'] = $total;
		$result['draw'] = $draw;
		$rows = array_merge($row,$result);
		
		echo json_encode($rows);
	} 
	
	function loadcolumn($view, $columnsetting= array()){
		$spt='dbo.MG_LOAD_COLUMN'; 
		$this->CI->ws_service->setSP(array('sp'=>$spt));
	 	$this->CI->ws_service->AddField('view_table',$view);
	 	$result = $this->CI->ws_service->resultXML();
		
		$ctype = array();
		$ctype['text'] = array("varchar","text","char");
		$ctype['int'] = array("bigint","int");
		$ctype['date'] = array("date","datetime");
		
		$return = array();
		$colModel = array();
		$colNames = array();
		$def_col = array();
		foreach($result['data'] as $value){
			$data = array();
			$data['name'] = getXMLValue($value,'COLUMN_NAME');
			$data['index'] = getXMLValue($value,'COLUMN_NAME');
			$data['searchoptions'] = array();
			$data['searchoptions']['sopt'][] = "eq";
			$data['searchoptions']['sopt'][] = "bw";
			$data['searchoptions']['sopt'][] = "bn";
			$data['searchoptions']['sopt'][] = "cn";
			$data['searchoptions']['sopt'][] = "nc";
			$data['searchoptions']['sopt'][] = "ew";
			$data['searchoptions']['sopt'][] = "en";
			//searchoptions:{sopt:['eq','bw','bn','cn','nc','ew','en']}
			$colModel[] = $data;
			
			$colNames[] =  ucwords(str_replace('_',' ',getXMLValue($value,'COLUMN_NAME')));
			
			if(in_array(getXMLValue($value,'DATA_TYPE'), $ctype['int'])){
				$ctype_data = 'int';
			} elseif(in_array(getXMLValue($value,'DATA_TYPE'), $ctype['date'])){
				$ctype_data = 'date';
			} else {
				$ctype_data = 'text';
			}
			
			$def_col[getXMLValue($value,'COLUMN_NAME')] = array("db" => getXMLValue($value,'COLUMN_NAME_2')
																,"sc" => getXMLValue($value,'COLUMN_NAME_2')
																,"ctype" => $ctype_data																	
																,"bypassvalue" => ""															
																);
		}
		
		foreach($columnsetting as $key=>$value){
			foreach($value as $k=>$v){
				$colModel[$k][$key] = $v;
				if($key == 'hidden'){
					//unset($colNames[$k]);
				}
			}
		}
		
		$return['colModel'] = json_encode($colModel);
		$return['colNames'] = json_encode(array_values($colNames));
		$return['def_col'] = $def_col;
		
		return $return;
	}
	
	function loaddata($view,$def_col,$where=array()){
	
		$spt='dbo.MG_LOADER_DATA'; 
	   	
	    $filterRules =  isset($_POST['filters'])?$_POST['filters']:'';
		$page = isset($_POST['page'])?$_POST['page']:1;
		$limit = isset($_POST['rows'])?$_POST['rows']:15;
		$order = isset($_POST['sord'])?$_POST['sord']:'asc';
		$sort = isset($_POST['sidx'])?$_POST['sidx']:'rID';
		$search = isset($_POST['_search'])?$_POST['_search']:false; 
		
		$filterWhere = json_decode($filterRules,true);
		
		foreach($where as $key=>$value){
			$filterWhere['rules'][] = array("field"=>$key,"op"=>"in","data"=>$value);
		}
		
		$filterRules = json_encode($filterWhere);

		$this->CI->ws_service->setSP(array('sp'=>$spt));
		$this->CI->ws_service->setView($limit, $page,$sort,$order,$def_col);
		$this->CI->ws_service->setWhere($search,$filterRules,$def_col);
	 	$this->CI->ws_service->AddField('view_table',$view);
		
	 	return $this->CI->ws_service->resultJSON();
	}
}
?>