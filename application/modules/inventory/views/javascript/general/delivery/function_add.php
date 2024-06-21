<script type="text/javascript">  
	function nav_button_<?php echo $function ?>(){
		delivery_type_id = 2;
		//alert(delivery_type_id );
		$('#form_<?php echo $methodid ?>_bc_out_header_id').html('');
		$('#form_<?php echo $methodid ?>_bc_out_header_id').selectpicker('refresh');
		
		$('#form_<?php echo $methodid ?>_sales_order_id').html('');
		$('#form_<?php echo $methodid ?>_sales_order_id').selectpicker('refresh');
		
		$('#panel_content_<?php echo $methodid ?>').hide();
		$('#panel_content_form_<?php echo $methodid ?>').show();
				
		$('.form_title_<?php echo $methodid ?>').html('New <?php echo $page_title ?>');
		
		$('#form_<?php echo $methodid ?>_delivery_id').val('');
		$('#form_<?php echo $methodid ?>_delivery_type_id').val(delivery_type_id);
		getnexttransno(39, 'form_<?php echo $methodid ?>_delivery_no');
		$('#form_<?php echo $methodid ?>_delivery_date').val('<?php echo date('Y-m-d') ?>');
		
		$('.select_<?php echo $methodid ?>_from_sales').hide();
		$('.select_<?php echo $methodid ?>_from_custom').show();
		$('.panel_<?php echo $methodid ?>_from_sales').hide();
		$('.panel_<?php echo $methodid ?>_from_custom').show();
		
		new_delivery = 1;
		table_<?php echo $methodid ?>_delivery_order.api().draw();
		
		setTimeout(function(){ 
			$('.tab_scrollbar').getNiceScroll().resize(); 
		}, 100);
	}
</script>