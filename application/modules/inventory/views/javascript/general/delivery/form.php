<script type="text/javascript">
	var new_delivery = 1;
	var delivery_id = 0;
	var lock_data = 0;
	var delivery_type_id = 1;
	var delivery_partner_id = 0;
	
	function change_delivery(id){
		$.ajax({
			url: baseurl+'loader',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param: 'data_delivery'
				,id : id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				$('#form_<?php echo $methodid ?>_delivery_id').val(data[0].delivery_id);
				$('#form_<?php echo $methodid ?>_delivery_type_id').val(data[0].delivery_type_id);
				$('#form_<?php echo $methodid ?>_delivery_detail_delivery_id').val(data[0].delivery_id);
				$('#form_<?php echo $methodid ?>_delivery_no').val(data[0].delivery_no);
				$('#form_<?php echo $methodid ?>_delivery_date').val(data[0].delivery_date);
				change_form_<?php echo $methodid ?>_partner_id(data[0].partner_id);
				
				delivery_id = id;
				lock_data = data[0].lock_data;
				
				new_delivery = 0;
				delivery_type_id = data[0].delivery_type_id;			
				if(data[0].delivery_type_id == 1){
					$('.panel_<?php echo $methodid ?>_from_sales').show();
					$('.panel_<?php echo $methodid ?>_from_custom').hide();
					$('.select_<?php echo $methodid ?>_from_sales').show();
					$('.select_<?php echo $methodid ?>_from_custom').hide();
					table_<?php echo $methodid ?>_delivery_order_from_sales.api().ajax.reload();

				} else {
					$('.panel_<?php echo $methodid ?>_from_sales').hide();
					$('.panel_<?php echo $methodid ?>_from_custom').show();
					$('.select_<?php echo $methodid ?>_from_sales').hide();
					$('.select_<?php echo $methodid ?>_from_custom').show();
					table_<?php echo $methodid ?>_delivery_order.api().ajax.reload();
				}
				
				
				setTimeout(function(){ 
					$('.tab_scrollbar').getNiceScroll().resize(); 
					if(data[0].delivery_type_id == 1){
						change_form_<?php echo $methodid ?>_sales_order_transfer_id(data[0].sales_order_transfer_id);
					} else {
						change_form_<?php echo $methodid ?>_bc_out_header_id(data[0].bc_out_header_id);
					}
				}, 100);
			}
		});
	}
	
	$('#form_<?php echo $methodid ?>_partner_id').on('change', function (event, clickedIndex, newValue, oldValue) {
		$('#form_<?php echo $methodid ?>_bc_out_header_id').html('');
		$('#form_<?php echo $methodid ?>_bc_out_header_id').selectpicker('refresh');
		
		$('#form_<?php echo $methodid ?>_sales_order_transfer_id').html('');
		$('#form_<?php echo $methodid ?>_sales_order_id').selectpicker('refresh');
	});
	
	$('#form_<?php echo $methodid ?>_bc_out_header_id').on('change', function (event, clickedIndex, newValue, oldValue) {
		table_<?php echo $methodid ?>_delivery_order.api().ajax.reload();
	});
	
	$('#form_<?php echo $methodid ?>_sales_order_transfer_id').on('change', function (event, clickedIndex, newValue, oldValue) {
		table_<?php echo $methodid ?>_delivery_order_from_sales.api().ajax.reload();
	});
			
	function cancel_<?php echo $methodid ?>(){
		$('#panel_content_<?php echo $methodid ?>').show();
		$('#panel_content_form_<?php echo $methodid ?>').hide();
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
	
	var check_submit = 0;
	function post_<?php echo $methodid ?>(){
		if(check_submit == 0) {
			check_submit = 1;
			page_loading("show",'<?php echo $page_title ?>','Please Wait...');
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
						$('#panel_content_<?php echo $methodid ?>').show();
						$('#panel_content_form_<?php echo $methodid ?>').hide();
						table_<?php echo $methodid ?>.api()
							.ajax
							.reload();
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

	var options_uom = {
		values: "a, b, c",
		ajax: {
			url: baseurl+"loader",
			type: "POST",
			dataType: "json",
			data: {
					'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
					,param: 'uom'
					,q: "{{{q}}}"
				}
		},
		locale: {
			emptyTitle: "UOM"
		},
		log: 3,
		preprocessData: function(data) {
			var i,
			l = data.length,
			array = [];
			if (l) {
				for (i = 0; i < l; i++) {
					array.push(
						$.extend(true, data[i], {
							text: data[i].value,
							value: data[i].id,
							data: {
								// subtext: data[i].id
							}
						})
					);
				}
			}
			
			return array;
		}
		,preserveSelected: true
	};
	
	var table_<?php echo $methodid ?>_delivery_order = $('#table_<?php echo $methodid ?>_delivery_order').dataTable({
		"dom": '<"top">t<"bottom">flipr<"clear">',
		"paging": false,
		"processing": true,
		"serverSide": true,
		"searching": false,
		"bInfo" : false,
		orderCellsTop: false,
		fixedHeader: true,
		"ajax": {
			"url": baseurl+'<?php echo $class_uri ?>/loaddata_custom_item',
			"type": "POST",
			"data": function ( d ) {
				d.<?php echo $this->security->get_csrf_token_name() ?> = "<?php echo $this->security->get_csrf_hash() ?>";
				d.new_delivery = new_delivery;
				d.delivery_id = delivery_id;
				d.lock_data = lock_data;
				d.delivery_type_id = delivery_type_id;
				d.partner_id = $('#form_<?php echo $methodid ?>_partner_id').val();
				d.bc_out_header_id = $('#form_<?php echo $methodid ?>_bc_out_header_id').val();
				
				var dt_params = $('#table_<?php echo $methodid ?>').data('dt_params');
				// Add dynamic parameters to the data object sent to the server
				if(dt_params){ $.extend(d, dt_params); }
			}
		},
		"order": [[ 3, "asc" ]],
		"columnDefs": [ 
			{"targets":0,"name":"bc_out_barang_id","orderable": false,"visible":false} 
			,{"targets":1,"name":"custom_type_name","className": "nowrap","orderable": false} 
			,{"targets":2,"name":"car","className": "nowrap","orderable": false} 
			,{"targets":3,"name":"bc_no","className": "nowrap","orderable": false} 
			,{"targets":4,"name":"bc_date","className": "nowrap","orderable": false} 
			,{"targets":5,"name":"item","className": "nowrap","orderable": false} 
			,{"targets":6,"name":"quantity_custom","className": "nowrap","orderable": false} 
			,{"targets":7,"name":"quantity_delivered","className": "nowrap","orderable": false} 
			,{"targets":8,"name":"unit","className": "nowrap","orderable": false} 
			,{"targets":9,"name":"this_order","className": "nowrap","orderable": false} 
			,{"targets":10,"name":"unit_delivered","className": "nowrap","orderable": false} 
			,{"targets":11,"name":"conversion","className": "nowrap","orderable": false} 
		],
		fnDrawCallback: function() {
		   setTimeout(function(){$('.tab_scrollbar').getNiceScroll().resize();}, 100);
		}
	});
	
	var table_<?php echo $methodid ?>_delivery_order_from_sales = $('#table_<?php echo $methodid ?>_delivery_order_from_sales').dataTable({
		"dom": '<"top">t<"bottom">flipr<"clear">',
		"paging": false,
		"processing": true,
		"serverSide": true,
		"searching": false,
		"bInfo" : false,
		orderCellsTop: false,
		fixedHeader: true,
		"ajax": {
			"url": baseurl+'<?php echo $class_uri ?>/loaddata_sales_item',
			"type": "POST",
			"data": function ( d ) {
				d.<?php echo $this->security->get_csrf_token_name() ?> = "<?php echo $this->security->get_csrf_hash() ?>";
				d.new_delivery = new_delivery;
				d.delivery_id = delivery_id;
				d.lock_data = lock_data;
				d.delivery_type_id = delivery_type_id;
				d.partner_id = $('#form_<?php echo $methodid ?>_partner_id').val();
				d.sales_order_transfer_id = $('#form_<?php echo $methodid ?>_sales_order_transfer_id').val();
				
				var dt_params = $('#table_<?php echo $methodid ?>').data('dt_params');
				// Add dynamic parameters to the data object sent to the server
				if(dt_params){ $.extend(d, dt_params); }
			}
		},
		"order": [[ 3, "asc" ]],
		"columnDefs": [ 
			{"targets":0,"name":"sales_detail_id","orderable": false,"visible":false} 
			,{"targets":1,"name":"sales_order_no","className": "nowrap","orderable": false} 
			,{"targets":2,"name":"sales_order_date","className": "nowrap","orderable": false} 
			,{"targets":3,"name":"item","className": "nowrap","orderable": false} 
			,{"targets":4,"name":"quantity_custom","className": "nowrap","orderable": false} 
			,{"targets":5,"name":"quantity_delivered","className": "nowrap","orderable": false} 
			,{"targets":6,"name":"unit","className": "nowrap","orderable": false} 
			,{"targets":7,"name":"this_order","className": "nowrap","orderable": false} 
			,{"targets":8,"name":"unit_delivered","className": "nowrap","orderable": false} 
			,{"targets":9,"name":"conversion","className": "nowrap","orderable": false} 
		],
		fnDrawCallback: function() {
		   setTimeout(function(){$('.tab_scrollbar').getNiceScroll().resize();}, 100);
		}
	});
	
</script>