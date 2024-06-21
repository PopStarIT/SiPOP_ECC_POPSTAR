<script type="text/javascript">
	var new_work_order_scrap = 1;
	var work_order_scrap_plan_id = 0;
	var work_order_scrap_work_process_id = 0;
	var work_order_scrap_id = 0;
	var work_order_scrap_bom_id = 0;
	var work_order_scrap_quantity = 0;
	var work_order_scrap_list_id = 0;
	var work_order_scrap_supply_id = 0;
	
	var idsOfSelectedRows_<?php echo $methodid ?>_material = [],
	updateIdsOfSelectedRows_<?php echo $methodid ?>_material = function (id, isSelected) {
		var index = $.inArray(id, idsOfSelectedRows_<?php echo $methodid ?>_material);
		if (!isSelected && index >= 0) {
			idsOfSelectedRows_<?php echo $methodid ?>_material.splice(index, 1); // remove id from the list
		} else if (index < 0) {
			idsOfSelectedRows_<?php echo $methodid ?>_material.push(id);
		}
	};
	
	$(".form_tab_<?php echo $methodid ?>").on("click", "a", function (e) {
        e.preventDefault();
		idsOfSelectedRows_<?php echo $methodid ?>_material = [];
		setTimeout(function(){ 
			change_form_<?php echo $methodid ?>_detail_item_id();
			
			$("#table_<?php echo $methodid ?>_material").trigger("reloadGrid", { fromServer: true, page: 1 });
			$("#table_<?php echo $methodid ?>_material").setGridWidth($('.grid_container_<?php echo $methodid; ?>_material').width() - 20,true).trigger('resize');
			
			$("#table_<?php echo $methodid ?>_detail").trigger("reloadGrid");
			$("#table_<?php echo $methodid ?>_detail").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail').width() - 20,true).trigger('resize');
			
			$('.tab_scrollbar').getNiceScroll().resize(); 
		}, 1000);
    });
	
	$('#form_<?php echo $methodid ?>_work_process_id').on('change', function (event, clickedIndex, newValue, oldValue) {
		$('#form_<?php echo $methodid ?>_work_order_plan_id').html('');
		$('#form_<?php echo $methodid ?>_work_order_plan_id').selectpicker('refresh');
		change_form_<?php echo $methodid ?>_work_order_plan_id();
	});
		
	function cancel_<?php echo $methodid ?>(){
		$('#panel_content_<?php echo $methodid ?>').show();
		$('#panel_content_form_<?php echo $methodid ?>').hide();
		$("#table_<?php echo $methodid ?>").trigger('reloadGrid');
	}
	
	function save_<?php echo $methodid ?>(){
		$('#form_<?php echo $methodid ?>').submit();
	}
	
	var jvalidate = $("#form_<?php echo $methodid ?>").validate({
		ignore: [],
		rules: {                                            
			gl_account_group: {
				required: true
			}
		} 
	});
	
	function edit_<?php echo $methodid?>(id){
		//alert(id);
		$.ajax({
			url: baseurl+'loader',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param: 'data_work_order_scrap'
				,id : id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				work_order_scrap_id = data[0].work_order_scrap_id;
				new_work_order_scrap = 0;
				work_order_scrap_plan_id = data[0].work_order_plan_id;
				work_order_scrap_work_process_id = data[0].work_process_id;
									
				$('#form_<?php echo $methodid ?>_detail_quantity_scrap').val(0);
				
				$('#form_<?php echo $methodid ?>_work_order_scrap_id').val(work_order_scrap_id);
				$('#form_<?php echo $methodid ?>_work_order_scrap_no').val(data[0].work_order_scrap_no);
				$('#form_<?php echo $methodid ?>_work_order_scrap_date').val(data[0].work_order_scrap_date);
				
				$('#form_<?php echo $methodid ?>_detail_work_order_scrap_id').val(work_order_scrap_id);
				$('#form_<?php echo $methodid ?>_detail_work_order_plan_id').val(work_order_scrap_plan_id);
				$('#form_<?php echo $methodid ?>_detail_work_process_id').val(work_order_scrap_work_process_id);
				$('#form_<?php echo $methodid ?>_detail_work_order_scrap_date').val(data[0].work_order_scrap_date);
				$('#form_<?php echo $methodid ?>_detail_work_order_scrap_detail_id').val('');
				
				$("#tab_<?php echo $methodid; ?>_detail").attr("data-toggle","tab");
				$("#tab_<?php echo $methodid; ?>_detail").removeClass( "tab_disabled");
			
				change_form_<?php echo $methodid ?>_work_process_id(work_order_scrap_work_process_id);
				setTimeout(function(){ 
					change_form_<?php echo $methodid ?>_work_order_plan_id(work_order_scrap_plan_id);
				}, 500);
												
				setTimeout(function(){ 
					$("#tab_<?php echo $methodid; ?>_supply").removeAttr("data-toggle");
					$("#tab_<?php echo $methodid; ?>_supply").addClass( "tab_disabled");
			
					$("#tab_<?php echo $methodid; ?>_detail").attr("data-toggle","tab");
					$("#tab_<?php echo $methodid; ?>_detail").removeClass( "tab_disabled");
					
					$("#tab_<?php echo $methodid; ?>_header").attr("data-toggle","tab");
					$("#tab_<?php echo $methodid; ?>_header").removeClass( "tab_disabled");
					$("#tab_<?php echo $methodid; ?>_header").click();
					
					$('.tab_scrollbar').getNiceScroll().resize(); 
				}, 100);
			}
		});
	}
		
	var check_submit = 0;
	function post_<?php echo $methodid ?>(){
		if(check_submit == 0) {
			check_submit = 1;
			page_loading("show",'Save <?php echo $page_title ?>','Please Wait...');
			var data = $("#form_<?php echo $methodid ?>").serialize();
			
			$.ajax({
				url: baseurl+'<?php echo $class_uri ?>/post_add_edit',
				data: data,
				dataType: 'json',
				method: 'post',
				success: function(data){
					page_loading("hide");
					check_submit = 0;
					if(data.valid){
						show_success("show",'<?php echo $page_title ?> Header',data.message);	
						work_order_scrap_work_process_id = $('#form_<?php echo $methodid ?>_work_process_id').val();
						work_order_scrap_plan_id = $('#form_<?php echo $methodid ?>_work_order_plan_id').val();
						work_order_scrap_date = $('#form_<?php echo $methodid ?>_work_order_scrap_date').val();
									
						if(new_work_order_scrap == 1){
							new_work_order_scrap = 0;
							work_order_scrap_id = data.work_order_scrap_id;
							
							$('#form_<?php echo $methodid ?>_work_order_scrap_id').val(work_order_scrap_id);
							$('#form_<?php echo $methodid ?>_detail_work_order_scrap_id').val(work_order_scrap_id);
							$('#form_<?php echo $methodid ?>_detail_work_order_scrap_detail_id').val('');
							$('#form_<?php echo $methodid ?>_detail_work_process_id').val(work_order_scrap_work_process_id);
							$('#form_<?php echo $methodid ?>_detail_work_order_plan_id').val(work_order_scrap_plan_id);
							$('#form_<?php echo $methodid ?>_detail_work_order_scrap_date').val(work_order_scrap_date);
									
							$("#tab_<?php echo $methodid; ?>_detail").attr("data-toggle","tab");
							$("#tab_<?php echo $methodid; ?>_detail").removeClass( "tab_disabled");
							$("#tab_<?php echo $methodid; ?>_detail").click();
												
							setTimeout(function(){ 
								$("#table_<?php echo $methodid ?>_material").trigger("reloadGrid", { fromServer: true, page: 1 });
								$("#table_<?php echo $methodid ?>_material").setGridWidth($('.grid_container_<?php echo $methodid; ?>_material').width() - 20,true).trigger('resize');
								$('.tab_scrollbar').getNiceScroll().resize(); 
							}, 500);													
						} else {
							new_work_order_scrap = 1;
							$('#panel_content_<?php echo $methodid ?>').show();
							$('#panel_content_form_<?php echo $methodid ?>').hide();
							$("#table_<?php echo $methodid ?>").trigger('reloadGrid');
						}
					} else {
						show_error("show",'Error',data.message);
					}
				},
				error: function(xhr,error){
					show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
					check_submit = 0;
				}
			});
		}
	}
	
	/* Detail Function */
	
	$(function () {
		'use strict';
		$("#table_<?php echo $methodid ?>_material").jqGrid({
			datatype: "json",
			url: baseurl+'<?php echo $class_uri ?>/loaddata_material',
			mtype : "post",
			postData:{
				'q':'1'
				,'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
				, work_order_plan_id : function (){
						return $('#form_<?php echo $methodid ?>_detail_work_order_plan_id').val();	
					}
				, work_process_id : function (){
						return $('#form_<?php echo $methodid ?>_detail_work_process_id').val();	
					}
				, work_order_scrap_date : function (){
						return $('#form_<?php echo $methodid ?>_detail_work_order_scrap_date').val();	
					}
				, work_order_scrap_detail_id : function (){
						return $('#form_<?php echo $methodid ?>_detail_work_order_scrap_detail_id').val();	
					}
			},
			colNames:['item_id', 'Item Code', 'Item Name', 'Quantity Available', 'Quantity Material', 'Unit', 'r7'],
			colModel:[
				{
					"name":"r1"
					,"index":"r1"
					,"width":120
					,"searchoptions":{"clearSearch":false}
					,"key":true
					,"title":"bom_detail_id"
					,"align":"right"
					,"hidden":true
				},
				{
					"name":"r2"
					,"index":"r2"
					,"width":120
					,"searchoptions":{"clearSearch":false}
					,"title":"item_code"
					,"align":"left"
					,"hidden":false
				},
				{
					"name":"r3"
					,"index":"r3"
					,"width":120
					,"searchoptions":{"clearSearch":false}
					,"title":"item_name"
					,"align":"left"
					,"hidden":false
				},
				{
					"name":"r4"
					,"index":"r4"
					,"width":120
					,"searchoptions":{"clearSearch":false}
					,"title":"quantity_available"
					,"align":"right"
				},
				{
					"name":"r5"
					,"index":"r5"
					,"width":120
					,"searchoptions":{"clearSearch":false}
					,"title":"quantity_material"
					,"align":"right"
					,editable: true
				},
				{
					"name":"r6"
					,"index":"r6"
					,"width":120
					,"searchoptions":{"clearSearch":false}
					,"title":"unit"
					,"align":"left"
					,"hidden":false
				},
				{
					"name":"r7"
					,"index":"r7"
					,"width":120
					,"searchoptions":{"clearSearch":false}
					,"title":"selected"
					,"align":"left"
					,"hidden":true
				}
			],
			rowNum:-1,
			multiselect: true,
			sortname: 'r1',
			viewrecords: true,
			sortorder: "asc",
			height: 250,	
			shrinkToFit:false,
			jsonReader: { repeatitems : false },
			forceFit:true,
			cellEdit:true,
			loadonce : true,
			cellsubmit: 'clientArray',
			rownumbers: true,
			pager: '#ptable_<?php echo $methodid ?>_material',
			onSelectRow: updateIdsOfSelectedRows_<?php echo $methodid ?>_material,
			onSelectAll: function (aRowids, isSelected) {
				var i, count, id;
				for (i = 0, count = aRowids.length; i < count; i++) {
					id = aRowids[i];
					updateIdsOfSelectedRows_<?php echo $methodid ?>_material(id, isSelected);
				}
			},
			loadComplete: function () {
				var rowData = $("#table_<?php echo $methodid ?>_material").getRowData();
				for (var i = 0; i < rowData.length; i++) {
				    //alert(set_decimalPlaces(rowData[i].r5,12));
					//rowData[i].r5=set_decimalPlaces(rowData[i].r5,12)
				   	if(rowData[i].r7 == 0 ){
						$(this).jqGrid('setSelection', rowData[i].r1, true);
					} else {
						$this.jqGrid('setSelection', idsOfSelectedRows_<?php echo $methodid ?>_material[i], false);
					}
				}
			}
		});
		
		$("#table_<?php echo $methodid ?>_material").jqGrid("setColProp", "rn", {hidedlg: false});
						
		$("#table_<?php echo $methodid ?>_material").jqGrid('navGrid','#ptable_<?php echo $methodid ?>_material',{edit:false,add:false,del:false,view:false, search: false});  
		$("#table_<?php echo $methodid ?>_material").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, defaultSearch: 'cn', ignoreCase: false});  
		
	});
	
	var jvalidate2 = $("#form_<?php echo $methodid ?>_detail").validate({
		ignore: [],
		rules: {                                            
			item_id: {
				required: true
			},
			'quantity_ordered': {
				min: 0
			}
		} 
	});
	
	var check_submit = 0;
	function add_<?php echo $methodid ?>(){
		new_sales_order = 0;
		if(check_submit == 0) {
			check_submit = 1;
			
			var check_error = 0;
			var error_msg = '';
			
			var myArray = [];
			var rowsData = idsOfSelectedRows_<?php echo $methodid ?>_material;
			for (var i = 0; i < rowsData.length; i++) {
				
				var rowId = rowsData[i];
				var row = $('#table_<?php echo $methodid ?>_material').jqGrid ('getRowData', rowId);
				
				var item_code = unwrap_cell_value(row.r2).replace(/,/g, '');
				var quantity_material = parseFloat(unwrap_cell_value(row.r5).replace(/,/g, ''));
				var quantity_available = parseFloat(unwrap_cell_value(row.r4).replace(/,/g, ''));
				var idnya = parseFloat(unwrap_cell_value(row.r1).replace(/,/g, ''));
				
				if(quantity_available < quantity_material){
					check_error = 1;
					error_msg = 'Item Code : ' + item_code + ' Quantity insufficient';
				} 
				
				if (quantity_material > 0) {	
					myArray.push({'item_id':idnya,'quantity_material':quantity_material}); 
				} 
			}
			
			if (myArray.length == 0 ){
				show_error("show",'Error','Please select material');
				check_submit = 0;
			} else if (check_error != 0) {
				show_error("show",'Error',error_msg);
				check_submit = 0;
			} else {
				page_loading("show",'<?php echo $page_title ?> Detail','Please Wait...');
				var form_data = $("#form_<?php echo $methodid ?>_detail").serializeArray();
				var data = {
					'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>',                             
					material_list : myArray
				}
				
				for (var i = 0; i < form_data.length; i++){
					data[form_data[i]['name']] = form_data[i]['value'];
				}
				
				
				$.ajax({
					url: baseurl+'<?php echo $class_uri ?>/post_add_edit_detail',
					data: data,
					dataType: 'json',
					method: 'post',
					success: function(data){
						page_loading("hide");
						check_submit = 0;
						if(data.valid){
							show_success("show",'<?php echo $page_title ?>',data.message);	
							idsOfSelectedRows_<?php echo $methodid ?>_detail = [];
							
							$("#table_<?php echo $methodid ?>_detail").trigger('reloadGrid');
							cancel_detail_<?php echo $methodid ?>();
							$("#table_<?php echo $methodid ?>_detail").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail').width() - 20,true).trigger('resize');
										
						} else {
							show_error("show",'Error',data.message);
						}
					},
					error: function(xhr,error){
						show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
						check_submit = 0;
					}
				});
			}
		}
	}
		
	function edit_detail_<?php echo $methodid ?>(id){
		idsOfSelectedRows_<?php echo $methodid ?>_material = [];
		page_loading("show",'<?php echo $page_title ?>','Please Wait...');
		$.ajax({
			url: baseurl+'loader',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param: 'data_work_order_scrap_detail'
				,id : id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				page_loading("hide");
			//	alert(data);
				$('.button_<?php echo $methodid ?>_detail_edit').show();
				$('.button_<?php echo $methodid ?>_detail_new').hide();	
				
				$('#form_<?php echo $methodid ?>_detail_work_order_scrap_detail_id').val(data[0].work_order_scrap_detail_id);
				$('#form_<?php echo $methodid ?>_detail_quantity_scrap').val(data[0].quantity_scrap);
				
				change_form_<?php echo $methodid ?>_detail_item_id(data[0].item_id);
				$("#table_<?php echo $methodid ?>_material").trigger("reloadGrid", { fromServer: true, page: 1 });
			
			}
		});
	}
	
	function delete_detail_<?php echo $methodid ?>(id){
		if(check_submit == 0) {
			swal({
				title: "Confirm Delete <?php echo $page_title ?> Detail ?",
				type: "question",
				dangerMode: true,
				showCancelButton: !0,
				confirmButtonClass: "btn btn-danger m-1",
				cancelButtonClass: "btn btn-secondary m-1",
				confirmButtonText: "Confirm",
				cancelButtonText: "Cancel",
				backdrop: true,
				allowOutsideClick : false,
			}).then((result) => {
				if (result.value) {
					page_loading("show",'Delete <?php echo $page_title ?> Detail','Please Wait...');
					$.ajax({
						url: baseurl+'<?php echo $class_uri ?>/delete_detail',								
						data: {'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
						,work_order_scrap_detail_id:id},
						dataType: 'json',
						method: 'post',
						success: function(data){
							page_loading("hide");
							check_submit = 0;
							if(data.valid){
								show_success("show",'Delete <?php echo $page_title ?> Detail',data.message);			
								$("#table_<?php echo $methodid ?>_detail").trigger('reloadGrid');
								cancel_detail_<?php echo $methodid ?>();
								
								setTimeout(function(){ 
									$('.tab_scrollbar').getNiceScroll().resize(); 
								}, 100);
							} else {
								show_error("show",'Error',data.message);
							}
						},
						error: function(xhr,error){
							show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
							check_submit = 0;
						}
					});
				} else if (result.dismiss === swal.DismissReason.cancel) {
					swal.closeModal();	
					check_submit = 0;
				}
			});
		}
	}
	
	function cancel_detail_<?php echo $methodid ?>(){
		$('#form_<?php echo $methodid ?>_detail_work_order_scrap_detail_id').val('');
		$('#form_<?php echo $methodid ?>_detail_quantity_scrap').val(0);
		
		idsOfSelectedRows_<?php echo $methodid ?>_material = [];
		setTimeout(function(){ 
			$("#table_<?php echo $methodid ?>_material").trigger("reloadGrid", { fromServer: true, page: 1 });
		}, 200);
		
		$("#table_<?php echo $methodid ?>_detail").trigger("reloadGrid");
		
		$('.button_<?php echo $methodid ?>_detail_edit').hide();
		$('.button_<?php echo $methodid ?>_detail_new').show();	
	}	
	/* End Detail Function */
	
	var click_transfer_<?php echo $methodid ?> = function (id, isSelected) {
		$('#form_<?php echo $methodid ?>_supply_item_stock_move_id').val('');
		$('#form_<?php echo $methodid ?>_supply_work_order_scrap_supply_id').val('');
		$('#form_<?php echo $methodid ?>_supply_quantity_supply').val(0);
		$('#form_<?php echo $methodid ?>_supply_from').val('');
		$('#form_<?php echo $methodid ?>_supply_receive_date').val('');
		$('#form_<?php echo $methodid ?>_supply_receive_no').val('');
		
		if (!isSelected) {
			$('#form_<?php echo $methodid ?>_supply_work_order_scrap_list_id').val('');
		} else {
			var row = jQuery("#table_<?php echo $methodid ?>_supply").jqGrid('getRowData',id);
			work_order_scrap_list_id = parseInt(unwrap_cell_value(row.r1).replace(/,/g, ''));
			$('#form_<?php echo $methodid ?>_supply_work_order_scrap_list_id').val(work_order_scrap_list_id);
		}
		
		$("#table_<?php echo $methodid ?>_available").trigger('reloadGrid');	
		$("#table_<?php echo $methodid ?>_list_transfer").trigger('reloadGrid');	
	}
	
	var click_item_<?php echo $methodid ?> = function (id, isSelected) {	
		if (!isSelected) {
			var row_supply = $("#table_<?php echo $methodid ?>_list_transfer").jqGrid('getRowData',id);
			if(unwrap_cell_value(row_supply.r1) == id){
				var table_available = $("#table_<?php echo $methodid ?>_list_transfer").jqGrid('getGridParam','selrow');
				if(table_available == id){
					$("#table_<?php echo $methodid ?>_list_transfer").jqGrid("resetSelection");
				}
			}
			
			$('#form_<?php echo $methodid ?>_supply_stock_move_id').val('');
			$('#form_<?php echo $methodid ?>_supply_work_order_scrap_supply_id').val('');
			$('#form_<?php echo $methodid ?>_supply_quantity_supply').val(0);
			$('#form_<?php echo $methodid ?>_supply_from').val('');
			$('#form_<?php echo $methodid ?>_supply_receive_date').val('');
			$('#form_<?php echo $methodid ?>_supply_receive_no').val('');
		} else {
			var row = $("#table_<?php echo $methodid ?>_available").jqGrid('getRowData',id);
			stock_move_id = parseInt(unwrap_cell_value(row.r1).replace(/,/g, ''));
			from = unwrap_cell_value(row.r2);
			receive_date = unwrap_cell_value(row.r3);
			receive_no = unwrap_cell_value(row.r4);
			quantity_supply = parseFloat(unwrap_cell_value(row.r7).replace(/,/g, ''));
			work_order_scrap_supply_id = '';
			
			var row_supply = $("#table_<?php echo $methodid ?>_list_transfer").jqGrid('getRowData',id);
			if(unwrap_cell_value(row_supply.r1) == id){
				work_order_scrap_supply_id = parseInt(unwrap_cell_value(row_supply.r13).replace(/,/g, ''));
				quantity_supply = parseFloat(unwrap_cell_value(row_supply.r7).replace(/,/g, ''));
				
				var table_available = $("#table_<?php echo $methodid ?>_list_transfer").jqGrid('getGridParam','selrow');
				if(table_available != id){
					$('#table_<?php echo $methodid ?>_list_transfer').jqGrid('setSelection',id);
				}
			} else {
				$("#table_<?php echo $methodid ?>_list_transfer").jqGrid("resetSelection");
			}
			
			
			$('#form_<?php echo $methodid ?>_supply_stock_move_id').val(stock_move_id);
			$('#form_<?php echo $methodid ?>_supply_work_order_scrap_supply_id').val(work_order_scrap_supply_id);
			$('#form_<?php echo $methodid ?>_supply_quantity_supply').val(quantity_supply);
			$('#form_<?php echo $methodid ?>_supply_from').val(from);
			$('#form_<?php echo $methodid ?>_supply_receive_date').val(receive_date);
			$('#form_<?php echo $methodid ?>_supply_receive_no').val(receive_no);
			
		}
	}
	
	var click_supply_<?php echo $methodid ?> = function (id, isSelected) {
		if (!isSelected) {	
			var row_available = $("#table_<?php echo $methodid ?>_available").jqGrid('getRowData',id);
			if(unwrap_cell_value(row_available.r1) == id){
				var table_available = $("#table_<?php echo $methodid ?>_available").jqGrid('getGridParam','selrow');
				if(table_available == id){
					$("#table_<?php echo $methodid ?>_available").jqGrid("resetSelection");
				}
			}
			
			$('#form_<?php echo $methodid ?>_supply_stock_move_id').val('');
			$('#form_<?php echo $methodid ?>_supply_work_order_scrap_supply_id').val('');
			$('#form_<?php echo $methodid ?>_supply_quantity_supply').val(0);
			$('#form_<?php echo $methodid ?>_supply_from').val('');
			$('#form_<?php echo $methodid ?>_supply_receive_date').val('');
			$('#form_<?php echo $methodid ?>_supply_receive_no').val('');
		} else {
			var row = $("#table_<?php echo $methodid ?>_list_transfer").jqGrid('getRowData',id);
			stock_move_id = parseInt(unwrap_cell_value(row.r1).replace(/,/g, ''));
			from = unwrap_cell_value(row.r2);
			receive_date = unwrap_cell_value(row.r3);
			receive_no = unwrap_cell_value(row.r4);
			work_order_scrap_supply_id = parseInt(unwrap_cell_value(row.r13).replace(/,/g, ''));
			quantity_supply = parseFloat(unwrap_cell_value(row.r7).replace(/,/g, ''));
			
			var row_available = $("#table_<?php echo $methodid ?>_available").jqGrid('getRowData',id);
			if(unwrap_cell_value(row_available.r1) == id){
				var table_available = $("#table_<?php echo $methodid ?>_available").jqGrid('getGridParam','selrow');
				if(table_available != id){
					$('#table_<?php echo $methodid ?>_available').jqGrid('setSelection',id);
				}
			} else {
				$("#table_<?php echo $methodid ?>_available").jqGrid("resetSelection");
			}
			
			$('#form_<?php echo $methodid ?>_supply_stock_move_id').val(stock_move_id);
			$('#form_<?php echo $methodid ?>_supply_work_order_scrap_supply_id').val(work_order_scrap_supply_id);
			$('#form_<?php echo $methodid ?>_supply_quantity_supply').val(quantity_supply);
			$('#form_<?php echo $methodid ?>_supply_from').val(from);
			$('#form_<?php echo $methodid ?>_supply_receive_date').val(receive_date);
			$('#form_<?php echo $methodid ?>_supply_receive_no').val(receive_no);
		}
	}
	
	function supply_<?php echo $methodid?>(id){
		$.ajax({
			url: baseurl+'loader',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param: 'data_work_order_scrap'
				,id : id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				work_order_scrap_id = data[0].work_order_scrap_id;
				
				$('#form_<?php echo $methodid ?>_supply_work_order_scrap_id').val(work_order_scrap_id);
				$('#form_<?php echo $methodid ?>_supply_work_order_scrap_list_id').val('');
				$('#form_<?php echo $methodid ?>_supply_work_order_scrap_no').val(data[0].work_order_scrap_no);
				$('#form_<?php echo $methodid ?>_supply_work_order_scrap_date').val(data[0].work_order_scrap_date);
				$('#form_<?php echo $methodid ?>_supply_work_process_name').val(data[0].work_process_name);
				$('#form_<?php echo $methodid ?>_supply_work_order_plan').val(data[0].work_order_plan);
				
				setTimeout(function(){ 
					$("#table_<?php echo $methodid ?>_supply").trigger('reloadGrid');
					$("#table_<?php echo $methodid ?>_supply").setGridWidth($('.grid_container_<?php echo $methodid; ?>_supply').width() - 20,true).trigger('resize');
					
					$("#table_<?php echo $methodid ?>_available").trigger('reloadGrid');
					$("#table_<?php echo $methodid ?>_available").setGridWidth($('.grid_container_<?php echo $methodid; ?>_available').width() - 20,true).trigger('resize');
						
					$("#table_<?php echo $methodid ?>_list_transfer").trigger('reloadGrid');
					$("#table_<?php echo $methodid ?>_list_transfer").setGridWidth($('.grid_container_<?php echo $methodid; ?>_list_transfer').width() - 20,true).trigger('resize');
											
					$('.tab_scrollbar').getNiceScroll().resize(); 
				}, 500);
			}
		});
	}
	
	var check_submit = 0;
	function post_<?php echo $methodid ?>_supply(){
		new_work_order_transfer = 0;
		if(check_submit == 0) {
			check_submit = 1;
			page_loading("show",'Supply','Please Wait...');
			var data = $("#form_<?php echo $methodid ?>_supply").serialize();
			$.ajax({
				url: baseurl+'<?php echo $class_uri ?>/post_add_edit_supply',
				data: data,
				dataType: 'json',
				method: 'post',
				success: function(data){
					page_loading("hide");
					check_submit = 0;
					if(data.valid){
						show_success("show",'Supply',data.message);	
						$("#table_<?php echo $methodid ?>_supply").trigger('reloadGrid');
						$("#table_<?php echo $methodid ?>_supply").setGridWidth($('.grid_container_<?php echo $methodid; ?>_supply').width() - 20,true).trigger('resize');
						
						$("#table_<?php echo $methodid ?>_available").trigger('reloadGrid');
						$("#table_<?php echo $methodid ?>_available").setGridWidth($('.grid_container_<?php echo $methodid; ?>_available').width() - 20,true).trigger('resize');
						
						$("#table_<?php echo $methodid ?>_list_transfer").trigger('reloadGrid');
						$("#table_<?php echo $methodid ?>_list_transfer").setGridWidth($('.grid_container_<?php echo $methodid; ?>_list_transfer').width() - 20,true).trigger('resize');
							
						setTimeout(function(){ 
							$('.tab_scrollbar').getNiceScroll().resize(); 
						}, 100);
					} else {
						show_error("show",'Error',data.message);
					}
				},
				error: function(xhr,error){
					show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
					check_submit = 0;
				}
			});
		}
	}
	
	function supply_fifo_<?php echo $methodid ?>(){
		if(check_submit == 0) {
			swal({
				title: "Auto Supply FIFO ?",
				type: "question",
				dangerMode: true,
				showCancelButton: !0,
				confirmButtonClass: "btn btn-danger m-1",
				cancelButtonClass: "btn btn-secondary m-1",
				confirmButtonText: "Confirm",
				cancelButtonText: "Cancel",
				backdrop: true,
				allowOutsideClick : false,
			}).then((result) => {
				if (result.value) {
					page_loading("show",'Auto Supply FIFO','Please Wait...');
					$.ajax({
						url: baseurl+'<?php echo $class_uri ?>/auto_supply_fifo',								
						data: {'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>',work_order_scrap_id:work_order_scrap_id},
						dataType: 'json',
						method: 'post',
						success: function(data){
							page_loading("hide");
							check_submit = 0;
							if(data.valid){
								show_success("show",'Auto Supply FIFO',data.message);			
								$("#table_<?php echo $methodid ?>_supply").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_supply").setGridWidth($('.grid_container_<?php echo $methodid; ?>_supply').width() - 20,true).trigger('resize');
							
								$("#table_<?php echo $methodid ?>_available").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_available").setGridWidth($('.grid_container_<?php echo $methodid; ?>_available').width() - 20,true).trigger('resize');
											
								$("#table_<?php echo $methodid ?>_list_transfer").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_list_transfer").setGridWidth($('.grid_container_<?php echo $methodid; ?>_list_transfer').width() - 20,true).trigger('resize');
									
								setTimeout(function(){ 
									$('.tab_scrollbar').getNiceScroll().resize(); 
								}, 100);
							} else {
								show_error("show",'Error',data.message);
							}
						},
						error: function(xhr,error){
							show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
							check_submit = 0;
						}
					});
				} else if (result.dismiss === swal.DismissReason.cancel) {
					swal.closeModal();	
					check_submit = 0;
				}
			});
		}
	}
	
	function supply_lifo_<?php echo $methodid ?>(){
		if(check_submit == 0) {
			swal({
				title: "Auto Supply LIFO ?",
				type: "question",
				dangerMode: true,
				showCancelButton: !0,
				confirmButtonClass: "btn btn-danger m-1",
				cancelButtonClass: "btn btn-secondary m-1",
				confirmButtonText: "Confirm",
				cancelButtonText: "Cancel",
				backdrop: true,
				allowOutsideClick : false,
			}).then((result) => {
				if (result.value) {
					page_loading("show",'Auto Supply LIFO','Please Wait...');
					$.ajax({
						url: baseurl+'<?php echo $class_uri ?>/auto_supply_lifo',								
						data: {'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>',work_order_scrap_id:work_order_scrap_id},
						dataType: 'json',
						method: 'post',
						success: function(data){
							page_loading("hide");
							check_submit = 0;
							if(data.valid){
								show_success("show",'Auto Supply LIFO',data.message);			
								$("#table_<?php echo $methodid ?>_supply").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_supply").setGridWidth($('.grid_container_<?php echo $methodid; ?>_supply').width() - 20,true).trigger('resize');
							
								$("#table_<?php echo $methodid ?>_available").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_available").setGridWidth($('.grid_container_<?php echo $methodid; ?>_available').width() - 20,true).trigger('resize');
											
								$("#table_<?php echo $methodid ?>_list_transfer").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_list_transfer").setGridWidth($('.grid_container_<?php echo $methodid; ?>_list_transfer').width() - 20,true).trigger('resize');
							
							setTimeout(function(){ 
									$('.tab_scrollbar').getNiceScroll().resize(); 
								}, 100);
							} else {
								show_error("show",'Error',data.message);
							}
						},
						error: function(xhr,error){
							show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
							check_submit = 0;
						}
					});
				} else if (result.dismiss === swal.DismissReason.cancel) {
					swal.closeModal();	
					check_submit = 0;
				}
			});
		}
	}
</script>