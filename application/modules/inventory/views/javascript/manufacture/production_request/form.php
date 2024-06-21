<script type="text/javascript">
	var new_work_order_request = 1;
	var work_order_request_id = 0;
	
	var work_order_request_plan_id = 0;
	var work_order_request_work_process_id = 0;
	
	var work_order_request_bom_id = 0;
	var work_order_request_quantity = 0;
	
	var idsOfSelectedRows_<?php echo $methodid ?>_detail = [],
	updateIdsOfSelectedRows_<?php echo $methodid ?>_detail = function (id, isSelected) {
		var index = $.inArray(id, idsOfSelectedRows_<?php echo $methodid ?>_detail);
		if (!isSelected && index >= 0) {
			idsOfSelectedRows_<?php echo $methodid ?>_detail.splice(index, 1); // remove id from the list
		} else if (index < 0) {
			idsOfSelectedRows_<?php echo $methodid ?>_detail.push(id);
		}
	};
	
	$(".form_tab_<?php echo $methodid ?>").on("click", "a", function (e) {
        e.preventDefault();
		setTimeout(function(){ 
			change_form_<?php echo $methodid ?>_detail_work_order_detail_id();
			
			$("#table_<?php echo $methodid ?>_detail").trigger("reloadGrid", { fromServer: true, page: 1 });
			$("#table_<?php echo $methodid ?>_detail").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail').width() - 20,true).trigger('resize');
			
			$("#table_<?php echo $methodid ?>_list").trigger('reloadGrid');
			$("#table_<?php echo $methodid ?>_list").setGridWidth($('.grid_container_<?php echo $methodid; ?>_list').width() - 20,true).trigger('resize');
			
			$('.tab_scrollbar').getNiceScroll().resize(); 
		}, 500);
    });
	
	$('#form_<?php echo $methodid ?>_work_process_id').on('change', function (event, clickedIndex, newValue, oldValue) {
		$('#form_<?php echo $methodid ?>_work_order_plan_id').html('');
		$('#form_<?php echo $methodid ?>_work_order_plan_id').selectpicker('refresh');
		change_form_<?php echo $methodid ?>_work_order_plan_id();
	});
	
	$('#form_<?php echo $methodid ?>_detail_work_order_detail_id').on('change', function (event, clickedIndex, newValue, oldValue) {
		$('#form_<?php echo $methodid ?>_detail_item_id').html('');
		$('#form_<?php echo $methodid ?>_detail_item_id').selectpicker('refresh');
		change_form_<?php echo $methodid ?>_detail_item_id();
	});
	
	$('#form_<?php echo $methodid ?>_detail_item_id').on('change', function (event, clickedIndex, newValue, oldValue) {
		$('#form_<?php echo $methodid ?>_detail_bom_id').html('');
		$('#form_<?php echo $methodid ?>_detail_bom_id').selectpicker('refresh');
		change_form_<?php echo $methodid ?>_detail_bom_id();
	});
	
	$('#form_<?php echo $methodid ?>_detail_quantity_request ,#form_<?php echo $methodid ?>_detail_bom_id').on('change', function (event, clickedIndex, newValue, oldValue) {
		$("#table_<?php echo $methodid ?>_detail").trigger("reloadGrid", { fromServer: true, page: 1 });
		idsOfSelectedRows_<?php echo $methodid ?>_detail = [];
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
			purchase_request_no: {
				required: true
			},
			purchase_request_date:{
				required: true
			}
		} 
	});
	
	function edit_<?php echo $methodid?>(id){
		page_loading("show",'<?php echo $page_title ?>','Please Wait...');
		$.ajax({
			url: baseurl+'loader',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param: 'data_work_order_request'
				,id : id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				page_loading("hide");
				$('.button_<?php echo $methodid ?>_detail_edit').hide();
				$('.button_<?php echo $methodid ?>_detail_new').show();		
				
				new_work_order_request = 0;
				work_order_request_id = data[0].work_order_request_id;
				work_order_request_plan_id = data[0].work_order_plan_id;
				work_order_request_work_process_id = data[0].work_process_id;
				
				$('#form_<?php echo $methodid ?>_work_order_request_id').val(data[0].work_order_request_id);
				$('#form_<?php echo $methodid ?>_work_order_request_no').val(data[0].work_order_request_no);
				$('#form_<?php echo $methodid ?>_work_order_request_date').val(data[0].work_order_request_date);
				
				$('#form_<?php echo $methodid ?>_detail_work_order_request_id').val(data[0].work_order_request_id);
				$('#form_<?php echo $methodid ?>_detail_work_order_plan_id').val(work_order_request_plan_id);
				$('#form_<?php echo $methodid ?>_detail_work_process_id').val(work_order_request_work_process_id);
				$('#form_<?php echo $methodid ?>_detail_work_order_request_detail_id').val('');
				
				$("#tab_<?php echo $methodid; ?>_detail").attr("data-toggle","tab");
				$("#tab_<?php echo $methodid; ?>_detail").removeClass( "tab_disabled");
			
				change_form_<?php echo $methodid ?>_work_process_id(work_order_request_work_process_id);
				
				setTimeout(function(){ 
					change_form_<?php echo $methodid ?>_work_order_plan_id(work_order_request_plan_id);
				}, 500);
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
						show_success("show",'<?php echo $page_title ?>',data.message);	
						
						work_order_request_plan_id = $('#form_<?php echo $methodid ?>_work_order_plan_id').val();
						work_order_request_work_process_id = $('#form_<?php echo $methodid ?>_work_process_id').val();
						
						if(new_work_order_request == 1){
							new_work_order_request = 0;
							$("#tab_<?php echo $methodid; ?>_detail").attr("data-toggle","tab");
							$("#tab_<?php echo $methodid; ?>_detail").removeClass( "tab_disabled");
							$("#tab_<?php echo $methodid; ?>_detail").click();
							work_order_request_id = data.work_order_request_id;
							
							$('#form_<?php echo $methodid ?>_work_order_request_id').val(work_order_request_id);
							$('#form_<?php echo $methodid ?>_detail_work_order_request_id').val(work_order_request_id);
							$('#form_<?php echo $methodid ?>_detail_work_order_plan_id').val(work_order_request_plan_id);
							$('#form_<?php echo $methodid ?>_detail_work_process_id').val(work_order_request_work_process_id);
								
							setTimeout(function(){ 
								$("#table_<?php echo $methodid ?>_detail").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_detail").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail').width() - 20,true).trigger('resize');
								
								$("#table_<?php echo $methodid ?>_list").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_list").setGridWidth($('.grid_container_<?php echo $methodid; ?>_list').width() - 20,true).trigger('resize');
								
								$('.tab_scrollbar').getNiceScroll().resize(); 
							}, 500);
							
						} else {
							new_work_order_request = 1;
							$('#panel_content_<?php echo $methodid ?>').show();
							$('#panel_content_form_<?php echo $methodid ?>').hide();
							$("#table_<?php echo $methodid ?>").trigger('reloadGrid');
						}
						
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
		
	/* Detail Function */	
		
	$(function () {
		'use strict';
		$("#table_<?php echo $methodid ?>_detail").jqGrid({
			datatype: "json",
			url: baseurl+'<?php echo $class_uri ?>/loaddata_bom',
			mtype : "post",
			postData:{
					'q':'1'
					,'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
					, work_order_detail_id : function (){
							return $('#form_<?php echo $methodid ?>_detail_work_order_detail_id').val();	
						}
					, bom_id : function (){
							return $('#form_<?php echo $methodid ?>_detail_bom_id').val();	
						}
					, quantity_request : function (){
							return $('#form_<?php echo $methodid ?>_detail_quantity_request').val();	
						}
					
			},
			colNames:['bom_detail_id', 'bom_id', 'Item Code', 'Item Name', 'Qauntity', 'Unit', 'r7', 'r8', 'r9'],
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
					,"title":"bom_id"
					,"align":"right"
					,"hidden":true
				},
				{
					"name":"r3"
					,"index":"r3"
					,"width":120
					,"searchoptions":{"clearSearch":false}
					,"title":"item_code"
					,"align":"right"
					,"hidden":false
				},
				{
					"name":"r4"
					,"index":"r4"
					,"width":120
					,"searchoptions":{"clearSearch":false}
					,"title":"item_name"
					,"align":"right"
					,"hidden":false
				},
				{
					"name":"r5"
					,"index":"r5"
					,"width":120
					,"searchoptions":{"clearSearch":false}
					,"title":"mat_quantity"
					,"align":"right"
					,editable: true
				},
				{
					"name":"r6"
					,"index":"r6"
					,"width":120
					,"searchoptions":{"clearSearch":false}
					,"title":"uom_code"
					,"align":"left"
					,"hidden":false
				},
				{
					"name":"r7"
					,"index":"r7"
					,"width":120
					,"searchoptions":{"clearSearch":false}
					,"title":"uom_code"
					,"align":"left"
					,"hidden":true
				},
				{
					"name":"r8"
					,"index":"r8"
					,"width":120
					,"searchoptions":{"clearSearch":false}
					,"title":"uom_code"
					,"align":"left"
					,"hidden":true
				},
				{
					"name":"r9"
					,"index":"r9"
					,"width":120
					,"searchoptions":{"clearSearch":false}
					,"title":"uom_code"
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
			pager: '#ptable_<?php echo $methodid ?>_detail',
			onSelectRow: updateIdsOfSelectedRows_<?php echo $methodid ?>_detail,
			onSelectAll: function (aRowids, isSelected) {
				var i, count, id;
				for (i = 0, count = aRowids.length; i < count; i++) {
					id = aRowids[i];
					updateIdsOfSelectedRows_<?php echo $methodid ?>_detail(id, isSelected);
				}
			},
			loadComplete: function () {
				var $this = $(this), i, count;
				for (i = 0, count = idsOfSelectedRows_<?php echo $methodid ?>_detail.length; i < count; i++) {
					$this.jqGrid('setSelection', idsOfSelectedRows_<?php echo $methodid ?>_detail[i], false);
				}
			}
		});
		
		$("#table_<?php echo $methodid ?>_detail").jqGrid("setColProp", "rn", {hidedlg: false});
						
		$("#table_<?php echo $methodid ?>_detail").jqGrid('navGrid','#ptable_<?php echo $methodid ?>_detail',{edit:false,add:false,del:false,view:false, search: false});  
		$("#table_<?php echo $methodid ?>_detail").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, defaultSearch: 'cn', ignoreCase: false});  
		
	});
	
	
	var jvalidate2 = $("#form_<?php echo $methodid ?>_detail").validate({
		ignore: [],
		rules: {                                            
			item_id: {
				required: true
			},
			'quantity_requested': {
				min: 0
			},
			'request_delivery_date': {
				required: true
			}
		} 
	});
	
	var check_submit = 0;
	function add_<?php echo $methodid ?>(){
		new_purchase_request = 0;
		if(check_submit == 0) {
			check_submit = 1;
			
			var myArray = [];
			var rowsData = idsOfSelectedRows_<?php echo $methodid ?>_detail;
			for (var i = 0; i < rowsData.length; i++) {
				
				var rowId = rowsData[i];
				var row = $('#table_<?php echo $methodid ?>_detail').jqGrid ('getRowData', rowId);
				
				var qty_mat = parseFloat(unwrap_cell_value(row.r5).replace(/,/g, ''));
				var idnya = parseFloat(unwrap_cell_value(row.r9).replace(/,/g, ''));
				
				if (qty_mat >= 0) {	
					myArray.push({'item_id':idnya,'qty':qty_mat}) ; 
				} 
			}

			if (myArray.length == 0 ){
				show_error("show",'Error','Please select material');
				check_submit = 0;
			} else {
				page_loading("show",'<?php echo $page_title ?> Detail','Please Wait...');
				var data = {
					'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>',                             
					request_list : myArray,
					work_order_request_id : $('#form_<?php echo $methodid ?>_detail_work_order_request_id').val(),
					work_order_detail_id : $('#form_<?php echo $methodid ?>_detail_work_order_detail_id').val(),
					item_id : $('#form_<?php echo $methodid ?>_detail_item_id').val(),
					bom_id : $('#form_<?php echo $methodid ?>_detail_bom_id').val(),
					quantity_request : $('#form_<?php echo $methodid ?>_detail_quantity_request').val()
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
							show_success("show",'<?php echo $page_title ?> Detail',data.message);	
							
							idsOfSelectedRows_<?php echo $methodid ?>_detail = [];
							
							$("#table_<?php echo $methodid ?>_detail").trigger("reloadGrid", { fromServer: true, page: 1 });
							$("#table_<?php echo $methodid ?>_list").trigger('reloadGrid');
							
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
		page_loading("show",'<?php echo $page_title ?>','Please Wait...');
		$.ajax({
			url: baseurl+'loader',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param: 'data_work_order_request_detail'
				,id : id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				page_loading("hide");
				$('.button_<?php echo $methodid ?>_detail_edit').show();
				$('.button_<?php echo $methodid ?>_detail_new').hide();		
				
				$('#form_<?php echo $methodid ?>_detail_work_order_request_detail_id').val(data[0].work_order_request_detail_id);
				$('#form_<?php echo $methodid ?>_detail_quantity_request').val(data[0].quantity_request);
				
				setTimeout(function(){ 
					change_form_<?php echo $methodid ?>_detail_work_order_detail_id(data[0].work_order_detail_id);
					setTimeout(function(){ 
						change_form_<?php echo $methodid ?>_detail_item_id(data[0].item_id);
						setTimeout(function(){ 
							change_form_<?php echo $methodid ?>_detail_bom_id(data[0].bom_id);
						}, 500);
					}, 500);
				}, 500);
			}
		});
	}
	
	function delete_detail_<?php echo $methodid ?>(work_order_request_detail_id){
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
						data: {'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>',work_order_request_detail_id:work_order_request_detail_id},
						dataType: 'json',
						method: 'post',
						success: function(data){
							page_loading("hide");
							check_submit = 0;
							if(data.valid){
								show_success("show",'Delete <?php echo $page_title ?> Detail',data.message);			
								$("#table_<?php echo $methodid ?>_detail").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_list").trigger('reloadGrid');
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
		$('#form_<?php echo $methodid ?>_detail_work_order_request_detail_id').val('');
		$('#form_<?php echo $methodid ?>_detail_quantity_requested').val(0);
		
		$('.button_<?php echo $methodid ?>_detail_edit').hide();
		$('.button_<?php echo $methodid ?>_detail_new').show();				
	}	
	/* End Detail Function */	
</script>