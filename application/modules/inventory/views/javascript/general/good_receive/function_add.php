<script type="text/javascript">  
	function nav_button_<?php echo $function ?>(){
		new_grn = 1;
		grn_lock_data = 0;
		grn_type_id = 2;
		
		$('.form_title_<?php echo $methodid ?>').html('New <?php echo $page_title ?>');
		
		page_loading("show",'New <?php echo $page_title ?>','Please Wait...');
		
		$("#tab_<?php echo $methodid; ?>_detail").removeAttr("data-toggle");
		$("#tab_<?php echo $methodid; ?>_detail").addClass( "tab_disabled");
		
		$('#panel_content_<?php echo $methodid ?>').hide();
		$('#panel_content_form_<?php echo $methodid ?>').show();
		
		$('#form_<?php echo $methodid ?>_bc_in_header_id').html('');
		$('#form_<?php echo $methodid ?>_bc_in_header_id').selectpicker('refresh');
		
		$('#form_<?php echo $methodid ?>_purchase_order_id').html('');
		$('#form_<?php echo $methodid ?>_purchase_order_id').selectpicker('refresh');
		
		$('#form_<?php echo $methodid ?>_grn_id').val('');
		$('#form_<?php echo $methodid ?>_grn_type_id').val(grn_type_id);
		getnexttransno(10, 'form_<?php echo $methodid ?>_grn_no');
		$('#form_<?php echo $methodid ?>_grn_date').val('<?php echo date('Y-m-d') ?>');
		$('#form_<?php echo $methodid ?>_delivery_no').val('');
		$('#form_<?php echo $methodid ?>_delivery_date').val('');
		
		$('.select_<?php echo $methodid ?>_from_purchase').hide();
		$('.select_<?php echo $methodid ?>_from_custom').show();
		$('.panel_<?php echo $methodid ?>_from_purchase').hide();
		$('.panel_<?php echo $methodid ?>_from_custom').show();
		
		setTimeout(function(){ 
			$('.tab_scrollbar').getNiceScroll().resize(); 
		}, 100);
	}
</script>