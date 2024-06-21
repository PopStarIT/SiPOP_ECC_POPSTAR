<div class="row">
	<div class="col-xl-12 grid_container_<?php echo $table_id ?>">
		<table id="table_<?php echo $table_id ?>"></table>
		<div id="ptable_<?php echo $table_id ?>"></div>                                                     
	</div>
</div>

<?php
	$colNames = array();
	$model = array();
	if(isset($field)) {
		foreach($field as $key => $dt_field){
			
			$colNames[] = strtoupper(str_replace('_',' ',$dt_field['title']));
			
			$row = array();
			$row['name'] = $dt_field['sc'];
			$row['index'] = $dt_field['sc'];
			$row['width'] = '150';
			$row['searchoptions'] = array("clearSearch" => false);
			$row['resizable'] = true;
					
			if($dt_field['sc'] == 'r1'){
				$row['key'] = true;
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
				$row['formatter'] = $dt_field['formatter'];
			}
						
			if(isset($dt_field['search'])){
				$row['search'] = $dt_field['search'];
			}
						
			if(isset($dt_field['sortable'])){
				$row['sortable'] = $dt_field['sortable'];
			}
						
			if(isset($dt_field['editable'])){
				$row['editable'] = $dt_field['editable'];
			}
						
			if(isset($dt_field['edittype'])){
				$row['edittype'] = $dt_field['edittype'];
			}
						
			if(isset($dt_field['editoptions'])){
				$row['editoptions'] = $dt_field['editoptions'];
			}
						
			$model[] = $row;
			
		}
		$colModel = json_encode($model);
	}

?>

<script type="text/javascript">
	var lastSel_<?php echo $table_id ?>;
	//alert(baseurl+'<?php echo $table_id ?>;');
	//alert(baseurl+'<?php echo $class_uri ?>/<?php echo $loaddata ?>');
	$(function () {
		"use strict";
		$("#table_<?php echo $table_id ?>").jqGrid({
			url: baseurl+'<?php echo $class_uri ?>/<?php echo $loaddata ?>',
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
					<?php } ?>
					
			},
			datatype: "json",
			colNames:[<?php echo "'". implode("','",$colNames) ."'" ?>],
			colModel:<?php echo $colModel ?>,
			iconSet: "fontAwesome",
			rownumbers: true,
			rowNum:10,
			rowList:[10,30,50,100],
			pager: '#ptable_<?php echo $table_id ?>',
			sortname: "r1",
			sortorder: "asc",
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
			overlay: 0,	
			<?php if(isset($extra_data['footer_data'])){ ?>		
			footerrow : true,
			userDataOnFooter : true,
			<?php } ?>
			// gridview:true,
			<?php 
				if(isset($extra_data['onclick'])){				
			?>
				onSelectRow: <?php echo $extra_data['onclick'] ?>,
			<?php
				}
			?>
			<?php 
				if(isset($extra_data['beforeclick'])){				
			?>
				beforeSelectRow: <?php echo $extra_data['beforeclick'] ?>,
			<?php
				}
			?>
			ondblClickRow: function(id){ 
			  if(id && id!==lastSel_<?php echo $table_id ?>){ 
				 $(this).restoreRow(lastSel_<?php echo $table_id ?>); 
				 lastSel_<?php echo $table_id ?>=id; 
			  } 
			  $(this).editRow(id, true); 
		   }
		}); 
		
		$("#table_<?php echo $table_id ?>").jqGrid("setColProp", "rn", {hidedlg: false});			
		$("#table_<?php echo $table_id ?>").jqGrid('navGrid','#ptable_<?php echo $table_id ?>',{edit:false,add:false,del:false,view:false, search: false});  
		$("#table_<?php echo $table_id ?>").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, defaultSearch: 'cn', ignoreCase: false});  
		
		$("#table_<?php echo $table_id ?>").bind("jqGridAfterLoadComplete", function () {
			var $this = $(this), iCol, iRow, rows, row, cm, colWidth,
				$cells = $this.find(">tbody>tr>td"),
				$colHeaders = $(this.grid.hDiv).find(">.ui-jqgrid-hbox>.ui-jqgrid-htable>thead>.ui-jqgrid-labels>.ui-th-column>div"),
				colModel = $this.jqGrid("getGridParam", "colModel"),
				n = $.isArray(colModel) ? colModel.length : 0,
				idColHeadPrexif = "jqgh_" + this.id + "_";

			$cells.wrapInner("<span class='mywrapping'></span>");
			$colHeaders.wrapInner("<span class='mywrapping'></span>");

			// $cells.wrapInner("");
			// $colHeaders.wrapInner("");

			for (iCol = 0; iCol < n; iCol++) {
				cm = colModel[iCol];
				colWidth = $("#" + idColHeadPrexif + $.jgrid.jqID(cm.name) + ">.mywrapping").outerWidth() + 25; // 25px for sorting icons
				for (iRow = 0, rows = this.rows; iRow < rows.length; iRow++) {
					row = rows[iRow];
					if ($(row).hasClass("jqgrow")) {
						colWidth = Math.max(colWidth, $(row.cells[iCol]).find(".mywrapping").outerWidth());
					}
				}
				$this.jqGrid("setColWidth", iCol, colWidth + 20,false);
			}
		});

	});
</script>