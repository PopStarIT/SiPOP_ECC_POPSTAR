<?php if(isset($dashboard_table)) { ?>	
	<?php
	$colNames = array();
	$model = array();
	
	if(isset($dashboard_table['extra_data'])){
		$extra_data = $dashboard_table['extra_data'];
	} else {
		$extra_data = array();
	}
	//var_dump($extra_data);die();
	
	if(isset($dashboard_table['field'])) {
		foreach($dashboard_table['field'] as $key => $dt_field){
			
			$colNames[] = strtoupper(str_replace('_',' ',$dt_field['title']));
			
			$row = array();
			$row['name'] = $dt_field['sc'];
			$row['index'] = $dt_field['sc'];
			$row['width'] = '150';
			$row['searchoptions'] = array("clearSearch" => false);
			
			if($dt_field['sc'] == 'r1'){
				$row['key'] = true;
			}
			
			if(isset($dt_field['title'])){
				$row['title'] = $dt_field['title'];
			}
			
			if(isset($dt_field['width'])){
				$row['width'] = $dt_field['width'];
			}
			
			if(isset($dt_field['align'])){
				$row['align'] = $dt_field['align'];
			}
			
			if(isset($dt_field['hidden'])){
				$row['hidden'] = $dt_field['hidden'];
			}
							
			if(isset($dt_field['formatter'])){
				if($dt_field['sc'] != 'r1'){
					$row['formatter'] = $dt_field['formatter'];
				}
			}
			// if($ctype == 'date'){
				// $searchoptions_c = array();
				// $searchoptions_c['searchhidden'] = true;
				
				
				// $row['searchoptions'] = $searchoptions_c;
			// }
			
			
			$model[] = $row;
			// $row_field = array();
			// $row_field['targets'] = $key;
			// $row_field['name'] = $dt_field['field'];
			// if(isset($dt_field['title'])){
				// $row_field['title'] = $dt_field['title'];
			// } else {
				// $row_field['title'] = strtoupper(str_replace('_',' ',$dt_field['field']));
			// }
			
			// if(isset($dt_field['visible'])){
				// $row_field['visible'] = $dt_field['visible'];
			// }
			
			// if(isset($dt_field['className'])){
				// $row_field['className'] = $dt_field['className'];
			// } else {
				// $row_field['className'] = 'nowrap';
			// }
			
			
			// $data_field[] = $row_field;
		}
		$colModel = json_encode($model);
	}
	//var_dump($extra_data);
	
	?>
	
	<script type="text/javascript">  
  // alert(baseurl+'<?php echo $class_uri ?>/loaddata');
		$(function () {
			"use strict";
			$("#table_<?php echo $methodid ?>").jqGrid({
				url: baseurl+'<?php echo $class_uri ?>/loaddata',
				mtype : "post",
				postData:{
					'q':'1'
					,'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
					<?php foreach($extra_data as $key=>$value){ ?>
						<?php if($key == 'extra_param'){ ?>
							<?php foreach($value as $extra_param){ ?>
								, '<?php echo $extra_param['field'] ?>' : function (){
									return $('#<?php echo $extra_param['form_id'] ?>').val();	
								}									
							<?php } ?>
						<?php } ?>
						<?php if($key == 'methodid'){ ?>
								, 'methodid' : <?php echo $value ?>		
						<?php } ?>
						<?php if($key == 'custom_type_id'){ ?>
								, 'custom_type_id' : <?php echo $value ?>		
						<?php } ?>
					<?php } ?>
					},
				datatype: "json",
				colNames:[<?php echo "'". implode("','",$colNames) ."'" ?>],
				colModel:<?php echo $colModel ?>,
				iconSet: "fontAwesome",
				rownumbers: true,
				rowNum:10,
				rowList:[10,30,50,100],
				pager: '#ptable_<?php echo $methodid ?>',
				sortname: "r1",
				sortorder: "desc",
				autowidth:true,
				shrinkToFit:false,
				forceFit:true,
				height: 250,		
				jsonReader: { repeatitems : false },
				viewrecords : true,
				gridview:true,
				multipleSearch: true,
				multipleGroup: true,
				recreateFilter: true,
				overlay: 0
			}); 
			$("#table_<?php echo $methodid ?>").jqGrid("setColProp", "rn", {hidedlg: false});
						
			$("#table_<?php echo $methodid ?>").jqGrid('navGrid','#ptable_<?php echo $methodid ?>',{edit:false,add:false,del:false,view:false, search: false});  
			$("#table_<?php echo $methodid ?>").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, defaultSearch: 'cn', ignoreCase: false});  
			
		});
	</script>
	
	
	<?php 
		if(isset($dashboard_table['nav_button'])) {
			foreach($dashboard_table['nav_button'] as $dt_nav_button) {
					
				$permision = $this->authentication->permission_check($dt_nav_button['method_id']);
				//var_dump($permision);
				if($permision){
				//	var_dump($dt_nav_button['load']);die();
					if(isset($dt_nav_button['load'])){
						$component = array();
						$component['function'] = $dt_nav_button['method_id'] ."_". $data_method[$dt_nav_button['method_id']]['method'];
						//var_dump('javascript/'.$dt_nav_button['load']);
						//var_dump($component);die();
						$this->load->view('javascript/'.$dt_nav_button['load'],$component);
					}
				}
			}
		} 
	?>
<?php } ?>